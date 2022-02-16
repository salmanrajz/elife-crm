<?php

namespace App\Http\Controllers;

use App\call_center;
use App\TargetAssignerManager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class TargetAssignerManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $r = TargetAssignerManager::all();
        $r = TargetAssignerManager::select('target_assigner_managers.*','call_centers.call_center_name')
        ->LeftJoin(
            'call_centers','call_centers.id',
            'target_assigner_managers.call_center_id'
        )
        ->get();
        return view('dashboard.view-target-manager',compact('r'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $r = TargetAssignerManager::all();
        $CallCenter = call_center::wherestatus('1')->get();
        return view('dashboard.add-target-manager',compact('CallCenter'));
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
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'month' =>  [
                'required',
                Rule::unique('target_assigner_managers')
                    ->where('call_center_id', $request->agent_group)
            ],
            // 'month' => 'required|unique:target_assigner_manager,month',
            'target' => 'required',
            'agent_group' => 'required',
            // 'num_allowed' => 'required',
            // 'duration' => 'required',
            // 'revenue' => 'required',
            // 'free_min' => 'required',
            // 'plan_category' => 'required'
        ]);
        // $k =



        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        $k = TargetAssignerManager::create([
            'name' => $request->name,
            'month' => $request->month,
            'target' => $request->target,
            'call_center_id' => $request->agent_group,
            'status' => '1'
        ]);
        return redirect(route('Manager-target.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TargetAssignerManager  $targetAssignerManager
     * @return \Illuminate\Http\Response
     */
    public function show(TargetAssignerManager $targetAssignerManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TargetAssignerManager  $targetAssignerManager
     * @return \Illuminate\Http\Response
     */
    public function edit(TargetAssignerManager $targetAssignerManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TargetAssignerManager  $targetAssignerManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TargetAssignerManager $targetAssignerManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TargetAssignerManager  $targetAssignerManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(TargetAssignerManager $targetAssignerManager)
    {
        //
    }
}
