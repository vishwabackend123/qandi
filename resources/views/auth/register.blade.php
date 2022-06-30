@extends('layouts.app')
@section('content')
<!--<section class="login-bg-img">
    <span class="outer-logo"><a href="{{ env('LANDING_URL') }}" target="_blank"><img src="{{URL::asset('public/images_new/QI_Logo.gif')}}" alt="logo not find"></a></span>
    <div class="login_screen" id="login-box">
        <form id="studentsignup" method="post">
            @csrf
            <div id="name-box">
                <p class="mb-0">Welcome to Q&I </p>
                <p>“Let's start with getting to know you better. What's your name?”</p>
                <div class="pt-3">
                    <div class="form-group flds">
                        <input type="text" class="form-control m-email" name="user_name" id="user_name" placeholder="Hi, this is Rohit / Seema…" onkeypress="return lettersOnly(event)" autocomplete="off" maxlength="25">
                        <span class="error-sms mobil-not-valid" id="errlog_name">Please entered your name</span>
                        <span class="error-sms email-not-valid">Please sign up first or check the email or mobile you have provided</span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="sign-btn"><button type="button" id="goto-mobile-btn" disabled class="btn btn-primary disbaled-btn active-btn text-uppercase">go next</button></div>
                </div>
            </div>
            <div id="email-box">
                <p class="mb-0">Welcome to Q&I </p>
                <p>“Sign-up using your email address and mobile number.”</p>
                <div class="pt-3 emailNumdiv">
                    <div class="form-group flds">
                        <input type="text" class="form-control email-addrs disable-value" placeholder="Email address" name="email_add" minlength="8" maxlength="64" id="email_add" autocomplete="off" value="">
                        <span class="error-sms enter-otp" id="errlog_email">Please enter your email address</span>
                    </div>
                    <div class="form-group flds">
                        <input type="text" class="form-control m-email" name="mobile_num" id="mobile_num" value="" minlength="10" maxlength="10" onkeypress="return isNumber(event)" placeholder="Mobile number" autocomplete="off">
                        <span class="error-sms mobil-not-valid" id="errlog_mob">Please enter your mobile number</span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="sign-btn"><button type="button" id="goto-otp-btn" disabled class="btn btn-primary disbaled-btn active-btn text-uppercase">Next</button></div>
                </div>
            </div>
            <div id="otp-box">
                <p class="mb-0">Welcome to Q&I </p>
                <p>"You must have received an OTP from us in your inbox or message"</p>
                <div class="pt-3 verifyBox">
                    <div class="form-group flds">
                        <input type="text" class="form-control pass disable-value" onkeypress="return isNumber(event)" name="reg_otp" id="reg_otp" minlength="5" maxlength="5" placeholder="Enter OTP" autocomplete="off">
                        <span class="error-sms enter-otp" id="errlog_otp"></span>
                        <span class="error-sms wrong-otp" id="errlog_auth"></span>
                        <p class="text-right" id="wait_otp_div">Resend OTP in 180 sec</p>
                    </div>

                    <div class="clearfix"></div>
                    <p id="resendOtp_link" class="text-center mt-4 mb-0">Didn’t get OTP? <a href="javascript:void(0);" onclick="resentOtp();">Resend</a></p>
                    <div class="sign-btn"><button type="submit" disabled class="btn btn-primary disbaled-btn active-btn text-uppercase" id="otp-verify-btn">Sign Up</button></div>

                    @if (env('STUDENT_ENV') != 'prod')
                    <span style="display:none" id="resp_opt"></span>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="login_screen" id="address-box" style="display:none">
        <p class="mb-0 font-weight-bold auth-txt">Welcome <span class="usernamE"> </span>!</p>
        <p class="mb-0 blacktxt"> Tell us a little bit about you</p>
        <div class="contentA">
            <form id="addressSignup" method="post">
                @csrf
                <input type="hidden" name="student_id" id="student_id" value="">
                <input type="hidden" name="refer_code" id="refer_code" value="{{$referral_code ?? ''}}">
                <div class="form-group flds ">
                    <div class="store-mobile mb-2 pl-2">
                        <img src="{{URL::asset('public/images_new/phone-log.png')}}" alt="mobile icon not find">
                        <span class="pl-2"> <span class="student-mobile"></span></span>
                    </div>
                </div>
                <div class="form-group flds ">
                    <div class="store-mobile">
                        <img src="{{URL::asset('public/images_new/locationlog.png')}}" alt="mobile icon not find" style="width:20px;">
                        <span class="pl-2"><span class="student-name">India</span></span>
                        <input type="hidden" name="country" id="country" value="India" required onkeypress="return lettersOnly(event)">
                    </div>
                </div>
                <div id="addressfield">
                    <div class="form-group flds " id="statebx">
                        <input type="text" class="form-control  students select-grade" id="select-state" placeholder="Select your state" name="state" required readonly onkeypress="return lettersOnly(event)" autocomplete="off">
                        <span class="currect-email currect-value"><img src="{{URL::asset('public/images_new/success-icon.png')}}"></span>
                        <div class="country-code-name stu-grade" id="state_list" style="display:none">
                        </div>
                    </div>
                    <div class="form-group flds" id="citybx">
                        <input type="text" class="form-control  students select-exam" id="select-city" placeholder="Select your city" name="city" required readonly onkeypress="return lettersOnly(event)" autocomplete="off">
                        <span class="currect-email currect-value"><img src="{{URL::asset('public/images_new/success-icon.png')}}"></span>
                        <div class="country-code-name stu-exam" id="city_list" style="display:none;">
                        </div>
                        <p id="city_remark" style="display:none;">Select the nearest city if your city is not shown in the list</p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="sign-btn">
                    <button type="submit" id="address-btn" disabled class="btn btn-primary disbaled-btn active-btn text-uppercase">Go Next ></button>
                </div>
            </form>
        </div>
    </div>
    <div class="loader-block" style="display:none;">
        <img src="{{URL::asset('public/after_login/new_ui/images/loader.gif')}}">
    </div>
</section>
<script type="text/javascript">
    function getParameter(p)
    {
        var url = window.location.search.substring(1);
        var varUrl = url.split('&');
        for (var i = 0; i < varUrl.length; i++)
        {
            var parameter = varUrl[i].split('=');
            if (parameter[0] == p)
            {
                return parameter[1];
            }
        }
    }
    var input = document.getElementById("user_name");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $("#goto-mobile-btn").trigger("click");
        }
    });

    var input = document.getElementById("email_add");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $("#goto-otp-btn").trigger("click");
        }
    });
    var input = document.getElementById("mobile_num");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $("#goto-otp-btn").trigger("click");
        }
    });
    var input = document.getElementById("reg_otp");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $("#otp-verify-btn").trigger("click");
        }
    });
   $(document).on('keypress', function(e) {
      var hasclass = $('#address-btn').hasClass('disbaled-btn');
        if (e.which == 13 && e.which != true) {
            event.preventDefault();
            $("#address-btn").trigger("click");
        }
    });
    
    $('#resendOtp_link').hide();
    $('#user_name').keyup(function() {
        var value = this.value;
        var length = value.length;
        if (value != '') {
            $('#goto-mobile-btn').removeAttr("disabled");
            $('#goto-mobile-btn').removeClass("disbaled-btn");
        } else {
            $('#goto-mobile-btn').attr('disabled', 'disabled');
            $('#goto-mobile-btn').addClass("disbaled-btn");
        }
    });
    $(function() {

        /* check email or number filled or not */
        $('.emailNumdiv input').keyup(function() {
            var empty = false;

            $('.emailNumdiv input').each(function() {
                if ($(this).val() == '') {
                    empty = true;
                }
            });

            if (empty) {
                $('#goto-otp-btn').attr('disabled', 'disabled');
                $('#goto-otp-btn').addClass("disbaled-btn");
            } else {
                $('#goto-otp-btn').removeAttr('disabled');
                $('#goto-otp-btn').removeClass("disbaled-btn");
            }
        });

        /* check OTP filled or not */
        $('.verifyBox input').keyup(function() {
            var empty = false;
            $('.verifyBox input').each(function() {
                if ($(this).val() == '') {
                    empty = true;
                }
            });

            if (empty) {
                $('#otp-verify-btn').attr('disabled', 'disabled');
                $('#otp-verify-btn').addClass("disbaled-btn");
            } else {
                $('#otp-verify-btn').removeAttr('disabled');
                $('#otp-verify-btn').removeClass("disbaled-btn");
            }
        });




    });

    function addressFieldChnage() {

        var empty = false;
        $('#addressfield input').each(function() {
            var ids= this.id;
            if(ids=='myInput' || ids=='myInputState')
            {
                return; 
            }
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#address-btn').attr('disabled', 'disabled');
            $('#address-btn').addClass("disbaled-btn");
        } else {
            $('#address-btn').removeAttr('disabled');
            $('#address-btn').removeClass("disbaled-btn");
        }
    }

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

                var testMobile = /^[6-9][0-9]{9}$/;
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

                            if ($("#resp_opt").length == 1) {
                                $("#resp_opt").text(response.mobile_otp);
                            }
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

        /*  $('#otp-verify-btn').click(function() {
             $('#login-box').addClass('close-box');
             $('#address-box').addClass('open-box');
         }); */



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
                        console.log(response);
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
                            $('#student_id').val(response.student_id);
                            $('.usernamE').html(response.user_name);
                            $('.student-mobile').html("+91-" + response.mobile);
                            //$('#otp-verify-box').addClass('open-box');

                            $('#login-box').addClass('close-box');
                            $('#address-box').addClass('open-box');
                            /* $('#otp-box').addClass('close-box');
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url
                            } */
                        }

                    },
                    error: function(xhr, b, c) {
                        console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                    }
                });
            }

        });

        $("#addressSignup").validate({
            rules: {
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
            },
            messages: {
                "state": {
                    required: "Please select state"
                },
                "city": {
                    required: "Please select city"
                }
            },
            submitHandler: function(form) {
                var student_id = $("#student_id").val();
                var country = $("#country").val();
                var state = $("#select-state").val();
                var city = $("#select-city").val();
                var referCode = $("#refer_code").val();
                var referEmail = $("#email_add").val();
                var exam_id = getParameter('exam_id');
                var trial_id = getParameter('trial');
                if (typeof(exam_id)  === "undefined") {
                    exam_id="";
                }
                if (typeof(trial_id)  === "undefined") {
                    trial_id ="";
                }

                $.ajax({
                    url: "{{ url('/signupAddress') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        student_id: student_id,
                        country: country,
                        state: state,
                        city: city,
                        refer_code: referCode,
                        refer_email: referEmail,
                        exam_id: exam_id,
                        trail:trial_id,
                    },
                    success: function(response_data) { //debugger;
                        var response = jQuery.parseJSON(response_data);
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url
                        }
                    },
                    error: function(xhr, b, c) {
                        console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                    }
                });
            }

        });


        /* search State */
        $('#select-state').on("click keyup", function(event) {
            $('#city_list').hide();
            $('#city_remark').hide()
            var val = event.target.value;
            var country = $('#country').val();
            $('.loader-block').show();
            $.ajax({
                url: "{{ url('/getState',) }}",
                type: "GET",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    'search_text': event.target.value,
                    'country': country,
                },
                success: function(response_data) {
                    $('.loader-block').hide();
                    let html = '';
                    var data = jQuery.parseJSON(response_data);

                    if (data.success === true) {

                        html += data.response;

                    } else {
                        html += `<ul><li>States</li></ul>`;
                    }

                    $('#state_list').show();
                    $('#state_list').html(html);
                }
            });

        });


        /* function for focusout select state */
        /* $('#select-state').focusout(function() {
            //$('#state_list').hide();
        }) */

        /* function for select sity */
        $('#select-city').on("click keyup", function(event) {
            $('#state_list').hide();
            var val = event.target.value;
            var state = $('#select-state').val();

            $('.loader-block').show();

            $.ajax({
                url: "{{ url('/getCity',) }}",
                type: "GET",
                cache: false,
                data: {
                    'search_text': event.target.value,
                    'state': state,
                },
                success: function(response_data) {
                    $('.loader-block').hide();
                    let html = '';
                    var data = jQuery.parseJSON(response_data);

                    if (data.success === true) {

                        html += data.response;

                    } else {
                        html += `<ul><li>Cities</li></ul>`;
                    }
                    $('#city_list').html(html);
                    $('#city_list').show();
                    $('#city_remark').show();
                    $("#myInput").focus();
                }
            });

        });


        /* function for focusout select state */
        /*  $('#select-city').focusout(function() {
             
         }) */



    });
    window.addEventListener('click', function(e) {
        if (document.getElementById('citybx').contains(e.target)) {
            // Clicked in box
        } else {
            $('#city_list').hide();
            $('#city_remark').hide()
        }
        if (document.getElementById('statebx').contains(e.target)) {
            // Clicked in box
        } else {
            $('#state_list').hide();
        }
    });
    /* select state function */
    function selectState(state) {
        $('#select-state').val(state);
        $('#select-state').valid();
        $('#select-city').val("");
        $('#state_list').hide();
        addressFieldChnage();
    }

    /* set selected city */
    function selectCity(state) {
        $('#select-city').val(state);
        $('#select-city').valid();
        $('#city_list').hide();
        $('#city_remark').hide()
        addressFieldChnage();
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
                //sentotplogin();
                //$('#goto-otp-btn').click();

            } else {
                $('#wait_otp_div').show();
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

function searchCity() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    if(input.value.length >= 3 || input.value == '')
    {
            $.ajax({
                url: "{{ url('/searchCity',) }}",
                type: "GET",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    'search_text': input.value
                },
                success: function(response_data) {
                    let html = '';
                    var data = jQuery.parseJSON(response_data);

                    if (data.success === true) {

                        html += data.response;

                    } else {
                        html += `<li>Cities</li>`;
                    }
                    $('#myMenu').html(html);
                }
            });
    }             
}

    function searchState() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInputState");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myStateList");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            txtValue = li[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>!--->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<section class="d-flex h-100 login-signup">
   <div class="left-sidepannel d-flex flex-column justify-content-between position-relative">
      <figure class="pb-4">
         <a href="javascript:void(0);">
            <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g filter="url(#dxjwe095ea)">
                  <path d="M28 4.8H8.8V24H28V4.8zM47.195 24.001h-19.2v19.2h19.2V24z" fill="#38D430"/>
                  <path d="M47.195 4.8h-19.2V24h19.2V4.8z" fill="#00AB16"/>
                  <path d="m39.82 18.625 1.614 1.664h1.864L40.702 17.6l1.664-1.93v-1.928l-2.546 2.944-2.446-2.53.716-.511c.832-.616 1.664-1.431 1.664-2.596 0-1.68-1.28-2.795-3.029-2.795-1.514 0-2.995 1.081-2.995 2.878 0 1.099.816 1.98 1.365 2.56l.35.366-.234.167c-1.248.915-2.063 1.792-2.063 3.278 0 1.514 1.165 3.013 3.328 3.013 1.331 0 2.346-.75 3.344-1.892zm-4.692-7.578a1.565 1.565 0 0 1 1.597-1.597c.982 0 1.631.699 1.631 1.564 0 .583-.25 1.082-.965 1.598l-.882.665-.466-.499c-.449-.45-.915-1.048-.915-1.73zm-.582 6.34c0-.915.532-1.497 1.181-1.98l.583-.45 2.645 2.746-.1.117c-.682.782-1.43 1.398-2.362 1.398-1.215 0-1.947-.916-1.947-1.83zm-10.034-2.986a6.124 6.124 0 1 0-6.134 6.144 5.962 5.962 0 0 0 3.5-1.178l1.007 1.011h2.91l-2.46-2.47a6 6 0 0 0 1.177-3.507zm-2.762 1.92-1.674-1.68h-2.91l3.136 3.15a3.919 3.919 0 1 1 1.448-1.47zm12.208 11.392h7.296v2.159h-2.498v7.458h2.488v2.158h-7.296v-2.155h2.504v-7.458h-2.494v-2.162z" fill="#1F1F1F"/>
               </g>
               <defs>
                  <filter id="dxjwe095ea" x=".8" y=".8" width="54.395" height="54.401" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                     <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                     <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                     <feOffset dy="4"/>
                     <feGaussianBlur stdDeviation="4"/>
                     <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0"/>
                     <feBlend in2="BackgroundImageFix" result="effect1_dropShadow_757_2052"/>
                     <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                     <feOffset dy="4"/>
                     <feGaussianBlur stdDeviation="4"/>
                     <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0"/>
                     <feBlend in2="effect1_dropShadow_757_2052" result="effect2_dropShadow_757_2052"/>
                     <feBlend in="SourceGraphic" in2="effect2_dropShadow_757_2052" result="shape"/>
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
         <p>Already have an account? <a href="javascript:void(0);">Login</a></p>
         <form>
            <div class="custom-input pb-4">
               <label>Name</label>
               <input type="text" class="form-control" placeholder="Full name">
            </div>
            <div class="custom-input pb-4 position-relative">
               <label>Mobile</label>
               <input type="text" maxlength="10" class="form-control" placeholder="Mobile no">
            </div>
            <div class="custom-input pb-4 position-relative d-none">
               <label>Mobile</label>
               <input type="text" maxlength="10" class="form-control" placeholder="Mobile no">
               <a class="editnumber verifyno">Verify</a>
            </div>
            <div class="custom-input changeno pb-3 d-none">
               <label>Mobile</label>
               <div class="d-flex position-relative">
                  <input type="text" maxlength="10" class="form-control bg-white" placeholder="Mobile no">
                  <span class="position-absolute sentotp">OTP sent</span>
                  <a class="editnumber" href="javascript:void(0);" class="d-block bg-white">
                     <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 13.333h6M11 2.333a1.414 1.414 0 1 1 2 2l-8.333 8.334L2 13.333l.667-2.666L11 2.333z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     </svg>
                     &nbsp;Edit
                  </a>
               </div>
            </div>
            <div class="custom-input pb-3">
               <label>Enter OTP</label>
               <div class="d-flex enterotp bg-white">
                  <input class="form-control" maxlength="1"><input class="form-control" maxlength="1"><input class="form-control" maxlength="1"><input class="form-control" maxlength="1"><input class="form-control" maxlength="1">    
               </div>
               <p class="p-0 mt-2 resend">Didn’t get the code? <a href="javascript:void(0);">Resend</a></p>
            </div>
            <div class="custom-input pb-4">
               <label>Email</label>
               <input type="email" class="form-control" placeholder="Email address">
            </div>
            <div class="custom-input pb-4">
               <label>City</label>
               <select id="single" class="js-states form-control">
                  <option>Mohali</option>
                  <option>Jind</option>
                  <option>Narwana</option>
                  <option>Kaithal</option>
               </select>
            </div>
            <div class="custom-input pb-4 row">
               <div class="col-lg-6">
                  <label>Grade</label>
                  <select class="form-control selectdata">
                     <option class="we">Select</option>
                     <option class="we2">1</option>
                     <option>2</option>
                  </select>
               </div>
               <div class="col-lg-6">
                  <label>Exam</label>
                  <select class="form-control selectdata">
                     <option>Select</option>
                     <option>Neet</option>
                     <option>Jee</option>
                  </select>
               </div>
            </div>
            <div class="Get-otp pt-4">
               <button type="submit" class="btn btn-common-green text-white w-100 disabled">Continue</button>    
            </div>
         </form>
      </div>
      <h3 class="copyright text-center pt-4">By clicking continue, you agree to our<br> <a href="javascript:void(0);">Terms & Conditions </a>and <a href="javascript:void(0);">Privacy Policy</a>.</h3>
   </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
   $("#single").select2({
       placeholder: "Select a City",
       allowClear: true
   });
   $("#multiple").select2({
       placeholder: "Select a City",
       allowClear: true
   });
</script>
@endsection