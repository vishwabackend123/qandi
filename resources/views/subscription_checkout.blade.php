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
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 outer-logo">
                <img src="{{URL::asset('public/images_new/uniq.png')}}" />
            </div>
        </div>
    </div>
</header>
<section class="d-flex flex-column align-items-center justify-content-center h-100 ">

    <div class="steps-links d-flex ">
        <div class="px-5 border-bg-right pt-3"><span class="red-dots1 active-dot"></span>Orders</div>
        <div class="px-5  pt-3 border-bg-left border-bg-right"><span class="red-dots1"></span>Shipping</div>
        <div class="px-5  pt-3 border-bg-left"><span class="red-dots1"></span>Payments</div>
    </div>
    <div class="Fullsub-amt-subN subs-box p-3 col-6 mt-5">
        <div class="d-flex align-items-center">
            <div class="col-4">
                <h3>{{$subscriptions_data->subscription_name}}</h3>
                <!-- <span class="d-block">Entrance Prep2022</span> -->
            </div>
            <div class=" col-4">
                <select class="form-select border-0 border-bottom  rounded-0">
                    <option>Full Subscription</option>
                </select>
            </div>
            <div class="mx-2 col-1">
                <!-- <select class="form-select border-0 border-bottom rounded-0">
                    <option>1</option>
                </select> -->
            </div>
            <div class="col-3">
                <h4 class="text-success fs-5 m-0">₹ {{$price}}</h4>
            </div>
        </div>
    </div>
    <div class="TotalAmount mt-5 col-6 bg-danger p-3 d-flex align-items-center">
        <span class="fs-5 text-white">Total</span>
        <span class="fs-5 text-white ms-auto">₹ {{$price}}</span>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-5">
        <form action="{{ route('razorpay.payment.store') }}" method="POST">
            @csrf
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}" data-amount="{{$price * 100}}" data-currency="INR" data-order_id="{{$razorpayOrderId}}" data-buttontext="" data-name="{{$subscriptions_data->subscription_name}}" data-description="{{$subscriptions_data->subscription_details}}" data-prefill.name="{{$userData->user_name}}" data-prefill.email="{{$userData->email}}" data-notes.exam_id="{{$subscriptions_data->class_exam_id}}" data-notes.subscription_id="{{$subscriptions_data->id}}" data-notes.month="12" data-theme.color="#d71921" data-button.hide="true">
            </script>
            <input type="hidden" value="{{$subscriptions_data->class_exam_id}}" name="exam_id">
            <button type="submit" class="PayBttn btn  px-5 rounded-0 fs-4"><span class="px-5">Pay</span></button>
        </form>

    </div>
</section>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{URL::asset('public/js/jquery-3.2.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $('.scroll-div').slimscroll({
        height: '40vh'
    });
</script>

@endsection