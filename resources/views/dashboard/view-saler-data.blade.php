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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Plan</a>
                            </li>
                            <li class="breadcrumb-item active">All Agency</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Saler Data</h4>
                            <a class="btn btn-success" href="{{route('saler.entry')}}">Add Data</a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Company Name</th>
                                                <th>Authorize Person Name</th>
                                                <th>Authorize Person Number</th>
                                                <th>Company Number</th>
                                                <th>Email</th>
                                                <th>Company Address</th>
                                                <th>Remarks</th>
                                                <th>Location</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)

                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->company_name}}</td>
                                                <td>{{$item->authorize_person_name}}</td>
                                                <td>{{$item->authorize_person_number}}</td>
                                                <td>{{$item->company_number}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->company_address}}</td>
                                                <td>{{$item->remarks}}</td>
                                                <td>
                                                    <a href="https://maps.google.com?q={{$item->location}}">   View Location</a>
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
