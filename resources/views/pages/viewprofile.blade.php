@extends('layouts.backend.mainlayout')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">


@section('title','Account Admin')
@section('content')
<style>
    .koo {
        background-image: url('/assets/images/koo-favicon.png');
        width: 40px;
        height: 40px;
        position: relative;
    }

    .scoopit-favicon {
        background-image: url('/assets/images/scoopit-favicon.png');
        width: 40px;
        height: 40px;
        position: relative;
    }

    .slashdot-favicon {
        background-image: url('/assets/images/slashdot-favicon.png');
        width: 40px;
        height: 40px;
        position: relative;
    }

    .padding {
        padding: 4rem !important
    }

    .user-card-full {
        overflow: hidden
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        border: none;
        margin-bottom: 30px
    }

    .m-r-0 {
        margin-right: 0px
    }

    .m-l-0 {
        margin-left: 0px
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px
    }

    .bg-c-lite-green {
        background: linear-gradient(to top, #8360c3, #2ebf91);
        background-image: url("/assets/images/users/view-pic.jpg");
    }

    .user-profile {
        padding: 20px 0
    }

    .card-block {
        padding: 1.25rem
    }

    .m-b-25 {
        margin-bottom: 25px
    }

    .img-radius {
        border-radius: 5px
    }

    h6 {
        font-size: 14px
    }

    .card .card-block p {
        line-height: 25px
    }

    <blade media|%20only%20screen%20and%20(min-width%3A%201400px)%20%7B>p {
        font-size: 14px
    }
    }

    .card-block {
        padding: 1.25rem
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .topbar .top-navbar .navbar-header .navbar-brand {
        padding-bottom: 10px !important;
    }

    .card .card-block p {
        line-height: 25px
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .text-muted {
        color: #8080ff !important
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .f-w-600 {
        font-weight: 600
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .user-card-full .social-link li {
        display: inline-block
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out
    }

    /* amit new profile start here  */
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .me-2 {
        margin-right: .5rem !important;
    }

    /* amit new profile start here  */
    .padding {
        padding: 1rem !important;
    }

</style>

<br>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="container">
                            <div class="main-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-block text-center text-white">
                                                <div class="m-b-25">
                                                  

                                                    @if(Auth::user()->file_pic == NULL)
                                                    <img src="{{url('assets/images/users/default.png')}}"
                                                        class="img-circle profile-pic" width="150">
                                                    @else
                                                    <img src="{{url('storage/images/',Auth::user()->file_pic) }}"
                                                        class="rounded-circle mt-4 ml-2 border border-danger"
                                                        width="150" height="150" alt="">

                                                    @endif

                                                </div>

                                                <h4><span>{{Auth::user()->name}}</span></h4>
                                                <p class="text-secondary mb-1">Digital Marketer</p>
                                                <p class="text-muted font-size-sm">{{$get_country_name}}</p>

                                                {{-- update pic start here  --}}
                                                @if(auth::user()->file_pic ==NULL)
                                                <button type="button" name="" id="profile_change_pic_id"
                                                    value="{{auth::user()->id}}"
                                                    class="chnage_image_class_edit btn btn-outline-success btn-sm ">Update
                                                    Avatar
                                                </button>
                                                <br><br>
                                                @else
                                                <!-- if condition open -->
                                                <button type="button" name="" id="profile_pic_id"
                                                    value="{{auth::user()->id}}"
                                                    class="profile_class_edit btn btn-outline-success btn-sm ">Update
                                                    Avatar
                                                </button>

                                                <br><br>

                                                @endif
                                                <!-- update profile update open -->
                                                <div id="user_pic_formModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary">
                                                                <h5 class="modal-title text-white" id="pic_model">Update
                                                                    Avatar</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Success Message after submit -->
                                                                <span id="form_result_pic" aria-hidden="true"></span>
                                                                <!-- Error Message after form not submit -->
                                                                <form method="post" id="sample_form_pic"
                                                                    class="form-horizontal"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group" id="name_form">
                                                                        <label class="control-label">Name: </label>
                                                                        <input type="file" name="file_pic" id="file_pic"
                                                                            class="form-control" />
                                                                        <span class="text-danger">*file type: PNG &
                                                                            maximum
                                                                            file size 1
                                                                            MB*</span>
                                                                    </div>

                                                                    <input type="hidden" value="{{ Auth::user()->id }}"
                                                                        name="admin_id" id="admin_id" />
                                                                    <input type="hidden"
                                                                        value="{{ Auth::user()->email }}"
                                                                        name="admin_email" id="admin_email" />
                                                                    <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                                                    <input type="hidden" value="null" name="user_id"
                                                                        id="user_id">
                                                                    <input type="hidden" value="null" name="user_email"
                                                                        id="user_email">
                                                                    <input type="hidden" value="" name="slugname">
                                                                    <input type="hidden" value="" name="slug_id">
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <input type="hidden" name="action_pic"
                                                                    id="action_pic" />
                                                                <input type="hidden" name="hidden_id_edit_profile"
                                                                    id="hidden_id_edit_profile" />
                                                                <input type="submit" name="action_button_pic"
                                                                    id="action_button_pic"
                                                                    class="btn btn-warning float-center"
                                                                    value="Update" />
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="change_pic_formModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary">
                                                                <h5 class="modal-title text-white" id="pic_model">Change
                                                                    image</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <!-- Success Message after submit -->
                                                                <span id="form_result_change_pic"
                                                                    aria-hidden="true"></span>
                                                                <!-- Error Message after form not submit -->
                                                                <form method="post" id="sample_form_change_pic"
                                                                    class="form-horizontal"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group" id="name_form">
                                                                        <label class="control-label">Name: </label>
                                                                        <input type="file" name="file_pic" id="file_pic"
                                                                            class="form-control" />
                                                                        <span class="text-danger">*file type: PNG &
                                                                            maximum
                                                                            file size 1
                                                                            MB*</span>
                                                                    </div>

                                                                    <input type="hidden" value="{{ Auth::user()->id }}"
                                                                        name="admin_id" id="admin_id" />
                                                                    <input type="hidden"
                                                                        value="{{ Auth::user()->email }}"
                                                                        name="admin_email" id="admin_email" />
                                                                    <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                                                    <input type="hidden" value="null" name="user_id"
                                                                        id="user_id">
                                                                    <input type="hidden" value="null" name="user_email"
                                                                        id="user_email">
                                                                    <input type="hidden" value="" name="slugname">
                                                                    <input type="hidden" value="" name="slug_id">
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <input type="hidden" name="action_chnage_pic"
                                                                    id="action_chnage_pic" />
                                                                <input type="hidden"
                                                                    name="hidden_id_edit_chnage_profile"
                                                                    id="hidden_id_edit_chnage_profile" />
                                                                <input type="submit" name="action_button_chnage_pic"
                                                                    id="action_button_chnage_pic"
                                                                    class="btn btn-warning float-center"
                                                                    value="Update" />
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <a href=""><i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16">Edit</i></a> --}}

                                                {{-- <a href=""><i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16">Edit</i></a> --}}

                                                <div id="user_formModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary">
                                                                <h5 class="modal-title text-white"
                                                                    id="exampleModalLabel">Update
                                                                    password
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <!-- Success Message after submit -->
                                                                <span id="form_result" aria-hidden="true"></span>
                                                                <!-- Error Message after form not submit -->
                                                                <form method="post" id="sample_form"
                                                                    class="form-horizontal"
                                                                    enctype="multipart/form-data"
                                                                    onsubmit="return check()">
                                                                    @csrf

                                                                    <div class="form-group" id="name_form">
                                                                        <label class="control-label">Name: </label>
                                                                        <input type="text" name="name" id="name"
                                                                            class="form-control" />
                                                                    </div>
                                                                    <!-- password show and hide open -->
                                                                    <div class="form-group" id="name_form">
                                                                        <label>Password</label>
                                                                        <div class="input-group"
                                                                            id="show_hide_password">
                                                                            <input
                                                                                class="form-control input-group-addon"
                                                                                type="password" name="password"
                                                                                id="password_user">
                                                                            <div class="input-group-addon">
                                                                                <a href=""><button
                                                                                        class="btn btn-light border"><i
                                                                                            class="fa fa-eye-slash"
                                                                                            aria-hidden="true"></i></button></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- password show and hide close -->
                                                                    <!--cornfirm password show and hide open -->
                                                                    <div class="form-group" id="name_form">
                                                                        <label>Confirm Password</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control" type="password"
                                                                                name="password" id="confirm_password">

                                                                        </div>
                                                                        <span id='message'></span>
                                                                    </div>
                                                                    <!-- cornfirm password show and hide close -->
                                                                    <input type="hidden" value="{{ Auth::user()->id }}"
                                                                        name="admin_id" id="admin_id" />
                                                                    <input type="hidden"
                                                                        value="{{ Auth::user()->email}}"
                                                                        name="admin_email" id="admin_email" />
                                                                    <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                                                    <input type="hidden" value="{{Auth::user()->email}}"
                                                                        name="email">
                                                                    <input type="hidden" value="{{ date('d-m-y') }}"
                                                                        name="daymonth">
                                                                    <input type="hidden" value="null" name="user_id"
                                                                        id="user_id">
                                                                    <input type="hidden" value="null" name="user_email"
                                                                        id="user_email">
                                                                    <input type="hidden" value="" name="slugname">
                                                                    <input type="hidden" value="" name="slug_id">
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <input type="hidden" name="action" id="action" />
                                                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                                                <input type="submit" name="action_button"
                                                                    id="action_button"
                                                                    class="btn btn-warning float-center" value="Add" />
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <a href="">

                                                </a>
                                                <button type="button" name="" id="profile_id"
                                                    value="{{auth::user()->id}}"
                                                    class="profile btn btn-outline-success btn-sm ml-2">Update
                                                    password</button>
                                                <br><br>
                                                <!-- update profile update open -->
                                                <div id="user_formModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary">
                                                                <h5 class="modal-title text-white"
                                                                    id="exampleModalLabel">Update
                                                                    password
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <!-- Success Message after submit -->
                                                                <span id="form_result" aria-hidden="true"></span>
                                                                <!-- Error Message after form not submit -->
                                                                <form method="post" id="sample_form"
                                                                    class="form-horizontal"
                                                                    enctype="multipart/form-data"
                                                                    onsubmit="return check()">
                                                                    @csrf

                                                                    <div class="form-group" id="name_form">
                                                                        <label class="control-label">Name: </label>
                                                                        <input type="text" name="name" id="name"
                                                                            class="form-control" />
                                                                    </div>
                                                                    <!-- password show and hide open -->
                                                                    <div class="form-group" id="name_form">
                                                                        <label>Password</label>
                                                                        <div class="input-group"
                                                                            id="show_hide_password">
                                                                            <input
                                                                                class="form-control input-group-addon"
                                                                                type="password" name="password"
                                                                                id="password_user">
                                                                            <div class="input-group-addon">
                                                                                <a href=""><button
                                                                                        class="btn btn-light border"><i
                                                                                            class="fa fa-eye-slash"
                                                                                            aria-hidden="true"></i></button></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- password show and hide close -->
                                                                    <!--cornfirm password show and hide open -->
                                                                    <div class="form-group" id="name_form">
                                                                        <label>Confirm Password</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control" type="password"
                                                                                name="password" id="confirm_password">

                                                                        </div>
                                                                        <span id='message'></span>
                                                                    </div>
                                                                    <!-- cornfirm password show and hide close -->
                                                                    <input type="hidden" value="{{ Auth::user()->id }}"
                                                                        name="admin_id" id="admin_id" />
                                                                    <input type="hidden"
                                                                        value="{{ Auth::user()->email}}"
                                                                        name="admin_email" id="admin_email" />
                                                                    <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                                                    <input type="hidden" value="{{Auth::user()->email}}"
                                                                        name="email">
                                                                    <input type="hidden" value="{{ date('d-m-y') }}"
                                                                        name="daymonth">
                                                                    <input type="hidden" value="null" name="user_id"
                                                                        id="user_id">
                                                                    <input type="hidden" value="null" name="user_email"
                                                                        id="user_email">
                                                                    <input type="hidden" value="" name="slugname">
                                                                    <input type="hidden" value="" name="slug_id">
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <input type="hidden" name="action" id="action" />
                                                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                                                <input type="submit" name="action_button"
                                                                    id="action_button"
                                                                    class="btn btn-warning float-center" value="Add" />
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- update pic end here  --}}
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">
                                                        <i class="fab fa-facebook" style="color: blue;"></i> &nbsp; facebook
                                                    </h6>
                                                    @if(!empty($profile_user_url->facebook))
                                                    <span class="text-secondary"> <a class="text-secondary"
                                                            href="{{$profile_user_url->facebook}}"
                                                            target="_blank">facebook</a> </span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill">Not
                                                        Available url</span>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">

                                                        <i class="fab fa-tumblr" style="color: #9900e6;"></i> &nbsp;Tumblr
                                                    </h6>
                                                    @if(!empty($profile_user_url->tumblr))
                                                    <span class="text-secondary"> <a class="text-secondary"
                                                            href="{{$profile_user_url->tumblr}}"
                                                            target="_blank">Tumblr</a> </span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill">Not
                                                        Available url</span>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">

                                                        <i class="fab fa-twitter" style="color: #00cccc;"></i> &nbsp;Twitter
                                                    </h6>

                                                    @if(!empty($profile_user_url->twitter))
                                                    <span class="text-secondary"> <a class="text-secondary"
                                                            href="{{$profile_user_url->twitter}}"
                                                            target="_blank">Twitter</a> </span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill">Not
                                                        Available url</span>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">

                                                        <i class="fab fa-instagram" style="color: #ff0000;"></i> &nbsp;Instagram
                                                    </h6>
                                                    @if(!empty($profile_user_url->instagram))
                                                    <span class="text-secondary"> <a class="text-secondary"
                                                            href="{{$profile_user_url->instagram}}"
                                                            target="_blank">Instagram</a> </span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill">Not
                                                        Available url</span>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">

                                                        <i class="fab fa-quora" style="color: #990000;"></i>&nbsp; quora
                                                    </h6>
                                                    @if(!empty($profile_user_url->quora))
                                                    <span class="text-secondary"> <a class="text-secondary"
                                                            href="{{$profile_user_url->quora}}"
                                                            target="_blank">Quora</a> </span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill">Not
                                                        Available url</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body mt-3">



                                                @if(!empty($profile_user_url->facebook))
                                                <button class="btn btn-success edit_add_profile " id="edit_add_profile"
                                                    value="{{ Auth::user()->id }}"> Edit profile</button>
                                                @else
                                                <button class="btn btn-secondary fa fa-ban" style="display: none;"> Edit profile</button>
                                                @endif


                                                <button class="btn btn-danger view_all_url fa fa-eye" id="view_all_url"
                                                    value="{{ Auth::user()->id }}"> view profile</button>
                                                <div class="row mt-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Full Name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <span>{{ Auth::user()->name }}</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Email</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <span>{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Country</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <span>{{$get_country_name}}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">State</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <span>{{$get_state_name}}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">City</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <span>{{$get_city_name}}</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Account Active from</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        {{ Auth::user()->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <button class="btn btn-primary" id="add_profile_btn"
                                                            type="submit" value="{{ auth::user()->id }}">
                                                            Add Profile</button> <br> <br>
                                                        <p>Facebook</p>
                                                        <span>{{$profile_user_url->facebook}}</span>
                                                        <div class="progress mb-3" style="height: 5px">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p>Twitter</p>
                                                        <span>{{$profile_user_url->twitter}}</span>
                                                        <div class="progress mb-3" style="height: 5px">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 72%" aria-valuenow="72" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p>Youtube</p>
                                                        <span>{{$profile_user_url->youtube}}</span>
                                                        <div class="progress mb-3" style="height: 5px">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: 89%" aria-valuenow="89" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p>Wordpress</p>
                                                        <span>{{$profile_user_url->wordpress}}</span>
                                                        <div class="progress mb-3" style="height: 5px">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <p> Tumblr :</p>
                                                        <span>{{$profile_user_url->tumblr}}</span>
                                                        <div class="progress" style="height: 5px">
                                                            <div class="progress-bar bg-info" role="progressbar"
                                                                style="width: 66%" aria-valuenow="66" aria-valuemin="0"
                                                                aria-valuemax="100"> </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- add profile here --}}
                        <div id="addProfileModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title edit_profile_modal_title text-white"
                                            id="exampleModalLabel">
                                            Add Profile </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>


                                    </div>
                                    <div class="modal-body">

                                        <!-- Success Message after submit -->
                                        <span id="store_url_result" aria-hidden="true"></span>
                                        <!-- Error Message after form not submit -->
                                        <form method="post" id="addProfile_Sample_Form" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-facebook"
                                                                id="basic-addon1" style="font-size:24px; color: blue;"></span>
                                                        </div>
                                                        <input type="text" name="facebook" id="facebook_url"
                                                            class="form-control" placeholder="Enter your facebook url">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-twitter"
                                                                id="basic-addon1" style="font-size:24px; color: #00cccc;"></span>
                                                        </div>
                                                        <input type="text" name="twitter" id="twitter_url"
                                                            class="form-control" placeholder="Enter your twitter url">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-youtube"
                                                                id="basic-addon1" style="font-size:24px; color: #ff0000;"></span>
                                                        </div>
                                                        <input type="text" name="youtube" id="youtube_url"
                                                            class="form-control" placeholder="Enter your youtube url">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-wordpress"
                                                                id="basic-addon1" style="font-size:24px"></span>
                                                        </div>
                                                        <input type="text" name="wordpress" id="wordpress_url"
                                                            class="form-control" placeholder="Enter your wordpress url">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-tumblr-square"
                                                                id="basic-addon1" style="font-size:24px; color: #9900e6;"></span>
                                                        </div>
                                                        <input type="text" name="tumblr" id="tumblr_url"
                                                            class="form-control" placeholder="Enter your tumblr url">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-instagram"
                                                                id="basic-addon1" style="font-size:24px; color: #ff0066;"></span>
                                                        </div>
                                                        <input type="text" name="instagram" id="instagram_url"
                                                            class="form-control" placeholder="Enter your instagram url">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-quora" id="basic-addon1"
                                                                style="font-size:24px; color: #990000;"></span>
                                                        </div>
                                                        <input type="text" name="quora" id="quora_url"
                                                            class="form-control" placeholder="Enter your quora url">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-pinterest"
                                                                id="basic-addon1" style="font-size:24px; color: #b30000;"></span>
                                                        </div>
                                                        <input type="text" name="pinterest" id="pinterest_url"
                                                            class="form-control" placeholder="Enter your pinterest url">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text fab fa-reddit"
                                                                id="basic-addon1" style="font-size:24px; color: #ff0000;"></span>
                                                        </div>
                                                        <input type="text" name="reddit" id="reddit_url"
                                                            class="form-control" placeholder="Enter your reddit url">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text koo" id="basic-addon1"
                                                                style="font-size:24px; color: #ffaa00;"> </span>
                                                        </div>
                                                        <input type="text" name="koo" id="koo_url" class="form-control"
                                                            placeholder="Enter your koo url">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text scoopit-favicon"
                                                                id="basic-addon1" style="font-size:24px"></span>
                                                        </div>
                                                        <input type="text" name="scoopit" id="scoopit_url"
                                                            class="form-control" placeholder="Enter your scoopit url">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text slashdot-favicon"
                                                                id="basic-addon1" style="font-size:24px"> </span>
                                                        </div>
                                                        <input type="text" name="slashdot" id="slashdot_url"
                                                            class="form-control" placeholder="Enter your slashdot url">
                                                    </div>
                                                </div>
                                            </div>



                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                                id="profile_store_hidden_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"
                                                id="admin_email" />

                                            <input type="hidden" value="{{ Auth::user()->name }}" name="user_name">

                                            <input type="hidden" value="{{ $org_slug }}" id="slug"
                                                name="u_org_slugname">
                                            <br>
                                            <input type="hidden" value="{{ $slug_id }}" name="u_org_organization_id"
                                                id="u_org_organization_id">
                                            <input type="hidden" value="{{ $getting_roll_id }}" name="u_org_role_id"
                                                id="u_org_role_id">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="profile_hidden_id" id="profile_hidden_id" />
                                        <input type="submit" name="action_button" id="action_add_profile_button"
                                            class="btn btn-warning float-center" value="Add" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- add profile end here --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- ======================================================view modal open ======================== --}}
<div id="viewall_url" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title edit_profile_modal_title text-white" id="viewall_url">view Profile </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <div class="modal-body">



                <form method="post" id="addProfile_Sample_Form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-facebook" id="basic-addon1"
                                        style="font-size:24px; color: blue;"></span>
                                </div>
                                <span name="facebook" id="facebook_view_url" class="form-control"></span>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-twitter" id="basic-addon1"
                                        style="font-size:24px; color: #00cccc;"></span>
                                </div>
                                <span name="twitter" id="twitter_view_url" class="form-control"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-youtube" id="basic-addon1"
                                        style="font-size:24px; color: #ff0000;"></span>
                                </div>
                                <span name="youtube" id="youtube_view_url" class="form-control"> </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-wordpress" id="basic-addon1"
                                        style="font-size:24px;"></span>
                                </div>
                                <span name="wordpress" id="wordpress_view_url" class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-tumblr" id="basic-addon1"
                                        style="font-size:24px; color: #9900e6;"></span>
                                </div>
                                <span name="tumblr" id="tumblr_view_url" class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-instagram" id="basic-addon1"
                                        style="font-size:24px; color: #ff0066;"></span>
                                </div>
                                <span name="instagram" id="instagram_view_url" class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-quora" id="basic-addon1"
                                        style="font-size:24px; color: #990000;"></span>
                                </div>
                                <span name="quora" id="quora_view_url" class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-pinterest" id="basic-addon1"
                                        style="font-size:24px; color: #b30000;"></span>
                                </div>
                                <span name="pinterest" id="pinterest_view_url" class="form-control"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fab fa-reddit" id="basic-addon1"
                                        style="font-size:24px; color: #ff0000;"></span>
                                </div>
                                <span name="reddit" id="reddit_view_url" class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text koo" id="basic-addon1" style="font-size:24px; color: #ffaa00;"> </span>
                                </div>
                                <span name="koo" id="koo_view_url" class="form-control"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text scoopit-favicon" id="basic-addon1"
                                        style="font-size:24px"></span>
                                </div>
                                <span name="scoopit" id="scoopit_view_url" class="form-control"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text slashdot-favicon" id="basic-addon1"
                                        style="font-size:24px"> </span>
                                </div>
                                <span name="slashdot" id="slashdot_view_url" class="form-control"> </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="admin_id" />
                    <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="admin_email" />
                    <input type="hidden" value="{{ Auth::user()->name }}" name="user_name">
                    <input type="hidden" value="{{ $org_slug }}" id="slug" name="u_org_slugname"> <br>
                    <input type="hidden" value="{{ $slug_id }}" name="u_org_organization_id" id="u_org_organization_id">
                    <input type="hidden" value="{{ $getting_roll_id }}" name="u_org_role_id" id="u_org_role_id">

            </div>

            </form>
        </div>
    </div>
</div>
{{-- ======================================================view modal close ======================== --}}
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@endsection


@push('js')

<script>
    // data table open with fetching
    // image load
    window.addEventListener("load", function () {
        $(".loader").delay(500).fadeOut("slow");
    });
    // image load close
    $(document).ready(function () {
        id = $('#profile_id').val();
        // edit function open
        $(document).on('click', '.profile', function () {
            console.log('working edit button');
            $('#name_form').show();
            id = $('#profile_id').val();
            console.log('we gotted id on update avtar '.id);
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{ url('viewprofile/edit') }}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('now are in success function');
                    console.log(html);
                    $('#name').val(html.data.name);
                    $('#email').val(html.data.email);
                    $('#password_user').val(html.data.password);
                    $('#admin_id').val(html.data.admin_id);
                    $('#admin_email').val(html.data.admin_email);
                    $('.modal-title').text("Update password");
                    $('.modal-title_delete').text("data will be delete");
                    $('#action_button').val("Update");
                    $('#action').val("Update");
                    $('#user_formModal').modal('show');
                    $('#hidden_id').val(id);
                }
            })
        });
        // edit function close
        // model will be display on add and edit button click
        $('#create_record').click(function () {
            $('#name_form').show();
            $('#name_form_pic_edit').show();
            $('#passlabel,#password').show();
            $('#sample_form')[0].reset();
            $('#form_result').html('');
            $('.modal-title').text("Add New User");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#user_formModal').modal('show');
        });
        // model will be close
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! add profile model will be open !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $('#add_profile_btn').click(function () {
            console.log('add profiel button  pe click huwa');
            $('#addProfileModal').modal('show');
        })
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! add profile model will be close !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            // data add working on submit button
            // update button wotking for updata data
            if ($('#action').val() == "Update") {
                console.log('update button pe click ho rha hai');
                $.ajax({
                    url: "{{ url('viewprofile/update') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    // message alert open
                    success: function (data) {
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#user_formModal').modal('hide');
                                location.reload(true);
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                        // adding alert messages for success and exist data validation close
                    },
                    // message alert close
                    error: function (data) {
                        console.log('Error:', data);
                        //    this function for hide with id #formModel
                        console.log('update function kamm nahi kr rha hai');
                    }
                });
            }
        });
        //
        // =============================================== pic edit fnction  start================================================
        $(document).on('click', '.profile_class_edit', function () {
            console.log('profile_class_edit working this button for update avtar');
            $('#name_form').show();
            $('#form_result_pic').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{ url('viewprofile/edit_user_pic') }}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('inside success function');
                    console.log(html);
                    $('#admin_id').val(html.data.admin_id);
                    $('#admin_email').val(html.data.admin_email);
                    $('.modal-title').text("Update avatar");
                    $('.modal-title_delete').text("data will be delete");
                    $('#action_button_pic').val("Update");
                    $('#action_pic').val("Update");
                    $('#user_pic_formModal').modal('show');
                    $('#hidden_id_edit_profile').val(id);
                }
            })
        });
        // =============================================== pic edit fnction  end ================================================

        // :::::::::::::::::::::::::::::::::: first time image change open 1 ::::::::::::::::::::::::::::::::::::::::::::::::
        $(document).on('click', '.chnage_image_class_edit', function () {
            console.log('first time image change working edit button');
            $('#name_form').show();
            id = $('#profile_change_pic_id').val();
            console.log('id ka vale aaaya '.id);
            $('#form_result_change_pic').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{ url('viewprofile/first_change_edit_user_pic') }}/" +
                    id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('first time image change edit ke page pe');
                    console.log(html);
                    $('#admin_id').val(html.data.admin_id);
                    $('#admin_email').val(html.data.admin_email);
                    $('.modal-title').text("Change avatar");
                    $('.modal-title_delete').text("data will be delete");
                    $('#action_button_chnage_pic').val("Update");
                    $('#action_chnage_pic').val("Update");
                    $('#change_pic_formModal').modal('show');
                    $('#hidden_id_edit_chnage_profile').val(id);
                }
            })
        });
        //::::::::::::::::::::::::::: first time image change close 1  :::::::::::::::::::::::
        // ===============================================update pic open  ======================================================
        //  form working start
        $('#sample_form_pic').on('submit', function (event) {
            event.preventDefault();
            // data add working on submit button
            // update button wotking for updata data
            if ($('#action_pic').val() == "Update") {
                console.log('profile update button pe click ho rha hai');
                $.ajax({
                    url: "{{ url('viewprofile/update_user_pic') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    // message alert open
                    success: function (data) {
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result_pic').html(html);
                            setTimeout(function () {
                                $('#user_pic_formModal').modal('hide');
                                console.log(
                                    'page reload ho rha hai pic update krne pe'
                                );
                                // $('#profile_table').Table().ajax.reload();
                                location.reload(true);
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result_pic').html(html);
                        }
                        // adding alert messages for success and exist data validation close
                    },
                    // message alert close
                    error: function (data) {
                        console.log('Error:', data);
                        //    this function for hide with id #formModel
                        console.log('update function kamm nahi kr rha hai');
                    }
                });
            }
        });
        // ===============================================update pic close  ======================================================
        // ::::::::::::::::::::::::::::::: first time image pic update open 1  ::::::::::::::::::::::::::::::::::::
        $('#sample_form_change_pic').on('submit', function (event) {
            event.preventDefault();
            // data add working on submit button
            // update button wotking for updata data
            if ($('#action_chnage_pic').val() == "Update") {
                console.log('profile update button pe click ho rha hai');
                $.ajax({
                    url: "{{ url('viewprofile/update_user_change_pic') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    // message alert open
                    success: function (data) {
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result_change_pic').html(html);
                            setTimeout(function () {
                                $('#change_pic_formModal').modal('hide');
                                console.log(
                                    'page reload ho rha hai pic update krne pe'
                                );
                                // $('#profile_table').Table().ajax.reload();
                                location.reload(true);
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result_change_pic').html(html);
                        }
                        // adding alert messages for success and exist data validation close
                    },
                    // message alert close
                    error: function (data) {
                        console.log('Error:', data);
                        //    this function for hide with id #formModel
                        console.log(
                            'change image first time  update function kamm nahi kr rha hai'
                        );
                    }
                });
            }
        });
        // ::::::::::::::::::::::::::: first time image pic update close 1  :::::::::::::::::::::::::::::::::::::::
        // ############## password hide and  show start ###########################################################
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input ').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
        // ############## password hide and  show end ###########################################################



    });


    // ================================================================================================================================
    //  ===============Start VIEW PROFILE =============================================================================================
    // ================================================================================================================================

    $(document).on('click', '.view_all_url', function () {
        console.log('view all url in on button click');
        $('#name_form').show();
        var user_profile_id = $('#admin_id').val();
        console.log('id ka vale aaaya '.user_profile_id);
        $('#form_result_pic').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{ url('/user_edit_profiles/') }}/" + user_profile_id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function (html) {
                console.log('view value');
                console.log(html);
                var fb_title = html.data.facebook;
                var twit_title = html.data.twitter;
                var ytb_title = html.data.youtube;
                var wordp_title = html.data.wordpress;
                var tmb_title = html.data.tumblr;
                var inst_title = html.data.instagram;
                var qura_title = html.data.quora;
                var pint_title = html.data.pinterest;
                var redit_title = html.data.reddit;
                var ko_title = html.data.koo;
                var scpt_title = html.data.scoopit;
                var saldt_title = html.data.slashdot;

                $('#facebook_view_url').html(fb_title);
                $('#twitter_view_url').html(twit_title);
                $('#youtube_view_url').html(ytb_title);
                $('#wordpress_view_url').html(wordp_title);
                $('#tumblr_view_url').html(tmb_title);
                $('#instagram_view_url').html(inst_title);
                $('#quora_view_url').html(qura_title);
                $('#pinterest_view_url').html(pint_title);
                $('#reddit_view_url').html(redit_title);
                $('#koo_view_url').html(ko_title);
                $('#scoopit_view_url').html(scpt_title);
                $('#slashdot_view_url').html(saldt_title);
                $('#admin_email').val(html.data.admin_email);
                $('.view-all-url').text("view");
                $('#viewall_modal_url').modal('show');
            }
        })
    });
    // ================================================================================================================================
    //  ===============End VIEW  PROFILE  =============================================================================================
    // ================================================================================================================================

    // ================================================================================================================================
    //  ===============Start  Edit Url profile=========================================================================================
    // ================================================================================================================================
    $(document).on('click', '.edit_add_profile', function () {
        console.log('edit add profile pe click huwa');
        var user_profile_id = $('#admin_id').val();
        $('#addProfileModal').show();
        console.log('peofile edit view details open' + user_profile_id);
        $.ajax({
            type: "get",
            data: {},
            url: "{{ url('/user_edit_profiles/') }}/" + user_profile_id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function (html) {
                var title_fb = html.data.facebook;
                console.log('facebook url' + title_fb);
                $('#facebook_url').val(html.data.facebook);
                $('#twitter_url').val(html.data.twitter);
                $('#youtube_url').val(html.data.youtube);
                $('#wordpress_url').val(html.data.wordpress);
                $('#tumblr_url').val(html.data.tumblr);
                $('#instagram_url').val(html.data.instagram);
                $('#quora_url').val(html.data.quora);
                $('#pinterest_url').val(html.data.pinterest);
                $('#reddit_url').val(html.data.reddit);
                $('#koo_url').val(html.data.koo);
                $('#scoopit_url').val(html.data.scoopit);
                $('#slashdot_url').val(html.data.slashdot);
                $('#action_add_profile_button').val("Update");
                $('#addProfileModal').modal('show');
                $('#profile_hidden_id').val(user_profile_id);
            }
        })
    });
    // ================================================================================================================================
    //  ===============End Edit url  profile===========================================================================================
    // ================================================================================================================================

    // ================================================================================================================================
    //  ===============Start  Add profile==============================================================================================
    // ================================================================================================================================


    $('#addProfile_Sample_Form').on('submit', function (event) {
        event.preventDefault();
        if ($('#action_add_profile_button').val() == "Add") {
            console.log('addprofile button pe click ho rha hai');
            $.ajax({
                url: "{{ url('addprofile/social-url') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                // message alert open
                success: function (data) {
                    var html = '';
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.message +
                            '</div>';
                        $('#store_url_result').html(html);
                        setTimeout(function () {
                            $('#addProfileModal').modal('hide');
                            location.reload(true);
                        }, 2000);
                    } else {
                        html = '<div class="alert alert-danger">' + data.message +
                            '</div>';
                        $('#store_url_result').html(html);
                    }
                    // adding alert messages for success and exist data validation close
                },
                // message alert close
                error: function (data) {
                    console.log('Error:', data);
                    //    this function for hide with id #formModel
                    console.log('update function kamm nahi kr rha hai');
                }
            });
        }

        // !!!!!!!!!!!!!!!!!!!!!! edit profile update function open !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        if ($('#action_add_profile_button').val() == "Update") {
            console.log('update button pe click ho rha hai profile');
            $.ajax({
                url: "{{ Route('addurl.update') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },

                // message alert open
                success: function (data) {
                    console.log('update ho gaya successfully');
                    var html = '';
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.message + '</div>';
                        $('#store_url_result').html(html);
                        setTimeout(function () {
                            $('#addProfileModal').modal('hide');
                        }, 2000);
                    } else {
                        html = '<div class="alert alert-danger">' + data.message + '</div>';
                        $('#store_url_result').html(html);
                    }
                },
                // message alert close
                error: function (data) {
                    console.log('Error:', data);
                    console.log('update function kamm nahi kr rha hai');
                }
            });
        }
        // ================================================================================================================================
        //  ===============End  EDIT PROFILE UPDATE FUNCTION CLOSE HERE ===================================================================
        // ================================================================================================================================

    });

    // ------------------------------  view all adprofile url open ---------------------------------------------------
    $(document).on('click', '.view_all_url', function () {
        console.log('view all url in on button click');
        $('#name_form_view_profile').show();
        var user_profile_id = $('#admin_id').val();
        console.log('id ka vale aaaya '.user_profile_id);
        $('#form_result_pic').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{ url('/user_edit_profiles/') }}/" + user_profile_id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function (html) {
                console.log('view value');
                console.log(html);
                var fb_title = html.data.facebook;
                var twit_title = html.data.twitter;
                var ytb_title = html.data.youtube;
                var wordp_title = html.data.wordpress;
                var tmb_title = html.data.tumblr;
                var inst_title = html.data.instagram;
                var qura_title = html.data.quora;
                var pint_title = html.data.pinterest;
                var redit_title = html.data.reddit;
                var ko_title = html.data.koo;
                var scpt_title = html.data.scoopit;
                var saldt_title = html.data.slashdot;

                $('#facebook_view_url').html(fb_title);
                $('#twitter_view_url').html(twit_title);
                $('#youtube_view_url').html(ytb_title);
                $('#wordpress_view_url').html(wordp_title);
                $('#tumblr_view_url').html(tmb_title);
                $('#instagram_view_url').html(inst_title);
                $('#quora_view_url').html(qura_title);
                $('#pinterest_view_url').html(pint_title);
                $('#reddit_view_url').html(redit_title);
                $('#koo_view_url').html(ko_title);
                $('#scoopit_view_url').html(scpt_title);
                $('#slashdot_view_url').html(saldt_title);
                $('#admin_email').val(html.data.admin_email);
                $('.view-all-url').text("view");
                $('#viewall_url').modal('show');
                // $('#hidden_id_edit_profile').val(id);


            }
        })
    });
    // ------------------------------  view all adprofile url close ---------------------------------------------------

</script>
<script>
    $('#confirm_password').on('keyup', function () {
        if ($(this).val() == $('#password_user').val()) {
            $('#message').html('Password matched').css('color', 'green');
        } else $('#message').html('Password not matching').css('color', 'red');
    });

</script>
<script>
    // =============================================== pic edit fnction  start================================================
    $(document).on('click', '.profile_class_edit', function () {
        console.log('working edit button');
        $('#name_form').show();
        id = $('#profile_pic_id').val();
        console.log('id ka vale aaaya '.id);
        $('#form_result_pic').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{url('viewprofile/edit_user_pic')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function (html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html);
                $('#admin_id').val(html.data.admin_id);
                $('#admin_email').val(html.data.admin_email);
                $('.modal-title').text("Update avatar");
                $('.modal-title_delete').text("data will be delete");
                $('#action_button_pic').val("Update");
                $('#action_pic').val("Update");
                $('#user_pic_formModal').modal('show');
                $('#hidden_id_edit_profile').val(id);
            }
        })
    });
    // =============================================== pic edit fnction  end ================================================

    // :::::::::::::::::::::::::::::::::: first time image change open 1 ::::::::::::::::::::::::::::::::::::::::::::::::
    $(document).on('click', '.chnage_image_class_edit', function () {
        console.log('first time image change working edit button');
        $('#name_form').show();
        id = $('#profile_change_pic_id').val();
        console.log('id ka vale aaaya '.id);
        $('#form_result_change_pic').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{url('viewprofile/first_change_edit_user_pic')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function (html) {
                console.log('first time image change edit ke page pe');
                console.log(html);
                $('#admin_id').val(html.data.admin_id);
                $('#admin_email').val(html.data.admin_email);
                $('.modal-title').text("Change avatar");
                $('.modal-title_delete').text("data will be delete");
                $('#action_button_chnage_pic').val("Update");
                $('#action_chnage_pic').val("Update");
                $('#change_pic_formModal').modal('show');
                $('#hidden_id_edit_chnage_profile').val(id);
            }
        })
    });
    //::::::::::::::::::::::::::: first time image change close 1  :::::::::::::::::::::::
    // ===============================================update pic open  ======================================================
    //  form working start
    $('#sample_form_pic').on('submit', function (event) {
        event.preventDefault();
        // data add working on submit button
        // update button wotking for updata data
        if ($('#action_pic').val() == "Update") {
            console.log('profile update button pe click ho rha hai');
            $.ajax({
                url: "{{url('viewprofile/update_user_pic') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                // message alert open
                success: function (data) {
                    var html = '';
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.message +
                            '</div>';
                        $('#form_result_pic').html(html);
                        setTimeout(function () {
                            $('#user_pic_formModal').modal('hide');
                            console.log(
                                'page reload ho rha hai pic update krne pe');
                            // $('#profile_table').Table().ajax.reload();
                            location.reload(true);
                        }, 2000);
                    } else {
                        html = '<div class="alert alert-danger">' + data.message +
                            '</div>';
                        $('#form_result_pic').html(html);
                    }
                    // adding alert messages for success and exist data validation close
                },
                // message alert close
                error: function (data) {
                    console.log('Error:', data);
                    //    this function for hide with id #formModel
                    console.log('update function kamm nahi kr rha hai');
                }
            });
        }
    });
    // ===============================================update pic close  ======================================================
    // ::::::::::::::::::::::::::::::: first time image pic update open 1  ::::::::::::::::::::::::::::::::::::
    $('#sample_form_change_pic').on('submit', function (event) {
        event.preventDefault();
        // data add working on submit button
        // update button wotking for updata data
        if ($('#action_chnage_pic').val() == "Update") {
            console.log('profile update button pe click ho rha hai');
            $.ajax({
                url: "{{url('viewprofile/update_user_change_pic') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                // message alert open
                success: function (data) {
                    var html = '';
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.message +
                            '</div>';
                        $('#form_result_change_pic').html(html);
                        setTimeout(function () {
                            $('#change_pic_formModal').modal('hide');
                            console.log(
                                'page reload ho rha hai pic update krne pe');
                            // $('#profile_table').Table().ajax.reload();
                            location.reload(true);
                        }, 2000);
                    } else {
                        html = '<div class="alert alert-danger">' + data.message +
                            '</div>';
                        $('#form_result_change_pic').html(html);
                    }
                    // adding alert messages for success and exist data validation close
                },
                // message alert close
                error: function (data) {
                    console.log('Error:', data);
                    //    this function for hide with id #formModel
                    console.log(
                        'change image first time  update function kamm nahi kr rha hai'
                    );
                }
            });
        }
    });
    // ::::::::::::::::::::::::::: first time image pic update close 1  :::::::::::::::::::::::::::::::::::::::

</script>
@endpush
