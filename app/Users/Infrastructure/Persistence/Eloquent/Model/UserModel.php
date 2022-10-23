<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Eloquent\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Shared\Domain\Service\HashService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * @property int id
 * @property string uuid
 * @property string login
 * @property string email
 * @property string password
 * @property string email_verified_at
 * @property Carbon created_at
 * @property Carbon updated_at
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
            set: static fn ($value) => HashService::make($value),
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
