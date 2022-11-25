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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("management_id");
            $table->unsignedBigInteger("employee_manager_id")->nullable();
            $table->unsignedBigInteger("employee_primary_manager_id");
            $table->foreign("management_id")->references("id")->on("managements");
            $table->foreign("employee_manager_id")->references("id")->on("employees");
            $table->foreign("employee_primary_manager_id")->references("id")->on("employees");
            $table->string("caption");
            $table->string("short_name")->nullable();
            $table->string("display_number")->nullable();
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
        Schema::dropIfExists('departments');
    }
};
