<div class="package_name new_package" style="display:{{old('simtype') == 'New' ? 'block' : 'none'}}">
    <input type="hidden" name="AjaxUrl" value="{{ route('ajaxRequest.post') }}" id="AjaxUrl">
    <input type="hidden" name="AjaxUrl2" value="{{ route('ajaxRequest.PlanType') }}" id="AjaxUrl2">
    <input type="hidden" name="AjaxUrl3" value="{{ route('ajaxRequest.checkNumData') }}" id="AjaxUrl3">
    <input type="hidden" name="CheckPackageName" value="{{ route('ajaxRequest.CheckPackageName') }}" id="CheckPackageName">
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="center">
                Postpaid Package
            </label>
        </div>
    </div>
    <div class="form-group">
    {{-- <label class="radio-inline">
        <input type="radio" class="numbertype" name="numbertype" id="silver" value="silver">Silver</label>
    <label class="radio-inline">
        <input type="radio" class="numbertype"  name="numbertype" id="silver" value="gold">Golden</label>
    <label class="radio-inline">
        <input type="radio" class="numbertype"  name="numbertype" id="silver" value="platinum">Platinum</label> --}}

        {{-- <input type="hidden" name="mytypeval" id="mytypeval" value="silver"> --}}
</div>
<div class="container">
    <div class="form-group" id="number_exceed_msg">

    </div>
</div>
    <!-- form-group end -->
    <div class="form-group jackson_action row" id="klon1">
    <div class="col-md-12">
    <label for="mytypeval">Select Number Type</label>
    <select name="mytypeval[]" id="mytypeval" class="form-control hidden" >
        <option value="">Select Number Type</option>
        {{-- <option value="my">My Reserved Number</option> --}}
        @foreach ($q as $qq)
        <option value="{{$qq->type}}">{{$qq->type}}</option>
        @endforeach

        {{-- <option value="Standard" {{old('mytypeval') == 'Standard' ? 'selected' : ''}}>Standard</option>
        <option value="silver" {{old('mytypeval') == 'silved' ? 'selected' : ''}} >Silver</option>
        <option value="gold" {{old('mytypeval') == 'gold' ? 'selected' : ''}}>Golden</option>
        <option value="Platinum" {{old('mytypeval') == 'platinum' ? 'selected' : ''}}>Platinum</option> --}}
    </select>
    </div>
        <div class="col-md-4 col-sm-12 col-xs-12 form-group salman_ahmed">
            {{-- <input class="form-control select2" placeholder="Select Number i.e 0551234567" name="selnumber[]" maxlength="10" required type="text" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return isNumberKey(event)"  id="customer_number" value="{{old('cnumber')}}" data-mask="999-9999999" data-validate-length-range="6" data-validate-words="2" /> --}}
            {{-- <select name="selnumber[]" id="selcnumber" class="form-control NumberDropDown" style="width:200px;height:50px;">
            </select> --}}
            <input class="form-control salman_ahmed_number" id="salman_ahmed" placeholder="Selected Number" name="selnumber[]" type="number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return isNumberKey(event)">
            {{-- <input type="hidden" name="quick_search_val" id="quick_search_val"> --}}
            {{-- <div id="suggesstion-box2" style="background:white;margin: 0;padding: 0;position: absolute;z-index:99999;width:466px;"></div> --}}
        </div>


        <!-- Customer number end -->
        {{-- <span class=""> --}}

            <div class="col-md-3 col-sm-12 col-xs-12 form-group ">
                <select name="plan_new[]" id="c__select" class="form-control c__select">
                    <option value="">Select Plan</option>
                        @foreach($plans as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                        @endforeach
                    <!-- <option value="250">250</option> -->
                </select>
            </div>
        {{-- </span> --}}
        <div class="item col-md-2 col-sm-12 col-xs-12 form-group">
            <select name="activation_charges_new[]" id="activation_charges" class="activation_charges form-control">
                <option value="">Select Amount</option>
                <option value="Paid">Paid</option>
                <option value="Free">Free</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group ">
            <input type="text" name="activation_rate_new[]" id="activation_rate" class="activation_rate form-control" placeholder="I.E 130 AED" value="" onkeypress="return isNumberKey(event)">
        </div>
        <div class="container col-md-12">
            <div class="table-responsive ">
                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                        <tr class="headings">
                            <!-- <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th> -->
                            <label for="" id="lsm">
                                <!-- <input type="text" name="plans[]" id="lm" value=""  class="noborder"/> -->
                            </label>

                            <!-- <p class="ponka" id="ponka">lorem</p> -->
                            <th class="column-title ponka">Local Minutes </th>
                            <th class="column-title">Flexible Minutes </th>
                            <th class="column-title">Data </th>
                            <th class="column-title">Preffered Numbers Allowed </th>
                            <th class="column-title">Free minutes to preffered Numbers </th>
                            <th class="column-title">Contract Commitment </th>
                            <!-- <th class="column-title">Amount </th> -->
                            <th class="column-title no-link last"><span class="nobr">Monthly Plan Payment</span></th>

                        </tr>
                    </thead>
                    <style>
                        .noborder {
                            border: none;
                            width: 50%;
                            font-weight: bold;
                        }
                    </style>
                    <tbody>
                        <tr class="even pointer">
                            <!-- <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td> -->
                            <td class="lm ponka">
                                <input type="text" name="plans[]" id="lm" value="" class="noborder lm" />
                            </td>
                            <td class="fm ">
                                <input type="text" name="plans[]" id="fm" value="" class="noborder fm" />
                            </td>
                            <td class="data ">
                                <input type="text" name="plans[]" id="data" value="" class="noborder samina" />
                            </td>
                            <td class="pnum ">
                                <input type="text" name="plans[]" id="pnum" value="" class="noborder pnum" />
                            </td>
                            <td class="fmnum ">
                                <input type="text" name="plans[]" id="fmnum" value="" class="noborder fmnum" />
                            </td>
                            <td>
                                <div id="contract_commitment_1" class="contract_commitment_1"></div>
                                <!-- <input type="text"  id="monthly_plan_payment" value=""  class="noborder mp"/> -->
                            </td>
                            <td class="a-right a-right m_p ">
                                <input type="text" name="plan_s[]" id="mp1" onchange="myFunction2()" value="0" class="noborder mp" />
                            </td>
                            <!-- <td class=" last"><a href="#">View</a> -->
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="container_sam"></div>


    <!-- form-group end -->
    <div id="container_sam2" class="form-group">

    </div>

    <div class="col-md-6 col-sm-6 col-xs-6 form-group rajput">
        <a class="btn btn-primary" id="sumebutton" style="color:#fff">
            Add New Number
        </a>
    </div>
    <!-- <p class="p1">Click this paragraph to increase text size.</p>
    <p class="p2">This is another paragraph.</p>

    <button type="button" id=s_sambutton>Copy the first p element (including event handlers), and append to body element</button> -->

    </body>
    <!-- <button id="cloneDiv">CLICK TO CLONE</button> -->

    <!-- <div id="klon1">klon1</div> -->
    <!-- <div id="klon2">klon2</div> -->

    <div class="form-group">

        <!-- </div>
                    <div class="item form-group"> -->
        <!-- required -->

        <span class="required hidden">*</span>
        <div class=" item col-md-5 col-sm-5 col-xs-12 form-group hidden">
            <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
            <select name="contract_comm_new" id="fname1" class="fname1 form-control ">
                <option value="">Contract Commitment</option>
                <option value="No Contract" id="6_months">No Contract</option>
                <option value="12 Months" id="">12 Months</option>
                <option value="24 Months">24 Months</option>
            </select>

        </div>



    </div>
    <div class="item col-md-12 col-sm-12 col-xs-12 form-group ">
        <h4>Remarks *</h4>


        <div class="form-group">
            <textarea name="remarks_process_new" id="remarks_process" cols="30" rows="10" class="form-control remarks_process_new">Please Verify</textarea>
            <!-- <input type="text" name="remarks_process" id="remarks_process" class="form-control"> -->
        </div>
        <!-- <input type="text" name="course_name" id="course_name" value=""/> -->
        <!-- <input type="text" name="course_credit" id="course_credit" value=""/> -->
        <!-- form-group end -->
        <!--  #6 end -->
        <!-- pika booo -->



        <!-- pika booo -->
        <div class="row hidden-lg hidden-ms hidden">
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Local Minutes</label>
                    <div class="col-sm-12 col-xs-12 form-group ">
                        <input class="form-control  lm" disabled="" type="text">
                        <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Flexible Minutes</label>
                    <div class="col-sm-12 col-xs-12 form-group ">
                        <input class="form-control  fm" disabled="" type="text">
                        <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Data</label>
                    <div class="col-sm-12 col-xs-12 form-group ">
                        <input class="form-control  samina" disabled="" type="text">
                        <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Preffered Number Allowed</label>
                    <div class="col-sm-12 col-xs-12 form-group ">
                        <input class="form-control  pnum" disabled="" type="text">
                        <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Contract Commitment</label>
                    <div class="col-sm-12 col-xs-12 form-group ">

                        <!-- <input class="form-control  pnum" disabled="" type="text">
                              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Free Minutes to Preffered</label>
                    <div class="col-sm-12 col-xs-12 form-group ">
                        <input class="form-control  fmnum" disabled="" type="text">
                        <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="localminutes" class="control-label col-md-2 col-sm-2 col-xs-12">Monthly Payment</label>
                    <div class="col-sm-12 col-xs-12 form-group ">
                        <input class="form-control  mp" disabled="" type="text">
                        <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </div>
        <!--  #6 -->


        {{-- <div class="form-group">

            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                <label for="add-device">Add Device</label>
                <input type="checkbox" data-toggle="toggle" id="purpose1" onclick="return alert('Kindly Upgrade your Sim Contract')">
            </div>
            <!-- </div>
                    <div class="item form-group"> -->
            <!-- required -->


            <!-- Customer number end -->
        </div>
        <!-- form-group end -->
        <!--  #5 end -->

        <!-- pika booo --> --}}



    </div>
    <div class="form-group">
        <div id="myModal" class="modal fade" role="dialog" style="margin-top:10%;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="close_modal()">&times;</button>
                        <h4 class="modal-title">Follow Up</h4>
                    </div>
                    <div class="modal-body">
                        <!-- <p>Some text in the modal.</p> -->
                        <div class="form-group row" style="display:block;" id="call_back_at_new">
                            <div class="col-md-1 col-md-12">
                                <label for="">
                                    <h5>Call Back At</h5>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                                <input type="hidden" name="call_back_ajax" value='' class="call_back_ajax">
                                <input type="datetime-local" name="call_back_at_new" class="form-control" id="call_back_new" placeholder="Add Later time" aria-describedby="inputSuccess2Status2" >
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <!-- <textarea name="remarks_new" id="remarks_new" cols="30" rows="10" class="form-control"></textarea> -->

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Follow Up" class="btn btn-success" name="follow" id="follow_up_new" style="display:;">

                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
       <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input type="submit" value="Submit" class="btn btn-success submit_button_new submit_button_on_no" name="upload" id="submit_button">
            <input value="Follow Up" class="btn btn-success follow_up_new" data-toggle="modal" data-target="#myModal" id="follow_up_new" type="button">

                          {{-- <input type="submit" value="Submit" class="btn btn-success  submit_mnp submit_button_on_no" name="upload" id="submit_button">
                          <input value="Follow Up" class="btn btn-success follow_up_mnp follow_up_new" data-toggle="modal" data-target="#myModalMNP" id="follow_up_new" >
                          <input type="reset" value="Reset" class="btn btn-primary reset" name="reset" id="reset"> --}}


                        </div>
                  </div>
</div>

</div>
