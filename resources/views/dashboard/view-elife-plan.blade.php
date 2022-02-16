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
                                <h4 class="card-title">Plans</h4>
                            <a class="btn btn-success" href="{{route('elife.create')}}">Add New Plan</a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Product</th>
                                                <th>Speed</th>
                                                <th>Devices</th>
                                                <th>Duration</th>
                                                <th>Monthly Charges</th>
                                                <th>Installation Charges</th>
                                                <th>Revenue</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($plan as $item)

                                            <tr>
                                                <td>{{$item->plan_name}}</td>
                                                <td>{{$item->product_type}}</td>
                                                <td>{{$item->speed}}</td>
                                                <td>{{$item->devices}}</td>
                                                <td>{{$item->contract}}</td>
                                                <td>{{$item->monthly_charges}}</td>
                                                <td>{{$item->installation_charges}}</td>
                                                <td>{{$item->revenue}}</td>
                                                <td>
                                                <a href="{{route('elife.edit',$item->id)}}">
                                                <i class="fa fa-edit"></i>
                                                </a>
                                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'elife.destroy', $item->id ] ]) }}
                                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                                {{ Form::close() }}
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Speed</th>
                                                <th>Devices</th>
                                                <th>Duration</th>
                                                <th>Monthly Charges</th>
                                                <th>Installation Charges</th>
                                                <th>Revenue</th>
                                                <th>Action</th>
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
