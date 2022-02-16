<div class="package_name postpaid_package" >
@php( $plans = \App\plan::wherestatus('1')->get())

<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <label class="center">
            Postpaid Package
        </label>
    </div>
</div>
<!-- form-group end -->
<!-- form-group end -->
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
        <select name="plan_mnp" id="c__select" class="form-control " style="" required onchange="plan_month($(this).val())">
            <option value="">
                <option value="">Select Plan</option>
        @foreach($plans as $plan)
        <option value="{{ $plan->id }}" {{ $operation->select_plan == $plan->id ? 'selected' : '' }}>{{ $plan->plan_name }}</option>
        @endforeach


            <!-- <option value="250">250</option> -->
        </select>

    </div>
    <!-- </div>
            <div class="item form-group"> -->
    <!-- required -->

    {{-- <span class="required">*</span> --}}



    <div class="item col-md-3 col-sm-12 col-xs-12 form-group">
        <select name="activation_charges_mnp" id="activation_charges" class="activation_charges form-control">
            <option value="Free">Free</option>
        </select>
    </div>
</div>


</div>
