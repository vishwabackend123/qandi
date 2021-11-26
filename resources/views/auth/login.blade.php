@extends('layouts.app')

@section('content')
<nav class="py-0 px-7 navbar navbar-expand-lg trans-navbar">
    <div class="container-fluid"><a class="navbar-brand" href="{{url('/')}}"><img src="{{URL::asset('public/images/main-logo.png')}}" class="img-fluid" /></a></div>
</nav>
<div id="main">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(window).on("load resize scroll", function(e) {
            var winHeight = $(window).height() - 40;
            $('.pageBg').height(winHeight);

        });
    </script>

    <div class="ms-auto login-box me-auto" id="name-box">

        <div class="welcome-heading">Welcome to UniQ</div>
        <div class="welcome-msg">Please login using your registered email/ Mobile number </div>
        <form id="studentlogin" method="post">
            {{-- @csrf --}}
            <div id="mobile_input">
                <div class="text-box mt-5">
                    <span class="text-icon"><img src="{{URL::asset('public/images/user-icon.png')}}"></span>
                    <input type="text" name="login_mobile" id="mobile_num" value="" autocomplete="off" placeholder="Mobile number / e-mail ID" />

                </div>
                <span class="invalid-feedback m-0" role="alert" id="errlog_mob"> </span>

                <div class="text-center mt-5" id="mobile-input-btn">
                    <button type="button" class="btn btn-danger text-uppercase rounded-0 px-5  " onclick="sentotplogin()">Next
                    </button>
                </div>
            </div>

            <div id="input-otp-box" style="display:none">
                <div class="text-box py-3">
                    <span class="text-icon"><img src="{{URL::asset('public/images/mail.png')}}"></span>
                    <input type="text" name="login_otp" id="otp_num" placeholder="Enter OTP" minlength="5" maxlength="5" onkeypress="return isNumber(event)" autocomplete="off" />
                </div>
                <span class="invalid-feedback m-0" role="alert" id="errlog_otp"> </span>
                <span class="invalid-feedback m-0" role="alert" id="errlog_auth"> </span>
                <div class="d-flex align-items-center mt-0">
                    <span class="ms-auto" id="wait_otp_div"> </span>
                </div>
                <p id="resendOtp_link" class="text-center mt-4 mb-0">Didn’t get OTP? <a href="javascript:void(0);" onclick="sentotplogin();">Resend</a></p>
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="otp-verify-btn">
                        Sign In
                    </button>
                </div>
            </div>
        </form>

        {{-- <p class="text-center login-txt">OR <br>Login using</p>
        <div class="text-center"><a href="{{ url('auth/google') }}" class="mx-4"><img src="{{URL::asset('public/images/google.png')}}"></a>
        <a href="{{ url('auth/facebook') }}" class="mx-4"><img src="{{URL::asset('public/images/facebook.png')}}"></a>
    </div>--}}
    <p class="text-center mt-4 mb-0">Don’t have an account? <a href="{{ route('register') }}">Sign up</a></p>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>


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

    function sentotplogin() {
        var mobile = $("#mobile_num").val();
        if (mobile == '') {
            $("#errlog_mob").html('Please Enter registered email/ Mobile number ');
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
                console.log(response_data);
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
                    required: "Please, enter OTP"
                },
                "login_mobile": {
                    required: "Please, enter OTP"
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