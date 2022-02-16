@extends('layouts.dashboard-app')

@section('main-content')
<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <div class="col p-0">
                <h4>Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

            </div>
            {{-- <div class="col p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Target</a>
                    </li>
                    <li class="breadcrumb-item active">All Target</li>
                </ol>
            </div> --}}
        </div>
        @inject('provider', 'App\Http\Controllers\MainController')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Agent Report</h4>
                        {{-- <a class="btn btn-success" href="{{route('user-target.create')}}">Add New Target</a> --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Agent Name</th>
                                        <th>Email</th>
                                        <th>Pending</th>
                                        <th>In Process</th>
                                        <th>Active</th>
                                        <th>Reject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        @php
                                        $channel = str_replace(' ', '-', $channel);
                                        @endphp
                                        <th>
                                            <a href="{{route('AgentLeadData',['id'=>$item->id,'channel'=>$channel,'leadid'=>$item->id,'status'=>'1.01'])}}" data-toggle="tooltip"
                                                title="View Lead Details">
                                                {{-- View remarks --}}
                                                {{$provider::sale_count($item->id,'1.01',$channel)}}
                                                {{-- <i class="fa fa-pencil display-6" style="color:green;"></i> --}}
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{route('AgentLeadData',['id'=>$item->id,'channel'=>$channel,'leadid'=>$item->id,'status'=>'1.10'])}}" data-toggle="tooltip"
                                                title="View Lead Details">
                                                {{-- View remarks --}}
                                                {{$provider::sale_count($item->id,'1.10',$channel)}}
                                                {{-- <i class="fa fa-pencil display-6" style="color:green;"></i> --}}
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{route('AgentLeadData',['id'=>$item->id,'channel'=>$channel,'leadid'=>$item->id,'status'=>'1.02'])}}" data-toggle="tooltip"
                                                title="View Lead Details">
                                                {{-- View remarks --}}
                                                {{$provider::sale_count($item->id,'1.02',$channel)}}
                                                {{-- <i class="fa fa-pencil display-6" style="color:green;"></i> --}}
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{route('AgentLeadData',['id'=>$item->id,'channel'=>$channel,'leadid'=>$item->id,'status'=>'1.04'])}}" data-toggle="tooltip"
                                                title="View Lead Details">
                                                {{-- View remarks --}}
                                                {{$provider::sale_count($item->id,'1.04',$channel)}}
                                                {{-- <i class="fa fa-pencil display-6" style="color:green;"></i> --}}
                                            </a>
                                        </th>

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
