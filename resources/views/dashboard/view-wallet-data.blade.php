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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Wallet</a>
                            </li>
                            <li class="breadcrumb-item active">All Wallet</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Wallet</h4>
                            <a class="btn btn-success" href="{{route('wallet.create')}}">Add New Wallet</a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Manager Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)

                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->username}}</td>
                                                <td>
                                                {{-- <a href="{{route('wallet.edit',$item->id)}}">
                                                <i class="fa fa-edit"></i>
                                                </a> --}}
                                                @if(auth()->user()->role == 'Manager')
                                                <button class="btn btn-success" onclick="window.location.href='{{route('agency.index')}}'">Assign To Agency</button>
                                                @else
                                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'wallet.destroy', $item->id ] ]) }}
                                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                                {{ Form::close() }}
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Manager Name</th>
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
