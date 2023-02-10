<?php

use App\Models\User\User;
use App\Models\User\UserRestoreToken;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRestoreTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(UserRestoreToken::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(UserRestoreToken::RESTORE_TOKEN);
            $table->unsignedBigInteger(UserRestoreToken::USER_ID);

            $table->foreign(UserRestoreToken::USER_ID)
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
        Schema::dropIfExists(UserRestoreToken::TABLE_NAME);
    }
};
