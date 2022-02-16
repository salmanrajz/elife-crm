<?php

namespace App\Http\Controllers;

use App\call_center;
use App\TargetAssignerUser;
use App\User;
use Illuminate\Http\Request;

class TargetAssignerUserController extends Controller
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
        $CallCenter = User::whereAgentCode(auth()->user()->agent_code)->get();
        return view('dashboard.add-target-user', compact('CallCenter'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TargetAssignerUser  $targetAssignerUser
     * @return \Illuminate\Http\Response
     */
    public function show(TargetAssignerUser $targetAssignerUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TargetAssignerUser  $targetAssignerUser
     * @return \Illuminate\Http\Response
     */
    public function edit(TargetAssignerUser $targetAssignerUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TargetAssignerUser  $targetAssignerUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TargetAssignerUser $targetAssignerUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TargetAssignerUser  $targetAssignerUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(TargetAssignerUser $targetAssignerUser)
    {
        //
    }
}
