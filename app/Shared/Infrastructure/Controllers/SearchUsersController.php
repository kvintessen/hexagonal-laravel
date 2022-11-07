<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controllers;

use App\Shared\Domain\Criteria\Filters;
use App\Users\Infrastructure\Adapter\UserAdapter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

final class SearchUsersController
{
    public function __construct(private readonly UserAdapter $userAdapter)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * example url: v1/kanban/boards?filters=created_at>=2022-01-01&order_by=name&order=desc&limit=5&offset=1
     */
    public function __invoke(Request $request): JsonResponse
    {
        $filters = Filters::fromString($request->get('filters'));
        $orderBy = $request->get('order_by');
        $order = $request->get('order');
        $limit = $request->get('limit');
        $offset = $request->get('offset');

        $usersDTO = $this->userAdapter->search($filters, $orderBy, $order, $limit, $offset);

        return new JsonResponse(
            [
                'users' => $usersDTO->toArray(),
            ],
            ResponseAlias::HTTP_OK,
            ['Access-Control-Allow-Origin' => '*']
        );
    }
}
