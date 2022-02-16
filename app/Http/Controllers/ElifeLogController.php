<?php

namespace App\Http\Controllers;

use App\elife_log;
use App\NumberDataBank;
use Illuminate\Http\Request;

class ElifeLogController extends Controller
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
        // return auth()->user()->id;
        // $k = elife_log::select('elife_logs.*', 'elife_bulkers.number','elife_bulkers.plan','elife_bulkers.customer_name as name', 'elife_bulkers.area')
        // ->LeftJoin(
        //     'elife_bulkers',
        //     'elife_bulkers.id','elife_logs.number_id'
        // )
        // ->where('elife_logs.identify', '0')
        // // ->where('type', $slug)
        // ->where('userid', auth()->user()->id)
        // ->paginate();        //
        // $k = NumberDataBank::paginate();
        $k = NumberDataBank::select('number_data_banks.mobile','number_data_banks.id', 'number_to_users.id as uid', 'number_to_users.identity as status')
        ->Join(
            'number_to_managers','number_to_managers.num_id','number_data_banks.id'
        )
        ->Join(
            'number_to_users',
            'number_to_users.num_id',
            'number_to_managers.id'
        )
        ->where('number_to_users.identity','0')
        ->paginate();

        return view('dashboard.add-white-log', compact('k'));
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
        $k = elife_log::findorfail($request->userid);
        $k->status = $request->status;
        $k->remarks = $request->remarks;
        $k->identify = 1;
        $k->save();
        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\elife_log  $elife_log
     * @return \Illuminate\Http\Response
     */
    public function show(elife_log $elife_log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\elife_log  $elife_log
     * @return \Illuminate\Http\Response
     */
    public function edit(elife_log $elife_log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\elife_log  $elife_log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, elife_log $elife_log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\elife_log  $elife_log
     * @return \Illuminate\Http\Response
     */
    public function destroy(elife_log $elife_log)
    {
        //
    }
}
