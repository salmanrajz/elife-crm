<?php

namespace App\Http\Controllers;

use App\AgencyBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    //
    public function AgencyBilling(Request $request){
        // return $request->id;
        $data = AgencyBill::where('agency_id',$request->id)->get();
        $agency_id = $request->id;
        return view('dashboard.view-agency-billing',compact('data','agency_id'));

    }
    public function BillingAmountAdd(Request $request){
        // return $request;
        $validator = Validator::make($request->all(), [ // <---

            'amount' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        // $data = numberdetail::findorfail($request->id)
        // return "zom";
        $data = AgencyBill::updateOrCreate(['id' => $request->id], [
            // $data = numberdetail::create([
            'amount' => $request->amount,
            'agency_id' => $request->agency_id,
            'userid' => auth()->user()->id
        ]);
        return response()->json(['success' => 'Data has been updated, Please wait']);
    }
    public function BillingAmount(Request $request){
        return $data = AgencyBill::select('amount')->where('agency_id',$request->id)->sum('amount');
    }
}
