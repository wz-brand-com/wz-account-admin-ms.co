<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/wizbrand-favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/max-cdn-min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contactus.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/instagram.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/instagram.js')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/twitter-style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <title>WizBrand Online Digital Marketing Software</title>
</head>
<style>
    .btn-sizes {
        height: 50px;
        background-color: black;
        padding: 10px 8px;
    }
</style>
<body>
    <!-- -- navbar start here  -- -->
    @include('page-layouts.navbar')
    <!-- {{-- navbar start close --}} -->
    @yield('content')
    <!-- product end here  -->
    @include('page-layouts.footer')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/Url/urlAnalyser.js') }}"></script>

    <script src="{{ asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <!-- captcha code open -->
    <script src="{{ asset('assets/css/recaptch_api.js')}}"></script>
    <!-- captcha code close -->
    <script src="{{ asset('js/jquery.validate.min.js')}}"></script>
    <script>
        $(function () {
            $("form[name='contactForm']").validate({
                // Define validation rules
                rules: {
                    name: "required",
                    email: "required",
                    phone: "required",
                    subject: "required",
                    message: "required",
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    subject: {
                        required: true
                    },
                    message: {
                        required: true
                    }
                },
                // Specify validation error messages
                messages: {
                    name: "Please provide a valid name.",
                    email: {
                        required: "Please enter your email",
                        minlength: "Please enter a valid email address"
                    },
                    phone: {
                        required: "Please provide a phone number",
                        minlength: "Phone number must be min 10 characters long",
                        maxlength: "Phone number must not be more than 10 characters long"
                    },
                    subject: "Please enter subject",
                    message: "Please enter your message"
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-220146405-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag() {
   dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', 'UA-220146405-1');
</script>

</body>
</html>
