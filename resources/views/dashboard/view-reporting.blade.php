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
                                {{-- @can('manage sale')
                                <a class="btn btn-success" href="{{route('lead.show',1)}}">
                                        Add New Lead
                                </a>
                                @endcan --}}
                                <div class="float">
                                    <div class="form-group">
                                        <select name="status" id="status" class="form-control">
                                            @foreach ($status as $st)
                                        <option value="{{$st->status_name}}">{{$st->status_name}}</option>
                                            @endforeach
                                            {{-- <option value="pending">Pending</option> --}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">End Date</label>
                                        <input type="date" name="start_date" id="end_date"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                    <button class="btn btn-info" onclick="SearchCustomReport('{{$id}}','{{route('ajaxRequest.ReportByDay')}}','{{auth()->user()->id}}')">Search</button>
                                    </div>
                                </div>
                            {{-- <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a> --}}
                                <div class="table-responsive" id="ReportingData">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Lead No</th>
                                                <th>Customer Name</th>
                                                <th>Plan Name</th>
                                                <th>Sim Type</th>
                                                <th>C.M. No</th>
                                                <th>Lead Generate Time</th>
                                                {{-- <th>Status</th> --}}
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($operation as $key => $item)

                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->lead_no}}</td>
                                                <td>{{$item->customer_name}}</td>
                                                <td>{{$item->select_plan}}</td>
                                                <td>{{$item->sim_type}}</td>
                                                <td>{{$item->customer_number}}</td>
                                                <td>{{$item->lead_generate_time}}</td>
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
                                                @endif
                                                {{-- <td> --}}
                                                    <a href="{{route('view.lead',$item->id)}}">
                                                        View remarks
                                                    </a>
                                                {{-- </td> --}}
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
