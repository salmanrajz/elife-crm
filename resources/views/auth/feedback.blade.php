@extends('layouts.app')
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/feedback.png')}}">
<title>FEEDBACK</title>
<meta property="og:image" content="{{asset('images/feedback.png')}}" />

@section('content')
    <div class="login-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card">
                            <div class="logo text-center offset-md-4">
                            <a href="{{route('login')}}">
                                    <img src="{{asset('images/etisalat-logo.png')}}" alt="Dialup" style="width:25%">
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="text-center m-t-15">Submit Feedback Survey</h4>
                                <form method="POST" action="{{route('feedback.store')}}">
                                @csrf
                                <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="name">{{__('Mobile Number')}}</label>
                                <input type="tel" name="number" id="name" class="form-control" value="{{old('number')}}" >
                                </div>
                                <div class="form-group">
                                <label for="name">{{__('Alternative Number')}}</label>
                                <input type="tel" name="alternative_number" id="name" class="form-control" value="{{old('alternative_number')}}">
                                </div>

                                <div class="form-group">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </div>
                                <div class="form-group">
                                <label for="plan_desc">{{__('Plan Description')}}</label>
                                <textarea class="form-control" name="plan_desc">{{old('plan_desc')}}</textarea>
                                {{-- <input type="tel" name="plan_desc" id="plan_desc" class="form-control" value="{{old('plan_desc')}}"> --}}
                                </div>


                                        <div class="form-group row" style="font-size:8px">
                            <div class="col-md-12 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="existing_customer">Existing Customer</label>
                                </div>
                        </div>
                                        {{-- <div class="form-group col-md-6 text-right"><a href="#">Forgot Password?</a>
                                        </div> --}}
                                    </div>
                                    <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-etisalat">
                                    {{ __('Submit') }}
                                </button>

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
body{
    font-family: Neotech-medium, "GE SS Two", Roboto, Arial, sans-serif !important;

}
    .card,.row {
  background: url('{{asset('images/eti3.png')}}') no-repeat center center fixed;
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
