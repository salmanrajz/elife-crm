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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Call Log</li>
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

                        {{-- foreach --}}
                        <!-- Plan name -->
                        <div class="row">

                            <label for="localminutes" class="control-label col-md-6 col-sm-12 col-xs-12">
                                Call Log Name</label>
                            <label for="localminutes" class="control-label col-md-6 col-sm-12 col-xs-12">
                                Remarks</label>
                        </div>
                        {{-- @for($i = 0; $i<=300 ; $i++) --}}
                        @foreach ($k as $i => $item)
                        {{-- {{$item->number}} --}}
                        <form class="form-horizontal form-label-left input_mask" method="post" autocomplete="off"
                            id="call_log_{{$i}}" onsubmit="return false">
                            @csrf
                            <div class="form-group row container" style="padding:0px 30px;">
                                Customer Name: {{$item->name}}
                            </div>
                            <div class="form-group row container" style="padding:0px 30px;">
                                Customer Area: {{$item->area}}
                            </div>
                            <div class="form-group row container" style="padding:0px 30px;">
                                Customer Old Remarks: {{$item->remarks}}
                            </div>
                            <div class="form-group row container" style="padding:0px 30px;">
                                Customer Old Status: {{$item->status}}
                            </div>
                            <div class="form-group row">

                                <div class="col-md-2 col-sm-4 col-xs-12 form-group has-feedback">
                                    <input class="form-control " placeholder="Customer Number i.e 0551234567"
                                        name="number" maxlength="10" required type="tel"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        onkeypress="return isNumberKey(event)" id="number" value="{{$item->number}}" />
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-12 form-group has-feedback">
                                   <input type="text" name="value" id="value" value="{{$item->plan}}" class="form-control">
                                </div>
                                <input type="hidden" name="userid" value="{{$item->id}}">

                                <div class=" col-md-2" id="remarks_{{$i}}">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        <select name="status" id="status" class="form-control">
                                            <option value="Follow Up" @if( $item->status == 'Follow Up') selected
                                                @endif>Follow Up</option>
                                            <option value="Interested" @if( $item->status == 'Interested') selected
                                                @endif>Interested</option>
                                            <option value="Not Interested" @if( $item->status == 'Not Interested')
                                                selected @endif>Not Interested</option>
                                            <option value="No Answer" @if( $item->status == 'No Answer') selected
                                                @endif>No Answer</option>
                                            <option value="Lead" @if( $item->status == 'Lead') selected @endif>Lead
                                            </option>
                                            <option value="Not Valid" @if( $item->status == 'Not Valid') selected
                                                @endif>Not Valid</option>
                                        </select>

                                    </div>

                                </div>
                                <div class=" col-md-3" id="remarks_{{$i}}">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        {{-- <select name="status" id="status" class="form-control">
                                                <option value="Follow Up" @if( $item->status == 'Follow Up')  selected @endif>Follow Up</option>
                                                <option value="Interested" @if( $item->status == 'Interested')  selected @endif>Interested</option>
                                                <option value="Not Interested" @if( $item->status == 'Not Interested')  selected @endif>Not Interested</option>
                                                <option value="No Answer" @if( $item->status == 'No Answer')  selected @endif>No Answer</option>
                                                <option value="Lead" @if( $item->status == 'Lead')  selected @endif>Lead</option>
                                                <option value="Not Valid" @if( $item->status == 'Not Valid')  selected @endif>Not Valid</option>
                                            </select> --}}
                                        <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control"
                                            placeholder="add remarks">{{old('remarks')}}</textarea>
                                    </div>

                                </div>

                                <!--  #7-->
                                {{-- <div class="ln_solid"></div> --}}
                                {{-- <div class="form-group"> --}}
                                <div class="col-md-3 col-sm-12 col-xs-12 col-md-offset-3">
                                    <!-- <button type="button" class="btn btn-primary">Can cel</button> -->
                                    {{-- <button class="btn btn-primary" type="reset">Reset</button> --}}
                                    {{-- @if ($item->status != ' ') --}}
                                    {{-- <input type="button" class="btn btn-info" name="Updated" id="btn_{{$i}}"
                                        value="Updated"> --}}
                                    {{-- @else --}}
                                    <input type="submit" class="btn btn-success" name="upload" id="btn_{{$i}}"
                                        onclick="CallLogForm('{{$i}}','call_log_{{$i}}','{{route('elife-log.store')}}')"
                                        value="Update">

                                    {{-- @endif --}}
                                </div>
                                {{-- </div> --}}
                            </div>
                        </form>
                        @endforeach
                        {{ $k->links() }}
                        {{-- <script>
    $('.pagination a').on('click', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#') {
        $('#ajaxContent').load($(this).attr('href'));
    }
});
</script> --}}

                        {{-- @endfor --}}


                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection
