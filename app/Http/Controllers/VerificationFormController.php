<?php

namespace App\Http\Controllers;

use App\audio_recording;
use App\choosen_number;
use App\lead_sale;
use App\numberdetail;
use App\remark;
use App\timing_duration;
use App\channel_partner;
use App\verification_form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;



class VerificationFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return auth()->user()->role;
        $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*", "status_codes.status_name")
        // $user =  DB::table("subjects")->select('subject_name', 'id')
        ->LeftJoin(
            'timing_durations',
            'timing_durations.lead_no',
            '=',
            'lead_sales.id'
        )
        ->Join(
            'status_codes',
            'status_codes.status_code',
            '=',
            'lead_sales.status'
        )
        ->where('lead_sales.lead_type', 'elife')
        ->where('lead_sales.status', '1.01')
        ->get();
        // $operation = lead_sale::wherestatus('1.01')->get();
        return view('dashboard.view-operation-lead', compact('operation'));
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
        // return $request;
        if($request->reject_comment_new != ''){
            // return "b";
            // $validator = Validator::make($request->all(), [ // <---
            //     // // 'title' => 'required|unique:posts|max:255',
            //     // // 'body' => 'required',
            //     // // 'cname' => 'required|string|unique:lead_sales,customer_name',
            //     // 'cnumber' => 'required',
            //     // 'nation' => 'required',
            //     // 'age' => 'required|numeric',
            //     // 'sim_type' => 'required',
            //     // 'gender' => 'required',
            //     // 'emirates' => 'required',
            //     // 'emirate_id' => 'required',
            //     // 'language' => 'required',
            //     // 'plan_new' => 'required',
            //     // 'selnumber' => 'required|numeric',
            //     // 'activation_charges_new' => 'required',
            //     // 'activation_rate_new' => 'required',
            //     // 'remarks_process_new' => 'required',
            //     'audio.*' => 'required',

            // ]);
            // if ($validator->fails()) {
            //     return redirect()->back()
            //         ->withErrors($validator)
            //         ->withInput();
            // }
            if($request->reject_comment_new == 'Already Active')
            {

            }
            else{

                if (empty($request->audio)) {
                    notify()->error('Please Submit Audio');
                    return redirect()->back()
                    ->withInput();
                }
            }

            if (!empty($request->audio)) {
            foreach ($request->audio as $key => $val) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('audio')) {
                        // return "a";
                        // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('audio', $name);
                        $input['path'] = $name;
                    }
                    //     $data2 = meeting_std::create([
                    //         'meeting_id' => $meeting_id,
                    //         'meeting_title' => $request->course_title,
                    //         'std_id' => $val,
                    //         'status' => 1,
                    //     ]);
                    // } else {
                    //     echo "boom";
                    // }
                    $data = audio_recording::create([
                        // 'resource_name' => $request->resource_name,
                        'audio_file' => $name,
                        'username' => auth()->user()->name,
                        'lead_no' => $request->lead_id,
                        // 'teacher_id' => $request->teacher_id,
                        'status' => 1,
                    ]);
                }
            }
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.04',
                'remarks' => $request->reject_comment_new,
                // 'later_date' => $request->later_date,
                'pre_check_agent' => auth()->user()->id
                // 'date_time_follow' => $request->call_back_at_new,
            ]);
            foreach ($request->selnumber as $key => $val) {
                // return $val;
                $count = numberdetail::select("numberdetails.id")
                    ->where('numberdetails.number', $val)
                    ->count();
                if ($count > 0) {
                    $dn = numberdetail::select("numberdetails.id")
                        ->where('numberdetails.number', $val)
                        ->first();
                    $k = numberdetail::findorfail($dn->id);
                    $k->status = 'Reserved';
                    $k->book_type = '0';
                    $k->save();
                    $cn = choosen_number::select('choosen_numbers.id')
                        ->where('number_id', $dn->id)
                        ->first();
                    $cnn = choosen_number::findorfail($cn->id);
                    $cnn->status = '1';
                    $cnn->save();
                }
                // return $d->id;
                // return "number has been reserved";

            }
            notify()->success('Reject succesfully');
            return redirect(route('verification.index'));
            // return "D";
        }
        if($request->later_date != ''){
            // return "c";

            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.06',
                'remarks' => $request->remarks_for_cordination,
                'later_date' => $request->later_date,
                'pre_check_agent' => auth()->user()->id
                // 'date_time_follow' => $request->call_back_at_new,
            ]);
            //
            // remark::create([
            //     'remarks' => $request->remarks_for_cordination,
            //     'lead_status' => '1.03',
            //     'lead_id' => $request->lead_id,
            //     'lead_no' => $request->lead_id,
            //     'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            //     'user_agent' => auth()->user()->name,
            //     'user_agent_id' => auth()->user()->id,
            // ]);
            // return
            notify()->success('Lead has been Later up now');

            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));
        }
        if ($request->remarks_for_cordination != '') {
            $validatedData = Validator::make($request->all(), [
                'remarks_for_cordination' => 'required|string',
            ]);
            // return "s";
            if ($validatedData->fails()) {
                return redirect()->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }
            // return "b";
            // return $request->lead_id;
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.03',
                'remarks' => $request->remarks_for_cordination,
                // 'date_time_follow' => $request->call_back_at_new,
            ]);
            remark::create([
                'remarks' => $request->remarks_for_cordination,
                'lead_status' => '1.03',
                'lead_id' => $request->lead_id,
                'lead_no' => $request->lead_id,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // return
            notify()->success('Lead has been follow up now');

            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));
        }
        else if ($request->sim_type == 'New' && $request->reject_comment_new == '') {
            // return "s";
            // return $request;
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                // 'cname' => 'required|string|unique:lead_sales,customer_name',
                'cnumber' => 'required',
                'nation' => 'required',
                'age' => 'required|numeric',
                'sim_type' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                // 'remarks_process_new' => 'required',
                'audio.*' => 'required',

            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if (empty($request->audio)) {
                notify()->error('Please Submit Audio');
                return redirect()->back()
                    ->withInput();
            }
            // $planName = $request->plan_name;
            $planName = implode(',', $request->plan_new);
            $SelNumber = implode(",", $request->selnumber);
            $activation_charge = implode(",", $request->activation_charges_new);
            $activation_rate_new = implode(",",
                $request->activation_rate_new
            );
            // return $request->emirate_id;
            // return $test = implode(",", $request->plan_new);
            $data = verification_form::create([
                'cust_id'=>$request->lead_id,
                'lead_no'=>$request->lead_id,
                'lead_id'=>$request->lead_no,
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_number' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'original_emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirate_location' => $request->emirates,
                'additional_documents' => $request->additional_documents,
                'verify_agent' => auth()->user()->id,
                // main
                'selected_number' => $SelNumber,
                'select_plan' => $planName,
                // 'contract_commitment' => $request->status,
                'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_new,
                'status' => '1.09',
                // 'saler_name' => 'Sale',
                'pay_status' => $activation_charge,
                'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
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
                    $dn = numberdetail::select("numberdetails.id")
                    ->where('numberdetails.number', $val)
                    ->first();
                    $k = numberdetail::findorfail($dn->id);
                    $k->status = 'Hold';
                    $k->save();
                    // CHANGE LATER
                    $cn = choosen_number::select('choosen_numbers.id')
                    ->where('number_id',$dn->id)
                    ->first();
                    if($cn){
                        $cnn = choosen_number::findorfail($cn->id);
                        $cnn->status = '4';
                        $cnn->save();
                    }
                    // CHANGE LATER
                }
                // return $d->id;
                // return "number has been reserved";

            }
            // $n = numberdetail::select("numberdetails.id")
            //     ->where('numberdetails.number', $val)
            //     ->first();
            // $k = numberdetail::findorfail($d->id);
            // $k->status = 'Reserved';
            // $k->save();
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.07',
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirates' => $request->emirates,
                'additional_document' => $request->additional_documents,
                // 'verify_agent' => auth()->user()->id,
                // main
                'selected_number' => $SelNumber,
                'select_plan' => $planName,
                // 'contract_commitment' => $request->status,
                'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_new,
                // 'status' => '1.09',
                // 'saler_name' => 'Sale',
                'pay_status' => $activation_charge,
                'pay_charges' => $activation_rate_new,
            ]);
            $d = timing_duration::select('id')
            ->where('lead_no', $request->lead_id)
            ->first();
            $data  = timing_duration::findorfail($d->id);
            $data->lead_proceed_time = Carbon::now()->toDateTimeString();
            $data->verify_agent = auth()->user()->id;
            $data->save();


            foreach ($request->audio as $key => $val) {
                if (!empty($request->audio)) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('audio')) {
                        // return "a";
                    // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('audio', $name);
                        $input['path'] = $name;
                    }
                    //     $data2 = meeting_std::create([
                    //         'meeting_id' => $meeting_id,
                    //         'meeting_title' => $request->course_title,
                    //         'std_id' => $val,
                    //         'status' => 1,
                    //     ]);
                    // } else {
                    //     echo "boom";
                    // }
                    $data = audio_recording::create([
                        // 'resource_name' => $request->resource_name,
                        'audio_file' => $name,
                        'username' => 'salman',
                        'lead_no' => $request->lead_id,
                        // 'teacher_id' => $request->teacher_id,
                        'status' => 1,
                    ]);
                }
            }

            notify()->success('Sim Type New Verified succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));


            // return $planName .'<br>'. $SelNumber . '<br>' . $activation_charge . '<br>' . $activation_rate_new;

        }
        else if ($request->sim_type == 'MNP' && $request->reject_comment_new == '' || $request->sim_type == 'Migration' && $request->reject_comment_new == '') {
            // return "s";
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                // 'cname' => 'required|string|unique:lead_sales,customer_name',
                // 'cnumber' => 'required|numeric',
                'nation' => 'required',
                'age' => 'required|numeric',
                'sim_type' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                'audio.*' => 'required',

                // 'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                // 'remarks_process_new' => 'required',
            ]);
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // return $request->emirate_id;
            // return $test = implode(",", $request->plan_new);
            $data = verification_form::create([
                'cust_id'=>$request->lead_id,
                'lead_no'=>$request->lead_id,
                'lead_id'=>$request->lead_no,
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_number' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'original_emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirate_location' => $request->emirates,
                'additional_documents' => $request->additional_documents,
                'verify_agent' => auth()->user()->id,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_mnp,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_mnp,
                'status' => '1.09',
                // 'saler_name' => 'Sale',
                'pay_status' => $request->activation_charges_mnp,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            //
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
            //
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.07',
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirates' => $request->emirates,
                'additional_document' => $request->additional_documents,
                'select_plan' => $request->plan_mnp,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_mnp,
                'pay_status' => $request->activation_charges_mnp,
                // 'status' => '1.09',
                // 'saler_name' => 'Sale',
                // 'verify_agent' => auth()->user()->id,
                // main
                // 'selected_number' => $SelNumber,
                // 'select_plan' => $planName,
                // // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // // 'lead_no' => 'Lead No',
                // 'remarks' => $request->remarks_process_new,
                // // 'status' => '1.09',
                // // 'saler_name' => 'Sale',
                // 'pay_status' => $activation_charge,
                // 'pay_charges' => $activation_rate_new,
            ]);
            foreach ($request->audio as $key => $val) {
                if (!empty($request->audio)) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('audio')) {
                        // return "a";
                    // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('audio', $name);
                        $input['path'] = $name;
                    }
                    //     $data2 = meeting_std::create([
                    //         'meeting_id' => $meeting_id,
                    //         'meeting_title' => $request->course_title,
                    //         'std_id' => $val,
                    //         'status' => 1,
                    //     ]);
                    // } else {
                    //     echo "boom";
                    // }
                    // salman
                    $data = audio_recording::create([
                        // 'resource_name' => $request->resource_name,
                        'audio_file' => $name,
                        'username' => 'salman',
                        'lead_no' => $request->lead_id,
                        // 'teacher_id' => $request->teacher_id,
                        'status' => 1,
                    ]);
                }
            }
            $d = timing_duration::select('id')
            ->where('lead_no', $request->lead_id)
            ->first();
            $data  = timing_duration::findorfail($d->id);
            $data->lead_proceed_time = Carbon::now()->toDateTimeString();
            $data->verify_agent = auth()->user()->id;
            $data->save();

            notify()->success('Verified succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));


            // return $planName .'<br>'. $SelNumber . '<br>' . $activation_charge . '<br>' . $activation_rate_new;

        }
        else if ($request->sim_type == 'Elife' && $request->reject_comment_new == '') {
            // return "s";
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                // 'cname' => 'required|string|unique:verification,customer_name',
                // 'cnumber' => 'required|numeric',
                'nation' => 'required',
                'age' => 'required|numeric',
                'sim_type' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                // 'plan_new' => 'required',
                // 'dob' => 'required',
                'audio.*' => 'required',
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
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // return $request->emirate_id;
            // return $test = implode(",", $request->plan_new);
            $data = verification_form::create([
                'cust_id'=>$request->lead_id,
                'lead_no'=>$request->lead_id,
                'lead_id'=>$request->lead_no,
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_number' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'original_emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirate_location' => $request->emirates,
                'additional_documents' => $request->additional_documents,
                'verify_agent' => auth()->user()->id,
                'dob' => $request->dob,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_elife,
                'number_commitment' => $request->elife_makani_number,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_elife,
                // 'status' => '1.09',
                // 'saler_name' => 'Sale',
                'pay_status' => $request->activation_charges_mnp,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            //
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.07',
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirates' => $request->emirates,
                'additional_document' => $request->additional_documents,
                'dob' => $request->dob,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_elife,
                'number_commitment' => $request->elife_makani_number,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_elife,
                // 'status' => '1.09',
                // 'saler_name' => 'Sale',
                'pay_status' => $request->activation_charges_mnp,
            ]);
            //
            $d = timing_duration::select('id')
            ->where('lead_no', $request->lead_id)
            ->first();
            $data  = timing_duration::findorfail($d->id);
            $data->lead_proceed_time = Carbon::now()->toDateTimeString();
            $data->verify_agent = auth()->user()->id;
            $data->save();
            foreach ($request->audio as $key => $val) {
                if (!empty($request->audio)) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('audio')) {
                        // return "a";
                    // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('audio', $name);
                        $input['path'] = $name;
                    }
                    //     $data2 = meeting_std::create([
                    //         'meeting_id' => $meeting_id,
                    //         'meeting_title' => $request->course_title,
                    //         'std_id' => $val,
                    //         'status' => 1,
                    //     ]);
                    // } else {
                    //     echo "boom";
                    // }
                    $data = audio_recording::create([
                        // 'resource_name' => $request->resource_name,
                        'audio_file' => $name,
                        'username' => 'salman',
                        'lead_no' => $request->lead_id,
                        // 'teacher_id' => $request->teacher_id,
                        'status' => 1,
                    ]);
                }
            }

            notify()->success('Verified succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));


            // return $planName .'<br>'. $SelNumber . '<br>' . $activation_charge . '<br>' . $activation_rate_new;

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\verification_form  $verification_form
     * @return \Illuminate\Http\Response
     */
    public function show(verification_form $verification_form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\verification_form  $verification_form
     * @return \Illuminate\Http\Response
     */
    public function edit(verification_form $verification_form)
    {
        //
        // return $verification_form;
    }
    public function lead(verification_form $verification_form)
    {
        //
        return $verification_form;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\verification_form  $verification_form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, verification_form $verification_form)
    {
        //
        // return $request;
// @php( $audios = \App\audio_recording::wherelead_no($operation->id)->get())
         $vid = verification_form::wherelead_no($request->lead_id)->first();
         $verification_id = verification_form::findorfail($vid->id);
        // return $verification_form;
        if ($request->remarks_for_cordination != '') {
            $validatedData = Validator::make($request->all(), [
                'remarks_for_cordination' => 'required|string',
            ]);
            // return "s";
            if ($validatedData->fails()) {
                return redirect()->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }
            // return "b";
            // return $request->lead_id;
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.03',
                'remarks' => $request->remarks_for_cordination,
                // 'date_time_follow' => $request->call_back_at_new,
            ]);
            remark::create([
                'remarks' => $request->remarks_for_cordination,
                'lead_status' => '1.03',
                'lead_id' => $request->lead_id,
                'lead_no' => $request->lead_id,
                'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // return
            notify()->success('Lead has been follow up now');

            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));
        } else if ($request->sim_type == 'New') {
            // return "s";
            // return $request;
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                // 'cname' => 'required|string|unique:lead_sales,customer_name',
                'cnumber' => 'required',
                'nation' => 'required',
                'age' => 'required|numeric',
                'sim_type' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                // 'remarks_process_new' => 'required',
                'audio.*' => 'required',

            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if (empty($request->audio)) {
                notify()->error('Please Submit Audio');
                return redirect()->back()
                ->withInput();
            }
            // $planName = $request->plan_name;
            $planName = implode(',', $request->plan_new);
            $SelNumber = implode(",", $request->selnumber);
            $activation_charge = implode(",", $request->activation_charges_new);
            $activation_rate_new = implode(
                ",",
                $request->activation_rate_new
            );
            // return $request->emirate_id;
            // return $test = implode(",", $request->plan_new);
            $verification_id->update([
                'cust_id' => $request->lead_id,
                'lead_no' => $request->lead_id,
                'lead_id' => $request->lead_no,
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_number' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'original_emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirate_location' => $request->emirates,
                'additional_documents' => $request->additional_documents,
                'verify_agent' => auth()->user()->id,
                // main
                'selected_number' => $SelNumber,
                'select_plan' => $planName,
                // 'contract_commitment' => $request->status,
                'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_new,
                'status' => '1.10',
                // 'saler_name' => 'Sale',
                'pay_status' => $activation_charge,
                'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.10',
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirates' => $request->emirates,
                'additional_document' => $request->additional_documents,
                // 'verify_agent' => auth()->user()->id,
                // main
                'selected_number' => $SelNumber,
                'select_plan' => $planName,
                // 'contract_commitment' => $request->status,
                'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_new,
                // 'status' => '1.09',
                // 'saler_name' => 'Sale',
                'pay_status' => $activation_charge,
                'pay_charges' => $activation_rate_new,
            ]);


            foreach ($request->audio as $key => $val) {
                if (!empty($request->audio)) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('audio')) {
                        // return "a";
                        // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('audio', $name);
                        $input['path'] = $name;
                    }
                    //     $data2 = meeting_std::create([
                    //         'meeting_id' => $meeting_id,
                    //         'meeting_title' => $request->course_title,
                    //         'std_id' => $val,
                    //         'status' => 1,
                    //     ]);
                    // } else {
                    //     echo "boom";
                    // }
                    $data = audio_recording::create([
                        // 'resource_name' => $request->resource_name,
                        'audio_file' => $name,
                        'username' => 'salman',
                        'lead_no' => $request->lead_id,
                        // 'teacher_id' => $request->teacher_id,
                        'status' => 1,
                    ]);
                }
            }

            notify()->success('Verified succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));


            // return $planName .'<br>'. $SelNumber . '<br>' . $activation_charge . '<br>' . $activation_rate_new;

        } else if ($request->sim_type == 'MNP' || $request->sim_type == 'Migration') {
            // return "s";
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                // 'cname' => 'required|string|unique:lead_sales,customer_name',
                // 'cnumber' => 'required|numeric',
                'nation' => 'required',
                'age' => 'required|numeric',
                'sim_type' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                'audio.*' => 'required',

                // 'plan_new' => 'required',
                // 'selnumber' => 'required|numeric',
                // 'activation_charges_new' => 'required',
                // 'activation_rate_new' => 'required',
                // 'remarks_process_new' => 'required',
            ]);
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // return $request->emirate_id;
            // return $test = implode(",", $request->plan_new);
            $verification_id->update([
                'cust_id' => $request->lead_id,
                'lead_no' => $request->lead_id,
                'lead_id' => $request->lead_no,
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_number' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'original_emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirate_location' => $request->emirates,
                'additional_documents' => $request->additional_documents,
                'verify_agent' => auth()->user()->id,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_mnp,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_mnp,
                'status' => '1.10',
                // 'saler_name' => 'Sale',
                'pay_status' => $request->activation_charges_mnp,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.10',
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirates' => $request->emirates,
                'additional_document' => $request->additional_documents,
                'select_plan' => $request->plan_mnp,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_mnp,
                'pay_status' => $request->activation_charges_mnp,
                // 'status' => '1.09',
                // 'saler_name' => 'Sale',
                // 'verify_agent' => auth()->user()->id,
                // main
                // 'selected_number' => $SelNumber,
                // 'select_plan' => $planName,
                // // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // // 'lead_no' => 'Lead No',
                // 'remarks' => $request->remarks_process_new,
                // // 'status' => '1.09',
                // // 'saler_name' => 'Sale',
                // 'pay_status' => $activation_charge,
                // 'pay_charges' => $activation_rate_new,

            ]);
            foreach ($request->audio as $key => $val) {
                if (!empty($request->audio)) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('audio')) {
                        // return "a";
                        // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('audio', $name);
                        $input['path'] = $name;
                    }
                    //     $data2 = meeting_std::create([
                    //         'meeting_id' => $meeting_id,
                    //         'meeting_title' => $request->course_title,
                    //         'std_id' => $val,
                    //         'status' => 1,
                    //     ]);
                    // } else {
                    //     echo "boom";
                    // }
                    $data = audio_recording::create([
                        // 'resource_name' => $request->resource_name,
                        'audio_file' => $name,
                        'username' => 'salman',
                        'lead_no' => $request->lead_id,
                        // 'teacher_id' => $request->teacher_id,
                        'status' => 1,
                    ]);
                }
            }

            notify()->success('Verified succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));


            // return $planName .'<br>'. $SelNumber . '<br>' . $activation_charge . '<br>' . $activation_rate_new;
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        } else if ($request->sim_type == 'Elife') {
            // return "s";
            $validator = Validator::make($request->all(), [ // <---
                // 'title' => 'required|unique:posts|max:255',
                // 'body' => 'required',
                // 'cname' => 'required|string|unique:verification,customer_name',
                // 'cnumber' => 'required|numeric',
                'nation' => 'required',
                'age' => 'required|numeric',
                'sim_type' => 'required',
                'gender' => 'required',
                'emirates' => 'required',
                'emirate_id' => 'required',
                'language' => 'required',
                // 'plan_new' => 'required',
                // 'dob' => 'required',
                'audio.*' => 'required',
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
            // $planName = $request->plan_name;
            // $planName = implode(',', $request->plan_new);
            // $SelNumber = implode(",", $request->selnumber);
            // $activation_charge = implode(",", $request->activation_charges_new);
            // $activation_rate_new = implode(",", $request->activation_rate_new);
            // return $request->emirate_id;
            // return $test = implode(",", $request->plan_new);
            $verification_id->update([
                'cust_id' => $request->lead_id,
                'lead_no' => $request->lead_id,
                'lead_id' => $request->lead_no,
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_number' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'original_emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirate_location' => $request->emirates,
                'additional_documents' => $request->additional_documents,
                'verify_agent' => auth()->user()->id,
                'dob' => $request->dob,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_elife,
                'number_commitment' => $request->elife_makani_number,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_elife,
                'status' => '1.10',
                // 'saler_name' => 'Sale',
                'pay_status' => $request->activation_charges_mnp,
                // 'pay_charges' => $activation_rate_new,
                // 'device' => $request->status,
                // 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                // 'date_time_follow' => $current_date_time = Carbon::now()->toDateTimeString(),
                // 'commitment_period' => $request->status,
            ]);
            //
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.10',
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'nationality' => $request->nation,
                'age' => $request->age,
                'sim_type' => $request->sim_type,
                'gender' => $request->gender,
                'emirates' => $request->emirates,
                'emirate_num' => $request->emirate_num,
                // 'etisalat_number' => $request->status,
                'emirate_id' => $request->emirate_id,
                'language' => $request->language,
                'emirates' => $request->emirates,
                'additional_document' => $request->additional_documents,
                'dob' => $request->dob,
                // main
                // 'selected_number' => $SelNumber,
                'select_plan' => $request->plan_elife,
                'number_commitment' => $request->elife_makani_number,
                // 'contract_commitment' => $request->status,
                // 'contract_commitment' => $request->contract_comm_mnp,
                // 'lead_no' => 'Lead No',
                'remarks' => $request->remarks_process_elife,
                // 'status' => '1.09',
                // 'saler_name' => 'Sale',
                'pay_status' => $request->activation_charges_mnp,
            ]);
            //
            foreach ($request->audio as $key => $val) {
                if (!empty($request->audio)) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('audio')) {
                        // return "a";
                        // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('audio', $name);
                        $input['path'] = $name;
                    }
                    //     $data2 = meeting_std::create([
                    //         'meeting_id' => $meeting_id,
                    //         'meeting_title' => $request->course_title,
                    //         'std_id' => $val,
                    //         'status' => 1,
                    //     ]);
                    // } else {
                    //     echo "boom";
                    // }
                    $data = audio_recording::create([
                        // 'resource_name' => $request->resource_name,
                        'audio_file' => $name,
                        'username' => 'salman',
                        'lead_no' => $request->lead_id,
                        // 'teacher_id' => $request->teacher_id,
                        'status' => 1,
                    ]);
                }
            }

            notify()->success('Verified succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('verification.index'));


            // return $planName .'<br>'. $SelNumber . '<br>' . $activation_charge . '<br>' . $activation_rate_new;

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\verification_form  $verification_form
     * @return \Illuminate\Http\Response
     */
    public function destroy(verification_form $verification_form)
    {
        //
    }
}
