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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Agency</a>
                            </li>
                            <li class="breadcrumb-item active">All Agency</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Agency</h4>
                            <button class="btn btn-success" data-toggle="modal" data-target="#MyModal">Add Amount</button>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Amount</th>
                                                <th>Agency ID</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)

                                            <tr>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->agency_id}}</td>
                                                <td>{{$item->user_id}}</td>
                                                <td>
                                                {{-- <a href="{{route('user.edit',$item->id)}}">
                                                <i class="fa fa-edit"></i>
                                                </a> --}}
                                                <a href="{{route('agency.destroy',$item->id)}}" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="fa fa-recycle"></i>
                                                </a>
                                                <a href="{{route('agency.edit',$item->id)}}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="{{route('AgencyBilling',$item->id)}}">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                    {{--  --}}
                                    <!-- Modal -->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="MyModalCenter">Topup</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <form  id="FormID">
            @inject('HomeCount', 'App\Http\Controllers\MainController')

            <div class="form-group row">
                <h3>Available Balance:
                                {{$HomeCount::MyAvailableBalance()}}
                </h3>
                <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12">Amount</label>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <input class="form-control has-feedback-left" id="inputSuccess3" name="amount"
                        placeholder="Type Agent Name Here" type="number" value="" autocomplete="off">
                        <input type="hidden" name="agency_id" value="{{$agency_id}}">
                    {{-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> --}}
                </div>
                <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>

            </div>
        </div>
      </div>
      <div class="modal-footer">
            <button class="btn btn-success" type="button" name="submit" onclick="VerifyLead('{{route('BillingAmountAdd')}}','FormID','{{route('AgencyBilling',$agency_id)}}')">Proceed</button>
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </form>

      </div>
    </div>
  </div>
</div>

                                    {{--  --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #/ container -->
        </div>
        @endsection
        {{-- @@section('name') --}}

        {{-- @endsection --}}
