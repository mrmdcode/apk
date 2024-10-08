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
        Schema::create('motor_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_id')->constrained('company_motors');
            $table->foreignId("event_id")->constrained('motor_events');
            $table->text("data");
            $table->enum("process",["normal","warning","error"])->nullable();
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
        Schema::dropIfExists('motor_data');
    }
};
