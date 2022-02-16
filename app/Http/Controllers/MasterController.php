<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MasterController extends Controller
{
    //
    public function MasterLogin(Request $request)
    {
        $data = User::findorfail($request->id);
        Auth::login($data);
        return redirect()->route('home');
    }
}
