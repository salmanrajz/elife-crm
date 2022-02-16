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
        @role('Manager|NumberSuperAdmin|General-Manager')
        <div class="container">
            <h4>In Process</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.02','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4>Follow Up</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.19','channel'=>$pawry])}}'"
                            >
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4>Reject</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.04','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4>Final</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.21','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4>Non Validate</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.22','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endrole
        @role('MIS-COORDINATOR')
        <div class="container">
            <h4>In Process</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.02','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4>Follow Up</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.19','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4>Reject</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.04','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4>Final</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.21','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <h4>Non Validate</h4>
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetails',['id'=>'1.22','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endrole
        @role('VALIDATOR')
        <div class="container">
            <div class="row mt-3">
                @foreach ($permission as $channel)
                @php
                $pawry = str_replace(' ', '-', $channel->name);
                @endphp
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center" data-toggle="tootltip"
                            tooltip="Check Your Total Pending Lead"
                            onclick="javascript:location.href='{{route('showCampaignProductDetailsManageRecording',['id'=>'rec','channel'=>$pawry])}}'">
                            <h4 class="white" style="color:#fff;">{{$channel->name}}</h4>
                            <h6 class="display-5 mt-4 white" style="color:#fff;">
                                {{-- {{$cordination_pending}} --}}
                                {{-- {{$HomeCount::TotalLeadManagerChannelStatus($channel->name,'1.01')}} --}}
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endrole

    </div>
</div>
@endsection
