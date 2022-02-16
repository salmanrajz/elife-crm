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
                                {{-- <div class="table-responsive" id="broom">
                                    <h3 class="">if you're unable to see leads, please allow location for leads or refresh page</h3>
                                </div> --}}
                                <table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>S#</th>
            <th>Lead No</th>
            <th>Customer Name</th>
            <th>Plan Name</th>
            <th>Sim Type</th>
            <th>C.M. No</th>
            <th>Status</th>
            <th>Attend</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($operation as $key => $item)
        <tr>
            <td>{{$key}}</td>
            <td>{{$item->lead_no}}</td>
            <td>{{$item->customer_name}}</td>
            <td>
                @if ($item->sim_type == 'Elife')
                @php $plan = \App\elife_plan::whereId($item->select_plan)->first() @endphp
                {{$plan->plan_name}}
                @else
                @php $plan = \App\plan::whereId($item->select_plan)->first() @endphp
                {{$plan->plan_name}}
                @endif
            </td>
            <td>{{$item->sim_type}}</td>
            <td>{{$item->customer_number}}</td>
            <td>{{$item->status_name}}</td>
            <td>
                <a href="{{route('activation.edit',$item->id)}}">
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
            <!-- #/ container -->
        </div>
        @endsection
        {{-- @@section('name') --}}

        {{-- @endsection --}}
