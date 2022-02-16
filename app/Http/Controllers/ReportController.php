<?php

namespace App\Http\Controllers;

use App\activation_form;
use App\call_center;
use App\channel_partner;
use App\lead_sale;
use App\plan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public static function NumberOfAgent($AgentCode){
        return $count = User::whereAgentCode($AgentCode)->count();
    }
    public static function AllLeadsCallCenter($call_center,$type,$channel){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', $call_center)
            ->whereMonth('lead_sales.created_at', Carbon::now()->month)
            // ->where('users.id', $id)
            ->count();
    }
    public static function AllLeadsCallCenterCombine($call_center,$type,$channel){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            // ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', $call_center)
            ->whereMonth('lead_sales.created_at', Carbon::now()->month)
            // ->where('users.id', $id)
            ->count();
    }
    public static function AllLeadsMonthly($call_center,$type,$channel){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            ->where('lead_sales.channel_type', $channel)
            // ->where('users.agent_code', $call_center)
            ->whereMonth('lead_sales.created_at', Carbon::now()->month)
            // ->where('users.id', $id)
            ->count();
    }
    public static function AllLeadsMonthlyAgent($status){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', 'elife')
            ->where('lead_sales.status', $status)
            ->where('lead_sales.channel_type', 'elifa')
            ->where('users.id', auth()->user()->id)
            ->whereMonth('lead_sales.created_at', Carbon::now()->month)
            // ->where('users.id', $id)
            ->count();
    }
    public static function AllLeadsCallCenterToday($call_center,$type,$channel){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', $call_center)
            ->whereDate('lead_sales.date_time', Carbon::today())
            // ->where('users.id', $id)
            ->count();
    }
    public static function AllLeadsCallCenterTodayCombine($call_center,$type){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            // ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', $call_center)
            ->whereDate('lead_sales.date_time', Carbon::today())
            // ->where('users.id', $id)
            ->count();
    }
    public static function AllLeadsToday($call_center,$type,$channel){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            ->where('lead_sales.channel_type', $channel)
            // ->where('users.agent_code', $call_center)
            ->whereDate('lead_sales.date_time', Carbon::today())
            // ->where('users.id', $id)
            ->count();
    }
    public static function AllLeadsTodayCombine($call_center,$type,$channel){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            // ->where('lead_sales.channel_type', $channel)
            // ->where('users.agent_code', $call_center)
            ->whereDate('lead_sales.date_time', Carbon::today())
            // ->where('users.id', $id)
            ->count();
    }
    public static function AllLeadsMonthlyCombine($call_center,$type,$channel){
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            // ->where('lead_sales.status', $status)
            ->where('lead_sales.lead_type', $type)
            // ->where('lead_sales.channel_type', $channel)
            // ->where('users.agent_code', $call_center)
            // ->whereDate('lead_sales.date_time', Carbon::today())
            // ->where('users.id', $id)
            ->whereMonth('lead_sales.created_at', Carbon::now()->month)
            ->count();
    }
    public static function CalCenterLeadtype($id, $status, $type, $channel)
    {
        // return $id;
        // return $status;
        // return $status;
        // $status = trim($status);
        if($status == 'verified'){
            //  $status = "'1.03','1.05','1.07','1.08','1.09','1.10'";
            return $postpaid_verified = \App\User::select("users.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status',
                ['1.05', '1.07', '1.08', '1.09', '1.10', '1.02', '1.16', '1.17']
            )
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
            // -> whereDate('lead_sales.created_at', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
            }
            else if($status == 'inprocess'){
                return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
                    ->where('lead_sales.lead_type', $type)
                    ->where('lead_sales.channel_type', $channel)
                    ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                    ->get()
                    // ->where('users.id', $id)
                    ->count();
            // 1.03,1.05,1.07,1.08,1.09,1.10
        }
        else if($status == 'nonverified'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.04','1.01'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'rejected'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.15'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'followup'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.16','1.17','1.03'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == '1.02'){
            return $active = \App\activation_form::select('activation_forms.id')
            ->LeftJoin(
                'lead_sales',
                'lead_sales.id',
                'activation_forms.lead_id'
            )
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('activation_forms.status', '1.02')
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('activation_forms.created_at', Carbon::now()->month)
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else{
            // $today = Carbon::today();
            return $postpaid_verified = \App\User::select("users.*")
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
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
            // $status = $status;
        }
        // $status = explode(',', $status);


    }
    public static function CalCenterLeadtypeCombine($id, $status, $type, $channel)
    {
        // return $id;
        // return $status;
        // return $status;
        // $status = trim($status);
        if($status == 'verified'){
            //  $status = "'1.03','1.05','1.07','1.08','1.09','1.10'";
            return $postpaid_verified = \App\User::select("users.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status',
                ['1.05', '1.07', '1.08', '1.09', '1.10','1.02']
            )
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // -> whereDate('lead_sales.created_at', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
            }
            else if($status == 'inprocess'){
                return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
                    ->where('lead_sales.lead_type', $type)
                    // ->where('lead_sales.channel_type', $channel)
                    ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                    ->get()
                    // ->where('users.id', $id)
                    ->count();
            // 1.03,1.05,1.07,1.08,1.09,1.10
        }
        else if($status == 'nonverified'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.04','1.01'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'rejected'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.15'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'followup'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.16','1.17','1.03'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == '1.02'){
            return $active = \App\activation_form::select('activation_forms.id')
                ->LeftJoin(
                    'lead_sales',
                    'lead_sales.id',
                    'activation_forms.lead_id'
                )
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('activation_forms.status', '1.02')
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('activation_forms.created_at', Carbon::now()->month)
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else{
            // $today = Carbon::today();
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->where('lead_sales.status', $status)
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
            // $status = $status;
        }
        // $status = explode(',', $status);


    }
    public static function CalCenterTotalMonth($id, $status, $type, $channel)
    {
        // return $id;
        // return $status;
        // return $status;
        // $status = trim($status);
        if($status == 'verified'){
            //  $status = "'1.03','1.05','1.07','1.08','1.09','1.10'";
            return $postpaid_verified = \App\User::select("users.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status',
                ['1.05', '1.07', '1.08', '1.09', '1.10', '1.02', '1.16', '1.17']
            )
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // -> whereDate('lead_sales.created_at', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
            }
            else if($status == 'inprocess'){
                return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
                    ->where('lead_sales.lead_type', $type)
                    ->where('lead_sales.channel_type', $channel)
                    // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                    ->get()
                    // ->where('users.id', $id)
                    ->count();
            // 1.03,1.05,1.07,1.08,1.09,1.10
        }
        else if($status == 'nonverified'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.04','1.01'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'rejected'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.15'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'followup'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.16','1.17','1.03'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == '1.02'){
            return $active = \App\activation_form::select('activation_forms.id')
            ->LeftJoin(
                'lead_sales',
                'lead_sales.id',
                'activation_forms.lead_id'
            )
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('activation_forms.status', '1.02')
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('activation_forms.created_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else{
            // $today = Carbon::today();
            return $postpaid_verified = \App\User::select("users.*")
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
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
            // $status = $status;
        }
        // $status = explode(',', $status);


    }
    public static function CalCenterLeadtypeDate($id, $status, $type, $channel)
    {
        // return $id;
        // return $status;
        // return $status;
        // $status = trim($status);
        if($status == 'verified'){
            //  $status = "'1.03','1.05','1.07','1.08','1.09','1.10'";
            return $postpaid_verified = \App\User::select("users.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status',
                ['1.05', '1.07', '1.08', '1.09', '1.10', '1.02', '1.16', '1.17']
            )
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
            }
            else if($status == 'inprocess'){
                return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
                    ->where('lead_sales.lead_type', $type)
                    ->where('lead_sales.channel_type', $channel)
                    ->where('users.agent_code', $id)
                    ->whereDate('lead_sales.updated_at', Carbon::today())
                    ->get()
                    // ->where('users.id', $id)
                    ->count();
            // 1.03,1.05,1.07,1.08,1.09,1.10
        }
        else if($status == 'nonverified'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.04','1.01'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'rejected'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.15'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'followup'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.16','1.17','1.03'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == '1.02'){
            return $active = \App\activation_form::select('activation_forms.id')
            ->LeftJoin(
            'lead_sales','lead_sales.id','activation_forms.lead_id'
            )
            ->LeftJoin(
            'users','users.id','lead_sales.saler_id'
            )
            ->where('activation_forms.status', '1.02')
            ->where('lead_sales.lead_type', $type)
            ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', $id)
            ->whereDate('activation_forms.created_at', Carbon::today())
            // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
            ->get()
            // ->where('users.id', $id)
            ->count();
        }
        else{
            // $today = Carbon::today();
            return $postpaid_verified = \App\User::select("users.*")
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
                ->where('users.agent_code', $id)
                ->whereDate('activation_forms.created_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
            // $status = $status;
        }
        // $status = explode(',', $status);


    }
    public static function CalCenterLeadtypeDateCombine($id, $status, $type)
    {
        // return $id;
        // return $status;
        // return $status;
        // $status = trim($status);
        if($status == 'verified'){
            //  $status = "'1.03','1.05','1.07','1.08','1.09','1.10'";
            return $postpaid_verified = \App\User::select("users.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status',
                ['1.05', '1.07', '1.08', '1.09', '1.10', '1.02', '1.16', '1.17']
            )
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
            }
            else if($status == 'inprocess'){
                return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
                    ->where('lead_sales.lead_type', $type)
                    // ->where('lead_sales.channel_type', $channel)
                    ->where('users.agent_code', $id)
                    ->whereDate('lead_sales.date_time', Carbon::today())
                    ->get()
                    // ->where('users.id', $id)
                    ->count();
            // 1.03,1.05,1.07,1.08,1.09,1.10
        }
        else if($status == 'nonverified'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.04','1.01'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'rejected'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.15'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'followup'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.16','1.17','1.03'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == '1.02'){
            // return "000";
            return $active = \App\activation_form::select('activation_forms.id')
                ->LeftJoin(
                    'lead_sales',
                    'lead_sales.id',
                    'activation_forms.lead_id'
                )
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('activation_forms.status', '1.02')
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('activation_forms.created_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else{
            // $today = Carbon::today();
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->where('lead_sales.status', $status)
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                ->where('users.agent_code', $id)
                ->whereDate('lead_sales.updated_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
            // $status = $status;
        }
        // $status = explode(',', $status);


    }
    public static function CalCenterToday($id, $status, $type, $channel)
    {
        // return $id;
        // return $status;
        // return $status;
        // $status = trim($status);
        if($status == 'verified'){
            //  $status = "'1.03','1.05','1.07','1.08','1.09','1.10'";
            return $postpaid_verified = \App\User::select("users.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status',
                ['1.05', '1.07', '1.08', '1.09', '1.10','1.02','1.16','1.17']
            )
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
            }
            else if($status == 'inprocess'){
                return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
                    ->where('lead_sales.lead_type', $type)
                    ->where('lead_sales.channel_type', $channel)
                    // ->where('users.agent_code', $id)
                    ->whereDate('lead_sales.updated_at', Carbon::today())
                    ->get()
                    // ->where('users.id', $id)
                    ->count();
            // 1.03,1.05,1.07,1.08,1.09,1.10
        }
        else if($status == 'nonverified'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.04','1.01'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'rejected'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.15'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'followup'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.16','1.17','1.03'])
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == '1.02'){
            return $active = \App\activation_form::select('activation_forms.id')
                ->LeftJoin(
                    'lead_sales',
                    'lead_sales.id',
                    'activation_forms.lead_id'
                )
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('activation_forms.status', '1.02')
                ->where('lead_sales.lead_type', $type)
                ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('activation_forms.created_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else{
            // $today = Carbon::today();
            return $postpaid_verified = \App\User::select("users.*")
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
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.updated_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
            // $status = $status;
        }
        // $status = explode(',', $status);


    }
    public static function CalCenterTodayCombine($id, $status, $type, $channel)
    {
        // return $id;
        // return $status;
        // return $status;
        // $status = trim($status);
        if($status == 'verified'){
            //  $status = "'1.03','1.05','1.07','1.08','1.09','1.10'";
            return $postpaid_verified = \App\User::select("users.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status',
                ['1.05', '1.07', '1.08', '1.09', '1.10', '1.02', '1.16', '1.17']
            )
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
            }
            else if($status == 'inprocess'){
                return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
                    ->where('lead_sales.lead_type', $type)
                    // ->where('lead_sales.channel_type', $channel)
                    // ->where('users.agent_code', $id)
                    ->whereDate('lead_sales.date_time', Carbon::today())
                    ->get()
                    // ->where('users.id', $id)
                    ->count();
            // 1.03,1.05,1.07,1.08,1.09,1.10
        }
        else if($status == 'nonverified'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.04','1.01'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'rejected'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.15'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'followup'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.16','1.17','1.03'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == '1.02'){
            return $active = \App\activation_form::select('activation_forms.id')
            ->LeftJoin(
                'lead_sales',
                'lead_sales.id',
                'activation_forms.lead_id'
            )
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('activation_forms.status', '1.02')
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('activation_forms.created_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else{
            // $today = Carbon::today();
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->where('lead_sales.status', $status)
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereDate('lead_sales.updated_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
            // $status = $status;
        }
        // $status = explode(',', $status);


    }
    public static function CalCenterMonthlyCombine($id, $status, $type, $channel)
    {
        // return $id;
        // return $status;
        // return $status;
        // $status = trim($status);
        if($status == 'verified'){
            //  $status = "'1.03','1.05','1.07','1.08','1.09','1.10'";
            return $postpaid_verified = \App\User::select("users.*")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status',
                ['1.05', '1.07', '1.08', '1.09', '1.10', '1.02', '1.16', '1.17']
            )
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
            }
            else if($status == 'inprocess'){
                return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
                    ->where('lead_sales.lead_type', $type)
                    // ->where('lead_sales.channel_type', $channel)
                    // ->where('users.agent_code', $id)
                    ->whereDate('lead_sales.date_time', Carbon::today())
                    ->get()
                    // ->where('users.id', $id)
                    ->count();
            // 1.03,1.05,1.07,1.08,1.09,1.10
        }
        else if($status == 'nonverified'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.04','1.01'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'rejected'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.15'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == 'followup'){
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->whereIn('lead_sales.status', ['1.16','1.17','1.03'])
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // ->whereDate('lead_sales.date_time', Carbon::today())
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else if($status == '1.02'){
            return $active = \App\activation_form::select('activation_forms.id')
            ->LeftJoin(
                'lead_sales',
                'lead_sales.id',
                'activation_forms.lead_id'
            )
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('activation_forms.status', '1.02')
                ->where('lead_sales.lead_type', $type)
                ->whereMonth('activation_forms.created_at', Carbon::now()->month)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                // ->whereDate('activation_forms.created_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
        }
        else{
            // $today = Carbon::today();
            return $postpaid_verified = \App\User::select("users.*")
                // $user =  DB::table("subjects")->select('subject_name', 'id')
                ->Join(
                    'lead_sales',
                    'lead_sales.saler_id',
                    '=',
                    'users.id'
                )
                ->where('lead_sales.status', $status)
                ->where('lead_sales.lead_type', $type)
                // ->where('lead_sales.channel_type', $channel)
                // ->where('users.agent_code', $id)
                ->whereMonth('lead_sales.created_at', Carbon::now()->month)
                // ->whereDate('lead_sales.updated_at', Carbon::today())
                // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
                ->get()
                // ->where('users.id', $id)
                ->count();
            // $status = $status;
        }
        // $status = explode(',', $status);


    }
    public static function CalCenterLeadtypeInProcess($id,$status, $status1, $type, $channel)
    {
        // return $id;
        return $postpaid_verified = \App\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->Join(
                'lead_sales',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->whereIn('lead_sales.status', [$status,$status1])
            ->where('lead_sales.lead_type', $type)
            ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', $id)
            // ->where('users.id', $id)
            ->count();
    }
    // public function
    public function DailyReport(Request $request){
        // return $request;
        // return  "Daily Report";
        $channel_partner = channel_partner::whereStatus('1')->get();
        $callcenter = call_center::select('call_centers.*')
        ->where('call_center_name','!=','ARF')
        ->where('call_center_name','!=','CC8-Elife')
        ->where('status','1')->orderBy('call_center_name', 'asc')->get();
        // return $callcenter_today = call_center::select('call_centers.*')
        // ->where('call_center_name','!=','ARF')
        // ->where('call_center_name','!=','CC8-Elife')
        // ->where('status','1')
        // ->where('created_at', Carbon::today())
        // ->get();
        // ->get();
        return view('report.dailyreport',compact('channel_partner', 'callcenter'));
    }
    // public function TodayReport(Request $request){
    //     // return $request;
    //     // return  "Daily Report";
    //     $channel_partner = channel_partner::whereStatus('1')->get();
    //     $callcenter = call_center::select('call_centers.*')
    //     ->where('call_center_name','!=','ARF')
    //     ->where('call_center_name','!=','CC8-Elife')
    //     ->where('status','1')->get();
    //     return view('report.dailyreport',compact('channel_partner', 'callcenter'));
    // }
    public static function plan_above_150($channel_partner){
        // $k =
        // SELECT a.select_plan,c.plan_name,c.monthly_payment from lead_sales a INNER JOIN activation_forms b on b.lead_id = a.id INNER JOIN plans c on c.id = a.select_plan ORDER BY c.monthly_payment DESC
        //
        // return $channel_partner;
        return $k = lead_sale::select('plans.monthly_payment', 'lead_sales.channel_type')
        ->LeftJoin(
            'activation_forms','activation_forms.lead_id','=','lead_sales.id'
        )
        ->LeftJoin(
            'plans','plans.id','=',
            'activation_forms.select_plan'
        )
        ->LeftJoin(
            'users','lead_sales.saler_id','=','users.id'
        )
        ->where('lead_sales.channel_type',$channel_partner)
        ->where('plans.monthly_payment', '>=','150')
        ->whereMonth('activation_forms.created_at', Carbon::now()->month)

        // ->whereDate('lead_sales.date_time', Carbon::today())
        // ->where('users.agent_code', '=',$channel_partner)
        ->where('lead_sales.status','1.02')
        ->count();
    }
    public static function plan_sum($id, $status, $type, $channel){
        // $k =
        // SELECT a.select_plan,c.plan_name,c.monthly_payment from lead_sales a INNER JOIN activation_forms b on b.lead_id = a.id INNER JOIN plans c on c.id = a.select_plan ORDER BY c.monthly_payment DESC
        //
        // return $id . $status . $type . $channel;
        return $k = lead_sale::select('plans.revenue')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'activation_forms.select_plan'
        )
        ->LeftJoin(
            'users',
            'lead_sales.saler_id',
            '=',
            'users.id'
        )
            // ->where('plans.monthly_payment', '<', '150')
        ->where('lead_sales.lead_type', $type)
        ->where('lead_sales.channel_type', $channel)
        ->where('users.agent_code', $id)
        ->where('lead_sales.status', '1.02')
        ->whereDate('activation_forms.date_time', Carbon::today())
        ->sum('plans.revenue');
    }
    public static function plan_sum_combine($id, $status, $type){
        // $k =
        // SELECT a.select_plan,c.plan_name,c.monthly_payment from lead_sales a INNER JOIN activation_forms b on b.lead_id = a.id INNER JOIN plans c on c.id = a.select_plan ORDER BY c.monthly_payment DESC
        //
        // return $id . $status . $type . $channel;
        return $k = lead_sale::select('plans.revenue')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'activation_forms.select_plan'
        )
        ->LeftJoin(
            'users',
            'lead_sales.saler_id',
            '=',
            'users.id'
        )
            // ->where('plans.monthly_payment', '<', '150')
        ->where('lead_sales.lead_type', $type)
        // ->where('lead_sales.channel_type', $channel)
        ->where('users.agent_code', $id)
        ->where('lead_sales.status', '1.02')
        ->whereDate('activation_forms.created_at', Carbon::today())

        ->sum('plans.revenue');
    }
    public static function plan_sum_monthly($id, $status, $type, $channel){
        // $k =
        // SELECT a.select_plan,c.plan_name,c.monthly_payment from lead_sales a INNER JOIN activation_forms b on b.lead_id = a.id INNER JOIN plans c on c.id = a.select_plan ORDER BY c.monthly_payment DESC
        //
        // return $id . $status . $type . $channel;
        return $k = lead_sale::select('plans.revenue')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'activation_forms.select_plan'
        )
        ->LeftJoin(
            'users',
            'lead_sales.saler_id',
            '=',
            'users.id'
        )
            // ->where('plans.monthly_payment', '<', '150')
        ->where('lead_sales.lead_type', $type)
        ->where('lead_sales.channel_type', $channel)
        ->where('users.agent_code', $id)
        ->where('lead_sales.status', '1.02')
        ->whereMonth('activation_forms.created_at', Carbon::now()->month)
        ->sum('plans.revenue');
    }
    public static function plan_sum_monthly_combine($id, $status, $type, $channel){
        // $k =
        // SELECT a.select_plan,c.plan_name,c.monthly_payment from lead_sales a INNER JOIN activation_forms b on b.lead_id = a.id INNER JOIN plans c on c.id = a.select_plan ORDER BY c.monthly_payment DESC
        //
        // return $id . $status . $type . $channel;
        return $k = lead_sale::select('plans.revenue')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'activation_forms.select_plan'
        )
        ->LeftJoin(
            'users',
            'lead_sales.saler_id',
            '=',
            'users.id'
        )
            // ->where('plans.monthly_payment', '<', '150')
        ->where('lead_sales.lead_type', $type)
        // ->where('lead_sales.channel_type', $channel)
        ->where('users.agent_code', $id)
        ->where('lead_sales.status', '1.02')
        ->whereMonth('activation_forms.created_at', Carbon::now()->month)
        ->sum('plans.revenue');
    }
    public static function plan_below_150($channel_partner){
        return $k = lead_sale::select('plans.monthly_payment')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'lead_sales.select_plan'
        )
        ->LeftJoin(
            'users',
            'activation_forms.saler_id',
            '=',
            'users.id'
        )
        ->where('plans.monthly_payment', '<', '150')
        ->where('lead_sales.channel_type', $channel_partner)
        ->where('lead_sales.status', '1.02')
        ->whereMonth('activation_forms.created_at', Carbon::now()->month)
        ->count();
    }
    public static function plan_total($channel_partner){
        return $k = lead_sale::select('plans.monthly_payment')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'activation_forms.select_plan'
        )
        ->LeftJoin(
            'users',
            'lead_sales.saler_id',
            '=',
            'users.id'
        )
        // ->where('plans.monthly_payment', '<', '150')
        // ->where('users.agent_code', '=', $channel_partner)
        ->where('lead_sales.status', '1.02')
        ->where('lead_sales.channel_type',$channel_partner)
        ->whereMonth('activation_forms.created_at', Carbon::now()->month)
        ->count();
    }
    public function MonthlyActivation(Request $request){
        // return $request;
        // SELECT b.customer_name,c.plan_name,a.customer_number,a.selected_number,a.created_at as created_date,d.created_at as lead_assign_date, a.emirates,b.created_at as activated_date from lead_sales a INNER JOIN activation_forms b on b.lead_id = a.id INNER JOIN plans c on c.id = a.select_plan INNER JOIN lead_locations d on d.lead_id = a.id

        // return $r = lead_sale::select('lead_sales.customer_name','plans.plan_name','lead_sales.selected_number','lead_sales.customer_number','lead_sales.created_at as create_date', 'lead_locations.created_at as assign_date','activation_forms.created_at as activation_date')
        // ->LeftJoin(
        //     'activation_forms','activation_forms.lead_id','=','lead_sales.id'
        // )
        // ->LeftJoin(
        //     'plans','plans.id','=','lead_sales.select_plan'
        // )
        // ->LeftJoin(
        //     'lead_locations',
        //     'lead_locations.lead_id','=','lead_sales.id'
        // )
        // ->where('lead_sales.status','1.02')
        // ->get();
        $channel_partner = channel_partner::whereStatus('1')->get();
        return view('report.activationreport', compact('channel_partner'));


    }
    public static function carry_forward($id,$type,$channel){
        // return Carbon::now()->subMonth()->month;
        return $postpaid_verified = \App\User::select("users.*")
        // $user =  DB::table("subjects")->select('subject_name', 'id')
        ->Join(
            'lead_sales',
            'lead_sales.saler_id',
            '=',
            'users.id'
        )
            ->whereIn('lead_sales.status', ['1.05', '1.07', '1.08', '1.09', '1.10'])
            ->where('lead_sales.lead_type', $type)
            ->where('lead_sales.channel_type', $channel)
            ->where('users.agent_code', $id)
            ->whereMonth('lead_sales.created_at', '=', Carbon::now()->subMonth()->month)
            // ->whereDate('lead_sales.updated_at', Carbon::today())
            ->get()
            // ->where('users.id', $id)
            ->count();
    }
    public function DailyActivation(Request $request){
        $channel_partner = channel_partner::whereStatus('1')->get();
        $callcenter = call_center::select('call_centers.*')
            ->where('call_center_name', '!=', 'ARF')
            ->where('call_center_name', '!=', 'CC8-Elife')
            ->where('status', '1')->orderBy('call_center_name', 'asc')->get();
        // return $callcenter_today = call_center::select('call_centers.*')
        // ->where('call_center_name','!=','ARF')
        // ->where('call_center_name','!=','CC8-Elife')
        // ->where('status','1')
        // ->where('created_at', Carbon::today())
        // ->get();
        // ->get();
        return view('report.ActivationReport2', compact('callcenter'));

        // return view('report.dailyreport', compact('channel_partner', 'callcenter'));
    }
    public function MonthlyTarget(Request $request){
        $channel_partner = channel_partner::whereStatus('1')->get();
        $callcenter = call_center::select('call_centers.*')
            ->where('call_center_name', '!=', 'ARF')
            ->where('call_center_name', '!=', 'CC8-Elife')
            ->where('status', '1')->orderBy('call_center_name', 'asc')->get();
        // return $callcenter_today = call_center::select('call_centers.*')
        // ->where('call_center_name','!=','ARF')
        // ->where('call_center_name','!=','CC8-Elife')
        // ->where('status','1')
        // ->where('created_at', Carbon::today())
        // ->get();
        // ->get();
        return view('report.monthlytarget', compact('callcenter'));

        // return view('report.dailyreport', compact('channel_partner', 'callcenter'));
    }
    public static function ActivationUser($userid,$date){
        return $k = activation_form::select('id')
        ->where('saler_id', $userid)
        ->where('activation_date', $date)
        // ->where('')
        ->count();
    }
    public static function ActivationUserGrandTotal($userid){
        return $k = activation_form::select('id')
        ->where('saler_id', $userid)
        // ->where('activation_date', $date)
        ->whereMonth('activation_forms.activation_date', Carbon::now()->month)

        // ->where('')
        ->count();
    }
    public static function ActivationCallAgent($userid,$date){
        // return $userid;
        return $k = activation_form::select('id')
        ->LeftJoin(
            'users','users.id','activation_forms.saler_id'
        )
        ->where('users.agent_code', $userid)
        ->where('activation_forms.activation_date', $date)
            // ->where('')
        ->count();
    }
    public static function ActivationCallAgentBetween($userid,$date1,$date2){
        // return $userid;
        // return $date1 . $date2;
        return $k = activation_form::select('id')
        ->LeftJoin(
            'users','users.id','activation_forms.saler_id'
        )
        ->where('users.agent_code', $userid)
        ->whereBetween('activation_forms.activation_date', [$date1, $date2])
            // ->where('')
        ->count();
    }
    public static function ActivationCallAgentGrandTotal($userid){
        // return $userid;
        return $k = activation_form::select('id')
        ->LeftJoin(
            'users','users.id','activation_forms.saler_id'
        )
        ->where('users.agent_code', $userid)
            // ->where('activation_forms.activation_date', $date)
            // ->where('')
        ->whereMonth('activation_forms.activation_date', Carbon::now()->month)
        ->count();
    }
    // public static function ActivationCallAgentBetween($userid){
    //     // return $userid;
    //     return $k = activation_form::select('id')
    //     ->LeftJoin(
    //         'users','users.id','activation_forms.saler_id'
    //     )
    //     ->where('users.agent_code', $userid)
    //         // ->where('activation_forms.activation_date', $date)
    //         // ->where('')
    //     ->whereMonth('activation_forms.activation_date', Carbon::now()->month)
    //     ->count();
    // }
    public static function ActivationGrandTotal(){
        // return $userid;
        return $k = activation_form::select('id')
        ->LeftJoin(
            'users','users.id','activation_forms.saler_id'
        )
        // ->where('users.agent_code', $userid)
            // ->where('activation_forms.activation_date', $date)
            // ->where('')
        ->whereMonth('activation_forms.activation_date', Carbon::now()->month)
        ->count();
    }
    public static function TotalPaid($id, $type, $channel){
        // return $id . $type . $channel;
        // return "30";
        return $k = lead_sale::select('plans.monthly_payment', 'lead_sales.channel_type')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'lead_sales.select_plan'
        )
            ->LeftJoin(
                'users',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.channel_type', $channel)
            ->where('lead_sales.lead_type', $type)
            // ->where('users.agent_code', $type)
            ->whereDate('activation_forms.created_at', Carbon::now()->month)
            ->where('lead_sales.status', '1.02')
            ->count();
    }
    public static function TotalPaidCallAgent($id, $type, $channel){
        // return $id . $type . $channel;
        // return "30";
        return $k = lead_sale::select('plans.monthly_payment', 'lead_sales.channel_type')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'lead_sales.select_plan'
        )
            ->LeftJoin(
                'users',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.channel_type', $channel)
            ->where('lead_sales.lead_type', $type)
            ->where('users.agent_code', $id)
            ->whereDate('activation_forms.created_at', Carbon::today())
            ->where('lead_sales.status', '1.02')
            ->count();
    }
    public static function TotalPaidMonthlyCallCenter($id, $type, $channel){
        // return $id . $type . $channel;
        // return "30";
        return $k = lead_sale::select('plans.monthly_payment', 'lead_sales.channel_type')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'lead_sales.select_plan'
        )
            ->LeftJoin(
                'users',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.channel_type', $channel)
            ->where('lead_sales.lead_type', $type)
            ->where('users.agent_code', $id)
            ->whereMonth('activation_forms.created_at', Carbon::now()->month)
            ->where('lead_sales.status', '1.02')
            ->count();
    }
    public static function TotalPaidMonthly($id, $type, $channel){
        // return $id . $type . $channel;
        // return "30";
        return $k = lead_sale::select('plans.monthly_payment', 'lead_sales.channel_type')
        ->LeftJoin(
            'activation_forms',
            'activation_forms.lead_id',
            '=',
            'lead_sales.id'
        )
        ->LeftJoin(
            'plans',
            'plans.id',
            '=',
            'lead_sales.select_plan'
        )
            ->LeftJoin(
                'users',
                'lead_sales.saler_id',
                '=',
                'users.id'
            )
            ->where('lead_sales.channel_type', $channel)
            ->where('lead_sales.lead_type', $type)
            // ->where('users.agent_code', $id)
            ->whereMonth('activation_forms.created_at', Carbon::now()->month)
            ->where('lead_sales.status', '1.02')
            ->count();
    }
}
