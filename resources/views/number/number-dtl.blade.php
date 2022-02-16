@extends('layouts.num-app')

@section('content')
<body onload="NumberDtl('All','{{route('ajaxRequest.NumberByType')}}','{{$slug}}')">

<div class="form-container">
    <div class="container-fluid">
        <h3>Select Number Type</h3>
        @foreach ($q as $qq)
    <input type="radio" name="numtype" id="standard" value="{{$qq->type}}" onclick="NumberDtl('{{$qq->type}}','{{route('ajaxRequest.NumberByType')}}','{{$slug}}')">
        <label for="radio">{{$qq->type}}</label>
        @endforeach
        <input type="radio" name="numtype" id="reload" onclick="NumberDtl('All','{{route('ajaxRequest.NumberByType')}}','{{$slug}}')">
            <label for="radio">Show All</label>
    </div>

    <div class="container-fluid float-left left">
        <button class="btn btn-info float-left left" onclick="ShowReserved('{{auth()->user()->id}}','{{route('ajaxRequest.ReservedNum')}}','{{$slug}}')">Show Reserved Number</button>
        @if (auth()->user()->agent_code != 'ARF')
        <a class="btn btn-success" href="{{route('lead.show',1)}}">Lead Dashboard</a>
        @endif
    {{-- </div> --}}
    {{-- <div class="container-fluid float-right right"> --}}
        {{-- <li><a href="{{route('logout')}}"><i class="icon-power"></i> <span>Logout</span></a> --}}
        <a class="btn btn-success float-right right" href="{{route('logout')}}">Logout ({{auth()->user()->name}})</a>
    </div>

</div>
<h3 class="text-center" id="loading_num">
    Please wait while system loading numbers...
    <img src="{{asset('assets/images/loader.gif')}}" alt="Loading" class="img-fluid text-center offset-md-6">
</h3>
<div id="broom">

</div>

@endsection
