<?php

namespace App\Http\Controllers;

use App\dataentry;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DataController extends Controller
{
    //
    public function add_saler_data(Request $request){
        // add - saler - data
        // return "ZOom";
        return view('dashboard.add-saler-data');
    }
    public function saler_data(Request $request){
        $data = dataentry::where('userid',auth()->user()->id)->get();
        return view('dashboard.view-saler-data',compact('data'));
    }
    public static function mydailylead($userid){
        return $data = dataentry::where('userid',$userid)
        ->whereDate('created_at', Carbon::today())
        ->get()->count();
    }
    public static function myweeklylead($userid){
        return $data = dataentry::where('userid',$userid)
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get()->count();
    }
    public static function mymonthlylead($userid){
        return $data = dataentry::where('userid',$userid)
        ->whereMonth('created_at', Carbon::now()->month)
        ->get()->count();
    }
    public static function MyAllLead($userid){
        return $data = dataentry::where('userid',$userid)->get()->count();
    }
    //
    public function saler_store(Request $request){
        $validatedData = Validator::make($request->all(), [
            'company_name' => 'required',
            'authorized_person' => 'required',
            'company_number' => 'required',
            'email' => 'required',
            'company_address' => 'required',
            'remarks' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
                $ipaddress =   $request->ip();
        if($ipaddress == '127.0.0.1'){
            // $lng =   $details->lng;
            $location = '0';
        }else{

             $ipaddress =   $request->ip();
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ipaddress}"));
            $location =   $details->loc;
        }
        //
        $data = dataentry::create([
            'company_name' => $request->company_name,
            'authorize_person_name' => $request->authorized_person,
            'authorize_person_number' => $request->authorize_person_number,
            'company_number' => $request->company_number,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'remarks' => $request->remarks,
            'location' => $location,
            'conversion' => '1',
            'userid'=> auth()->user()->id,
        ]);
        //
        // return
        notify()->success('Data Added Succesfully');
        return response()->json(['success' => 'Data Added Succesfully']);


    }
}
