@extends('layouts.dashboard-app')
@inject('provider', 'App\Http\Controllers\HomeController')
@section('main-content')
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
                            <h4 class="card-title">Pending Lead</h4>
                                {{-- {{}} --}}
                                @role('Tele Sale')
                                <div class="float-left">
                                    <a class="btn btn-success" href="{{route('partner.show','elifa-elife')}}">
                                        Add New Lead
                                    </a>
                                </div>
                                @endrole
                                {{-- <div class="float-right">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">End Date</label>
                                        <input type="date" name="start_date" id="end_date">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-info" onclick="SearchCustomReport('pending','{{route('ajaxRequest.ReportByDay')}}','{{auth()->user()->id}}')">Search</button>
                                    </div>
                                </div> --}}

                            {{-- <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a> --}}
                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Lead No</th>
                                                <th>Customer Name</th>
                                                <th>Plan Name</th>
                                                <th>Sim Type</th>
                                                <th>Lead Type</th>
                                                <th>C.M. No</th>
                                                <th>Lead Generate Time</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>View Lead</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($operation as $key => $item)

                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->lead_no}}</td>
                                                <td>{{$item->customer_name}}</td>
                                                <td>
                                                    @if ($item->select_plan != "")
                                                    @foreach(explode(',', $item->select_plan) as $info)
                                                        {{-- @php($app = \App\plan::whereid($info)) --}}
                                                            {{-- // {{$app->plan_name}} --}}
                                                            @php( $plans = \App\plan::whereid($info)->first())
                                                                {{$plans->plan_name}}
                                                    @endforeach
                                                    @endif


                                                </td>
                                                <td>{{$item->sim_type}}</td>
                                                <td>{{$item->lead_type}}</td>
                                                <td>{{$item->customer_number}}</td>
                                                <td>{{$item->lead_generate_time}}</td>
                                                <td>{{$item->status_name}}</td>
                                                <td>{{$item->remarks}}</td>
                                                <td>
                                                    <a href="{{route('view.lead',$item->id)}}">
                                                        View remarks
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
