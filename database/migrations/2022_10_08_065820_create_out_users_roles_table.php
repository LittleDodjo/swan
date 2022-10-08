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
        Schema::create('out_users_roles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->boolean('isView')->default(true);
            $table->boolean('isViewAny')->default(true);
            $table->boolean('isCreate')->default(false);
            $table->boolean('isDelete')->default(false);
            $table->boolean('isChange')->default(false);
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
        Schema::dropIfExists('out_users_roles');
    }
};
