<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_sales', function (Blueprint $table) {
            $table->id();
            $table->string('lead_no')->nullable();
            $table->string('kiosk_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_number')->nullable();
            $table->string('email')->nullable();
            $table->string('product_type')->nullable();
            $table->string('amount')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->nullable();
            $table->integer('saler_id')->nullable();
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
        Schema::dropIfExists('billing_sales');
    }
}
