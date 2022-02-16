<?php

namespace App\Http\Controllers;

use App\billing_sale;
use App\dataentry;
use App\elife_sale;
use App\lead_sale;
use App\numberdetail;
use App\postpaid_sales;
use App\prepaid_sale;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    //
    public function ManageRecording($id,$channel){
        $journalName = str_replace('-', ' ', $channel);
        if ($journalName == 'Elife Telesales') {
            if ($id == 'rec') {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->where('sale_type', $journalName)
                    ->whereNull('audio')
                    ->wherein('elife_sales.status',['1.04','1.21','1.19'])
                    // ->where('elife_sales.status',$id)
                    ->get();
                return view('dashboard.manager.RecgrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->where('sale_type', $journalName)
                    ->where('elife_sales.status', $id)->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Elife DTD') {
            if ($id == 'rec') {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->where('sale_type', $journalName)
                    ->whereNull('audio')
                    ->wherein('elife_sales.status', ['1.04', '1.21', '1.19'])

                    // ->where('elife_sales.status',$id)
                    ->get();

                return view('dashboard.manager.RecgrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->where('sale_type', $journalName)
                    ->where('elife_sales.status', $id)->get();

                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Elife Kiosk') {
            if ($id == 'rec') {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->where('sale_type', $journalName)
                    ->whereNull('audio')
                    ->wherein('elife_sales.status', ['1.04', '1.21', '1.19'])
                    // ->where('elife_sales.status', $id)
                    ->get();
                return view('dashboard.manager.RecgrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                    ->where('sale_type', $journalName)
                    ->where('elife_sales.status', $id)
                    ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        }
    }
    public function ManagerController($id,$channel){
       $journalName = str_replace('-', ' ', $channel);
       if($journalName == 'Elife Telesales'){
           if($id == '1.00'){
               $operation =  elife_sale::select('elife_sales.*','status_codes.status_name')
               ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
               )
                ->where('sale_type',$journalName)
                // ->where('elife_sales.status',$id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel','id'));
           }
           else{
               $operation =  elife_sale::select('elife_sales.*','status_codes.status_name')
               ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
               )
                ->where('sale_type',$journalName)
                ->where('elife_sales.status',$id)->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel','id'));

           }

        }
        else if($journalName == 'Elife DTD'){
            if ($id == '1.00') {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                // ->where('elife_sales.status',$id)
                ->get();

                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }
            else{
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                ->where('elife_sales.status',$id)->get();

                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));

            }
        }
        else if($journalName == 'Elife Kiosk'){
            if($id == '1.00'){
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                // ->where('elife_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }
            else{
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                ->where('elife_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }
       }
        else if($journalName == 'Postpaid Telesales'){
            if($id == '1.00'){
                $operation =  postpaid_sales::select('postpaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'postpaid_sales.status'
                )
                ->where('sale_type', $journalName)
                // ->where('postpaid_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }
            else{
                $operation =  postpaid_sales::select('postpaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'postpaid_sales.status'
                )
                ->where('sale_type', $journalName)
                ->where('postpaid_sales.status', $id)->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));

            }
       }
        else if($journalName == 'Postpaid kiosk'){
            if($id == '1.00'){
                $operation =  postpaid_sales::select('postpaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'postpaid_sales.status'
                )
                ->where('sale_type', $journalName)
                // ->where('postpaid_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }else{

            $operation =  postpaid_sales::select('postpaid_sales.*', 'status_codes.status_name')
            ->Join(
                'status_codes',
                'status_codes.status_code',
                'postpaid_sales.status'
            )
            ->where('sale_type', $journalName)
            ->where('postpaid_sales.status', $id)->get();
            return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }

       }
        else if($journalName == 'Accessories Kiosk'){
            if($id == '1.00'){
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                    // ->where('sale_type', $journalName)
                    // ->where('sale_type', $journalName)
                    // ->where('prepaid_sale.status', $id)
                    ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }else{
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                    // ->where('sale_type', $journalName)
                    // ->where('sale_type', $journalName)
                    ->where('prepaid_sale.status', $id)->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));

            }
       }
        else if($journalName == 'Accessories Kiosk'){
            if($id == '1.00'){
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                // ->where('prepaid_sale.status', $id)->get();
                    // ->where('sale_type', $journalName)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }
            else{
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                ->where('prepaid_sale.status', $id)->get();
                    // ->where('sale_type', $journalName)
                // ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));

            }
       }
        else if($journalName == 'Control Line Kiosk'){
            if($id == '1.00'){
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                ->where('product_type', 'Control Line')
                // ->where('prepaid_sale.status', $id)
                ->get();
                // ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));
            }
            else{
                $operation =  prepaid_sale::select('prepaid_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'prepaid_sales.status'
                )
                ->where('product_type', 'Control Line')
                ->where('prepaid_sale.status', $id)->get();
                // ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation','channel', 'id'));

            }
       }
        else if($journalName == 'Billing Kiosk'){
            if($id == '1.00'){
                $operation =  billing_sale::select('billing_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'billing_sales.status'
                )
                ->where('sale_type', $journalName)
                // ->where('prepaid_sale.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadBilling', compact('operation','channel', 'id'));
            }
            else{
                $operation =  billing_sale::select('billing_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'billing_sales.status'
                )
                ->where('sale_type', $journalName)
                ->where('billing_sales.status', $id)->get();
                return view('dashboard.manager.mygrpleadBilling', compact('operation','channel', 'id'));

            }
       }
       else if($journalName == 'Data Entry'){
            //    return "Boom";
            $data = dataentry::all();
            return view('dashboard.view-saler-data', compact('data'));
       }

    }

    public function AddRecording($id,$channel,$leadid){
        // return $id . $channel . $leadid;
        $daring = explode('-', $channel);
        $type = $daring['0'];
        $ptype = $daring['1'];
        $countries = \App\country_phone_code::all();
        $emirates = \App\emirate::all();
        $plans = \App\plan::wherestatus('1')->get();
        $elifes = \App\elife_plan::wherestatus('1')->get();
        $addons = \App\addon::wherestatus('1')->get();
        $itproducts = \App\it_products::wherestatus('1')->get();
        // $users = \App\User::whererole('sale')->get();
        $last = \App\lead_sale::latest()->first();
        $users = \App\User::select("users.*")
            ->whereIn('role', array('sale', 'NumberAdmin'))
            ->where('agent_code', auth()->user()->agent_code)
            ->where('id', '!=', auth()->user()->id)
            ->get();
        // $runner = \App\User::select("users.*")
        //     ->whereIn('role', array('runner'))
        //     ->where('agent_code', auth()->user()->agent_code)
        //     ->where('id', '!=', auth()->user()->id)
        //     ->get();
        $q = numberdetail::select("numberdetails.type")
        ->where("numberdetails.status", "Available")
        ->where("numberdetails.channel_type", $daring)
        ->groupBy('numberdetails.type')
            ->get();
        $data = elife_sale::findorfail($leadid);
        return view('dashboard.rec-lead', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q', 'data'));
    }

    public function attend_lead($id,$channel,$leadid){
        if($id == '1.01'){
            // return $id . $channel;
            $daring = explode('-', $channel);
            $type = $daring['0'];
            $ptype = $daring['1'];
            $countries = \App\country_phone_code::all();
            $emirates = \App\emirate::all();
            $plans = \App\plan::wherestatus('1')->get();
            $elifes = \App\elife_plan::wherestatus('1')->get();
            $addons = \App\addon::wherestatus('1')->get();
            $itproducts = \App\it_products::wherestatus('1')->get();
            // $users = \App\User::whererole('sale')->get();
            $last = \App\lead_sale::latest()->first();
            $users = \App\User::select("users.*")
                ->whereIn('role', array('sale', 'NumberAdmin'))
                ->where('agent_code', auth()->user()->agent_code)
                ->where('id', '!=', auth()->user()->id)
                ->get();
            $runner = \App\User::select("users.*")
                ->whereIn('role', array('runner'))
                ->where('agent_code', auth()->user()->agent_code)
                ->where('id', '!=', auth()->user()->id)
                ->get();
            $q = numberdetail::select("numberdetails.type")
            ->where("numberdetails.status", "Available")
            ->where("numberdetails.channel_type", $daring)
            ->groupBy('numberdetails.type')
            ->get();
            $data = elife_sale::findorfail($leadid);
            return view('dashboard.manage-lead', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q','data', 'runner'));
        }
        elseif($id == '1.10'){
            // return $id . $channel;
            $daring = explode('-', $channel);
            $type = $daring['0'];
            $ptype = $daring['1'];
            $countries = \App\country_phone_code::all();
            $emirates = \App\emirate::all();
            $plans = \App\plan::wherestatus('1')->get();
            $elifes = \App\elife_plan::wherestatus('1')->get();
            $addons = \App\addon::wherestatus('1')->get();
            $itproducts = \App\it_products::wherestatus('1')->get();
            // $users = \App\User::whererole('sale')->get();
            $last = \App\lead_sale::latest()->first();
            $users = \App\User::select("users.*")
                ->whereIn('role', array('sale', 'NumberAdmin'))
                ->where('agent_code', auth()->user()->agent_code)
                ->where('id', '!=', auth()->user()->id)
                ->get();
            // $runner = \App\User::select("users.*")
            //     ->whereIn('role', array('runner'))
            //     ->where('agent_code', auth()->user()->agent_code)
            //     ->where('id', '!=', auth()->user()->id)
            //     ->get();
            $q = numberdetail::select("numberdetails.type")
            ->where("numberdetails.status", "Available")
            ->where("numberdetails.channel_type", $daring)
            ->groupBy('numberdetails.type')
            ->get();
            $data = elife_sale::findorfail($leadid);
            return view('dashboard.activate-lead', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q','data'));
        }
        elseif($id == '1.02'){
            // return $id . $channel;
            $daring = explode('-', $channel);
            $type = $daring['0'];
            $ptype = $daring['1'];
            $countries = \App\country_phone_code::all();
            $emirates = \App\emirate::all();
            $plans = \App\plan::wherestatus('1')->get();
            $elifes = \App\elife_plan::wherestatus('1')->get();
            $addons = \App\addon::wherestatus('1')->get();
            $itproducts = \App\it_products::wherestatus('1')->get();
            // $users = \App\User::whererole('sale')->get();
            $last = \App\lead_sale::latest()->first();
            $users = \App\User::select("users.*")
                ->whereIn('role', array('sale', 'NumberAdmin'))
                ->where('agent_code', auth()->user()->agent_code)
                ->where('id', '!=', auth()->user()->id)
                ->get();
            // $runner = \App\User::select("users.*")
            //     ->whereIn('role', array('runner'))
            //     ->where('agent_code', auth()->user()->agent_code)
            //     ->where('id', '!=', auth()->user()->id)
            //     ->get();
            $q = numberdetail::select("numberdetails.type")
            ->where("numberdetails.status", "Available")
            ->where("numberdetails.channel_type", $daring)
            ->groupBy('numberdetails.type')
            ->get();
            $data = elife_sale::findorfail($leadid);
            return view('dashboard.finalize-lead', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q','data'));
        }
    }
    public function AgentLeadData($agentid,$channel,$leadid,$id){
        // return $agentid . $channel . $leadid.$status;
        $journalName = str_replace('-', ' ', $channel);
        if ($journalName == 'Elife Telesales') {
            if ($id == '1.00') {
                $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                    // ->where('elife_sales.status',$id)
                    ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                // return $journalName;
                 $operation =  elife_sale::select('elife_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                ->where('elife_sales.status', $id)
                ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Elife DTD') {
            if ($id == '1.00'
            ) {
                $operation =  elife_sale::select('elife_sales.*',
                    'status_codes.status_name'
                )
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                    // ->where('elife_sales.status',$id)
                    ->get();

                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  elife_sale::select('elife_sales.*',
                    'status_codes.status_name'
                )
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                    ->where('elife_sales.status', $id)->get();

                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            }
        } else if ($journalName == 'Elife Kiosk') {
            if ($id == '1.00') {
                $operation =  elife_sale::select('elife_sales.*',
                    'status_codes.status_name'
                )
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
                )
                ->where('sale_type', $journalName)
                    // ->where('elife_sales.status', $id)
                    ->get();
                return view('dashboard.manager.mygrpleadElife', compact('operation', 'channel', 'id'));
            } else {
                $operation =  elife_sale::select('elife_sales.*',
                    'status_codes.status_name'
                )
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'elife_sales.status'
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
                ->where('sale_type', $journalName)
                    // ->where('prepaid_sale.status', $id)
                    ->get();
                return view('dashboard.manager.mygrpleadBilling',
                    compact('operation', 'channel', 'id')
                );
            } else {
                $operation =  billing_sale::select('billing_sales.*', 'status_codes.status_name')
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'billing_sales.status'
                )
                ->where('sale_type', $journalName)
                    ->where('prepaid_sale.status', $id)->get();
                return view('dashboard.manager.mygrpleadBilling',
                    compact('operation', 'channel', 'id')
                );
            }
        }
    }
}
