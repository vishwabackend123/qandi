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
<section class="subscriptionsPage d-flex fullbody_scan_page">
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
                    <p class="progress__title">Personal Assessment Test</p>
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
        <div class="fullbody_scan_wrapper">
            <div class="mt-5 d-flex justify-content-between align-items-center pb-5">
                <div class="backBtn pt-0 mr-2">
                    <a href="{{ url('performance_analytics') }}">
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
                    @if ($exam_name_new == 'full_exam_basic')
                    <h4 class="assismetHeading w-100">Basic Personalized Assessment</h4>
                    @else
                    <h4 class="assismetHeading w-100">Advance Personalized Assessment</h4>
                    @endif
                    @if($user_exam_id == '1')
                    <h6 class="assismetSubHeading">Mathematics, Physics &amp; Chemistry</h6>
                    @else
                    <h6 class="assismetSubHeading">Physics, Chemistry, Biology &amp; Zoology</h6>
                    @endif
                    <div class="TimeblockAssisment">
                        <div class="questionAss">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M3.5 18V7C3.5 3 4.5 2 8.5 2H15.5C19.5 2 20.5 3 20.5 7V17C20.5 17.14 20.5 17.28 20.49 17.42" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6.35 15H20.5V18.5C20.5 20.43 18.93 22 17 22H7C5.07 22 3.5 20.43 3.5 18.5V17.85C3.5 16.28 4.78 15 6.35 15Z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8 7H16" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8 10.5H13" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <label>{{$questions_count}}</label>
                            <span>Questions</span>
                        </div>
                        <div class="questionAss mr-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20.75 13.25C20.75 18.08 16.83 22 12 22C7.17 22 3.25 18.08 3.25 13.25C3.25 8.42 7.17 4.5 12 4.5C16.83 4.5 20.75 8.42 20.75 13.25Z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 8V13" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 2H15" stroke="#56B663" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <label>{{$exam_fulltime/60}}</label>
                            <span>Hours.</span>
                        </div>
                    </div>
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
                    <h4>All the Best {{ucwords($userData->user_name)}}!</h3>
                        <!-- <p class="my-3">to assess your preparation. Take your first step to improvement.</p> -->
                         @if($full_body_attempt =="Y")
                        <a class="btn btn-common-white disabled" href="javescript:void(0);">Attempted</a>
                        @else
                         <form class="form-horizontal ms-auto " action="{{$exam_url}}" method="post">
                                    @csrf
                                    <input type="hidden" name="ranSession" value="{{$ranSession}}" />
                                    <button type="submit" class="btn btn-common-white">Take Test</button>
                                </form>
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
                                @if ($exam_name_new == 'full_exam_basic')
                                <li> This test is of <b>{{$total_marks}} marks (40 </b> marks each section) </li>
                                @else
                                <li> This test is of <b>{{$total_marks}} marks (100 </b> marks each section) </li>
                                @endif
                            </ul>
                        </div>
                        <div class="commonInstructionList">
                            <div class="instHeading">
                                @if($user_exam_id == '1')
                                <b>2. <span>Subject-Specific Instructions (Physics/ Chemistry/Mathematics)</span></b>
                                @else
                                <b>2. <span>Subject-Specific Instructions (Physics/Chemistry/Biology/Zoology)</span></b>
                                @endif
                            </div>
                            <div class="instLine"></div>
                            <ul>
                                @if ($exam_name_new == 'full_exam_basic')
                                <li> Each subject consists of <b>10 </b>single correct MCQs</li>
                                @else
                                <li> Each subject consists of <b>25 </b>single correct MCQs</li>
                                @endif
                                <li>The answer to each question will be evaluated according to the following marking</li>
                            </ul>
                            <div class="instructionTable">
                                <table class="table table-bordered ">
                                    <tbody>
                                        <tr>
                                            <td>Full marks</td>
                                            <td><b>+4 </b>Correct answer</td>
                                        </tr>
                                        <tr>
                                            <td>No Mark</td>
                                            <td><b>0 </b>Unanswered/Unanswered and marked for review</td>
                                        </tr>
                                        <tr>
                                            <td>Minus One Mark</td>
                                            @if ($exam_name_new == 'full_exam_basic')
                                            <td><b>-2 </b>in all other cases</td>
                                            @else
                                            <td><b>-1 </b>in all other cases</td>
                                            @endif
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
        </div>
    </div>
</section>
@endsection
