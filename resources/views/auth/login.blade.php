@extends('page-layouts.index')
@section('content')

<div class="jumbotron1 jumbotron-fluid">
    <div class="container">
        <div class="row login_card">
            <!-- login panel open -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <!--***************************************  login panel open  ***************************************** -->
                <aside class="col-md-12 login_form_card">
                    <!-- header image of wizbrand open -->
                    <h4 class="text-white mt-2 text-center">Login Form</h4>
                    <div class="d-flex justify-content-center">
                        <!-- <div class="login_logo_container">
                                <img src="assets/images/wizbrand-logo.png" width="50px;" class="login_logo" alt="Logo"> </div>
                            </div> -->

                        <!-- header image of wizbrand close -->
                        <!-- login  input open -->
                        <div class="d-flex justify-content-center shadow">
                            <form method="POST" action="{{ route('login') }}">
                                {!! @csrf_field() !!}
                                <div id="msgcont" class="d-flex justify-content-center"
                                    style="display:none!important">
                                    <div id="msg" class="alert alert-danger py-1 px-2" role="alert"></div>
                                </div>
                                <div
                                    class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="input-group mb-3 mt-3">
                                        <div class="input-group-append"> <span class="input-group-text"><i
                                                    class="fa fa-user-o" aria-hidden="true"></i></span> </div>
                                        <input id="email" class="form-control" type="email" name="email"
                                            placeholder="Email" value="{{ old('email') }}"
                                            autocomplete="email" autofocus>
                                    </div>
                                    @if($errors->has('email'))
                                        <p>
                                            <span class="tst4">{{ $errors->first('email') }}</span>
                                        </p>
                                    @endif
                                </div>
                                <div
                                    class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="input-group mb-4">
                                        <div class="input-group-append"> <span class="input-group-text"><i
                                                    class="fa fa-key" aria-hidden="true"></i></span> </div>
                                        <input class="form-control" type="password" placeholder="Password"
                                            name="password" autocomplete="current-password">
                                    </div>
                                    @if($errors->has('password'))
                                        <p>
                                            <span class="tst4">
                                                {{ $errors->first('password') }}
                                            </span></p>
                                    @endif
                                </div>
                                <!-- for custome validation C:\xampp\htdocs\dmin\vendor\laravel\framework\src\Illuminate\Foundation\Auth\AuthenticatesUsers.php -->

                                <div
                                    class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                    {!! app('captcha')->display() !!}

                                    @if($errors->has('g-recaptcha-response'))
                                        <p>
                                            <span class="help-block tst4">{{ $errors->first('g-recaptcha-response') }}</span>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-center login_container">
                                        <button type="submit" name="button"
                                            class="jumbo_btn1 btn btn-primary login_btn">Login</button><br>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-center  login_container">
                                        <a href="{{ route('password.request') }}" target="_blank"
                                            id="to-recover" class="text-white pull-right"><i
                                                class="fa fa-lock m-r-5"></i><b> Forgot password</b></a>
                                    </div>
                                </div>
                                <br><br><br>
                            </form>
                        </div>
                        <!-- login  input close -->
                </aside>
                <!--***************************************  login panel close ***************************************** -->
            </div>
            <!-- login panel close -->
            <!-- slider open -->
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <!-- ======================================= slider open content ======================= -->
                <aside class="col-md-12">
                    <!-- ================== 1-carousel bootstrap  ==================  -->
                    <div id="carousel1_indicator" class="carousel slide border border-white shadow"
                        data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel1_indicator" data-slide-to="1"></li>
                            <li data-target="#carousel1_indicator" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" height="415px;"
                                    src="assets/images/wizbrand-project-management-sotware.png" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" height="415px;"
                                    src="assets/images/wizbrand-marketing-toolkits.png" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" height="415px;"
                                    src="assets/images/wizbrand-sotware-management.png" alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" height="415px;"
                                    src="assets/images/wizbrand-case-study.png" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel1_indicator" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel1_indicator" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!-- ==================  1-carousel bootstrap ==================  .// -->
                </aside>
                <!-- ======================================= slider close content ======================= -->
            </div>
            <!-- slider open -->
        </div>
    </div>
</div>

<!-- 2nd step start here  -->
@endsection
