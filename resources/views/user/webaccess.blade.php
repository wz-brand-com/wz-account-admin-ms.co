@extends('layouts.backend.mainlayout')
@section('title','User WebAccess')

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
        <h3 class="text-themecolor">Seo Assets Section</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Seo Assets</a></li>
            <li class="breadcrumb-item active">Website & Access</li>
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
                                    class="btn btn-primary ">Add Assets</button>
                            </div>
                        </div>
                                    
                        <table id="WebAccessTable" class="table">
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
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add Assets</h5>
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
                                                        <label class="control-label">Type of Assets </label>
                                                        <select name="type_of_task" id="type_of_task"  class="form-control">
                                                        <option value="default" class="form-control text-dark">Select Types of Assets </option>
                                                        <!-- @foreach($taskTypeFromSiteAdmin as $task_typ)
                                                        <option  value="{{$task_typ['tasktype']}}" name="{{$task_typ['id']}}" >{{$task_typ['tasktype']}}</option>
                                                        @endforeach  -->
                                                        <option value="Social Media Sites">Social Media Sites</option>
                                                        <option value="Social Bookmarking Sites">Social Bookmarking Sites</option>
                                                        <option value="Video Submission Sites">Video Submission Sites</option>
                                                        <option value="Images Submission Sites">Images Submission Sites</option>
                                                        <option value="Blogs Submission Sites">Blogs Submission Sites</option>
                                                        <option value="Articles Submission Sites">Articles Submission Sites</option>
                                                        <option value="Forums Sites">Forums Sites</option>
                                                        <option value="Social Media data">Social Media data</option>
                                                        <option value="Press Releases">Press Releases</option>
                                                        <option value="News News">News News</option>
                                                        <option value="Web pages Sites">Web pages Sites</option>
                                                        <option value="Location data">Location data</option>
                                                        <option value="Podcasts">Podcasts</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Website</label> 
                                                        <input type="text" name="website" id="website" class="form-control" autocomplete="off" /> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Email Address</label> 
                                                        <input type="text" name="email_address" id="email_address" class="form-control" autocomplete="off" /> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">User Name</label> 
                                                        <input type="text" name="user_name" id="user_name" class="form-control" autocomplete="off"/> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label> 
                                                        <input type="password" name="password" id="password" class="form-control" autocomplete="off" /> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Page URL</label> 
                                                        <input type="url" name="page_url" id="page_url" class="form-control" autocomplete="off" placeholder="https://example.com"/> 
                                                            <span class="text-danger">(*https:// or http://*)</span>
                                                    </div>   
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="control-label">Manage By</label> 
                                                        <select name="maintenance_engineer" id="maintenance_engineer" class="form-control">
                                                            <option value="default" class="form-control text-dark">Select Email </option>
                                                            
                                                            @if($web_access_user == NULL)
                                                            <option  type="text" value="{{Auth::user()->email}}" name="maintenance_engineer" id="maintenance_engineer" >{{Auth::user()->email}} </option>

                                                            @else
                                                            @foreach($web_access_user as $manager)
                                                            <option  value="{{$manager['u_org_user_email']}}" name="{{$manager['u_org_user_id']}}" >{{$manager['u_org_user_email']}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>  
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
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove this Webaccess?</h4>
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
    user_id = $('#user_id').val();
    var dt = $('#WebAccessTable').DataTable({
        // adding copy button
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5'
        ],
        language: {
            buttons: {
                copyTitle: 'Copy Data',
                copyKeys: 'Ctrl + C',
                copySuccess: {
                    _: '%d lignes copiées',
                    1: '1 ligne copiée'
                }
            }
        },
        // adding copy button end
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/webaccess')}}/"+id,
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
        data :{user_id},          
        responsive: true,
        rowReorder: false,
        columnDefs: [
            {"title": "ID","targets": 0,"width": "5%"},
            {"title": "Types of Assests","targets": 1,"width": "15%"},
            {"title": "Website","targets": 2,"width": "15%"},
            {"title": "Email","targets": 3,"width": "10%"},
            {"title": "Manage By","targets": 4,"width": "15%"},
            {"title": "Password","targets": 5,"width": "10%"},
            {"title": "Page URL","targets": 6,"width": "10%"},
            // {"title": "Action","targets": 7,"width": "10%"},
             ],
        columns: [
            
            {
                data: 'id'
            },
            {
                data: null,
                render: function(data, type, row) 
                {
                    return '<p class="label label-light-info"> ' + data['type_of_task'] + ' </p>'
                },
            },
            {
                data: null,
                render: function(data, type, row) 
                {
                    return '<p> ' + data['website'].slice(0, 12) + ' </p>'
                },
            },
            {data: 'email_address'},
            {
                data: null,
                render: function(data, type, row) 
                {
                    return '<p class="label label-light-warning"> ' + data['user_name'] + ' </p>'
                },
            },
            {
                data: null,
                render: function(data, type, row) 
                {
                    return '<code> ' + data['password'].slice(0, 12) + ' </code>'
                },
            },
            
            {
                data: null,
                render: function(data, type, row) 
                {
                    return '<a href="'+data['page_url']+'" class="btn waves-effect waves-light btn-xs btn-info" target="_blank">Click Here </a>'
                },
            },


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
        $('.modal-title').text("Add New Assets");
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
                url: "{{route('webaccess.store') }}",
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
                    // adding alert messages
                    console.log(data.errors);
                      // adding alert messages for success and exist data validation open
                      var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#WebAccessTable').DataTable().ajax.reload();
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
                url: "{{url('/api/v1/j/webaccess/update/') }}",
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
                   
                    // adding alert messages
                    console.log(data.errors);
                    // adding alert messages for success and exist data validation open
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#WebAccessTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                        // adding alert messages for success and exist data validation close
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
            url: "{{url('/api/v1/j/webaccess/edit/')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html);
                $('#type_of_task').val(html.data.type_of_task);            
                $('#website').val(html.data.website);            
                $('#email_address').val(html.data.email_address);            
                $('#user_name').val(html.data.user_name);            
                $('#password').val(html.data.password);            
                $('#page_url').val(html.data.page_url); 
                $('#maintenance_engineer').val(html.data.maintenance_engineer);            
                $('.modal-title').text("Edit Web Access");
                $('.modal-title_delete').text("Web Access Delete");
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
            url: "{{url('api/v1/j/webaccess/destroy')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            beforeSend: function() {
                $('#ok_button').text('Deleting..');
            },
            success: function(data) {
                $('#ok_button').text('OK');
                $('#confirmModal').modal('hide');
                $('#WebAccessTable').DataTable().ajax.reload()
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })
    });
});
</script>
@endpush