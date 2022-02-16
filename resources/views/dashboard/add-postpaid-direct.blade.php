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
                        <div class="container mb-10 pt-10" style="margin-bottom:50px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <form onsubmit="return false" method="post" enctype="multipart/form-data"
                                        id="FetchApiForm3">
                                        @csrf
                                        Emirates Front ID:
                                        <input type="file" name="front_img" id="front_img"
                                            onchange="NameApi('{{route('ocr-name.submit')}}','FetchApiForm3')">
                                        <img src="" id="front_img_display" style="width:175px;" accept="image/*">
                                    </form>
                                </div>
                                <div class="col-md-6">

                                    <form onsubmit="return false" method="post" enctype="multipart/form-data"
                                        id="FetchApiForm">
                                        @csrf
                                        Emirates Back ID:
                                        <input type="file" name="front_img" id="back_img"
                                            onchange="SavingDataDeal('{{route('ocr.submit')}}','FetchApiForm')">
                                        <img src="" id="back_img_display" style="width:175px;" accept="image/*">
                                    </form>
                                </div>
                            </div>

                        </div>
                        <form class="form-horizontal form-label-left input_mask" method="post" autocomplete="off"
                            id="elife_form">
                            @csrf
                            <!-- Plan name -->
                            <input type="hidden" name="sale_type" value="{{$type .' '. $ptype}}">
                            <div class="form-group audio_action row" id="klon_audio1">
                                <div class="col-sm-4 col-xs-12 col-md-4">
                                    <label for="audio1">Document </label>
                                    <input type="file" name="documents[]" id="docs" class="" accept="image/*" required>
                                </div>
                                <div class="col-sm-4 col-xs-12 col-md-4">
                                    <label for="audio1">SR Documents </label>
                                    <input type="file" name="sr_documents" id="docs" class="" accept="image/*" required>
                                </div>
                                <div class="col-sm-4 col-xs-12 col-md-4">
                                    <label for="audio1">SR Number </label>
                                    <input type="text" name="sr_number" id="docs" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6 col-sm-6 col-xs-6 form-group rajput">
                                    <a class="btn btn-primary" id="add_audio" style="color: white">
                                        Add New Document
                                    </a>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <input type="hidden" name="generic_id"
                                        value="{{$getfirst = empty($last)? 1 : $last->id}}">
                                    <input class="form-control " id="leadno"
                                        value="{{auth()->user()->agent_code .'-'. $getfirst .'-'. Carbon\Carbon::now()->format('M') .'-'.now()->year}}"
                                        placeholder="Lead Number" type="text" disabled>
                                    <input class="form-control " id="inputSuccess3" name="leadnumber"
                                        value="{{auth()->user()->agent_code .'-'. $getfirst .'-'. Carbon\Carbon::now()->format('M') .'-'.now()->year}}"
                                        placeholder="Lead Number" type="hidden">
                                    <input type="hidden" name="channel_type" id="type" value="{{$type}}">
                                    <input type="hidden" name="lead_type" id="type" value="{{$ptype}}">
                                    <!-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> -->
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="center">
                                        Personal Information
                                    </label>
                                </div>
                            </div>


                            <!-- form group start -->
                            <!-- Customer name start -->
                            <div class="form-group row">

                                <div class="col-md-6 col-sm-12 col-xs-12 form-group ">
                                    <label for="cname">Customer Name</label>
                                    {{-- {{$id}} --}}
                                    <input class="form-control " id="cname" placeholder="Customer Name" name="cname"
                                        type="text" required value="{{old('cname')}}">

                                </div>
                                <!-- </div>
                            <div class="item form-group"> -->
                                <!-- required -->


                                {{-- <span class="required">*</span> --}}
                                <div class="col-md-2">
                                    <label for="cnumber">Customer Number</label>

                                    <select name="code" id="" class="form-control">
                                        <option value="050">050</option>
                                        <option value="052">052</option>
                                        <option value="054">054</option>
                                        <option value="055">055</option>
                                        <option value="056">056</option>
                                        <option value="058">058</option>
                                    </select>

                                </div>
                                <div class="  col-md-4 col-sm-12 col-xs-12 form-group ">
                                    <label for=""></label>
                                    <!-- <input type="number" maxlength="1" max="9" min="1" size="1" > -->
                                    {{-- <input class="form-control " placeholder="Customer Number i.e 0551234567" name="cnumber" onkeypress="return isNumberKey(event)"  id="customer_number" value="{{old('cnumber')}}"
                                    /> --}}
                                    <input class="form-control " placeholder="Customer Number i.e 1234567"
                                        name="cnumber" maxlength="7" required type="tel"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        onkeypress="return isNumberKey(event)" id="customer_number"
                                        value="{{old('cnumber')}}" data-mask="9999999" data-validate-length-range="6"
                                        data-validate-words="2" />
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
                                    <select name="nation" id="c_select" class="form-control" required>

                                        @foreach($countries as $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- </div>
                            <div class="item form-group"> -->
                                <!-- required -->

                                {{-- <span class="required">*</span> --}}
                                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group ">
                                    <label for="age">Customer Age</label>
                                    <input class="form-control " id="age" placeholder="Customer Age not less than 21"
                                        name="age" required type="number" required
                                        onkeypress="return isNumberKey(event)"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="2" value="{{old('age')}}">
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
                                    <label for="simtype">Product Type</label>

                                    <select name="simtype" id="simtype" class="sim_type form-control" required>
                                        <option value="">-- Product Type --</option>
                                        <option value="New" @if (old('simtype')=="New" ) {{ 'selected' }} @endif>New
                                        </option>
                                        <option value="MNP" @if (old('simtype')=="MNP" ) {{ 'selected' }} @endif>MNP
                                        </option>
                                        <option value="Migration" @if (old('simtype')=="Migration" ) {{ 'selected' }}
                                            @endif>Migration</option>

                                    </select>

                                </div>



                                <div class="col-md-6 col-sm-6 col-xs-12 form-group " id="zone" style="display:none;">
                                    <label for="zonetype">Zone</label>
                                    <select name="zone" id="zonetype" class="sim_type form-control" required>
                                        <option value="">-- Select Zone --</option>
                                        <option value="Defender" @if (old('zone')=="Defender" ) {{ 'selected' }} @endif>
                                            Defender</option>
                                        <option value="Non Defender" @if (old('zone')=="Non Defender" ) {{ 'selected' }}
                                            @endif>Non Defender</option>
                                        <option value="Shared Zone" @if (old('zone')=="Shared Zone" ) {{ 'selected' }}
                                            @endif>Shared Zone</option>
                                    </select>

                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                                    <label for="gender">Gender</label>

                                    <select name="gender" id="gender" class="gender form-control" required>
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male" @if (old('gender')=="Male" ) {{ 'selected' }} @endif>Male
                                        </option>
                                        <option value="Female" @if (old('gender')=="Female" ) {{ 'selected' }} @endif>
                                            Female</option>
                                        <option value="Other" @if (old('gender')=="Other" ) {{ 'selected' }} @endif>
                                            Other</option>
                                    </select>

                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                                    <label for="emirate">Select Emirate</label>

                                    <select name="emirates" id="emirate" class="emirates form-control" required>
                                        <option value="">Select Emirates</option>
                                        @foreach($emirates as $emirate)
                                        <option value="{{ $emirate->name }}" @if (old('emirates')==$emirate->name)
                                            {{ 'selected' }} @endif>{{ $emirate->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <!-- Customer number end -->
                                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group ">
                                    <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                                    <label for="emirate_id">Document Type</label>

                                    <select name="emirate_id" class="form-control " required id="emirate_id">
                                        <option value="">-- Document Type --</option>
                                        <option value="Emirate ID" id="" @if (old('emirate_id')=="Emirate ID" )
                                            {{ 'selected' }} @endif>Emirate ID</option>
                                        <option value="Passport" id="" @if (old('emirate_id')=="Passport" )
                                            {{ 'selected' }} @endif>Passport</option>
                                        <!-- <option value="24">24 Months</option> -->
                                    </select>

                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group" style="display: none;"
                                    id="show_emirate_id">
                                    <label for="emirate_number">Emirate ID # </label>
                                    <input class="form-control " id="emirate_number" data-mask="999-9999-9999999-9"
                                        data-validate-length-range="6" data-validate-words="2" name="emirate_number"
                                        placeholder="Emirate ID" type="tel" value="{{old('emirate_number')}}">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group" style="display: none;"
                                    id="show_passport">
                                    <label for="emirate_number">Passport ID #</label>
                                    <input class="form-control " id="passport_number" data-mask="999-9999-9999999-9"
                                        data-validate-length-range="6" data-validate-words="2" name="emirate_number"
                                        placeholder="Emirate ID" type="tel" value="{{old('emirate_number')}}">
                                </div>
                                <!-- Customer Identity End -->

                                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group"
                                    style="display:{{$ptype == 'elife' ? 'block' : 'block'}}">
                                    <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->

                                    <!-- salary_certificate_above_15000 Darham OR CREDIT CARD -->
                                    <!-- <select name="additional_document" class="form-control " id="document_option" style="display:block;" required=""> -->
                                    <!-- <option value="No Additional Documents " selected></option> -->
                                    <!-- </select> -->
                                    <label for="hideme_document">Document Details</label>

                                    <select name="additional_document" class="form-control " id="hideme_document"
                                        style="display:block" {{$ptype == 'elife' ? '' : 'required'}}>

                                        {{-- <option value="No Additional Document Required" id="" class="hideonelife" {{old('additional_document') == 'No Additional Document Required' ? 'selected' : ''}}>No
                                        Additional Document Required</option> --}}
                                        <option value="Salary Certificate" id="" class="hideonelife"
                                            {{old('additional_document') == 'Salary Certificate ' ? 'selected' : ''}}>
                                            Salary Certificate</option>
                                        <option value="Tenancy Contract" id=""
                                            {{old('additional_document') == 'Renancy Contract' ? 'selected' : ''}}>
                                            Tenancy Contract</option>
                                        {{-- <option value="Utility Bill" id="" class="hideonelife" {{old('additional_document') == 'Utility Bill' ? 'selected' : ''}}>Utility
                                        Bill (Current)</option> --}}
                                        {{-- <option value="Credit Card" id="" class="hideonelife" {{old('additional_document') == 'Credit Slip' ? 'selected' : ''}}>Credit
                                        Card</option> --}}
                                        {{-- <option value="Pay Slip From Exchange" id="" class="hideonelife" {{old('additional_document') == 'Pay Slip From Exchange' ? 'selected' : ''}}>Pay
                                        Slip From Exchange</option> --}}
                                        {{-- <option value="Title Deeds" id="" class="hideonelife" {{old('additional_document') == 'Title Deeds' ? 'selected' : ''}}>Title
                                        Deeds</option> --}}
                                        {{-- <option value="Car Registration" id="" class="hideonelife" {{old('additional_document') == 'Car Mulkiya' ? 'selected' : ''}}>Car
                                        Mulkiya</option> --}}
                                        {{-- <option value="Labour Contract" id="" class="hideonelife" {{old('additional_document') == 'Labour Contract' ? 'selected' : ''}}>Labour
                                        Contracts</option> --}}
                                        {{-- <option value="Etisalat Postpaid/Elife Account" id="" class="hideonelife" {{old('additional_document') == 'Erisalat Postpaid/Elife Account' ? 'selected' : ''}}>Etisalat
                                        Postpaid/Elife Account</option> --}}
                                        {{-- <option value="Bank Statement Last 3 Months" id="" class="hideonelife" {{old('additional_document') == 'Bank Statement Last 3 Months' ? 'selected' : ''}}>Bank
                                        Statement Last 3 Months</option> --}}
                                        {{-- <option value="Customer has Existing billing (account 6 months old)" {{old('additional_document') == 'Customer has Existing billing (account 6 months old)' ? 'selected' : ''}}
                                        id="" class="hideonelife">Customer has Existing billing (account 6 months old)
                                        </option>
                                        <option value="DU Bill Last 3 Months"
                                            {{old('additional_document') == 'DU Bill Last 3 Months' ? 'selected' : ''}}
                                            id="" class="hideonelife">DU Bill Last 3 Months
                                        </option> --}}
                                        <!-- <option value="24">24 Months</optio n> -->
                                    </select>
                                    <!-- <input class="form-control " id="salman_ahmed" placeholder="Selected Number"  data-validate-length-range="6" data-validate-words="2" name="selnumber" type="file"> -->

                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                                    <label for="language">Language</label>
                                    <select name="language" class="form-control " required id="language">
                                        <option value="">Select Language</option>
                                        <option value="English" {{old('language') == 'English' ? 'selected' : ''}}>
                                            English</option>
                                        <option value="Arabic" {{old('language') == 'Arabic' ? 'selected' : ''}}>Arabic
                                        </option>
                                        <option value="Hindi/Urdu">Hindi / Urdu</option>
                                    </select>
                                </div>



                                <div class="container-fluid">


                                </div>
                                {{-- @include('dashboard.include.mnp') --}}
                                @include('dashboard.include.new-direct-package')
                                {{-- @include('dashboard.include.elife-package') --}}
                                {{-- @include('dashboard.include.itp') --}}
                            </div>

                            <div class="ln_solid"></div>

                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
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
