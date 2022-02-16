@extends('layouts.dashboard-app')

@section('main-content')
        <div class="content-body">
            <div class="container">
                <div class="row page-titles">
                    <div class="col p-0">                        <h4>Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

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
@php( $countries = \App\country_phone_code::all())
@php( $emirates = \App\emirate::all())
@php( $plans = \App\plan::wherestatus('1')->get())
@php( $elifes = \App\elife_plan::wherestatus('1')->get())
@php( $addons = \App\addon::wherestatus('1')->get())
@php( $users = \App\User::whererole('sale')->get())
@php( $audios = \App\audio_recording::wherelead_no($operation->id)->get())
    {!! Form::model($operation,['method'=>'PATCH','action'=>['LeadSaleController@update',$operation->id]]) !!}
    @csrf
                                <div class="form-group">
                                <input type="hidden" name="lead_id" id="lead_id" value="{{$operation->id}}" class="dont_hide">
                                <input type="hidden" name="lead_no" id="lead_no" value="" class="dont_hide">
                                <input type="hidden" name="ver_id" id="ver_id" value="" class="dont_hide">

 <div class="form-group">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="center">
                                    Personal Information:
                                </label>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                            <input class="form-control " id="inputSuccess3" placeholder="Customer Name" name="cname" required type="text" disabled value="{{$operation->customer_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="center">
                                    <h4 style="display:inline-block;color:black;" class="black">Customer Number:</h4>
                                </label>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                <input class="form-control " id="inputSuccess3" placeholder="Customer Name" name="cname" required type="text" disabled value="{{$operation->customer_number}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="center">
                                    Emirate ID:
                                </label>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                <input class="form-control " id="inputSuccess3" placeholder="Customer Name" name="cname" required type="text" disabled value="{{$operation->emirate_id}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="center">
                                    <h4 class="black" style="display:inline-block;color:black;">Emirate #:</h4>
                                </label>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                <input class="form-control " id="inputSuccess3" placeholder="Customer Name" name="cname" required type="text" disabled value="{{$operation->emirate_num}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="center">
                                    Etisalat #:
                                </label>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                <input class="form-control " id="inputSuccess3" placeholder="Customer Name" name="cname" required type="text" disabled value="{{$operation->etisalat_number}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="center">
                                    Status:
                                </label>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="OK to Verify" {{ old('status') == 'OK to Verify' ? 'selected' : '' }} >OK to Verify</option>
                                    <option value="Cap Limit" {{ old('status') == 'Cap limit' ? 'selected' : '' }}>Cap Limit</option>
                                    <option value="Record Not Found" {{ old('status') == 'Record Not Found' ? 'selected' : '' }} >Record Not Found</option>
                                    <option value="Bill Pending"{{ old('status') == 'Bill Pending' ? 'selected' : '' }}>Bill Pending</option>
                                    <option value="Other Owner" {{ old('status') == 'Other Owner' ? 'selected' : '' }}>Other Owner</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <label class="center">
                                    Remarks *
                                </label>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                            <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control" required>{{old('remarks')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="call_back_ajax">
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <input type="submit" value="Proceed" class="btn btn-success">
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
