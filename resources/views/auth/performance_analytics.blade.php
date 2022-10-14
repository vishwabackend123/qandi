@extends('layouts.app')
@section('content')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
$lead_exam_id = isset($userData->lead_exam_id) && !empty($userData->lead_exam_id) ?$userData->lead_exam_id:'';
$trail_sub = isset($userData->trail_sub) && !empty($userData->trail_sub) ?$userData->trail_sub:'';
$full_body_attempt = Session::get('full_body_attempt');

@endphp
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
<section class="subscriptionsPage d-flex fullbody_scan_page">
    <div class="subscriptionsLeftpannel">
        <a href="{{env('CMS_URL')}}" target="_blank"><img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></a>
        <div class="progress-box">
            <ul class="progressorder">
                <li class="progress__item progress__item--completed">
                    <p class="progress__title">Select Plan</p>
                    <p class="progress__info">Decide on the best plan for your preparation</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
                <li class="progress__item progress__item--completed">
                    <p class="progress__title">Self Analysis</p>
                    <p class="progress__info">Rate your level of proficiency</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
                <li class="progress__item   progress__item--active">
                    <p class="progress__title">Personalized Preparation Assessment</p>
                    <p class="progress__info">To assess your preparedness</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
            </ul>
        </div>
        @if($userData->email_verified=='No')
        <div class="verificationBox tab_show_performence_analytics tab_show">
            <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
            <a href="javascript:void(0);" class="resend_email">Resend</a>
            <span class="mt-2" id="email_success"></span>
        </div>
        @endif
    </div>
    <div class="selectPlan subscriptionsRightpannel">
        <span class="tab_show_performence_analytics tab_show desktop_hide_performence_analytics"><img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></span>
        <div class="SelectPlane_text">
            <h3 class="pageCountBox">Personalized Preparation Assessment
                <span class="pagecount hideondesktop"><span class="activePage">2</span>/3</span>
            </h3>
            <p>To assess your preparedness</p>
        </div>
        <div class="verificationBox mt-0 desktop_hide_performence_analytics">
            <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
            <a href="javascript:void(0);" class="resend_email">Resend</a>
        </div>
        <div class="fullbody_scan_wrapper">
            <div class="fullbody_scan_box d-flex">
                <div class="fullbody_scan_card w-50">
                    <p class="mt-0">Please attempt the Personalized Preparation Assessment, so that we can generate tasks based on your proficiency levels.</p>
                    <span class="custom-border"></span>
                    <ul style="margin-top:32px">
                        <li class="mb-3">No of Questions: <span>{{$prof_test_qcount}} questions</span></li>
                        <li class="mb-3">Duration <span>3 hours</span></li>
                        <li>Subjects <span>{{$subjects_name}}</span></li>
                    </ul>
                </div>
                <div class="fullbody_scan_test w-50 text-center position-relative">
                    <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-big.svg')}}"></span>
                    <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-small.svg')}}"></span>
                    <span class="greenball-1">
                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 109 106" width="109" height="106">
                            <title>Mask group-svg</title>
                            <defs>
                                <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                    <path d="m-425 10c0-5.52 4.48-10 10-10h514c5.52 0 10 4.48 10 10v332c0 5.52-4.48 10-10 10h-514c-5.52 0-10-4.48-10-10z" />
                                </clipPath>
                            </defs>
                            <style>
                                .s0 {
                                    fill: #52ac5f
                                }
                            </style>
                            <g id="Clip-Path" clip-path="url(#cp1)">
                                <g id="Layer">
                                    <path id="Layer" class="s0" d="m82 103c-44.2 0-80-35.8-80-80 0-44.2 35.8-80 80-80 44.2 0 80 35.8 80 80 0 44.2-35.8 80-80 80z" />
                                    <path id="Layer" class="s0" d="m-437 372c-35.4 0-64-28.6-64-64 0-35.4 28.6-64 64-64 35.4 0 64 28.6 64 64 0 35.4-28.6 64-64 64z" />
                                    <path id="Layer" class="s0" d="m-4.5 307c-21.8 0-39.5-17.7-39.5-39.5 0-21.8 17.7-39.5 39.5-39.5 21.8 0 39.5 17.7 39.5 39.5 0 21.8-17.7 39.5-39.5 39.5z" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="greenball-2">
                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 53 109" width="53" height="109">
                            <title>Mask group-svg</title>
                            <defs>
                                <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                    <path d="m0-233c0-5.52 4.48-10 10-10h514c5.52 0 10 4.48 10 10v332c0 5.52-4.48 10-10 10h-514c-5.52 0-10-4.48-10-10z" />
                                </clipPath>
                            </defs>
                            <style>
                                .s0 {
                                    fill: #52ac5f
                                }
                            </style>
                            <g id="Clip-Path" clip-path="url(#cp1)">
                                <g id="Layer">
                                    <path id="Layer" class="s0" d="m507-140c-44.2 0-80-35.8-80-80 0-44.2 35.8-80 80-80 44.2 0 80 35.8 80 80 0 44.2-35.8 80-80 80z" />
                                    <path id="Layer" class="s0" d="m-12 129c-35.4 0-64-28.6-64-64 0-35.4 28.6-64 64-64 35.4 0 64 28.6 64 64 0 35.4-28.6 64-64 64z" />
                                    <path id="Layer" class="s0" d="m420.5 64c-21.8 0-39.5-17.7-39.5-39.5 0-21.8 17.7-39.5 39.5-39.5 21.8 0 39.5 17.7 39.5 39.5 0 21.8-17.7 39.5-39.5 39.5z" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="greenball-3">
                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 87 88" width="87" height="88">
                            <title>Mask group-svg</title>
                            <defs>
                                <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                    <path d="m-377-211c0-5.52 4.48-10 10-10h514c5.52 0 10 4.48 10 10v332c0 5.52-4.48 10-10 10h-514c-5.52 0-10-4.48-10-10z" />
                                </clipPath>
                            </defs>
                            <style>
                                .s0 {
                                    fill: #52ac5f
                                }
                            </style>
                            <g id="Clip-Path" clip-path="url(#cp1)">
                                <g id="Layer">
                                    <path id="Layer" class="s0" d="m130-118c-44.2 0-80-35.8-80-80 0-44.2 35.8-80 80-80 44.2 0 80 35.8 80 80 0 44.2-35.8 80-80 80z" />
                                    <path id="Layer" class="s0" d="m-389 151c-35.4 0-64-28.6-64-64 0-35.4 28.6-64 64-64 35.4 0 64 28.6 64 64 0 35.4-28.6 64-64 64z" />
                                    <path id="Layer" class="s0" d="m43.5 86c-21.8 0-39.5-17.7-39.5-39.5 0-21.8 17.7-39.5 39.5-39.5 21.8 0 39.5 17.7 39.5 39.5 0 21.8-17.7 39.5-39.5 39.5z" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <img src="{{URL::asset('public/after_login/current_ui/images/note.svg')}}" style="width: 106.5px;height: 116px;">
                    <h3 class="mb-0 mt-2">Personalized Preparation Assessment</h3>
                    <p class="my-3">to assess your preparation. Take your first step to improvement.</p>
                    @if($full_body_attempt=="Y")
                    <a class="btn btn-common-white disabled" href="javescript:void(0);">Attempted</a>
                    @else
                    <a class="btn btn-common-white" href="{{route('exam',['full_exam','instruction'])}}">Attempt Now</a>
                    @endif
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-between align-items-center pt-4">
                <div class="backBtn pt-0 mr-2">
                    <a href="{{ url('performance-rating') }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M10 4 6 8l4 4" stroke="#363C4F" stroke-opacity=".8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        Back
                    </a>
                </div>
                <a class="btn btn-common-transparent" href="{{url('/dashboard')}}">Skip to Dashboard</a>
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
                    }, 10000);

                },
            });
        });
    });
</script>
@endsection