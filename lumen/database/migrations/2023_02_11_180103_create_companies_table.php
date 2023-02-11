<?php

use App\Models\Company\Company;
use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(Company::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Company::TITLE);
            $table->text(Company::DESCRIPTION);
            $table->unsignedBigInteger(Company::USER_ID);
            $table->timestamps();

            $table->foreign(Company::USER_ID)
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
        Schema::dropIfExists(Company::TABLE_NAME);
    }
}
