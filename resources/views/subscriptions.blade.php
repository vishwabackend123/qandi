@extends('layouts.app')

@section('content')
<nav class="py-0 px-7 navbar navbar-expand-lg trans-navbar">
    <div class="container-fluid"><a class="navbar-brand" href="{{url('/')}}"><img src="{{URL::asset('public/images/main-logo.png')}}" class="img-fluid" /></a></div>
</nav>
<div id="main">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h1 class="main-heading">WHAT's your game ?</h1>
            <div id="scrollDiv">
                <div class="row">
                    @if($errors->any())
                    <div class="col-md-12 ">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{$errors->first()}}
                        </div>
                    </div>
                    @endif
                    @if(isset($subscriptions) && !empty($subscriptions))
                    @foreach($subscriptions as $sub)
                    @php
                    $subspriceData=(isset($sub->subs_price) && !empty($sub->subs_price))?(array)json_decode($sub->subs_price):[];

                    $subsprice=(!empty($subspriceData))?head(array_values($subspriceData)):0;

                    @endphp

                    @if(in_array($sub->subscript_id,$purchased_ids) )
                    @php
                    $subscription_type='';
                    $filtered = $aPurchased->where('subscription_id', $sub->subscript_id);
                    $filtered_data = $filtered->first();
                    $subscription_type = $filtered_data->subscription_type;
                    @endphp


                    @if($subscription_type=="P")

                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small subscriptionBox inactive-block  ">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content me-3">{{$sub->subscription_details}}</p>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5 disabled" id="goto-otp-btn">Already Purchased </i></button>
                            </div>
                        </div>
                    </div>
                    @elseif($subscription_type=="T")
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small subscriptionBox   ">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content me-3">{{$sub->subscription_details}}</p>



                            <div class="text-center mt-4">
                                <form action="{{route('checkout')}}" if="checkout" method="post">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                    <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                    <input type="hidden" name="exam_period" value="12">
                                    <input type="hidden" name="period_unit" value="month">
                                    <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                </form>
                            </div>
                            <div class="text-center mt-2">
                                <apan class="text-success text-decoration-underline">Already in 14 days trail Period. </apan>
                            </div>

                        </div>
                    </div>
                    @endif
                    @else
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small subscriptionBox  ">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content me-3">{{$sub->subscription_details}}</p>

                            <div class="text-center mt-4">
                                <form action="{{route('checkout')}}" if="checkout" method="post">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                    <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                    <input type="hidden" name="exam_period" value="12">
                                    <input type="hidden" name="period_unit" value="month">
                                    <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                </form>
                            </div>

                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection