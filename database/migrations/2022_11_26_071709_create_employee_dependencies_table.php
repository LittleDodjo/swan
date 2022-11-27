<?php

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Management\Management;
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
        Schema::create('employee_dependencies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->nullable();
            $table->foreignIdFor(Management::class)->nullable();
            $table->foreignIdFor(Department::class)->nullable();
            $table->foreignIdFor(EmployeeDepartment::class)->nullable();
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
        Schema::dropIfExists('employee_dependencies');
    }
};
