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
                            id="elife_form" autocomplete="off">
                            @csrf
                            <!-- Plan name -->
                            <input type="hidden" name="sale_type" value="{{$type .' '. $ptype}}">
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
                                        type="text" required value="{{old('cname')}}" autocomplete="off">

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

                                    <select name="simtype" id="simtype" class="sim_type form-control" required
                                        onchange="check_elife_package(this,'{{route('elife.plan')}}')">
                                        <option value="">-- Product Type --</option>
                                        @if ($ptype == 'Postpaid')
                                        <option value="New" @if (old('simtype')=="New" ) {{ 'selected' }} @endif>New
                                        </option>
                                        <option value="MNP" @if (old('simtype')=="MNP" ) {{ 'selected' }} @endif>MNP
                                        </option>
                                        <option value="Migration" @if (old('simtype')=="Migration" ) {{ 'selected' }}
                                            @endif>Migration</option>
                                        @elseif($ptype == 'ITProducts')
                                        @foreach ($itproducts as $itp)
                                        <option value="{{$itp->id}}" @if (old('simtype')==$itp->id) {{ 'selected' }}
                                            @endif>{{$itp->name}}</option>
                                        @endforeach
                                        @else
                                        <option value="Elife" @if (old('simtype')=="Elife" ) {{ 'selected' }} @endif>
                                            Elife</option>
                                        <option value="BitStream" @if (old('simtype')=="BitStream" ) {{ 'selected' }}
                                            @endif>BitStream</option>
                                        @endif
                                    </select>

                                </div>
                                <input type="hidden" id="elife_addon_url" value="{{route('elife.addon')}}">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <label for="zonetype">Select Plan</label>
                                    <select name="plan_elife" id="c__select" class="form-control elife_plan" style=""
                                        onchange="elife_plan_month($(this).val(),'ElifePlanFetch','{{ route('ajaxRequest.post') }}')">
                                        <option value="">Select Plan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <label for="zonetype">Select Addon</label>
                                    <select name="addon" id="addon_fetch" class="form-control elife_plan" style="">
                                        <option value="">Select Addon</option>
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
                                        data-validate-length-range="6" data-validate-words="2" name="passport_number"
                                        placeholder="Emirate ID" type="tel" value="{{old('passport_number')}}">
                                </div>
                                <!-- Customer Identity End -->

                                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group"
                                    style="display:{{$ptype == 'elife' ? 'block' : 'block'}}">

                                    <label for="hideme_document">Document Details</label>

                                    <select name="additional_document" class="form-control " id="hideme_document"
                                        style="display:block" {{$ptype == 'elife' ? '' : 'required'}}>
                                        <option value="Salary Certificate" id="" class="hideonelife"
                                            {{old('additional_document') == 'Salary Certificate ' ? 'selected' : ''}}>
                                            Salary Certificate</option>
                                        <option value="Tenancy Contract" id=""
                                            {{old('additional_document') == 'Renancy Contract' ? 'selected' : ''}}>
                                            Tenancy Contract</option>

                                        <!-- <option value="24">24 Months</optio n> -->
                                    </select>

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



                                <div class=" item col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="emirate_number">Vila/Flat No</label>
                                    <input class="form-control " id="flat_no" name="flat" type="text"
                                        placeholder="Address">
                                </div>
                                <div class=" item col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="emirate_number">Street</label>
                                    <input class="form-control " id="flat_no" name="street" type="text"
                                        placeholder="Address">

                                </div>
                                <div class=" item col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="emirate_number">Area</label>
                                    <input class="form-control " id="flat_no" name="area" type="text"
                                        placeholder="Address">

                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <label for="zonetype">Eid / Makani #</label>

                                    <input type="text" name="elife_makani_number" id="elife_makani_number"
                                        class="form-control" placeholder="Eid / Makani #">
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div id="location_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="add_location">Search Location</label>
                                    <div class="input-group mb-3">


                                        <input id="pac-input" class="controls form-control" type="text"
                                            placeholder="Enter a location" name="location">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fom-group">
                                        <label for="add_location">Add Latitude and Langitude</label>
                                        <input type="text" class="form-control" id="add_lat_lng" name="add_lat_lng"
                                            value="{{old('add_lat_lng')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 hidden d-none">
                                    <div class="fom-group">
                                        <label for="add_location">Choosen Lead Number</label>
                                        <input type="text" class="form-control" id="aff_number" name="aff_number"
                                            value="{{ request()->session()->get('choosen_lead_number')}}">
                                    </div>
                                </div>
                                <div class="container">
                                    <div id="map"></div>
                                    <style>
                                        #map {
                                            height: 100%;
                                        }

                                    </style>
                                </div>
                                <div class="container-fluid">
                                </div>
                                {{-- @include('dashboard.include.mnp') --}}
                                {{-- @include('dashboard.include.new-package') --}}
                                {{-- @include('dashboard.include.elife-package') --}}
                                {{-- @include('dashboard.include.itp') --}}
                                <div class="item col-md-12 col-sm-12 col-xs-12 form-group ">
                                    <!-- <h3>Remarks</h3> -->
                                    <h4>Remarks *</h4>

                                    <div class="form-group">
                                        <textarea name="remarks_process_elife" id="remarks_process" cols="30" rows="10"
                                            class="form-control remarks_elife">Please Verify</textarea>
                                        <!-- <input type="text" name="remarks_process" id="remarks_process" class="form-control"> -->
                                    </div>
                                </div>
                                {{-- <div class="form-group"> --}}
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <input type="button" value="Submit"
                                            class="btn btn-success  submit_mnp submit_button_on_no" name="upload"
                                            id="submit_button" onclick="VerifyLead('{{route('elife.lead.submit')}}','elife_form','{{route('home')}}')">
                                        {{-- <input value="Follow Up" class="btn btn-success follow_up_mnp follow_up_new"
                                            data-toggle="modal" data-target="#myModalElife" id="follow_up_new"> --}}
                                        <input type="reset" value="Reset" class="btn btn-primary reset" name="reset"
                                            id="reset">


                                    {{-- </div> --}}
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            {{-- lorem --}}
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            {{-- lorem --}}




                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
