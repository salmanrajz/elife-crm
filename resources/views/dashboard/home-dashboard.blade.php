@extends('layouts.dashboard-app')
@inject('provider', 'App\Http\Controllers\ReportController')
@inject('DataChecker', 'App\Http\Controllers\DataController')
@section('main-content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col p-0">
                <h4>Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

            </div>
            <div class="col p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
        @role('Saler')
        <h2 class="text-center display-3">Data Entry</h2>
        <div class="row">
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center" onclick="#">
                        <h4>Daily</h4>
                        <h6 class="display-5 mt-4">
                            {{$DataChecker::mydailylead(auth()->user()->id)}}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center" onclick="#">
                        <h4>Weekly</h4>
                        <h6 class="display-5 mt-4">
                            {{$DataChecker::myweeklylead(auth()->user()->id)}}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center" onclick="#">
                        <h4>Monthly</h4>
                        <h6 class="display-5 mt-4">
                            {{$DataChecker::mymonthlylead(auth()->user()->id)}}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center" onclick="#">
                        <h4>OverAll</h4>
                        <h6 class="display-5 mt-4">
                            {{$DataChecker::MyAllLead(auth()->user()->id)}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        @endrole
        @role('Tele Sale')
        <h2 class="text-center display-3">Elife</h2>
        <div class="row">
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center" onclick="#">
                        <h4>Total Activation</h4>
                        <h6 class="display-5 mt-4">
                            {{-- {{$elife_activation}} --}}
                            {{-- AllLeadsMonthlyAgent --}}
                            {{$provider::AllLeadsMonthlyAgent('1.02')}}

                        </h6>

                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Total Verified</h4>
                        <h6 class="display-5 mt-4">
                            {{$provider::AllLeadsMonthlyAgent('1.07')}}

                        </h6>

                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Total Rejected</h4>
                        <h6 class="display-5 mt-4">
                            {{$provider::AllLeadsMonthlyAgent('1.04')}}

                        </h6>

                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Total Follow Up </h4>
                        <h6 class="display-5 mt-4">
                            {{$provider::AllLeadsMonthlyAgent('1.03')}}
                        </h6>

                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Total Pending </h4>
                        <h6 class="display-5 mt-4">
                            {{$provider::AllLeadsMonthlyAgent('1.01')}}
                        </h6>

                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Total In Process </h4>
                        <h6 class="display-5 mt-4">
                            {{$provider::AllLeadsMonthlyAgent('1.10')}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        @endrole

    </div>
</div>
@endsection
