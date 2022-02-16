<?php

namespace App\Http\Controllers;

use App\billing_sale;
use App\elife_sale;
use App\postpaid_sales;
use App\prepaid_sale;
use Illuminate\Http\Request;
// use app\team_leader;
use App\team_leader;
use App\User;

class TeamController extends Controller
{
    //
    public function myteam(Request $request){
        // return "Team";
         $data = team_leader::select('users.name','team_leaders.teamleader_id','team_leaders.userid')
         ->Join(
             'users','users.id','team_leaders.userid'
         )
         ->where('teamleader_id',auth()->user()->id)->get();
        // return
        return view('team.myteam',compact('data'));
    }
    //
    public function myteamid(Request $request){
        // return $request->slug;
        $user = User::findorfail($request->slug);
        $data = $user->getAllPermissions();
        return view('team.team-channel',compact('data','user'));
        // return view('dashboard.show-channel', compact('data'));
    }
    //
    public function TeamChannel(Request $request){
        // return $request->id . '-'. $request->channel;
        $agent_id = $request->id;
        $channel_name = $request->channel;
        return view('team.team-dashboard',compact('agent_id','channel_name'));
    }
    //
    public function ShowTeamMemberLead(Request $request){
        $channel = $request->channel;
        $id = $request->id;
        $journalName = str_replace('-', ' ', $channel);
        //
        if ($journalName == 'Elife Telesales') {
            if ($id == '1.00'
            ) {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->Join(
                    'users','users.id','elife_sales.saler_id'
                )
                ->where('sale_type', $journalName)
                // ->where('elife_sales.status',$id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->Join(
                    'users',
                    'users.id',
                    'elife_sales.saler_id'
                )
                ->where('sale_type', $journalName)
                ->where('elife_sales.status', $id)->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Elife DTD') {
            if ($id == '1.00') {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'elife_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                // ->where('elife_sales.status',$id)
                ->get();

                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'elife_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                ->where('elife_sales.status', $id)->get();

                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Elife Kiosk') {
            if ($id == '1.00') {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'elife_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                // ->where('elife_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'elife_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                ->where('elife_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Postpaid Telesales') {
            if ($id == '1.00') {
                $operation =  postpaid_sales::select('postpaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'postpaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'postpaid_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                // ->where('postpaid_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  postpaid_sales::select('postpaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'postpaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'postpaid_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                ->where('postpaid_sales.status', $id)->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Postpaid kiosk') {
            if ($id == '1.00') {
                $operation =  postpaid_sales::select('postpaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'postpaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'postpaid_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                // ->where('postpaid_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {

                $operation =  postpaid_sales::select('postpaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'postpaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'postpaid_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                ->where('postpaid_sales.status', $id)->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Accessories Kiosk') {
            if ($id == '1.00') {
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'prepaid_sales.saler_id'
                    )
                // ->where('sale_type', $journalName)
                // ->where('sale_type', $journalName)
                // ->where('prepaid_sale.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'prepaid_sales.saler_id'
                    )
                // ->where('sale_type', $journalName)
                // ->where('sale_type', $journalName)
                ->where('prepaid_sale.status', $id)->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Accessories Kiosk') {
            if ($id == '1.00') {
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'prepaid_sales.saler_id'
                    )
                // ->where('prepaid_sale.status', $id)->get();
                // ->where('sale_type', $journalName)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'prepaid_sales.saler_id'
                    )
                ->where('prepaid_sale.status', $id)->get();
                // ->where('sale_type', $journalName)
                // ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Control Line Kiosk') {
            if ($id == '1.00') {
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'prepaid_sales.saler_id'
                    )
                ->where('product_type', 'Control Line')
                // ->where('prepaid_sale.status', $id)
                ->get();
                // ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'prepaid_sales.saler_id'
                    )
                ->where('product_type', 'Control Line')
                ->where('prepaid_sale.status', $id)->get();
                // ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Billing Kiosk') {
            if ($id == '1.00') {
                $operation =  billing_sale::select('billing_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'billing_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'billing_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                // ->where('prepaid_sale.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadBilling', compact('operation', 'channel', 'id'));
            } else {
                $operation =  billing_sale::select('billing_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'billing_sales.status'
                )
                    ->Join(
                        'users',
                        'users.id',
                        'billing_sales.saler_id'
                    )
                ->where('sale_type', $journalName)
                ->where('prepaid_sale.status', $id)->get();
                return view('dashboard.manager.mygrpleadBilling', compact('operation', 'channel', 'id'));
            }
        }
        //

    }
}
