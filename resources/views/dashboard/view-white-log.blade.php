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
                    <li class="breadcrumb-item active">Call Log</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                            @foreach($errors->all() as $error)
                            {{ $error }}<br />
                            @endforeach
                        </div>
                        @endif

                        {{-- foreach --}}
                        <!-- Plan name -->
                        <div class="row">

                            <label for="localminutes" class="control-label col-md-6 col-sm-12 col-xs-12">
                                Call Log Name</label>
                            <label for="localminutes" class="control-label col-md-6 col-sm-12 col-xs-12">
                                Remarks</label>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                    <th>S#</th>
                                    <th>Agent Name</th>
                                    <th>Customer Name</th>
                                    <th>Customer Area</th>
                                    <th>Customer Number</th>
                                    {{-- <th>Customer Plan</th> --}}
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Date and Time</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach ($k as $i => $item)
                                {{-- {{$item->number}} --}}
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$item->agent_name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>Building - {{$item->building}} - Tenant Type : {{$item->tenant_type}} - {{$item->makani_eid}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{$item->remarks}}</td>
                                    <td>
                                        @if($item->other_remarks != '')
                                        {{-- {{$item->other_remarks}} --}}
                                            @if($item->other_remarks == 'Lead has Been Created')
                                            {{-- <a href=""></a> --}}
                                            {{$item->other_remarks}}
                                             <a href="#" data-toggle="tooltip"
                                                title="View Lead Details">
                                                {{-- View remarks --}}
                                                <i class="fa fa-eye display-6" style="color:green;"></i>
                                            </a>
                                            @else
                                            Lead Not Created Yet
                                            @endif
                                        @else
                                        {{$item->remarks}}
                                        @endif
                                    </td>
                                    <td>{{$item->updated_at}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        {{-- @for($i = 0; $i<=300 ; $i++) --}}




                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
