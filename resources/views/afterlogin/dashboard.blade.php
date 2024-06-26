@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
$user_exam_id = isset($userData->grade_id)?$userData->grade_id:'';
@endphp

<script>
    (function(f, b) {
            if (!b.__SV) {
                var e, g, i, h;
                window.mixpanel = b;
                b._i = [];
                b.init = function(e, f, c) {
                    function g(a, d) {
                        var b = d.split(".");
                        2 == b.length && (a = a[b[0]], d = b[1]);
                        a[d] = function() {
                            a.push([d].concat(Array.prototype.slice.call(arguments, 0)))
                        }
                    }
                    var a = b;
                    "undefined" !== typeof c ? a = b[c] = [] : c = "mixpanel";
                    a.people = a.people || [];
                    a.toString = function(a) {
                        var d = "mixpanel";
                        "mixpanel" !== c && (d += "." + c);
                        a || (d += " (stub)");
                        return d
                    };
                    a.people.toString = function() {
                        return a.toString(1) + ".people (stub)"
                    };
                    i = "disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
                    for (h = 0; h < i.length; h++) g(a, i[h]);
                    var j = "set set_once union unset remove delete".split(" ");
                    a.get_group = function() {
                        function b(c) {
                            d[c] = function() {
                                call2_args = arguments;
                                call2 = [c].concat(Array.prototype.slice.call(call2_args, 0));
                                a.push([e, call2])
                            }
                        }
                        for (var d = {}, e = ["get_group"].concat(Array.prototype.slice.call(arguments, 0)), c = 0; c < j.length; c++) b(j[c]);
                        return d
                    };
                    b._i.push([e, f, c])
                };
                b.__SV = 1.2;
                e = f.createElement("script");
                e.type = "text/javascript";
                e.async = !0;
                e.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ?
                    MIXPANEL_CUSTOM_LIB_URL : "file:" === f.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
                g = f.getElementsByTagName("script")[0];
                g.parentNode.insertBefore(e, g)
            }
        })(document, window.mixpanel || []);
</script>


@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<!-- Modal -->
@if($subjects_rating == null || empty($subjects_rating))
@endif
<!-- Modal -->
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
@if($errors->any())
<?php $redis_data = Session::get('redis_data'); ?>

<script>
    $(window).on('load', function() {
        $('#matrix').modal('show');
    });
</script>
@endif
<div class="spinnerblock" style="display:none">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="main-wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
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
    <div class="content-wrapper dashbaordContainer">
        <div class="dashboardTopSection">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @if($userData->email_verified=='No')
                        <div class="verifiaction-link">
                            <p style="line-height: 34px;">A verification link has been sent to <b>{{$userData->email}},</b> please click the link to get your account verified. <a href="javascript:void(0);" class="resend_email">Resend</a></p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 commonblockDash myqTodayPannel">
                        <div class="commondashboardTop">
                            <h3 class="boxheading headingbgchange">MyQ Today
                                <span class="tooltipmain tooltipmyq">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                        </g>
                                    </svg>
                                    <p class="tooltipclass">
                                        <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                        A progressive score derived from all the assessments attempted on the platform. This score lets you know your probability of success if you appeared for the exam today.
                                    </p>
                                </span>
                            </h3>
                            <div class="myqTodayGraphSec">

                                <input type="hidden" name="accurate_percent" id="accurate_percent" value="{{$myqtodayScore}}">
                                <div class="mq_circle">
                                    <div class="mq_circle_percent" data-percent="{{$accurate_percent}}">
                                        <div class="circletop">
                                            <div class="mq_circle_inner">
                                                <div class="mq_round_per"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($userStatus==false)
                                <div class="textblock">
                                    <h6 class="dashSubHeading">You are doing great!</h6>
                                    <p class="dashSubtext">Practice more to improve your score</p>
                                    <a onclick="sendSeeAnalyticsEvent()" href="{{route('overall_analytics')}}" class="commmongreenLink">See Analytics <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg></span></a>
                                </div>
                                @else
                                <div class="textblock">
                                    <h6 class="dashSubHeading">Lets get started!</h6>
                                    <p class="dashSubtext">To begin your journey, attempt 'Personalized Assessment'</p>
                                    <a href="#Assesmentmodal" data-bs-toggle="modal" data-bs-target="#Assesmentmodal" class="commmongreenLink">Attempt Now <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg></span></a>
                                </div>
                                @endif

                            </div>
                            <div class="commonWhiteBox subject_performance_card">
                                <div class="boxHeadingBlock">
                        
                                    <h3 class="boxheading">Subject Performance
                                        <span class="tooltipmain">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                </g>
                                            </svg>
                                            <p class="tooltipclass">
                                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                                Check your proficiency level across subjects.
                                            </p>
                                        </span>
                                    </h3>
                                    <p class="dashSubtext mb-3">Map your subject journey. Aim to complete each circle.</p>
                                </div>
                                @if($userStatus==false)
                                <div class="subjectScoreBlock">
                                    <div class="row">
                                        @if(!empty($subject_proficiency))
                                        @foreach($subject_proficiency as $key=>$sub)
                                        <?php
                                        if (round($sub['score']) <= 40) {
                                            $colorcls = "";
                                        } elseif (round($sub['score']) <= 75) {
                                            $colorcls = "yellowgraph";
                                        } else {
                                            $colorcls = "greengraph";
                                        }
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="SubjectscorePannel">
                                                <div class="subjextscoreLeft">
                                                    <h6>{{$sub['subject_name']}}</h6>
                                                    <div class="d-flex justify-content-between">
                                                        <h4>{{round($sub['score'])}}%</h4>
                                                        <div class="radial_progress_bar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">

                                                                <circle cx="16" cy="16" r="15.9155" class="progress-bar__background" />

                                                                <circle id="js-progress-bar{{$key}}" cx="16" cy="16" r="15.9155" class="progress-bar__progress 
                                                                            js-progress-bar {{$colorcls}}" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                var percentageComplete = "{{round($sub['score'])}}";
                                                var strokeDashOffsetValue = 100 - (percentageComplete);
                                                var progressBar = $("#js-progress-bar{{$key}}");
                                                progressBar.css("stroke-dashoffset", strokeDashOffsetValue);
                                            </script>
                                        </div>

                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @else
                                <div class="emptystate">
                                    <div class="emptystateInner">
                                        <div class="emptyicon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="81" viewBox="0 0 80 81" fill="none">
                                                <circle cx="40" cy="40.102" r="40" fill="#E0F6E3" />
                                                <path d="M16.979 25.102h10.525a1 1 0 0 1 1 1v2.22a1 1 0 0 1-1 1h-5.87c-.458 0-.864.312-.91.768-.303 3.018 1.262 8.859 8.382 15.604.885.84.051 2.165-.937 1.45-10.105-7.32-12.436-16.283-12.146-21.179.03-.499.456-.863.956-.863zM64.021 25.102H53.496a1 1 0 0 0-1 1v2.22a1 1 0 0 0 1 1h5.87c.458 0 .864.312.91.768.303 3.018-1.262 8.859-8.382 15.604-.885.84-.051 2.165.937 1.45 10.104-7.32 12.436-16.283 12.146-21.179-.03-.499-.456-.863-.956-.863z" fill="#BEE9C4" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M40.206 21.102H27.588c-.04.465-.089.965-.14 1.494-.59 6.134-1.554 16.144 4.322 21.616 1.044.972 1.868 1.64 2.516 2.164 1.99 1.614 2.326 1.886 2.326 5.539v2.641h7.776v-2.641c0-3.653.335-3.925 2.326-5.539a44.9 44.9 0 0 0 2.516-2.164c5.876-5.472 4.912-15.482 4.322-21.616-.051-.529-.1-1.029-.14-1.494H40.206z" fill="#fff" />
                                                <path d="M29 60.102a6 6 0 0 1 6-6h10a6 6 0 0 1 6 6v2H29v-2z" fill="#BEE9C4" />
                                                <path d="M40.05 29.022a.5.5 0 0 1 .9 0l.825 1.691a.5.5 0 0 0 .376.275l1.856.275a.5.5 0 0 1 .278.85l-1.35 1.33a.5.5 0 0 0-.141.44l.317 1.87a.5.5 0 0 1-.728.525l-1.648-.877a.5.5 0 0 0-.47 0l-1.648.877a.5.5 0 0 1-.728-.525l.317-1.87a.5.5 0 0 0-.142-.44l-1.349-1.33a.5.5 0 0 1 .278-.85l1.856-.275a.5.5 0 0 0 .376-.275l.826-1.691z" fill="#56B663" />
                                            </svg>
                                        </div>
                                        <p class="emptytext">Curious about your subject-wise performance? Attempt <strong>'Personalized Assessment'</strong></p>
                                        <a href="#Assesmentmodal" data-bs-toggle="modal" data-bs-target="#Assesmentmodal" class="btn btn-common-transparent nobg">Attempt Now</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 commonblockDash mytaskdash">
                        <div class="commonWhiteBox">
                            <div class="boxHeadingBlock flexblock">
                                <h3 class="boxheading">My Task Center
                                    <span class="tooltipmain">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                            </g>
                                        </svg>
                                        <p class="tooltipclass">
                                            <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                            Recommended daily and weekly personalized tasks to improve your level of preparation.
                                        </p>
                                    </span>
                                </h3>
                                @if((isset($userStatus) && $userStatus==false))
                                <a onclick="sendtaskEvent()" href="{{route('dashboard-DailyTask')}}" class="commmongreenLink mb-2">Task Center <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg></span></a>
                                @endif
                            </div>

                            @if((isset($prof_asst_test) && $prof_asst_test=='N'))
                            <div class="fullbodyBox">
                                <div class="leftBox">
                                    <h4>Personalized Assessment</h4>
                                    <p> to assess your preparation. Take your first step to improvement.</p>
                                    <a href="#Assesmentmodal" data-bs-toggle="modal" data-bs-target="#Assesmentmodal" class="btn btn-common-white">Attempt Now</a>
                                    <!--a href="{{route('exam',['full_exam','instruction'])}}" class="btn btn-common-white">Attempt Now</a-->
                                </div>
                                <div class="rightImgBox">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="107" height="105" viewBox="0 0 107 105" fill="none">
                                        <rect y="17.496" width="79" height="101" rx="2" transform="rotate(-12.796 0 17.496)" fill="#D4ECD8" />
                                        <rect x="10.203" y="7.494" width="79" height="101" rx="2" fill="#EDFFEF" />
                                        <rect x="16.203" y="50.494" width="10" height="10" rx="3.125" fill="#56B663" />
                                        <path d="m19.328 55.494 1.25 1.25 2.5-2.5" stroke="#E0F6E3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                        <rect x="16.203" y="70.494" width="10" height="10" rx="3.125" fill="#56B663" />
                                        <path d="m19.328 75.494 1.25 1.25 2.5-2.5" stroke="#E0F6E3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                        <path stroke="#B2D9B6" stroke-width="2" stroke-linecap="round" d="M31.203 51.494h15M31.203 71.494h15M18.203 27.494h42M18.203 35.494h29M66.203 27.494h17M31.203 58.494h26M31.203 78.494h26" />
                                        <path d="m73.418 88.26-10.084-6.504-2.05 11.02c-.331 1.776 1.674 3.045 3.137 1.988l8.997-6.503z" fill="#56B663" />
                                        <path d="M94.23 33.856a4 4 0 0 1 5.53-1.194l3.361 2.169a3.999 3.999 0 0 1 1.193 5.53L73.418 88.26l-10.085-6.505 30.897-47.9z" fill="#4A9453" />
                                        <path d="M94.23 33.856a4 4 0 0 1 5.53-1.194l3.361 2.169a3.999 3.999 0 0 1 1.193 5.53l-5.42 8.403-10.084-6.505 5.42-8.403z" fill="#E0F6E3" />
                                        <path fill="#56B663" d="m90.436 39.738 10.084 6.505-3.252 5.042-10.084-6.505z" />
                                    </svg>
                                </div>
                            </div>
                            @endif
                            <!-- <a href="{{route('exam',['full_exam','instruction'])}}" class="btn btn-common-white">Attempt Now</a> -->
                            <div class="tabMainblock">
                                <div class="commontab mobilejustify">
                                    <div class="tablist">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active qq1_2_3_4" data-bs-toggle="tab" href="#daily">Daily tasks</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#weekly">Weekly tasks</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="daily" class=" tab-pane active">
                                            @if((isset($userStatus) && $userStatus==false))
                                            <div class="taskstatusBlock" style="margin-bottom:12px;">
                                                <h4>Task completed</h4>
                                                <!-- <a href="#Assesmentmodal" data-bs-toggle="modal" data-bs-target="#Assesmentmodal">Click me</a> -->

                                                <div class="statusvalue">
                                                    <span class="codevalue">{{$completeddailyTask}}</span><span>/{{(isset($dailyTask) && count($dailyTask)>0)?count($dailyTask):0}}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if((isset($userStatus) && $userStatus==true))
                                            <!-- if((isset($prof_asst_test) && $prof_asst_test=='N')) -->
                                            <p class="dashSubtext">Start taking tests, and we'll create tasks for you based on your proficiency to help you become more prepared.
                                            </p>
                                            @endif
                                            @if((isset($dailyTask) && !empty($dailyTask)) && $userStatus==false)
                                            <div class="tasklisting">
                                                <ul class="commonlisting">
                                                    @foreach($dailyTask as $key=>$data)
                                                    @if($data['category'] == 'skill' && $data['task_type'] == 'daily')
                                                    @php
                                                    $current_date=date("d");
                                                    if($current_date % 4 == 0){
                                                    $skill_task = 'Evaluation Skill';
                                                    $skill_category = 'evaluation';
                                                    }
                                                    else if($current_date % 4 == 1){
                                                    $skill_task = 'Knowledge Skill';
                                                    $skill_category = 'knowledge';
                                                    }
                                                    elseif($current_date % 4 == 2){
                                                    $skill_task = 'Application Skill';
                                                    $skill_category = 'application';
                                                    }
                                                    else{
                                                    $skill_task = 'Comprehension Skill';
                                                    $skill_category = 'comprehension';
                                                    }
                                                    @endphp
                                                    <li>
                                                        <div class="tasklistleft">

                                                            <h6>Task {{$key+1}}</h6>
                                                            <h4>{{$skill_task}}</h4>
                                                            <h5>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}} Questions | {{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</h5>
                                                        </div>
                                                        @if($data['allowed'] == '1')
                                                        <div class="tasklistbtn">
                                                            <a href="{{route('dailyTaskExamSkill',[$data['category'],$data['task_type'],'instruction',$skill_category])}}" class="btn btn-common-transparent nobg">Practice</a>
                                                        </div>
                                                        @else
                                                        <div class="tasklistbtn">
                                                            <button class="btn btn-common-transparent nobg disabled" disabled>Attempted</button>
                                                        </div>
                                                        @endif

                                                    </li>
                                                    @endif
                                                    @if($data['category'] == 'time' && $data['task_type'] == 'daily')
                                                    <li>
                                                        <div class="tasklistleft">
                                                            <h6>Task {{$key+1}}</h6>
                                                            <h4>Time Management</h4>
                                                            <h5>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}} Questions | {{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</h5>
                                                        </div>
                                                        @if($data['allowed'] == '1')
                                                        <div class="tasklistbtn">
                                                            <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                                        </div>
                                                        @else
                                                        <div class="tasklistbtn">
                                                            <button class="btn btn-common-transparent nobg disabled" disabled>Attempted</button>
                                                        </div>
                                                        @endif
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                                <div class="moreTaskLink bottomlikabs">
                                                    <a href="{{route('dashboard-DailyTask')}}" class="commmongreenLink mb-2"> more tasks <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg></span></a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div id="weekly" class=" tab-pane">
                                            @if((isset($userStatus) && $userStatus==false))
                                            <div class="taskstatusBlock" style="margin-bottom:12px;">
                                                <h4>Task completed</h4>
                                                <div class="statusvalue">
                                                    <span class="codevalue">{{$completedweekTask}}</span><span>/{{(isset($weekTask) && count($weekTask)>0)?count($weekTask):0}}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if((isset($userStatus) && $userStatus==true))
                                            <!-- if((isset($prof_asst_test) && $prof_asst_test=='N')) -->
                                            <p class="dashSubtext">Start taking tests, and we'll create tasks for you based on your proficiency to help you become more prepared.
                                            </p>
                                            @endif
                                            @if((isset($weekTask) && !empty($weekTask)) && $userStatus==false)
                                            <div class="tasklisting">
                                                <ul class="commonlisting">
                                                    @foreach($weekTask as $wkey=>$data)
                                                    @if($data['category'] == 'accuracy' && $data['task_type'] == 'weekly')
                                                    <li>
                                                        <div class="tasklistleft">
                                                            <h6>Task {{$wkey+1}}</h6>
                                                            <h4>Accuracy Test</h4>
                                                            <h5>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}} Questions | {{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</h5>
                                                        </div>
                                                        @if($data['allowed'] == '1')
                                                        <div class="tasklistbtn">
                                                            <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                                        </div>
                                                        @else
                                                        <div class="tasklistbtn">
                                                            <button class="btn btn-common-transparent nobg disabled" disabled>Attempted</button>
                                                        </div>
                                                        @endif
                                                    </li>
                                                    @endif
                                                    @if($data['category'] == 'weak_topic' && $data['task_type'] == 'weekly')
                                                    <li>
                                                        <div class="tasklistleft">
                                                            <h6>Task {{$wkey+1}}</h6>
                                                            <h4>Weak Topic Test</h4>
                                                            <h5>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}} Questions | {{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</h5>
                                                        </div>
                                                        @if($data['allowed'] == '1')
                                                        <div class="tasklistbtn">
                                                            <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                                        </div>
                                                        @else
                                                        <div class="tasklistbtn">
                                                            <button class="btn btn-common-transparent nobg disabled" disabled>Attempted</button>
                                                        </div>
                                                        @endif
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                                <div class="moreTaskLink bottomlikabs">
                                                    <a href="{{route('dashboard-DailyTask')}}" class="commmongreenLink mb-2"> more tasks <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg></span></a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 commonblockDash">
                        <div class="commonWhiteBox">
                            <div class="boxHeadingBlock">
                                <h3 class="boxheading">MyQ Matrix
                                    <span class="tooltipmain right-tolltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                            </g>
                                        </svg>
                                        <p class="tooltipclass">
                                            <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                            An actionable matrix of your strengths, weaknesses and improvement areas.
                                        </p>
                                    </span>
                                </h3>
                                <p class="dashSubtext">Know your strengths and weaknesses and step up your game.</p>
                            </div>
                            @if(!empty($myq_matrix) && $userStatus==false)
                            <div class="MyqMatrixMain mt-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="myqmatPannel myqcolor1">
                                            <a href="#strengthmodal" data-bs-toggle="modal" data-bs-target="#strengthmodal">
                                                <div class="myqinner">
                                                    <h6>Q1</h6>
                                                    <h5>Strengths</h5>
                                                    <p>Topics which are your strengths.</p>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0);" class="myq_matrix_quadrant" data-name="q_1">
                                                <div class="myqbottomSec">
                                                    <h3>@if(isset($myq_matrix[0]))
                                                        {{$myq_matrix[0]}}
                                                        @else
                                                        0
                                                        @endif <span class="topictext">Topics</span>
                                                    </h3>
                                                    <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="myqmatPannel myqcolor2">
                                            <a href="#needsfocusmodal" data-bs-toggle="modal" data-bs-target="#needsfocusmodal">
                                                <div class="myqinner">
                                                    <h6>Q2</h6>
                                                    <h5>Opportunity</h5>
                                                    <p>Potentially strong topics that need a little attention.</p>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0);" class="myq_matrix_quadrant" data-name="q_2">
                                                <div class="myqbottomSec">
                                                    <h3>@if(isset($myq_matrix[0]))
                                                        {{$myq_matrix[1]}}
                                                        @else
                                                        0
                                                        @endif
                                                        <span class="topictext">Topics</span>
                                                    </h3>
                                                    <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="myqmatPannel myqcolor3 mb-0">
                                            <a href="#hopefulmodal" data-bs-toggle="modal" data-bs-target="#hopefulmodal">
                                                <div class="myqinner">
                                                    <h6>Q3</h6>
                                                    <h5>Hurdles </h5>
                                                    <p>Topics which are not entirely weaknesses but are hurdles in your journey.</p>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0);" class="myq_matrix_quadrant" data-name="q_3">
                                                <div class="myqbottomSec">
                                                    <h3>@if(isset($myq_matrix[2]))
                                                        {{ $myq_matrix[2]}}
                                                        @else
                                                        0
                                                        @endif <span class="topictext">Topics</span>
                                                    </h3>
                                                    <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="myqmatPannel myqcolor4  mb-0">
                                            <a href="#weakmodal" data-bs-toggle="modal" data-bs-target="#weakmodal">
                                                <div class="myqinner">
                                                    <h6>Q4</h6>
                                                    <h5>Weakness</h5>
                                                    <p>Your weakest topics.</p>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0);" class="myq_matrix_quadrant" data-name="q_4">
                                                <div class="myqbottomSec">
                                                    <h3>@if(isset($myq_matrix[3]))
                                                        {{ $myq_matrix[3]}}
                                                        @else
                                                        0
                                                        @endif <span class="topictext">Topics</span>
                                                    </h3>
                                                    <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="emptystate mt-3">
                                <div class="emptystateInner">
                                    <div class="emptyicon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="81" viewBox="0 0 80 81" fill="none">
                                            <circle cx="40" cy="40.102" r="40" fill="#E0F6E3" />
                                            <path d="M16.979 25.102h10.525a1 1 0 0 1 1 1v2.22a1 1 0 0 1-1 1h-5.87c-.458 0-.864.312-.91.768-.303 3.018 1.262 8.859 8.382 15.604.885.84.051 2.165-.937 1.45-10.105-7.32-12.436-16.283-12.146-21.179.03-.499.456-.863.956-.863zM64.021 25.102H53.496a1 1 0 0 0-1 1v2.22a1 1 0 0 0 1 1h5.87c.458 0 .864.312.91.768.303 3.018-1.262 8.859-8.382 15.604-.885.84-.051 2.165.937 1.45 10.104-7.32 12.436-16.283 12.146-21.179-.03-.499-.456-.863-.956-.863z" fill="#BEE9C4" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M40.206 21.102H27.588c-.04.465-.089.965-.14 1.494-.59 6.134-1.554 16.144 4.322 21.616 1.044.972 1.868 1.64 2.516 2.164 1.99 1.614 2.326 1.886 2.326 5.539v2.641h7.776v-2.641c0-3.653.335-3.925 2.326-5.539a44.9 44.9 0 0 0 2.516-2.164c5.876-5.472 4.912-15.482 4.322-21.616-.051-.529-.1-1.029-.14-1.494H40.206z" fill="#fff" />
                                            <path d="M29 60.102a6 6 0 0 1 6-6h10a6 6 0 0 1 6 6v2H29v-2z" fill="#BEE9C4" />
                                            <path d="M40.05 29.022a.5.5 0 0 1 .9 0l.825 1.691a.5.5 0 0 0 .376.275l1.856.275a.5.5 0 0 1 .278.85l-1.35 1.33a.5.5 0 0 0-.141.44l.317 1.87a.5.5 0 0 1-.728.525l-1.648-.877a.5.5 0 0 0-.47 0l-1.648.877a.5.5 0 0 1-.728-.525l.317-1.87a.5.5 0 0 0-.142-.44l-1.349-1.33a.5.5 0 0 1 .278-.85l1.856-.275a.5.5 0 0 0 .376-.275l.826-1.691z" fill="#56B663" />
                                        </svg>
                                    </div>
                                    <p class="emptytext">Attempt <strong>'Personalized Assessment'</strong> to learn about your strengths and weaknesses. </p>
                                    <!--a href="{{route('exam',['full_exam','instruction'])}}" class="btn btn-common-transparent nobg">Attempt Now</a-->
                                    <a href="#Assesmentmodal" data-bs-toggle="modal" data-bs-target="#Assesmentmodal" class="btn btn-common-transparent nobg">Attempt Now</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="cardWhiteBg">
                            <section class="weeklyPlanWrapper">
                                <div class="planDetail">
                                    <div class="planewrapper">
                                        <div class="plantitleBox">
                                            <div class="boxHeadingBlock">
                                                <h3 class="boxheading">
                                                    Weekly Planner
                                                    <span class="tooltipmain">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                            </g>
                                                        </svg>
                                                        <p class="tooltipclass">
                                                            <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                                            Schedule your practice sessions as per your needs.
                                                        </p>
                                                    </span>
                                                </h3>
                                                <p class="dashSubtext">Plan your weekly practice for the chapters of your choice.</p>
                                            </div>
                                            <div class="gotoPlanner gotoplanner_mob mobile_block">
                                                <a href="{{ url('/planner') }}">
                                                    <span>Go to Planner</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="planDetailBox">
                                            <div class="vLine"></div>
                                            <div class="selectedWeek">
                                                <p class="m-0">This week<span class="mobile_block">:</span></p>
                                                <p class="m-0 dateformate">{{date('j M', strtotime('monday this week'))}} - {{date('j M', strtotime('sunday this week'))}}</p>
                                            </div>
                                            <div class="plannedtestbox">
                                                <div class="plannedtest">
                                                    <p class="m-0 AttempType">Planned Tests</p>
                                                    <p class="m-0 testCount">{{$planned_test_cnt}}</p>
                                                </div>
                                                <div class="plannedtest">
                                                    <p class="m-0 AttempType">Attempted Tests</p>
                                                    <p class="m-0 testCount">{{$attempted_test_cnt}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gotoPlanner mobile_hide">
                                        <a onclick="sendGoToPlannerEvent()" href="{{ url('/planner') }}">
                                            <span>Go to Planner</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                @if(isset($planner) && empty($planner))
                                <div class="testPlanCardholder">
                                    <div class="testPlanCard testplannewuser">
                                        <svg class="testplanNewimg" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80" fill="none">
                                            <circle cx="40" cy="40" r="40" fill="#E0F6E3" />
                                            <path d="M23.988 27.418a4 4 0 0 1 3.966-4.518H56.79a4 4 0 0 1 3.966 3.483l3.653 28a4 4 0 0 1-3.966 4.517H31.607a4 4 0 0 1-3.966-3.482l-3.653-28z" fill="#BEE9C4" />
                                            <path d="M58.01 27.418a4 4 0 0 0-3.966-4.518H25.208a4 4 0 0 0-3.966 3.483l-3.653 28a4 4 0 0 0 3.966 4.517h28.836a4 4 0 0 0 3.966-3.482l3.653-28z" fill="#fff" />
                                            <path d="M53 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952H53zM35.399 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952h2.697z" fill="#56B663" />
                                            <path d="M24.07 31.544a.8.8 0 0 1 .784-.644h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM23.271 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM22.472 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM30.47 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM29.671 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM28.87 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4zM36.87 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.956l.48-2.4zM36.07 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM35.271 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM43.271 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM42.47 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM49.67 31.544a.8.8 0 0 1 .784-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM48.87 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4z" fill="#E0F6E3" />
                                        </svg>
                                        <p class=" m-0">Start planning your week</p>
                                        <div class="addPlanbtn">
                                            <a onclick="sendAddPlanEvent()" href="{{ url('/planner') }}" class="btn btn-common-transparent nobg">
                                                <!-- <span class="mobile_hide">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                        <path d="M10 18.333a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 6.666v6.667M6.666 10h6.667" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span> -->
                                                <span class="addiconempty">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                        <path d="M10 6v8M6 10h8" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                <span>Add
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="allSubslider">
                                    <div class="dashborarSlider owl-carousel owl-theme">
                                        @foreach($planner as $key=>$val)
                                        <?php
                                        if ($val->subject_id == 1) {
                                            $backgroundclass = "mathCard";
                                            $subject_name = "Mathematics";
                                            $img_url = 'public/after_login/current_ui/images/mathmatcs.svg';
                                        } elseif ($val->subject_id == 2) {
                                            $backgroundclass = "physicsCard";
                                            $subject_name = "Physics";
                                            $img_url = 'public/after_login/current_ui/images/physics.svg';
                                        } elseif ($val->subject_id == 3) {
                                            $backgroundclass = "chemistryCard";
                                            $subject_name = "Chemistry";
                                            $img_url = 'public/after_login/current_ui/images/chemistry.svg';
                                        } elseif ($val->subject_id == 4) {
                                            $backgroundclass = "botanyCard";
                                            $subject_name = "Botany";
                                            $img_url = 'public/after_login/current_ui/images/botany.svg';
                                        } elseif ($val->subject_id == 146) {
                                            $backgroundclass = "zoologyCard";
                                            $subject_name = "Zoology";
                                            $img_url = 'public/after_login/current_ui/images/zoology.svg';
                                        } else {
                                            $backgroundclass = "physicsCard";
                                            $subject_name = "";
                                            $img_url = "";
                                        }
                                        ?>
                                        <div class="item">
                                            <div class="testPlanCard subCard {{$backgroundclass}}">
                                                <p class="m-0">{{$subject_name}}</p>
                                                <h3 title="{{$val->chapter_name}}">{{$val->chapter_name}}</h3>
                                                <div class="proficiencyper"><small>Proficiency</small><br><b>{{ round($val->chapter_score, 0)}}%</b></div>
                                                <div class="attemptBtn">
                                                    @if($val->test_completed_yn=='Y')
                                                    <a href="javascript:void(0);" class="btn btn-common-attempted" style="cursor: default;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <circle cx="10" cy="10" r="10" fill="#56B663" />
                                                            <path d="m5.5 10.5 3 3L14 8" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> Attempted</a>
                                                    @else
                                                    <form method="post" action="{{route('plannerExam',[$val->id,'instruction'])}}">
                                                        @csrf
                                                        <input type="hidden" name="chapter_name" value="{{$val->chapter_name}}">
                                                        <input type="hidden" name="subject_id" value="{{$val->subject_id}}">
                                                        <input type="hidden" name="chapter_id" value="{{$val->chapter_id}}">
                                                        <input type="hidden" name="exam_id" value="{{$val->exam_id}}">
                                                        <button type="submit" href="" class="btn btn-common-green">Attempt Now</button>
                                                    </form>
                                                    @endif
                                                </div>
                                                <div class="subIcon">
                                                    <img src="{{URL::asset($img_url)}}">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </section>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="">
                            <section class="graphCard my-4">
                                <div class="graphCardwrapper">
                                    <div class="journeyGraph cardWhiteBg">
                                        <div class="boxHeadingBlock">
                                            <h3 class="boxheading">
                                                Progress Journey
                                                <span class="tooltipmain">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                        <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                        </g>
                                                    </svg>
                                                    <p class="tooltipclass">
                                                        <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                                        Map your current vs your ideal preparation pace.
                                                    </p>
                                                </span>
                                            </h3>
                                        </div>
                                        @if($userStatus==false)
                                        <div class="row row_repeate">
                                            @else
                                            <div class="row row_repeate emptyrow">
                                                @endif
                                                <div class="col-md-7">
                                                    <div class="progress_journey_chart progressnewjourney">
                                                         <span class="yaxis_label" style="position: relative;margin: 0px 0 0 -60px;"><small>No. of chapters completed</small> </span>
                                                        <canvas id="progressJourny_graph"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- if (isset($ideal) && !empty($ideal) && $userStatus==false) -->
                                                    @if($userStatus==false)
                                                    <div class="graphDetail w-100">
                                                        <div class="yourPacebox">
                                                            <p class="graphTitle">Ideal Pace</p>
                                                            <p>
                                                                <span class="weekCountline myscore"></span>
                                                                <span class="weekCount">{{round($ideal_avg)}}</span>
                                                                @if(round($ideal_avg)==1)
                                                                <span class="weekText">chapter per week</span>
                                                                @else
                                                                <span class="weekText">chapters per week</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="yourPacebox">
                                                            <p class="graphTitle">Your Pace</p>
                                                            <p>
                                                                <span class="weekCountline colorHline"></span>
                                                                <span class="weekCount">{{round($your_place_avg)}}</span>
                                                                @if(round($your_place_avg)==1)
                                                                 <span class="weekText">chapter per week</span>
                                                                @else
                                                                 <span class="weekText">chapters per week</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        @if($your_place_avg < $ideal_avg)
                                                        @if(round($totalNoOfChapters) ==1)
                                                        <div class="note">
                                                            <b>Note:</b> To achieve the ideal pace, you have to complete {{round($totalNoOfChapters)}} chapter this week
                                                        </div>
                                                        @else
                                                        <div class="note">
                                                            <b>Note:</b> To achieve the ideal pace, you have to complete {{round($totalNoOfChapters)}} chapters this week
                                                        </div>
                                                        @endif
                                                       @endif 

                                                    </div>
                                                    @else
                                                    <div class="graphDetailempty w-100">
                                                        <p>Begin your practice and we will curate an ideal pace against your own progress graph.</p>
                                                        <a href="{{ url('/exam_custom') }}" class="btn btn-common-transparent width150 nobg">Attempt Now</a>
                                                    </div>
                                                    @endif
                                                    <!-- <a href="" class="btn btn-common-transparent desktop_hide mt-3 mb-3 white_bg">Attempt Now</a> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="journeyGraph cardWhiteBg markstrends_whitecard">
                                            <div class="boxHeadingBlock">
                                                <h3 class="boxheading">
                                                    Marks Trend
                                                    <span class="tooltipmain">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                            </g>
                                                        </svg>
                                                        <p class="tooltipclass">
                                                            <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                                            Get insights on your progress over time.
                                                        </p>
                                                    </span>
                                                </h3>
                                            </div>

                                            @if($userStatus==false)
                                            <div class="journeyBoxcontainer row_repeate">
                                                @else
                                                <div class="journeyBoxcontainer row_repeate emptyrow">
                                                    @endif
                                                    <div class="graphimg">
                                                        @if($userStatus==false)
                                                        <div class="dropbox desktop_hide">
                                                            <div class="customDropdown1 dropdown" id="dropdown2">
                                                                <input class="text-box markstrend" type="text" id="markstrend_graph2" placeholder="All Test" readonly>
                                                                <div class="options">
                                                                    <div style=" overflow-y: auto;  height: 145px;">
                                                                        <div class="active markstrend markstrend_graph2" onclick="showMobile('All Test', 'all','markstrend_graph2')">All Test</div>
                                                                        <div class="markstrend markstrend_graph2" onclick="showMobile('Mock Test', 'Mocktest','markstrend_graph2')">Mock Test</div>
                                                                        <div class="markstrend markstrend_graph2" onclick="showMobile('Practice Test', 'Assessment','markstrend_graph2')">Practice Test</div>
                                                                        <div class="markstrend markstrend_graph2" onclick="showMobile('Test Series', 'Test-Series','markstrend_graph2')">Test Series</div>
                                                                        <div class="markstrend markstrend_graph2" onclick="showMobile('Live', 'Live','markstrend_graph2')">Live Test</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div></div>
                                                        @endif
                                                        <div class="progress_journey_chart graph_padd">
                                                            <span class="yaxis_label"><small>Marks (in %)</small> </span>
                                                            <canvas id="trend_graph" style="height: 270px;"></canvas>
                                                        </div>
                                                        <div class="desktop_hide">
                                                            <div class="yourPacebox">
                                                                <p class="testScrolltype">
                                                                    <span class="weekCountlineH myscore"></span>
                                                                    <span class="weekText">My score</span>
                                                                </p>
                                                                <p class="testScrolltype">
                                                                    <span class="weekCountlineH  peerAvg"></span>
                                                                    <span class="weekText">Peer average</span>
                                                                </p>
                                                                <p class="testScrolltype">
                                                                    <span class="weekCountlineH  topScroe"></span>
                                                                    <span class="weekText">Top score</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- if (!empty($trendResponse) && $userStatus==false) -->
                                                    @if($userStatus==false)
                                                    <div class="graphDetail">
                                                        <div class="dropbox mobile_hide">
                                                            <div class="customDropdown1 dropdown" id="dropdown1">
                                                                <input class="text-box markstrend" type="text" id="markstrend_graph" placeholder="All Test" readonly>
                                                                <div class="options">
                                                                    <div style=" overflow-y: auto;  height: 145px;">
                                                                        <div class="active markstrend markstrend_graph" onclick="show('All Test', 'all','markstrend_graph')">All Test</div>
                                                                        <div class="markstrend markstrend_graph" onclick="show('Mock Test', 'Mocktest','markstrend_graph')">Mock Test</div>
                                                                        <div class="markstrend markstrend_graph" onclick="show('Practice Test', 'Assessment','markstrend_graph')">Practice Test</div>
                                                                        <div class="markstrend markstrend_graph" onclick="show('Test Series', 'Test-Series','markstrend_graph')">Test Series</div>
                                                                        <div class="markstrend markstrend_graph" onclick="show('Live', 'Live','markstrend_graph')">Live Test</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="yourPacebox scoretype mobile_hide">
                                                            <p class="testScrolltype">
                                                                <span class="weekCountlineH myscore"></span>
                                                                <span class="weekText">My score</span>
                                                            </p>
                                                            <p class="testScrolltype">
                                                                <span class="weekCountlineH  peerAvg"></span>
                                                                <span class="weekText">Peer average</span>
                                                            </p>
                                                            <p class="testScrolltype">
                                                                <span class="weekCountlineH  topScroe"></span>
                                                                <span class="weekText">Top score</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="graphDetailempty">
                                                        <p>Analyse your marks trend and get a grip on your preparation. Begin your practice to generate your graph.</p>
                                                        <div class="yourPacebox">
                                                            <p class="testScrolltype">
                                                                <span class="weekCountlineH myscore"></span>
                                                                <span class="weekText">My score</span>
                                                            </p>
                                                            <p class="testScrolltype">
                                                                <span class="weekCountlineH  peerAvg"></span>
                                                                <span class="weekText">Peer average</span>
                                                            </p>
                                                            <p class="testScrolltype">
                                                                <span class="weekCountlineH  topScroe"></span>
                                                                <span class="weekText">Top score</span>
                                                            </p>
                                                        </div>
                                                        <a href="{{ url('/exam_custom') }}" class="btn btn-common-transparent width150 nobg mt-4">Attempt Now</a>
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Strengths-popup start  -->
    <div class="modal fade" id="strengthmodal">
        <div class="modal-dialog">
            <div class="modalcenter">
                <div class="modal-content strengthmodal_content">
                    <div class="modal-header1">
                        <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="intraction_text_q1">Q1</div>
                        <div class="intraction_text_strength">Strengths</div>
                        <hr>
                        <div class="instruction_text_content">

                            Going great. Find your strong topics here. Stay in the lead by revision.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="needsfocusmodal">
        <div class="modal-dialog">
            <div class="modalcenter">
                <div class="modal-content strengthmodal_content">
                    <div class="modal-header1">
                        <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="intraction_text_q1">Q2</div>
                        <div class="intraction_text_strength">Opportunity</div>
                        <hr>
                        <div class="instruction_text_content">
                            Give a little attention to these topics and take another step towards perfection.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="hopefulmodal">
        <div class="modal-dialog">
            <div class="modalcenter">
                <div class="modal-content strengthmodal_content">
                    <div class="modal-header1">
                        <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="intraction_text_q1">Q3</div>
                        <div class="intraction_text_strength">Hurdles</div>
                        <hr>
                        <div class="instruction_text_content">
                            Topics that are hurdles in your journey. Do not save them for the last.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="weakmodal">
        <div class="modal-dialog">
            <div class="modalcenter">
                <div class="modal-content strengthmodal_content">
                    <div class="modal-header1">
                        <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="intraction_text_q1">Q4</div>
                        <div class="intraction_text_strength">Weakness</div>
                        <hr>
                        <div class="instruction_text_content">
                            Find your weak topics here. Work hard to move these topics to other quadrants.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Strengths-popup end -->

    <div class="modal fade" id="matrix">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light">
                <div class="modal-header pb-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Please practice more questions on our platform to enable this test.</p>
                    <div class="text-center mb-4">
                        <a href="javascript:void(0);" class="btn btn-danger px-5" data-bs-dismiss="modal" aria-label="Close" title="Close"> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Assesment Modal -->
  <div class="modal fade assesmentmodal" id="Assesmentmodal">
        <div class="modal-dialog">
            <div class="modalcenter">
                <div class="modal-content strengthmodal_content">
                    <div class="modal-header1">
                        <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path d="M18 6.51123L6 18.5112" stroke="#1F1F1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6.51123L18 18.5112" stroke="#1F1F1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></a>
                    </div>
                    <div class="modal-body">
                    <div class="AssementTestBlock">
                        <div class="SelectPlane_text">
                            <h3 class="pageCountBox"><div>Personalized Preparation Assessment </div>
                            </h3>
                        </div>
                        <div class="verificationBox mt-0 desktop_hide_performence_analytics">
                            <p>A verification link has been sent to<b> {{$userData->email}}</b>, please click the link to get your account verified.</p>
                            <a href="javascript:void(0);" class="resend_email">Resend</a>
                        </div>
                        <div class="personalAssesmentNewBlock">
                            <div class="AssiementNewRow">
                                <div class="AssesmentWhitePannel">
                                    <h4 class="assismetHeading">Quick Personalized Assessment</h4>
                                    @if($user_exam_id == '1')
                                    <h6 class="assismetSubHeading">Mathematics, Physics & Chemistry</h6>
                                    @else
                                    <h6 class="assismetSubHeading">Physics, Chemistry, Botany & Zoology</h6>
                                    @endif
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
                                            @if($user_exam_id == '1')
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                                </svg>
                                                30 questions in this assessment
                                            </li>
                                            @else
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                                </svg>
                                                40 questions in this assessment
                                            </li>
                                            @endif
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
                                                Short-length test to evaluate knowledge level
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                                </svg>
                                                Personalized recommendations for improvement plan
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
                                <h4 class="assismetHeading">Detailed Personalized Assessment</h4>
                                    @if($user_exam_id == '1')
                                    <h6 class="assismetSubHeading">Mathematics, Physics & Chemistry</h6>
                                    @else
                                    <h6 class="assismetSubHeading">Physics, Chemistry, Botany & Zoology</h6>
                                    @endif
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
                                                 @if($user_exam_id == '1')
                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                                </svg>75 questions in this assessment
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                                                </svg>100 questions in this assessment
                        @endif
                                                
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
                                                </svg>Personalized recommendations for improvement plan
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="{{route('exam',['full_exam_advance','instruction'])}}" class="btn btn-common-green fullwidth"> Take Test</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Assesment Modal_end -->


    <div class="loader-block" style="display:none;">
        <img src="{{URL::asset('public/after_login/new_ui/images/loader.gif')}}">
    </div>
    <!-- Footer Section -->
    @include('afterlogin.layouts.footer_new')
    <!-- footer Section end  -->
    @php
    $trend_stu_score=$trend_avg_score=$trend_max_score=$aWeeks = $weekdates=[];
    $month = date('m');
    $i = $month - count($trendResponse)+1;
    if (!empty($trendResponse)) {
    foreach ($trendResponse as $key => $trend) {
    //$week = "W" . $i;
    $monthName = date('M', mktime(0, 0, 0, $i, 10));
    $week = $monthName;
    array_push($aWeeks, $week);
    $timestamp = strtotime( $trend['date']);
    $last_date=date("j M", $timestamp);
    $first_date = date('j M', strtotime('-6 days', $timestamp));
    array_push($weekdates, $first_date."-".$last_date);
    array_push($trend_stu_score, $trend['student_score']);
    array_push($trend_avg_score, $trend['average_score']);
    array_push($trend_max_score, $trend['max_score']);
    $i++;
    }
    }else{
    array_push($trend_stu_score, 0);
    array_push($trend_avg_score, 0);
    array_push($trend_max_score, 0);
    }
    $weeks_json = isset($aWeeks) ? json_encode($aWeeks) : [];
    $weekdates_json = isset($weekdates) ? json_encode($weekdates) : [];
    $stu_score_json = isset($trend_stu_score) ? json_encode($trend_stu_score) : [];
    $avg_score_json = isset($trend_avg_score) ? json_encode($trend_avg_score) : [];
    $max_score_json = isset($trend_max_score) ? json_encode($trend_max_score) : [];
    $ideal = isset($ideal) ? json_encode($ideal) : [];
    $your_place = (isset($your_place) && ($userStatus==false)) ? json_encode($your_place) : [];

    $progress_cat = isset($progress_cat) ? json_encode($progress_cat) : [];
    $aWeeks= array_values($aWeeks);
    @endphp

    <script>
        function sendtaskEvent() {

            mixpanel.track('Go to Task Center', {
                "$city": '<?php echo $userData->city; ?>',
            });

        }

        function sendSeeAnalyticsEvent() {
            mixpanel.track('Clicked See Analytics', {
                "$city": '<?php echo $userData->city; ?>',
            });
        }

        function sendAddPlanEvent() {

            mixpanel.track('Click Add Plan', {
                "$city": '<?php echo $userData->city; ?>',
            });

        }

        function sendGoToPlannerEvent() {

            mixpanel.track('Click Go to Planner Button', {
                "$city": '<?php echo $userData->city; ?>',
            });

        }


        $(document).ready(function() {
            $("span.tooltipmain svg").click(function(event) {
                event.stopPropagation();

                var card_open = $(this).siblings("p").hasClass('show');
                if (card_open === true) {
                    $(this).siblings("p").hide();
                    $(this).siblings("p").removeClass('show');
                } else {
                    $("span.tooltipmain p.tooltipclass span").each(function() {
                        $(this).parent("p").hide();
                        $(this).parent("p").removeClass('show');
                    });
                    $(this).siblings("p").show();
                    $(this).siblings("p").addClass('show');
                }
                $('.customDropdown').removeClass('active');

            });
            $("span.tooltipmain p.tooltipclass span").click(function() {
                $(this).parent("p").hide();
                $(this).parent("p").removeClass('show');
            });
            $('.myq_matrix_quadrant').click(function() {
                var quad_name = $(this).attr('data-name');
                sessionStorage.setItem("quadrant_name", quad_name);
                window.location.href = '{{url("dashboard-MyQMatrix")}}';
            });
        });
        $(document).on('click', function(e) {
            var card_opened = $('.tooltipclass').hasClass('show');
            if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
                $('.tooltipclass').hide();
                $('.tooltipclass').removeClass('show');
            }
            var dropdown_open = $('.customDropdown').hasClass('active');
            if (!$(e.target).is('.markstrend') && dropdown_open === true) {
                $('.customDropdown').removeClass('active');
            }
        });
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
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $('.dashborarSlider').owlCarousel({
            stagePadding: 10,
            loop: false,
            margin: 0,
            nav: true,
            dots: false,
            // rewindNav:true,

            responsive: {
                0: {
                    items: 1,
                    stagePadding: 40,
                    margin: 0,
                    loop: false,
                },

                500: {
                    items: 1,
                    // nav: false,
                    stagePadding: 40,
                    margin: 0,
                    loop: false,
                },
                600: {
                    items: 2
                },
                767: {
                    items: 3
                },
                1199: {
                    items: 4
                }

            }
        })
    </script>
    <script>
        /* progress Journy graph */

        const labels1 = <?php print_r($progress_cat); ?>;
        const data1 = {
            labels: labels1,
            datasets: [{
                    label: 'Ideal Pace',
                    backgroundColor: '#05d6a1',
                    borderColor: '#05d6a1',
                    data: <?php print_r($ideal); ?>,
                    borderwidth: 0.6,
                    tension: 0.4
                },
                {
                    label: 'Your Pace',
                    backgroundColor: '#f87d96',
                    borderColor: '#f87d96',
                    data: <?php print_r($your_place); ?>,
                    borderwidth: 0.6,
                    tension: 0.4
                }
            ]
        };

        const config1 = {
            type: 'line',
            data: data1,
            options: {
                maintainAspectRatio: false,
                responsive: true,
                elements: {
                    point: {
                        radius: 2
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Line Chart - Cubic interpolation mode'
                    },
                    tooltip: {
                        displayColors: false,
                        // yAlign: 'bottom',
                        backgroundColor: colorItems
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,

                        },
                    },
                y: {
                    beginAtZero: true,
                    ticks: {
                         precision: 0
                        }
                    },
                }
            }
        };

        const myChart1 = new Chart(
            document.getElementById('progressJourny_graph'),
            config1
        );
        /* progress Journy graph end */

        /** ********************/
        const labels2 = <?php print_r($weeks_json); ?>;
        const data2 = {
            labels: labels2,
            datasets: [{
                    label: 'My score',
                    backgroundColor: '#05d6a1',
                    borderColor: '#05d6a1',
                    data: <?php print_r($stu_score_json); ?>,
                    borderwidth: 1,
                    tension: 0.4
                },
                {
                    label: 'Peer average',
                    backgroundColor: '#f87d96',
                    borderColor: '#f87d96',
                    data: <?php print_r($avg_score_json); ?>,
                    borderwidth: 1,
                    tension: 0.4
                },
                {
                    label: 'Top score',
                    backgroundColor: '#12c3ff',
                    borderColor: '#12c3ff',
                    data: <?php print_r($max_score_json); ?>,
                    borderwidth: 1,
                    tension: 0.4
                }
            ]
        };

        const config2 = {
            type: 'line',
            data: data2,
            options: {
                maintainAspectRatio: false,
                responsive: true,
                elements: {
                    point: {
                        radius: 2
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Line Chart - Cubic interpolation mode'
                    },
                    tooltip: {
                        displayColors: false,
                        // yAlign: 'bottom',
                        backgroundColor: colorItems
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,

                        },
                    },
                    y: {

                        type: 'linear',
                        grace: '5%',

                        min: 0,

                    }

                }
            }
        };

        const myChart2 = new Chart(
            document.getElementById('trend_graph'),
            config2
        );

        function colorItems(tooltipItem) {
            const tooltipBackColor = tooltipItem.tooltip.labelColors[0].backgroundColor;
            return tooltipBackColor;
        }
    </script>
    <script>
        function show(value, type, ids) {
            document.querySelector("#markstrend_graph").value = value;
            url = "{{ url('trendGraphUpdate/') }}/" + type;
            $.ajax({
                type: 'GET', //post method
                url: url, //ajaxformexample url
                dataType: "json",
                success: function(response) {
                    console.log(response.student_score);
                    myChart2.data.labels = response.labels;
                    myChart2.data.datasets[0].data = response.student_score; // or you can iterate for multiple datasets
                    myChart2.data.datasets[1].data = response.average_score; // or you can iterate for multiple datasets
                    myChart2.data.datasets[2].data = response.max_score; // or you can iterate for multiple datasets
                    myChart2.update(); // finally update our chart
                }
            });
        }

        function showMobile(value, type, ids) {
            document.querySelector("#markstrend_graph2").value = value;
            url = "{{ url('trendGraphUpdate/') }}/" + type;
            $.ajax({
                type: 'GET', //post method
                url: url, //ajaxformexample url
                dataType: "json",
                success: function(response) {
                    console.log(response.student_score);
                    myChart2.data.labels = response.labels;
                    myChart2.data.datasets[0].data = response.student_score; // or you can iterate for multiple datasets
                    myChart2.data.datasets[1].data = response.average_score; // or you can iterate for multiple datasets
                    myChart2.data.datasets[2].data = response.max_score; // or you can iterate for multiple datasets
                    myChart2.update(); // finally update our chart
                }
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
    </script>

    <script>
        $('.toastdata').hide();
        $('.progress').hide();
    </script>
    <?php $redis_data = Session::get('redis_data'); ?>
    @if((isset($userStatus) && $userStatus==false))
    <!-- Mixpanel Started-->
    <script type="text/javascript">
        

        // Enabling the debug mode flag is useful during implementation,
        // but it's recommended you remove it for production
        var mixpanelid = "{{$redis_data['MIXPANEL_KEY']}}";
        mixpanel.init(mixpanelid);
        mixpanel.track('Loaded - Dashboard', {
            "$city": '<?php echo $userData->city; ?>',
        });
    </script>
    @else
    <script type="text/javascript">
        // Enabling the debug mode flag is useful during implementation,
        // but it's recommended you remove it for production

        var mixpanelid = "{{env('MIXPANEL_KEY')}}";
        mixpanel.init(mixpanelid);
        mixpanel.track('Loaded - Dashoard - empty state', {
            "$city": '<?php echo $userData->city; ?>',
        });
    </script>

    @endif
    <!-- Mixpanel Event Ended-->


<div class="modal fade examModal 10" id="resume-test" tabindex="-1" role="dialog" aria-labelledby="resume-test" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content exammodal_content">
                <div class="modal-body exam-paused-body">
                    <div class="modal-header-exam text-center ">
                        <div class="exam-overview ">
                            <label>Exam Paused</label>
                        </div>
                    </div>
                    <div class="exam_duration_block text-center">
                        <img src="{{URL::asset('public/after_login/current_ui/images/exam-clock.svg')}}" />
                        <label class="d-block">Remaining time in the exam</label>
                        <span class="exam_duration d-block" id="pauseTime">03 mins</span>
                    </div>
                    <p>Your last assessment is on hold; click resume to go back to it.</p>
                    <!-- <p class="exittext">Do you want to exit the test? </P>
                    <p class="exittext-subheading">You can always come back and resume the test </p> -->
                    <div class="exam-footer-sec">
                        <div class="task-btn tasklistbtn text-center">
                            <button id="bt-modal-cancel" onclick="start();" class="btn btn-common-green" data-bs-dismiss="modal"> Resume <label class="p-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 17.259V6.741a1 1 0 0 1 1.504-.864l9.015 5.26a1 1 0 0 1 0 1.727l-9.015 5.259A1 1 0 0 1 7 17.259z" fill="#fff" />
                                    </svg>
                                </label>
                            </button>
                        </div>
                    </div>

                    <!-- <div id="button_width" class="exam-footer-sec width-50">
                        <div class="task-btn tasklistbtn">
                            <button class="btn btn-common-transparent nobg reviewbtn submitPopupBtn" data-bs-dismiss="modal" onclick="start()" id="back_to_restart">Back To test</button>
                            <a href="{{url('/dashboard')}}" id="bt-modal-confirm" class="btn btn-common-green green50 submitPopupBtn">Exit Test<label>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z" fill="#fff" />
                                    </svg>  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                    <path d="M11.4998 18.9515C10.1574 19.1083 8.79687 18.9579 7.52111 18.5116C6.24535 18.0654 5.08775 17.3349 4.13582 16.3755C3.05866 15.2982 2.27257 13.9652 1.85118 12.5013C1.42979 11.0373 1.38688 9.49039 1.72649 8.00535C2.0661 6.52031 2.7771 5.14577 3.79289 4.0105C4.80868 2.87523 6.09602 2.01637 7.53432 1.51438C8.97261 1.0124 10.5148 0.883716 12.0164 1.14039C13.518 1.39706 14.9299 2.03068 16.1198 2.98191C17.3097 3.93313 18.2386 5.17082 18.8197 6.57905C19.4007 7.98727 19.6148 9.51993 19.4418 11.0335" stroke="#F2F4F7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 5.01123V10.0112L12.5 12.0112M15.5 15.0112V20.0112M19.5 15.0112V20.0112" stroke="#F2F4F7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </label>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
    <style>
                .assesmentmodal .modal-dialog{max-width:960px;}

        .customDropdown1 {
            position: relative;
            width: 100%;
            border-radius: 10px;
            height: 60px;
        }

        .customDropdown1::before {
            content: "";
            background: url(https://app.thomsondigital2021.com/public/after_login/current_ui/images/arrow_drop_down.svg);
            position: absolute;
            top: 27px;
            right: 20px;
            z-index: 1;
            width: 21px;
            height: 8px;
            transition: 0.5s;
            pointer-events: none;
            background-size: revert;
            background-position: center;
            width: 13.1px;
            height: 10px;
        }

        .customDropdown1.active1::before {
            top: 22px;
            transform: rotate(-180deg);
        }

        .customDropdown1 input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            background: #f6f9fd;
            border: none;
            outline: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            letter-spacing: normal;
        }

        .customDropdown1 .options {
            position: absolute;
            top: 70px;
            width: 100%;
            background: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            -moz-scrollbar-position: outside;
            overflow: hidden;
            display: none;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            letter-spacing: normal;
            color: #1f1f1f;
        }

        .customDropdown1.active1 .options {
            display: block;
            z-index: 9;
        }

        .customDropdown1 .options .markstrend {
            padding: 12px 20px;
            cursor: pointer;
        }

        .journeyBoxcontainer .customDropdown1 .options .markstrend:hover {
            background: #f0fcf2;
        }

        .customDropdownpdown1 input::-webkit-input-placeholder {
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            text-align: left;
            color: #1f1f1f;
        }

        .customDropdown1 input::-webkit-input-placeholder {
            /* Edge */
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            text-align: left;
            color: #1f1f1f;
        }

        .customDropdown1 input:-ms-input-placeholder {
            /* Internet Explorer 10-11 */
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            text-align: left;
            color: #1f1f1f;
        }

        .customDropdown1 input::placeholder {
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            text-align: left;
            color: #1f1f1f;
        }
    </style>
    @endsection