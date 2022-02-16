<?php

namespace App\Http\Controllers;

// use Spatie\Permission\Contracts\Role;

// use App\Http\Controllers\Roles;
// use App\Role;

use App\activation_form;
use App\channel_partner;
use App\user;
use App\emirate;
use App\numberdetail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use  Spatie\Permission\Traits\HasRoles;
use Auth;
// use Roles;
use Illuminate\Http\Request;
// use App\Permission;
// use Carbon;
use Carbon\Carbon;
// app/Http/Controllers/
use App\CustomerFeedBack;
use App\lead_sale;
use App\team_leader;
use App\verification_form;
use Session;

// use App\DataTables\UsersDataTable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function index(UsersDataTable $dataTable)
    // {
    //     return $dataTable->render('users.index');
    // }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function days_test($now){
        $startDate = \Carbon\Carbon::now(); //returns current day
        $f = $startDate->firstOfMonth();
        $date = Carbon::parse($f);
        // $now = Carbon::now();

        return $diff = $date->diffInDays($now);
    }
    public static function days($month){
        // $month = '2020-11';
        $start = \Carbon\Carbon::parse($month)->startOfMonth();
        $end = \Carbon\Carbon::parse($month)->endOfMonth();

        $dates = [];
        while ($start->lte($end)) {
            $carbon = \Carbon\Carbon::parse($start);
            if ($carbon->isWeekend() != true) {
                $dates[] = $start->copy()->format('Y-m-d');
            }
            $start->addDay();
        }
        return count($dates);
        // foreach ($dates as $key => $dateval) {
        //     echo "<br>" . $dateval;
        // }
    }
    public static function MyCount($id)
    {
        return $id;
    }
    public static function ActivationCallAgentGrandTotal($userid)
    {
        // return $userid;
        return $k = activation_form::select('id')
            ->LeftJoin(
                'users',
                'users.id',
                'activation_forms.saler_id'
            )
            ->where('users.agent_code', $userid)
            // ->where('activation_forms.activation_date', $date)
            // ->where('')
            ->whereMonth('activation_forms.activation_date', Carbon::now()->month)
            ->count();
    }
    public static function ReservCounter($id,$channel)
    {
        return $data = \App\choosen_number::select("choosen_numbers.*")
                ->LeftJoin(
                    'numberdetails','numberdetails.id','=','choosen_numbers.number_id','numberdetails.id'
                )
                ->where("choosen_numbers.status", 1)
                ->where("choosen_numbers.user_id", $id)
                ->where("numberdetails.channel_type", $channel)
                ->count();

        // $data = choosen_number::selectRaw('users.*, COUNT(choosen_numbers.user_id) as total_posts')
        // // ->Join(
        // //     'choosen_numbers',
        // //     'choosen_numbers.number_id',
        // //     '=',
        // //     'numberdetails.id'
        // // )
        // ->Join(
        //     'users',
        //     'users.id',
        //     '=',
        //     'choosen_numbers.user_id'
        // )
        //     ->where("choosen_numbers.status", 1)
        //     ->groupBy('choosen_numbers.user_id')
        //     ->get();
    }
    public function NumberSystem(request $request){
        return $request;
    }
    public static function NotificationCount($id,$type){
        return $count = \App\customer_notification::select("customer_notifications.id")
                ->where('userid',auth()->user()->id)
                ->where('type',$type)
                ->where('status',1)
                ->count();
    }
    public static function FullPlan($id,$simType){
        // return $id;
        if($simType == 'New' || $simType == 'MNP' || $simType == 'Migration'){
            $postpaid = \App\plan::select("plans.plan_name")
            ->where('plans.id', $id)
            ->first();
            return $postpaid->plan_name;
        }
        else if($simType == 'Elife'){
            // $postpaid_verified = \App\plan::select("plans.plan_name")
            // ->where('plans.id', $id)
            // ->first();
             $plan = \App\elife_plan::findorfail($id);
            return $plan->plan_name;
         }
         else{
             return "ITP";
         }
    }
    public static function PlanName($id){
        return $postpaid_verified = \App\plan::select("plans.plan_name")
            ->where('plans.id', $id)
            ->first();
    }
    public static function ElifePlanName($id){
        return $plan_name = \App\plan::findorfail($id);
    }
    // POSTPAID START
    public static function TotalLead($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', '1.07')
            // ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    // POSTPAID START
    public static function TotalLeadManager(){
        // return $id;
       return $tmkoc = lead_sale::select('lead_sales.*')
       ->join(
           'users',
           'users.id',
           '=',
           'lead_sales.saler_id'
       )
       ->where('users.agent_code',auth()->user()->agent_code)
       ->count();

    }
    public static function TotalLeadManagerChannel($channel){
        // return $id;
       return $tmkoc = lead_sale::select('lead_sales.*')
       ->join(
           'users',
           'users.id',
           '=',
           'lead_sales.saler_id'
       )
       ->where('users.agent_code',auth()->user()->agent_code)
       ->where('lead_sales.channel_type',$channel)
       ->count();

    }
    public static function TotalLeadManagerChannelStatus($channel,$status){
        // return $id;
       return $tmkoc = lead_sale::select('lead_sales.*')
       ->join(
           'users',
           'users.id',
           '=',
           'lead_sales.saler_id'
       )
        ->Join(
            'status_codes',
            'status_codes.status_code',
            '=',
            'lead_sales.status'
        )
       ->where('users.agent_code',auth()->user()->agent_code)
       ->where('lead_sales.channel_type',$channel)
       ->where('lead_sales.status',$status)
       ->count();
    }
    public static function TotalLeadManagerChannelStatusVerified($channel,$status){
        // return $id;
        if ($status == 'verified') {
            return $tmkoc = lead_sale::select('lead_sales.*')
                ->join(
                    'users',
                    'users.id',
                    '=',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    '=',
                    'lead_sales.status'
                )
                ->where('users.agent_code', auth()->user()->agent_code)
                ->where('lead_sales.channel_type', $channel)
                ->whereIn('lead_sales.status', ['1.07','1.10','1.02'])
                ->count();
        }
        elseif($status == 'rejected'){
            return $tmkoc = lead_sale::select('lead_sales.*')
                ->join(
                    'users',
                    'users.id',
                    '=',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    '=',
                    'lead_sales.status'
                )
                ->where('users.agent_code', auth()->user()->agent_code)
                ->where('lead_sales.channel_type', $channel)
                ->whereIn('lead_sales.status', ['1.15','1.04'])
                ->count();
        }

    }
    public static function TotalLeadManagerChannelStatusVerifiedElife($channel,$status){
        // return $id;
        if ($status == 'verified') {

            return $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*", "status_codes.status_name", "verification_forms.id as ver_id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
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
                ->Join(
                    'verification_forms',
                    'verification_forms.lead_no',
                    '=',
                    'lead_sales.id'
                )
                ->whereIn('lead_sales.status', ['1.07', '1.16'])
                ->where('lead_sales.lead_type', 'elife')
                ->where('users.agent_code', auth()->user()->agent_code)
                ->count();
        }
        elseif($status == 'rejected'){
            return $tmkoc = lead_sale::select('lead_sales.*')
                ->join(
                    'users',
                    'users.id',
                    '=',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    '=',
                    'lead_sales.status'
                )
                ->where('users.agent_code', auth()->user()->agent_code)
                ->where('lead_sales.channel_type', $channel)
                ->whereIn('lead_sales.status', ['1.15','1.04'])
                ->count();
        }

    }
    public static function TotalLeadStatus($id,$status,$channel){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', $id)
            ->where('lead_sales.lead_type', $status)
            ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', auth()->user()->agent_code)
            // ->where('users.id', $id)
            ->count();
    }
    public static function TotalLeadStatusElife($id,$status){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', $id)
            ->where('lead_sales.lead_type', $status)
            // ->where('lead_sales.channel_type', $channel)
            // ->where('users.id', $id)
            ->count();
    }
    public static function TotalLeadVerified($id,$leadtype,$channel)
    {
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')

            ->Join(
                'verification_forms',
                'verification_forms.verify_agent',
                '=',
                'users.id'
            )
            ->Join(
                'lead_sales',
                'lead_sales.id',
                '=',
                'verification_forms.lead_no'
            )
            ->where('verification_forms.status', $id)
            ->where('lead_sales.lead_type',$leadtype)
            ->where('lead_sales.channel_type',$channel)
            ->where('users.id', auth()->user()->id)
            ->count();
    }
    public static function TotalChannelLead($id,$leadtype,$channel)
    {
        // return $id;
        if($id == '1.04'){
            return $postpaid_verified = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')

                // ->Join(
                //     'verification_forms',
                //     'verification_forms.verify_agent',
                //     '=',
                //     'users.id'
                // )
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->where('lead_sales.status', $id)
                ->where('lead_sales.lead_type', $leadtype)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.id', auth()->user()->id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->count();
        }
        else if($id == '1.02'){
            return $postpaid_verified = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')

                // ->Join(
                //     'verification_forms',
                //     'verification_forms.verify_agent',
                //     '=',
                //     'users.id'
                // )
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->where('lead_sales.status', $id)
                ->where('lead_sales.lead_type', $leadtype)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.id', auth()->user()->id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->count();
        }
        else{
            return $postpaid_verified = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')

                // ->Join(
                //     'verification_forms',
                //     'verification_forms.verify_agent',
                //     '=',
                //     'users.id'
                // )
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->where('lead_sales.status', $id)
                ->where('lead_sales.lead_type', $leadtype)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.id', auth()->user()->id)
                // ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->count();
        }

    }
    public static function TotalLeadVerifiedElife($id,$leadtype)
    {
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')

            ->Join(
                'verification_forms',
                'verification_forms.verify_agent',
                '=',
                'users.id'
            )
            ->Join(
                'lead_sales',
                'lead_sales.id',
                '=',
                'verification_forms.lead_no'
            )
            ->where('lead_sales.status', '1.07')
            ->where('lead_sales.lead_type',$leadtype)
            // ->where('lead_sales.channel_type',$channel)
            ->where('users.id', auth()->user()->id)
            ->count();
    }
    public static function TotalPostPaidLead($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.lead_type', 'postpaid')
            // ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    public static function TotalPostElifeLead($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.lead_type', 'Elife')
            // ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    public static function TotalPostITLead($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.lead_type', 'ITProducts')
            // ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    public static function PostPaidVerified($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.07')
            ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    public static function PostPaidPending($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.01')
            ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    public static function TotalLeadtype($id,$status,$type, $channel){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', auth()->user()->agent_code)
            ->where('users.id', $id)
            ->count();
    }
    public static function TotalLaterLead($id,$status){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.pre_check_agent',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', 'postpaid')
            // ->where('lead_sales.channel_type', $channel)
            // ->where('users.agent_code', auth()->user()->agent_code)
            ->where('users.id', $id)
            ->count();
    }
    public static function TotalLaterLeadElife($id,$status){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.pre_check_agent',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', 'elife')
            // ->where('lead_sales.channel_type', $channel)
            // ->where('users.agent_code', auth()->user()->agent_code)
            ->where('users.id', $id)
            ->count();
    }
    public static function PostPaidFollow($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('users.id', auth()->user()->id)
            ->where('lead_sales.status', '1.03')
            ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    public static function PostPaidReject($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.04')
            ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    public static function PostPaidActive($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.02')
            ->where('lead_sales.lead_type', 'postpaid')
            ->where('users.id', $id)
            ->count();
    }
    // POSTPAID END

    // ELIFE START
    public static function ElifeVerified($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.07')
            ->where('lead_sales.lead_type', 'Elife')
            ->where('users.id', $id)
            ->count();
    }
    public static function ElifePending($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.01')
            ->where('lead_sales.lead_type', 'Elife')
            ->where('users.id', $id)
            ->count();
    }
    public static function ElifeFollow($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('users.id', auth()->user()->id)
            ->where('lead_sales.status', '1.03')
            ->where('lead_sales.lead_type', 'Elife')
            ->where('users.id', $id)
            ->count();
    }
    public static function ElifeReject($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.04')
            ->where('lead_sales.lead_type', 'Elife')
            ->where('users.id', $id)
            ->count();
    }
    public static function ElifeActive($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.02')
            ->where('lead_sales.lead_type', 'Elife')
            ->where('users.id', $id)
            ->count();
    }
    // ELIFE END
    // ITProduct START
    public static function ITProductVerified($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.07')
            ->where('lead_sales.lead_type', 'ITProducts')
            ->where('users.id', $id)
            ->count();
    }
    // public function
    public static function ITProductPending($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.01')
            ->where('lead_sales.lead_type', 'ITProducts')
            ->where('users.id', $id)
            ->count();
    }
    public static function ITProductFollow($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.03')
            ->where('lead_sales.lead_type', 'ITProducts')
            ->where('users.id', $id)
            ->count();
    }
    public static function ITProductReject($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.04')
            ->where('lead_sales.lead_type', 'ITProducts')
            ->where('users.id', $id)
            ->count();
    }
    public static function ITProductActive($id){
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.status', '1.02')
            ->where('lead_sales.lead_type', 'ITProducts')
            ->where('users.id', $id)
            ->count();
    }
    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }
    public function AllCordinationPending($id){
        // return $id;
        if($id == 'AllCord'){
            if (auth()->user()->role == 'MainCoordinator') {

                $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*", "status_codes.status_name", "verification_forms.id as ver_id", 'verification_forms.created_at as verified_date')
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->LeftJoin(
                    'timing_durations',
                    'timing_durations.lead_no',
                    '=',
                    'lead_sales.id'
                )
                    ->LeftJoin(
                        'status_codes',
                        'status_codes.status_code',
                        '=',
                        'lead_sales.status'
                    )
                    ->LeftJoin(
                        'users',
                        'users.id',
                        '=',
                        'lead_sales.saler_id'
                    )
                    ->LeftJoin(
                        'verification_forms',
                        'verification_forms.lead_no',
                        '=',
                        'lead_sales.id'
                    )
                    // ->whereIn('verification_forms.status', ['1.09','1.16'])
                    // ->where('users.agent_code', auth()->user()->agent_code)
                    ->get();
                    return view('dashboard.manage-cordination-lead', compact('operation'));

            } else {
                $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*", "status_codes.status_name", "verification_forms.id as ver_id")
                    // $user =  DB::table("subjects")->select('subject_name', 'id')
                    ->Join(
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
                    ->Join(
                        'verification_forms',
                        'verification_forms.lead_no',
                        '=',
                        'lead_sales.id'
                    )
                    ->whereIn('lead_sales.status', ['1.07','1.16'])
                    ->where('users.agent_code', auth()->user()->agent_code)
                    ->get();
                return view('dashboard.manage-cordination-lead', compact('operation'));
            }
        }
        else if($id == 'AllActive')
        {
            //
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
            // ->where('verification_forms.emirate_location', auth()->user()->emirate)
            ->groupBy('verification_forms.lead_no')
            ->get();

            return view('dashboard.view-activation-pending', compact('operation'));
        }
        else if($id == 'CordFollow'){
            if (auth()->user()->role == 'MainCoordinator') {
                $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*", "status_codes.status_name", "verification_forms.id as ver_id")
                    // $user =  DB::table("subjects")->select('subject_name', 'id')
                    ->Join(
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
                    ->Join(
                        'verification_forms',
                        'verification_forms.lead_no',
                        '=',
                        'lead_sales.id'
                    )
                    ->where('verification_forms.status','1.16')        // ->where('users.agent_code', auth()->user()->agent_code)
                    ->get();
                return view('dashboard.manage-cordination-lead', compact('operation'));
            } else {
                $operation = lead_sale::select("timing_durations.lead_generate_time", "lead_sales.*", "status_codes.status_name", "verification_forms.id as ver_id")
                    // $user =  DB::table("subjects")->select('subject_name', 'id')
                    ->Join(
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
                    ->Join(
                        'verification_forms',
                        'verification_forms.lead_no',
                        '=',
                        'lead_sales.id'
                    )
                    ->where('lead_sales.status', '1.16')
                    ->where('users.agent_code', auth()->user()->agent_code)
                    ->get();
                return view('dashboard.manage-cordination-lead', compact('operation'));
            }
        }
        else if($id == 'CordActive'){
            //
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
            ->where('verification_forms.status', '1.17')
            ->where('lead_locations.assign_to', auth()->user()->id)
            // ->where('verification_forms.emirate_location', auth()->user()->emirate)
            ->groupBy('verification_forms.lead_no')
            ->get();

            return view('dashboard.view-activation-pending', compact('operation'));
        }
    }
    public function Online()
    {
        $users = User::all();
        return view('dashboard.status', compact('users'));
    }
 // ITProduct END
    public function index(Request $request)
    {
        // return auth()->user()->role;
        // return user::find(1)->authentications;
        // return User::find(1)->lastLoginAt();
        // $user = User::find(1);
        // return $user->isOnline();

        // return $user_ip_address = $request->ip();
        // if()
        // if(Auth::user()->hasRole('sale'))
        // {
        //     // return "Hoe";
        //     // do something
        // }
        // if(auth()->user()->agent_code == 'ARF'){
        //     return redirect(route('number-system.index'));
        // }
        if(auth()->user()->agent_code == 'ARF' || auth()->user()->role == 'NumberCord' || auth()->user()->role == 'NumberActivation'){
            return redirect(route('number-system-ttf','OCP1'));
        }
        // $permission = Permission::findById(6);
        // $role = Role::findById(18);
        // $role->givePermissionTo($permission);
        // auth()->user()->givePermissionTo('manage postpaid');
        // return auth()->user()->role;
        // return $role = Role::all();
        // return $permission = Permission::all();
        // $permission->removeRole($role);
        // $role->revokePermissionTo($permission);
        // $role->revokePermissionTo($permission);
        // $role = Role::findById(15);
        // Permissions::create([''])
        // Permission::create(['name'=> 'manage reporting']);
        // Role::create(['name'=> 'SpecialVerification']);
        // auth()->user()->givePermissionTo('manage elife');
        // auth()->user()->givePermissionTo('manage itproducts');
        // auth()->user()->assignRole('Sale');
        // return auth()->user()->permissions;
        // drakify('error'); // for success alert
        // return auth()->user()->role;
        // return "ROle" . auth()->user()->role;
        if(auth()->user()->role == 'Manager' || auth()->user()->role == 'General-Manager' || auth()->user()->role == 'NumberSuperAdmin' || auth()->user()->role == 'Elife Manager'){
            // get all inherited permissions for that user
                $user = auth()->user();
                $permission = $user->getAllPermissions();
                return view('dashboard.manager.home-dashboard',compact('permission'));

        }
        else if(auth()->user()->role == 'MIS-COORDINATOR'){
            // get all inherited permissions for that user
                $user = auth()->user();
                $permission = $user->getAllPermissions();
                return view('dashboard.manager.home-dashboard',compact('permission'));

        }
        else if(auth()->user()->role == 'VALIDATOR'){
            // get all inherited permissions for that user
                $user = auth()->user();
                $permission = $user->getAllPermissions();
                return view('dashboard.manager.home-dashboard',compact('permission'));

        }
        else if(auth()->user()->role == 'sale' || auth()->user()->role == 'NumberAdmin' || auth()->user()->role == 'Team-Leader'){
            // return "s";

                $channel_partner = channel_partner::where('status', '1')->get();
                 $myteam = team_leader::where('teamleader_id',auth()->user()->id)->get();
                return view('dashboard.sale-dashboard',compact('channel_partner'));
        }
        else if(auth()->user()->role == 'Team-Leader'){
            // return "s";

                $channel_partner = channel_partner::where('status', '1')->get();
                 $myteam = team_leader::where('teamleader_id',auth()->user()->id)->get();
                return view('dashboard.sale-dashboard',compact('channel_partner'));
        }
        else if(auth()->user()->role == 'Coordination'){
            // $cordination_pending = \App\User::select("users.id")
            //     // $user =  DB::table("subjects")->select('subject_name', 'id')
            //     ->leftJoin(
            //         'lead_sales',
            //         'lead_sales.saler_id',
            //         '=',
            //         'users.id'
            //     )
            //     ->leftJoin(
            //         'verification_forms',
            //         'verification_forms.lead_no',
            //         '=',
            //         'lead_sales.id'
            //     )
            //     // ->where('users.id', auth()->user()->id)
            //     ->whereIn('lead_sales.status', ['1.07','1.16'])
            //     ->where('lead_sales.lead_type', 'elife')
            //     ->where('users.agent_code', auth()->user()->agent_code)
            //     ->count();
            // $cordination_complete = \App\User::select("users.id")
            //     // $user =  DB::table("subjects")->select('subject_name', 'id')
            //     ->leftJoin(
            //         'lead_sales',
            //         'lead_sales.saler_id',
            //         '=',
            //         'users.id'
            //     )
            //     // ->where('users.id', auth()->user()->id)
            //     ->where('lead_sales.status', '1.10')
            //     ->where('lead_sales.lead_type', 'postpaid')
            //     ->where('users.agent_code', auth()->user()->agent_code)
            //     ->count();
            //     $emirates = emirate::wherestatus('1')->get();
            //     $activation_users = User::role('activation')->get();
                return view('dashboard.cordination-dashboard');
        }
        else if(auth()->user()->role == 'MainCoordinator'){
            $cordination_pending = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->leftJoin(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->leftJoin(
                    'verification_forms',
                    'verification_forms.lead_no',
                    '=',
                    'lead_sales.id'
                )
                // ->where('users.id', auth()->user()->id)
                ->where('lead_sales.status', '1.07')
                ->where('lead_sales.lead_type', 'postpaid')
                // ->where('users.agent_code', auth()->user()->agent_code)
                ->count();
            $cordination_complete = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->leftJoin(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                // ->where('users.id', auth()->user()->id)
                ->where('lead_sales.status', '1.10')
                ->where('lead_sales.lead_type', 'postpaid')
                // ->where('users.agent_code', auth()->user()->agent_code)
                ->count();
                $emirates = emirate::wherestatus('1')->get();
                $activation_users = User::role('activation')->get();
                return view('dashboard.cordination-dashboard', compact('cordination_complete', 'cordination_pending', 'emirates', 'activation_users'));
        }
        else if(auth()->user()->role == 'Activation' || auth()->user()->role == 'Elife Active'){
            // $cordination_pending = verification_form::select("verification_forms.lead_no", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "status_codes.status_name")
            //     // $user =  DB::table("subjects")->select('subject_name', 'id')
            //     ->Join(
            //         'timing_durations',
            //         'timing_durations.lead_no',
            //         '=',
            //         'verification_forms.lead_no'
            //     )
            //     ->Join(
            //         'remarks',
            //         'remarks.lead_no',
            //         '=',
            //         'verification_forms.lead_no'
            //     )
            //     ->Join(
            //         'status_codes',
            //         'status_codes.status_code',
            //         '=',
            //         'verification_forms.status'
            //     )
            //     ->where('verification_forms.status', '1.10')
            //     ->where('verification_forms.assing_to', auth()->user()->id)
            //     // ->where('verification_forms.emirate_location', auth()->user()->emirate)
            //     // ->groupBy('verification_forms.lead_no')
            //     ->count();

            $cordination_pending = verification_form::select("verification_forms.lead_no", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "status_codes.status_name", "lead_locations.lat", "lead_locations.lng")
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
                // ->Join(
                //     'remarks',
                //     'remarks.lead_no',
                //     '=',
                //     'verification_forms.lead_no'
                // )
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
                ->where('lead_sales.status', '1.10')
                ->where('lead_locations.assign_to', auth()->user()->id)
                // ->where('verification_forms.emirate_location', auth()->user()->emirate)
                // ->groupBy('verification_forms.lead_no')
                ->count();
            // $cordination_complete =
            $cordination_complete = \App\activation_form::select('activation.*')
            ->where('activation_sold_by',auth()->user()->id)
            ->count();
            // $cordination_complete = \App\User::select("users.id")
            //     // $user =  DB::table("subjects")->select('subject_name', 'id')
            //     ->leftJoin(
            //         'lead_sales',
            //         'lead_sales.saler_id',
            //         '=',
            //         'users.id'
            //     )
            //     // ->where('users.id', auth()->user()->id)
            //     ->where('lead_sales.status', '1.02')
            //     ->where('lead_sales.lead_type', 'postpaid')
            //     ->where('users.agent_code', auth()->user()->agent_code)
            //     ->count();
            $reverify_lead = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->leftJoin(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                // ->where('users.id', auth()->user()->id)
                ->where('lead_sales.status', '1.05')
                ->where('lead_sales.lead_type', 'postpaid')
                ->where('users.agent_code', auth()->user()->agent_code)
                ->count();
                return view('dashboard.activation-dashboard', compact('cordination_complete', 'cordination_pending', 'reverify_lead'));
        }
        else if(auth()->user()->role == 'Verification' || auth()->user()->role == 'NumberVerification' || auth()->user()->role == 'elif-Verification'){
             $postpaid_pending = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                // ->where('users.id', auth()->user()->id)
                ->where('lead_sales.status', '1.01')
                ->where('lead_sales.lead_type', 'postpaid')
                // ->where('users.agent_code', auth()->user()->agent_code)
                ->count();

            $postpaid_verified = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                // ->where('users.id', auth()->user()->id)
                ->where('lead_sales.status', '1.07')
                ->where('lead_sales.lead_type', 'postpaid')
                // ->where('users.agent_code', auth()->user()->agent_code)
                ->count();
            $total_re_verify = \App\User::select("users.id")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                // ->where('users.id', auth()->user()->id)
                ->where('lead_sales.status', '1.13')
                ->where('lead_sales.lead_type', 'postpaid')
                // ->where('users.agent_code', auth()->user()->agent_code)
                ->count();
            //
            $channel_partner = channel_partner::where('status', '1')->get();

                return view('dashboard.verification-dashboard', compact('postpaid_pending', 'postpaid_verified', 'total_re_verify','channel_partner'));

                //
        }
        else if(auth()->user()->role == 'Admin' || auth()->user()->role == 'SuperAdmin'){
            // return "yes";
            return view('admin.home-dashboard');
        }
        else if(auth()->user()->role == 'NumberController')
        {
            // return "S";
            $r = numberdetail::select('numberdetails.type')->where('status','Available')->groupBy('numberdetails.type')->get();
            return view('admin.number-dashboard',compact('r'));
        }
        else{
            // return "s";
            return view('dashboard.home-dashboard');
        }
    }
    public function feedback(){
        $data = CustomerFeedBack::all();
        return view('dashboard.feedback',compact('data'));
    }

}
