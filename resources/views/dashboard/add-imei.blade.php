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
                            action="{{route('imei.store')}}">
                            @csrf
                            <!-- Plan name -->
                            <div class="form-group">

                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">
                                    Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="name"
                                        placeholder="Type Plan Name Here" type="text" value="{{ old('name') }}">
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">
                                    IMEI NUMBER</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="imei"
                                        placeholder="Type IMEI Here" type="text" value="{{ old('imei') }}">
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>

                            </div>

                            <!--  #6-->
                            <!--  #7 -->
                            <div class="form-group">


                                <label for="duration" class="control-label col-md-12 col-sm-12 col-xs-12">Status</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <!-- <input class="form-control has-feedback-left" id="inputSuccess3"  name="name" placeholder="Local Minutes" type="text"> -->
                                    <select name="status" id="duration" class="form-control has-feedback-left">
                                        {{-- <option value="{{ old('duration') }}">{{old('local_minutes') }}</option>
                                        --}}
                                        <option value="">--Status--</option>
                                        <option value="1" @if (old('status')=="1" ) {{ 'selected' }} @endif>Enable
                                        </option>
                                        <option value="0" @if (old('status')=="0" ) {{ 'selected' }} @endif>Disabled
                                        </option>
                                    </select>
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


                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
