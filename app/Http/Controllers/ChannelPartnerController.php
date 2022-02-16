<?php

namespace App\Http\Controllers;

use App\channel_partner;
use App\kiosk_id;
use App\numberdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class ChannelPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return "boom";
        $data = channel_partner::all();
        // $roles = Spatie\Permission\Models\Role::all();

        return view('dashboard.view-partner',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.add-partner');
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
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:channel_partners,name',
            'status' => 'required',
            'partner_type' => 'required',
        ]);






        if ($validatedData->fails()) {
            return redirect()->back()
            ->withErrors($validatedData)
            ->withInput();
        }
        channel_partner::create([
            'name' => $request->name,
            'type' => $request->partner_type,
            'status' => $request->status,
        ]);
        notify()->success('Channel Partner has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('partner.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\channel_partner  $channel_partner
     * @return \Illuminate\Http\Response
     */
    public function show(channel_partner $channel_partner,$id)
    {
        //
        // return $id;
        // $pattern = ' ';
        // return $which_text = preg_replace("/\r/", "-", $id);


        // return preg_replace($pattern, '-', $id);
        // return $zid = implode('-',' ', $id);
        $daring = explode('-', $id);
        // return $daring['0'] . $daring['1'];
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
        ->whereIn('role',array('sale','NumberAdmin'))
        ->where('agent_code',auth()->user()->agent_code)
        ->where('id','!=',auth()->user()->id)
        ->get();
        $q = numberdetail::select("numberdetails.type")
            ->where("numberdetails.status","Available")
            ->where("numberdetails.channel_type", $daring)
            ->groupBy('numberdetails.type')

        ->get();
        // $nonmembers = $users->reject(function ($users, $key) {
        //     return $users->hasRole('sale');
        // });
        // return $users->hasRole('sale')->get();
        // return "zoom";
        // return $type;
        $user = auth()->user();
        if($id == 'Prepaid-Kiosk'){
            if($user->can('Elife Telesales')){
            // if (auth()->user()->role == 'DirectSale') {
                return view('dashboard.add-prepaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
                // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            } else {
                return view('dashboard.add-prepaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            }
        }
        else if($id == 'Postpaid-Telesales'){
            // return $id;
            return view('dashboard.add-postpaid', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        }
        else if($id == 'Postpaid-kiosk'){
            return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        }
        else if($id == 'Accessories-Kiosk'){
            // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            return view('dashboard.add-accessories-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        }
        else if($id == 'Billing-Kiosk'){
                // $kioskid
                $kiosk = kiosk_id::all();
                return view('dashboard.add-payment-direct', compact('kiosk','countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            // return view('dashboard.add-accessories-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        }
        else if($id == 'Control-Line-Kiosk'){
            return view('dashboard.add-control-line-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            // return view('dashboard.add-accessories-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        }
        // if($type == 'Accessories'){
        //     if (auth()->user()->role == 'DirectSale') {
        //         // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     } else {
        //         return view('dashboard.add-accessories-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     }
        // }
        // if($type == 'Control Line'){
        //     if (auth()->user()->role == 'DirectSale') {
        //         return view('dashboard.add-control-line-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //         // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     } else {
        //         return view('dashboard.add-control-line-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     }
        // }
        // if($type == 'Accessories'){
        //     if (auth()->user()->role == 'DirectSale') {
        //         return view('dashboard.add-accessories-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //         // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     } else {
        //         return view('dashboard.add-accessories-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     }
        // }
        // if($type == 'Billing'){
        //     if (auth()->user()->role == 'DirectSale') {
        //         return view('dashboard.add-payment-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //         // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     } else {
        //         return view('dashboard.add-payment-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     }
        // }
        // else if($type == 'Postpaid'){
        //     if (auth()->user()->role == 'DirectSale') {
        //         return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //         // return view('dashboard.add-postpaid-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     } else {
        //         return view('dashboard.add-postpaid', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        //     }
        // }
        else if($id == 'Elife-Telesales'){
            return view('dashboard.add-lead', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        }
        else if($id == 'Elife-DTD'){
            return view('dashboard.add-lead-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            // return view('dashboard.add-lead', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        }
        else if($id == 'Elife-Kiosk'){
            return view('dashboard.add-lead-direct', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
            // return view('dashboard.add-lead', compact('countries', 'emirates', 'plans', 'elifes', 'addons', 'users', 'last', 'type', 'ptype', 'itproducts', 'q'));
        }
        else{
            // if (auth()->user()->role == 'DirectSale') {
            // } else {
            // }
        }
        // return $channel_partner;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\channel_partner  $channel_partner
     * @return \Illuminate\Http\Response
     */
    public function edit(channel_partner $channel_partner,$id)
    {
        //
        // return $id;
        $data = channel_partner::findorfail($id);
        return view('dashboard.edit-partner',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\channel_partner  $channel_partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, channel_partner $channel_partner,$id)
    {
        //
        // return $request;
        // return $id;\
        $data = channel_partner::findorfail($id);
        $data->name = $request->name;
        $data->type = $request->partner_type;
        $data->status = $request->status;
        $data->save();
        return redirect(route('partner.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\channel_partner  $channel_partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(channel_partner $channel_partner,$id)
    {
        //
        $article = channel_partner::findOrFail($id);
        $article->delete();
        // return $id;
        notify()->info('Channel Partner has been deleted succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('partner.index'));
    }
}
