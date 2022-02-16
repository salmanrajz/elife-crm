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
                {{-- SS --}}
                {{-- {{auth()->user()->role}} --}}
                @can('activate lead')
                 <h2 class="text-left display-6">
                    {{-- PostPaid (OCP1) --}}
                </h2>
                <div class="row mt-3">
                    <div class="col-lg-2">
                        <div class="card" id="active_div">
                            <div class="card-body text-center" data-toggle="tootltip" tooltip="Check Your Total Pending Lead" onclick="javascript:location.href='{{url('admin/activation')}}'">
                                <h4 class="white" style="color:#fff;">Total Pending</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                    {{$cordination_pending}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead" onclick="javascript:location.href='{{route('myactive')}}'">
                                <h4 class="white" style="color:#fff;">Total Activate</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" > {{$cordination_complete}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead">
                                <h4 class="white" style="color:#fff;">Total Re Verify</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" > {{$reverify_lead}}</h6>

                            </div>
                        </div>
                    </div>
                </div>
                @endcan
                @role('Elife Active')
                <div class="row mt-3">
                    <div class="col-lg-2">
                        <div class="card" id="active_div">
                            <div class="card-body text-center" data-toggle="tootltip" tooltip="Check Your Total Pending Lead" onclick="javascript:location.href='{{url('admin/activation')}}'">
                                <h4 class="white" style="color:#fff;">Total Pending</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" >
                                    {{$cordination_pending}}
                                </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead" onclick="javascript:location.href='{{route('myactive')}}'">
                                <h4 class="white" style="color:#fff;">Total Activate</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" > {{$cordination_complete}}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center"  data-toggle="tootltip" tooltip="Check Your Total Verified Lead">
                                <h4 class="white" style="color:#fff;">Total Re Verify</h4>
                                <h6 class="display-5 mt-4 white" style="color:#fff;" > {{$reverify_lead}}</h6>

                            </div>
                        </div>
                    </div>
                </div>
                @endrole

            </div>
        </div>
@endsection
