@extends('layouts.backend.mainlayout')
@section('title','User PhoneNumber')

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
        <h3 class="text-themecolor">Phone Number</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">System Setting</a></li>
            <li class="breadcrumb-item active">Phone Number</li>
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
                                    class="btn btn-primary ">Add Phone Number</button>
                            </div>
                        </div>

                        <table id="PhoneTable" class="table">
                            <thead>
                                <!-- data fetching from database -->
                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                        <div id="formModal" class="modal fade" role="dialog">

                            <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">

                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add Phone Number</h5>
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
                                                        <label class="control-label">Phone Number</label>
                                                        <input type="number" name="phone" id="phone"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">carrier</label>
                                                        <select name="carrier" id="carrier" class="form-control">
                                                            <option value="default" class="form-control text-dark">
                                                                Select Carrier </option>
                                                                <option name="" value="Airtel">Airtel</option>
                                                            <option name="" value="BSNL">BSNL</option>
                                                            <option name="" value="IDEA">IDEA</option>
                                                            <option name="" value="JIO">JIO</option>
                                                            <option name="" value="China Mobile"> China Mobile</option>
                                                            <option name="" value="Vodafone Group">Vodafone Group</option>
                                                            <option name="" value="America Movil Group">America Movil Group </option>
                                                            <option name="" value="Bharti Airtel"> Bharti Airtel</option>
                                                            <option name="" value="Telefonica Group">Telefonica Group</option>
                                                            <option name="" value="China Unicom">China Unicom</option>
                                                            <option name="" value="VimpelCom Group">VimpelCom Group</option>
                                                            <option name="" value="Reliance">Reliance</option>
                                                            <option name="" value="Telenor Group">Telenor Group</option>
                                                            <option name="" value="China Telecom">China Telecom</option>
                                                            <option name="" value="MTN Group">MTN Group</option>
                                                            <option name="" value="France Telecom">France Telecom</option>
                                                            <option name="" value="Telkomsel Group">Telkomsel Group</option>
                                                            <option name="" value="Idea Cellular">Idea Cellular</option>
                                                            <option name="" value="Sistema Group">Sistema Group</option>
                                                            <option name="" value="Verizon Wireless">Verizon Wireless</option>
                                                            <option name="" value="Deutsche Telekom">Deutsche Telekom</option>
                                                            <option name="" value=" AT&T"> AT&T</option>
                                                            <option name="" value="Telecom Italia">Telecom Italia</option>
                                                            <option name="" value="Movistar">Movistar</option>
                                                            <option name="" value="Digicel">Digicel</option>
                                                            <option name="" value="Claro">Claro</option>
                                                            <option name="" value="China telecom">China telecom</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Owner</label>
                                                        <select name="owner" id="owner" class="form-control">
                                                            <option value="default" class="form-control text-dark">
                                                                Select Owner </option>
                                                           
 
                                                                <option value="{{Auth::user()->email}}">{{Auth::user()->email}}</option> 
                                                                @foreach($find_org_user_email_phonenumber as $phoneNumber)
                                                                @if(Auth::user()->email !== $phoneNumber['u_org_user_email'])
                                                                <option  value="{{$phoneNumber['u_org_user_email']}}" name="{{$phoneNumber['u_org_user_id']}}" >{{$phoneNumber['u_org_user_email']}}</option>
                                                                @endif   
                                                                @endforeach  
                                                           
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Status</label>
                                                        <input type="text" name="status" id="status" autocomplete="off"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Last Used</label>
                                                        <input type="text" name="last_used" id="last_used" autocomplete="off"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Last Recharge</label>
                                                        <input type="text" name="last_recharge" id="last_recharge" autocomplete="off"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Country</label>
                                                        <select class="form-control custom-select" name="state"
                                                            id="state">
                                                            <option>-- Select country --</option>

                                                            <option>-- Select Country --</option>
																<option value="Anguilla" >Anguilla</option>
                                                                <option value="Antigua And Barbuda" >Antigua And Barbuda</option>
                                                                <option value="Argentina" >Argentina</option>
                                                                <option value="Armenia" >Armenia</option>
                                                                <option value="Aruba" >Aruba</option>
                                                                <option value="Australia" >Australia</option>
                                                                <option value="Austria" >Austria</option>
                                                                <option value="Azerbaijan" >Azerbaijan</option>
                                                                <option value="Bahamas The" >Bahamas The</option>
                                                                <option value="Bahrain" >Bahrain</option>
                                                                <option value="Bangladesh" >Bangladesh</option>
                                                                <option value="Barbados" >Barbados</option>
                                                                <option value="Belarus" >Belarus</option>
                                                                <option value="Belgium" >Belgium</option>
                                                                <option value="Belize" >Belize</option>
                                                                <option value="Benin" >Benin</option>
                                                                <option value="Bermuda" >Bermuda</option>
                                                                <option value="Bhutan" >Bhutan</option>
                                                                <option value="Bolivia" >Bolivia</option>
                                                                <option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
                                                                <option value="Botswana" >Botswana</option>
                                                                <option value="Bouvet Island" >Bouvet Island</option>
                                                                <option value="Brazil" >Brazil</option>
                                                                <option value="British Indian Ocean Territory" >British Indian Ocean Territory</option>
                                                                <option value="Brunei" >Brunei</option>
                                                                <option value="Bulgaria" >Bulgaria</option>
                                                                <option value="Burkina Faso" >Burkina Faso</option>
                                                                <option value="Burundi" >Burundi</option>
                                                                <option value="Cambodia" >Cambodia</option>
                                                                <option value="Cameroon" >Cameroon</option>
                                                                <option value="Canada" >Canada</option>  
                                                                <option value="Cape Verde" >Cape Verde</option>
                                                                <option value="Cayman Islands" >Cayman Islands</option>
                                                                <option value="Central African Republic" >Central African Republic</option>
                                                                <option value="Chad" >Chad</option>
                                                                <option value="Chile" >Chile</option>
                                                                <option value="China" >China</option>
                                                                <option value="Christmas Island" >Christmas Island</option>
                                                                <option value="Cocos (Keeling) Islands" >Cocos (Keeling) Islands</option>
                                                                <option value="Colombia" >Colombia</option>
                                                                <option value="Comoros" >Comoros</option>
                                                                <option value="Congo" >Congo</option>
                                                                <option value="The Democratic repbulic of Congo">The Democratic repbulic of Congo</option>
                                                                <option value="Cook Islands" >Cook Islands</option>
                                                                <option value="Costa Rica" >Costa Rica</option>
                                                                <option value="Cote D&#039;Ivoire (Ivory Coast)" >Cote D&#039;Ivoire (Ivory Coast)</option>
                                                                <option value="Croatia (Hrvatska)" >Croatia (Hrvatska)</option>
                                                                <option value="Cuba" >Cuba</option>
                                                                <option value="Cyprus" >Cyprus</option>
                                                                <option value="58" >Czech Republic</option>
                                                                <option value="Denmark" >Denmark</option>
                                                                <option value="Djibouti" >Djibouti</option>
                                                                <option value="Dominica" >Dominica</option>
                                                                <option value="Dominican Republic" >Dominican Republic</option>
                                                                <option value="East Timor" >East Timor</option>
                                                                <option value="Ecuador" >Ecuador</option>
                                                                <option value="Egypt" >Egypt</option>
                                                                <option value="El Salvador" >El Salvador</option>
                                                                <option value="Equatorial Guinea" >Equatorial Guinea</option>
                                                                <option value="Eritrea" >Eritrea</option>
                                                                <option value="Estonia" >Estonia</option>
                                                                <option value="Ethiopia" >Ethiopia</option>
                                                                <option value="Falkland Islands" >Falkland Islands</option>
                                                                <option value="Faroe Islands" >Faroe Islands</option>
                                                                <option value="Fiji Islands" >Fiji Islands</option>
                                                                <option value="Finland" >Finland</option>
                                                                <option value="France" >France</option>
                                                                <option value="French Guiana" >French Guiana</option>
                                                                <option value="French Polynesia" >French Polynesia</option>
                                                                <option value="French Southern Territories" >French Southern Territories</option>
                                                                <option value="Gabon" >Gabon</option>
                                                                <option value="The Gambia" >The Gambia</option>
                                                                <option value="Georgia" >Georgia</option>
                                                                <option value="Germany" >Germany</option>
                                                                <option value="Ghana" >Ghana</option>
                                                                <option value="Gibraltar" >Gibraltar</option>
                                                                <option value="Greece" >Greece</option>
                                                                <option value="Greenland" >Greenland</option>
                                                                <option value="Grenada" >Grenada</option>
                                                                <option value="Guadeloupe" >Guadeloupe</option>
                                                                <option value="Guam" >Guam</option>
                                                                <option value="Guatemala" >Guatemala</option>
                                                                <option value="Guernsey and Alderney" >Guernsey and Alderney</option>
                                                                <option value="Guinea" >Guinea</option>
                                                                <option value="Guinea-Bissau" >Guinea-Bissau</option>
                                                                <option value="Guyana" >Guyana</option>
                                                                <option value="Haiti" >Haiti</option>
                                                                <option value="Heard and McDonald Islands" >Heard and McDonald Islands</option>
                                                                <option value="Honduras" >Honduras</option>
                                                                <option value="Hong Kong S.A.R." >Hong Kong S.A.R.</option>
                                                                <option value="Hungary" >Hungary</option>
                                                                <option value="Iceland" >Iceland</option>
                                                                <option value="India" >India</option>
                                                                <option value="Indonesia" >Indonesia</option>
                                                                <option value="Iran" >Iran</option>
                                                                <option value="Ireland" >Ireland</option>
                                                                <option value="Israel" >Israel</option>
                                                                <option value="Italy" >Italy</option>
                                                                <option value="Jamaica" >Jamaica</option>
                                                                <option value="Japan" >Japan</option>
                                                                <option value="Jersey" >Jersey</option>
                                                                <option value="Jordan" >Jordan</option>
                                                                <option value="Kazakhstan" >Kazakhstan</option>
                                                                <option value="Kenya" >Kenya</option>
                                                                <option value="Kiribati" >Kiribati</option>
                                                                <option value="Korea North" >Korea North</option>
                                                                <option value="Korea South" >Korea South</option>
                                                                <option value="Kuwait" >Kuwait</option>
                                                                <option value="Kyrgyzstan" >Kyrgyzstan</option>
                                                                <option value="Laos" >Laos</option>
                                                                <option value="Latvia" >Latvia</option>
                                                                <option value="Lebanon" >Lebanon</option>
                                                                <option value="Lesotho" >Lesotho</option>
                                                                <option value="Liberia" >Liberia</option>
                                                                <option value="Libya" >Libya</option>
                                                                <option value="Liechtenstein" >Liechtenstein</option>
                                                                <option value="Lithuania" >Lithuania</option>
                                                                <option value="Luxembourg" >Luxembourg</option>
                                                                <option value="Macau S.A.R." >Macau S.A.R.</option>
                                                                <option value="Macedonia" >Macedonia</option>
                                                                <option value="Madagascar" >Madagascar</option>
                                                                <option value="Malawi" >Malawi</option>
                                                                <option value="Malaysia" >Malaysia</option>
                                                                <option value="Maldives" >Maldives</option>
                                                                <option value="Mali" >Mali</option>
                                                                <option value=">Malta" >Malta</option>
                                                                <option value="Man (Isle of)" >Man (Isle of)</option>
                                                                <option value="Marshall Islands" >Marshall Islands</option>
                                                                <option value="Martinique" >Martinique</option>
                                                                <option value="Mauritania" >Mauritania</option>
                                                                <option value="Mauritius" >Mauritius</option>
                                                                <option value="Mayotte" >Mayotte</option>
                                                                <option value="Mexico" >Mexico</option>
                                                                <option value="Micronesia" >Micronesia</option>
                                                                <option value="Moldova" >Moldova</option>
                                                                <option value="Monaco" >Monaco</option>
                                                                <option value="Mongolia" >Mongolia</option>
                                                                <option value="Montenegro" >Montenegro</option>
                                                                <option value="Montserrat" >Montserrat</option>
                                                                <option value="Morocco" >Morocco</option>
                                                                <option value="Mozambique" >Mozambique</option>
                                                                <option value="Myanmar" >Myanmar</option>
                                                                <option value="Namibia" >Namibia</option>
                                                                <option value="Nauru" >Nauru</option>
                                                                <option value="Nepal" >Nepal</option>
                                                                <option value="Netherlands Antilles" >Netherlands Antilles</option>
                                                                <option value="Netherlands The" >Netherlands The</option>
                                                                <option value="New Caledonia" >New Caledonia</option>
                                                                <option value="New Zealand" >New Zealand</option>
                                                                <option value="Nicaragua" >Nicaragua</option>
                                                                <option value="Niger" >Niger</option>
                                                                <option value="Nigeria" >Nigeria</option>
                                                                <option value="Niue" >Niue</option>
                                                                <option value="Norfolk Island" >Norfolk Island</option>
                                                                <option value="Northern Mariana Islands" >Northern Mariana Islands</option>
                                                                <option value="Norway" >Norway</option>
                                                                <option value="Oman" >Oman</option>
                                                                <option value="Pakistan" >Pakistan</option>
                                                                <option value="Palau" >Palau</option>
                                                                <option value="Palestinian Territory Occupied" >Palestinian Territory Occupied</option>
                                                                <option value="Panama" >Panama</option>
                                                                <option value="Papua new Guinea" >Papua new Guinea</option>
                                                                <option value="Paraguay" >Paraguay</option>
                                                                <option value="Peru" >Peru</option>
                                                                <option value="Philippines" >Philippines</option>
                                                                <option value="Pitcairn Island" >Pitcairn Island</option>
                                                                <option value="Poland" >Poland</option>
                                                                <option value="Portugal" >Portugal</option>
                                                                <option value="Puerto Rico" >Puerto Rico</option>
                                                                <option value="Qatar" >Qatar</option>
                                                                <option value="Reunion" >Reunion</option>
                                                                <option value="Romania" >Romania</option>
                                                                <option value="Russia" >Russia</option>
                                                                <option value="Rwanda" >Rwanda</option>
                                                                <option value="Saint Helena" >Saint Helena</option>
                                                                <option value="Saint Kitts And Nevis" >Saint Kitts And Nevis</option>
                                                                <option value="Saint Lucia" >Saint Lucia</option>
                                                                <option value="Saint Pierre and Miquelon" >Saint Pierre and Miquelon</option>
                                                                <option value="Saint Vincent And The Grenadines" >Saint Vincent And The Grenadines</option>
                                                                <option value="Saint-Barthelemy" >Saint-Barthelemy</option>
                                                                <option value="Saint-Martin (French part)" >Saint-Martin (French part)</option>
                                                                <option value="Samoa" >Samoa</option>
                                                                <option value="San Marino" >San Marino</option>
                                                                <option value="Sao Tome and Principe" >Sao Tome and Principe</option>
                                                                <option value="Saudi Arabia" >Saudi Arabia</option>
                                                                <option value="Senegal" >Senegal</option>
                                                                <option value="Serbia" >Serbia</option>
                                                                <option value="Seychelles" >Seychelles</option>
                                                                <option value="Sierra Leone" >Sierra Leone</option>
                                                                <option value="Singapore" >Singapore</option>
                                                                <option value="Slovakia" >Slovakia</option>
                                                                <option value="201" >Slovenia</option>
                                                                <option value="Solomon Islands" >Solomon Islands</option>
                                                                <option value="Somalia" >Somalia</option>
                                                                <option value="South Africa" >South Africa</option>
                                                                <option value="South Georgia" >South Georgia</option>
                                                                <option value="South Sudan" >South Sudan</option>
                                                                <option value="Spain" >Spain</option>
                                                                <option value="Sri Lanka" >Sri Lanka</option>
                                                                <option value="Sudan" >Sudan</option>
                                                                <option value="Suriname" >Suriname</option>
                                                                <option value="Svalbard And Jan Mayen Islands" >Svalbard And Jan Mayen Islands</option>
                                                                <option value="Swaziland" >Swaziland</option>
                                                                <option value="Sweden" >Sweden</option>
                                                                <option value="Switzerland" >Switzerland</option>
                                                                <option value="Syria" >Syria</option>
                                                                <option value="Taiwan" >Taiwan</option>
                                                                <option value="Tajikistan" >Tajikistan</option>
                                                                <option value="Tanzania" >Tanzania</option>
                                                                <option value="Thailand" >Thailand</option>
                                                                <option value="Togo" >Togo</option>
                                                                <option value="Tokelau" >Tokelau</option>
                                                                <option value="Tonga" >Tonga</option>
                                                                <option value="Trinidad And Tobago" >Trinidad And Tobago</option>
                                                                <option value="Tunisia" >Tunisia</option>
                                                                <option value="Turkey" >Turkey</option>
                                                                <option value="Turkmenistan" >Turkmenistan</option>
                                                                <option value="Turks And Caicos Islands" >Turks And Caicos Islands</option>
                                                                <option value="Tuvalu" >Tuvalu</option>
                                                                <option value="Uganda" >Uganda</option>
                                                                <option value="Ukraine" >Ukraine</option>
                                                                <option value="United Arab Emirates" >United Arab Emirates</option>
                                                                <option value="United Kingdom" >United Kingdom</option>
                                                                <option value="United States" >United States</option>
                                                                <option value="United States Minor Outlying Islands" >United States Minor Outlying Islands</option>
                                                                <option value="Uruguay" >Uruguay</option>
                                                                <option value="Uzbekistan" >Uzbekistan</option>
                                                                <option value="Vanuatu" >Vanuatu</option>
                                                                <option value="Vatican City State (Holy See)" >Vatican City State (Holy See)</option>
                                                                <option value="Venezuela" >Venezuela</option>
                                                                <option value="Vietnam" >Vietnam</option>
                                                                <option value="Virgin Islands (British)" >Virgin Islands (British)</option>
                                                                <option value="Virgin Islands (US)" >Virgin Islands (US)</option>
                                                                <option value="Wallis And Futuna Islands" >Wallis And Futuna Islands</option>
                                                                <option value="Western Sahara" >Western Sahara</option>
                                                                <option value="Yemen" >Yemen</option>
                                                                <option value="Zambia" >Zambia</option>
                                                                <option value="Zimbabwe" >Zimbabwe</option>
                                                                <option value="Kosovo" >Kosovo</option>
                                                                <option value="Curaçao" >Curaçao</option>
                                                        </select>

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
                                        this Phone Number</h4>
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
        var dt = $('#PhoneTable').DataTable({
            "ajax": {
                "paging": true,
                "scrollX": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "url": "{{url('api/v1/j/phone/index')}}/" + id,
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
                    "title": "Phone",
                    "targets": 1,
                    "width": "15%"
                },
                {
                    "title": "Carrier",
                    "targets": 2,
                    "width": "10%"
                },
                {
                    "title": "Owner",
                    "targets": 3,
                    "width": "10%"
                },
                {
                    "title": "Status",
                    "targets": 4,
                    "width": "10%"
                },
                {
                    "title": "last Used",
                    "targets": 5,
                    "width": "10%"
                },
                {
                    "title": "last Recharge",
                    "targets": 6,
                    "width": "10%"
                },
                {
                    "title": "State",
                    "targets": 7,
                    "width": "10%"
                },
             
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'phone'
                }, {
                    data: 'carrier'
                }, {
                    data: 'owner'
                }, {
                    data: 'status'
                }, {
                    data: 'last_used'
                }, {
                    data: 'last_recharge'
                }, {
                    data: 'state'
                },
                // {
                //     data: null,
                //     render: function (data, type, row) {
                //         return '<div class="row"><div class="col-6"><button type="button"  id="' +
                //             data['id'] +
                //             '" class="edit btn btn-primary"><i class="mdi mdi-lead-pencil"></i></button></div><div class="col-2"><button type="button" id="' +
                //             data['id'] +
                //             '"  class="btn btn-danger  delete"><i class="mdi mdi-delete"></i></button></div> </div>'
                //     },
                // },
            ],


        });
        // data table close

        // model will be display on add and edit button click
        $('#create_record').click(function () {
            $('#name_form').show();
            $('#sample_form')[0].reset();
            $('#form_result').html('');
            $('.modal-title').text("Add New phone");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        // model will be close

        //  form working start
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();

            // data add working on submit button
            if ($('#action').val() == 'Add') {
                console.log('add button click ho rha ha');
                $.ajax({
                    url: "{{route('phone.store') }}",
                    method: "POST",
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
                        console.log('phone number update ho gaya successfully');
                        var html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#PhoneTable').DataTable().ajax.reload();
                            }, 2000);
                        } else {
                            html = '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            $('#form_result').html(html);
                        }
                        // adding alert messages for success and exist data validation close
                    },
                    // message alert close

                    error: function (data) {
                        console.log('Error:', data);
                        console.log('submit function kamm nahi kr rha hai');
                    }
                })
            }

            // update button wotking for updata data
            if ($('#action').val() == "Update") {
                console.log('update button pe click ho rha hai');
                $.ajax({
                    url: "{{url('/api/v1/j/phone/update/') }}",
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
                            $('#formModal').modal('hide');
                            $('#PhoneTable').DataTable().ajax.reload();
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
            $.ajax({
                type: "get",
                data: {},
                url: "{{url('/api/v1/j/phone/edit/')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                success: function (html) {
                    console.log('value aa gaya edit ke page pe');
                    console.log(html);
                    $('#phone').val(html.data.phone);
                    $('#carrier').val(html.data.carrier);
                    $('#owner').val(html.data.owner);
                    $('#status').val(html.data.status);
                    $('#last_used').val(html.data.last_used);
                    $('#last_recharge').val(html.data.last_recharge);
                    // $('#state').val(html.data.state);  
                    //open 
                    $('#state').prepend("<option value='" + html.data.state +
                        "' selected='selected'>" + html.data.state + "</option>");
                    // close      
                    $('.modal-title').text("Edit Phone Number");
                    $('.modal-title_delete').text("Phone Number Delete");
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
                url: "{{url('api/v1/j/phone/destroy')}}/" + id,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                },
                beforeSend: function () {
                    $('#ok_button').text('Deleting..');
                },
                success: function (data) {
                    $('#ok_button').text('OK');
                    $('#confirmModal').modal('hide');
                    $('#PhoneTable').DataTable().ajax.reload()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
    });

</script>
@endpush
