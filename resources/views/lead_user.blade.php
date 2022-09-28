@extends('layouts.app')
@section('content')
<style>
    @media screen and (max-width:767px){
        .contact-section {padding: 12px 0px 0px;}
        .email-sec > h2 {font-size: 16px;}
        .email-sec input#exampleFormControlInput1::placeholder {
    color: rgba(54, 60, 79, 0.5) !important;
}
.email-sec .btn.btn-common-green { margin-top: 60px;}
.terms-sec {padding: 24px 0px;}
.missing-info-section {
    position: static;
    max-width: 380px;
    padding: 40px 16px 20px;
    top: inherit;
    left: inherit;
    transform: inherit;
    margin: 0 auto;
    width: 100%;
}
.contact-num label > a {color: #363c4f !important;}
.contact-num > label, .city-sec > label {
    font-size: 14px;
    font-weight: 800;
    color: #363c4f;
    padding-left: 6px;
}
.name-title {
    background: #e0f6e3;
    padding: 20px 0px;
    border-radius: 10px;
}
.logo_sec {
    padding-bottom: 40px;
}

    }
</style>
<div class="missing-info-main body-color">
    <div class="logo-fullpage mobile_hide">
    <svg width="56" height="56" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#wign0frmma)">
                    <path d="M24 4.001H8v16h16V4zM39.996 20.002h-16v16h16v-16z" fill="#38D430" />
                    <path d="M39.996 4.001h-16v16h16V4z" fill="#00AB16" />
                    <path d="m33.851 15.522 1.345 1.386h1.553l-2.163-2.24 1.387-1.608v-1.606l-2.122 2.453-2.038-2.108.596-.426c.693-.513 1.387-1.193 1.387-2.164 0-1.4-1.067-2.33-2.524-2.33-1.262 0-2.496.902-2.496 2.4 0 .915.68 1.65 1.137 2.133l.291.305-.194.139c-1.04.762-1.72 1.493-1.72 2.731 0 1.262.971 2.511 2.774 2.511 1.11 0 1.955-.625 2.787-1.576zm-3.91-6.315a1.303 1.303 0 0 1 1.331-1.33c.818 0 1.359.582 1.359 1.303 0 .485-.208.9-.804 1.33l-.735.555-.389-.416c-.374-.374-.762-.873-.762-1.442zm-.485 5.283c0-.762.443-1.248.984-1.65l.485-.374 2.205 2.288-.083.097c-.569.652-1.193 1.165-1.97 1.165-1.011 0-1.621-.763-1.621-1.526zm-8.362-2.488a5.103 5.103 0 1 0-5.111 5.12 4.968 4.968 0 0 0 2.916-.982l.84.843h2.425l-2.05-2.059a5 5 0 0 0 .98-2.922zm-2.302 1.6-1.395-1.4h-2.424l2.613 2.624a3.265 3.265 0 1 1 1.206-1.224zm10.174 9.493h6.08v1.8h-2.082v6.215h2.073v1.798h-6.08v-1.796h2.087v-6.216h-2.078v-1.801z" fill="#1F1F1F" />
                </g>
                <defs>
                    <filter id="wign0frmma" x="0" y=".001" width="47.996" height="48" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="4" />
                        <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow_1768_17758" />
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="4" />
                        <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                        <feBlend in2="effect1_dropShadow_1768_17758" result="effect2_dropShadow_1768_17758" />
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow_1768_17758" result="shape" />
                    </filter>
                </defs>
            </svg>
    </div>
    <div class="missing-info-section">
        <div class="logo_sec mobile_block">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#wign0frmma)">
                    <path d="M24 4.001H8v16h16V4zM39.996 20.002h-16v16h16v-16z" fill="#38D430" />
                    <path d="M39.996 4.001h-16v16h16V4z" fill="#00AB16" />
                    <path d="m33.851 15.522 1.345 1.386h1.553l-2.163-2.24 1.387-1.608v-1.606l-2.122 2.453-2.038-2.108.596-.426c.693-.513 1.387-1.193 1.387-2.164 0-1.4-1.067-2.33-2.524-2.33-1.262 0-2.496.902-2.496 2.4 0 .915.68 1.65 1.137 2.133l.291.305-.194.139c-1.04.762-1.72 1.493-1.72 2.731 0 1.262.971 2.511 2.774 2.511 1.11 0 1.955-.625 2.787-1.576zm-3.91-6.315a1.303 1.303 0 0 1 1.331-1.33c.818 0 1.359.582 1.359 1.303 0 .485-.208.9-.804 1.33l-.735.555-.389-.416c-.374-.374-.762-.873-.762-1.442zm-.485 5.283c0-.762.443-1.248.984-1.65l.485-.374 2.205 2.288-.083.097c-.569.652-1.193 1.165-1.97 1.165-1.011 0-1.621-.763-1.621-1.526zm-8.362-2.488a5.103 5.103 0 1 0-5.111 5.12 4.968 4.968 0 0 0 2.916-.982l.84.843h2.425l-2.05-2.059a5 5 0 0 0 .98-2.922zm-2.302 1.6-1.395-1.4h-2.424l2.613 2.624a3.265 3.265 0 1 1 1.206-1.224zm10.174 9.493h6.08v1.8h-2.082v6.215h2.073v1.798h-6.08v-1.796h2.087v-6.216h-2.078v-1.801z" fill="#1F1F1F" />
                </g>
                <defs>
                    <filter id="wign0frmma" x="0" y=".001" width="47.996" height="48" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="4" />
                        <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow_1768_17758" />
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="4" />
                        <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                        <feBlend in2="effect1_dropShadow_1768_17758" result="effect2_dropShadow_1768_17758" />
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow_1768_17758" result="shape" />
                    </filter>
                </defs>
            </svg>
        </div>
        <div class="profile-sec">
            <div class="name-title">
                <span><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x=".5" y=".5" width="39" height="39" rx="9.5" fill="#fff" stroke="#E9EEF4" />
                        <path d="M26.667 27.5v-1.667a3.333 3.333 0 0 0-3.334-3.333h-6.666a3.333 3.333 0 0 0-3.334 3.333V27.5M20 19.167a3.333 3.333 0 1 0 0-6.667 3.333 3.333 0 0 0 0 6.667z" stroke="#1F1F1F" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <label id="user_name">{{$lead_user_data['FirstName']}} {{$lead_user_data['LastName']}}</label>
                <div class="contact-section">
                    <div class="contact-num">
                        <span>Mobile</span>
                        <label>{{$lead_user_data['Mobile']}}</label>
                    </div>
                    <div class="city-sec">
                        <span>City</span>
                        <label id="location">{{$lead_user_data['mx_City']}}</label>
                    </div>
                </div>
                <div class="contact-section">
                    <div class="contact-num">
                        <span>Grade</span>
                        <label>{{$lead_user_data['mx_Grade']}}</label>
                    </div>
                    <div class="city-sec">
                        <span>Exam</span>
                        <label>{{$lead_user_data['mx_Exam_to_prepare']}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="email-sec">
            <h2>Provide email to start journey.</h2>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control email_input" id="exampleFormControlInput1" placeholder="Email address" maxlength="35">
                <span class="email_error" style="color:red">Please enter valid email id</span>
                @if($trail==1)
                <button type="button" id="free_trail" class="btn btn-common-green text-white trail" style="cursor:default">Start Free Trial</button>
                @else
                <button type="button" id="subscribe_now" class="btn btn-common-green text-white trail" style="cursor:default">Subscribe Now</button>
                @endif
                <div class="terms-sec">
                    <p>By clicking continue, you agree to our <a href="{{env('CMS_URL')}}terms-of-use/" target="_blank">Terms & Conditions</a> and <a href="{{env('CMS_URL')}}privacy-policy/" target="_blank">Privacy Policy.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="state" id="state" value="{{$lead_user_data['mx_State']}}">
<script type="text/javascript">
$('.email_error').hide();
$('.email_input').keyup(function() {
    var input_data = $(this).val();
    if (input_data == '') {
        $('.trail').attr('disabled', 'disabled');
        $('.trail').addClass("disabled-btn");
        $('.trail').attr('style', 'background:#a9e1b0 !important');
        $('.trail').attr('cursor', 'default');
    } else {
        $('.trail').removeAttr('disabled');
        $('.trail').removeClass("disabled-btn");
        $('.trail').attr('style', 'background: #56b663 !important');
        $('.trail').attr('cursor', 'pointer');
    }
});
$('.email_input').blur(function() {
    var input_data = $(this).val();
    if (!isValidEmail(input_data)) {
        $('.email_error').text('Please enter valid email id');
        $('.email_error').show();
        $('.trail').attr('disabled', 'disabled');
        $('.trail').addClass("disabled-btn");
        $('.trail').attr('style', 'background:#a9e1b0 !important');
        $('.trail').attr('cursor', 'default');
    } else {
        $('.email_error').hide();
    }
});
$('.trail').click(function() {
    var ids = $(this).attr('id');
    var email = $(".email_input").val();
    if (email) {
        var mobile_num = <?php echo $lead_user_data['Mobile'] ?>;
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
                    var register_otp = Array.from(String(response.otp), Number);
                    var user_name = '<?php echo $lead_user_data["FirstName"] .' '. $lead_user_data["LastName"];?>';
                    var email_add = $(".email_input").val();
                    var location = '<?php echo $lead_user_data["mx_City"]?>';
                    var exam = <?php echo $lead_user_data['mx_Exam_id']?>;
                    var grade_stage = <?php echo $lead_user_data['mx_Grade_id']?>;
                    var refer_code = '';
                    var referral_email = '';
                    var state = $("#state").val();
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
                            state: state,
                            refer_code: refer_code,
                            refer_email: referral_email,
                        },
                        success: function(response_data) {
                            var response = jQuery.parseJSON(response_data);

                            if (response.status == 400) {

                                $('.email_error').show();
                                $('.email_error').text(response.msg);
                                setTimeout(function() {
                                    $(".email_error").fadeOut();
                                }, 5000);
                                return false
                            } else {
                                if (ids == 'free_trail') {
                                    var subscription_id = '';
                                    if (exam == 1) {
                                        subscription_id = 1;
                                    } else {
                                        subscription_id = 4;
                                    }
                                    var current_year = new Date().getFullYear();
                                    window.location.href = '{{url("trial_subscription")}}' + '/' + subscription_id + '/' + current_year + '/' + exam;
                                } else {
                                    window.location.href = '{{url("dashboard")}}';
                                }

                            }

                        },
                        error: function(xhr, b, c) {

                        }
                    });
                } else {
                    $('.email_error').show();
                    $('.email_error').text(response.message);
                    setTimeout(function() {
                        $(".email_error").fadeOut();
                    }, 5000);

                }

            },
        });
    }

});

function isValidEmail(email) {
    return /^([A-Za-z0-9_\-\.]+)@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,3})$/.test(email) &&
        /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(email);
}

$( document ).ready(function() {
    $(".body-color").parents("body").css("background", "#e0f6e3")
});
</script>
@endsection
