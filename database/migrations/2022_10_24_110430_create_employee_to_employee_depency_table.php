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
        Schema::create('employee_to_employee_depency', function (Blueprint $table) {
            $table->id();
            $table->foreignId("primary_employee_id")->constrained("employees");
            $table->foreignId("slave_employee_id")->constrained("employees");
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
        Schema::dropIfExists('employee_to_employee_depency');
    }
};
