<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('elife_sales', function (Blueprint $table) {
            //
            $table->string('front_document')->nullable();
            $table->string('back_document')->nullable();
            $table->string('sr_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elife_sales', function (Blueprint $table) {
            //
        });
    }
}
