@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<style type="text/css">
.error {
    font-size: 14px;
    font-weight: normal;
    color: #dc6803 !important;
}

</style>

<body class="bg-content">
    <div class="main-wrapper">
        @include('afterlogin.layouts.navbar_header_new')
        @include('afterlogin.layouts.sidebar_new')
        <section class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="info">
                            <h1 class="main-title">Personal info</h1>
                            <p>Update your personal details here.</p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form id="editProfile_form" method="post" action="/editProfile">
                            <div class="row pt-4">
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" value="{{$userData->first_name}}" id="firstname" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" value="{{$userData->last_name}}" id="lastname" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4">
                                        <label>Display Name</label>
                                        <input type="text" class="form-control" placeholder="Display Name" value="{{$userData->user_name}}" id="username" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4">
                                        <label>Email</label>
                                        <input type="text" class="form-control" placeholder="Email" value="{{$userData->email}}" id="useremail" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 custom-input pb-4">
                                    <label>State</label>
                                    @php
                                    $userstate = $userData->state;
                                    @endphp
                                    <select class="form-control selectdata state_list" id="state" required>
                                        <option class="we" value="">Select State</option>
                                        @foreach($state_list as $state)
                                        <option class="we" value="{{$state}}" @if($state==$userstate) selected @else "" @endif>{{$state}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 custom-input pb-4">
                                    <label>City</label>
                                    <select class="form-control selectdata city_list" id="city_name" required>
                                        <option class="we">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="custom-input pb-4">
                                        <label>Mobile</label>
                                        <input type="text"  class="form-control bg-transparent" placeholder="Mobile no" value="{{$userData->mobile}}" required id="mobile_num" minlength="10" maxlength="10" onkeypress="return isNumber(event)" name="user_mobile">
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback m-0" role="alert" id="errlog_edit"> </span>
                            <hr class="line mb-4">
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <div class="d-flex custom-profileupload">
                                        <div class="preview-zone hidden">
                                            <div class="box box-solid">
                                                <div class="box-body"></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-wrapper w-100">
                                            <div class="dropzone-desc text-center">
                                                <img src="{{URL::asset('public/after_login/current_ui/images/upload-img.jpg')}}" alt="performance">
                                                <p><a href="javascript:void(0);">Click to upload</a> or drag and drop<br> <span>(SVG, PNG, JPG or GIF)</span></p>
                                            </div>
                                            <input type="file" name="img_logo" class="dropzone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="line">
                            <div class="d-flex justify-content-end mb-5 pb-5">
                                <a href="{{ url('/dashboard') }}" class="btn cancle mr-2 bg-transparent ">Cancel</a>
                                <button type="submit" class="btn savebtn text-white border-0 ml-1 ">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="line pb-5 mb-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="info">
                            <h1 class="main-title">Subscription</h1>
                            <p>Beginner • {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</p>
                        </div>
                    </div>
                    <div class="col-lg-8 pt-4">
                        <div class="bg-white subscription-details">
                            <h1 class="subs-heading d-inline-block">JEE MAIN Subscription</h1>
                            <hr class="line">
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Subscription type</h2>
                                <h3>JEE 1 year Subscription</h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Price</h2>
                                <h3>₹15,000</h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Active date</h2>
                                <h3>20th April 2022</h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3 planend">
                                <h2>End date</h2>
                                <h3>20th April 2023</h3>
                            </div>
                            <div id="panel">
                                <hr class="line">
                                <p>JEE-Main, which replaced AIEEE, is for admissions to the National Institutes of Technology (NITs), Indian Institutes of Information Technology (IIITs) and some other colleges designated as "centrally funded technical institutes" (CFTIs).</p>
                            </div>
                            <div class="flip d-inline-block">Show details</div>
                            <i class="fa fa-angle-right text-success" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
@include('afterlogin.layouts.footer_new')
<script type="text/javascript">
$(document).ready(function() {
    var user_state = '<?php echo $userData->state; ?>';
    getCity(user_state, 'load');
    $('.state_list').on('change', function() {
        var state = $(this).val();
        getCity(state, 'change');

    });
    $("#editProfile_form").validate({
        rules: {
            user_mobile: {
                mobileregx: /^[6-9][0-9]{9}$/,
            },
        },
        submitHandler: function(form) {
            var emailField = $('#useremail').val();
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test(emailField) == false) {
                $("#errlog_edit").html("Invalid email id");
                $("#errlog_edit").fadeIn('slow');
                $("#errlog_edit").fadeOut(10000);
                alert("hello");
                return false;
            }
            $.ajax({
                url: "{{ url('/editProfile') }}",
                type: 'POST',
                data: $('#editProfile_form').serialize(),
                beforeSend: function() {},
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);
                    if (response.success == true) {

                        var user_name = response.user_info.user_name;
                        var city = response.user_info.city;
                        $('.activeUserName').html(user_name);
                        $('#activeUserName').text(user_name);
                        $('#select-city').attr('value', city);
                        $(".profile-show").show();
                        $(".edit-form").hide();
                        $("#LeaDer").show();
                        $("#sucessAcc_edit").html("Profile updated successfully.");
                        $("#sucessAcc_edit").fadeIn('slow');
                        $("#sucessAcc_edit").fadeOut(10000);
                        $('#firstname').attr('value', response.user_info.first_name);
                        $('#lastname').attr('value', response.user_info.last_name);
                        $('#select-state').attr('value', response.user_info.state);
                        $('#useremail').attr('value', response.user_info.email);
                        $('#user_mobile').attr('value', response.user_info.mobile);
                        $('#username').attr('value', user_name);
                    } else {
                        $("#errlog_edit").html(response.message);
                        $("#errlog_edit").fadeIn('slow');
                        $("#errlog_edit").fadeOut(10000);
                        return false;
                    }


                },
                error: function(xhr, b, c) {
                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                }
            });
        }

    });
});

function getCity(state, type) {
    var user_city = '<?php echo $userData->city; ?>';
    $.ajax({
        url: "{{ url('/getCity',) }}",
        type: "GET",
        cache: false,
        data: {
            'state': state,
        },
        success: function(response_data) {
            if (type == 'change') {
                $('.city_list').html('<option value="">Select City</option>');
                $.each(response_data, function(key, value) {
                    $(".city_list").append('<option value="' + value + '">' + value + '</option>');
                });
            } else {
                $('.city_list').html('<option value="">Select City</option>');
                $.each(response_data, function(key, value) {
                    if (value == user_city) {
                        $(".city_list").append('<option value="' + value + '" selected>' + value + '</option>');
                    } else {
                        $(".city_list").append('<option value="' + value + '">' + value + '</option>');
                    }

                });
            }

        }
    });
}

</script>
@endsection
