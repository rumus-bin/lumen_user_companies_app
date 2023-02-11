<?php

namespace App\Models\Company;

use App\Models\PhoneNumber\PhoneNumber;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property string $title
 * @property string $description
 * @property User $user
 * @property PhoneNumber $phone
 */
class Company extends Model
{
    public const TABLE_NAME = 'companies';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const USER_ID = 'user_id';
    public const PHONE = 'phone';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        self::TITLE,
        self::DESCRIPTION
    ];

    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    public function phone(): MorphOne
    {
        return $this->morphOne(PhoneNumber::class, 'phonable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
