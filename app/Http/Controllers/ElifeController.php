<?php

namespace App\Http\Controllers;

use App\addon;
use Illuminate\Http\Request;

class ElifeController extends Controller
{
    //
    public function elifeaddon(Request $request){
        // return $request;
         $k = addon::all();
        //  $k = addon::where('package_id',$request->package_id)->get();
        return view('ajax.addon',compact('k'));
    }
}
