@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<style>
    #refund_block_form .text-box input,
    #refund_block_form .text-box textarea {
        background: #f2f2f2;
        color: #2c3348;
        font-size: 14px;
        line-height: 22px;
        border: 1px solid #ccc;
        display: block;
        width: 100%;
        padding: 5px 10px !important;
    }

    .error {
        color: #F00 !important;
        background-color: #FFF;
    }
</style>
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <div class="content-wrapper my-4">
        <!-- dashboard html section-->
        <div class="container-fluid">
            <!--  -->
            <div class="row">
                <div class="col-lg-7 m-auto refund-money bg-white">
                    <div class=" p-3" id="refund_block_form">
                        <form id="refund_form" action="{{route('refund_form_submit')}}" method="POST" autocomplete="off">
                            @csrf
                            <div class="text-box form-group row align-items-center mb-4">
                                <label for="fname" class="col-md-4">Account Holder Name<span class="text-red">*</span></label>
                                <div class="col-md-8">
                                    <div class="position-relative required-filed">
                                        <input type="text" id="fname" class="form-control refund_class" name="firstname" placeholder="Your name.." onkeypress="return lettersOnly(event)" autocomplete="off" required maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <div class="text-box form-group row align-items-center mb-4">
                                <label for="lname" class="col-md-4">Bank Name<span class="text-red">*</span></label>
                                <div class="col-md-8">
                                    <div class="position-relative required-filed">
                                        <input type="text" id="bank_name" class="form-control refund_class" name="bank_name" placeholder="Bank Name.." onkeypress="return lettersOnly(event)" autocomplete="off" required maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <div class="text-box form-group row align-items-center mb-4">
                                <label for="lname" class="col-md-4">Account No<span class="text-red">*</span></label>
                                <div class="col-md-8">
                                    <div class="position-relative required-filed">
                                        <input type="text" id="acc_no" onkeypress="return isNumber(event)" class="form-control refund_class" name="acc_no" placeholder="Account No.." autocomplete="off" maxlength="16" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-box form-group row align-items-center mb-4">
                                <label for="lname" class="col-md-4">IFSC Code<span class="text-red">*</span></label>
                                <div class="col-md-8">
                                    <div class="position-relative required-filed">
                                        <input type="text" id="ifsc_code" class="form-control refund_class" name="ifsc_code" placeholder="IFSC Code.." required maxlength="11" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="text-box form-group row align-items-center mb-4">
                                <label for="subject" class="col-md-4">Message<span class="text-red">*</span></label>
                                <div class="col-md-8">
                                    <div class="position-relative required-filed">
                                        <textarea id="subject" name="subject" placeholder="Write something.." autocomplete="off" class="refund_class"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" id="saveEdit" class="btn btn-danger  rounded saveEdit">
                                    Submit
                                </button>
                            </div>
                            <div class="col-md-12 text-center">
                                <span id="refund_response" class=""></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End dashboard html section-->
@include('afterlogin.layouts.footer_new')
<script type="text/javascript">
    $(document).ready(function() {
        $('.saveEdit').addClass('disabled');
        $('.refund_class').keyup(function() {
            refundformCheck();
        });

        function refundformCheck() {
            var empty = false;
            $('.refund_class').each(function() {
                if ($(this).val() == '') {
                    empty = true;
                }
            });
            if (empty) {
                $('.saveEdit').addClass('disabled');

            } else {
                $('.saveEdit').removeClass('disabled');
            }
        }

        $.validator.addMethod("regx", function(value, element, regexpr) {
            return regexpr.test(value);
        }, 'Enter valid IFSC code');
        $("#refund_form").validate({
            rules: {
                acc_no: {
                    digits: true,
                    minlength: 10,
                    maxlength: 16
                },
                ifsc_code: {

                    //change regexp to suit your needs
                    regx: /^[A-Za-z]{4}\d{7}$/,
                    minlength: 11,
                    maxlength: 11
                }
            },
            messages: {
                ifsc_code: {
                    regx: "Enter Valid IFSC Code.",
                }
            },
            submitHandler: function(form) {

                $.ajax({
                    url: "{{ url('/refund_form_submit') }}",
                    type: 'POST',
                    data: $('#refund_form').serialize(),
                    beforeSend: function() {},
                    success: function(response_data) {
                        var response = jQuery.parseJSON(response_data);

                        if (response.success == true) {
                            $('#refund_form').each(function() {
                                this.reset();
                            });
                            var message = response.message;
                            $("#refund_response").html(message);
                            $("#refund_response").addClass("text-success");
                            $("#refund_response").fadeIn('slow');
                            $("#refund_response").fadeOut(10000);


                        } else {
                            var message = "Somthing wrong try again!!"
                            $("#refund_response").html(message);
                            $("#refund_response").addClass("text-danger");
                            $("#refund_response").fadeIn('slow');
                            $("#refund_response").fadeOut(10000);
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

    function lettersOnly(evt) {

        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
            ((evt.which) ? evt.which : 0));
        if (charCode > 32 && (charCode < 65 || charCode > 90) &&
            (charCode < 97 || charCode > 122)) {

            return false;
        }
        return true;
    }
</script>
@endsection