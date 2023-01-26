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
        Schema::create('outgoing_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OutgoingRegister::class);
            $table->foreignIdFor(Employee::class);
            $table->json('touched_fields');
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
        Schema::dropIfExists('outgoing_histories');
    }
};
