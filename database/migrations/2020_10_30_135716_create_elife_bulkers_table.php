<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElifeBulkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elife_bulkers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('number');
            $table->string('plan');
            $table->string('area');
            $table->string('identify')->default(0);
            $table->string('status')->default(1);
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
        Schema::dropIfExists('elife_bulkers');
    }
}
