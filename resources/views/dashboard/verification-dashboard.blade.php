@extends('layouts.dashboard-app')

@section('main-content')
@inject('provider', 'App\Http\Controllers\HomeController')
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

                {{-- routes/ --}}
                @role('Verification')
                 <h2 class="text-left display-6">
                    {{-- PostPaid ({{$cp->name}}) --}}
                </h2>
                <div class="row mt-3">
                    <div class="col-lg-2">
                        <div class="card" id="active_div">
                            <div class="card-body text-center" data-toggle="tootltip" tooltip="Check Your Total Pending Lead">
                                <h4 class="white" style="color:#fff;">Total Pending</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                    {{-- {{$postpaid_pending}} --}}
                                    {{$provider::TotalLeadStatusElife('1.01','Elife')}}

                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead">
                                <h4 class="white" style="color:#fff;">Total Verified</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                    {{$provider::TotalLeadVerifiedElife('1.09','Elife')}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead">
                                <h4 class="white" style="color:#fff;">Total Re Verify</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                    {{$provider::TotalLeadStatusElife('1.11','Elife')}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-2">
                        <div class="card" id="process_div">
                            <div class="card-body text-center" data-toggle="tootltip" tooltip="Check Your Total Re Verified Lead" >
                                <h4 class="white" style="color:#fff;">Total Later Lead</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                    {{$provider::TotalLaterLeadElife(auth()->user()->id,'1.06','postpaid',$cp->name)}}
                                </h6>

                            </div>
                        </div>
                    </div> --}}
                </div>
                @endrole

            </div>
        </div>
@endsection
