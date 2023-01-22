<?php

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
        Schema::create('stamp_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OutgoingRegister::class);
            $table->json('stamps_used');
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
        Schema::dropIfExists('stamp_histories');
    }
};
