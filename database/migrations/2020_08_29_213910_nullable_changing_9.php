<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableChanging9 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_sales', function (Blueprint $table) {
            //
            $table->date('dob')->unsigned()->nullable()->change();
            $table->dateTime('later_date')->unsigned()->nullable()->change();
            // $table->double('monthly_payment',5,2)->unsigned()->nullable()->change();
            // $table->double('total_monthly_payment',5,2)->unsigned()->nullable()->change();
            $table->varchar('emirate_id')->unsigned()->nullable()->change();
            $table->bigInteger('emirate_num')->unsigned()->nullable()->change();
            $table->bigInteger('etisalat_number')->unsigned()->nullable()->change();
            // $table->double('mobile_payment',5,2)->unsigned()->nullable()->change();
            $table->text('pre_check_remarks')->unsigned()->nullable()->change();
            $table->text('pre_check_status')->unsigned()->nullable()->change();
            $table->text('pre_check_agent')->unsigned()->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_sales', function (Blueprint $table) {
            //
        });
    }
}
