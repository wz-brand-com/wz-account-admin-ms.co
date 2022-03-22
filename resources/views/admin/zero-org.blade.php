
  <link href="{{ asset('assets/cdn/bootstrap-cdn/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/cdn/ajax-cdn/popper.min.js') }}" rel="stylesheet">
 <link href="{{ asset('assets/cdn/ajax-cdn/popper.min.js') }}" rel="stylesheet">
 <link href="{{ asset('assets/assets/cdn/bootstrap-cdn/bootstrap.min.js') }}" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <style>
  .mystylepic{
    background-image: url("/assets/images/background/login-register.jpg");
     /* Full height */
  height: 100%;

/* Center and scale the image nicely */
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
   
 </style>          

<div class="container-fluid mystylepic">
    <div class="row" >
        <div class="col-3"></div>
        <div class="col-6">
        
        <!-- card open -->
        <div class="card shadow bg-text">
            <div class="card-header text-success">
               Create Organization
            </div> 
            <!-- messsage open -->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                @foreach ($errors->all() as $error)
                <li class="text-center text-danger">{{ $error }}</li>
                @endforeach
                </ul>
                </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            <!-- messsage close -->
            <div class="card-body">
                <form action="{{route('org-store')}}" method="post" class="form-horizontal"enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" id="name_form">
                        <label class="control-label col-md-4">Organization Name : </label>
                        <div class="col-md-12">
                            <input type="text" name="org_name" id="name" class="form-control" autocomplete="off"/>
                            <input type="hidden" value="{{ Auth::user()->id }}" name="org_user_id"/>
                            <input type="hidden" value="{{ Auth::user()->email}}" name="org_user_email"/>
                            <input type="hidden" value="{{ Auth::user()->name}}" name="org_user_name"/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary float-left ml-3 fa fa-pencile"> Save </button>
               
                </form>
               
                <button class="btn btn-outline-primary fa fa-list ml-2" ><a href="" class="text_u"> Organization List </a> </button>
                 <!-- footer open -->
                 <button class="btn btn-outline-danger">
                <a class="waves-effect waves-dark fa fa-power-off" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             {!! @csrf_field() !!}
                </form>
                <!-- footer clsoe --> 
               <!-- content close -->
            </div>
        </div>
        <!-- card close -->
        </div>
        <div class="col-3"></div>
    </div>
</div>
