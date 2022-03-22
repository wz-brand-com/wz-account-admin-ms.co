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
    .gradient-brand-color {
        background-image: -webkit-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
        background-image: -ms-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
        color: #fff;
    }
    .contact-info__wrapper {
        overflow: hidden;
        border-radius: .625rem .625rem 0 0
    }
    @media (min-width: 1024px) {
        .contact-info__wrapper {
            border-radius: 0 .625rem .625rem 0;
            padding: 5rem !important
        }
    }
    .contact-info__list span.position-absolute {
        left: 0
    }
    .z-index-101 {
        z-index: 101;
    }
    .list-style--none {
        list-style: none;
    }
    .contact__wrapper {
        background-color: #fff;
        border-radius: 0 0 .625rem .625rem
    }
    @media (min-width: 1024px) {
        .contact__wrapper {
            border-radius: .625rem 0 .625rem .625rem
        }
    }
    @media (min-width: 1024px) {
        .contact-form__wrapper {
            padding: 5rem !important
        }
    }
    .shadow-lg,
    .shadow-lg--on-hover:hover {
        box-shadow: 0 1rem 3rem rgba(132, 138, 163, 0.1) !important;
    }

    .error {
    color: red;
  }
  .error {
    color: red;
    font-weight: 400;
    display: block;
    padding: 6px 0;
    font-size: 14px;
}
.form-control.error {
    border-color: red;
    padding: .375rem .75rem;
}
</style>

      <!-- jumbostron start bittu here  -->
      <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron_con">
                        <h1 style="text-align: center" class="display-5 text-white"><b>CONTACT US</b></h1>
                        <div class="breadcrumbs">
                            <a href="/">Home</a>
                            <a class="active" href="">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- flash session start here  --}}
    <div class="card-body">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
            Session::forget('success');
            @endphp
        </div>
        @endif
        {{-- flash session end here  --}}
        {{-- free quote start here  --}}

        {{-- <section>
            <div class="get_pricing_estimate prof_page_section" id="value_added_service">
                <h2 class="request">Request A Free Estimate</h2>
                <div class="online_visibility_header_border"></div>
                <div class="container ss_new_container">
                    <div class="row custom_service_outer_div_main">
                        <div class="col-md-6">
                            <div class="custom_service_outer_div value_added_service_tab">
                                <p>Custom Services</p>
                            </div>
                            <div class="custom_service_value_below_div padding_botton_align">
                                <div class="row">
                                    <div class="col-md-1 image_section">
                                        <img src="{{ asset('assets/images/wizbrand-pay-per-click.svg')}}"
                                            alt="Pay Per Click">
                                    </div>
                                    <div class="col-md-11 other_content_image">
                                        <div class="custom_service_value_below_content">
                                            <h3 class=""><a href="" class="pay_per">Pay Per
                                                    Click</a></h3>
                                            <p>Boost your website traffic and increase sales by adopting our PPC
                                                services at
                                                lowest pricing</p>
                                            <input type="hidden" value="Pay Per Click" class="free_estimate_value">
                                            <input type="hidden" value="PPC" class="free_estimate_short_value">
                                            <input type="submit" name="" value="Get a Free Estimate"
                                                class="contact_up_popup">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom_service_value_below_div">
                                <div class="row">
                                    <div class="col-md-1 image_section">
                                        <img src="{{ asset('assets/images/wizbrand-pay-per-click.svg')}}"
                                            alt="Pay Per Click">
                                    </div>
                                    <div class="col-md-11 other_content_image">
                                        <div class="custom_service_value_below_content">
                                            <h3><a href="" class="pay_per">Marketing
                                                    Qualified Lead</a></h3>
                                            <p>Boost your website traffic and increase sales by adopting our PPC
                                                services at
                                                lowest pricing</p>
                                            <input type="hidden" value="Marketing Qualified Lead"
                                                class="free_estimate_value">
                                            <input type="hidden" value="MQL" class="free_estimate_short_value">
                                            <input type="submit" name="" value="Get a Free Estimate"
                                                class="contact_up_popup">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="custom_service_outer_div value_added_service_tab">
                                <p>Value Added Services</p>
                            </div>
                            <div class="custom_service_value_below_div">
                                <div class="row">
                                    <div class="col-md-1 image_section">
                                        <img src="{{ asset('assets/images/wizbrand-pay-per-click.svg')}}"
                                            alt="Pay Per Click">
                                    </div>
                                    <div class="col-md-11 other_content_image">
                                        <div class="custom_service_value_below_content">
                                            <h3><a href="" class="pay_per">Branded
                                                    Content Solutions</a></h3>
                                            <p>Boost your website traffic and increase sales by adopting our PPC
                                                services at
                                                lowest pricing</p>
                                            <input type="hidden" value="Branded Content Solutions"
                                                class="free_estimate_value">
                                            <input type="hidden" value="BCS" class="free_estimate_short_value">
                                            <input type="submit" name="" value="Get a Free Estimate"
                                                class="contact_up_popup">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="custom_service_value_below_div">
                                <div class="row">
                                    <div class="col-md-1 image_section">
                                        <img src="{{ asset('assets/images/wizbrand-pay-per-click.svg')}}"
                                            alt="Pay Per Click">
                                    </div>
                                    <div class="col-md-11 other_content_image">
                                        <div class="custom_service_value_below_content">
                                            <h3><a href="" class="pay_per">Sponsorships</a>
                                            </h3>
                                            <p>Boost your website traffic and increase sales by adopting our PPC
                                                services at
                                                lowest pricing</p>
                                            <input type="hidden" value="Sponsorships" class="free_estimate_value">
                                            <input type="hidden" value="SS" class="free_estimate_short_value">
                                            <input type="submit" name="" value="Get a Free Estimate"
                                                class="contact_up_popup">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- free quote end here  --}}

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    {{-- <div class="col-md-6 text-center">
                    <h2 class="heading-section">CONTACT US</h2>
                </div> --}}
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="wrapper">
                            <div class="row no-gutters">
                                <div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
                                    <div class="contact-wrap w-100 p-md-5 p-4">
                                        <h3 class="mb-4">Get in touch</h3>
                                        <div id="form-message-warning" class="mb-4"></div>
                                        {{-- <div id="form-message-success" class="mb-4">
                                        Your message was sent, thank you!
                                    </div> --}}
                                        <form action="{{ route('contact-form.store')}}" name="contactForm" method="POST" id="" name=""
                                            class="" novalidate="novalidate">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label" for="name">Full Name</label>
                                                        <input type="text" id="name" name="name" class="form-control"
                                                            placeholder="Name" value="{{ old('name') }}">
                                                        @if ($errors->has('name'))

                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label" for="email">Email Address</label>
                                                        <input type="text" id="email" name="email" class="form-control"
                                                            placeholder="Email" value="{{ old('email') }}">

                                                        @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="label" id="subject" for="subject">Subject</label>
                                                        <input type="text" class="form-control" name="subject"
                                                            id="subject" placeholder="Subject">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="label" id="contact" for="subject">Phone</label>
                                                        <input type="number" name="phone" class="form-control"
                                                            placeholder="Phone" value="{{ old('phone') }}">
                                                        @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="label" id="message" for="#">Message</label>
                                                        <textarea name="message" rows="3"
                                                            class="form-control">{{ old('message') }}</textarea>
                                                        @if ($errors->has('message'))
                                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- google captcha start here  --}}
                                                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                    {!! app('captcha')->display() !!}
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="help-block">
                                                            <strong class="tst4 btn btn-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                {{-- google capthca end here  --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="submit" value="Send Message"
                                                            class="btn btn-primary">
                                                        <div class="submitting"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                                    <div class="info-wrap bg-primary w-100 p-md-5 p-4">
                                        <h3>Let's get in touch</h3>
                                        <p class="mb-4 text-white">We're open for any suggestion or just to have a chat
                                        </p>
                                        <div class="dbox w-100 d-flex align-items-start">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-map-marker"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <span>Address:</span> Bangalore India

                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-phone"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Phone: + 1235 2355 98</span></p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-paper-plane"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Email: contact@wizbrand.com</span></p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-globe"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Website : wizbrand.com</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        <br>
    </div>
@endsection




