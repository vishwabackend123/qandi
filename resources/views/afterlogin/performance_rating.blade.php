@extends('layouts.app')
@section('content')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
$lead_exam_id = isset($userData->lead_exam_id) && !empty($userData->lead_exam_id) ?$userData->lead_exam_id:'';
$trail_sub = isset($userData->trail_sub) && !empty($userData->trail_sub) ?$userData->trail_sub:'';
@endphp
<?php $redis_data = Session::get('redis_data'); ?>
<div class="wihoutlogintoast">
    <div class="toastdata">
        <div class="toast-content">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 17C1 8.163 8.163 1 17 1s16 7.163 16 16-7.163 16-16 16S1 25.837 1 17z" fill="#8DFDB3" />
                <path d="M23.666 16.387V17a6.667 6.667 0 1 1-3.953-6.093m3.953.76L17 18.34l-2-2" stroke="#039855" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M17 32C8.716 32 2 25.284 2 17H0c0 9.389 7.611 17 17 17v-2zm15-15c0 8.284-6.716 15-15 15v2c9.389 0 17-7.611 17-17h-2zM17 2c8.284 0 15 6.716 15 15h2c0-9.389-7.611-17-17-17v2zm0-2C7.611 0 0 7.611 0 17h2C2 8.716 8.716 2 17 2V0z" fill="#BDF3C5" />
            </svg>
            <div class="message">
                <h5 class="mb-2 error_header"></h5>
                <p class="error_toast"></p>
            </div>
        </div>
        <div class="progress"></div>
    </div>
</div>
<section class="subscriptionsPage d-flex subscriptionNew">
    <div class="subscriptionsLeftpannel">
        <a href="{{env('CMS_URL')}}" target="_blank"> <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></a>
        <div class="progress-box">
            <ul class="progressorder">
                <li class="progress__item progress__item--completed">
                    <p class="progress__title">Select Plan</p>
                    <p class="progress__info">Decide on the best plan for your preparation</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
                <li class="progress__item   progress__item--active">
                    <p class="progress__title">Self Analysis</p>
                    <p class="progress__info">Rate your level of proficiency</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
                <li class="progress__item ">
                    <p class="progress__title">Personal Assessment Test</p>
                    <p class="progress__info">To assess your preparedness</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
            </ul>
        </div>
        @if($userData->email_verified=='No')
        <div class="verificationBox">
            <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
            <a href="javascript:void(0);" class="resend_email">Resend</a>
            <span class="mt-2" id="email_success"></span>
        </div>
        @endif
    </div>
    <div class="selectPlan subscriptionsRightpannel">
        <span class="mobile_block"><img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></span>
        <div class="SelectPlane_text">
            <h3 class="pageCountBox">Help us get to know you
                <span class="pagecount hideondesktop"><span class="activePage">2</span>/3</span>
            </h3>
            <p>Provide your latest school/board exam scores.</p>
        </div>
        <div class="performance_rating_wrapper">
            <div class="performanceNewWrapper">
                <div class="performanceInputWrapper">
                    @foreach($user_subjects as $subject_proficiency)
                    @php
                    $sub_sel_rating=isset($aStudentRating['additionalProp'.$subject_proficiency->id])?$aStudentRating['additionalProp'.$subject_proficiency->id]:'';
                    @endphp
                    <div class="custom-input">
                        <label>{{$subject_proficiency->subject_name}}*</label>
                        <div class="input-field" id="input_{{$subject_proficiency->subject_name}}">
                            <input type="text" class="form-control rating_input" placeholder="Type here" onkeyup="checkValidRating(this.value,'{{$subject_proficiency->subject_name}}')" maxlength="3" value="{{$sub_sel_rating}}" data-id="additionalProp{{$subject_proficiency->id}}" onkeypress="return isNumber(event)">
                            <div class="Floattext">
                                <span class="input-group-text">100</span>
                            </div>
                        </div>
                        <span class="scoreError" id="error_{{$subject_proficiency->subject_name}}">Score should be out of 100. Please enter a valid score.</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class=" mt-5 d-flex justify-content-between align-items-center pt-4">
                <div class="backBtn pt-0 mr-2">
                    @if (!Session::has('lead_trail_status'))
                    <a href="{{route('subscriptions')}}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M10 4 6 8l4 4" stroke="#363C4F" stroke-opacity=".8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        Back
                    </a>
                    @endif
                </div>
                <button class="btn btn-common-green @if(empty($aStudentRating)) disabled @endif" @if(empty($aStudentRating)) disabled @endif id="store_rating" onclick="store_rating();">Continue</button>
            </div>
            <div class="verificationBox mobile_block">
                <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
                <a href="javascript:void(0);" class="resend_email">Resend</a>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('.scoreError').hide();
    $('#email_success').hide();
    $('.toastdata').hide();
    $('.progress').hide();
    $('.resend_email').click(function() {
        var user_id = '<?php echo $user_id; ?>';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('send_verfication_email') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                userId: user_id,
            },
            success: function(response_data) {
                $('.toastdata').show();
                $('.progress').show();
                $('.toastdata').addClass('active');
                $('.progress').addClass('active');
                $('.error_header').text("Email Verification Link Sent");
                if (response_data.status === true) {
                    $('.error_toast').text("A verification link has been sent, please click the link to get your account verified.");
                } else {
                    $('.error_toast').text(response_data.message);
                }
                setTimeout(function() {
                    $(".toastdata").removeClass('active');
                    $(".progress").removeClass('active');
                    $('.toastdata').hide();
                    $('.progress').hide();
                }, 10000);

            },
        });
    });
});

function selectProficiencyLevel(id, pr_level) {
    $(".subject_" + id).removeClass('selected-level');
    $("#user_pro_level_" + id + "_" + pr_level).addClass('selected-level');
    $('#store_rating').removeAttr("disabled");
    $('#store_rating').removeClass("disabled");
}

function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}


function store_rating() {
    let subjects_rating = {};
    $('.rating_input').each(function() {


        var name = $(this).attr('data-id');
        var value = $(this).val();;

        subjects_rating[name] = value;
    });


    $.ajax({
        url: "{{ url('/dailyWelcomeUpdates') }}",
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            storeddata: subjects_rating,
        },
        beforeSend: function() {},
        success: function(response_data) {
            var response = jQuery.parseJSON(response_data);
            if (response.success == true) {
                window.location.href = '{{url("performance_analytics")}}';
            }


        },
        error: function(xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        }
    });
}

function checkValidRating(valueData, subject) {
    checkValueOrNot();
    if (valueData) {
        if (Number(valueData) > 100) {
            $('#error_' + subject).show();
            $('#input_' + subject).addClass('inputerror');
            $('#store_rating').attr('disabled', true);
            $('#store_rating').addClass("disabled");
        } else {
            $('#error_' + subject).hide();
            $('#input_' + subject).removeClass('inputerror');
        }

    }
}
$('.rating_input').keyup(function() {
    checkValueOrNot();
});

function checkValueOrNot() {
    var isNumber = 0;
    var inputcount = $(".rating_input").length;
    $(".rating_input").each(function() {
        var valu = $(this).val();
        if (valu) {
            if (Number(valu) <= 100) {
                isNumber++;
            }

        }
    });
    if (isNumber == inputcount) {
        $('#store_rating').removeAttr("disabled");
        $('#store_rating').removeClass("disabled");
    } else {
        $('#store_rating').attr('disabled', true);
         $('#store_rating').addClass("disabled");
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

</script>
@endsection
