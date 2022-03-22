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
<!-- jumbostron start here  -->
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron_con">
                    <h1 style="text-align: center" class="display-5 text-white"><b style="font-family: 'Domine', serif;">ABOUT US</b></h1>
                    <div class="breadcrumbs">
                        <a href="/">Home</a>
                        <a class="active" href="">About us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- jumbostron start end here  --}}
{{-- services page start here  --}}
<div class="container" style="">
    <div class="row">
        {{-- content start here  --}}
        <br><br><br><br><br>
        <div class="row">
            <div class="col-lg-8 col-sm-8">
                <h1 class="wedo">ABOUT US</h1>
                <br>
                <p class="wedop text-justify px-2">WizBrand is a platform built with an in-depth understanding of
                    the vision and product concept of digital marketing, digital marketers, and organizations
                    large-small. Our Team built a one-stop platform that provides opportunities to track projects,
                    assets, tasks, resources, and their progress, and stay organized on a single platform with a
                    centralized workspace so that we can manage the work of an organization well.
                </p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <br>
                <img class="about-image mt-4" src="{{ asset('assets/images/wizbrand-banner-about-us-page.jpg')}}"
                    alt="">
                </span>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <br>
                <img class="about-image mt-4" src="{{ asset('assets/images/wizbrand-using-software.png')}}" alt="">
                </span>
            </div>
            <div class="col-lg-7 col-sm-6">
                <h2 class="abts">Who can use this platform?</h2>
                <br>
                <p class="wedop text-justify px-2">By using the WizBrand Platform, Thousands of organizations and millions of digital marketers use these platforms to manage all digital marketing projects, assets, tasks, resources, and track their progress and organize them with a centralized workspace.
                </p>
            </div>
        </div>
        {{-- content end here  --}}
        <div style="text-align: center">
            <p class="meetourteam">Meet Our Team</p>
        </div>
        {{-- gallery start here  --}}

        <div class="container my-4">
            <!--Grid row-->
            <div class="row text-center">

                {{-- First modal start here  --}}

                {{-- First modal end here  --}}
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{asset('assets/images/gallery/wizbrand-team-rajesh.jpg')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Rajesh Kumar<br>
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
                                                src="{{asset('assets/images/gallery/wizbrand-team-rajesh.jpg')}}"
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
                        src="{{ asset('assets/images/wizbrand-team-mantosh.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Mantosh Kumar Singh <br>
                            Director of - Engineering</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop4"><span
                                class="">Mantosh's Bio</span>
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
                                                src="{{ asset('assets/images/wizbrand-team-mantosh.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">Mantosh Singh</span>
                                            <p class="text-justify text-dark">I am working as a Senior Engineering Manager at Cotocus. Taking care of our new product "professnow.com" and also managing a team of Trainers, Consultants, and Experts who support DevOps, DevSecOps, Master in DevOps, Site Reliability Engineering (SRE) training, consulting and outsourcing projects for our Corporate clients and individuals.
                                            </p>

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
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{asset('assets/images/wizbrand-team-bittu.PNG')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Bittu Kumar <br>
                            Director of - Engineering</p>
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
                                            <p class="text-justify text-dark">I am working as a Senior Software Engineer and Digital Marketing Lead at Cotocus, managing a team of Digital Medial Consultant, SEO engineers and DevOps. In DevOps Domain, I am Co-ornidator and covering the DevOps Consulting, DevOps Corporate Training, DevOps Co-ordination and DevOps Project Outsourcing etc.
                                            </p>

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
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{asset('assets/images/gallery/wizbrand-team-amardeep.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Amardeep Kumar Dubey <br>
                            Director of - Engineering </p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#amardeep"><span
                                class="">Amardeep Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="amardeep" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{asset('assets/images/gallery/wizbrand-team-amardeep.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">Amardeep Kumar Dubey</span>
                                            <p class="text-justify text-dark">Amardeep is a seasoned marketing
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
                        src="{{asset('assets/images/gallery/wizbrand-team-pradeep.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Pradeep Kumar Pramanik, <br>
                            Engineering Project Manager </p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop5"><span
                                class="">Pradeep’s Bio</span>
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
                                                src="{{asset('assets/images/gallery/wizbrand-team-pradeep.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">PRADEEP KUMAR</span>
                                            <p class="text-justify text-dark">To become a successful professional and achieve high career growth through a continuous process of learning for achieving goal & keeping myself dynamic in the changing scenario to become a successful professional and leading to best opportunity</p>

                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/pradeep.cotocus"
                                                        target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/KumarqPradeep" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/pradeep-kumar-15895b122/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href=""
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
                    <img class="rounded-circle1"
                        src="{{ asset('assets/images/gallery/rakesh-kumar-gorai.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Rakesh Kumar Gorai, <br>
                            Engineering Project Manager</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#rakesh"><span
                                class="">Rakesh’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="rakesh" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/gallery/rakesh-kumar-gorai.png')}}" width="200">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">Rakesh Kumar Gorai</span>
                                            <p class="text-justify text-dark"> I am Rakesh
                                                Experienced Web Developer with a demonstrated history of working in
                                                the information technology and services industry. Skilled in HTML,
                                                CSS, Bootstrap4, PHP, Laravel Entrepreneurship, and jQuery. Strong
                                                engineering professional focused in Computer/Information Technology
                                                Administration and Management. Currently my profile is to study,
                                                analyze the requirement, creating frame for web application, coding
                                                and maintenance.</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/rakeshdev.cotocus/" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/Rakeshk02395842" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/rakesh-kumar-31b4031b4/"
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
                {{-- First modal end here  --}}
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{ asset('assets/images/gallery/wizbrand-team-sam.png')}}" data-holder-rendered="true">
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
                                                src="{{ asset('assets/images/gallery/wizbrand-team-sam.png')}}" width="200">
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
                        src="{{ asset('assets/images/gallery/wizbrand-team-biraj.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Biraj Kumar <br>
                            Head (Sales & Marketing)</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#biraj"><span
                                class="">Biraj's Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="biraj" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/gallery/wizbrand-team-biraj.png')}}" width="200">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">Biraj Kumar</span>
                                            <p class="text-justify text-dark"> Helping Techies & Corporates to learn trending technologies by managing a team of Trainers, Consultants, and Experts who are involved in DevOps, Cloud, HashiCorp, Splunk, Artificial Intelligence, Machine Learning, AppDynamics, New Relic, DataDog, and many more..
                                            </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/biraj.kr.169" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/biraj_cotocus" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/biraj01/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/itisbiraj/?hl=en" target="_blank">
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
                        src="{{ asset('assets/images/gallery/wizbrand-team-anil.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Anil Kumar, <br>
                            Head (Digital & Multimedia)</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#anil"><span
                                class="">Anil’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="anil" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/gallery/wizbrand-team-anil.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">Anil Kumar</span>
                                            <p class="text-justify text-dark">Hi
                                                I am Anil Over 5+ years experience in Video Editing and Operate computer editing systems and equipment used for video media and effects, Edit video to include preselected music, interviews, sound clips and other important aspects of the project.

                                            </p>

                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/anil.cotocus.9" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/anilcotocus" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href=""
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
                        src="{{ asset('assets/images/gallery/wizbrand-team-ravi.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Ravi Kumar, <br>
                            Head (Finance & Accounting)</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#ravi"><span
                                class="">Ravi’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="ravi" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/gallery/wizbrand-team-ravi.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">RAVI KUMAR</span>
                                            <p class="text-justify text-dark">Hi
                                                I am Ravi
                                                Experienced The Head of Accounting is responsible for the day-to-day aspects of the business's accounting and reporting functions and he reports directly to the Chief Finance Officer who takes responsibility over the entire financial department</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/ravi.cotocus" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/Ravikum53118099" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href=""
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/ravi.cotocus/" target="_blank">
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
                        src="{{ asset('assets/images/gallery/wizbrand-team-sushant.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Sushant Kumar, <br>
                           Senior Software Engineer</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#sushant"><span
                                class="">Sushant's Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="sushant" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/gallery/wizbrand-team-sushant.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">SUSHANT KUMAR</span>
                                            <p class="text-justify text-dark">Hi
                                                I am Sushant
                                                Experienced Web Developer with a demonstrated history of working in
                                                the information technology and services industry. Skilled in HTML,
                                                CSS, Bootstrap4, PHP, Laravel Entrepreneurship, and jQuery. Strong
                                                engineering professional focused in Computer/Information Technology
                                                Administration and Management. Currently my profile is to study,
                                                analyze the requirement, creating frame for web application, coding
                                                and maintenance.</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/sushant.cotocus" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/iamsushantku" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/sushant-kumar-b02035194/"
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
                {{-- First modal end here  --}}
                <div class="col-md-3 mb-4">
                    <img class="rounded-circle" alt="100x100"
                        src="{{ asset('assets/images/gallery/wizbrand-team-ajay.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Ajay Kumar, <br>
                            Software Engineer</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#ajay"><span
                                class="">Ajay’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="ajay" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/gallery/wizbrand-team-ajay.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">AJAY KUMAR</span>
                                            <p class="text-justify text-dark">Hi
                                                I am AJAY
                                                Experienced Web Developer with a demonstrated history of working in
                                                the information technology and services industry. Skilled in HTML,
                                                CSS, Bootstrap4, PHP, Laravel Entrepreneurship, and jQuery. Strong
                                                engineering professional focused in Computer/Information Technology
                                                Administration and Management. Currently my profile is to study,
                                                analyze the requirement, creating frame for web application, coding
                                                and maintenance.</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/ajay.cotocus.77" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/ajcotocus" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/ajay-kumar-789121185/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/ajay.cotocus/" target="_blank">
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
                        src="{{ asset('assets/images/gallery/wizbrand-team-dharmendra.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Dharmendra Kumar, <br>
                            Software Engineer</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#staticBackdrop9"><span
                                class="">Dharmu's Bio</span>
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
                                                src="{{ asset('assets/images/gallery/wizbrand-team-dharmendra.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">DHARMENDRA KUMAR</span>
                                            <p class="text-justify text-dark">Hi
                                                I am Dharmendra
                                                Experienced Web Developer with a demonstrated history of working in
                                                the information technology and services industry. Skilled in HTML,
                                                CSS, Bootstrap4, PHP, Laravel Entrepreneurship, and jQuery. Strong
                                                engineering professional focused in Computer/Information Technology
                                                Administration and Management. Currently my profile is to study,
                                                analyze the requirement, creating frame for web application, coding
                                                and maintenance.</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/developerdharmendra" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/software_dharmu" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/dharmendra-kumar-developer/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/dharmu.kite/" target="_blank">
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
                        src="{{ asset('assets/images/gallery/wizbrand-team-ashwani.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Ashwani Kumar, <br>
                            Software Engineer</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#ashwani"><span
                                class="">Ashwani’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="ashwani" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/gallery/wizbrand-team-ashwani.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">ASHWANI KUMAR</span>
                                            <p class="text-justify text-dark">Hi
                                                I am Ashwani
                                                Experienced Web Developer with a demonstrated history of working in
                                                the information technology and services industry. Skilled in HTML,
                                                CSS, Bootstrap4, PHP, Laravel Entrepreneurship, and jQuery. Strong
                                                engineering professional focused in Computer/Information Technology
                                                Administration and Management. Currently my profile is to study,
                                                analyze the requirement, creating frame for web application, coding
                                                and maintenance.</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="https://www.facebook.com/profile.php?id=100003935402658" target="_blank">
                                                        <i class="fa fa-facebook-square"
                                                            style="color: #3b5998; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://twitter.com/AshwaniAdarsh" target="_blank">
                                                        <i class="fa fa-twitter-square"
                                                            style="color: #1DA1F2; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.linkedin.com/in/adarsh-ashwani-a75b23130/"
                                                        target="_blank">
                                                        <i class="fa fa-linkedin-square"
                                                            style="color: #0077b5;; font-size: 26px;"
                                                            aria-hidden="true"></i>
                                                        </i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="https://www.instagram.com/adarshashwani/" target="_blank">
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
                        src="{{ asset('assets/images/wizbrand-team-amit.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Amit Kumar Thakur, <br>
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
                                        <div class="text-white mt-3"> <span class="intro-1">Amit Kumar Thakur</span>
                                            <p class="text-justify text-dark">Hi I am Amit Kumar Thakur Experienced as s Software Developer with a demonstrated history of working in the information technology and services industry. Skilled in HTML, CSS, Bootstrap4, PHP, Laravel-5.8, REST API,FB API,Google API, Youtube Api, Bitbucket,Github,Linux and jQuery. Strong engineering professional focused in Computer/Information Technology Administration and Management. Currently my profile is to Software Developer, analyze the requirement, creating frame for web application, coding and maintenance.</p>

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
                                                    <a href="https://www.instagram.com/amits_thakurs/" target="_blank">
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
                        src="{{ asset('assets/images/gallery/wizbrand-team-vijay.png')}}" data-holder-rendered="true">
                    <div>
                        <p class="director">Vijay Kumar Permanik, <br>
                            Software Engineer</p>
                        <a class="fusion-button1" href="#" data-toggle="modal" data-target="#Vijay"><span
                                class="">Vijay’s Bio</span>
                        </a>
                    </div>
                </div>
                {{-- First modal start here  --}}
                <!-- Modal -->
                <div class="modal fade" id="Vijay" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body" style="background-color: white;">
                                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center mt-2"> <img
                                                src="{{ asset('assets/images/gallery/wizbrand-team-vijay.png')}}"
                                                width="200"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-white mt-3"> <span class="intro-1">Vijay Kumar Permanik</span>
                                            <p class="text-justify text-dark">Hi
                                                I am Vijay Kumar Permanik
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
{{-- <section class="explore-topics">
    <h3>Explore More Services</h3>
    <p class="tlp-more-topics__description">Ready to brush up on something new? We've got more to read right this
        way.</p>
    <div class="tlp-more-topics__row">
        <a class="tlp-more-topics__row-item color-scheme-1" href="">Manage
            Projects</a>
            <a class="tlp-more-topics__row-item color-scheme-2" href="">Manage
                SEO Assets</a>
            <a class="tlp-more-topics__row-item color-scheme-3" href="">SEO</a>
    </div>
    <div class="tlp-more-topics__row">
        <a class="tlp-more-topics__row-item color-scheme-4" href="">Monitor Task
            progress</a>
        <a class="tlp-more-topics__row-item color-scheme-0" href="">Become a
            Digital Marketer</a>
        <a class="tlp-more-topics__row-item color-scheme-1" href="">Track
            Resources</a>

    </div>
    <section class="">
        <img class="wizp" src="{{ asset('assets/images/wizbrand.webp')}}" alt="">
        <h4 class="blog-section-header__heading wizp">Visit the WizBrand Blogs</h4>
    </section>

</section> --}}

{{-- blog section start here  --}}
<div class="container">
    <div class="row">
        <section class="blog-roll">

            <article class="blog-roll__item">
                <a href="https://www.wizbrand.com/tutorials/" target="_blank">
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
                <a href="https://www.wizbrand.com/tutorials/" target="_blank">
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
                <a href="https://www.wizbrand.com/tutorials/" target="_blank">
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
                <a href="https://www.wizbrand.com/tutorials/" target="_blank">
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
{{-- explore new topic end here  --}}
@endsection
