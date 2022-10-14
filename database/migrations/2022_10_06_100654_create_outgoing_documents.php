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
        Schema::create('outgoing_documents', function (Blueprint $table) {
            $table->id(); // идентификатор документа +
            $table->date("date_admission_to_office")->nullable(); // Дата поступления в канцелярию
            $table->string("executor_id")->nullable(); // Исполнитель ФИО +
            $table->integer("department_id")->nullable(); // Номер отдела +
            $table->string("out_correspondent_id")->nullable(); // Номер исходящего корреспондента +
            $table->date("out_correspondent_date")->nullable(); // Дата исходящего корреспондента +
            $table->integer("document_type")->default(0); // Тип документа * +
            $table->integer("departure_type")->default(0); // Тип отправления +
            $table->integer("departure_view")->default(0); // Вид отправления* +
            $table->date("departure_date")->nullable(); // Дата отправления письма( физического конверта ) +
            $table->date("departure_email_date")->nullable(); // Дата отправления электронной почтой +
            $table->string("outgoing_number")->nullable(); // Исходящий номер +
            $table->date("outgoing_date")->nullable(); // Дата регистрации исходяшего номера +
            $table->integer("lists_count")->default(1); // ККоличество листов +
            $table->string("where_directed")->nullable(); // Кому направлено (учреждение) +
            $table->integer("recipient")->nullable(); // Получатель +
            $table->string("address")->nullable();  // Адрес доставки +
            $table->string("document_content")->nullable(); // Содержание документа +
            $table->integer("count_of_instances")->default(0); // Количество экземпляров +
            $table->integer("count_of_envelopes")->default(0); //Количество конвертов +
            $table->integer("envelope_type")->nullable(); // Тип конверта +
            $table->float("brand_price")->nullable(); // Стоимость марок ( в рублевом эквиваленте ) +
            $table->timestamps(); // Временные метки
        });
        //            $table->date("receipt_date"); Временно отключено
//            $table->date("reg_date"); Временно отключено
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outgoing_documents');
    }
};
