<?php

namespace App\Models\User;

use App\Models\ProjectDataModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $auth_token
 * @property User $user
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 */
class UserAuthToken extends ProjectDataModel
{
    public const TABLE_NAME = 'user_auth_tokens';
    public const AUTH_TOKEN = 'auth_token';
    public const USER_ID = 'user_id';
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
        self::AUTH_TOKEN,
    ];

    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::USER_ID);
    }
}
