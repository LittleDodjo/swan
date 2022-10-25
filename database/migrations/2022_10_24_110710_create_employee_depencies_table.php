<?php

use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
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
        Schema::create('employee_depencies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->nullable();
            $table->foreignIdFor(Managment::class)->nullable();
            $table->foreignIdFor(Departament::class)->nullable();
            $table->foreignIdFor(EmployeeDepartament::class)->nullable();
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
        Schema::dropIfExists('employee_depencies');
    }
};
