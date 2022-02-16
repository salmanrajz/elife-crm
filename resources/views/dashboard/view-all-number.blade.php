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
                        @endrole                            <div class="table-responsive" id="broom">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Channel</th>
                                            <th>Status</th>
                                            <th>PassCode</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>

                                            <td style="font-size:18px;">
                                                {{$item->name}}
                                            </td>
                                            <td style="font-size:18px;">
                                                {{$item->number}}
                                            </td>
                                            <td style="font-size:18px;">
                                                {{$item->channel_type}}
                                            </td>
                                            <td style="font-size:18px;">
                                                {{$item->status}}
                                            </td>
                                            <td style="font-size:18px;">
                                                {{$item->passcode}}
                                            </td>
                                            <td style="font-size:18px;">
                                                @if ($item->status == 'Available')
                                                {{-- Only Seller Can Reserved Number --}}
                                                <button onclick="VerifyNum2('{{$item->id}}','{{route('ajaxRequest.VerifyNum2')}}')"
                                                                                class="btn btn-success">Remove</button>
                                                @elseif($item->status == 'Hold')
                                                <button onclick="reject('{{$item->id}}','{{route('ajaxRequest.Reject')}}','{{$item->cid}}')" class="btn btn-success">Reject</button>

                                                @elseif($item->status == 'Reserved')
                                                <button onclick="RevNum('{{$item->id}}','{{route('ajaxRequest.RevNum')}}','{{$item->cid}}')" class="btn btn-info">Revive</button>
                                                <button onclick="VerifyNum('{{$item->id}}','{{route('ajaxRequest.VerifyNum')}}','{{$item->cid}}')" class="btn btn-success">Remove</button>
                                                @elseif ($item->status == 'Active')
                                                <button onclick="Revert('{{$item->id}}','{{route('ajaxRequest.Revert')}}','{{$item->cid}}')" class="btn btn-success">Revert to Available</button>
                                                @endif
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
