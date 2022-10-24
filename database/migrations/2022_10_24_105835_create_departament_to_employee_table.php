<?php

use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Employees\Employee;
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
        Schema::create('departament_to_employee', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Departament::class);
            $table->foreignIdFor(Employee::class);
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
        Schema::dropIfExists('departament_to_employee');
    }
};
