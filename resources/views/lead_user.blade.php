@extends('layouts.app')
@section('content')
<div class="missing-info-main">
    <div class="missing-info-section">
        <div class="profile-sec">
            <div class="name-title">
                <span><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x=".5" y=".5" width="39" height="39" rx="9.5" fill="#fff" stroke="#E9EEF4" />
                        <path d="M26.667 27.5v-1.667a3.333 3.333 0 0 0-3.334-3.333h-6.666a3.333 3.333 0 0 0-3.334 3.333V27.5M20 19.167a3.333 3.333 0 1 0 0-6.667 3.333 3.333 0 0 0 0 6.667z" stroke="#1F1F1F" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <label id="user_name">{{$lead_user_data['FirstName']}}</label>
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
            <h2>Provide email to start journey</h2>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control email_input" id="exampleFormControlInput1" placeholder="Email Address">
                <span class="email_error" style="color:red">Please enter valid email id</span>
                @if($trail==1)
                <button type="button" id="free_trail" class="btn btn-common-green text-white trail">Start Free Trial</button>
                @else
                <button type="button" id="subscribe_now" class="btn btn-common-green text-white trail">Subscribe Now</button>
                @endif
                <div class="terms-sec">
                    <p>By clicking continue, you agree to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy.</a></p>
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
    } else {
        $('.trail').removeAttr('disabled');
        $('.trail').removeClass("disabled-btn");
        $('.trail').attr('style', 'background: #56b663 !important');
    }
});
$('.email_input').blur(function() {
    var input_data = $(this).val();
    if (!isValidEmail(input_data)) {
        $('.email_error').show();
        $('.trail').attr('disabled', 'disabled');
        $('.trail').addClass("disabled-btn");
        $('.trail').attr('style', 'background:#a9e1b0 !important');
    } else {
        $('.email_error').hide();
    }
});
$('.trail').click(function() {
    //var mobile_num =<?php echo $lead_user_data['Mobile'] ?>;
    var mobile_num = 9990344765;
    url = "{{ url('sentMobileOtp/') }}/" + mobile_num;
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response_data) {
            var response = jQuery.parseJSON(response_data);
            var register_otp = response.otp;
            var user_name = '<?php echo $lead_user_data["FirstName"]?>';
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
                        if (response.msg === 'Wrong OTP') {

                        } else if (response.msg === 'User already registered') {

                        } else {

                        }
                        return false
                    } else {
                        window.location.href = '{{url("dashboard")}}';
                    }

                },
                error: function(xhr, b, c) {

                }
            });
        },
    });
});

function isValidEmail(email) {
    return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(email) &&
        /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(email);
}

</script>
@endsection
