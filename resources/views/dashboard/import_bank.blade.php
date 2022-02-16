<!DOCTYPE html>
<html>
 <head>
  <title>Import Excel File in CRM SOFTWARE</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
{{--
  <div class="container">
   <h3 align="center">Import Excel File in CRM SOFTWARE</h3>
    <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif --}}

   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif



   <br />

   {{--  --}}
   <div id="assigner_block">

        <form class="form-horizontal form-label-left input_mask" method="post" id="assigner"
            enctype="multipart/form-data">

            {{-- <form action="{{route('bulk.assigner')}}" method="post"> --}}
            {{-- @csrf --}}
            {{ csrf_field() }}

            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <label for="number">Total Number ({{$NumberCount}}) | Selected Number: <span
                                id="selected_number" style="color:red">0</span></label>
                        <select name="number[]" id="number" class="form-control" multiple style="height:500px;">
                            @foreach ($b as $item)
                            <option value="{{$item->id}}">{{$item->mobile}} - {{$item->name}} - {{$item->building}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user">Users</label>
                            <select name="user" id="user" class="form-control">
                                @foreach ($u as $s)
                                <option value="{{$s->id}}">{{$s->name . '-' .$s->agent_code . '-' . $s->email}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="button" value="Assign Number"
                                onclick="BulkAssigner('{{route('bulk.assigner.users')}}','assigner')" class="btn btn-info">
                        </div>
                        <div class="form-group">
                            <h3 class="text-center" id="loading_num" style="display:none">
                                Please wait while assigning numbers...
                                <img src="{{asset('assets/images/loader.gif')}}" alt="Loading"
                                    class="img-fluid text-center offset-md-6">
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
   {{--  --}}
  </div>
 </body>
</html>
<x-footer></x-footer>
