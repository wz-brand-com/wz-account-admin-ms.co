@extends('layouts.backend.mainlayout')
@section('title','Account Admin')

@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
    localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());

</script>
<style>li{list-style:none;}
    .table-responsive {
    display: block;
    width: 100%;
    overflow-x: !important;
    
}
</style>
<!-- hidden Auth email and id for calling in json index -->
<input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="auth_id" />
<input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
{{-- <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Team Rating Section</h3>
    </div>
    <div class="col-md-7 align-self-center">
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
                                    class="btn btn-primary ">Add New Rating</button>
                            </div>
                        </div>

                        <table id="RatingTable" class="table">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                        <div id="formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
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

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">User Name </label>
                                                        <select name="rating_user_name" id="rat_user_name" class="w-100 p-2">
                                                   
                                                       

                                                  
                                                        </select>
                                                        
                                                    </div>
                                                </div>  

                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Manager Name</label>
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- week  and month start -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Week</label>
                                                        <select name="week" id="week" class="w-100 p-2">
                                                            <option value="">select Week</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Month </label>
                                                        <select name="month" id="month" class="w-100 p-2">
                                                            <option value="{{ date('F') }}">{{ date('F') }}</option>
                                                            <option value="">-------</option>
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- week and month section end -->

                                            <!-- year and rating start -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Year</label>

                                                       
                                                            <input type="text" readonly class="w-100 p-2" name="year" id="year" value="<?php echo date("Y") ?>">
                                                              
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Rating</label>

                                                        <select name="rating" id="rating" class="w-100 p-2">
                                                            <option value="">select rating</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
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
                                            
                                            <input type="hidden" name="rating_user_email" id="rating_user_id" value="">
                                            <input type="hidden" name="rating_manager_email" id="rating_manager_id" value="">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                                    </div>
                                    <input type="hidden" value="{{ Auth::user()->email }}" id="email" name="rating_user_email">

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
                                        this Team Rating?</h4>
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
    $(document).ready(function () {
        // image load
        window.addEventListener("load", function () {
            $(".loader").delay(500).fadeOut("slow");
        });
        console.log('trying to call api');
        id = $('#u_org_organization_id').val();
        var dt = $('#RatingTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/rating/index')}}/" + id,
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
                    "title": "Name",
                    "targets": 1,
                    "width": "5%"
                },
                {
                    "title": "Manager",
                    "targets": 2,
                    "width": "5%"
                },
                {
                    "title": "Week",
                    "targets": 3,
                    "width": "5%"
                },
                {
                    "title": "Month",
                    "targets": 4,
                    "width": "5%"
                },
                {
                    "title": "Year",
                    "targets": 5,
                    "width": "5%"
                },
                {
                    "title": "Rating",
                    "targets": 6,
                    "width": "1%"
                },
                {
                    "title": "Action",
                    "targets": 7,
                    "width": "2%"
                },
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'rating_user_name'
                },
                {
                    data: 'rating_manager_name'
                },
                {
                    data: 'week'
                },
                {
                    data: 'month'
                },
                {
                    data: 'year'
                },
                {
                    data: 'rating'
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<div class="row"><div class="col-6"><button type="button"  id="' +
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
            $('.modal-title').text("Add New Rating");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        // model will be close

        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            //passing user email in hidden for submitting email into databse
            var team_rat_user_name = $("#rat_user_name option:selected").attr("name");
             $('#rating_user_id').val(team_rat_user_name);
             console.log('rating_user_id ka value aa raha hai' + team_rat_user_name);

            var team_rat_manager_name = $("#rat_manager_name option:selected").attr("name");
             $('#rating_manager_id').val(team_rat_manager_name);
             console.log('rating_manager_id ka value aa raha hai' + team_rat_manager_name);
            // data add working on submit button
            // data add working on submit button
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{route('rating.store') }}",
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
                        // adding alert messages for success and exist data validation open
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#RatingTable').DataTable().ajax.reload();
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
                        console.log('Manager ka value store nahi rha ha');
                    }
                })
            }

            // update button wotking for updata data
            if ($('#action').val() == "Update") {
                console.log('update button pe click ho rha hai');
                $.ajax({
                    url: "{{url('/api/v1/j/rating/update/') }}",
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
                        console.log('Rating update ho gaya successfully');
                        //setting 2 second in modal to stay
                        setTimeout(function () {
                            $('#formModal').modal('hide');
                            $('#RatingTable').DataTable().ajax.reload();
                        }, 2000);

                        // adding alert messages
                        console.log(data.errors);
                        var html = '';
                        if (data.error) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.error.length; count++) {
                                html += '<p>' + data.error[count] + '</p>';
                            }
                            html += '</div>';
                            $('#form_result').html(html);
                        }
                        if (data.message) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                    },
                    // message alert close
                    error: function (data) {
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
                url: "{{url('/api/v1/j/rating/edit/')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    // testing open
                    // $('#rat_user_name').prepend("<option value='" + html.data.rating_user_name + "' selected='selected'>" + html.data.rating_user_name + "</option>").attr('readonly', true);

                    // $('#tool_slug').prepend("<option value='" + html.data.tool_slug + "' selected='selected'>" + html.data.tool_slug + "</option>").attr('readonly', true);
                   
                    // testing close
                    $('#rat_user_name').val(html.data.rating_user_name);
                    $('#rat_manager_name').val(html.data.rating_manager_name);
                    $('#week').val(html.data.week);
                    $('#month').val(html.data.month);
                    $('#year').val(html.data.year);
                    $('#rating').val(html.data.rating);
                    $('#admin_id').val(html.data.admin_id);
                    $('#admin_email').val(html.data.admin_email);
                    $('.modal-title').text("Edit Rating");
                    $('.modal-title_delete').text("Rating Delete");
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
                url: "{{url('api/v1/j/rating/destroy')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                beforeSend: function () {
                    $('#ok_button').text('Deleting..');
                },
                success: function (data) {
                    $('#ok_button').text('OK');
                    $('#confirmModal').modal('hide');
                    $('#RatingTable').DataTable().ajax.reload()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
    });

</script>
@endpush
