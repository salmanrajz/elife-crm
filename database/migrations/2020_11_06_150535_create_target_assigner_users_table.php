<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetAssignerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_assigner_users', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->string('name')->nullable();
            $table->string('month')->nullable();
            $table->string('target')->nullable();
            $table->string('user')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('target_assigner_users');
    }
}
