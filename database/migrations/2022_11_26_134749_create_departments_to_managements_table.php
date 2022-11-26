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
        Schema::create('departments_to_managements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\BaseModel\Department\Department::class);
            $table->foreignIdFor(\App\Models\BaseModel\Management\Management::class);
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
        Schema::dropIfExists('departments_to_managements');
    }
};
