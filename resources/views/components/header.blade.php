    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dialup IT Services') }}</title>

        <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logo.png')}}">
    <!-- Custom Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-mask/jasny-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">

    <link href="{{asset('assets/plugins/summernote/dist/summernote.css')}}" rel="stylesheet">

    <script src="{{asset('js/modernizr-3.6.0.min.js')}}"></script>
    <link href="{{asset('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <input type="hidden" name="userlogged" id="userlogged" value="{{isset(Auth()->user()->id) ? Auth()->user()->id : ""}}">
    @role('sale')
    {{-- I am a writer! --}}

    <input type="hidden" name="saler_id" id="saler_id" value={{auth()->user()->id}}>
    @else
        {{-- I am not a writer... --}}
    @endrole


    @notifyCss
    <x:notify-messages />

