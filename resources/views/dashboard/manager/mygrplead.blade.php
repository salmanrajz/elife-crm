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
                                    <table class="table table-striped table-bordered zero-configuration" style="font-weight:300">
                                    {{-- <table s id="pdf"> --}}
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Lead No</th>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Selected Number</th>
                                                <th>Plan Name</th>
                                                <th>Sim Type</th>
                                                <th>Channel</th>
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
                                                <td>{{$key}}</td>
                                                <td>{{$item->lead_no}}</td>
                                                <td>{{$item->date_time}}</td>
                                                <td>{{$item->customer_name}}</td>
                                                <td>{{$item->selected_number}}</td>
                                                <td>
                                                    {{-- {{$item->select_plan}} --}}

                                                    {{$provider::FullPlan($item->select_plan,$item->sim_type)}}
                                                </td>
                                                <td>{{$item->sim_type}}</td>
                                                <td>{{$item->channel_type}}</td>
                                                <td>{{$item->customer_number}}</td>
                                                <td>
                                                    @if ($item->sim_type == 'Elife')
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
                                                <a href="{{route('view.lead',$item->id)}}" data-toggle="tooltip" title="View Lead Details">
                                                        {{-- View remarks --}}
                                                            <i class="fa fa-eye display-6" style="color:green;"></i>
                                                    </a>
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
