<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrepaidSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prepaid_sales', function (Blueprint $table) {
            $table->id();
            $table->string('lead_no')->nullable();
            $table->string('kiosk_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_number')->nullable();
            $table->string('country')->nullable();
            $table->string('age')->nullable();
            $table->string('product_type')->nullable();
            $table->string('plan')->nullable();
            $table->string('gender')->nullable();
            $table->string('emirate')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document')->nullable();
            $table->string('document_no')->nullable();
            $table->string('language')->nullable();
            $table->integer('saler_id')->nullable();
            $table->string('status')->nullable();
            $table->string('emirate_expiry')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('front_document')->nullable();
            $table->string('back_document')->nullable();
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
        Schema::dropIfExists('prepaid_sales');
    }
}
