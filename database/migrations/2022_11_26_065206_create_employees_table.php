<?php

use App\Models\BaseModel\Employee\Appointment;
use App\Models\BaseModel\Employee\EmployeeDependency;
use App\Models\BaseModel\Organization;
use App\Models\User;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("patronymic")->nullable();
            $table->string("phone_number");
            $table->string("email")->unique();
            $table->integer('rank')->default(1);
            $table->boolean('sex')->default(false);
            $table->string('cabinet')->nullable();
            $table->boolean("personal_data_access")->default(false);
            $table->foreignIdFor(User::class)->nullable()->unique();
            $table->foreignIdFor(Appointment::class)->nullable();
            $table->foreignIdFor(EmployeeDependency::class)->nullable()->default(null);
            $table->foreignIdFor(Organization::class);
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
};
