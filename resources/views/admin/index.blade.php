@extends('layouts.backend.mainlayout')
@section('title','Admin')
@section('content')
{{-- <input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());
</script> --}}
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Superadmin </h3>
    </div>
    <div class="col-md-7 align-self-center">
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">System Setting</a></li>
            <li class="breadcrumb-item active">Task</li>
        </ol> -->
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

                        {{-- model  open --}}
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn btn-primary ">Add New Admin</button>
                            </div>

                        </div>

                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th data-column_name="id" width="5%">id</th>
                                    <th data-column_name="name" width="30%">Name</th>
                                    <th data-column_name="email" width="30%">Email</th>
                                    <th data-column_name="password" width="30%">Password</th>
                                    <th width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                        {{-- imager loader open --}}
                        <div class="loader text-center">
                            <img src="{{asset('assets/images/loading.gif')}}" alt="Loading..." />
                        </div>
                        {{-- imager loader close --}}

                        <div id="formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Super Admin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="sample_form" class="form-horizontal"
                                            enctype="multipart/form-data" onsubmit="return validation()">
                                            @csrf

                                            <div class="form-group" id="name_form">
                                                <label class="control-label col-md-4">User Name </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" id="name" class="form-control" />
                                                    <span id="username" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group" id="name_form">
                                                <label class="control-label col-md-4">User Email </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="email" id="email" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="form-group" id="name_form">
                                                <label class="control-label col-md-4">Password</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="password" id="password"
                                                        class="form-control" />
                                                </div>
                                            </div>

                                            <!-- <input type="text" value="{{ Auth::user()->id }}" name="admin_id"
                                                id="admin_id" />
                                            <input type="text" value="{{ Auth::user()->email }}" name="admin_email"
                                                id="admin_email" /> -->
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
                    </div>
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
                                        this Task?</h4>
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

$(document).ready(function() {
    var dt = $('#myTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('/api/v1/j/admin/index')}}",
            "dataSrc": 'data',
            "type": "GET",
            "datatype": "json",
            "crossDomain": true,
            "beforeSend": function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem(
                'a_u_a_b_t'));
            }
        },
        processing: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        rowReorder: false,
        columnDefs: [{
            "title": "id",
            "targets": 0,
            "width": "20%"
        }, ],
        columns: [{
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'password'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="row"><div class="col-6"><button type="button"  id="' +
                        data['id'] +
                        '" class="edit btn btn-primary">Edit</button></div><div class="col-2"><button type="button" id="' +
                        data['id'] +
                        '"  class="btn btn-danger  delete">Delete</button></div> </div>'
                },
            },
        ],


    });
    // data table close

    // model will be display on add and edit button click
    $('#create_record').click(function() {
        $('#name_form').show();
        $('#sample_form')[0].reset();
        $('#form_result').html('');
        $('.modal-title').text("Add New SuperAdmin");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#formModal').modal('show');
    });
    // model will be close

    //  form working start
    $('#sample_form').on('submit', function(event) {
        event.preventDefault();
    
        // data add working on submit button
        if ($('#action').val() == 'Add') {
            console.log('add button click ho rha ha');
            $.ajax({
                url: "{{route('admin.store') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                // success: function(data) {
                //     console.log('Superadmin ka value store ho gaya..');
                //     $('#formModal').modal('hide');
                    
                //     // $('#myTable').DataTable().ajax.reload();
                // },

                  // message alert open
                  success: function(data) {
                    console.log('Manager update ho gaya successfully');
                    //setting 2 second in modal to stay
                    setTimeout(function(){
                        $('#formModal').modal('hide');
                        $('#myTable').DataTable().ajax.reload();
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
                error: function(data) {
                    console.log('Superadmin ka value store nahi rha ha');
                    console.log('Error:', data);
                }
            })
        }


        // update button wotking for updata data
        if ($('#action').val() == "Update") {
            console.log('update button pe click ho rha hai');
            $.ajax({
                url: "{{url('/api/v1/j/superadmin/update/') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                // success: function(data) {
                //     console.log('update ho gaya successfully');
                //     $('#formModal').modal('hide');
                //     $('#myTable').DataTable().ajax.reload()
                // },
                  // message alert open
                  success: function(data) {
                    console.log('Manager update ho gaya successfully');
                    //setting 2 second in modal to stay
                    setTimeout(function(){
                        $('#formModal').modal('hide');
                        $('#myTable').DataTable().ajax.reload();
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
                error: function(data) {
                    console.log('Error:', data);
                    //    this function for hide with id #formModel
                    console.log('update function kamm nahi kr rha hai');
                }
            });
        }
    });
    //
    $(document).on('click', '.edit', function() {
        console.log('working edit button');
        $('#name_form').show();
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{url('/api/v1/j/index/edit/')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                //   drop down open i am not using this
                //    $.each(html.$projects, function(i, $projects) {
                //     $('#project_manager').append("<option value='" + $projects.id + "' selected='selected'>" + $projects.project_manager+ "</option>");
                //     });
                //  i am not using this drop down close
                console.log('value aa gaya edit ke page pe');
                console.log(html);
                // $('#task').val(html.data.task);
                $('.modal-title').text("Edit Task");
                $('.modal-title_delete').text("Task will be delete");
                $('#action_button').val("Update");
                $('#action').val("Update");
                $('#formModal').modal('show');
                $('#hidden_id').val(id);

            }
        })
    });


    var id;
    $(document).on('click', '.delete', function() {
        id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function() {
        console.log('working delete button');
        $('#name_form').show();
        $('#form_result').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{url('api/v1/j/index/destroy')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            beforeSend: function() {
                $('#ok_button').text('Deleting..');
            },
            success: function(data) {
                $('#confirmModal').modal('hide');
                $('#myTable').DataTable().ajax.reload()
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })
    });
});
</script>
@endpush