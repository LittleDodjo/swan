<?php

use App\Models\BaseModel\Employee\Employee;
use App\Models\OutgoingModel\OutgoingRegister;
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
        Schema::create('stamp_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->boolean('type')->default(true);
            $table->json('balance');
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
        Schema::dropIfExists('stamp_balances');
    }
};
