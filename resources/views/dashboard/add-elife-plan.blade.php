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
                            {{ $error }}<br />
                            @endforeach
                        </div>
                        @endif
                        <form class="form-horizontal form-label-left input_mask" method="post"
                            action="{{route('elife.store')}}">
                            @csrf
                            <!-- Plan name -->
                            <div class="form-group">

                                <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Plan
                                    Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="plan_name"
                                        placeholder="Type Plan Name Here" type="text" value="{{old('plan_name')}}">
                                </div>
                            </div>
                            <!-- Plan name end -->

                            <!--  #1 -->
                            <div class="form-group">
                                <label for="localminutes"
                                    class="control-label col-md-2 col-sm-2 col-xs-12">Speed</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="speed"
                                        placeholder="250 Mbps" type="text" value="{{old('speed')}}">

                                </div>

                                <!--  #1-->
                                <!--  #2 -->

                                <label for="localminutes"
                                    class="control-label col-md-2 col-sm-2 col-xs-12">Devices</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="devices"
                                        placeholder="Broadband etc" type="text" value="{{old('devices')}}">

                                </div>
                            </div>
                            <!--  #2-->
                            <!--  #7 -->
                            <div class="form-group">



                                <!--  #7-->
                                <!--  #3 -->
                                <div class="form-group">
                                    <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Monthly
                                        Charges</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        <input class="form-control has-feedback-left" id="inputSuccess3"
                                            name="monthly_charges" placeholder="Monthly Charges" type="number"
                                            value="{{old('monthly_charges')}}">
                                    </div>

                                    <!--  #3-->
                                    <!--  #4 -->

                                    <label for="localminutes"
                                        class="control-label col-md-2 col-sm-2 col-xs-12">Installation Charges</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        <input class="form-control has-feedback-left" id="inputSuccess3"
                                            name="installation_charges" placeholder="Installation Charges" type="number"
                                            value="{{old('installation_charges')}}">

                                    </div>
                                    <label for="localminutes"
                                        class="control-label col-md-2 col-sm-2 col-xs-12">Revenue</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        <input class="form-control has-feedback-left" id="inputSuccess3" name="revenue"
                                            placeholder="Revenue" type="number" value="{{old('revenue')}}">

                                    </div>
                                </div>
                                <!--  #4-->
                                <label for="localminutes"
                                    class="control-label col-md-2 col-sm-2 col-xs-12">Duration</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <!-- <input class="form-control has-feedback-left" id="inputSuccess3"  name="name" placeholder="Local Minutes" type="text"> -->
                                    <select name="contract" id="duration" class="form-control has-feedback-left">
                                        <option value="">--Please Select</option>
                                        <option value="12 Months" @if (old('contract')=="12 Months" ) {{ 'selected' }}
                                            @endif>12 Months</option>
                                        <option value="24 Months" @if (old('contract')=="24 Months" ) {{ 'selected' }}
                                            @endif>24 Months</option>
                                        <option value="No Contract" @if (old('contract')=="No Contract" )
                                            {{ 'selected' }} @endif>No Contract</option>
                                    </select>
                                </div>
                                <label for="product_type"
                                    class="control-label col-md-2 col-sm-2 col-xs-12">Product Type</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <!-- <input class="form-control has-feedback-left" id="inputSuccess3"  name="name" placeholder="Local Minutes" type="text"> -->
                                    <select name="product_type" id="product_type" class="form-control has-feedback-left">
                                        <option value="">--Please Product</option>
                                        <option value="Elife" @if (old('product_type')=="Elife" ) {{ 'selected' }}
                                            @endif>Elife</option>
                                        <option value="BitStream" @if (old('product_type')=="BitStream" ) {{ 'selected' }}
                                            @endif>BitStream</option>
                                        {{-- <option value="No Contract" @if (old('contract')=="No Contract" ) --}}
                                            {{-- {{ 'selected' }} @endif>No Contract</option> --}}
                                    </select>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <!-- <button type="button" class="btn btn-primary">Can cel</button> -->
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success" name="upload">Submit</button>
                                    </div>
                                </div>




                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
