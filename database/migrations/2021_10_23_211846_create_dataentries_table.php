<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataentries', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('authorize_person_name');
            $table->string('authorize_person_number');
            $table->string('company_number');
            $table->string('email');
            $table->string('company_address');
            $table->longText('remarks');
            $table->string('location');
            $table->string('conversion');
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
        Schema::dropIfExists('dataentries');
    }
}
