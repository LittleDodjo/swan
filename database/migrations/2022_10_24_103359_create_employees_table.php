<?php

use App\Models\BaseModels\Employees\Appointment;
use App\Models\BaseModels\Employees\EmployeeDepency;
use App\Models\BaseModels\Organization;
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
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Appointment::class)->nullable();
            $table->foreignIdFor(EmployeeDepency::class)->nullable()->default(null);
            $table->foreignIdFor(Organization::class);
            $table->string("email")->unique();
            $table->boolean("personal_data_access")->default(false);
            $table->integer('rank')->default(0);
            $table->boolean('sex')->default(false);
            $table->string('cabinet');
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
