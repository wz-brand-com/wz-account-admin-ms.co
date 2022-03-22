<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/public-view.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-home.css') }}">
    <style>
        .jumbotron {
            background-image: url(assets/images/wizbrand-cover-banner.png) !important;
            min-width: 100px !important;
            width: 100% !important;
            height: 200px;
        }
    </style>
    <title> Wizbrand | users </title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar" style="background-color: #0b1320;">
        <div class="container-fluid">
            <a href="/"><img class="logos" src="assets/images/wiz.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="assets/images/toggle.png" alt="">
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="navbar-nav topnav" style="margin-left: 372px">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('organzations.list.all') }}">Organizations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('user-profile') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('about')}}">About&nbsp;us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="https://www.wizbrand.com/tutorials/"
                            target="_blank">Tutorials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="https://www.wizbrand.com/tools/">Tools</a>
                     </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('service')}}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/register')}}">Register</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link active" href="{{ url('/login')}}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- jumbostron start here  -->
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron_con">
                        <h1 style="text-align: center" class="display-5 text-white"><b
                                style="font-family: 'Domine', serif;">ALL USERS</b></h1>
                        <div class="breadcrumbs">
                            <a href="/">Home</a>
                            <a class="active" href="">Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- jumbostron start end here --}}
    {{-- <div class="container">
        <div class="row">

        </div>
    </div> --}}
    <div class="container">
        <div class="card mt-4">
            <div class="row py-3 px-3">
                <div class="col-lg-4 col-md-3 col-sm-3 col-3">
                    <label class="font-weight-bold text-danger"> Country </label>
                    <select class="form-control countries" name="filter_by_country" id="filter_by_country">
                        <option value="all">All Country</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-3">
                    <label class="font-weight-bold text-danger"> State </label>
                    <select class="form-control states" name="filter_by_state" id="filter_by_state">
                        <option value="all">Select State</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-3">
                    <label class="font-weight-bold text-danger"> City </label>
                    <select class="form-control cities" name="filter_by_city" id="filter_by_city">
                        <option value="all">Select City</option>
                    </select>
                </div>
                <div class="col-12 p-3">
                    <input type="text" class="form-control" name="manual_filter_table" id="filter_by_search"
                        placeholder="Search Keyword.." style="font-size:18px; border:1px solid blue;">
                </div>
            </div>
        </div>
        <div class="row" id="user_pic_file">
            
                @include('paginated_data')
          
        </div>
    </div>


    <br><br>
    <footer class="section bg-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="">
                        <h6 class=" footer-heading text-uppercase text-white"
                            style="border-bottom: 1px solid; width: 120px;">
                            Register&nbsp;Here
                        </h6>
                        <ul class="list-unstyled footer-link mt-4">
                            <li>
                                <badge class="badge footer_focus_style"><a href="https://www.wizbrand.com/register"
                                        target="_blank">Regitser</a></badge>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="">
                        <h6 class=" footer-heading text-uppercase text-white"
                            style="border-bottom: 1px solid; width: 111px;">
                            SEO Tools:
                        </h6>
                        <ul class="list-unstyled footer-link mt-2">
                            <li>
                                <a href="">Google Analytics</a>
                            </li>
                            <li>
                                <a href="">Backlink Checker</a>
                            </li>
                            <li>
                                <a href="">Page Speed Test</a>
                            </li>
                            <li>
                                <a href="">Website Hit Counter</a>
                            </li>
                            <li>
                                <a href="#" target="_blank">Adsense Calculator</a>
                            </li>

                            <li>
                                <a href="#" target="_blank">Ads Keyword Planner</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="">
                        <h6 class=" footer-heading text-uppercase text-white"
                            style="border-bottom: 1px solid; width: 160px;">
                            About&nbsp;Company:
                        </h6>
                        <ul class="list-unstyled footer-link mt-2">
                            <li>
                                <a href="">About Us</a>
                            </li>
                            <li>
                                <a href="https://www.wizbrand.com/tutorials/">Blog</a>
                            </li>

                            <li>
                                <a href="">Gallery</a>
                            </li>
                            <li>
                                <a href="">Services</a>
                            </li>
                            <li>
                                <a href="">Contact us</a>
                            </li>
                            <li>
                                <a href="">Organization</a>
                            </li>
                            <li>
                                <a href="">Support</a>
                            </li>
                            <li>
                                <a href="">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="">Select your country</a>
                            </li>
                            <div class="d-flex footer_flag_main">
                                <a href="https://www.wizbrand.com/">
                                    <div class="cat_new_footer_flag india_flag" title="india_flag" alt="india_flag">
                                    </div>
                                </a>
                                <a href="https://www.wizbrand.com/">
                                    <div class="cat_new_footer_flag us_flag" title="us_flag" alt="us_flag"></div>
                                </a>
                                <a href="https://www.wizbrand.com/">
                                    <div class="cat_new_footer_flag gcc_flag" title="gcc_flag" alt="gcc_flag"></div>
                                </a>
                                <a href="https://www.wizbrand.com/" rel="noopener" target="_blank">
                                    <div class="cat_new_footer_flag uk_flag" title="uk_flag" alt="uk_flag"></div>
                                </a>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ml-5">
                        <h6 class="footer-heading text-uppercase text-white"
                            style="border-bottom: 1px solid; width: 211px;">
                            Get&nbsp;In&nbsp;Touch&nbsp;With&nbsp;Us:
                        </h6>
                        <a href="https://www.wizbrand.com/" class="mt-4 text-white">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            www.wizbrand.com
                        </a>
                        <p class="text-white">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            contact@wizbrand.com
                        </p>
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/wizbrandOffer" target="_blank">
                                        <i class="fa fa-facebook-square" style="color: #3b5998; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/WizBrandIndia" target="_blank">
                                        <i class="fa fa-twitter-square" style="color: #1DA1F2; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.linkedin.com/company/wizbrand/" target="_blank">
                                        <i class="fa fa-linkedin-square" style="color: #0077b5; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.instagram.com/wizbrand.india/" target="_blank">
                                        <i class="fa fa-instagram" style="color: #8a3ab9; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.youtube.com/channel/UCLvVLngJC7pse7Jx3V2m7Fg" target="_blank">
                                        <i class="fa fa-youtube" style="color: #FF0000; font-size: 26px;"
                                            aria-hidden="true"></i>
                                        </i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <div class="container-fluid bg-dark">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright_footer">
                    <p class="text-center text-white mt-2">
                        Copyright © 2022 WizBrand All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer End -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
</body>
<style>
    .messages {
        color: red;

    }

</style>


<script src="{{ asset('js/location.js') }}"></script>
<script type="text/javascript">
    function fetch_jobs_data( filter_by_country, filter_by_state, filter_by_city,
        filter_by_search) {
        console.log('fetch_jobs_data ka ajax function me hai');
        $('#user_pic_file').html('');
        $('#trainer').html(
            '<center><img src="{{ asset('images/load-indicator.gif') }}" alt="Loading..." /></center>'
        );
        $.ajax({
            url: "{{ url('/welcome_manualfilter') }}?filter_by_country=" +
                filter_by_country +
                "&filter_by_state=" + filter_by_state + "&filter_by_city=" + filter_by_city +
                
                "&filter_by_search=" + filter_by_search,
            success: function (data) {
                console.log(data+'data in success function');
                $('#user_pic_file').html('');
                $('#user_pic_file').html(data);
            }
        });
    }

    $(document).ready(function () {
        console.log('ye cv ka filter function me hai');
        $('#filter_by_country').change(function () {
            console.log('filter by country function me hai');
            $('#filter_by_search').val('');
          
            var filter_by_search = $('#filter_by_search').val();
            filter_by_country = $("#filter_by_country").val();

            $('#filter_by_state option').prop('selected', function () {
                return this.defaultSelected;
            });
            $('#filter_by_city option').prop('selected', function () {
                return this.defaultSelected;
            });
            filter_by_state = "all";
            filter_by_city = "all";
           

            fetch_jobs_data( filter_by_country, filter_by_state, filter_by_city,
            
                filter_by_search);
        });

        $('#filter_by_state').change(function () {
            $('#filter_by_search').val('');
            // var page = $('#hidden_page').val();
            // var page = 1;
            var filter_by_search = $('#filter_by_search').val();
            filter_by_state = $("#filter_by_state").val();
            filter_by_country = "all";
            filter_by_city = "all";
          

            fetch_jobs_data( filter_by_country, filter_by_state, filter_by_city,
            
                filter_by_search);
        });

        $('#filter_by_city').change(function () {
            $('#filter_by_search').val('');
           
            var filter_by_search = $('#filter_by_search').val();
            filter_by_city = $("#filter_by_city").val();
           
            filter_by_country = "all";
            filter_by_state = "all";
          
            fetch_jobs_data( filter_by_country, filter_by_state, filter_by_city,
            
                filter_by_search);
        });

        

    });


    $(document).on('keyup', '#filter_by_search', function () {
        var filter_by_search = $('#filter_by_search').val();
        console.log('filter by search function me hai'+filter_by_search);

      
        filter_by_country = "all";
        filter_by_state = "all";
        filter_by_city = "all";
        $('#filter_by_country option').prop('selected', function () {
            return this.defaultSelected;
        });
        $('#filter_by_state option').prop('selected', function () {
            return this.defaultSelected;
        });
       
        $('#filter_by_city option').prop('selected', function () {
            return this.defaultSelected;
        });
        fetch_jobs_data( filter_by_country, filter_by_state, filter_by_city,
            filter_by_search);
    });


    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var manual_filter_tablesm = $('#manual_filter_tablesm').val();
       
        manual_filter = $("#manual_filter_table").val();
        manual_filter = $("#manual_filter_table1").val();
        manual_filter = $("#manual_filter_table2").val();
        manual_filter = $("#manual_filter_table3").val();
        fetch_jobs_data( manual_filter, manual_filter_tablesm);
    });

    
</script>



</html>
