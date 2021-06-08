@extends('afterlogin.layouts.app')

@section('content')
<style>
    .razorpay-payment-button {
        display: none;
    }
</style>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ">
                <img src="{{URL::asset('public/images/main-logo-red.png')}}" />
            </div>
        </div>
    </div>
</header>

<section class="d-flex flex-column align-items-center justify-content-center h-100">
    <div class="steps-links d-flex">
        <div class="px-5 border-bg-right pt-3"><span class="red-dots active-dot"></span>Orders</div>
        <div class="px-5  pt-3 border-bg-left border-bg-right"><span class="red-dots"></span>Shipping</div>
        <div class="px-5  pt-3 border-bg-left"><span class="red-dots"></span>Payments</div>
    </div>
    <div class="subs-box p-3 col-6 mt-5">
        <div class="d-flex align-items-center">
            <div class="col-4">
                <h3>{{$subscriptions_data->exam_name}}</h3>
                <span class="d-block">{{$subscriptions_data->exam_description}}</span>
            </div>
            <div class=" col-4">
                <select class="form-select border-0 border-bottom  rounded-0">
                    <option>Full Subscription</option>
                </select>
            </div>
            <div class="mx-4 col-1">
                <select class="form-select border-0 border-bottom rounded-0">
                    <option>{{$subscriptions_data->day_month_count}} {{$subscriptions_data->day_unit}}</option>
                </select>
            </div>
            <div class="col-2 ms-auto">
                <h4 class="text-success fs-5 m-0">₹ {{$subscriptions_data->exam_price}}</h4>
            </div>
        </div>
    </div>
    <div class="mt-5 col-6 bg-danger p-3 d-flex align-items-center">
        <span class="fs-5 text-white">Total</span>
        <span class="fs-5 text-white ms-auto">₹ {{$subscriptions_data->exam_price}}</span>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-5">

        <form action="{{ route('razorpay.payment.store') }}" method="POST">
            @csrf
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}" data-amount="{{$subscriptions_data->exam_price * 100}}" data-currency="INR" data-order_id="{{$razorpayOrderId}}" data-buttontext="" data-name="{{$subscriptions_data->exam_name}}" data-description="{{$subscriptions_data->exam_description}}" data-prefill.name="{{Auth::user()->first_name}}" data-prefill.email="{{Auth::user()->email}}" data-notes.exam_id="{{$subscriptions_data->exam_id}}" data-notes.month="{{$subscriptions_data->day_month_count}}" data-theme.color="#d71921" data-button.hide="true">
            </script>
            <input type="hidden" value="{{$subscriptions_data->exam_id}}" name="exam_id">
            <button stype="submit" class="btn btn-outline-danger px-5 rounded-0 fs-4"><span class="px-5">Pay</span></button>
        </form>
    </div>
</section>

@include('afterlogin.layouts.footer')

@endsection