<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElifeSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elife_sales', function (Blueprint $table) {
            $table->id();
            $table->string('lead_no')->nullable();
            $table->string('kiosk_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_number')->nullable();
            $table->string('country')->nullable();
            $table->string('age')->nullable();
            $table->string('product_type')->nullable();
            $table->string('plan')->nullable();
            $table->string('addon')->nullable();
            $table->string('zone')->nullable();
            $table->string('gender')->nullable();
            $table->string('emirate')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document')->nullable();
            $table->string('document_no')->nullable();
            $table->string('language')->nullable();
            $table->string('address')->nullable();
            $table->string('vila')->nullable();
            $table->string('street')->nullable();
            $table->string('area')->nullable();
            $table->string('makani')->nullable();
            $table->string('location_name')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('saler_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('elife_sales');
    }
}
