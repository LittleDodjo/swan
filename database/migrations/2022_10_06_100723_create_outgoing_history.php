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
        Schema::create('outgoing_history', function (Blueprint $table) {
            $table->id(); // Собственный идентификатор
            $table->integer("user_id"); //  Идентификатор пользователя
            $table->integer("document_id"); // Идентификатор документа
            $table->json("actions"); // json-данные коллекция совершенных операций
            $table->timestamps(); // Временные метки
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outgoing_history');
    }
};
