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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Activation Lead</a>
                            </li>
                            <li class="breadcrumb-item active">All Activation Lead</li>
                        </ol>
                    </div>
                </div>
                    <input type="hidden" id="lat">
                    <input type="hidden" id="lng">
                    <div id="map"></div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Activation Leads</h4>
                                {{-- <a class="btn btn-success" href="{{route('plan.create')}}">Add New Plan</a> --}}
                                <div class="table-responsive" id="broom">
                                    <h3 class="">if you're unable to see leads, please allow location for leads or refresh page</h3>
                                </div>
                                <h3 class="text-center" id="loading_num">
    Please wait while system loading leads...
    <img src="{{asset('assets/images/loader.gif')}}" alt="Loading" class="img-fluid text-center offset-md-6">
</h3>
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
