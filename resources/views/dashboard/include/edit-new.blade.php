             <div class="package_name new_package" >
                 <div class="form-group">
                     <div class="col-md-12 col-sm-6 col-xs-12">
                         <label class="center">
                             Postpaid Package
                         </label>
                     </div>
                 </div>
@php( $plans = \App\plan::wherestatus('1')->get())

                    {{-- {{$ln = $data->selected_number}} --}}
@if ($data->selected_number != "")
  @foreach(explode(',', $data->selected_number) as $key => $info)
    {{-- <option>{{$info}}</option> --}}
    {{-- $plan = $question->select_plan; --}}
    {{-- {{$data->select_plan[$key]}} --}}
    @php( $sel_plan = explode(",",$data->select_plan) )
    @php( $selected_number = explode(",",$data->selected_number) )
    @php( $pay_status = explode(",",$data->pay_status) )
    @php( $pay_charges = explode(",",$data->pay_charges) )
             {{-- {{$values[$key]}} --}}

                     <!-- form-group end -->

                     <div class="form-group jackson_action row" id="klon">
                         <div class="col-md-4 col-sm-12 col-xs-12 form-group salman_ahmed" required>
                         <input class="form-control " id="salman_ahmed" placeholder="Selected Number" name="selnumber[]" type="text" required maxlength="12" value="{{$selected_number[$key]}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return isNumberKey(event)">
                             <input type="hidden" name="quick_search_val" id="quick_search_val">
                             <div id="suggesstion-box2" style="background:white;margin: 0;padding: 0;position: absolute;z-index:99999;width:466px;"></div>
                         </div>
                         {{-- <span class=""> --}}

                             <div class="col-md-3 col-sm-12 col-xs-12 form-group ">
                                 <select name="plan_new[]" id="c__select" class="form-control " style="" required onchange="plan_month($(this).val())">
                                 {{-- <option value="{{$data->select_plan}}">
                                            {{$data->select_plan}}
                                     </option> --}}
                                     <option value="">Select Plan</option>
                                        @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" {{ $sel_plan[$key] == $plan->id ? 'selected' : '' }}>{{ $plan->plan_name }}</option>
                                        @endforeach

                                     <!-- <option value="250">250</option> -->
                                 </select>

                             </div>
                         {{-- </span> --}}
                         <div class="item col-md-2 col-sm-12 col-xs-12 form-group">
                             <select name="activation_charges_new[]" id="activation_charges" class="activation_charges form-control">
                                 <option value=""></option>
                                 <!-- <option value="Paid">Paid</option> -->

                                 <option value="Free" @if ($pay_status[$key] == "Free") {{ 'selected' }} @endif>Free</option>
                                 <option value="Paid" @if ($pay_status[$key] == "Paid") {{ 'selected' }} @endif>Paid</option>
                             </select>
                         </div>
                         <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                             <input type="text" name="activation_rate_new[]" id="activation_rate" class="activation_rate form-control" placeholder="I.E 130 AED" value="{{$pay_charges[$key]}}">
                         </div>

                         <div class="container col-md-12">
                             <div class="table-responsive hidden-sm hidden-xs">

                                     <table class="table table-striped table-bordered table-responsive">
                                         <thead>
                                             <tr class="headings">
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
                                                 <td class="lm ponka">
                                                 <input type="text" name="plans[]" id="lm" value="{{$plan->local_minutes}}" class="noborder lm" />
                                                 </td>
                                                 <td class="fm ">
                                                     <input type="text" name="plans[]" id="fm" value="{{$plan->flexible_minutes}}" class="noborder fm" />
                                                 </td>
                                                 <td class="data ">
                                                     <input type="text" name="plans[]" id="data" value="{{$plan->data}}" class="noborder samina" />
                                                 </td>
                                                 <td class="pnum ">
                                                     <input type="text" name="plans[]" id="pnum" value="{{$plan->number_allowed}}" class="noborder pnum" />
                                                 </td>
                                                 <td class="fmnum ">
                                                     <input type="text" name="plans[]" id="fmnum" value="{{$plan->free_minutes}}" class="noborder fmnum" />
                                                 </td>
                                                 <td>
                                                     <div id="contract_commitment_1" class="contract_commitment_1">
                                                         {{$plan->duration}}
                                                     </div>
                                                     <!-- <input type="text"  id="monthly_plan_payment" value=""  class="noborder mp"/> -->
                                                 </td>
                                                 <td class="a-right a-right m_p ">
                                                     <input type="text" name="plan_s[]" id="mp1" onchange="myFunction2()" value="{{$plan->revenue}}" class="noborder mp" />
                                                 </td>
                                                 <!-- <td class=" last"><a href="#">View</a> -->
                                                 </td>
                                             </tr>

                                         </tbody>
                                     </table>
                             </div>
                         </div>
                         <!-- <button class="btn btn-success klon_verify" onclick="" type="button">Verify</button> -->
                     </div>
@endforeach
@endif

                 <div id="container_sam"></div>


                 <!-- form-group end -->
                 <div id="container_sam2" class="form-group">

                 </div>


                     <div class="col-md-6 col-sm-6 col-xs-6 form-group rajput">
                         <a class="btn btn-primary" id="sumebutton" style="display:none;color:#fff">
                             Add New Number
                         </a>
                         <a class="btn btn-primary" id="show_sumebutton" style="color:#fff">
                             Edit Number Details
                         </a>
                     </div>
                 <?php
                //  }
                  ?>
                 <div class="form-group">

                     <!-- </div>
                                <div class="item form-group"> -->
                     <!-- required -->

                     <span class="required hidden">*</span>
                     <div class=" item col-md-5 col-sm-5 col-xs-12 form-group hidden" >
                         <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                         <select name="contract_comm_new" id="fname1" class="fname1 form-control " >
                             <option value="">Contract Commitment</option>
                             <option value="No Contract" id="6_months">No Contract</option>
                             <option value="12 Months" id="">12 Months</option>
                             <option value="24 Months">24 Months</option>
                         </select>

                     </div>



                 </div>
                 <div class="item col-md-12 col-sm-12 col-xs-12 form-group ">

                     <!-- <input type="text" name="course_name" id="course_name" value=""/> -->
                     <!-- <input type="text" name="course_credit" id="course_credit" value=""/> -->
                     <!-- form-group end -->
                     <!--  #6 end -->
                     <!-- pika booo -->


                     <div class="table-responsive hidden-sm hidden-xs hidden">
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
                                     <th class="bulk-actions" colspan="7">
                                         <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                     </th>
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
                                         <input type="text" name="plan_s[]" id="mp1" onchange="myFunction2()" value="" class="noborder mp" />
                                     </td>
                                     <!-- <td class=" last"><a href="#">View</a> -->
                                     </td>
                                 </tr>

                             </tbody>
                         </table>
                     </div>
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


                     <div class="form-group">

                         <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                            <label for="add-device">Add Device</label>
                                            <input type="checkbox" data-toggle="toggle" id="purpose1" onclick="return alert('Kindly Upgrade your Sim Contract')">
                                        </div> -->


                         <!-- Customer number end -->
                     </div>
                     <!-- form-group end -->
                     <!--  #5 end -->

                     <!-- pika booo -->
<h4>Remarks *</h4>


        <div class="form-group">
            <textarea name="remarks_process_new" id="remarks_process" cols="30" rows="10" class="form-control remarks_process_new">{{$data->remarks}}</textarea>

        </div>

                     <div class="" id="business1" style="display: none;">
                         <table class="table table-striped table-bordered table-responsive">
                             <thead>
                                 <tr class="headings">

                                     <th class="column-title">
                                         Devices
                                     </th>
                                     <th class="column-title">Commitment Period </th>
                                     <!-- <th class="column-title hidden">Monthly Payment </th> -->


                                 </tr>
                             </thead>

                             <tbody>

                                 <td class=" ">
                                     <select name="devices" id="" class="devices form-control " onchange="getData2($(this).val());">
                                         <option value="">-- Please Select --</option>


                                     </select>

                                 </td>
                                 <td class=" ">
                                     <select name="sam_commitment" id="fname" class="form-control  device_duration fname_sam">
                                         <option value="">--Please Select</option>
                                         <!-- <option value=""></option> -->
                                         <option value="12 Months">12 Months</option>
                                         <option value="24 Months">24 Months</option>
                                     </select>

                                 </td>
                                 <script>
                                     function myFunction() {
                                         var x = document.getElementById("fname");
                                         var div = document.getElementById('device_commitment_period');
                                         div.innerHTML = x.value;



                                     }

                                     function myFunction1() {
                                         var y = document.getElementById("fname1");
                                         var div1 = document.getElementById('contract_commitment_1');
                                         div1.innerHTML = y.value;

                                         // var z = document.getElementById("contract_commitment_1");
                                         var div2 = document.getElementById('contract_commitment');
                                         div2.innerHTML = y.value;


                                     }

                                     // function myFunction1()
                                     // {
                                     // var y = document.getElementById("fname1");
                                     // var div1 = document.getElementById('contract_commitment_1');
                                     // div1.innerHTML = y.value;
                                     // }
                                     // function myFunction2()
                                     // {
                                     // var z = document.getElementById("mp1");
                                     // var div2 = document.getElementById('monthly_plan_payment1');
                                     // div2.innerHTML = z.value;
                                     // }
                                 </script>

                                 <!-- Enter your name: <input type="text" id="mp1" onchange="myFunction2()"> -->
                                 <!-- <p>When you leave the input field, a function is triggered which transforms the input text to upper case.</p> -->

                                 <!-- <div id="monthly_plan_payment1"></div> -->



                                 <!-- <td class="a-right a-right ">$7.45</td> -->
                                 <!-- <td class=" last"><a href="#">View</a> -->
                                 <!-- </td> -->
                                 </tr>

                             </tbody>
                         </table>
                         <div class="col-md-8">
                             <table class="table table-striped table-bordered table-responsive">
                                 <thead>
                                     <th class="column-title center" style="width: 50%">Post Paid Contract Commitment</th>
                                     <th class="column-title center">Post Paid Monthly Plan Payment</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <td class=" ">
                                         <div id="contract_commitment"></div>
                                     </td>
                                     <td class=" ">
                                         <input type="text" name="total_monthly_pay1" id="monthly_plan_payment" value="" class="noborder mp" />
                                     </td>
                                     </tr>
                                 </tbody>
                             </table>
                             <table class="table table-striped table-bordered table-responsive">
                                 <thead>
                                     <th class="column-title center" style="width: 50%">Device Contract Commitment</th>
                                     <th class="column-title center">Mobile Payment</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <td class=" ">
                                         <div id="device_commitment_period"></div>

                                     </td>
                                     <td class=" ">
                                         <input type="text" name="monthly_pay" id="contract_commitment1" value="" class="monthly_pay noborder" />

                                     </td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                         <div class="com-md-4">
                             <table class="table table-striped table-bordered table-responsive" style="width: 30%;">
                                 <thead>
                                     <th class="column-title center">Total Monthly Payment</th>
                                     <!-- <th class="column-title center" >Post Paid Monthly Plan Payment</th> -->
                                 </thead>
                                 <tbody>
                                     <tr style="height:131px">
                                         <td class=" ">
                                             <input type="text" name="total_monthly_pay" id="finaltotal1" value="" class="noborder" />
                                             <div><span id="finaltotal" style="text-align: center;font-size:52px;"></span></div>
                                         </td>
                                         <script>
                                             var myInput = document.getElementById('finaltotal');
                                             // myInput.disabled = true;
                                         </script>

                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                         <!-- table end  -->
                         <!-- table start -->
                         <!-- table end -->
                     </div>

                 </div>
                 <div class="form-group">
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
                                         <div class="col-md-12 col-md-12">
                                             <label for="">
                                                 <h5>Call Back At</h5>
                                             </label>
                                         </div>
                                         <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                                             <input type="datetime-local" name="call_back_at_new" class="form-control myDatepicker" id="myDatepicker" placeholder="Add Later time" aria-describedby="inputSuccess2Status2">
                                         </div>
                                         <div class="col-md-7 col-sm-12 col-xs-12 form-group">
                                             <textarea name="remarks_new" id="remarks_new" cols="30" rows="10" class="form-control hidden"></textarea>

                                         </div>

                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <input type="submit" value="Follow Up New" class="btn btn-success" name="follow_up_new" id="follow_up_new" style="display:;">

                                     <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                 </div>
                             </div>

                         </div>
                     </div>
<div class="col-sm-12 col-md-12 col-xs-12">
                                        <input type="submit" value="Proceed" class="btn btn-success submit_button_new submit" name="upload" id="submit_button">

                                        <button class="btn btn-success edit edit_enable" id="edit" type="button" data-toggle="modal" data-target="#myModal">
                                            Follow
                                        </button>


                                    </div>

                 </div>
             </div>
