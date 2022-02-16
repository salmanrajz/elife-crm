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
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <label for="simtype">Agency ID</label>

                                    <select name="AgencyID" id="AgencyID" class="sim_type form-control" onchange="AgencyID('{{route('BillingAmount')}}')">
                                        <option value="">Select Agency ID</option>
                                        @foreach ($kiosk as $item)
                                            <option value="{{$item->id}}">{{$item->agency_id}}</option>
                                        @endforeach

                                    </select>

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <label for="simtype">Billing Amount</label>
                                    <input type="text" name="BillingAmount" id="BillingAmount" class="form-control">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="BillingDiv" style="display:none;">
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

                            <form onsubmit="return false" method="post" enctype="multipart/form-data" id="FetchApiForm">
                                @csrf
                                Emirates Back ID:
                                <input type="file" name="front_img" id="back_img"
                                    onchange="SavingDataDeal('{{route('ocr.submit')}}','FetchApiForm')">
                                    <img src="" id="back_img_display"  style="width:175px;" accept="image/*">
                            </form>
                            </div>
                            </div>

                        </div>
                        <form class="form-horizontal form-label-left input_mask" method="post"
                            action="{{route('lead.store')}}" autocomplete="off" id="elife_form">
                            @csrf
                            <input type="hidden" name="sale_type" value="{{$type .' '. $ptype}}">
                                <input type="hidden" name="BillingAmountVal" id="BillingAmountVal">
                                <input type="hidden" name="agency_id" id="agency_id">


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
                                    <label for="name">Customer Name</label>
                                    {{-- {{$id}} --}}
                                    <input class="form-control " id="name" placeholder="Customer Name" name="cname"
                                        type="text" required value="{{old('cname')}}">
                                </div>
                                <!-- </div>
                            <div class="item form-group"> -->
                                <!-- required -->


                                {{-- <span class="required">*</span> --}}

                                <div class="  col-md-4 col-sm-12 col-xs-12 form-group ">
                                    <label for="">Customer Number</label>
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


                                <!-- </div>
                            <div class="item form-group"> -->
                                <!-- required -->

                                {{-- <span class="required">*</span> --}}
                                <div class=" item col-md-6 col-sm-12 col-xs-12 form-group ">
                                    <label for="age">Customer Email</label>
                                    <input class="form-control " id="email" placeholder="Customer Age not less than 21"
                                        name="email" required type="email" required
                                        >
                                </div>
                                 <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                    <label for="simtype">Product Type</label>

                                    <select name="simtype" id="simtype" class="sim_type form-control" required>
                                        <option value="">-- Product Type --</option>
                                        @php
                                        $pd = \App\billing_type::where('status','1')->get();
                                        @endphp
                                        @foreach ($pd as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                                 <div class=" item col-md-6 col-sm-12 col-xs-12 form-group ">
                                    <label for="age">Recharge Amount</label>
                                    <input class="form-control " type="tel" name="recharge_amount" placeholder="recharge amount" />
                                </div>
                                <!-- Customer number end -->
                            </div>
                            <!-- form-group end -->
                            <!--  #2 end -->
                            <!--  #3 start -->

                            <!-- form group start -->
                            <!-- Customer name start -->


                </div>
                <div class="container-fluid">


                </div>
                 <div class="item col-md-12 col-sm-12 col-xs-12 form-group hidden d-none">
            <!-- <h3>Remarks</h3> -->
            <h4>Remarks *</h4>

            <div class="form-group">
                <textarea name="remarks_process_elife" id="remarks_process" cols="30" rows="10" class="form-control remarks_elife">Please Verify</textarea>
                <!-- <input type="text" name="remarks_process" id="remarks_process" class="form-control"> -->
            </div>
        </div>
                {{-- @include('dashboard.include.mnp') --}}
                {{-- @include('dashboard.include.new-package') --}}
                {{-- @include('dashboard.include.elife-package') --}}
                {{-- @include('dashboard.include.itp') --}}
                 <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input type="button" value="Submit" class="btn btn-success submit_button_new submit_button_on_no" name="upload" id="submit_button" onclick="VerifyLead('{{route('billing.submit')}}','elife_form','LoadTable')">
            {{-- <input value="Follow Up" class="btn btn-success follow_up_new" data-toggle="modal" data-target="#myModal" id="follow_up_new" type="button"> --}}

                          {{-- <input type="submit" value="Submit" class="btn btn-success  submit_mnp submit_button_on_no" name="upload" id="submit_button">
                          <input value="Follow Up" class="btn btn-success follow_up_mnp follow_up_new" data-toggle="modal" data-target="#myModalMNP" id="follow_up_new" >
                          <input type="reset" value="Reset" class="btn btn-primary reset" name="reset" id="reset"> --}}


                        </div>
                  </div>
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
