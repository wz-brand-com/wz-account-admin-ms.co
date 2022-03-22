<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- admin css start here  --}}
    <link rel="stylesheet" href="{{asset('new-assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('new-assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('new-assets/css/demo/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('new-assets/images/favicon.png')}}" />
    
    {{-- admin css end here  --}}


    <title>WizBrand Account Admin Dashboard</title>
  </head>
  <body>
    <script src="{{asset('new-assets/js/preloader.js')}}"></script>
    
    
    @include('layout.head')
    {{-- @include('layout.sidebar') --}}
    @include('layout.sidebar')
    
    {{-- @include('layout.nav') --}}
    {{-- @include('layout.dashboard') --}}
    @yield('content')

    @include('layout.footer')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    {{-- admin script start here  --}}
    <script src="{{asset('new-assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('new-assets/vendors/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('new-assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('new-assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('new-assets/js/material.js')}}"></script>
    <script src="{{asset('new-assets/js/misc.js')}}"></script>
    <script src="{{asset('new-assets/js/dashboard.js')}}"></script>
    {{-- admin script end here  --}}

  </body>
</html>