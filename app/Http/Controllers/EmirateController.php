<?php

namespace App\Http\Controllers;

use App\emirate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmirateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emirate = emirate::get();

        return view('dashboard.view-emirate',compact('emirate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.add-emirate');

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
            'name' => 'required|string|unique:emirates,name',
            'status' => 'required|numeric',
        ]);




        emirate::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        notify()->success('Emirate has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('emirate.index'));

        if ($validatedData->fails()) {
            return redirect()->back()
            ->withErrors($validatedData)
            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\emirate  $emirate
     * @return \Illuminate\Http\Response
     */
    public function show(emirate $emirate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\emirate  $emirate
     * @return \Illuminate\Http\Response
     */
    public function edit(emirate $emirate)
    {
        //
        // return $emirate;
        $data = emirate::findorfail($emirate['id']);
        return view('dashboard.edit-emirate',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\emirate  $emirate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, emirate $emirate)
    {
        //
        // return $emirate;
        $data = emirate::findorfail($emirate['id']);
        $data->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        notify()->success('Emirate has been updated succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('emirate.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\emirate  $emirate
     * @return \Illuminate\Http\Response
     */
    public function destroy(emirate $emirate)
    {
        // return $emirate;
        //
        $article = emirate::findOrFail($emirate['id']);
        $article->delete();
        // return $id;
        notify()->info('Channel Emirate has been deleted succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('emirate.index'));
    }
}
