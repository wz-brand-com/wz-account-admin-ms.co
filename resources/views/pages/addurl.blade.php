@extends('layouts.backend.mainlayout')
@section('title','Account Admin')

@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());
</script>
<style>li{list-style:none;}

.tabs {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 20px;
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
<div class="container-fluid">
    <br><br>
<div class="card">
    <div class="card-body">
    <div class="tabs">
        <div class="tab-button-outer">
          <ul id="tab-button">
            <li><a href="#tab01">Add New Project</a></li>
            <li><a href="#tab02">Add New URL</a></li>
          </ul>
        </div>
        <div class="tab-select-outer">
          <select id="tab-select">
            <option value="#tab01">Add New Project</option>
            <option value="#tab02">Tab 2</option>
          </select>
        </div>
        <div id="tab01" class="tab-contents">
            <br>
            <a href="{{route('projectwithslug',[ 'org_slug' => $org_slug])}}">
                <button type="button" name="create_record" id=""
                class="btn btn-primary ">Add New Project</button></a>
        </div>
        <div id="tab02" class="tab-contents">
            <br>
            <button type="button" name="create_record" id="create_record"
            class="btn btn-primary ">Add New Url</button>
            <table id="urlTable" class="table">
                <thead>
                    <tr>
                        <th data-column_name="id" width="" style="width: 345px">id</th>
                        <th data-column_name="url" width="">Web URLs</th>
                        <th data-column_name="project_name" width="">Project</th>
                        <th width="">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <!-- {{-- modal start here  --}} -->
            <div id="formModall" class="modal fade" role="dialog">
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
                            <span id="form_result" aria-hidden="true"></span>
                            <!-- Error Message after form not submit -->
                            <form method="post" id="sample_form" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" id="name_form">
                                    <label class="control-label col-md-4">URL </label>
                                    <div class="col-md-12">
                                        <input type="text" name="url" id="url" class="form-control" autocomplete="off" />
                                        <!-- <span id="username" class="text-danger"></span> -->
                                    </div>
                                </div>
                                <div class="form-group" id="name_form">
                                    <label class="control-label col-md-4">Project Name</label>
                                    <div class="col-md-12">
                                        <select name="project_name" id="project_name" class="w-100 p-2">
                                        <option value="" class="form-controll text-dark">Select Project </option>
                                                @foreach(App\Http\Controllers\Api\ProjectApiController::getvalueall($slug_id) as $project)
                                            <option name="{{$project['project_name']}}" value="{{$project['id']}}">{{$project['project_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"id="admin_id" /> 
                                <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"id="admin_email" /> 
                                <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="auth_id" /> 
                                <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />  
                                <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                <input type="hidden" value="null" name="user_id" id="user_id">
                                <input type="hidden" value="null" name="user_email" id="user_email">
                                <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname"> <br>
                                <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id" id="u_org_organization_id">
                                <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                        </div>
                        <!-- <br /> -->
                        <div class="form-group text-center">
                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="addurl_hidden_id" id="addurl_hidden_id" />
                            <input type="submit" name="action_button" id="action_button"
                                class="btn btn-warning float-center" value="Add" />
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
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title" style="color:red;">Message </h3>
                                        <p class="card-text">The action can not be completed because the <span class="text-primary" name="url_name_display" id="url_name_display"> </span> Url
                                        is working in this <span class="text-primary">Rank & Rating of Page Ranking</span> program getting error message,</p>
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
                            <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove this URL?</h4>
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


<!-- Container fluid  -->
<!-- ============================================================== -->

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
    var slug_id = $('#u_org_organization_id').val();
    console.log('organization id is calling here '+slug_id);
    var dt = $('#urlTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/addurl/index')}}/"+slug_id,
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
            {"title": "URL","targets": 1,"width": "50%"},
            {"title": "Project Name","targets": 2,"width": "20%"},
            {"title": "Action","targets": 3,"width": "20%"},
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
                render: function(data, type, row) {
                    return '<div class="row"><div class="col-4"><button type="button"  id="' +
                        data['id'] +
                        '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-2"><button type="button" id="' +
                        data['id'] + '" name="' + data['url'] +  '"  class="btn btn-danger  delete"><i class="mdi mdi-delete"></i></button></div> </div>'
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
        $('.modal-title').text("Add New URL");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#formModall').modal('show');
    });
    // model will be close

    //  form working start
    $('#sample_form').on('submit', function(event) {
        event.preventDefault();
        // $("#selectedProject").attr("project_id");
        var project_name = $("#project_name option:selected").attr("name");
        // data add working on submit button
        if ($('#action').val() == 'Add') {
            console.log('add button click ho rha ha');
            $.ajax({
                url: "{{url('api/v1/j/addurl/store') }}/"+project_name,
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
                success: function(data) {
                    console.log('abhi ham success function ke ander aaye hai');
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModall').modal('hide');
                                $('#urlTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
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
                success: function(data) {
                    console.log('update ho gaya successfully');
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModall').modal('hide');
                                $('#urlTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                },
                // message alert close
                error: function(data) {
                    console.log('Error:', data);
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
            url: "{{url('/api/v1/j/addurl/edit/')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html);
                $('#url').val(html.data.url);
                $('#project_name').val(html.data.project_name);
                $('#project_name').val(html.data.project_id);
                $('#admin_id').val(html.data.admin_id);
                $('#admin_email').val(html.data.admin_email);
                $('.modal-title').text("Edit URL");
                $('.modal-title_delete').text("URL Delete");
                $('#action_button').val("Update");
                $('#action').val("Update");
                $('#formModall').modal('show');
                $('#addurl_hidden_id').val(id);
            }
        })
    });


    var id;
    $(document).on('click', '.delete', function() {
        id = $(this).attr('id');
        url_name = $(this).attr('name');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function() {
        console.log('working delete button');
        $('#name_form').show();
        $('#form_result').html('');
        $.ajax({
            type: "get",
            data: {},
            url: "{{url('api/v1/j/addurl/destroy')}}/" + id,
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
                                $('#urlTable').DataTable().ajax.reload();
                                // alert('Data Deleted Successfully'+data.success);
                            }, 2000);
                        } else {
                            $('#confirmModal').modal('hide');
                            $('#ok_button').text('OK');
                            $('#reextendmodel').modal('show');
                            console.log('user name aa raha hai'.url_name);
                            $('#url_name_display').html(url_name);
                            $('#form_result').html("");
                        }
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })
    });
});

// tabpan start here 

$(function() {
  var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabContents = $('.tab-contents'),
      activeClass = 'is-active';

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();

  $tabButtonItem.find('a').on('click', function(e) {
    var target = $(this).attr('href');

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on('change', function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop('selectedIndex');

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });
});

</script>
@endpush
