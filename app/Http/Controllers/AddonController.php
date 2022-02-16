<?php

namespace App\Http\Controllers;

use App\addon;
use App\elife_plan;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plan = addon::get();
        return view('dashboard.view-elife-addon', compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $plan = elife_plan::get();
        return view('dashboard.add-elife-addon',compact('plan'));

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
        $validatedData = $request->validate([
            'addon_name' => 'required|string|unique:addons,addon_name',
            'amount' => 'required|numeric',
            'elife_id' => 'required',
            'status' => 'required|numeric',
            // 'free_min' => 'required|numeric',
        ]);




        addon::create([
            'addon_name' => $request->addon_name,
            'amount' => $request->amount,
            'package_id' => $request->elife_id,
            // 'free_minutes' => $request->free_min,
            'status' => $request->status,
        ]);
        notify()->success('Elife Addon has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('elife-addon.index'));

        if ($validatedData->fails()) {
            return redirect()->back()
            ->withErrors($validatedData)
            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function show(addon $addon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function edit(addon $addon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, addon $addon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function destroy(addon $addon)
    {
        //
    }
}
