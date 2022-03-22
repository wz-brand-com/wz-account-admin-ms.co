@extends('layouts.backend.mainlayout')

@section('title','Interval Task')

@section('content')
<input type="hidden" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());
</script>
<style>li{list-style:none;}</style>
<!-- hidden Auth email and id for calling in json index -->
<input type="hidden" value="{{ Auth::user()->id }}" name="admin_id" id="AAuth_id" />
<input type="hidden" value="{{ Auth::user()->email }}" name="admin_email" id="auth_email" />
		<!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        {{-- <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Interval Task</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Task Managers</a></li>
                    <li class="breadcrumb-item active">Interval Task</li>
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
                                
	                        <div class="button-group">
	                            <button type="button" class="btn waves-effect waves-light btn-primary" name="create_record" id="create_record">Add New Task</button>
	                        </div>
							
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#hourly" id="houlry_task" role="tab">Hourly
                                	</a> 
                                </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#daily" id="daily_task" role="tab">
                                	Daily</a> 
                                </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#weekly" id="weekly_task" role="tab">
                                	Weekly</a> 
                                </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#biweekly" id="biweekly_task" role="tab">
                                	Bi Weekly</a> 
                                </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#monthly" id="monthly_task" role="tab">
                                	Monthly</a> 
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div class="tab-pane active" id="hourly" role="tabpanel">
                                    
                                    <div class="table-responsive m-t-10">
	                                    <table id="IntervalTable" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
	                                        <thead>

	                                        </thead>

	                                        <tbody>

	                                        </tbody>
	                                    </table>
                            		</div>
									
                                </div>

                                <!--===================== {{-- daily regular task ==========================--}} -->
                                <div class="tab-pane" id="daily" role="tabpanel">
									<div class="table-responsive m-t-10">
	                                    <table id="IntDailyTable" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
	                                       
	                                        <tbody>

	                                        </tbody>
	                                    </table>
                            		</div>
                                </div>
								<!-- ================ {{-- daily regular task end --}} =========================-->

                                <!--===================-- Weekly regular task --================================-->
                                <div class="tab-pane" id="weekly" role="tabpanel">
                                	<div class="table-responsive m-t-10">
	                                    <table id="WeeklyTable" class="table nowrap table-hover table-striped table-bordered" cellspacing="0" width="100%">
	                                        <thead>

	                                        </thead>

	                                        <tbody>

	                                        </tbody>
	                                    </table>
                            		</div>
                            	</div>

                                <!-- =========================== {{-- Weekly regular task end --}} ======================-->

                                <!--============================ {{--BiWeekly Regular Task start --}} =====================-->
                                <div class="tab-pane" id="biweekly" role="tabpanel">
                                	<div class="table-responsive m-t-10">
	                                    <table id="Bi" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
	                                        <thead>

	                                        </thead>

	                                        <tbody>
	                                        	
	                                        </tbody>
	                                    </table>
                            		</div>
                            	</div>
                                <!--============================ {{--BiWeekly Regular Task end --}} =========================-->

                                <!--============================ {{--Monthly Regular Task start --}} ==========================-->
                                <div class="tab-pane" id="monthly" role="tabpanel">
									<div class="table-responsive m-t-10">
	                                    <table id="MonthlyTable" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
	                                        <thead>

	                                        </thead>

	                                        <tbody>
	                                        	
	                                        </tbody>
	                                    </table>
                            		</div>
                                </div>
                                <!--============================ {{--Monthly Regular Task end --}} ============================-->

                            </div>
                        
                            <!-- model for submitting the data -->
                            <div id="formModal" class="modal fade" role="dialog">
                        
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
                                                        <label class="control-label">Name [Use CTRL + Click to Multi Select]</label>
                                                        <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose" name="user_name[]" id="user_name">
                                                        
                                                        <option value="">Select Multiple User</option>
                                                        </option> 
                                                      
                                                        <option value="{{Auth::user()->email}}">{{Auth::user()->email}}</option> 
                                                            @foreach($int_t_user_manager_assign as $tsk_manger) 
                                                                @if(Auth::user()->email !== $tsk_manger['u_org_user_email'])  
                                                                    <option  value="{{$tsk_manger['u_org_user_email']}}" name="{{$tsk_manger['u_org_user_id']}}" >{{$tsk_manger['u_org_user_email']}}</option>
                                                                @endif 
                                                             @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Task Frequency</label>
                                                        <select class="form-control custom-select"  name="task_freq" id ="task_freq">
                                                            <option>Select Task Freq</option>
                                                            <option value="hourly">Hourly</option>
                                                            <option value="daily">Daily</option>
                                                            <option value="weekly">Weekly</option>
                                                            <option value="biweekly">Bi Weekly</option>
                                                            <option value="monthly">Monthly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                              
                                                <div class="col-md-6"> 
                                                    <div class="form-group" id="name_form">
                                                        <label class="control-label">Task Details</label>
                                                        <textarea name="task_details" id="task_details" cols="30" rows="3" placeholder="Describe Here" class="form-control no-resize"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="admin_id"
                                                id="admin_id" />
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="admin_email"
                                                id="admin_email" />
                                                
                                               <!-- for account admin below value fo id and email will be null but when manager or user will store it it will get value by auth -->
                                            <input type="hidden" value="NULL" name="user_id" id="user_id">
                                            <input type="hidden" value="NULL" name="user_email" id="user_email">
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{$slug_id}}" name="u_org_organization_id" id="u_org_organization_id">
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_role_id" id="u_org_role_id">
                                             
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
                    <!-- delete confirmation popup start-->
                        <div id="confirmModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <br>
                                        <span class="modal-title_delete">Confirmation</span>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove this Interval Task</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" name="ok_button" id="ok_button"
                                            class="btn btn-danger">OK</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- delete confirmation popup start-->

                    {{-- model close --}}
                                
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
// hourly value start
admin_id = $('#AAuth_id').val();
console.log('admin id '+admin_id);
    id = $('#u_org_organization_id').val();
    console.log(id);
    // on reload default get hourly data open
 
        task_hourly = 'hourly';
    console.log('hourly ka value aa rha hai'+task_hourly);
    var dt = $('#IntervalTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/interval')}}/"+id+"/"+admin_id+"/"+task_hourly,
            "dataSrc": 'data',
            "type": "GET",
            "data": 'data', 
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
            {"title": "ID","targets": 0,"width": "10%"},
            {"title": "User Name","targets": 1,"width": "15%"},
            {"title": "Task Freq","targets": 2,"width": "15%"},
            {"title": "Task Title","targets": 3,"width": "15%"},
            {"title": "Task Details","targets": 4,"width": "15%"},
            {"title": "Action","targets": 5,"width": "15%"},
             ],
        columns: [{
                data: 'id'
            },
            {data: 'user_name'},
            {data:'task_freq'},
            {data: 'task_title'},
            {data: 'task_details'}, 
            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="row"><div class="col-6"><button type="button"  id="' +
                        data['id'] +
                        '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div> </div>'
                },
            },
        ],


    });

    // daily task open
    task_daily = 'daily';
    console.log('task aya ki nbai'+task_daily);
    var daily = $('#IntDailyTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/interval')}}/"+id+"/"+admin_id+"/"+task_daily,
            "dataSrc": 'data',
            "type": "GET",
            "data": 'data', 
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
            {"title": "ID","targets": 0,"width": "10%"},
            {"title": "User Name","targets": 1,"width": "15%"},
            {"title": "Task Freq","targets": 2,"width": "15%"},
            {"title": "Task Title","targets": 3,"width": "15%"},
            {"title": "Task Details","targets": 4,"width": "15%"},
            {"title": "Action","targets": 5,"width": "15%"},
             ],
        columns: [{
                data: 'id'
            },
            {data: 'user_name'},
            {data: 'task_freq'},
            {data: 'task_title'},
            {data: 'task_details'}, 
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
    // daily task close
    
    // weekly open
    task_weekly = 'weekly';
    var daily = $('#WeeklyTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/interval')}}/"+id+"/"+admin_id+"/"+task_weekly,
            "dataSrc": 'data',
            "type": "GET",
            "data": 'data', 
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
            {"title": "ID","targets": 0,"width": "10%"},
            {"title": "User Name","targets": 1,"width": "15%"},
            {"title": "Task Freq","targets": 2,"width": "15%"},
            {"title": "Task Title","targets": 3,"width": "15%"},
            {"title": "Task Details","targets": 4,"width": "15%"},
            {"title": "Action","targets": 5,"width": "15%"},
             ],
        columns: [{
                data: 'id'
            },
            {data: 'user_name'},
            {data: 'task_freq'},
            {data: 'task_title'},
            {data: 'task_details'}, 
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
    // weekly close

        //biweekly open 
        task_biweekly = 'biweekly';
    var daily = $('#Bi').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/interval')}}/"+id+"/"+admin_id+"/"+task_biweekly,
            "dataSrc": 'data',
            "type": "GET",
            "data": 'data', 
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
            {"title": "ID","targets": 0,"width": "10%"},
            {"title": "User Name","targets": 1,"width": "15%"},
            {"title": "Task Freq","targets": 2,"width": "15%"},
            {"title": "Task Title","targets": 3,"width": "15%"},
            {"title": "Task Details","targets": 4,"width": "15%"},
            {"title": "Action","targets": 5,"width": "15%"},
             ],
        columns: [{
                data: 'id'
            },
            {data: 'user_name'},
            {data: 'task_freq'},
            {data: 'task_title'},
            {data: 'task_details'}, 
            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="row"><div class="col-6"><button type="button"  id="' +
                        data['id'] +
                        '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div> </div>'
                },
            },
        ],
    });
        //biweekly close 

        // monthly open
        task_monthly = 'monthly';
    var daily = $('#MonthlyTable').DataTable({
        "ajax": {
            "paging": true,
            "scrollX": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "url": "{{url('api/v1/j/interval')}}/"+id+"/"+admin_id+"/"+task_monthly,
            "dataSrc": 'data',
            "type": "GET",
            "data": 'data', 
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
            {"title": "ID","targets": 0,"width": "10%"},
            {"title": "User Name","targets": 1,"width": "15%"},
            {"title": "Task Freq","targets": 2,"width": "15%"},
            {"title": "Task Title","targets": 3,"width": "15%"},
            {"title": "Task Details","targets": 4,"width": "15%"},
            {"title": "Action","targets": 5,"width": "15%"},
             ],
        columns: [{
                data: 'id'
            },
            {data: 'user_name'},
            {data: 'task_freq'},
            {data: 'task_title'},
            {data: 'task_details'}, 
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
        // monthly close

    // on reload default get hourly data close

    // hourly function open
    $("#houlry_task").click(function(){
        $('#IntervalTable').DataTable().ajax.reload();
        
    });
    // hourly value end
    $("#daily_task").click(function(){
    // daily interval task get data
   
    $('#IntDailyTable').DataTable().ajax.reload();
    
    });
    // daily interval task end

    // weekly start interval task
    $("#weekly_task").click(function(){
        $('#WeeklyTable').DataTable().ajax.reload();
    });
    // weekly start interval end

    // biweekly start
    $("#biweekly_task").click(function(){
        $('#Bi').DataTable().ajax.reload();
    });
    // biweekly end

    // Monthly start interval task start
    $("#monthly_task").click(function(){
        
        $('#MonthlyTable').DataTable().ajax.reload();
    });
    // Monthly start interval task end

    // model will be display on add and edit button click
    $('#create_record').click(function() {
        // alert('click on create record form');
        $('#name_form').show();
        $('#sample_form')[0].reset();
        $('#form_result').html('');
        $('.modal-title').text("Add New Interval Task");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#formModal').modal('show');
    });
    // model will be close

    //  form working start
    $('#sample_form').on('submit', function(event) {
        event.preventDefault();
    
        // data add working on submit button
        if ($('#action').val() == 'Add') {
            console.log('add button click ho rha ha');
            $.ajax({
                url: "{{route('interval.store') }}",
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
                   
                    var html = '';
                    if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +'</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#PhoneTable,#IntervalTable,#IntDailyTable,#WeeklyTable,#Bi,#MonthlyTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message + '</div>';
                            $('#form_result').html(html);
                        }
                       
                },
                error: function(data) {
                    console.log('Error:', data);
                    console.log('submit function kamm nahi kr rha hai');
                }
            });
        }

        // update button wotking for updata data
        if ($('#action').val() == "Update") {
            console.log('update button pe click ho rha hai');
            $.ajax({
                url: "{{url('/api/v1/j/interval/update/') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function(data) {
                   
                   var html = '';
                   if (data.success) {
                           html = '<div class="alert alert-success">' + data.message +'</div>';
                           $('#form_result').html(html);
                           setTimeout(function () {
                               $('#formModal').modal('hide');
                               $('#PhoneTable,#IntervalTable,#IntDailyTable,#WeeklyTable,#Bi,#MonthlyTable').DataTable().ajax.reload();
                           }, 2000);
                       } else {
                           html = '<div class="alert alert-danger">' + data.message + '</div>';
                           $('#form_result').html(html);
                       }
                      
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
            url: "{{url('/api/v1/j/interval/edit')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            success: function(html) {
                console.log('value aa gaya edit ke page pe');
                console.log(html);         
                $.each(html, function(i, user) {
                    $('#user_name').prepend("<option value='" + user.user_name + "' selected='selected'>" + user.user_name + "</option>");
                });

                $('#task_freq').val(html.data.task_freq);            
                $('#task_details').val(html.data.task_details);                      
                $('.modal-title').text("Edit Interval Task");
                $('.modal-title_delete').text("Interval Task Delete");
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
            url: "{{url('api/v1/j/interval/destroy')}}/" + id,
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
            },
            beforeSend: function() {
                $('#ok_button').text('Deleting..');
            },
            success: function(data) {
                $('#ok_button').text('OK');
                $('#confirmModal').modal('hide');
                $('#IntervalTable,#IntDailyTable,#WeeklyTable,#Bi,#MonthlyTable').DataTable().ajax.reload();
            },
            error: function(data) {
                console.log('Error:', data);
            }
        })
    });
});
</script>
@endpush