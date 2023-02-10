<?php

namespace App\Models\User;

use App\Models\ProjectDataModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property UserAuthToken|null $authToken
 * @property string $name
 * @property string|null $surname
 * @property string $email
 */
class User extends ProjectDataModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    public const TABLE_NAME = 'users';

    public const NAME = 'name';
    public const SURNAME = 'surname';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        self::NAME,
        self::SURNAME,
        self::EMAIL,
    ];

    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        self::PASSWORD,
    ];

    public function phones(): HasMany
    {
        return $this->hasMany(UserPhone::class, UserPhone::USER_ID);
    }

    public function authToken(): HasOne
    {
        return $this->hasOne(UserAuthToken::class);
    }
}
