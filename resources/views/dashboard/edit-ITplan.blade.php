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
    {!! Form::model($data,['method'=>'PATCH','action'=>['ItproductplansController@update',$data->id]]) !!}

                            @csrf
                            <!-- Plan name -->
                            <div class="form-group">

                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Package
                                    Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="name"
                                        placeholder="Type Package Here" type="text" value="{{ $data->name }}">
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>
                                <div class="form-group">

                                <label for="localminutes"
                                    class="control-label col-md-12 col-sm-12 col-xs-12">Type</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <!-- <input class="form-control has-feedback-left" id="inputSuccess3"  name="name" placeholder="Local Minutes" type="text"> -->
                                    <select name="type" id="duration" class="form-control has-feedback-left">
                                        {{-- <option value="{{ old('duration') }}">{{old('local_minutes') }}</option>
                                        --}}
                                        <option value="">--Please Select</option>
                                        @foreach ($products as $pd)
                                        <option value="{{$pd->id}}" @if ($data->type==$pd->id ) {{ 'selected' }} @endif>{{$pd->name}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>


                            </div>



                                <label for="localminutes"
                                    class="control-label col-md-12 col-sm-12 col-xs-12">Payment</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="payment"
                                        placeholder="Payment" type="number" value="{{ $data->pricing }}">
                                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                                </div>
                            </div>
                            <!--  #6-->
                            <div class="form-group">
                                <label for="plan_desc">Plan Description</label>
                                <textarea name="plan_desc" id="plan_desc" cols="30" rows="10"
                            class="plan_desc summernote">{{$data->description}}</textarea>
                            </div>
                            <!--  #7 -->
                            <div class="form-group">

                                <label for="localminutes"
                                    class="control-label col-md-12 col-sm-12 col-xs-12">Status</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <!-- <input class="form-control has-feedback-left" id="inputSuccess3"  name="name" placeholder="Local Minutes" type="text"> -->
                                    <select name="status" id="duration" class="form-control has-feedback-left">
                                        {{-- <option value="{{ old('duration') }}">{{old('local_minutes') }}</option>
                                        --}}
                                        <option value="">--Please Select</option>
                                        <option value="1" @if ($data->status=="1" ) {{ 'selected' }} @endif>Enable
                                        </option>
                                        <option value="0" @if ($data->status=="0" ) {{ 'selected' }} @endif>Disable
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
