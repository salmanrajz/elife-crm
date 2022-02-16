<?php

namespace App\Http\Controllers;

use App\lead_sale;
use App\verification_form;
use Illuminate\Http\Request;

class CoordinaterController extends Controller
{
    //
    public static function emirate_lead($status, $emirate){
        return $tmkoc = lead_sale::select('lead_sales.*')
            ->join(
                'users',
                'users.id',
                '=',
                'lead_sales.saler_id'
            )
            ->join(
                'verification_forms','verification_forms.lead_no','=','lead_sales.id'
            )
            ->join(
            'lead_locations',
            'lead_locations.lead_id','=','lead_sales.id'
            )
            ->where('lead_locations.assign_to',auth()->user()->id)
            ->where('lead_sales.status', $status)
            ->where('lead_sales.emirates', $emirate)
            ->count();

    }
    public static function emirate_lead_all($status){
        return $tmkoc = lead_sale::select('lead_sales.*')
            ->join(
                'users',
                'users.id',
                '=',
                'lead_sales.saler_id'
            )
            ->join(
                'verification_forms','verification_forms.lead_no','=','lead_sales.id'
            )
            ->join(
            'lead_locations',
            'lead_locations.lead_id','=','lead_sales.id'
            )
            ->where('lead_locations.assign_to',auth()->user()->id)
            ->where('lead_sales.status', $status)
            // ->where('lead_sales.emirates', $emirate)
            ->count();

    }
    public static function emirate_lead_assigned_all($status){
        return $tmkoc = lead_sale::select('lead_sales.*')
            ->join(
                'users',
                'users.id',
                '=',
                'lead_sales.saler_id'
            )
            ->join(
                'verification_forms','verification_forms.lead_no','=','lead_sales.id'
            )
            ->join(
            'lead_locations',
            'lead_locations.lead_id','=','lead_sales.id'
            )
            ->where('lead_locations.assign_to','!=',auth()->user()->id)
            ->where('lead_sales.status', $status)
            // ->where('lead_sales.emirates', $emirate)
            ->count();

    }
    public static function emirate_lead_assigned($status, $emirate){
        return $tmkoc = lead_sale::select('lead_sales.*')
            ->join(
                'users',
                'users.id',
                '=',
                'lead_sales.saler_id'
            )
            ->join(
                'verification_forms','verification_forms.lead_no','=','lead_sales.id'
            )
            ->join(
            'lead_locations',
            'lead_locations.lead_id','=','lead_sales.id'
            )
            ->where('lead_locations.assign_to','!=',auth()->user()->id)
            ->where('lead_sales.status', $status)
            ->where('lead_sales.emirates', $emirate)
            ->count();

    }
    public function emirate($id){
        if($id == 'All'){
            $operation = verification_form::select("verification_forms.lead_no", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "status_codes.status_name", "lead_locations.assign_to")
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
                    'status_codes',
                    'status_codes.status_code',
                    '=',
                    'verification_forms.status'
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
                    'lead_sales.saler_id'
                )
                ->LeftJoin(
                    'lead_locations',
                    'lead_locations.lead_id',
                    '=',
                    'lead_sales.id'
                )
                ->where('lead_locations.assign_to', '=', auth()->user()->id)
                ->where('lead_sales.status', '1.10')
                // ->where('lead_sales.emirates', $id)
                // ->where('verification_forms.assing_to', auth()->user()->id)
                // ->where('verification_forms.emirate_location', auth()->user()->emirate)
                ->groupBy('verification_forms.lead_no')
                ->latest()
                ->get();
            // $operation = verification_form::wherestatus('1.10')->get();
            return view('dashboard.view-proceed-request', compact('operation'));
        }
        else{


        $operation = verification_form::select("verification_forms.lead_no", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "status_codes.status_name", "lead_locations.assign_to")
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
                'status_codes',
                'status_codes.status_code',
                '=',
                'verification_forms.status'
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
                'lead_sales.saler_id'
            )
            ->LeftJoin(
                'lead_locations',
                'lead_locations.lead_id',
                '=',
                'lead_sales.id'
            )
            ->where('lead_locations.assign_to', '=', auth()->user()->id)
            ->where('lead_sales.status', '1.10')
            ->where('lead_sales.emirates', $id)
            // ->where('verification_forms.assing_to', auth()->user()->id)
            // ->where('verification_forms.emirate_location', auth()->user()->emirate)
            ->groupBy('verification_forms.lead_no')
            ->latest()
            ->get();
        // $operation = verification_form::wherestatus('1.10')->get();
        return view('dashboard.view-proceed-request', compact('operation'));
        }
    }
    public function emirate_assigned($id){
        if($id == 'All'){
            $operation = verification_form::select("verification_forms.lead_no", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "status_codes.status_name", "lead_locations.assign_to")
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
                'status_codes',
                'status_codes.status_code',
                '=',
                'verification_forms.status'
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
                'lead_sales.saler_id'
            )
            ->LeftJoin(
                'lead_locations',
                'lead_locations.lead_id',
                '=',
                'lead_sales.id'
            )
            ->where('lead_locations.assign_to', '!=', auth()->user()->id)
            ->where('lead_sales.status', '1.10')
            // ->where('lead_sales.emirates', $id)
            ->latest()

                // ->where('verification_forms.assing_to', auth()->user()->id)
                // ->where('verification_forms.emirate_location', auth()->user()->emirate)
                ->groupBy('verification_forms.lead_no')
                ->get();
            // $operation = verification_form::wherestatus('1.10')->get();
            return view('dashboard.view-proceed-request', compact('operation'));
        }else{
            $operation = verification_form::select("verification_forms.lead_no", "timing_durations.lead_generate_time", "verification_forms.*", "remarks.remarks as latest_remarks", "status_codes.status_name", "lead_locations.assign_to")
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
                'status_codes',
                'status_codes.status_code',
                '=',
                'verification_forms.status'
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
                'lead_sales.saler_id'
            )
            ->LeftJoin(
                'lead_locations',
                'lead_locations.lead_id',
                '=',
                'lead_sales.id'
            )
            ->where('lead_locations.assign_to', '!=', auth()->user()->id)
            ->where('lead_sales.status', '1.10')
            ->where('lead_sales.emirates', $id)
            ->latest()

                // ->where('verification_forms.assing_to', auth()->user()->id)
                // ->where('verification_forms.emirate_location', auth()->user()->emirate)
                ->groupBy('verification_forms.lead_no')
                ->get();
            // $operation = verification_form::wherestatus('1.10')->get();
            return view('dashboard.view-proceed-request', compact('operation'));
        }
    }
    public static function assign_count($id){
        // return $id;
        return $operation = verification_form::select("verification_forms.lead_no")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            // ->Join(
            //     'timing_durations',
            //     'timing_durations.lead_no',
            //     '=',
            //     'verification_forms.lead_no'
            // )
            // ->Join(
            //     'lead_sales',
            //     'lead_sales.id',
            //     '=',
            //     'verification_forms.lead_no'
            // )
            // ->Join(
            //     'remarks',
            //     'remarks.lead_no',
            //     '=',
            //     'verification_forms.lead_no'
            // )
            // ->Join(
            //     'status_codes',
            //     'status_codes.status_code',
            //     '=',
            //     'verification_forms.status'
            // )
            ->Join(
                'lead_locations',
                'lead_locations.lead_id',
                '=',
                'verification_forms.lead_no'
            )
            ->where('verification_forms.status', '1.10')
            ->where('lead_locations.assign_to', $id)
            // ->where('verification_forms.emirate_location', auth()->user()->emirate)
            // ->groupBy('verification_forms.lead_no')
            ->count();
    }
}
