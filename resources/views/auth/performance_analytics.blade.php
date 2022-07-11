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
                <li class="progress__item progress__item--completed">
                    <p class="progress__title">Self Analysis</p>
                    <p class="progress__info">Rate your level of proficiency</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
                <li class="progress__item   progress__item--active">
                    <p class="progress__title">Full Body Scan</p>
                    <p class="progress__info">To assess your preparedness</p>
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
            <h3>Full Body Scan</h3>
            <p>To assess your preparedness</p>
        </div>
        <div class="fullbody_scan_wrapper">
            <div class="fullbody_scan_box d-flex">
                <div class="fullbody_scan_card w-50">
                    <p class="mt-0">Please attempt the Full Body Scan test, so that we can generate tasks for you, based on your proficiency levels.</p>
                    <span class="custom-border"></span>
                    <ul style="margin-top:32px">
                        <li class="mb-3">No of Questions: <span>{{$prof_test_qcount}} questions</span></li>
                        <li class="mb-3">Duration <span>3 hours</span></li>
                        <li>Subjects <span>{{$subjects_name}}</span></li>
                    </ul>
                </div>
                <div class="fullbody_scan_test w-50 text-center position-relative">
                    <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-big.png')}}"></span>
                    <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-small.png')}}"></span>
                    <img src="{{URL::asset('public/after_login/current_ui/images/note.png')}}" style="width: 106.5px;height: 116px;">
                    <h3 class="mb-0 mt-2">Full Body Scan Test</h3>
                    <p class="my-3">to assess your preparedness and begin to improve it</p>
                    @if($full_body_attempt=="Y")
                    <a class="btn btn-common-white disabled" href="javescript:void(0);">Attempted</a>
                    @else
                    <a class="btn btn-common-white" href="{{route('exam','full_exam')}}">Attempt Now</a>
                    @endif
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-between align-items-center pt-4">
                <div class="backBtn pt-0 mr-2">
                    <a href="{{ url('subscriptions') }}">
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
</script>
@endsection