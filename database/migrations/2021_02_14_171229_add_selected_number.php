<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSelectedNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postpaid_sales', function (Blueprint $table) {
            //
            $table->string('selected_number')->nullable();
            $table->string('select_plan')->nullable();
            $table->string('pay_status')->nullable();
            $table->string('pay_charges')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postpaid_sales', function (Blueprint $table) {
            //
        });
    }
}
