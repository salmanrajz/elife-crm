<input type="hidden" name="checkpending" value="{{route('ajaxRequest.CheckPendingLead')}}" id="CheckPendingLead">
    <!-- Common JS -->
    <script src="{{asset('assets/plugins/common/common.min.js')}}"></script>
    <!-- Custom script -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet">

    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2-init.js')}}"></script>

    <script src="{{asset('js/custom.min.js')}}"></script>
    @notifyJs
    <script src="{{asset('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <script src="{{asset('assets/plugins/bootstrap-mask/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/summernote/dist/summernote.min.js')}}"></script>
    <script src="{{asset('assets/plugins/summernote/dist/summernote-init.js')}}"></script>
        <!-- Toastr -->
    <script src="{{asset('assets/plugins/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/plugins/toastr/js/toastr.init.js')}}"></script>

    <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> --}}
    <script>
  @if(Session::has('message'))
  toastr.options =
  {
    "closeButton" : true,
    "positionClass": "toast-bottom-right",
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>
    <!-- Laravel Javascript Validation -->
    {{-- <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\StoreBlogPostRequest', '#my-form'); !!} --}}

    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('2a65497ef5f1dcb5da95', {
        cluster: 'ap2'
        });
        // alert($("#saler_id").val());
        var channel = pusher.subscribe('my-channel_'+$("#saler_id").val());
        channel.bind('my-event', function(data) {
        // alert(JSON.stringify(data));
        // alert(data[0]);
        var a = JSON.stringify(data);
        var obj = $.parseJSON(a);
        console.log(obj);
        // alert(obj['message']);
        // var p = "Message : " + message + "Lead"
        // alert(obj);
        if(obj['userid'] == $("#userlogged").val()){
            toastr.options = {
                "debug": false,
                "positionClass": "toast-bottom-left",
                "onclick": null,
                "fadeIn": 300,
                "fadeOut": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000
            }
            toastr.info(obj['message']);

        }
        else{
            toastr.options = {
                "debug": false,
                "positionClass": "toast-bottom-left",
                "onclick": null,
                "fadeIn": 300,
                "fadeOut": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000
            }
            toastr.info('Message has been send');
        }
        // alert(obj['0']['1']);

    });


         //Subscribe to the channel we specified in our Laravel Event
    //Subscribe user to the channel created for this user.
    //For example if user's id is 1 then bind to notification-channel_1
    // var channel = pusher.subscribe('notification-channel_'+$('#logged_in_userId').val());

    // //Bind a function to a Event (the full Laravel class)
    // channel.bind('App\\Events\\HelloPusherEvent', addMessage);

    </script>
@role('Activation|Elife Active|SpecialActivation')
<script>
      // Note: This example requires that you consent to locationloading_num sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            $("#lat").val(position.coords.latitude);
            $("#lng").val(position.coords.longitude);
            // alert(position.coords.latitude);
            // alert(position.coords.longitude);

            // infoWindow.setPosition(pos);
            // infoWindow.setContent('Location found.');
            // infoWindow.open(map);
            // map.setCenter(pos);
              ActivateLeadById(position.coords.latitude,position.coords.longitude,'{{route('ajaxRequest.NumberActivation')}}');
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
        ActivateLeadById(position.coords.latitude,position.coords.longitude,'{{route('ajaxRequest.NumberActivation')}}');
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        // alert("Please allow location for fetching leads");
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'please allow locaiton for fetching leads!',
            footer: '<a href="https://bit.ly/3cK3YYE"> how to allow location?</a>'
            });
            infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
     function ActivateLeadById(lat,lng,url){
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                lat: lat,
                lng: lng,
            },
             beforeSend: function () {
            $("#loading_num").show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
        },
            success: function (data) {
                // alert(data);
            $("#loading_num").hide();
                $("#broom").html(data);
            }
        });
    }
    </script>

    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUr9WNseZIZbaPQq4lfewpxaGEjRGM8gk&callback=initMap">
    </script>
    {{-- <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
<script>
  const beamsClient = new PusherPushNotifications.Client({
    instanceId: '584366d6-8260-434c-8dbd-12afc1def27b',
  });

  beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => console.log('Successfully registered and subscribed!'))
    .catch(console.error);
</script> --}}
    {{-- <script>
        $(document).ready(function(){
    $('#customer_number').mask('999-9999999');
});
    </script> --}}

@endrole
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUr9WNseZIZbaPQq4lfewpxaGEjRGM8gk&libraries=places‌​&sensor=false"></scr‌​ipt> --}}
{{-- script:sr --}}
 {{-- <script --}}
    {{-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUr9WNseZIZbaPQq4lfewpxaGEjRGM8gk&libraries=places‌​&sensor=false"> --}}
    {{-- </script> --}}
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUr9WNseZIZbaPQq4lfewpxaGEjRGM8gk&libraries=places">
</script>
 <script>
function initMap2() {
            // alert("S");
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: -33.8688,
      lng: 151.2195
    },
    zoom: 13
  });
//   var input = /** @type {!HTMLInputElement} */ (
//     document.getElementById('pac-input'));
//   var input = $("#pac-input").val();
  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('search_location'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(document.getElementById('pac-input'));
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    //
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    var long = place.geometry.location.lng();
    $("#add_lat_lng").val(lat + ',' +long);
    // parseFloat($('#lat').val(lat));
    // parseFloat($('#lng').val(long));
                    // initialize(lat, long);
                    // codeLatLng(lat, long);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);
}

initMap2();

    </script>
