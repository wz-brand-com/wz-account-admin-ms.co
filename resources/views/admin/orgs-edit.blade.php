@extends('layouts.frontend.mainlayout')


@section('title','Organization')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
  .mystylepics{
    background-image: url("/assets/images/background/login-register.jpg");
     /* Full height */
  height: 100%;

/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover;
} 
 li{ text-decoration:none; list-style-type:none;}
 button a:hover{text-decoration:none;color:white;}
 a:hover{text-decoration:none;}  
 table, tr, td  {border: none; border-collapse: collapse;border: none; outline: none;border-top:none}
 
 </style> 
<div class="container-fluid mystylepics">
    <div class="row" >
        <div class="col-2"></div>
            <div class="col-8">
           
                <!-- card open -->
                <div class="card shadow bg-text">
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
                    <div class="card-header text-success">
                      Edit  Organization 
                    </div> 
                    <div class="card-body">
                        <div class="form-group" id="name_form">
                            <div class="col-md-12">
                                <div class="card mt-2" style="border-left: 2px solid blue;">
                                    <div class="card-body shadow ">
                                       <form method="post" action="{{route('orgs-update',$validate_orgs->id)}}" enctype="multipart/form-data">
                                       @csrf
                                       <input type="text" name="org_name" class="w-100 p-1" value="{{$validate_orgs->org_name}}">
                                       <button type="submit" class="btn btn-outline-primary fa fa-send-o float-right mr-1 mt-2"> &nbsp;Update</button>
                                       <button type="button" class="btn btn-outline-info fa fa-ban float-right mr-1 mt-2"> &nbsp;<a href="{{url('orgs')}}">Cancle </a></button>
                                       </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card close -->
            </div>
        <div class="col-2"></div>
    </div>
</div>

