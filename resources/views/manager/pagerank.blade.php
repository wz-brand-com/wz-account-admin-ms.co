@extends('layouts.backend.mainlayout')
@section('title','Manager Pagerank')

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
        <h3 class="text-themecolor">Page Ranking Section</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">System Setting</a></li>
            <li class="breadcrumb-item active">Task</li>
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
                                    class="btn btn-primary ">Add New Page Rank</button>
                            </div>
                        </div>

                        <table id="PagerankTable" class="table">
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
                                                <label class="control-label">URL</label>
                                                    <select name="url" id="url" class="w-100 p-2">
                                                    <option value="" class="form-controll text-dark">Select URL </option>
                                                    </select>
                                            </div>

                                            <!-- pagerank and page authority start -->
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group" id="name_form">
                                                    <label class="control-label">Google Pagerank</label>
                                                        <input type="text" name="pagerank" id="pagerank" class="form-control" autocomplete="off"
                                                        placeholder="enter pagerank" />
                                                    </div>

                                                    
                                                </div>
                                                <div class="col-md-6 col-sm-6">

                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Page Authority</label>
                                                            <input type="text" name="authority" id="authority" class="form-control" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- pagerank and page authority end -->
                                            
                                            <!-- gs placement and bs placement start -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Google S Page Placement</label>
                                                            <input type="text" name="gsplace" id="gsplace" class="form-control"  autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label"> BS Page Placement</label>
                                                            <input type="text" name="bsplace" id="bsplace" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- gs placement and bs placement end -->
                                            <!-- Sending admin_id and admin_email in hidden input box -->
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                                id="admin_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" id="admin_email" name="admin_email" />
                                            <input type="hidden" value="NULL" name="user_id" id="user_id">
                                            <input type="hidden" value="NULL" name="user_email" id="user_email"> 
                                            <input type="hidden" value="" id="url_id" name="url_id" />
                                            <input type="hidden" value="" id="project_id" name="project_id">
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id" id="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
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
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove this Pagerank?</h4>
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
    // onchange function for url get via project name
    $('#project_name').on('change',function(){
        console.log('project name change');
        if(this.value !='default'){
            ajaxCall();
        } else{
            $('#url').empty();
            $('#url').append('<option> Select URL</option>');
        }
        function ajaxCall() {
        console.log('in ajaxCall');
        var project_id = $("#project_name option:selected").attr("name");
        console.log(project_id);
        $.ajax({
                "type": "GET",
                "url": "{{url('api/v1/j/addurl/getProject')}}/"+project_id,
                "data": {},
                "headers": {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function(response) {
                // console.log(response);
                // $('#url').empty();
                // $('#url').append('<option> Select Url </option>');
                // $.each(response,function(i,link){
                //         $('#url').append('<option name="'+link.id+'" value="'+link.url+'">'+link.url+ '</option>');
                //     });
                var wiz_url = response.getting_wizproject_url;
                        console.log('wizard ka url le kr aa gaya' + wiz_url);
                     $('#url').empty();
                        $('#url').append('<option> Select Urls </option>');  
                        console.log(response);
                        $.each(response.data, function (i, link) {
                            $('#url').append('<option name="' + link.id +'" value="' + link.url + '">' + link.url +'</option>'); 
                        });

                        // wizard url open
                        $('#url').append('<option name="' +wiz_url.data.id +'" value="' +wiz_url.data.facebook +'">' + wiz_url.data.facebook +
                        '</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.linkedIn+'">'+wiz_url.data.linkedIn+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.youtube+'">'+wiz_url.data.youtube+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.twitter+'">'+wiz_url.data.twitter+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.reddit+'">'+wiz_url.data.reddit+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.tumblr+'">'+wiz_url.data.tumblr+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.plurk+'">'+wiz_url.data.plurk+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.getpocket+'">'+wiz_url.data.getpocket+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.wix+'">'+wiz_url.data.wix+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.wordpress+'">'+wiz_url.data.wordpress+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.weebly+'">'+wiz_url.data.weebly+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.medium+'">'+wiz_url.data.medium+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.professnow+'">'+wiz_url.data.professnow+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.github+'">'+wiz_url.data.github+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.hubpages+'">'+wiz_url.data.hubpages+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.ehow+'">'+wiz_url.data.ehow+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.dzone+'">'+wiz_url.data.dzone+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.articlesfactory+'">'+wiz_url.data.articlesfactory+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.justdial+'">'+wiz_url.data.justdial+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.sulekha+'">'+wiz_url.data.sulekha+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.indiamart+'">'+wiz_url.data.indiamart+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.quikr+'">'+wiz_url.data.quikr+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.click+'">'+wiz_url.data.click+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.quora+'">'+wiz_url.data.quora+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.wikibooks+'">'+wiz_url.data.wikibooks+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.answers+'">'+wiz_url.data.answers+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.superuser+'">'+wiz_url.data.superuser+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.dailymotion+'">'+wiz_url.data.dailymotion+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.vimeo+'">'+wiz_url.data.vimeo+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.metacafe+'">'+wiz_url.data.metacafe+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.dropshots+'">'+wiz_url.data.dropshots+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.mediafire+'">'+wiz_url.data.mediafire+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.slideshare+'">'+wiz_url.data.slideshare+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.scribd+'">'+wiz_url.data.scribd+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.four_shared+'">'+wiz_url.data.four_shared+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.issuu+'">'+wiz_url.data.issuu+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.freeadstime+'">'+wiz_url.data.freeadstime+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.superadpost+'">'+wiz_url.data.superadpost+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.mastermoz+'">'+wiz_url.data.mastermoz+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.h1ad+'">'+wiz_url.data.h1ad+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.imgur+'">'+wiz_url.data.imgur+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.flickr+'">'+wiz_url.data.flickr+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.instagram+'">'+wiz_url.data.instagram+'</option>'
                        +'<option name="' +wiz_url.data.id +'" value="'+wiz_url.data.pinterest+'">'+wiz_url.data.pinterest+'</option>'
                        );
                        // wizard url close
                // #################################################################################################################
                },
                error: function(errorResponse) {
                console.log(errorResponse);
                }
            });
        }
    });
  // onchange function for url get via project name  

 // image load
 window.addEventListener("load", function() {
   $(".loader").delay(500).fadeOut("slow");
});
    console.log('trying to call api');
    id = $('#u_org_organization_id').val();
    var dt = $('#PagerankTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/pagerank/index')}}/"+id,
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
            {"title": "Project Name","targets": 1,"width": "20%"},
            {"title": "URL","targets": 2,"width": "20%"},
            {"title": "Google Pagerank","targets": 3,"width": "20%"},
            {"title": "Page Authority","targets": 4,"width": "20%"},
            {"title": "Google S Page Placement","targets": 5,"width": "15%"},
            {"title": "B S Page Placement","targets": 6,"width": "15%"},
            {"title": "Action","targets": 7,"width": "10%"},
             ],
        columns: [{
                data: 'id'
            },
            {
                data: 'project_name'
            },
            {
                data: null,
                render: function(data, type, row) 
                {
                    return '<a href="'+data['url']+'" class="btn waves-effect waves-light btn-xs btn-info" target="_blank" title="'+data['url']+'">Click Here </a>'
                },
            },
            {
                data: 'pagerank'
            },
            {
                data: 'authority'
            },
            {
                data: 'gsplace'
            },
            {
                data: 'bsplace'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="row"><div class="col-6"><button type="button"  id="' +
                        data['id'] +
                        '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div></div>'
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
        $('.modal-title').text("Add New Pagerank");
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
        //passing url id in hidden for submitting url_id into databse
        var url = $('#url option:selected').attr("name");
        $('#url_id').val(url);

        console.log(url);
        // data add working on submit button
        if ($('#action').val() == 'Add') {
        
            console.log('add button click ho rha ha');
            $.ajax({
                url: "{{url('api/v1/j/pagerank/store') }}",
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
                    console.log('abhi ham success function ke ander aaye hai');
                   // adding alert messages for success and exist data validation open
                   var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#PagerankTable').DataTable().ajax.reload();
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
                url: "{{url('/api/v1/j/pagerank/update') }}",
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
                //     console.log('URL update ho gaya successfully');
                //     $('#formModal').modal('hide');
                //     $('#PagerankTable').DataTable().ajax.reload()
                // },

                // message alert open
                success: function(data) {
                    console.log('Manager update ho gaya successfully');
                    //setting 2 second in modal to stay
                    setTimeout(function(){
                        $('#formModal').modal('hide');
                        $('#PagerankTable').DataTable().ajax.reload();
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
            url: "{{url('/api/v1/j/pagerank/edit')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html);
          
                $('#project_name').val(html.data.project_name);
             //open 
             $('#url').prepend("<option value='"+html.data.url+"' selected='selected'>"+html.data.url+"</option>");
                // close
                $('#pagerank').val(html.data.pagerank);
                $('#authority').val(html.data.authority);
                $('#gsplace').val(html.data.gsplace);
                $('#bsplace').val(html.data.bsplace);
                $('#admin_id').val(html.data.admin_id);
                $('#admin_email').val(html.data.admin_email);
                $('.modal-title').text("Edit Pagerank");
                $('.modal-title_delete').text("Pagerank Delete");
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
            url: "{{url('api/v1/j/pagerank/destroy')}}/" + id,
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
                $('#PagerankTable').DataTable().ajax.reload()
            },
            error: function(data) {
                console.log('Error:', data);   
            }
        })
    });
});
</script>
@endpush