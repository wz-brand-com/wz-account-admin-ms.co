<!DOCTYPE html>

<html lang="en">

 <head>
 	{{-- <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script> --}}
 	{{-- <script src="{{ asset('assets/js1/checking.js')}}"></script> --}}

	 {{-- google font start here  --}}
	 <link rel="preconnect" href="https://fonts.googleapis.com">


	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

     {{-- google font end here  --}}
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

   @include('layouts.backend.partials.head')

 </head>

 <body class="fix-header fix-sidebar card-no-border">
    {{-- <script src="{{asset('new-assets/js/preloader.js')}}"></script> --}}
	<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
		@include('layouts.backend.partials.nav')

		@include('layouts.backend.partials.sidebar')

		<div class="page-wrapper">
		@yield('content')

		</div>

		@include('layouts.backend.partials.footer-scripts')

	</div>

    {{-- new theme start here  --}}
    {{-- <script src="{{asset('new-assets/vendors/js/vendor.bundle.base.js')}}"></script> --}}
    {{-- <script src="{{asset('new-assets/vendors/chartjs/Chart.min.js')}}"></script> --}}
    <script src="{{asset('new-assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('new-assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('new-assets/js/material.js')}}"></script>
    <script src="{{asset('new-assets/js/misc.js')}}"></script>
    <script src="{{asset('new-assets/js/dashboard.js')}}"></script>
    <script src="{{asset('new-assets/vendors/chartjs/Chart.min.js')}}"></script>
    {{-- new theme end here  --}}


 </body>


</html>
