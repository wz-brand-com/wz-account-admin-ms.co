@extends('layouts.frontend.mainlayout')
@section('title', 'Register')
@push('css') 
<style>
  .lfts{
    text-align: center;
  }
</style>
@endpush
@section('content')
<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url('{{asset('/img/login-register.jpg')}}');">
            <div class="container">
                <div class="row">
                  <div style="margin-left: 245px">
                    <br><br><br><div class="card shadow ">
                      <div class="card-header"style="color:red;">
                        <b class="fa fa-ban" style="font-size: 19px">&nbsp;&nbsp; Account Blocked</b>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title" style="color:blue;">Hi, {{ Auth::user()->name }}</h5>
                        <p class="card-text display-7">Your account has been blocked please contact to <b>Site Admin</b> for further Access</p>
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
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
@endsection
@push('js')
@endpush