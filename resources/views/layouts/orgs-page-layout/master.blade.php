<!DOCTYPE html>

<html lang="en">

 <head>
 	<!-- plugins:css -->
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
	 
	 

	 
   

 </head>

 

 <body>
 <script src="{{asset('new-assets/js/preloader.js')}}"></script>

	<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
		
		@include('layout.head')

		@include('layout.sidebar')
		
		
		@yield('content')

		

		@include('layout.footer')

	</div>

	  <script src="{{asset('new-assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('new-assets/vendors/chartjs/Chart.min.js')}}"></script>
  <script src="{{asset('new-assets/vendors/jvectormap/jquery-jvectormap.min.js)}}"></script>
  <script src="{{asset('new-assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('new-assets/js/material.js')}}"></script>
  <script src="{{asset('new-assets/js/misc.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('new-assets/js/dashboard.js')}}"></script>
  <!-- End custom js for this page-->

 </body>


</html>