<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style-home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contactus.css')}}">



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
    {{-- <link rel="stylesheet" href="{{ asset('js/jquery-3.2.1.slim.min.js')}}"> --}}
    <script src="{{ asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script> --}}
    {{-- <link rel="stylesheet" href="{{ asset('js/popper.min.js')}}"> --}}
    <script src="{{ asset('js/popper.min.js')}}"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <!-- captcha code open -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- captcha code close -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
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
</body>
</html>
