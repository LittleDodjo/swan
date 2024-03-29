<?php

use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\Reason;
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
        Schema::create('employee_defaults', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("employee_id");
            $table->unsignedBigInteger("deputy_employee_id")
                ->nullable();
            $table->foreign("employee_id")
                ->references("id")
                ->on("employees")
                ->onDelete("cascade");
            $table->foreign("deputy_employee_id")
                ->references("id")
                ->on("employees")
                ->onDelete("cascade");
            $table->foreignIdFor(Reason::class);
            $table->date("from_date");
            $table->date("to_date")->nullable();
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
        Schema::dropIfExists('employee_defaults');
    }
};
