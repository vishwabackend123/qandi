@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
$leadData ='';
if (Session::has('lead_trail_status')) {
$leadData = Session::get('lead_trail_status');
}
@endphp
@section('content')

<!-- Mixpanel Started -->
<?php $redis_data = Session::get('redis_data'); ?>
<script type="text/javascript">
(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

// Enabling the debug mode flag is useful during implementation,
// but it's recommended you remove it for production

var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
mixpanel.init(mixpanelid);
mixpanel.track('Loaded Select Plan',{
        "$city" : '<?php echo $userData->city; ?>',
        });

</script>

<!-- Mixpanel Event Ended -->


<div class="wrapper wihoutlogintoast">
    <div class="toastdata">
        <div class="toast-content">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 17C1 8.163 8.163 1 17 1s16 7.163 16 16-7.163 16-16 16S1 25.837 1 17z" fill="#8DFDB3" />
                <path d="M23.666 16.387V17a6.667 6.667 0 1 1-3.953-6.093m3.953.76L17 18.34l-2-2" stroke="#039855" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M17 32C8.716 32 2 25.284 2 17H0c0 9.389 7.611 17 17 17v-2zm15-15c0 8.284-6.716 15-15 15v2c9.389 0 17-7.611 17-17h-2zM17 2c8.284 0 15 6.716 15 15h2c0-9.389-7.611-17-17-17v2zm0-2C7.611 0 0 7.611 0 17h2C2 8.716 8.716 2 17 2V0z" fill="#BDF3C5" />
            </svg>
            <div class="message">
                <h5 class="mb-2 error_header"></h5>
                <p class="error_toast"></p>
            </div>
        </div>

        <div class="progress"></div>
    </div>
    <section class="subscriptionsPage d-flex">
        <div class="subscriptionsLeftpannel">
            <a href="{{env('CMS_URL')}}" target="_blank"><img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></a>
            <div class="progress-box">
                <ul class="progressorder">
                    <li class="progress__item  progress__item--active">
                        <p class="progress__title">Select Plan</p>
                        <p class="progress__info">Decide on the best plan for your preparation</p>
                    </li>
                   @if ($student_rating == null || empty($student_rating)) 
                    <li class="progress__item">
                        <p class="progress__title">Self Analysis</p>
                        <p class="progress__info">Rate your level of proficiency</p>
                    </li>
                    <li class="progress__item ">
                        <p class="progress__title">Personalized Assessment</p>
                        <p class="progress__info">To assess your preparedness</p>
                    </li>
                    @endif
                </ul>
            </div>
            @if($userData->email_verified=='No')
            <div class="verificationBox">
                <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
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
                    <!-- <p>{{$sub->subscription_name}} Annual Plan desktop</p> -->
                    <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select> -->
                    <!-- Select2 drop down -->
                    <div class="customDropdown1 dropdown" id="dropdown1" style=" width:300px;">
                        <input class="text-box markstrend" type="text" id="subscriptions_plan" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan" onclick="showPlan('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{number_format($subsprice)}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <!-- <p>{{$sub->subscription_name}} Annual Plan 1</p> -->
                        <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select> -->
                    <!-- Select2 drop down Mobile -->
                    <div class="customDropdown1 dropdown" id="dropdown2" >
                        <input class="text-box markstrend" type="text" id="subscriptions_plan_mobile" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan_mobile" onclick="showPlanMobile('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{number_format($subsprice)}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>

                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                    </div>
                </div>




                <div class="testType testTypeformob">
                    <div class="testTypeulbox d-md-flex justify-content-between align-items-center">
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
                                AI-based Analytics and Valuable Insights
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
                    <div class="allbenefitsbtn"><span class="show-text">Show all benefits</span>
                        <span class="hide-text">Hide benefits</span>
                        <span class="arrowbtn1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="m4 6.314 4 4 4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="planType">
                    <div class="freeTrial">
                        @if ($student_rating == null || empty($student_rating)) 
                        <a href="{{url('/performance-rating')}}">Continue</a>
                        @else
                        <a href="{{url('/dashboard')}}">Continue</a>
                        @endif
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="{{$default_month}}">
                            <input type="hidden" name="period_unit" value="month">
                            <button type="submit" class="btn btn-common-green disabled" disabled id="get-sub-btn"> Purchased</button>
                        </form>
                    </div>
                </div>
            </div>
            @elseif($subscription_type!="P")
            <div class="selectPlanedetail">
                <div class="planeName hideonmobile">
                    <!-- <p>{{$sub->subscription_name}} Annual Plan desktop</p> -->
                     <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select> -->
                    <!-- Select2 drop down -->
                    <div class="customDropdown1 dropdown" id="dropdown1" style=" width:300px;">
                        <input class="text-box markstrend" type="text" id="subscriptions_plan" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan" onclick="showPlan('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->

                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{number_format($subsprice)}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <!-- <p>{{$sub->subscription_name}} Annual Plan 2</p> -->
                         <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                        </select> -->
                        <!-- Select2 drop down Mobile -->
                    <div class="customDropdown1 dropdown" id="dropdown2" >
                        <input class="text-box markstrend" type="text" id="subscriptions_plan_mobile" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan_mobile" onclick="showPlanMobile('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{number_format($subsprice)}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>

                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                    </div>
                </div>




                <div class="testType testTypeformob">
                    <div class="testTypeulbox d-md-flex justify-content-between align-items-center">
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
                                AI-based Analytics and Valuable Insights
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
                    <div class="allbenefitsbtn"><span class="show-text">Show all benefits</span>
                        <span class="hide-text">Hide benefits</span>
                        <span class="arrowbtn1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="m4 6.314 4 4 4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>

                    </div>
                </div>
                @php
                $days=14;
                if(isset($subscriptionData))
                {
                    $startdate=isset($subscriptionData->subscription_start_date)? date("d-m-Y", strtotime($subscriptionData->subscription_start_date)):'';
                    $expirydate=isset($subscriptionData->subscription_end_date)? date("d-m-Y", strtotime($subscriptionData->subscription_end_date)):'';
                    $datetime1 = new DateTime($startdate);
                    $datetime2 = new DateTime($expirydate);
                    $interval = $datetime1->diff($datetime2);
                    $days = $interval->format('%a');
                }
                @endphp
                <div class="planType">
                    <div class="freeTrial">
                        @if($days <=14)
                            @if ($student_rating == null || empty($student_rating)) 
                            <a href="{{url('/performance-rating')}}">Already in {{$days}} day trial Period</a>
                            @else
                            <a href="{{url('/dashboard')}}">Already in {{$days}} day trial Period</a>
                            @endif
                        @else
                        @if ($student_rating == null || empty($student_rating)) 
                            <a href="{{url('/performance-rating')}}">Already in 1 year trial Period</a>
                            @else
                            <a href="{{url('/dashboard')}}">Already in 1 year trial Period</a>
                            @endif
                        @endif
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Get Subscription</button>
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
                    <!-- <p>{{$sub->subscription_name}} Annual Plan desktop</p> -->
                   <!--  <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select> -->
                    <!-- Select2 drop down -->
                    <div class="customDropdown1 dropdown" id="dropdown1" style=" width:300px;">
                        <input class="text-box markstrend" type="text" id="subscriptions_plan" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan" onclick="showPlan('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{number_format($subsprice)}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <!-- <p>{{$sub->subscription_name}} Annual Plan 3</p> -->
                        <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select> -->
                    <!-- Select2 drop down Mobile -->
                    <div class="customDropdown1 dropdown" id="dropdown2" >
                        <input class="text-box markstrend" type="text" id="subscriptions_plan_mobile" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan_mobile" onclick="showPlanMobile('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{number_format($subsprice)}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>

                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                    </div>
                </div>




                <div class="testType testTypeformob">
                    <div class="testTypeulbox d-md-flex justify-content-between align-items-center">
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
                                AI-based Analytics and Valuable Insights
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
                    <div class="allbenefitsbtn"><span class="show-text">Show all benefits</span>
                        <span class="hide-text">Hide benefits</span>
                        <span class="arrowbtn1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="m4 6.314 4 4 4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="planType">
                    @if($sub->trial_subscription_duration>0)
                    @if(!in_array($sub->subscript_id,$purchasedid) )
                    <div class="freeTrial">
                        @if(isset($leadData) && $leadData !=2)
                        <a href="{{route('trial_subscription',[$sub->subscript_id,$sub->exam_year,$sub->class_exam_id])}}">Start your {{$sub->trial_subscription_duration}}-day free trial.</a>
                        @endif
                    </div>
                    @else
                    <div class="freeTrial">
                        <a href="javascript:void(0);">Expired {{$sub->trial_subscription_duration}} day trial</a>
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
                            <button type="submit" class="btn btn-common-green disabled" disabled id="get-sub-btn"> Get Subscription</button>
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
                    <!-- <p>{{$sub->subscription_name}} Annual Plan desktop</p> -->
                    <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select> -->
                    <!-- Select2 drop down -->
                    <div class="customDropdown1 dropdown" id="dropdown1" style=" width:300px;">
                        <input class="text-box markstrend" type="text" id="subscriptions_plan" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan" onclick="showPlan('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{number_format($subsprice)}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                        </div>
                    </div>
                </div>

                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <!-- <p>{{$sub->subscription_name}} Annual Plan 4</p> -->
                        <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                        </select> -->
                        <!-- Select2 drop down Mobile -->
                    <div class="customDropdown1 dropdown" id="dropdown2" >
                        <input class="text-box markstrend" type="text" id="subscriptions_plan_mobile" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan_mobile" onclick="showPlanMobile('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{number_format($subsprice)}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>

                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                    </div>
                </div>

                <!------------------------------------------------------------------------------------>
                <div class="testType testTypeformob">
                    <div class="testTypeulbox d-md-flex justify-content-between align-items-center">
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
                                AI-based Analytics and Valuable Insights
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
                    <div class="allbenefitsbtn"><span class="show-text">Show all benefits</span>
                        <span class="hide-text">Hide benefits</span>
                        <span class="arrowbtn1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                <path d="m4 6.314 4 4 4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>

                </div>
                <div class="planType">
                    @if($sub->trial_subscription_duration>0)
                    @if(!in_array($sub->subscript_id,$purchasedid) )

                    <div class="freeTrial">
                        @if(isset($leadData) && $leadData !=2)
                        <a href="{{route('trial_subscription',[$sub->subscript_id,$sub->exam_year,$sub->class_exam_id])}}">Start your {{$sub->trial_subscription_duration}}-day free trial</a>
                        @endif
                    </div>
                    @else
                    <div class="freeTrial">
                        <a href="javascript:void(0);">Expired {{$sub->trial_subscription_duration}} day trial ></a>
                    </div>
                    @endif
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Get Subscription</button>
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
                    <!-- <p>{{$sub->subscription_name}} Annual Plan desktop</p> -->
                    <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select> -->
                    <!-- Select2 drop down -->
                    <div class="customDropdown1 dropdown" id="dropdown1" style=" width:300px;">
                        <input class="text-box markstrend" type="text" id="subscriptions_plan" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan" onclick="showPlan('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{number_format($subsprice)}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <!-- <p>{{$sub->subscription_name}} Annual Plan 5</p> -->
                       <!--   <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                        </select> -->
                        <!-- Select2 drop down Mobile -->
                    <div class="customDropdown1 dropdown" id="dropdown2" >
                        <input class="text-box markstrend" type="text" id="subscriptions_plan_mobile" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan_mobile" onclick="showPlanMobile('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{number_format($subsprice)}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>

                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                    </div>
                </div>

                <div class="testType testTypeformob">
                    <div class="testTypeulbox d-md-flex justify-content-between align-items-center">
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
                                AI-based Analytics and Valuable Insights
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
                    <!-- <p>{{$sub->subscription_name}} Annual Plan desktop</p> -->
                    <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select> -->
                    <!-- Select2 drop down -->
                    <div class="customDropdown1 dropdown" id="dropdown1" style=" width:300px;">
                        <input class="text-box markstrend" type="text" id="subscriptions_plan" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan" onclick="showPlan('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{number_format($subsprice)}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                         <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select>
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{number_format($subsprice)}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>

                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                    </div>
                </div>


                <div class="testType testTypeformob">
                    <div class="testTypeulbox d-md-flex justify-content-between align-items-center">
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
                                AI-based Analytics and Valuable Insights
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
                        <a href="javascript:void(0);" style="cursor:default">Your {{$sub->trial_subscription_duration}}-day free trial has expired.</a>
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Get Subscription</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="selectPlanedetail">
                <div class="planeName hideonmobile">
                    <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                    </select>
                    <div class="price">
                        <div class="offer">
                            <span class="offer_price">₹{{number_format($subsprice)}}</span>
                            <span class="offer_disco">({{$discount}}% off)</span>
                        </div>
                        <div class="peryearPrice">
                            ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                        </div>
                    </div>
                </div>
                <div class="planenameformob hideondesktop">
                    <div class="planeName">
                        <!-- <p>{{$sub->subscription_name}} Annual Plan 6</p> -->
                        <!-- <select class="form-control plandropdown">
                             @foreach($plan_list as $list)
                             <option value="{{$list}}" @if($list==$default_month) selected @else "" @endif>{{$sub->subscription_name}} {{$list}}-Month Plan</option>
                             @endforeach
                       </select> -->
                       <!-- Select2 drop down Mobile -->
                    <div class="customDropdown1 dropdown" id="dropdown2" >
                        <input class="text-box markstrend" type="text" id="subscriptions_plan_mobile" placeholder="{{$sub->subscription_name}} {{$default_month}}-Month Plan" readonly>
                        <div class="options">
                            <div style=" overflow-y: auto;  height: 145px;">
                            @foreach($plan_list as $list)
                            <div class="active markstrend subscriptions_plan_mobile" onclick="showPlanMobile('{{$sub->subscription_name}}', '{{$list}}','subscriptions_plan')" >{{$sub->subscription_name}} {{$list}}-Month Plan</div>
                             @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Select2 drop down END -->
                        <div class="price">
                            <div class="offer">
                                <span class="offer_price">₹{{number_format($subsprice)}}</span>
                                <span class="offer_disco">({{$discount}}% off)</span>
                            </div>

                        </div>
                    </div>
                    <div class="peryearPrice">
                        ₹{{number_format($subsprice-$discount_price)}}<span>{{$default_month}} months</span>
                    </div>
                </div>





                <div class="testType testTypeformob">
                    <div class="testTypeulbox d-md-flex justify-content-between align-items-center">
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
                                AI-based Analytics and Valuable Insights
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
                        <a href="javascript:void(0);" style="cursor:default">Your 14-day free trial has expired.</a>
                    </div>
                    <div class="getSubs">
                        <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                            <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                            <input type="hidden" name="exam_period" value="12">
                            <input type="hidden" name="period_unit" value="month">
                            <button type="submit" class="btn btn-common-green" id="get-sub-btn">Get Subscription</button>
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
                    <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
                    <a href="javascript:void(0);" class="resend_email">Resend</a>
                    <span class="mt-2" id="email_success"></span>
                </div>
            </div>
        </div>
    </section>
</div>
@php 
$subscrption_json= json_encode($subscriptions_list);
@endphp
<script type="text/javascript">
    function showPlan(type, month, id) {
            document.querySelector("#subscriptions_plan").value = type + " " +month+ "-Month Plan"  ;   
            
            
                         $.ajax({
                url: "{{ url('get_plan_list') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    planMonth: month,
                },
                success: function(response_data) {
                    $("input[name='subscript_id']").val(response_data.subscript_id);
                    $("input[name='exam_period']").val(response_data.months);
                    $('.peryearPrice').html("₹"+response_data.price+"<span>"+response_data.months+" months</span>");
                    $('.offer_price').html("₹"+response_data.price);
                },
            });
        }

        function showPlanMobile(type, month, id) {
            document.querySelector("#subscriptions_plan_mobile").value = type + " " +month+ "-Month Plan"  ;   
            
            $.ajax({
                url: "{{ url('get_plan_list') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    planMonth: month,
                },
                success: function(response_data) {
                    $("input[name='subscript_id']").val(response_data.subscript_id);
                    $("input[name='exam_period']").val(response_data.months);
                    $('.peryearPrice').html("₹"+response_data.price+"<span>"+response_data.months+" months</span>");
                    $('.offer_price').html("₹"+response_data.price);
                },
            });
        }

    let dropdown1 = document.querySelector("#dropdown1")
        dropdown1.onclick = function() {
            dropdown1.classList.toggle("active1")
        }

        let dropdown2 = document.querySelector("#dropdown2")
        dropdown2.onclick = function() {
            dropdown2.classList.toggle("active1")
        }
        
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
                    $('.toastdata').show();
                    $('.progress').show();
                    $('.toastdata').addClass('active');
                    $('.progress').addClass('active');
                    $('.error_header').text("Email Verification Link Sent");
                    if (response_data.status === true) {
                        $('.error_toast').text("A verification link has been sent, please click the link to get your account verified.");
                    } else {
                        $('.error_toast').text(response_data.message);
                    }
                    setTimeout(function() {
                        $(".toastdata").removeClass('active');
                        $(".progress").removeClass('active');
                        $('.toastdata').hide();
                        $('.progress').hide();
                    }, 10000);

                },
            });
        });
        $(".plandropdown").on('change',function () {
             var plan_month= $('.plandropdown option:selected').val();
                         $.ajax({
                url: "{{ url('get_plan_list') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    planMonth: plan_month,
                },
                success: function(response_data) {
                    $("input[name='subscript_id']").val(response_data.subscript_id);
                    $("input[name='exam_period']").val(response_data.months);
                    $('.peryearPrice').html("₹"+response_data.price+"<span>"+response_data.months+" months</span>");
                    $('.offer_price').html("₹"+response_data.price);
                },
            });
        });
    });
</script>
<script>
    $('.toastdata').hide();
    $('.progress').hide();
    $('.allbenefitsbtn').click(function() {
        $('.testTypeulbox').toggleClass('autoHeight');
        $('.arrowbtn1').toggleClass('arrowroted');

    });
</script>


@endsection