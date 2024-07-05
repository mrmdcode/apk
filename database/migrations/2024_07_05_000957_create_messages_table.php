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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['system','company'])->default('system');
            $table->foreignId('company_sender')->nullable()->constrained('user_companies','id');
            $table->foreignId('company_receiver')->nullable()->constrained('user_companies','id');
            $table->text('message');
            $table->timestamp('seen_at')->nullable();
            $table->enum('priority',['superHigh','high','normal','low'])->default('normal');
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
        Schema::dropIfExists('messages');
    }
};
