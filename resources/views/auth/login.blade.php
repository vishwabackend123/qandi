@extends('layouts.app')

@section('content')
<section class="login-bg-img">

    <span class="outer-logo"><a href="{{url('/')}}" target="_blank"><img src="{{URL::asset('public/images_new/QI_Logo.gif')}}" alt="logo not find"></a></span>
    <div class="login_screen">
        <p class="mb-0">Welcome to UniQ</p>
        <p>Please login using your registered email/ Mobile number</p>
        <div class="pt-3 login-screen">
            <form id="studentlogin" method="post">
                {{-- @csrf --}}
                <div id="mobile_input">
                    <div class="form-group flds">
                        <input type="text" class="form-control m-email" name="login_mobile" id="mobile_num" placeholder="Mobile number/email ID" autocomplete="off">
                        <span class="error-sms mobil-not-valid" id="errlog_mob">Please entered registered email/mobile number</span>
                        <span class="error-sms email-not-valid">Please sign up first or check the email or mobile you have provided</span>

                    </div>
                    <div class="clearfix"></div>
                    <div class="sign-btn"><button type="button" onclick="sentotplogin()" id="mobile-input-btn" disabled class="next-btn btn btn-primary disbaled-btn active-btn text-uppercase">NEXT</button></div>

                </div>

                <div id="input-otp-box" style="display:none">
                    <div class="form-group flds">
                        <input type="text" class="form-control pass disable-value" name="login_otp" id="otp_num" placeholder="Enter OTP" minlength="5" maxlength="5" onkeypress="return isNumber(event)" autocomplete="off">
                        <span class="error-sms enter-otp" id="errlog_otp">Please, enter OTP</span>
                        <span class="error-sms wrong-otp" id="errlog_auth">You have entered a wrong OTP. Please try again
                        </span>
                    </div>
                    <p class="text-right" id="wait_otp_div">Resend OTP in 180 sec</p>
                    <div class="clearfix"></div>
                    <p id="resendOtp_link" class="text-center mt-4 mb-0">Didn’t get OTP? <a href="javascript:void(0);" onclick="sentotplogin();">Resend</a></p>
                    <div class="sign-btn"><button type="submit" id="otp-verify-btn" disabled class="btn btn-primary disbaled-btn active-btn text-uppercase">Sign in</button></div>
                </div>
                <p>Don’t have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </form>
        </div>
    </div>
    <!--login_screen-->
</section>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{URL::asset('public/js/jquery-3.2.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/bootstrap.min.js')}}"></script>

<script>
    $('#resendOtp_link').hide();


    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    $('#mobile_num').keyup(function() {
        var value = this.value;
        var length = value.length;
        if (value != '') {
            $('#mobile-input-btn').removeAttr("disabled");
            $('#mobile-input-btn').removeClass("disbaled-btn");
        } else {
            $('#mobile-input-btn').attr('disabled', 'disabled');
            $('#mobile-input-btn').addClass("disbaled-btn");
        }
    });

    $('#otp_num').keyup(function() {
        var value = this.value;
        var length = value.length;
        if (value != '' && length == 5) {
            $('#otp-verify-btn').removeAttr("disabled");
            $('#otp-verify-btn').removeClass("disbaled-btn");
        } else {
            $('#otp-verify-btn').attr('disabled', 'disabled');
            $('#otp-verify-btn').addClass("disbaled-btn");
        }
    });

    function sentotplogin() {
        var mobile = $("#mobile_num").val();
        if (mobile == '') {
            $("#errlog_mob").html('Please entered registered email/mobile number');
            $("#errlog_mob").fadeIn('fast');
            $("#errlog_mob").fadeOut(5000);
            return false;
        }
        /*  if (mobile.length != 10) {
             $("#errlog_mob").html('Please Enter valid mobile number');
             $("#errlog_mob").fadeIn('fast');
             $("#errlog_mob").fadeOut(5000);
             return false;
         } */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('sendotplogin') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                mobile: mobile,
            },
            success: function(response_data) {

                var response = jQuery.parseJSON(response_data);

                if (response.success == true) {
                    $("#mobile-input-btn").hide();
                    $("#input-otp-box").show();
                    $('#resendOtp_link').hide();
                    //$("#input-otp-box").show();

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

    function resentOtpTime() {
        var timeLeft = 180;
        var elem = document.getElementById('wait_otp_div');
        var timerId = setInterval(countdown, 1000);

        function countdown() {

            if (timeLeft == -1) {
                clearTimeout(timerId);
                $('#resendOtp_link').show();
                $('#wait_otp_div').hide();
                /*  sentotplogin(); */
            } else {
                $('#wait_otp_div').show();
                //elem.innerHTML = 'Resend OTP in <a href="#" class="forgot ">' + timeLeft + ' sec </a>';
                elem.innerHTML = 'Resend OTP in ' + timeLeft + ' sec ';
                timeLeft--;
            }

        }

    }


    $(document).ready(function() {
        $("#studentlogin").validate({
            rules: {
                login_mobile: {
                    required: true,
                },
                login_otp: {
                    required: true,
                },
            },
            messages: {
                "login_otp": {
                    required: "Please, enter OTP!"
                },
                "login_mobile": {
                    required: "Please entered registered email/mobile number."
                }
            },
            errorElement: 'div',
            errorLabelContainer: '#errlog_otp',
            submitHandler: function(form) {

                var login_mobile = $("#mobile_num").val();
                var login_otp = $("#otp_num").val();


                $.ajax({
                    url: "{{ url('/verifyotplogin') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        login_mobile: login_mobile,
                        login_otp: login_otp,
                    },
                    beforeSend: function() {},

                    success: function(response_data) { //debugger;

                        var response = jQuery.parseJSON(response_data);
                        if (response.status == 400) {
                            if (response.error) {
                                var errormsg = $("#errlog_auth").show();
                                errormsg[0].textContent = response.message;
                                setTimeout(function() {
                                    $('#errlog_auth').fadeOut('fast');
                                }, 10000);
                            }
                        } else {

                            var previousUrl = '{{ url()->previous() }}';
                            //
                            if ((previousUrl.includes('subscriptions') == true) || (previousUrl.includes('trial_subscription') == true)) {

                                window.location.href = '{{url("subscriptions")}}';
                            } else {
                                window.location.href = '{{url("dashboard")}}';
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
</script>

@endsection