@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
$lead_exam_id = isset($userData->lead_exam_id) && !empty($userData->lead_exam_id) ?$userData->lead_exam_id:'';
$trail_sub = isset($userData->trail_sub) && !empty($userData->trail_sub) ?$userData->trail_sub:'';
@endphp
@section('content')
<div class="wrapper">
    <section class="subscriptionsPage d-flex">
        <div class="subscriptionsLeftpannel">
            <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo">
            <div class="progress-box">
                <ul class="progressorder">
                    <li class="progress__item  progress__item--active">
                        <p class="progress__title">Select Plan</p>
                        <p class="progress__info">Decide on the best plan for your preparation</p>
                    </li>
                    <li class="progress__item">
                        <p class="progress__title">Self Analysis</p>
                        <p class="progress__info">Rate your level of proficiency</p>
                    </li>
                    <li class="progress__item ">
                        <p class="progress__title">Full Body Scan</p>
                        <p class="progress__info">To assess your preparedness</p>
                    </li>
                </ul>
            </div>
            @if($userData->email_verified=='No')
            <div class="verificationBox">
                <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified</p>
                <a href="javascript:void(0);" class="resend_email">Resend</a>
                <span class="mt-2" id="email_success"></span>
            </div>  
            @endif 
        </div>
        <div class="selectPlan subscriptionsRightpannel">
            <span class="mobile_block"><img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></span>
            <div class="SelectPlane_text">
                <h3 class="pageCountBox">Select Plan<span class="pagecount hideondesktop"><span class="activePage">1</span>/3</span></h3>
                <p>Decide on the best plan for your preparation</p>
            </div>
            @if(isset($subscriptions) && !empty($subscriptions))
            @if($suscription_status !=0)
            @foreach($subscriptions as $sub)
            @php
            $subspriceData=(isset($sub->subs_price) && !empty($sub->subs_price))?(array)json_decode($sub->subs_price):[];
            $subspriceDiscount=(isset($sub->subs_dis_price) && !empty($sub->subs_dis_price))?(array)json_decode($sub->subs_dis_price):[];
            $subsprice=(!empty($subspriceData))?head(array_values($subspriceData)):0;
            $discount=(!empty($subspriceDiscount))?head(array_values($subspriceDiscount)):0;
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
            $discount_price=($subsprice*$discount)/100;
            if(isset($user_exam_id) && !empty($user_exam_id) && $sub->class_exam_id != $user_exam_id)
            {
            continue;
            }
            @endphp
            @if($subscription_type=="P")
            <div class="selectPlanedetail">
                <div class="planeName hideonmobile">
                    <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{$subsprice}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{$subsprice}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                    </div>
                </div>




                <div class="testType testTypeformob">
                    <div class="testTypeulbox">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Chapter and Topic-wise Unlimited Tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Adaptive Learning Experience
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                AI-based Analytics and Valuable Insightss
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Identify Your Strengths and Weaknesses
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Personalised and Smart Recommendations
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Plan Your Weekly and Monthly Preparation
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Unlimited Mock tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>Live Exam - All India Test Series
                            </li>
                        </ul>
                    </div>
                    <div class="allbenefitsbtn">Show all benefits
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="m4 6.314 4 4 4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="planType">
                    <div class="freeTrial">
                        <a href="{{url('/performance-rating')}}">Continue</a>
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <input type="hidden" name="exam_price" value="{{$subsprice}}">
                            <button type="submit" class="btn btn-common-green disabled" disabled id="get-sub-btn"> Purchased</button>
                        </form>
                    </div>
                </div>
            </div>
            @elseif($subscription_type!="P")
            <div class="selectPlanedetail">
                <div class="planeName hideonmobile">
                    <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{$subsprice}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{$subsprice}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                    </div>
                </div>




                <div class="testType testTypeformob">
                    <div class="testTypeulbox">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Chapter and Topic-wise Unlimited Tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Adaptive Learning Experience
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                AI-based Analytics and Valuable Insightss
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Identify Your Strengths and Weaknesses
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Personalised and Smart Recommendations
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Plan Your Weekly and Monthly Preparation
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Unlimited Mock tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>Live Exam - All India Test Series
                            </li>
                        </ul>
                    </div>
                    <div class="allbenefitsbtn">Show all benefits
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="m4 6.314 4 4 4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                    </div>
                </div>
                <div class="planType">
                    <div class="freeTrial">
                        <a href="{{url('/performance-rating')}}">Already in {{$sub->trial_subscription_duration}} days trial Period</a>
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <input type="hidden" name="exam_price" value="{{$subsprice}}">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Get subscription</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @elseif((count($purchasedid)>0) && !empty($userData->id))
            @php
            $discount=(!empty($subspriceDiscount))?head(array_values($subspriceDiscount)):0;
            $discount_price=($subsprice*$discount)/100;
            if(isset($user_exam_id) && !empty($user_exam_id) && $sub->class_exam_id != $user_exam_id)
            {
            continue;
            }
            @endphp
            <div class="selectPlanedetail" style="display:none">
                <div class="planeName hideonmobile">
                    <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{$subsprice}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{$subsprice}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                    </div>
                </div>




                <div class="testType testTypeformob">
                    <div class="testTypeulbox">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Chapter and Topic-wise Unlimited Tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Adaptive Learning Experience
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                AI-based Analytics and Valuable Insightss
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Identify Your Strengths and Weaknesses
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Personalised and Smart Recommendations
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Plan Your Weekly and Monthly Preparation
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Unlimited Mock tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>Live Exam - All India Test Series
                            </li>
                        </ul>
                    </div>
                    <div class="allbenefitsbtn">Show all benefits
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="m4 6.314 4 4 4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="planType">
                    @if($sub->trial_subscription_duration>0)
                    @if(!in_array($sub->subscript_id,$purchasedid) )
                    <div class="freeTrial">
                        <a href="{{route('trial_subscription',[$sub->subscript_id,$sub->exam_year,$sub->class_exam_id])}}">Start {{$sub->trial_subscription_duration}} days free trial</a>
                    </div>
                    @else
                    <div class="freeTrial">
                        <a href="javascript:void(0);">Expired {{$sub->trial_subscription_duration}} days trial</a>
                    </div>
                    @endif
                    @endif
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @if((count($purchasedid)>0) && !empty($userData->id)) onsubmit="return confirm('Previous subscription will not be valid after new subscription.');" @endif method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <input type="hidden" name="exam_price" value="{{$subsprice}}">
                            <button type="submit" class="btn btn-common-green disabled" disabled id="get-sub-btn"> Get Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            @php
            $discount=(!empty($subspriceDiscount))?head(array_values($subspriceDiscount)):0;
            $discount_price=($subsprice*$discount)/100;
            if(isset($user_exam_id) && !empty($user_exam_id) && $sub->class_exam_id != $user_exam_id)
            {
            continue;
            }
            @endphp
            <div class="selectPlanedetail">
                <div class="planeName hideonmobile">
                    <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{$subsprice}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                        </div>
                    </div>
                </div>

                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{$subsprice}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                    </div>
                </div>

<!------------------------------------------------------------------------------------>
                <div class="testType testTypeformob">
                    <div class="testTypeulbox">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Chapter and Topic-wise Unlimited Tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Adaptive Learning Experience
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                AI-based Analytics and Valuable Insightss
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Identify Your Strengths and Weaknesses
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Personalised and Smart Recommendations
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Plan Your Weekly and Monthly Preparation
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Unlimited Mock tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>Live Exam - All India Test Series
                            </li>
                        </ul>
                    </div>
                    <div class="allbenefitsbtn">Show all benefits
                    <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="m4 6.314 4 4 4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                  
                </div>
                <div class="planType">
                    @if($sub->trial_subscription_duration>0)
                    @if(!in_array($sub->subscript_id,$purchasedid) )

                    <div class="freeTrial">
                        <a href="{{route('trial_subscription',[$sub->subscript_id,$sub->exam_year,$sub->class_exam_id])}}">Start {{$sub->trial_subscription_duration}} days free trial</a>
                    </div>
                    @else
                    <div class="freeTrial">
                        <a href="javascript:void(0);">Expired {{$sub->trial_subscription_duration}} days trial ></a>
                    </div>
                    @endif
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <input type="hidden" name="exam_price" value="{{$subsprice}}">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Get subscription</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
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
            <div class="selectPlanedetail">
                <div class="planeName hideonmobile">
                    <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{$subsprice}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{$subsprice}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                    </div>
                </div>

                <div class="testType testTypeformob">
                    <div class="testTypeulbox">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Chapter and Topic-wise Unlimited Tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Adaptive Learning Experience
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                AI-based Analytics and Valuable Insightss
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Identify Your Strengths and Weaknesses
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Personalised and Smart Recommendations
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Plan Your Weekly and Monthly Preparation
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Unlimited Mock tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>Live Exam - All India Test Series
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="planType">
                    <div class="freeTrial">
                        <a href="javascript:void(0);">Your paid subscription expired</a>
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <input type="hidden" name="exam_price" value="{{$subsprice}}">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Renew</button>
                        </form>
                    </div>
                </div>
            </div>
            @elseif( $user_exam_id==$sub->class_exam_id && $subscription_type !="P")
            <div class="selectPlanedetail">
                @php
                $discount=(!empty($subspriceDiscount))?head(array_values($subspriceDiscount)):0;
                $discount_price=($subsprice*$discount)/100;
                if(isset($user_exam_id) && !empty($user_exam_id) && $sub->class_exam_id != $user_exam_id)
                {
                continue;
                }
                @endphp
                <div class="planeName hideonmobile">
                    <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{$subsprice}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{$subsprice}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                    </div>
                </div>


                <div class="testType testTypeformob">
                    <div class="testTypeulbox">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Chapter and Topic-wise Unlimited Tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Adaptive Learning Experience
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                AI-based Analytics and Valuable Insightss
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Identify Your Strengths and Weaknesses
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Personalised and Smart Recommendations
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Plan Your Weekly and Monthly Preparation
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Unlimited Mock tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>Live Exam - All India Test Series
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="planType">
                    <div class="freeTrial">
                        <a href="javascript:void(0);">{{$sub->trial_subscription_duration}} days trial Period expired.</a>
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <input type="hidden" name="exam_price" value="{{$subsprice}}">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Get Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="selectPlanedetail">
                <div class="planeName hideonmobile">
                    <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{$subsprice}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <p>{{strtoupper($sub->subscription_name)}} Annual Plan</p>
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{$subsprice}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{$subsprice-$discount_price}}<sub>per year</sub>
                    </div>
                </div>





                <div class="testType testTypeformob">
                    <div class="testTypeulbox">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Chapter and Topic-wise Unlimited Tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Adaptive Learning Experience
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                AI-based Analytics and Valuable Insightss
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Identify Your Strengths and Weaknesses
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Personalised and Smart Recommendations
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Plan Your Weekly and Monthly Preparation
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>
                                Unlimited Mock tests
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663" />
                                </svg>Live Exam - All India Test Series
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <div class="planType">
                    <div class="freeTrial">
                        <a href="javascript:void(0);">14 days trial Period expired.</a>
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <input type="hidden" name="exam_price" value="{{$subsprice}}">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Get Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif
            @endif
            <div class="verificationBoxmobile  hideondesktop">
                <div class="verificationBox">
                    <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified</p>
                    <a href="javascript:void(0);" class="resend_email">Resend</a>
                    <span class="mt-2" id="email_success"></span>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#email_success').hide();
        $('.resend_email').click(function() {
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
                        $("#email_success").fadeOut(10000);
                    } else {
                        $('#email_success').css('color', 'red');
                        $('#email_success').text(response_data.message);
                        $('#email_success').show();
                        $("#email_success").fadeOut(10000);
                    }

                },
            });
        });
    });
</script>
<script>
  $( '.allbenefitsbtn' ).click(function() {
    $( '.testTypeulbox' ).toggleClass('autoHeight');
    });
 </script>
@endsection