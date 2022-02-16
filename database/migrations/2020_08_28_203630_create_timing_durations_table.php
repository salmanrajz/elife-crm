<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimingDurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timing_durations', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_no');
            $table->datetime('lead_generate_time');
            $table->datetime('lead_accept_time');
            $table->datetime('lead_proceed_time');
            $table->integer('sale_agent');
            $table->integer('verify_agent');
            $table->integer('status');
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
        Schema::dropIfExists('timing_durations');
    }
}
