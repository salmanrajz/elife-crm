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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    {{--  --}}
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center">
                            <a href="{{route('elife.index')}}"><h4 class="white" style="color:#fff;">All Elife Plan List</h4></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center">
                            <a href="{{route('plan.index')}}"><h4 class="white" style="color:#fff;">All Postpaid Plan List</h4></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="rejected_div">
                            <div class="card-body text-center">
                            <a href="{{route('elife-addon.index')}}"><h4 class="white" style="color:#fff;">All Elife Addon List</h4></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="follow_up_div">
                            <div class="card-body text-center">
                            <a href="{{route('call-center.index')}}"><h4 class="white" style="color:#fff;">All Call Center List</h4></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="card" id="follow_up_div">
                            <div class="card-body text-center">
                            <a href="{{route('emirate.index')}}"><h4 class="white" style="color:#fff;">All Emirate List</h4></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="pending_div">
                            <div class="card-body text-center">
                            <a href="{{route('imei.index')}}"><h4 class="white" style="color:#fff;">Elife Device List</h4></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="pending_div">
                            <div class="card-body text-center">
                            <a href="{{route('user-index')}}"><h4 class="white" style="color:#fff;">Users</h4></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
@endsection
