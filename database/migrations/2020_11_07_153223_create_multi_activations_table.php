<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiActivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_activations', function (Blueprint $table) {
            $table->id();
            $table->integer('cust_id');
            $table->string('lead_no');
            $table->integer('lead_id');
            $table->integer('verification_id');
            $table->string('customer_name');
            $table->integer('customer_number');
            $table->integer('age');
            $table->string('gender');
            $table->string('nationality');
            $table->string('language');
            $table->string('original_emirate_id');
            $table->string('emirate_number');
            $table->string('additional_documents');
            $table->string('sim_type');
            $table->string('number_commitment');
            $table->string('contract_commitment');
            $table->string('selected_number');
            $table->string('flexible_minutes');
            $table->string('data');
            $table->integer('local_minutes');
            $table->integer('preffer_number_allowed');
            $table->integer('free_minutes_to_preffered');
            $table->string('monthly_plan');
            $table->string('device_name');
            $table->string('device_duration');
            $table->string('device_payment');
            $table->string('select_plan');
            $table->string('benefits');
            $table->string('total');
            $table->string('monthly_payment');
            $table->string('emirate_location');
            $table->string('verify_agent');
            $table->string('remarks');
            $table->string('pay_status');
            $table->string('pay_charges');
            $table->date('activation_date');
            $table->string('activation_sr_no');
            $table->string('activation_service_order');
            $table->string('activation_selected_no');
            $table->string('activation_sim_serial_no');
            $table->string('activation_emirate_expiry');
            $table->string('activation_sold_by');
            $table->string('emirate_id_front');
            $table->string('emirate_id_back');
            $table->string('activation_screenshot');
            $table->integer('saler_id');
            $table->datetime('later');
            $table->text('recording');
            // $table->integer('saler_id');
            $table->integer('assing_to');
            $table->integer('backoffice_by');
            $table->integer('cordination_by');
            // $table->datetime('later');
            $table->datetime('date_time');
            // $table->string('recording');
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
        Schema::dropIfExists('multi_activations');
    }
}
