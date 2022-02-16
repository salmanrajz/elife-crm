<?php

namespace App\Http\Controllers;

use App\call_center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = call_center::all();
        return view('dashboard.view-call-center',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.add-call-center');
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
        $validator = Validator::make($request->all(), [ // <---

        // $validatedData = $request->validate([
            // 'plan_name' => 'required | string | unique',
            // 'plan_name' => 'required|string|unique:plans,plan_name',
            'name' => 'required|string|unique:call_centers,call_center_name',
            'call_center_short_code' => 'required',
            'call_center_amount' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = call_center::create([
            'call_center_name' => $request->name,
            'call_center_amount' => $request->call_center_amount,
            'call_center_code' => $request->call_center_short_code,
            'status' => $request->status,
        ]);
        notify()->success('Call Center has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('call-center.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\call_center  $call_center
     * @return \Illuminate\Http\Response
     */
    public function show(call_center $call_center)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\call_center  $call_center
     * @return \Illuminate\Http\Response
     */
    public function edit(call_center $call_center)
    {
        //
        // return $call_center;
        $data = call_center::findorfail($call_center['id']);
        return view('dashboard.edit-call-center', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\call_center  $call_center
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, call_center $call_center)
    {
        //
        // return $call_center;
        $data = call_center::findorfail($call_center['id']);
        $data->update([
            'call_center_name' => $request->name,
            'call_center_amount' => $request->call_center_amount,
            'call_center_code' => $request->call_center_short_code,
            'status' => $request->status,
        ]);
        notify()->success('Call Center has been Updated succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('call-center.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\call_center  $call_center
     * @return \Illuminate\Http\Response
     */
    public function destroy(call_center $call_center)
    {
        //
    }
}
