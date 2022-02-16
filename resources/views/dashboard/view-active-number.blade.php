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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Plan</a>
                    </li>
                    <li class="breadcrumb-item active">All Plan</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Reserved Number</h4>
                        @role('Admin|superAdmin')
                        <a class="btn btn-yahoo" href="{{route('number-all')}}">All Number</a>
                        <a class="btn btn-info" href="{{route('active-number')}}">Active Number</a>
                        <a class="btn btn-success" href="{{route('user-number-all')}}">User Wise Number</a>
                        @endrole
                        <div class="table-responsive" id="broom">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Agent Name</th>
                                        <th>Number</th>
                                        <th>Type</th>
                                        <th>Channel Type</th>
                                        <th>Agent Group</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $k => $item)
                                    <tr>

                                        <td style="font-size:18px;">
                                            {{$item->name}}
                                        </td>
                                        <td style="font-size:18px;">
                                            {{$item->number}}
                                        </td>
                                        <td style="font-size:18px;">
                                            {{$item->type}}
                                        </td>
                                        <td style="font-size:18px;">
                                            {{$item->channel_type}}
                                        </td>
                                        <td style="font-size:18px;">
                                            {{$item->agent_group}}
                                        </td>
                                        <td style="font-size:18px;">
                                            {{$item->status}}
                                        </td>
                                        <td style="font-size:18px;">
                                            {{-- {{$item->css}} --}}
                                        @if(auth()->user()->role == 'Manager' || auth()->user()->role == 'NumberSuperAdmin' || auth()->user()->role == 'Admin')
                                        {{-- @role('Manager|NumberSuperAdmin|Admin') --}}
                                            @if ($item->status == 'Reserved' && $item->book_type == '1' || $item->status == 'Hold' && $item->book_type == '1')
                                            <button

                                                class="btn btn-danger" data-toggle="modal" data-target="#RejectModalNew{{$k}}">Reject
                                                Lead</button>
                                            @elseif($item->status == 'Active')
                                            @else
                                            <button
                                                onclick="RevNum('{{$item->id}}','{{route('ajaxRequest.RevNum')}}','{{$item->cid}}')"
                                                class="btn btn-info">Revive</button>

                                            @endif
                                        <div id="RejectModalNew{{$k++}}" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top:10%;">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" onclick="close_modal()">&times;</button>
                                                        {{-- <h4 class="modal-title">Reject</h4> --}}
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <p>Some text in the modal.</p> -->
                                                        <div class="form-group" style="display:block;" id="Reject_New">
                                                        <select name="reject_comment_new" id="reject_comment{{$k}}" class="form-control">
                                                            <option value="">Select Reject Reason</option>
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
                                                    <div class="modal-footer">
                                                    <input type="button" value="Reject" class="btn btn-success reject" name="reject_new" id="reject_ew" style="display:;" onclick="rejectManager('{{$item->id}}','{{route('ajaxRequest.ManagerReject')}}','{{$item->cid}}','{{$k}}')">
                                                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                                    </div>
                                                    </div>

                                                </div>
                                            </div>
                                            @endif
                                            {{-- @endrole --}}
                                            @role('admin')
                                            @if ($item->status == 'Active')
                                            @else
                                            <button
                                                onclick="RevNum('{{$item->id}}','{{route('ajaxRequest.RevNum')}}','{{$item->cid}}')"
                                                class="btn btn-info">Revive</button>
                                            @endif
                                            @if ($item->status == 'Active')
                                            <button
                                                onclick="Revert('{{$item->id}}','{{route('ajaxRequest.Revert')}}','{{$item->cid}}')"
                                                class="btn btn-success">Revert to Available</button>
                                            @else
                                            <button
                                                onclick="VerifyNum('{{$item->id}}','{{route('ajaxRequest.VerifyNum')}}','{{$item->cid}}')"
                                                class="btn btn-success">Remove</button>
                                            @endif
                                            @endrole
                                        </td>

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
