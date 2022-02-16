<!-- verify elife -->
@php( $plans = \App\elife_plan::wherestatus('1')->get())
@php( $addons = \App\addon::wherestatus('1')->get())
@php( $ch_addons = \App\chosen_addon::wherelead_id('23')->get())
@php( $count = $ch_addons->count())
{{-- {{dd($ch_addons)}} --}}
<div class="package_name_elife elife_package" >
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label class="center">
                Elife Package
            </label>
        </div>
        <!-- 1st row of elfie -->
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                <select name="plan_elife" id="c__select" class="form-control elife_plan" style="" onchange="elife_plan_month($(this).val(),'ElifePlanFetch','{{ route('ajaxRequest.post') }}')">
 <option value="">Select Plan</option>
        @foreach($plans as $plan)
        <option value="{{ $plan->id }}" {{ $data->select_plan == $plan->id ? 'selected' : '' }}>{{ $plan->plan_name }}</option>
        @endforeach
                </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">

            <input type="text" name="elife_makani_number" id="elife_makani_number" class="form-control" placeholder="Eid / Makani #" value="{{$data->number_commitment}}">
            </div>
        </div>
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

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                @foreach ($addons as $key => $addon)
                @if($key < $count)
                <div class="checkbox">
                    <input type="checkbox" name="elife_package[]" id="{{$addon->id}}" value={{$addon->id}} {{ $ch_addons[$key]->addon_id == $addon->id ? 'checked' : '' }}>
                    <label for="">
                        {{$addon->addon_name . ' - '. $addon->amount . ' AED'}}
                    </label>
                </div>
                {{-- @e --}}
                @endif
                @endforeach
            </div>
             <div class="item col-md-12 col-sm-12 col-xs-12 form-group ">
            <!-- <h3>Remarks</h3> -->
            <h4>Remarks *</h4>

            <div class="form-group">
                <textarea name="remarks_process_elife" id="remarks_process" cols="30" rows="10" class="form-control remarks_elife">{{$data->remarks}}</textarea>
                <!-- <input type="text" name="remarks_process" id="remarks_process" class="form-control"> -->
            </div>
        </div>
             <div class="form-group">
                     <div id="myModal" class="modal fade" role="dialog" style="margin-top:10%;" data-backdrop="static" data-keyboard="false">
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
                                             <input type="datetime-local" name="call_back_at_new" class="form-control " id="#" placeholder="Add Later time" aria-describedby="inputSuccess2Status2">
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
</div>
