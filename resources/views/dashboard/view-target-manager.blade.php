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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Target</a>
                    </li>
                    <li class="breadcrumb-item active">All Target</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Targets</h4>
                        <a class="btn btn-success" href="{{route('Manager-target.create')}}">Add New Target</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Target</th>
                                        <th>Call Center Name</th>
                                        <th>Status</th>
                                        {{-- <th>Free Minutes</th>
                                        <th>Monthly Payments</th>
                                        <th>Duration</th>
                                        <th>Number Allowed</th> --}}
                                        {{-- <th>Revenue</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($r as $item)

                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->month}}</td>
                                        <td>{{$item->target}}</td>
                                        <td>{{$item->call_center_name}}</td>
                                        <td>{{$item->status}}</td>
                                        {{-- <td>{{$item->free_minutes}}</td> --}}
                                        {{-- <td>{{$item->monthly_payment}}</td> --}}
                                        {{-- <td>{{$item->duration}}</td> --}}
                                        {{-- <td>{{$item->number_allowed}}</td> --}}
                                        {{-- <td>{{$item->revenue}}</td> --}}
                                        <td>
                                            <a href="{{route('Manager-target.edit',$item->id)}}">
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
