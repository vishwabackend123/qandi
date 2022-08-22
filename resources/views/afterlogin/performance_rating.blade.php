@extends('layouts.app')
@section('content')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
$lead_exam_id = isset($userData->lead_exam_id) && !empty($userData->lead_exam_id) ?$userData->lead_exam_id:'';
$trail_sub = isset($userData->trail_sub) && !empty($userData->trail_sub) ?$userData->trail_sub:'';
@endphp
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
        <div class="toast-close" onclick="toastClose()">
            <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M26 14 14 26M14 14l12 12" stroke="#1F1F1F" stroke-width="1.71" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="progress"></div>
    </div>
<section class="subscriptionsPage d-flex">
    <div class="subscriptionsLeftpannel">
       <a href="https://www.qanditoday.com/" target="_blank"> <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></a>
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
                    <p class="progress__title">Full Body Scan</p>
                    <p class="progress__info">To assess your preparedness</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
            </ul>
        </div>
         @if($userData->email_verified=='No')
        <div class="verificationBox">
            <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified</p>
            <a href="javascript:void(0);" class="resend_email">Resend</a>
            <span class="mt-2" id="email_success"></span>
        </div>
        @endif
    </div>
    <div class="selectPlan subscriptionsRightpannel">
        <span class="mobile_block"><img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></span>
        <div class="SelectPlane_text">
            <h3 class="pageCountBox">Self Analysis
            <span class="pagecount hideondesktop"><span class="activePage">2</span>/3</span>
            </h3>
            <p>Rate your level of proficiency</p>
        </div>
        <div class="performance_rating_wrapper">
            @foreach($user_subjects as $subject_proficiency)
            @php
            $sub_sel_rating=isset($aStudentRating[$subject_proficiency->id])?$aStudentRating[$subject_proficiency->id]:0;

            @endphp

            <div class="subject-level-proficiency mb-5">
                <h5>{{$subject_proficiency->subject_name}}</h5>
                <ul class="proficiency-level-lists d-flex justify-content-beween flex-wrap">
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}} @if($sub_sel_rating==1) selected-level @endif" data-id="{{$subject_proficiency->id}}" data-value="1" id="user_pro_level_{{$subject_proficiency->id}}_1" onclick="selectProficiencyLevel({{$subject_proficiency->id}},1)">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Beginner</label>
                    </li>
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}} @if($sub_sel_rating==2) selected-level @endif" data-id="{{$subject_proficiency->id}}" data-value="2" id="user_pro_level_{{$subject_proficiency->id}}_2" onclick="selectProficiencyLevel({{$subject_proficiency->id}},2)">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Foundation</label>
                    </li>
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}} @if($sub_sel_rating==3) selected-level @endif" data-id="{{$subject_proficiency->id}}" data-value="3" id="user_pro_level_{{$subject_proficiency->id}}_3" onclick="selectProficiencyLevel({{$subject_proficiency->id}},3)">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Intermediate</label>
                    </li>
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}} @if($sub_sel_rating==4) selected-level @endif" data-id="{{$subject_proficiency->id}}" data-value="4" id="user_pro_level_{{$subject_proficiency->id}}_4" onclick="selectProficiencyLevel({{$subject_proficiency->id}},4)">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Proficient</label>
                    </li>
                    <li class="user-proficiency-level subject_{{$subject_proficiency->id}} @if($sub_sel_rating==5) selected-level @endif" data-id="{{$subject_proficiency->id}}" data-value="5" id="user_pro_level_{{$subject_proficiency->id}}_5" onclick="selectProficiencyLevel({{$subject_proficiency->id}},5)">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                        </span>
                        <label class="mb-0">Expert</label>
                    </li>
                </ul>
            </div>
            @endforeach
            <div class="mt-5 d-flex justify-content-between align-items-center pt-4">
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
                <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified</p>
                <a href="javascript:void(0);" class="resend_email">Resend</a>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
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
                    }, 5000);

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
        $('.selected-level').each(function() {


            var name = $(this).attr('data-id');
            var value = $(this).attr('data-value');;

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

                if (response_data == 'success') {
                    window.location.href = '{{url("performance_analytics")}}';
                }

            },
            error: function(xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });
    }
</script>
@endsection