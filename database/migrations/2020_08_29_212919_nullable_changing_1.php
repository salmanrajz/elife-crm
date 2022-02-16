<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableChanging1 extends Migration
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
            $table->bigInteger('etisalat_number')->unsigned()->nullable()->change();
            $table->bigInteger('emirate_id')->unsigned()->nullable()->change();
            $table->bigInteger('emirate_num')->unsigned()->nullable()->change();
            $table->bigInteger('share_with')->unsigned()->nullable()->change();

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
