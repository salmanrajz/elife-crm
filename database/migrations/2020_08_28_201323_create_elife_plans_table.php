<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElifePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elife_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->string('speed');
            $table->string('devices');
            $table->float('monthly_charges', 5, 2);
            $table->float('installation_charges', 5, 2);
            $table->string('contract');
            $table->decimal('revenue',5,2);
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
        Schema::dropIfExists('elife_plans');
    }
}
