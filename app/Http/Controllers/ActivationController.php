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
// use App\lead_sale;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ActivationController extends Controller
{
    //
    public function myactive(){
        $id = 'Activated Leads';
        $operation = lead_sale::select("timing_durations.lead_generate_time", "timing_durations.lead_accept_time", "timing_durations.lead_proceed_time", "lead_sales.*", "status_codes.status_name")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->LeftJoin(
                'timing_durations',
                'timing_durations.lead_no',
                '=',
                'lead_sales.id'
            )
            ->LeftJoin(
                'activation_forms',
                'activation_forms.lead_id',
                '=',
                'lead_sales.id'
            )
            ->Join(
                'status_codes',
                'status_codes.status_code',
                '=',
                'lead_sales.status'
            )
            ->Join(
                'users',
                'users.id',
                '=',
                'lead_sales.saler_id'
            )
            ->where('lead_sales.status', '1.02')
            ->where('activation_forms.activation_sold_by', auth()->user()->id)
            ->get();
        // $operation = lead_sale::wherestatus('1.01')->get();
        return view('dashboard.view-all-lead', compact('operation', 'id'));
    }


    public function ActiveNew(Request $request){
        // return $request;

        $validatedData = Validator::make($request->all(), [
            // 'plan_name' => 'required | string | unique',
            // 'plan_name' => 'required|string|unique:plans,plan_name',
            'activation_date.*' => 'required',
            'activation_sr_no.*' => 'required|numeric',
            'activation_service_order.*' => 'required|numeric',
            'activation_selected_no.*' => 'required|numeric',
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
            'sr_photo.*' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        foreach ($request->plan_new as $key => $value) {
            // return $value;
            // return $key;
            // echo $key . '<br>';
            // $date = str_replace('/',
            // '-',
            // return $request['sr_photo'][1];
            if ($file = $request->file('sr_photo')) {
                // $ext = date('d-m-Y-H-i');
                $mytime = Carbon::now();
                $ext =  $mytime->toDateTimeString();
                $name = $ext . '-' . $file[$key]->getClientOriginalName();
                // return $name = Str::slug($name, '-');
                // return $name;
                // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                $file[$key]->move('documents', $name);
                $input['path'] = $name;
            }
            // return $request['activation_date'][1];
            // echo $request->activation_date[$key] . '<br>';
            // );
            // $request->activation_date[1];
            // $activation_date = date('Y-m-d', strtotime($date));

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
                'select_plan' => $value,
                'benefits' => $request->customer_name,
                // 'benefits' => $request->customer_name,
                // 'total' => $request->customer_name,
                'emirate_location' => $request->emirates,
                'verify_agent' => $request->activation_sold_by,
                // 'remarks' => $request->customer_name,
                // 'pay_status' => $request->customer_name,
                // 'pay_charges' => $request->customer_name,
                'activation_date' => $request['activation_date'][$key],
                'activation_sr_no' => $request['activation_sr_no'][$key],
                'activation_service_order' => $request['activation_service_order'][$key],
                'pay_charges' => $request['activation_rate_new'][$key],
                'pay_status' => $request['activation_charges_new'][$key],
                'activation_selected_no' => $request['activation_selected_no'][$key],
                'activation_sim_serial_no' => $request->activation_sim_serial_no,
                'activation_emirate_expiry' => $request->activation_emirate_expiry,
                'activation_sold_by' => auth()->user()->id,

                'emirate_id_front' => Session::get('front_image'),
                'emirate_id_back' => Session::get('front_image'),
                'activation_screenshot' => $name,

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
        }

        // SSS
        // $date = str_replace('/',
        //     '-',
        //     $request->activation_date
        // );
        // $activation_date = date('Y-m-d', strtotime($date));

        // $k = activation_form::create([
        //     'cust_id' => $request->lead_id,
        //     'lead_no' => $request->lead_no,
        //     'lead_id' => $request->lead_id,
        //     'verification_id' => $request->verification_id,
        //     'customer_name' => $request->cname,
        //     'customer_number' => $request->cnumber,
        //     'age' => $request->age,
        //     'gender' => $request->gender,
        //     'nationality' => $request->nation,
        //     'language' => $request->language,
        //     'original_emirate_id' => $request->emirate_id,
        //     // 'emirate_number' => $request->customer_name,
        //     'additional_documents' => $request->additional_document,
        //     'sim_type' => $request->simtype,
        //     'number_commitment' => $request->numcommit,
        //     // 'contract_commitment' => $request->customer_name,
        //     'select_plan' => $request->plan_elife,
        //     'benefits' => $request->customer_name,
        //     // 'benefits' => $request->customer_name,
        //     // 'total' => $request->customer_name,
        //     'emirate_location' => $request->emirates,
        //     'verify_agent' => $request->activation_sold_by,
        //     // 'remarks' => $request->customer_name,
        //     // 'pay_status' => $request->customer_name,
        //     // 'pay_charges' => $request->customer_name,
        //     'activation_date' => $activation_date,
        //     'activation_sr_no' => $request->activation_sr_no,
        //     'activation_service_order' => $request->activation_service_order,
        //     'activation_selected_no' => $request->activation_selected_no,
        //     'activation_sim_serial_no' => $request->activation_sim_serial_no,
        //     'activation_emirate_expiry' => $request->activation_emirate_expiry,
        //     'activation_sold_by' => auth()->user()->id,

        //     'emirate_id_front' => Session::get('front_image'),
        //     'emirate_id_back' => Session::get('front_image'),
        //     'activation_screenshot' => Session::get('sr_no'),

        //     'saler_id' => $request->saler_id,
        //     // 'later' => $request->customer_name,
        //     // 'recording' => $request->customer_name,
        //     // 'assing_to' => $request->customer_name,
        //     // 'backoffice_by' => $request->customer_name,
        //     // 'cordination_by' => $request->customer_name,
        //     'date_time' => Carbon::now()->toDateTimeString(),
        //     'status' => '1.02',
        //     // 'selected_number' => $request->customer_name,
        //     // 'flexible_minutes' => $request->customer_name,
        //     // 'data' => $request->customer_name,
        // ]);
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
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

        // return redirect()->back()->withInput();
        // return redirect(route('activation.index'));
        // SSS END
    }
    public function ActiveElife(Request $request){
        $validatedData = Validator::make($request->all(), [
            // 'plan_name' => 'required | string | unique',
            // 'plan_name' => 'required|string|unique:plans,plan_name',
            // 'activation_date' => 'required',
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
            // return redirect()->back()
            //     ->withErrors($validatedData)
            //     ->withInput();
            return response()->json(['error' => $validatedData->errors()->all()]);

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
        if ($file2 = $request->file('activation_screenshot')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $name2 = $ext . '-' . $file2->getClientOriginalName();
            // $name2 = Str::slug($name2, '-');

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
            'emirate_id_front' => Session::get('front_image'),
            'emirate_id_back' => Session::get('front_image'),
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
                    'username' => auth()->user()->name,
                    'document_name' => $name,
                    'lead_id' => $request->lead_id,
                    'activation_id' => $activation_id,
                    'status' => '1',
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
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

        // return redirect()->back()->withInput();
        // return redirect(route('activation.index'));
    }
    public function ActiveElifePlan(Request $request){
        // return $request;
        $k = activation_form::select('activation_forms.*')
                            ->where('activation_forms.lead_id', $request->lead_id)->first();
        $k = activation_form::findorfail($k->id);
        $k->status = '1.18';
        $k->date_time = $request->later_date;
        $k->save();
        $k = verification_form::select('verification_forms.*')
                            ->where('verification_forms.lead_no', $request->lead_id)->first();
        $k = verification_form::findorfail($k->id);
        $k->status = '1.18';
        $k->save();
        $k = lead_sale::findorfail($request->lead_id);
        $k->status = '1.18';
        $k->save();

    }
    public function RejectElifePlan(Request $request){
        // return $request;
        $k = activation_form::select('activation_forms.*')
                            ->where('activation_forms.lead_id', $request->lead_id)->first();
        $k = activation_form::findorfail($k->id);
        $k->status = '1.15';
        $k->remarks = $request->remarks;
        // $k->date_time = $request->later_date;
        $k->save();
        $k = verification_form::select('verification_forms.*')
                            ->where('verification_forms.lead_no', $request->lead_id)->first();
        $k = verification_form::findorfail($k->id);
        $k->status = '1.15';
        $k->remarks = $request->remarks;
        $k->save();
        $k = lead_sale::findorfail($request->lead_id);
        $k->status = '1.15';
        $k->remarks = $request->remarks;
        $k->save();

    }
}
