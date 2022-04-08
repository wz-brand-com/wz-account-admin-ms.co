@extends('layouts.backend.mainlayout')
@section('title','Account Admin')
@section('content')
{{-- <input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
    localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());

</script> --}}
<!-- select to open -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- select to close -->
<style>li{list-style:none;}</style>
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
                                    class="btn btn-primary ">Invite Member</button>
                            </div>
                        </div>
                        <table id="managerTable" class="table" data-order='[[ 0, "desc" ]]'>
                            <thead>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <div id="formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add New Manager</h5>
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
                                                <label class="control-label">Invite User By Email id </label>

                                                <!-- autosearch open -->
                                                <!-- <input type="email" class="form-control typeahead" id="user_id" name="u_org_user_email" autocomplete="off"> -->
                                                <input type="email" class="form-control typeahead" id="user_id" name="u_org_user_email" autocomplete="off">
                                                <!-- autosearch close -->
                                             
                                                <span id="input_email_id_validation" aria-hidden="true" class="text-center mt-2" style="color:red;"></span>
                                            </div>
                                            <div class="form-group" id="name_form">
                                                <label class="control-label">Invite Role </label>
                                                <select name="u_org_role_id" id="role_id" class="form-control">
                                                <option value="" class="form-control text-dark">Select Role </option>
                                                    @foreach($rolles as $rolle)
                                                    <option  value="{{$rolle['id']}}" name="{{$rolle['role_name']}}" >{{$rolle['role_name']}}</option>
                                                        @endforeach
                                                </select>
                                                <span id="input_role_id" aria-hidden="true" class="text-center mt-2" style="color:red;"></span>
                                                <span id="action_buttons" aria-hidden="true" class="text-center mt-2" style="color:green;"></span>
                                            
                                            </div>
                                        <input type="hidden" value="{{ Auth::user()->id }}"name="admin_id"id="admin_id"/>
                                        <input type="hidden" value="{{ Auth::user()->name }}"name="admin_name"/>
                                        <input type="hidden" value="{{ Auth::user()->email }}" name="invited_by_email"/>
                                        <!-- for account admin below value fo id and email will store it it will get value by auth -->
                                        <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                        <input type="hidden" value="{{$slug_id}}" id="user_organisation_id" name="u_org_organization_id">
                                        <input type="hidden" value="" name="u_org_user_member_role_name" id="u_org_user_member_role_name">
                                        <input type="hidden" value="0" name="status">
                                    </div>
                                    <!-- <br /> -->
                                    <div class="form-group text-center">
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="hidden_id" id="hidden_id" />
                                        <input type="submit" name="action_button" id="action_button"
                                            class="btn btn-warning float-center " value="Add" />
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

                     <!-- member invite remove modal open -->
                     <div class="row">
                        <div class="col-lg-10">
                            <div id="remove_memeber_model" class="modal" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-header" style="color:red;font-weight:bold;">
                                               Remove Member
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="dashboard">Are you sure want to remove This member?</h4>                                           
                                            </div>
                                            <div class="modal-footer">
                                                
                                                <button type="button" name="ok_button_member_remove" id="ok_invited_button_removed"
                                                    class="btn btn-danger">OK</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- member invite remove modal close -->
                    <div id="confirmModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <br>
                                    <span class="modal-title_delete">Confirmation</span>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center" style="margin:0; color:red;">are you sure to remove this organization?</h4>
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
        id = $('#admin_id').val();
        
        getOrgBasedWithRollIdDashboard = $('#slug').val();
        console.log(slug);
        var dt = $('#managerTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/invitedSlugBasedDashbaord/ChekingUserEmail')}}/"+ getOrgBasedWithRollIdDashboard,
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
               
                {
                    "title": "Action",
                    "targets": 4,
                    "width": "10%"
                },
                {
                    "title": "Action",
                    "targets": 5,
                    "width": "10%"
                },
            ],
            columns: [
                { data: 'id' },
                { data: 'u_org_user_email'},
                { data: 'u_org_slugname' },
                { data: 'u_org_role_name' },
                // user block unblock open
                {
                    data: null,
                    render: function (data, type, row) {
                        if (data.status == '1') {
                                return ' <button type="button" class="btn btn-danger fa fa-lock  add_block_user" id="' +
                                data['id'] + '"> Blocked </button>'
                             
                        } else {
                            return ' <button type="button" class="btn btn-danger fa fa-unlock  add_block_user" id="' +
                                data['id'] + '">  Block  </button> '
                        }
                    },
                },
                // user block unblock open
                 // user invited_&_remove open
                 {
                    data: null,
                    render: function (data, type, row) {
                        if (data.invited_removed == 1) {
                                return ' <button type="button" class="btn  fa fa-trash  invited_removed_button" id="' +
                                data['id'] + '" style="background-color:#03AF18; color:white;"> Remove </button>'
                             
                        } else {
                            return ' <button type="button" class="btn fa fa-trash invited_removed_button" id="' +
                                data['id'] + '" style="background-color:red; color:white;">  Remove  </button> '
                        }
                    },
                },
                // user invited_&_remove close
                
            ],


        });
        // data table close

        // model will be display on add and edit button click
        $('#create_record').click(function () {
            $('#name_form').show();
            $('#passlabel,#password').show();
            $('#sample_form')[0].reset();
            $('#form_result').html('');
            $('.modal-title').text("Invite member");
            $('#action_button').val("Add");
            // form reset open
            $('#user_id option').prop('selected', function () {
            return this.defaultSelected;
            });
            // form reset close
            $('#input_role_id').html('');
            $('#action_buttons').html('');  //After add click processing messsage reset
            $('#inviting').html('');
            $('#input_email_id_validation').html('');
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

        //  form working start
        $('#sample_form').on('submit', function (event) {
            console.log('inivte member form submit');
            event.preventDefault();
            
            // email id getting form invite time memeber open
            var member_role_id = $("#role_id option:selected").attr("name");
            console.log('getting role_id '+member_role_id);
            $('#u_org_user_member_role_name').val(member_role_id);
             var getting_member_emailId = $("#user_id").val();
             $('#u_org_user_email').val(getting_member_emailId);
            console.log('email id aaa ja rha hai ' +getting_member_emailId);
            if ($('#action').val() == 'Add') 
            {
                console.log('add button click ho rha ha');
                 // else part for vaidation  open
                 if (!$('#user_id').val()) 
                {
                    $('#input_email_id_validation').html("Please  Select Email or Invite Member !");
                }
                else if(!$('#role_id').val())
                {
                    $('#input_role_id').html("Please  Select Role !");
                }
                else
                {
                // else part for vaidation  close
                $.ajax({
                    url: "{{url('members/store') }}",  // from web.php
                    // url: "{{Route('invited.role.org.name') }}", // from api.php
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
                                $('#sample_form')[0].reset();
                                $('#managerTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                    },
                    error: function(data) {
                    console.log('invite memnber ka value store nahi rha ha');
                    console.log('Error:', data);
                }
                })
              
            }
           
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
            $('#name_form').show();
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('api/v1/j/member_active_deactive_user')}}/" + id,
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

        // remove modal open
      
        // invited and remove open
        $(document).on('click', '.invited_removed_button', function () {
            $('#remove_memeber_model').modal('show');
            var id = $(this).attr('id');
            var user_organisation_id = $('#user_organisation_id').val();
            console.log('user_organisation_id id ka value aa gaya '+user_organisation_id);
        $(document).on('click', '#ok_invited_button_removed', function () {
            console.log('working invited removed button'+id);
           
            $('#form_result').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('api/v1/j/organization/userRemoveOrgDestroy')}}/" + id + '/' + user_organisation_id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },

                beforeSend: function() {
                $('#ok_invited_button_removed').text('removing member..');
                },

                success: function (html) {
                    console.log('value aa gaya invited removed ke page pe');
                    setTimeout(function () {
                        $('#remove_memeber_model').modal('hide');
                        $('#ok_invited_button_removed').text('OK');
                                $('#managerTable').DataTable().ajax.reload();
                            }, 2000);
                }
            })
        });
        // invited and remove close
    });
});
</script>
@endpush
