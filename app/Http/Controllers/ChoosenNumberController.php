<?php

namespace App\Http\Controllers;

use App\choosen_number;
use App\numberdetail;
use Illuminate\Http\Request;

class ChoosenNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = numberdetail::select("numberdetails.*", "choosen_numbers.id as cid", "choosen_numbers.agent_group", "users.name", "choosen_numbers.created_at as datetime")
        ->Join(
            'choosen_numbers',
            'choosen_numbers.number_id',
            '=',
            'numberdetails.id'
        )
        ->Join(
            'users',
            'users.id',
            '=',
            'choosen_numbers.user_id'
        )
            ->where("choosen_numbers.status", 1)
            // ->where("choosen_numbers.agent_group", auth()->user()->agent_code)
            // ->where("","")
            // ->where("remarks.user_agent_id", auth()->user()->id)
            // ->where("choosen_numbers.user_id", $request->simtype)
            // ->where("numberdetails.type", $request->simtype)
            // ->where("numberdetails.status", 'Available')
            // ->groupBy('numberdetails.type')
            ->get();
            return view('dashboard.view-active-number',compact('data'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\choosen_number  $choosen_number
     * @return \Illuminate\Http\Response
     */
    public function show(choosen_number $choosen_number)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\choosen_number  $choosen_number
     * @return \Illuminate\Http\Response
     */
    public function edit(choosen_number $choosen_number)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\choosen_number  $choosen_number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, choosen_number $choosen_number)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\choosen_number  $choosen_number
     * @return \Illuminate\Http\Response
     */
    public function destroy(choosen_number $choosen_number)
    {
        //
    }
}
