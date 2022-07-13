@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
@endphp
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
<div class="main-wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper dashbaordContainer">
        <div class="dashboardTopSection">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="verifiaction-link">
                            <p>A verification link has been sent to <b>{{$userData->email}},</b> please click the link to get your account verified <a href="javascript:void(0);" class="resend_email">Resend</a></p>
                            <span class="mt-2" id="email_success"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 commonblockDash myqTodayPannel">
                        <div class="commondashboardTop">
                            <h3 class="boxheading headingbgchange">MyQ Today
                                <span class="tooltipmain">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                        </g>
                                    </svg>
                                    <p class="tooltipclass">
                                        <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                        A score derived from the detailed analysis of your test patterns that gives a clear understanding of your current level of preparation in comparison to an ideal one. Measure your real-time probability of reaching the goal with your current pattern of preparation. Set your goal!
                                    </p>
                                </span>
                            </h3>
                            <div class="myqTodayGraphSec">
                                <div class="mq_circle_percent" data-percent="{{$myqtodayScore}}">
                                    <div class="mq_circle_inner">
                                        <div class="mq_round_per"></div>
                                    </div>
                                </div>
                                @if(!empty($subject_proficiency))
                                <div class="textblock">
                                    <h6 class="dashSubHeading">You are doing great!</h6>
                                    <p class="dashSubtext">Attempt more tests to improve your score.</p>
                                    <a href="{{route('overall_analytics')}}" class="commmongreenLink">See analytics <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg></span></a>
                                </div>
                                @else
                                <div class="textblock">
                                    <h6 class="dashSubHeading">Lets get started!</h6>
                                    <p class="dashSubtext">To begin your journey, attempt "Full body scan".</p>
                                    <a href="{{route('exam','full_exam')}}" class="commmongreenLink">Attempt Now <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg></span></a>
                                </div>
                                @endif
                            </div>
                            <div class="commonWhiteBox">
                                <div class="boxHeadingBlock">
                                    <h3 class="boxheading">Subject Performance
                                        <span class="tooltipmain">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                </g>
                                            </svg>
                                            <p class="tooltipclass">
                                                <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                            </p>
                                        </span>
                                    </h3>
                                    <p class="dashSubtext">Supporting text for better interaction on this section</p>
                                </div>
                                @if(!empty($subject_proficiency))
                                <div class="subjectScoreBlock">
                                    <div class="row">
                                        @if(!empty($subject_proficiency))
                                        @foreach($subject_proficiency as $key=>$sub)
                                        <?php
                                        if (round($sub['score']) <= 40) {
                                            $colorcls = "";
                                        } elseif (round($sub['score']) <= 75) {
                                            $colorcls = "orangegraph";
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
                                                        <div class="circle_percent mt-3 {{$colorcls}}" data-percent="{{round($sub['score'])}}">
                                                            <div class="circle_inner">
                                                                <div class="round_per"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                        <p class="emptytext">Curious about your subject wise performance? Attempt <strong>'Full body scan.'</strong></p>
                                        <a href="{{route('exam','full_exam')}}" class="btn btn-common-transparent nobg">Attempt Now</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 commonblockDash">
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
                                            <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                            A list of customized tasks specially personalized for you based on the in-depth analysis of your completed tests. Strengthen your core learning and strategic skills through these quick customized tests. Build on your strengths and work on your weaker areas to progressively improve them. Improve on your proficiency!
                                        </p>
                                    </span>
                                </h3>
                                <a href="{{route('dashboard-DailyTask')}}" class="commmongreenLink mb-2">Task Center <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg></span></a>
                            </div>
                            @if(isset($prof_asst_test) && $prof_asst_test=='N')
                            <div class="fullbodyBox">
                                <div class="leftBox">
                                    <h4>Full Body Scan Test</h4>
                                    <p>to assess your preparedness and begin to improve it</p>
                                    <a href="{{route('exam','full_exam')}}" class="btn btn-common-white">Attempt Now</a>
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
                            <div class="tabMainblock">
                                <div class="commontab">
                                    <div class="tablist">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#daily">Daily tasks</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#weekly">Weekly tasks</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="daily" class=" tab-pane active">
                                            <div class="taskstatusBlock">
                                                <h4>Task completed</h4>
                                                <div class="statusvalue">
                                                    <span class="codevalue">{{$completeddailyTask}}</span><span>/</span><span>2</span>
                                                </div>
                                            </div>
                                            @if(isset($prof_asst_test) && $prof_asst_test=='N')
                                            <p class="dashSubtext mt-2">Start taking tests, and we'll create tasks for you based on your proficiency to help you become more exam-ready overall.
                                            </p>
                                            @endif
                                            @if(isset($prof_asst_test) && $prof_asst_test=='Y')
                                            <div class="tasklisting">
                                                <ul class="commonlisting">
                                                    @foreach($dailyTask as $key=>$data)
                                                    @if($data['category'] == 'skill' && $data['task_type'] == 'daily')
                                                    @php
                                                    $current_date=date("d");
                                                    if($current_date % 4 == 0){
                                                    $skill_task = 'Evaluation Skills';
                                                    $skill_category = 'evaluation';
                                                    }
                                                    else if($current_date % 4 == 1){
                                                    $skill_task = 'Knowledge Skills';
                                                    $skill_category = 'knowledge';
                                                    }
                                                    elseif($current_date % 4 == 2){
                                                    $skill_task = 'Application Skills';
                                                    $skill_category = 'application';
                                                    }
                                                    else{
                                                    $skill_task = 'Comprehension Skills';
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
                                                            <a href="{{route('dailyTaskExamSkill',[$data['category'],$data['task_type'],$skill_category])}}" class="btn btn-common-transparent nobg">Take test</a>
                                                        </div>
                                                        @else
                                                        <div class="tasklistbtn">
                                                            <a href="javascript:void(0);" class="btn btn-common-transparent nobg">ALREADY ATTEMPTED</a>
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
                                                            <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type']])}}" class="btn btn-common-transparent nobg">Take test</a>
                                                        </div>
                                                        @else
                                                        <div class="tasklistbtn">
                                                            <a href="javascript:void(0);" class="btn btn-common-transparent nobg">ALREADY ATTEMPTED</a>
                                                        </div>
                                                        @endif
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                                <div class="moreTaskLink">
                                                    <a href="{{route('dashboard-DailyTask')}}" class="commmongreenLink mb-2"> more tasks <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg></span></a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div id="weekly" class=" tab-pane">
                                            <div class="taskstatusBlock">
                                                <h4>Task completed</h4>
                                                <div class="statusvalue">
                                                    <span class="codevalue">{{$completedweekTask}}</span><span>/</span><span>2</span>
                                                </div>
                                            </div>
                                            <p class="dashSubtext mt-2">Please attempt the Full body scan test,
                                                so that we could generate tasks for you, based on your proficiency levels.</p>
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
                                                            <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type']])}}" class="btn btn-common-transparent nobg">Take test</a>
                                                        </div>
                                                        @else
                                                        <div class="tasklistbtn">
                                                            <a href="javascript:void(0);" class="btn btn-common-transparent nobg">ALREADY ATTEMPTED</a>
                                                        </div>
                                                        @endif
                                                    </li>
                                                    @endif
                                                    @if($data['category'] == 'weak_topic' && $data['task_type'] == 'weekly')
                                                    <li>
                                                        <div class="tasklistleft">
                                                            <h6>Task {{$wkey+1}}</h6>
                                                            <h4>Weak topic Test</h4>
                                                            <h5>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}} Questions | {{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</h5>
                                                        </div>
                                                        @if($data['allowed'] == '1')
                                                        <div class="tasklistbtn">
                                                            <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type']])}}" class="btn btn-common-transparent nobg">Take test</a>
                                                        </div>
                                                        @else
                                                        <div class="tasklistbtn">
                                                            <a href="javascript:void(0);" class="btn btn-common-transparent nobg">ALREADY ATTEMPTED</a>
                                                        </div>
                                                        @endif
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                                <div class="moreTaskLink">
                                                    <a href="{{route('dashboard-DailyTask')}}" class="commmongreenLink mb-2"> more tasks <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg></span></a>
                                                </div>
                                            </div>
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
                                            <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                            A matrix created to analyse your attempts in various topics over time and sort them into your areas of strengths and weaknesses. This data will keep on changing as you progress and diligently work on your identified and analysed weaknesses and strengths. It will also make visible those topics that can become your strength with a little more effort on your part. Align your preparation now!
                                        </p>
                                    </span>
                                </h3>
                                <p class="dashSubtext">Supporting text for better interaction on this section</p>
                            </div>
                            @if(!empty($myq_matrix))
                            <div class="MyqMatrixMain mt-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="myqmatPannel myqcolor1">
                                            <a href="#strengthmodal" data-bs-toggle="modal" data-bs-target="#strengthmodal">
                                                <div class="myqinner">
                                                    <h6>Q1</h6>
                                                    <h5>Strengths</h5>
                                                    <p>Going great. Find your strong topics here. Stay in the lead by revision</p>
                                                </div>
                                            </a>
                                            <a href="{{route('dashboard-MyQMatrix','q_1')}}">
                                                <div class="myqbottomSec">
                                                    <h3>@if(isset($myq_matrix[0]))
                                                        {{ str_pad($myq_matrix[0], 2, '0', STR_PAD_LEFT);}}
                                                        @else
                                                        00
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
                                                    <h5>Needs focus</h5>
                                                    <p>Give a little attention to these topics and take another step towards perfection. </p>
                                                </div>
                                            </a>
                                            <a href="{{route('dashboard-MyQMatrix','q_2')}}">
                                                <div class="myqbottomSec">
                                                    <h3>@if(isset($myq_matrix[0]))
                                                        {{ str_pad($myq_matrix[0], 2, '0', STR_PAD_LEFT);}}
                                                        @else
                                                        00
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
                                                    <h5>Hopeful </h5>
                                                    <p>Topics that are hurdles in your journey. Do not save them for the last. </p>
                                                </div>
                                            </a>
                                            <a href="{{route('dashboard-MyQMatrix','q_3')}}">
                                                <div class="myqbottomSec">
                                                    <h3>@if(isset($myq_matrix[2]))
                                                        {{ str_pad($myq_matrix[2], 2, '0', STR_PAD_LEFT);}}
                                                        @else
                                                        00
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
                                                    <h5>Weak </h5>
                                                    <p>Find your weak topics here. Work hard to move these topics to other quadrants.</p>
                                                </div>
                                            </a>
                                            <a href="{{route('dashboard-MyQMatrix','q_4')}}">
                                                <div class="myqbottomSec">
                                                    <h3>@if(isset($myq_matrix[3]))
                                                        {{ str_pad($myq_matrix[3], 2, '0', STR_PAD_LEFT);}}
                                                        @else
                                                        00
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
                                    <p class="emptytext">Attempt <strong>'Full body scan.'</strong> to learn about your strengths and weaknesses. </p>
                                    <a href="{{route('exam','full_exam')}}" class="btn btn-common-transparent nobg">Attempt Now</a>
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
                                                    Weekly plan
                                                    <span class="tooltipmain">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                            </g>
                                                        </svg>
                                                        <p class="tooltipclass">
                                                            <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                            To reduce uncertainty and increase your efficiency and chances of success, it is absolutely essential that you plan your preparation with great care. With effective planning comes motivation, productivity, satisfaction, and ultimately success. Go ahead and plan your week!
                                                        </p>
                                                    </span>
                                                </h3>
                                                <p class="dashSubtext">Plan your weekly tests for any chapters</p>
                                            </div>
                                        </div>
                                        <div class="planDetailBox">
                                            <div class="vLine"></div>
                                            <div class="selectedWeek">
                                                <p class="m-0">This week </p>
                                                <p class="m-0">{{date('jS M', strtotime('monday this week'))}} - {{date('jS M', strtotime('sunday this week'))}}</p>
                                            </div>
                                            <div class="plannedtestbox">
                                                <div class="plannedtest">
                                                    <p class="m-0 AttempType"> Planned Test</p>
                                                    <p class="m-0 testCount">{{$planned_test_cnt}}</p>
                                                </div>
                                                <div class="plannedtest">
                                                    <p class="m-0 AttempType">Attempted Test</p>
                                                    <p class="m-0 testCount">{{$attempted_test_cnt}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gotoPlanner">
                                        <a href="{{ url('/planner') }}">
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
                                            <a href="{{ url('/planner') }}" class="btn btn-common-transparent nobg">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                        <path d="M10 18.333a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 6.666v6.667M6.666 10h6.667" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
                                        } elseif ($val->subject_id == 2) {
                                            $backgroundclass = "physicsCard";
                                            $subject_name = "Physics";
                                        } elseif ($val->subject_id == 3) {
                                            $backgroundclass = "chemistryCard";
                                            $subject_name = "Chemistry";
                                        } elseif ($val->subject_id == 4) {
                                            $backgroundclass = "botanyCard";
                                            $subject_name = "Botany";
                                        } elseif ($val->subject_id == 146) {
                                            $backgroundclass = "zoologyCard";
                                            $subject_name = "Zoology";
                                        } else {
                                            $backgroundclass = "physicsCard";
                                            $subject_name = "";
                                        }
                                        ?>
                                        <div class="item">
                                            <div class="testPlanCard subCard {{$backgroundclass}}">
                                                <p class="m-0">{{$subject_name}}</p>
                                                <h3>{{$val->chapter_name}}</h3>
                                                <div class="proficiencyper"><small>Proficiency</small><br><b>{{ round($val->chapter_score, 0)}}%</b></div>
                                                <div class="attemptBtn">
                                                    @if($val->test_completed_yn=='Y')
                                                    <a href="" class="btn btn-common-attempted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <circle cx="10" cy="10" r="10" fill="#56B663" />
                                                            <path d="m5.5 10.5 3 3L14 8" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> Attempted</a>
                                                    @else
                                                    <form method="post" action="{{route('plannerExam',[$val->id])}}">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="79" height="68" viewBox="0 0 79 68" fill="none">
                                                        <path d="M58.975.373 19.797.166 39.18 11.111 58.975.373z" fill="url(#xbs2u8kpya)" />
                                                        <path d="M58.975.373 19.797.166 39.18 11.111 58.975.373z" fill="url(#pdstqsqm7b)" />
                                                        <path d="M78.562 33.415 58.56 44.773 39.178 11.112 58.973.373l19.589 33.042z" fill="url(#i6rag4r7fc)" />
                                                        <path d="M78.562 33.415 58.56 44.773 39.178 11.112 58.973.373l19.589 33.042z" fill="url(#s6bkns5edd)" />
                                                        <path d="M0 33.62 19.795.167 39.59 11.111 19.795 44.566 0 33.621z" fill="url(#ls4ucv1fue)" />
                                                        <path d="M0 33.62 19.795.167 39.59 11.111 19.795 44.566 0 33.621z" fill="url(#fpylq9jbjf)" />
                                                        <path d="M57.736 66.664V44.918L78.77 33.21 57.736 66.664z" fill="url(#xwkqjxxcog)" />
                                                        <path d="M57.736 66.664V44.918L78.77 33.21 57.736 66.664z" fill="url(#h5r5kftt9h)" />
                                                        <path d="M58.353 44.565H20v22.51l37.734-.414.62-22.096z" fill="url(#zy6p1fbq7i)" />
                                                        <path d="M58.353 44.565H20v22.51l37.734-.414.62-22.096z" fill="url(#sdlb5dxifj)" />
                                                        <path d="M20.001 67.076 0 33.621l20.001 10.945v22.51z" fill="url(#tg87y2hlqk)" />
                                                        <path d="M20.001 67.076 0 33.621l20.001 10.945v22.51z" fill="url(#4gvoyw248l)" />
                                                        <path d="M19.795 44.564 39.384 11.11l19.589 33.455H19.795z" fill="url(#62ss06008m)" />
                                                        <path d="M19.795 44.564 39.384 11.11l19.589 33.455H19.795z" fill="url(#bjzgc4z0ln)" />
                                                        <defs>
                                                            <linearGradient id="xbs2u8kpya" x1="39.489" y1=".373" x2="39.489" y2="11.111" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#D9D9D9" />
                                                                <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                                                            </linearGradient>
                                                            <linearGradient id="pdstqsqm7b" x1="39.489" y1=".373" x2="39.489" y2="11.111" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#43E1CE" />
                                                                <stop offset="1" stop-color="#2899CA" />
                                                            </linearGradient>
                                                            <linearGradient id="i6rag4r7fc" x1="59.076" y1=".58" x2="59.076" y2="44.773" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#D9D9D9" />
                                                                <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                                                            </linearGradient>
                                                            <linearGradient id="s6bkns5edd" x1="59.076" y1=".58" x2="59.076" y2="44.773" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#43E1CE" />
                                                                <stop offset="1" stop-color="#2899CA" />
                                                            </linearGradient>
                                                            <linearGradient id="ls4ucv1fue" x1="19.795" y1=".166" x2="19.795" y2="44.566" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#D9D9D9" />
                                                                <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                                                            </linearGradient>
                                                            <linearGradient id="fpylq9jbjf" x1="19.795" y1=".166" x2="19.795" y2="44.566" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#43E1CE" />
                                                                <stop offset="1" stop-color="#2899CA" />
                                                            </linearGradient>
                                                            <linearGradient id="xwkqjxxcog" x1="68.252" y1="33.209" x2="68.252" y2="66.664" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#D9D9D9" />
                                                                <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                                                            </linearGradient>
                                                            <linearGradient id="h5r5kftt9h" x1="68.252" y1="33.209" x2="68.252" y2="66.664" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#43E1CE" />
                                                                <stop offset="1" stop-color="#2899CA" />
                                                            </linearGradient>
                                                            <linearGradient id="zy6p1fbq7i" x1="39.176" y1="44.565" x2="39.176" y2="67.074" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#D9D9D9" />
                                                                <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                                                            </linearGradient>
                                                            <linearGradient id="sdlb5dxifj" x1="39.176" y1="44.565" x2="39.176" y2="67.074" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#43E1CE" />
                                                                <stop offset="1" stop-color="#2899CA" />
                                                            </linearGradient>
                                                            <linearGradient id="tg87y2hlqk" x1="10.207" y1="34.034" x2="10.207" y2="67.489" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#D9D9D9" />
                                                                <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                                                            </linearGradient>
                                                            <linearGradient id="4gvoyw248l" x1="10.207" y1="34.034" x2="10.207" y2="67.489" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#43E1CE" />
                                                                <stop offset="1" stop-color="#2899CA" />
                                                            </linearGradient>
                                                            <linearGradient id="62ss06008m" x1="39.384" y1="11.109" x2="39.384" y2="44.564" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#D9D9D9" />
                                                                <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                                                            </linearGradient>
                                                            <linearGradient id="bjzgc4z0ln" x1="39.384" y1="11.109" x2="39.384" y2="44.564" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#43E1CE" />
                                                                <stop offset="1" stop-color="#2899CA" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
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
                                                Progress journey
                                                <span class="tooltipmain">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                        <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                        </g>
                                                    </svg>
                                                    <p class="tooltipclass">
                                                        <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                        Mapping your progress journey against an ideal path lets you draw valuable insights about the rate at which you are progressing with respect to the ideal path that will lead you to success. It will help you judge whether you are keeping pace or lagging behind, for you to take corrective action. Pick up your pace!
                                                    </p>
                                                </span>
                                            </h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="auto" viewBox="0 0 271 191" fill="none">
                                                <path stroke="#E0E0E0" d="M1.5 8v183M2 190.5h258M3 145.5h256M3 99.5h256M3 53.5h256M3 7.5h256" />
                                                <path transform="matrix(.81923 -.57346 .30416 .95262 1 191)" stroke="#05D6A1" stroke-width="2" stroke-linecap="round" d="M1-1h327.577" />
                                                <path d="m2 190 25.532-37.903a31 31 0 0 1 25.711-13.681h13.514a31 31 0 0 0 25.71-13.681l11.353-16.853a31.001 31.001 0 0 1 25.711-13.681h22.173a30.999 30.999 0 0 0 17.618-5.493L263 24" stroke="#F7758F" stroke-width="2" stroke-linecap="round" />
                                            </svg> -->
                                                <div class="progress_journey_chart">
                                                    <canvas id="progressJourny_graph"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                @if (isset($ideal) && !empty($ideal))
                                                <div class="graphDetail w-100">
                                                    <div class="yourPacebox">
                                                        <p class="graphTitle">Ideal Pace</p>
                                                        <p>
                                                            <span class="weekCountline myscore"></span>
                                                            <span class="weekCount">{{round($ideal_avg)}}</span>
                                                            <span class="weekText">chapters per week</span>
                                                        </p>
                                                    </div>
                                                    <div class="yourPacebox">
                                                        <p class="graphTitle">Your Pace</p>
                                                        <p>
                                                            <span class="weekCountline colorHline"></span>
                                                            <span class="weekCount">{{round($your_place_avg)}}</span>
                                                            <span class="weekText">chapters per week</span>
                                                        </p>
                                                    </div>
                                                    @if(round($ideal_avg) > round($your_place_avg))
                                                    <div class="note">
                                                        <b>Note:</b> To achieve the ideal pace you have to complete {{(round($ideal_avg)-round($your_place_avg))}} chapters this week
                                                    </div>
                                                    @endif
                                                </div>
                                                @else
                                                <div class="graphDetailempty w-100">
                                                    <p>To achieve this pace, you must begin attempting chapter-wise questions and increase your accuracy</p>
                                                    <a href="{{ url('/exam_custom') }}" class="btn btn-common-transparent width150 nobg">Attempt Now</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="journeyGraph cardWhiteBg">
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
                                                        <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                        This chart will give insights and a deep understanding of your ongoing preparation, and your improvement over time. An increasing trend is what you should ideally be maintaining. Go uptrend!
                                                    </p>
                                                </span>
                                            </h3>
                                        </div>
                                        <div class="journeyBoxcontainer">
                                            <div class="graphimg">
                                                <div class="progress_journey_chart">
                                                    <canvas id="trend_graph"></canvas>
                                                </div>
                                            </div>
                                            @if (!empty($trendResponse))
                                            <div class="graphDetail">
                                                <div class="dropbox">
                                                    <div class="customDropdown dropdown">
                                                        <input class="text-box markstrend" type="text" id="markstrend_graph" placeholder="All Test" readonly>
                                                        <div class="options" style=" overflow-y: auto; height: 303%; ">
                                                            <div class="active markstrend" onclick="show('All Test', 'all')">All Test</div>
                                                            <div class="active markstrend" onclick="show('Mock Test', 'Mocktest')">Mock Test</div>
                                                            <div class="markstrend" onclick="show('Practice Test', 'Assessment')">Practice Test</div>
                                                            <div class="markstrend" onclick="show('Test Series', 'Test-Series')">Test Series</div>
                                                            <div class="markstrend" onclick="show('Live', 'Live')">Live </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="yourPacebox scoretype">
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
                                                <p>To achieve this pace, you must begin attempting chapter-wise questions and increase your accuracy</p>
                                                <div class="h">
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
                                                <a href="{{ url('/exam_custom') }}" class="btn btn-common-transparent width150 nobg">Attempt Now</a>
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
        <div class="modalcenter">
            <div class="modal-dialog">
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
        <div class="modalcenter">
            <div class="modal-dialog">
                <div class="modal-content strengthmodal_content">
                    <div class="modal-header1">
                        <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="intraction_text_q1">Q2</div>
                        <div class="intraction_text_strength">Needs focus</div>
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
        <div class="modalcenter">
            <div class="modal-dialog">
                <div class="modal-content strengthmodal_content">
                    <div class="modal-header1">
                        <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="intraction_text_q1">Q3</div>
                        <div class="intraction_text_strength">Hopeful</div>
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
        <div class="modalcenter">
            <div class="modal-dialog">
                <div class="modal-content strengthmodal_content">
                    <div class="modal-header1">
                        <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                    </div>
                    <div class="modal-body">
                        <div class="intraction_text_q1">Q4</div>
                        <div class="intraction_text_strength">Weak</div>
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
    <div class="loader-block" style="display:none;">
        <img src="{{URL::asset('public/after_login/new_ui/images/loader.gif')}}">
    </div>
    <!-- Footer Section -->
    @include('afterlogin.layouts.footer_new')
    <!-- footer Section end  -->
    @php
    $trend_stu_score=$trend_avg_score=$trend_max_score=$aWeeks = $weekdates=[];
    $i = 1;
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
    $your_place = isset($your_place) ? json_encode($your_place) : [];
    $progress_cat = isset($progress_cat) ? json_encode($progress_cat) : [];
    $aWeeks= array_values($aWeeks);
    @endphp
    <script>
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


        });
        $("span.tooltipmain p.tooltipclass span").click(function() {
            $(this).parent("p").hide();
            $(this).parent("p").removeClass('show');
        });
    });
    $(document).on('click', function(e) {
        var card_opened = $('.tooltipclass').hasClass('show');
        if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
            $('.tooltipclass').hide();
            $('.tooltipclass').removeClass('show');
        }
        var dropdown_open =$('.customDropdown').hasClass('active');
        if (!$(e.target).is('.markstrend') && dropdown_open === true) {
            $('.customDropdown').removeClass('active');
        }
    });
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
                nav: false,
                stagePadding: 40,
                margin: 0,
                loop: true,
            },
            600: {
                items: 3
            },
            1000: {
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
            responsive: true,
            elements: {
                point: {
                    radius: 0
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
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                }

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
            responsive: true,
            elements: {
                point: {
                    radius: 0
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
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    },
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


    /* $('#markstrend_graph').change(function() {
        var value = this.value;
        alert(value);
    }); */

    </script>
    <script>
    function show(value, type) {
        document.querySelector(".text-box").value = value;

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



    let dropdown = document.querySelector(".customDropdown")
    dropdown.onclick = function() {
        dropdown.classList.toggle("active")
    }

    </script>
    @endsection
