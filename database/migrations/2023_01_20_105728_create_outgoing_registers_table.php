<?php

use App\Models\BaseModel\Employee\Employee;
use App\Models\Outgoing\OrganizationRegister;
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
        Schema::create('outgoing_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->foreignIdFor(OrganizationRegister::class);
            $table->boolean('message_type');
            $table->date('receipt_date');
            $table->date('departure_date')->nullable();
            $table->date('departure_date_email')->nullable();
            $table->string('registration_number');
            $table->date('registration_date');
            $table->integer('lists_count')->default(1);
            $table->integer('envelopes_count')->default(1);
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
        Schema::dropIfExists('outgoing_registers');
    }
};
