<?php

namespace App\Http\Controllers;

use App\it_products;
use App\itproductplans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;

class ItproductplansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $plan = itproductplans::all();
        $plan = itproductplans::select("itproductplans.*", "it_products.name as product_name")
            // $user =  DB::table("subjects")->select('subject_name', 'id')
            ->LeftJoin(
                'it_products',
                'it_products.id',
                '=',
                'itproductplans.type'
            )
            ->get();
        return view('dashboard.view-itplan',compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = it_products::wherestatus('1')->get();
        return view('dashboard.add-ITplan',compact('products'));
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
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string',
            'status' => 'required',
            'type' => 'required',
            'payment' => 'required',
            'plan_desc' => 'required',
        ]);






        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        itproductplans::create([
            'name' => $request->name,
            'type' => $request->type,
            'pricing' => $request->payment,
            'description' => $request->plan_desc,
            'status' => $request->status,
        ]);
        notify()->success('IT Partner Plan has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('IT-Plan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\itproductplans  $itproductplans
     * @return \Illuminate\Http\Response
     */
    public function show(itproductplans $itproductplans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\itproductplans  $itproductplans
     * @return \Illuminate\Http\Response
     */
    public function edit(itproductplans $itproductplans,$id)
    {
        //
        // return $id;
        $products = it_products::wherestatus('1')->get();
        $data = itproductplans::findorfail($id);
        return view('dashboard.edit-ITplan', compact('products','data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\itproductplans  $itproductplans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, itproductplans $itproductplans,$id)
    {
        //
        // return $id;
        $data = itproductplans::findorfail($id);
        $data->update([
            'name' => $request->name,
            'type' => $request->type,
            'pricing' => $request->payment,
            'description' => $request->plan_desc,
            'status' => $request->status,
        ]);
        notify()->success('IT Partner Plan has been Updated succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('IT-Plan.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\itproductplans  $itproductplans
     * @return \Illuminate\Http\Response
     */
    public function destroy(itproductplans $itproductplans,$id)
    {
        //
        // return $id;
        $article = itproductplans::findOrFail($id);
        $article->delete();
        // return $id;
        notify()->info('IT Partner Plan has been deleted succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('IT-Plan.index'));
    }
}
