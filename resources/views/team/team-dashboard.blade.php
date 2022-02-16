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
        {{-- {{auth()->user()->role}} --}}

        {{-- <h2 class="text-left display-6">
                    Users
                </h2> --}}
        @inject('HomeCount', 'App\Http\Controllers\HomeController')
        <div class="container">
            <div class="row mt-3">
                @php
                $pawry = str_replace('-', ' ', $channel_name);
                @endphp
                <div class="col-lg-2">
                    <h4 class="text-center">In Process</h4>
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('ShowTeamMemberLead',['id'=>'1.02','channel'=>$channel_name,'agent'=>$agent_id])}}'">
                            <h4 class="white" style="color:#fff;">{{$pawry}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                {{-- ['id'=>$item->id,'channel'=>$channel,'leadid'=>$item->id,'status'=>'1.01'] --}}
                <div class="col-lg-2">
                    <h4 class="text-center">Follow Up</h4>
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('ShowTeamMemberLead',['id'=>'1.19','channel'=>$channel_name,'agent'=>$agent_id])}}'">
                            <h4 class="white" style="color:#fff;">{{$pawry}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h4 class="text-center">Reject Lead</h4>
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('ShowTeamMemberLead',['id'=>'1.04','channel'=>$channel_name,'agent'=>$agent_id])}}'">
                            <h4 class="white" style="color:#fff;">{{$pawry}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h4 class="text-center">Final Lead</h4>
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('ShowTeamMemberLead',['id'=>'1.21','channel'=>$channel_name,'agent'=>$agent_id])}}'">
                            <h4 class="white" style="color:#fff;">{{$pawry}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h4 class="text-center">Non Validate</h4>
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('ShowTeamMemberLead',['id'=>'1.2','channel'=>$channel_name,'agent'=>$agent_id])}}'">
                            <h4 class="white" style="color:#fff;">{{$pawry}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
@endsection
