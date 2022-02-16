<?php

namespace App\Http\Controllers;

use App\call_center;
use App\User;
use App\emirate;
use App\kiosk_id;
use App\team_leader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;


class UserController extends Controller
{
    //
    public function index(){
        $data = User::all();
        return view('dashboard.view-users',compact('data'));
    }
    public function myagent(){
        $user = auth()->user();
        $permissions = $user->getAllPermissions();
        // return $permissions['0']->name;
        $channel = $permissions['0']->name;
        $data = User::permission($channel)->where('role','Tele Sale')->get();
        return view('dashboard.add-target-user',compact('data','channel'));

    }
    public function create(){

        $CallCenter = call_center::wherestatus('1')->get();
        if(auth()->user()->role == 'Admin'){
            $permissions = Permission::all();
            $role = Role::all();
        }
        else{
            $user = auth()->user();
            $permissions = $user->getAllPermissions();
            $role = Role::whereIn('name',['Tele Sale','Runner'])
            // ->where('name','Runner')
            ->get();
        }
        $emirates = emirate::all();
        $kioskid = kiosk_id::all();
        // $role = Role::whereIn('name',['Tele Sale','Runner'])
        $teamleader = User::where('role','Team-Leader')->get();
        // $role = Role::findById(2);

        return view('dashboard.add-user',compact('CallCenter','role', 'permissions','emirates', 'teamleader', 'kioskid'));
    }
    public function store(Request $request){
        // return $request;
        // return

        $validator = Validator::make($request->all(), [ // <---
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            // 'password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'agent_group' => ['required'],
            'rc_code' => ['required'],
            'teamleader' => 'required_if:role,==,Tele Sale,DirectSale'
            // 'teamleader' => 'required_if:role:Tele Sale',
            // 'teamleader' => 'required_if'
            // 'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        if ($file = $request->file('img')) {
            // $ext = date('d-m-Y-H-i');
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $name = $ext . '-' . $file->getClientOriginalName();
            $name = Str::slug($name, '-');

            // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $file->move('image', $name);
            $input['path'] = $name;
        }
        else{
            $name = 'default.png';
        }
        // return $request->role;
        $data =   User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'agent_code' => $request->agent_group,
            'role' => $request->role,
            'password' => Hash::make($request['password']),
            'emirate' => $request->emirate,
            'profile' => $name,
            'kiosk_id' => $request->rc_code,
        ]);
        $data->assignRole($request->role);
        if(!empty($request->permissions)){

            foreach ($request->permissions as $key => $value) {
                # code...
                // auth()->user()->givePermissionTo('manage postpaid');
                $data->givePermissionTo($value);
                // return $value;
            }
        }
        if($request->role == 'Tele Sale'){
            $teamleader = team_leader::create([
                'teamleader_id' => $request->teamleader,
                'userid'=> $data->id,
            ]);
        }

        // $data = call_center::create([
        //     'call_center_name' => $request->name,
        //     'call_center_amount' => $request->call_center_amount,
        //     'call_center_code' => $request->call_center_short_code,
        //     'status' => $request->status,
        // ]);

        // // return redirect()->back()->withInput();
        // notify()->success('Call Center has been created succesfully');
        return redirect(route('user-index'));
    }
    public function destroy(user $user,$id)
    {
        //
        // return $id;
        $d = user::findorfail($id);
        $d->delete();
        // return
        notify()->info('User has been succesfully deleted');

        // // return redirect()->back()->withInput();
        return redirect(route('user-index'));

    }
    public function edit($id){
         $user = user::select('users.*', 'team_leaders.teamleader_id')
         ->LeftJoin(
            'team_leaders','team_leaders.userid','users.id'
         )
         ->where('users.id',$id)->first();
        $teamleader = User::where('role', 'Team-Leader')->get();

        $CallCenter = call_center::wherestatus('1')->get();
        $role = Role::all();
        $permissions = Permission::all();
        $emirates = emirate::all();
        // $selected_role = Role::findById($id);


        return view('dashboard.edit-user', compact('user', 'CallCenter','role','permissions','emirates', 'teamleader'));
    }
    public function update(Request $request){
        // return $request;
        $user = user::findorfail($request->id);
        if($request->password == ''){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'agent_code' => $request->agent_code,
                // 'password' => Hash::make($request->password),
            ]);
            notify()->success('User has been updated Succesfully');
            return redirect(route('user-index'));
        }
        else{
            $user->update([
                'name' => $request->name,
                'agent_code' => $request->agent_code,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            notify()->success('User has been updated Succesfully');
            return redirect(route('user-index'));
        }
        // $id = $request

        // return $id;
    }
}
