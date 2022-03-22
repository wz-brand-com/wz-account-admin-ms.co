
<link href="{{ asset('assets/cdn/bootstrap-cdn/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/cdn/ajax-cdn/popper.min.js') }}" rel="stylesheet">
 <link href="{{ asset('assets/cdn/ajax-cdn/popper.min.js') }}" rel="stylesheet">
 <link href="{{ asset('assets/assets/cdn/bootstrap-cdn/bootstrap.min.js') }}" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  .mystylepic{
    background-image: url("/assets/images/background/login-register.jpg");
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    } 


 li{
     text-decoration:none;
     list-style-type:none; 
 }

 .text_u:hover{
    text-decoration:none;
     list-style-type:none; 
     color:white;
 }
 .fontsize{
    font-family: Arial, Helvetica, sans-serif;
 } 
 .text-white:hover{
     text-decoration:none;
 } 

 
 @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,700;1,400&display=swap');

 /* font-family: 'Libre Baskerville', serif; */

 h2{
    font-family: 'Libre Baskerville', serif;
    text-align: center;
    font-size: bold;
 }

 </style>          

<div class="container-fluid mystylepic">
    <div class="row" >
        <div class="col-3"></div>
        <div class="col-6">
        
        <!-- card open -->
        <div class="card shadow bg-text" style="margin-top: 54px">
            <!-- <div class="card-header text-danger">
              <h5> Empty Organization</h5>
            </div>  -->

            <div class="card-body">
                
              <div class="login-box card shadow">
                <div class="card-body">
                <span> <h2 class="font-family: 'Libre Baskerville', serif;" class="text-center text-primary fontsize">
                    <!-- You have been removed from this organization Please contact an administrator for further access. -->
                    You don't have Organization 
                  </h2> <hr></span> 
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-6">
                                <button class="btn btn-info "><a href="{{ route('orgspages')}}" class="text-white">Create Organization  </a></button>
                                
                                <!-- footer open -->
                 <button class="btn btn-danger">
                <a class="waves-effect text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             {!! @csrf_field() !!}
                </form>
                <!-- footer clsoe --> 
                            
                            </div>
                        </div>
                   
                </div>
            </div>
                
               <!-- content close -->
            </div>
            
            
           
           
        </div>
        <!-- card close -->
        </div>
        <div class="col-3"></div>
    </div>
</div>