<?php

namespace App\Http\Controllers;

use App\elife_bulker;
use App\elife_log;
use App\Imports\elife_bulk;
use Illuminate\Http\Request;
use App\Imports\NumberImport;
use App\NumberDataBank;
use App\NumberToManager;
use App\NumberToUser;
use App\remarks_elife_number;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;



class ImportExcelController extends Controller
{
    //
    public function index(){
        // return "b";
        return view('dashboard.import');
    }
    function import(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
         $path1 = $request->file('select_file')->store('temp');
         $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        Excel::import(new NumberImport, $path);
        return back()->with('success', 'Number Data Imported successfully.');
//

    }
    public function index_elife(){
        // return "b";
        $b = NumberDataBank::where('identity','0')->get();
        $NumberCount = NumberDataBank::where('identity','0')->count();
        $u = User::select('users.*')->where('role','Manager')->get();
        return view('dashboard.import2',compact('b', 'NumberCount','u'));
    }
    public function assign_number_bank(){
        // return "b";
        $b = NumberToManager::select('number_data_banks.mobile','number_data_banks.name', 'number_data_banks.building','number_to_managers.id')
        ->Join(
            'number_data_banks','number_data_banks.id',
            'number_to_managers.num_id'
        )
        ->where('number_to_managers.identity','0')->get();
        $NumberCount = NumberToManager::where('identity','0')->count();
        $u = User::select('users.*')->where('role','Tele Sale')->get();
        return view('dashboard.import_bank',compact('b', 'NumberCount','u'));
    }
    function import_elife(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
         $path1 = $request->file('select_file')->store('temp');
         $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        Excel::import(new elife_bulk, $path);
        return back()->with('success', 'Number Data Imported successfully.');
//

    }
    public function assigner(Request $request)
    {
        // return $request;
        foreach ($request->number as $k) {
            // echo $k . '<br>';
            // $k = explode('-', $k);
            // return $k['0'];
            // return $k['1'];
            NumberToManager::create([
                'num_id' => $k,
                'userid' => $request->user,
                'identity' => '0',
            ]);
            // if ($k['1'] == 'Country') {
                $ks = NumberDataBank::where('id', $k)->update(['identity' => '1']);
            // } else {
                // $ks = bulknumber::where('number', $k)->update(['identify' => '1']);
            // }
        }
        return "01";
    }
    public function assigner_users(Request $request)
    {
        // return $request;
        foreach ($request->number as $k) {
            // echo $k . '<br>';
            // $k = explode('-', $k);
            // return $k['0'];
            // return $k['1'];
            NumberToUser::create([
                'num_id' => $k,
                'userid' => $request->user,
                'manager_id' => auth()->user()->id,
                'identity' => '0',
            ]);
            // if ($k['1'] == 'Country') {
                $ks = NumberToManager::where('id', $k)->update(['identity' => '1']);
            // } else {
                // $ks = bulknumber::where('number', $k)->update(['identify' => '1']);
            // }
        }
        return "01";
    }
    public function ElifeDataUploader(Request $request){
        // return $request;
        // return response()->json(['error' => 'New Sale has been submitted succesfully']);
        $validator = Validator::make($request->all(), [ // <---
            // 'start_date' => 'required',
            'remarks' => 'required_if:status,==,"other"',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $data = remarks_elife_number::create([
            'number' => $request->number,
            'number_id' => $request->userid,
            'userid' => auth()->user()->id,
            'remarks' => $request->status,
            'other_remarks' => $request->remarks,
            'status' => 1,
        ]);
        $ks = NumberToUser::where('id', $request->uid)->update(['identity' => '1']);
        return "1";

    }
    public function ElifeLeadBank(Request $request){
        // return $request;
        // return response()->json(['error' => 'New Sale has been submitted succesfully']);
        $validator = Validator::make($request->all(), [ // <---
            // 'start_date' => 'required',
            'remarks' => 'required_if:status,==,"other"',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $data = remarks_elife_number::create([
            'number' => $request->number,
            'number_id' => $request->userid,
            'userid' => auth()->user()->id,
            'remarks' => "Lead",
            'other_remarks' => "Lead",
            'status' => 1,
        ]);
        $request->session()->put('choosen_lead_number', $request->number);
        $ks = NumberToUser::where('id', $request->uid)->update(['identity' => '1']);
        return "1";

    }
    //
    public function ElifeLog()
    {
        $k = NumberToManager::select('number_data_banks.mobile', 'number_data_banks.name', 'number_data_banks.building', 'number_to_managers.id','users.name as agent_name', 'number_data_banks.tenant_type', 'number_data_banks.makani_eid', 'remarks_elife_numbers.remarks', 'remarks_elife_numbers.other_remarks', 'remarks_elife_numbers.lead_id', 'remarks_elife_numbers.updated_at')
        ->Join(
            'number_data_banks',
            'number_data_banks.id',
            'number_to_managers.num_id'
        )
        ->Join(
            'number_to_users',
            'number_to_users.num_id',
            'number_to_managers.id'
        )
        ->Join(
            'users',
            'users.id',
            'number_to_users.userid'
        )
        ->Join(
            'remarks_elife_numbers',
            'remarks_elife_numbers.number_id','number_data_banks.id'
        )
        ->where('number_to_managers.identity', '1')->get();        //
        return view('dashboard.view-white-log', compact('k'));
    }

}
