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
                <select name="plan_elife" id="c__select" class="form-control elife_plan" style="" onchange="elife_plan_month($(this).val())">
 <option value="">Select Plan</option>
        @foreach($plans as $plan)
        <option value="{{ $plan->id }}" {{ $operation->select_plan == $plan->id ? 'selected' : '' }}>{{ $plan->plan_name }}</option>
        @endforeach
                </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">

            <input type="text" name="elife_makani_number" id="elife_makani_number" class="form-control" placeholder="Eid / Makani #" value="{{$operation->number_commitment}}">
            </div>
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
        </div>
    </div>
</div>
