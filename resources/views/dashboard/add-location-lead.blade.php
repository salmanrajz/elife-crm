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
                            <li class="breadcrumb-item active">Coordination Lead</li>
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
    <form action="{{route('lead-location.store')}}" method="post">
    @csrf
                                <div class="form-group">
                                <input type="hidden" name="" id="leadid" value="{{$operation->lead_no}}" class="dont_hide">
                                <input type="hidden" name="lead_id" id="lead_id" value="{{$operation->lead_no}}" class="dont_hide">
                                <input type="hidden" name="lead_no" id="lead_no" value="" class="dont_hide">
                                <input type="hidden" name="ver_id" id="ver_id" value="{{$operation->id}}" class="dont_hide">

                                <?php
                                // $idz = $id + 1;
                                ?>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <input class="form-control " id="leadno" value="{{$operation->lead_id}}" type="text" disabled>
                                    <input class="form-control " id="inputSuccess3" name="leadnumber" value="{{$operation->id}}" placeholder="Lead Number" type="hidden">
                                    <!-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> -->
                                </div>
                            </div>
                            <!--  #1-->
                            <!--  #2 -->
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="center">
                                        Personal Information
                                    </label>
                                </div>
                            </div>

                            <!-- form group start -->
                            <!-- Customer name start -->
                            <div class="form-group row">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                <input class="form-control " id="inputSuccess3" placeholder="Customer Name" name="cname" required type="text" value="{{$operation->customer_name}}">
                                </div>
                                <!-- </div>
                                <div class="item form-group"> -->
                                <!-- required -->

                                {{-- <span class="required">*</span> --}}
                                <div class="  col-md-5 col-sm-5 col-xs-12 form-group ">
                                    <!-- <input type="number" maxlength="1" max="9" min="1" size="1" > -->
                                    <input class="form-control " placeholder="Customer Number i.e 971551234567" name="cnumber" maxlength="12" required type="tel" value="{{$operation->customer_number}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return isNumberKey(event)">
                                </div>
                                <!-- Customer number end -->
                            </div>
                            <!-- form-group end -->
                            <!--  #2 end -->
                            <!--  #2 nationality and age-->

                            <!-- form group start -->
                            <!-- Customer name start -->
                            <div class="form-group row">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <select name="nation" id="c_select" class="form-control " required>
                                        {{-- <option value=""></option> --}}
                                        @foreach($countries as $country)
                                        <option value="{{ $country->name }}" {{ $operation->nationality == $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                                        {{-- <option value="{{ $country->name }}">{{ $country->name }}</option> --}}
                                        @endforeach
                                    </select>
                                </div>
                                <!-- </div>
                                <div class="item form-group"> -->
                                <!-- required -->

                                {{-- <span class="required">*</span> --}}
                                <div class=" item col-md-5 col-sm-5 col-xs-12 form-group ">
                                    <input class="form-control " id="age" placeholder="Customer Age not less than 21" name="age" required type="number" value="{{ $operation->age }}" onkeypress="return isNumberKey(event)" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2">
                                </div>
                                <!-- Customer number end -->
                            </div>
                            <!-- form-group end -->
                            <!--  #2 end -->
                            <!--  #3 start -->

                            <!-- form group start -->
                            <!-- Customer name start -->
                            <div class="row form-group">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">

                                    <select name="simtype" id="" class="sim_type form-control">
                                        <option value="">-- Product Type --</option>

                                        <option value="New" @if ($operation->sim_type == "New") {{ 'selected' }} @endif>New</option>
                                        <option value="MNP" @if ($operation->sim_type == "MNP") {{ 'selected' }} @endif>MNP</option>
                                        <option value="Elife" @if ($operation->sim_type == "Elife") {{ 'selected' }} @endif>Elife</option>
                                    </select>

                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                                    <select name="gender" id="" class="gender form-control">
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male" @if ($operation->gender == "Male") {{ 'selected' }} @endif>Male</option>
                                        <option value="Female" @if ($operation->gender == "Female") {{ 'selected' }} @endif>Female</option>
                                    </select>

                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group ">
                                    <select name="emirates" id="" class="emirates form-control">
                                        @foreach($emirates as $emirate)
                                        <option value="{{ $emirate->name }}" {{ $operation->emirates == $emirate->name ? 'selected' : '' }}>{{ $emirate->name }}</option>
                                        {{-- <option value="{{ $country->name }}">{{ $country->name }}</option> --}}
                                        @endforeach
                                    </select>

                                </div>
                                <!-- Customer number end -->
                                <div class=" item col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                                    <select name="emirate_id" class="form-control " required id="emirate_id">
                                        {{-- <option value="" ></option> --}}
                                        <option value="">-- Original Emirate Id --</option>
                                        <option value="Yes, Customer has original Emirates Id" id="" @if ($operation->original_emirate_id == "Yes, Customer has original Emirates Id") {{ 'selected' }} @endif>Yes, Customer has original Emirates Id</option>
                                        <option value="No" id="" @if ($operation->original_emirate_id == "No") {{ 'selected' }} @endif>No</option>
                                        <!-- <option value="24">24 Months</option> -->
                                    </select>

                                </div>
                                <!-- Customer Identity End -->

                                <div class=" item col-md-6 col-sm-6 col-xs-12 form-group">
                                    <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                                    {{-- <select name="additional_document" class="form-control " id="credit_salary" style="display:none;">
                                        <!-- <option value="No Documents Required">No Documents Required</option> -->
                                        <option value="Credit Card" id="">Credit Card</option>
                                        <option value="Salary Certificate" id="">Salary Certificate</option>
                                    </select> --}}
                                    <!-- salary_certificate_above_15000 Darham OR CREDIT CARD -->
                                    <select name="additional_document" class="form-control " id="hideme_document" style="display:block">

                                        <option value="No Additional Documents" @if ($operation->additional_document == "No Additional Documents") {{ 'selected' }} @endif>No Additional Documents Required</option>
                                        <option value="required" @if ($operation->additional_document == "required") {{ 'selected' }} @endif>Additional Document Required</option>
                                        <option value="Salary Certificate" @if ($operation->additional_document == "Salary Certificate") {{ 'selected' }} @endif>Salary Certificate</option>
                                        <option value="Tenancy Contract" @if ($operation->additional_document == "Tenancy Contract") {{ 'selected' }} @endif>Tenancy Contract</option>
                                        <option value="Utility Bill" @if ($operation->additional_document == "Utility Bill") {{ 'selected' }} @endif>Utility Bill (Current)</option>
                                        <option value="Credit Card" @if ($operation->additional_document == "Credit Card") {{ 'selected' }} @endif>Credit Card</option>
                                        <option value="Pay Slip" @if ($operation->additional_document == "Pay Slip") {{ 'selected' }} @endif>Pay Slip</option>
                                        <option value="Title Deeds" @if ($operation->additional_document == "Title Deeds") {{ 'selected' }} @endif>Title Deeds</option>
                                        <option value="Customer has Existing billing (account 6 months old)" @if ($operation->additional_document == "Customer has Existing billing (account 6 months old)") {{ 'selected' }} @endif>Customer has Existing billing (account 6 months old)
                                        </option>
                                        <!-- <option value="24">24 Months</optio n> -->
                                    </select>
                                    <!-- <input class="form-control " id="salman_ahmed" placeholder="Selected Number" data-validate-length-range="6" data-validate-words="2" name="selnumber" type="file"> -->

                                </div>
                                <div class="col-md-5 col-sm-6 col-xs-12 form-group ">
                                    <select name="language" class="form-control " required="">
                                        <option value="English" @if ($operation->language == "English") {{ 'selected' }} @endif>English</option>
                                        <option value="Arabic" @if ($operation->language == "Arabic") {{ 'selected' }} @endif>Arabic</option>
                                        <option value="Hindi/Urdu" @if ($operation->language == "Hindi/Urdu") {{ 'selected' }} @endif>Hindi / Urdu</option>
                                    </select>
                                </div>
                                <!-- </div>
                             <div class="item form-group"> -->
                                <!-- required -->
                                <div id="number_commit" style="display:none;">
                                    <span class="required">*</span>
                                    <div class=" item col-md-5 col-sm-5 col-xs-12 form-group " required>
                                        <select name="numcommit" class="form-control " id="commitment_">
                                            <option value="">-- Select Number Commitment --</option>
                                            <option value="Regular Commitment">Regular Commitment</option>
                                            <option value="Special Commitment">Special Commitment</option>
                                            <!-- <option value="New Special">New Special</option> -->
                                            <option value="Bronze Commitment">Bronze Commitment</option>
                                            <option value="Silver Commitment">Silver Commitment</option>
                                            <option value="Gold Commitment">Gold Commitment</option>
                                            <option value="Gold Plus Commitment">Gold Plus Commitment</option>
                                        </select>
                                        <!--                         <input class="form-control " id="inputSuccess3" placeholder="Number Commitment" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="numcommit" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->

                                    </div>
                                </div>
                                <!-- Customer number end -->
                            </div>
                            <!--  #3 end -->
                            <!--  #4 start -->

                <input type="hidden" name="saler_id" id="saler_id" value="{{$operation->saler_id}}">

                            <!--  #4 end -->
                            <!--  #5 -->
                            @if($operation->sim_type == 'Elife')
                            @include('dashboard.include.verify-elife')
                            @elseif($operation->sim_type == 'MNP')
                            @include('dashboard.include.verify-mnp')
                            @elseif($operation->sim_type == 'New')
                            @include('dashboard.include.cord-new')
                            @endif

                            <div class="container-fluid" style="border:1px solid black; padding:20px 30px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fom-group">
                                            <label for="add_location">Add Emirates</label>
                                            <select name="emirates" id="emirate" class="emirates form-control" required>
                                            <option value="">Select Emirates</option>
                                            @foreach($emirates as $emirate)
                                                <option value="{{ $emirate->name }}" @if ($operation->emirate_location == $emirate->name) {{ 'selected' }} @endif>{{ $emirate->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                    <div id="location_error"></div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Customer Location Url" name="add_location" id="add_location" value="{{old('add_location')}}" onkeyup="check_location_url()">
                                            <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="check_location_url()" id="checker">Fetch Location</button>
                                        </div>
                                    </div>
                                    </div>
                                <div class="col-md-6">
                                        @foreach ($audios as $audio)
                                <audio preload controls src='{{asset('audio')}}/{{$audio->audio_file}}' id='audio-player' name='audio-player'></audio>
                                @endforeach
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fom-group">
                                            <label for="add_location">Add Latitude and Langitude</label>
                                            <input type="text" class="form-control" id="add_lat_lng" name="add_lat_lng" value="{{old('add_lat_lng')}}">
                                        </div>
                                    </div>
                                </div>
                                {{-- {{auth()->user()->agent_code}} --}}
                                {{-- @if(auth()->user()->agent_code == 'CC8-ELIFE') --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fom-group">
                                            <label for="add_location">Allocate To:</label>

                                            <select name="assing_to" id="assing_to" class="form-control">
                                                <option value="">Allocate to</option>
                                                @foreach($users as $u)
                                                    <option value="{{$u->id}}">{{$u->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- @else --}}
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="fom-group">
                                            <label for="add_location">Allocate To:</label>

                                            <select name="assing_to" id="assing_to" class="form-control">
                                                <option value="">Allocate to</option>
                                                    <option value="136" {{ old('assign_to') == '136' ? 'selected' : 'selected' }}>Junaid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- @endif --}}

                                <br>
                                <div class="row">
                                    <div class="container-fluid">
                                        <button class="btn btn-success" type="submit" name="submit">Proceed</button>
                                        <button class="btn btn-success" type="button" name="follow" id="follow_up" data-toggle="modal" data-target="#myModal">Follow</button>
                                        <button class="btn btn-success" type="button" name="follow" id="follow_up" data-toggle="modal" data-target="#myModalVer">Re Verification</button>
                                        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#RejectModalNew">Reject</button>

                                    </div>
                                </div>
                            </div>
                            {{-- <input type="hidden" name="Verification" value="yes"> --}}
                            <!-- my modal reject -->

            <!-- Modal -->
                <div class="form-group">
                     <div id="myModal" class="modal fade" role="dialog" style="margin-top:10%;">
                         <div class="modal-dialog">

                             <!-- Modal content-->
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <button type="button" class="close" operation-dismiss="modal">&times;</button>
                                     <h4 class="modal-title">Follow Back</h4>
                                 </div>
                                 <div class="modal-body">
                                     <!-- <p>Some text in the modal.</p> -->
                                     <div class="form-group" style="display:block;" id="call_back_at_new">
                                         <div class="col-md-12 col-md-5">
                                             <label for="">
                                                 <h5>Call Back At</h5>
                                             </label>
                                         </div>
                                         <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                                             <input type="datetime-local" name="call_back_at_new" class="form-control myDatepicker" id="myDatepicker" placeholder="Add Later time" aria-describedby="inputSuccess2Status2">
                                         </div>
                                         <div class="col-md-12 col-md-5">
                                         <label for="remarks_new">Remarks</label>
                                         </div>
                                         <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                             <textarea name="remarks_for_cordination" id="remarks_for_cordination" cols="30" rows="10" class="form-control">{{old('remarks_for_cordination')}}</textarea>
                                         </div>

                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <input type="submit" value="Follow Up New" class="btn btn-success" name="follow_up_new" id="follow_up_new" style="display:;">

                                     <!-- <button type="button" class="btn btn-default" operation-dismiss="modal">Close</button> -->
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
                <div class="form-group">
                     <div id="myModalVer" class="modal fade" role="dialog" style="margin-top:10%;">
                         <div class="modal-dialog">

                             <!-- Modal content-->
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <button type="button" class="close" operation-dismiss="modal">&times;</button>
                                     <h4 class="modal-title">Re Verification Back</h4>
                                 </div>
                                 <div class="modal-body">
                                     <!-- <p>Some text in the modal.</p> -->
                                     <div class="form-group" style="display:block;" id="call_back_at_new">

                                         <div class="col-md-12 col-md-5">
                                         <label for="remarks_new">Remarks</label>
                                         </div>
                                         <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                             <textarea name="reverify_remarks" id="reverify_remarks" cols="30" rows="10" class="form-control">{{old('reverify_remarks')}}</textarea>
                                         </div>

                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <input type="submit" value="Re Verify" class="btn btn-success" name="follow_up_new" id="follow_up_new" style="display:;">

                                     <!-- <button type="button" class="btn btn-default" operation-dismiss="modal">Close</button> -->
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>

    {!! Form::close() !!}
<div id="RejectModalNew" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top:10%;">
              <div class="modal-dialog">
    {{ Form::open([ 'method'  => 'get', 'route' => [ 'lead.rejected', $operation->lead_id ], 'files' => true ]) }}
                <input type="hidden" name="lead_id" value="{{$operation->lead_no}}">
                <input type="hidden" name="ver_id" id="ver_id" value="{{$operation->id}}" class="dont_hide">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="close_modal()">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                  </div>
                  <div class="modal-body">
                    <!-- <p>Some text in the modal.</p> -->
                    <div class="form-group" style="display:block;" id="Reject_New">
                      <select name="reject_comment_new" id="reject_comment" class="form-control">
                        <option value="">Select Reject Reason</option>
                        <option value="Already Active">Already Active</option>
                        <option value="No Need">No Need</option>
                        <option value="Not Interested">Not Interested</option>
                        <option value="Emriate ID Expired">Emriate ID Expired</option>
                        <option value="Cap Limit">Cap Limit</option>
                        <option value="Less Salary">Less Salary</option>
                        <option value="Bill Pending">Bill Pending</option>
                        <option value="dont have valid docs">dont have valid docs</option>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" value="Reject" class="btn btn-success reject" name="reject_new" id="reject_ew" style="display:;" onclick="test_reject()">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                  </div>
                </div>
    {!! Form::close() !!}

              </div>
            </div>
                    {{-- </form> --}}

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- #/ container -->
        </div>
        @endsection
@include('dashboard.include.chat')
