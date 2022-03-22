@extends('layouts.backend.mainlayout')
@section('title','Manager Project')

@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
    localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());
</script>
<style>
    li {
        list-style: none;
    }


    .tabs {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .table tbody tr td{
    text-align:left;
}

    #tab-button {
        display: table;
        table-layout: fixed;
        width: 100%;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    #tab-button li {
        display: table-cell;
        width: 20%;
    }

    #tab-button li a {
        display: block;
        padding: .5em;
        background: #eee;
        border: 1px solid #ddd;
        text-align: center;
        color: #000;
        text-decoration: none;
    }

    #tab-button li:not(:first-child) a {
        border-left: none;
    }

    #tab-button li a:hover,
    #tab-button .is-active a {
        border-bottom-color: transparent;
        background: #5c4ac7;
        color: white;
    }

    .tab-contents {
        padding: .5em 2em 1em;
        border: 1px solid #ddd;
    }



    .tab-button-outer {
        display: none;
    }

    .tab-contents {
        margin-top: 20px;
    }

    @media screen and (min-width: 768px) {
        .tab-button-outer {
            position: relative;
            z-index: 2;
            display: block;
        }

        .tab-select-outer {
            display: none;
        }

        .tab-contents {
            position: relative;
            top: -1px;
            margin-top: 0;
        }
    }
</style>
<!-- hidden Auth email and id for calling in json index -->
<input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="auth_id" />
<input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

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

    <div class="card">
        <div class="card-body">
            <div class="tabs">
                <div class="tab-button-outer">
                    <ul id="tab-button">
                        <li><a href="#tab01">New Projects</a></li>
                        <li><a href="#tab02">New URLS</a></li>
                      
                    </ul>
                </div>
                <div class="tab-select-outer">
                    <select id="tab-select">
                        <option value="#tab01">Add New Project</option>
                        <option value="#tab02">Tab 2</option>
                    </select>
                </div>

                <div id="tab01" class="tab-contents">
                    <br><button type="button" name="create_record" id="create_record" class="btn btn-primary ">Add New
                        Project</button>

                    <table id="projectTable" class="table">
                        <thead>
                            <tr>
                                <th  width="10%">id</th>
                                <th  width="35%">Project Name</th>
                                <th  width="35%">wizard</th>
                                <th  width="35%">Project Manager</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>

                    <div id="formModal" class="modal fade" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Project</h5>
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
                                            <label class="control-label">Project Name </label>
                                            <input type="text" name="project_name" id="project_name" autocomplete="off"
                                                class="form-control" />
                                            <span id="username" class="text-danger"></span>
                                        </div>

                                        <div class="form-group" id="name_form">
                                            <label class="control-label">Project Manager</label>
                                            
                                                <select name="project_manager" id="project_manager" class="w-100 p-2">
                                                <option value="{{Auth::user()->email}}" class="form-controll text-dark">Select Manager </option>
                                                @if($project_managers == NULL)
                                                <option value="{{Auth::user()->email}}">{{Auth::user()->email}}</option>
                                                @else
                                                @foreach($project_managers as $manager)
                                                <option  value="{{$manager['u_org_user_email']}}" name="{{$manager['u_org_user_id']}}" >{{$manager['u_org_user_email']}}</option>
                                                    @endforeach  
        
                                                @endif
                                                </select>
                                                
                                        </div>
                                        <!-- Sending admin_id and admin_email in hidden input box -->
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                            id="admin_id" />
                                        <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"
                                            id="admin_email" />
                                        <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                        <input type="hidden" value="NULL" name="user_id" id="user_id">
                                        <input type="hidden" value="NULL" name="user_email" id="user_email">
                                </div>
                                <input type="hidden" value="" name="admin_gen_id" id="admin_gen_id">
                                <!-- <br /> -->
                                <div class="form-group text-center">
                                    <input type="hidden" name="action" id="action" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button" id="action_button"
                                        class="btn btn-warning float-center" value="Add" />
                                    <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                    <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id"
                                        id="u_org_organization_id">
                                    <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id"
                                        id="u_org_role_id">

                                </div>
                                </form>
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
                                                <button type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title" style="color:red;">Message </h3>
                                                <p class="card-text">The action can not be completed because the <span
                                                        class="text-primary" name="project_name_display"
                                                        id="project_name_display"> </span> project name
                                                    is working in this <span class="text-primary">Rank & Rating of
                                                        Website Ranking</span> program getting error message,</p>
                                                <a href="#" class="close"
                                                    data-dismiss="modal"><i
                                                        class="fa fa-times-circle text-danger"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data cannot delete after model close -->
                

                    {{-- model close --}}

                </div>
                <div id="tab02" class="tab-contents">
                    <br>
                    <button type="button" name="create_record_url" id="create_record_url" class="btn btn-primary ">Add
                        New Url
                    </button>
                    <!-- {{-- modal start here  --}} -->

                    <table id="urlTable" class="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-left">id</th>
                                <th class="text-left" width="30%">Web URLs</th>
                                <th class="text-left" width="30%">Project</th>
                                <th class="text-left" width="40%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div id="formModal_urlss" class="modal fade" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Url</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Success Message after submit -->
                                    <span id="form_result_new" aria-hidden="true"></span>
                                    <!-- Error Message after form not submit -->
                                    <form method="post" id="sample_form_url" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group" id="name_form_url_new">
                                            <label class="control-label col-md-4">URL </label>
                                            <div class="col-md-12">
                                                <input type="url" name="url" id="url" class="form-control"
                                                    autocomplete="off" placeholder="https://example.com" />
                                                    <span class="text-danger">(*https:// or http://*)</span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="name_form_url_new">
                                            <label class="control-label col-md-4">Project Name</label>
                                            <div class="col-md-12">
                                                <select name="project_name" id="project_name_url" class="w-100 p-2">
                                                    <option value="" class="form-controll text-dark">Select Project
                                                    </option>
                                                    @foreach(App\Http\Controllers\Api\ProjectApiController::getvalueall($slug_id)
                                                    as $project)
                                                    <option name="{{$project['project_name']}}"
                                                        value="{{$project['id']}}">{{$project['project_name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                            id="admin_id" />
                                        <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"
                                            id="admin_email" />
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                            id="auth_id" />
                                        <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"
                                            id="auth_email" />
                                        <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                        <input type="hidden" value="null" name="user_id" id="user_id">
                                        <input type="hidden" value="null" name="user_email" id="user_email">
                                        <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname"> <br>
                                        <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id"
                                            id="u_org_organization_id">
                                        <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id"
                                            id="u_org_role_id">
                                


                                <!-- <br /> -->
                                <div class="form-group text-center">
                                    <input type="hidden" name="action" id="action" />
                                    <input type="hidden" name="addurl_hidden_id" id="addurl_hidden_id" />
                                    <input type="submit" name="action_button_url" id="action_button_url"
                                        class="btn btn-warning float-center" value="Add" />
                                </div>
                            </form>
                        </div>
                            </div>
                        </div>
                    </div>

                    <!-- data cannot delete after  model open -->
                    <!-- data cannot delete after  model open -->
                    
                        <div class="col-lg-10">
                            <div id="reextendmodel_url" class="modal" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-header" style="color:red;font-weight:bold;">
                                                Error
                                                <button type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title" style="color:red;">Message </h3>
                                                <p class="card-text">The action can not be completed because the <span
                                                        class="text-primary" name="url_name_display"
                                                        id="url_name_display"> </span> Url
                                                    is working in this <span class="text-primary">Rank & Rating of Page
                                                        Ranking</span> program getting error message,</p>
                                                <a href="#" class="close"
                                                    data-dismiss="modal"><i
                                                        class="fa fa-times-circle text-danger"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    <!-- data cannot delete after model close -->
                    <div id="confirmModal_url" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <button type="button" class="close" id="closeurl"
                                        data-dismiss="modal">&times;</button>
                                    <br>
                                    <span class="modal-title_delete">Confirmation</span>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove
                                        this URL?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" name="ok_button_url" id="ok_button_url"
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
                    this Project?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button"
                    class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
        // id = $('#u_org_role_id').val();
        slug_id = $('#u_org_organization_id').val();
        console.log('organization id is calling here ' + slug_id);
        var dt = $('#projectTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/project/index')}}/" + slug_id,
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
                    
                },
                {
                    "title": "Project Name",
                    "targets": 1,
                   
                },
                {
                    "title": "wizard",
                    "targets": 2,
                   
                },
                {
                    "title": "Project Manager",
                    "targets": 3,
                   
                },
                {
                    "title": "Action",
                    "targets": 4,
                   
                },
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'project_name'
                },
                  //    wizard open
            {
                    data: null,
                    render: function (data, type, row) {
                        return '<div class="row"><div class="col-6"><a target="_blank"href="https://www.wizbrand.com/orgs/'+data['slugname']+'/start-wizard/' +data['project_name']+ '/'+ data['id']+ ' "> Start Wizard</a></div> </div>'
                    },
                },
            //    wizard close
                {
                    data: 'project_manager'
                },
               

                {
                    data: null,
                    render: function (data, type, row) {
                        return '<div class="row"><div class="col-6"><button type="button"  id="' +
                            data['id'] +
                            '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div></div>'
                            // <div class="col-2">
                            //     <button type="button" id="' +data['id'] + '" name="' + data['project_name'] +
                            //     '"  class="btn btn-danger  delete"><i class="mdi mdi-delete"></i></button>
                            // </div>        
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
            $('.modal-title').text("Add New Project");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        // model will be close

        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            // admin_gen_id taking by select manager open
            var admin_gen_id_value = $("#project_manager option:selected").attr("name");
            console.log('admin_gen_id ka value aa gaya' + admin_gen_id_value);
            $('#admin_gen_id').val(admin_gen_id_value);
            // admin_gen_id taking by select manager close

            // data add working on submit button
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{route('project.store') }}",
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
                        console.log(data.errors);
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#projectTable').DataTable().ajax.reload();
                                window.location.reload();
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
                    url: "{{url('/api/v1/j/project/update/') }}",
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
                        console.log(
                            'abhi ham success function ke ander aaye hai update krne pe'
                            );
                        console.log(data.errors);
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#projectTable').DataTable().ajax.reload();
                                
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                    },

                    // message alert close

                    error: function (data) {
                        console.log(' value store nahi rha ha');
                        console.log('Error:', data);
                    }
                });
            }
            // update function close
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
                url: "{{url('/api/v1/j/project/edit/')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    $('#project_name').val(html.data.project_name);
                    $('#project_manager').val(html.data.project_manager);
                    $('#sa_id').val(html.data.sa_id);
                    $('#sa_email').val(html.data.sa_email);
                    $('.modal-title').text("Edit Project");
                    $('.modal-title_delete').text("Project Delete");
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
            project_name = $(this).attr('name');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            console.log('working delete button');
            $('#name_form').show();
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('api/v1/j/project/destroy')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                beforeSend: function () {
                    $('#ok_button').text('Deleting..');
                },
                success: function (data) {
                    // $('#ok_button').text('OK');
                    // $('#confirmModal').modal('hide');
                    // $('#projectTable').DataTable().ajax.reload();
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.message +
                        '</div>';
                        $('#form_result').html(html);
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#ok_button').text('OK');
                            $('#projectTable').DataTable().ajax.reload();
                            // alert('Data Deleted Successfully'+data.success);
                        }, 2000);
                    } else {
                        $('#confirmModal').modal('hide');
                        $('#ok_button').text('OK');
                        $('#reextendmodel').modal('show');
                        console.log('user name aa raha hai'.project_name);
                        $('#project_name_display').html(project_name);
                        $('#form_result').html("");
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
    });

    // tabpan start here 

    $(function () {
        var $tabButtonItem = $('#tab-button li'),
            $tabSelect = $('#tab-select'),
            $tabContents = $('.tab-contents'),
            activeClass = 'is-active';

        $tabButtonItem.first().addClass(activeClass);
        $tabContents.not(':first').hide();

        $tabButtonItem.find('a').on('click', function (e) {
            var target = $(this).attr('href');

            $tabButtonItem.removeClass(activeClass);
            $(this).parent().addClass(activeClass);
            $tabSelect.val(target);
            $tabContents.hide();
            $(target).show();
            e.preventDefault();
        });

        $tabSelect.on('change', function () {
            var target = $(this).val(),
                targetSelectNum = $(this).prop('selectedIndex');

            $tabButtonItem.removeClass(activeClass);
            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
            $tabContents.hide();
            $(target).show();
        });
    });

    // model will be display on add and edit button click
</script>

<!-- {{-- add new url start here  --}} -->

<script>
    $(document).ready(function () {
        // image load
        window.addEventListener("load", function () {
            $(".loader").delay(500).fadeOut("slow");
        });
        console.log('trying to call api');
        var slug_id = $('#u_org_organization_id').val();
        console.log('organization id is calling here ' + slug_id);
        var dt = $('#urlTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/addurl/index')}}/" + slug_id,
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

                {
                    "title": "ID",
                    "targets": 0,
                    "width": "30%"
                },
                {
                    "title": "URL",
                    "targets": 1,
                    "width": "60%"
                },
                {
                    "title": "Project Name",
                    "targets": 2,
                    "width": "5%"
                },
                {
                    "title": "Action",
                    "targets": 3,
                    "width": "25%"
                },

            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'url'
                },
                {
                    data: 'project_name'
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<div class="row"><div class="col-4"><button type="button"  id="' +
                            data['id'] +
                            '" class="edit_url btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div></div>'
                    },
                },
            ],


        });
        // data table close

        // model will be display on add and edit button click
        $('#create_record_url').click(function () {
            $('#name_form_url_new').show();
            $('#sample_form')[0].reset();
            $('#form_result_new').html('');
            $('.modal-title').text("Add New URL");
            $('#action_button_url').val("Add");
            $('#action').val("Add");
            $('#formModal_urlss').modal('show');

        });
        // model will be close

        //  form working start
        $('#sample_form_url').on('submit', function (event) {
            event.preventDefault();
            // $("#selectedProject").attr("project_id");
            var project_name = $("#project_name_url option:selected").attr("name");
            console.log('proect ka value aaa rha hai' + project_name);
            // data add working on submit button
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{url('api/v1/j/addurl/store') }}/" + project_name,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    headers: {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    // validaion open

                    // validaion close
                    success: function (data) {
                        console.log('abhi ham success function ke ander aaye hai');
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result_new').html(html);
                            setTimeout(function () {
                                $('#formModal_urlss').modal('hide');
                                $('#urlTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result_new').html(html);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        console.log('error part main aa agye hai');
                    }
                })
            }

            // update button wotking for updata data
            if ($('#action').val() == "Update") {
                console.log('update button pe click ho rha hai');
                $.ajax({
                    // url: "{{url('api/v1/j/addurl/update') }}",
                    url: "{{Route('add_url.update') }}",
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
                        console.log('update ho gaya successfully new update');
                        // $('#formModal_urlss').modal('hide');
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result_new').html(html);
                            setTimeout(function () {
                                $('#formModal_urlss').modal('hide');
                                // window.location.reload();

                                $('#urlTable').DataTable().ajax.reload();
                            }, 2000);

                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result_new').html(html);
                        }
                    },
                    // message alert close
                    error: function (data) {
                        console.log('Error:', data);
                        console.log('update function kamm nahi kr rha hai');
                    }
                });
            }
        });
        //
        $(document).on('click', '.edit_url', function () {
            console.log('working edit button');
            $('#name_form_url_new').show();
            var id = $(this).attr('id');
            $('#form_result_new').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('/api/v1/j/addurl/edit/')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    $('#url').val(html.data.url);
                    $('#project_name').val(html.data.project_name);
                    $('#project_name').val(html.data.project_id);
                    $('#admin_id').val(html.data.admin_id);
                    $('#admin_email').val(html.data.admin_email);
                    $('.modal-title').text("Edit URL");
                    $('.modal-title_delete').text("URL Delete");
                    $('#action_button_url').val("Update");
                    $('#action').val("Update");
                    $('#formModal_urlss').modal('show');
                    $('#addurl_hidden_id').val(id);
                    // window.location.reload();

                }
            })
        });


        var id;
        $(document).on('click', '.deletes', function () {
            id = $(this).attr('id');
            url_name = $(this).attr('name');
            $('#confirmModal_url').modal('show');
        });

        $('#ok_button_url').click(function () {
            console.log('working delete button');
            $('#name_form_url_new').show();
            $('#form_result_new').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('api/v1/j/addurl/destroy')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                beforeSend: function () {
                    $('#ok_button_url').text('Deleting..');
                },
                success: function (data) {
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.message +
                        '</div>';
                        $('#form_result_new').html(html);
                        setTimeout(function () {
                            $('#confirmModal_url').modal('hide');
                            $('#ok_button_url').text('OK');
                            $('#urlTable').DataTable().ajax.reload();
                            // $('#urlTable').DataTable().ajax.reload();
                            window.location.reload();
                            // alert('Data Deleted Successfully'+data.success);
                        }, 2000);
                    } else {
                        $('#confirmModal_url').modal('hide');
                        $('#ok_button_url').text('OK');
                        $('#reextendmodel_url').modal('show');
                        console.log('user name aa raha hai'.url_name);
                        $('#url_name_display').html(url_name);
                        $('#form_result_new').html("");
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
    });
</script>
<!-- {{-- add new url script end here  --}} -->

{{-- amitadd new script  --}}

<script>
    function refreshPage() {
        window.location.reload();
    }
</script>

<!-- {{-- amitadd new end  --}} -->
@endpush