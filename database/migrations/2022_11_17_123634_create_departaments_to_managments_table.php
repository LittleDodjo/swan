<?php

use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Managements\Management;
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
            $table->foreignIdFor(Department::class);
            $table->foreignIdFor(Management::class);
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
