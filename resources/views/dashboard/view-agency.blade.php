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
                                <h4 class="card-title">Agency</h4>
                            <a class="btn btn-success" href="{{route('agency.create')}}">Add New Agency</a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Location Name</th>
                                                <th>Emirate</th>
                                                <th>Agency ID</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)

                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->location}}</td>
                                                <td>{{$item->agency_id}}</td>
                                                <td>
                                                    @if($item->status == 1)
                                                    Enable
                                                    @else
                                                    Disable
                                                    @endif
                                                </td>
                                                <td>
                                                {{-- <a href="{{route('user.edit',$item->id)}}">
                                                <i class="fa fa-edit"></i>
                                                </a> --}}
                                                <a href="{{route('agency.destroy',$item->id)}}" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="fa fa-recycle"></i>
                                                </a>
                                                <a href="{{route('agency.edit',$item->id)}}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="{{route('AgencyBilling',$item->id)}}">
                                                    <i class="fa fa-eye"></i>
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
