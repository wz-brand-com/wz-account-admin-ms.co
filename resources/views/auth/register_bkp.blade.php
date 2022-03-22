@extends('layouts.frontend.mainlayout')

@section('title', 'Register')

@push('css') 

@endpush

@section('content')
<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url('{{asset('/img/login-register.jpg')}}');">
            <div class="login-box card shadow">
                <div class="card-body">
                    <form class="form-horizontal form-material" method="POST" action="{{ route('register') }}" id="form">
                       {!! @csrf_field() !!} 
                        <h3 class="box-title m-b-20">Register as <span class="text-primary"> Account Admin </span>
                       </h3>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('name') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                
                                <input id="email" class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}"  autocomplete="email" autofocus> 
                               
                               @if ($errors->has('email'))
                                    <span class="tst4 btn btn-danger">
                                        <span>{{ $errors->first('email') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" type="password"  id="password_user" placeholder="Password" name="password" autocomplete="current-password"> 
                                
                            </div>
                           
                            @if ($errors->has('password'))
                                    <span class="tst4 btn btn-danger">
                                        <span class="text-left col-sm">{{ $errors->first('password') }}</span>
                                    </span>
                            @endif
                        </div>

                        
                        
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="password-confirm" type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                            <span id='message' ></span>
                        </div>
                       
                       

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info  btn-block text-uppercase waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                            </div>
                        </div>
                        

                    
                    </form>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-block text-uppercase waves-effect waves-light"><a href="http://www.wizbrand.com" class="text-white">Back to home </a></button>
                            </div>
                        </div>
                    <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
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