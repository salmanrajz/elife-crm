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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Operation Lead</a>
                            </li>
                            <li class="breadcrumb-item active">All Operation Lead</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Operation Leads</h4>
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
                                                <th>C.M. No</th>
                                                <th>Lead Generate Time</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Attend</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($operation as $key => $item)
                                            @inject('provider', 'App\Http\Controllers\HomeController')

                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{$item->lead_no}}</td>
                                                <td>{{$item->customer_name}}</td>
                                                <td>{{$item->select_plan}}</td>
                                                <td>{{$item->sim_type}}</td>
                                                <td>{{$item->customer_number}}</td>
                                                <td>{{$item->lead_generate_time}}</td>
                                                <td>{{$item->status}}</td>
                                                <td>{{$item->remarks}}</td>
                                                <td>
                                                <a href="{{route('verification.pre-check-form',$item->id)}}">
                                                <i class="fa fa-edit"></i>
                                                </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S#</th>
                                                <th>Lead No</th>
                                                <th>Customer Name</th>
                                                <th>Plan Name</th>
                                                <th>Sime Type</th>
                                                <th>C.M. No</th>
                                                <th>Lead Generate Time</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Attend</th>
                                            </tr>
                                        </tfoot>
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
