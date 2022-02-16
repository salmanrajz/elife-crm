@extends('layouts.dashboard-app')
@inject('HomeCount', 'App\Http\Controllers\CoordinaterController')
@section('main-content')
        <div class="content-body">
            <div class="container">
                <div class="row page-titles">
                    <div class="col p-0">
                        <h4 class="white">Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

                    </div>
                    <div class="col p-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>

                @inject('HomeCount', 'App\Http\Controllers\HomeController')
{{-- s --}}
                @role('Coordination')
{{-- <h2 class="text-center display-3">Elife</h2> --}}
                <div class="container">
                    <div class="row mt-3">

                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead" onclick="javascript:location.href='{{route('all.pending','AllCord')}}'">
                                <h4 class="white" style="color:#fff;">All Leads</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                {{$HomeCount::TotalLeadManagerChannelStatusVerifiedElife('elifa','verified')}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead" onclick="javascript:location.href='{{route('verification.final-cord-lead')}}'">
                                <h4 class="white" style="color:#fff;">Pending Leads</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                {{$HomeCount::TotalLeadStatus('1.07','elife','elifa')}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead" onclick="javascript:location.href='{{route('all.pending','CordFollow')}}'">
                                <h4 class="white" style="color:#fff;">Follow Up Leads</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                {{$HomeCount::TotalLeadStatus('1.16','elife','elifa')}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead" onclick="javascript:location.href='{{route('activation.proceed')}}'">
                                <h4 class="white" style="color:#fff;">Processed Leads</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                {{$HomeCount::TotalLeadStatus('1.10','elife','elifa')}}
                                </h6>

                            </div>
                        </div>
                    </div>
                </div>
                @endrole
                {{-- {{auth()->user()->role}} --}}
                {{-- @role('') --}}

            </div>
        </div>
@endsection
