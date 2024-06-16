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
        Schema::create('motor_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_id')->constrained('company_motors');
            $table->string("name",250);
            $table->string("topic",250);
            $table->string('payload',250)->nullable();
            $table->float('normal');
            $table->float('min');
            $table->float('max');
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
        Schema::dropIfExists('motor_events');
    }
};
