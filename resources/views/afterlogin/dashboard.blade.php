@extends('afterlogin.layouts.app_new')

@php
$userData = Session::get('user_data');

@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper dashboard">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->

    <div class="content-wrapper">
        <div class="container-fluid pt-0  dashboard-cards-block">

            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="bg-white shadow-lg">
                        <small>
                            <i class="fa  fa-info"></i>
                            <p>
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                <!-- <label>About MyQ Today</label> -->
                                A score derived from the detailed analysis of your test patterns that gives a clear understanding of your current level of preparation in comparison to an ideal one. Measure your real-time probability of reaching the goal with your current pattern of preparation. Set your goal!
                            </p>
                        </small>
                        <div class="row h-100">
                            <div class="col-lg-7 col-sm-12 col-md-8" style="padding-right:0!important;">
                                <div style="padding:20px 0 0;">
                                    <div class="prgress-i-txt px-3 mb-1" style="padding-left:30px!important;">
                                        <span class="progress_text">MyQ Today</span>
                                    </div>
                                    <div class="d-flex justify-content-center flex-column h-100 ">
                                        <div class="" id="scorecontainer"></div>

                                        <ul class="live-test mt-1">
                                            <li>
                                                <span class="last-live-test" style="vertical-align:middle;"></span>MyQ Today Score
                                            </li>
                                            <!-- <li>
                                                <span class="pre-test"></span>Previous Test
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-12  text-center seeAnico" style="padding-left:0;">
                                <div class="analytics-thumbnail-bg h-100">
                                    <div class="button-sec mb-4 mt-3"><a href="{{route('overall_analytics')}}" title="See Analytics">See Analytics</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="bg-white shadow-lg py-5 ps-3 pe-1">
                        <small>
                            <i class="fa  fa-info"></i>
                            <p>
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                            </p>
                        </small>
                        <div class="prgress-i-txt px-0">
                            <span class="progress_text">Subject Performance</span>
                        </div>
                        <div class="subject-scroll">
                            <ul class="course-star pe-2">
                                @if(!empty($subjectData))
                                @foreach($subjectData as $key=>$sub)
                                <li>
                                    <strong>{{$sub['subject_name']}}</strong>
                                    <span class="star-img">
                                        <div class="star-ratings-css ">
                                            <div class="star-ratings-css-top" style="width: {{round($sub['score'])}}%">
                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                            </div>
                                            <div class="star-ratings-css-bottom">
                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                            </div>
                                        </div>

                                    </span>
                                    <span>{{round($sub['score'])}}%</span>


                                </li>
                                @endforeach
                                @endif

                            </ul>
                        </div>

                    </div>
                </div>
                <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="bg-white shadow-lg py-5 peragraph prgress-i-txt" style="overflow:hidden;">
                        <div class="prgress-i-txt px-3">
                            <span class="progress_text">Weekly Marks Trends</span>
                          
                        </div>
                        <div id="marks_trend_graph"></div>
                    </div>
                </div> -->
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="bg-white shadow-lg py-5 myqMatrix-card">
                        <span class="progress_text" style="padding-left: 15px;">MyQ Matrix</span>
                        <small>
                            <i class="fa  fa-info"></i>
                            <p>
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                A matrix created to analyse your attempts in various topics over time and sort them into your areas of strengths and weaknesses. <br /><br /> This data will keep on changing as you progress and diligently work on your identified and analysed weaknesses and strengths. It will also make visible those topics that can become your strength with a little more effort on your part. Align your preparation now!
                            </p>
                        </small>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="topics-box">
                                    <b>Q2</b>
                                    <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                            <b>00</b>
                                            <small>Topic</small>
                                        </span>
                                    </a>
                                </div>
                                <div class="topics-box">

                                    <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                            <b>00</b>
                                            <small>Topic</small>
                                        </span></a>
                                    <b style="margin:0 0 0 6px">Q1</b>
                                </div>
                                <div class="topics-box">
                                    <b>Q3</b>
                                    <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                            <b>00</b>
                                            <small>Topic</small>
                                        </span></a>
                                </div>
                                <div class="topics-box">
                                    <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                            <b>00</b>
                                            <small>Topic</small>
                                        </span></a>
                                    <b style="margin:0 0 0 6px">Q4</b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="p-0 m-0 matrixLists">
                                    <li><b>Q1</b> Your strength topics. Keep revising to stay on top.</li>
                                    <li><b>Q2</b> Convert into strengths with focussed practice </li>
                                    <li><b>Q3</b> Weakness which can be converted to strength with consistent efforts</li>
                                    <li class="m-0"><b>Q4</b> Your weakness. Need considerable efforts to convert to strengths </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--row-->

            <div class="row">
                <div class="col-md-4">
                    <div class="bg-white shadow-lg py-5">
                        <small>
                            <i class="fa  fa-info"></i>
                            <p>
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                Mapping your progress journey against an ideal path lets you draw valuable insights about the rate at which you are progressing with respect to the ideal path that will lead you to success. It will help you judge whether you are keeping pace or lagging behind, for you to take corrective action. Pick up your pace!
                            </p>
                        </small>
                        <div class="prgress-i-txt mb-2">
                            <span class="progress_text" style="padding-left: 15px;">Progress Journey</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <figure>
                                    <img src="{{URL::asset('public/after_login/new_ui/images/progress-journey-graph.png')}}" class="w-100">
                                </figure>
                            </div>
                            <div class="col-md-6">
                                <div class="chapter-ideal-schedule text-center">
                                    <span>8</span>
                                    <small>You are 8 chapter behind the ideal schedule</small>
                                    <ul class="live-test mt-3 p-0 d-block" style="text-align: left;">
                                        <li style="margin-right:10px;">
                                            <span style="vertical-align:middle;background:#ff0909;"></span>Ideal Pace
                                        </li>
                                        <li>
                                            <span class="last-live-test"></span>Your Pace
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="bg-white shadow-lg py-5">
                        <small>
                            <i class="fa  fa-info"></i>
                            <p>
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                This chart will give insights and a deep understanding of your ongoing preparation, and your improvement over time. An increasing trend is what you should ideally be maintaining. Go uptrend!
                            </p>
                        </small>
                        <div class="prgress-i-txt">
                            <span class="progress_text" style="padding-left: 15px;">Weekly Marks Trends</span>
                        </div>
                        <div id="marks_trend_graph"></div>
                        <!-- <figure>
                            <img src="{{URL::asset('public/after_login/new_ui/images/weekly-trends-graph.png')}}" class="w-100">
                        </figure> -->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-white shadow-lg py-5 task-center-block">
                        <small>
                            <i class="fa  fa-info"></i>
                            <p>
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                A list of customized tasks specially personalized for you based on the in-depth analysis of your completed tests. Strengthen your core learning and strategic skills through these quick customized tests. Build on your strengths and work on your weaker areas to progressively improve them. Improve on your proficiency!
                            </p>
                        </small>
                        <div class="prgress-i-txt mb-4">
                            <span class="progress_text" style="padding-left: 15px;">My Task Center</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span><img src="{{URL::asset('public/after_login/new_ui/images/daily-task-icon.png')}}"></span>
                            <a class="btn btntheme" href="{{route('dashboard-DailyTask')}}">Daily TASK</a>
                            <!-- <button class="btn btntheme" data-bs-toggle="modal" data-bs-target="#matrix">Daily TASK</button> -->
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <span><img src="{{URL::asset('public/after_login/new_ui/images/weekly-task-icon.png')}}"></span>
                            <a class="btn btntheme" href="{{route('dashboard-DailyTask')}}">Weekly TASK</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="cust-gallery pt-0">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @if(isset($prof_asst_test) && $prof_asst_test=='N')
                        <div class="swiper-slide bg-white AttmnowSec">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex">
                                        <span style="margin-right: 20px;">
                                            <img src="{{URL::asset('public/after_login/new_ui/images/complete-icon.png')}}" style="width:80px;">
                                        </span>
                                        <div>
                                            <p>Complete the</p>
                                            <h3>Full Body Scan Test</h3>
                                            <p>to see complete analytics</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sign-btn">
                                <a href="{{route('exam','full_exam')}}"><button type="submit" class="btn btn-primary active-btn text-uppercase">
                                        <img src="{{URL::asset('public/after_login/new_ui/images/right-white.png')}}">attempt now!</button></a>

                            </div>
                        </div>
                        @endif

                        @if(isset($planner) && empty($planner))
                        <div class="swiper-slide bg-white go2Planner weekylplan-block weekly-plan-test">
                            <small>
                                <i class="fa  fa-info"></i>
                                <p>
                                    <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                    To reduce uncertainty and increase your efficiency and chances of success, it is absolutely essential that you plan your preparation with great care. With effective planning comes motivation, productivity, satisfaction, and ultimately success. Go ahead and plan your week!
                                </p>
                            </small>
                            <span>Weekly Plan</span>
                            <div class="test-attend text-center pt-2 pb-2">

                                <div class="text-center" style="font-size: 14px;max-width: 170px;margin: 0 auto;">
                                    <b>Plan Tests</b> <br />
                                    Plan upto seven tests on topics of your choice
                                </div>
                                <button class="custom-btn-gray mt-4" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/new_ui/images/planer.png')}}" alt="icon not find">Go To
                                    Planner</button>

                            </div>

                        </div>
                        @elseif(isset($planner) && !empty($planner))
                        <div class="swiper-slide bg-white go2Planner weekylplan-block">
                            <small>
                                <i class="fa  fa-info"></i>
                                <p>
                                    <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                    To reduce uncertainty and increase your efficiency and chances of success, it is absolutely essential that you plan your preparation with great care. With effective planning comes motivation, productivity, satisfaction, and ultimately success. Go ahead and plan your week!
                                </p>
                            </small>
                            <span>Weekly Plan</span>
                            <div class="test-attend text-center pt-2 pb-2">
                                <div class="text-center" style="font-size: 14px;max-width: 170px;margin: 0 auto;">
                                    <b> Tests Attempted</b>
                                    <div class="ms-auto">

                                        @foreach($planner as $key=>$val)
                                        @if($val->test_completed_yn=="Y")
                                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle text-success" aria-hidden="true"></i></a>
                                        @else
                                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle" aria-hidden="true"></i></a>

                                        @endif
                                        @endforeach

                                    </div>
                                    <button class="custom-btn-gray" style="margin-top:24px;" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/new_ui/images/planer.png')}}" alt="icon not find">Go To
                                        Planner</button>
                                </div>
                            </div>

                        </div>
                        @endif
                        @if(isset($planner) && empty($planner))
                        <div class="swiper-slide bg-white">


                            <!----- Weekly tests ---->
                            <small>
                                <i class="fa  fa-info"></i>
                                <p>
                                    <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                    To reduce uncertainty and increase your efficiency and chances of success, it is absolutely essential that you plan your preparation with great care. With effective planning comes motivation, productivity, satisfaction, and ultimately success. Go ahead and plan your week!
                                </p>
                            </small>
                            <div class="row weeklytest-block">
                                <div class="col-lg-12">
                                    <div class="d-flex">
                                        <span class="subjectIcon" style="margin-right: 20px;">
                                            <img style="width:80px;" src="{{URL::asset('public/after_login/new_ui/images/complete-icon.png')}}"></span>
                                        <div>
                                            <p>Plan your</p>
                                            <h3 class="chapter_name mb-0 w-100">Weekly Tests</h3>
                                            <p>for regular preparation</p>

                                        </div>
                                    </div>
                                    <button style="background-color: #fff;text-transform: none;" class="custom-btn-gray mt-4" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample"><i style="margin-right: 5px;" class="fa fa-angle-left"></i> Click on GO TO Planner</button>
                                </div>
                            </div>
                            <!-------------------->

                        </div>
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            <img src="{{URL::asset('public/after_login/new_ui/images/chemistry-subject-icon.png')}}">
                            <div>
                                <i class="fas fa-check-circle text-success" style="margin-right: 5px;"></i>
                                CHEMISTRY
                            </div>
                        </div>
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            <img src="{{URL::asset('public/after_login/new_ui/images/physics-subject-icon.png')}}">
                            <div>
                                <i class="fas fa-check-circle text-success" style="margin-right: 5px;"></i>
                                PHYSICS
                            </div>
                        </div>
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            <span>
                                <img style=";z-index: 1;" src="{{URL::asset('public/after_login/new_ui/images/chemistry-subject-icon.png')}}">
                                <img src="{{URL::asset('public/after_login/new_ui/images/physics-subject-icon.png')}}">
                            </span>
                            <div style="margin-top: -8px;">
                                <i class="fas fa-check-circle text-success" style="margin-right: 5px;"></i>
                                MORE
                            </div>
                        </div>

                        @elseif(isset($planner) && !empty($planner))

                        @foreach($planner as $key=>$val)
                        @if($val->test_completed_yn=="N")
                        <div class="swiper-slide bg-white">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex">
                                        <span class="subjectIcon" style="margin-right: 20px;"><img style="width:80px;" src="{{$val->url}}"></span>
                                        <div>
                                            <p>Level up in</p>
                                            <h3 class="chapter_name mb-0" title="{{$val->chapter_name}}">{{$val->chapter_name}}</h3>
                                            <ul class="course-star pe-2 m-0">
                                                <li style="float:none;">
                                                    <strong style="width:auto;">Proficiency</strong>
                                                    <span class="star-img" style="width:auto;">
                                                        <div class="star-ratings-css ">
                                                            <div class="star-ratings-css-top" style="width: {{round($val->chapter_score, 2)}}%">
                                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                            </div>
                                                            <div class="star-ratings-css-bottom">
                                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                            </div>
                                                        </div>

                                                    </span>
                                                    <span> {{round($val->chapter_score, 2)}}%</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sign-btn">
                                <form method="post" action="{{route('plannerExam',[$val->id])}}">
                                    @csrf
                                    <input type="hidden" name="chapter_name" value="{{$val->chapter_name}}">
                                    <input type="hidden" name="subject_id" value="{{$val->subject_id}}">
                                    <input type="hidden" name="chapter_id" value="{{$val->chapter_id}}">
                                    <input type="hidden" name="exam_id" value="{{$val->exam_id}}">
                                    <button type="submit" class="btn btn-primary active-btn text-uppercase mt-2">
                                        <img style="margin-left: -10px;" src="{{URL::asset('public/after_login/new_ui/images/right-white.png')}}">attempt now!</button>
                                </form>
                            </div>


                        </div>
                        @elseif($val->test_completed_yn=="Y")
                        <div class="swiper-slide bg-white testcompltd completed-test-block ">
                            <div class="test-attend text-center">
                                <!-- <p>Tests Attempted</p> -->
                                <div class="ms-auto">
                                    <span class="text-secondary chapter_name mb-2 d-block"><i class="fas fa-check-circle text-success" aria-hidden="true"></i></span>
                                    <h3 class="mb-0">{{$val->chapter_name}}</h3>
                                    <ul class="course-star mt-3 mb-0">
                                        <li style="float:none;">
                                            <strong style="width:auto;" class="d-block">Proficiency</strong>
                                            <span class="star-img" style="width:auto;">
                                                <div class="star-ratings-css ">
                                                    <div class="star-ratings-css-top" style="width: {{round($val->chapter_score, 2)}}%">
                                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                    </div>
                                                    <div class="star-ratings-css-bottom">
                                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                    </div>
                                                </div>

                                            </span>
                                            <span> {{round($val->chapter_score, 2)}}%</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @endif
                        @endforeach
                        @endif
                    </div>


                </div>
                <!--swiper mySwiper-->
                <!-- <ul class="d-inline-flex">
                    <li class="bg-white">
                        <img style="width:80px;" src="{{URL::asset('public/after_login/new_ui/images/chemistry-subject-icon.png')}}">
                        <div class="mt-3">
                            <i class="fas fa-check-circle text-success"></i>
                            CHEMISTRY
                        </div>
                    </li>
                    <li class="bg-white">
                        <img style="width:80px;" src="{{URL::asset('public/after_login/new_ui/images/chemistry-subject-icon.png')}}">
                        <div class="mt-3">
                            <i class="fas fa-check-circle text-success"></i>
                            PHYSICS
                        </div>
                    </li>   
                </ul> -->


            </div>


        </div>
    </div>
</div>

<!-- Modal -->
@if($subjects_rating == null || empty($subjects_rating))
<div class="modal fade" id="welcomeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body pt-0 text-center">

                <p class="wl-user-title">Hello {{!empty($userData->user_name)?ucwords($userData->user_name):'Guest'}}!</p>
                <h3 class=" wel-msg">Welcome to the <span class="text-danger">Game</span></h3>

                @if(isset($subjects_rating) && empty($subjects_rating))
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5 fw-bold" onclick="welcome_back();">Let’s get you started ></a>
                @else
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5 fw-bold" onclick="welcome_back();">Let’s go ></a>
                @endif
                <!-- <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5" data-bs-toggle="modal" data-bs-target="#favSubResponse" data-bs-dismiss="modal">Let’s get you started ></a> -->
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="favSubResponse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body p-4 pt-0 text-center">

                <p class="rating-headline mt-5 mb-4"> How much do you like each of these subjects?</p>

                <div class="row">

                    @if(isset($aSubjects) && !empty($aSubjects))
                    @foreach($aSubjects as $sub)
                    <div class="col-md-12">
                        <div class="rating block">
                            <span class="lbl-text">{{$sub->subject_name}}</span>
                            <div class="rating-wrapper">
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="5" id="{{$sub->subject_name}}_5">
                                <label class="rating-heart" for="{{$sub->subject_name}}_5"><i class="fa fa-star"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="4" id="{{$sub->subject_name}}_4">
                                <label class="rating-heart" for="{{$sub->subject_name}}_4"><i class="fa fa-star"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="3" id="{{$sub->subject_name}}_3">
                                <label class="rating-heart" for="{{$sub->subject_name}}_3"><i class="fa fa-star"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="2" id="{{$sub->subject_name}}_2">
                                <label class="rating-heart" for="{{$sub->subject_name}}_2"><i class="fa fa-star"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="1" id="{{$sub->subject_name}}_1">
                                <label class="rating-heart" for="{{$sub->subject_name}}_1"><i class="fa fa-star"></i></label>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    @endif

                    <div class="d-flex align-items-center mt-5">

                        <a href="#" class="btn rating-next-btn disabled  rounded-0 ms-auto px-4" id="nxt-btn" onclick="store_rating();">Next&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endif

<!-- Modal -->

<!-- Full exam popup -->
@if(isset($prof_asst_test) && $prof_asst_test=='N')
<div class="modal fade" id="fullTest_Dashboard" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-modal="true" role="dialog" style="display: none; padding-left: 0px;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <!--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body pt-0 text-center">
                <p id="h1--P" class="h1-p text-success text-uppercase">Just one more step!</p>
                <p>Take a full body scan test to analyse and plan your preparation journey</p>
                <a id="full-txtBlock" href="{{route('exam','full_exam')}}" class="full-txtblock justify-content-center d-flex align-items-center mb-4 mt-5 mx-5 py-4">
                    <i class="fa-li fa fa-check" aria-hidden="true"></i>
                    <span class="text-white ms-4 ">Take full body scan of<br>75 questions test</span>
                </a>
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-5 btn-light text-danger px-4 skip-dashboard" data-bs-toggle="modal" data-bs-dismiss="modal">Skip to Dashboard &gt;</a>
            </div>

        </div>
    </div>
</div>
@endif
<!-- End full exam popup -->

<!--------- Modal ------>
<div class="modal fade" id="matrix">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <!-- <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
            </div> -->
            <div class="modal-body text-center">
                <p>Give more tests for this <br /> section to be populated</p>
                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-danger px-5" data-bs-dismiss="modal"> Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-------------------->

<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->
@php
$trend_stu_scroe=$trend_avg_scroe=$trend_max_scroe=$aWeeks = [];
$i = 1;
if (!empty($trendResponse)) {
foreach ($trendResponse as $key => $trend) {
$week = "W" . $i;
array_push($aWeeks, $week);
array_push($trend_stu_scroe, $trend['student_score']);
array_push($trend_avg_scroe, $trend['average_score']);
array_push($trend_max_scroe, $trend['max_score']);

$i++;
}

}else{
array_push($trend_stu_scroe, 0);
array_push($trend_avg_scroe, 0);
array_push($trend_max_scroe, 0);
}

$weeks_json = isset($aWeeks) ? json_encode($aWeeks) : [];
$stu_scroe_json = isset($trend_stu_scroe) ? json_encode($trend_stu_scroe) : [];
$avg_scroe_json = isset($trend_avg_scroe) ? json_encode($trend_avg_scroe) : [];
$max_scroe_json = isset($trend_max_scroe) ? json_encode($trend_max_scroe) : [];

@endphp

<script type="text/javascript">
    $(window).on('load', function() {
        if ($("#welcomeModal").length > 0) {
            $('#welcomeModal').modal('show');
        }

    });

    $(".rating-input").click(function() {
        $("#nxt-btn").removeClass("disabled");
    });
    /* $('.subject_scroll').slimscroll({
        height: '25vh'
    }); */

    function welcome_back() {
        $('#welcomeModal').modal('hide');

        if ($("#favSubResponse").length > 0) {
            $("#favSubResponse").modal("show");
        } else if ($("#fullTest_Dashboard").length > 0) {
            $("#fullTest_Dashboard").modal("show");
        }
    }

    function store_rating() {
        /* getting subject rating for new user */
        let subjects_rating = {};
        $('input[type=radio]:checked').each(function() {


            var name = $(this).attr('name');
            var value = $(this).val();

            subjects_rating[name] = value;
        });
        /*  console.log(subjects_rating);
         var existing = JSON.parse(localStorage.getItem("store_data") || '[]');
         console.log(existing);
         existing['subjects_rating'] = subjects_rating;
         console.log(existing['subjects_rating']);
         localStorage.setItem('store_data', JSON.stringify(existing));

         var storeddata = JSON.parse(localStorage.getItem("store_data"));

         console.log(storeddata); */
        $.ajax({
            url: "{{ url('/dailyWelcomeUpdates') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                storeddata: subjects_rating,
            },
            beforeSend: function() {},
            success: function(response_data) { //debugger;

                if (response_data == 'success') {
                    if ($("#favSubResponse").length > 0) {
                        $("#favSubResponse").modal("hide");
                    }

                    /*  $("#feelresponseModal").modal("hide"); */
                    if ($("#fullTest_Dashboard").length > 0) {
                        $("#fullTest_Dashboard").modal("show");
                    }
                }

            },
            error: function(xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });
    }

    $('.instructions').slimscroll({
        height: '33vh'
    });

    $(".rating-input").click(function() {
        $("#nxt-btn").removeClass("disabled");
    });
</script>
<script type="text/javascript">
    $('.scroll-div').slimscroll({
        height: '40vh'
    });

    var starClicked = false;

    $(function() {

        $('.star').click(function() {

            $(this).children('.selected').addClass('is-animated');
            $(this).children('.selected').addClass('pulse');

            var target = this;

            setTimeout(function() {
                $(target).children('.selected').removeClass('is-animated');
                $(target).children('.selected').removeClass('pulse');
            }, 1000);

            starClicked = true;
        })

        $('.half').click(function() {
            if (starClicked == true) {
                setHalfStarState(this)
            }
            $(this).closest('.rating').find('.js-score').text($(this).data('value'));

            $(this).closest('.rating').data('vote', $(this).data('value'));
            calculateAverage()
            console.log(parseInt($(this).data('value')));

        })

        $('.full').click(function() {
            if (starClicked == true) {
                setFullStarState(this)
            }
            $(this).closest('.rating').find('.js-score').text($(this).data('value'));

            $(this).find('js-average').text(parseInt($(this).data('value')));

            $(this).closest('.rating').data('vote', $(this).data('value'));
            calculateAverage()

            console.log(parseInt($(this).data('value')));
        })

        $('.half').hover(function() {
            if (starClicked == false) {
                setHalfStarState(this)
            }

        })

        $('.full').hover(function() {
            if (starClicked == false) {
                setFullStarState(this)
            }
        })

    })

    function updateStarState(target) {
        $(target).parent().prevAll().addClass('animate');
        $(target).parent().prevAll().children().addClass('star-colour');

        $(target).parent().nextAll().removeClass('animate');
        $(target).parent().nextAll().children().removeClass('star-colour');
    }

    function setHalfStarState(target) {
        $(target).addClass('star-colour');
        $(target).siblings('.full').removeClass('star-colour');
        updateStarState(target)
    }

    function setFullStarState(target) {
        $(target).addClass('star-colour');
        $(target).parent().addClass('animate');
        $(target).siblings('.half').addClass('star-colour');

        updateStarState(target)
    }

    function calculateAverage() {
        var average = 0

        $('.rating').each(function() {
            average += $(this).data('vote')
        })

        $('.js-average').text((average / $('.rating').length).toFixed(3))
    }
</script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        slideToClickedSlide: false,
        focusableElements: false,
        pagination: {
            el: ".swiper-pagination",
            clickable: false,

        },
        breakpoints: {
            1920: {
                slidesPerView: 3,
                spaceBetween: 30,

            },
            1028: { // this is all desktop view of my laptop
                slidesPerView: 3,
                spaceBetween: 30,
            },
            300: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });
</script>

<script>
    /* Score Pie Chart */
    Highcharts.chart('scorecontainer', {
        chart: {
            height: 130,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            spacingTop: 0,
            spacingBottom: 0,
            spacingRight: 0,
        },
        title: {
            text: '<span style=" font: normal normal 200 48px/60px Manrope; letter-spacing: 0px; color: #21ccff;">{{$corrent_score_per}}</span> <br><span style=" font: normal normal normal 14px/22px Manrope;letter-spacing: 0px;color: #21ccff;"> / 100 </span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: 0,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                point: {
                    events: {
                        legendItemClick: function() {
                            this.slice(null);
                            return false;
                        }
                    }
                },
                startAngle: -140,
                endAngle: 140,
                center: ['50%', '50%'],
                size: '100%'
            }
        },
        series: [{
            type: 'pie',

            innerSize: '85%',
            data: [{
                    name: 'Score',
                    y: <?php echo $score; ?>,
                    color: '#21ccff'
                },
                {
                    name: 'Inprogress',
                    y: <?php echo $inprogress; ?>,
                    color: '#d0f3ff'
                },
                {
                    name: 'Progress',
                    y: <?php echo $progress; ?>,
                    color: '#d0f3ff'
                },
                {
                    name: '',
                    y: <?php echo $others; ?>,
                    color: '#e4e4e4'
                }


            ]

        }]
    });

    /* Mrks trend Graph */
    Highcharts.chart('marks_trend_graph', {
        chart: {
            type: 'areaspline',
            height: 165,
            plotBackgroundColor: null,
            zoomType: 'x',

        },
        title: {
            text: ''
        },

        legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom',
            bottom: '-20px',
            floating: false,
            borderWidth: 0,

        },
        xAxis: {
            label: true,
            accessibility: {
                rangeDescription: 'Range: start to current week'
            },
            categories: <?php echo $weeks_json; ?>,

        },
        yAxis: {
            title: {
                text: null
            },
            labels: {
                enabled: true
            },

            min: 0
        },
        tooltip: {
            shared: true,
            valueSuffix: ' marks'
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.4
            },
            series: {
                pointPadding: 0,
                groupPadding: 0,
                marker: {
                    enabled: true
                },
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }

            }

        },
        series: [{
            name: 'Student Score',
            data: <?php echo $stu_scroe_json; ?>, //[0, 4, 4],
            color: '#007aff' // Jane's color
        }, {
            name: 'Class Avg',
            data: <?php echo $avg_scroe_json; ?>, //[16, 18, 17],
            color: '#dfe835'
        }, {
            name: 'Top Marks',
            data: <?php echo $max_scroe_json; ?>, // [16, 21, 23],
            color: '#eb4034'
        }],


    });
    /* Mrks trend Graph */
</script>
<script>
    $(document).ready(function() {
        $(".dashboard-cards-block .bg-white>small i").click(function() {
            $(this).siblings("p").show();
        });
        $(".dashboard-cards-block .bg-white>small p>span").click(function() {
            $(this).parent("p").hide();
        });
    });
</script>
@endsection