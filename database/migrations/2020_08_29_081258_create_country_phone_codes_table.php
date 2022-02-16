<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryPhoneCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_phone_codes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('code');
            $table->decimal('purchase_price',10,4);
            $table->integer('syn_status');
            $table->dateTime('syn_date');
            $table->double('lat');
            $table->double('lng');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_phone_codes');
    }
}
