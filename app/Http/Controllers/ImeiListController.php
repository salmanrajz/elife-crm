<?php

namespace App\Http\Controllers;

use App\imei_list;
use Illuminate\Http\Request;
// validate
use Illuminate\Support\Facades\Validator;


class ImeiListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emirate = imei_list::all();
        return view('dashboard.view-all-imei',compact('emirate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.add-imei');
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
        $validator = Validator::make($request->all(), [ // <---
            'name'=> 'required',
            'imei'=> 'required|unique:imei_lists,imei_number',
            'status'=> 'required',
            // 'remarks_process_new' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
         $data = imei_list::create([
            'name' => $request->name,
            'imei_number' => $request->imei,
            'status' => $request->status,
        ]);
        notify()->success('IMEI has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('imei.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\imei_list  $imei_list
     * @return \Illuminate\Http\Response
     */
    public function show(imei_list $imei_list)
    {
        //
        // return $imei_list;
        // $data = emirate::findorfail($emirate['id']);
        // return view('dashboard.edit-emirate', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\imei_list  $imei_list
     * @return \Illuminate\Http\Response
     */
    public function edit(imei_list $imei_list,$id)
    {
        //
        // return $imei_list;
        $data = imei_list::findorfail($id);
        return view('dashboard.edit-imei', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\imei_list  $imei_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, imei_list $imei_list,$id)
    {
        //
        // return $id;
        $data = imei_list::findorfail($id);
        $data->update([
            'name' => $request->name,
            'imei_number' => $request->imei,
            'status' => $request->status,
        ]);
        notify()->success('IMEI has been Update succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('imei.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\imei_list  $imei_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(imei_list $imei_list,$id)
    {
        //
        // return "s";
        // return $imei_list;
        $article = imei_list::findOrFail($id);
        $article->delete();
        // return $id;
        notify()->info('Device has been deleted succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('imei.index'));
    }
}
