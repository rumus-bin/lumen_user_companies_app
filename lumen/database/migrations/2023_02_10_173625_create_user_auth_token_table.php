<?php

use App\Models\User\User;
use App\Models\User\UserAuthToken;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAuthTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(UserAuthToken::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(UserAuthToken::AUTH_TOKEN);
            $table->unsignedBigInteger(UserAuthToken::USER_ID);
            $table->timestamps();

            $table->foreign(UserAuthToken::USER_ID)
                ->references(User::ID)
                ->on(User::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(UserAuthToken::TABLE_NAME);
    }
};
