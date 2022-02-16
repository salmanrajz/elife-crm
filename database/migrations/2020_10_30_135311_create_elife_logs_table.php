<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElifeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elife_logs', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('number_id');
            $table->string('remarks');
            $table->string('status')->default('1');
            $table->string('identify')->default('0');
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
        Schema::dropIfExists('elife_logs');
    }
}
