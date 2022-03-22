<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@500&display=swap" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style-home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style_1.css')}}">
    <title>WizBrand Online Digital Marketing Software</title>
</head>
<style>
    .btn-sizes {
        height: 50px;
        background-color: black;
        padding: 10px 8px;
    }

</style>

<body>
    <!-- -- navbar start here  -- -->
    <nav class="navbar navbar-expand-lg navbar" style="background-color: #0b1320;">
        <div class="container-fluid">
            <a href="/"><img class="logos" src="assets/images/wiz.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="assets/images/toggle.png" alt="">
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="navbar-nav topnav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('organzations.list.all') }}">Organizations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('user-profile') }}">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('about')}}">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="https://www.wizbrand.com/tutorials/"
                            target="_blank">Tutorials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="https://www.wizbrand.com/tools/">Tools</a>
                     </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('service')}}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/register')}}">Register</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link active" href="{{ url('/login')}}">Login</a>
                    </li>
    
                </ul>
            </div>
        </div>
    </nav>
    <!-- {{-- navbar start close --}} -->
    {{-- 2nd login form start here --}}

    <div class="loginFlow">
        <div class="loginPage">
            <div class="content">
                <div class="wrapper">
                    <div class="row">
                        <div>
                            <div class="info-wrapper col s6 card border-warning">
                                <div class="row">
                                    <div class="col s12"><strong class="hdn">About Account Admin?</strong></div>
                                </div>
                                <div class="info-list">
                                    <div class="row">
                                        <div class="col s12"><em class="icon"></em><i class="fas fa-check-circle"
                                                style="color: green">&nbsp;&nbsp;</i><span class="text">Admin can create an organization and have full access</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12"><em class="icon"></em><i class="fas fa-check-circle"
                                                style="color: green">&nbsp;&nbsp;</i><span class="text">Invite to member as role like Admin, Manger or User</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12"><em class="icon"></em><i class="fas fa-check-circle"
                                                style="color: green">&nbsp;&nbsp;</i><span class="text">Admin has access to remove and block any organization.</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12"><em class="icon"></em><i class="fas fa-check-circle"
                                                style="color: green">&nbsp;&nbsp;</i><span class="text">Admin can assign task to Admin, Manger or User.</span></div>
                                    </div>
                                </div>
                                <div class="action row">

                                </div>
                                <div class="action row">
                                    <div class="col s12">
                                         <!-- slider start  -->
                                         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                            </ol>
                                            <div class="carousel-inner">
                                              <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{ asset('assets/images/wizbrand-register-slider-1.png')}}" alt="First slide">
                                              </div>
                                              <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ asset('assets/images/wizbrand-register-slider-2.png')}}" alt="Second slide">
                                              </div>
                                              <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ asset('assets/images/wizbrand-register-slider-3.png')}}" alt="Third slide">
                                              </div>
                                              <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ asset('assets/images/wizbrand-register-slider-4.png')}}" alt="Third slide">
                                              </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                              <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                              <span class="sr-only">Next</span>
                                            </a>
                                          </div>

                                    </div>
                                </div>
                            </div>
                            <div class="login-wrapper col s6 card">
                                <div class="gutter">
                                    <form action="{{ url('/register') }}" name="contactForm" method="POST" id="" name=""
                                            class="" novalidate="novalidate">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h4 class="box-title m-b-20">Register as <span class="text-primary"> Account Admin </span>
                                                        </h4><br>
                                                            <label class="label" for="email">Enter your Name</label>
                                                            <input id="name" type="text" class="form-control" name="name"
                                                            value="{{ old('name') }}" placeholder="Enter Your Name" required
                                                            autofocus>

                                                        @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="label" for="email">Email Address</label>
                                                        <input id="email" class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                                                        @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- {{-- google captcha start here  --}} -->
                                                 <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                    {!! app('captcha')->display() !!}

                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="help-block">
                                                            <strong class="tst4 btn btn-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                <!-- {{-- google capthca end here  --}} -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="submit" value="Register"
                                                            class="btn btn-primary">
                                                        <div class="submitting"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2nd login form end here --}}
    <br><br>















    <!-- footer start here  -->
    <footer class="section bg-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="">
                        <h6 class=" footer-heading text-uppercase text-white"
                            style="border-bottom: 1px solid; width: 120px;">
                            Register&nbsp;Here
                        </h6>
                        <ul class="list-unstyled footer-link mt-4">
                            <li>
                                <badge class="badge footer_focus_style"><a href="https://www.wizbrand.com/register"
                                        target="_blank">Regitser</a></badge>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="">
                        <h6 class=" footer-heading text-uppercase text-white"
                            style="border-bottom: 1px solid; width: 111px;">
                            SEO Tools:
                        </h6>
                        <ul class="list-unstyled footer-link mt-2">
                            <li>
                                <a href="">Google Analytics</a>
                            </li>
                            <li>
                                <a href="">Backlink Checker</a>
                            </li>
                            <li>
                                <a href="">Page Speed Test</a>
                            </li>
                            <li>
                                <a href="">Website Hit Counter</a>
                            </li>
                            <li>
                                <a href="#" target="_blank">Adsense Calculator</a>
                            </li>

                            <li>
                                <a href="#" target="_blank">Ads Keyword Planner</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="">
                        <h6 class=" footer-heading text-uppercase text-white"
                            style="border-bottom: 1px solid; width: 160px;">
                            About&nbsp;Company:
                        </h6>
                        <ul class="list-unstyled footer-link mt-2">
                            <li>
                                <a href="{{route('about')}}">About Us</a>
                            </li>
                            <li>
                                <a href="https://www.wizbrand.com/tutorials/">Blog</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('gallery')}}">Gallery</a>
                            </li>
                            <li>
                                <a href="{{ route('service')}}">Services</a>
                            </li>
                            <li>
                                <a href="{{ route('contact-form')}}">Contact us</a>
                            </li>
                            <li>
                                <a href="">Support</a>
                            </li>
                            <li>
                                <a href="">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="">Select your country</a>
                            </li>
                            <div class="d-flex footer_flag_main">
                                <a href="https://www.wizbrand.com/">
                                    <div class="cat_new_footer_flag india_flag" title="india_flag" alt="india_flag">
                                    </div>
                                </a>
                                <a href="https://www.wizbrand.com/">
                                    <div class="cat_new_footer_flag us_flag" title="us_flag" alt="us_flag"></div>
                                </a>
                                <a href="https://www.wizbrand.com/">
                                    <div class="cat_new_footer_flag gcc_flag" title="gcc_flag" alt="gcc_flag"></div>
                                </a>
                                <a href="https://www.wizbrand.com/" rel="noopener" target="_blank">
                                    <div class="cat_new_footer_flag uk_flag" title="uk_flag" alt="uk_flag"></div>
                                </a>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ml-5">
                        <h6 class="footer-heading text-uppercase text-white"
                            style="border-bottom: 1px solid; width: 211px;">
                            Get&nbsp;In&nbsp;Touch&nbsp;With&nbsp;Us:
                        </h6>
                        <a href="https://www.wizbrand.com/" class="mt-4 text-white">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            www.wizbrand.com
                        </a>
                        <p class="text-white">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            contact@wizbrand.com
                        </p>
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/wizbrandOffer" target="_blank">
                                        <i class="fa fa-facebook-square" style="color: #3b5998; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/WizBrandIndia" target="_blank">
                                        <i class="fa fa-twitter-square" style="color: #1DA1F2; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.linkedin.com/company/wizbrand/" target="_blank">
                                        <i class="fa fa-linkedin-square" style="color: #0077b5; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.instagram.com/wizbrand.india/" target="_blank">
                                        <i class="fa fa-instagram" style="color: #8a3ab9; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.youtube.com/channel/UCLvVLngJC7pse7Jx3V2m7Fg" target="_blank">
                                        <i class="fa fa-youtube" style="color: #FF0000; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <div class="container-fluid bg-dark">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright_footer">
                    <p class="text-center text-white mt-2">
                        Copyright © 2021 WizBrand All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">

    </script>
    <script>
        $(function () {
            $("form[name='contactForm']").validate({
                // Define validation rules
                rules: {
                    name: "required",
                    email: "required",

                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },

                },
                // Specify validation error messages
                messages: {
                    name: "Please provide a valid name.",
                    email: {
                        required: "Please enter your email",
                        minlength: "Please enter a valid email address"
                    },

                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
</body>

</html>
