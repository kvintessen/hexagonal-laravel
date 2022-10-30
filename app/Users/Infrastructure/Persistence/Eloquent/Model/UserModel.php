<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Eloquent\Model;

use App\Shared\Infrastructure\Service\HashService;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * App\Users\Infrastructure\Persistence\Eloquent\Model\UserModel.
 *
 * @property int $id
 * @property string $uuid
 * @property string $login
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|UserModel newModelQuery()
 * @method static Builder|UserModel newQuery()
 * @method static Builder|UserModel query()
 * @method static Builder|UserModel whereCreatedAt($value)
 * @method static Builder|UserModel whereEmail($value)
 * @method static Builder|UserModel whereEmailVerifiedAt($value)
 * @method static Builder|UserModel whereId($value)
 * @method static Builder|UserModel whereLogin($value)
 * @method static Builder|UserModel wherePassword($value)
 * @method static Builder|UserModel whereRememberToken($value)
 * @method static Builder|UserModel whereUpdatedAt($value)
 * @method static Builder|UserModel whereUuid($value)
 * @mixin Eloquent
 * @mixin Builder
 */
final class UserModel extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public const TABLE_NAME = 'users';

    public const FIELD_ID = 'id';
    public const FIELD_UUID = 'uuid';
    public const FIELD_LOGIN = 'login';
    public const FIELD_EMAIL = 'email';
    public const FIELD_PASSWORD = 'password';
    public const FIELD_REMEMBER_TOKEN = 'remember_token';
    public const FIELD_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_UPDATED_AT = 'updated_at';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::FIELD_UUID,
        self::FIELD_LOGIN,
        self::FIELD_EMAIL,
        self::FIELD_PASSWORD,
        self::FIELD_EMAIL_VERIFIED_AT,
    ];

    protected $hidden = [
        self::FIELD_PASSWORD,
        self::FIELD_REMEMBER_TOKEN,
    ];

    protected $casts = [
        self::FIELD_EMAIL_VERIFIED_AT => 'datetime',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: static fn ($value) => (new HashService)->make($value),
        );
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
