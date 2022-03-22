@extends('layouts.backend.mainlayout')
@section('title','wizard')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .star_mark {
    color: red !important;
    font-weight: bold !important;
}


/* amit button css start here  */
.button {
    display: inline-block;
    border-radius: 6px;
    background-color: #7a00ff;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 18px;
    padding: 10px;
    width: 140px;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5px;
}

.button span {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
}

.button span:after {
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -15px;
    transition: 0.5s;
}

.button:hover span {
    padding-right: 12px;
}

.button:hover span:after {
    opacity: 1;
    right: 0;
}

.outli {
outline-width: 1px;
outline-style: solid;
outline-color: #C9D6FF;
}

/* wizard navigation css start here  */
    .nav-item a{
        color: red;
        font-size: 15px;
        margin: 0;
        padding: 13px 17px;
        position: relative;
    }
/* wizard navigation css end here  */
</style>
<!-- sending token open -->
<input type="hidden" name="token" id="a_u_a_b_t" value="{!! $a_user_api_bearer_token !!}">
<script type="text/javascript">
    localStorage.setItem('a_u_a_b_t', $('#a_u_a_b_t').val());

</script>
<!-- sending token close -->

<div class="row mb-5 mt-1">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 ml-auto">
        <div class="row align-items-center">
            <div class="col-xl-12 col-12 mb-4 mb-xl-0">
                <div class="row">
                    <div class="col-md-8">
                        <!-- {{-- Wizard button start here  --}} -->
                        <button class="button ml-3 mt-4" name="create_project_wizard" id="create_project_wizard"
                            style="vertical-align:middle"><span>Continue to Wizard </span>
                        </button>
                        <!-- {{-- Wizard button end here  --}} -->
                    </div>
                    <br>
                    <br>
                </div>


                <!--  table start here  - -->
                <div class="card-body">
                  <div class="form-group" id="name_form">
                      <div class="col-md-12">
                          <!-- testing card open -->
                          <div class="card mt-2">
                            <div class="card-body shadow outli">
                                <table id="wizardTable" class="table" data-order='[[ 0, "desc" ]]'>
                                  <thead>
                                      <tr>
                                          <th data-column_name="id" width="" style="width:200px">id</th>
                                          <th data-column_name="url" width="">Web URLs</th>
                                          <th data-column_name="project_name" width="">Project</th>
                                          <th data-column_name="count_null_value" width="">Skip Input</th>
                                          <th width="">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                            </div>
                          </div>
                      </div>
                  </div>
                 </div>
                <!-- -  table start here  ---->

                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="users.id" />
                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
            </div>
        </div>
    </div>
</div>
<div id="create_project_wizard_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Wizard</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="trainer_class_form_result" aria-hidden="true"></span>
                <div class="row">
                    <section class="col-12">
                        <ul class="nav nav-tabs flex-nowrap" role="tablist">
                            <li role="presentation" class="nav-item">
                                <a href="#step1" class="nav-link active" data-toggle="tab" aria-controls="step1"
                                    role="tab" id="stepA" title="Step 1"> 1 </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step2" class="nav-link disabled" data-toggle="tab" aria-controls="step2"
                                    role="tab" id="stepB" title="Step 2"> 2 </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step3" class="nav-link disabled" data-toggle="tab" aria-controls="step3"
                                    role="tab" id="stepC" title="Step 3"> 3 </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step4" class="nav-link disabled" data-toggle="tab" aria-controls="step4"
                                    role="tab" id="stepD" title="Step 4"> 4 </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step5" class="nav-link disabled" data-toggle="tab" aria-controls="step5"
                                    role="tab" id="stepE" title="Step 5"> 5 </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step6" class="nav-link disabled" data-toggle="tab" aria-controls="step6"
                                    role="tab" id="stepF" title="Step 6"> 6 </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step7" class="nav-link disabled" data-toggle="tab" aria-controls="step7"
                                    role="tab" id="stepG" title="Step 7"> 7 </a>
                            </li>

                            <li role="presentation" class="nav-item">
                                <a href="#step8" class="nav-link disabled" data-toggle="tab" aria-controls="step8"
                                    role="tab" id="stepH" title="Step 8"> 8 </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step9" class="nav-link disabled" data-toggle="tab" aria-controls="step9"
                                    role="tab" id="stepI" title="Step 9"> 9 </a>
                            </li>

                            <li role="presentation" class="nav-item">
                                <a href="#complete" class="nav-link disabled" data-toggle="tab" aria-controls="complete"
                                    role="tab" id="stepJ" title="Complete"> 10 </a>
                            </li>
                        </ul>
                        <form id="my_class_form" role="form">
                            <!-- ==========================  Step-1 start ======================================= -->
                            <div class="tab-content py-2">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1>Social Media Handles Sites</h1>
                                            <div class="form-group" id="project_form">
                                                <label class="control-label">Project Name: <span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                     <input type="text" class="form-control" value="" name="project_name" id="project_name">
                                                     <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" name="wizard_project_id">
                                                </div>
                                                <span
                                                    style="color:red;font-size:12px; font-weight:bold; font-weight:bold;"
                                                    id="errNm1">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group" id="facebook_form">
                                              <label class="control-label">Facebook url <span class="star_mark">*</span>: </label>
                                              <div class="col-md-12">
                                                <!-- button group with skip open -->
                                              <div class="input-group mb-3">
                                              <input type="text" class="form-control" name="facebook" id="facebook_url_id" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                  <button class="btn btn-outline-warning" id="skip_facebook_id" type="button">skip</button>
                                                </div>
                                              </div>
                                              <!-- button group with skip close -->
                                            </div>
                                              <span style="color:red;font-size:12px; font-weight:bold;" id="class_err"></span>
                                              <span style="color:orange;font-size:12px; font-weight:bold;" id="fb_url_error"></span>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group" id="linkedIn_form">
                                                <label class="control-label">linkedIn url <span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                    <!-- button group with skip open -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="linkedIn"
                                                            id="linkedIn_url_id">

                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-warning"
                                                                id="skip_linkedIn_id" type="button">skip</button>
                                                        </div>
                                                    </div>
                                                    <!-- button group with skip close -->
                                                </div>
                                                <span style="color:red;font-size:12px; font-weight:bold;"
                                                    id="errNm_linkedIn"></span>
                                                <span style="color:orange;font-size:12px; font-weight:bold;"
                                                    id="linkedIn_url_validate_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group" id="twitter_url_id_form">
                                                <label class="control-label">Twitter url <span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                    <!-- button group with skip open -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="twitter"
                                                            id="twitter_url_id">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-warning" id="skip_twitter_id"
                                                                type="button">skip</button>
                                                        </div>
                                                    </div>
                                                    <!-- button group with skip close -->
                                                </div>
                                                <span style="color:red;font-size:12px; font-weight:bold;"
                                                    id="errNm3"></span>
                                                <span style="color:orange;font-size:12px; font-weight:bold;"
                                                    id="twitter_url_validate_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group" id="instagram_url_id_form">
                                                <label class="control-label">Instagram url <span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                    <!-- button group with skip open -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="instagram"
                                                            id="instagram_url_id">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-warning"
                                                                id="skip_instagram_id" type="button">skip</button>
                                                        </div>
                                                    </div>
                                                    <!-- button group with skip close -->
                                                </div>
                                                <span style="color:red;font-size:12px; font-weight:bold;"
                                                    id="errNm4"></span>
                                                <span style="color:orange;font-size:12px; font-weight:bold;"
                                                    id="instagram_url_validate_error"></span>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group" id="youtube_url_id_form">
                                                <label class="control-label">Youtube url <span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                    <!-- button group with skip open -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="youtube"
                                                            id="youtube_url_id">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-warning" id="skip_youtube_id"
                                                                type="button">skip</button>
                                                        </div>
                                                    </div>
                                                    <!-- button group with skip close -->
                                                </div>
                                                <span style="color:red;font-size:12px; font-weight:bold;"
                                                    id="errNm5"></span>
                                                <span style="color:orange;font-size:12px; font-weight:bold;"
                                                    id="youtube_url_validate_error"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="button" class="btn btn-primary next-step1 float-right">Next</button>
                                </div>
                                <!-- ==========================  Step-1 end ======================================= -->

                                <!-- ==========================  Step-2 start ======================================= -->
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group" id="pinterest_url_id_form">
                                                <h1>Social Bookmarking Sites</h1>
                                                <label class="control-label">Pinterest profile link <span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                    <!-- button group with skip open -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="pinterest"
                                                            id="pinterest_url_id">

                                                        <!-- <div class="input-group-append">
                            <button class="btn btn-outline-warning" id="skip_pinterest_id" type="button">skip</button>
                          </div> -->
                                                    </div>
                                                    <!-- button group with skip close -->
                                                    <span style="color:red; font-size:12px; font-weight:bold;"
                                                        id="errNm6"></span>
                                                </div>

                                                <div class="form-group mt-3" id="reddit_form">
                                                    <label class="control-label" id="lbl_txt">Reddit profile
                                                        link</label>
                                                    <div class="col-md-12">
                                                        <!-- button group with skip open -->
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="reddit"
                                                                id="reddit_url_id">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-warning"
                                                                    id="skip_reddit_id" type="button">skip</button>
                                                            </div>
                                                        </div>
                                                        <!-- button group with skip close -->

                                                    </div>
                                                    <span style="color:red; font-size:12px; font-weight:bold;"
                                                        id="errRediit_url"></span>
                                                    <span style="color:orange; font-size:12px; font-weight:bold;"
                                                        id="reddit_url_validate_error"></span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group" id="tumblr_url_id_form">
                                                <label class="control-label">Tumblr profile link <span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                    <!-- button group with skip open -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="tumblr"
                                                            id="tumblr_url_id">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-warning" id="skip_tumblr_id"
                                                                type="button">skip</button>
                                                        </div>
                                                    </div>
                                                    <!-- button group with skip close -->
                                                </div>
                                                <span style="color:red;font-size:12px; font-weight:bold;"
                                                    id="errNm7"></span>
                                                <span style="color:orange;font-size:12px; font-weight:bold;"
                                                    id="tumblr_url_validate_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group" id="plurk_url_id_form">
                                                <label class="control-label">Plurk profile link<span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                    <!-- button group with skip open -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="plurk"
                                                            id="plurk_url_id">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-warning" id="skip_plurk_id"
                                                                type="button">skip</button>
                                                        </div>
                                                    </div>
                                                    <!-- button group with skip close -->
                                                </div>
                                                <span style="color:red;font-size:12px; font-weight:bold;"
                                                    id="errNm8"></span>
                                                <span style="color:orange;font-size:12px; font-weight:bold;"
                                                    id="plurk_url_validate_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group" id="getpocket_url_id_form">
                                                <label class="control-label">Getpocket profile link <span
                                                        class="star_mark">*</span>: </label>
                                                <div class="col-md-12">
                                                    <!-- button group with skip open -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="getpocket"
                                                            id="getpocket_url_id">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-warning"
                                                                id="skip_getpocket_id" type="button">skip</button>
                                                        </div>
                                                    </div>
                                                    <!-- button group with skip close -->
                                                </div>
                                                <span style="color:red;font-size:12px; font-weight:bold;"
                                                    id="errNm9"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button" class="btn btn-primary next-step2">Next</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ==========================  Step-2 end ======================================= -->

                                <!-- ==========================  Step-3 start ======================================= -->
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h1>Blogging Sites</h1>
                                    <div class="form-group" id="wix_blog_form">
                                        <label class="control-label">wix.com <span class="star_mark">*</span>: </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="wix" id="wix_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_wix_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;" id="errNm10"></span>
                                    </div>

                                    <div class="form-group" id="wordpress_blog_form">
                                        <label class="control-label">wordpress.org <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="wordpress"
                                                    id="wordpress_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_wordpress_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_wordpress"></span>
                                    </div>

                                    <div class="form-group" id="weebly_blog_form">
                                        <label class="control-label">Weebly.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="weebly"
                                                    id="weebly_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_weebly_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_weebly"></span>
                                    </div>

                                    <div class="form-group" id="medium_blog_form">
                                        <label class="control-label">medium.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="medium"
                                                    id="medium_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_medium_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_medium"></span>
                                    </div>

                                    <div class="form-group" id="professnow_blog_form">
                                        <label class="control-label">Professnow.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="professnow"
                                                    id="professnow_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_professnow_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_professnow"></span>
                                    </div>

                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-primary btn-info-full next-step3">Next</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ==========================  Step-3 end  ======================================= -->

                                <!-- ==========================  Step-4 start ======================================= -->
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <h1>Article Submission Sites</h1>
                                    <div class="form-group" id="github_blog_form">
                                        <label class="control-label">github.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="github"
                                                    id="github_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_github_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_github"></span>
                                    </div>

                                    <div class="form-group" id="hubpages_blog_form">
                                        <label class="control-label"> hubpages.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="hubpages"
                                                    id="hubpages_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_hubpages_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_hubpages"></span>
                                    </div>

                                    <div class="form-group" id="ehow_blog_form">
                                        <label class="control-label">ehow.com <span class="star_mark">*</span>: </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="ehow" id="ehow_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_ehow_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_ehow_step_4"></span>
                                    </div>

                                    <div class="form-group" id="dzone_blog_form">
                                        <label class="control-label"> dzone.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="dzone" id="dzone_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_dzone_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_dzone"></span>
                                    </div>

                                    <div class="form-group" id="articlesfactory_blog_form">
                                        <label class="control-label">Articlesfactory.com <span
                                                class="star_mark">*</span>: </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="articlesfactory"
                                                    id="articlesfactory_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_articlesfactory_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_articlesfactory"></span>
                                    </div>

                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-primary btn-info-full next-step4">Next</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ==========================  Step-4 end ======================================= -->

                                <!-- ==========================  Step-5 start ======================================= -->
                                <div class="tab-pane" role="tabpanel" id="step5">
                                    <h1>Local Search Engine Sites</h1>
                                    <div class="form-group" id="justdial_blog_form">
                                        <label class="control-label">Justdial.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="justdial"
                                                    id="justdial_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_justdial_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_justdial"></span>
                                    </div>

                                    <div class="form-group" id="sulekha_blog_form">
                                        <label class="control-label"> Sulekha.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="sulekha"
                                                    id="sulekha_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_sulekha_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_sulekha"></span>
                                    </div>

                                    <div class="form-group" id="indiamart_blog_form">
                                        <label class="control-label">IndiaMart.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="indiamart"
                                                    id="indiamart_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_indiamart_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_indiamart"></span>
                                    </div>

                                    <div class="form-group" id="quikr_blog_form">
                                        <label class="control-label"> Quikr <span class="star_mark">*</span>: </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="quikr" id="quikr_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_quikr_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_quikr"></span>
                                    </div>

                                    <div class="form-group" id="click_blog_form">
                                        <label class="control-label">Click.in <span class="star_mark">*</span>: </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="click" id="click_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_click_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_click"></span>
                                    </div>

                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-primary btn-info-full next-step5">Next</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ==========================  Step-5 end ========================================= -->

                                <!-- ==========================  Step-6 start ======================================= -->
                                <div class="tab-pane" role="tabpanel" id="step6">
                                    <h1>Question and Answer Sites</h1>
                                    <div class="form-group" id="quora_blog_form">
                                        <label class="control-label"> Quora.Com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="quora" id="quora_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_quora_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_quora"></span>
                                    </div>

                                    <div class="form-group" id="wikibooks_blog_form">
                                        <label class="control-label"> Wikibooks.Org <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="wikibooks"
                                                    id="wikibooks_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_wikibooks_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_wikibooks"></span>
                                    </div>


                                    <div class="form-group" id="answers_blog_form">
                                        <label class="control-label"> Answers.Com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="answers"
                                                    id="answers_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_answers_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_answers"></span>
                                    </div>

                                    <div class="form-group" id="superuser_blog_form">
                                        <label class="control-label">Superuser.Com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="superuser"
                                                    id="superuser_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_superuser_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_superuser"></span>
                                    </div>

                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-primary btn-info-full next-step6">Next</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ==========================  Step-6 end ========================================= -->

                                <!-- ==========================  Step-7 start ======================================= -->
                                <div class="tab-pane" role="tabpanel" id="step7">
                                    <h1>Video Submission Sites</h1>
                                    <!-- <div class="form-group" id="url_youtube_id_form">
                    <label class="control-label"> YouTube <span class="star_mark">*</span>: </label>
                    <div class="col-md-12">
                      <input type="text" name="youtube" id="url_youtube_id" class="form-control" />
                    </div>
                    <span style="color:red;font-size:12px; font-weight:bold;" id="err_url_youtube"></span>
                  </div> -->

                                    <div class="form-group" id="dailymotion_blog_form">
                                        <label class="control-label"> Dailymotion <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="dailymotion" id="dailymotion_url_id" class="form-control"/> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="dailymotion"
                                                    id="dailymotion_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_dailymotion_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_dailymotion"></span>
                                    </div>

                                    <div class="form-group" id="vimeo_blog_form">
                                        <label class="control-label">vimeo <span class="star_mark">*</span>: </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="vimeo" id="vimeo_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="vimeo" id="vimeo_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_vimeo_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_vimeo"></span>
                                    </div>

                                    <div class="form-group" id="metacafe_blog_form">
                                        <label class="control-label"> Metacafe <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="metacafe" id="metacafe_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="metacafe"
                                                    id="metacafe_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_metacafe_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_metacafe"></span>
                                    </div>

                                    <div class="form-group" id="dropshots_blog_form">
                                        <label class="control-label">DropShots <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="dropshots" id="dropshots_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="dropshots"
                                                    id="dropshots_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_dropshots_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_dropshots"></span>
                                    </div>

                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-primary btn-info-full next-step7">Next</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ==========================  Step-7 end ========================================= -->

                                <!-- ==========================  Step-8 start ======================================= -->
                                <div class="tab-pane" role="tabpanel" id="step8">
                                    <h1>PDF/PPTs submission sites</h1>
                                    <div class="form-group" id="mediafire_form">
                                        <label class="control-label"> mediafire.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="mediafire" id="mediafire_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="mediafire"
                                                    id="mediafire_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_mediafire_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_mediafire"></span>
                                    </div>

                                    <div class="form-group" id="slideshare_form">
                                        <label class="control-label"> slideshare.net <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="slideshare" id="slideshare_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="slideshare"
                                                    id="slideshare_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_slideshare_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_slideshare"></span>
                                    </div>

                                    <div class="form-group" id="scribd_blog_form">
                                        <label class="control-label"> scribd.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="scribd"
                                                    id="scribd_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_scribd_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_scribd"></span>
                                    </div>

                                    <div class="form-group" id="4shared_blog_form">
                                        <label class="control-label"> 4shared.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="four_shared"
                                                    id="4shared_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_four_shared_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_4shared"></span>
                                    </div>

                                    <div class="form-group" id="issuu_form">
                                        <label class="control-label">issuu.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="issuu" id="issuu_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_issuu_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_issuu"></span>
                                    </div>

                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-primary btn-info-full next-step8">Next</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ==========================  Step-8 end ========================================= -->

                                <!-- ==========================  Step-9 start ======================================= -->
                                <div class="tab-pane" role="tabpanel" id="step9">
                                    <h1>Directory Submission Sites</h1>
                                    <div class="form-group" id="freeadstime_form">
                                        <label class="control-label"> freeadstime.org <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="freeadstime" id="freeadstime_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="freeadstime"
                                                    id="freeadstime_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_freeadstime_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_freeadstime"></span>
                                    </div>

                                    <div class="form-group" id="superadpost_form">
                                        <label class="control-label"> superadpost.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="superadpost" id="superadpost_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="superadpost"
                                                    id="superadpost_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_superadpost_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_superadpost"></span>
                                    </div>

                                    <div class="form-group" id="findermaster_blog_form">
                                        <label class="control-label"> findermaster.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="findermaster" id="findermaster_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="findermaster"
                                                    id="findermaster_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_findermaster_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_findermaster"></span>
                                    </div>

                                    <div class="form-group" id="mastermoz_blog_form">
                                        <label class="control-label"> mastermoz.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="mastermoz" id="mastermoz_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="mastermoz"
                                                    id="mastermoz_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_mastermoz_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_mastermoz"></span>
                                    </div>

                                    <div class="form-group" id="h1ad_form">
                                        <label class="control-label">h1ad.com <span class="star_mark">*</span>: </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="h1ad" id="h1ad_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="h1ad" id="h1ad_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_h1ad_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_h1ad"></span>
                                    </div>

                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-primary btn-info-full next-step9">Next</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ==========================  Step-9 end ========================================= -->

                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <!-- Success Message after submit -->
                                    <span id="form_result" aria-hidden="true"></span>
                                    <!-- Error Message after form not submit -->
                                    <h1>Image Submission Site</h1>
                                    <div class="form-group" id="imgur_form">
                                        <label class="control-label"> imgur.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="imgur" id="imgur_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="imgur" id="imgur_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_imgur_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="errNm_imgur"></span>
                                    </div>

                                    <div class="form-group" id="flickr_form">
                                        <label class="control-label"> flickr.com <span class="star_mark">*</span>:
                                        </label>
                                        <div class="col-md-12">
                                            <!-- <input type="text" name="flickr" id="flickr_url_id" class="form-control" /> -->
                                            <!-- button group with skip open -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="flickr"
                                                    id="flickr_url_id">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" id="skip_flickr_id"
                                                        type="button">skip</button>
                                                </div>
                                            </div>
                                            <!-- button group with skip close -->
                                        </div>
                                        <span style="color:red;font-size:12px; font-weight:bold;"
                                            id="err_flickr"></span>
                                    </div>

                                    <!-- <div class="form-group" id="instagram_form">
                    <label class="control-label"> instagram.com <span class="star_mark">*</span>: </label>
                    <div class="col-md-12">
                      <input type="text" name="instagram" id="instagram_url_id" class="form-control" />
                    </div>
                    <span style="color:red;font-size:12px; font-weight:bold;" id="errNm_instagram"></span>
                  </div> -->


                                    <div class="form-group" id="mediafire_form">
                                        <!-- <label class="control-label">mediafire.com <span class="star_mark">*</span>: </label>
                    <div class="col-md-12">
                    <input type="text" name="mediafire" id="mediafire_url_id" class="form-control" />
                    </div>

                    <span style="color:red;font-size:12px; font-weight:bold;" id="errNm11"></span> -->

                                        <div class="form-group" align="center">
                                            <input type="hidden" name="trainer_class_action"
                                                id="trainer_class_action" />
                                            <!-- <input type="hidden" name="org_user_name" id="org_user_name"
                        value="{{ Auth::user()->name }}"> -->
                                            <input type="hidden" name="wizard_Hidden_id" id="wizard_Hidden_id" />

                                            <!-- organization hidden value sending open -->
                                            <input type="hidden" value="{{$getting_roll_id}}" name="u_org_user_id"
                                                id="u_org_user_id">
                                            <input type="hidden" value="{{$org_slug}}" id="slug" name="u_org_slugname">
                                            <input type="hidden" value="{{Auth::user()->email}}" name="u_org_user_email"
                                                id="u_org_user_email">
                                            <input type="hidden" value="{{$org_id}}" name="u_org_organization_id"
                                                id="u_org_organization_id">
                                            <!-- organization hidden value sending close -->


                                        </div>
                                    </div>
                                    <ul class="float-right">
                                        <li class="list-inline-item">
                                            <button type="button"
                                                class="btn btn-outline-primary prev-step">Previous</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="submit" name="trainer_class_action_button"
                                                id="trainer_class_action_button" class="btn btn-primary btn-info-full"
                                                value="Add" />
                                        </li>
                                    </ul>
                                    <br />
                                </div>
                                <div class="clearfix"></div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- {{-- delete modal start here  --}} -->

<div id="wiz_confirm_delete_modals" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <button type="button" class="close" id="closeurl" data-dismiss="modal">&times;</button>
                <br>
                <span class="modal-title_delete">Confirmation</span>
            </div>
            <div class="modal-body">
                <h4 class="text-center" style="margin:0; color:red;">Are you sure you want to remove this wizard
                    project?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- -- delete modal end here  - -->
<div class="row">
    <div class="col-lg-10">
        <div id="wizardmodel" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <br>
                        <span class="modal-title_delete">Message</span>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center" style="margin:0; color:red;">wizard created successfully</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
        <div id="myclassupdatemodel" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 style="color:green;" class="tool-modal-title" id="exampleModalLabel">wizard updated
                            successfully</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--################################## view all url modal open #############################################-->
<div class="modal fade" id="viewAllValueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View all urls</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Project name: </b></span>
                            <span id="project_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Facebook url: </b></span>
                            <span id="facebook_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>LinkedIn url: </b></span>
                            <span id="linkedin_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Twitter url: </b></span>
                            <span id="twitter_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Reddit url: </b></span>
                            <span id="reddit_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Youtube url: </b></span>
                            <span id="youtube_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Tumblr url: </b></span>
                            <span id="tumblr_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Plurk url: </b></span>
                            <span id="plurk_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Getpocket url: </b></span>
                            <span id="getpocket_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Wix url: </b></span>
                            <span id="wix_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Wordpress url: </b></span>
                            <span id="wordpress_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Weebly url: </b></span>
                            <span id="weebly_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Medium url: </b></span>
                            <span id="medium_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>ProfessNow url: </b></span>
                            <span id="professnow_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Hubpages url: </b></span>
                            <span id="hubpages_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Ehow url: </b></span>
                            <span id="ehow_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Dzone url: </b></span>
                            <span id="dzone_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Articlesfactory url: </b></span>
                            <span id="articlesfactory_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Justdial url: </b></span>
                            <span id="justdial_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Sulekha url: </b></span>
                            <span id="sulekha_name_view_url"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Indiamart url: </b></span>
                            <span id="indiamart_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Quikr url: </b></span>
                            <span id="quikr_name_view_url"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Click url: </b></span>
                            <span id="click_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Wikibooks url: </b></span>
                            <span id="wikibooks_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Quora url: </b></span>
                            <span id="quora_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Answer url: </b></span>
                            <span id="answers_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Superuser url: </b></span>
                            <span id="superuser_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Dailymotion url: </b></span>
                            <span id="dailymotion_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Vimeo url: </b></span>
                            <span id="vimeo_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Metacafe url: </b></span>
                            <span id="metacafe_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Dropshots url: </b></span>
                            <span id="dropshots_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Slideshare url: </b></span>
                            <span id="slideshare_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Scribd url: </b></span>
                            <span id="scribd_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>4shared url: </b></span>
                            <span id="4shared_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Issuu url: </b></span>
                            <span id="issuu_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Freeadstime url: </b></span>
                            <span id="freeadstime_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>SuperadPost url: </b></span>
                            <span id="superadpost_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>FinderMaster url: </b></span>
                            <span id="findermaster_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>MasterMoz url: </b></span>
                            <span id="mastermoz_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>H1had url: </b></span>
                            <span id="h1ad_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Imgur url: </b></span>
                            <span id="imgur_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Flicker url: </b></span>
                            <span id="flickr_name_view"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Instagram url: </b></span>
                            <span id="instagram_name_view"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div>
                            <span><b>Pinterest url: </b></span>
                            <span id="pinterest_name_view"></span>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- ############################################# view all url modal close ###########################################-->
<script src="{{ asset('assets/wizard/project_wizard.js') }}"></script>




@endsection
