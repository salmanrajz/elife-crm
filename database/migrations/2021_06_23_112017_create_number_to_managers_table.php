<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumberToManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_to_managers', function (Blueprint $table) {
            $table->id();
            $table->integer('num_id')->nullable();
            $table->integer('userid')->nullable();
            $table->integer('status')->default(1);
            $table->integer('identity')->default(0);
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
        Schema::dropIfExists('number_to_managers');
    }
}
