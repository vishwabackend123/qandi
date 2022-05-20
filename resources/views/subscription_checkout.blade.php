@extends('afterlogin.layouts.app_new')
@section('content')
@php
$userData = Session::get('user_data');
@endphp
<style>
    .razorpay-payment-button {
        display: none;
    }
</style>
<!-- update-->
<header>
    <div class="container">
        <div class="rownot">
            <div class="outer-logo">
                <a href="{{ env('LANDING_URL') }}" title="Home" target="_blank">
                    <img src="{{URL::asset('public/images_new/QI_Logo.gif')}}" />
                </a>
            </div>
        </div>
    </div>
</header>
<section class="d-flex flex-column align-items-center justify-content-center h-100 checkoutpayment">
    <div class="steps-links d-flex ">
        <div class="px-sm-5 px-3 border-bg-right pt-3"><span class="red-dots1 active-dot"></span>Order</div>
        <div class="px-sm-5 px-3 pt-3 border-bg-left border-bg-right"><span class="red-dots1"></span>Shipping</div>
        <div class="px-sm-5 px-3 pt-3 border-bg-left"><span class="red-dots1"></span>Payment</div>
    </div>
    <div class="Fullsub-amt-subN subs-box p-4 col-6 mt-5 totalpaymentbox">
        <div class="d-flex align-items-center justify-content-between">
            <div class="col-sm-4">
                <h3>{{$subscriptions_data->subscription_name}}</h3>
                <!-- <span class="d-block">Entrance Prep2022</span> -->
            </div>
            <div class=" col-sm-4 text-sm-center">
                <sapn>Full Subscription</sapn>
                <!-- <select class="form-select border-0 border-bottom  rounded-0">
                    <option>Full Subscription</option>
                </select> -->
            </div>
            <!--
            <div class="mx-2 col-1">
                 <select class="form-select border-0 border-bottom rounded-0">
                    <option>1</option>
                </select>
            </div>
-->
            <div class="col-sm-4">
                @if($discount_code)
                <h4 class="text-success fs-5 m-0 text-sm-right">₹ {{$price + $discounted_price}}</h4>
                @else
                <h4 class="text-success fs-5 m-0 text-sm-end">₹ {{$price}}</h4>
                @endif
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-3">
            <p class="p-0 mb-sm-0 mb-2 coupontext">Apply Coupon</p>
            @if($discount_code)
            <form action="{{route('checkout')}}" if="checkout_{{$subscript_id}}" method="post">
                @csrf
                <input type="hidden" name="exam_id" value="{{$exam_id}}">
                <input type="hidden" name="subscript_id" value="{{$subscript_id}}">
                <input type="hidden" name="exam_period" value="12">
                <input type="hidden" name="period_unit" value="month">
                <input type="hidden" name="exam_price" value="{{$price + $discounted_price}}">
                <button type="submit" class="btn applybtn col-lg-2 col-md-3 remove_coupan" style="width:80px">Remove </button>
            </form>
            @else
            <button type="button" class="btn applybtn col-lg-2 col-md-3 apply_coupan" data-toggle="modal" data-target="couponbox"> Apply </button>
            @endif
        </div>
    </div>
    <div class="TotalAmount mt-5 col-md-6 col-12 bg-danger p-4">
        @if($discount_code)
        <div class="discount_div">
            <div class="d-flex  align-items-center justify-content-between pb-2">
                <span class="fs-5 text-white">Amout</span>
                <span class="fs-5 text-white ms-auto fw-normal">₹ {{$price + $discounted_price}}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between pb-2">
                <span class="fs-5 text-white">Discount</span>
                <span class="fs-5 fw-normal text-white ms-auto discount_span">-₹ {{$discounted_price}}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between pb-2 border-bottom">
                <span class="fs-5 text-white">Coupon Discount </span>
                <span class="fs-5 fw-normal text-white ms-auto position-relative coupon_discount">% {{$coupon_discount}}</span>
            </div>
        </div>
        @endif
        <div class="d-flex align-items-center justify-content-between pt-2">
            <span class="fs-5 text-white fw-bold">Total Amout</span>
            <span class="fs-5 fw-bold text-white ms-auto total_amount_span">{{$price}}</span>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-5 mb-5">
        <form action="{{ route('razorpay.payment.store') }}" method="POST">
            @csrf
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}" data-amount="{{$price * 100}}" data-currency="INR" data-order_id="{{$razorpayOrderId}}" data-buttontext="" data-name="{{$subscriptions_data->subscription_name}}" data-description="{{Str::limit($subscriptions_data->subscription_details, 250)}}" data-prefill.name="{{$userData->user_name}}" data-prefill.contact="{{$userData->mobile}}" data-prefill.email="{{$userData->email}}" data-notes.exam_id="{{$subscriptions_data->class_exam_id}}" data-notes.subscription_id="{{$subscriptions_data->id}}" data-notes.month="12" data-theme.color="#d71921" data-button.hide="true">
            </script>
            <input type="hidden" value="{{$subscriptions_data->class_exam_id}}" name="exam_id">
            <a href="{{ url('/subscriptions') }}" class="backbtn btn  px-5  fs-4 m-0"> <i class="fa fa-angle-left px-1"></i> Back </a>
            <button type="submit" class="PayBttn btn  px-5 rounded-0 fs-4"><span class="px-5">Pay</span></button>
        </form>
    </div>
</section>
<!--------- Modal trial-box------>
<div class="modal fade custommodal" id="couponbox">
    <div class="modal-dialog modal-dialog-centered trialbox">
        <div class="modal-content rounded-0 bg-light p-5">
            <form action="{{route('checkout')}}" if="checkout_{{$subscript_id}}" method="post" id="formId">
                @csrf
                <input type="hidden" name="exam_id" value="{{$exam_id}}">
                <input type="hidden" name="subscript_id" value="{{$subscript_id}}">
                <input type="hidden" name="exam_period" value="12">
                <input type="hidden" name="period_unit" value="month">
                <input type="hidden" name="exam_price" value="{{$price}}">
                <div class="modal-body text-center p-0">
                    <p class="pb-4 mt-4 m-0">Apply Coupon</p>
                    <input class="form-control bg-light mb-4" name="discount_code" id="inputcode" type="text" placeholder="Enter Coupon Code" maxlength="30">
                    <span style="color: red;" class="error_msg"></span>
                    <div class="text-center mb-4">
                        <button type="submit" class="btn btn-danger px-5 col-lg-6 col-sm-12 validate_coupan" data-bs-dismiss="modal">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-------------------->


<script>
$(document).ready(function() {
    $('.apply_coupan').on('click', function() {
        $('#couponbox').modal('show');
    });
    $('.validate_coupan').click(function(e) {
        e.preventDefault();
        var inputvalue = $('#inputcode').val();
        var price = '<?php echo $price?>';
        if (inputvalue) {
            $.ajax({
                url: "{{ url('/ajax_validate_coupon_code/',) }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    couponCode: inputvalue
                },
                beforeSend: function() {},
                success: function(response_data) {
                    if (response_data.status == true) {
                        $("#formId").submit();
                    } else {
                        e.preventDefault();
                        $('.error_msg').text(response_data.message);
                        $('.error_msg').show();
                        setTimeout(function() {
                            $('.error_msg').hide();
                        }, 3000);
                        return false;
                    }

                },

            });
        } else {
            $('.error_msg').text("Please enter valid code");
            $('.error_msg').show();
            setTimeout(function() {
                $('.error_msg').hide();
            }, 3000);
            return false;
        }
    })
});

</script>
@endsection
