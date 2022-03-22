@extends('layouts.backend.mainlayout')
@section('title','User Email')

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
        <h3 class="text-themecolor">Email Access Section</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">SEO Assets</a></li>
            <li class="breadcrumb-item active">Email</li>
        </ol>
    </div>
</div> --}}
<br><br><br>
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


                    <div class="">

                        {{-- model  open --}}
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn btn-primary ">Add New Email</button>
                            </div>
                        </div>
                                    
                        <table id="EmailAccessTable" class="table">
                            <thead>
                               <!-- data fetching from database -->
                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                        <div id="formModal" class="modal fade" role="dialog">
                        
                            <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
                                
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add Email</h5>
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
 
                                            <div class="row">
                                                <div class="col-md-6" id="name_form"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Email </label>
                                                        <input type="email" name="email" id="email" autocomplete="off" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label> 
                                                        <input type="password" name="password" id="password" autocomplete="off" class="form-control" /> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Phone Number</label> 
                                                        <input type="number" name="phone_number" id="phone_number" autocomplete="off" class="form-control" /> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Password Hint</label> 
                                                        <input type="text" name="password_hint" id="password_hint" autocomplete="off" class="form-control" /> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Account Recovery Details</label> 
                                                        <input type="text" name="account_recovey_details" id="account_recovey_details" class="form-control" autocomplete="off" /> 
                                                    </div>
                                                </div>
                                               
                                            </div>


                                             <!-- Sending admin_id and admin_email in hidden input box -->
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                                id="admin_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"
                                                id="admin_email" />
                                                
                                               <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                            <input type="hidden" value="NULL" name="user_id" id="user_id">
                                            <input type="hidden" value="NULL" name="user_email" id="user_email">
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id" id="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id"> 
                                            <!-- Sending admin_id and admin_email in hidden input box end-->
                                    </div>

                                    <!-- <br /> -->
                                    <div class="form-group text-center">
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="email_hidden_id" id="email_hidden_id" />
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
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove this Email?</h4>
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
 // image load
 window.addEventListener("load", function() {
   $(".loader").delay(500).fadeOut("slow");
});
    console.log('trying to call api');
    id = $('#u_org_organization_id').val();
    var dt = $('#EmailAccessTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/email/index')}}/"+id,
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
        language: {
            processing: "<img src='../../assets/images/loader.gif' style='z-index:1071;background-color:white;border-radius:8pt;padding-top:4pt;padding-bottom:4pt;position:fixed;top:0;right:0;bottom:0;left:0;margin:auto;'>"
        },
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        rowReorder: false,
        columnDefs: [
            {"title": "ID","targets": 0,"width": "10%"},
            {"title": "Email","targets": 1,"width": "10%"},
            {"title": "Mobile","targets": 2,"width": "15%"},
            {"title": "password_hint","targets": 3,"width": "15%"},
            {"title": "Password","targets": 4,"width": "10%"},
            {"title": "Account Recovery","targets": 5,"width": "15%"},
           
             ],
        columns: [{
                data: 'id'
            },
            {data:'email'}, { data: 'phone_number'},{data: 'password_hint'},{data: 'password'},
            {data:'account_recovey_details'},
            
            // {
            //     data: null,
            //     render: function(data, type, row) {
            //         return '<div class="row"><div class="col-6"><button type="button"  id="' +
            //             data['id'] +
            //             '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-2"><button type="button" id="' +
            //             data['id'] +
            //             '"  class="btn btn-danger  delete"><i class="mdi mdi-delete"></i></button></div> </div>'
            //     },
            // },
        ],


    });
    // data table close

    // model will be display on add and edit button click
    $('#create_record').click(function() {
        $('#name_form').show();
        $('#sample_form')[0].reset();
        $('#form_result').html('');
        $('.modal-title').text("Add New email");
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
                url: "{{route('email.store') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function(data) {
                    console.log('Data store ho gaya');
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#EmailAccessTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                        // adding alert messages for success and exist data validation close
                  
                },
                error: function(data) {
                    console.log('Error:', data);
                    //    this function for hide with id #formModel
                    console.log('update function kamm nahi kr rha hai');
                }
            })
        }

        // update button wotking for updata data
        if ($('#action').val() == "Update") {
            console.log('update button pe click ho rha hai');
            $.ajax({
                // url: "{{url('api/v1/j/email/update') }}",
                url: "{{route('email.update') }}",
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
                        $('#EmailAccessTable').DataTable().ajax.reload();
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
            url: "{{url('/api/v1/j/email/edit/')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html);
                $('#email').val(html.data.email);            
                $('#password').val(html.data.password);            
                $('#phone_number').val(html.data.phone_number);            
                $('#password_hint').val(html.data.password_hint);            
                $('#account_recovey_details').val(html.data.account_recovey_details);
                $('.modal-title').text("Edit Email");
                $('.modal-title_delete').text("Email Delete");
                $('#action_button').val("Update");
                $('#action').val("Update");
                $('#formModal').modal('show');
                $('#email_hidden_id').val(id);
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
            url: "{{url('api/v1/j/email/destroy')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            beforeSend: function() {
                $('#ok_button').text('Deleting..');
            },
            success: function(data) {
                $('#confirmModal').modal('hide');
                $('#EmailAccessTable').DataTable().ajax.reload()
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })
    });
});
</script>
@endpush