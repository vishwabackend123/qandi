@extends('layouts.app')
@section('content')
<div class="plan_successfull_wrapper">
    <div class="plan_successfull_heder_icon">
        <a href="{{env('CMS_URL')}}" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="66" viewBox="0 0 64 66" fill="none" class="plan_successfull_heder_icon_img">
                <g filter="url(#67epj5et9a)">
                    <path d="M32 6H8v24h24V6zM55.993 30.002H31.994V54h24V30z" fill="#38D430" />
                    <path d="M55.993 6H31.994v24h24V6z" fill="#00AB16" />
                    <path d="m46.775 23.281 2.018 2.08h2.33l-3.245-3.36 2.08-2.413V17.18l-3.183 3.68-3.057-3.162.894-.64c1.04-.77 2.08-1.788 2.08-3.244 0-2.101-1.6-3.495-3.785-3.495-1.893 0-3.744 1.352-3.744 3.599 0 1.372 1.019 2.475 1.705 3.2l.437.457-.291.208c-1.56 1.144-2.58 2.24-2.58 4.098 0 1.892 1.457 3.766 4.16 3.766 1.664 0 2.933-.938 4.181-2.365zM40.91 13.81a1.958 1.958 0 0 1 1.997-1.997c1.227 0 2.038.873 2.038 1.955 0 .728-.312 1.352-1.206 1.997l-1.103.832-.582-.624c-.562-.562-1.144-1.31-1.144-2.164zm-.728 7.924c0-1.144.665-1.872 1.477-2.475l.728-.562 3.307 3.432-.125.146c-.853.977-1.789 1.747-2.954 1.747-1.518 0-2.433-1.144-2.433-2.288zM27.64 18.001a7.653 7.653 0 1 0-7.667 7.68 7.452 7.452 0 0 0 4.374-1.472l1.259 1.264h3.638l-3.075-3.088a7.5 7.5 0 0 0 1.47-4.384zm-3.453 2.4-2.093-2.099h-3.636l3.92 3.936a4.9 4.9 0 1 1 1.81-1.837zm15.26 14.24h9.12v2.699h-3.123v9.323h3.11v2.697h-9.12v-2.694h3.13v-9.323h-3.117v-2.702z" fill="#1F1F1F" />
                </g>
                <defs>
                    <filter id="67epj5et9a" x="0" y="2" width="63.993" height="64.001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="4" />
                        <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow_532_2530" />
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="4" />
                        <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                        <feBlend in2="effect1_dropShadow_532_2530" result="effect2_dropShadow_532_2530" />
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow_532_2530" result="shape" />
                    </filter>
                </defs>
            </svg>
        </a>
    </div>
    <div class="email-confirmation token_verfiy">
        <div class="email-profile-pick">
            @if(isset($response_json['message']) && !empty($response_json['message']) && ($response_json['message'] == 'Token Expired, please resend email verification' || $response_json['message'] == 'Invald Token'))
            <svg width="101" height="100" viewBox="0 0 101 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50.5" cy="50" r="50" fill="#FEF0C7" />
                <path d="M50 43.793v-9.655c8.702 0 15.862 7.16 15.862 15.862S58.702 65.862 50 65.862 34.138 58.702 34.138 50c0-4.206 1.672-8.243 4.645-11.217" stroke="#DC6803" stroke-width="2.5" stroke-miterlimit="10" />
                <path d="M42.128 44.078a1.379 1.379 0 1 1 1.95-1.95l7.872 5.921a2.759 2.759 0 1 1-3.9 3.901l-5.922-7.872z" fill="#DC6803" />
            </svg>
            @else
            <svg width="101" height="100" viewBox="0 0 101 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50.5" cy="50" r="50" fill="#E0F6E3" />
                <path d="M58.834 64.167H42.166c-5 0-8.334-2.5-8.334-8.334V44.168c0-5.834 3.334-8.334 8.334-8.334h16.666c5 0 8.334 2.5 8.334 8.334v11.666c0 5.834-3.334 8.334-8.334 8.334z" stroke="#039855" stroke-width="2.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                <path d="m58.833 45-5.216 4.167c-1.717 1.366-4.534 1.366-6.25 0L42.166 45" stroke="#039855" stroke-width="2.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            @endif
        </div>
        @if(isset($response_json['message']) && !empty($response_json['message']) && $response_json['message'] == 'Token Expired, please resend email verification')
        <p class="email_head"><span>Email link Expired</span></p>
        <p><label><b>{{$response_json['email']}}</b> is not Verified yet. </label></p>
        <span class="mt-2" id="email_success"></span>
        <div class="d-flex align-items-center justify-content-center">
            <a href="javascript:void(0)" class="btn btn-common-transparent nobg w-50 resend_email" style="padding: 10px 40px;margin:24px 12px 0px 0px;"> Resend</a>
            <a href="{{ url('/dashboard') }}" class="btn btn-common-green w-50"> Continue</a>
        </div>
        @elseif(isset($response_json['message']) && !empty($response_json['message']) && $response_json['message'] == 'Invald Token')
        <p class="email_head"><span>Invalid token</span></p>
        <p><label><b></b> Invalid token</label></p>
        @else
        <p class="email_head"><span>{{$message_success}}</span></p>
        @if($message_success == 'Email already Verified')
        <p><label><b>{{$response_json['email']}}</b> is Verified. </label></p>
        @else
        <p><label><b>{{$response_json['email']}}</b> is now Verified. </label></p>
        @endif
        <div class="d-flex align-items-center justify-content-center">
            <a href="{{ url('/dashboard') }}" class="btn btn-common-green w-50"> Continue</a>
        </div>
        @endif
    </div>
    @if(isset($response_json['student_id']))
    <div class="email-confirmation email_send">
        <div class="email-profile-pick">
            <svg width="101" height="100" viewBox="0 0 101 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50.5" cy="50" r="50" fill="#E0F6E3" />
                <path d="M58.834 64.167H42.166c-5 0-8.334-2.5-8.334-8.334V44.168c0-5.834 3.334-8.334 8.334-8.334h16.666c5 0 8.334 2.5 8.334 8.334v11.666c0 5.834-3.334 8.334-8.334 8.334z" stroke="#039855" stroke-width="2.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                <path d="m58.833 45-5.216 4.167c-1.717 1.366-4.534 1.366-6.25 0L42.166 45" stroke="#039855" stroke-width="2.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <p class="email_head"><span>Email link Sent</span></p>
        <p><label><b></b> A verification link has been sent to <strong>{{$response_json['email']}}</strong>, please click the link to get your account verified</label></p>
        <div class="d-flex align-items-center justify-content-center">
            <a href="{{ url('/dashboard') }}" class="btn btn-common-green w-50"> Continue</a>
        </div>
    </div>
    @endif
</div>
<script type="text/javascript">
$('.email_send').hide();

</script>
@if(isset($response_json['student_id']))
<script type="text/javascript">
$('#email_success').hide();
$('.resend_email').click(function() {
    $('.email-error').hide();
    var user_id = '<?php echo $response_json["student_id"]; ?>';
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

                $('.email_send').show();

            } else {
                $('#email_success').css('color', 'red');
                $('#email_success').text(response_data.message);
                $('#email_success').show();
                $("#email_success").fadeOut(10000);
                setTimeout(function() {
                    $('.email-error').show();
                }, 2000);
            }

        },
    });
});

</script>
@endif
@endsection
