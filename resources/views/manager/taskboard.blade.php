@extends('layouts.backend.mainlayout')
@section('title','Account Admin')

@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
    localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());

</script>
<!-- hidden Auth email and id for calling in json index -->
<input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="auth_id" />
<input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />
<!-- select keyword html tag input open -->
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

    .tagify {
        --tags-border-color: none;
    }
    #taskboardviewdetails span b{
color:#000;
    }
</style>

<br><br><br>

<div class="container-fluid">

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <!-- -- model  open -- -->
                        <div class="row">
                            <div class="col-md-8">
                            <button type="button" name="create_record" id="create_record"
                                class="btn btn-primary ">Add New Task
                            </button>
                            </div>
                        </div>
                        <table id="TaskboardTable" class="table">
                            <thead>
                                <!-- data fetching from database -->
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div id="taskboard_form_modal" class="modal fade" role="dialog">
                            <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel"></h5>
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
                                                        <label class="control-label">Project Name </label>
                                                        <select name="project_name" id="project_name" class="w-100 p-2">
                                                            <option value="default" class="form-control text-dark">
                                                                Select Project </option>
                                                            @foreach(App\Http\Controllers\Api\ProjectApiController::getvalueall($slug_id)
                                                            as $project)
                                                            <option name="{{$project['id']}}" value="{{$project['project_name']}}">
                                                                {{$project['project_name']}}</option>
                                                            @endforeach

                                                        </select> 
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Web Url</label>
                                                        <select name="weburl" id="url" class="w-100 p-2">
                                                            <option value="" class="form-controll text-dark">
                                                                Select Web URL </option>
                                                        </select>
                                                        <input type="hidden" value="" id="weburl_id" name="weburl_id" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">keyword</label>
                                                        <input name='keyword' onkeydown="return false;">
                                                        <select name="" id="keyword-select" class="w-100 p-2">
                                                            <option value="" class="form-controll text-dark">Select
                                                                Keyword </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Severity</label>
                                                        <select class="form-control custom-select" name="severity"
                                                            id="severity">
                                                            <option value="">Select Severity</option>
                                                            <option value="Most Important">Most Important</option>
                                                            <option value="Moderately Important">Moderately Important
                                                            </option>
                                                            <option value="Important">Important</option>
                                                            <option value="Regular">Regular</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Task Type</label>
                                                    

                                                        <select name="tasktype" id="taskTypeValue" class="w-100 p-2">
                                                            <option value="default" class="form-controll text-dark">Select Task Type </option>
                                                           
                                                          
                                                        </select>

                                                      

                                                    </div>
                                                </div>
                                                <div class="col-md-6">


                                                    <div class="form-group">
                                                        <label class="control-label">Task Deadline</label>
                                                        <input type="date" id="taskdeadline"
                                                            class="form-control mydatepicker" placeholder="mm/dd/yyyy"
                                                            name="taskdeadline" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">

                                                    <label class="control-label">Task Assign To</label>
                                                        <select name="user" id="project_manager" class="w-100 p-2">
                                                            <option value=""  class="form-controll text-dark"> Select Email </option>
                                                            <option value="{{Auth::user()->email}}">{{Auth::user()->email}}</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group" id="hidestatus">
                                                        <label class="control-label">Task Status</label>

                                                        <select name="status" id="status" class="w-100 p-2">
                                                            <option>-- Select Status --</option>
                                                            <option id="pending" value="pending">Pending</option>
                                                            <option value="hold">Hold</option>
                                                            <option value="verified">Verified</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Attachment File</label>
                                                        <input type="file" id="document_file"
                                                            class="form-control" name="document" accept=".pdf, .jpeg, .jpg, .png" >
                                                             <span class="text-danger">Upload file (.pdf, .jpeg, .jpg, .png)</span>
                                                             <div id="document_show"></div>
                                                             <!-- <input type="hidden" id="file_document_show" name="file_document_show"> -->
                                                    </div>

                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Description</label>
                                                        <textarea row="4" name="description" id="textarea"
                                                            class="w-100 p-2" maxlength="120"> </textarea>
                                                        <span id="rchars">120</span> Character(s) Remaining
                                                    </div>
                                                </div>
                                            </div>
                                    <!-- Sending admin_id and admin_email in hidden input box -->
                                    <input type="hidden" name="user_hidden_id" id="user_hidden_id"> <!--- for img update hiden id--->
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="admin_id"/>
                                    <input type="hidden" value="{{ Auth::user()->email }}" id="admin_email" name="admin_email"/>
                                    <input type="hidden" value="NULL" name="user_id" id="user_id"/>
                                    <input type="hidden" value="NULL" name="user_email" id="user_email"/>
                                    <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                    <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id" id="u_org_organization_id">
                                    <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                                    <!-- Sending admin_id and admin_email in hidden input box end-->

                                    </div>
                                    <input type="hidden" value="" id="url_id" name="url_id" />

                                    <input type="hidden" value="" id="project_id" name="project_id">
                                    <input type="hidden" value="" id="title" name="title">

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

                    <!-- for delete form open -->
                    <div id="confirmModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <br>
                                    <span class="modal-title_delete text-dark">Confirmation</span>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove
                                        this Task Borad</h4>
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
                    <!--  Popup for show full data button start -->
                    <div class="modal fade" id="viewbutton" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="socialTitle"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table id="viewTable" class="table">
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

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- task view details open -->
<div id="taskboardviewdetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="mymodal-title text-white" id="mymodal"> Task Board Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="famous_city_form_result" aria-hidden="true"></span>
                <div id="cardop" class="cardop" style="display: none;">
                    <div class="card-body">
                            <!-- Show Modal view Card start -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div>
                                        <span><b>Project name: </b></span>
                                        <span id="project_name_title"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div>
                                        <span><b>Keyword: </b></span>
                                        <span id="keyword_name"></span>
                                    </div>
                                </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>Severity: </b></span>
                                        <span id="severity_name"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>Taskdeadline: </b></span>
                                        <span id="taskdeadline_name"></span>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>User: </b></span>
                                        <span id="user_name"></span>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <span><b>Weburl: </b></span>
                                        <span id="weburl_name"></span>
                                    </div>
                                </div>
                                <hr>
                                
                                <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <span><b>Tasktype: </b></span>
                                            <span id="tasktype_name"></span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <span><b>Document: </b></span>
                                            <span id="document_show_image"></span>
                                        </div>
                                </div>
                                <hr>
                                <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <span><b>Describtion: </b></span>
                                            <span id="description_name"></span>
                                        </div>
                                    
                                </div>
                                <hr>

                                </div>
                            </div>
                            
                            <!-- Show Modal view Card End -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- task view details close -->
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@endsection

@push('js')

<script>
    $(document).ready(function () {
        // image load

           
               // manger will be call on load page open
               userAuthId = $('#admin_id').val();
        console.log('what is coming in userAuthId : ' +userAuthId);
        organisation_id = $('#u_org_organization_id').val();
        console.log('organisation id ka ' + organisation_id);
        $.ajax({
        type: 'get',
        url: "{{url('api/v1/j/invitedManagerUserGetting')}}/" + userAuthId+'/'+organisation_id,
        dataType: "json",
        async:false,
        // dataSrc: 'data',
        // "beforeSend": function (xhr) {
        //             xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem(
        //                 'a_u_a_b_t'));
        //         },

        headers: {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
        
        success: function(data) {
            console.log('success main mamager id value a rha hai ki nahi'+data);
            var p_name = ('#project_manager');
            // $(p_name).empty();

            $.each(data, function (i, link) {
                            $('#project_manager').append('<option name="' + link.u_org_user_email +'" value="' + link.u_org_user_email + '">' + link.u_org_user_email +'</option>'); 
                        });

        }

    });

    

    // manger will be call on load page close

     // ======================== task type is calling in drop dwon open
    //  slug_id = $('#admin_id').val();
    //     console.log('task type auth is cooming' + slug_id);
    //     $.ajax({
    //         type: 'get',
    //         url: "{{ url('api/v1/j/siteadmin_tasktype/gettasktype') }}/" + slug_id,
    //         dataType: "json",
    //         async: false,
    //         dataSrc: 'data',
    //         "beforeSend": function (xhr) {
    //             xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem(
    //                 'a_u_a_b_t'));
    //         },
    //         success: function (data) {
    //             console.log('success task type value is coming from site admin' + data);
    //             var p_name = ('#taskTypeValue');
    //             $.each(data, function (i, link) {
    //             $('#taskTypeValue').append('<option name="' + link.tasktype + '" value="' + link.tasktype +'">' + link.tasktype + '</option>');
    //             });
    //         }
    //     });
    // ======================== task type is calling in drop dwon close




        // onchange function for url get via project name
        $('#project_name').on('change', function () {
            $('#keyword-select').empty();
                $('#keyword-select').append('<option> Select keyword </option>');
                tagify.removeAllTags();
            console.log('project name change');
            if (this.value != 'default') {
                ajaxCall();
            } else {
                $('#url').empty();
                $('#url').append('<option> Select URLs</option>');

            }


            function ajaxCall() {
                console.log('in ajaxCall');
                var project_id = $("#project_name option:selected").attr("name");
                console.log('project name ka id aya yaha pe '+ project_id);
                $.ajax({
                    "type": "GET",
                    "url": "{{url('api/v1/j/addurl/getProject')}}/" + project_id,
                    "data": {},
                    "headers": {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    success: function (response) {
                        // $('#url').empty();
                        // $('#url').append('<option> Select Urls </option>');
                        // console.log(response);
                        // $.each(response, function (i, link) {
                        //     $('#url').append('<option name="' + link.id +'"value="'+link.url+'">'+link.url+'</option>');
                        // });
                        
                       // this url is comming from add url ms concatinate close
                        var wiz_url = response.getting_wizproject_url;
                        console.log('wizard ka url le kr aa gaya' + wiz_url);  
                        $('#url').empty();
                        $('#url').append('<option> Select Url </option>');  
                        console.log(response);
                        $.each(response.data, function (i, link) {
                            $('#url').append('<option name="' + link.id +'" value="' + link.url + '">' + link.url +'</option>'); 
                        });
                        // this url is comming from add url ms concatinate close

                        // wizard url open
                        // $('#url').append('<option name="' +wiz_url.data.id +'" value="' +wiz_url.data.facebook +'">' + wiz_url.data.facebook +
                        // '</option>'
                        // );
                        $('#url').append('<option name="' +wiz_url.data.id +'" value="' +wiz_url.data.facebook +'">' + wiz_url.data.facebook +
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
                    },
                    error: function (errorResponse) {
                        console.log(errorResponse);
                    }
                });
            }
        });
        // onchange function for url get via project name
        // onchange function for url select on based keyword will be display


        $('#url').on('change', function () {
            console.log('keyword name change');
            var weburl_id = $("#url option:selected").attr("name");
            console.log('geting url ka id on change url '+ weburl_id);
            $("#weburl_id").val(weburl_id);
            if (this.value != '') {
                ajaxCall();
            } else {
                $('#keyword-select').empty();
                $('#keyword-select').append('<option> Select keyword </option>');
            }


            // selector on keyword open
            function ajaxCall() {
                console.log('in ajaxCall');
                var url_id = $("#url option:selected").attr("name");
                console.log("url ka id kahe nahi aa rha be" + url_id);
                $.ajax({
                    "type": "GET",
                    "url": "{{url('api/v1/j/keyword/getKeywordData')}}/" + url_id,
                    "data": {},
                    "headers": {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    success: function (response) {
                        $('#keyword-select').empty();
                        $('#keyword-select').append('<option> Select keywords1 </option>');
                        console.log(response);
                        $.each(JSON.parse(response[0].keyword), function (key, value) {
                            $('#keyword-select').append('<option name="' + response[
                                    0].id +
                                '" value="' + value.value + '">' + value
                                .value + '</option>');

                        });
                    },
                    error: function (errorResponse) {
                        console.log(errorResponse);
                    }
                });
            }
            // selector on keyword close
        });
        // onchange function for url select on based keyword will be display  close

        window.addEventListener("load", function () {
            $(".loader").delay(500).fadeOut("slow");
        });
        console.log('trying to call api');
        id = $('#u_org_organization_id').val();
        user_id = $('#user_id').val();
        var dt = $('#TaskboardTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,

                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/taskboards/index')}}/" + id,
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
                    "targets": 0
                },
                {
                    "title": "Task Title",
                    "targets": 1
                },
                {
                    "title": "Project&nbsp;&nbsp;Name",
                    "targets": 2
                },

                {
                    "title": "User Email",
                    "targets": 3
                },
                {
                    "title": "Task Deadline",
                    "targets": 4
                },
                {
                    "title": "Status",
                    "targets": 5
                },
                {
                    "title": "Action",
                    "targets": 6,
                    "width": "20%"
                },

            ],
            columns: [{
                    data: 'id'
                },
                {
                    // data: 'title'
                    data: null,
                    render: function(data, type, row) 
                    {
                        return  data['title'].substr(0, 6) 
                    },
                },
                {
                    // data: 'project_name'

                    data: null,
                    render: function(data, type, row) 
                    {
                        // if(data.count < 30){
                        //     return  data['project_name']
                        // } else{
                            return  data['project_name'].substr(0, 30)
                            // +'...'
                        // }
                    },

                },

                {
                    data: 'user'
                },
                {
                    data: 'taskdeadline'
                },


                // {
                //     data: 'description'
                // },
                {
                    data: null,
                    render: function (data, type, row) {
                        if (row.status == 'completed') {
                            return '<span class="badge badge-pill badge-success">' + data[
                                'status'] + '</span>';
                        } else if (row.status == 'hold') {
                            return '<span class="badge badge-pill badge-warning">' + data[
                                'status'] + '</span>';
                        } else if (row.status == 'verified') {
                            return '<span class="badge badge-pill badge-info">' + data[
                                'status'] + '</span>'
                        } else {
                            return '<span class="badge badge-pill badge-danger">' + data[
                                'status'] + '</span>';
                        }
                    }
                },
                {
                    data: null,

                    render: function (data, type, row) {
                        return '<div class="row"><div class="col-4"><button type="button"  id="' +
                            data['id'] +
                            '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div>                            <div class="row"><div class="col-4"><button type="button"  id="' +
                            data['id'] +
                            '" class="details_task_view btn btn-success"><i class="mdi mdi-eye"></i></button></div>      <div class="col-4"><button type="button" id="' +

                            data['id'] +
                            '"  class="btn btn-danger  delete"><i class="mdi mdi-delete"></i></button></div> </div>'
                    },
                },
            ],


        });
        // data table close

        // showing single data by id
        $(document).on('click', '.viewdata', function () {
            id = $(this).attr('id');
            $('#viewbutton').modal('show');
            var dt = $('#viewTable').DataTable({
                "destroy": true,
                "ajax": {
                    "paging": true,
                    "scrollX": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "processing": true,
                    "serverSide": true,
                    "url": "{{url('api/v1/j/taskboards/showdata')}}/" + id,
                    "dataSrc": 'data',
                    "type": "GET",
                    "datatype": "json",
                    "crossDomain": true,
                    "beforeSend": function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer " + localStorage
                            .getItem(
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
                        "title": "Project Name",
                        "targets": 1,
                        "width": "15%"
                    },
                    {
                        "title": "keyword",
                        "targets": 2,
                        "width": "15%"
                    },
                    {
                        "title": "Description",
                        "targets": 3,
                        "width": "15%"
                    },
                    {
                        "title": "User",
                        "targets": 4,
                        "width": "10%"
                    },

                ],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'project_name'
                    }, {
                        data: 'keyword'
                    }, {
                        data: 'description'
                    }, {
                        data: 'user'
                    },
                ],
            });

        });
        // showing single data by id end

        // model will be display on add and edit button click
        $(document).on('click', '#create_record', function () {
            tagify.removeAllTags();
            $('#name_form').show();
            $('#sample_form')[0].reset();
            $('#form_result').html('');
            $('.modal-title').text("Add New Task");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#hidestatus').hide();
            $('#document_show').hide();
            $('#taskboard_form_modal').modal('show');
            $('#url').empty();
            $('#url').append('<option> Select Urls </option>');
            $('#keyword-select').empty();
            $('#keyword-select').append('<option> Select keyword </option>');

        });
        // model will be close

        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();

            //passing project id in hidden for submitting projec_id into databse
            var project_id = $("#project_name option:selected").attr("name");
            $('#project_id').val(project_id);
         
            // data add working on submit button
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{url('api/v1/j/taskboards/store') }}/" + project_name,
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
                        console.log(data.errors);
                        // adding alert messages for success and exist data validation open
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#taskboard_form_modal').modal('hide');
                                // $('#TaskboardTable').DataTable().ajax.reload();
                                location.reload(true);
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                        // adding alert messages for success and exist data validation close


                    },
                    error: function (data) {
                        console.log('In Error me aa gaya hai');
                        console.log('Error:', data);
                    }
                })
            }

            // update button wotking for updata data
            if ($('#action').val() == "Update") {
                console.log('update button pe click ho rha hai');
                $.ajax({
                    url: "{{url('/api/v1/j/taskboards/update/') }}",
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
                        //setting 2 second in modal to stay
                        setTimeout(function () {
                            $('#taskboard_form_modal').modal('hide');
                            // $('#TaskboardTable').DataTable().ajax.reload();
                            location.reload(true);
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
            $('#document_show').html('');
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('/api/v1/j/taskboards/edit/')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);

                    $.each(JSON.parse(html.data.keyword), function (key, value) {

                        tagify.addTags([value.value])
                        });
                       // selector on keyword open
                $.ajax({
                    "type": "GET",
                    "url": "{{url('api/v1/j/keyword/getKeywordData')}}/" + html.data.weburl_id,
                    "data": {},
                    "headers": {
                        "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                    },
                    success: function (response) {
                        $('#keyword-select').empty();
                        // $('#keyword-select').append('<option> Select keywords1 </option>');
                        console.log(response);
                        $.each(JSON.parse(response[0].keyword), function (key, value) {
                            $('#keyword-select').append('<option name="' + response[
                                    0].id +
                                '" value="' + value.value + '">' + value
                                .value + '</option>');

                        });
                    },
                    error: function (errorResponse) {
                        console.log(errorResponse);
                    }
                });
            // selector on keyword close
                    //open
                    $('#url').prepend("<option value='" + html.data.weburl +
                        "' selected='selected'>" + html.data.weburl + "</option>");
                    // close
                //    image will be show on edit event open
                var documnet_files = html.data.document;
                $('#document_show').append('<a target="_blank" href="https://www.wizbrand.com/wz-tasks-board-ms/storage/file/'+documnet_files+'">'+documnet_files+'</a>');

                // taking file name open
                $('#file_document_show').val(documnet_files);
                // taking file name close

                //    image will be show on edit event close
                    $('#user_hidden_id').val(html.data.id);

                    $('#project_name').val(html.data.project_name);
                    // $('#document_file').val(documnet_files);
                    $('#severity').val(html.data.severity);
                    $('#textarea').val(html.data.description);
                    $('#user').val(html.data.user);
                    $('#weburl').val(html.data.weburl);
                    $('#tasktype').val(html.data.tasktype);
                    $('#taskdeadline').val(html.data.taskdeadline);
                    $('#status').val(html.data.status);
                    $('#title').val(html.data.title);
                    $('#hidestatus').show();
                    $('.modal-title').text("Edit Task Borad");
                    $('.modal-title_delete').text("Task Borad Delete");
                    $('#action_button').val("Update");
                    $('#action').val("Update");
                    $('#taskboard_form_modal').modal('show');
                    $('#hidden_id').val(id);
                }
            })
        });

        //:::::::::::::::::::::::::::::::: task details open  :::::::::::::::::::::::::::;
        $(document).on('click', '.details_task_view', function () {
            console.log('task view details open');
            var id = $(this).attr('id');
            $('#document_show_image').html('');
            console.log('task view details open' + id);
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('/api/v1/j/taskboards/edit')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    var title = html.data.project_name;
                    var keyword_title = '';
                    $.each(JSON.parse(html.data.keyword), function (key, value) {
                        // console.log(key)
                        keyword_title += '<span class="custom-tag">' + value.value +
                            '</span>';
                    });
                    var severity_title = html.data.severity;
                    var description_title = html.data.description;
                    var user_title = html.data.user;
                    var weburl_title = html.data.weburl;
                    var tasktype_title = html.data.tasktype;
                    var taskdeadline_title = html.data.taskdeadline;
                    var status_title = html.data.status;
                    var task_title = html.data.title;
                    var url_title = html.data.url;
                    // image will be show on view modal open
                    var documnet_files_image = html.data.document;
                    // $('#document_show_image').append('<img width="250px;" height="150px;" src="http://wz-tasks-board-ms/storage/file/'+documnet_files_image+'">');

                    // var documnet_files_image = html.data.document;
                    $('#document_show_image').append('<a target="_blank" href="https://www.wizbrand.com/wz-tasks-board-ms/storage/file/'+documnet_files_image+'">'+documnet_files_image+'</a>');
                    // image will be show on view modal clsoe

                    $(".cardop").show();
                    $('#project_name_title').html(title);
                    $('#keyword_name').html(keyword_title);
                    $('#severity_name').html(severity_title);
                    $('#description_name').html(description_title);
                    $('#user_name').html(user_title);
                    $('#weburl_name').html(weburl_title);
                    $('#tasktype_name').html(tasktype_title);
                    $('#taskdeadline_name').html(taskdeadline_title);
                    $('#status_name').html(status_title);
                    $('#title_name').html(task_title);
                    $('#url_name').html(url_title);
                    $('#taskboardviewdetails').modal('show');


                }
            })
        });
        // ::::::::::::::::::::::::::: task details close ::::::::::::::::::::::::::::::::::::::::::::::

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
                url: "{{url('api/v1/j/taskboards/destroy')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                beforeSend: function () {
                    $('#ok_button').text('Deleting..');
                },
                success: function (data) {
                    $('#ok_button').text('OK');
                    $('#confirmModal').modal('hide');
                    $('#TaskboardTable').DataTable().ajax.reload()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
        // =======================   count descript open  ==========================
        var maxLength = 120;
        $('textarea').keyup(function () {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
        // ========================= count discription close  ================================

        // keyword display on view details open
        var input = document.querySelector('input[name=keyword]'),
            tagify = new Tagify(input);
        //(input).tagify({duplicates :false});
        $('#keyword-select').on('change', function () {
            tagify.addTags([this.value])
        });

        $('input[name=keyword]').keypress(function (e) {
            e.preventDefault();
        });
    });
        $(window).on('load', function () {
    setTimeout(() => {
        $('.tagify__input').remove();
    }, 2000);
    });



    // keyword display on view details open

</script>


@endpush
