<?php

use App\Models\BaseModel\Employee\Employee;
use App\Models\OutgoingModel\OrganizationRegister;
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
        Schema::create('outgoing_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->foreignIdFor(Employee::class, 'executor_id')->nullable();
            $table->json('stamps_used')->nullable();
            $table->json('departure_data');
            $table->string('registration_number');
            $table->date('registration_date');
            $table->boolean('message_type')->default(false);
            $table->integer('lists_count')->default(1);
            $table->softDeletes();
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
