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
        Schema::create('company_motors', function (Blueprint $table) {
            $table->id();
            $table->foreignId("company_seller_id")->constrained("user_companies");
            $table->foreignId("company_buyer_id")->constrained("user_companies");
            $table->string("motor_name",250);
            $table->string("motor_model",250)->nullable();
            $table->string("motor_year",250);
            $table->string("motor_start",250)->nullable();
            $table->string("motor_serial",250)->unique();
            $table->string("motor_address",250);
            $table->text('motor_description');
            $table->float("allowable_winding_temperature");
            $table->float("allowable_bearing_temperature");
            $table->float("hungarian_vibration");
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text("file_1")->nullable();
            $table->text("file_2")->nullable();
            $table->text("file_3")->nullable();
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
        Schema::dropIfExists('company_motors');
    }
};
