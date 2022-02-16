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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">All Leads for Verification</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Leads for Verification</h4>
                            {{-- <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a> --}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" style="font-weight:400;">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Lead No</th>
                                                <th>Customer Name</th>
                                                <th>Plan Name</th>
                                                <th>Sim Type</th>
                                                <th>C.M. No</th>
                                                <th>Later Date Time</th>
                                                <th>Status</th>
                                                {{-- <th>Remarks</th> --}}
                                                <th>Attend</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($operation as $key => $item)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$item->lead_no}}</td>
                                                <td>{{$item->customer_name}}</td>
                                                <td>

                                                @if ($item->sim_type == 'Elife')
                                                     @php( $plan = \App\elife_plan::whereId($item->select_plan)->first())
                                                        {{$plan->plan_name}}
                                                @else
                                                @php( $plan = \App\plan::whereId($item->select_plan)->first())
                                                        {{$plan->plan_name}}
                                                @endif
                                                </td>

                                                <td>{{$item->sim_type}}</td>
                                                <td>{{$item->customer_number}}</td>
                                                <td>{{$item->later_date}}</td>
                                                <td>
                                                    Reject
                                                </td>
                                                <td>
                                                <a href="{{route('verification.lead_generate',$item->id)}}" data-toggle="tooltip" title="Attend Lead for Verification">
                                                <i class="fa fa-check-circle display-6" style="color:green;"></i>
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
