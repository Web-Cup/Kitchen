@extends('layouts/masterLayout')


@section('title', 'Order Status')

@section('vendor-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
    <!-- END: Vendor CSS-->
@endsection
@section('page-style')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/app-ecommerce-shop.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/plugins/forms/wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
    <!-- END: Page CSS-->

        <link href="{{ asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<style>

    #map {
    height: 100%;
    }
    html,
    body {
    height: 100%;
    margin: 0;
    padding: 0;
    }
</style>
 <!-- BEGIN: Content-->
<meta name="csrf-token" content="{!! csrf_token() !!}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>

    <div class="app-content content" style="background: white;">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
        <input type="hidden" name="nextlongitude" id="nextlongitude" value="{{$nextlongitude}}" class="form-control">
        <input type="hidden" name="nextlatitude" id="nextlatitude" value="{{$nextlatitude}}" class="form-control">
        <input type="hidden" name="latitude" id="latitude" value="{{$latitude}}" class="form-control">

            <div class="content-body">
                <div id="map" style="width: 100%; height:400px;"></div>
                <div class="row" style="margin: 30px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-4" style="text-align: center;">
                        <h1>
                            Order Placed Successfully
                        </h1>
                        <h4>
                            Waiting to the restaurant to confirm your order
                        </h4>
                    </div>
                    <div class="col-md-4"></div>
                </div>

            </div>
        </div>
    </div>
    <!-- <div id="map" style="width: 100%; height:400px;"></div> -->

@endsection

@section('vendor-script')
        <!-- Vendor js files -->
         <script src="{{ asset('public/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
        <script src="{{ asset('public/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
        <script src="{{ asset('public/vendors/js/extensions/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/extensions/toastr.min.js') }}"></script>

@endsection

@section('page-script')                
        <!-- Select2 library -->
            <script src="{{ asset('public/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
        <!-- Page js files -->
        <script src="{{ asset('public/js/scripts/pages/app-ecommerce-shop.js') }}"></script>
        <!-- BEGIN: Page JS-->
            <script src="{{ asset('public/app-assets/js/scripts/pages/app-ecommerce-shop.js') }}"></script>
        <!-- END: Page JS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyBRbDjAmZEqpIUg9LJclblxdrFwGD7dNcw&amp;libraries=places" type="text/javascript"></script>
        <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyDxTV3a6oL6vAaRookXxpiJhynuUpSccjY&amp;libraries=places&amp;callback=initialize" type="text/javascript"></script> -->
 <script>
     "use strict";
     let map;
     function initialize() {
        var latitude = $('#nextlatitude').val();
        var longitude = $('#nextlongitude').val();

         var input = document.getElementById('checkout-city');
         var autocomplete = new google.maps.places.Autocomplete(input);
         autocomplete.addListener('place_changed', function() {
             var place = autocomplete.getPlace();
             $('#latitude').val(place.geometry['location'].lat());
             $('#longitude').val(place.geometry['location'].lng());
         });
         map = new google.maps.Map(document.getElementById("map"), {
          center: {
            lat:  parseFloat(latitude),
            lng: parseFloat(longitude)
          },
          zoom: 8
        });
        const marker = new google.maps.Marker({
            map: map,
            position: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
        });
        marker.setVisible();
     }
     google.maps.event.addDomListener(window, 'load', initialize);

  </script>

@endsection
   