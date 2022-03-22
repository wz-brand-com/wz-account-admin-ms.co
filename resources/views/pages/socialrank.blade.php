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

                        <!-- {{-- model  open --}} -->
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn btn-primary ">Add New Social Ranking</button>

                                    <button type="button" name="ytsubscriber" id="ytsubscriber" class="btn waves-effect waves-light btn-danger"><i class="mdi mdi-youtube-play"></i> Subscriber</button>

                                    <button type="button" class="btn waves-effect waves-light btn-primary" title="Facebook Likes" id="fbview"><i class="mdi mdi-facebook-box"></i> <i class="mdi mdi-thumb-up"></i></button>

                                   <button type="button" class="btn waves-effect waves-light btn-success" id="twitterview"><i class="mdi mdi-twitter-box"></i> Followers</button>
                            </div>
                        </div>

                        <table id="SocialTable" class="table">
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
                                                    <select name="project_name" id="project_name" class="w-100 p-2">
                                                        <option value="default" class="form-control text-dark">Select Project </option>
                                                        @foreach(App\Http\Controllers\Api\ProjectApiController::getvalueall($slug_id) as $project)

                                                        <option name="{{$project['id']}}" value="{{$project['project_name']}}">{{$project['project_name']}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>

                                            <div class="form-group" id="name_form">
                                                <label class="control-label">Facebook Likes</label>
                                                <input type="text" name="fb_likes" id="fb_likes" class="form-control" placeholder="enter facebook likes" autocomplete="off" />
                                            </div>

                                            <!-- pagerank and page authority start -->
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group" id="name_form">
                                                    <label class="control-label">Youtube Subscribers</label>
                                                        <input type="text" name="yt_subs" id="yt_subs" class="form-control" placeholder="enter yt subscribers" autocomplete="off"/>
                                                    </div>

                                                    
                                                </div>
                                                <div class="col-md-6 col-sm-6">

                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Twitter Followers</label>
                                                            <input type="text" name="tw_follower" id="tw_follower" class="form-control" placeholder="enter twitter follower" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- pagerank and page authority end -->
                                            
                                            <!-- Global  and US rank start -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Instagram Followers</label>
                                                            <input type="text" name="insta_follower" id="insta_follower" class="form-control" placeholder="enter insta follower" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  Global  and US rank end -->



                                            <!-- Sending admin_id and admin_email in hidden input box -->
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                                id="admin_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" id="admin_email" name="admin_email" />
                                            <input type="hidden" value="NULL" name="user_id" id="user_id">
                                            <input type="hidden" value="NULL" name="user_email" id="user_email"> 
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id" id="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                                            <!-- below is not applicable here -->
                                            <!-- <input type="hidden" value="" id="url_id" name="url_id" /> -->
                                            <input type="hidden" value="" id="project_id" name="project_id">
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
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove this Socialrank?</h4>
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

                    <!--  Popup for yt  facebook and insta button start -->
                    <div class="modal fade" id="socialbutton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="socialTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table id="socialTableView" class="table">
                                    <thead>

                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
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
    var dt = $('#SocialTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/socialrank')}}/"+id,
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
            {"title": "Date","targets": 1,"width": "10%"},
            {"title": "Project Name","targets": 2,"width": "20%"},
            {"title": "FB Likes","targets": 3,"width": "10%"},
            {"title": "YT Subscriber","targets": 4,"width": "10%"},
            {"title": "Twitter Followers","targets": 5,"width": "10%"},
            {"title": "Instagram Followers","targets": 6,"width": "10%"},
            {"title": "Action","targets": 7,"width": "10%"},
             ],
        columns: [{
                data: 'id'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<p> '+ data['created_at'].slice(0,10)+' </p>'
                },
            },
            {
                data: null,
                render: function(data, type, row) 
                {
                    return '<span class="label label-primary"> ' + data['project_name'] + ' </span>'
                },
            },
            {
                data: 'fb_likes'
            },
            {
                data: 'yt_subs'
            },
            {
                data: 'tw_follower'
            },
            {
                data: 'insta_follower'
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
        $('.modal-title').text("Add New Social Ranking");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#formModal').modal('show');
    });
    // model will be close


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
                url: "{{url('api/v1/j/socialrank/store') }}",
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
                       // adding alert messages for success and exist data validation open
                       var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#SocialTable').DataTable().ajax.reload();
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
        if ($('#action').val() == "Update") {
            console.log('update button pe click ho rha hai');
            $.ajax({
                url: "{{url('/api/v1/j/socialrank/update/') }}",
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
                        // adding alert messages for success and exist data validation open
                        var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#SocialTable').DataTable().ajax.reload();
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
            url: "{{url('/api/v1/j/socialrank/edit')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html); 
                $('#project_name').val(html.data.project_name);
                $('#fb_likes').val(html.data.fb_likes);
                $('#yt_subs').val(html.data.yt_subs);
                $('#usa_rank').val(html.data.usa_rank);
                $('#tw_follower').val(html.data.tw_follower);
                $('#insta_follower').val(html.data.insta_follower);
                $('#admin_id').val(html.data.admin_id);
                $('#admin_email').val(html.data.admin_email);
                $('.modal-title').text("Edit Socialrank");
                $('.modal-title_delete').text("Socialrank Delete");
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
            url: "{{url('api/v1/j/socialrank/destroy')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            beforeSend: function() {
                $('#ok_button').text('Deleting..');
            },
            success: function(data) {
                console.log('Socialrank delete ho gaya successfully');
                $('#ok_button').text('OK');
                $('#confirmModal').modal('hide');
                $('#SocialTable').DataTable().ajax.reload()
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })
    });

    // extra popup for multiple view via subscriber , twitter follower and insta followers
    $("#ytsubscriber").click(function(){
        // alert('subscriber button click working');
        $("#socialbutton").modal("show");
        $("#socialTitle").text("YT Subscriber View");
            var social = $('#socialTableView').DataTable({
            "destroy": true,
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/socialrank')}}/"+id,
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
            columnDefs: [
                {"title": "ID","targets": 0},
                {"title": "Date","targets": 1},
                {"title": "Project Name","targets": 2},
                {"title": "YT Subscriber","targets": 3},
                ],
            columns: [
                {
                    data: 'id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<p> '+ data['created_at'].slice(0,10)+' </p>'
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) 
                    {
                        return '<span class="label label-primary"> ' + data['project_name'] + ' </span>'
                    },
                },
                {
                    data: 'yt_subs'
                },

            ],


        });
    });

    // fb view start on popup 
    $("#fbview").click(function(){
        // alert("fb view is working");
        $("#socialbutton").modal("show");
        $("#socialTitle").text("FB View");
        var social = $('#socialTableView').DataTable({
            "destroy": true,
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/socialrank')}}/"+id,
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
            columnDefs: [
                {"title": "ID","targets": 0},
                {"title": "Date","targets": 1},
                {"title": "Project Name","targets": 2},
                {"title": "FB Likes","targets": 3},
                ],
            columns: [
                {
                    data: 'id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<p> '+ data['created_at'].slice(0,10)+' </p>'
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) 
                    {
                        return '<span class="label label-primary"> ' + data['project_name'] + ' </span>'
                    },
                },
                {
                    data: 'fb_likes'
                },

            ],
        });
    });

    // twitter view in popup start
    $("#twitterview").click(function(){
        // alert("fb view is working");
        $("#socialbutton").modal("show");
        $("#socialTitle").text("Twitter Followers View");
        var social = $('#socialTableView').DataTable({
            "destroy": true,
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/socialrank')}}/"+id,
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
            columnDefs: [
                {"title": "ID","targets": 0},
                {"title": "Date","targets": 1},
                {"title": "Project Name","targets": 2},
                {"title": "Twitter Followers","targets": 3},
                ],
            columns: [
                {
                    data: 'id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<p> '+ data['created_at'].slice(0,10)+' </p>'
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) 
                    {
                        return '<span class="label label-primary"> ' + data['project_name'] + ' </span>'
                    },
                },
                {
                    data: 'tw_follower'
                },

            ],
        });
    });

});
</script>
@endpush