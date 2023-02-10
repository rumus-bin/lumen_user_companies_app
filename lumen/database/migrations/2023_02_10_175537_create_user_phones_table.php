<?php

use App\Models\User\User;
use App\Models\User\UserPhone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(UserPhone::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(UserPhone::PHONE_NUMBER);
            $table->unsignedBigInteger(UserPhone::USER_ID);

            $table->foreign(UserPhone::USER_ID)
                ->references(User::ID)
                ->on(User::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(UserPhone::TABLE_NAME);
    }
};
