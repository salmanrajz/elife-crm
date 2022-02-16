<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Location;
// namespace App\Location\Drivers;
// use App\location;
use Stevebauman\Location\Position;
use App\numberdetail;
use App\emirate;

use Illuminate\Http\Request;

class NumberdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['role:NumberAdmin|NumberSuperAdmin|NumberVerification|NumberCord|NumberActivation|sale|Manager']);
    }
    public function index()
    {
        if(auth()->user()->role == 'NumberSuperAdmin' || auth()->user()->role == 'Manager'){
            // return "boom";
            // return auth()->user()->agent_code;
            $emirates = emirate::all();
             $data = numberdetail::select("numberdetails.*", "choosen_numbers.id as cid","users.name", "choosen_numbers.created_at as datetime")
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
            ->where("numberdetails.status",'Reserved')
            ->where('numberdetails.channel_type','OCP1')
            ->where("choosen_numbers.agent_group",auth()->user()->agent_code)
                // ->where("","")
                // ->where("remarks.user_agent_id", auth()->user()->id)
                // ->where("choosen_numbers.user_id", $request->simtype)
                // ->where("numberdetails.type", $request->simtype)
                // ->where("numberdetails.status", 'Available')
                // ->groupBy('numberdetails.type')
                ->get();
            return view('number.number-dtl-user', compact('data','emirates'));

        }
        else if(auth()->user()->role == 'NumberVerification'){
            $data = numberdetail::select("numberdetails.*", "choosen_numbers.id as cid", "users.name", "choosen_numbers.created_at as datetime","users.agent_code as UserAgentGroup")
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
                ->where("choosen_numbers.status", 4)
                ->where('numberdetails.channel_type','OCP1')
                ->where("choosen_numbers.agent_group",'!=','ARF')
                // ->where("","")
                // ->where("remarks.user_agent_id", auth()->user()->id)
                // ->where("choosen_numbers.user_id", $request->simtype)
                // ->where("numberdetails.type", $request->simtype)
                // ->where("numberdetails.status", 'Available')
                // ->groupBy('numberdetails.type')
                ->get();
            return view('number.number-ver-user', compact('data'));
        }
        else if(auth()->user()->role == 'NumberCord'){
            $data = numberdetail::select("numberdetails.*", "choosen_numbers.id as cid", "users.name", "choosen_numbers.created_at as datetime","users.agent_code as UserAgentGroup")
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
                ->where("choosen_numbers.status", 4)
                ->where('numberdetails.channel_type', 'OCP1')
                ->where("choosen_numbers.agent_group",'!=','ARF')
                // ->where("","")
                // ->where("remarks.user_agent_id", auth()->user()->id)
                // ->where("choosen_numbers.user_id", $request->simtype)
                // ->where("numberdetails.type", $request->simtype)
                // ->where("numberdetails.status", 'Available')
                // ->groupBy('numberdetails.type')
                ->get();
            return view('number.number-cord-user', compact('data'));
        }
        else if(auth()->user()->role == 'NumberActivation'){
     
            return view('number.number-activation');
        }
        else{


        //
            $q = numberdetail::select("numberdetails.type")
        // ->where("remarks.user_agent_id", auth()->user()->id)
        // ->where("numberdetails.id", $request->id)
            ->where("numberdetails.status", 'Available')
            ->where('numberdetails.channel_type', 'OCP1')
            ->groupBy('numberdetails.type')
            ->get();
            //
            $data = numberdetail::wherestatus('Available')->get();
            return view('number.number-dtl', compact('data', 'q'));
        }

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
     * @param  \App\numberdetail  $numberdetail
     * @return \Illuminate\Http\Response
     */
    public function show(numberdetail $numberdetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\numberdetail  $numberdetail
     * @return \Illuminate\Http\Response
     */
    public function edit(numberdetail $numberdetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\numberdetail  $numberdetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, numberdetail $numberdetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\numberdetail  $numberdetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(numberdetail $numberdetail)
    {
        //
    }
}
