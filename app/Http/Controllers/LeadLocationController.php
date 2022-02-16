<?php

namespace App\Http\Controllers;

use App\lead_location;
use App\lead_sale;
use App\remark;
use App\verification_form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LeadLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // return $request;
        // return salman
        if($request->reverify_remarks != ''){
            $validatedData = Validator::make($request->all(), [
                'reverify_remarks' => 'required|string',
            ]);
            // return "s";
            if ($validatedData->fails()) {
                return redirect()->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }
            // return "b";
            // return $request->lead_id;
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.01',
                'remarks' => $request->reverify_remarks,
                'date_time_follow' => $request->call_back_at_new,
                'emirates' => $request->emirates,
            ]);
            $dd = verification_form::findOrFail($request->ver_id);
            $dd->update([
                'status' => '1.01',
                'emirate_location' => $request->emirates,
            ]);
            remark::create([
                'remarks' => $request->reverify_remarks,
                'lead_status' => '1.01',
                'lead_id' => $request->lead_id,
                'lead_no' => $request->lead_id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // return
            notify()->success('Lead has been forward to re verification');

            // return redirect()->back()->withInput();
            return redirect(route('verification.final-cord-lead'));
        }
        if($request->call_back_at_new != ''){
            $validatedData = Validator::make($request->all(), [
                'remarks_for_cordination' => 'required|string',
            ]);
            // return "s";
            if ($validatedData->fails()) {
                return redirect()->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }
            // return "b";
            // return $request->lead_id;
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.03',
                'remarks' => $request->remarks_for_cordination,
                'date_time_follow' => $request->call_back_at_new,
                'emirates' => $request->emirates,
            ]);
            $dd = verification_form::findOrFail($request->ver_id);
            $dd->update([
                'status' => '1.03',
                'emirate_location' => $request->emirates,
            ]);
            remark::create([
                'remarks' => $request->call_back_at_new,
                'lead_status' => '1.03',
                'lead_id' => $request->lead_id,
                'lead_no' => $request->lead_id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => auth()->user()->name,
                'user_agent_id' => auth()->user()->id,
            ]);
            // return
            notify()->success('Lead has been follow up now');

            // return redirect()->back()->withInput();
            return redirect(route('verification.final-cord-lead'));
        }
        else{
            // return $request;
            $validatedData = Validator::make($request->all(), [
                'add_location' => 'required|string',
                // 'add_lat_lng' => 'required',
                'assing_to' => 'required'
                // 'lng' => 'required|numeric',
            ]);
            if ($validatedData->fails()) {
                return redirect()->back()
                    ->withErrors($validatedData)
                    ->withInput();
            }
            if(!empty($request->add_lat_lng)){

                $name = explode(',', $request->add_lat_lng);
                $lat = $name[0];
                $lng = $name[1];
            }else{
                $lat = '';
                $lng = '';
            }

            lead_location::create([
                'lead_id' => $request->lead_id,
                'location_url' => $request->add_location,
                'lat' => $lat,
                'lng' => $lng,
                'assign_to' => $request->assing_to,
                // 'number_allowed' => $request->num_allowed,
                // 'duration' => $request->duration,
                // 'revenue' => $request->revenue,
                // 'free_minutes' => $request->free_min,
                'status' => 1,
            ]);
            $d = lead_sale::findOrFail($request->lead_id);
            $d->update([
                'status' => '1.10',
            ]);
            $dd = verification_form::findOrFail($request->ver_id);
            $dd->update([
                'status' => '1.10',
                'assing_to' => '1',
                'cordination_by' => auth()->user()->id,
                'emirate_location' => $request->emirates,
            ]);
            notify()->success('Location Added succesfully');

            // return redirect()->back()->withInput();
            return redirect(route('verification.final-cord-lead'));


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lead_location  $lead_location
     * @return \Illuminate\Http\Response
     */
    public function show(lead_location $lead_location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lead_location  $lead_location
     * @return \Illuminate\Http\Response
     */
    public function edit(lead_location $lead_location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lead_location  $lead_location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lead_location $lead_location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lead_location  $lead_location
     * @return \Illuminate\Http\Response
     */
    public function destroy(lead_location $lead_location)
    {
        //
    }
}
