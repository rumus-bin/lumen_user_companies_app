<?php

use App\Models\PhoneNumber\PhoneNumber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(PhoneNumber::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(PhoneNumber::PHONE_NUMBER);
            $table->unsignedBigInteger(PhoneNumber::PHONABLE_ID);
            $table->string(PhoneNumber::PHONABLE_TYPE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(PhoneNumber::TABLE_NAME);
    }
}

