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
    {!! Form::model($data,['method'=>'PATCH','action'=>['LeadSaleController@update',$data->id]]) !!}

                            {{-- <form class="form-horizontal form-label-left input_mask" method="post" action="{{route('lead.store')}}"> --}}
@csrf
<!-- Plan name -->



<div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label class="center">
                    Personal Information
                  </label>
                </div>
              </div>


              <!-- form group start -->
              <!-- Customer name start -->
              <div class="form-group row">
                <input class="form-control " id="leadid" value="{{$data->id}}" placeholder="Lead Number" type="hidden" disabled>
                <input class="form-control " id="leadno" value="{{$data->lead_no}}" placeholder="Lead Number" type="text" disabled>
                <input class="form-control " id="inputSuccess3" name="leadnumber" value="{{$data->lead_no}}" placeholder="Lead Number" type="hidden">
                <input type="hidden" name="channel_type" id="type" value="{{$data->channel_type}}">
                <input type="hidden" name="lead_type" id="type" value="{{$data->lead_type}}">
                <div class="col-md-6 col-sm-12 col-xs-12 form-group ">
                    <label for="cname">Customer Name</label>
                <input class="form-control " id="cname" placeholder="Customer Name" name="cname" type="text" required value="{{$data->customer_name}}">

                </div>
                <!-- </div>
                            <div class="item form-group"> -->
                <!-- required -->


                {{-- <span class="required">*</span> --}}
                <div class="  col-md-6 col-sm-12 col-xs-12 form-group ">
                  <!-- <input type="number" maxlength="1" max="9" min="1" size="1" > -->
                    <label for="cnumber">Customer Number</label>
                  <input class="form-control " placeholder="Customer Number i.e 0551234567" name="cnumber" maxlength="10" required type="text" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return isNumberKey(event)"  id="customer_number" value="{{$data->customer_number}}" data-mask="999-9999999" data-validate-length-range="6" data-validate-words="2" />
                </div>
                <!-- Customer number end -->
              </div>
              <!-- form-group end -->
              <!--  #2 end -->
              <!--  #2 nationality and age-->

              <!-- form group start -->
              <!-- Customer name start -->
              <div class="form-group row">

                <div class="col-md-6 col-sm-12 col-xs-12 form-group ">
                    <label for="c_select">Country</label>
                  <select name="nation" id="c_select" class="form-control " required>

                      @foreach($countries as $country)
                        <option value="{{ $country->name }}" {{$data->nationality == $country->name ? 'selected' : ''}}>{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
                <!-- </div>
                            <div class="item form-group"> -->
                <!-- required -->

                {{-- <span class="required">*</span> --}}
                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group ">
                    <label for="age">Customer Age</label>
                  <input class="form-control " id="age" placeholder="Customer Age not less than 21" name="age" required type="number" required onkeypress="return isNumberKey(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="{{$data->age}}">
                </div>
                <!-- Customer number end -->
              </div>
              <!-- form-group end -->
              <!--  #2 end -->
              <!--  #3 start -->

              <!-- form group start -->
              <!-- Customer name start -->
              <div class="form-group row">

                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                    <label for="simtype">Sim Type</label>

                  <select name="simtype" id="simtype" class="sim_type form-control" required>
                    <option value="">-- Product Type --</option>
                    @if ($data->lead_type == 'postpaid')

                    <option value="New" {{$data->sim_type == 'New' ? 'selected' : ''}}>New</option>
                    <option value="MNP" {{$data->sim_type == 'MNP' ? 'selected' : ''}}>MNP</option>
                    <option value="Migration" {{$data->sim_type == 'Migration' ? 'selected' : ''}}>Migration</option>
                    @elseif($data->lead_type == 'ITProducts')
                        @foreach ($itproducts as $itp)
                        <option value="{{$itp->id}}" {{$data->sim_type == $itp->id ? 'selected' : ''}}>{{$itp->name}}</option>
                        @endforeach
                    @else
                    <option value="Elife" {{$data->sim_type == 'Elife' ? 'selected' : ''}}>Elife</option>
                    @endif
                  </select>

                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                    <label for="gender">Gender</label>

                  <select name="gender" id="gender" class="gender form-control" required>
                    <option value="">-- Select Gender --</option>
                    <option value="Male" {{$data->gender == 'Male' ? 'selected' : ''}} >Male</option>
                    <option value="Female"{{$data->gender == 'Female' ? 'selected' : ''}}>Female</option>
                    <option value="Other" {{$data->gender == 'Other' ? 'selected' : ''}}>Other</option>
                  </select>

                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                    <label for="emirate">Select Emirate</label>

                  <select name="emirates" id="emirate" class="emirates form-control" required>
                    <option value="">Select Emirates</option>
                    @foreach($emirates as $emirate)
                        <option value="{{ $emirate->name }}" {{$data->emirates == $emirate->name ? 'selected' : ''}}>{{ $emirate->name }}</option>
                    @endforeach
                  </select>

                </div>
                <!-- Customer number end -->
                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group ">
                  <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                    <label for="emirate_id">Select Emirate ID</label>

                  <select name="emirate_id" class="form-control " required id="emirate_id">
                    <option value="">-- Original Emirate Id --</option>
                    <option value="Yes, Customer has original Emirates Id" id="" {{$data->emirate_id == 'Yes, Customer has original Emirates Id' ? 'selected' : ''}}>Yes, Customer has original Emirates Id</option>
                    <option value="No" id="" {{$data->emirate_id == 'No' ? 'selected' : ''}}>No</option>
                    <!-- <option value="24">24 Months</option> -->
                  </select>

                </div>

                <!-- Customer Identity End -->

                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group">
                  <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                    <label for="credit_salary">Document Details</label>
                  <select name="additional_document" class="form-control " id="credit_salary" style="display:none;">
                    <!-- <option value="No Documents Required">No Documents Required</option> -->
                    <option value="Credit Card" id="">Credit Card</option>
                    <option value="Salary Certificate" id="">Salary Certificate</option>
                  </select>
                  <!-- salary_certificate_above_15000 Darham OR CREDIT CARD -->
                  <!-- <select name="additional_document" class="form-control " id="document_option" style="display:block;" required=""> -->
                  <!-- <option value="No Additional Documents " selected></option> -->
                  <!-- </select> -->
                    <label for="hideme_document">Document Details</label>

                  <select name="additional_document" class="form-control " id="hideme_document" style="display:block" required>


                    <option value="No Additional Document Required" id="" class="hideonelife" {{$data->additional_document == 'No Additional Document Required' ? 'selected' : ''}}>No Additional Document Required</option>
                    <option value="Salary Certificate" id="" class="hideonelife" {{$data->additional_document == 'Salary Certificate ' ? 'selected' : ''}}>Salary Certificate</option>
                    <option value="Tenancy Contract" id="" {{$data->additional_document == 'Renancy Contract' ? 'selected' : ''}}>Tenancy Contract</option>
                    <option value="Utility Bill" id="" class="hideonelife" {{$data->additional_document == 'Utility Bill' ? 'selected' : ''}}>Utility Bill (Current)</option>
                    <option value="Credit Card" id="" class="hideonelife" {{$data->additional_document == 'Credit Slip' ? 'selected' : ''}}>Credit Card</option>
                    <option value="Pay Slip" id="" class="hideonelife" {{$data->additional_document == 'Pay Slip' ? 'selected' : ''}}>Pay Slip</option>
                    <option value="Title Deeds" id="" class="hideonelife" {{$data->additional_document == 'Title Deeds' ? 'selected' : ''}}>Title Deeds</option>
                    <option value="Car Registration" id="" class="hideonelife" {{$data->additional_document == 'Car Registration' ? 'selected' : ''}}>Car Registration</option>
                    <option value="Labour Contract" id="" class="hideonelife" {{$data->additional_document == 'Labour Contract' ? 'selected' : ''}}>Labour Contracts</option>
                    <option value="Etisalat Postpaid/Elife Account" id="" class="hideonelife" {{$data->additional_document == 'Erisalat Postpaid/Elife Account' ? 'selected' : ''}}>Etisalat Postpaid/Elife Account</option>
                    <option value="Bank Statement 3 Months" id="" class="hideonelife" {{$data->additional_document == 'Bank Statement 3 Months' ? 'selected' : ''}}>Bank Statement 3 Months</option>
                    <option value="Customer has Existing billing (account 6 months old)" {{$data->additional_document == 'Customer has Existing billing (account 6 months old)' ? 'selected' : ''}} id="" class="hideonelife">Customer has Existing billing (account 6 months old)
                    </option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 form-group ">
                    <label for="hideme_document">Language</label>
                  <select name="language" class="form-control " required id="language">
                    <option value="">Select Language</option>
                    <option value="English" {{$data->language == 'English' ? 'selected' : ''}}>English</option>
                    <option value="Arabic" {{$data->language == 'Arabic' ? 'selected' : ''}}>Arabic</option>
                    <option value="Hindi/Urdu" {{$data->language == 'Hindi/Urdu' ? 'selected' : ''}}>Hindi / Urdu</option>
                  </select>
                </div>


                <!-- </div>
                            <div class="item form-group"> -->
                <!-- required -->
                <div id="number_commit" style="display:none;">
                  <span class="required">*</span>
                  <div class=" item col-md-12 col-sm-12 col-xs-12 form-group ">
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
                <!--  #7-->
                {{-- <div class="col-sm-8"> --}}
                <div class="form-group col-sm-8 col-md-8">
                  <label for="shared_with">Shared With </label>
                  <select name="shared_with" id="shared_with" class="form-control">
                    <option value="">Select Option</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{$data->share_with == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                        @endforeach

                  </select>
                </div>
              <div class=" item col-md-5 col-sm-6 col-xs-12 form-group">
                <label for="emirate_number" style="color:red;">Emirate ID #</label>
                <input class="form-control " id="emirate_number" data-mask="999-9999-9999999-9" data-validate-length-range="6" data-validate-words="2" name="emirate_number" placeholder="Emirate ID" type="num" value="{{$data->emirate_num}}">

              </div>
              <div class=" item col-md-1 col-sm-12 col-xs-12 form-group">
                <span>OR</span>
              </div>
              <div class=" item col-md-5 col-sm-6 col-xs-12 form-group">
                <label for="etisalat_number" style="color:red;">Etisalat Number #</label>
                <input class="form-control " id="etisalat_number" data-mask="999-9999999" data-validate-length-range="6" data-validate-words="2" name="etisalat_number" placeholder="Etisalat ID" type="num" value="{{$data->etisalat_number}}">

              </div>
               @if($data->sim_type == 'Elife')
               @include('dashboard.include.edit-elife')
               @elseif($data->sim_type == 'MNP')
               @include('dashboard.include.edit-mnp')
               @elseif($data->sim_type == 'New')
               @include('dashboard.include.edit-new')
               @else
                @include('dashboard.include.edit-itp')

               @endif
            </div>

                      <div class="ln_solid"></div>

                                    <div class="col-sm-4">
                                        <!-- new follow up modal -->
                                        <div id="myModal" class="modal fade" role="dialog" style="margin-top:10%;">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Modal Header</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <p>Some text in the modal.</p> -->
                                                        <div class="form-group" style="display:block;" id="call_back_at_new">
                                                            <div class="col-md-1 col-md-5">
                                                                <label for="">
                                                                    <h5>Call Back At</h5>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-5 col-sm-5 col-xs-12 form-group ">
                                                                <input type="datetime-local" name="call_back_at_elife" class="form-control myDatepicker" id="myDatepicker" placeholder="Add Later time" aria-describedby="inputSuccess2Status2">
                                                            </div>
                                                            <div class="col-md-7 col-sm-12 col-xs-12 form-group">
                                                                <textarea name="remarks_elife" id="remarks_elife" cols="30" rows="10" class="form-control hidden"></textarea>
                                                            </div>
                                                            <input type="submit" value="Follow Up" class="btn btn-success" name="follow_up_new" id="follow_up_new" style="display:;">

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div id="RejectModalNew" class="modal fade RejectModalNew" role="dialog" style="margin-top:10%;">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">New Reject</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- <p>Some text in the modal.</p> -->
                                                        <div class="form-group" style="display:block;" id="Reject_New">
                                                            <select name="reject_comment_new" id="reject_comment" class="reject_comment form-control">
                                                                <option value="Reason 1">Reason 1</option>
                                                                <option value="Reason 2">Reason 2</option>
                                                                <option value="Reason 3">Reason 3</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" value="Reject" class="btn btn-success reject" name="reject_new" id="reject_ew" style="display:;" data-toggle="modal">
                                                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- new follow up modal end -->

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

@include('dashboard.include.chat')
