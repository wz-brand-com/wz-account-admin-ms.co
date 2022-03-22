@extends('layouts.frontend.mainlayout')
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

@section('title', 'Account Activated')
<style>
    .amt {
        margin-top: 93px;
        padding-bottom: 223px;
        text-align: center;
    }

    .activate {
        font-size: 22px;
        font-weight: 300%;
    }

    .fo {
        font-family: 'Merriweather', serif;
        font-size: 23px;
    }

    /* .card{
        background: linear-gradient(to right, #373b44, #4286f4);
        color: whitesmoke;
    } */

</style>
@push('css')

@endpush

@section('content')
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
    <div class="login-register" style="background-image:url('{{asset('/img/login-register.jpg')}}');">
        <!-- Button trigger modal -->
        <div class="col-lg-8 amt" style="margin-left: 193px;">
            <div class="card-body">
                <div class="card"><br>
                    <p class="activate fo"><i class="fa fa-envelope-o" aria-hidden="true"
                            style="font-size: 12px; color: green;"></i>
                        You're already assigned organization so, please check your email<br>and verify the account.
                        <a class="btn btn-primary" href="https://wizbrand.com/" target="_blank"
                            role="button">&nbsp;&nbsp;Back to Home&nbsp;
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- amit start here  -->
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

@endsection

@push('js')

@endpush