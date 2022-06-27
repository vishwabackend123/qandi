@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
$lead_exam_id = isset($userData->lead_exam_id) && !empty($userData->lead_exam_id) ?$userData->lead_exam_id:'';
$trail_sub = isset($userData->trail_sub) && !empty($userData->trail_sub) ?$userData->trail_sub:'';
@endphp
@section('content')
<!-- Side bar menu -->
@if(isset($user_id) && !empty($user_id) && !empty($user_exam_id)&& $suscription_status !=0)
@include('afterlogin.layouts.sidebar_new')
@endif
<!-- <div id="main" class="subScrip">
    @if(isset($user_id) && !empty($user_id) && !empty($user_exam_id) && $suscription_status !=0 )
    @include('afterlogin.layouts.navbar_header_new')
    @else
    <div class="row" style="height:90px;">
        <span class="outer-logo"><a href="{{ env('LANDING_URL') }}" target="_blank"><img src="{{URL::asset('public/images_new/QI_Logo.gif')}}" class="img-fluid" /></a></span>
    </div>
    <div class="clearfix"></div>
    @endif
  
    <div class="container ps-md-0 ps-5 pe-md-0 pe-0">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h1 class="main-heading position-relative">WHAT's your game ?
                
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
          
                <div class="row justify-content-center">
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
                    <div class="col-xl-4 col-lg-6 col-sm-9 col-12 p-sm-4 p-3 text-center">
                        <div class="bg-white white-box-small subscriptionBox ">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content">{{$sub->subscription_details}}</p>
                            <div class="text-center mt-5">
                                <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                    <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                    <input type="hidden" name="exam_period" value="12">
                                    <input type="hidden" name="period_unit" value="month">
                                    <input type="hidden" name="exam_price" value="{{$subsprice}}">
                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 disabled m-0 w-100" disabled id="goto-otp-btn"> Purchased</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @elseif($subscription_type!="P")
                    <div class="col-xl-4 col-md-6 p-sm-4 p-3 text-center ">
                        <div class="bg-white white-box-small subscriptionBox">
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
                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                </form>
                            </div>
                            <div class="text-center mt-2">
                                <span class="text-success text-decoration-underline">Already in {{$sub->trial_subscription_duration}} days trail Period. </span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @elseif((count($purchasedid)>0) && !empty($userData->id))
                    <div class="col-xl-4 col-md-6 p-sm-4 p-3 text-center " style="display:none">
                        <div class="bg-white white-box-small subscriptionBox">
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
                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5 disabled" disabled id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                </form>
                            </div>
                            @if($sub->trial_subscription_duration>0)
                            @if(!in_array($sub->subscript_id,$purchasedid) )
                            <div class="text-center mt-2">
                                <a href="{{route('trial_subscription',[$sub->subscript_id,$sub->exam_year,$sub->class_exam_id])}}" class="Try14 text-danger text-decoration-underline btn disabled" disabled="disabled" @if((count($purchasedid)>0) && !empty($userData->id)) onclick="return confirm('Previous subscription will not be valid after new subscription.');" @endif >Try {{$sub->trial_subscription_duration}} days trial ></a>
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
                    @php
                    if(isset($lead_exam_id) && !empty($lead_exam_id) && $sub->subscript_id != $lead_exam_id)
                    {
                        continue;
                    } 
                    @endphp
                    <div class="col-xl-4 col-md-6 p-4 text-center ">
                        <div class="bg-white white-box-small subscriptionBox  ">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content me-3 mr-3">{{$sub->subscription_details}}</p>
                            <div class="text-center mt-4">
                                @if(empty($trail_sub) || $trail_sub==2)
                                <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" @if((count($purchasedid)>0) && !empty($userData->id)) onsubmit="return confirm('Previous subscription will not be valid after new subscription.');" @endif method="post">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                    <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                    <input type="hidden" name="exam_period" value="12">
                                    <input type="hidden" name="period_unit" value="month">
                                    <input type="hidden" name="exam_price" value="{{$subsprice}}">
                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                </form>
                                @endif
                            </div>
                            @if($sub->trial_subscription_duration>0)
                            @if(!in_array($sub->subscript_id,$purchasedid) )
                            <div class="text-center mt-2">
                                @if(empty($trail_sub) || $trail_sub==1)
                                <a href="{{route('trial_subscription',[$sub->subscript_id,$sub->exam_year,$sub->class_exam_id])}}" class="Try14 text-danger text-decoration-underline" @if((count($purchasedid)>0) && !empty($userData->id)) onclick="return confirm('Previous subscription will not be valid after new subscription.');" @endif >Try {{$sub->trial_subscription_duration}} days trial></a>
                                @endif
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
                   
                    @php
                    $collect_Sub=collect($subscriptions);
                    @endphp
                    @foreach($subscriptions as $sub)
                    @php
                    $subspriceData=(isset($sub->subs_price) && !empty($sub->subs_price))?(array)json_decode($sub->subs_price):[];
                    $subsprice=(!empty($subspriceData))?head(array_values($subspriceData)):0;
                    @endphp
                    @if(isset($user_exam_id) && !empty($user_exam_id) && $collect_Sub->contains('class_exam_id', $user_exam_id))
                    @if( $user_exam_id==$sub->class_exam_id && $subscription_type=="P")
                    <div class="col-md-4 p-4 text-center ">
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
                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Renew <i class="fas fa-arrow-right"></i></button>
                                    <div class="text-center mt-2">
                                        <span class="text-danger text-decoration-underline">Your paid subscription expired.</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @elseif( $user_exam_id==$sub->class_exam_id && $subscription_type !="P")
                    <div class="col-md-4 p-4 text-center">
                        <div class="bg-white white-box-small subscriptionBox">
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
                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                    <div class="text-center mt-2">
                                        <span class="text-danger text-decoration-underline">14 days trail Period expired.</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @else
                    <div class="col-md-4 p-4 text-center">
                        <div class="bg-white white-box-small subscriptionBox">
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
                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                    <div class="text-center mt-2">
                                        <span class="text-danger text-decoration-underline">14 days trail Period expired.</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                    @endif
                </div>
             
            </div>
        </div>
    </div> -->
    <div class="container-fluid">
        <section class="subscriptionsPage">
            <div class="row">
                <div class="col-md-4 p-0">
                    <div class="left">
                        <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo">

                        <div class="progress-box">
                            <ul class="progressorder">
                                <li class="progress__item progress__item--completed">
                                <p class="progress__title">You order is  sucessfully placed</p>
                                <p class="progress__info">Shipment ID dghbh will reach you on 27 september</p>
                                </li>
                                <li class="progress__item progress__item--active">
                                <p class="progress__title">You order is beign Processed</p>
                                <p class="progress__info">Bill generate</p>
                                </li>
                                <li class="progress__item progress__item--active">
                                <p class="progress__title">You order is out for delivery</p>
                                <p class="progress__info">Delivery Executive is out for delivery</p>
                                </li>
                                <li class="progress__item">
                                <p class="progress__title">You order is out for delivery</p>
                                <p class="progress__info">Delivery Executive is out for delivery</p>
                                </li>
                            </ul>
                        </div>
                        <div class="verificationBox">
                            <p>A verification link has been sent to<b> Sakshi@gmail.com</b>, please click the link to get your account verified</p>
                            <a href="">Resend</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 p-0">
                    <div class="selectPlane">
                        <div class="SelectPlane_text">
                            <h3>Select Plane</h3>
                            <p>Decide on the best plan for your preparation</p>
                        </div>
                        <div class="selectPlanedetail">
                            <div class="planeName">
                                <p>NEET Annual Plan</p>
                                <div class="price">
                                    <div class="offer">
                                        30,000 <span>(50% off) </span>  
                                    </div>
                                    <div class="peryearPrice">
                                        15,000<sub>per year</sub>
                                    </div>
                                </div>
        
                            </div>

                            <div class="testType">
                                <ul>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"/>
                                        </svg>
                                        Chapter and Topic-wise Unlimited Tests
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"/>
                                        </svg>
                                        Adaptive Learning Experience
                                    </li>
                                    <li>
                                    
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"/>
                                        </svg>
                                        AI-based Analytics and Valuable Insightss
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"/>
                                        </svg>
                                        Identify Your Strengths and Weaknesses
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"/>
                                        </svg>
                                        Personalised and Smart Recommendations
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"/>
                                        </svg>
                                        Plan Your Weekly and Monthly Preparation
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"/>
                                        </svg>
                                        Unlimited Mock tests</li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"/>
                                        </svg>Live Exam - All India Test Series
                                    </li>
                                </ul>
                            </div>

                            <div class="planType">
                                <div class="freeTrial">
                                    <a href="">Start 14 days free trial</a>
                                 </div>
                                 <div class="getSubs">
                                    <a href="">Get Subscritption</a>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
   





<style>
   .verificationBox {
    width: 339px;
  height: 166px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 28px;
  margin: 154px 0 0;
  padding: 20px 40px;
  border-radius: 20px;
  box-shadow: 0 8px 30px 0 rgba(172, 185, 176, 0.14), 0 8px 30px 0 rgba(172, 185, 176, 0.14);
  background-color:#ffffff;
    }
    .verificationBox a{
        width: 114px;
        height: 38px;
        flex-grow: 0;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 8px;
        border: solid 1px #dc6803;
        background-color: #fff;
        color:#dc6803;
    }
    .verificationBox p{
        text-align: center;
    font-size: 14px;
    }
.custom-container{
    width:100%;
    max-width: 1440px;
    margin: auto;
}
@media(max-width:1600px){
    .custom-container{
        width:100%;
        max-width: 1366px;
        margin: auto;
    }
}
@media(max-width:1440px){
    .custom-container{
        width:100%;
        max-width: 1280px;
        margin: auto;
    }
}
@media(max-width:1366px){
    .custom-container{
        width:100%;
        max-width: 1100px;
        margin: auto;
    }
}
@media(max-width:1200px){
    .custom-container{
        width:90%;
            
    }
}
.left{
    background-color: #e0f6e3;
    height: 100vh;
}
.selectPlane  {
    background-color: #f5faf6;
    height: 100vh;
}
.SelectPlane_text h3{
    color:#1f1f1f;
    font-size:24px;
}
.SelectPlane_text p{
    color: #363c4f;
    font-size: 14px;
    line-height: 18.2px;
}
.logo{
    width:50px;
}
.selectPlanedetail {
    padding: 40px;;
    border-radius: 20px;
    box-shadow: 0 8px 30px 0 rgba(172, 185, 176, 0.14);
    background: #ffffff;

}
.SelectPlane_text{
    padding: 60px 0px;
}
.selectPlane{           
    padding: 0px 20px;
}

.planeName{
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid rgba(86, 182, 99, 0.2);
    padding-bottom: 40px;

}
.offer{
    padding: 2px 8px;
    border-radius: 8px;
    background-color: rgba(86, 182, 99, 0.1);
    font-size: 14px;
    font-weight: bold;
    line-height: 1.29;
    letter-spacing: normal;
    text-align: center;
    color: #363c4f;
}
.offer span{
    color: #56b663;
    font-size: 14px;
    font-weight: bold;
    line-height: 1.29;
    letter-spacing: normal;
    text-align: center;
}
.planeName P {
    font-size: 18px;
    font-weight: 800;
    line-height: 1;
    letter-spacing: normal;
    text-align: center;
}
.peryearPrice{
    font-size: 30px;
    font-weight: 600;
    line-height: 1.3;
    letter-spacing: normal;
    text-align: left;
}
.peryearPrice  sub{
    font-size: 14px;
    color:#363c4f;
    line-height: 1.3;
}

.testType{
    padding-top: 40px;
    border-bottom: 1px solid rgba(86, 182, 99, 0.2);
    padding-bottom: 24px;
    display: flex;
    justify-content: space-between;
}
.testType ul{
    padding: 0px;
    margin: 0px;
}

.testType ul li{
    ;
}
.testType ul li{
    font-size: 14px;
    line-height: 3;
    text-align: left;
    color: #363c4f;
}
.testType ul li svg  {
    margin-right: 8px;
}
.planType {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 80px;
}

.freeTrial a {
    color:#56b663;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.43;
}
.getSubs a{
    color:#ffffff;
    background-color:#56b663;
    padding: 10px 40px;
    border-radius: 8px;
    box-shadow: 0 1px 2px 0 rgba(16, 24, 40, 0.05);
}
</style>
 
    @if(isset($user_id) && !empty($user_id) && !empty($user_exam_id) && $suscription_status !=0)
    @include('afterlogin.layouts.footer_new')
    @endif
 
    @endsection