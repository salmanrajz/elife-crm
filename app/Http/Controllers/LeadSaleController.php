<?php

namespace App\Http\Controllers;

use App\chosen_addon;
use App\lead_sale;
use App\remark;
use App\channel_partner;
use App\timing_duration;
use App\numberdetail;
use App\choosen_number_log;
use App\choosen_number;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class LeadSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*", "status_codes.status_name")
        // $user =  DB::table("subjects")->select('subject_name', 'id')
        ->LeftJoin(
            'timing_durations',
            'timing_durations.lead_no',
            '=',
            'lead_sales.id'
        )
        // ->Join(
        //     'plans',
        //     'plans.id',
        //     '=',
        //     'lead_sales.sim_type'
        // )
        ->Join(
            'status_codes',
            'status_codes.status_code',
            '=',
            'lead_sales.status'
        )
        ->where('lead_sales.status', '1.01')
        ->where('lead_sales.saler_id', auth()->user()->id)
        ->whereMonth('lead_sales.created_at', Carbon::now()->month)

        ->get();
        // $operation = lead_sale::wherestatus('1.01')->get();
        return view('dashboard.view-pending-lead', compact('operation'));

    }
    public function pending(){
        $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'timing_durations',
                'timing_durations.lead_no',
                '=',
                'lead_sales.id'
            )
            ->where('lead_sales.status', '1.03')
            ->get();
        // $operation = lead_sale::wherestatus('1.01')->get();
        return view('dashboard.view-all-lead', compact('operation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lead = lead_sale::latest();
        return view('dashboard.add-lead', compact('lead'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
        if($request->callbackitp != '' && $request->channel_type == 'ITProducts')
        {
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
                'remarks_itp' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // $test = implode(",", $request->plans);
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.04';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            $data = lead_sale::create([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_number,
                'etisalat_number' => $request->etisalat_number,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->package_id,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_itp,
                'status' => '1.03',
                'saler_name' => auth()->user()->name,
                // 'pay_status' => $activation_charge,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $lead_date,
                'date_time_follow' => $lead_date,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_itp,
                'lead_status' => '1.03',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.03',

            // ]);
            notify()->success('New IT Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));
        }
        if($request->call_back_at_new != '' && $request->simtype == 'New'){
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
            foreach ($request->selnumber as $key => $val) {
                // return $val;
                    $d = numberdetail::select("numberdetails.id")
                        ->where('numberdetails.number',$val)
                        ->first();
                    $k = numberdetail::findorfail($d->id);
                    $k->status = 'Reserved';
                    $k->save();
                $k = choosen_number::create([
                    'number_id' => $k->id,
                    'user_id' => auth()->user()->id,
                    'status' => '1',
                    'agent_group' => auth()->user()->agent_code,
                    // 'ip_address' => Request::ip(),
                    'date_time' => Carbon::now()->toDateTimeString(),
                ]);
                // return "number has been reserved";
                $log = choosen_number_log::create([
                    // 'number'
                    'number_id' => $k->id,
                    'user_id' => auth()->user()->id,
                    'agent_group' => auth()->user()->agent_code,
                ]);
            }
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.03';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            // $planName = $request->plan_name;
            $planName = implode(',', $request->plan_new);
            $SelNumber = implode(",", $request->selnumber);
            $activation_charge = implode(",", $request->activation_charges_new);
            $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            $data = lead_sale::create([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type'=>$request->channel_type,
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
                'status' => '1.03',
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
            remark::create([
                'remarks' => $request->remarks_process_new,
                'lead_status' => '1.03',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.03',

            // ]);
            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        }
        else if($request->call_back_at_mnp != '' && $request->simtype == 'MNP' || $request->call_back_at_mnp == '' && $request->simtype == 'Migration')
        {
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
                $status = '1.03';
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
            $data = lead_sale::create([
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
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_mnp,
                'contract_commitment' => $request->status,
                'benefits' => $test,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_process_mnp,
                'status' => '1.03',
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
            remark::create([
                'remarks' => $request->remarks_process_mnp,
                'lead_status' => '1.03',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
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
        else if($request->call_back_at_elife != '' && $request->simtype == 'Elife'){
            // return $request->call_back_at_elife;
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
                $status = '1.03';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // $test = implode(",", $request->plans);
            $elife_plans = implode(",", $request->elife_plans);
            $data = lead_sale::create([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_number,
                'etisalat_number' => $request->etisalat_number,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_elife,
                'contract_commitment' => $request->contract_commitement_elife,
                'number_commitment' => $request->elife_makani_number,
                'benefits' => $elife_plans,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_process_elife,
                'status' => '1.03',
                'saler_name' => auth()->user()->name,
                // 'pay_status' => $activation_charge,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $lead_date,
                'date_time_follow' => $lead_date,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_process_elife,
                'lead_status' => '1.03',
                'lead_id' => $data->id,
                'lead_no' => $data->id,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.01',

            // ]);
            $batch_id = $data->id;
            $teacher_id = $request->elife_package;
            $book_records = [];
            // return "b";
            // Add needed information to book records
                    if (!empty($teacher_id)) {
            foreach ($teacher_id as $key => $val) {
                // return $val;
                // return $key;
                // foreach ($teacher_id as $book => $val) {
                    // Get the current time
                    // $now = Carbon::now();

                    // Formulate record that will be saved
                    $book_records[] = [
                        'lead_id' => $batch_id,
                        'addon_id' => $val,
                        'status' => 1,
                    ];
                }
            }
            chosen_addon::insert($book_records);



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
        else if($request->simtype == 'New'){
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
            $test = implode(",",$request->plans);
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.01';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            $data = lead_sale::create([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
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
            foreach ($request->selnumber as $key => $val) {
                // return $val;
                $count = numberdetail::select("numberdetails.id")
                ->where('numberdetails.number', $val)
                ->count();
                if ($count > 0) {
                    $d = numberdetail::select("numberdetails.id")
                    ->where('numberdetails.number', $val)
                    ->first();
                    $k = numberdetail::findorfail($d->id);
                    $k->status = 'Reserved';
                    $k->book_type = '1';
                    $k->save();
                }
                else{
                    $d = numberdetail::select("numberdetails.id")
                        ->where('numberdetails.number', $val)
                        ->first();
                    $k = numberdetail::findorfail($d->id);
                    $k->status = 'Reserved';
                    $k->save();
                    //
                    $k = choosen_number::create([
                        'number_id' => $k->id,
                        'user_id' => auth()->user()->id,
                        'status' => '1',
                        'agent_group' => auth()->user()->agent_code,
                        // 'ip_address' => Request::ip(),
                        'date_time' => Carbon::now()->toDateTimeString(),
                    ]);
                    // return "number has been reserved";
                    $log = choosen_number_log::create([
                        // 'number'
                        'number_id' => $k->id,
                        'user_id' => auth()->user()->id,
                        'agent_group' => auth()->user()->agent_code,
                    ]);
                // return $ch->id;
                }
                // return $d->id;
                // return "number has been reserved";

            }
            remark::create([
                'remarks'=> $request->remarks_process_new,
                'lead_status' => $status,
                'lead_id' => $data->id,
                'lead_no' => $data->id,'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            timing_duration::create([
                'lead_no' => $data->id,
                'lead_generate_time' => Carbon::now()->toDateTimeString(),
                'sale_agent' => auth()->user()->id,
                'status' => $status,

            ]);
            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        }
        else if($request->simtype == 'MNP' || $request->simtype == 'Migration') {
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
                'plans'=>'required',
                'plan_mnp'=>'required',
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
                $status = '1.01';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            $data = lead_sale::create([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
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
            remark::create([
                'remarks' => $request->remarks_process_mnp,
                'lead_status' => $status,
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            timing_duration::create([
                'lead_no' => $data->id,
                'lead_generate_time' => Carbon::now()->toDateTimeString(),
                'sale_agent' => auth()->user()->id,
                'status' => $status,

            ]);
            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        }
        else if($request->channel_type == 'ITProducts'){
            // return $request;
            // if ($request->callbackitp != '' && $request->channel_type == 'ITProducts') {
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
                    'remarks_itp' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.01';
                $lead_date = Carbon::now()->toDateTimeString();
            }
                // return "s";
                // $planName = $request->plan_name;
                // $planName = implode(',', $request->plan_new);
                // $SelNumber = implode(",", $request->selnumber);
                // $activation_charge = implode(",", $request->activation_charges_new);
                // $activation_rate_new = implode(",", $request->activation_rate_new);
                // $test = implode(",", $request->plans);
                $data = lead_sale::create([
                    'customer_name' => $request->cname,
                    'customer_number' => $request->cnumber,
                    'nationality' => $request->nation,
                    'age' => $request->age,
                    'sim_type' => $request->simtype,
                    'gender' => $request->gender,
                    'lead_type' => $request->lead_type,
                    'channel_type' => $request->channel_type,
                    'emirates' => $request->emirates,
                    'emirate_num' => $request->emirate_number,
                    'etisalat_number' => $request->etisalat_number,
                    'emirate_id' => $request->emirate_id,
                    'language' => $request->language,
                    'share_with' => $request->shared_with,
                    'additional_document' => $request->additional_document,
                    'saler_id' => auth()->user()->id,
                    // main
                    // 'selected_number' => $SelNumber,
                    'select_plan' => $request->package_id,
                    // 'contract_commitment' => $request->status,
                    // 'contract_commitment' => $request->contract_comm_mnp,
                    'lead_no' => $request->leadnumber,
                    'remarks' => $request->remarks_itp,
                    'status' => '1.01',
                    'saler_name' => auth()->user()->name,
                    // 'pay_status' => $activation_charge,
                    // 'pay_charges' => $activation_rate_new,
                    // 'device' => $request->status,
                    'date_time' => $lead_date,
                    'date_time_follow' => $lead_date,
                    // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                    // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                    // 'commitment_period' => $request->status,
                ]);
                remark::create([
                    'remarks' => $request->remarks_itp,
                    'lead_status' => '1.01',
                    'lead_id' => $data->id,
                    'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                    'user_agent' => auth()->user()->name,
                    'user_agent_id' => auth()->user()->id,
                ]);
                timing_duration::create([
                    'lead_no' => $data->id,
                    'lead_generate_time' => Carbon::now()->toDateTimeString(),
                    'sale_agent' => auth()->user()->id,
                    'status' => '1.01',
                    // return "bo";
                ]);
                notify()->success('New IT Sale has been submitted succesfully');
                // return redirect()->back()->withInput();
                return redirect(route('lead.index'));
            // }
        }
        else if($request->simtype == 'Elife') {
            // return "elife";
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
                'plan_elife' => 'required',
                'remarks_process_elife' => 'required',
                // 'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                // 'remarks_process_new' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if (!empty($request->existing_lead)) {
                $status = '1.14';
                $lead_date = $request->lead_date;
            } else {
                $status = '1.04';
                $lead_date = Carbon::now()->toDateTimeString();
            }
            // return "b";
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // $test = implode(",", $request->plans);
            // return $request->elife_plans;
            $elife_plans = implode(",",$request->elife_plans);
            $data = lead_sale::create([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_number,
                'etisalat_number' => $request->etisalat_number,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_elife,
                'contract_commitment' => $request->contract_commitement_elife,
                'number_commitment' => $request->elife_makani_number,
                'benefits' => $elife_plans,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_process_elife,
                'status' => '1.01',
                'saler_name' => auth()->user()->name,
                // 'pay_status' => $activation_charge,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $lead_date,
                'date_time_follow' => $lead_date,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_process_elife,
                'lead_status' => '1.01',
                'lead_id' => $data->id,
                'lead_no' => $data->id,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            timing_duration::create([
                'lead_no' => $data->id,
                'lead_generate_time' => Carbon::now()->toDateTimeString(),
                'sale_agent' => auth()->user()->id,
                'status' => '1.01',

            ]);
            $batch_id = $data->id;
            $teacher_id = $request->elife_package;
            $book_records = [];

            // Add needed information to book records
            if (!empty($teacher_id)) {
            foreach ($teacher_id as $key => $val) {
                // return $val;
                // return $key;
                // foreach ($teacher_id as $book => $val) {
                    // Get the current time
                    // $now = Carbon::now();

                    // Formulate record that will be saved
                    $book_records[] = [
                        'lead_id' => $batch_id,
                        'addon_id' => $val,
                        'status' => 1,
                    ];
                }
            }
            chosen_addon::insert($book_records);



            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        }




        // addon::create([
        //     'addon_name' => $request->addon_name,
        //     'amount' => $request->amount,
        //     'package_id' => $request->elife_id,
        //     // 'free_minutes' => $request->free_min,
        //     'status' => $request->status,
        // ]);
        // notify()->success('Elife Addon has been submitted succesfully');

        // // return redirect()->back()->withInput();
        // return redirect(route('elife-addon.index'));

        // if ($validatedData->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validatedData)
        //         ->withInput();
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lead_sale  $lead_sale
     * @return \Illuminate\Http\Response
     */
    public function show(lead_sale $lead_sale)
    {
        //
        // get logged-in user
        $user = auth()->user();

        // get all inherited permissions for that user
        $data = $user->getAllPermissions();

        // dd($permissions);
        // $user = User::findorfail(auth()->user()->id);
        // return $$permissionNames = $user->getPermissionNames(); // collection of name strings

        // return $lead_sale;
        // $data = channel_partner::whereStatus('1')->get();
        // $data2 = channel_partner::wheretype('elife')->get();
        return view('dashboard.show-channel',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lead_sale  $lead_sale
     * @return \Illuminate\Http\Response
     */
    public function edit(lead_sale $leadsale,$id)
    {
        // @php( $countries = \App\country_phone_code::all())
        // @php( $emirates = \App\emirate::all())
        // @php( $plans = \App\plan::wherestatus('1')->get())
        // @php( $elifes = \App\elife_plan::wherestatus('1')->get())
        // @php( $addons = \App\addon::wherestatus('1')->get())
        // @php( $users = \App\user::whererole('sale')->get())
        //
        $countries = \App\country_phone_code::all();
        $emirates = \App\emirate::all();
        $plans = \App\plan::wherestatus('1')->get();
        $elifes = \App\elife_plan::wherestatus('1')->get();
        $addons = \App\addon::wherestatus('1')->get();
        $users = \App\User::whererole('sale')->get();
        // return $id;
        $data = lead_sale::findorfail($id);
        $itproducts = \App\it_products::wherestatus('1')->get();
        $remarks =
            remark::select("remarks.*")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            ->where("remarks.lead_id", $id)
            ->get();
        // return "1";
        return view('dashboard.edit-lead', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users','data','itproducts', 'remarks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lead_sale  $lead_sale
     * @return \Illuminate\Http\Response
     */
    public function followUpdate(request $request, $id){
        // return $request;

    }

    public function update(Request $request, lead_sale $leadsale,$id)
    {
        //
        // return $request;
        // return $id;
        if ($request->callbackitp != '' && $request->channel_type == 'ITProducts') {
            $data = lead_sale::findorfail($id);
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
                'remarks_itp' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // $test = implode(",", $request->plans);
            $data->update([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_number,
                'etisalat_number' => $request->etisalat_number,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->package_id,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_itp,
                'status' => '1.03',
                'saler_name' => auth()->user()->name,
                // 'pay_status' => $activation_charge,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_itp,
                'lead_status' => '1.03',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.03',

            // ]);
            notify()->success('New IT Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));
        }
        else if($request->call_back_at_new != '' && $request->simtype == 'New'){
            $data = lead_sale::findorfail($id);
            // return
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
            // $planName = $request->plan_name;
            $planName = implode(',', $request->plan_new);
            $SelNumber = implode(",", $request->selnumber);
            $activation_charge = implode(",", $request->activation_charges_new);
            $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            $data->update([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
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
                'status' => '1.03',
                'saler_name' => auth()->user()->name,
                'pay_status' => $activation_charge,
                'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_process_new,
                'lead_status' => '1.03',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.03',

            // ]);
            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(url('admin/leads/follow'));
        } else if ($request->call_back_at_mnp != '' && $request->simtype == 'MNP' || $request->call_back_at_mnp == '' && $request->simtype == 'Migration') {
            // return $request->call_back_at_mnp;
            $data = lead_sale::findorfail($id);
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
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // return $request->plans;
            // return $request;
            // return $request->plan_mnp;
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            $data->update([
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
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_mnp,
                'contract_commitment' => $request->status,
                'benefits' => $test,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_process_mnp,
                'status' => '1.03',
                'saler_name' => auth()->user()->name,
                'pay_status' => $request->activation_charges_mnp,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_process_mnp,
                'lead_status' => '1.03',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.01',

            // ]);
            notify()->success('New Sale has been updated succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        } else if ($request->simtype == 'MNP' || $request->simtype == 'Migration') {
            $data = lead_sale::findorfail($id);
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
            // return $request;
            // return $request->plan_mnp;
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            $test = implode(",", $request->plans);
            $data->update([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
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
                'status' => '1.01',
                'saler_name' => auth()->user()->name,
                'pay_status' => $request->activation_charges_mnp,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_process_mnp,
                'lead_status' => '1.01',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            timing_duration::create([
                'lead_no' => $data->id,
                'lead_generate_time' => Carbon::now()->toDateTimeString(),
                'sale_agent' => auth()->user()->id,
                'status' => '1.01',

            ]);
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
        else if($request->simtype == 'New'){
            $data = lead_sale::findorfail($id);
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
            $test = implode(",",$request->plans);
            $data->update([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'gender' => $request->gender,
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
                'status' => '1.01',
                'saler_name' => auth()->user()->name,
                'pay_status' => $activation_charge,
                'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            // remark::create([
            //     'remarks'=> $request->remarks_process_new,
            //     'lead_status' => '1.01',
            //     'lead_id' => $data->id,
            //     'lead_no' => $data->id,'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
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

        } else if ($request->channel_type == 'ITProducts') {
            // return $request;
            $data = lead_sale::findorfail($id);
            // if ($request->callbackitp != '' && $request->channel_type == 'ITProducts') {
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
                // // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                'remarks_itp' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // return "s";
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // $test = implode(",", $request->plans);
            $data->update([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'gender' => $request->gender,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_number,
                'etisalat_number' => $request->etisalat_number,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->package_id,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_itp,
                'status' => '1.01',
                'saler_name' => auth()->user()->name,
                // 'pay_status' => $activation_charge,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_itp,
                'lead_status' => '1.01',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // timing_duration::create([
            //     'lead_no' => $data->id,
            //     'lead_generate_time' => Carbon::now()->toDateTimeString(),
            //     'sale_agent' => auth()->user()->id,
            //     'status' => '1.03',
            // return "bo";
            // ]);
            notify()->success('New IT Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));
            // }
        } else if ($request->simtype == 'Elife') {
            // return "elife";
            $data = lead_sale::findorfail($id);
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
                'plan_elife' => 'required',
                'remarks_process_elife' => 'required',
                // 'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                // 'remarks_process_new' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            // return "b";
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // $test = implode(",", $request->plans);
            // return $request->elife_plans;
            $elife_plans = implode(",", $request->elife_plans);
            $data->update([
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->simtype,
                'lead_type' => $request->lead_type,
                'channel_type' => $request->channel_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_number,
                'etisalat_number' => $request->etisalat_number,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'share_with' => $request->shared_with,
                'additional_document' => $request->additional_document,
                'saler_id' => auth()->user()->id,
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_elife,
                'contract_commitment' => $request->contract_commitement_elife,
                'number_commitment' => $request->elife_makani_number,
                'benefits' => $elife_plans,
                'lead_no' => $request->leadnumber,
                'remarks' => $request->remarks_process_elife,
                'status' => '1.01',
                'saler_name' => auth()->user()->name,
                // 'pay_status' => $activation_charge,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            remark::create([
                'remarks' => $request->remarks_process_elife,
                'lead_status' => '1.01',
                'lead_id' => $data->id,
                'lead_no' => $data->id,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            timing_duration::create([
                'lead_no' => $data->id,
                'lead_generate_time' => Carbon::now()->toDateTimeString(),
                'sale_agent' => auth()->user()->id,
                'status' => '1.01',

            ]);
            $batch_id = $data->id;
            $teacher_id = $request->elife_package;
            $book_records = [];

            // Add needed information to book records
            if (!empty($teacher_id)) {
                foreach ($teacher_id as $key => $val) {
                    // return $val;
                    // return $key;
                    // foreach ($teacher_id as $book => $val) {
                    // Get the current time
                    // $now = Carbon::now();

                    // Formulate record that will be saved
                    $book_records[] = [
                        'lead_id' => $batch_id,
                        'addon_id' => $val,
                        'status' => 1,
                    ];
                }
            }
            chosen_addon::insert($book_records);



            notify()->success('New Sale has been submitted succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('lead.index'));


            // return $planName . $SelNumber . $activation_charge . $activation_rate_new;

        }
        // $p = lead_sale::FindOrFail($request->lead_id);
        // $validatedData = $request->validate([
        //     // 'status' => 'required',
        //     'status' => 'required',
        //     'remarks' => 'required',
        //     // 'lng' => 'required|numeric',
        // ]);
        // $d = lead_sale::findOrFail($request->lead_id);

        // $d->update([
        //     'status' => '1.12',
        //     'pre_check_status' => $request->status,
        //     'pre_check_remarks' => $request->remarks,
        // ]);
        // notify()->success('Pre Check Verify succesfully');

        // // return redirect()->back()->withInput();
        // return redirect(route('verification.manage-pre-check'));

        // if ($validatedData->fails()) {
        //     return redirect()->back()
        //     ->withErrors($validatedData)
        //     ->withInput();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lead_sale  $lead_sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(lead_sale $lead_sale)
    {
        //
    }
}
