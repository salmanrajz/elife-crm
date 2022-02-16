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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <h1 class="text-center display-5">
                    Product
                </h1>
                <div class="row mt-10">
                    @foreach ($data as $item)
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body" >
                                    <h4>{{$item->name}} <span class="pull-right"><i class="ion-android-download f-s-30 text-primary"></i></span></h4>
                                    <h2 class="m-t-20 f-s-14 text-right" >
                                    @php
                                    // $item->name
                                    $pawry = str_replace(' ', '-', $item->name);
                                    // $pawry =
                                    @endphp
                                    <a href="{{route('partner.show',$pawry)}}">New Lead</a>
                                    </h2>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
@endsection
