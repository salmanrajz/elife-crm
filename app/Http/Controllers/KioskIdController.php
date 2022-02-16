<?php

namespace App\Http\Controllers;

use App\emirate;
use App\kiosk_id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class KioskIdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = kiosk_id::all();
        return view('dashboard.view-agency', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emirates = emirate::all();
        //
        return view('dashboard.add-agency',compact('emirates'));
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
            'name' => 'required|string',
            'location' => 'required|string',
            // 'password' => 'required',
            'agency_id' => 'required|string|unique:kiosk_ids,agency_id',
            // 'agency_id' => ['required', 'string'],
            // 'teamleader' => 'required_if:role:Tele Sale',
            // 'teamleader' => 'required_if'
            // 'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = kiosk_id::create([
            'name' => $request->name,
            'location' => $request->location,
            'agency_id' => $request->agency_id,
        ]);
        notify()->success('Agency has been created succesfully');
        return redirect(route('agency.index'));
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\kiosk_id  $kiosk_id
     * @return \Illuminate\Http\Response
     */
    public function show(kiosk_id $kiosk_id,$id)
    {
        //
        // return $id;
        $data = kiosk_id::findorfail($id);
        $data->delete();
        notify()->success('Agency has been Deleted succesfully');
        return redirect(route('agency.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kiosk_id  $kiosk_id
     * @return \Illuminate\Http\Response
     */
    public function edit(kiosk_id $kioskid,$id)
    {
        //
        // return $id;
        $data = kiosk_id::findorfail($id);
        // return view('add-a')
        $emirates = emirate::all();
        //
        return view('dashboard.edit-agency', compact('emirates','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kiosk_id  $kiosk_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kiosk_id $kiosk_id,$id)
    {
        //
        $validator = Validator::make($request->all(), [ // <---
            // 'promotion_title' => 'required|max:255|unique:promotions,promotion_title,except,id,'. $request->post_id.'',
            'agency_id' => [
                'required',
                Rule::unique('kiosk_ids')->ignore($id),
            ],
            'name' => 'required|max:255',
            'location' => 'required',
            //  = 'date_format:Y-m-d|after:start_date';

            // 'code' => 'required|max:255|unique:diags,code',
            // 'address' => 'required|max:255',
        ]);
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()->all()]);
        // }
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        // promotions::updateOrCreate(['id' => $this->post_id],[($request->all());
        // return $id;
        $data = kiosk_id::findorfail($id);
        $data->name = $request->name;
        $data->location = $request->location;
        $data->agency_id = $request->agency_id;
        $data->save();
        // return response()->json(['success' => 'Campaign has been created succesfully']);
        notify()->success('Agency has been Updated succesfully');
        return redirect(route('agency.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kiosk_id  $kiosk_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(kiosk_id $kiosk_id,$id)
    {
        //
        return $id;
        $data = kiosk_id::findorfail($id);
        $data->delete();
        notify()->success('Agency has been Deleted succesfully');
        return redirect(route('agency.index'));

    }
}
