@extends('layouts.backend.mainlayout')

@section('title','Account Admin')
@section('content')

<input type="hidden" id="a_u_a_b_t" value= "{!! $a_user_api_bearer_token !!}" >
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
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">User's Manager Section</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">System Setting</a></li>
            <li class="breadcrumb-item active">Users Manager</li>
        </ol>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        <!-- {{-- model  open --}} -->
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn waves-effect waves-light btn-primary">
                                    Define Manager</button>
                            </div>
                        </div>
                        <table id="umTable" class="table">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- Popup modal start -->
                        <div id="formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add New User Manager</h5>
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
                                                <!-- {{-- drop down value open --}} -->
                                                
                                                <select name="user_name" id="user_name" class="w-100 p-2">
                                                <option value="" class="form-controll text-dark">Select Employee </option>
                                                 @foreach(App\Http\Controllers\Api\AgentController::getvalueall() as $username)

                                                    <option value="{{$username['name']}}">{{$username['name']}}</option>

                                                @endforeach
                                                </select>
                                                <!-- {{-- drop down value close --}} -->

                                            </div>
                                            <span id='message'></span>
                                            <div class="form-group" id="name_form">
                                                <label class="control-label">Manager Name: </label>
                                                    <select name="manager_name" id="manager_name" class="w-100 p-2">
                                                    <option value="" class="form-controll text-dark">Select Manager </option>
                                                     @foreach(App\Http\Controllers\Api\ManagerApiController::getvalueall() as $user)

                                                    <option value="{{$user['name']}}">{{$user['name']}}</option>

                                                    @endforeach
                                                    </select>
                                            </div>

                                            <!-- hidden auth id and email -->
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="admin_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="admin_email" />
                                            <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                            <input type="hidden" value="NULL" name="user_id" id="user_id">
                                            <input type="hidden" value="NULL" name="user_email" id="user_email">
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">

                                    </div>
                                    <br />
                                    <div class="form-group text-center">
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="u_m_hidden_id" id="u_m_hidden_id" />
                                        <input type="submit" name="action_button" id="action_button"
                                            class="btn btn-warning float-center" value="Add" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="confirmModal_u_m" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <br>
                                    <span class="modal-title_delete">Confirmation</span>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove
                                        this User Manager?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" name="delete_u_m" id="delete_u_m"
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
        var dt = $('#umTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('/api/v1/j/usermanager/index')}}/"+id,
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
            columnDefs: [
                {"title": "id", "targets": 0,"width": "20%"},
                {"title": "User Name", "targets": 1,"width": "30%"},
                {"title": "Manager", "targets": 2,"width": "30%"},
                {"title": "Action", "targets": 3,"width": "20%"},
         ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'user_name'
                },
                {
                    data: 'manager_name'
                },

                {
                    data: null,
                    render: function (data, type, row) {
                        return '<div class="row"><div class="col-6"> <button type="button"  id="' +
                            data['id'] +
                            '" class="edit_user_maanger btn btn-primary">Edit</button></div><div class="col-2"><button type="button" id="' +
                            data['id'] +
                            '"  class="btn btn-danger  delete_u_m">Delete</button></div> </div>'
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
            $('.modal-title').text("Define User Manager");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        // model will be close

        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            // data add working on submit button
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{Route('usersmanager.store') }}",
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
                success: function(data) {
                    console.log('user Manager update ho gaya successfully');
                    // adding alert messages
                    console.log(data.errors);
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#umTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                },
                // message alert close
                    error: function (data) {
                        console.log(' value store nahi rha ha');
                        console.log('Error:', data);
                    }
                })
            }
            // update button wotking for updata data
            if ($('#action').val() == "Update_user_manager") {
                console.log('update button pe click ho rha hai');
                $.ajax({
                    url: "{{Route('usermanager_u_m.update') }}",
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
                    //setting 2 second in modal to stay
                    setTimeout(function(){
                        $('#formModal').modal('hide');
                        $('#umTable').DataTable().ajax.reload();
                    }, 2000);
                    
                    // adding alert messages
                    console.log(data.errors);
                    var html = '';
                    if(data.error)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.error.length; count++)
                        {
                        html += '<p>' + data.error[count] + '</p>';
                        }
                        html += '</div>';
                        $('#form_result').html(html);
                    }
                    if(data.message)
                    {
                        html = '<div class="alert alert-success">' + data.message + '</div>';
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
        $(document).on('click', '.edit_user_maanger', function () {
            console.log('working edit button');
            $('#name_form').show();
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('api/v1/j/usermanager/edit_user_manager')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    $('#user_name').val(html.data.user_name);
                    $('#manager_name').val(html.data.manager_name);
                    $('#admin_id').val(html.data.admin_id);
                    $('#admin_email').val(html.data.admin_email);
                    $('.modal-title').text("Edit User Manager");
                    $('.modal-title_delete').text("data will be delete");
                    $('#action_button').val("Update");
                    $('#action').val("Update_user_manager");
                    $('#formModal').modal('show');
                    $('#u_m_hidden_id').val(id);

                }
            })
        });


        var id;
        $(document).on('click', '.delete_u_m', function () {
            id = $(this).attr('id');
            $('#confirmModal_u_m').modal('show');
        });

        $('#delete_u_m').click(function () {
            console.log('working delete button');
        //    
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('api/v1/j/usermanagers/destroy_u_m')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                beforeSend: function () {
                    $('#delete_u_m').text('Deleting..');
                },
                success: function (data) {
                    $('#delete_u_m').text('OK');
                    $('#confirmModal_u_m').modal('hide');
                    $('#umTable').DataTable().ajax.reload()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
    });

</script>


@endpush
