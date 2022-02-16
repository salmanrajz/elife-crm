              <div class="package_name postpaid_package" style="display:{{old('simtype') == 'MNP' || old('simtype') == 'Migration' ? 'block' : 'none'}};">

                  <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="center">
                              Postpaid Package
                          </label>
                      </div>
                  </div>
                  <!-- form-group end -->
                  <!-- form-group end -->
                  <div class="form-group ">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                          <select name="plan_mnp" id="c__select" class="form-control plan_mnp" style="" onchange="plan_month($(this).val(),'PlanFetch','{{ route('ajaxRequest.post') }}')">
                              <option value="">Select Plan</option>
                        @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{old('plan_mnp') == $plan->plan_name ? 'selected' : ''}}>{{ $plan->plan_name }}</option>
                        @endforeach
                              <!-- <option value="250">250</option> -->
                          </select>

                      </div>

                      <span class="required hidden">*</span>
                      <div class=" item col-md-5 col-sm-5 col-xs-12 form-group hidden">
                          <!-- <input class="form-control " id="inputSuccess3" placeholder="Customer Number" data-inputmask="'mask' : '(999) 999-9999'" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="num"> -->
                          <select name="contract_comm_mnp" id="fname2" class="fname1 form-control " onchange="myFunction1()">
                              <option value="">Contract Commitment</option>
                              <option value="No Contract" id="6_months1" >No Contract</option>
                              <option value="12 Months" id="">12 Months</option>
                              <option value="24 Months">24 Months</option>
                          </select>

                      </div>


                      <div class="item col-md-3 col-sm-12 col-xs-12 form-group">
                          <select name="activation_charges_mnp" id="activation_charges" class="activation_charges form-control">
                              <!-- <option value="Paid">Paid</option> -->
                              <option value="Free">Free</option>
                          </select>
                      </div>
                      <div class="col-md-3 col-sm-12 col-xs-12 form-group hidden">
                          <input type="text" name="activation_rate_mnp" id="activation_rate" class="activation_rate form-control" placeholder="I.E 100 AED" value="">
                      </div>
                  </div>
                  <div class="item col-md-12 col-sm-12 col-xs-12 form-group ">


                      <!-- <input type="text" name="course_name" id="course_name" value=""/> -->
                      <!-- <input type="text" name="course_credit" id="course_credit" value=""/> -->
                      <!-- form-group end -->
                      <!--  #6 end -->
                      <!-- pika booo -->


                      <div class="table-responsive  ">
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
                                          <input type="text" name="plan_s[]" id="mp2" onchange="myFunction2()" value="0" class="noborder mp" />
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
                      <h4>Remarks *</h4>

                      <div class="form-group">
                      <textarea name="remarks_process_mnp" id="remarks_process" cols="30" rows="10" class="form-control">Please Verify</textarea>
                      </div>


                  </div>
                  <div class="form-group">
                      <div id="myModalMNP" class="modal fade" role="dialog" style="margin-top:10%;" data-backdrop="static" data-keyboard="false">
                          <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" onclick="close_modal()">&times;</button>
                                      <h4 class="modal-title">Follow Up</h4>
                                  </div>
                                  <div class="modal-body">
                                      <!-- <p>Some text in the modal.</p> -->
                                      <div class="form-group" style="display:block;" id="call_back_at_new">
                                          <div class="col-md-1 col-md-5">
                                              <label for="">
                                                  <h5>Call Back At</h5>
                                              </label>
                                          </div>
                                          <div class="col-md-12 col-sm-512 col-xs-12 form-group ">
                                              <!-- <input type="hidden" name="call_back_ajax call_back_mnp" value=''> -->
                                              <input type="hidden" name="call_back_ajax" value='' class="call_back_ajax">

                                          <input type="datetime-local" name="call_back_at_mnp" class="form-control " id="call_back_mnp" placeholder="Add Later time" aria-describedby="inputSuccess2Status2" value="{{old('call_back_at_mnp')}}">
                                          </div>
                                          <div class="col-md-7 col-sm-12 col-xs-12 form-group">
                                              <!-- <textarea name="remarks_mnp" id="remarks_mnp" cols="30" rows="10" class="form-control"></textarea> -->

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
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <input type="submit" value="Submit" class="btn btn-success  submit_mnp submit_button_on_no" name="upload" id="submit_button">
                          <input value="Follow Up" class="btn btn-success follow_up_mnp follow_up_new" data-toggle="modal" data-target="#myModalMNP" id="follow_up_new" >
                          <input type="reset" value="Reset" class="btn btn-primary reset" name="reset" id="reset">
                        </div>
                  </div>
              </div>
            </div>
