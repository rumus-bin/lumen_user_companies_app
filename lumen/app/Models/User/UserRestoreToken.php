<?php

namespace App\Models\User;

use App\Models\ProjectDataModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRestoreToken extends ProjectDataModel
{
    public const TABLE_NAME = 'user_restore_tokens';
    public const RESTORE_TOKEN = 'restore_token';
    public const USER_ID = 'user_id';

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
