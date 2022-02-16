<?php

namespace App\Http\Controllers;

use App\elife_plan;
use Illuminate\Http\Request;
use Validator;
class ElifePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plan = elife_plan::get();
        return view('dashboard.view-elife-plan',compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.add-elife-plan');

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
            'plan_name' => 'required|string|unique:elife_plans,plan_name',
            'speed' => 'required',
            'devices' => 'required',
            'monthly_charges' => 'required',
            'installation_charges' => 'required',
            'revenue' => 'required',
            'contract' => 'required',
            'product_type' => 'required',
            // 'free_min' => 'required|numeric',
        ]);
        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }



        elife_plan::create([
            'plan_name' => $request->plan_name,
            'speed' => $request->speed,
            'devices' => $request->devices,
            'monthly_charges' => $request->monthly_charges,
            'installation_charges' => $request->installation_charges,
            'revenue' => $request->revenue,
            'contract' => $request->contract,
            'product_type' => $request->product_type,
            // 'free_minutes' => $request->free_min,
            'status' => 1,
        ]);
        notify()->success('Elife Plan has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('elife.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\elife_plan  $elife_plan
     * @return \Illuminate\Http\Response
     */
    public function show(elife_plan $elife_plan)
    {
        //
        // return $elife_plan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\elife_plan  $elife_plan
     * @return \Illuminate\Http\Response
     */
    public function edit(elife_plan $elife)
    {
        // return $elife;
        return view('dashboard.edit-elife-plan', compact('elife'));
        //

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\elife_plan  $elife_plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // return $id;
        $validator = Validator::make($request->all(), [
            // 'plan_name' => 'required|string|unique:elife_plans,plan_name',
            'plan_name' => 'required|string|unique:elife_plans,plan_name,' . $id,
            // 'plan_name' => 'required|string|unique:elife_plans,plan_name,except,id,"'.$id.'"',
            'speed' => 'required',
            'devices' => 'required',
            'monthly_charges' => 'required',
            'installation_charges' => 'required',
            'revenue' => 'required',
            'contract' => 'required',
            'product_type' => 'required',
            // 'free_min' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validatedData)
            ->withInput();
        }

        // return "2";
        $data = elife_plan::findorfail($id);
        $data->update([
            'plan_name' => $request->plan_name,
            'speed' => $request->speed,
            'devices' => $request->devices,
            'monthly_charges' => $request->monthly_charges,
            'installation_charges' => $request->installation_charges,
            'revenue' => $request->revenue,
            'contract' => $request->contract,
            'product_type' => $request->product_type,
            // 'free_minutes' => $request->free_min,
            'status' => 1,
        ]);
        notify()->success('Elife Plan has been updated succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('elife.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\elife_plan  $elife_plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(elife_plan $elife_plan,$id)
    {
        //
        $article = elife_plan::findOrFail($id);
        $article->delete();
        // return $id;
        notify()->info('Elife Plan has been deleted succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('elife.index'));
    }
}
