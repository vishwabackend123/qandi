<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Q&I</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />
    <style>
        .upInfo {
    max-width: 400px;
    width: 100%;
    margin: 0 auto;
    position: relative;
    background: white;
}

.upInfo .logo {
    text-align: center;
    margin: 15px;
}

.upInfo .verify-field {
    display: flex;
}

.upInfo .verify-field .btn {
    width: fit-content !important;
    color: #ffffff;
    background: #4caf50 !important;
    border: none !important;
    cursor: pointer;
}

.upInfo #contact {
    font-family: "Roboto", Helvetica, Arial, sans-serif;
    background: #4caf5014;
    padding: 25px;
    margin: 150px 0;
    box-shadow: 0 0 20px 0 rgb(0 0 0 / 20%), 0 5px 5px 0 rgb(0 0 0 / 24%);
    border-radius: 18px;
}

.upInfo #contact h3 {
    display: block;
    font-size: 30px;
    font-weight: 300;
    margin-bottom: 10px;
}

.upInfo fieldset {
    border: medium none !important;
    margin: 0 0 10px;
    min-width: 100%;
    padding: 0;
    width: 100%;
}

.upInfo #contact input[type="text"],
.upInfo #contact input[type="email"],
.upInfo #contact input[type="tel"],
.upInfo #contact input[type="button"] {
    width: 100%;
    border: 1px solid #ccc;
    background: #fff;
    margin: 0 0 5px;
    padding: 10px;
    font-size: 20px;
}

.upInfo #contact input[type="text"]:hover,
.upInfo #contact input[type="email"]:hover,
.upInfo #contact input[type="tel"]:hover {
    -webkit-transition: border-color 0.3s ease-in-out;
    -moz-transition: border-color 0.3s ease-in-out;
    transition: border-color 0.3s ease-in-out;
    border: 1px solid #aaa;
}

.upInfo #contact button[type="submit"] {
    cursor: pointer;
    width: 100%;
    border: none;
    background: #4caf50;
    color: #fff;
    margin: 0 0 5px;
    padding: 10px;
    font-size: 15px;
}

.upInfo #contact button[type="submit"]:hover {
    background: #43a047;
    -webkit-transition: background 0.3s ease-in-out;
    -moz-transition: background 0.3s ease-in-out;
    transition: background-color 0.3s ease-in-out;
}

.upInfo #contact button[type="submit"]:active {
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
}

.upInfo #contact input:focus {
    outline: 0;
    border: 1px solid #aaa;
}

.upInfo::-webkit-input-placeholder {
    color: #888;
}

.upInfo:-moz-placeholder {
    color: #888;
}

.upInfo::-moz-placeholder {
    color: #888;
}

.upInfo:-ms-input-placeholder {
    color: #888;
}

</style>
</head>
<div class="upInfo">
    <form id="contact" action="" method="post">
        <div class="logo"> <img src="{{URL::asset('public/after_login/new_ui/images/QI_Logo_al.gif')}}"></div>
        <input type="hidden" name="country" id="country" value="India">
        <input type="hidden" name="state" id="state" value="Bihar">
        <input type="hidden" name="city" id="city" value="{{$lead_user_data['mx_City']}}">
        <input type="hidden" name="exam_id" id="exam_id" value="{{$lead_user_data['mx_Exam_id']}}">
        <input type="hidden" name="trail" id="trail" value="{{$trail}}">
        <h3>Update Your Information</h3>
        <span id="errormsg" style="color:red"></span>
        <fieldset>
            <input placeholder="Your name" value="{{$lead_user_data['FirstName']}}" type="text" tabindex="1" required autofocus id="user_name">
        </fieldset>
        <fieldset class="verify-field">
            <input placeholder="Your Phone Number" value="{{$lead_user_data['Mobile']}}" type="tel" tabindex="3" required id="mobile_num">
            <input class="btn btn-default" value="Verifed" type="button" tabindex="3" required>
            </span>
        </fieldset>
        <fieldset>
            <input placeholder="Your Email Address" value="{{$lead_user_data['EmailAddress']}}" type="email" tabindex="2" required id="email_add">
        </fieldset>
        <fieldset>
            <input placeholder="Your City" value="{{$lead_user_data['mx_City']}}" type="text" tabindex="2" required>
        </fieldset>
        <fieldset>
            <input placeholder="Exam to prepare for" value="{{$lead_user_data['mx_Exam_to_prepare']}}" type="text" tabindex="2" required>
        </fieldset>
        <fieldset>
            <input placeholder="Your grade" value="{{$lead_user_data['mx_Grade']}}" type="text" tabindex="2" required>
        </fieldset>
        @if($trail==1)
        <fieldset>
            <button name="submit" type="submit" id="contact-submit">Start Free</button>
        </fieldset>
        @else
         <fieldset>
            <button name="submit" type="submit" id="contact-submit">Subscribe now</button>
        </fieldset>
        @endif
    </form>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
    $('#errormsg').hide();
    $("form").submit(function(e) {
        e.preventDefault(e);
        var mobile_num = $("#mobile_num").val();
        var email_add = $("#email_add").val();
        var user_name = $("#user_name").val();
        $.ajax({
            url: "{{ route('sendotpsignup') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                mobile: mobile_num,
                email: email_add,
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);
                if (response.success == true) {
                    verfiyRegister(response.mobile_otp);    
                }else
                {
                    $("#errormsg").text(response.message);
                    $("#errormsg").fadeIn('slow');
                    $("#errormsg").fadeOut(10000);
                }
                
            },
        });
    });
});

function verfiyRegister(reg_otp) {
    var mobile_num = $("#mobile_num").val();
    var email_add = $("#email_add").val();
    var user_name = $("#user_name").val();
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
        success: function(response_data) {
            var response = jQuery.parseJSON(response_data);
             if (response.status == 400) {
                $("#errormsg").text(response.error);
                $("#errormsg").fadeIn('slow');
                $("#errormsg").fadeOut(10000);
             }else
             {
                updateAddress(response.student_id);    
             }
            
        },
        error: function(xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        }
    });
}
function updateAddress(student_id) {
        var country = $("#country").val();
        var state = $("#state").val();
        var city = $("#city").val();
        var referCode = '';
        var referEmail = '';
        var exam_id = $('#exam_id').val();
        var trail = $('#trail').val();
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
                        trail:trail,
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

</script>
<html>
