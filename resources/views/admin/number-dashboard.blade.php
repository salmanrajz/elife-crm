@extends('layouts.dashboard-app')
@php
$channel = \App\channel_partner::whereStatus('1')->get();
$r = \App\numberdetail::select('numberdetails.type')->where('status','Available')->groupBy('numberdetails.type')->get();
@endphp
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
            </div>
            <div class="container">
                <div class="row">
            @foreach ($channel as $c)

                @foreach ($r as $item)
                <div class="col-lg-2">
                    <div class="card" id="active_div">
                        <div class="card-body text-center">
                            <a href="{{route('NumberAllCleaner',['id'=>$item->type,'channel'=>$c->name])}}"><h4 class="white" style="color:#fff;">{{$c->name}} - {{$item->type}}</h4></a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforeach

                </div>
            </div>

        </div>
@endsection
