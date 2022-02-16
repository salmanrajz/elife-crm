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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Call Log</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                            @foreach($errors->all() as $error)
                            {{ $error }}<br />
                            @endforeach
                        </div>
                        @endif

                        {{-- foreach --}}
                        <!-- Plan name -->
                        <div class="row">

                            <label for="localminutes" class="control-label col-md-6 col-sm-12 col-xs-12">
                                Call Log Name</label>
                            <label for="localminutes" class="control-label col-md-6 col-sm-12 col-xs-12">
                                Remarks</label>
                        </div>
                        @inject('provider', 'App\Http\Controllers\AjaxController')
                        <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                    <th>S#</th>
                                    <th>Agent Name</th>
                                    <th>Follow Up</th>
                                    <th>Interested</th>
                                    <th>Not Interested</th>
                                    <th>No Answer</th>
                                    <th>Lead</th>
                                    <th>Not Valid</th>
                                    {{-- <th>Status</th> --}}
                                    {{-- <th>Remarks</th> --}}
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach ($k as $i => $item)
                                {{-- {{$item->number}} --}}
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$item->agent_name}}</td>
                                    <td>
                                    {{$provider::ElifeLogWise($item->userid,'Follow Up')}}
                                    </td>
                                    <td>
                                    {{$provider::ElifeLogWise($item->userid,'Interested')}}
                                    </td>
                                    <td>
                                    {{$provider::ElifeLogWise($item->userid,'Not Interested')}}
                                    </td>
                                    <td>
                                    {{$provider::ElifeLogWise($item->userid,'No Answer')}}
                                    </td>
                                    <td>
                                    {{$provider::ElifeLogWise($item->userid,'Lead')}}
                                    </td>
                                    <td>
                                    {{$provider::ElifeLogWise($item->userid,'Not Valid')}}
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @for($i = 0; $i<=300 ; $i++) --}}




                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
