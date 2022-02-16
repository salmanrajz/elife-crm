<?php

namespace App\Http\Controllers;

use App\activation_document;
use App\activation_form;
use App\lead_sale;
use App\remark;
use App\numberdetail;
use App\choosen_number;
use App\verification_form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

// Validator


class ActivationFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $operation = verification_form::select("verification_forms.lead_no","timing_durations.lead_generate_time", "verification_forms.*","remarks.remarks as latest_remarks","status_codes.status_name")
        // $user =  DB::table("subjects")->select('subject_name', 'id')
        ->Join(
            'timing_durations',
            'timing_durations.lead_no',
            '=',
            'verification_forms.lead_no'
        )
        ->Join(
            'remarks',
            'remarks.lead_no',
            '=',
            'verification_forms.lead_no'
        )
        ->Join(
            'status_codes',
            'status_codes.status_code',
            '=',
            'verification_forms.status'
        )
        ->where('verification_forms.status', '1.10')
        ->where('verification_forms.assing_to', auth()->user()->id)
        // ->where('verification_forms.emirate_location', auth()->user()->emirate)
        ->groupBy('verification_forms.lead_no')
        ->get();

        return view('dashboard.view-activation-request',compact('operation'));
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
        if($request->reverify_remarks != ''){
            // return $request;
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.13',
                'remarks' => $request->reverify_remarks,
                // 'date_time_follow' => $request->call_back_at_new,
            ]);
            $dd = verification_form::findOrFail($request->ver_id);
            $dd->update([
                'status' => '1.13',
                // 'assing_to' => $request->assing_to,
                // 'cordination_by' => auth()->user()->id,
            ]);
            remark::create([
                'remarks' => $request->reverify_remarks,
                'lead_status' => '1.13',
                'lead_id' => $request->lead_id,
                'lead_no' => $request->lead_id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // return
            notify()->success('Lead has been ReVerification now');

            // return redirect()->back()->withInput();
            return redirect(route('verification.final-cord-lead'));
        }
        else if ($request->call_back_at_new != '') {
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
                'date_time_follow' => $request->call_back_at_new,
            ]);
            $dd = verification_form::findOrFail($request->ver_id);
            $dd->update([
                'status' => '1.03',
                // 'assing_to' => $request->assing_to,
                // 'cordination_by' => auth()->user()->id,
            ]);
            remark::create([
                'remarks' => $request->call_back_at_new,
                'lead_status' => '1.01',
                'lead_id' => $request->lead_id,
                'lead_no' => $request->lead_id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // return
            notify()->success('Lead has been follow up now');

            // return redirect()->back()->withInput();
            return redirect(route('verification.final-cord-lead'));
        }
        else if($request->simtype == 'Elife'){
            $validatedData = Validator::make($request->all(),[
                // 'plan_name' => 'required | string | unique',
                // 'plan_name' => 'required|string|unique:plans,plan_name',
                'activation_date' => 'required',
                'activation_sr_no' => 'required|numeric|min:9',
                'imei' => 'required',
                // 'activation_service_order' => 'required|numeric',
                // 'activation_selected_no' => 'required|numeric',
                // 'activation_sim_serial_no' => 'required',
                // 'activation_emirate_expiry' => 'required',
                'activation_sold' => 'required',
                'activation_sold_by' => 'required',
                'saler_id' => 'required',
                // 'emirate_id_front' => 'required',
                // 'emirate_id_back' => 'required',
                // 'activation_screenshot' => 'required',
                // 'additional_document_activation' => 'required',
                // 'documents.*' => 'required',
            ]);
            if ($validatedData->fails()) {
                return redirect()->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }
            if ($file = $request->file('emirate_id_front')) {
                // $ext = date('d-m-Y-H-i');
                $mytime = Carbon::now();
                $ext =  $mytime->toDateTimeString();
                $name = $ext . '-' . $file->getClientOriginalName();
                $name = Str::slug($name, '-');

                // $name1 = $ext . '-' . $file1->getClientOriginalName();
                // $name1 = Str::slug($name, '-');

                // $name2 = $ext . '-' . $file2->getClientOriginalName();
                // $name2 = Str::slug($name, '-');

                // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                $file->move('documents', $name);
                $input['path'] = $name;

                // $file1->move('documents', $name1);
                // $input['path'] = $name1;

                // $file2->move('documents', $name2);
                // $input['path'] = $name2;
            }
            if ($file1 = $request->file('emirate_id_back')) {
                // $ext = date('d-m-Y-H-i');
                $mytime = Carbon::now();
                $ext =  $mytime->toDateTimeString();
                $name1 = $ext . '-' . $file1->getClientOriginalName();
                $name1 = Str::slug($name1, '-');

                // $name1 = $ext . '-' . $file1->getClientOriginalName();
                // $name1 = Str::slug($name, '-');

                // $name2 = $ext . '-' . $file2->getClientOriginalName();
                // $name2 = Str::slug($name, '-');

                // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                $file1->move('documents', $name1);
                $input['path'] = $name1;

                // $file1->move('documents', $name1);
                // $input['path'] = $name1;

                // $file2->move('documents', $name2);
                // $input['path'] = $name2;
            }
            if ($file2 = $request->file('activation_screenshot')) {
                // $ext = date('d-m-Y-H-i');
                $mytime = Carbon::now();
                $ext =  $mytime->toDateTimeString();
                $name2 = $ext . '-' . $file->getClientOriginalName();
                $name2 = Str::slug($name2, '-');

                // $name1 = $ext . '-' . $file1->getClientOriginalName();
                // $name1 = Str::slug($name, '-');

                // $name2 = $ext . '-' . $file2->getClientOriginalName();
                // $name2 = Str::slug($name, '-');

                // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                $file2->move('documents', $name2);
                $input['path'] = $name2;

                // $file1->move('documents', $name1);
                // $input['path'] = $name1;

                // $file2->move('documents', $name2);
                // $input['path'] = $name2;
            }
            $k = activation_form::create([
                    'cust_id' => $request->lead_id,
                    'lead_no' => $request->lead_no,
                    'lead_id' => $request->lead_id,
                    'verification_id' => $request->verification_id,
                    'customer_name' => $request->cname,
                    'customer_number' => $request->cnumber,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'nationality' => $request->nation,
                    'language' => $request->language,
                    'original_emirate_id' => $request->emirate_id,
                    // 'emirate_number' => $request->customer_name,
                    'additional_documents' => $request->additional_document,
                    'sim_type' => $request->simtype,
                    'number_commitment' => $request->numcommit,
                    // 'contract_commitment' => $request->customer_name,
                    'select_plan' => $request->plan_elife,
                    'benefits' => $request->customer_name,
                    // 'benefits' => $request->customer_name,
                    // 'total' => $request->customer_name,
                    'emirate_location' => $request->emirates,
                    'verify_agent' => $request->activation_sold_by,
                    // 'remarks' => $request->customer_name,
                    // 'pay_status' => $request->customer_name,
                    // 'pay_charges' => $request->customer_name,
                    'activation_date' => Carbon::now()->toDateTimeString(),
                    'activation_sr_no' => $request->activation_sr_no,
                    // 'activation_service_order' => $request->activation_service_order,
                    // 'activation_selected_no' => $request->activation_selected_no,
                    // 'activation_sim_serial_no' => $request->activation_sim_serial_no,
                    // 'activation_emirate_expiry' => $request->activation_emirate_expiry,
                    'activation_sold_by' => auth()->user()->id,
                    'imei' => $request->imei,
                    'emirate_id_front' => $name,
                    'emirate_id_back' => $name1,
                    'activation_screenshot' => $name2,

                    'saler_id' => $request->saler_id,
                    // 'later' => $request->customer_name,
                    // 'recording' => $request->customer_name,
                    // 'assing_to' => $request->customer_name,
                    // 'backoffice_by' => $request->customer_name,
                    // 'cordination_by' => $request->customer_name,
                    'date_time' => Carbon::now()->toDateTimeString(),
                    'status' => '0',
                    // 'selected_number' => $request->customer_name,
                    // 'flexible_minutes' => $request->customer_name,
                    // 'data' => $request->customer_name,
                ]);
                $activation_id = $k->id;
                $teacher_id = $request->documents;
                $book_records = [];



             if (!empty($request->documents)) {
            foreach ($request->documents as $key => $val) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('documents')) {
                        // return "a";
                        // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('documents', $name);
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
                    $data = activation_document::create([
                        // 'resource_name' => $request->resource_name,
                        'username' => 'activation',
                        'document_name' => $name,
                        'lead_id' => $request->lead_id,
                        'activation_id' => $activation_id,
                        'status'=>'0',
                        // 'batch_id' => $batch_id,
                    ]);
                }
            }
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.02',
            ]);
            $d = verification_form::findOrFail($request->ver_id);
            $d->update([
                'status' => '1.02',
                'assing_to' => $request->assing_to,
                'cordination_by' => auth()->user()->id,
            ]);

            // Insert book records
            activation_document::insert($book_records);
            Session::forget('front_image');
            Session::forget('back_image');
            Session::forget('sr_no');
            notify()->success('New Sale has been created succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('activation.index'));

        }
        else if($request->simtype == 'New'){
            // return $request;
            foreach ($request->plan_new as $key => $value) {
                return $value;
            }
            $validatedData = Validator::make($request->all(), [
                // 'plan_name' => 'required | string | unique',
                // 'plan_name' => 'required|string|unique:plans,plan_name',
                'activation_date' => 'required',
                'activation_sr_no' => 'required|numeric',
                'activation_service_order' => 'required|numeric',
                'activation_selected_no' => 'required|numeric',
                'activation_sim_serial_no' => 'required',
                'activation_emirate_expiry' => 'required',
                'activation_sold' => 'required',
                'activation_sold_by' => 'required',
                'saler_id' => 'required',
                // 'emirate_id_front' => 'required',
                // 'emirate_id_back' => 'required',
                // 'activation_screenshot' => 'required',
                'additional_document_activation' => 'required',
                'documents.*' => 'required',
            ]);
            if ($validatedData->fails()) {
                return redirect()->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }

            $date = str_replace('/', '-', $request->activation_date);
            $activation_date = date('Y-m-d', strtotime($date));

            $k = activation_form::create([
                'cust_id' => $request->lead_id,
                'lead_no' => $request->lead_no,
                'lead_id' => $request->lead_id,
                'verification_id' => $request->verification_id,
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'age' => $request->age,
                'gender' => $request->gender,
                'nationality' => $request->nation,
                'language' => $request->language,
                'original_emirate_id' => $request->emirate_id,
                // 'emirate_number' => $request->customer_name,
                'additional_documents' => $request->additional_document,
                'sim_type' => $request->simtype,
                'number_commitment' => $request->numcommit,
                // 'contract_commitment' => $request->customer_name,
                'select_plan' => $request->plan_elife,
                'benefits' => $request->customer_name,
                // 'benefits' => $request->customer_name,
                // 'total' => $request->customer_name,
                'emirate_location' => $request->emirates,
                'verify_agent' => $request->activation_sold_by,
                // 'remarks' => $request->customer_name,
                // 'pay_status' => $request->customer_name,
                // 'pay_charges' => $request->customer_name,
                'activation_date' => $activation_date,
                'activation_sr_no' => $request->activation_sr_no,
                'activation_service_order' => $request->activation_service_order,
                'activation_selected_no' => $request->activation_selected_no,
                'activation_sim_serial_no' => $request->activation_sim_serial_no,
                'activation_emirate_expiry' => $request->activation_emirate_expiry,
                'activation_sold_by' => auth()->user()->id,

                'emirate_id_front' => Session::get('front_image'),
                'emirate_id_back' => Session::get('front_image'),
                'activation_screenshot' => Session::get('sr_no'),

                'saler_id' => $request->saler_id,
                // 'later' => $request->customer_name,
                // 'recording' => $request->customer_name,
                // 'assing_to' => $request->customer_name,
                // 'backoffice_by' => $request->customer_name,
                // 'cordination_by' => $request->customer_name,
                'date_time' => Carbon::now()->toDateTimeString(),
                'status' => '1.02',
                // 'selected_number' => $request->customer_name,
                // 'flexible_minutes' => $request->customer_name,
                // 'data' => $request->customer_name,
            ]);
            if (!empty($request->selnumber)) {
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
                        $k->status = 'Active';
                        $k->save();
                        // CHANGE LATER
                        $cn = choosen_number::select('choosen_numbers.id')
                    ->where('number_id', $dn->id)
                    ->first();
                        if ($cn) {
                            $cnn = choosen_number::findorfail($cn->id);
                            $cnn->status = '2';
                            $cnn->save();
                        }
                        // CHANGE LATER
                    }
                    // return $d->id;
                // return "number has been reserved";
                }
            }
            $activation_id = $k->id;
            $teacher_id = $request->documents;
            $book_records = [];



            if (!empty($request->documents)) {
            foreach ($request->documents as $key => $val) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('documents')) {
                        // return "a";
                        // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('documents', $name);
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
                    $data = activation_document::create([
                        // 'resource_name' => $request->resource_name,
                        'username' => 'activation',
                        'document_name' => $name,
                        'lead_id' => $request->lead_id,
                        'activation_id' => $activation_id,
                        'status' => '1.02',
                        // 'batch_id' => $batch_id,
                    ]);

                }
            }

            // Insert book records
            activation_document::insert($book_records);
            Session::forget('front_image');
            Session::forget('back_image');
            Session::forget('sr_no');
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.02',
            ]);
            $d = verification_form::findOrFail($request->ver_id);
            $d->update([
                'status' => '1.02',
                'assing_to' => $request->assing_to,
                'cordination_by' => auth()->user()->id,
            ]);
            notify()->success('New Activation has been created succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('activation.index'));

        }
        else if($request->simtype == 'MNP' || $request->simtype == 'Migration'){
            // return $request;
            $validatedData = Validator::make($request->all(), [
                // 'plan_name' => 'required | string | unique',
                // 'plan_name' => 'required|string|unique:plans,plan_name',
                'activation_date' => 'required',
                'activation_sr_no' => 'required|numeric',
                'activation_service_order' => 'required|numeric',
                'activation_selected_no' => 'required|numeric',
                'activation_sim_serial_no' => 'required',
                'activation_emirate_expiry' => 'required',
                'activation_sold' => 'required',
                'activation_sold_by' => 'required',
                'saler_id' => 'required',
                // 'emirate_id_front' => 'required',
                // 'emirate_id_back' => 'required',
                // 'activation_screenshot' => 'required',
                // 'additional_document_activation' => 'required',
                'documents.*' => 'required',
            ]);
            if ($validatedData->fails()) {
                return redirect()->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }
            // if ($file = $request->file('emirate_id_front')) {
            //     // $ext = date('d-m-Y-H-i');
            //     $mytime = Carbon::now();
            //     $ext =  $mytime->toDateTimeString();
            //     $name = $ext . '-' . $file->getClientOriginalName();
            //     $name = Str::slug($name, '-');

            //     // $name1 = $ext . '-' . $file1->getClientOriginalName();
            //     // $name1 = Str::slug($name, '-');

            //     // $name2 = $ext . '-' . $file2->getClientOriginalName();
            //     // $name2 = Str::slug($name, '-');

            //     // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            //     $file->move('documents', $name);
            //     $input['path'] = $name;

            //     // $file1->move('documents', $name1);
            //     // $input['path'] = $name1;

            //     // $file2->move('documents', $name2);
            //     // $input['path'] = $name2;
            // }
            // if ($file1 = $request->file('emirate_id_back')) {
            //     // $ext = date('d-m-Y-H-i');
            //     $mytime = Carbon::now();
            //     $ext =  $mytime->toDateTimeString();
            //     $name1 = $ext . '-' . $file1->getClientOriginalName();
            //     $name1 = Str::slug($name1, '-');

            //     // $name1 = $ext . '-' . $file1->getClientOriginalName();
            //     // $name1 = Str::slug($name, '-');

            //     // $name2 = $ext . '-' . $file2->getClientOriginalName();
            //     // $name2 = Str::slug($name, '-');

            //     // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            //     $file1->move('documents', $name1);
            //     $input['path'] = $name1;

            //     // $file1->move('documents', $name1);
            //     // $input['path'] = $name1;

            //     // $file2->move('documents', $name2);
            //     // $input['path'] = $name2;
            // }
            // if ($file2 = $request->file('activation_screenshot')) {
            //     // $ext = date('d-m-Y-H-i');
            //     $mytime = Carbon::now();
            //     $ext =  $mytime->toDateTimeString();
            //     $name2 = $ext . '-' . $file->getClientOriginalName();
            //     $name2 = Str::slug($name2, '-');

            //     // $name1 = $ext . '-' . $file1->getClientOriginalName();
            //     // $name1 = Str::slug($name, '-');

            //     // $name2 = $ext . '-' . $file2->getClientOriginalName();
            //     // $name2 = Str::slug($name, '-');

            //     // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            //     $file2->move('documents', $name2);
            //     $input['path'] = $name2;

            //     // $file1->move('documents', $name1);
            //     // $input['path'] = $name1;

            //     // $file2->move('documents', $name2);
            //     // $input['path'] = $name2;
            // }
            $date = str_replace('/', '-', $request->activation_date);
            $activation_date = date('Y-m-d',
                strtotime($date)
            );
            $k = activation_form::create([
                'cust_id' => $request->lead_id,
                'lead_no' => $request->lead_no,
                'lead_id' => $request->lead_id,
                'verification_id' => $request->verification_id,
                'customer_name' => $request->cname,
                'customer_number' => $request->cnumber,
                'age' => $request->age,
                'gender' => $request->gender,
                'nationality' => $request->nation,
                'language' => $request->language,
                'original_emirate_id' => $request->emirate_id,
                // 'emirate_number' => $request->customer_name,
                'additional_documents' => $request->additional_document,
                'sim_type' => $request->simtype,
                'number_commitment' => $request->numcommit,
                // 'contract_commitment' => $request->customer_name,
                'select_plan' => $request->plan_elife,
                'benefits' => $request->customer_name,
                // 'benefits' => $request->customer_name,
                // 'total' => $request->customer_name,
                'emirate_location' => $request->emirates,
                'verify_agent' => $request->activation_sold_by,
                // 'remarks' => $request->customer_name,
                // 'pay_status' => $request->customer_name,
                // 'pay_charges' => $request->customer_name,
                'activation_date' => $activation_date,
                'activation_sr_no' => $request->activation_sr_no,
                'activation_service_order' => $request->activation_service_order,
                'activation_selected_no' => $request->activation_selected_no,
                'activation_sim_serial_no' => $request->activation_sim_serial_no,
                'activation_emirate_expiry' => $request->activation_emirate_expiry,
                'activation_sold_by' => auth()->user()->id,

                'emirate_id_front' => Session::get('front_image'),
                'emirate_id_back' => Session::get('front_image'),
                'activation_screenshot' => Session::get('sr_no'),
                'saler_id' => $request->saler_id,
                // 'later' => $request->customer_name,
                // 'recording' => $request->customer_name,
                // 'assing_to' => $request->customer_name,
                // 'backoffice_by' => $request->customer_name,
                // 'cordination_by' => $request->customer_name,
                'date_time' => Carbon::now()->toDateTimeString(),
                'status' => '1.02',
                // 'selected_number' => $request->customer_name,
                // 'flexible_minutes' => $request->customer_name,
                // 'data' => $request->customer_name,
            ]);
            $activation_id = $k->id;
            $teacher_id = $request->documents;
            $book_records = [];



            if (!empty($request->documents)) {
            foreach ($request->documents as $key => $val) {
                    // return $request->audio;
                    // return $request->file();
                    if ($file = $request->file('documents')) {
                        // return "a";
                        // }
                        $ext = date('d-m-Y-H-i');
                        // return $file;
                        $mytime = Carbon::now();
                        $ext =  $mytime->toDateTimeString();
                        $name = $ext . '-' . $file[$key]->getClientOriginalName();
                        $name = Str::slug($name, '-');

                        // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                        $file[$key]->move('documents', $name);
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
                    $data = activation_document::create([
                        // 'resource_name' => $request->resource_name,
                        'username' => 'activation',
                        'document_name' => $name,
                        'lead_id' => $request->lead_id,
                        'activation_id' => $activation_id,
                        'status' => '1.02',
                        // 'batch_id' => $batch_id,
                    ]);
                    $d = lead_sale::findOrFail($request->lead_id);
                    $d->update([
                        'status' => '1.02',
                    ]);
                    $d = verification_form::findOrFail($request->ver_id);
                    $d->update([
                        'status' => '1.02',
                        'assing_to' => $request->assing_to,
                        'cordination_by' => auth()->user()->id,
                    ]);
                }
            }

            // Insert book records
            activation_document::insert($book_records);
            Session::forget('front_image');
            Session::forget('back_image');
            Session::forget('sr_no');
            notify()->success('New Activation has been created succesfully');
            // return redirect()->back()->withInput();
            return redirect(route('activation.index'));

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\activation_form  $activation_form
     * @return \Illuminate\Http\Response
     */
    public function show(activation_form $activation_form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\activation_form  $activation_form
     * @return \Illuminate\Http\Response
     */
    public function edit(activation_form $plan,$id)
    {
        //
        // return $plan;
        if(auth()->user()->role == 'Elife Active'){
            $operation = verification_form::select("lead_sales.id as lead_id", "verification_forms.id as ver_id", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "users.name as agent_name", "lead_sales.*", "lead_locations.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->LeftJoin(
                'timing_durations',
                'timing_durations.lead_no',
                '=',
                'verification_forms.lead_no'
            )
            ->LeftJoin(
                'remarks',
                'remarks.lead_no',
                '=',
                'verification_forms.lead_no'
            )
            ->LeftJoin(
                'lead_locations',
                'lead_locations.lead_id',
                '=',
                'verification_forms.lead_no'
            )
            ->LeftJoin(
                'lead_sales',
                'lead_sales.id',
                '=',
                'verification_forms.lead_no'
            )
            ->LeftJoin(
                'users',
                'users.id',
                '=',
                'lead_sales.share_with'
            )
            ->where('verification_forms.id', $id)
            ->first();

            $remarks =  remark::select("remarks.*")
                // ->where("remarks.user_agent_id", auth()->user()->id)
                ->where("remarks.lead_id", $operation->lead_id)
                ->get();
            $countries = \App\country_phone_code::all();
            // $operation = verification_form::wherestatus('1.10')->get();
            $emirates = \App\emirate::all();
            $plans = \App\plan::wherestatus('1')->get();
            $elifes = \App\elife_plan::wherestatus('1')->get();
            $addons = \App\addon::wherestatus('1')->get();
            $device = \App\imei_list::wherestatus('1')->get();

            // $operation = verification_form::whereid($id)->get();
            return view('dashboard.add-activation-elife', compact('operation', 'remarks', 'countries', 'emirates', 'plans', 'elifes', 'addons', 'device'));
        }
        else{
            $operation = verification_form::select("lead_sales.id as lead_id", "verification_forms.id as ver_id", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "users.name as agent_name", "lead_sales.*", "lead_locations.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->LeftJoin(
                'timing_durations',
                'timing_durations.lead_no',
                '=',
                'verification_forms.lead_no'
            )
            ->LeftJoin(
                'remarks',
                'remarks.lead_no',
                '=',
                'verification_forms.lead_no'
            )
            ->LeftJoin(
                'lead_locations',
                'lead_locations.lead_id',
                '=',
                'verification_forms.lead_no'
            )
            ->LeftJoin(
                'lead_sales',
                'lead_sales.id',
                '=',
                'verification_forms.lead_no'
            )
            ->LeftJoin(
                'users',
                'users.id',
                '=',
                'lead_sales.share_with'
            )
            ->where('verification_forms.id', $id)
            ->first();

            $remarks =  remark::select("remarks.*")
                // ->where("remarks.user_agent_id", auth()->user()->id)
                ->where("remarks.lead_id", $operation->lead_id)
                ->get();
            $countries = \App\country_phone_code::all();
            // $operation = verification_form::wherestatus('1.10')->get();
            $emirates = \App\emirate::all();
            $plans = \App\plan::wherestatus('1')->get();
            $elifes = \App\elife_plan::wherestatus('1')->get();
            $addons = \App\addon::wherestatus('1')->get();
            $device = \App\imei_list::wherestatus('1')->get();

            // $operation = verification_form::whereid($id)->get();
            return view('dashboard.add-activation', compact('operation', 'remarks', 'countries', 'emirates', 'plans', 'elifes', 'addons', 'device'));
        }
        // return view('dashboar', compact('operation'));

        // return $activation_form;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\activation_form  $activation_form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, activation_form $activation_form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\activation_form  $activation_form
     * @return \Illuminate\Http\Response
     */
    public function destroy(activation_form $activation_form)
    {
        //
    }
}
