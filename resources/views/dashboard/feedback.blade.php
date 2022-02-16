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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Feedback</a>
                            </li>
                            <li class="breadcrumb-item active">All Feedback</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Feedback</h4>
                            {{-- <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a> --}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Customer Email</th>
                                                <th>Customer Number</th>
                                                <th>Plan Desc</th>
                                                <th>Feedback Date</th>
                                                {{-- <th>Flexible Minutes</th> --}}
                                                {{-- <th>Data</th> --}}
                                                {{-- <th>Free Minutes</th> --}}
                                                {{-- <th>Monthly Payments</th> --}}
                                                {{-- <th>Duration</th> --}}
                                                {{-- <th>Revenue</th> --}}
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)

                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->phone_number}}</td>
                                                <td>{{$item->plan_desc}}</td>
                                                <td>{{$item->lead_date}}</td>

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
