<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<style>
    .table td,
    .table th {
        padding: 12px !important;
    }

    .logouts {
        margin-left: 750px;
        margin-top: -40px;
        background-color: #FFFFFF;
    }

    .logouts:hover {
        background-color: whitesmoke;
    }

    .btn-outline-info:hover {
        color: red !important;
    }

    .btn-outline-primary {
        background-color: whitesmoke;
    }

    .btn-outline-primary:hover {
        background-color: whitesmoke;
    }

    .myButton {
        background-color: #5c4ac7;
        border-radius: 14px;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 17px;
        padding: 12px 15px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #2f6627;
    }

    .myButton:hover {
        background-color: #5759e4;
        color: whitesmoke;
    }

    .myButton:active {
        position: relative;
        top: 2px;
    }

    .thcolor {
        color: red;
    }

    .dashboard {
        font-family: 'Playfair Display', serif;
    }

</style>

@extends('layouts.orgs-page-layout.mainlayout')
@section('content')

<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());
</script>

<div style="margin-left: 124px">

    <body>
        <!-- {{-- <div class="container-fluid mystylepics"> --}} -->
        <br>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-9">
                <!-- card open -->
                <div class="card shadow bg-text border border-warning">
                    <!-- messsage open -->
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-center text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if($message = session()->get('messages'))
                    <div class="alert alert-danger alert-block" id="exampleModal">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <!-- messsage close -->
                    <!-- message body open -->
                    <!-- message body open -->
                    @if($message = session()->get('message'))
                    <!-- model open -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: #6666ff">
                                    <h5 class="modal-title" id="exampleModalLabel">Can't Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="font-size: 17px"> This organization cannot be deleted because it has been already assigned to someone.</p>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                        <!-- model close -->
                        <script>
                            $(document).ready(function () {
                                $("#exampleModalCenter").modal('show');
                            });

                            $(document).ready(function () {
                                // Open modal on page load
                                $("#exampleModalCenter").modal('show');

                                // Close modal on button click
                                $(".close").click(function () {
                                    $("#exampleModalCenter").modal('hide');
                                });
                            });

                        </script>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if(session()->get('danger'))
                    <div class="alert alert-danger col-xl-10 col-12 col-sm-10 col-lg-10 col-md-10">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session()->get('danger') }}
                    </div>
                    @endif
                    <!-- message body close -->
                    <!-- ################# close testing delted organization ####################33 -->
                    <!-- if organization not be delete then modal will be open -->
                    <div class="card-header text-success">
                        <br>
                        <button type="button" name="create_org_record" id="create_org_record" class="btn btn-primary btn btn-info fa fa-plus "> Add Organization</button>
                        {{-- model open for add organisation open --}}
                        
                        <div id="formOrganisationModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add Organization</h5>
                                        <!-- <button type="button btn btn-info" class="add_orgclose" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button> -->
                                        <button type="button" class="add_orgclose" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Success Message after submit -->
                                        <span id="form_result" aria-hidden="true"></span>
                                        <!-- Error Message after form not submit -->
    
                                        <form method="post" id="sample_organization_form" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group" id="name_org_form">
                                                <label class="control-label"> Add Organisation </label>
                                                <input type="text" name="org_name" id="org_name" autocomplete="off"
                                                    class="form-control" />
                                                <span id="username" class="text-danger"></span>
                                            </div>
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="org_user_id"
                                                id="org_user_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="org_user_email"
                                                id="org_user_email" />
                                           
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

                        {{-- model open for add organisation close --}}
                        <button class="btn btn-light logouts" title="logout">
                            <a class=" fa fa-power-off" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            </a>
                        </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {!! @csrf_field() !!}
                        </form>
                    </div>
                    <!-- {{-- end organization  --}} -->
                    <div class="card-body">
                        <div class="form-group" id="name_form">
                            <div class="col-md-12">
                                <!-- testing card open -->
                                <div class="card mt-2">
                                    <div class="card-body shadow ">

                                        <!-- Table for showing data start -->
                                            <table id="organisation_data_Table" class="table" data-order='[[ 0, "desc" ]]'>
                                                <thead>
                                                    
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        <!-- Table for showing data end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- amit modal start here  --}}
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalurl" tabindex="-1" aria-labelledby="exampleModalurlLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: #6666ff">
                                    <h5 class="modal-title" id="exampleModalurlLabel">Please Click Continue to Dashboard
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h3 class="dashboard"><i class="fa fa-hand-o-right" aria-hidden="true"
                                            style="color: red;"></i>&nbsp;Please Click Continue to Dashboard</h3>
                                    <p class="dashboard ml-4" style="font-size: 17px;">Before proceeding further, please click on Continue to Dashboard, then the menu will be enable.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- amit modal end here  --}}
                    <!-- data cannot delete after model close -->
                    <div id="confirmModal" class="modal fade" role="dialog">
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
                                        this Organization</h4>
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

                    <!-- card close -->
                </div>
            </div>
        </div>
</div>

</body>

<script>
    // data table open with fetching

    $(document).ready(function () {
        // image load
        window.addEventListener("load", function () {
            $(".loader").delay(500).fadeOut("slow");
        });
        var slug_id = $('#org_user_id').val();
        var dt = $('#organisation_data_Table').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/organization/index')}}/" + slug_id,
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
                    "title": "Organisation Name",
                    "targets": 1,
                    "width": "45%"
                },
                {
                    "title": "Dashboard Access",
                    "targets": 2,
                    "width": "45%"
                },
              
                {
                    "title": "Action",
                    "targets": 3,
                    "width": "20%"
                },
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'org_slug'
                },

                // {
                // data: null,
                // render: function(data, type, row)   
                // {
                //     return '<div class="row"><div class="col-2"><button type="button"  id="' +
                //             data['org_slug'] +
                //             '" class="onslugbutton btn btn-primary"><i class="mdi mdi-lead-pencil"></i>Continue to dashbaord </button></div> </div>'

                // },
                // },
                {
                data: null,
                render: function(data, type, row)   
                {
                    return '<a href="orgs/'+data['org_slug'] + '/dashboard'+' " class="btn waves-effect waves-light btn-xs btn-info">Continue Dashboard </a>'

                },
                },


                {
                    data: null,
                    render: function (data, type, row) {
                        return '<div class="row"><div class="col-2"><button type="button"  id="' +
                            data['id'] +
                            '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-2"><button type="button" id="' +
                            data['id'] +
                            '"  class="btn btn-danger delete"><i class="mdi mdi-delete"></i></button></div> </div>'
                    },
                },
            ],
        });
        // data table close
        // model will be display on add and edit button click
        $('#create_org_record').click(function () {
            console.log('create org record click');
            $('#name_form').show();
            $('#sample_organization_form')[0].reset();
            $('#form_result').html('');
            $('.modal-title').text("Add New Organization");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formOrganisationModal').modal('show');
            $(".add_orgclose").click(function () {
            $("#formOrganisationModal").modal('hide');
 });
        });
        // model will be close
        //  form working start
        $('#sample_organization_form').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{url('api/v1/j/organization/store') }}",
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
                                $('#formOrganisationModal').modal('hide');
                                $('#organisation_data_Table').DataTable().ajax.reload();
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
                    url: "{{url('api/v1/j/organization/update/') }}",
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
                        setTimeout(function () {
                            $('#formOrganisationModal').modal('hide');
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
                url: "{{url('api/v1/j/organization/edit/')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {	
                    //  i am not using this drop down close
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    $('#org_name').val(html.data.u_org_slugname);
                    $('#org_slug').val(html.data.org_slug);
                    $('#sa_id').val(html.data.admin_id);
                    $('#sa_email').val(html.data.admin_email);
                    $('.modal-title').text("Edit Task Type");
                    
                    $('.modal-title_delete').text("Task will be delete");
                    $('#action_button').val("Update");
                    $('#action').val("Update");
                    $('#formOrganisationModal').modal('show');
                    $('#hidden_id').val(id);
                   

                }
            })
        });


       
        // $(document).on('click', '.delete', function () {
        //     id = $(this).attr('id');

        //     $('#confirmModal').modal('show');
        // });

        // var id;
        // $(document).on('click', '.delete', function () {
        //     console.log("delete pe delete ho rha hai");
        //     id = $(this).attr('id');
        //     url_name = $(this).attr('name');
        //     $('#confirmModal').modal('show');
        // });

        // $('#ok_button').click(function () {
        //     console.log('working delete button');
        //     $('#name_form').show();
        //     $('#form_result').html('');
        //     $.ajax({
        //         type: "get",
        //         data: {},
        //         url: "{{url('api/v1/j/organization/destroy')}}/" + id,
        //         headers: {
        //             "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
        //         },
        //         beforeSend: function () {
        //             $('#ok_button').text('Deleting..');
        //         },
        //         success: function (data) {
        //             if (data.success) {
        //                 html = '<div class="alert alert-success">' + data.message +
        //                 '</div>';
        //                 $('#form_result').html(html);
        //                 setTimeout(function () {
        //                     $('#confirmModal').modal('hide');
        //                     $('#ok_button').text('OK');
        //                     $('#organisation_data_Table').DataTable().ajax.reload();
        //                     // alert('Data Deleted Successfully'+data.success);
        //                 }, 2000);
        //             } else {
        //                 $('#confirmModal').modal('hide');
        //                 $('#ok_button').text('OK');
        //                 $('#reextendmodel').modal('show');

        //             }
        //             // testing close
        //         },
        //         error: function (data) {
        //             console.log('Error:', data);
        //         }
        //     })
        // });
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
                url: "{{url('api/v1/j/organization/destroy')}}/" + id,
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
                            location.reload();
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

</script>
       

@endsection