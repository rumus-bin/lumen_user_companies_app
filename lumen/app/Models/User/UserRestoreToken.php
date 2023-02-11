<?php

namespace App\Models\User;

use App\Models\ProjectDataModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $user
 * @property string $restore_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserRestoreToken extends ProjectDataModel
{
    public const TABLE_NAME = 'user_restore_tokens';
    public const RESTORE_TOKEN = 'restore_token';
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
        self::RESTORE_TOKEN,
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
