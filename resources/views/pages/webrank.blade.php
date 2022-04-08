@extends('layouts.backend.mainlayout')
@section('title','Account Admin')

@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());
</script>
<style>li{list-style:none;}</style>
<!-- hidden Auth email and id for calling in json index -->
<input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="auth_id" />
<input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />

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
                                    class="btn btn-primary ">Add New Webrank</button>

                                <button type="button" name="alexa_global" id="alexa_global"
                                    class="btn waves-effect waves-light btn-success btn-sm">Alexa Global</button>

                                <button type="button" name="domain" id="domain"
                                    class="btn waves-effect waves-light btn-primary btn-sm">Domain</button>

                                <button type="button" name="alexaindia" id="alexaindia"
                                    class="btn waves-effect waves-light btn-success btn-sm">Alexa India</button>
                            </div>
                        </div>

                        <table id="WebrankTable" class="table">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                        <div id="formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add New </h5>
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
                                                <label class="control-label">Project Name</label>
                                                <select name="project_name" id="project_name" class="w-100 p-2" >
                                                    <option value="" class="form-control text-dark">Select
                                                        Project </option>
                                                    @foreach(App\Http\Controllers\Api\ProjectApiController::getvalueall($slug_id)
                                                    as $project)

                                                    <option name="{{$project['id']}}"
                                                        value="{{$project['project_name']}}">
                                                        {{$project['project_name']}}</option>
                                                    @endforeach
                                                </select>
                                                <span id="validation_project" class="text-danger"></span>
                                            </div>

                                            <div class="form-group" id="name_form">
                                                <label class="control-label">Domain Authority</label>
                                                <input type="text" name="domain" id="domain_id" autocomplete="off" class="form-control" placeholder="enter domain authority" />
                                                <span id="validation_domain" class="text-danger"></span>
                                            </div>

                                            <!-- pagerank and page authority start -->
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Alexa Global Rank</label>
                                                        <input type="text" name="global_rank" id="global_rank" autocomplete="off"
                                                            class="form-control" placeholder="enter alexa global" />
                                                            <span id="validation_g_rank" class="text-danger"></span>
                                                    </div>


                                                </div>
                                                <div class="col-md-6 col-sm-6">

                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Alexa Usa Rank</label>
                                                        <input type="text" name="usa_rank" id="usa_rank" autocomplete="off"
                                                            class="form-control" placeholder="enter alexa usa rank" />
                                                            <span id="validation_us_rank" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- pagerank and page authority end -->

                                            <!-- Global  and US rank start -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Alexa India Rank</label>
                                                        <input type="text" name="india_rank" id="india_rank" autocomplete="off"
                                                            class="form-control" placeholder="enter alexa india rank" />
                                                            <span id="validation_ind_rank" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">External Bakclinks</label>
                                                        <input type="text" name="backlinks" id="backlinks"
                                                            class="form-control" autocomplete="off"
                                                            placeholder="enter external backlinks" />
                                                            <span id="validation_bck_link" class="text-danger"></span>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Global  and US rank end -->

                                            <!-- india and backlinks -->
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-sm-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Referring Domains</label>
                                                        <input type="text" name="refer" id="refer" autocomplete="off"
                                                            class="form-control" />
                                                            <span id="validation_refr" class="text-danger"></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Sending admin_id and admin_email in hidden input box -->
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                                id="admin_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" id="admin_email"
                                                name="admin_email" />
                                            <input type="hidden" value="NULL" name="user_id" id="user_id">
                                            <input type="hidden" value="NULL" name="user_email" id="user_email"> 
                                            <!-- below is not applicable here -->
                                            <!-- <input type="hidden" value="" id="url_id" name="url_id" /> -->
                                            <input type="hidden" value="" id="project_id" name="project_id">
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id" id="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                                        </div>

                                    <!-- <br /> -->
                                    <div class="form-group text-center">
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="webrank_hidden_id" id="webrank_hidden_id" />
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
                                        this URL?</h4>
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

                    <!-- Alexa Global Popup start -->
                    <div class="modal fade" id="global" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commontitle"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table id="alexaTable" class="table">
                                        <thead>
                                        </thead>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <tbody>

                                                    </tbody>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Alexa Global Popup end -->


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
    console.log('organization id ka value aa rha hai'+id);
    var dt = $('#WebrankTable').DataTable({
        "ajax": {
        "paging": true,
        "scrollX": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "processing": true,
        "serverSide": true,
        "url": "{{url('api/v1/j/webrank')}}/" + id,
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
        columnDefs: [{
                "title": "ID",
                "targets": 0,
                "width": "%"
            },
            {
                "title": "Date",
                "targets": 1,
                "width": "%"
            },
            {
                "title": "Project Name",
                "targets": 2,
                "width": "10%"
            },
            {
                "title": "Domain Authority",
                "targets": 3,
                "width": "10%"
            },
            {
                "title": "Alexa Global",
                "targets": 4,
                "width": "10%"
            },
            {
                "title": "Alexa USA",
                "targets": 5,
                "width": "10%"
            },
            {
                "title": "Alexa India",
                "targets": 6,
                "width": "10%"
            },
            {
                "title": "Backlinks",
                "targets": 7,
                "width": "10%"
            },
            {
                "title": "Referring Domains",
                "targets": 8,
                "width": "10%"
            },
            {
                "title": "Action",
                "targets": 9,
                "width": "10%"
            },
        ],
        columns: [{
                data: 'id'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<p> ' + data['created_at'].slice(0, 10) + ' </p>'
                },
            },
            {
                data: 'project_name'
            },
            {
                data: 'domain'
            },
            {
                data: 'global_rank'
            },
            {
                data: 'usa_rank'
            },
            {
                data: 'india_rank'
            },
            {
                data: 'backlinks'
            },
            {
                data: 'refer'
            },
            {
                data: null,
                render: function(data, type, row) {
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
    $('#create_record').click(function() {
        $('#name_form').show();
        $('#sample_form')[0].reset();
        $('#form_result').html('');
        $('.modal-title').text("Add New Webrank");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#formModal').modal('show');
    });
    // model will be close

    // showing alexa global data in popup
    $('#alexa_global').click(function() {
        $('#global').modal('show');
        $('#commontitle').text('Alexa Global Rank');
        var global = $('#alexaTable').DataTable({
            "destroy": true,
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/webrank')}}/" + id,
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
                processing: "<img src='../assets/images/loader.gif' style='z-index:1071;background-color:white;border-radius:8pt;padding-top:4pt;padding-bottom:4pt;position:fixed;top:0;right:0;bottom:0;left:0;margin:auto;'>"
            },
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            rowReorder: false,
            columnDefs: [{
                    "title": "ID",
                    "targets": 0
                },
                {
                    "title": "Date",
                    "targets": 1
                },
                {
                    "title": "Project Name",
                    "targets": 2
                },
                {
                    "title": "Alexa Global",
                    "targets": 3
                },
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<p> ' + data['created_at'].slice(0, 10) + ' </p>'
                    },
                },
                {
                    data: 'project_name'
                },
                {
                    data: 'global_rank'
                },

            ],
        });
    });
    // showing alexa global data in popup end

    // showing domain data in popup start
    $('#domain').click(function() {
        $('#global').modal('show');
        $('#commontitle').text('Domain Authority');
        var global = $('#alexaTable').DataTable({
            "destroy": true,
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/webrank')}}/" + id,
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
                processing: "<img src='../assets/images/loader.gif' style='z-index:1071;background-color:white;border-radius:8pt;padding-top:4pt;padding-bottom:4pt;position:fixed;top:0;right:0;bottom:0;left:0;margin:auto;'>"
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
                    "title": "Date",
                    "targets": 1,
                },
                {
                    "title": "Project Name",
                    "targets": 2,
                },
                {
                    "title": "Domain Authority",
                    "targets": 3,
                },
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<p> ' + data['created_at'].slice(0, 10) + ' </p>'
                    },
                },
                {
                    data: 'project_name'
                },
                {
                    data: 'domain'
                },

            ],
        });
    });
    // showing domain data in popup end

    // showing alexa india data in popup start
    $('#alexaindia').click(function() {
        $('#global').modal('show');
        $('#commontitle').text('Alexa India Rank');
        var global = $('#alexaTable').DataTable({
            "destroy": true,
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/webrank')}}/" + id,
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
                processing: "<img src='../assets/images/loader.gif' style='z-index:1071;background-color:white;border-radius:8pt;padding-top:4pt;padding-bottom:4pt;position:fixed;top:0;right:0;bottom:0;left:0;margin:auto;'>"
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
                    "title": "Date",
                    "targets": 1,
                },
                {
                    "title": "Project Name",
                    "targets": 2,
                },
                {
                    "title": "Alexa India rank",
                    "targets": 3,
                },
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<p> ' + data['created_at'].slice(0, 10) + ' </p>'
                    },
                },
                {
                    data: 'project_name'
                },
                {
                    data: 'india_rank'
                },

            ],
        });
    });
    // showing alexa india data in popup end see very carefully
   


//    hide and sho wmessage open
$('#project_name').on('change', function () {
        if ($('#project_name').val() != '') {
            $('#validation_project').hide();
        }
    });
$('#domain_id').on('change', function () {
        if ($('#domain_id').val() != '') {
            $('#validation_domain').hide();
        }
    });
$('#global_rank').on('change', function () {
        if ($('#global_rank').val() != '') {
            $('#validation_g_rank').hide();
        }
    });
$('#usa_rank').on('change', function () {
        if ($('#usa_rank').val() != '') {
            $('#validation_us_rank').hide();
        }
    });
$('#india_rank').on('change', function () {
        if ($('#india_rank').val() != '') {
            $('#validation_ind_rank').hide();
        }
    });
$('#backlinks').on('change', function () {
        if ($('#backlinks').val() != '') {
            $('#validation_bck_link').hide();
        }
    });
$('#refer').on('change', function () {
        if ($('#refer').val() != '') {
            $('#validation_refr').hide();
        }
    });
//    hide and sho wmessage close
    //  form working start
    $('#sample_form').on('submit', function(event) {
        event.preventDefault();
       
        //passing project id in hidden for submitting projec_id into databse
        var project_id = $("#project_name option:selected").attr("name");
        $('#project_id').val(project_id);

        // data add working on submit button
        if ($('#action').val() == 'Add') {

            console.log('add button click ho rha ha');  
            $.ajax({
                 
                url: "{{url('api/v1/j/webrank/store') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                // validation check on input empty open
        beforeSend: function beforeSend() {
                    if (!$('#project_name').val()) {
                        $('#validation_project').html("Please fill project name field");
                    }
                   
                    if (!$('#domain_id').val()) {
                        $('#validation_domain').html("Please  fill domain  field");
                    }
                    if (!$('#global_rank').val()) {
                        $('#validation_g_rank').html("Please  fill global rank field");
                    }
                    if (!$('#usa_rank').val()) {
                        $('#validation_us_rank').html("Please  fill usa rank field");
                    }
                    if (!$('#india_rank').val()) {
                        $('#validation_ind_rank').html("Please  fill usa rank field");
                    }
                    if (!$('#backlinks').val()) {
                        $('#validation_bck_link').html("Please  fill backlink field");
                    }
                    if (!$('#refer').val()) {
                        $('#validation_refr').html("Please  fill refer field");
                    }
                },
        // validation check on input empty close
                success: function(data) {
                // adding alert messages for success and exist data validation open
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#WebrankTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                // adding alert messages for success and exist data validation close
                },
                error: function(data) {
                    console.log('Error:', data);
                    console.log('submit function kamm nahi kr rha hai');
                }
            })
        }

        // update button wotking for updata data
        if ($('#action').val() == "update") {
            console.log('update button pe click ho rha hai');
            $.ajax({
                // url: "{{url('api/v1/j/webrank/update') }}",
                url: "{{route('webranks.update') }}",
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
                    console.log('Url update ho gaya successfully');
                    //setting 2 second in modal to stay
                    setTimeout(function(){
                        $('#formModal').modal('hide');
                        $('#WebrankTable').DataTable().ajax.reload();
                    }, 2000);
                    
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#WebrankTable').DataTable().ajax.reload();
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
            url: "{{url('/api/v1/j/webrank/edit')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html);
                $('#project_name').val(html.data.project_name);
                $('#global_rank').val(html.data.global_rank);
                $('#usa_rank').val(html.data.usa_rank);
                $('#india_rank').val(html.data.india_rank);
                $('#backlinks').val(html.data.backlinks);
                $('#refer').val(html.data.refer);
                $('#domain_id').val(html.data.domain);
                $('#admin_id').val(html.data.admin_id);
                $('#admin_email').val(html.data.admin_email);
                $('.modal-title').text("Edit Webrank");
                $('.modal-title_delete').text("Webrank Delete");
                $('#action_button').val("update");
                $('#action').val("update");
                $('#formModal').modal('show');
                $('#webrank_hidden_id').val(id);
            }
        })
    });

    // delete start
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
            url: "{{url('api/v1/j/webrank/destroy')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            beforeSend: function() {
                $('#ok_button').text('Deleting..');
            },
            success: function(data) {
                console.log('URL delete ho gaya successfully');
                $('#ok_button').text('OK');
                $('#confirmModal').modal('hide');
                $('#WebrankTable').DataTable().ajax.reload()
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })
    });
});
</script>
@endpush