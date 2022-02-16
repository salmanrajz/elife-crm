<?php

namespace App\Http\Controllers;

use App\User;
use App\userwaller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserwallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = userwaller::select('userwallers.id','userwallers.name','userwallers.userid','users.name as username','userwallers.amount')
        ->Join(
            'users','users.id','userwallers.userid'
        )
        ->get();
        return view('dashboard.view-wallet-data',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = User::where('role','Manager')->get();
        return view('dashboard.add-wallet',compact('data'));
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
            'name' => 'required|string|unique:billing_types,name',
            'userid' => 'required',
            'amount' => 'required',

        ]);
        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }



        userwaller::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'userid' => $request->userid,
        ]);
        notify()->success('Manager Wallet has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('wallet.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\userwaller  $userwaller
     * @return \Illuminate\Http\Response
     */
    public function show(userwaller $userwaller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\userwaller  $userwaller
     * @return \Illuminate\Http\Response
     */
    public function edit(userwaller $userwaller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\userwaller  $userwaller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, userwaller $userwaller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\userwaller  $userwaller
     * @return \Illuminate\Http\Response
     */
    public function destroy(userwaller $userwaller,$id)
    {
        //
        $article = userwaller::findOrFail($id);
        $article->delete();
        // return $id;
        notify()->info('Wallet has been deleted succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('wallet.index'));
    }
}
