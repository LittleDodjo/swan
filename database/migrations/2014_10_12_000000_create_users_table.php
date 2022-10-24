<?php

use App\Models\BaseModels\Employees\Employee;
use App\Models\UserRoles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
//            $table->foreignIdFor("employee")->nullable();
            $table->string("login")->unique();
            $table->string("password");
            $table->boolean("isConfirmed")->default(false);
            $table->foreignIdFor(UserRoles::class);
            $table->foreignIdFor(Employee::class);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
