@extends('layouts.dashboard-app')

@section('main-content')
        <div class="content-body">
            <div class="container">
                <div class="row page-titles">
                    <div class="col p-0">                        <h4>Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

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
                                <h4 class="card-title">Plans</h4>
                            <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Plan Category</th>
                                                <th>Local Minutes</th>
                                                <th>Flexible Minutes</th>
                                                <th>Data</th>
                                                <th>Free Minutes</th>
                                                <th>Monthly Payments</th>
                                                <th>Duration</th>
                                                <th>Number Allowed</th>
                                                <th>Revenue</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($plan as $item)

                                            <tr>
                                                <td>{{$item->plan_name}}</td>
                                                <td>{{$item->plan_category}}</td>
                                                <td>{{$item->local_minutes}}</td>
                                                <td>{{$item->flexible_minutes}}</td>
                                                <td>{{$item->data}}</td>
                                                <td>{{$item->free_minutes}}</td>
                                                <td>{{$item->monthly_payment}}</td>
                                                <td>{{$item->duration}}</td>
                                                <td>{{$item->number_allowed}}</td>
                                                <td>{{$item->revenue}}</td>
                                                <td>
                                                <a href="{{route('plan.edit',$item->id)}}">
                                                <i class="fa fa-edit"></i>
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
