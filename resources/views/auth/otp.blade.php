@extends('layouts.app')

@section('content')
    <div class="login-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card">
                            <div class="card-body">
                                <div class="logo text-center offset-md-4">
                                {{-- <a href="{{route('login')}}">
                                        <img src="{{asset('assets/images/logo.png')}}" alt="Dialup" style="width:45%">
                                    </a> --}}
                                </div>
                                <h4 class="text-center m-t-15">Submit Feedback Survey</h4>
                        {!! Form::model($data,['method'=>'PATCH','action'=>['CustomerFeedBackController@update',$data->id]]) !!}

                                {{-- <form method="PATCH" action="{{route('feedback.update',$data->id)}}"> --}}
                                @csrf
                                Welcome {{$data->name}}
                                <div class="form-group">
                                <label for="name">{{__('OTP CODE')}}</label>
                                <input type="tel" name="otp" id="otp" class="form-control" value="{{old('otp')}}" required>
                                </div>
                                
                                        {{-- <div class="form-group col-md-6 text-right"><a href="#">Forgot Password?</a>
                                        </div> --}}
                                    </div>
                                    <div class="form-group">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-etisalat">
                                    {{ __('Submit') }}
                                </button>
                            <button type="button" class="btn btn-etisalat" onclick="OTP('{{$data->id}}','{{ route('ajaxRequest.OTP') }}')">
                                    {{ __('Resend OTP') }}
                                </button>
                                <a href="{{route('feedback.index')}}" class="btn btn-etisalat">
                                    {{ __('Back') }}
                                </a>
                                    </div>
                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<style>
    /* .background{
        background:url('https://creativepool.com/files/candidate/portfolio/full/1272208.png');
    } */
/* main {
  background: url('{{asset('images/etisalat.png')}}') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
} */
    .card,.row {
  background: url('{{asset('images/eti.png')}}') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.btn-etisalat{
    background:#bed30c;
    border:1px solid #bed30c;
    color:#fff;
}
</style>
