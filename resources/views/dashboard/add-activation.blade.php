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
                    <li class="breadcrumb-item active">Activation Form</li>
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
                        @php
                        $audios = \App\audio_recording::wherelead_no($operation->lead_id)->get();
                        @endphp
                        {{-- <h4>TESTING AREA</h4> --}}
                        <div class="form-container">
                            <form onsubmit="return false" method="post" enctype="multipart/form-data"
                                id="FetchApiForm3">
                                @csrf
                                EID FRONT:
                                <input type="file" name="front_img" id="front_img"
                                    onchange="NameApi('{{route('ocr-name.submit')}}','FetchApiForm3')">
                                <h3 class="text-center" id="loading_num1" style="display:none">
                                    {{-- Please wait while system loading leads... --}}
                                    <img src="{{asset('assets/images/loader.gif')}}" alt="Loading"
                                        class="img-fluid text-center offset-md-6" style="width:35px;">
                                </h3>
                                {{-- <input type="file" name="back_img" id="back_img"> --}}
                                {{-- <input type="button" value="Upload Image" name="submit"
                                    > --}}
                                {{-- <input type="submit" value="Upload Image" name="submit" > --}}
                                <div class="form-group">
                                    <label for="dob">Name:</label>
                                    <input type="text" name="dob" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="dob">Emirate ID:</label>
                                    <input type="text" name="dob" id="emirate_id">
                                </div>
                            </form>
                        </div>
                        <div class="form-container">
                            <form onsubmit="return false" method="post" enctype="multipart/form-data" id="FetchApiForm">
                                @csrf
                                EID BACK:
                                <input type="file" name="front_img" id="front_img"
                                    onchange="SavingDataDeal('{{route('ocr.submit')}}','FetchApiForm')">
                                <h3 class="text-center" id="loading_num2" style="display:none">
                                    {{-- Please wait while system loading leads... --}}
                                    <img src="{{asset('assets/images/loader.gif')}}" alt="Loading"
                                        class="img-fluid text-center offset-md-6" style="width:35px;">
                                </h3>
                                {{-- <input type="file" name="back_img" id="back_img"> --}}
                                {{-- <input type="button" value="Upload Image" name="submit"
                                    > --}}
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" name="dob" id="dob">
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Expiry</label>
                                    <input type="text" name="dob" id="expiry">
                                </div>
                            </form>
                        </div>
                        {{-- <div class="form-container">
                            <form onsubmit="return false" method="post" enctype="multipart/form-data"
                                id="FetchApiForm2">
                                @csrf
                                Sr & Service Order Number:
                                <input type="file" name="front_img" id="front_img" onchange="SrApi('{{route('ocr-sr.submit')}}','FetchApiForm2')">
                        <h3 class="text-center" id="loading_num3" style="display:none">
                            <img src="{{asset('assets/images/loader.gif')}}" alt="Loading"
                                class="img-fluid text-center offset-md-6" style="width:35px;">
                        </h3>

                        <div class="form-group">
                            <label for="dob">Sr #</label>
                            <input type="text" name="dob" id="sr_no">
                        </div>
                        <div class="form-group">
                            <label for="dob">Service Order Number</label>
                            <input type="text" name="dob" id="order_number">
                        </div>
                        <div class="form-group">
                            <label for="dob">Application Date</label>
                            <input type="text" name="dob" id="application_date">
                        </div>

                        </form>
                    </div> --}}

                    {{-- {{$operation->assign_to}} --}}

                    {{-- {!!
                        Form::model($operation,['method'=>'POST','action'=>['ActivationFormController@store',$operation->id],'files'=>true])
                        !!} --}}

                    <form class="form-horizontal form-label-left input_mask" method="post" onsubmit="return false"
                        enctype="multipart/form-data" id="ActiveForm">
                        @csrf
                        <!-- Plan name -->
                        <div class="form-group">
                            <input type="hidden" name="verification_id" id="verification_id"
                                value="{{$operation->ver_id}}" class="dont_hide">
                            <input type="hidden" name="lead_id" id="leadid" value="{{$operation->lead_id}}"
                                class="dont_hide">
                            <input type="hidden" name="lead_id" id="lead_id" value="{{$operation->lead_id}}"
                                class="dont_hide">
                            <input type="hidden" name="lead_no" id="lead_no" value="{{$operation->lead_no}}"
                                class="dont_hide">
                            <input type="hidden" name="ver_id" id="ver_id" value="{{$operation->ver_id}}"
                                class="dont_hide">

                            <?php
                                // $idz = $id + 1;
                                ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                <input class="form-control " id="leadno" value="{{$operation->lead_no}}" type="text"
                                    disabled>
                                <input class="form-control " id="inputSuccess3" name="leadnumber"
                                    value="{{$operation->lead_no}}" placeholder="Lead Number" type="hidden">
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
                                <input class="form-control " id="CustomerNameAct" placeholder="Customer Name"
                                    name="cname" required type="text" value="{{$operation->customer_name}}">
                            </div>
                            <!-- </div>
                                <div class="item form-group"> -->
                            <!-- required -->

                            {{-- <span class="required">*</span> --}}
                            <div class="  col-md-5 col-sm-5 col-xs-12 form-group ">
                                <!-- <input type="number" maxlength="1" max="9" min="1" size="1" > -->
                                <input class="form-control " placeholder="Customer Number i.e 971551234567"
                                    name="cnumber" maxlength="12" required type="tel"
                                    value="{{$operation->customer_number}}"
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    onkeypress="return isNumberKey(event)">
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
                                    <option value="{{ $country->name }}"
                                        {{ $operation->nationality == $country->name ? 'selected' : '' }}>
                                        {{ $country->name }}</option>
                                    {{-- <option value="{{ $country->name }}">{{ $country->name }}</option> --}}
                                    @endforeach
                                </select>
                            </div>
                            <!-- </div>
                                <div class="item form-group"> -->
                            <!-- required -->

                            {{-- <span class="required">*</span> --}}
                            <div class=" item col-md-5 col-sm-5 col-xs-12 form-group ">
                                <input class="form-control " id="age" placeholder="Customer Age not less than 21"
                                    name="age" required type="number" value="{{ $operation->age }}"
                                    onkeypress="return isNumberKey(event)" required
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    maxlength="2">
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

                                    <option value="New" @if ($operation->sim_type == "New") {{ 'selected' }} @endif>New
                                    </option>
                                    <option value="MNP" @if ($operation->sim_type == "MNP") {{ 'selected' }} @endif>MNP
                                    </option>
                                    <option value="Elife" @if ($operation->sim_type == "Elife") {{ 'selected' }}
                                        @endif>Elife</option>
                                </select>

                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                                <select name="gender" id="" class="gender form-control">
                                    <option value="">-- Select Gender --</option>
                                    <option value="Male" @if ($operation->gender == "Male") {{ 'selected' }} @endif>Male
                                    </option>
                                    <option value="Female" @if ($operation->gender == "Female") {{ 'selected' }}
                                        @endif>Female</option>
                                </select>

                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-12 form-group ">
                                <select name="emirates" id="" class="emirates form-control">
                                    @foreach($emirates as $emirate)
                                    <option value="{{ $emirate->name }}"
                                        {{ $operation->emirates == $emirate->name ? 'selected' : '' }}>
                                        {{ $emirate->name }}</option>
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
                                    <option value="Yes, Customer has original Emirates Id" id="" @if ($operation->
                                        emirate_id == "Yes, Customer has original Emirates Id") {{ 'selected' }}
                                        @endif>Yes, Customer has original Emirates Id</option>
                                    <option value="No" id="" @if ($operation->emirate_id == "No") {{ 'selected' }}
                                        @endif>No</option>
                                    <!-- <option value="24">24 Months</option> -->
                                </select>

                            </div>
                            <!-- Customer Identity End -->
                            <div class="col-md-5 col-sm-6 col-xs-12 form-group ">
                                <input type="text" name="disabled" id="emirate_id_form"
                                    value="{{ $operation->emirate_num == '' ? $operation->contract_commitment : $operation->emirate_num }}"
                                    class="form-control">
                            </div>
                            <div class=" item col-md-6 col-sm-6 col-xs-12 form-group">
                                <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                                {{-- <select name="additional_document" class="form-control " id="credit_salary" style="display:none;">
                                        <!-- <option value="No Documents Required">No Documents Required</option> -->
                                        <option value="Credit Card" id="">Credit Card</option>
                                        <option value="Salary Certificate" id="">Salary Certificate</option>
                                    </select> --}}
                                <!-- salary_certificate_above_15000 Darham OR CREDIT CARD -->
                                <select name="additional_document" class="form-control " id="hideme_document"
                                    style="display:block">

                                    <option value="Salary Certificate" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Salary Certificate ' ? 'selected' : ''}}>
                                        Salary Certificate</option>
                                    <option value="Tenancy Contract" id=""
                                        {{$operation->additional_document == 'Renancy Contract' ? 'selected' : ''}}>
                                        Tenancy Contract</option>
                                    <option value="Utility Bill" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Utility Bill' ? 'selected' : ''}}>Utility
                                        Bill (Current)</option>
                                    <option value="Credit Card" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Credit Slip' ? 'selected' : ''}}>Credit
                                        Card</option>
                                    <option value="Pay Slip From Exchange" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Pay Slip From Exchange' ? 'selected' : ''}}>
                                        Pay Slip From Exchange</option>
                                    <option value="Title Deeds" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Title Deeds' ? 'selected' : ''}}>Title
                                        Deeds</option>
                                    <option value="Car Registration" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Car Mulkiya' ? 'selected' : ''}}>Car
                                        Mulkiya</option>
                                    <option value="Labour Contract" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Labour Contract' ? 'selected' : ''}}>
                                        Labour Contracts</option>
                                    <option value="Etisalat Postpaid/Elife Account" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Erisalat Postpaid/Elife Account' ? 'selected' : ''}}>
                                        Etisalat Postpaid/Elife Account</option>
                                    <option value="Bank Statement Last 3 Months" id="" class="hideonelife"
                                        {{$operation->additional_document == 'Bank Statement Last 3 Months' ? 'selected' : ''}}>
                                        Bank Statement Last 3 Months</option>
                                    <option value="Customer has Existing billing (account 6 months old)"
                                        {{$operation->additional_document == 'Customer has Existing billing (account 6 months old)' ? 'selected' : ''}}
                                        id="" class="hideonelife">Customer has Existing billing (account 6 months old)
                                    </option>
                                    <option value="DU Bill Last 3 Months"
                                        {{$operation->additional_document == 'DU Bill Last 3 Months' ? 'selected' : ''}}
                                        id="" class="hideonelife">DU Bill Last 3 Months
                                    </option>
                                </select>
                                <!-- <input class="form-control " id="salman_ahmed" placeholder="Selected Number" data-validate-length-range="6" data-validate-words="2" name="selnumber" type="file"> -->

                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-12 form-group ">
                                <select name="language" class="form-control " required="">
                                    <option value="English" @if ($operation->language == "English") {{ 'selected' }}
                                        @endif>English</option>
                                    <option value="Arabic" @if ($operation->language == "Arabic") {{ 'selected' }}
                                        @endif>Arabic</option>
                                    <option value="Hindi/Urdu" @if ($operation->language == "Hindi/Urdu")
                                        {{ 'selected' }} @endif>Hindi / Urdu</option>
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



                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label class="center">
                                    Shared With:
                                </label>
                                <input type="text" name="shared_with" id="shared_with" class="form-control" disabled
                                    value="{{$operation->share_with}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="center">
                                    Registration Field
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">


                            @if($operation->sim_type == 'Elife')
                            <div class=" item col-md-6 col-sm-6 col-xs-12 form-group ">
                                <label for="imei">Device No</label>
                                <select name="imei" id="imei" class="form-control">
                                    @foreach ($device as $dd)
                                    <option value="{{$dd->imei_number}}" {{old('imei_number') == $dd->imei_number}}>
                                        {{$dd->imei_number}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else

                            <!-- <span class="required">*</span> -->
                            <div class=" item col-md-6 col-sm-6 col-xs-12 form-group d-none hidden">
                                <input type="text" name="activation_sim_serial_no" id="activation_sim_serial_no"
                                    placeholder="Sim Serial #" class="form-control" maxlength="19"
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    value="0">
                            </div>
                            <!-- <span class="required">*</span> -->
                        </div>
                        <div class="form-group row">

                            <!-- <span class="required">*</span> -->
                            <div class=" item col-md-6 col-sm-6 col-xs-12 form-group ">
                                <label for="activation_emirate_expiry">Emirate Expiry</label>
                                <input type="text" name="activation_emirate_expiry" id="activation_emirate_expiry"
                                    placeholder="Emirates ID Expiry" class="form-control">
                            </div>
                            @endif

                            <!-- <span class="required">*</span> -->
                            <div class=" item col-md-6 col-sm-6 col-xs-12 form-group ">
                                <label for="sale_agent">Sale Agent</label>
                                <input type="text" name="activation_sold" id="activation_sold_by" placeholder="Sold BY"
                                    class="form-control" value="{{$operation->saler_name}}">
                                <input type="hidden" name="activation_sold_by" id="activation_sold_by"
                                    placeholder="Sold BY" class="form-control" value="{{$operation->saler_id}}">
                                <input type="hidden" name="saler_id" id="saler_id" placeholder="Sold BY"
                                    class="form-control" value="{{$operation->saler_id}}">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="center">
                                    Upload Documents
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class=" item col-md-4 col-sm-6 col-xs-12 form-group ">
                                <select name="additional_document_activation" class="form-control " id="hideme_document"
                                    style="display:block">
                                    <option value="No Additional Document Required">No Additional Document Required
                                    </option>
                                    <option value="Salary Certificate" id="">Salary Certificate</option>
                                    <option value="Tenancy Contract" id="">Tenancy Contract</option>
                                    <option value="Utility Bill" id="">Utility Bill (Current)</option>
                                    <option value="Credit Card" id="">Credit Card</option>
                                    <option value="Pay Slip" id="">Pay Slip</option>
                                    <option value="Title Deeds" id="">Title Deeds</option>
                                    <option value="Car Registration" id="">Car Registration</option>
                                    <option value="Labour Contract" id="">Labour Contracts</option>
                                    <option value="Etisalat Postpaid/Elife Account" id="">Etisalat Postpaid/Elife
                                        Account</option>
                                    <option value="Bank Statement 3 Months" id="">Bank Statement 3 Months</option>
                                    <option value="Customer has Existing billing (account 6 months old)" id="">Customer
                                        has Existing billing (account 6 months old)
                                    </option>
                                    <!-- <option value="24">24 Months</optio n> -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group audio_action" id="klon_audio1">
                            <div class="col-sm-4 col-xs-12 col-md-4">
                                <label for="audio1">Document </label>
                                <input type="file" name="documents[]" id="docs" class="">
                            </div>


                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 form-group rajput">
                            <a class="btn btn-primary" id="add_audio" style="color: white">
                                Add New Document
                            </a>
                        </div>

                        <!--  #3 end -->
                        <!--  #4 start -->


                        <!--  #4 end -->
                        <!--  #5 -->
                        <br>
                        <br>
                        <br>
                        @if($operation->sim_type == 'Elife')
                        @include('dashboard.include.active-elife')
                        @elseif($operation->sim_type == 'MNP')
                        @include('dashboard.include.active-mnp')
                        @elseif($operation->sim_type == 'New')
                        @include('dashboard.include.active-new')
                        @endif

                        {{-- @inject('provider', 'app/http/Controllers/AjaxController'); --}}
                        <div class="container-fluid">
                            @foreach ($audios as $audio)
                            <audio preload controls src='{{asset('audio')}}/{{$audio->audio_file}}' id='audio-player'
                                name='audio-player'></audio>
                            @endforeach
                        </div>
                        <div class="container">
                            <div class="row">

                                <a href="{{$operation->location_url}}" class="btn btn-success" target="_blank">View
                                    Location URL</a>
                                <a href="https://maps.google.com?q={{$operation->lat}},{{$operation->lng}}"
                                    class="btn btn-success" target="_blank">View Location Lat Lng</a>
                                <br>
                                {{-- <span class="red">Assign To: </span>
                                    CURRENT USERNAME --}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="container-fluid">
                                <input type="hidden" name="call_back_ajax" class="call_back_ajax" id="call_back_ajax"
                                    value="yes">

                                <input type="submit" value="Submit" class="btn btn-success submit_button_new"
                                    onclick="SavingActivationLead('{{route('activate-lead')}}','ActiveForm')">
                                <button class="btn btn-success" type="button" name="reverify" id="reverify"
                                    data-toggle="modal" data-target="#myModalVer">Re Verify</button>
                                <button class="btn btn-success" type="button" name="follow" id="follow_up"
                                    data-toggle="modal" data-target="#myModal">Follow</button>

                                <button class="btn-submit btn btn-danger" type="button" data-toggle="modal"
                                    data-target="#RejectModalNew">Reject</button>

                            </div>

                        </div>
                        {{-- Lorem ipsum dolor sit amet consectetur, adipisicing elit. At amet maiores a ipsum quidem iusto odit doloribus rerum accusantium itaque magnam velit, deserunt, unde sapiente cum, enim id alias expedita! --}}
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <h3 class="text-center" id="loading_num3" style="display:none">
                            {{-- Please wait while system loading leads... --}}
                            <img src="{{asset('assets/images/loader.gif')}}" alt="Loading"
                                class="img-fluid text-center offset-md-6" style="width:35px;">
                        </h3>
                        <div class="form-group">
                            <div id="myModal" class="modal fade" role="dialog" style="margin-top:10%;">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                onclick="close_modal()">&times;</button>
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
                                                    <input type="datetime-local" name="call_back_at_new"
                                                        class="form-control " id="myDatepicker"
                                                        placeholder="Add Later time"
                                                        aria-describedby="inputSuccess2Status2">
                                                </div>
                                                <div class="col-md-12 col-md-5">
                                                    <label for="remarks_new">Remarks</label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <textarea name="remarks_for_cordination"
                                                        id="remarks_for_cordination" cols="30" rows="10"
                                                        class="form-control">{{old('remarks_for_cordination')}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Follow Up New" class="btn btn-success"
                                                name="follow_up_new" id="follow_up_new" style="display:;">

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
                                            {{-- <button type="button" class="close"
                                                operation-dismiss="modal">&times;</button> --}}
                                            <button type="button" class="close" data-dismiss="modal"
                                                onclick="close_modal()">&times;</button>
                                            <h4 class="modal-title">Re Verification Back</h4>
                                        </div>
                                        <div class="modal-body">
                                            <!-- <p>Some text in the modal.</p> -->
                                            <div class="form-group" style="display:block;" id="call_back_at_new">

                                                <div class="col-md-12 col-md-5">
                                                    <label for="remarks_new">Remarks</label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <textarea name="reverify_remarks" id="reverify_remarks" cols="30"
                                                        rows="10"
                                                        class="form-control">{{old('reverify_remarks')}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Re Verify" class="btn btn-success"
                                                name="follow_up_new" id="follow_up_new" style="display:;">

                                            <!-- <button type="button" class="btn btn-default" operation-dismiss="modal">Close</button> -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        {!! Form::close() !!}
                        <div id="RejectModalNew" class="modal fade" role="dialog" data-backdrop="static"
                            data-keyboard="false" style="margin-top:10%;">
                            <div class="modal-dialog">
                                {{ Form::open([ 'method'  => 'post', 'route' => [ 'lead.rejected', $operation->lead_id ], 'files' => true ]) }}
                                <input type="hidden" name="lead_id" value="{{$operation->lead_id}}">
                                <input type="hidden" name="ver_id" id="ver_id" value="{{$operation->ver_id}}"
                                    class="dont_hide">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            onclick="close_modal()">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <p>Some text in the modal.</p> -->
                                        <div class="form-group" style="display:block;" id="Reject_New">
                                            <select name="reject_comment_new" id="reject_comment" class="form-control">
                                                <option value="">Select Reject Reason</option>
                                                <option value="Already Active">Already Active</option>
                                                <option value="No Need">No Need</option>
                                                <option value="Age less than 21">Age less than 21</option>
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
                                        <input type="button" value="Reject" class="btn btn-success reject"
                                            name="reject_new" id="reject_ew" style="display:;" onclick="test_reject()">
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
