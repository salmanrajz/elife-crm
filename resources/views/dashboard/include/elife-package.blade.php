<div class="package_name_elife elife_package" style="display:{{old('simtype') == 'Elife' ? 'block' : 'block'}}">
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label class="center">
                Package Details
            </label>
        </div>
        <div class="table-responsive ">
            <table class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr class="headings">
                        <label for="" id="lsm">
                            <!-- <input type="text" name="plans[]" id="lm" value=""  class="noborder"/> -->
                        </label>

                        <!-- <p class="ponka" id="ponka">lorem</p> -->
                        <th class="column-title ponka">Plan Name</th>
                        <th class="column-title">Speed </th>
                        <th class="column-title">Devices </th>
                        <th class="column-title">Monthly Charges</th>
                        <th class="column-title">Installation Charges </th>
                        <th class="column-title">Contract Commitment </th>
                        <!-- <th class="column-title">Amount </th> -->

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
                            <input type="text" name="elife_plans[]" id="elife_package_name" class="noborder lm" />
                        </td>
                        <td class="fm ">
                            <input type="text" name="elife_plans[]" id="elife_speed" class="noborder fm" />
                        </td>
                        <td class="data ">
                            <input type="text" name="elife_plans[]" id="elife_devices" class="noborder samina" />
                        </td>
                        <td class="pnum ">
                            <input type="text" name="elife_plans[]" id="elife_mothly_charges" class="noborder pnum" />
                            <input type="hidden" name="elife_monthly_charges" id="elife_mc" class="noborder pnum" />
                        </td>
                        <td class="fmnum ">
                            <input type="text" name="elife_plans[]" id="elife_installation_charges" class="noborder fmnum" />
                        </td>
                        <td>
                            <div id="elife_contract" class="contract_commitment_1"></div>
                            <input type="hidden" name="contract_commitement_elife" id="contract_commitment_elife">
                            <!-- <input type="text"  id="monthly_plan_payment" value=""  class="noborder mp"/> -->
                        </td>

                        <!-- <td class=" last"><a href="#">View</a> -->
                    </tr>

                </tbody>
            </table>
        </div>
        {{-- <div class="form-group row">
            <div class="col-md-6 col-sm-6 col-xs-6  ">
                <label for="">Elife Addon</label>
                @foreach ($addons as $key => $addon)
                @if($key > '5')
                @else
                <div class="checkbox">
                    <input type="checkbox" name="elife_package[]" id="{{$addon->id}}" value={{$addon->id}}>
                    <label for="">
                            {{$addon->addon_name . ' - '. $addon->amount . ' AED'}}
                    </label>
                </div>
                @endif
                @endforeach
                <!-- <select name="elife_package[]" id="elife_package" class="form-control elife_package" style="" multiple> -->
                <!-- <option value="">Select Plan</option> -->
                <!-- <option value="0">None</option> -->

                <!-- </select> -->
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6  ">
                <label for="">Elife Addon</label>
                @foreach ($addons as $key => $addon)
                @if($key < '6')
                @else
                <div class="checkbox">
                    <input type="checkbox" name="elife_package[]" id="{{$addon->id}}" value={{$addon->id}}>
                    <label for="">
                            {{$addon->addon_name . ' - '. $addon->amount . ' AED'}}
                    </label>
                </div>
                @endif
                @endforeach
                <!-- <select name="elife_package[]" id="elife_package" class="form-control elife_package" style="" multiple> -->
                <!-- <option value="">Select Plan</option> -->
                <!-- <option value="0">None</option> -->

                <!-- </select> -->
            </div>
        </div> --}}
        <div class="item col-md-12 col-sm-12 col-xs-12 form-group ">
            <!-- <h3>Remarks</h3> -->
            <h4>Remarks *</h4>

            <div class="form-group">
                <textarea name="remarks_process_elife" id="remarks_process" cols="30" rows="10" class="form-control remarks_elife">Please Verify</textarea>
                <!-- <input type="text" name="remarks_process" id="remarks_process" class="form-control"> -->
            </div>
        </div>
        <!-- 1st row of elfie  end -->

    </div>
    <div class="form-group">
        <div id="myModalElife" class="modal fade" role="dialog" style="margin:10%;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="close_modal()">&times;</button>
                        <h4 class="modal-title">Follow Up</h4>
                    </div>
                    <div class="modal-body">
                        <!-- <p>Some text in the modal.</p> -->
                        <div class="form-group" style="display:block;" id="call_back_at_elife">
                            <div class="col-md-1 col-md-12">
                                <label for="">
                                    <h5>Call Back At</h5>
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                                <!-- <input type="hidden" name="call_back_ajax call_back_elife" value=''> -->
                                <input type="hidden" name="call_back_ajax" value='' class="call_back_ajax">

                                <input type="datetime-local" name="call_back_at_elife" class="form-control " id="call_back_at_elifee" placeholder="Add Later time" aria-describedby="inputSuccess2Status2">
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12 form-group">
                                <!-- <textarea name="remarks_elife" id="remarks_new" cols="30" rows="10" class="form-control"></textarea> -->

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
                          <input value="Follow Up" class="btn btn-success follow_up_mnp follow_up_new" data-toggle="modal" data-target="#myModalElife" id="follow_up_new" >
                          <input type="reset" value="Reset" class="btn btn-primary reset" name="reset" id="reset">


                        </div>
                  </div>
        {{-- <div class="col-sm-4 col-md-4 col-xs-12">
            <input type="submit" value="Submit" class="btn btn-success submit_button_new submit_button_on_no" name="upload" id="submit_button">
            <input value="Follow Up" class="btn btn-success follow_up_new" data-toggle="modal" data-target="#myModalElife" id="follow_up_new" style="display:;">
        </div>
        <div class="col-sm-4">
            <input type="reset" value="Reset" class="btn btn-success reset" name="reset" id="reset">
        </div> --}}
    </div>
</div>
