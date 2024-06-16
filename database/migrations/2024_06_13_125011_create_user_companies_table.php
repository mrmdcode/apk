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
        Schema::create('user_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->constrained("users","id")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->string('company_name',250);
            $table->string("company_registration_number",250);
            $table->string("company_address",250)->nullable();
            $table->string("legal_address_company",250)->nullable();
            $table->string("economic_code_company",250);
            $table->string("national_ID",250);
            $table->string("postal_code_company",250);
            $table->string("name_agent_company",250)->nullable();
            $table->string("phone_agent_company",250)->nullable();
            $table->enum("type",["seller","buyer","both"]);
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
        Schema::dropIfExists('user_companies');
    }
};
