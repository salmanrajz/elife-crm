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
                             <form class="form-horizontal form-label-left input_mask" method="post"
                                autocomplete="off" id="call_log_{{$i}}" onsubmit="return false">
                            @csrf
                            <div class="form-group row">


                                <div class="col-md-3 col-sm-4 col-xs-12 form-group has-feedback">
                                    <input class="form-control " placeholder="Customer Number i.e 0551234567" name="number"
                                maxlength="10" required type="tel"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                onkeypress="return isNumberKey(event)" id="number"
                                value="{{$item->mobile}}" />
                                </div>
                                <input type="hidden" name="userid" value="{{$item->id}}">
                                <input type="hidden" name="uid" value="{{$item->uid}}">
                                    {{-- <div class="col-md-3"  id="remarks"> --}}


                                    {{-- <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" onchange="change_feedback('{{$i}}')">
                                    <select name="remarks" id="remarks_call_log_{{$i}}" class="form-control" required>
                                                <option value="Using Corporate Plan">Using Corporate Plan</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div> --}}

                                    {{-- </div> --}}
                                    <div class=" col-md-6" >

                                        {{-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">
                                            Remarks</label> --}}
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                            <select name="status" id="remarks_call_log_{{$i}}" class="form-control" onchange="change_feedback('{{$i}}')">
                                                <option value="No Answer" selected>No Answer</option>
                                                <option value="Not Interested" >Not Interested</option>
                                                <option value="Follow Up" >Follow Up</option>
                                                <option value="other" >Other</option>
                                            </select>
                                        <textarea name="remarks" id="remarks_{{$i}}" cols="30" rows="10" class="form-control" placeholder="add remarks" style="display:none;">{{old('remarks')}}</textarea>
                                        {{-- <input type="date" name="follow_date" id="follow_date_{{$i}}" style="display: none" class="form-control"> --}}
                                        </div>

                                    </div>

                                    <!--  #7-->
                                    {{-- <div class="ln_solid"></div> --}}
                                    {{-- <div class="form-group"> --}}
                                    <div class="col-md-3 col-sm-12 col-xs-12 col-md-offset-3">
                                    <!-- <button type="button" class="btn btn-primary">Can cel</button> -->
                                    {{-- <button class="btn btn-primary" type="reset">Reset</button> --}}
                                    @if ($item->status != '')
                                    <input type="button" class="btn btn-info" name="Updated" id="btn_{{$i}}"  value="Updated">
                                    @else
                                    <input type="submit" class="btn btn-success" name="upload" id="btn_{{$i}}" onclick="CallLogForm('{{$i}}','call_log_{{$i}}','{{route('elife-datauploader-bank')}}')" value="Update">
                                    <button class="btn btn-info"
                                    onclick="CallLogFormLead('{{$i}}','call_log_{{$i}}','{{route('elife-lead-bank')}}','{{route('partner.show','Elife-Telesales')}}')"
                                    {{-- onclick="window.location.href='{{route('partner.show','Elife-Telesales')}}'" --}}
                                    >Lead</button>

                                    @endif
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
