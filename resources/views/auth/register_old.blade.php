@extends('layouts.app')

@section('content')
<nav class="py-0 px-7 navbar navbar-expand-lg trans-navbar">
    <div class="container-fluid"><a class="navbar-brand" href="{{ env('LANDING_URL') }}"><img src="{{URL::asset('public/images/main-logo.png')}}" class="img-fluid" /></a></div>
</nav>
<div id="main">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(window).on("load resize scroll", function(e) {
            var winHeight = $(window).height() - 40;
            $('.pageBg').height(winHeight);

        });
    </script>
    <form id="studentsignup" method="post">
        @csrf
        <div class="ms-auto login-box me-auto" id="name-box">
            <div class="welcome-heading">Welcome to UniQ </div>
            <p class="welcome-msg text-center">“Let's start with getting to know you better.
                What's <b>your name</b>?”</p>
            <div class="text-box mt-5 py-3">
                <span class="text-icon"><img src="{{URL::asset('public/images/user-icon.png')}}"></span>
                <input type="text" name="user_name" id="user_name" placeholder="Hi, this is Rohit / Seema…" onkeypress="return lettersOnly(event)" autocomplete="off" />
            </div>
            <span class="invalid-feedback m-0" role="alert" id="errlog_name"> </span>

            <div class="text-center mt-5">
                <button type="button" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-mobile-btn">Go Next</button>
            </div>

        </div>

        <div class="ms-auto login-box me-auto" id="email-box">
            <!-- <div><a href="#" class="back-btn" id="backname"><img src="{{URL::asset('public/images/back-btn.png')}}"></a></div> -->
            <div class="welcome-heading">Welcome to UniQ </div>
            <p class="welcome-msg text-center">“Sign-up using your email address and mobile number.” </p>
            <div class="text-box mt-4">
                <span class="text-icon"><img src="{{URL::asset('public/images/mail.png')}}"></span>
                <input type="email" placeholder="Email address" name="email_add" minlength="8" maxlength="35" id="email_add" />
            </div>
            <span class="invalid-feedback m-0" role="alert" id="errlog_email"> </span>
            <div class="text-box mt-4">
                <span class="text-icon"><img src="{{URL::asset('public/images/user-icon.png')}}"></span>
                <input type="text" name="mobile_num" id="mobile_num" value="" minlength="10" maxlength="10" onkeypress="return isNumber(event)" placeholder="Mobile number" autocomplete="off" />
            </div>
            <span class="invalid-feedback m-0" role="alert" id="errlog_mob"> </span>
            <div class="text-center mt-5">
                <button type="button" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Send OTP</button>
            </div>
        </div>

        <div class="ms-auto login-box me-auto" id="otp-box">
            <!-- <div><a href="#" class="back-btn" id="backmobile"><img src="{{URL::asset('public/images/back-btn.png')}}"></a></div> -->
            <div class="welcome-heading">Welcome to UniQ </div>
            <p class="welcome-msg text-center">“You must have received an OTP from us in your inbox or message” </p>
            <div class="text-box mt-5 py-3">
                <span class="text-icon"><img src="{{URL::asset('public/images/mail.png')}}"></span>
                <input type="text" onkeypress="return isNumber(event)" name="reg_otp" id="reg_otp" minlength="5" maxlength="5" placeholder="Enter OTP" autocomplete="off" />
            </div>
            <span class="invalid-feedback m-0" role="alert" id="errlog_otp"> </span>
            <span class="invalid-feedback m-0" role="alert" id="errlog_auth"> </span>
            <div class="d-flex align-items-center mt-0">

                <span class="ms-auto" id="some_div"> </span>
            </div>
            <p id="resendOtp_link" class="text-center mt-4 mb-0 resend_otp">Didn’t get OTP? <a href="javascript:void(0);" onclick="resentOtp();">Resend</a></p>
            <div class="text-center mt-2"> <button class="btn btn-danger text-uppercase rounded-0 px-5" id="otp-verify-btn">Verify OTP</button></div>

        </div>
    </form>

    <div class="ms-auto login-box me-auto" id="otp-verify-box">

        <p class="welcome-msg text-center text-success">User registered successfully. </p>
        <p class="py-5 text-center"><img src="{{URL::asset('public/images/check.png')}}"></p>
        <div class="text-center mt-2"> <a href="{{ route('login') }}" class="btn btn-danger text-uppercase rounded-0 px-5  ">Back to login</a></div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script type="text/javascript">
    $('#resendOtp_link').hide();

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function lettersOnly(evt) {

        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
            ((evt.which) ? evt.which : 0));
        if (charCode > 32 && (charCode < 65 || charCode > 90) &&
            (charCode < 97 || charCode > 122)) {

            return false;
        }
        return true;
    }

    $(function() {

        $('#goto-mobile-btn').click(function() {
            var user_name = $("#user_name").val();
            if (user_name == '') {
                $("#errlog_name").html('Please enter your name');
                $("#errlog_name").fadeIn('fast');
                $("#errlog_name").fadeOut(5000);
                return false;
            } else {
                $('#name-box').addClass('close-box');
                $('#email-box').addClass('open-box');
            }

        });

        $('#goto-otp-btn').click(function() {
            $check = 0;
            var email_add = $("#email_add").val();


            if (email_add == '') {
                $("#errlog_email").html('Please enter your email address');
                $("#errlog_email").fadeIn('fast');
                $("#errlog_email").fadeOut(5000);
                $check = 1;
            } else {
                var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                if (testEmail.test(email_add)) {} else {
                    $("#errlog_email").html('Please enter valid email address');
                    $("#errlog_email").fadeIn('fast');
                    $("#errlog_email").fadeOut(5000);
                    $check = 1;
                };
            }

            var mobile_num = $("#mobile_num").val();
            if (mobile_num == '') {
                $("#errlog_mob").html('Please enter your mobile number');
                $("#errlog_mob").fadeIn('fast');
                $("#errlog_mob").fadeOut(5000);
                $check = 1;
            } else {
                //var testMobile = /^\d{10}$/;
                var testMobile = /^[7-9][0-9]{9}$/;
                if (testMobile.test(mobile_num)) {} else {
                    $("#errlog_mob").html('Please enter valid mobile number');
                    $("#errlog_mob").fadeIn('fast');
                    $("#errlog_mob").fadeOut(5000);
                    $check = 1;
                };
            }
            if ($check == 1) {
                return false;
            } else {
                $.ajax({
                    url: "{{ route('sendotpsignup') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        mobile: mobile_num,
                        email: email_add,
                    },
                    success: function(response_data) {
                        // console.log(response_data);
                        var response = jQuery.parseJSON(response_data);

                        if (response.success == true) {
                            $('#email-box').addClass('close-box');
                            $('#otp-box').addClass('open-box');

                            resentOtpTime();
                        } else {
                            $("#errlog_mob").html(response.message);
                            $("#errlog_mob").fadeIn('slow');
                            $("#errlog_mob").fadeOut(10000);
                            return false;
                        }

                    },
                });
            }


        });

        $('#backname').click(function() {
            $('#name-box').removeClass('close-box');
            //$('#otp-box').addClass('close-box');
            $('#email-box').removeClass('open-box');

        });

        $('#backmobile').click(function() {
            $('#email-box').removeClass('close-box');
            //$('#otp-box').addClass('close-box');
            $('#otp-box').removeClass('open-box');

        });

        /* $('#otp-verify-btn').click(function() {

            $('#otp-verify-box').addClass('open-box');
            $('#otp-box').addClass('close-box');
        }); */

        $('#set-pwd').click(function() {

            $('#set-password-box').addClass('open-box');
            $('#otp-verify-box').addClass('close-box');
        });

        /* Mobile otp authentications */

        $("#studentsignup").validate({
            rules: {
                reg_otp: {
                    required: true,
                },
            },
            messages: {
                "reg_otp": {
                    required: "Please, enter OTP"
                }
            },
            errorElement: 'div',
            errorLabelContainer: '#errlog_otp',
            submitHandler: function(form) {

                var user_name = $("#user_name").val();
                var email_add = $("#email_add").val();
                var mobile_num = $("#mobile_num").val();
                var reg_otp = $("#reg_otp").val();


                $.ajax({
                    url: "{{ url('/verifyOtpRegister') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        reg_otp: reg_otp,
                        email_add: email_add,
                        user_name: user_name,
                        mobile_num: mobile_num,
                    },
                    beforeSend: function() {},
                    success: function(response_data) { //debugger;
                        var response = jQuery.parseJSON(response_data);
                        if (response.status == 400) {
                            if (response.error) {
                                var errormsg = $("#errlog_auth").show();

                                errormsg[0].textContent = response.error;
                                setTimeout(function() {
                                    $('#errlog_auth').fadeOut('fast');
                                }, 10000);
                            }
                            return false
                        } else {
                            //$('#otp-verify-box').addClass('open-box');
                            $('#otp-box').addClass('close-box');
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url
                            }
                        }

                    },
                    error: function(xhr, b, c) {
                        console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                    }
                });
            }

        });


    });

    function resentOtpTime() {
        var timeLeft = 180;
        var elem = document.getElementById('some_div');
        var timerId = setInterval(countdown, 1000);

        function countdown() {

            if (timeLeft == -1) {
                clearTimeout(timerId);
                $('#resendOtp_link').show();
                $('#some_div').hide();
                //sentotplogin();
                //$('#goto-otp-btn').click();

            } else {
                $('#some_div').show();
                // elem.innerHTML = 'Resend OTP in <a href="javascript:void(0);"  class="forgot ">' + timeLeft + ' sec </a>';
                elem.innerHTML = 'Resend OTP in ' + timeLeft + ' sec ';
                timeLeft--;
            }

        }

    }

    function resentOtp() {
        $('#goto-otp-btn').click();
    }

    $('#user_name').bind("cut copy paste", function(e) {
        e.preventDefault();
    });
</script>
@endsection