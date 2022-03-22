<!DOCTYPE html>

<html lang="en">

 <head>

   @include('blockdashboard_layouts.frontend.partials.head')

 </head>

 <body class="fix-header fix-sidebar card-no-border">

	<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
		

		
		@yield('content')

		@include('blockdashboard_layouts.frontend.partials.footer-scripts')

</div>

 </body>

</html>