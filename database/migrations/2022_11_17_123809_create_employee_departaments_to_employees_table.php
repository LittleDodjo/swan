<?php

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
        Schema::create('employee_departaments_to_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\BaseModels\Employees\Employee::class);
            $table->foreignIdFor(\App\Models\BaseModels\Departaments\EmployeeDepartament::class);
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
        Schema::dropIfExists('employee_departaments_to_employees');
    }
};
