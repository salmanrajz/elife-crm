<?php

namespace App\Http\Controllers;

use App\it_products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ItProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $itp = it_products::all();
        return view('dashboard.view-itproducts',compact('itp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.add-itp');
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
            'name' => 'required|string|unique:it_products,name',
            'status' => 'required',
        ]);
        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        it_products::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        notify()->success('IT Product has been created succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('IT-product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\it_products  $it_products
     * @return \Illuminate\Http\Response
     */
    public function show(it_products $it_products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\it_products  $it_products
     * @return \Illuminate\Http\Response
     */
    public function edit(it_products $it_products,$id)
    {
        //
        // return $id;
        $data = it_products::findorfail($id);
        return view('dashboard.edit-itp',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\it_products  $it_products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, it_products $it_products,$id)
    {
        //
        // return $it_products;
        $data = it_products::findorfail($id);
        $data->name = $request->name;
        $data->status = $request->status;
        $data->save();
        notify()->success('IT Product has been Updated succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('IT-product.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\it_products  $it_products
     * @return \Illuminate\Http\Response
     */
    public function destroy(it_products $it_products,$id)
    {
        //
        $article = it_products::findOrFail($id);
        $article->delete();
        // return $id;
        notify()->info('IT Products has been deleted succesfully');

        // return redirect()->back()->withInput();
        return redirect(route('IT-product.index'));
    }
}
