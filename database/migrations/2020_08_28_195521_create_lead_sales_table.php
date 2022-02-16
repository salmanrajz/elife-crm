<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('gender');
            $table->string('emirates');
            $table->string('pay_status');
            $table->string('pay_charges');
            $table->integer('customer_number');
            $table->integer('age');
            $table->string('nationality');
            $table->integer('number_commitment');
            $table->string('sim_type');
            $table->integer('select_plan');
            $table->string('contract_commitment');
            $table->string('benefits');
            $table->string('lead_no');
            $table->integer('selected_number');
            $table->string('device');
            $table->string('commitment_period');
            $table->string('language');
            $table->date('dob');
            $table->datetime('later_date');
            $table->string('saler_name');
            $table->integer('saler_id');
            $table->float('monthly_payment', 5, 2);
            $table->float('total_monthly_payment', 5, 2);
            $table->text('remarks');
            $table->integer('emirate_id');
            $table->integer('emirate_num');
            $table->integer('etisalat_number');
            $table->string('additional_document');
            $table->float('mobile_payment', 5, 2);
            $table->datetime('date_time');
            $table->datetime('date_time_follow');
            $table->integer('share_with');
            $table->text('pre_check_remarks');
            $table->text('pre_check_status');
            $table->text('pre_check_agent');
            $table->float('status', 5, 2);
            // $table->float('status');
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
        Schema::dropIfExists('lead_sales');
    }
}
