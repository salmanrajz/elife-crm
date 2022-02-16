<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataUploaderElivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_uploader_elife', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('name');
            $table->string('mobile_number');
            $table->string('area');
            $table->string('building_villa');
            $table->string('flat_villa_number');
            $table->string('tenant_type');
            $table->string('email')->nullable();
            $table->string('building_makani_number')->nullable();
            $table->date('contract_date')->nullable();
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
        Schema::dropIfExists('data_uploader_elives');
    }
}
