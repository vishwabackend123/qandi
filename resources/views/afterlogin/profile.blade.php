@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="main-wrapper exam-wrapperBg">
        @include('afterlogin.layouts.navbar_header_new')
        @include('afterlogin.layouts.sidebar_new')
        <section class="content-wrapper mobile-wrapper">
             @if(count($errors) > 0 )
            <div class="toastdata active">
                <div class="toast-content">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 17C1 8.163 8.163 1 17 1s16 7.163 16 16-7.163 16-16 16S1 25.837 1 17z" fill="#8DFDB3" />
                        <path d="M23.666 16.387V17a6.667 6.667 0 1 1-3.953-6.093m3.953.76L17 18.34l-2-2" stroke="#039855" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17 32C8.716 32 2 25.284 2 17H0c0 9.389 7.611 17 17 17v-2zm15-15c0 8.284-6.716 15-15 15v2c9.389 0 17-7.611 17-17h-2zM17 2c8.284 0 15 6.716 15 15h2c0-9.389-7.611-17-17-17v2zm0-2C7.611 0 0 7.611 0 17h2C2 8.716 8.716 2 17 2V0z" fill="#BDF3C5" />
                    </svg>
                    <div class="message">
                        <h5 class="mb-2"> </h5>
                        @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                        @endforeach
                    </div>
                </div>
                
                <div class="progress active"></div>
            </div>
            <script>
                $(function() {
                    setTimeout(function() {
                        $(".toastdata").removeClass('active');
                        $(".progress").removeClass('active');
                    }, 10000);
                });
            </script>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="info">
                            <h1 class="main-title">Personal Information</h1>
                            <p>Update your personal details here</p>
                            <div class="line d-block d-lg-none"></div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form id="editProfile_form" method="post" action="{{route('editProfile')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="country" value="India">
                            <div class="row pt-4">
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" value="{{$userData->first_name}}" id="firstname" name="firstname" onkeypress="return onlyAlphabetsForName(event,this);" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" value="{{$userData->last_name}}" id="lastname" name="lastname" onkeypress="return onlyAlphabetsForName(event,this);" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4">
                                        <label>Display Name</label>
                                        <input type="text" class="form-control" placeholder="Display Name" value="{{$userData->user_name}}" id="username" name="username" required onkeypress="return onlyAlphabetsDisplay(event,this);" maxlength="25">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4 position-relative">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email" value="{{$userData->email}}" id="useremail" name="useremail" required maxlength="64" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                                        @if($userData->email_verified=='No')
                                        <a class="bg-white editnumber resendmail resend_email" href="javascript:void(0);">Resend</a>
                                        <span class="email-error">Email not verified, Please resend verification link to verify</span>
                                        <br>
                                        <span class="mt-2" id="email_success"></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 custom-input pb-4">
                                    <label>State</label>
                                    @php
                                    $userstate = $userData->state;
                                    @endphp
                                    <select class="form-control selectdata reqrd js-example-basic-single state_list" id="state" name="state" required>
                                        <option class="we" value="">Select a State</option>
                                        @foreach($state_list as $state)
                                        <option class="we" value="{{$state}}" @if($state==$userstate) selected @else "" @endif>{{$state}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 custom-input pb-4">
                                    <label>City</label>
                                    <select class="form-control selectdata reqrd js-example-basic-single city_list" id="city_name" name="city" required>
                                        <option class="we" value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="line mb-4 d-md-block d-none"></div>
                            <div class="row">
                                <div class="col-lg-6 custom-input pb-4">
                                    <label>Grade</label>
                                    <select class="form-control selectdata js-example-basic-single selectgrade" name="grade" id="grade" required>
                                        <option class="we" value="" disabled selected hidden>Select Grade</option>
                                        <option class="we2" value="1" @if($student_stage_at_sgnup==1) selected @else '' @endif>10th Standard Pass</option>
                                        <option class="we" value="2" @if($student_stage_at_sgnup==2) selected @else '' @endif>11th Standard Pass</option>
                                        <option class="we" value="3" @if($student_stage_at_sgnup==3) selected @else '' @endif>12th Standard Pass</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-input pb-4">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control bg-transparent" placeholder="Mobile no." value="{{$userData->mobile}}" id="mobile_num" minlength="10" maxlength="10" onkeypress="return isNumber(event)" name="user_mobile" readonly>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback m-0" role="alert" id="errlog_edit"> </span>
                            <div class="line mb-4 d-md-block d-none"></div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="d-sm-flex custom-profileupload">
                                        <div class="preview-zone hidden mb-sm-0 mb-4">
                                            <div class="box box-solid">
                                                <div class="box-body"><img height="64px" width="64px" style="border-radius:32px;margin-right:20px;" src="{{$imgPath}}" alt="performance"></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-wrapper w-100">
                                            <div class="dropzone-desc text-center">
                                                <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 23C3 11.954 11.954 3 23 3s20 8.954 20 20-8.954 20-20 20S3 34.046 3 23z" fill="#F2F4F7" />
                                                    <g clip-path="url(#yofycrtcca)">
                                                        <path d="M26.333 26.333 23 23m0 0-3.333 3.333M23 23v7.5m6.992-2.175A4.168 4.168 0 0 0 28 20.5h-1.05a6.668 6.668 0 1 0-11.45 6.083" stroke="#475467" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                    </g>
                                                    <path d="M23 40c-9.389 0-17-7.611-17-17H0c0 12.703 10.297 23 23 23v-6zm17-17c0 9.389-7.611 17-17 17v6c12.703 0 23-10.297 23-23h-6zM23 6c9.389 0 17 7.611 17 17h6C46 10.297 35.703 0 23 0v6zm0-6C10.297 0 0 10.297 0 23h6c0-9.389 7.611-17 17-17V0z" fill="#F9FAFB" />
                                                    <defs>
                                                        <clipPath id="yofycrtcca">
                                                            <path fill="#fff" transform="translate(13 13)" d="M0 0h20v20H0z" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <p class="pt-2 mt-1"><a href="javascript:void(0);">Click to upload</a> or drag and drop<br> <span> PNG, JPG or JPEG</span></p>
                                            </div>
                                            <input type="file" name="file-input" id="file-input" class="dropzone" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line mt-4 mb-3"></div>
                            <div class="d-flex justify-content-end mb-md-5 mb-2 pb-5">
                                <button type="button" id="cancelEdit" class="btn cancle me-2 bg-transparent ">Cancel</button>
                                <button type="submit" id="saveEdit" class="btn savebtn text-white border-0 ms-1 ">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="pb-sm-5 mb-3">
                    <div class="line"></div>
                </div>
                <div class="row">
                    <div class="col-lg-11">
                    <div class="info">
                            <h1 class="main-title">Subscription</h1>
                            <p>{{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</p>
                        </div>
                        @php
                        $subspriceData=(isset($current_subscription->subs_price) && !empty($current_subscription->subs_price))?(array)json_decode($current_subscription->subs_price):[];
                        $subsprice=(!empty($subspriceData))?head(array_values($subspriceData)):0;
                        $subscription_desc = (isset($current_subscription->subscription_details) && !empty($current_subscription->subscription_details))? $current_subscription->subscription_details :'No data';
                        @endphp
                        @php $startdate=isset($subscription_details->subscription_start_date)? date("d-m-Y", strtotime($subscription_details->subscription_start_date)):''; @endphp
                        @php $expirydate=isset($subscription_details->subscription_end_date)? date("d-m-Y", strtotime($subscription_details->subscription_end_date)):''; @endphp
                        @php
                        $datetime1 = new DateTime($startdate);
                        $datetime2 = new DateTime($expirydate);
                        $interval = $datetime1->diff($datetime2);
                        $days = $interval->format('%a');
                        @endphp
                        <div class="bg-white subscription-details mt-5">
                            <div class="d-flex justify-content-between align-items-center mb-sm-3 mb-2 pb-1">
                                <h1 class="subs-heading d-inline-block m-0">{{isset($subscription_details->subscription_name)?$subscription_details->subscription_name:''}} Subscription</h1>
                                @if($days <=14) <form action="{{route('checkout')}}" if="checkout_{{$current_subscription->subscript_id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{$current_subscription->class_exam_id}}">
                                    <input type="hidden" name="subscript_id" value="{{$current_subscription->subscript_id}}">
                                    <input type="hidden" name="exam_period" value="12">
                                    <input type="hidden" name="period_unit" value="month">
                                    <input type="hidden" name="exam_price" value="{{$subsprice}}">
                                    <button type="submit" class="btn savebtn text-white border-0 upgradebtn d-sm-block d-none" id="get-sub-btn">Upgrade Plan</button>
                                    </form>
                                    @endif
                            </div>
                            <div class="line mb-3 pb-1"></div>
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Subscription type</h2>
                                @if($subscription_type == "P" || $days >14)
                                     <h3>{{isset($subscription_details->subscription_name)?$subscription_details->subscription_name:''}} 1 year Subscription</h3>
                                    @else
                                    <h3>{{isset($subscription_details->subscription_name)?$subscription_details->subscription_name:''}} 14 day trial</h3>

                                    @endif
                            </div>
                            @if($subscription_type == "P" || $days >14)
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Price</h2>
                                <h3>₹{{number_format($subsprice)}}</h3>
                            </div>
                            @endif
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Active date</h2>
                                <h3>{{!empty($startdate)?date("j F Y", strtotime($startdate)):''}}</h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3 planend">
                                <h2>End date</h2>
                                <h3>{{!empty($expirydate)?date("j F Y", strtotime($expirydate)):''}}</h3>
                            </div>
                            <div id="panel">
                                <div class="line mb-3 pb-1"></div>
                                <p>{{$subscription_desc}}</p>
                            </div>
                            <div class="flip d-inline-block">Show details</div>
                            &nbsp;<i class="fa fa-angle-right fliparrow" aria-hidden="true" style="cursor:pointer"></i>
                            <!--a href="javascript:void(0);" class="btn savebtn text-white border-0 upgradebtn d-sm-none d-block w-100 mt-4">Upgrade Plan</a-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('afterlogin.layouts.footer_new')
    <script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Select a State",
        });
        $('.city_list').select2({
            placeholder: "Select a City",
        });
        $('.selectgrade').select2({
            minimumResultsForSearch: -1,
            placeholder: "Select a Grade",
        });
        editProfileCheck();
        var user_state = '<?php echo $userData->state; ?>';
        getCity(user_state, 'load');
        $('.state_list').on('change', function() {
            var state = $(this).val();
            getCity(state, 'change');

        });


        $.validator.addMethod("mobileregx", function(value, element, regexpr) {
            return regexpr.test(value);
        }, 'Please enter valid mobile number.');
        $("#editProfile_form").validate({
            rules: {
                user_mobile: {
                    mobileregx: /^[6-9][0-9]{9}$/,
                },
            },

        });
        $(".flip").click(function() {
            $("#panel").slideToggle("slow");
            $(this).text(function(i, v) {
                return v === 'Show details' ? 'Hide details' : 'Show details'
            })
        });
        $(".fliparrow").click(function() {
            $("#panel").slideToggle("slow");
            $('.flip').text(function(i, v) {
                return v === 'Show details' ? 'Hide details' : 'Show details'
            })
        });
    });
    $('#email_success').hide();
    $('.resend_email').click(function() {
        $('.email-error').hide();
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
                    $("#email_success").fadeOut(2000);
                    setTimeout(function() {
                        $('.email-error').show();
                    }, 2000);

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
    $('#editProfile_form input').keyup(function() {
        var id = this.id;
        if (id === 'mobile_num') {
            return false;
        }
        $('#editProfile_form').valid();
        editProfileCheck();
    });
    $('#editProfile_form select').change(function() {
        editProfileCheck();
    });
    $('#file-input').change(function() {
        if (this.files[0].size > 2097152) {
            $(this).val(null);
            alert("Image size is greater than 2 MB");
            return false;
        }
        editProfileCheck();
    });
    $('#cancelEdit').click(function() {
        var url = "{{ route('dashboard') }}";
        window.location.href = url;
    });



    function editProfileCheck() {
        var empty = false;
        $('#editProfile_form input').each(function() {
            var id = this.id;
            if (id == 'file-input') {
                return;
            }
            if (id == 'firstname') {
                return;
            }
            if (id == 'lastname') {
                return;
            }
            var city = $('#city_name').val();
            var state = $('#state').val();
            var grade = $('#grade').val();
            if (city == '') {
                empty = true;
            }
            if (state == '') {
                empty = true;
            }
            if (grade == '') {
                empty = true;
            }
            var input_data = $(this).val();
            input_data = input_data.trim();
            if (input_data == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#saveEdit').attr('disabled', 'disabled');
            $('#saveEdit').addClass("disabled-btn");
            $('#cancelEdit').attr('disabled', 'disabled');
            $('#cancelEdit').addClass("disabled-btn");

        } else {
            $('#saveEdit').removeAttr('disabled');
            $('#saveEdit').removeClass("disabled-btn");
            $('#cancelEdit').removeAttr('disabled');
            $('#cancelEdit').removeClass("disabled-btn");

        }


    }

    function getCity(state, type) {
        if (state) {
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
                        $('#saveEdit').attr('disabled', 'disabled');
                        $('#saveEdit').addClass("disabled-btn");
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

    }

    function onlyAlphabetsForName(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else { return true; }
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                return true;
            else
                return false;
        } catch (err) {
            alert(err.Description);
        }
    }

    function onlyAlphabetsDisplay(e, t) {
        return (e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || e.charCode == 32;
    }
    $("#username").keyup(function() {
        var myValue = $(this).val();
        var test = myValue.replace(/  +/g, ' ');
        $("#username").val(test);
    });

    </script>
</body>
@endsection
