<?php

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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("management_id")->nullable();
            $table->unsignedBigInteger("manager_id");
            $table->unsignedBigInteger("deputy_id")->nullable();
            $table->foreign("management_id")
                ->references("id")
                ->on("managements");
            $table->foreign("deputy_id")
                ->references("id")
                ->on("employees");
            $table->foreign("manager_id")
                ->references("id")
                ->on("employees");
            $table->string("caption");
            $table->string("short_name")->nullable();
            $table->string("code")->unique();
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
