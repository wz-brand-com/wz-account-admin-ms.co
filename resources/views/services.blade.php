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
                    <h1 style="text-align: center" class="display-5 text-white"><b style="font-family: 'Domine', serif;">OUR SERVICES</b></h1>
                    <div class="breadcrumbs">
                        <a href="/">Home</a>
                        <a class="active" href="">Services</a>
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
            <h2 class="section-title">Our Services</h2>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card border-0 shadow rounded-xs pt-3">
                <div class="card-body" style="border-bottom: 2px solid #f5af19;">
                    <i class="icon-lg icon-primary icon-bg-primary icon-bg-circle"></i>
                    <img src="{{ asset('assets/images/wizbrand-google-analytics.jpg')}}" alt="">

                    <h4 class="mt-4 mb-3">Google Analytics</h4>
                    <p>Google Analytics is a web analytics service offered by Google that tracks and reports website
                        traffic, currently as a platform inside the Google Marketing Platform brand.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card border-0 shadow rounded-xs pt-3">
                <div class="card-body" style="border-bottom: 2px solid #5D26C1;">
                    <i class="icon-lg icon-primary icon-bg-yellow icon-bg-circle"></i>
                    <img src="{{ asset('assets/images/wizbrand-backlink-checker.png')}}" alt="">
                    <h4 class="mt-4 mb-3">Backlink Checker</h4>
                    <p>The Most Powerful Backlink Checker · See domain and page-level metrics for any target ·
                        Monitor the growth and decline of backlink profiles <br><br></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card border-0 shadow rounded-xs pt-4">
                <div class="card-body" style="border-bottom: 2px solid #ad5389;"> <i
                        class="icon-lg icon-primary icon-bg-primary icon-bg-circle"></i>
                    <img src="{{ asset('assets/images/wizbrand-website-hit-counter.png')}}" alt="">
                    <h4 class="mt-4 mb-3">Website Hit Counter</h4>
                    <p>A web counter or hit counter is a computer software program that indicates the number of visitors, or hits, a particular webpage, that indicates the number of visitors </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card border-0 shadow rounded-xs pt-3">
                <div class="card-body" style="border-bottom: 2px solid #FF8C00;"> <i
                        class="icon-lg icon-primary icon-bg-primary icon-bg-circle"></i>
                    <img src="{{ asset('assets/images/wizbrand-google-adsense.png')}}" alt="">
                    <h4 class="mt-4 mb-3">Adsense Calculator</h4>
                    <p>For an estimate, try the revenue calculator on the AdSense site. It calculates your potential
                        annual revenue based on the content category of your site. <br><br></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card border-0 shadow rounded-xs pt-4">
                <div class="card-body" style="border-bottom: 2px solid #667db6;"> <i
                        class="icon-lg icon-primary icon-bg-primary icon-bg-circle"></i>
                    <img src="{{ asset('assets/images/wizbrand-keyword-planner.png')}}" alt="">
                    <h4 class="mt-4 mb-3">Ads Keyword Planner</h4>
                    <p>Keyword Planner lets you find the most effective keywords for your PPC activity. Learn to bid
                        on the right keywords to maximise ROI.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card border-0 shadow rounded-xs pt-4">
                <div class="card-body" style="border-bottom: 2px solid #e73827;"><i
                        class="icon-lg icon-primary icon-bg-primary icon-bg-circle"></i>
                    <img src="{{ asset('assets/images/wizbrand-seo-marketing-tools.jpg')}}" alt="">
                    <h4 class="mt-4 mb-3">SEO Optimization</h4>
                    <p>Search engine optimization is the process of improving the quality and quantity of website
                        traffic to a website or a web page from search engines. <br><br></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card border-0 shadow rounded-xs pt-4">
                <div class="card-body" style="border-bottom: 2px solid #e9d362;"> <i
                        class="icon-lg icon-primary icon-bg-primary icon-bg-circle"></i>
                    <img src="{{ asset('assets/images/wizbrand-smo.jpg')}}" alt="">
                    <h4 class="mt-4 mb-3">Social Media
                    </h4>
                    <p>Our social media marketing services are designed in a manner, that it will help organizations
                        to get in touch with your niche audience and engage.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card border-0 shadow rounded-xs pt-4">
                <div class="card-body" style="border-bottom: 2px solid #DA22FF;"><i
                        class="icon-lg icon-primary icon-bg-primary icon-bg-circle"></i>
                    <img src="{{ asset('assets/images/wizbrand-digital-marketing.jpg')}}" alt="">
                    <h4 class="mt-4 mb-3">Digital Marketing</h4>
                    <p>we are proud to say that we have helped many brands establish an influential and dominant
                        online presence in their niche.<br><br></p>
                </div>
            </div>
        </div>
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
{{-- explore new topic end here  --}}

@endsection
