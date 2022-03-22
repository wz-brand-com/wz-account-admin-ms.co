<!DOCTYPE html>

<html lang="en">

 <head>
 	<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

   @include('layouts.backend.partials.head')

 </head>

 <body class="fix-header fix-sidebar card-no-border">

	
    <div id="main-wrapper">
		@include('layouts.backend.partials.nav')

		@include('layouts.backend.partials.sidebar')
		
		<div class="page-wrapper">
		@yield('content')

		</div>

		@include('layouts.backend.partials.footer-scripts')

	</div>

 </body>

</html>