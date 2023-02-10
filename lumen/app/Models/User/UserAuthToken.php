<?php

namespace App\Models\User;

use App\Models\ProjectDataModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
