@extends('layouts.backend.mainlayout')
@section('title','Manager Keyword')

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
<!-- html tag input open -->
<link href="{{ asset('css/tagify.css') }}" rel="stylesheet">
<script src="{{ asset('js/jQuery.tagify.min.js') }}"></script>   
<script src="{{ asset('js/tagify.min.js') }}"></script>

<style>

.custom-tag {
    background: #eee;
    border-radius: 3px 0 0 3px; 
    display: inline-block;
    height: 26px;
    line-height: 26px;
    padding: 0 10px 0 10px;
    position: relative;
    margin: 0 5px 5px 0;
}



</style>
<!-- ============================================================== -->
{{-- <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Keyword Section</h3>
    </div>
    <div class="col-md-7 align-self-center">
       
    </div>
</div> --}}
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

                        {{-- model  open --}}
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn btn-primary ">Add New Keyword</button>
                            </div>
                        </div>

                        <table id="keywordTable" class="table">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                        <div id="formModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add New Keyword</h5>
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
                                                <label class="control-label col-md-4">Project Name</label>
                                                <div class="col-md-12">
                                                <select name="project_name" id="project_name" class="w-100 p-2">
                                                        <option value="default" class="form-control text-dark">Select Project </option>
                                                        @foreach(App\Http\Controllers\Api\ProjectApiController::getvalueall($slug_id) as $project)

                                                        <option name="{{$project['id']}}" value="{{$project['project_name']}}">{{$project['project_name']}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
    
                                            <div class="form-group" id="name_form">
                                                <label class="control-label col-md-4">URL</label>
                                                <div class="col-md-12">
                                                    <select name="url" id="url" class="w-100 p-2">
                                                        <option value="" class="form-controll text-dark">Select URL </option>
                                                        <option value="" class="form-controll text-dark"> </option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group" id="name_form">
                                                <label class="control-label col-md-4">Keyword</label>
                                                <div class="col-md-12">
                                                    <!-- <input type="text" name="keyword" id="keyword" class="form-control" /> -->
                                                    <!-- testing keyword open -->
                                                    <input id="keyword1"  name="keyword" class="form-control">
                                                    <!-- testing keyword close -->
                                                </div>
                                                <!-- information open -->
                                                <span class="fa fa-info-circle text-success"> 
                                                <span class="text-danger mt-2">After Each Keyword Press Enter  </span>
                                                </span>
                                                <!-- information close -->
                                            </div>
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

                    
                    <!-- data cannot delete after  model open  -->
                    <div class="row">
                        <div class="col-lg-10">
                            <div id="reextendmodel" class="modal" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-header" style="color:red;font-weight:bold;">
                                                 Error
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title" style="color:red;">Message </h3>
                                                <p class="card-text">The action can not be completed because the <span class="text-primary" name="name_manager" id="name_manager"> </span>
                                                is working in this <span class="text-primary">Task Manager of Task Board</span> program getting error message,</p>
                                                <a href="#" class="close" data-dismiss="modal"><i class="fa fa-times-circle text-danger"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data cannot delete after model close -->

                    <div id="confirmModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <br>
                                    <span class="modal-title_delete">Confirmation</span>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove this Keyword?</h4>
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
    var input = document.querySelector('input[name=keyword]'),
    tagify =new Tagify(input);
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
                    // $('#url').empty();
                    // $('#url').append('<option> Select Url </option>');
                    // console.log(response);
                    // $.each(response,function(i,link){
                    //     $('#url').append('<option name="'+link.id+'" value="'+link.url+'">'+link.url+ '</option>');
                    // });  
                    var wiz_url = response.getting_wizproject_url;
                        console.log('wizard ka url le kr aa gaya' + wiz_url);
                    // $('#url').empty();
                    // $('#url').append('<option> Select Url </option>');
                    // console.log(response);
                    // $.each(response,function(i,link){
                    //     $('#url').append('<option name="'+link.id+'" value="'+link.url+'">'+link.url+ '</option>');
                    // });
                     // this url is comming from add url ms concatinate close
                     $('#url').empty();
                        $('#url').append('<option> Select Url </option>');  
                        console.log(response);
                        $.each(response.data, function (i, link) {
                            $('#url').append('<option name="' + link.url +'" value="' + link.url + '">' + link.url +'</option>'); 
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
                        // wizard url clos e
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
    function setkeyword(keyword){
         var newkey='';
         $.each(JSON.parse(keyword), function (key, value) {
                       // console.log(key)
                       newkey+='<span class="custom-tag">'+value.value+'</span>';
                       
          });
        return newkey;
    }
    var dt = $('#keywordTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/keyword/index')}}/"+id,
            "dataSrc": 'data',
            "type": "GET",
            "datatype": "json",
            "crossDomain": true,
            "sScrollY": "200px",
            "sScrollX": "98%" , 
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
            {"title": "ID","targets": 0,"width": "5%"},
            {"title": "Project Name","targets": 1,"width": "10%"},
            {"title": "URL","targets": 2,"width": "5%"},
            {"title": "Keyword","targets": 3,"width": "10%"},
            {"title": "Action","targets": 4,"width": "5%"},
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
                data: null,
                render: function(data, type, row) 
                {   
                    return setkeyword(data['keyword'])
                    
                    
                },
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="row"><div class="col-5"><button type="button"  id="' +
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
        $('.modal-title').text("Add New Keyword");
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
                url: "{{url('api/v1/j/keyword/store') }}",
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
                                $('#keywordTable').DataTable().ajax.reload();
                            }, 2000);
                            window.location.reload();
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                        // adding alert messages for success and exist data validation close
                },
                error: function(data) {
                    console.log('In Error me aa gaya hai');
                    console.log('Error:', data);
                }
            })
        }

        // update button wotking for updata data
        if ($('#action').val() == "Update") {
            console.log('update button pe click ho rha hai');
            $.ajax({
                url: "{{url('/api/v1/j/keyword/update/') }}",
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
                    console.log('URL update ho gaya successfully');
                    //setting 2 second in modal to stay
                    setTimeout(function(){
                        $('#formModal').modal('hide');
                        $('#keywordTable').DataTable().ajax.reload();
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
        // var input = document.querySelector('input[id=keyword1]'),
        //     tagify = new Tagify(input);
        $('#name_form').show();
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{url('/api/v1/j/keyword/edit')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html);
                
                $.each(JSON.parse(html.data.keyword), function (key, value) {
            //   debugger;
             tagify.addTags([value.value]);
            console.log(value.value);
              });

                 //open
                 $('#url').prepend("<option value='" + html.data.url +
                   "' selected='selected'>" + html.data.url + "</option>");
                    // close
                $('#project_name').val(html.data.project_name);
                $('#url').val(html.data.url);

               
                var keyword_title = '';
                console.log('keyword ka value aaa raha hai ki nahi'+keyword_title);
                    $.each(JSON.parse(html.data.keyword), function (key, value) {
                        // console.log(key)
                        keyword_title += '<span class="custom-tag">' + value.value +
                            '</span>';

                    });
                $('#keyword_name').html(keyword_title);
                $('#admin_id').val(html.data.admin_id);
                $('#admin_email').val(html.data.admin_email);
                $('.modal-title').text("Edit Keyword");
                $('.modal-title_delete').text("Keyword Delete");
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
        name = $(this).attr('name');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function() {
        console.log('working delete button');
        $('#name_form').show();
        $('#form_result').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{url('api/v1/j/keyword/destroy')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            beforeSend: function() {
                $('#ok_button').text('Deleting..');
            },
            success: function(data) {
                if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#confirmModal').modal('hide');
                                $('#ok_button').text('OK');
                                $('#keywordTable').DataTable().ajax.reload();
                                // alert('Data Deleted Successfully'+data.success);
                            }, 2000);
                        } else {
                            $('#confirmModal').modal('hide');
                            $('#ok_button').text('OK');
                            $('#reextendmodel').modal('show');
                            console.log('user name aa raha hai'.name);
                            $('#name_manager').html(name);
                            $('#form_result').html("");
                        }
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })
    });
});
</script>
<!-- :::::::::::::::: tag keyword open :::::::::::::::::::: -->
<script>
	// jQuery
    // $('[name=keyword]').tagify();
// Vanilla JavaScript 
// var input = document.querySelector('input[name=keyword]'),
// tagify =new Tagify( input );
// $('[name=keyword]').tagify({duplicates :false});



</script>
<!-- :::::::::::::::: tag keyword close :::::::::::::::::::: -->

@endpush