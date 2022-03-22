@extends('layouts.backend.mainlayout')

@section('title','User')
@section('content')

<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
    localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());

</script>
<style>li{list-style:none;}</style>
<!-- hidden Auth email and id for calling in json index -->
<input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="auth_id" />
<input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
{{-- <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">User Section </h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">System Setting</a></li> -->
            <li class="breadcrumb-item active">User</li>
        </ol>
    </div>
</div> --}}
<br><br><br>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <div class="">

                        {{-- model  open --}}
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn btn-primary ">Add New User</button>
                            </div>

                        </div>

                        <table id="userTable" class="table">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                        <div id="user_formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add New User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Success Message after submit -->
                                        <span id="form_result" aria-hidden="true"></span>
                                        <!-- Error Message after form not submit -->
                                        <form method="post" id="sample_form" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            @csrf




                                            <div class="form-group" id="name_form">
                                                <label class="control-label">Name: </label>
                                                <input type="name" name="name" id="name" class="form-control" autocomplete="off" />
                                            </div>

                                            <div class="form-group" id="name_form">
                                                <label class="control-label">Email: </label>
                                                <input type="email" name="email" id="email" class="form-control"  autocomplete="off"/>
                                            </div>


                                            <!-- password show and hide open -->
                                            <div class="form-group" id="name_form">
                                                <label>Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input class="form-control input-group-addon" type="password"
                                                        name="password" id="password_user">
                                                    <div class="input-group-addon">
                                                        <a href=""><button class="btn btn-light border"><i
                                                                    class="fa fa-eye-slash"
                                                                    aria-hidden="true"></i></button></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- password show and hide close -->

                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                                id="admin_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"
                                                id="admin_email" />
                                            <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                            <input type="hidden" value="null" name="user_id" id="user_id">
                                            <input type="hidden" value="null" name="user_email" id="user_email">
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="hidden_id" id="hidden_id" />
                                        <input type="submit" name="action_button" id="action_button"
                                            class="btn btn-warning float-center" value="Add" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data cannot delete after  model open -->
                    <div class="row">
                        <div class="col-lg-10">
                            <div id="reextendmodel" class="modal" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-header" style="color:red;font-weight:bold;">
                                                Error
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title" style="color:red;">Message </h3>
                                                <p class="card-text">The action can not be completed because the <span
                                                        class="text-primary" name="name_manager" id="name_manager">
                                                    </span>
                                                    is working in this <span class="text-primary">Rank & Rating of Team
                                                        Rating</span> program getting error message,</p>
                                                <a href="#" class="close" data-dismiss="modal"><i
                                                        class="fa fa-times-circle text-danger"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data cannot delete after model close -->
                    <div id="confirmModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <br>
                                    <span class="modal-title_delete">Confirmation</span>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove
                                        this User?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" name="ok_button" id="ok_button"
                                        class="btn btn-danger">OK</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- model close --}}

                </div>
            </div>
        </div>
    </div>
</div>
</div>
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
        id = $('#u_org_role_id').val();
        var dt = $('#userTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('/api/v1/j/user/index')}}/" + id,
                "dataSrc": 'data',
                "type": "GET",
                "datatype": "json",
                "crossDomain": true,
                "beforeSend": function (xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem(
                        'a_u_a_b_t'));
                }
            },
            processing: true,
            language: {
                processing: "<img src='../../assets/images/loader.gif' style='z-index:1071;background-color:white;border-radius:8pt;padding-top:4pt;padding-bottom:4pt;position:fixed;top:0;right:0;bottom:0;left:0;margin:auto;'>"
            },
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            rowReorder: false,
            columnDefs: [{
                    "title": "ID",
                    "targets": 0,
                    "width": "10%"
                },
                {
                    "title": "User Name",
                    "targets": 1,
                    "width": "30%"
                },
                {
                    "title": "User Email",
                    "targets": 2,
                    "width": "30%"
                },
                
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },

                // {
                //     data: null,
                //     render: function (data, type, row) {
                //         return '<div class="row"><div class="col-6"> <button type="button"  id="' +
                //             data['id'] +
                //             '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-2"><button type="button" id="' +
                //             data['id'] + '" name="' + data['name'] +
                //             '"  class="btn btn-danger  delete"><i class="mdi mdi-delete"></i></button></div> </div>'
                //     },
                // },
            ],


        });
        // data table close

        // model will be display on add and edit button click
        $('#create_record').click(function () {
            $('#name_form').show();
            $('#passlabel,#password').show();
            $('#sample_form')[0].reset();
            $('#form_result').html('');
            $('.modal-title').text("Add New User");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#user_formModal').modal('show');
        });
        // model will be close

        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            // data add working on submit button
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{Route('user.store') }}",
                    method: "POST",
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
                                $('#userTable').DataTable().ajax.reload();
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
                        console.log(' value store nahi rha ha');
                        console.log('Error:', data);
                    }
                })
            }
            // update button wotking for updata data
            if ($('#action').val() == "Update") {
                console.log('update button pe click ho rha hai');
                $.ajax({
                    url: "{{url('/api/v1/j/user/update/') }}",
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
                success: function(data) {
                    console.log('update ho gaya successfully');
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#user_formModal').modal('hide');
                                $('#userTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
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
        $(document).on('click', '.edit', function () {
            console.log('working edit button');
            $('#name_form').show();
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('/api/v1/j/user/edit/')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    //  i am not using this drop down close
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    $('#name').val(html.data.name);
                    $('#email').val(html.data.email);
                    $('#admin_id').val(html.data.admin_id);
                    $('#admin_email').val(html.data.admin_email);
                    $('#passlabel,#password').hide();
                    $('.modal-title').text("Edit Data");
                    $('.modal-title_delete').text("data will be delete");
                    $('#action_button').val("Update");
                    $('#action').val("Update");
                    $('#user_formModal').modal('show');
                    $('#hidden_id').val(id);

                }
            })
        });


        var id;
        $(document).on('click', '.delete', function () {
            id = $(this).attr('id');
            name = $(this).attr('name');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            console.log('working delete button');
            $('#name_form').show();
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('api/v1/j/user/destroy')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                beforeSend: function () {
                    $('#ok_button').text('Deleting..');
                },
                success: function (data) {
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.message +
                            '</div>';
                        $('#form_result').html(html);
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#ok_button').text('OK');
                            $('#userTable').DataTable().ajax.reload();
                            // alert('Data Deleted Successfully'+data.success);
                        }, 2000);
                    } else {
                        $('#confirmModal').modal('hide');
                        $('#ok_button').text('OK');
                        $('#reextendmodel').modal('show');
                        console.log('user name aa raha hai'.name);
                        $('#name_manager').html(name);
                        $('#form_result').html("");
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
    });

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

</script>
@endpush
