<?php

namespace App\Models\User;

use App\Models\ProjectDataModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPhone extends ProjectDataModel
{
    public const TABLE_NAME = 'user_phones';
    public const PHONE_NUMBER = 'phone_number';
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
        self::PHONE_NUMBER,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::USER_ID);
    }
}
