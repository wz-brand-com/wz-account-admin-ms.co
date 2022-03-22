@section('title','Blocked Organization')
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
 </style>          

<div class="container-fluid mystylepic">
    <div class="row" >
        <div class="col-3"></div>
        <div class="col-6">
        
        <!-- card open -->
        <div class="card shadow bg-text">
            <div class="card-header">
              <h5 style="color:red;"> Blocked Organization</h5>
            </div> 

            <div class="card-body">
               <br>  
              <div class="login-box card shadow">
                <div class="card-body">
                <span> <h5 class="text-center text-danger fontsize">
                    You have been blocked from this organization. Please contact your account admin.  </h5> <hr></span> 
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-6">
                                <button class="btn btn-info "><a href="{{url('orgs')}}" class="text-white">Back to Home  </a></button>
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