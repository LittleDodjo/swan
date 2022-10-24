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
        Schema::create('employee_depencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id")->constrained("employees");
            $table->foreignId("managment_id")->constrained("managments");
            $table->foreignId("departament_id")->constrained("departaments");
            $table->foreignId("employee_departament_id")->constrained("employee_departaments");
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
