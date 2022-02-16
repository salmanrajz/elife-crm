@extends('layouts.dashboard-app')

@section('main-content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col p-0">
                                       <h4>Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

            </div>
            <div class="col p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">From</a>
                    </li>
                    <li class="breadcrumb-item active">Basic</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                            @foreach($errors->all() as $error)
                            {{ $error }}<br />
                            @endforeach
                        </div>
                        @endif
                        <form class="form-horizontal form-label-left input_mask" method="post"
                            action="{{route('admin.user.store')}}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <!-- Plan name -->
                            <div class="form-group">

                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Agent
                                    Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="name"
                                        placeholder="Type Agent Name Here" type="text" value="{{ old('name') }}" autocomplete="off">
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>

                            </div>
                           <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Select RC Code</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input type="text" name="rc_code" id="rc_code" class="form-control">
                                   {{-- <select name="rc_code" id="rc_code" class="rc_code form-control" >
                                    <option value="">Select RC Code</option>
                                    @foreach($kioskid as $item)
                                        <option value="{{ $item->agency_id }}" @if (old('rc_code') == $item->agency_id) {{ 'selected' }} @endif>{{ $item->agency_id }}</option>
                                    @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Email</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="email"
                                        placeholder="Type Email Here" type="email" value="{{ old('email') }}">
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Select Group</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <select name="agent_group" id="agent_group" class="form-control select2">
                                        @foreach ($CallCenter as $item)
                                    <option value="{{$item->call_center_code}}">{{$item->call_center_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Select Role</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <select name="role" id="role" class="form-control">
                                        @foreach ($role as $r)
                                    <option value="{{$r->name}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Select Emirate</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                   <select name="emirates" id="emirate" class="emirates form-control" >
                                    <option value="">Select Emirates</option>
                                    @foreach($emirates as $emirate)
                                        <option value="{{ $emirate->name }}" @if (old('emirates') == $emirate->name) {{ 'selected' }} @endif>{{ $emirate->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="TeamLeaderDiv" >
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Select Team Leader</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                   <select name="teamleader" id="teamleader" class="form-control" >
                                    <option value="">Select Team Leader</option>
                                    @foreach($teamleader as $item)
                                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permissions">Permissions</label>
                                @foreach ($permissions as $pp)
                                <div class="col-md-12">
                                    <input type="checkbox" name="permissions[]" id="permission" value="{{$pp->name}}">
                                    <label for="Permissions">{{$pp->name}}</label>
                                </div>
                                @endforeach

                                {{-- <div class="col-md-12">
                                    <input type="checkbox" name="permissions[]" id="permission" value="manage postpaid">
                                    <label for="Permissions">Manage PostPaid</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="checkbox" name="permissions[]" id="permission" value="manage itproducts">
                                    <label for="Permissions">Manage IT Products</label>
                                </div> --}}
                            </div>

                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Password</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="password"
                                        placeholder="*********" type="password" >
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Confirm Password</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="password_confirmation"
                                        placeholder="*********" type="password" >
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="profile_pic">Profile Picture</label>
                                <input type="file" name="img" id="profile_pic" class="form-control-file">
                                <img id="myImg" src="#" alt="your image" style="width:25%"/>
                            </div>


                    </div>
                    <!--  #7-->
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <!-- <button type="button" class="btn btn-primary">Can cel</button> -->
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success" name="upload">Submit</button>
                        </div>
                    </div>


                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
<!-- #/ container -->
</div>
@endsection
