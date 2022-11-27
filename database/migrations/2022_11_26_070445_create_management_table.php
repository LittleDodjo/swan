<?php

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("depends_id");
            $table->unsignedBigInteger("manager_id");
            $table->foreign("depends_id")
                ->references("id")
                ->on("employees")
                ->onDelete('cascade');
            $table->foreign("manager_id")
                ->references("id")
                ->on("employees")
                ->onDelete('cascade');
            $table->string("caption");
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
        Schema::dropIfExists('managements');
    }
};
