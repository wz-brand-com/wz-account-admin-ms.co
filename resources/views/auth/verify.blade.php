<!-- <!DOCTYPE html> -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="5LONDAkIrFcLmssC5XS4YFqLFv4AXSYeTSH6mkCX">

    <title>Thanks For Register!</title>

    <!-- Styles -->

    <!-- do not remove below css it's mandatory for home page :)  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">


    <script type="text/javascript" src="https://devopsschool.com/js/app.js"></script>

    <style>
        .amt {
            color: rebeccapurple;
        }
        /* Page Load popup Section Start  */
        
        .section-services {
            padding: 2% 0%;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(to right, #667db6, #0082c8, #0082c8, #667db6);
            /* background: url(../img/cta-bg.jpg) no-repeat; */

            border-radius: 5px;
            color: #fff;
        }
        /* .section-services::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background: rgba(11, 41, 55, 0.9);
        } */
        
        .section-services .header-section {
            margin-bottom: 2px;
        }
        
        .section-services .header-section .title {
            position: relative;
            padding-bottom: 5px;
            text-transform: uppercase;
        }
        
        .section-services .header-section .title:before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 140px;
            height: 1px;
            background-color: #0000cc;
        }
        
        .section-services .header-section .title:after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 45px;
            height: 3px;
            background-color: #ffffff;
        }
        
        .section-services .header-section .title span {
            color: #ffffff;
        }
        
        .section-services .header-section .description {
            color: #6f6f71;
        }
        
        .engimg {
            height: 15em;
            width: 9em;
        }
        
        @media only screen and (max-width:600px) {
            .section-services .header-section .title {
                font-size: 1.3em !important;
                left: 0px;
            }
        }
        
        .section-services .single-service {
            margin-top: 1em;
            border-radius: 10px;
            background-color: #24252a;
            box-shadow: 2px 3px 4px #b8b9be, -2px -2px 4px #fff;
        }
        
        .section-services .single-service .part-1 {
            padding: 7px 10px;
            height: 100px;
            border-bottom: 2px solid #1d1e23;
        }
        
        .section-services .single-service .part-1 i {
            margin-bottom: 5px;
            font-size: 2em;
            color: #ffdf6c;
        }
        
        .section-services .single-service .part-1 .title {
            font-size: 17px;
            letter-spacing: 1px;
            line-height: 1.8em;
        }

        .fas {
            color: #fff;
            font-size: 29px;
        }

        body{
            background-image: url("{{asset('/img/login-register.jpg')}}");
            background-size: cover;
        }
        /* Page Load popup Section End */

    </style>

   

</head>

<body>
   

    {{-- verify account start --}}
    <br><br><br><br>
    <div class="col-lg-7 amt" style="margin-left: 304px">
        <div class="card-body">
        <div class="card">
            <section class="section-services">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="header-section">
                                <h2 class="title"><span>Welcome to WizBrand</span></h2>
                                
                                <br><br>
                                <p><i class="fas fa-envelope-open"></i>&nbsp;&nbsp;&nbsp;Verify Your Email Address</p>
                                <p style="font-size: 19px;"><i class="fas fa-check-circle" style="color: white"></i> Before proceeding, please check your email for a verification link.</p>
                                
                                
                                <img src="images/inbox-message.png" style="margin-bottom: 29px;" alt="">
                                <i style="font-size: 27px; color: yellow;">Need Assistance</i><br>
                                <p class="text-center" style="color: #ffffff; font-size: 25px;">Feel free to contact us - <a href="mailto: Contact@Cotocus.com" style="color: black; background-color: #ffff00; font-size: 25px;"><b>info@wizbrand.com</b></a>
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
        </div>
        </div>
    </div>

    {{-- verify account end  --}}

    <!-- navbar start -->
    
    <!-- modal start here  -->

    <div id="mypopupModal" class="modal fade" role="dialog" style="margin-top: 73px">
        <div class="modal-dialog modal-lg">
            
            <div class="">
                <div class="modal-body text-center">
                    <button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
                    <section class="section-services">
                        <div class="container">
                            <div class="row justify-content-center text-center">
                                <div class="col-md-12 col-lg-12">
                                    <div class="header-section">
                                        <h2 class="title"><span>Welcome to WizBrand</span></h2>
                                        
                                        <br><br>
                                        <p><i class="fas fa-envelope-open"></i>&nbsp;&nbsp;&nbsp;Verify Your Email Address</p>
                                        <p style="font-size: 19px;"><i class="fas fa-check-circle" style="color: white"></i> Before proceeding, please check your email for a verification link.</p>
                                        
                                        
                                        <img src="images/inbox-message.png" style="margin-bottom: 29px;" alt="">
                                        <i style="font-size: 27px; color: yellow;">Need Assistance</i><br>
                                        <p class="text-center" style="color: #ffffff; font-size: 25px;">Feel free to contact us - <a href="mailto: Contact@Cotocus.com" style="color: black; background-color: #ffff00; font-size: 25px;"><b>info@wizbrand.com</b></a>
                                            
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>


    {{-- modal end here  --}}
    
    






    <!--Footer section End -->
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        // For Load page popup Start
        setTimeout(function() {
            $('#mypopupModal').modal("show");
        }, 1000)
    </script>





</body>

</html>