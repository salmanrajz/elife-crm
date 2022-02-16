<div class="package_name itp" >
    {{-- Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam esse obcaecati exercitationem at tenetur velit, fugiat reiciendis unde cupiditate sequi ipsam modi nobis alias, aut ea amet doloribus voluptatibus quia. --}}
    <h3>IT Product Pacakge List</h3>
    <input type="hidden" name="ajaxUrlIT" id="ajaxUrlIT" value="{{ route('ajaxRequest.itpost') }}">
    <input type="hidden" id="itplanid" value="{{$data->select_plan}}">
    <input type="hidden" id="itplanurl" value="{{ route('ajaxRequest.itplan') }}">
    <div class="form-group">
        <label for="Package Name">Package Name</label>
        <select name="package_id" id="package_id" class="form-control" onchange="itplan($(this).val(),'{{ route('ajaxRequest.itplan') }}')">
            <option value=""></option>
        </select>
    </div>
    <div class="form-group">
        <label for="pricing">Pricing:</label>
        <input type="hidden" name="pricing" name="pricing" class="plan_pricing">
        <input type="text" name="pricing" id="pricing" disabled class="class-form-control plan_pricing">
    </div>
    <div class="form-group">
        <label for="plan_desc">Plan Description</label>
        <p name="plan_desc" id="plan_desc" class="plan_description"></p>
    </div>
    <div class="form-group">
        <label for="Remarks">Remarks</label>
    <textarea name="remarks_itp" id="remarks_itp" cols="30" rows="10" class="remarks_itp form-control">{{$data->remarks}}</textarea>
    </div>
    <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-success submit_button_new submit_button_on_no" name="upload" id="submit_button">
            <input value="Follow Up" class="btn btn-success follow_up_new" data-toggle="modal" data-target="#myModalITP" id="follow_up_new" type="button">
    </div>
        <div class="form-group">
        <div id="myModalITP" class="modal fade" role="dialog" style="margin-top:10%;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Call Back IT Package</h4>
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
                                <input type="datetime-local" name="callbackitp" class="form-control myDatepicker" id="callbackitp" placeholder="Add Later time" aria-describedby="inputSuccess2Status2" >
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12 form-group">
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
</div>
