@extends('layouts.app')
<style>
    .close-btn-subs {
        position: absolute;
        top: 0;
        right: 0;
    }

    .subScrip .row {
        width: 100%;
        margin: 0 auto;
    }
</style>
@section('content')
@php
if(session()->has('user_data')){
$userData = Session::get('user_data');

$user_id = $userData->id;
$user_exam_id = $userData->grade_id;
}


@endphp

<div id="main" class="subScrip">
    <div class="row" style="height:90px;">
        <span class="outer-logo"><a href="{{url('/')}}" target="_blank"><img src="{{URL::asset('public/images_new/uniq.png')}}" class="img-fluid" /></a></span>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-10 mx-auto">
            <h1 class="main-heading position-relative">WHAT's your game ?
                @if(!empty($user_id) && $suscription_status!=0)
                <a href="{{ url('/dashboard') }}" class="close-btn-subs"><img src="{{URL::asset('public/after_login/images/close.png')}}"></a>
                @elseif(!empty($user_id) && $suscription_status==0)
                <a href="{{ url('/') }}" class="close-btn-subs"><img src="{{URL::asset('public/after_login/images/close.png')}}"></a>
                @elseif(!isset($user_id))
                <a href="{{ url('/') }}" class="close-btn-subs"><img src="{{URL::asset('public/after_login/images/close.png')}}"></a>
                @endif
            </h1>
            @if($errors->any())
            <div class="row">
                <div class="col-md-12 ">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{$errors->first()}}
                    </div>
                </div>
            </div>
            @endif
            <!-- <div id="scrollDiv"> -->
            <div class="row">
                @if(isset($subscriptions) && !empty($subscriptions))
                @if($suscription_status !=0)
                @foreach($subscriptions as $sub)
                @php

                $subspriceData=(isset($sub->subs_price) && !empty($sub->subs_price))?(array)json_decode($sub->subs_price):[];

                $subsprice=(!empty($subspriceData))?head(array_values($subspriceData)):0;

                @endphp

                @if(in_array($sub->subscript_id,$purchased_ids) )
                @php
                //$subscription_type='';
                $filtered = $aPurchased->where('subscription_id', $sub->subscript_id);
                $filtered_data = $filtered->first();
                //$subscription_type = $filtered_data->subscription_t;
                $subscribed_id = $filtered_data->subscription_id;

                $expirydate=isset($filtered_data->subscription_end_date)? date("d-m-y", strtotime($filtered_data->subscription_end_date)):'';
                $dateTimeExpiry = strtotime($expirydate);
                $todaydate = date("y-m-d");
                $dateTimeToday = strtotime($todaydate);

                @endphp


                @if($subscription_type=="P")

                <div class="col-md-4 p-4 ">
                    <div class="bg-white white-box-small subscriptionBox inactive-block  ">
                        <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                        <p class="price">Rs. {{$subsprice}}</p>
                        <p class="box-content scroll-content me-3 pr-3">{{$sub->subscription_details}}</p>

                        <div class="text-center mt-5">
                            <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                <input type="hidden" name="exam_period" value="12">
                                <input type="hidden" name="period_unit" value="month">
                                <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5 disabled" disabled id="goto-otp-btn"> Purchased </i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif($subscription_type!="P")

                <div class="col-md-4 p-4 ">
                    <div class="bg-white white-box-small subscriptionBox   ">
                        <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                        <p class="price">Rs. {{$subsprice}}</p>
                        <p class="box-content scroll-content me-3 pr-3">{{$sub->subscription_details}}</p>



                        <div class="text-center mt-4">
                            <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                <input type="hidden" name="exam_period" value="12">
                                <input type="hidden" name="period_unit" value="month">
                                <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now<i class="fas fa-arrow-right"></i></button>
                            </form>
                        </div>
                        <div class="text-center mt-2">
                            <apan class="text-success text-decoration-underline">Already in {{$sub->trial_subscription_duration}} days trail Period. </apan>
                        </div>
                    </div>
                </div>
                @endif
                @elseif((count($purchasedid)>0) && !empty($userData->id))

                <div class="col-md-4 p-4 " style="display:none">
                    <div class="bg-white white-box-small subscriptionBox  ">
                        <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                        <p class="price">Rs. {{$subsprice}}</p>
                        <p class="box-content scroll-content me-3 mr-3">{{$sub->subscription_details}}</p>

                        <div class="text-center mt-4">
                            <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" @if((count($purchasedid)>0) && !empty($userData->id)) onsubmit="return confirm('Previous subscription will not be valid after new subscription.');" @endif method="post">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                <input type="hidden" name="exam_period" value="12">
                                <input type="hidden" name="period_unit" value="month">
                                <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5 disabled" disabled id="goto-otp-btn">Subscribe Now<i class="fas fa-arrow-right"></i></button>
                            </form>
                        </div>
                        @if($sub->trial_subscription_duration>0)
                        @if(!in_array($sub->subscript_id,$purchasedid) )

                        <div class="text-center mt-2">
                            <a href="{{route('trial_subscription',[$sub->subscript_id,$sub->exam_year])}}" class="Try14 text-danger text-decoration-underline btn disabled" disabled="disabled" @if((count($purchasedid)>0) && !empty($userData->id)) onclick="return confirm('Previous subscription will not be valid after new subscription.');" @endif >Try {{$sub->trial_subscription_duration}} days trial ></a>
                        </div>

                        @else
                        <div class="text-center mt-2">
                            <span class="text-danger text-decoration-underline">Expired {{$sub->trial_subscription_duration}} days trial ></span>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                @else

                <div class="col-md-4 p-4 ">
                    <div class="bg-white white-box-small subscriptionBox  ">
                        <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                        <p class="price">Rs. {{$subsprice}}</p>
                        <p class="box-content scroll-content me-3 mr-3">{{$sub->subscription_details}}</p>

                        <div class="text-center mt-4">
                            <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" @if((count($purchasedid)>0) && !empty($userData->id)) onsubmit="return confirm('Previous subscription will not be valid after new subscription.');" @endif method="post">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                <input type="hidden" name="exam_period" value="12">
                                <input type="hidden" name="period_unit" value="month">
                                <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now<i class="fas fa-arrow-right"></i></button>
                            </form>
                        </div>
                        @if($sub->trial_subscription_duration>0)
                        @if(!in_array($sub->subscript_id,$purchasedid) )

                        <div class="text-center mt-2">
                            <a href="{{route('trial_subscription',[$sub->subscript_id,$sub->exam_year])}}" class="Try14 text-danger text-decoration-underline" @if((count($purchasedid)>0) && !empty($userData->id)) onclick="return confirm('Previous subscription will not be valid after new subscription.');" @endif >Try {{$sub->trial_subscription_duration}} days trial></a>
                        </div>

                        @else
                        <div class="text-center mt-2">
                            <span class="text-danger text-decoration-underline">Expired {{$sub->trial_subscription_duration}} days trial ></span>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>

                @endif

                @endforeach

                @else
                <!-- After expired Package -->
                @foreach($subscriptions as $sub)
                @php

                $subspriceData=(isset($sub->subs_price) && !empty($sub->subs_price))?(array)json_decode($sub->subs_price):[];

                $subsprice=(!empty($subspriceData))?head(array_values($subspriceData)):0;

                @endphp

                @if(isset($user_exam_id) && !empty($user_exam_id))
                @if( $user_exam_id==$sub->class_exam_id && $subscription_type=="P")

                <div class="col-md-4 p-4 ">
                    <div class="bg-white white-box-small subscriptionBox  ">
                        <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                        <p class="price">Rs. {{$subsprice}}</p>
                        <p class="box-content scroll-content me-3 mr-3">{{$sub->subscription_details}}</p>

                        <div class="text-center mt-4">
                            <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                <input type="hidden" name="exam_period" value="12">
                                <input type="hidden" name="period_unit" value="month">
                                <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Renew<i class="fas fa-arrow-right"></i></button>
                                <div class="text-center mt-2">
                                    <span class="text-danger text-decoration-underline">Your paid subscription expired.</span>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
                @elseif( $user_exam_id==$sub->class_exam_id && $subscription_type!="P")
                <div class="col-md-4 p-4 ">
                    <div class="bg-white white-box-small subscriptionBox  ">
                        <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                        <p class="price">Rs. {{$subsprice}}</p>
                        <p class="box-content scroll-content me-3 mr-3">{{$sub->subscription_details}}</p>

                        <div class="text-center mt-4">
                            <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                <input type="hidden" name="exam_period" value="12">



                        </div>
                    </div>
                </div>
                @endif
                @endif

                @endforeach
                @endif
                @endif

            </div>
            <!-- </div> -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{URL::asset('public/js/jquery-3.2.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('public/js/bootstrap.min.js')}}"></script>


@endsection