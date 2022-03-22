@extends('layouts.frontend.mainlayout')

@section('title', 'email verification')

@push('css') 

@endpush

@section('content')
<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url('{{asset('/img/login-register.jpg')}}');">        
            <div class="login-box card">
            <div class="card-body">
            	@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <form class="form-horizontal form-material" method="POST" action="{{ route('password.email') }}">
                	{{ csrf_field() }}
                    <h3 class="box-title m-b-20">Recover Email</h3>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">    
                      <div class="col-xs-12">
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required="" placeholder="Email">

                       			@if ($errors->has('email'))
                                    <span class="tst4 btn btn-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                      </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Email verification</button>
                      </div>
                    </div>
                  </form>
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