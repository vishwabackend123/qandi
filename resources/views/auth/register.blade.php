@extends('layouts.app')
@section('content')

<?php 
    if( isset( $_SESSION['SECRET_REDIS'] ) ) {
      $redis_data = $_SESSION['SECRET_REDIS'];
   }
?>

<!-- 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                                <h5 class="pb-2">Progress journey</h5>
                                <p>Track your progress visually with a graph that <br> shows you your ideal and actual pace</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{URL::asset('public/after_login/current_ui/images/weekly.svg')}}" alt="performance" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="pb-2">Weekly plan</h5>
                                <p>Check your proficiency in different subjects by planning <br>weekly tests for any chapters </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{URL::asset('public/after_login/current_ui/images/Task-center.svg')}}" alt="performance" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="pb-2">Task center</h5>
                                <p>To assess your readiness, set daily or weekly tasks to<br> evaluate your skills </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-seidepannel d-md-flex d-block flex-column justify-content-start position-relative allscrollbar signuprightpannel">
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
                <h1 class="pb-2 mb-1">Sign Up</h1>
                <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
                <form id="studentsignup" method="post">
                    @csrf
                    <input type="hidden" name="refer_code" id="refer_code" value="{{$referral_code ?? ''}}">
                    <input type="hidden" name="refer_email" id="referral_email" value="{{$referral_email ?? ''}}">
                    <input type="hidden" name="state" id="state_name" value="">
                    <input type="hidden" name="city" id="city_name" value="">
                    <div class="custom-input pb-3">
                        <label>Name </label>
                        <input type="text" name="user_name" id="user_name" class="form-control reqrd txtOnlySpace" placeholder="Name" maxlength="25" onkeypress="return onlyAlphabetsDisplay(event,this);" onpaste="validatePaste(this, event)" required>
                    </div>
                    <div class=" custom-input changeno pb-3 ">
                        <label>Mobile</label>
                        <div class="d-flex position-relative" id="mobile_num_box">
                            <input type="text" maxlength="10" class="form-control bg-white reqrd" placeholder="Mobile no." name="mobile_num" id="mobile_num" onkeypress="return isNumber(event)">
                            <span class="position-absolute  sentotp d-none" id="otpsentmsg">OTP sent</span>
                            <a class="editnumber  d-none" id="verifynum" href="javascript:void(0);">Verify</a>
                            <a class="editnumber bg-white d-none" href="javascript:void(0);" id="editsignnumber">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 13.333h6M11 2.333a1.414 1.414 0 1 1 2 2l-8.333 8.334L2 13.333l.667-2.666L11 2.333z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                &nbsp;Edit
                            </a>
                        </div>
                        <span class="error mt-2" id="err_reg_mob"></span>
                        <!-- for automation testing -->
                        <div class="d-none" id="testing_otp"></div>
                        <!-- for automation testing -->
                    </div>
                    <div class="custom-input pb-3 otp-input" style="display:none">
                        <label>Enter OTP</label>
                        <div class="d-flex enterotp bg-white" id="otp_box">
                            <input class="form-control otp reqrd" maxlength="1" name="register_otp[]" onkeypress="return isNumber(event)" required>
                            <input class="form-control otp reqrd" maxlength="1" name="register_otp[]" onkeypress="return isNumber(event)" required>
                            <input class="form-control otp reqrd" maxlength="1" name="register_otp[]" onkeypress="return isNumber(event)" required>
                            <input class="form-control otp reqrd" maxlength="1" name="register_otp[]" onkeypress="return isNumber(event)" required>
                            <input class="form-control otp reqrd" maxlength="1" name="register_otp[]" onkeypress="return isNumber(event)" required>
                        </div>
                        <div>
                            <span class="error mt-2" id="errlog_otp"></span>
                            <p class="p-0 mt-2 resend resend_again">Didn’t get the code?
                                <a class="resendweight float-right" href="javascript:void(0);" onclick="resentOtp()">Resend OTP</a>
                            </p>
                            <p class="p-0 mt-2 resend resend_timer">Resend OTP in <span id="wait_otp_div">00:59</span>
                                <a class="resendweight float-right resendcolorchan" href="javascript:void(0);">Resend OTP</a>
                            </p>
                        </div>
                    </div>
                    <div class="custom-input pb-3">
                        <label>Email</label>
                        <input type="email" class="form-control reqrd" placeholder="Email address" name="email_add" minlength="8" maxlength="64" id="email_add" required>
                        <span class="error mt-2" id="errlog_mail"></span>
                    </div>
                    <div class="custom-input pb-3">
                        <label>City</label>
                        <div id="location-box" class="position-relative">
                            <select class="js-states form-control reqrd" name="location" data-use-select2="true" id="location" required>
                                <option value="">Select a city</option>
                            </select>
                        </div>
                    </div>
                    <div class="custom-input pb-3 row">
                        <div class="col-6">
                            <label>Grade</label>
                            <select class="form-control selectdata reqrd js-example-basic-single" name="grade" id="grade" required>
                                <option class="we" value="" disabled selected hidden>Select grade</option>
                                <option class="we2" value="1" data-value="10th Standard Pass">10th Standard Pass</option>
                                <option class="we" value="2" data-value="11th Standard Pass">11th Standard Pass</option>
                                <option class="we" value="3" data-value="12th Standard Pass">12th Standard Pass</option>
                          
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Exam</label>
                            <select class="form-control selectdata reqrd js-example-basic-single examtype" name="exam" id="exam_id" required>
                                <option value="" disabled selected hidden>Exam Type</option>
                                <option value="1">JEE Main</option>
                                <option value="2">NEET</option>
                            </select>
                        </div>
                    </div>
                    <span class="error mt-2" id="errlog_auth"></span>
                    <div class="Get-otp pt-4">
                    <button type="submit" id="signup_cnt" class="btn btn-common-green text-white w-100 " onclick="sendSignUpEvent()" disabled>Continue</button>
                    
                    </div>
                </form>
            </div>
            <h3 class="copyright text-center pb-md-0 pb-5 pt-4 m-0">By clicking continue, you agree to our<br> <a href="{{env('CMS_URL')}}terms-of-use/" target="_blank">Terms & Conditions </a> &nbsp;and &nbsp;<a href="{{env('CMS_URL')}}privacy-policy/" target="_blank">Privacy Policy</a>.</h3>
        </div>
    </section>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        var timerId = '';
        /* name input validation */
        /* only letter number */
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        /* only letter input */
        function onlyAlphabetsDisplay(e, t) {
            return (e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || e.charCode == 32;
        }
        $("#user_name").keyup(function() {
            var myValue = $(this).val();
            var test = myValue.replace(/  +/g, ' ');
            $("#user_name").val(test);
        });
        $("#user_name").blur(function() {
            var myValue = $(this).val();
            myValue = myValue.trim();
            $("#user_name").val(myValue);
            saveFormValidate();
        });


        /* convert text in to capitalized text */
        $.fn.capitalize = function() {
            $.each(this, function() {
                var split = this.value.split(' ');
                for (var i = 0, len = split.length; i < len; i++) {
                    split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);
                }
                this.value = split.join(' ');
            });
            return this;
        };
        /* capitalize the input name */
        $('#user_name').on('keyup', function() {
            $(this).capitalize();
        }).capitalize();

        $('#mobile_num').on("change keyup paste contextmenu input", function(evt) {
            $("#err_reg_mob").html("");
            if ($(this).val().length == 10) {
                $('#verifynum').removeClass("d-none");
                $('#verifynum').addClass("d-block");
            } else {
                $('#verifynum').removeClass("d-block");
                $('#verifynum').addClass("d-none");
            }

        });

        /* name input validation */
        $(function() {

            const $inp = $(".otp");

            $inp.on({
                paste(ev) { // Handle Pasting

                    const clip = ev.originalEvent.clipboardData.getData('text').trim();
                    // Allow numbers only
                    if (!/\d{5}/.test(clip)) return ev.preventDefault(); // Invalid. Exit here
                    // Split string to Array or characters
                    const s = [...clip];
                    // Populate inputs. Focus last input.
                    $inp.val(i => s[i]).eq(5).focus();
                },
                input(ev) { // Handle typing

                    const i = $inp.index(this);
                    var input_val = this.value;
                    if (!input_val.match(/^\d+$/)) {
                        $(this).val('');
                        return false;
                    }
                    if (this.value) $inp.eq(i + 1).focus();
                },
                keydown(ev) { // Handle Deleting

                    const i = $inp.index(this);
                    if (!this.value && ev.key === "Backspace" && i) $inp.eq(i - 1).focus();
                }
            });
        });

        function resentOtp() {
            $('#otp_box input[name="register_otp[]"').val('');
            $('#verifynum').click();
            saveFormValidate();
        }
        $('#editsignnumber').click(function() {
            $('#mobile_num').val('');
            $('.otp-input').hide();
            $('#otpsentmsg').removeClass("d-block");
            $('#otpsentmsg').addClass("d-none");
            $('#editsignnumber').removeClass("d-block");
            $('#editsignnumber').addClass("d-none");
            $('#otp_box input[name="register_otp[]"').val('');
            $('.otp').attr('style', 'border: 0.5px solid #d0d5dd !important');
            clearTimeout(timerId);
            $('#wait_otp_div').text('00:59');
            $("#errlog_otp").html('')
            $('#mobile_num').attr("readonly", false);
            saveFormValidate();
        });
        $('#verifynum').click(function() {
            $check = 0;
            var mobile_num = $("#mobile_num").val();
            if (mobile_num == '') {
                $("#err_reg_mob").html('Please enter your mobile number');
                $("#err_reg_mob").fadeIn('fast');
                $check = 1;
            } else {

                var testMobile = /^[6-9][0-9]{9}$/;
                if (testMobile.test(mobile_num)) {} else {
                    $("#err_reg_mob").html('Please enter valid mobile number');
                    $("#err_reg_mob").fadeIn('fast');
                    $check = 1;
                };
            }
            if ($check == 1) {
                return false;
            } else {
                url = "{{ url('sentMobileOtp/') }}/" + mobile_num;
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response_data) {
                        var response = jQuery.parseJSON(response_data);


                        if (response.success == true) {
                            resentOtpTime();
                            $('#verifynum').removeClass("d-block");
                            $('#verifynum').addClass("d-none");

                            $('#otpsentmsg').removeClass("d-none");
                            $('#otpsentmsg').addClass("d-block");
                            $('#editsignnumber').removeClass("d-none");
                            $('#editsignnumber').addClass("d-block");

                            $('#mobile_num').attr("readonly", true);
                            if (response.hasOwnProperty("otp")) {
                              $('#testing_otp').html(response.otp);
                            }


                            $('.otp-input').show();
                        } else {
                            $("#err_reg_mob").html(response.message);
                            $("#err_reg_mob").fadeIn('fast');
                            $("#mobile_num").focus();
                            return false;
                        }

                    },
                });
            }


        });

        $.validator.addMethod(
            /* The value you can use inside the email object in the validator. */
            "regex",

            /* The function that tests a given string against a given regEx. */
            function(value, element, regexp) {
                /* Check if the value is truthy (avoid null.constructor) & if it's not a RegEx. (Edited: regex --> regexp)*/

                if (regexp && regexp.constructor != RegExp) {
                    /* Create a new regular expression using the regex argument. */
                    regexp = new RegExp(regexp);
                }

                /* Check whether the argument is global and, if so set its last index to 0. */
                else if (regexp.global) regexp.lastIndex = 0;

                /* Return whether the element is optional or the result of the validation. */
                return this.optional(element) || regexp.test(value);
            }
        );
        $("#studentsignup").validate({

            rules: {
                user_name: {
                    required: true,
                    normalizer: function( value ) {
                        return $.trim( value );
                     },
                },
                mobile_num: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
                "register_otp[]": {
                    required: true,
                },
                email_add: {
                    required: true,
                    email: true,
                    regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                },
                location: {
                    required: true,
                },
                grade: {
                    required: true,
                },
                exam: {
                    required: true,
                }
            },
            messages: {
                "user_name": {
                    required: "Please enter the name."
                },
                "mobile_num": {
                    required: "Please enter the mobile number."
                },
                "register_otp[]": {
                    required: "Please enter the OTP."
                },
                "email_add": {
                    required: "Please enter email address.",
                    regex: "Please enter valid email address."
                },
                "location": {
                    required: "Please select city."
                },
                "grade": {
                    required: "Please select grade."
                },
                "exam": {
                    required: "Please select exam"
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {

                switch (element.attr("name")) {
                    case 'user_name':
                        error.insertAfter($("#user_name"));
                        break;
                    case 'mobile_num':
                        error.insertAfter($("#mobile_num_box"));
                        break;
                    case 'register_otp[]':
                        $("#errlog_otp").html('Please enter the valid OTP.')
                        break;
                    case 'email_add':
                        error.insertAfter($("#email_add"));
                        break;
                    case 'grade':
                        error.insertAfter($("#grade"));
                        break;
                    case 'exam':
                        error.insertAfter($("#exam_id"));
                        break;
                    case 'location':
                        error.insertAfter($("#location-box"));
                        break;
                    default:
                        error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                var user_name = $("#user_name").val();
                var email_add = $("#email_add").val();
                var mobile_num = $("#mobile_num").val();

                var register_otp = $("input[name='register_otp[]']")
                    .map(function() {
                        return $(this).val();
                    }).get();
                var location = $("#location").val();
                var exam = $("#exam_id").val();
                var grade_stage = $("#grade").val();
                var refer_code = $("#refer_code").val();
                var referral_email = $("#referral_email").val();
                var state = $('#state_name').val();
                var city = $('#city_name').val();
                $.ajax({
                    url: "{{ url('/verifyOtpRegister') }}",
                    type: 'POST',
                    async: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        reg_otp: register_otp,
                        email_add: email_add,
                        user_name: user_name,
                        mobile_num: mobile_num,
                        location: city,
                        exam_id: exam,
                        stage_at_signup: grade_stage,
                        state: state,
                        refer_code: refer_code,
                        refer_email: referral_email,
                        check_otp: 'Y',
                    },
                    beforeSend: function() {},
                    success: function(response_data) { //debugger;
                        var response = jQuery.parseJSON(response_data);

                        if (response.status == 400) {
                            if (response.msg === 'Wrong OTP') {
                                var errormsg = $("#errlog_otp").show();

                                errormsg[0].textContent = "Invalid OTP";
                                setTimeout(function() {
                                    $('#errlog_otp').fadeOut('fast');
                                }, 10000);
                            } else if (response.msg === 'User already registered') {
                                var errormsg = $("#errlog_mail").show();

                                errormsg[0].textContent = 'Email address already exist.';
                                setTimeout(function() {
                                    $('#errlog_mail').fadeOut('fast');
                                }, 10000);
                            } else {
                                var errormsg = $("#errlog_auth").show();
                                errormsg[0].textContent = response.msg;
                                setTimeout(function() {
                                    $('#errlog_auth').fadeOut('fast');
                                }, 10000);
                            }
                            return false
                        } else {

                            
                            console.log(response);

                            // Mixpanel started
                            var exam = $("#exam_id").val();
                            var exam_name='JEE Main';
                            if (exam == 2) {
                                exam_name='NEET';
                            }

                            //var grade_stage = $("#grade").val();
                            var grade_stage = $("#grade").find(":selected").attr("data-value");
                            var email_add = $("#email_add").val();
                            var city = $('#city_name').val();
                            var state = $('#state_name').val();
                                mixpanel.identify(response.student_id);
                                // mixpanel requirment need to modify the code in case course list increases
                                // if(exam==1){
                                // exam='JEE'
                                // }else{
                                // exam='NEET'
                                // }
                                mixpanel.people.set({"$user_id":response.student_id,"$name":response.user_name,"$phone":response.mobile,"$Signup_at":response.created_at,"platform":"","referral":"","Course":exam_name,"Grade":grade_stage,"$email":email_add,"$city":city,"State":state});
                                mixpanel.track('Sign up completed',{
                                '$email' : email_add,
                                "Email Verified" : 'No',
                                "$city":city,
                                "State":state,
                                }); 
                           

                            // Mixpanel Event Ended

                            
                            $('#student_id').val(response.student_id);
                            $('.usernamE').html(response.user_name);
                            $('.student-mobile').html("+91-" + response.mobile);
                            $('#login-box').addClass('close-box');
                            $('#address-box').addClass('open-box');
                            window.location.href = '{{url("dashboard")}}';
                        }

                    },
                    error: function(xhr, b, c) {
                        console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                    }
                });
            }

        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                minimumResultsForSearch: -1,
                placeholder: "Select Grade",
            });
            $('.examtype').select2({
                minimumResultsForSearch: -1,
                placeholder: "Exam Type",
            });

            $('.resend_again').hide();

            $("#location").select2({
                allowClear: false,
                minimumInputLength: 3,
                minimumResultsForSearch: -1,
                maximumInputLength: 29,
                tokenSeparators: [',', ' '],
                placeholder: "Select a City",
                selectOnClose: false,
                closeOnSelect: true,

                ajax: {
                    url: "{{ url('/newCityList') }}",
                    type: "GET",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var queryParameters = {
                            search_text: params.term
                        }
                        return queryParameters;
                    },
                    processResults: function(response_data, params) {
                        var data = $.map(response_data.response, function(obj) {
                            obj.id = obj.id;
                            obj.text = obj.text;
                            obj.datavalue = obj.state;
                            return obj;
                        });

                        params.page = params.page || 1;

                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;
                $('#state_name').val(data['datavalue']);
                $('#city_name').val(data['id']);
            });

            $('#location').val(null).trigger('change');
            $('#location').on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
            $(document).on('keypress', '.select2-search__field', function() {

                if (event.which > 32 && (event.which < 65 || event.which > 90) &&
                    (event.which < 97 || event.which > 122)) {
                    event.preventDefault();
                }
            });
            $(document).on('input', '.select2-search__field', function(event) {
                if (event.target.value.length >= 28) {
                    var search_value = event.target.value;
                    search_value = search_value.substring(0, 28);
                    $(this).val(search_value);
                }
            });
            $('#location').change(function() {
                $("#location-error").hide();
            })
            $(document).keypress(function(e) {
                if (e.keyCode === 13) {
                    if (!$('#signup_cnt').prop('disabled')) {
                        $('#studentsignup').submit();
                        e.preventDefault();
                        return false;
                    }
                }
            });
        });

        $('.otp').keyup(function(e) {

            var isEmptyOTP = false;
            $('.otp').each(function() {
                if ($(this).val() == '') {
                    isEmptyOTP = true;
                    $(this).attr('style', 'border: 0.5px solid #d0d5dd !important');
                } else {
                    $(this).attr('style', 'border: 1px solid #56b66380 !important;');
                }
            });
            if (isEmptyOTP) {


            } else {
                $("#errlog_otp").html("");
            }
            if (e.which == 37) {
                $(e.target).prev('.otp').focus();
            }
            if (e.which == 39) {
                $(e.target).next('.otp').focus();
            }
        });

        $('.reqrd').keyup(function() {
            saveFormValidate();
        });
        $('.reqrd').change(function() {
            saveFormValidate();
        });

        function saveFormValidate() {
            var isEmpty = false;
            $('.reqrd').each(function() {
                if ($(this).val() == '' || $(this).val() == null) {
                    isEmpty = true;
                }
            });


            if (isEmpty) {
                $('#signup_cnt').attr('disabled', 'disabled');
                $('#signup_cnt').addClass("disbaled");
            } else {
                if ($("#studentsignup").valid()) {
                    $('#signup_cnt').removeAttr('disabled');
                    $('#signup_cnt').removeClass("disbaled");
                } else {
                    $('#signup_cnt').attr('disabled', 'disabled');
                    $('#signup_cnt').addClass("disbaled");
                }

            }
        }

        /* function for select sity */
        document.addEventListener("paste", function(e) {
            if (e.target.type === "text" && e.target.id != 'mobile_num' && e.target.id != 'user_name' && e.target.id != 'email_add') {
                var data = e.clipboardData.getData('Text');
                if (!isNaN(data)) {
                    data = data.split('');
                    [].forEach.call(document.querySelectorAll(".otp"), (node, index) => {
                        node.value = data[index];
                    });
                } else {
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

        function validatePaste(el, e) {
            var regex = /^[a-z .'-]+$/gi;
            var key = e.clipboardData.getData('text')
            if (!regex.test(key)) {
                e.preventDefault();
                return false;
            }
        }
        $('.txtOnlySpace').bind('keyup blur', function() {
            var node = $(this);
            node.val(node.val().replace(/[^a-zA-Z\s]/g, ''));
            var fieldLength = document.getElementById('user_name').value.length;
            //Suppose u want 4 number of character
            if (fieldLength <= 25) {
                return true;
            } else {
                var str = document.getElementById('user_name').value;
                str = str.substring(0, str.length - 1);
                document.getElementById('user_name').value = str;
            }
        });
        $('#mobile_num').bind('keyup blur', function() {
            var node = $(this);
            node.val(node.val().replace(/[^0-9]/g, ''));
        });
        $('#email_add').bind('keyup blur', function() {
            var fieldLength = document.getElementById('email_add').value.length;
            if (fieldLength <= 64) {
                return true;
            } else {
                var str = document.getElementById('email_add').value;
                str = str.substring(0, str.length - 1);
                document.getElementById('email_add').value = str;
            }
        });
    </script>

    <!-- Mixpanel Started -->

<script type="text/javascript">
        (function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
        for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
        MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

        // Enabling the debug mode flag is useful during implementation,
        // but it's recommended you remove it for production


        var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
        mixpanel.init(mixpanelid);
        mixpanel.track('Loaded Sign up');


        window.addEventListener("pageshow", function(event) {
            var historyTraversal = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
            if (historyTraversal) {
                window.location.reload();
            }
        });
        function sendSignUpEvent(){

            var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
                mixpanel.init(mixpanelid);
                mixpanel.track('Sign up Started');
        }
</script>

</body>
@endsection