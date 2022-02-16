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
                             enctype="multipart/form-data" autocomplete="off" onsubmit="return false" id="SalerData">
                            @csrf
                            <!-- Plan name -->
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Company
                                    Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="company_name"
                                        placeholder="Company Name" type="text"  autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Authorized Person
                                    Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="authorized_person"
                                        placeholder="Authorized Person Name" type="text"  autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Company Number</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control " placeholder="Customer Number i.e 001234567"
                                        name="company_number" maxlength="9" required type="tel"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        onkeypress="return isNumberKey(event)" id="customer_number"
                                         data-mask="9999999" data-validate-length-range="6"
                                        data-validate-words="2" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Authorized Person Number</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control " placeholder="Authorized Person i.e 001234567"
                                        name="authorize_person_number" maxlength="9" required type="tel"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        onkeypress="return isNumberKey(event)" id="authorize_person_number"
                                         data-mask="9999999" data-validate-length-range="6"
                                        data-validate-words="2" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Email</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="email"
                                        placeholder="Email" type="email"  autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Company Address</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input class="form-control has-feedback-left" id="inputSuccess3" name="company_address"
                                        placeholder="Type Agent Name Here" type="text"  autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Remarks</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>




                    </div>
                    <!--  #7-->
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- <button type="button" class="btn btn-primary">Can cel</button> -->
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success" name="upload"
                            onclick="VerifyLead('{{route('saler.store')}}','SalerData','{{route('home')}}')"
                            >Submit</button>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">

                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
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
