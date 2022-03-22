@extends('layouts.backend.mainlayout')
@section('title','user')
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
        <h3 class="text-themecolor">Invite Member Section</h3>
    </div>
    <div class="col-md-7 align-self-center">

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
                        <!-- {{-- model  open --}} -->
                        <div class="row">
                            <!-- <div class="col-md-8">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn btn-primary ">Invite Member</button>
                            </div> -->
                        </div>
                        <table id="managerTable" class="table">
                            <thead>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <div id="formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <!-- <h5 class="modal-title text-white" id="exampleModalLabel">Add New Manager</h5> -->
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
                                                <label class="control-label">Invite User </label>
                                                <select name="u_org_user_id" id="user_id" class="form-control">
                                                <option value="default" class="form-control text-dark">Select user </option>
                                                    @foreach($getting_all_users as $users)
                                                    <option  value="{{$users['id']}}">{{$users['name']}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group" id="name_form">
                                                <label class="control-label">Invite Role </label>
                                                <select name="u_org_role_id" id="role_id" class="form-control">
                                                <option value="default" class="form-control text-dark">Select Role </option>
                                                    @foreach($rolles as $rolle)
                                                    <option name="{{$rolle['role_id']}}" value="{{$rolle['id']}}">{{$rolle['role_name']}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                           
                                        <input type="hidden" value="{{ Auth::user()->id }}"name="admin_id"id="admin_id"/>
                                        <input type="hidden" value="{{ Auth::user()->name }}"name="admin_name"/>
                                        <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"id="admin_email"/>

                                   

                                        <!-- for account admin below value fo id and email will store it it will get value by auth -->
                                        <input type="hidden" value="null" name="user_id" id="user_id">
                                        <input type="hidden" value="null" name="user_email" id="user_email">
                                        <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                        <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id">
                                        <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                                        <input type="hidden" value="0" name="status">
                                    </div>
                                    <!-- <br /> -->
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
                                                <p class="card-text">The action can not be completed because the Manager
                                                    <span class="text-primary" name="name_manager" id="name_manager">
                                                    </span>
                                                    is working in this <span class="text-primary">Project Onboarding
                                                        Project</span> program getting error message,</p>
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
                                        this Manager?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" name="ok_button" id="ok_button"
                                        class="btn btn-danger">OK</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- {{-- model close --}} -->
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
    $(document).ready(function () {

        // image load
        window.addEventListener("load", function () {
            $(".loader").delay(500).fadeOut("slow");
        });

        console.log('trying to call api');
        // id = $('#admin_id').val();
        org_slug = $('#slug').val();
        console.log(slug);
        var dt = $('#managerTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('orgs/members')}}/"+ org_slug,
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
             // {
                //     "title": "Member Name",
                //     "targets": 1,
                //     "width": "15%"
                // },
              
                {
                    "title": "Member Email",
                    "targets": 1,
                    "width": "20%"
                },
                {
                    "title": "Organization Name",
                    "targets": 2,
                    "width": "20%"
                },
                {
                    "title": "Role",
                    "targets": 3,
                    "width": "5%"
                },
            ],
            columns: [
                { data: 'id' },
                { data: 'u_org_user_email'},
                { data: 'u_org_slugname' },
                { data: 'u_org_role_name' },

               
               
                // {
                //     data: null,
                //     render: function (data, type, row)
                //     {

                //         if (data.status == '1') {
                //             return ' <button type="button" class="btn btn-danger  add_block_user" id="' +
                //                 data['id'] + '">Block  </button>'
                //         } else {
                //             return ' <button type="button" class="btn btn-success add_block_user" id="' +
                //                 data['id'] + '"> Un-block  </button> '
                //         }
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
            $('.modal-title').text("Select member");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        // model will be close


        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{route('managerstore') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    success: function (data) {
                        console.log('abhi ham success function ke ander aaye hai');
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#managerTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        html = '<div class="alert alert-danger">' + data.message + '</div>';
                        console.log('error part main aa agye hai');
                    }
                })
            }

            // update button wotking for updata data
            if ($('#action').val() == "Update") {
                console.log('update button pe click ho rha hai');
                $.ajax({
                    url: "{{route('memberupdate') }}",
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
                    console.log('Manager update ho gaya successfully');
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#managerTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                },
                // message alert close
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
        $(document).on('click', '.add_block_user', function () {
            console.log('working edit button');
            $('#name_form').show();
        var id = $(this).attr('id');
        //   var id = $('#u_org_role_id').val();
          console.log('u_org_role_id value aaa gaya'+id);
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('member_active_deactive_user')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('value aa gaya edit ke page pe');
                    setTimeout(function () {
                                $('#managerTable').DataTable().ajax.reload();
                            }, 2000);
                }
            })
        });
    });
</script>
@endpush
