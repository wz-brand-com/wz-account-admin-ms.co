<!DOCTYPE html>

<html lang="en">

 <head>
 	<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>

   @include('blockdashboard_layouts.backend.partials.head')

 </head>

 <body class="fix-header fix-sidebar card-no-border">

	<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
		@include('blockdashboard_layouts.backend.partials.nav')

		@include('blockdashboard_layouts.backend.partials.sidebar')
		
		<div class="page-wrapper">
		@yield('content')

		</div>

		@include('blockdashboard_layouts.backend.partials.footer-scripts')

	</div>

 </body>

</html>