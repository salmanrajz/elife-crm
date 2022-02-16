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
                    <li class="breadcrumb-item active">Call Center Leads</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Call Center All Leads</h4>
                        {{-- {{}} --}}

                        {{-- <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a> --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration"
                                style="font-weight:300">
                                {{-- <table s id="pdf"> --}}
                                <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Lead No</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        {{-- <th>Selected Number</th> --}}
                                        <th>Plan Name</th>
                                        <th>Sim Type</th>
                                        {{-- <th>Channel</th> --}}
                                        <th>Customer Number</th>
                                        {{-- <th>Lead Generate Time</th> --}}
                                        <th>Status</th>
                                        {{-- <th>Remarks</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($operation as $key => $item)

                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->lead_no}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->customer_name}}</td>
                                        <td>
                                            {{-- {{$item->plan}} --}}
                                                @php
                                                 $plan = \App\elife_plan::whereId($item->plan)->first();
                                                 if($plan){
                                                    echo $plan->plan_name;
                                                 }
                                                 else{
                                                    $plan = \App\plan::whereId($item->plan)->first();
                                                    if($plan){
                                                        echo $plan->plan_name;
                                                    }
                                                    else{

                                                    }
                                                 }
                                                @endphp
                                                {{-- {{$plan->plan_name}} --}}
                                            {{-- @php( ) --}}
                                                    {{-- {{$plan->plan_name}} --}}
                                            {{-- @endif --}}
                                            {{-- {{$provider::FullPlan($item->plan,'Elife')}} --}}
                                        </td>
                                        <td>{{$item->product_type}}</td>
                                        <td>{{$item->customer_number}}</td>
                                        <td>
                                            @if ($item->product_type == 'Elife')
                                            @if ($item->status == '1.02')
                                            SR Generated
                                            @else
                                            {{$item->status_name}}
                                            @endif
                                            @else
                                            {{$item->status_name}}
                                            @endif
                                        </td>
                                        {{-- <td>{{$item->remarks}}</td> --}}
                                        <td>
                                           <a href="{{route('AddRecording',['id'=>$id,'channel'=>$channel,'leadid'=>$item->id])}}" data-toggle="tooltip"
                                                title="View Lead Details">
                                                {{-- View remarks --}}
                                                <i class="fa fa-pencil display-6" style="color:green;"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    <div id="myModal{{$key}}" class="modal fade" role="dialog" style="margin-top:10%;">
                                        <form id="ModalActiveForm" onsubmit="return false">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Choose Time &amp; Date for later</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <p>Some text in the modal.</p> -->
                                                        <h6>Choose Date &amp; Time: </h6>
                                                        <div class="row">
                                                            <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                                                <!-- Linked Picker Parent -->
                                                                <div class="form-group">
                                                                    <div class="input-group" id="datetimepicker6">
                                                                        <input type="datetime-local"
                                                                            class="form-control" name="later_date"
                                                                            id="datetimepicker6">
                                                                        <input type="hidden" name="lead_id"
                                                                            value="{{$item->id}}">
                                                                        <span class="input-group-addon">
                                                                            <span
                                                                                class="glyphicon glyphicon-calendar"></span>
                                                                        </span>

                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" value="Submit" class="btn btn-success"
                                                            name="later"
                                                            onclick="ModalForm('{{route('activate-elife-plan')}}','ModalActiveForm')">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    <div id="RejectLead{{$key}}" class="modal fade" role="dialog" style="margin-top:10%;">
                                        <form id="ModalActiveForm" onsubmit="return false">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Select Remarks</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <p>Some text in the modal.</p> -->
                                                        <h6>Select Remarks </h6>
                                                        <div class="row">
                                                            <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                                                <!-- Linked Picker Parent -->
                                                                <div class="form-group">
                                                                    <select name="remarks" id="remarks" class="form-control">
                                                <option value="">Select Reject Reason</option>
                                                <option value="Already Active">Already Active</option>
                                                <option value="No Need">No Need</option>
                                                <option value="Not Interested">Not Interested</option>
                                                <option value="Emriate ID Expired">Emriate ID Expired</option>
                                                <option value="Cap Limit">Cap Limit</option>
                                                <option value="Less Salary">Less Salary</option>
                                                <option value="Bill Pending">Bill Pending</option>
                                                <option value="dont have valid docs">dont have valid docs</option>
                                            </select>



                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" value="Submit" class="btn btn-success"
                                                            name="later"
                                                            onclick="ModalForm('{{route('reject-elife-plan')}}','ModalActiveForm')">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
{{-- @@section('name') --}}

{{-- @endsection --}}
