<?php

namespace App\Http\Controllers;

use App\multisale;
use App\numberdetail;
use Illuminate\Http\Request;
// use Validator;
// use Carbon;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\Validator;

// use validator

class MultisaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lead = multisale::latest();
        $countries = \App\country_phone_code::all();
        $emirates = \App\emirate::all();
        $plans = \App\plan::wherestatus('1')->get();
        $last = \App\lead_sale::latest()->first();
        $users = \App\User::select("users.*")
        ->whereIn('role', array('sale', 'NumberAdmin'))
        ->where('agent_code', auth()->user()->agent_code)
        ->where('id', '!=', auth()->user()->id)
        ->get();
        $q = numberdetail::select("numberdetails.type")
        ->where("numberdetails.status", "Available")
        // ->where("numberdetails.channel_type", $daring)
            ->groupBy('numberdetails.type')

            ->get();
        return view('dashboard.add-lead-multi', compact('lead','countries','emirates','plans','last','users','q'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->call_back_at_new != '' && $request->simtype == 'New') {
            // return $request->call_back_at_new;
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                'cname' => 'required|string',
                'cnumber' => 'required|string',
                'nation' => 'required',
                'age' => 'required|numeric|min:20|not_in:20',
                'simtype' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                'activation_charges_new' => 'required',
                'activation_rate_new' => 'required',
                'remarks_process_new' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // foreach ($request->selnumber as $key => $val) {
            //     // return $val;
            //     $d = numberdetail::select("numberdetails.id")
            //         ->where('numberdetails.number', $val)
            //         ->first();
            //     $k = numberdetail::findorfail($d->id);
            //     $k->status = 'Reserved';
            //     $k->save();
            //     $k = choosen_number::create([
            //         'number_id' => $k->id,
            //         'user_id' => auth()->user()->id,
            //         'status' => '1',
            //         'agent_group' => auth()->user()->agent_code,
            //         // 'ip_address' => Request::ip(),
            //         'date_time' => Carbon::now()->toDateTimeString(),
            //     ]);
            //     // return "number has been reserved";
            //     $log = choosen_number_log::create([
            //         // 'number'
            //         'number_id' => $k->id,
            //         'user_id' => auth()->user()->id,
            //         'agent_group' => auth()->user()->agent_code,
            //     ]);
            // }
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.21';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            // $planName = $request->plan_name;
            $planName = implode(',', $request->plan_new);
            $SelNumber = implode(",", $request->selnumber);
            $activation_charge = implode(",", $request->activation_charges_new);
            $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            $data = multisale::create([
                    'customer_name' => $request->cname,
                    'customer_number' => $request->cnumber,
                    'nationality' => $request->nation,
                    'age' => $request->age,
                    'sim_type' => $request->simtype,
                    'gender' => $request->gender,
                    'lead_type' => 'multilead',
                    'channel_type' => 'multilead',
                    'emirates' => $request->emirates,
                    'emirate_num' => $request->emirate_number,
                    'etisalat_number' => $request->etisalat_number,
                    'emirate_id' => $request->emirate_id,
                    'language' => $request->language,
                    'share_with' => $request->shared_with,
                    'additional_document' => $request->additional_document,
                    'saler_id' => auth()->user()->id,
                    // main
                    'selected_number' => $SelNumber,
                    'select_plan' => $planName,
                    // 'contract_commitment' => $request->status,
                    'contract_commitment' => $request->contract_comm_mnp,
                    'lead_no' => $request->leadnumber,
                    'remarks' => $request->remarks_process_new,
                    'status' => '1.21',
                    'saler_name' => auth()->user()->name,
                    'pay_status' => $activation_charge,
                    'pay_charges' => $activation_rate_new,
                    // 'device' => $request->status,
                    'date_time' => $lead_date,
                    'date_time_follow' => $lead_date,
                    // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                    // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                    // 'commitment_period' => $request->status,
                ]);
            // remark::create([
            //     'remarks' => $request->remarks_process_new,
            //     'lead_status' => '1.21',
            //     'lead_id' => $data->id,
            //     'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            //     'user_agent' => 'Sale',
            //     'user_agent_id' => auth()->user()->id,
            // ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.21',

            // ]);
            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        } else if ($request->call_back_at_mnp != '' && $request->simtype == 'MNP' || $request->call_back_at_mnp == '' && $request->simtype == 'Migration') {
            // return $request->call_back_at_mnp;
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                'cname' => 'required|string',
                'cnumber' => 'required|string',
                'nation' => 'required',
                'age' => 'required|numeric|min:20|not_in:20',
                'simtype' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                // 'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                // 'remarks_process_new' => 'required',
            ]);
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.21';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            // return $request;
            // return $request->plan_mnp;
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            $data = multisale::create([
                    'customer_name' => $request->cname,
                    'customer_number' => $request->cnumber,
                    'nationality' => $request->nation,
                    'age' => $request->age,
                    'sim_type' => $request->simtype,
                    'gender' => $request->gender,
                    'emirates' => $request->emirates,
                    'emirate_num' => $request->emirate_number,
                    'etisalat_number' => $request->etisalat_number,
                    'emirate_id' => $request->emirate_id,
                    'language' => $request->language,
                    'lead_type' => 'multilead',
                    'channel_type' => 'multilead',
                    'share_with' => $request->shared_with,
                    'additional_document' => $request->additional_document,
                    'saler_id' => auth()->user()->id,
                    // 'selected_number' => $SelNumber,
                    'select_plan' => $request->plan_mnp,
                    'contract_commitment' => $request->status,
                    'benefits' => $test,
                    'lead_no' => $request->leadnumber,
                    'remarks' => $request->remarks_process_mnp,
                    'status' => '1.21',
                    'saler_name' => auth()->user()->name,
                    'pay_status' => $request->activation_charges_mnp,
                    // 'pay_charges' => $activation_rate_new,
                    // 'device' => $request->status,
                    'date_time' => $lead_date,
                    'date_time_follow' => $lead_date,
                    // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                    // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                    // 'commitment_period' => $request->status,
                ]);
            // remark::create([
            //     'remarks' => $request->remarks_process_mnp,
            //     'lead_status' => '1.21',
            //     'lead_id' => $data->id,
            //     'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            //     'user_agent' => 'Sale',
            //     'user_agent_id' => auth()->user()->id,
            // ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.01',

            // ]);
            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                    ->withInput();
            }
        }
        //
        else if ($request->simtype == 'New') {
            // return $request->simtype;
            // return $request->remarks_process_new;
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                'cname' => 'required|string',
                'cnumber' => 'required|string',
                'nation' => 'required',
                'age' => 'required|numeric|min:20|not_in:20',
                'simtype' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                'activation_charges_new' => 'required',
                'activation_rate_new' => 'required',
                'remarks_process_new' => 'required',
                // 'mytypeval.*' => 'required',
                'selnumber.*' => 'required',
                'plan_new.*' => 'required',
                'activation_charges_new.*' => 'required',
                'activation_rate_new.*' => 'required',

            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // $planName = $request->plan_name;
            $planName = implode(',', $request->plan_new);
            $SelNumber = implode(",", $request->selnumber);
            $activation_charge = implode(",", $request->activation_charges_new);
            $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.20';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            $data = multisale::create([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => 'multilead',
                'channel_type' => 'multilead',
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_number,
                'etisalat_number' => $request->etisalat_number,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // main
                'selected_number' => $SelNumber,
                'select_plan' => $planName,
                // 'contract_commitment' => $request->status,
                'contract_commitment' => $request->contract_comm_mnp,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_process_new,
                'status' => $status,
                'saler_name' => auth()->user()->name,
                'pay_status' => $activation_charge,
                'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $lead_date,
                'date_time_follow' => $lead_date,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            // foreach ($request->selnumber as $key => $val) {
            //     // return $val;
            //     $count = numberdetail::select("numberdetails.id")
            //         ->where('numberdetails.number', $val)
            //         ->count();
            //     if ($count > 0) {
            //         $d = numberdetail::select("numberdetails.id")
            //             ->where('numberdetails.number', $val)
            //             ->first();
            //         $k = numberdetail::findorfail($d->id);
            //         $k->status = 'Reserved';
            //         $k->book_type = '1';
            //         $k->save();
            //     } else {
            //         $d = numberdetail::select("numberdetails.id")
            //             ->where('numberdetails.number', $val)
            //             ->first();
            //         $k = numberdetail::findorfail($d->id);
            //         $k->status = 'Reserved';
            //         $k->save();
            //         //
            //         $k = choosen_number::create([
            //             'number_id' => $k->id,
            //             'user_id' => auth()->user()->id,
            //             'status' => '1',
            //             'agent_group' => auth()->user()->agent_code,
            //             // 'ip_address' => Request::ip(),
            //             'date_time' => Carbon::now()->toDateTimeString(),
            //         ]);
            //         // return "number has been reserved";
            //         $log = choosen_number_log::create([
            //             // 'number'
            //             'number_id' => $k->id,
            //             'user_id' => auth()->user()->id,
            //             'agent_group' => auth()->user()->agent_code,
            //         ]);
            //         // return $ch->id;
            //     }
            //     // return $d->id;
            //     // return "number has been reserved";

            // }
            // remark::create([
            //     'remarks' => $request->remarks_process_new,
            //     'lead_status' => $status,
            //     'lead_id' => $data->id,
            //     'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            //     'user_agent' => 'Sale',
            //     'user_agent_id' => auth()->user()->id,
            // ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => $status,

            // ]);
            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        } else if ($request->simtype == 'MNP' || $request->simtype == 'Migration') {
            // return $request->simtype;
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                'cname' => 'required|string',
                'cnumber' => 'required|string',
                'nation' => 'required',
                'age' => 'required|numeric|min:20|not_in:20',
                'simtype' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                'plans' => 'required',
                'plan_mnp' => 'required',
                // 'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                'remarks_process_mnp' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // return $request;
            // return $request->plan_mnp;
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.20';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            $data = multisale::create([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => 'multilead',
                'channel_type' => 'multilead',
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_number,
                'etisalat_number' => $request->etisalat_number,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_mnp,
                'contract_commitment' => $request->status,
                'benefits' => $test,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_process_mnp,
                'status' => $status,
                'saler_name' => auth()->user()->name,
                'pay_status' => $request->activation_charges_mnp,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $lead_date,
                'date_time_follow' => $lead_date,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            // remark::create([
            //     'remarks' => $request->remarks_process_mnp,
            //     'lead_status' => $status,
            //     'lead_id' => $data->id,
            //     'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            //     'user_agent' => 'Sale',
            //     'user_agent_id' => auth()->user()->id,
            // ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => $status,

            // ]);
            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\multisale  $multisale
     * @return \Illuminate\Http\Response
     */
    public function show(multisale $multisale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\multisale  $multisale
     * @return \Illuminate\Http\Response
     */
    public function edit(multisale $multisale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\multisale  $multisale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, multisale $multisale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\multisale  $multisale
     * @return \Illuminate\Http\Response
     */
    public function destroy(multisale $multisale)
    {
        //
    }
}
