@extends('layouts.dashboard-app')
{{-- https://github.com/grosv/laravel-passwordless-login?ref=madewithlaravel.com --}}
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
                    <li class="breadcrumb-item active">All Coordination Lead</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Coordination Leads</h4>
                        {{-- <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a> --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Lead No</th>
                                        {{-- <th>Date</th> --}}
                                        <th>Customer Name</th>
                                        {{-- <th>Selected Number</th> --}}
                                        <th>Plan Name</th>
                                        <th>Product Type</th>
                                        <th>C.M. No</th>
                                        <th>Lead Generate Time</th>
                                        <th>Status</th>
                                        {{-- <th>Remarks</th> --}}
                                        @if (auth()->user()->role == 'MainCoordinator')
                                        <th>Action</th>
                                        @else
                                        <th>Attend</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($operation as $key => $item)

                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->lead_no}}</td>
                                        {{-- <td>{{$item->verified_date}}</td> --}}
                                        <td>{{$item->customer_name}}</td>
                                        {{-- <td class="color:black;font-weight:bold">{{$item->selected_number}}</td> --}}
                                        <td>
                                            @if ($item->sim_type == 'Elife')
                                            @php $plan = \App\elife_plan::whereId($item->select_plan)->first() @endphp
                                            {{$plan->plan_name}}
                                            @else
                                            @php $plan = \App\plan::whereId($item->select_plan)->first() @endphp
                                            {{$plan->plan_name}}
                                            @endif
                                        </td>
                                        <td>{{$item->sim_type}}</td>
                                        <td>{{$item->customer_number}}</td>
                                        <td>{{$item->lead_generate_time}}</td>
                                        <td>{{$item->status_name}}</td>
                                        {{-- <td>{{$item->remarks}}</td> --}}
                                        @if (auth()->user()->role == 'MainCoordinator')
                                        <td>
                                            @if($item->status_name == 'Assign to Activation')
                                            <a href="{{route('manage-cordination',$item->id)}}">
                                                <i class="fa fa-check-circle display-6" style="color:green;"></i>
                                            </a>
                                            @endif
                                        </td>
                                        @else
                                        <td>
                                            <a href="{{route('verification.add-location-lead',$item->id)}}">
                                                <i class="fa fa-check-circle display-6" style="color:green;"></i>
                                            </a>
                                            @if ($item->status_name != 'cordfollow')
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#RejectModalNew{{$key}}">Follow Up Lead</button>
                                            {{-- MODAL REJECT --}}
                                            <div id="RejectModalNew{{$key}}" class="modal fade" role="dialog"
                                                data-backdrop="static" data-keyboard="false" style="margin-top:10%;">
                                                {!!
                                                Form::model($item,['method'=>'get','action'=>['AjaxController@CordinationFollow',$item->id]])
                                                !!}
                                                {{-- {{ Form::open([ 'method'  => 'get', 'route' => [ 'device.rejected', $item->id ] ]) }}
                                                --}}
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                onclick="close_modal()">&times;</button>
                                                            <h4 class="modal-title">Follow Up Remarks</h4>
                                                        </div>
                                                        {{$item->lead_no}}
                                                        <div class="modal-body">
                                                            <!-- <p>Some text in the modal.</p> -->
                                                            <div class="form-group" style="display:block;"
                                                                id="Reject_New">
                                                                <label for="followup_remarks">Follow</label>
                                                                <textarea name="followup_remarks" id="followup_remarks"
                                                                    cols="30" rows="10" class="form-control"
                                                                    required></textarea>
                                                                {!! Form::hidden('lead_id', $item->id) !!}
                                                                {!! Form::hidden('ver_id', $item->ver_id) !!}

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" value="FollowUp"
                                                                class="btn btn-success reject" name="reject_new"
                                                                id="reject_ew" style="display:;">
                                                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                                        </div>
                                                    </div>

                                                </div>
                                                {{ Form::close() }}

                                            </div>
                                            @endif

                                        </td>
                                        @endif
                                    </tr>
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
