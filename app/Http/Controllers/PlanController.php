<?php

namespace App\Http\Controllers;

use App\plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plan = plan::get();
        return view('dashboard.view-plan',compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.add-plan');

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
            'plan_name' => 'required|string|unique:plans,plan_name',
            'local_minutes' => 'required',
            'flexible_minutes' => 'required',
            'data' => 'required',
            'num_allowed' => 'required',
            'duration' => 'required',
            'revenue' => 'required',
            'free_min' => 'required',
            'plan_category'=>'required'
        ]);



        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        Plan::create([
            'plan_name' => $request->plan_name,
            'local_minutes' => $request->local_minutes,
            'flexible_minutes' => $request->flexible_minutes,
            'data' => $request->data,
            'number_allowed' => $request->num_allowed,
            'duration' => $request->duration,
            'revenue' => $request->revenue,
            'free_minutes' => $request->free_min,
            'monthly_payment' => $request->monthly_pay,
            'plan_category' => $request->plan_category,
            'status' => 1,
        ]);
        notify()->success('Plan has been created succesfully');
        // return redirect()->back()->withInput();
        return redirect(route('plan.index'));




        // notify()->success('');
        // return redirect('admin/task/show');
        // if ($v->fails()) {
        //     return view('view_name');
        // } else {
        //     return view('view_name');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(plan $plan)
    {
        //
        // return $plan;
        // $plan = plan::get();
        return view('dashboard.edit-plan', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, plan $plan)
    {
        //
        // return $request;
        // return $plan;
        $validatedData = Validator::make($request->all(), [
            // 'plan_name' => 'required | string | unique',
            // 'plan_name' => 'required|string|unique:plans,plan_name',
            'local_minutes' => 'required',
            'flexible_minutes' => 'required',
            'data' => 'required',
            'num_allowed' => 'required',
            'duration' => 'required',
            'revenue' => 'required',
            'free_min' => 'required',
            'plan_category' => 'required',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        $plan->update([
            'plan_name' => $request->plan_name,
            'local_minutes' => $request->local_minutes,
            'flexible_minutes' => $request->flexible_minutes,
            'data' => $request->data,
            'number_allowed' => $request->num_allowed,
            'duration' => $request->duration,
            'revenue' => $request->revenue,
            'free_minutes' => $request->free_min,
            'plan_category' => $request->plan_category,
            'monthly_payment' => $request->monthly_pay,
            'status' => 1,
        ]);
        notify()->success('Plan has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('plan.index'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(plan $plan)
    {
        //
    }
}
