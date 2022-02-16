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
                        <li class="breadcrumb-item active">All Plan</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Reserved Number</h4>
 @role('Admin|superAdmin')
                        <a class="btn btn-yahoo" href="{{route('number-all')}}">All Number</a>
                        <a class="btn btn-info" href="{{route('active-number')}}">Active Number</a>
                        <a class="btn btn-success" href="{{route('user-number-all')}}">User Wise Number</a>
                        @endrole                            <div class="table-responsive" id="broom">
<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>Name</th>
            <th>Total Number of Reserved Number</th>
            <th>Remaining Attempt</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>

            <td style="font-size:18px;">
                {{$item->name}}
            </td>
            <td style="font-size:18px;">
                {{$item->total_posts}}
            </td>
            <td>
                {{10 - $item->total_posts}}
            </td>
            <td style="font-size:18px;">
            <a class="btn btn-success" href="{{route('user-number',$item->id)}}">View List</a>
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
