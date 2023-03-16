@extends('layouts.app')
@section('content')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
$lead_exam_id = isset($userData->lead_exam_id) && !empty($userData->lead_exam_id) ?$userData->lead_exam_id:'';
$trail_sub = isset($userData->trail_sub) && !empty($userData->trail_sub) ?$userData->trail_sub:'';
$full_body_attempt = Session::get('full_body_attempt');
@endphp
<?php $redis_data = Session::get('redis_data'); ?>
<?php 
// For Mixpanel
if($user_exam_id == '1'){
$grade='JEE';
}
elseif($user_exam_id == '2'){
$grade='NEET';
}
else{
$grade='NA';
}

?>
<!-- Mixpanel Started -->
<!--script type="text/javascript">
(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

// Enabling the debug mode flag is useful during implementation,
// but it's recommended you remove it for production
var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
mixpanel.init(mixpanelid);


</script-->
<!-- Mixpanel Event Ended -->
<div class="wihoutlogintoast">
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
</div>
<section class="subscriptionsPage d-flex fullbody_scan_page subscriptionNew">
    <div class="subscriptionsLeftpannel">
        <a href="{{env('CMS_URL')}}" target="_blank"><img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></a>
        <div class="progress-box">
            <ul class="progressorder">
                <li class="progress__item progress__item--completed">
                    <p class="progress__title">Select Plan</p>
                    <p class="progress__info">Decide on the best plan for your preparation</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
                <li class="progress__item progress__item--completed">
                    <p class="progress__title">Self Analysis</p>
                    <p class="progress__info">Rate your level of proficiency</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
                <li class="progress__item   progress__item--active">
                    <p class="progress__title">Personalized Assessment</p>
                    <p class="progress__info">To assess your preparedness</p>
                    <img src="{{URL::asset('public/after_login/current_ui/images/checkbox-icon.png')}}">
                </li>
            </ul>
        </div>
        @if($userData->email_verified=='No')
        <div class="verificationBox tab_show_performence_analytics tab_show">
            <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
            <a href="javascript:void(0);" class="resend_email">Resend</a>
            <span class="mt-2" id="email_success"></span>
        </div>
        @endif
    </div>
    <div class="selectPlan subscriptionsRightpannel">
        <span class="tab_show_performence_analytics tab_show desktop_hide_performence_analytics"><img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo"></span>
        <div class="AssementTestBlock">
            <div class="SelectPlane_text">
                <h3 class="pageCountBox">
                    <div>Personalized Preparation Assessment <span class="badge badge-light">{{$grade}}</span></div>
                    <span class="pagecount hideondesktop"><span class="activePage">3</span>/3</span>
                </h3>
                <p>To assess your preparedness, this will also help us to generate daily and weekly tasks for you, based on your proficiency levels.</p>
            </div>
            <div class="verificationBox mt-0 desktop_hide_performence_analytics">
                <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
                <a href="javascript:void(0);" class="resend_email">Resend</a>
            </div>
            <div class="personalAssesmentNewBlock">
                <div class="AssiementNewRow">
                    <div class="AssesmentWhitePannel">
                        <h4 class="assismetHeading">Basic Personalized Assessment</h4>
                        <h6 class="assismetSubHeading">Mathematics, Physics & Chemistry</h6>
                        <hr>
                        <div class="AssementBlockList">
                            <ul>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>
                                    1 hour duration
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>
                                    30 questions in this assessment
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>
                                    Covers the key topics in the syllabus
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>
                                    Short-lenght test to evaluate specific knowledge
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>
                                    Personalized recommendations for improvement
                                </li>
                            </ul>
                        </div>
                        <a href="{{route('exam',['full_exam_basic','instruction'])}}" class="btn btn-common-green fullwidth"> Take Test</a>
                    </div>
                    <div class="orblock">
                        <span>OR</span>
                    </div>
                    <div class="AssesmentWhitePannel">
                        <span class="recomondFloat">Recommended</span>
                        <h4 class="assismetHeading">Advanced Personalized Assessment</h4>
                        <h6 class="assismetSubHeading">Mathematics, Physics & Chemistry</h6>
                        <hr>
                        <div class="AssementBlockList">
                            <ul>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>3 hours duration
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>{{$prof_test_qcount}} questions in this assessment
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>Comprehensive assessment covering all topics
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>Full-length test designed to evaluate overall knowledge & simulate the actual exam experience
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                    </svg>Personalized recommendations for improvement
                                </li>
                            </ul>
                        </div>
                        <a href="{{route('exam',['full_exam_advance','instruction'])}}" class="btn btn-common-green fullwidth"> Take Test</a>
                    </div>
                </div>
                
            </div>
            <div class="mt-5 d-flex justify-content-between align-items-center pt-4">
                    <div class="backBtn pt-0 mr-2">
                        <a href="{{ url('performance-rating') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M10 4 6 8l4 4" stroke="#363C4F" stroke-opacity=".8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            Back
                        </a>
                    </div>
                    <a class="btn btn-common-transparent no-border" href="{{url('/dashboard')}}">Skip to Dashboard</a>
                </div>
        </div>
        <div class="fullbody_scan_wrapper" style="display:none">
            <div class="mt-5 d-flex justify-content-between align-items-center pb-5">
                <div class="backBtn pt-0 mr-2">
                    <a href="{{ url('performance-rating') }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M10 4 6 8l4 4" stroke="#363C4F" stroke-opacity=".8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        Back
                    </a>
                </div>
            </div>
            <div class="fullbody_scan_box d-flex fullBodyNew">
                <div class="fullbody_scan_card">
                    <span class="badge badge-light Subjectbadge mb-4">{{$grade}}</span>
                    <h4 class="assismetHeading w-100">Basic Personalized Assessment</h4>
                    @if($user_exam_id == '1')
                    <h6 class="assismetSubHeading">Mathematics, Physics &amp; Chemistry</h6>
                    @else
                    <h6 class="assismetSubHeading">Physics, Chemistry,Biology  &amp; Zoology</h6>
                    @endif
                    <div class="TimeblockAssisment">
                        <div class="questionAss">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M3.5 18V7C3.5 3 4.5 2 8.5 2H15.5C19.5 2 20.5 3 20.5 7V17C20.5 17.14 20.5 17.28 20.49 17.42" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6.35 15H20.5V18.5C20.5 20.43 18.93 22 17 22H7C5.07 22 3.5 20.43 3.5 18.5V17.85C3.5 16.28 4.78 15 6.35 15Z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8 7H16" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8 10.5H13" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <label>30</label>
                            <span>Questions</span>
                        </div>
                        <div class="questionAss mr-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20.75 13.25C20.75 18.08 16.83 22 12 22C7.17 22 3.25 18.08 3.25 13.25C3.25 8.42 7.17 4.5 12 4.5C16.83 4.5 20.75 8.42 20.75 13.25Z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 8V13" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 2H15" stroke="#56B663" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <label>01</label>
                            <span>Hours</span>
                        </div>
                    </div>
                    <!-- <ul style="margin-top:32px">
                        <li class="mb-3">No of Questions: <span>{{$prof_test_qcount}} questions</span></li>
                        <li class="mb-3">Duration <span>3 hours</span></li>
                        <li>Subjects <span>{{$subjects_name}}</span></li>
                    </ul> -->
                </div>
                <div class="fullbody_scan_test text-center position-relative">
                    <!-- <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-big.svg')}}"></span>
                    <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-small.svg')}}"></span> -->
                    <span class="greenball-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="28" viewBox="0 0 29 28" fill="none">
                            <circle cx="14.9725" cy="13.9891" r="13.9891" fill="#52AC5F" />
                        </svg>
                    </span>
                    <span class="greenball-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="71" viewBox="0 0 35 71" fill="none">
                            <circle cx="4.95911e-05" cy="35.2847" r="34.9727" fill="#52AC5F" />
                        </svg>
                    </span>
                    <span class="greenball-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <circle cx="8.53024" cy="8.61739" r="7.86886" fill="#52AC5F" />
                        </svg>
                    </span>
                    <img src="{{URL::asset('public/after_login/current_ui/images/note2.svg')}}" style="width: 72px;height: 78px;">
                    <h4>All the Best Sakshi!</h3>
                        <!-- <p class="my-3">to assess your preparation. Take your first step to improvement.</p> -->
                        @if($full_body_attempt=="Y")
                        <a class="btn btn-common-white disabled" href="javescript:void(0);">Attempted</a>
                        @else
                        <a class="btn btn-common-white" href="{{route('exam',['full_exam','instruction'])}}">Take Test</a>
                        @endif
                </div>
            </div>
            <div class="InstructionSectionAssisment">
                <div class="instructionScroolBlock">
                    <h3 class="instrctionHeading">INSTRUCTIONS</h3>
                    <p class="Instsubheading">
                        Prior to taking the test, please read through all of the instruction sections carefully.
                    </p>
                    <div class="instructionListBlock">
                        <div class="commonInstructionList">
                            <div class="instHeading">
                                <b>1. <span>General</span></b>
                            </div>
                            <div class="instLine"></div>
                            <ul>
                                <li> This DesD is of <b>300 marks (100 </b> marks each section) </li>
                            </ul>
                        </div>
                        <div class="commonInstructionList">
                            <div class="instHeading">
                                <b>2. <span>Subject-Specific Instructions (Physics/ Chemistry/Mathematics)</span></b>
                            </div>
                            <div class="instLine"></div>
                            <ul>
                                <li> Each subjecD consisDs of <b>25 </b>single correcD MCQs</li>
                                <li>The answer to each question will be evaluated according to the following marking</li>
                            </ul>
                            <div class="instructionTable">
                                <table class="table table-bordered ">
                                    <tbody>
                                        <tr>
                                            <td>Full marks</td>
                                            <td><b>+4 </b>CorrecD answer</td>
                                        </tr>
                                        <tr>
                                            <td>No Mark</td>
                                            <td><b>0 </b>Unanswered/Unanswered and marked for review</td>
                                        </tr>
                                        <tr>
                                            <td>Minus One Mark</td>
                                            <td><b>-1</b>in all other cases</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="commonInstructionList">
                                <div class="instHeading">
                                    <b>3. <span>CBT (Computer-Based Test) Instructions</span></b>
                                </div>
                                <div class="instLine"></div>
                                <ul>
                                    <li>The clock will be set at the server. The countdown timer at the top right corner of the screen will display the remaining time for the test. As soon as the designated time ends, the test will end.</li>
                                    <li><b>Average Time </b>on the top right corner indicates the ideal time in which that question should be solved.</li>
                                    <li>To pause the test, click on <b>"Pause"</b> icon and to resume the same, click on <b>"Resume"</b> button.</li>
                                    <li>To submit the test, click on the <b>"Submit"</b> button present at the top right side of the screen after attempting the last displayed question.</li>
                                    <li>To answer any question, choose the correct option and click on <b>"Save & Next" button.</b></li>
                                    <li>To deselect your chosen answer, click on the <b>"Clear Response" </b>button.</li>
                                    <li>To mark the question for review (without answering it), click on the <b>"Mark for Review”</b> button</li>
                                    <li>To mark the question for review (alter answering it), click on the <b>“Save & Mark for Review"</b> button</li>
                                    <li>Click on <b>"Next Question"</b> arrow button to skip any question without answering it.</li>
                                    <li>Click on the question number in the question palette at the right side of the screen to go to that question directly.<br>
                                        <b>
                                            Note that using this option does NOT save the answer to the currently displayed question.</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="mt-5 d-flex justify-content-between align-items-center pt-4">
                <div class="backBtn pt-0 mr-2">
                    <a href="{{ url('performance-rating') }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M10 4 6 8l4 4" stroke="#363C4F" stroke-opacity=".8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        Back
                    </a>
                </div>
                <a  class="btn btn-common-transparent" href="{{url('/dashboard')}}">Skip to Dashboard</a>
            </div> -->
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('#email_success').hide();
    $('.toastdata').hide();
    $('.progress').hide();
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
});

</script>
@endsection
