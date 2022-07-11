@extends('layouts.app')
@section('content')

<!-- 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section class="d-flex h-100 login-signup">
    <div class="left-sidepannel d-flex flex-column justify-content-between position-relative">
        <figure class="pb-4">
            <a href="javascript:void(0);">
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
                            <p>See how you are doing and see the percentage of<br> subject you are doing good in</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{URL::asset('public/after_login/current_ui/images/progress-jer.svg')}}" alt="performance" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="pb-2">Progress journey</h5>
                            <p>Visually track how your progress is going, graph that<br> shows you ideal pace and your pace</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{URL::asset('public/after_login/current_ui/images/weekly.svg')}}" alt="performance" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="pb-2">Weekly plan</h5>
                            <p>Plan your weekly tests for any chapters, check<br> proficiency of different subjects</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{URL::asset('public/after_login/current_ui/images/Task-center.svg')}}" alt="performance" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="pb-2">Task centre</h5>
                            <p>To assess your readiness, set daily or weekly tasks to<br> evaluate your skills </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="right-seidepannel d-flex flex-column justify-content-start position-relative allscrollbar signuprightpannel">
        <div class="loginform m-auto">
            <h1 class="pb-2 mb-1">Sign up</h1>
            <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
            <form id="studentsignup" method="post">
                @csrf
                <div class="custom-input pb-3">
                    <label>Name</label>
                    <input type="text" name="user_name" id="user_name" class="form-control reqrd" placeholder="Name" maxlength="25" onkeypress="return lettersOnly(event)" required>
                </div>
                <div class=" custom-input changeno pb-3 ">
                    <label>Mobile</label>
                    <div class="d-flex position-relative" id="mobile_num_box">
                        <input type="text" maxlength="10" class="form-control bg-white reqrd" placeholder="Mobile no" name="mobile_num" id="mobile_num" onkeypress="return isNumber(event)">
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
                        <a class="resendweight float-right resendcolorchan" href="javascript:void(0);" >Resend OTP</a>
                    </p>
                  </div>
                </div>
                <div class="custom-input pb-3">
                    <label>Email</label>
                    <input type="email" class="form-control reqrd" placeholder="Email address" name="email_add" minlength="8" maxlength="64" id="email_add" required>
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
                    <div class="col-lg-6">
                        <label>Grade</label>
                        <select class="form-control selectdata reqrd" name="grade" id="grade" required>
                            <option class="we" value="" disabled selected hidden>Select grade</option>
                            <option class="we2" value="1">Just starting out</option>
                            <option class="we" value="2">Completed (10+1) Syllabus</option>
                            <option class="we" value="3">Completed (10+2) Syllabus</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Exam</label>
                        <select class="form-control selectdata reqrd" name="exam" id="exam_id" required>
                            <option value="" disabled selected hidden>Exam Type</option>
                            <option value="1">JEE</option>
                            <option value="2">NEET</option>

                        </select>
                    </div>
                </div>
                <span class="error mt-2" id="errlog_auth"></span>
                <div class="Get-otp pt-4">
                    <button type="submit" id="signup_cnt" class="btn btn-common-green text-white w-100 " disabled>Continue</button>
                </div>
            </form>
        </div>
        <h3 class="copyright text-center pt-4">By clicking continue, you agree to our<br> <a href="https://qandi.com/terms-of-use/" target="_blank">Terms & Conditions </a> &nbsp;and &nbsp;<a href="https://qandi.com/privacy-policy/" target="_blank">Privacy Policy</a>.</h3>
    </div>
</section>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  var timerId='';
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
    $(document).on("keydown", "#user_name", function(evt) {
        var firstChar = $("#user_name").val();
        var val = $("#user_name").val();
        if (evt.keyCode == 32 && firstChar == "") {
            return false;
        }
        $("#user_name").val(val.replace(/  +/g, ' '));

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

    $('#mobile_num').on('keyup', function() {
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
                if (this.value) $inp.eq(i + 1).focus();
            },
            keydown(ev) { // Handle Deleting

                const i = $inp.index(this);
                if (!this.value && ev.key === "Backspace" && i) $inp.eq(i - 1).focus();
            }
        });
    });
    /*  $('.otp').keyup(function(event) {
         $(".otp-input input").filter(function() {
             return $.trim($(this).val()).length == 0
         }).length == 0;
     }); */

    function resentOtp() {
        $('#otp_box input[name="register_otp[]"').val('');
        $('#verifynum').click();
    }
    $('#editsignnumber').click(function() {
        $('#mobile_num').val('');
        $('.otp-input').hide();
        $('#otpsentmsg').removeClass("d-block");
        $('#otpsentmsg').addClass("d-none");
        $('#editsignnumber').removeClass("d-block");
        $('#editsignnumber').addClass("d-none");
        $('#otp_box input[name="register_otp[]"').val('');
        clearTimeout(timerId);
        $('#wait_otp_div').text('00:59');
    });
    $('#verifynum').click(function() {
        $check = 0;
        var mobile_num = $("#mobile_num").val();
        if (mobile_num == '') {
            $("#err_reg_mob").html('Please enter your mobile number');
            $("#err_reg_mob").fadeIn('fast');
            $("#err_reg_mob").fadeOut(1000);
            $check = 1;
        } else {

            var testMobile = /^[6-9][0-9]{9}$/;
            if (testMobile.test(mobile_num)) {} else {
                $("#err_reg_mob").html('Please enter valid mobile number');
                $("#err_reg_mob").fadeIn('fast');
                $("#err_reg_mob").fadeOut(1000);
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

                        $('.otp-input').show();
                    } else {
                        $("#err_reg_mob").html(response.message);
                        $("#err_reg_mob").fadeIn('fast');
                        $("#err_reg_mob").fadeOut(2000);
                        return false;
                    }

                },
            });
        }


    });


    $("#studentsignup").validate({

        rules: {
            user_name: {
                required: true,
            },
            mobile_num: {
                required: true,
            },
            "register_otp[]": {
                required: true,
            },
            email_add: {
                required: true,
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
                required: "Please enter email address."
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
        /* errorLabelContainer: '#errlog_otp', */
        errorPlacement: function(error, element) {

            switch (element.attr("name")) {
                case 'user_name':
                    error.insertAfter($("#user_name"));
                    break;
                case 'mobile_num':
                    error.insertAfter($("#mobile_num_box"));
                    break;
                case 'register_otp[]':
                    //error.add($("#errlog_otp"));
                    $("#errlog_otp").html('Please enter the valid OTP.')
                    /*error.insertAfter($("#otp_box") */
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
            $.ajax({
                url: "{{ url('/verifyOtpRegister') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    reg_otp: register_otp,
                    email_add: email_add,
                    user_name: user_name,
                    mobile_num: mobile_num,
                    location: location,
                    exam_id: exam,
                    stage_at_signup: grade_stage,
                },
                beforeSend: function() {},
                success: function(response_data) { //debugger;
                    var response = jQuery.parseJSON(response_data);

                    if (response.status == 400) {
                        if (response.msg === 'Wrong OTP') {
                            //$('errlog_otp').html("Invalid OTP");
                            var errormsg = $("#errlog_otp").show();

                            errormsg[0].textContent = "Invalid OTP";
                            setTimeout(function() {
                                $('#errlog_otp').fadeOut('fast');
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
                        $('#student_id').val(response.student_id);
                        $('.usernamE').html(response.user_name);
                        $('.student-mobile').html("+91-" + response.mobile);
                        //$('#otp-verify-box').addClass('open-box');

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
        $('.resend_again').hide();

        $("#location").select2({
            allowClear: false,
            minimumInputLength: 3,
            minimumResultsForSearch: -1,
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

                    // var data = jQuery.parseJSON(response_data);

                    var data = $.map(response_data.response, function(obj) {
                        obj.id = obj.id;
                        obj.text = obj.text;
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
        $('#location').change(function() {
            $("#location-error").hide();
        })


    });

    (function() {
        $('.reqrd').change(function() {

            var isEmpty = false;
            $('.reqrd').each(function() {
                if ($(this).val() == '') {
                    isEmpty = true;
                }
            });

            if (isEmpty) {
                $('#signup_cnt').attr('disabled', 'disabled');
                $('#signup_cnt').addClass("disbaled");
            } else {
                $('#signup_cnt').removeAttr('disabled');
                $('#signup_cnt').removeClass("disbaled");
            }
        });
    })()
    /* function for select sity */
    document.addEventListener("paste", function(e) {
        console.log(e.target.id);
        if (e.target.type === "text" && e.target.id !='mobile_num') {
            var data = e.clipboardData.getData('Text');
            data = data.split('');
            [].forEach.call(document.querySelectorAll(".otp"), (node, index) => {
                node.value = data[index];
            });
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
            elem.innerHTML = "00:"+timeLeft ;
            timeLeft--;
        }

    }
}

</script>
@endsection