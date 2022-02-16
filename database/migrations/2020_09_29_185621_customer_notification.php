<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('customer_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('lead_id')->nullable();
            $table->enum('type', ['pending', 'activation', 'other', 'follow']);
            $table->integer('userid');
            $table->integer('status')->default('1');
            // $table->string('')
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
        //
        Schema::create('customer_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('lead_id')->nullable();
            $table->enum('type', ['pending', 'activation', 'other', 'follow']);
            $table->integer('userid');
            $table->integer('status')->default('1');
            // $table->string('')
            $table->timestamps();
        });
    }
}
