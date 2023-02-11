<?php

namespace App\Models\PhoneNumber;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $phone_number
 */
class PhoneNumber extends Model
{
    public const TABLE_NAME = 'phone_numbers';
    public const PHONE_NUMBER = 'phone_number';
    public const PHONABLE_ID = 'phonable_id';
    public const PHONABLE_TYPE = 'phonable_type';

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

    public function phonable(): MorphTo
    {
        return $this->morphTo();
    }
}
