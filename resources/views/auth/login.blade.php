@extends('layouts.app')
@section('content')
<script type="text/javascript">
    window.addEventListener("pageshow", function ( event ) {
  var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    window.location.reload();
  }
});

</script>

<body style="background: #f5faf6;">
    <section class="d-flex login-signup">
        <div class="left-sidepannel d-flex flex-column justify-content-between position-relative">
            <figure class="pb-4">
                <a href="{{env('CMS_URL')}}" target="_blank">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#dxjwe095ea)">
                            <path d="M28 4.8H8.8V24H28V4.8zM47.195 24.001h-19.2v19.2h19.2V24z" fill="#38D430" />
                            <path d="M47.195 4.8h-19.2V24h19.2V4.8z" fill="#00AB16" />
                            <path d="m39.82 18.625 1.614 1.664h1.864L40.702 17.6l1.664-1.93v-1.928l-2.546 2.944-2.446-2.53.716-.511c.832-.616 1.664-1.431 1.664-2.596 0-1.68-1.28-2.795-3.029-2.795-1.514 0-2.995 1.081-2.995 2.878 0 1.099.816 1.98 1.365 2.56l.35.366-.234.167c-1.248.915-2.063 1.792-2.063 3.278 0 1.514 1.165 3.013 3.328 3.013 1.331 0 2.346-.75 3.344-1.892zm-4.692-7.578a1.565 1.565 0 0 1 1.597-1.597c.982 0 1.631.699 1.631 1.564 0 .583-.25 1.082-.965 1.598l-.882.665-.466-.499c-.449-.45-.915-1.048-.915-1.73zm-.582 6.34c0-.915.532-1.497 1.181-1.98l.583-.45 2.645 2.746-.1.117c-.682.782-1.43 1.398-2.362 1.398-1.215 0-1.947-.916-1.947-1.83zm-10.034-2.986a6.124 6.124 0 1 0-6.134 6.144 5.962 5.962 0 0 0 3.5-1.178l1.007 1.011h2.91l-2.46-2.47a6 6 0 0 0 1.177-3.507zm-2.762 1.92-1.674-1.68h-2.91l3.136 3.15a3.919 3.919 0 1 1 1.448-1.47zm12.208 11.392h7.296v2.159h-2.498v7.458h2.488v2.158h-7.296v-2.155h2.504v-7.458h-2.494v-2.162z" fill="#1F1F1F" />
                        </g>
                        <defs>
                            <filter id="dxjwe095ea" x=".8" y=".8" width="54.395" height="54.401" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dy="4" />
                                <feGaussianBlur stdDeviation="4" />
                                <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                                <feBlend in2="BackgroundImageFix" result="effect1_dropShadow_757_2052" />
                                <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dy="4" />
                                <feGaussianBlur stdDeviation="4" />
                                <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                                <feBlend in2="effect1_dropShadow_757_2052" result="effect2_dropShadow_757_2052" />
                                <feBlend in="SourceGraphic" in2="effect2_dropShadow_757_2052" result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </a>
            </figure>
            <div class="">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{URL::asset('public/after_login/current_ui/images/Subject-performance.svg')}}" alt="performance" class="w-100 d-block">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="pb-2">MyQ Today</h5>
                                <p>Check out your progress and see what percentage of <br> subjects you are doing well in </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{URL::asset('public/after_login/current_ui/images/progress-jer.svg')}}" alt="performance" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="pb-2">Progress Journey</h5>
                                <p>Track your progress visually with a graph that <br> shows you your ideal and actual pace</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{URL::asset('public/after_login/current_ui/images/weekly.svg')}}" alt="performance" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="pb-2">Weekly Plan</h5>
                                <p>Check your proficiency in different subjects by planning <br>weekly tests for any chapters </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{URL::asset('public/after_login/current_ui/images/Task-center.svg')}}" alt="performance" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="pb-2">Task Center</h5>
                                <p>To assess your readiness, set daily or weekly tasks to<br> evaluate your skills </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-seidepannel d-md-flex d-block flex-column justify-content-center position-relative allscrollbar loginrightpannel">
            <figure class="pb-md-4 pb-3 d-md-none d-block mobilelogo">
                <a href="{{env('CMS_URL')}}">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#dxjwe095ea)">
                            <path d="M28 4.8H8.8V24H28V4.8zM47.195 24.001h-19.2v19.2h19.2V24z" fill="#38D430" />
                            <path d="M47.195 4.8h-19.2V24h19.2V4.8z" fill="#00AB16" />
                            <path d="m39.82 18.625 1.614 1.664h1.864L40.702 17.6l1.664-1.93v-1.928l-2.546 2.944-2.446-2.53.716-.511c.832-.616 1.664-1.431 1.664-2.596 0-1.68-1.28-2.795-3.029-2.795-1.514 0-2.995 1.081-2.995 2.878 0 1.099.816 1.98 1.365 2.56l.35.366-.234.167c-1.248.915-2.063 1.792-2.063 3.278 0 1.514 1.165 3.013 3.328 3.013 1.331 0 2.346-.75 3.344-1.892zm-4.692-7.578a1.565 1.565 0 0 1 1.597-1.597c.982 0 1.631.699 1.631 1.564 0 .583-.25 1.082-.965 1.598l-.882.665-.466-.499c-.449-.45-.915-1.048-.915-1.73zm-.582 6.34c0-.915.532-1.497 1.181-1.98l.583-.45 2.645 2.746-.1.117c-.682.782-1.43 1.398-2.362 1.398-1.215 0-1.947-.916-1.947-1.83zm-10.034-2.986a6.124 6.124 0 1 0-6.134 6.144 5.962 5.962 0 0 0 3.5-1.178l1.007 1.011h2.91l-2.46-2.47a6 6 0 0 0 1.177-3.507zm-2.762 1.92-1.674-1.68h-2.91l3.136 3.15a3.919 3.919 0 1 1 1.448-1.47zm12.208 11.392h7.296v2.159h-2.498v7.458h2.488v2.158h-7.296v-2.155h2.504v-7.458h-2.494v-2.162z" fill="#1F1F1F" />
                        </g>
                        <defs>
                            <filter id="dxjwe095ea" x=".8" y=".8" width="54.395" height="54.401" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dy="4" />
                                <feGaussianBlur stdDeviation="4" />
                                <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                                <feBlend in2="BackgroundImageFix" result="effect1_dropShadow_757_2052" />
                                <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dy="4" />
                                <feGaussianBlur stdDeviation="4" />
                                <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                                <feBlend in2="effect1_dropShadow_757_2052" result="effect2_dropShadow_757_2052" />
                                <feBlend in="SourceGraphic" in2="effect2_dropShadow_757_2052" result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </a>
            </figure>
            <div class="loginform m-auto">
                <h1 class="pb-2 mb-1">Log In</h1>
                <p>Don’t have an account? <a href="{{ route('register') }}">Sign Up</a></p>
                <form id="studentlogin" method="post">
                    <div class="custom-input changeno pb-4">
                        <label>Mobile</label>
                        <div class="d-flex position-relative">
                            <input type="text" maxlength="10" class="form-control bg-white" name="login_mobile" id="mobile_num" placeholder="Mobile no." onkeypress="return isNumber(event)" oninput="process(this)">
                            <a class="d-none bg-white editnumber" href="javascript:void(0);">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 13.333h6M11 2.333a1.414 1.414 0 1 1 2 2l-8.333 8.334L2 13.333l.667-2.666L11 2.333z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                &nbsp;Change
                            </a>
                        </div>
                        <div class="error d-none mt-2 w-100" id="errlog_mob">Please enter valid Mobile no.</div>
                        <!-- for automation testing -->
                        <div class="d-none" id="testing_otp"></div>
                        <!-- for automation testing -->
                    </div>
                    <div class="custom-input pb-5 verify_otp">
                        <label>Enter OTP</label>
                        <div class="d-flex enterotp bg-white">
                            <input class="form-control otp_num" maxlength="1" id="opt_one" onkeypress="return isNumber(event)">
                            <input class="form-control otp_num" maxlength="1" id="opt_two" onkeypress="return isNumber(event)">
                            <input class="form-control otp_num" maxlength="1" id="opt_three" onkeypress="return isNumber(event)">
                            <input class="form-control otp_num" maxlength="1" id="opt_four" onkeypress="return isNumber(event)">
                            <input class="form-control otp_num" maxlength="1" id="opt_five" onkeypress="return isNumber(event)">
                        </div>
                        <div>
                            <p class="p-0 mt-2 resend resend_again">Didn’t get the code?
                                <a class="resendweight float-right" href="javascript:void(0);" onclick="sentotplogin('resend')">Resend OTP</a>
                            </p>
                            <p class="p-0 mt-2 resend resend_timer">Resend OTP in <span id="wait_otp_div">00:59</span>
                                <a class="resendweight float-right resendcolorchan" href="javascript:void(0);">Resend OTP</a>
                            </p>
                            <span class="mt-2 d-none" id="resend_opt_msg" style="color: green;">Resend OTP sent successfully</span>
                            <span class="error d-none mt-2" id="errlog_auth">You have entered a wrong OTP. Please try again</span>
                        </div>
                    </div>
                    <div class="Get-otp pt-4">
                        <button type="button" onclick="sentotplogin('send')" id="mobile-input-btn" class="btn btn-common-green text-white w-100 disabled" disabled>Get OTP</button>
                        <button type="button" id="otp-verify-btn" class="btn btn-common-green text-white w-100 disabled" onclick="verifyTop()" disabled><span>Verify OTP</span></button>
                    </div>
                </form>
            </div>
            <h3 class="copyright text-center position-absolute mt-md-0 mt-3 pb-md-0 pb-3">&copy 2022 Q&I. All rights reserved.</h3>
        </div>
    </section>
    <script type="text/javascript">
        $('.verify_otp').hide();
        $('#otp-verify-btn').hide();
        $('.resend_again').hide();
        var timerId = '';

        $(document).ready(function() {
            var input = document.getElementById("mobile_num");
            input.addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    var input_value=$('#mobile_num').val();
                    if (input_value != '' && input_value.length == 10) {
                        sentotplogin('send');
                    }else
                    {
                        $("#errlog_mob").removeClass("d-none");
                        $("#errlog_mob").html('Please enter at least 10 characters.');
                        $("#errlog_mob").fadeIn('fast');
                        $("#errlog_mob").fadeOut(5000);
                    }
                }
            });
            $("#studentlogin").submit(function(e) {
                e.preventDefault();
            });
            $('#mobile_num').on("change keyup paste contextmenu input", function(evt) {
                var value = this.value;
                var length = value.length;
                if (value != '' && length == 10) {
                    $('#mobile-input-btn').removeAttr("disabled");
                    $('#mobile-input-btn').removeClass("disabled");
                } else {
                    $('#mobile-input-btn').attr('disabled', 'disabled');
                    $('#mobile-input-btn').addClass("disabled");
                }
            });
            $('.otp_num').on("change keyup paste contextmenu input", function(e) {
                var opt_one = $('#opt_one').val();
                var mobile_num = $('#mobile_num').val();
                var opt_two = $('#opt_two').val();
                var opt_three = $('#opt_three').val();
                var opt_four = $('#opt_four').val();
                var opt_five = $('#opt_five').val();
                alert(e.which);
                if ((e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)) {
                    $(e.target).next('.otp_num').focus();
                } else if (e.which == 8) {
                    $(e.target).prev('.otp_num').focus();
                }
                if (e.which == 37) {
                    $(e.target).prev('.otp_num').focus();
                }
                if (e.which == 39) {
                    $(e.target).next('.otp_num').focus();
                }
                if (mobile_num != '' && opt_one != '' && opt_two != '' && opt_three != '' && opt_four != '' && opt_five != '') {
                    $('#otp-verify-btn').removeAttr("disabled");
                    $('#otp-verify-btn').removeClass("disabled");
                } else {
                    $('#otp-verify-btn').attr('disabled', 'disabled');
                    $('#otp-verify-btn').addClass("disabled");
                }
                if (opt_one) {
                    $('#opt_one').attr('style', 'border: 1px solid #56b66380 !important;');
                } else {
                    $('#opt_one').attr('style', 'border: 0.5px solid #d0d5dd !important');
                }
                if (opt_two) {
                    $('#opt_two').attr('style', 'border: 1px solid #56b66380 !important;');
                } else {
                    $('#opt_two').attr('style', 'border: 0.5px solid #d0d5dd !important');
                }
                if (opt_three) {
                    $('#opt_three').attr('style', 'border: 1px solid #56b66380 !important;');
                } else {
                    $('#opt_three').attr('style', 'border: 0.5px solid #d0d5dd !important');
                }
                if (opt_four) {
                    $('#opt_four').attr('style', 'border: 1px solid #56b66380 !important;');
                } else {
                    $('#opt_four').attr('style', 'border: 0.5px solid #d0d5dd !important');
                }
                if (opt_five) {
                    $('#opt_five').attr('style', 'border: 1px solid #56b66380 !important;');
                } else {
                    $('#opt_five').attr('style', 'border: 0.5px solid #d0d5dd !important');
                }
            });
            $('.editnumber').click(function() {
                $('#mobile_num').prop("readonly", false);
                $(this).hide();
                $("#mobile-input-btn").show();
                $('.verify_otp').hide();
                $('#otp-verify-btn').attr('disabled', 'disabled');
                $('#otp-verify-btn').addClass("disabled");
                $('#otp-verify-btn').hide();
                $('#opt_one').val('');
                $('#opt_one').attr('style', 'border: 0.5px solid #d0d5dd !important');
                $('#opt_two').val('');
                $('#opt_two').attr('style', 'border: 0.5px solid #d0d5dd !important');
                $('#opt_three').val('');
                $('#opt_three').attr('style', 'border: 0.5px solid #d0d5dd !important');
                $('#opt_four').val('');
                $('#opt_four').attr('style', 'border: 0.5px solid #d0d5dd !important');
                $('#opt_five').val('');
                $('#opt_five').attr('style', 'border: 0.5px solid #d0d5dd !important');
                clearTimeout(timerId);
                $('#wait_otp_div').text('00:59');
            });
            $(document).keypress(function(e) {
                if (e.keyCode === 13) {
                    if ($('#otp-verify-btn').css('display') != 'none' && $('#otp-verify-btn').hasClass('disabled') != true) {
                        verifyTop();
                    }
                }
            });

        });

        function sentotplogin(otp_type) {
            $('#opt_one').val('');
            $('#opt_two').val('');
            $('#opt_three').val('');
            $('#opt_four').val('');
            $('#opt_five').val('');

            var mobile = $("#mobile_num").val();
            if (mobile == '') {
                $("#errlog_mob").html('Please entered registered mobile number');
                $("#errlog_mob").fadeIn('fast');
                $("#errlog_mob").fadeOut(5000);
                return false;
            }
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
                    console.log(response);
                    if (response.success == true) {
                        $('#mobile_num').prop('readonly', true);
                        $('.editnumber').removeClass("d-none");
                        $('.editnumber').show();
                        $("#mobile-input-btn").hide();
                        $('.verify_otp').show();
                        $('#otp-verify-btn').show();
                        //if (response.otp) {
                            //$('#testing_otp').html(response.otp);
                        //}
                        if (otp_type == 'resend') {
                            $('#opt_one').val('');
                            $('#opt_two').val('');
                            $('#opt_three').val('');
                            $('#opt_four').val('');
                            $('#opt_five').val('');
                        }
                        resentOtpTime();

                    } else {
                        $("#errlog_mob").removeClass("d-none");
                        $("#errlog_mob").html(response.message);
                        $("#errlog_mob").fadeIn('slow');
                        $("#errlog_mob").fadeOut(10000);
                        return false;
                    }

                },
            });

        }

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function verifyTop() {

            var login_mobile = $("#mobile_num").val();
            var login_otp = '';
            $(".otp_num").each(function(index) {
                login_otp = login_otp + $(this).val()
            });


            $.ajax({
                url: "{{ url('/verifyotplogin') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    login_mobile: login_mobile,
                    login_otp: login_otp,
                },
                beforeSend: function() {},

                success: function(response_data) {

                    var response = jQuery.parseJSON(response_data);
                    if (response.status == 400) {
                        if (response.error) {
                            $('#errlog_auth').removeClass("d-none");
                            $("#errlog_auth").text(response.message);
                            $('#errlog_auth').removeClass("d-none");
                            $("#errlog_auth").fadeIn('slow');
                            $("#errlog_auth").fadeOut(10000);

                        }
                    } else {
                        var previousUrl = '{{ url()->previous() }}';
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
        document.addEventListener("paste", function(e) {
            if (e.target.type === "text") {
                var data = e.clipboardData.getData('Text');
                if(!isNaN(data)){
                     data = data.split('');
                    [].forEach.call(document.querySelectorAll(".otp_num"), (node, index) => {
                        node.value = data[index];
                    });
                }else
                {
                    return false;
                }
               
            }
        });

        function resentOtpTime() {
            $('.resend_again').hide();
            var timeLeft = 58;
            var elem = document.getElementById('wait_otp_div');
            timerId = setInterval(countdown, 1000);

            function countdown() {

                if (timeLeft == -1) {
                    clearTimeout(timerId);
                    $('.resend_again').show();
                    $('.resend_timer').hide();
                } else {
                    $('.resend_timer').show();
                    elem.innerHTML = "00:" + timeLeft;
                    timeLeft--;
                }

            }

        }
        function process(input){
            let value = input.value;
            let numbers = value.replace(/[^0-9]/g, "");
            input.value = numbers;
        }
    </script>
</body>
@endsection