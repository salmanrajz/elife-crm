@extends('layouts.dashboard-app')

@section('main-content')
{{-- @php( $question = \App\lead_sale::whereid($id)->get()) --}}
@php( $emirates = \App\emirate::all())
@php( $countries = \App\country_phone_code::all())


        <div class="content-body">
            <div class="container">
                <div class="row page-titles">
                    <div class="col p-0">
                        <h4>Hello, <span>Welcome {{auth()->user()->name}}</span></h4>

                    </div>
                    <div class="col p-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Operation Lead</a>
                            </li>
                            <li class="breadcrumb-item active">All Operation Lead</li>
                        </ol>
                    </div>
                </div>
 <div class="row">
      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
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

          <!-- pika booo -->
    {!! Form::model($operation,['method'=>'POST','action'=>['VerificationFormController@store',$operation->id],'files'=>true]) !!}
          {{-- <form method="post" id="pre-verification-form"> --}}
            <input type="hidden" name="cust_id" value="">
            <input class="form-control " id="leadid" value="{{$operation->id}}" placeholder="Lead Number" type="hidden" disabled>
            <input type="hidden" name="lead_id" id="lead_id" value="{{$operation->id}}">
            <input type="hidden" name="lead_no" id="lead_no" value="{{$operation->lead_no}}">
            <div class="table-responsive">

              <!-- kettly -->
              <div class="divTable blueTable">
                <div class="divTableHeading">
                  <div class="divTableRow">
                    <div class="divTableHead">Data Field</div>
                    <div class="divTableHead">Customer Data Field</div>
                    <div class="divTableHead">To be Edit</div>
                    <div class="divTableHead">Verified</div>
                  </div>
                </div>


                <?php


                ?>
                <div class="divTableBody">
                  <!-- 1 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Customer Name:</strong> </p>
                    </div>
                    <div class="divTableCell" style="width:20%;">
                      <input class="form-control " id="inputSuccess3" placeholder="Customer Name" name="old_cname" placeholder="Customer Number" type="text" disabled value="{{$operation->customer_name}}">
                    </div>
                    <div class="divTableCell" style="width:20%;">
                      <!-- <input type="checkbox"   id="state"> -->
                      <select name="Select Option" id="state" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                      </select>

                    </div>
                    <div class="divTableCell" style="width:20%;">
                    <input class="form-control " id="province" type="text" value="{{$operation->customer_name}}">
                      <input class="form-control " id="province1" name="cname" type="hidden" value="{{$operation->customer_name}}">
                      <input class="form-control " id="" name="cust_id" type="hidden" value="{{$operation->lead_no}}">
                      <script>
                        var myInput = document.getElementById('province');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- 1 -->
                  <!-- 2 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Customer Number:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Customer Name" name="old_cname" placeholder="Customer Number" type="tel" value="{{$operation->customer_number}}" maxlength="12">
                    </div>
                    <div class="divTableCell">
                      <select name="Select Option" id="state2" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="province2" type="text" value="{{$operation->customer_number}}">
                      <input class="form-control " id="province22" name="cnumber" type="hidden" value="{{$operation->customer_number}}">
                      <script>
                        var myInput = document.getElementById('province2');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- 2 -->
                  <!-- 3 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Age:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Age" name="old_age" placeholder="Customer Number" type="text" value="{{$operation->age}}">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state3" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="province3" type="text" value="{{$operation->age}}">
                      <input class="form-control " id="province33" name="age" type="hidden" value="{{$operation->age}}">
                      <script>
                        var myInput = document.getElementById('province3');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Emirates:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Age" name="old_age" placeholder="Customer Number" type="text" value="{{$operation->emirates}}">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state_emirates" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="emirates" id="province_emirates" class="emirates form-control" required>
                        <option value="{{$operation->emirates}}">
                            {{$operation->emirates}}
                          </option>
                        @foreach($emirates as $emirate)
                        <option value="{{ $emirate->name }}">{{ $emirate->name }}</option>
                    @endforeach
                      </select>
                      <input class="form-control " id="province__emirates" name="emirates" type="hidden" value="{{$operation->emirates}}">
                      <script>
                        var myInput = document.getElementById('province_emirates');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Language:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Age" name="old_age" placeholder="Customer Number" type="text" value="{{ $operation->language }}">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state_language" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="language" class="form-control " id="province_language">
                        <option value="{{ $operation->language }}">{{ $operation->language }}</option>
                        <option value="">Select Language</option>
                        <option value="English">English</option>
                        <option value="Arabic">Arabic</option>
                        <option value="Hindi/Urdu">Hindi / Urdu</option>
                      </select>
                      <input class="form-control " id="province__language" name="language" type="hidden" value="{{ $operation->language }}">
                      <script>
                        var myInput = document.getElementById('province_language');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- 3 -->
                  <!-- 4 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Nationality:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Nationality" name="old_nation" placeholder="Nationality" type="text" value="{{ $operation->nationality }}" >
                            </div>
                            <div class=" divTableCell">
                      <select name="Select Option" id="state4" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="nation" id="province4" class="form-control has-feedback-left">

                        <option value="{{ $operation->nationality }}">{{ $operation->nationality }}</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                        <!-- <input class="form-control " id="province4"  type="text" value=""  > -->
                      <input class="form-control " id="province44" name="nation" type="hidden" value="{{$operation->nationality}}">
                        <script>
                          var myInput = document.getElementById('province4');
                          myInput.disabled = true;
                        </script>
                    </div>
                  </div>
                  <!-- 4 -->
                  <!-- 5 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Original Emirate Id:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="inputSuccess3" disabled name="old_nation" value="{{ $operation->emirate_id }}" type="text" >
                            </div>
                            <div class=" divTableCell">
                      <select name="Select Option" id="state5" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="emirate_id" class="form-control has-feedback-left" required id="province5">
                        {{-- <option value=""></option> --}}
                        <option value="">-- Original Emirate Id --</option>
                        <option value="Yes, Customer has original Emirates Id" id="" @if ($operation->emirate_id == "Yes, Customer has original Emirates Id") {{ 'selected' }} @endif>Yes, Customer has original Emirates Id</option>
                        <option value="No" id="" @if ($operation->emirate_id == "No") {{ 'selected' }} @endif>No</option>
                        <!-- <option value="24">24 Months</option> -->
                      </select>
                      <!-- <input class="form-control " id="province5"  type="text" value=""> -->
                      <input class="form-control " id="province55" name="emirate_id" type="hidden" value="{{ $operation->emirate_id }}">
                      <script>
                        var myInput = document.getElementById('province5');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- 5 -->
                  <!-- original Emirate number -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Emirate ID #:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="inputSuccess3" disabled name="old_nation" value="{{ $operation->emirate_num }}" type="text">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state_emirate_num" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="province_original_id1" data-inputmask="'mask' : '999-9999-9999999-9'" data-validate-length-range="6" data-validate-words="2" name="emirate_number" placeholder="Emirate ID" type="num" value="{{ $operation->emirate_num }}">
                      <input class="form-control " id="province_original_id11" name="emirate_num" type="hidden" value="{{ $operation->emirate_num }}">
                      <script>
                        var myInput = document.getElementById('province_original_id1');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- original Emirate number end -->
                  <!-- 6 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Additional Documents:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="inputSuccess3" disabled value="{{ $operation->additional_document }}" name="" type="text">
                    </div>
                    <div class="divTableCell">
                      <select name="Select Option" id="state6" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="" id="province6" class="form-control">
                        <option value="Salary Certificate" id="" class="hideonelife" {{$operation->additional_documents == 'Salary Certificate ' ? 'selected' : ''}}>Salary Certificate</option>
                    <option value="Tenancy Contract" id="" {{$operation->additional_documents == 'Renancy Contract' ? 'selected' : ''}}>Tenancy Contract</option>
                    <option value="Utility Bill" id="" class="hideonelife" {{$operation->additional_documents == 'Utility Bill' ? 'selected' : ''}}>Utility Bill (Current)</option>
                    <option value="Credit Card" id="" class="hideonelife" {{$operation->additional_documents == 'Credit Slip' ? 'selected' : ''}}>Credit Card</option>
                    <option value="Pay Slip From Exchange" id="" class="hideonelife" {{$operation->additional_documents == 'Pay Slip From Exchange' ? 'selected' : ''}}>Pay Slip From Exchange</option>
                    <option value="Title Deeds" id="" class="hideonelife" {{$operation->additional_documents == 'Title Deeds' ? 'selected' : ''}}>Title Deeds</option>
                    <option value="Car Registration" id="" class="hideonelife" {{$operation->additional_documents == 'Car Mulkiya' ? 'selected' : ''}}>Car Mulkiya</option>
                    <option value="Labour Contract" id="" class="hideonelife" {{$operation->additional_documents == 'Labour Contract' ? 'selected' : ''}}>Labour Contracts</option>
                    <option value="Etisalat Postpaid/Elife Account" id="" class="hideonelife" {{$operation->additional_documents == 'Erisalat Postpaid/Elife Account' ? 'selected' : ''}}>Etisalat Postpaid/Elife Account</option>
                    <option value="Bank Statement Last 3 Months" id="" class="hideonelife" {{$operation->additional_documents == 'Bank Statement Last 3 Months' ? 'selected' : ''}}>Bank Statement Last 3 Months</option>
                    <option value="Customer has Existing billing (account 6 months old)" {{$operation->additional_documents == 'Customer has Existing billing (account 6 months old)' ? 'selected' : ''}} id="" class="hideonelife">Customer has Existing billing (account 6 months old)
                    </option>
                    <option value="DU Bill Last 3 Months" {{$operation->additional_documents == 'DU Bill Last 3 Months' ? 'selected' : ''}} id="" class="hideonelife">DU Bill Last 3 Months
                    </option>
                      </select>
                      <!-- <input class="form-control " id="province6"  type="file" value=""  > -->
                      <input class="form-control " id="province66" name="additional_documents" type="hidden" value="additional_documents">
                      <script>
                        var myInput = document.getElementById('province6');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                </div>
                <!-- kettly -->
                <div class="divTableRow">
                  <div class="divTableCell" style="width:20%;">
                    <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                    <p> <strong>Sim Type:</strong> </p>
                  </div>
                  <div class="divTableCell">
                  <input class="form-control " id="inputSuccess3" disabled placeholder="Sim Type" name="sim_type" type="text" value="{{$operation->sim_type}}">
                  </div>
                  <div class="divTableCell">
                    <select name="Select Option" id="state7" class="form-control" style="width:100px;">
                      <option value="other1">No </option>
                      <option value="other" id="other2">Yes</option>
                      <!-- <option value="other" id="other1">Yes</option> -->
                    </select>
                  </div>
                  <div class="divTableCell">

                    <input type="hidden" name="call_back_ajax">
                    <select name="simtype" id="province7" class="sim_type form-control" required>
                      <option value="">-- Product Type --</option>
                      <option value="New" @if ($operation->sim_type == "New") {{ 'selected' }} @endif>New</option>
                      <option value="MNP" @if ($operation->sim_type == "MNP") {{ 'selected' }} @endif>MNP</option>
                      <option value="Elife" @if ($operation->sim_type == "Elife") {{ 'selected' }} @endif>Elife</option>
                    </select>
                    <input type="hidden" name="total" value=">">
                    <input type="hidden" name="monthly_payment" value="">
                    <!-- <input class="form-control " id="province7"  type="text" value="  > -->
                    <input class="form-control " id="province77" name="sim_type" type="hidden" value="{{$operation->sim_type}}">
                    <script>
                      var myInput = document.getElementById('province7');
                      myInput.disabled = true;
                    </script>
                  </div>
                </div>
                <!-- call_back_ajax -->

              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                <input type="hidden" name="saler_id" id="saler_id" value="{{$operation->saler_id}}">
                <input type="hidden" name="call_back_ajax" class="call_back_ajax">
              <input type="hidden" name="gender" value="{{$operation->gender}}" class="gender">

              <div class="container hidden" style="background:#EEEEEE;border:1px solid #1C6EA4">
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <h4 class="">Pre Check Status</h4>
                  <h3 class="details red">
                    {{$operation->pre_check_status}}
                  </h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <h4 class="">Pre Check Remarks</h4>
                  <h3 class="details red">
                    {{$operation->pre_check_remarks}}
                  </h3>
                </div>
              </div>
               @if($operation->sim_type == 'Elife')
                <div class="container row" style="background:#EEEEEE;border:1px solid #1C6EA4">
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <h4 class="">DOB</h4>
                </div>
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <h4 class="">
                    <input type="date" name="dob" id="dob">
                  </h4>
                  <h3 class="details red">
                  </h3>
                </div>
              </div>
              @endif



              </div>
               @if($operation->sim_type == 'Elife')
               @include('dashboard.include.verify-elife')
               @elseif($operation->sim_type == 'MNP')
               @include('dashboard.include.verify-mnp')
               @elseif($operation->sim_type == 'New')
               @include('dashboard.include.verify-new')
               @endif

              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group audio_action row" >
                        <div class="col-sm-4 col-xs-12 col-md-4">
                          <label for="audio1" data-toggle="tooltip" title="Audio 1 is Mandatory">Audio 1</label>
                          <input type="file" name="audio[]" id="audio1" class=""  accept="audio/*">
                          </div>
                          <div class="col-sm-4 col-xs-12 col-md-4">
                            <label for="audio1">Audio 2 <strong style="color:red" data-toggle="tooltip" title="Audio 2nd Optional">Optional</strong></label>
                            <input type="file" name="audio[]" id="audio1" class=""  accept="audio/*">

                            </div>
                            <div class="col-sm-4 col-xs-12 col-md-4">
                                <label for="audio1">Audio <strong style="color:red" data-toggle="tooltip" title="Audio 3rd Optional">optional</strong></label>
                                <input type="file" name="audio[]" id="audio1" class=""  accept="audio/*">

                        </div>


                      </div>

                  </div>
                </div>
              </div>
              <br>
              <br>
              <br>
              <!-- end of table -->
              <!-- pika booo -->
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <!-- <button type="button" class="btn btn-primary">Cancel</button> -->
                  <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
                  <input type="submit" value="Verified" class="btn btn-success" name="upload">
                  <input type="button" value="Follow Up" class="btn btn-default" name="follow_up" id="follow_up" data-toggle="modal" data-target="#myModalF">
                  <button type="button" class="btn btn-success hidden" data-toggle="modal" data-target="#myModal">Later</button>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#RejectModalNew">Reject</button>
                  <!-- <input type="submit" value="Reject" class="btn btn-success" name="reject"> -->
                  <!-- <button type="submit" class="btn btn-success" name="upload">Submit</button> -->
                </div>
              </div>
            </div>
            <!-- my modal reject -->
            <div id="RejectModalNew" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top:10%;">
              <div class="modal-dialog">

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

              </div>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top:10%;" >
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="close_modal()">&times;</button>
                    <h4 class="modal-title">Choose Time &amp; Date for later</h4>
                  </div>
                  <div class="modal-body">
                    <!-- <p>Some text in the modal.</p> -->
                    <h6>Choose Date &amp; Time: </h6>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <!-- Linked Picker Parent -->
                        <div class="form-group">
                          <div class="input-group date" id="datetimepicker6">
                            <input type="datetime-local" class="form-control" name="later_date" id="later_date">
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>

                          </div>


                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Follow Up" class="btn btn-success" name="later">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
            <!-- FOLLOW UP -->
            <div id="myModalF" class="modal fade" role="dialog" style="margin-top:10%;">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <!-- <p>Some text in the modal.</p> -->
                    <div class="row">
                      <div class="col-md-12 col-sm-5 col-xs-12 form-group">
                        <h3>
                            Remarks
                        </h3>
                        <div class="form-group">
                            <textarea name="remarks_for_cordination" id="remarks_for_cordination" cols="30" rows="10" class="form-control">{{old('remarks_for_cordination')}}</textarea>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Submit" class="btn btn-success" name="later">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
            <!-- modal later -->
            <!-- modal reject end -->
          </form>
        </div>
      </div>



      <?php


      ?>


    </div>

            </div>
            <!-- #/ container -->
        </div>
        @endsection
        {{-- @@section('name') --}}

        {{-- @endsection --}}

        <style>
  div.blueTable {
    border: 1px solid #1C6EA4;
    background-color: #EEEEEE;
    width: 100%;
    text-align: left;
    border-collapse: collapse;
  }

  .divTable.blueTable .divTableCell,
  .divTable.blueTable .divTableHead {
    border: 1px solid #AAAAAA;
    padding: 3px 2px;
  }

  .divTable.blueTable .divTableBody .divTableCell {
    font-size: 13px;
  }

  .divTable.blueTable .divTableHeading {
    background: #34495E;
    border-bottom: 1px solid #444444;
  }

  .divTable.blueTable .divTableHeading .divTableHead {
    font-size: 15px;
    font-weight: bold;
    color: #FFFFFF;
    border-left: 1px solid #D0E4F5;
  }

  .divTable.blueTable .divTableHeading .divTableHead:first-child {
    border-left: none;
  }

  .blueTable .tableFootStyle {
    font-size: 14px;
  }

  .blueTable .tableFootStyle .links {
    text-align: right;
  }

  .blueTable .tableFootStyle .links a {
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 8px;
    border-radius: 5px;
  }

  .blueTable.outerTableFooter {
    border-top: none;
  }

  .blueTable.outerTableFooter .tableFootStyle {
    padding: 3px 5px;
  }

  /* DivTable.com */
  .divTable {
    display: table;
  }

  .divTableRow {
    display: table-row;
  }

  .divTableHeading {
    display: table-header-group;
  }

  .divTableCell,
  .divTableHead {
    display: table-cell;
  }

  .divTableHeading {
    display: table-header-group;
  }

  .divTableFoot {
    display: table-footer-group;
  }

  .divTableBody {
    display: table-row-group;
  }
</style>
@include('dashboard.include.chat')

