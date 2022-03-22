@extends('blockdashboard_layouts.backend.mainlayout')

@section('title','Block Dashboard')

@section('content')


  <div class="container">
      <div class="row">
          <div class="col-1"></div>
          <div class="col-10"> <script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>

<!-- mosue desable open -->

<!-- mosue desable close -->
<!-- model open -->

<div id="myModal" class="modal modal-fixed-footer">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">



      <!-- card open -->
      <div class="card shadow">
  <div class="card-header"style="color:red;">
    <b class="fa fa-ban">&nbsp;&nbsp; Account Blocked</b>
  </div>
  <div class="card-body">
    <h5 class="card-title" style="color:blue;">Hi, {{ Auth::user()->name }}</h5>
    <p class="card-text display-7">Your account has been blocked please contact to site admin for further Access</p>
    <a href="{{ route('logout') }}" class="btn btn-outline-danger float-right"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
  </div>
</div>
      <!-- card close -->


        </div>
    </div>
</div>
<!-- model close -->


 </div>
          <div class="col-1"></div>
      </div>
  </div>
@endsection
