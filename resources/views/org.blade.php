@extends('layouts.frontend.mainlayout')
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

@section('title', 'Account Activated')
<style>
    
    .amt{
      margin-top: 93px;
      padding-bottom: 223px;
      text-align: center;
    }
    
    .activate{
      font-size: 22px;
      font-weight: 300%;
    }
    
.fo{
    font-family: 'Merriweather', serif;
    font-size: 23px;
    }
    


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
            <div class="col-lg-7 amt" style="margin-left: 310px">
                <div class="card-body">
                <div class="card">
                    <p class="activate fo mt-3"><i class="fa fa-check-circle" aria-hidden="true" style="font-size: 15p; color: green;"></i>
                        Thanks! your account has been activated successfully.<br>please continue to 
                    <a class="btn btn-primary button3" href="https://www.wizbrand.com/login" target="_blank" role="button">Login</a> </p>
            
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