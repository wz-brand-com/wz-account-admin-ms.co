@extends('layouts.backend.mainlayout')
@section('title','Account Admin')
@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript"> localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());</script>
<style>li{list-style:none;}</style>
<!-- hidden Auth email and id for calling in json index -->

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Task Type Section </h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">System Setting</a></li>
            <li class="breadcrumb-item active">Task Type</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        {{-- model  open --}}
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn btn-primary ">Select Task Type</button>
                            </div>
                            <div class="col-md-2">
                                <!-- <button type="button" name="create_more" id="create_more" class="btn btn-success ">Add
                                    More Task Type</button> -->
                            </div>

                        </div>
                        <!-- Table for showing data start -->
                        <table id="taskTable" class="table">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- Table for showing data end -->
                        <!-- Popup modal form start -->
                        <div id="formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Select Task Type</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Success Message after submit -->
                                        <span id="form_result" aria-hidden="true"></span>
                                        <div class="alert alert-danger" style="display:none"></div>
                                        <!-- Error Message after form not submit -->

                                        <form method="post" id="sample_form" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group" id="name_form">
                                                <label class="control-label">Select Task Type </label>
                                                <select name="task_type" id="task_type" class="form-control mt-3">
                                                    <option value="" class="text-center"> -----</option>
                                                   @foreach($taskTypeFromSiteAdmin as $task_typ)
                                                        <option  value="{{$task_typ['tasktype']}}" name="{{$task_typ['id']}}" >{{$task_typ['tasktype']}}</option>
                                                        @endforeach     
                                                </select>

                                            </div>
                                            <!-- Sending superadmin_id and superadmin_email in hidden input box -->
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"id="admin_id" /> 
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"id="admin_email" /> 
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="auth_id" /> 
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />  
                                            <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                            <input type="hidden" value="null" name="user_id" id="user_id">
                                            <input type="hidden" value="null" name="user_email" id="user_email">
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id" id="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                                            <input type="hidden" name="taskTypeId" id="taskTypeId">
                                    </div>

                                    <br />
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
                        <!-- ======================================add task type more open ========================================= -->

                    
                        <!-- ====================================== add task type more close===================================== -->
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
                                                        class="text-primary"> </span>
                                                    is working in this <span class="text-primary">Task Manager of Task
                                                        Borad</span> program getting error message,</p>
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
                                        this Task Type?</h4>
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
    // data table open with fetching

    $(document).ready(function () {
        // image load
        window.addEventListener("load", function () {
            $(".loader").delay(500).fadeOut("slow");
        });
        // image load close
        // var id = $('#admin_id').val();
        var id = $('#u_org_organization_id').val();
        var dt = $('#taskTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/task/index')}}/" + id,
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
                    "width": "5%"
                },
                {
                    "title": "Task Name",
                    "targets": 1,
                    "width": "45%"
                },
                {
                    "title": "Action",
                    "targets": 2,
                    "width": "20%"
                },
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'task_type'
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<div class="row"><div class="col-2"><button type="button"  id="' +
                            data['id'] +
                            '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-2"><button type="button" id="' +
                            data['id'] +
                            '"  class="btn btn-danger  delete"><i class="mdi mdi-delete"></i></button></div> </div>'
                    },
                },
            ],
        });
        // data table close

        // model will be display on add and edit button click
        $('#create_record').click(function () {
            $('#name_form').show();
            $('#sample_form')[0].reset();
            $('#form_result').html('');
            $('.modal-title').text("Task Type");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        // model will be close


        // ====================================== open model for add more task type open  ========================
        // model will be display on add and edit button click
        $('#create_more').click(
    function () { // jab create_more pe click hoga tab ek model open hoga model ka name step-2
            $('#name_form').show();
            $('#sample_form_more')[0].reset();
            $('#form_result_more').html('');
            $('.modal-title').text("Add More Task Type");
            $('#action_button').val("Add");
            $('#action_more').val("Add");
            $('#formModal_more').modal('show'); // model name step-2
        });
        // add more task type close
       
        $('#sample_form_more').on('submit', function (event) {
            event.preventDefault();
            // data add working on submit button
           
            
            // add more task type open
            if ($('#action_more').val() == "Add") {
                console.log('profile update button pe click ho rha hai');
                $.ajax({
                    url: "{{url('api/v1/j/task/store') }}",
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
                        console.log(' value store ho gaya..');
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result_more').html(html);
                            setTimeout(function () {
                                $('#formModal_more').modal('hide');
                                // $('#taskTable').DataTable().ajax.reload();
                                location.reload(true);
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result_more').html(html);
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
        // ===============================================update pic close  ========================================

        // ====================================== open model for add more task type close  ========================


        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            var taskTypeId = $("#task_type option:selected").attr("name");
            console.log('task type ka id aaya ki nahi'+taskTypeId);
            $("#taskTypeId").val(taskTypeId);
            // data add working on submit button
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{url('api/v1/j/task/store') }}",
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
                        console.log(' value store ho gaya..');
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#taskTable').DataTable().ajax.reload();
                                // location.reload(true);
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                    },
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
                    url: "{{url('api/v1/j/task/update/') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    success: function (data) {
                        console.log('update ho gaya successfully');
                        //Setting time for show below success message
                        setTimeout(function () {
                            $('#formModal').modal('hide');
                            // $('#taskTable').DataTable().ajax.reload();
                            location.reload(true);
                        }, 2000);

                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success +
                                '</div>';
                            $('#form_result').html(html);
                        }
                    },
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
                url: "{{url('api/v1/j/task/edit/')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    //  i am not using this drop down close
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    $('#task_type').val(html.data.task_type);
                    $('#sa_id').val(html.data.admin_id);
                    $('#sa_email').val(html.data.admin_email);
                    $('.modal-title').text("Edit Task Type");
                    $('.modal-title_delete').text("Task will be delete");
                    $('#action_button').val("Update");
                    $('#action').val("Update");
                    $('#formModal').modal('show');
                    $('#hidden_id').val(id);

                }
            })
        });


        var id;
        $(document).on('click', '.delete', function () {
            id = $(this).attr('id');

            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            console.log('working delete button');
            $('#name_form').show();
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('api/v1/j/task/destroy')}}/" + id,
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
                            $('#taskTable').DataTable().ajax.reload();
                            // alert('Data Deleted Successfully'+data.success);
                        }, 2000);
                    } else {
                        $('#confirmModal').modal('hide');
                        $('#ok_button').text('OK');
                        $('#reextendmodel').modal('show');

                    }
                    // testing close
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
    });

</script>

@endpush
