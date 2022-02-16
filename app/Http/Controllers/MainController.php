<?php

namespace App\Http\Controllers;

use App\activation_document;
use App\AgencyBill;
use App\billing_sale;
use App\elife_sale;
use App\postpaid_activation_document;
// use App\prepaid_activation_document;
use App\postpaid_sales;
use App\prepaid_activation_documents;
use App\prepaid_sale;
use App\remarks_elife_number;
use App\userwaller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    //
    public function elife_telesale(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'cname' => 'required|string',
            'cnumber' => 'required|numeric',
            'code' => 'required|numeric',
            'elife_makani_number' => 'required',
            'emirate_id' => 'required',
            'emirate_number' => 'required_if:emirate_id,==,Emirate ID',
            'passport_number' => 'required_if:emirate_id,==,Passport',
            'emirates' => 'required',
            'flat' => 'required',
            'zone' => 'required_if:simtype,==,Elife',
            'street' => 'required',
            'area' => 'required',
            'gender' => 'required',
            'language' => 'required',
            'nation' => 'required',
            'add_lat_lng' => 'required',
            'additional_document' => 'required',
            'age' => 'required|integer|between:21,99',
            'plan_elife' => 'required',
            'remarks_process_elife' => 'required|string',
            'simtype' => 'required',
            'location' => 'required',
            'addon' => 'required',
            // 'age' => 'min:24'

        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if($request->emirate_id == 'Emirate ID'){
            $document_no = $request->emirate_number;
        }
        else{
            $document_no = $request->passport_number;
        }
        // return $request->add_lat_lng;
        $ll = explode(',',$request->add_lat_lng);
        $lat = $ll['0'];
        $lng = $ll['1'];
        if(!empty($request->aff_number)){
            $aff_number = $request->aff_number;
        }else{
            $aff_number = '';
        }
        // return $aff_number;
        $data = elife_sale::create([
            'customer_name' => $request->cname,
            'customer_number' => $request->code . '-'. $request->cnumber,
            'country' => $request->nation,
            'age' => $request->age,
            'product_type' => $request->simtype,
            'plan' => $request->plan_elife,
            'addon' => $request->addon,
            'zone' => $request->zone,
            'gender' => $request->gender,
            'emirate' => $request->emirates,
            'document_type' => $request->emirate_id,
            'additional_document' => $request->document,
            'document_no' => $document_no,
            'language' => $request->language,
            'address' => $request->flat . ' ' . $request->street . ' ' . $request->area,
            'vila' => $request->flat,
            'street' => $request->street,
            'area' => $request->area,
            'makani' => $request->elife_makani_number,
            'location_name' => $request->location,
            'lat' => $lat,
            'lng' => $lng,
            'saler_id' => auth()->user()->id,
            'status' => '1.01',
            'lead_no' => $request->leadnumber,
            'kiosk_id' => auth()->user()->kiosk_id,
            'remarks' => $request->remarks_process_elife,
            'sale_type' => $request->sale_type,
            'aff_number' => $aff_number,
        ]);
        if(!empty($request->aff_number)){
            // return $aff_number;
            $ks = remarks_elife_number::where('number', $aff_number)->update([
                'status' => '2',
                'lead_id' => $data->id,
                'other_remarks' => 'Lead has Been Created',
            ]);
        }
        Session::put('choosen_lead_number', '');
        // return $data;
        notify()->success('New Activation has been created succesfully');
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    public function elife_dd(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'cname' => 'required|string',
            'cnumber' => 'required|numeric',
            'code' => 'required|numeric',
            'elife_makani_number' => 'required',
            'emirate_id' => 'required',
            'emirate_number' => 'required_if:emirate_id,==,Emirate ID',
            'passport_number' => 'required_if:emirate_id,==,Passport',
            'emirates' => 'required',
            'flat' => 'required',
            'zone' => 'required_if:simtype,==,Elife',
            'street' => 'required',
            'area' => 'required',
            'gender' => 'required',
            'language' => 'required',
            'nation' => 'required',
            'add_lat_lng' => 'required',
            'additional_document' => 'required',
            'age' => 'required|integer|between:21,99',
            'plan_elife' => 'required',
            'remarks_process_elife' => 'required|string',
            'simtype' => 'required',
            'location' => 'required',
            'addon' => 'required',
            'sr_number' => 'required',
            'sr_documents' => 'required',
            'documents.*' => 'required',
            // 'age' => 'min:24'

        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if($request->emirate_id == 'Emirate ID'){
            $document_no = $request->emirate_number;
        }
        else{
            $document_no = $request->passport_number;
        }
        $ll = explode(',',$request->add_lat_lng);
        $lat = $ll['0'];
        $lng = $ll['1'];
        if ($file = $request->file('sr_documents')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $sr_documents = $ext . '-' . $file->getClientOriginalName();
            // return $name = Str::slug($name, '-');
            // return $name;
            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $sr_documents);
            $input['path'] = $sr_documents;
        }
        $data = elife_sale::create([
            'customer_name' => $request->cname,
            'customer_number' => $request->code . '-'. $request->cnumber,
            'country' => $request->nation,
            'age' => $request->age,
            'product_type' => $request->simtype,
            'plan' => $request->plan_elife,
            'addon' => $request->addon,
            'zone' => $request->zone,
            'gender' => $request->gender,
            'emirate' => $request->emirates,
            'document_type' => $request->emirate_id,
            'additional_document' => $request->document,
            'document_no' => $document_no,
            'language' => $request->language,
            'address' => $request->flat . ' ' . $request->street . ' ' . $request->area,
            'vila' => $request->flat,
            'street' => $request->street,
            'area' => $request->area,
            'makani' => $request->elife_makani_number,
            'location_name' => $request->location,
            'lat' => $lat,
            'lng' => $lng,
            'saler_id' => auth()->user()->id,
            'status' => '1.10',
            'lead_no' => $request->leadnumber,
            'kiosk_id' => auth()->user()->kiosk_id,
            'remarks' => $request->remarks_process_elife,
            'front_document' => Session::get('front_image'),
            'back_document' => Session::get('back_image'),
            'sr_number' => $request->sr_number,
            'sr_doc' => $sr_documents,
            'sale_type' => $request->sale_type,

            // 'sr_number' =>
        ]);
        Session::forget('front_image');
        Session::forget('back_image');
        // Session::forget('sr_no');
        if (!empty($request->documents)) {
            foreach ($request->documents as $key => $val) {
                // return $request->file();
                if ($file = $request->file('documents')) {
                    // }
                    $ext = date('d-m-Y-H-i');
                    // return $file;
                    $mytime = Carbon::now();
                    $ext =  $mytime->toDateTimeString();
                    $name = $ext . '-' . $file[$key]->getClientOriginalName();
                    // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                    $file[$key]->move('documents', $name);
                    $input['path'] = $name;
                }
                // }
                $data = activation_document::create([
                    // 'resource_name' => $request->resource_name,
                    'username' => 'activation',
                    'document_name' => $name,
                    'lead_id' => $data->id,
                    'activation_id' => $data->id,
                    'status' => '1.10',
                    // 'batch_id' => $batch_id,
                ]);
            }
        }
        // return $data;
        notify()->success('New Activation has been created succesfully');
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    public function postpaid_telesale(Request $request)
    {
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'cname' => 'required|string',
            'cnumber' => 'required|numeric',
            'code' => 'required|numeric',
            'emirates' => 'required',
            'gender' => 'required',
            'language' => 'required',
            'nation' => 'required',
            'additional_document' => 'required',
            'age' => 'required|integer|between:21,99',
            'plan_new' => 'required',
            'remarks_process_new' => 'required|string',
            'simtype' => 'required',
            'plan_s'=>'required',
            'activation_rate_new'=>'required',
            'selnumber'=>'required',

        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if ($request->emirate_id == 'Emirate ID') {
            $document_no = $request->emirate_number;
        } else {
            $document_no = $request->passport_number;
        }
        $data = postpaid_sales::create([
            'customer_name' => $request->cname,
            'customer_number' => $request->code . '-' . $request->cnumber,
            'country' => $request->nation,
            'age' => $request->age,
            'product_type' => $request->simtype,
            'plan' => $request->plan_new,
            'addon' => $request->addon,
            'emirate' => $request->emirates,
            'document_type' => $request->emirate_id,
            'additional_document' => $request->document,
            'language' => $request->language,
            'saler_id' => auth()->user()->id,
            'status' => '1.01',
            'lead_no' => $request->leadnumber,
            'kiosk_id' => auth()->user()->kiosk_id,
            'remarks' => $request->remarks_process_new,
            'sale_type' => $request->sale_type,
            'selected_number' => $request->selnumber,
            'document_no' => $document_no,
            'pay_status' => 'Paid',
            'pay_charges' => $request->activation_rate_new,

            // 'sr_number' =>
        ]);
        return $data;
    }
    public function postpaid_direct_telesale(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'cname' => 'required|string',
            'cnumber' => 'required|numeric',
            'code' => 'required|numeric',
            'emirates' => 'required',
            'gender' => 'required',
            'language' => 'required',
            'nation' => 'required',
            'additional_document' => 'required',
            'age' => 'required|integer|between:21,99',
            'plan_new' => 'required',
            'remarks_process_new' => 'required|string',
            'simtype' => 'required',
            'plan_s' => 'required',
            'activation_rate_new' => 'required',
            'selnumber' => 'required',
            'sr_number' => 'required',
            'sr_documents' => 'required',
            'documents.*' => 'required',

        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if ($request->emirate_id == 'Emirate ID') {
            $document_no = $request->emirate_number;
        } else {
            $document_no = $request->passport_number;
        }
        //
        if ($file = $request->file('sr_documents')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $sr_documents = $ext . '-' . $file->getClientOriginalName();
            // return $name = Str::slug($name, '-');
            // return $name;
            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $sr_documents);
            $input['path'] = $sr_documents;
        }
        //
        $data = postpaid_sales::create([
            'customer_name' => $request->cname,
            'customer_number' => $request->code . '-' . $request->cnumber,
            'country' => $request->nation,
            'age' => $request->age,
            'product_type' => $request->simtype,
            'plan' => $request->plan_new,
            'addon' => $request->addon,
            'emirate' => $request->emirates,
            'document_type' => $request->emirate_id,
            'additional_document' => $request->document,
            'language' => $request->language,
            'saler_id' => auth()->user()->id,
            'status' => '1.01',
            'lead_no' => $request->leadnumber,
            'kiosk_id' => auth()->user()->kiosk_id,
            'remarks' => $request->remarks_process_new,
            'sale_type' => $request->sale_type,
            'selected_number' => $request->selnumber,
            'document_no' => $document_no,
            'pay_status' => 'Paid',
            'pay_charges' => $request->activation_rate_new,
            'front_document' => Session::get('front_image'),
            'back_document' => Session::get('back_image'),
            'sr_number' => $request->sr_number,
            'sr_doc' => $sr_documents,
            'sale_type' => $request->sale_type,

            // 'sr_number' =>
        ]);
        Session::forget('front_image');
        Session::forget('back_image');
        // Session::forget('sr_no');
        if (!empty($request->documents)) {
            foreach ($request->documents as $key => $val) {
                // return $request->file();
                if ($file = $request->file('documents')) {
                    // }
                    $ext = date('d-m-Y-H-i');
                    // return $file;
                    $mytime = Carbon::now();
                    $ext =  $mytime->toDateTimeString();
                    $name = $ext . '-' . $file[$key]->getClientOriginalName();
                    // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                    $file[$key]->move('documents', $name);
                    $input['path'] = $name;
                }
                // }
                $data = postpaid_activation_document::create([
                    // 'resource_name' => $request->resource_name,
                    'username' => 'activation',
                    'document_name' => $name,
                    'lead_id' => $data->id,
                    'activation_id' => $data->id,
                    'status' => '1.10',
                    // 'batch_id' => $batch_id,
                ]);
            }
        }
        return $data;
    }
    public function prepaid_sale(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'cname' => 'required|string',
            'cnumber' => 'required|numeric',
            'code' => 'required|numeric',
            'gender' => 'required',
            'emirate_number' => 'required',
            'nation' => 'required',
            'age' => 'required|integer|between:21,99',
            // 'plan_new' => 'required',
            'remarks_process_new' => 'required|string',
            'simtype' => 'required',
            'emirate_expiry' => 'required',
            'dob' => 'required',
            'amount' => 'required_if:simtype,==,Control Line|numeric',

            // 'plan_s' => 'required',
            // 'activation_rate_new' => 'required',
            // 'selnumber' => 'required',
            // 'sr_number' => 'required',
            // 'sr_documents' => 'required',
            // 'documents.*' => 'required',

        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        $data = prepaid_sale::create([
            'customer_name' => $request->cname,
            'customer_number' => $request->code . '-' . $request->cnumber,
            'country' => $request->nation,
            'age' => $request->age,
            'product_type' => $request->simtype,
            'plan' => $request->plan_new,
            'saler_id' => auth()->user()->id,
            'status' => '1.01',
            'lead_no' => $request->leadnumber,
            'kiosk_id' => auth()->user()->kiosk_id,
            'remarks' => $request->remarks_process_new,
            'sale_type' => $request->sale_type,
            'selected_number' => $request->selnumber,
            'document_no' => $request->emirate_number,
            'pay_status' => 'Paid',
            'pay_charges' => $request->activation_rate_new,
            'date_of_birth' => date('Y-m-d', strtotime($request->dob)),
            'emirate_expiry' => date('Y-m-d', strtotime($request->emirate_expiry)),
            'front_document' => Session::get('front_image'),
            'back_document' => Session::get('back_image'),
            'amount' => $request->amount,
        ]);
        return $data;
        // if ($request->emirate_id == 'Emirate ID') {
        //     $document_no = $request->emirate_number;
        // } else {
        //     $document_no = $request->passport_number;
        // }
    }
    public function control_line_submit(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'cname' => 'required|string',
            'cnumber' => 'required|numeric',
            'code' => 'required|numeric',
            'gender' => 'required',
            'emirate_number' => 'required',
            'nation' => 'required',
            'age' => 'required|integer|between:21,99',
            // 'plan_new' => 'required',
            'remarks_process_new' => 'required|string',
            'simtype' => 'required',
            'emirate_expiry' => 'required',
            'dob' => 'required',
            'amount' => 'required_if:simtype,==,Control Line|numeric',

            // 'plan_s' => 'required',
            // 'activation_rate_new' => 'required',
            // 'selnumber' => 'required',
            // 'sr_number' => 'required',
            'sr_documents' => 'required',
            'documents.*' => 'required',

        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        $data = prepaid_sale::create([
            'customer_name' => $request->cname,
            'customer_number' => $request->code . '-' . $request->cnumber,
            'country' => $request->nation,
            'age' => $request->age,
            'product_type' => $request->simtype,
            'plan' => $request->plan_new,
            'saler_id' => auth()->user()->id,
            'status' => '1.01',
            'lead_no' => $request->leadnumber,
            'kiosk_id' => auth()->user()->kiosk_id,
            'remarks' => $request->remarks_process_new,
            'sale_type' => $request->sale_type,
            'selected_number' => $request->selnumber,
            'document_no' => $request->emirate_number,
            'pay_status' => 'Paid',
            'pay_charges' => $request->activation_rate_new,
            'date_of_birth' => date('Y-m-d', strtotime($request->dob)),
            'emirate_expiry' => date('Y-m-d', strtotime($request->emirate_expiry)),
            'front_document' => Session::get('front_image'),
            'back_document' => Session::get('back_image'),
            'amount' => $request->amount,
            'sr_number' => $request->sr_number,

        ]);
        Session::forget('front_image');
        Session::forget('back_image');
        // Session::forget('sr_no');
        if (!empty($request->documents)) {
            foreach ($request->documents as $key => $val) {
                // return $request->file();
                if ($file = $request->file('documents')) {
                    // }
                    $ext = date('d-m-Y-H-i');
                    // return $file;
                    $mytime = Carbon::now();
                    $ext =  $mytime->toDateTimeString();
                    $name = $ext . '-' . $file[$key]->getClientOriginalName();
                    // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                    $file[$key]->move('documents', $name);
                    $input['path'] = $name;
                }
                // }
                $data = prepaid_activation_documents::create([
                    // 'resource_name' => $request->resource_name,
                    'username' => 'activation',
                    'document_name' => $name,
                    'lead_id' => $data->id,
                    'activation_id' => $data->id,
                    'status' => '1.10',
                    // 'batch_id' => $batch_id,
                ]);
            }
        }
        return $data;
        // if ($request->emirate_id == 'Emirate ID') {
        //     $document_no = $request->emirate_number;
        // } else {
        //     $document_no = $request->passport_number;
        // }
    }
    public function billing_sale(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'cname' => 'required|string',
            'cnumber' => 'required|numeric',
            // 'gender' => 'required',
            'simtype' => 'required',
            'recharge_amount' => 'required_if:simtype,==,Control Line|numeric',
            'remarks_process_elife'=> 'required'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if(empty(Session::get('front_image'))){
            return response()->json(['error' => ['Documents' => ['Emirate front ID Issue, Please re upload']]], 200);
        }
        if(empty(Session::get('back_image'))){
            return response()->json(['error' => ['Documents' => ['Emirate Back ID Issue, Please re upload']]], 200);
        }
        // return $request->recharge_amount;
        $checkamount = AgencyBill::where('amount', '>=' , trim($request->recharge_amount))->first();
        if(!$checkamount){
            return response()->json(['error' => ['Documents' => ['Machine out of Balance, Please recharge or review your amount']]], 200);
        }else{


         $myamount = $checkamount->amount - $request->recharge_amount;;
        $checkamount->amount = $myamount;
        $checkamount->save();
        }
        // return $checkamount;
        $data = billing_sale::create([
            'customer_name' => $request->cname,
            'customer_number' => $request->cnumber,
            'saler_id' => auth()->user()->id,
            'status' => '1.01',
            'lead_no' => $request->leadnumber,
            'product_type' => $request->simtype,
            'kiosk_id' => auth()->user()->kiosk_id,
            'remarks' => $request->remarks_process_elife,
            'sale_type' => $request->sale_type,
            'front_document' => Session::get('front_image'),
            'back_document' => Session::get('back_image'),
            'amount' => $request->recharge_amount,
            'email' => $request->email,
            'agency_id' => $request->agency_id,
            // 'gender' => $request->gender,
        ]);
        Session::forget('front_image');
        Session::forget('back_image');
        return $data;
    }
    //
    public function elife_assigned(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'runner' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        $data = elife_sale::findorfail($request->leadid);
        $data->assigned_to = $request->runner;
        $data->status = '1.10';
        $data->save();
        return $data;
    }
    public function elife_followup(Request $request){
        // $validatedData = Validator::make($request->all(), [
        //     'activation_date' => 'required',
        // ]);
        // if ($validatedData->fails()) {
        //     return response()->json(['error' => $validatedData->errors()->all()]);
        // }
        //
        $data = elife_sale::findorfail($request->leadid);
        $data->status = '1.19';
        $data->save();
        // return
        notify()->success('Lead Succesfully Followup');

    }
    public function elife_reject(Request $request){
        // $validatedData = Validator::make($request->all(), [
        //     'activation_date' => 'required',
        // ]);
        // if ($validatedData->fails()) {
        //     return response()->json(['error' => $validatedData->errors()->all()]);
        // }
        //
        $data = elife_sale::findorfail($request->leadid);
        $data->status = '1.15';
        $data->save();
        // return
        notify()->success('Lead Succesfully Reject');
    }
    public function elife_complete(Request $request){
        // $validatedData = Validator::make($request->all(), [
        //     'activation_date' => 'required',
        // ]);
        // if ($validatedData->fails()) {
        //     return response()->json(['error' => $validatedData->errors()->all()]);
        // }
        //
        $data = elife_sale::findorfail($request->leadid);
        $data->status = '1.21';
        $data->save();
        // return
        notify()->success('Lead Succesfully Active');

    }
    public function attach_recording(Request $request){
        $validatedData = Validator::make($request->all(), [
            'audio' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        if ($file = $request->file('audio')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $audio = $ext . '-' . $file->getClientOriginalName();
            // return $name = Str::slug($name, '-');
            // return $name;
            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $audio);
            $input['path'] = $audio;
        }
        //
        $data = elife_sale::findorfail($request->leadid);
        $data->audio = $audio;
        $data->save();
        // return
        notify()->success('Audio Attached Succesfully');

    }
    public function attach_recording_nonvalidate(Request $request){
        $validatedData = Validator::make($request->all(), [
            'audio' => 'required',
            'remarks' => 'remarks',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        if ($file = $request->file('audio')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $audio = $ext . '-' . $file->getClientOriginalName();
            // return $name = Str::slug($name, '-');
            // return $name;
            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $audio);
            $input['path'] = $audio;
        }
        //
        $data = elife_sale::findorfail($request->leadid);
        $data->audio = $audio;
        $data->status = '1.22';
        $data->save();
        // return
        notify()->success('Audio Attached Succesfully');

    }
    public function elife_active(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'activation_date' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        if ($file = $request->file('front_img')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $front_document = $ext . '-' . $file->getClientOriginalName();
            // return $name = Str::slug($name, '-');
            // return $name;
            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $front_document);
            $input['path'] = $front_document;
        }
        else{
            $front_document = $request->front_doc_old;
        }
        // return $front_document;
        //
        //
        if ($file = $request->file('back_img')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $back_document = $ext . '-' . $file->getClientOriginalName();
            // return $name = Str::slug($name, '-');
            // return $name;
            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $back_document);
            $input['path'] = $back_document;
        }
        else{
            $back_document = $request->back_doc_old;
        }
        //
        //
        if ($file = $request->file('sr_documents')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $sr_doc = $ext . '-' . $file->getClientOriginalName();
            // return $name = Str::slug($name, '-');
            // return $name;
            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $sr_doc);
            $input['path'] = $sr_doc;
        }
        else{
            $sr_doc = $request->sr_doc_old;
        }
        //
        if(!empty($request->sr_number)){
            $sr_number = $request->sr_number;
        }
        else{
            $sr_number = $request->sr_number_old;
        }
        $data = elife_sale::findorfail($request->leadid);
        $data->activation_date = $request->activation_date;
        $data->front_document = $front_document;
        $data->back_document = $back_document;
        $data->sr_doc = $sr_doc;
        $data->sr_number = $sr_number;
        $data->status = '1.02';
        $data->save();


        if (!empty($request->documents)) {
            foreach ($request->documents as $key => $val) {
                // return $request->file();
                if ($file = $request->file('documents')) {
                    // }
                    $ext = date('d-m-Y-H-i');
                    // return $file;
                    $mytime = Carbon::now();
                    $ext =  $mytime->toDateTimeString();
                    $name = $ext . '-' . $file[$key]->getClientOriginalName();
                    // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
                    $file[$key]->move('documents', $name);
                    $input['path'] = $name;
                }
                // }
                $data = activation_document::create([
                    // 'resource_name' => $request->resource_name,
                    'username' => 'activation',
                    'document_name' => $name,
                    'lead_id' => $data->id,
                    'activation_id' => $data->id,
                    'status' => '1.02',
                    // 'batch_id' => $batch_id,
                ]);
            }
        }
        return $data;
    }
    public function leadrejectelife(Request $request)
    {
        // return $request;
        $d = elife_sale::findorfail($request->ver_id);
        $d->status = '1.04';
        $d->remarks = $request->reject_comment_new;
        $d->save();
        notify()->success('Lead Succesfully rejected');
        // return 1;
        return redirect(route('home'));
    }
    //
    public static function sale_count($saler_id,$status,$channel){
        // return $saler_id . $status;
        $journalName = str_replace('-', ' ', $channel);
        return $data = elife_sale::where('saler_id',$saler_id)->where('status',$status)->where('sale_type', $journalName)->get()->count();
    }
    public static function MyAvailableBalance(){
        // return $saler_id . $status;
        return $data = userwaller::select('userwallers.id', 'userwallers.name', 'userwallers.userid', 'users.name as username', 'userwallers.amount')
        ->Join(
            'users',
            'users.id',
            'userwallers.userid'
        )
        ->where('userid', auth()->user()->id)
        // ->get()
        ->sum('userwallers.amount');
    }
    public function MyWallet(Request $request){
        $data = userwaller::select('userwallers.id', 'userwallers.name', 'userwallers.userid', 'users.name as username', 'userwallers.amount')
        ->Join(
            'users',
            'users.id',
            'userwallers.userid'
        )
        ->where('userid',auth()->user()->id)
        ->get();
        // $data = userwaller::where('userid',auth()->user()->id)->get();
        return view('dashboard.view-wallet-data',compact('data'));
    }


}
