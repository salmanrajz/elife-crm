<option value="">Select Plan</option>
@foreach($data as $elife)
<option value="{{ $elife->id }}" {{old('plan_elife' == $elife->id ? 'selected': '')}}>{{ $elife->plan_name }}</option>
@endforeach
