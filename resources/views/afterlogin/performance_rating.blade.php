@extends('layouts.app')
@section('content')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
$lead_exam_id = isset($userData->lead_exam_id) && !empty($userData->lead_exam_id) ?$userData->lead_exam_id:'';
$trail_sub = isset($userData->trail_sub) && !empty($userData->trail_sub) ?$userData->trail_sub:'';
@endphp
<section class="subscriptionsPage d-flex">
    <div class="subscriptionsLeftpannel">
        <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo">
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
                    <p class="progress__title">You order is out for delivery</p>
                    <p class="progress__info">Delivery Executive is out for delivery</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
            </ul>
        </div>
        <div class="verificationBox">
            <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified</p>
            <a href="javascript:void(0);" class="resend_email">Resend</a>
            <span class="mt-2" id="email_success"></span>
        </div>
    </div>
    <div class="selectPlan subscriptionsRightpannel">
        <div class="SelectPlane_text">
            <h3>Self Analysis</h3>
            <p>Rate your level of proficiency</p>
        </div>
        <div class="performance_rating_wrapper">
            @foreach($user_subjects as $subject_proficiency)
            <div class="subject-level-proficiency mb-5">
                <h5>{{$subject_proficiency->subject_name}}</h5>
                <ul class="proficiency-level-lists d-flex justify-content-beween flex-wrap">
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}}" data-id="{{$subject_proficiency->id}}" data-value="1" id="user_pro_level_{{$subject_proficiency->id}}_1" onclick="selectProficiencyLevel({{$subject_proficiency->id}},1)">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Beginner</label>
                    </li>
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}}" data-id="{{$subject_proficiency->id}}" data-value="2" id="user_pro_level_{{$subject_proficiency->id}}_2" onclick="selectProficiencyLevel({{$subject_proficiency->id}},2)">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Foundation level</label>
                    </li>
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}}" data-id="{{$subject_proficiency->id}}" data-value="3" id="user_pro_level_{{$subject_proficiency->id}}_3" onclick="selectProficiencyLevel({{$subject_proficiency->id}},3)">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Intermediate</label>
                    </li>
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}}" data-id="{{$subject_proficiency->id}}" data-value="4" id="user_pro_level_{{$subject_proficiency->id}}_4" onclick="selectProficiencyLevel({{$subject_proficiency->id}},4)">
                        <span class="mr-3">
                            <b></b>
                            <b></b>
                            <b></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                        </span>
                        <label class="mb-0">Proficient</label>
                    </li>
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}}" data-id="{{$subject_proficiency->id}}" data-value="5" id="user_pro_level_{{$subject_proficiency->id}}_5" onclick="selectProficiencyLevel({{$subject_proficiency->id}},5)">
                        <span class="mr-3">
                            <b></b>
                            <b></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Expert</label>
                    </li>
                </ul>
            </div>
            @endforeach
            <div class="mt-5 d-flex justify-content-between align-items-center pt-4">
                <div class="backBtn pt-0 mr-2">
                    <a href="{{route('subscriptions')}}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M10 4 6 8l4 4" stroke="#363C4F" stroke-opacity=".8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        Back
                    </a>
                </div>
                <button class="btn btn-common-green" onclick="store_rating();">Continue</button>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('#email_success').hide();
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
                if (response_data.status === true) {
                    $('#email_success').css('color', 'green');
                    $('#email_success').text(response_data.message);
                    $('#email_success').show();
                    $("#email_success").fadeOut(10000);
                } else {
                    $('#email_success').css('color', 'red');
                    $('#email_success').text(response_data.message);
                    $('#email_success').show();
                    $("#email_success").fadeOut(10000);
                }

            },
        });
    });
});

function selectProficiencyLevel(id, pr_level) {
    $(".subject_" + id ).removeClass('selected-level');
    $("#user_pro_level_" + id + "_" + pr_level).addClass('selected-level');
}
function isEmpty(obj) {
  return Object.keys(obj).length === 0;
}


function store_rating() {
    let subjects_rating = {};
    $('.selected-level').each(function() {


        var name = $(this).attr('data-id');
        var value = $(this).attr('data-value');;

        subjects_rating[name] = value;
    });
    if(isEmpty(subjects_rating))
    {
        alert("Please select at least one");
        return false;

    }

    $.ajax({
        url: "{{ url('/dailyWelcomeUpdates') }}",
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            storeddata: subjects_rating,
        },
        beforeSend: function() {},
        success: function(response_data) { 

            if (response_data == 'success') {
                window.location.href = '{{url("dashboard")}}';
            }

        },
        error: function(xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        }
    });
}

</script>
@endsection
