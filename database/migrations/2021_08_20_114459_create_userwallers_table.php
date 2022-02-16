<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserwallersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userwallers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('userid')->nullable();
            $table->decimal('amount',10,2)->nullable();
            // $table->float('')->nullable();
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
        Schema::dropIfExists('userwallers');
    }
}
