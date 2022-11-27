<?php

use App\Models\BaseModel\Employee\Employee;
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
        Schema::create('employee_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("employee_depends");
            $table->unsignedBigInteger("manager_id");
            $table->unsignedBigInteger("deputy_id")->nullable();
            $table->foreign("employee_depends")
                ->references("id")
                ->on("employees");
            $table->foreign("deputy_id")
                ->references("id")
                ->on("employees");
            $table->foreign("manager_id")
                ->references("id")
                ->on("employees");
            $table->string("caption");
            $table->string("code")->unique();
            $table->string("short_name")->nullable();
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
        Schema::dropIfExists('employee_departments');
    }
};
