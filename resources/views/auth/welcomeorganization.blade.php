@extends('layouts.frontend.mainlayout')

@section('title','LogIn Page')

@push('css')

@endpush
@section('content')

<style>
    .blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color:rgb(252, 39, 1);   }
    49%{    color: rgb(252, 39, 1)  }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color:rgb(252, 39, 1)     }
}
</style>
        
<section id="wrapper">
        <div class="login-register" style="background-image:url('{{asset('/img/login-register.jpg')}}');">
            <div class="login-box card shadow">
                <div class="card-body">
                <span> <h2 class="text-center text-danger"> Thanks for Connecting with us  </h2> </span>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-block text-uppercase waves-effect waves-light"><a href="http://www.wizbrand.com/login" class="text-white">Log In  </a></button>
                            </div>
                        </div>
                   
                </div>
            </div>
        </div>
    </section>

@endsection
