@extends('page-layouts.index')
@section('content')
<style>
    .btn-sizes {
        height: 50px;
        background-color: black;
        padding: 10px 8px;
    }
    .jumbotron {
        background-image: url(assets/images/wizbrand-cover-banner.png);
        min-width: 100px !important;
        width: 100% !important;
        height: 200px;
    }
</style>
  <!-- jumbostron start bittu here  -->
  <div class="jumbotron">   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron_con">
                    <h1 style="text-align: center" class="display-5 text-white"><b>OUR GALLERY</b></h1>
                    <div class="breadcrumbs">
                        <a href="/">Home</a>
                        <a class="active" href="">Gallery</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- services page start here  --}}
<div class="container" style="">
    <div class="row">
        <div class="col-lg-12 text-center">
            {{-- <h2 class="section-title">Our Gallery</h2> --}}
            <div style="text-align: center">
                <img src="{{ asset('assets/images/wizbrand-gallery.png')}}" alt="">
                <p class="meetourteam">Meet Our Team</p>
            </div>
        </div>
        {{-- gallery start here  --}}
        <div class="container my-4">
            <!--Grid row-->
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{asset('assets/images/wizbrand-team-augustine.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Augustine Joseph, <br>
                            CEO </p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop2"><span
                                class="">Joseph’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{asset('assets/images/wizbrand-team-augustine.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">AUGUSTINE JOSEPH</span>
                                            <p class="text-justify text-dark">Augustine Joseph. MSc. MBA. CPL. CHPL
                                                (Retired Wing Commander-Air Force) is responsible for all the
                                                business operations, Sales & flight elements of company, ensuring
                                                high quality, smooth operation of the business. He has over 30 years
                                                of exceptional aviation experience, both in military and commercial
                                                aviation. </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/augustinej.joseph"
                                                        target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/augustjj/" target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="" target="_blank">
                                                        <i class="fa fa-instagram"
                                                            style="color: #8a3ab9; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Close</button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- First modal end here  --}}
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{asset('assets/images/wizbrand-team-rajesh.jpg')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Rajesh Kumar, <br>
                            Enterprise Architect & CTO</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop3"><span
                                class="">Rajesh's Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop3" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{asset('assets/images/wizbrand-team-rajesh.jpg')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-dark mt-3"> <span class="intro-1">RAJESH KUMAR
                                            </span>
                                            <p class="text-justify text-dark">Total, Over 15 years of extensive
                                                experience working with more than 8 software MNCs for software
                                                development/maintenance and production environments involved in
                                                continuous improvement and automating entire life cycle using latest
                                                devops tools and techniques from design and architecture, through
                                                implementation, deployment, and successful operations. </p>

                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/rajeshkumarIn"
                                                        target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/rajeshkumarin" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/rajeshkumarin"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/rajeshkumarin/"
                                                        target="_blank">
                                                        <i class="fa fa-instagram"
                                                            style="color: #8a3ab9; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Close</button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- First modal end here  --}}
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{ asset('assets/images/wizbrand-team-lovie-dua.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">LOVIE DUA, <br>
                            Head of Department - Europe</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop4"><span
                                class="">Lovie’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop4" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/wizbrand-team-lovie-dua.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">LOVIE DUA</span>
                                            <p class="text-justify text-dark">Lovie has more than 13 years of
                                                extensive experience in people management, technical recruitment,
                                                cost management, strategic operations solutions, resource planning,
                                                operations management and management consulting.</p>

                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="" target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="" target="_blank">
                                                        <i class="fa fa-instagram"
                                                            style="color: #8a3ab9; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Close</button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{asset('assets/images/wizbrand-team-bittu.PNG')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Bittu Kumar, <br>
                            L&D Manager </p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop"><span
                                class="">Bittu’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{asset('assets/images/wizbrand-team-bittu.PNG')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">BITTU KUMAR</span>
                                            <p class="text-justify text-dark">Bittu is a seasoned marketing
                                                professional who brings experience, enthusiasm and determination to
                                                leading day-to-day operations at Sure Oak. She is focused on
                                                ensuring we come together as a team to deliver outstanding value and
                                                service in helping our clients reach their goals.</p>

                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/bittukumar.prasad.58"
                                                        target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/Cotocusbittu" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/bittu-kumar-67958a129/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/bittucotocus1/"
                                                        target="_blank">
                                                        <i class="fa fa-instagram"
                                                            style="color: #8a3ab9; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Close</button>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- First modal end here  --}}
                <span class="mt-4"></span>
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{asset('assets/images/wizbrand-team-mantosh.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Mantosh Kumar, <br>
                            L&D Manager </p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop5"><span
                                class="">Mantosh’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop5" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{asset('assets/images/wizbrand-team-mantosh.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">MANTOSH KUMAR,</span>
                                            <p class="text-justify text-dark">Mantosh is a seasoned marketing
                                                professional who brings experience, enthusiasm and determination to
                                                leading day-to-day operations at Sure Oak. She is focused on
                                                ensuring we come together as a team to deliver outstanding value and
                                                service in helping our clients reach their goals.</p>

                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/mantoshsinghIN"
                                                        target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/mantoshsinghh" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/mantosh-singh/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/mantoshsinghh/"
                                                        target="_blank">
                                                        <i class="fa fa-instagram"
                                                            style="color: #8a3ab9; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Close</button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- First modal end here  --}}
                {{-- First modal end here  --}}
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{ asset('assets/images/wizbrand-team-sam.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Sam Ali, <br>
                            Software Engineer</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop6"><span
                                class="">Sam’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop6" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/wizbrand-team-sam.png')}}" width="200">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">Sam Ali</span>
                                            <p class="text-justify text-dark"> I am Sam
                                                Experienced Web Developer with a demonstrated history of working in
                                                the information technology and services industry. Skilled in HTML,
                                                CSS, Bootstrap4, PHP, Laravel Entrepreneurship, and jQuery. Strong
                                                engineering professional focused in Computer/Information Technology
                                                Administration and Management. Currently my profile is to study,
                                                analyze the requirement, creating frame for web application, coding
                                                and maintenance.</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/sam.cotocus" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/sam32937311" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/sam-ali-190504193/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="" target="_blank">
                                                        <i class="fa fa-instagram"
                                                            style="color: #8a3ab9; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Close</button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- First modal end here  --}}
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{ asset('assets/images/wizbrand-team-amit.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Amit Kumar, <br>
                            Software Engineer</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop7"><span
                                class="">Amit’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop7" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/wizbrand-team-amit.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">Amit Kumar</span>
                                            <p class="text-justify text-dark">Hi
                                                I am Amit
                                                Experienced Web Developer with a demonstrated history of working in
                                                the information technology and services industry. Skilled in HTML,
                                                CSS, Bootstrap4, PHP, Laravel Entrepreneurship, and jQuery. Strong
                                                engineering professional focused in Computer/Information Technology
                                                Administration and Management. Currently my profile is to study,
                                                analyze the requirement, creating frame for web application, coding
                                                and maintenance.</p>

                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/laravelamit/" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/AmitKum96687408" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/amitseobokaro/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/freelive4u/" target="_blank">
                                                        <i class="fa fa-instagram"
                                                            style="color: #8a3ab9; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Close</button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- First modal end here  --}}
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{ asset('assets/images/wizbrand-team-manish.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Manish Kumar, <br>
                            Software Engineer</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop9"><span
                                class="">Manish’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop9" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/wizbrand-team-manish.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">MANISH KUMAR</span>
                                            <p class="text-justify text-dark">Hi
                                                I am Manish
                                                Experienced Web Developer with a demonstrated history of working in
                                                the information technology and services industry. Skilled in HTML,
                                                CSS, Bootstrap4, PHP, Laravel Entrepreneurship, and jQuery. Strong
                                                engineering professional focused in Computer/Information Technology
                                                Administration and Management. Currently my profile is to study,
                                                analyze the requirement, creating frame for web application, coding
                                                and maintenance.</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/laravelamit/" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/AmitKum96687408" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/amitseobokaro/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/freelive4u/" target="_blank">
                                                        <i class="fa fa-instagram"
                                                            style="color: #8a3ab9; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Close</button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- First modal end here  --}}
            </div>
        </div>
        {{-- gallery end here  --}}
    </div>
</div>
{{-- services page end here  --}}
{{-- explore new topic start here  --}}
<section class="explore-topics">
    <h3>Explore More Services</h3>
    <p class="tlp-more-topics__description">Ready to brush up on something new? We've got more to read right this
        way.</p>
    <div class="tlp-more-topics__row">
        <a class="tlp-more-topics__row-item color-scheme-1" href="#">Manage Projects</a>
            <a class="tlp-more-topics__row-item color-scheme-2" href="#">Manage SEO Assets</a>
            <a class="tlp-more-topics__row-item color-scheme-3" href="#">SEO</a>
    </div>
    {{-- 2nd row start here  --}}
    <div class="tlp-more-topics__row">
        <a class="tlp-more-topics__row-item color-scheme-4" href="#">Monitor Task progress</a>
        <a class="tlp-more-topics__row-item color-scheme-0" href="#">Become a Digital Marketer</a>
        <a class="tlp-more-topics__row-item color-scheme-1" href="#">Track Resources</a>
    </div>
    {{-- 2nd row end here  --}}
    {{-- vist the blog section start here  --}}
    <section class="">
        <img class="wizp" src="{{ asset('assets/images/wizbrand.webp')}}" alt="">
        <h4 class="blog-section-header__heading wizp">Visit the WizBrand Blogs</h4>
    </section>
</section>
{{-- blog section start here  --}}
<div class="container">
    <div class="row">
        <section class="blog-roll">
            <article class="blog-roll__item">
                <a href="https://www.wizbrand.com/tutorials/">
                    <figure>
                        <img src="{{asset('assets/images/wizbrand-blog-marketing.jpg')}}" alt="Marketing">
                    </figure>
                    <div class="blog-roll__item-content">
                        <h3>Marketing</h3>
                        <p class="blogp">Insights, ideas, and inspiration for modern marketers.</p>
                    </div>
                </a>
            </article>
            <article class="blog-roll__item">
                <a href="https://www.wizbrand.com/tutorials/">
                    <figure>
                        <img src="{{asset('assets/images/wizbrand-marketing-team.webp')}}" alt="Sales">
                    </figure>
                    <div class="blog-roll__item-content">
                        <h3>Sales</h3>
                        <p class="blogp">Sell smarter, better, and faster.</p>
                    </div>
                </a>
            </article>
            <article class="blog-roll__item">
                <a href="https://www.wizbrand.com/tutorials/">
                    <figure>
                        <img src="{{ asset('assets/images/wizbrand-blog-services.jpg')}}" alt="Service">
                    </figure>
                    <div class="blog-roll__item-content">
                        <h3>Service</h3>
                        <p class="blogp">Helping you help your customers.</p>
                    </div>
                </a>
            </article>
            <article class="blog-roll__item">
                <a href="https://www.wizbrand.com/tutorials/">
                    <figure>
                        <img src="{{asset('assets/images/wizbrand-blog-website.png')}}" alt="Service">
                    </figure>
                    <div class="blog-roll__item-content">
                        <h3>Email Marketing</h3>
                        <p class="blogp">Helping you help your customers.</p>
                    </div>
                </a>
            </article>
        </section>
    </div>

</div>
{{-- blog section end here  --}}
<!-- product end here  -->
@endsection
