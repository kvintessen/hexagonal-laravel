<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Eloquent\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filter;
use App\Shared\Domain\Criteria\Filters;
use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Entity\UsersEntity;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\Users\Infrastructure\Persistence\Mapper\UserMapper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

final class DbUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly UserModel $model,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function create(UserEntity $userEntity): void
    {
        $userModel = UserMapper::mapToModel($userEntity);
        DB::beginTransaction();
        $userModel->save();
        DB::commit();
    }

    public function getByUuid(UserEntityId $id): UserEntity
    {
        /** @var UserModel $userModel */
        $userModel = $this->model->where([UserModel::FIELD_UUID => $id->value()])->first();

        return UserMapper::mapToDomain($userModel);
    }

    public function getByEmail(UserEntityEmail $email): ?UserEntity
    {
        /** @var UserModel|null $userModel */
        $userModel = $this->model->where([UserModel::FIELD_EMAIL => $email->value()])->firstOrFail();

        if (!$userModel) {
            return null;
        }

        return UserMapper::mapToDomain($userModel);
    }

    public function search(Criteria $criteria): UsersEntity
    {
        $eloquentUsers = $this->getAllByFilter(
            filters: $criteria->filters(),
            limit: $criteria->limit(),
            sort: $criteria->order()->orderBy(),
            sortBy:  $criteria->order()->type()->name
        );

        $users = $eloquentUsers->map(
            // @phpstan-ignore-next-line
            static function (UserModel $userModel)
            {
                return UserMapper::mapToDomain($userModel);
            }
        )->toArray();

        return new UsersEntity($users);
    }

    public function getAllByFilter(
        Filters $filters,
        array $relations = [],
        ?int $limit = 0,
        int $skip = 0,
        ?string $sort = null,
        ?string $sortBy = 'asc',
        int $chunk = 0,
    ): Collection {
        $query = $this->model::query();
        $filters->all() && $query = $this->applyFilters($query, $filters->all());

        $relations && $query->with($relations);
        $limit && $query->limit($limit);
        $skip && $query->skip($limit);
        $sort && $query->orderBy($sort, $sortBy);

        return $chunk ? $query->get()->chunk($chunk) : $query->get();
    }

    private function applyFilters(Builder $query, array $filters): Builder
    {
        /** @var Filter $filter */
        foreach ($filters as $filter) {
            $query->where($filter->field(), $filter->operator()->value, $filter->value());
        }

        return $query;
    }
}
