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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">From</a>
                            </li>
                            <li class="breadcrumb-item active">Basic</li>
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
            {{ $error }}<br/>
        @endforeach
    </div>
@endif
    {!! Form::model($plan,['method'=>'PATCH','action'=>['PlanController@update',$plan->id]]) !!}

{{-- <form class="form-horizontal form-label-left input_mask" method="PUT" action="{{route('plan.update',$plan->id)}}"> --}}
@csrf
<!-- Plan name -->
                    <div class="form-group">

                           <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Plan Name</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input class="form-control has-feedback-left" id="inputSuccess3" name="plan_name" placeholder="Type Plan Name Here" type="text" value="{{ $plan->plan_name }}">
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>

                    </div>
                     <div class="form-group">

                           <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Plan Category</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <select name="plan_category" id="plan_category" class="form-control">
                                        <option value="">Select Number Type</option>
                                        <option value="Standard" {{$plan->plan_category == 'Standard' ? 'selected' : ''}}>Standard</option>
                                        <option value="silver" {{$plan->plan_category == 'silver' ? 'selected' : ''}} >Silver</option>
                                        <option value="gold" {{$plan->plan_category == 'gold' ? 'selected' : ''}}>Golden</option>
                                        <option value="Platinum" {{$plan->plan_category == 'platinum' ? 'selected' : ''}}>Platinum</option>
                                    </select>
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>

                    </div>
<!-- Plan name end -->

              <!--  #1 -->
                    <div class="form-group">
                          <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Local Minutes</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input class="form-control has-feedback-left" id="inputSuccess3" name="local_minutes" placeholder="Local Minutes" type="text" value="{{ $plan->local_minutes }}">
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>

              <!--  #1-->
              <!--  #2 -->

                          <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Flexible Minutes</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input class="form-control has-feedback-left" id="inputSuccess3" name="flexible_minutes" placeholder="Flexible Minutes" type="text" value="{{ $plan->flexible_minutes }}">
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>
                    </div>
              <!--  #2-->
              <!--  #3 -->
                    <div class="form-group">
                          <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Data</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input class="form-control has-feedback-left" id="inputSuccess3" name="data" placeholder="Type in GB" type="text" value="{{ $plan->data }}">
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>

              <!--  #3-->
              <!--  #4 -->

                          <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Preffered Number Allowed</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input class="form-control has-feedback-left" id="inputSuccess3" name="num_allowed" placeholder="Preffered Number Allowed" type="text" value="{{ $plan->number_allowed }}">
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>
                    </div>
              <!--  #4-->
              <!--  #5 -->
                    <div class="form-group">
                          <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Free Minutes to Preffered Numbers</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input class="form-control has-feedback-left" id="inputSuccess3" name="free_min" placeholder="Free Minutes to Preffered Numbers" type="text" value="{{ $plan->free_minutes }}">
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>

              <!--  #5-->
              <!--  #6 -->

                          <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Monthly Payment</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input class="form-control has-feedback-left" id="inputSuccess3" name="monthly_pay" placeholder="Monthly Payment" type="text" value="{{ $plan->monthly_payment }}">
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>
                    </div>
              <!--  #6-->
              <!--  #7 -->
                    <div class="form-group">
                          <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Duration</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <!-- <input class="form-control has-feedback-left" id="inputSuccess3"  name="name" placeholder="Local Minutes" type="text"> -->
                            <select name="duration" id="duration" class="form-control has-feedback-left">
                                {{-- <option value="{{ old('duration') }}">{{old('local_minutes') }}</option> --}}
                                <option value="">--Please Select</option>
                                <option value="No Commitment" @if ($plan->duration == "No Commitment") {{ 'selected' }} @endif>No Commitment</option>
                                <option value="12 Months" @if ($plan->duration == "12 Months") {{ 'selected' }} @endif>12 Months</option>
                                <option value="24 Months" @if ($plan->duration == "24 Months") {{ 'selected' }} @endif>24 Months</option>
                            </select>
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>
                          <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Revenue</label>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input class="form-control has-feedback-left" id="inputSuccess3" name="revenue" placeholder="Add Revenue" type="text" value="{{ $plan->revenue }}">
                            {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                          </div>


                    </div>
              <!--  #7-->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <!-- <button type="button" class="btn btn-primary">Can cel</button> -->
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" name="upload">Submit</button>
                        </div>
                      </div>

    {!! Form::close() !!}

                    {{-- </form> --}}

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- #/ container -->
        </div>
        @endsection
