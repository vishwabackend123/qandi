@extends('layouts.app')

@section('content')
<section class="login-bg-img">

    <span class="outer-logo"><a href="#"><img src="{{URL::asset('public/images_new/uniq.png')}}" alt="logo not find"></a></span>
    <div class="login_screen">

        <form id="studentsignup" method="post">
            {{-- @csrf --}}
            <div id="name-box">
                <p class="mb-0">Welcome to UniQ</p>
                <p>“Let's start with getting to know you better. What's your name?”</p>
                <div class="pt-3">
                    <div class="form-group flds">
                        <input type="text" class="form-control m-email" name="user_name" id="user_name" placeholder="Hi, this is Rohit / Seema…" onkeypress="return lettersOnly(event)" autocomplete="off" s>
                        <span class="error-sms mobil-not-valid" id="errlog_name">Please entered your name</span>
                        <span class="error-sms email-not-valid">Please sign up first or check the email or mobile you have provided</span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="sign-btn"><button type="button" id="goto-mobile-btn" disabled class="btn btn-primary disbaled-btn active-btn text-uppercase">go next</button></div>
                </div>
            </div>

            <div id="email-box">
                <p class="mb-0">Welcome to UniQ</p>
                <p>“Sign-up using your email address and mobile number.”</p>
                <div class="pt-3">
                    <div class="form-group flds">
                        <input type="text" class="form-control email-addrs disable-value" placeholder="Enter address" name="email_add" minlength="8" maxlength="35" id="email_add" autocomplete="off">
                        <span class="error-sms enter-otp" id="errlog_email">Please enter your email address</span>
                    </div>

                    <div class="form-group flds">
                        <input type="text" class="form-control m-email" name="mobile_num" id="mobile_num" value="" minlength="10" maxlength="10" onkeypress="return isNumber(event)" placeholder="Mobile number" autocomplete="off">
                        <span class="error-sms mobil-not-valid" id="errlog_mob">Please enter your mobile number</span>

                    </div>
                    <div class="clearfix"></div>
                    <div class="sign-btn"><button type="button" id="goto-otp-btn" class="btn btn-primary disbaled-btn active-btn text-uppercase">Next</button></div>
                </div>

            </div>

            <div id="otp-box">
                <p class="mb-0">Welcome to UniQ</p>
                <p>"You must have received an OTP from us in your inbox or message"</p>
                <div class="pt-3">
                    <div class="form-group flds">
                        <input type="text" class="form-control pass disable-value" onkeypress="return isNumber(event)" name="reg_otp" id="reg_otp" minlength="5" maxlength="5" placeholder="Enter OTP" autocomplete="off">
                        <span class="error-sms enter-otp" id="errlog_otp"></span>
                        <span class="error-sms wrong-otp" id="errlog_auth"></span>
                    </div>
                    <p id="resendOtp_link" class="text-right">Resend OTP in 180 sec</p>
                    <div class="clearfix"></div>
                    <p class="text-center mt-4 mb-0">Didn’t get OTP? <a href="javascript:void(0);" onclick="resentOtp();">Resend</a></p>
                    <div class="sign-btn"><button type="submit" class="btn btn-primary disbaled-btn active-btn text-uppercase" id="otp-verify-btn">Sign Up</button></div>
                </div>
            </div>
        </form>

    </div>
    <!--login_screen-->
</section>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{URL::asset('public/js/jquery-3.2.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/bootstrap.min.js')}}"></script>

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

    $('#user_name').keyup(function() {
        var value = this.value;
        var length = value.length;
        if (value != '') {
            $('#goto-mobile-btn').removeAttr("disabled");
            $('#goto-mobile-btn').removeClass("disbaled-btn");
        } else {
            $('#goto-mobile-btn').attr("disabled");
            $('#goto-mobile-btn').addClass("disbaled-btn");
        }
    });


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