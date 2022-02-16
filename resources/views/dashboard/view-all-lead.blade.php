@extends('layouts.dashboard-app')

@section('main-content')
@inject('provider', 'App\Http\Controllers\AjaxController')
        <div class="content-body">
            <div class="container">
                <div class="row page-titles">
                    <div class="col p-0">
                        <h4>Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

                    </div>
                    <div class="col p-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Sale Leads</a>
                            </li>
                            <li class="breadcrumb-item active">All Sale Leads</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">{{$id}}</h4>
                                {{-- {{}} --}}
                                @can('manage sale')
                                <a class="btn btn-success" href="{{route('lead.show',1)}}">
                                        Add New Lead
                                </a>
                                @endcan
                            {{-- <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a> --}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" style="font-weight:300">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Lead No</th>
                                                <th>Customer Name</th>
                                                <th>Selected Number</th>
                                                <th>Plan Name</th>
                                                <th>Sim Type</th>
                                                <th>C.M. No</th>
                                                <th>Lead Generate Time</th>
                                                <th>Lead Accept Time</th>
                                                <th>Total Time</th>
                                                {{-- <th>Status</th> --}}
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($operation as $key => $item)

                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$item->lead_no}}</td>
                                                <td>{{$item->customer_name}}</td>
                                                <td style="color:black;font-weight:1000;">{{$item->selected_number}}</td>
                                                <td>

                                                @if ($item->sim_type == 'Elife')
                                                     @php( $plan = \App\elife_plan::whereId($item->select_plan)->first())
                                                        {{$plan->plan_name}}
                                                @else
                                                @php( $plan = \App\plan::whereId($item->select_plan)->first())
                                                        {{$plan->plan_name}}
                                                @endif
                                                </td>
                                                {{-- <td>{{$item->select_plan}}</td> --}}
                                                <td>{{$item->sim_type}}</td>
                                                <td>{{$item->customer_number}}</td>
                                                <td>{{$item->lead_generate_time}}</td>
                                                <td>{{$item->lead_accept_time}}</td>
                                                <td>
                                                    {{$provider::total_time($item->lead_accept_time,$item->lead_proceed_time)}}
                                                </td>
                                                <td>
                                                    @if ($item->sim_type == 'Elife')
                                                        @if ($item->status == '1.02')
                                                            SR Generated
                                                        @endif
                                                    @else
                                                        {{$item->status_name}}
                                                    @endif
                                                </td>
                                                {{-- <td>{{$item->remarks}}</td> --}}
                                                <td>
                                                @if($item->status == '1.03')
                                                <a href="{{route('lead.edit',$item->id)}}">
                                                <i class="fa fa-edit"></i>
                                                </a>
                                                @elseif($item->status == '1.13')
                                                 <a href="{{route('re-verification.lead_generate',$item->id)}}">
                                                <i class="fa fa-edit"></i>
                                                </a>
                                                @else
                                                {{-- <td> --}}
                                                    <a href="{{route('view.lead',$item->id)}}" data-toggle="tooltip" title="View">
                                                        {{-- View remarks --}}
                                                            <i class="fa fa-eye display-6" style="color:green;"></i>
                                                    </a>
                                                {{-- </td> --}}
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
