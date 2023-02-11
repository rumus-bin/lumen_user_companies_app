<?php

use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(User::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(User::NAME);
            $table->string(User::SURNAME)->nullable();
            $table->string(User::EMAIL)->unique();
            $table->string(User::PASSWORD);
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
        Schema::dropIfExists(User::TABLE_NAME);
    }
};
