@extends('layouts.dashboard-app')
{{-- @php @endphp --}}
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
                            action="{{route('multi-sale.store')}}" autocomplete="off">
                            @csrf
                            <!-- Plan name -->



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
                                    {{-- <input type="hidden" name="channel_type" id="type" value="{{$type}}"> --}}
                                    {{-- <input type="hidden" name="lead_type" id="type" value="{{$ptype}}"> --}}
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
                                <div class="  col-md-6 col-sm-12 col-xs-12 form-group ">
                                    <!-- <input type="number" maxlength="1" max="9" min="1" size="1" > -->
                                    <label for="cnumber">Customer Number</label>
                                    {{-- <input class="form-control " placeholder="Customer Number i.e 0551234567" name="cnumber" onkeypress="return isNumberKey(event)"  id="customer_number" value="{{old('cnumber')}}"
                                    /> --}}
                                    <input class="form-control " placeholder="Customer Number i.e 0551234567"
                                        name="cnumber" maxlength="10" required type="tel"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        onkeypress="return isNumberKey(event)" id="customer_number"
                                        value="{{old('cnumber')}}" data-mask="999-9999999"
                                        data-validate-length-range="6" data-validate-words="2" />
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
                                        {{-- @if ($ptype == 'postpaid') --}}
                                        <option value="New" @if (old('simtype')=="New" ) {{ 'selected' }} @endif>New
                                        </option>
                                        <option value="MNP" @if (old('simtype')=="MNP" ) {{ 'selected' }} @endif>MNP
                                        </option>
                                        <option value="Migration" @if (old('simtype')=="Migration" ) {{ 'selected' }}
                                            @endif>Migration</option>
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
                                    <label for="emirate_id">Select Emirate ID</label>

                                    <select name="emirate_id" class="form-control " required id="emirate_id">
                                        <option value="">-- Original Emirate Id --</option>
                                        <option value="Yes, Customer has original Emirates Id" id="" selected @if(old('emirate_id')=="Yes, Customer has original Emirates Id" )
                                            {{ 'selected' }} @endif>Yes, Customer has original Emirates Id</option>
                                        <option value="No" id="" @if (old('emirate_id')=="No" ) {{ 'selected' }} @endif>
                                            No</option>
                                        <!-- <option value="24">24 Months</option> -->
                                    </select>

                                </div>

                                <!-- Customer Identity End -->

                                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group">
                                    <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                                    <label for="credit_salary">Additional Documents</label>
                                    <select name="additional_document" class="form-control " id="credit_salary"
                                        style="display:none;">
                                        <!-- <option value="No Documents Required">No Documents Required</option> -->
                                        <option value="Credit Card" id="">Credit Card</option>
                                        <option value="Salary Certificate" id="">Salary Certificate</option>
                                    </select>
                                    <!-- salary_certificate_above_15000 Darham OR CREDIT CARD -->
                                    <!-- <select name="additional_document" class="form-control " id="document_option" style="display:block;" required=""> -->
                                    <!-- <option value="No Additional Documents " selected></option> -->
                                    <!-- </select> -->
                                    {{-- <label for="hideme_document">Document Details</label> --}}

                                    <select name="additional_document" class="form-control " id="hideme_document"
                                        style="display:block" required>

                                        <option value="No Additional Document Required" id="" class="hideonelife"
                                            {{old('additional_document') == 'No Additional Document Required' ? 'selected' : ''}}>
                                            No Additional Document Required</option>
                                        <option value="Salary Certificate" id="" class="hideonelife"
                                            {{old('additional_document') == 'Salary Certificate ' ? 'selected' : ''}}>
                                            Salary Certificate</option>
                                        <option value="Tenancy Contract" id=""
                                            {{old('additional_document') == 'Renancy Contract' ? 'selected' : ''}}>
                                            Tenancy Contract</option>
                                        <option value="Utility Bill" id="" class="hideonelife"
                                            {{old('additional_document') == 'Utility Bill' ? 'selected' : ''}}>Utility
                                            Bill (Current)</option>
                                        <option value="Credit Card" id="" class="hideonelife"
                                            {{old('additional_document') == 'Credit Slip' ? 'selected' : ''}}>Credit
                                            Card</option>
                                        <option value="Pay Slip From Exchange" id="" class="hideonelife"
                                            {{old('additional_document') == 'Pay Slip From Exchange' ? 'selected' : ''}}>
                                            Pay Slip From Exchange</option>
                                        <option value="Title Deeds" id="" class="hideonelife"
                                            {{old('additional_document') == 'Title Deeds' ? 'selected' : ''}}>Title
                                            Deeds</option>
                                        <option value="Car Registration" id="" class="hideonelife"
                                            {{old('additional_document') == 'Car Mulkiya' ? 'selected' : ''}}>Car
                                            Mulkiya</option>
                                        <option value="Labour Contract" id="" class="hideonelife"
                                            {{old('additional_document') == 'Labour Contract' ? 'selected' : ''}}>Labour
                                            Contracts</option>
                                        <option value="Etisalat Postpaid/Elife Account" id="" class="hideonelife"
                                            {{old('additional_document') == 'Erisalat Postpaid/Elife Account' ? 'selected' : ''}}>
                                            Etisalat Postpaid/Elife Account</option>
                                        <option value="Bank Statement Last 3 Months" id="" class="hideonelife"
                                            {{old('additional_document') == 'Bank Statement Last 3 Months' ? 'selected' : ''}}>
                                            Bank Statement Last 3 Months</option>
                                        <option value="Customer has Existing billing (account 6 months old)"
                                            {{old('additional_document') == 'Customer has Existing billing (account 6 months old)' ? 'selected' : ''}}
                                            id="" class="hideonelife">Customer has Existing billing (account 6 months
                                            old)
                                        </option>
                                        <option value="DU Bill Last 3 Months"
                                            {{old('additional_document') == 'DU Bill Last 3 Months' ? 'selected' : ''}}
                                            id="" class="hideonelife">DU Bill Last 3 Months
                                        </option>
                                        <!-- <option value="24">24 Months</optio n> -->
                                    </select>
                                    <!-- <input class="form-control " id="salman_ahmed" placeholder="Selected Number"  data-validate-length-range="6" data-validate-words="2" name="selnumber" type="file"> -->

                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 form-group ">
                                    <label for="hideme_document">Language</label>
                                    <select name="language" class="form-control " required id="language">
                                        <option value="">Select Language</option>
                                        <option value="English" {{old('language') == 'English' ? 'selected' : ''}}>
                                            English</option>
                                        <option value="Arabic" {{old('language') == 'Arabic' ? 'selected' : ''}}>Arabic
                                        </option>
                                        <option value="Hindi/Urdu">Hindi / Urdu</option>
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
                                    <label for="shared_with">Shared With</label>
                                    <select name="shared_with" id="shared_with" class="form-control">
                                        <option value="">Select Option</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{old('shared_with') == $user->id ? 'selected' : ''}}>{{ $user->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class=" item col-md-5 col-sm-6 col-xs-12 form-group">
                                    <label for="emirate_number">Emirate ID # (Optional)</label>
                                    <input class="form-control " id="emirate_number" data-mask="999-9999-9999999-9"
                                        data-validate-length-range="6" data-validate-words="2" name="emirate_number"
                                        placeholder="Emirate ID" type="tel" value="{{old('emirate_number')}}">

                                </div>
                                <div class=" item col-md-1 col-sm-12 col-xs-12 form-group">
                                    <span>OR</span>
                                </div>
                                <div class=" item col-md-5 col-sm-6 col-xs-12 form-group">
                                    <label for="etisalat_number">Etisalat Number # (Optional)</label>
                                    <input class="form-control " id="etisalat_number" data-mask="999-9999999"
                                        data-validate-length-range="6" data-validate-words="2" name="etisalat_number"
                                        placeholder="Etisalat ID" type="tel" value="{{old('emirate_number')}}">

                                </div>
                                <div class="container">
                                    <div class="row hidden d-none">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lead_date">Lead Date:</label>
                                                <input type="date" name="lead_date" id="lead_date">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lead_date">Existing Lead:</label>
                                                    <input type="checkbox" name="existing_lead" id="existing_lead"
                                                        value="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('dashboard.include.mnp')
                                    @include('dashboard.include.multi-new-package')
                                    {{-- @include('dashboard.include.itp') --}}
                                </div>
                                <div class="container-fluid" style="border:1px solid black; padding:20px 30px;">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div id="location_error"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control"
                                                    placeholder="Customer Location Url" name="add_location"
                                                    id="add_location" value="{{old('add_location')}}"
                                                    onkeyup="check_location_url()">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="check_location_url()" id="checker">Fetch
                                                        Location</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="fom-group">
                                                <label for="add_location">Add Latitude and Langitude</label>
                                                <input type="text" class="form-control" id="add_lat_lng"
                                                    name="add_lat_lng" value="{{old('add_lat_lng')}}">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="container-fluid"> --}}
                                    <h4>OR</h4>
                                    {{-- <div class="row form-group">
                                        <label for="location">Search location</label> --}}
                                    {{-- </div> --}}
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="fom-group">
                                                <label for="add_location">Search location</label>
                                                <input id="pac-input" class="controls form-control" type="text" placeholder="Enter a location">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="map"></div>
                                            <style>
                                                #map {
        height: 100%;
      }
                                            </style>
                                        </div>
                                    </div>
                                {{-- </div> --}}

                                    {{-- {{auth()->user()->agent_code}}
                                    @if(auth()->user()->agent_code == 'CC8-ELIFE')
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
                                    @else
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="fom-group">
                                                <label for="add_location">Allocate To:</label>

                                                <select name="assing_to" id="assing_to" class="form-control">
                                                    <option value="">Allocate to</option>
                                                    <option value="136"
                                                        {{ old('assign_to') == '136' ? 'selected' : 'selected' }}>Junaid
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif --}}

                                    <br>
                                    <div class="row">
                                        <div class="container-fluid">
                                            <button class="btn btn-success" type="submit" name="submit">Proceed</button>
                                            <button class="btn btn-success" type="button" name="follow" id="follow_up"
                                                data-toggle="modal" data-target="#myModal">Follow</button>
                                            <button class="btn btn-success" type="button" name="follow" id="follow_up"
                                                data-toggle="modal" data-target="#myModalVer">Re Verification</button>
                                            <button class="btn btn-info" type="button" data-toggle="modal"
                                                data-target="#RejectModalNew">Reject</button>

                                        </div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>



                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
