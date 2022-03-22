@extends('layouts.backend.mainlayout')
@section('title','Account Manager')

@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
    localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());

</script>
<style>
    li {
        list-style: none;
    }
    .creden{
        margin-left: 153px;
        color: red;
    }
</style>

<!-- hidden Auth email and id for calling in json index -->
<input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="auth_id" />
<input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />

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
                                                        <select name="type_of_task" id="type_of_task"
                                                            class="form-control">
                                                            <option value="default" class="form-control text-dark">
                                                                Select Types of Assets </option>
                                                            <!-- @foreach($taskTypeFromSiteAdmin as $task_typ)
                                                        <option  value="{{$task_typ['tasktype']}}" name="{{$task_typ['id']}}" >{{$task_typ['tasktype']}}</option>
                                                        @endforeach     -->
                                                            <option value="Social Media Sites">Social Media Sites
                                                            </option>
                                                            <option value="Social Bookmarking Sites">Social Bookmarking
                                                                Sites</option>
                                                            <option value="Video Submission Sites">Video Submission
                                                                Sites</option>
                                                            <option value="Images Submission Sites">Images Submission
                                                                Sites</option>
                                                            <option value="Blogs Submission Sites">Blogs Submission
                                                                Sites</option>
                                                            <option value="Articles Submission Sites">Articles
                                                                Submission Sites</option>
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
                                                        <label class="control-label">Email Address</label>
                                                        <input type="text" name="email_address" id="email_address"
                                                            class="form-control" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <!-- step -5 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Website(Domain Name)</label>
                                                        <input type="text" name="website" id="website"
                                                            class="form-control" autocomplete="off" />
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">User Name</label>
                                                        <input type="text" name="user_name" id="user_name"
                                                            class="form-control" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Project Name</label>

                                                        <select name="wizard_project_name" id="wiz_project_name"
                                                            class="w-100 p-2">
                                                            <option value="default" class="form-control">
                                                                Select Project </option>

                                                            @foreach(App\Http\Controllers\Api\WizardProjectApiController::getvalueall($slug_id)
                                                            as $project)

                                                            <option name="{{$project['id']}}"
                                                                value="{{$project['project_name']}}"
                                                                class="form-control">
                                                                {{$project['project_name']}}</option>
                                                            @endforeach

                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label>
                                                        <input type="password" name="password" id="password"
                                                            class="form-control" autocomplete="off" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Page URL</label>

                                                        <select name="page_url" id="page_url" class="form-control">
                                                            <option value="" class="form-control">
                                                                Select page URL </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Security Token</label>
                                                        <input type="text" name="user_security_token"  id="user_token" maxlength="16"class="form-control" autocomplete="off" />
                                                        <span id="manager_page_rchars">16</span> Character(s) Remaining
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Manage By</label>
                                                        <select name="maintenance_engineer" id="maintenance_engineer"
                                                            class="form-control">
                                                            <option value="default" class="form-control text-dark">
                                                                Select Email </option>
                                                            <option value="{{Auth::user()->email}}">
                                                                {{Auth::user()->email}}</option>
                                                            @foreach($web_access_user as $teamuser)
                                                            @if(Auth::user()->email !== $teamuser['u_org_user_email'])
                                                            <option value="{{$teamuser['u_org_user_email']}}"
                                                                name="{{$teamuser['u_org_user_id']}}">
                                                                {{$teamuser['u_org_user_email']}}</option>
                                                            @endif
                                                            @endforeach
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
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id"
                                                id="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id"
                                                id="u_org_role_id">
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
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove
                                        this Assets?</h4>
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

<!-- webaccess view details open -->
<div id="webaccess_view_details" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="mymodal-title text-white" id="view_all_modal_title"> Webaccess Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                    <div class="card-body">
                            <!-- Show Modal view Card start -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div>
                                        <span><b>Task type name: </b></span>
                                        <span id="type_of_task_view"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div>
                                        <span><b>Website: </b></span>
                                        <span id="website_view_details"></span>
                                    </div>
                                </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>Email: </b></span>
                                        <span id="email_address_view_details"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>user name: </b></span>
                                        <span id="user_name_view_details"></span>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>Password: </b></span>
                                        <span id="password_view_details"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>Manage By: </b></span>
                                        <span id="maintenance_engineer_view_details"></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>Page Url: </b></span>
                                        <span id="page_url_view_details"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>Project Name: </b></span>
                                        <span id="wizard_project_name_view_details"></span>
                                    </div>
                                </div>
                                <hr>
                                </div>
                                {{-- <span class="float-left"><a href="" class="btn btn-warning ml-2" data-toggle="modal" id="encrypt_add" data-target="#exampleModal">Decrypt data</a></span> --}}
                                <div class="col-2">
                                    <span class="float-left"><a href="" class="btn btn-warning ml-2" data-toggle="modal" id="encrypt_add" data-target="#exampleModal">Decrypt data</a></span>
                                </div>
                                <div class="col-10">
                                    <p class="creden">Please enter your token id then you can see the credentials.</p>
                                </div>
                            </div>
                            <!-- Show Modal view Card End -->
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- webaccess view details close -->
<!-- ################################ decrypt modal data open    ################# -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Put your valid id then you will see data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form  open --->
        <form id="encrypt_form" method="GET" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Put Token</label>
            <input type="text" class="form-control" id="vi_token_id" name="user_security_token">
            <span style="color:red;font-size:12px; font-weight:bold;" id="err_token_id"></span>
            <span style="color:green;font-size:12px; font-weight:bold;" id="success_token_id"></span>
            <span style="color:blue;font-size:12px; font-weight:bold;" id="empty_record_data"></span>
        </div>

          <div class="form-group" id="email_form">
            <label for="name">Email</label>
            <input type="text" class="form-control" id="email_decrypt_name" name="email_address">
          </div>
          <div class="form-group" id="password_form">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password_decrypt" name="password">
          </div>
         
        </form>
        <!-- form  close -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Check</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>   
</div>
<!-- ################################ decrypt modal data close   ################# -->


<!-- ############################## on edit page token will be find value open #####################  -->
<div class="modal fade" id="editTokenModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Put your valid id then you will see data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form  open --->
        <form id="edit_ency_token_form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Put Token</label>
            <input type="text" class="form-control" id="validation_token_id" name="user_security_token">
            <span id="plasewaitforeditModal" style="color:green;"></span>
            <span id="noDataMyRecord" style="color:red;"></span>
            <input type="hidden" name="user_id" id="user_id">

            <span id="email_address_will_be_get"></span>
        </form>
        <!-- form  close -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Check</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- ############################## on edit page token will be find value close #####################  -->



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
        slug_id = $('#u_org_organization_id').val();
        // user_id = $('#user_id').val();
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
                "url": "{{url('api/v1/j/webaccess')}}/" + slug_id,
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
            data: {
                user_id
            },
            responsive: true,
            rowReorder: false,
            columnDefs: [{
                    "title": "ID",
                    "targets": 0,
                    "width": "5%"
                },
                {
                    "title": "Types of Assests",
                    "targets": 1,
                    "width": "15%"
                },
                {
                    "title": "Website",
                    "targets": 2,
                    "width": "15%"
                },
                // {
                //     "title": "Email",
                //     "targets": 3,
                //     "width": "10%"
                // },
                {
                    "title": "User Name",
                    "targets": 3,
                    "width": "15%"
                },
                // {
                //     "title": "Password",
                //     "targets": 4,
                //     "width": "10%"
                // },
                {
                    "title": "Page URL",
                    "targets": 4,
                    "width": "10%"
                },
                {
                    "title": "Action",
                    "targets": 5,
                    "width": "20%"
                },
            ],
            columns: [

                {
                    data: 'id'
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<p class="label label-light-info"> ' + data['type_of_task'] +
                            ' </p>'
                    },
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<p> ' + data['website'].slice(0, 18) + ' </p>'
                    },
                },
                // {
                //     data: 'email_address'
                // },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<p class="label label-light-warning"> ' + data['user_name'] +
                            ' </p>'
                    },
                },
                // {
                //     data: null,
                //     render: function (data, type, row) {
                //         return '<code> ' + data['password'].slice(0, 12) + ' </code>'
                //     },
                // },

                {
                    data: null,
                    render: function (data, type, row) {
                        return '<a href="' + data['page_url'] +
                            '" class="btn waves-effect waves-light btn-xs btn-info" target="_blank">Click Here </a>'
                    },
                },


                {
                    // data: null,
                    // render: function (data, type, row) {
                    //     return '<div class="row"><div class="col-6"><button type="button"  id="' +
                    //         data['id'] +
                    //         '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-2"><button type="button" id="' +
                    //         data['id'] +
                    //         '"  class="btn btn-danger  delete"><i class="mdi mdi-delete"></i></button></div> </div>'
                    // },
                    data: null,
                render: function(data, type, row) {
                    return '<div class="row"><div class="col-4"><button type="button"  id="' +
                        data['id'] +
                        '" class=" btn btn-warning view_details"><i class="mdi mdi-eye"></i></button></div><div class="col-4"><button type="button" id="' +
                        data['id'] +
                        '"  class="verification_token btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-4"><button type="button" id="' +
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
            $('.modal-title').text("Add New Assets");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        // model will be close

        // on change project based url will be come open
        $('#wiz_project_name').on('change', function () {
            console.log('project name pe clik huwa');
            var project_name_id = $("#wiz_project_name option:selected").attr("name");
            console.log('project pe click krne  ajax ke bahar ' + project_name_id);
            ajaxCall();
            // selector on keyword open
            function ajaxCall() {
                console.log('project ajax ke ander' + project_name_id);
                $.ajax({
                    "type": "GET",
                    "url": "{{url('api/v1/j/wizard/getProjectDataId')}}/" + project_name_id,
                    "data": {},
                    "headers": {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    success: function (response) {
                        var add_url = response.g_data.data;
                        $('#page_url').empty();
                        $('#page_url').append('<option> Select page url now </option>');
                        // this url is comming from add url ms with concatinate open
                         var  url_list = '';
                         $.each(add_url, function(key,val) {
                         console.log(val.url+' :foraech ka length aa rha hai hello');
                         url_list = url_list.concat(`<option name="` +val.url +`" value="` +val.url +`">` + val.url + `</option>`);
                         });
                         $('#page_url').append(url_list);
                        // this url is comming from add url ms concatinate close
                        $('#page_url').append('<option name="' +response.data.id +'" value="' +response.data.facebook +'">' + response.data.facebook +
                        '</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.linkedIn+'">'+response.data.linkedIn+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.youtube+'">'+response.data.youtube+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.twitter+'">'+response.data.twitter+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.reddit+'">'+response.data.reddit+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.tumblr+'">'+response.data.tumblr+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.plurk+'">'+response.data.plurk+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.getpocket+'">'+response.data.getpocket+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.wix+'">'+response.data.wix+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.wordpress+'">'+response.data.wordpress+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.weebly+'">'+response.data.weebly+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.medium+'">'+response.data.medium+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.professnow+'">'+response.data.professnow+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.github+'">'+response.data.github+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.hubpages+'">'+response.data.hubpages+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.ehow+'">'+response.data.ehow+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.dzone+'">'+response.data.dzone+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.articlesfactory+'">'+response.data.articlesfactory+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.justdial+'">'+response.data.justdial+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.sulekha+'">'+response.data.sulekha+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.indiamart+'">'+response.data.indiamart+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.quikr+'">'+response.data.quikr+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.click+'">'+response.data.click+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.quora+'">'+response.data.quora+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.wikibooks+'">'+response.data.wikibooks+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.answers+'">'+response.data.answers+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.superuser+'">'+response.data.superuser+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.dailymotion+'">'+response.data.dailymotion+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.vimeo+'">'+response.data.vimeo+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.metacafe+'">'+response.data.metacafe+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.dropshots+'">'+response.data.dropshots+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.mediafire+'">'+response.data.mediafire+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.slideshare+'">'+response.data.slideshare+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.scribd+'">'+response.data.scribd+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.four_shared+'">'+response.data.four_shared+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.issuu+'">'+response.data.issuu+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.freeadstime+'">'+response.data.freeadstime+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.superadpost+'">'+response.data.superadpost+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.mastermoz+'">'+response.data.mastermoz+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.h1ad+'">'+response.data.h1ad+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.imgur+'">'+response.data.imgur+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.flickr+'">'+response.data.flickr+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.instagram+'">'+response.data.instagram+'</option>'
                        +'<option name="' +response.data.id +'" value="'+response.data.pinterest+'">'+response.data.pinterest+'</option>'
                        );  
                    },
                    error: function (errorResponse) {
                        console.log(errorResponse);
                    }
                });
            }
            // selector on keyword close
        });
        // onchange function for url select on based keyword will be display  close
        // on change project based url will be come close


        //  form working start
        $('#sample_form').on('submit', function (event) {
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
                    // onpage validation open
                    // beforeSend: function beforeSend() {
                    //     if (!$('#page_url').val()) {
                    //         $('#url_validation').html("Please  fill required field");

                    //     }else{
                    //         var url_default = $('#page_url').val();
                    //         if(url_default == 'http://' || url_default == 'https://') {
                    //             url_default;
                    //         }else{
                    //            'http'+url_default;
                    //         }
                    //     }
                    // },
                    // onpage validation close
                    success: function (data) {
                        // adding alert messages
                        console.log(data.errors);
                        // adding alert messages for success and exist data validation open
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#WebAccessTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                        // adding alert messages for success and exist data validation close

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        //    this function for hide with id #formModel
                        console.log('store  function kamm nahi kr rha hai');
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
                    success: function (data) {
                        console.log('Manager update ho gaya successfully');

                        // adding alert messages
                        console.log(data.errors);
                        // adding alert messages for success and exist data validation open
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#WebAccessTable').DataTable().ajax.reload();
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

         // #######################################  on edit token open   #######################################
         $(document).on('click', '.verification_token', function() {
      console.log('working edit button');
     $('#edit_ency_token_form')[0].reset();
     $("#noDataMyRecord").html('');

      var user_prim_id = $(this).attr('id');
      console.log('user ka id' + user_prim_id);
      $('#user_id').val(user_prim_id);
      $('#editTokenModal').modal('show');

        });
     
        // testing open
        // $('#vi_token_id').on('change', function () {
        // testing close
        // $('#validation_token_id').keyup(function (e) {
        $('#validation_token_id').on('change',function (e) {
        e.preventDefault();
        console.log('find token pe click huwa');
        var user_prim_id = $('#user_id').val();
        console.log("we are getting primary id " + user_prim_id);
            var input_user_token = $("#validation_token_id").val();
            console.log('user token ka value aya ki nahi be...' +input_user_token);
            // token based search function open
            taking_token_on_edit_page();
            // selector on keyword open
            function taking_token_on_edit_page() {
                $.ajax({
                    type: "GET",
                    url: "{{url('api/v1/j/edit_page_validate_vi_token_id')}}/" + input_user_token +'/'+user_prim_id,
                    data: {},
                    headers: {
                    Authorization: "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    // beforeSend: function beforeSend() {
                    //   if ($('#vi_token_id').val().length == 16) {
                    //       $('#success_token_id').html('please wait..');
                    //   }
                    //   else{
                    //     $('#err_token_id').html("please enter valid security code 16 digit");
                    //     return false;
                    //     $("#empty_record_data").hide("");
                    //     console.log("we need 16 digit value");
                    //   }

                    // },
                    success: function (response) {
                     if(response.edit_decrypt_email_id != undefined){
                        console.log("we found record");
                        $('#plasewaitforeditModal').html('plase wait..');
                        var input_user_token = $("#validation_token_id").val();
                        $('#user_token').val(input_user_token);
                        $('#maintenance_engineer').val(response.data.maintenance_engineer);
                        $('#page_url').prepend("<option value='" + response.data.page_url +
                        "' selected='selected'>" + response.data.page_url + "</option>");
                        $('#wiz_project_name').prepend("<option value='" + response.data.wizard_project_name +
                        "' selected='selected'>" + response.data.wizard_project_name + "</option>");
                        $('#website').val(response.data.website);
                        $('#user_name').val(response.data.user_name);
                        $('#password').val(response.return_edit_decrypt_pwd);
                        $("#email_address").val(response.edit_decrypt_email_id);
                        $('#type_of_task').prepend("<option value='" + response.data.type_of_task +
                        "' selected='selected'>" + response.data.type_of_task + "</option>");
                        $("#formModal").modal("show");
                        $('#action_button').val("Update");
                        $('#action').val("Update");
                        $('#formModal').modal('show');
                        // $('#editTokenModal').hide();
                       
                     }else{
                        console.log("no data in my records");
                        $("#noDataMyRecord").html("no data in my records");
                        $('#plasewaitforeditModal').hide('plase wait..');
                     }
                    },
                    error: function (errorResponse) {
                        console.log("sorry !! "+errorResponse);
                    }
                });
            }
        });

    // #######################################  on edit token clsoe ########################################
        //
        $(document).on('click', '.edit', function () {
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
                success: function (html) {
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    //open
                    $('#page_url').prepend("<option value='" + html.data.page_url +
                        "' selected='selected'>" + html.data.page_url + "</option>");
                    $('#wiz_project_name').prepend("<option value='" + html.data
                        .wizard_project_name +
                        "' selected='selected'>" + html.data.wizard_project_name +
                        "</option>");
                    // close
                    $('#type_of_task').val(html.data.type_of_task);
                    $('#website').val(html.data.website);
                    $('#email_address').val(html.data.email_address);
                    $('#user_name').val(html.data.user_name);
                    $('#password').val(html.data.password);
                    $('#maintenance_engineer').val(html.data.maintenance_engineer);
                    $('.modal-title').text("Edit Assets");
                    $('.modal-title_delete').text("Assets Delete");
                    $('#action_button').val("Update");
                    $('#action').val("Update");
                    $('#formModal').modal('show');
                    $('#hidden_id').val(id);
                }
            })
        });  // edit function close


        // ######################################### view all details open ##############################################
    $(document).on('click', '.view_details', function() {
        console.log('working view button');
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
                console.log('value aa gaya view all data ke page pe');
                console.log(html);
                 //open

                 $('#wiz_project_name').prepend("<option value='" + html.data.wizard_project_name +
                        "' selected='selected'>" + html.data.wizard_project_name + "</option>");
                // close
                var wizard_project_name_view = html.data.wizard_project_name;
                var page_url_view = html.data.page_url;
                var task_view = html.data.type_of_task;
                var website_view = html.data.website;
                var email_address_view = html.data.email_address;
                var user_name_view = html.data.user_name;
                var password_view = html.data.password;
                var maintenance_engineer_view = html.data.maintenance_engineer;
                $('#wizard_project_name_view_details').html(wizard_project_name_view);
                $('#page_url_view_details').html(page_url_view);
                $('#type_of_task_view').html(task_view);
                $('#website_view_details').html(website_view);
                $('#email_address_view_details').html(email_address_view);
                $('#user_name_view_details').html(user_name_view);
                $('#password_view_details').html(password_view);
                $('#maintenance_engineer_view_details').html(maintenance_engineer_view);
                $('#view_all_modal_title').text("Assets Details");
                $('.modal-title_delete').text("Assets Delete");
                $('#action_button').val("Update");
                $('#action').val("Update");
                $('#webaccess_view_details').modal('show');
                $('#hidden_id').val(id);
            }
        })



        // ============================ email and pwd encrypt open ================================================
        $('#encrypt_add').click(function() {
        $('#encrypt_form')[0].reset();
        console.log("form reload ho gaya");
        $('#success_token_id').html('');
        $('#empty_record_data').html('');
        $('#err_token_id').html('');
        $('#email_form').hide();
        $('#password_form').hide();
        });
        var user_getting_id = $(this).attr('id');
        console.log("id mil gaya 894 main" + user_getting_id);
        $('#vi_token_id').on('change', function () {
            var get_token_id = $("#vi_token_id").val();
            calling_token_id();
            // selector on keyword open
            function calling_token_id() {
                $.ajax({
                    "type": "GET",
                    "url": "{{url('api/v1/j/user_vi_token_id')}}/" + get_token_id +'/'+ user_getting_id,
                    "data": {},
                    "headers": {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    beforeSend: function beforeSend() {
                      if ($('#vi_token_id').val().length == 16) {
                          $('#success_token_id').html('please wait..');
                      }
                      else{
                        $('#err_token_id').html("please enter valid security code 16 digit");
                        return false;
                        $("#empty_record_data").hide("");
                        console.log("we need 16 digit value");
                      }

                    },
                    success: function (response) {
                     if(response.getting_decrypt_data_email != undefined){
                        console.log("we found record");
                        var user_email_view = response.getting_decrypt_data_email;
                        var user_pwd_view = response.getting_pwd_dcrypt;
                      console.log("userEmail" +user_email_view );
                        $("#email_decrypt_name").val(user_email_view);
                        $("#password_decrypt").val(user_pwd_view);
                        $('#email_form').show();
                        $('#password_form').show();
                        $("#success_token_id").hide();
                        $("#empty_record_data").hide();
                     }else{
                        console.log("no data in my record");
                        $('#success_token_id').hide('please wait..');
                        $("#empty_record_data").html("sorry no found data in record");
                        $('#err_token_id').hide();
                        $('#email_form').hide();
                        $('#password_form').hide();
                     }
                    },
                    error: function (errorResponse) {
                        console.log("sorry !! "+errorResponse);
                    }
                });
            }
   });
    // ============================ email and pwd encrypt close ================================================
    });  // view details close
    // ######################################### view all details close #############################################

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
                url: "{{url('api/v1/j/webaccess/destroy')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                beforeSend: function () {
                    $('#ok_button').text('Deleting..');
                },
                success: function (data) {
                    $('#ok_button').text('OK');
                    $('#confirmModal').modal('hide');
                    $('#WebAccessTable').DataTable().ajax.reload()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
    });

     // =======================   count descript open  ==========================
     var maxLength = 16;
    $('#user_token').keyup(function () {
        var textlen = maxLength - $(this).val().length;

        $('#manager_page_rchars').text(textlen);
    });
      
// ========================= count discription close  ================================

</script>
@endpush
