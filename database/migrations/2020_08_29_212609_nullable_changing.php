<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableChanging extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_sales', function (Blueprint $table) {
            //
            // $table->
            // $table->bigInteger('customer_number')->change();
            // $table->bigInteger('customer_number')->unsigned()->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_sales', function (Blueprint $table) {
            //
        });
    }
}
