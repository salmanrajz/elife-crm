<?php

namespace App\Http\Controllers;

use App\billing_type;
use Illuminate\Http\Request;
// use Validator;
use Illuminate\Support\Facades\Validator;

class BillingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $plan = billing_type::get();
        return view('dashboard.view-billing-type', compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.add-billing-type');

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
        //
        // $validatedData = $request->validate([
        //     'name' => 'required|string|unique:billing_types,name',
        //     // 'free_min' => 'required|numeric',
        // ]);
        // if ($validatedData->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validatedData)
        //         ->withInput();
        // }
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:billing_types,name',

        ]);
        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }



        billing_type::create([
            'name' => $request->name,
            'status' => 1,
        ]);
        notify()->success('Billing Type has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('BillingType.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\billing_type  $billing_type
     * @return \Illuminate\Http\Response
     */
    public function show(billing_type $billing_type)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\billing_type  $billing_type
     * @return \Illuminate\Http\Response
     */
    public function edit(billing_type $billing_type,$id)
    {
        //
        $data = billing_type::findorfail($id);
        return view('dashboard.edit-billing-type', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\billing_type  $billing_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, billing_type $billing_type,$id)
    {
        //
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|unique:billing_types,name,' . $id,

            // 'name' => 'required|string|unique:billing_types,name',

        ]);
        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        $data = billing_type::findorfail($id);
        $data->update([
            'name' => $request->name,
            'status' => 1,
        ]);
        notify()->success('Billing Type has been updated succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('BillingType.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\billing_type  $billing_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(billing_type $billing_type,$id)
    {
        //
        //
        $article = billing_type::findOrFail($id);
        $article->delete();
        // return $id;
        notify()->info('Billing Type has been deleted succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('BillingType.index'));
    }
}
