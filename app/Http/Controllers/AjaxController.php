<?php

namespace App\Http\Controllers;

use App\choosen_number;
use App\choosen_number_log;
use App\elife_plan;
use App\itproductplans;
use App\lead_sale;
use App\numberdetail;
use App\multisale;
use App\plan;
use App\remark;
use App\CustomerFeedBack;
use App\lead_location;
use App\choosen_number_location;
use App\customer_notification;
use App\elife_log;
use App\emirate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\MyEvent;
use App\status_code;
use App\timing_duration;
use App\User;
use App\verification_form;
use thiagoalessio\TesseractOCR\TesseractOCR;
// use werk365\IdentityDocuments\IdentityDocuments;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;
use Illuminate\Support\Facades\Session;




// use Request;


class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function MaroDikro($origin_lat,$origin_lng,$dest_lat,$dest_lng){
            $origin = $origin_lat . ',' . $origin_lng;
        // $destination = $dest_lat . ',' . $dest_lng;
            if (empty($dest_lat) || empty($dest_lng)) {
                return $destination = $dest_lat . ',' . $dest_lng;
            } else {
                return $destination = '23,23' . ',' .  '23,23';
            }
            $response = \GoogleMaps::load('distancematrix')
            ->setParam([
            'origins'          => $origin,
            'destinations'     => $destination,
            // 'mode' => 'driving' ,
            // 'language' => 'fr',

            ])->get();
            $res = json_decode($response);
            // dd($res);
            // dd($res['row);
            // return $res->rows->elements->duration;
            foreach($res->rows as $resp) {
            foreach($resp->elements as $dist) {
            //     // dd($dist->distance);
            // dd($dist);
            foreach($dist->duration as $dt){
            // dd($dt);
            $d = $dt;
            }
            foreach($dist->distance as $ds){
            // dd($ds);
            // echo $ds;
            echo $variable = substr($ds, 0, strpos($ds, "km"));

            // echo strtok($ds, 'KM');
            // foreach($ds['value'] as $dsf){
            //     echo $dsf;
            // }
            }


            }
            }
    }
    public static function passcode_fetch($number)
    {
        $l = numberdetail::where('number',$number)->first();
        // return $lead_id;
        return $l->passcode;
    }
    public static function total_time($first_date,$second_date){
        $t1 = Carbon::parse($first_date);
        $t2 = Carbon::parse($second_date);
        // return $diff = $t1->diff($t2);
        return $t1->diff($t2)->format('%H:%I:%S');


    }
    public function numbersystem($slug){
        // return $slug;
        if (auth()->user()->role == 'NumberSuperAdmin' || auth()->user()->role == 'Manager') {
            // return "boom";
            // return auth()->user()->agent_code;
            $emirates = emirate::all();
            $data = numberdetail::select("numberdetails.*", "choosen_numbers.id as cid", "users.name", "choosen_numbers.created_at as datetime")
            ->Join(
                'choosen_numbers',
                'choosen_numbers.number_id',
                '=',
                'numberdetails.id'
            )
            ->Join(
                'users',
                'users.id',
                '=',
                'choosen_numbers.user_id'
            )
            ->where("numberdetails.status", 'Reserved')
            ->where('numberdetails.channel_type', $slug)
            ->where("choosen_numbers.agent_group", auth()->user()->agent_code)
            // ->where("","")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            // ->where("choosen_numbers.user_id", $request->simtype)
            // ->where("numberdetails.type", $request->simtype)
            // ->where("numberdetails.status", 'Available')
            // ->groupBy('numberdetails.type')
            ->get();
            return view('number.number-dtl-user', compact('data', 'emirates','slug'));
        } else if (auth()->user()->role == 'NumberVerification') {
            $data = numberdetail::select("numberdetails.*", "choosen_numbers.id as cid", "users.name", "choosen_numbers.created_at as datetime", "users.agent_code as UserAgentGroup")
            ->Join(
                'choosen_numbers',
                'choosen_numbers.number_id',
                '=',
                'numberdetails.id'
            )
            ->Join(
                'users',
                'users.id',
                '=',
                'choosen_numbers.user_id'
            )
            ->where("choosen_numbers.status", 4)
            ->where('numberdetails.channel_type', $slug)
            ->where("choosen_numbers.agent_group", '!=', 'ARF')
            // ->where("","")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            // ->where("choosen_numbers.user_id", $request->simtype)
            // ->where("numberdetails.type", $request->simtype)
            // ->where("numberdetails.status", 'Available')
            // ->groupBy('numberdetails.type')
            ->get();
            return view('number.number-ver-user', compact('data', 'slug'));
        } else if (auth()->user()->role == 'NumberCord') {
            $data = numberdetail::select("numberdetails.*", "choosen_numbers.id as cid", "users.name", "choosen_numbers.created_at as datetime", "users.agent_code as UserAgentGroup")
            ->Join(
                'choosen_numbers',
                'choosen_numbers.number_id',
                '=',
                'numberdetails.id'
            )
            ->Join(
                'users',
                'users.id',
                '=',
                'choosen_numbers.user_id'
            )
            ->where("choosen_numbers.status", 4)
            ->where('numberdetails.channel_type', $slug)
            ->where("choosen_numbers.agent_group", '!=', 'ARF')
            // ->where("","")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            // ->where("choosen_numbers.user_id", $request->simtype)
            // ->where("numberdetails.type", $request->simtype)
            // ->where("numberdetails.status", 'Available')
            // ->groupBy('numberdetails.type')
            ->get();
            return view('number.number-cord-user', compact('data','slug'));
        } else if (auth()->user()->role == 'NumberActivation') {
            return view('number.number-activation');
        } else {


            //
            $q = numberdetail::select("numberdetails.type")
                // ->where("remarks.user_agent_id", auth()->user()->id)
                // ->where("numberdetails.id", $request->id)
                ->where("numberdetails.status", 'Available')
                ->where('numberdetails.channel_type', $slug)
                ->groupBy('numberdetails.type')
                ->get();
            //
            // $data = numberdetail::;
            return view('number.number-dtl', compact('q','slug'));
        }
    }
    // public function ClientIp(Request $request){

    //         // Gettingip address of remote user
    //         return $user_ip_address=$request->ip();

    // }
    public function AcceptLead(Request $request){
        // return $request;
        $d = timing_duration::select('id')
        ->where('lead_no',$request->lead_id)
        ->first();
        $data  = timing_duration::findorfail($d->id);
        $data->lead_accept_time = Carbon::now()->toDateTimeString();
        $data->save();
        return '1';

    }
    public function CheckPendingLead(request $request){
        // return $request;
        // return auth()->user()->id;
         $d = customer_notification::select("customer_notifications.id")
            ->where('userid',auth()->user()->id)
            ->count();
            if($d > 0){
                notify()->success('you have pending leads, please proceed');
            }
            return $d;
    }
    public function checkNumData(request $request){
        // return $request;
       return $dataNum = choosen_number::select("choosen_numbers.id")
        // ->where("remarks.user_agent_id", auth()->user()->id)
        ->where("choosen_numbers.user_id", auth()->user()->id)
        ->where("choosen_numbers.status", 1)
            // ->where("numberdetails.status", 'Available')
        ->count();
    }
    public function CheckPackageName(Request $request){
        // return $request;
         $d = numberdetail::select("numberdetails.type")
        ->where("numberdetails.number",$request->number)
        ->first();
        return $d->type;
        // return $d->type;
    }
    public function NumberByType(Request $request){
        // return $request;
        if(auth()->user()->role == 'ARF')
        {
            return $data = numberdetail::select("numberdetails.*")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            // ->where("numberdetails.id", $request->id)
            // ->where("numberdetails.type", $request->simtype)
            ->where("numberdetails.status", 'Available')
            ->where("numberdetails.channel_type", 'OCP1')
                // ->groupBy('numberdetails.type')
            ->get();
            //
            // $data = numberdetail::wherestatus('Available')->get();
            return view('number.number-dtl-fetch', compact('data'));
        }
        else if($request->simtype == 'All'){
            $data = numberdetail::select("numberdetails.*")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            // ->where("numberdetails.id", $request->id)
            // ->where("numberdetails.type", $request->simtype)
            ->where("numberdetails.status", 'Available')
            ->where("numberdetails.channel_type", $request->partner)
            // ->groupBy('numberdetails.type')
            ->get();
            //
            // $data = numberdetail::wherestatus('Available')->get();
            return view('number.number-dtl-fetch', compact('data'));
        }
        else{

            $data = numberdetail::select("numberdetails.*")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            // ->where("numberdetails.id", $request->id)
            ->where("numberdetails.type", $request->simtype)
            ->where("numberdetails.channel_type", $request->partner)
            ->where("numberdetails.status", 'Available')
            // ->groupBy('numberdetails.type')
            ->get();
            //
            // $data = numberdetail::wherestatus('Available')->get();
            return view('number.number-dtl-fetch', compact('data'));
        }
    }
    public function NumberByType2(Request $request){
        // return $request;
        // return "Salman";
        if($request->simtype == 'Active')
        {
            // return auth()->user()->agent_code;
            if(auth()->user()->agent_code == 'ARF'){
                $data = numberdetail::select("numberdetails.*","choosen_numbers.agent_group")
                    // ->where("remarks.user_agent_id", auth()->user()->id)
                    // ->where("numberdetails.id", $request->id)
                    ->Join(
                        'choosen_numbers',
                        'choosen_numbers.number_id',
                        '=',
                        'numberdetails.id'
                    )
                    ->where("choosen_numbers.agent_group", auth()->user()->agent_code)
                    ->where("numberdetails.status", $request->simtype)
                    // ->where("numberdetails.status", 'Available')
                    // ->groupBy('numberdetails.type')
                    ->get();
                //
                // $data = numberdetail::wherestatus('Available')->get();
                return view('number.number-dtl-report', compact('data'));
            }
            else{
                $data = numberdetail::select("numberdetails.*","choosen_numbers.agent_group","users.name")
                    // ->where("remarks.user_agent_id", auth()->user()->id)
                    // ->where("numberdetails.id", $request->id)
                    ->LeftJoin(
                        'choosen_numbers',
                        'choosen_numbers.number_id',
                        '=',
                        'numberdetails.id'
                    )
                    ->Join(
                        'users',
                        'users.id',
                        '=',
                        'choosen_numbers.user_id'
                    )
                    // ->where("choosen_numbers.agent_group", auth()->user()->agent_code)
                    ->where("numberdetails.status", $request->simtype)
                    // ->where("numberdetails.status", 'Available')
                    // ->groupBy('numberdetails.type')
                    ->get();
                //
                // $data = numberdetail::wherestatus('Available')->get();
                return view('number.number-dtl-report', compact('data'));
            }
        }
        else if($request->simtype == 'Hold'){

           $data = numberdetail::select("numberdetails.*","choosen_numbers.agent_group","users.*", "choosen_numbers.id as cid")
                    // ->where("remarks.user_agent_id", auth()->user()->id)
                    // ->where("numberdetails.id", $request->id)
                    ->LeftJoin(
                        'choosen_numbers',
                        'choosen_numbers.number_id',
                        '=',
                        'numberdetails.id'
                    )
                    ->Join(
                        'users',
                        'users.id',
                        '=',
                        'choosen_numbers.user_id'
                    )
                    ->where("choosen_numbers.agent_group", auth()->user()->agent_code)
                    ->where("numberdetails.status", $request->simtype)
                    // ->where("numberdetails.status", 'Available')
                    // ->groupBy('numberdetails.type')
                    ->get();
                //
                // $data = numberdetail::wherestatus('Available')->get();
                return view('number.number-dtl-report', compact('data'));
        }
        else if($request->simtype == 'Available'){

            $data = numberdetail::select("numberdetails.*")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            // ->where("numberdetails.id", $request->id)
            ->where("numberdetails.status", $request->simtype)
            // ->where("numberdetails.status", 'Available')
            // ->groupBy('numberdetails.type')
            ->get();
        //
        // $data = numberdetail::wherestatus('Available')->get();
        return view('number.number-dtl-report', compact('data'));
        }
        else if($request->simtype == 'Reserved'){
            // return $request->simtype;
            $data = numberdetail::select("numberdetails.*","choosen_numbers.agent_group")
                    // ->where("remarks.user_agent_id", auth()->user()->id)
                    // ->where("numberdetails.id", $request->id)
                    ->Join(
                        'choosen_numbers',
                        'choosen_numbers.number_id',
                        '=',
                        'numberdetails.id'
                    )
                    ->where("choosen_numbers.agent_group", auth()->user()->agent_code)
                    ->where("numberdetails.status", $request->simtype)
                    // ->where("numberdetails.status", 'Available')
                    // ->groupBy('numberdetails.type')
                    ->get();
                //
                // $data = numberdetail::wherestatus('Available')->get();
                return view('number.number-dtl-report', compact('data'));
        }

    }
    public function ReservedNum(Request $request){
        // return $request;
             $data = numberdetail::select("numberdetails.*","choosen_numbers.id as cid", "choosen_numbers.created_at as datetime")
            ->Join(
                'choosen_numbers',
                'choosen_numbers.number_id',
                '=',
                'numberdetails.id'
            )
                // ->where("","")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            ->where("choosen_numbers.status",1)
            ->where("numberdetails.book_type",0)
            ->where("numberdetails.channel_type",$request->partner)
            ->where("choosen_numbers.user_id", $request->simtype)
            // ->where("numberdetails.type", $request->simtype)
            // ->where("numberdetails.status", 'Available')
            // ->groupBy('numberdetails.type')
            ->get();
        //
        // $data = numberdetail::wherestatus('Available')->get();
        return view('number.number-dtl-rcvd', compact('data'));
    }
    //
    public function ChatPost(Request $request){
        // return $request;
        // return $data = $request->saler_id;
        remark::create([
            'remarks' => $request->remarks,
            'lead_status' => '0',
            'lead_id' => $request->id,
            'lead_no' => $request->id,
            'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => auth()->user()->name,
            'user_agent_id' => auth()->user()->id,
        ]);
        // return
        // return auth()->user()->id;
        $data =
        remark::select("remarks.*")
        // ->where("remarks.user_agent_id", auth()->user()->id)
        ->where("remarks.lead_id", $request->id)
        ->get();
        $remarks = 'Lead ID: ' . $request->id . '<br> Message: ' . $request->remarks;
        // @role('sale')
        if(auth()->user()->role != 'sale')
        event(new MyEvent($remarks, $request->saler_id,$request->id));
        // else
        return view('chat.chat',compact('data'));
    }
    public function ajaxRequest()
    {
        return view('ajaxRequest');
    }
    public function PlanType(Request $request){
        // return $request;
        $users = plan::select("plans.id", "plans.plan_name")
            // $user =  DB::table("subjects")->select('subject_name', 'id')

            ->where('plans.plan_category', $request['id'])
            ->get();
        $collection = collect($users);
        $abcd =  $collection->pluck('plan_name', 'id');
        return response()->json($abcd, 200);
    }
    public function ajaxRequestPost(Request $request)
    {
        $ajaxName = $request['ajaxName'];
        // return $ajaxName;
        if($ajaxName == 'PlanFetch'){
            // return $request['plan_name'];
            $plan = plan::whereid($request->plan_name)->get();
            // return json($plan);
            return $plan;
        }
        else if($ajaxName == 'ElifePlanFetch'){
            $plan = elife_plan::whereid($request->plan_name)->get();
            // return json($plan);
            return $plan;
        }
        // $input = $request->all();
        // \Log::info($input);

        // return response()->json(['success' => 'Got Simple Ajax Request.']);
    }
    public function ajaxRequestItPost(Request $request)
    {
        // $ajaxName = $request['ajaxName'];
        // // return $ajaxName;
        // return $request->id;
        // if($ajaxName == 'PlanFetch'){
        //     // return $request['plan_name'];
        //  $plan = itproductplans::wheretype($request->id)->get();
            $plan = itproductplans::select("itproductplans.id", "itproductplans.name")
                    ->where("itproductplans.type",$request->id)
                    ->get();
            $collection = collect($plan);
            $abcd =  $collection->pluck('name', 'id');

            return response()->json($abcd, 200);
            // return json($plan);

        // return response()->json(['success' => 'Got Simple Ajax Request.']);
    }
    public function ajaxRequestItPlan(Request $request)
    {
            $plan = itproductplans::select("itproductplans.pricing", "itproductplans.description")
                    ->where("itproductplans.id",$request->id)
                    ->get();
            $collection = collect($plan);
            $abcd =  $collection->pluck('pricing', 'description');
            return response()->json($abcd, 200);

    }
    public function dataAjax(Request $request)
    {
    if($request->id == 'my'){
            $data = [];

            if ($request->has('q')) {
                $search = $request->q;
                $data = numberdetail::select("number", "number")
                    ->Join(
                        'choosen_numbers',
                        'choosen_numbers.number_id',
                        '=',
                        'numberdetails.id'
                    )
                    ->where('number', 'LIKE', "%$search%")
                    ->where('user_id', auth()->user()->id)
                    ->where('channel_type', $request->pid)
                    ->where('book_type', 0)
                    // ->where('lead_sales.selected_number','=!', $search)
                    // ->where('type', $request->id)
                    // ->where('numstatus','Available')
                    ->get();
            }
            return response()->json($data);
    }
    else{
            $dataNum = choosen_number::select("choosen_numbers.id")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            ->where("choosen_numbers.user_id", auth()->user()->id)
            ->where("choosen_numbers.status", 1)
            // ->where("numberdetails.status", 'Available')
            ->count();
        if ($dataNum <= 10) {
            $data = [];

            if ($request->has('q')) {
                $search = $request->q;
                $data = numberdetail::select("number", "number")
                    // ->Join(
                    //     'choosen_numbers',
                    //     'choosen_numbers.number_id',
                    //     '=',
                    //     'numberdetails.id'
                    // )
                    ->where('number', 'LIKE', "%$search%")
                    // ->where('user_id', auth()->user()->id)
                    ->where('channel_type', $request->pid)
                    ->where('type', $request->id)
                    ->where('status', 'Available')
                    ->get();
            }
            return response()->json($data);
        }

    }
    }
    public function SaleReport(request $request){
        // return $request;
        $reportName = $request->reportName;
        $userId = $request->userid;
        return view('dashboard.sale.sale-report',compact('reportName','userId'));
    }
    public function DtlReport(request $request){
        // return $request;
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
        ->where('status_codes.status_name', $request->reportName)
        ->where('lead_sales.lead_type', $request->ProductType)
        ->where('lead_sales.saler_id', $request->userid)
        ->get();
        // $reportName = $request->reportName;
        // $userId = $request->userid;
        return view('dashboard.sale.sale-dtl',compact('operation'));
    }
    public function ReportByDay(request $request){
        // return $date = Carbon::now()->startOfDay;
        // return $request;
        if (auth()->user()->role == 'Manager') {
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
                ->Join(
                    'users',
                    'users.id',
                    '=',
                    'lead_sales.saler_id'
                )
                // ->where('users.id', $request['userid'])
                ->where('lead_sales.lead_type', $request['simtype'])
                ->where('status_codes.status_name', $request['status'])
                ->where('users.agent_code', auth()->user()->agent_code)
                ->whereBetween('lead_sales.date_time', [$request['start'], $request['end']])
                // ->where('lead_salses.date_time', '>=', $request['start'])
                // ->where('lead_sales.date_time', '>=', $request['end'])
                ->get();
            return view('ajax.ajax', compact('operation'));
        } else if (auth()->user()->role == 'Admin' || auth()->user()->role == 'SuperAdmin') {
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
                ->Join(
                    'users',
                    'users.id',
                    '=',
                    'lead_sales.saler_id'
                )
                // ->where('users.id', $request['userid'])
                ->where('lead_sales.lead_type', $request['simtype'])
                ->where('status_codes.status_name', $request['status'])
                ->whereBetween('lead_sales.date_time', [$request['start'], $request['end']])
                // ->where('lead_salses.date_time', '>=', $request['start'])
                // ->where('lead_sales.date_time', '>=', $request['end'])
                ->get();
            return view('ajax.ajax', compact('operation'));
        }


    }
    public function report(Request $request){
        // return "boom boom";
        // return $request->userid;
        // return $request['start'];
        $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*","status_codes.status_name")
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
            ->Join(
                'users',
                'users.id',
                '=',
                'lead_sales.saler_id'
            )
            ->where('users.id', $request['userid'])
            ->where('lead_sales.status', $request['reportName'])
            ->get();
        return view('ajax.ajax',compact('operation'));
    }
    public function ChannelReport(Request $request){
        // return "boom boom";
        // return $request->userid;
        // return $request['start'];

        $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*","status_codes.status_name")
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
            ->Join(
                'users',
                'users.id',
                '=',
                'lead_sales.saler_id'
            )
            ->where('users.id', $request['userid'])
            ->where('lead_sales.status', $request['reportName'])
            ->where('lead_sales.channel_type', $request['type'])
            ->get();
        return view('ajax.ajax',compact('operation'));
    }
    public function BookNum(request $request){
        // return $request;
        if(auth()->user()->agent_code == 'ARF')
        {
            $ct = 5;
        }
        else{
            $ct = 10;
        }
        $data = numberdetail::select("numberdetails.id")
        // ->where("remarks.user_agent_id", auth()->user()->id)
        ->where("numberdetails.id", $request->id)
        ->where("numberdetails.status", 'Available')
        ->count();
        $dataNum = choosen_number::select("choosen_numbers.id")
        ->Join(
            'numberdetails','numberdetails.id','=','choosen_numbers.number_id'
        )
        // ->where("remarks.user_agent_id", auth()->user()->id)
        ->where("choosen_numbers.user_id", auth()->user()->id)
        ->where("numberdetails.status", 'Reserved')
        ->where('numberdetails.book_type','0')
        ->where("numberdetails.channel_type", $request->Channel)

        // ->where("numberdetails.status", 'Available')
        ->count();
        if($data < 1){
            notify()->error('Number Already Reserved');
            return 0;
        }
        else if($ct > $dataNum){
            $d = numberdetail::findorfail($request->id);
            $d->status = 'Reserved';
            $d->save();
            $k = choosen_number::create([
                'number_id' => $request->id,
                'user_id' => auth()->user()->id,
                'status' => '1',
                'agent_group' => auth()->user()->agent_code,
                // 'ip_address' => Request::ip(),
                'date_time' => Carbon::now()->toDateTimeString(),
            ]);
            $log = choosen_number_log::create([
                // 'number'
                'number_id' => $request->id,
                'user_id' => auth()->user()->id,
                'agent_group' => auth()->user()->agent_code,
            ]);
            notify()->success('Number Succesfully Reserved');
            return 1;
        }
        else if($dataNum >= $ct)
        {
            // "error";
            notify()->error('You Already Cross Limit, please revive old');
            return 2;
        }


    }
    public function leadreject(Request $request){
        // return $request;
        $d = elife_sale::findorfail($request->lead_id);
        $d->status = '1.15';
        $d->remarks = $request->reject_comment_new;
        $d->save();
        $de = verification_form::findorfail($request->ver_id);
        $de->status = '1.15';
        $de->save();

        $k = numberdetail::where('number',$d->selected_number)
        ->first();
        // $k->id;
        $dj= numberdetail::findorfail($k->id);
        $dj->status = 'Reserved';
        $dj->book_type = '0';
        $dj->save();
        // return $dj->id;
        $dek = choosen_number::where('number_id',$dj->id)->first();
        // return $dek->id;;
        if($dek){
            $dej = choosen_number::findorfail($dek->id);
            $dej->status = '1';
            // $de->delete();
            $dej->save();
        }
        // return "b";
        // $d->save();
        // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Lead Succesfully rejected');
        // return 1;
        return redirect(route('verification.final-cord-lead'));
    }
    public function CordinationFollow(Request $request){
        // return $request;
        $d = lead_sale::findorfail($request->lead_id);
        $d->status = '1.16';
        $d->remarks = $request->followup_remarks . 'By ' . auth()->user()->id;
        $d->save();
        $de = verification_form::findorfail($request->ver_id);
        $de->status = '1.16';
        $de->save();
        // $d->save();
        // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Lead Succesfully Follow up');
        // return 1;
        return redirect(route('verification.final-cord-lead'));
    }
    public function ActivationFollow(Request $request){
        // return $request;
        $d = lead_sale::findorfail($request->lead_id);
        $d->status = '1.17';
        $d->remarks = $request->followup_remarks . 'By ' . auth()->user()->id;
        $d->save();
        $de = verification_form::findorfail($request->ver_id);
        $de->status = '1.17';
        $de->save();
        // $d->save();
        // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Lead Succesfully Follow up');
        // return 1;
        return redirect(route('activation.index'));
    }
    public function RevNum(request $request){
        // return $request;
        // $data = numberdetail::select("numberdetails.id")
        // // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
        // ->where("numberdetails.status", 'Available')
        // ->count();
        // if($data == 1){
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Available';
        $d->save();
        $de = choosen_number::findorfail($request->cid);
        // $d->status = 'Available';
        $de->delete();
        // $d->save();
        // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Number Succesfully Retrive');
        return 1;
        // }
        // notify()->error('Number Already Reserved');
        // return 0;

    }
    public function RevNum2(request $request){
        // return $request;
        // $data = numberdetail::select("numberdetails.id")
        // // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
        // ->where("numberdetails.status", 'Available')
        // ->count();
        // if($data == 1){
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Available';
        $d->save();
        // $de = choosen_number::findorfail($request->cid);
        // // $d->status = 'Available';
        // $de->delete();
        // $d->save();
        // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Number Succesfully Retrive');
        return 1;
        // }
        // notify()->error('Number Already Reserved');
        // return 0;

    }
    public function HoldNum(request $request){
        //    HOLD NUMBER
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Hold';
        $d->save();
        $de = choosen_number::findorfail($request->cid);
        $de->status = '4';
        $de->save();

        notify()->success('Number Succesfully Forward');
        return 1;

        // HOLD NUMBER 4

    }
    public function AssignLead(request $request){
        //    HOLD NUMBER
        // return $request;
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Forward';
        $d->save();
        $de = choosen_number::findorfail($request->cid);
        $de->status = '5';
        $de->save();
        choosen_number_location::create([
            'lead_id' => $request->cid,
            'location_url' => $request->google_url,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'status' => 1,
        ]);
        notify()->success('Number Succesfully Assign');
        return 1;



        // HOLD NUMBER 4

    }
    // 55.3832735
    // 25.2778584
    public function NumberActivation(request $request){
        // return $request;
        //
        if(auth()->user()->role == 'SpecialActivation'){
            // $operation = multisale
            // return "Multi Sale";
            $operation = multisale::select('multisales.*')
                ->LeftJoin(
                'status_codes',
                'status_codes.status_code',
                '=',
                'multisales.status')
                ->where('multisales.status','1.20')
                ->get();

            // $operation = verification_form::select("verification_forms.lead_no", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "status_codes.status_name", "lead_locations.lat", "lead_locations.lng")
            //    // $user =  DB::table("subjects")->select('subject_name', 'id')
            // //    ->Join(
            // //        'timing_durations',
            // //        'timing_durations.lead_no',
            // //        '=',
            // //        'verification_forms.lead_no'
            // //    )
            //    ->Join(
            //        'lead_sales',
            //        'lead_sales.id',
            //        '=',
            //        'verification_forms.lead_no'
            //    )
            //    ->Join(
            //        'remarks',
            //        'remarks.lead_no',
            //        '=',
            //        'verification_forms.lead_no'
            //    )
            //    ->Join(
            //        'status_codes',
            //        'status_codes.status_code',
            //        '=',
            //        'verification_forms.status'
            //    )
            //    ->Join(
            //        'lead_locations',
            //        'lead_locations.lead_id',
            //        '=',
            //        'verification_forms.lead_no'
            //    )
            //    ->where('verification_forms.status', '1.10')
            //    ->where('lead_locations.assign_to', auth()->user()->id)
            //    ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
            //    // ->where('verification_forms.emirate_location', auth()->user()->emirate)
            //    ->groupBy('verification_forms.lead_no')
            //    // -order('updated_at', 'desc')
            //    ->latest()
            //    ->get();
           // ->get();
            $user_lat = $request->lat;
            $user_lng = $request->lng;
            // $user_lat = '23'; $user_lng = '23';
           return view('number.number-list-activation', compact('operation','user_lat','user_lng'));
        }
        else{
            $operation = verification_form::select("verification_forms.lead_no", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "status_codes.status_name", "lead_locations.lat", "lead_locations.lng")
               // $user =  DB::table("subjects")->select('subject_name', 'id')
               ->Join(
                   'timing_durations',
                   'timing_durations.lead_no',
                   '=',
                   'verification_forms.lead_no'
               )
               ->Join(
                   'lead_sales',
                   'lead_sales.id',
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
               ->Join(
                   'lead_locations',
                   'lead_locations.lead_id',
                   '=',
                   'verification_forms.lead_no'
               )
               ->where('verification_forms.status', '1.10')
               ->where('lead_locations.assign_to', auth()->user()->id)
               ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
               // ->where('verification_forms.emirate_location', auth()->user()->emirate)
               ->groupBy('verification_forms.lead_no')
               // -order('updated_at', 'desc')
               ->latest()
               ->get();
           // ->get();
           $user_lat = $request->lat;
           $user_lng = $request->lng;
           return view('number.number-list-activation', compact('operation','user_lat','user_lng'));

        }
        // return view('')
        // return auth()->user()->emirate;
        //    $data = numberdetail::select("numberdetails.*", "choosen_numbers.id as cid", "users.name", "choosen_numbers.created_at as datetime","users.agent_code as UserAgentGroup")
        //         ->Join(
        //             'choosen_numbers',
        //             'choosen_numbers.number_id',
        //             '=',
        //             'numberdetails.id'
        //         )
        //         ->Join(
        //             'users',
        //             'users.id',
        //             '=',
        //             'choosen_numbers.user_id'
        //         )
        //         ->Join(
        //             'choosen_number_locations',
        //             'choosen_number_locations.lead_id',
        //             '=',
        //             'choosen_numbers.id'
        //         )
        //         // ->where("choosen_numbers.status", 4)
        //         ->where("choosen_number_locations.emirate",auth()->user()->emirate)
        //         ->where("choosen_numbers.agent_group",'!=','ARF')
        //         // ->where("","")
        //         // ->where("remarks.user_agent_id", auth()->user()->id)
        //         // ->where("choosen_numbers.user_id", $request->simtype)
        //         // ->where("numberdetails.type", $request->simtype)
        //         // ->where("numberdetails.status", 'Available')
        //         // ->groupBy('numberdetails.type')
        //         ->get();
    }
    public function VerifyNum(request $request){
        // return $request;
        // $data = numberdetail::select("numberdetails.id")
        // // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
        // ->where("numberdetails.status", 'Available')
        // ->count();
        // if($data == 1){
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Active';
        $d->save();
        $de = choosen_number::findorfail($request->cid);
        $de->status = '2';
        // $de->delete();
        $de->save();
        // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Number Succesfully Active and Removed from the list');
        return 1;
        // }
        // notify()->error('Number Already Reserved');
        // return 0;

    }
    public function reject(request $request){
        // return $request;
        // $data = numberdetail::select("numberdetails.id")
        // // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
        // ->where("numberdetails.status", 'Available')
        // ->count();
        // if($data == 1){
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Reserved';
        $d->save();
        $de = choosen_number::findorfail($request->cid);
        $de->status = '1';
        // $de->delete();
        $de->save();
        // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Number Succesfully Reject');
        return 1;
        // }
        // notify()->error('Number Already Reserved');
        // return 0;

    }
    public function ManagerReject(request $request){
        // return $request;
        // $data = numberdetail::select("numberdetails.id")
        // // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
        // ->where("numberdetails.status", 'Available')
        // ->count();
        // if($data == 1){
        $lead_sale = lead_sale::select('lead_sales.*')
        ->Join(
            'numberdetails',
            'numberdetails.number',
            '=',
            'lead_sales.selected_number'
        )
        ->where('numberdetails.id',$request->id)
        ->where('lead_sales.status','!=','1.02')
        ->first();
        if (!empty($lead_sale)) {
            $ls = lead_sale::findorfail($lead_sale->id);
            $ls->status = '1.04';
            $ls->device = $request->id;
            $ls->selected_number = '';
            $ls->remarks = $request->remarks;
            $ls->save();

             $ks = verification_form::where('lead_no',$lead_sale->id)->count();
            if(!empty($ks)){
                 $ks = verification_form::where('lead_no',$lead_sale->id)->update(['status'=>'1.04']);
            }
            // return "s";

            remark::create([
                'remarks' => $request->remarks,
                'lead_status' => '1.04',
                'lead_id' => $lead_sale->id,
                'lead_no' => $lead_sale->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            $d = numberdetail::findorfail($request->id);
            $d->status = 'Reserved';
            $d->book_type = '0';
            $d->save();
            $de = choosen_number::findorfail($request->cid);
            $de->status = '1';
            // $de->delete();
            $de->save();
            // $k = choosen_number::create([
            //     'number_id' => $request->id,
            //     'user_id' => auth()->user()->id,
            //     'status' => '1',
            //     'agent_group' => auth()->user()->agent_code,
            // ]);
            notify()->success('Number Succesfully Reject with lead');
            return 1;
        }
        else{
            $d = numberdetail::findorfail($request->id);
            $d->status = 'Reserved';
            $d->book_type = '0';
            $d->save();
            $de = choosen_number::findorfail($request->cid);
            $de->status = '1';
            // $de->delete();
            $de->save();
            return "1";

        }
        // }
        // notify()->error('Number Already Reserved');
        // return 0;

    }

    public function LeadReAssign(request $request){
        // return $request;
        // $plan = lead_sale::findorfail($request->lead_id);
        // $plan = verification_form::where('lead_no',$request->lead_id)->first();

        $plan2 = verification_form::findorfail($request->ver_id);
        $p3 = lead_location::where('lead_id',$plan2->lead_no)->first();
        $p4 = lead_location::findorfail($p3->id);

        $plan2->update([
            'assing_to' => $request->assing_to,
        ]);


        $p4->update([
            'assign_to' => $request->assing_to,
        ]);
        // return $p4;
        // return $plan2;
        notify()->success('Lead re assinging done');
        // return redirect()->back();
        return "1";
        // ->update(['assing_to',$request->assing_to]);

    }
    public function VerifyNum2(request $request){
        // return $request;
        // $data = numberdetail::select("numberdetails.id")
        // // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
        // ->where("numberdetails.status", 'Available')
        // ->count();
        // if($data == 1){
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Active';
        $d->save();
        // $de = choosen_number::findorfail($request->cid);
        // $de->status = '2';
        // // $de->delete();
        // $de->save();
        // // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Number Succesfully Removed');
        return 1;
        // }
        // notify()->error('Number Already Reserved');
        // return 0;

    }
    public function ShowGroupLeads($id,$channel){
        if ($id == 'reject') {
            if (Auth()->user()->role == 'Elife Manager') {
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
                    ->Join(
                        'users',
                        'users.id',
                        '=',
                        'lead_sales.saler_id'
                    )
                    // ->where('lead_sales.status', '1.06')
                    ->where('users.agent_code', auth()->user()->agent_code)
                    ->where('lead_sales.channel_type', $channel)
                    ->whereIn('lead_sales.status', ['1.04', '1.15'])
                    ->get();
                // $operation = lead_sale::wherestatus('1.01')->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation'));
            } else {
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
                ->Join(
                    'users',
                    'users.id',
                    '=',
                    'lead_sales.saler_id'
                )
                // ->where('lead_sales.status', '1.06')
                ->where('users.agent_code', auth()->user()->agent_code)
                ->where('lead_sales.channel_type', $channel)
                ->whereIn('lead_sales.status', ['1.04', '1.15'])
                ->get();
                // $operation = lead_sale::wherestatus('1.01')->get();
                return view('dashboard.manager.mygrplead', compact('operation'));
            }
        }
         else if ($id == 'verified') {
            if (Auth()->user()->role == 'Elife Manager') {
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
                ->Join(
                    'users',
                    'users.id',
                    '=',
                    'lead_sales.saler_id'
                )
                // ->where('lead_sales.status', '1.06')
                ->where('users.agent_code', auth()->user()->agent_code)
                ->where('lead_sales.channel_type', $channel)
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10', '1.02'])
                ->get();
                // $operation = lead_sale::wherestatus('1.01')->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation'));
            }
            else{
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
                ->Join(
                    'users',
                    'users.id',
                    '=',
                    'lead_sales.saler_id'
                )
                // ->where('lead_sales.status', '1.06')
                ->where('users.agent_code', auth()->user()->agent_code)
                ->where('lead_sales.channel_type', $channel)
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10', '1.02'])
                ->get();
                // $operation = lead_sale::wherestatus('1.01')->get();
                return view('dashboard.manager.mygrplead', compact('operation'));
            }
        } else {
            if(auth()->user()->role == 'Manager' || auth()->user()->role == 'NumberSuperAdmin'){
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
                        ->Join(
                            'users',
                            'users.id',
                            '=',
                            'lead_sales.saler_id'
                        )
                        // ->where('lead_sales.status', '1.06')
                        ->where('users.agent_code', auth()->user()->agent_code)
                        ->where('lead_sales.channel_type', $channel)
                        ->where('lead_sales.status', $id)
                        ->get();
                    // $operation = lead_sale::wherestatus('1.01')->get();
                    return view('dashboard.manager.mygrplead', compact('operation'));
                }
                else if(Auth()->user()->role == 'Elife Manager'){

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
                    ->Join(
                        'users',
                        'users.id',
                        '=',
                        'lead_sales.saler_id'
                    )
                    // ->where('lead_sales.status', '1.06')
                    ->where('users.agent_code', auth()->user()->agent_code)
                    ->where('lead_sales.channel_type', $channel)
                    ->where('lead_sales.status', $id)
                    ->get();
                    return view('dashboard.manager.mygrpleadElife', compact('operation'));
                }
        }
    }
    public function VerifyNum22(request $request){
        // return $request;
        // $data = numberdetail::select("numberdetails.id")
        // // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
        // ->where("numberdetails.status", 'Available')
        // ->count();
        // if($data == 1){
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Active';
        $d->remarks = auth()->user()->id;
        $d->save();
        // $de = choosen_number::findorfail($request->cid);
        // $de->status = '2';
        // // $de->delete();
        // $de->save();
        // // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Number Succesfully Removed');
        return 1;
        // }
        // notify()->error('Number Already Reserved');
        // return 0;

    }
    public function Revert(request $request){
        // return $request;
        // $data = numberdetail::select("numberdetails.id")
        // // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
        // ->where("numberdetails.status", 'Available')
        // ->count();
        // if($data == 1){
        $d = numberdetail::findorfail($request->id);
        $d->status = 'Available';
        $d->save();
        $de = choosen_number::findorfail($request->cid);
        $de->status = '3';
        // $de->delete();
        $de->save();
        // $k = choosen_number::create([
        //     'number_id' => $request->id,
        //     'user_id' => auth()->user()->id,
        //     'status' => '1',
        //     'agent_group' => auth()->user()->agent_code,
        // ]);
        notify()->success('Number Succesfully Verified');
        return 1;
        // }
        // notify()->error('Number Already Reserved');
        // return 0;

    }
    public function otp(request $request){
        $data = customerFeedBack::findorfail($request->leadid);
        // $arr_sendRequest['user'] = '20091153';
        $sam = rand(0323,31231);
        $data->validation_code = $sam;
        $data->save();
        $arr_sendRequest['user'] = '20091153';
        $arr_sendRequest['pwd'] = "Core!5Core";
        $arr_sendRequest['number'] = '971'.substr($data->phone_number, 3) ;
        $arr_sendRequest['msg'] = "Your One Time OTP IS =>" . $sam;
        $arr_sendRequest['sender'] = "SMS Alert";
        $arr_sendRequest['language'] = "Unicode";
        $k = array($arr_sendRequest);
        $jon = json_encode($k);
        $url = 'https://mshastra.com/sendsms_api_json.aspx';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jon);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
         $result = curl_exec($ch);
        notify()->info('OTP RESEND SUCCESS');


    }
    public function vision(){
        return view('number.vision');
    }
    public function vision_sr(){
        return view('number.vision-sr');
    }
    public function vision_name(){
        return view('number.vision-name');
    }
    public function ocr_sr(Request $request){
        // return $request;
        if ($file = $request->file('front_img')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('front_img')));
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $name = $ext . '-' . $file->getClientOriginalName();
            // $name = Str::slug($name, '-');

            // $name1 = $ext . '-' . $file1->getClientOriginalName();
            // $name1 = Str::slug($name, '-');

            // $name2 = $ext . '-' . $file2->getClientOriginalName();
            // $name2 = Str::slug($name, '-');

            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $name);
            Session::put('sr_no', $name);//to put the session value
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");
            $gcvRequest = new GoogleCloudVision([$request],  env('GOOGLE_CLOUD_KEY'));
            //send annotation request
            $response = $gcvRequest->annotate();
            //  $string =  json_encode(["description" => $response->responses[0]->textAnnotations[0]->description]);
            // ech
            $string = $response->responses[0]->textAnnotations[0]->description;
            $string = preg_replace('/\s+/', ' ', $string) . '<br>';
            $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
            $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
            $regexJs = '#\\{Name:\\}(.+)\\{/Nationality\\}#s';

            foreach (explode(' ', $string) as $id) {
                // echo $id . '<br>';
                // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
                // print_r($matches);
                // }
                // preg_match($regex2, $id, $matches2);
                $expr = '#^[0-9\.:\-\/]+$#';
                if (preg_match($expr, $id, $match) == 1) {
                    echo '###' . $match[0];
                }
                else{
                    // echo ".";
                }

                // // if match, show VALID
                // if (count($matches2) == 1
                // ) {
                //     echo '###' . $id;
                // } else {
                //     // echo "{$id} INVALID</br>";
                // }
            }
            // echo $string['description'];
            // foreach (explode(' ', $string) as $id) {
            //     // echo $id . '<br>';
            //     preg_match($regex, $id, $matches);

            //     // // if match, show VALID
            //     if (count($matches) == 1) {
            //         // echo "SSS";
            //         // echo $matches['0'];
            //         echo '###' . "{$id}";
            //     }
            //     // else {
            //     //     // echo "{$string} INVALID</br>";
            //     // }
            // }
        }
        // if ($file = $request->file('front_img')) {
        //     $mytime = Carbon::now();
        //     $ext =  $mytime->toDateTimeString();
        //     $name = $ext . '-' . $file->getClientOriginalName();
        //     // $name = Str::slug($name, '-');

        //     // $name1 = $ext . '-' . $file1->getClientOriginalName();
        //     // $name1 = Str::slug($name, '-');

        //     // $name2 = $ext . '-' . $file2->getClientOriginalName();
        //     // $name2 = Str::slug($name, '-');

        //     // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
        //     $file->move('img', $name);
        //     $input['path'] = $name;
        //     $k = (new TesseractOCR('img/' . $name))
        //         // ->digits()
        //         // ->hocr()
        //         // ->quiet()
        //         //
        //         // ->tsv()

        //         // ->pdf()

        //         // ->lang('eng', 'jpn', 'spa')
        //         // ->whitelist(range('A', 'Z'))
        //         // ->whitelist(range(0,9,'-'))
        //         ->whitelist(range(0,9), ' /:')

        //         ->run();
        //     $string = rtrim($k);
        //      $string = preg_replace('/\s+/', ' ', $k);
        //     $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        //     foreach (explode(' ', $string) as $id) {
        //         // echo $id . '<br>';
        //         // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
        //         // print_r($id);
        //         // }
        //         if(strlen($id) > 4){
        //             echo '###'.$id ;
        //         }
        //         // preg_match($regex2, $id, $matches2);

        //         // if match, show VALID
        //         // if (count($matches2) == 1) {
        //         //     echo '###' . $id;
        //         // } else {
        //         //     // echo "{$id} INVALID</br>";
        //         // }
        //     }

        // }
    }
    public function OnlineStatus(Request $request)
    {
        $type = $request->type;
        $users = User::all();
        return view('dashboard.online-status', compact('users','type'));
    }
    public function OCR(Request $request)
    {
        if ($file = $request->file('front_img')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('front_img')));
            //prepare request
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $name = $ext . '-' . $file->getClientOriginalName();
            // $name = Str::slug($name, '-');

            // $name1 = $ext . '-' . $file1->getClientOriginalName();
            // $name1 = Str::slug($name, '-');

            // $name2 = $ext . '-' . $file2->getClientOriginalName();
            // $name2 = Str::slug($name, '-');

            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $name);
            Session::put('back_image', $name);//to put the session value
            //
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");
            $gcvRequest = new GoogleCloudVision([$request],  'AIzaSyBUr9WNseZIZbaPQq4lfewpxaGEjRGM8gk');
            //send annotation request
            $response = $gcvRequest->annotate();
            //  $string =  json_encode(["description" => $response->responses[0]->textAnnotations[0]->description]);
            // ech
            // return $response;
            if (!empty($response)) {

            $string = $response->responses[0]->textAnnotations[0]->description;
            $string = preg_replace('/\s+/', ' ', $string) . '<br>';
            $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
            $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
            // $regexJs = '#\\{Name:\\}(.+)\\{/المتحدة\\}#s';
            // $regexJs = '#\\{Name:\\}(.+)\\{/Nationality\\}#s';

            foreach (explode(' ', $string) as $id) {
                // echo $id . '<br>';
                // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
                // print_r($matches);
                // }
                preg_match($regex2, $id, $matches2);

                // if match, show VALID
                if (count($matches2) == 1) {
                    echo '###' . $id;
                } else {
                    // echo "{$id} INVALID</br>";
                }
            }
            // return "z";
            // echo $string['description'];
            if (preg_match('/Name:(.*?)الجنسية/', $string, $match) == 1) {
            // if (preg_match('/Name:(.*?)Nation/', $string, $match) == 1) {
                echo '###' . $match[1] . '<br>';
            }
            foreach (explode(' ', $string) as $id) {
                // echo $id . '<br>';
                preg_match($regex, $id, $matches);

                // // if match, show VALID
                if (count($matches) == 1) {
                    // echo "SSS";
                    // echo $matches['0'];
                    echo '###' . "{$id}";
                }
                // else {
                //     // echo "{$string} INVALID</br>";
                // }
            }
            }
        }
        // return $request;
        // $fileName = time() . '_' . $request->file->getClientOriginalName();
        // if ($file = $request->file('front_img')) {
            // $ext = date('d-m-Y-H-i');
            // $mytime = Carbon::now();
            // $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            // // $name = Str::slug($name, '-');

            // // $name1 = $ext . '-' . $file1->getClientOriginalName();
            // // $name1 = Str::slug($name, '-');

            // // $name2 = $ext . '-' . $file2->getClientOriginalName();
            // // $name2 = Str::slug($name, '-');

            // // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            // $file->move('img', $name);
            // $input['path'] = $name;
            // $k = (new TesseractOCR('img/'.$name))
            //     // ->digits()
            //     // ->hocr()
            //     // ->quiet()
            //     //
            //     // ->tsv()

            //     // ->pdf()

            //     // ->lang('eng', 'jpn', 'spa')
            //     // ->whitelist(range('A', 'Z'))
            //     // ->whitelist(range(0,9,'-'))
            //     // ->whitelist(range(0,9), '-/@')

            // ->run();
            //   $string = rtrim($k);
            //  echo $string = preg_replace('/\s+/', ' ', $k);

            // // echo $l = str_replace(" ","@",$k);
            // // echo $l['0'];
            // // echo $k .'<br> ' . 'Sa';
            // $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
            // $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
            // // const str = 'The first sentence. Some second sentence. Third sentence and the names are John, Jane, Jen. Here is the fourth sentence about other stuff.'

            // // $regexJs = '/Name: ([^.]+)*(\1)/';
            // $regexJs = '#\\{Name:\\}(.+)\\{/Nationality\\}#s';
            // // $str = 'United Arab Emirates ay ‘ doa‘Lal Ann Resident Identity Card ID Number / 42 gli a8) 784-1974-6574140-8 Coa) apls URGAS tame aul! Name: Muhammad Kashif Saleem Uddin Nationality: Pakistan ARAELLLLL';
            // if (preg_match('/Name:(.*?)Nationality/', $string, $match) == 1) {
            //     echo 'Name: ' . $match[1] . '<br>';
            // }
            // // if (preg_match('/Nationality(.*?)/', $string, $match) == 1) {
            // //     echo 'Nationality: ' . $match[1] . '<br>';
            // // }


            // foreach (explode(' ', $string) as $id) {
            //     preg_match($regex, $id, $matches);

            //     // if match, show VALID
            //     if (count($matches) == 1) {
            //         echo 'Emirate ID:' . "{$id} VALID</br>";
            //     } else {
            //         // echo "{$id} INVALID</br>";
            //     }
            // }
            // foreach (explode(' ', $string) as $id) {
            //     // echo $id . '<br>';
            //     // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
            //     // print_r($matches);
            //     // }
            //     preg_match($regex2, $id, $matches2);

            //     // if match, show VALID
            //     if (count($matches2) == 1) {
            //         echo '###' . $id;
            //     } else {
            //         // echo "{$id} INVALID</br>";
            //     }
            // }

        // }
        // return $fileName = time() . '.' . $request->file->extension();
        // return view('number.vision');
        // echo (new TesseractOCR('mixed-languages.png'))
        // ->lang('eng', 'jpn', 'spa')
        // ->run();
        // echo (new TesseractOCR('img/text.png'))
        // ->lang('eng', 'jpn', 'spa')
        // ->run();
        // $ocr = new TesseractOCR();
        // $ocr->image('img/text.png');
        // $ocr->run();
        // return "s";
        // echo $ocr;
        // return $ocr;
        // return IdentityDocuments::parse($request);
    }
    public function ocr_name(Request $request)
    {
        if ($file = $request->file('front_img')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('front_img')));
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $name = $ext . '-' . $file->getClientOriginalName();
            // $name = Str::slug($name, '-');

            // $name1 = $ext . '-' . $file1->getClientOriginalName();
            // $name1 = Str::slug($name, '-');

            // $name2 = $ext . '-' . $file2->getClientOriginalName();
            // $name2 = Str::slug($name, '-');

            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('documents', $name);
            Session::put('front_image', $name);//to put the session value

            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");
            $gcvRequest = new GoogleCloudVision([$request],  'AIzaSyBUr9WNseZIZbaPQq4lfewpxaGEjRGM8gk');
            //send annotation request
            $response = $gcvRequest->annotate();
            //  $string =  json_encode(["description" => $response->responses[0]->textAnnotations[0]->description]);
            // ech
            if (!empty($response)) {
                $string = $response->responses[0]->textAnnotations[0]->description;
                $string = preg_replace('/\s+/', ' ', $string) . '<br>';
                $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
                $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
                $regexJs = '#\\{Name:\\}(.+)\\{/Nationality\\}#s';

                foreach (explode(' ', $string) as $id) {
                    // echo $id . '<br>';
                    // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
                    // print_r($matches);
                    // }
                    preg_match($regex2, $id, $matches2);

                    // if match, show VALID
                    if (count($matches2) == 1) {
                        echo '###' . $id;
                    } else {
                        // echo "{$id} INVALID</br>";
                    }
                }
                // echo $string['description'];
                if (preg_match('/ame:(.*?)ation/', $string, $match) == 1) {
                    echo '###' . $match[1] . '<br>';
                }
                foreach (explode(' ', $string) as $id) {
                    // echo $id . '<br>';
                    preg_match($regex, $id, $matches);

                    // // if match, show VALID
                    if (count($matches) == 1) {
                        // echo "SSS";
                        // echo $matches['0'];
                        echo '###' . "{$id}";
                    }
                    // else {
                //     // echo "{$string} INVALID</br>";
                // }
                }
            }
        }
        // return $request;
        // $fileName = time() . '_' . $request->file->getClientOriginalName();
        // if ($file = $request->file('front_img')) {
        //     // $ext = date('d-m-Y-H-i');
        //     $mytime = Carbon::now();
        //     $ext =  $mytime->toDateTimeString();
        //     $name = $ext . '-' . $file->getClientOriginalName();
        //     // $name = Str::slug($name, '-');

        //     // $name1 = $ext . '-' . $file1->getClientOriginalName();
        //     // $name1 = Str::slug($name, '-');

        //     // $name2 = $ext . '-' . $file2->getClientOriginalName();
        //     // $name2 = Str::slug($name, '-');

        //     // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
        //     $file->move('img', $name);
        //     $input['path'] = $name;
        //     $k = (new TesseractOCR('img/'.$name))
        //         // ->digits()
        //         // ->hocr()
        //         // ->quiet()
        //         //
        //         // ->tsv()

        //         // ->pdf()

        //         // ->lang('eng', 'jpn', 'spa')
        //         // ->whitelist(range('A', 'Z'))
        //         // ->whitelist(range(0,9,'-'))
        //         // ->whitelist(range(0,9), '-/@')

        //     ->run();
        //       $string = rtrim($k);
        //      echo $string = preg_replace('/\s+/', ' ', $k);

        //     // echo $l = str_replace(" ","@",$k);
        //     // echo $l['0'];
        //     // echo $k .'<br> ' . 'Sa';
        //     $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
        //     $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        //     // const str = 'The first sentence. Some second sentence. Third sentence and the names are John, Jane, Jen. Here is the fourth sentence about other stuff.'

        //     // $regexJs = '/Name: ([^.]+)*(\1)/';
        //     $regexJs = '#\\{Name:\\}(.+)\\{/Nationality\\}#s';
        //     // $str = 'United Arab Emirates ay ‘ doa‘Lal Ann Resident Identity Card ID Number / 42 gli a8) 784-1974-6574140-8 Coa) apls URGAS tame aul! Name: Muhammad Kashif Saleem Uddin Nationality: Pakistan ARAELLLLL';
        //     // if (preg_match('/Name:(.*?)Nationality/', $string, $match) == 1) {
        //     if (preg_match('/Name:(.*?)Nation/', $string, $match) == 1) {
        //         echo '###'.$match[1];
        //     }
        //     // if (preg_match('/Nationality(.*?)/', $string, $match) == 1) {
        //     //     echo 'Nationality: ' . $match[1] . '<br>';
        //     // }


        //     foreach (explode(' ', $string) as $id) {
        //         preg_match($regex, $id, $matches);

        //         // if match, show VALID
        //         if (count($matches) == 1) {
        //             echo '###'."{$id}";
        //         } else {
        //             // echo "{$id} INVALID</br>";
        //         }
        //     }
        //     // foreach (explode(' ', $string) as $id) {
        //     //     // echo $id . '<br>';
        //     //     // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
        //     //     // print_r($matches);
        //     //     // }
        //     //     preg_match($regex2, $id, $matches2);

        //     //     // if match, show VALID
        //     //     if (count($matches2) == 1) {
        //     //         echo '###' . $id;
        //     //     } else {
        //     //         // echo "{$id} INVALID</br>";
        //     //     }
        //     // }
        //     // preg_match('#\\{FINDME\\}(.+)\\{/FINDME\\}#s', $out, $matches);
        //     // //
        //     //             if(preg_match($regexJs, $string, $matches)){
        //     //                 print_r($matches);
        //     //             }
        //     // if (preg_match("/Name:\s(.*)\Nationality/", $string, $matches1)) {
        //     //     // echo $matches1[1] . "<br />";
        //     //                     print_r($matches);
        //     // }
        //     // $code = preg_quote($string);
        //     //     $k = "United Arab Emirates ay ‘ doa‘Lal Ann Resident Identity Card ID Number / 42 gli a8) 784-1974-6574140-8 Coa) apls URGAS tame aul! Name: Muhammad Kashif Saleem Uddin Nationality: Pakistan ARAELLLLLMuhammad Kashif Saleem Uddin";
        //     // if (preg_match("/Name:\s(.*)\sNationality/",$string,$matches1)) {
        //     //     echo $matches1[1] . "<br />";
        //     //                     print_r($matches1);
        //     //                     echo "1";
        //     // }
        //     // return preg_match('/Name:\s(.*)/', $string);


        //     // $startsAt = strpos($string, "{Name:}") + strlen("{Nationality}");
        //     // $endsAt = strpos($string, "{/Nationality}", $startsAt);
        //     // $result = substr($string, $startsAt, $endsAt - $startsAt);

        //     // names = str.match(regex)[1],
        //     //     array = names.split(/,\s*/)

        //     // console.log(array)
        //     // $pattern = '#(?:\G(?!\A)|Name:(?:\s+F)?)\s*\K[\w.]+#';
        //     // // print_r($matches);
        //     // // $txt = "calculated F 15 513 153135 155 125 156 155";
        //     // $txt = "calculated F 15 16 United Arab Emirates ay ‘ doa‘Lal Ann Resident Identity Card ID Number: / 42 gli a8) 784-1974-6574140-8 Coa) apls URGAS tame aul! Name: Muhammad Kashif Saleem Uddin Nationality: Pakistan ARAELLLLL";
        //     // echo preg_match_all("/(?:\bName\b|\G(?!^))[^:]*:\K./", $txt, $matches);
        //     // print_r($matches);
        //     // foreach(explode('@', $string) as $info)
        //     // {
        //     // // $str = "http://www.youtube.com/ytscreeningroom?v=NRHVzbJVx8I";
        //     // foreach (explode('@', $string) as $id) {
        //     //     // echo $id;
        //     //     // $pattern = '#(?:\G(?!\A)|Name:(?:\s+F)?)\s*\K[\w.]+#';
        //     //     // preg_match($pattern, $id, $matches);
        //     //     // print_r($matches);

        //     // }
        //     //     // $string = "SALMAN";
        //     //     // preg_match("/^[a-zA-Z-'\s]+$/", $value);

        //     //     // $rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
        //     //     // $rexSafety = "/^[^<,\"@/{}()*$%?=>:|;#]*$/i";
        //     //     if (preg_match('#(?:\G(?!\A)|salmanahmed(?:\s+F)?)\s*\K[\w.]+', $id)) {
        //     //         // var_dump('bad name');
        //     //         echo $id . '<br>';
        //     //     } else {
        //     //         // var_dump('ok');
        //     //     }
        //     // }

        //     //
        // }
        // return $fileName = time() . '.' . $request->file->extension();
        // return view('number.vision');
        // echo (new TesseractOCR('mixed-languages.png'))
        // ->lang('eng', 'jpn', 'spa')
        // ->run();
        // echo (new TesseractOCR('img/text.png'))
        // ->lang('eng', 'jpn', 'spa')
        // ->run();
        // $ocr = new TesseractOCR();
        // $ocr->image('img/text.png');
        // $ocr->run();
        // return "s";
        // echo $ocr;
        // return $ocr;
        // return IdentityDocuments::parse($request);
    }
    public function manage_cordinator($id){
        // return "bOom";
        // return $id;
       $operation = verification_form::select("lead_sales.id", "verification_forms.id as ver_id", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "users.name as agent_name", "lead_sales.*", "lead_locations.location_url", "lead_locations.lat","lead_locations.lng")
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
            ->where('lead_sales.id', $id)
            ->first();
        // if($remarks)
        // ->where("remarks.user_agent_id", auth()->user()->id)
        // return $operation->lead_id;
        $remarks =  remark::select("remarks.*")
        ->where("remarks.lead_id", $operation->id)
        ->get();
        $countries = \App\country_phone_code::all();
        // $operation = verification_form::wherestatus('1.10')->get();
        $emirates = \App\emirate::all();
        $plans = \App\plan::wherestatus('1')->get();
        $users = \App\User::role('activation')->get();
        $addons = \App\addon::wherestatus('1')->get();
        $device = \App\imei_list::wherestatus('1')->get();

        // $operation = verification_form::whereid($id)->get();
        return view('dashboard.assign-lead-to-activation', compact('operation', 'remarks', 'countries', 'emirates', 'plans', 'users', 'addons', 'device'));
        // return view('dashboar', compact('operation'));
    }
    public function MyLog(){
        $k = elife_log::select('elife_logs.*', 'elife_bulkers.number', 'elife_bulkers.plan', 'elife_bulkers.customer_name as name', 'elife_bulkers.area','elife_logs.status','elife_logs.remarks')
        ->LeftJoin(
            'elife_bulkers',
            'elife_bulkers.id',
            'elife_logs.number_id'
        )
        ->where('elife_logs.identify', '1')
        // ->where('type', $slug)
        ->where('userid', auth()->user()->id)
        ->get();        //
        return view('dashboard.view-white-log', compact('k'));
    }
    public function ElifeLog(){
        $k = elife_log::select('elife_logs.*', 'elife_bulkers.number', 'elife_bulkers.plan', 'elife_bulkers.customer_name as name', 'elife_bulkers.area','elife_logs.status','elife_logs.remarks','users.name as agent_name','elife_logs.updated_at')
        ->LeftJoin(
            'elife_bulkers',
            'elife_bulkers.id',
            'elife_logs.number_id'
        )
        ->LeftJoin(
            'users',
            'users.id',
            'elife_logs.userid'
        )
        ->where('elife_logs.identify', '1')
        // ->where('type', $slug)
        // ->where('userid', auth()->user()->id)
        ->get();        //
        return view('dashboard.view-white-log', compact('k'));
    }
    public function ViewElifeUser(){
         $k = elife_log::select('elife_logs.*', 'elife_bulkers.number', 'elife_bulkers.plan', 'elife_bulkers.customer_name as name', 'elife_bulkers.area', 'elife_logs.status', 'elife_logs.remarks','users.name as agent_name','users.id as userid')
        ->LeftJoin(
            'elife_bulkers',
            'elife_bulkers.id',
            'elife_logs.number_id'
        )
        ->LeftJoin(
            'users',
            'users.id',
            'elife_logs.userid'
        )
        ->groupBy('elife_logs.userid')
        // ->where('elife_logs.identify', '0')
        // ->where('type', $slug)
        ->where('users.agent_code', auth()->user()->agent_code)
        ->get();        //
        return view('dashboard.view-user-log', compact('k'));
    }
    public static function ElifeLogWise($userid,$status){
        return $k = elife_log::select('elife_logs.*', 'elife_bulkers.number', 'elife_bulkers.plan', 'elife_bulkers.customer_name as name', 'elife_bulkers.area', 'elife_logs.status', 'elife_logs.remarks')
            ->LeftJoin(
                'elife_bulkers',
                'elife_bulkers.id',
                'elife_logs.number_id'
            )
            ->where('elife_logs.identify', '1')
            // ->where('type', $slug)
            ->where('elife_logs.userid', $userid)
            ->where('elife_logs.status', $status)
            ->count();        //
    }
    public static function ElifeNoAnswer(){
        //
        $k = elife_log::select('elife_logs.*', 'elife_bulkers.number', 'elife_bulkers.plan', 'elife_bulkers.customer_name as name', 'elife_bulkers.area')
        ->LeftJoin(
            'elife_bulkers',
            'elife_bulkers.id',
            'elife_logs.number_id'
        )
        ->where('elife_logs.identify', '1')
        // ->where('type', $slug)
        ->where('elife_logs.status', 'No Answer')
        ->where('userid', auth()->user()->id)
        ->paginate();        //
        return view('dashboard.add-answer-log', compact('k'));
        // return "B";
        // $k = elife_log::select('elife_logs.*', 'elife_bulkers.number', 'elife_bulkers.plan', 'elife_bulkers.customer_name as name', 'elife_bulkers.area','elife_logs.status','elife_logs.remarks')
        // ->LeftJoin(
        //     'elife_bulkers',
        //     'elife_bulkers.id',
        //     'elife_logs.number_id'
        // )
        // ->where('elife_logs.identify', '1')
        // ->where('elife_logs.remarks', 'No Answer')
        // ->where('userid', auth()->user()->id)
        // ->get();        //
        // return view('dashboard.view-white-log', compact('k'));
        //
        // $k = elife_log::select('elife_logs.*', 'elife_bulkers.number', 'elife_bulkers.plan', 'elife_bulkers.customer_name as name', 'elife_bulkers.area', 'elife_logs.status', 'elife_logs.remarks')
        // ->LeftJoin(
        //     'elife_bulkers',
        //     'elife_bulkers.id',
        //     'elife_logs.number_id'
        // )
        // ->where('elife_logs.identify', '1')
        //     // ->where('type', $slug)
        // ->where('elife_logs.remarks', 'No Answer')
        // // ->where('userid', auth()->user()->id)

        // ->where('userid', auth()->user()->id)
        // ->get();        //
        // return view('dashboard.view-white-log', compact('k'));
    }
    public function NumberAllCleaner($id,$channel){
        // $data = numberdetail::all();

        $removed = numberdetail::select("numberdetails.*","users.name","choosen_numbers.id as cid")
            ->LeftJoin(
                'choosen_numbers',
                'choosen_numbers.number_id',
                '=',
                'numberdetails.id'
                )
            ->LeftJoin(
                    'users',
                    'users.id',
                    '=',
                    'choosen_numbers.user_id'
                )
            ->where('numberdetails.status','Active')
            ->where('numberdetails.channel_type',$channel)
            ->where('numberdetails.type',$id)
            ->where('numberdetails.remarks',auth()->user()->id)
            ->count();
        $data = numberdetail::select("numberdetails.*","users.name","choosen_numbers.id as cid")
            ->LeftJoin(
                'choosen_numbers',
                'choosen_numbers.number_id',
                '=',
                'numberdetails.id'
                )
            ->LeftJoin(
                    'users',
                    'users.id',
                    '=',
                    'choosen_numbers.user_id'
                )
            ->where('numberdetails.status','Available')
            ->where('numberdetails.channel_type',$channel)
            ->where('numberdetails.type',$id)
            ->get();

            // ->get();
        return view('dashboard.view-all-number-cleaner', compact('data','removed'));
    }
    public function AllRemovedNumber(){
        // $data = numberdetail::all();

        $removed = numberdetail::select("numberdetails.*","users.name","choosen_numbers.id as cid")
            ->LeftJoin(
                'choosen_numbers',
                'choosen_numbers.number_id',
                '=',
                'numberdetails.id'
                )
            ->LeftJoin(
                    'users',
                    'users.id',
                    '=',
                    'choosen_numbers.user_id'
                )
            ->where('numberdetails.status','Active')
            // ->where('numberdetails.channel_type',$channel)
            // ->where('numberdetails.type',$id)
            ->where('numberdetails.remarks',auth()->user()->id)
            ->get();


            // ->get();
        return view('report.removednumber', compact('removed'));
    }
    public function ElifePlan(Request $request){
        // return $reqeust;
        $data = elife_plan::where('product_type',$request->product)->get();
        return view('dashboard.elife',compact('data'));

    }
}
