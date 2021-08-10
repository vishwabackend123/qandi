@extends('layouts.app')

@section('content')

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
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small subscriptionBox @if(in_array($sub->subscript_id,$purchased_ids)) inactive-block  @endif">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content">{{$sub->subscription_details}}</p>
                            @if(in_array($sub->subscript_id,$purchased_ids))
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5 disabled" id="goto-otp-btn">Already Purchased </i></button>
                            </div>
                            @else
                            <div class="text-center mt-5">
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
                                <a href="{{route('trial_subscription',$sub->class_exam_id)}}" class="text-danger text-decoration-underline">Try 14 days trial ></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection