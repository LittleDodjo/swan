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
        Schema::create('departaments_to_managments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\BaseModels\Departaments\Departament::class);
            $table->foreignIdFor(\App\Models\BaseModels\Managments\Managment::class);
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
        Schema::dropIfExists('departaments_to_managments');
    }
};
