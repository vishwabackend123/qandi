@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
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
                        <div class="verifiaction-link" style="display:none">
                            <p>A verification link has been sent to <b>Sakshi@gmail.com,</b> please click the link to get your account verified <a href="#">Resend</a></p>
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
                                        This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                    </p>
                                </span>
                            </h3>
                            <div class="myqTodayGraphSec">
                                <div class="mq_circle_percent" data-percent="75">
                                    <div class="mq_circle_inner">
                                        <div class="mq_round_per"></div>
                                    </div>
                                </div>
                                <div class="textblock">
                                    <h6 class="dashSubHeading">You are doing great!</h6>
                                    <p class="dashSubtext">Attempt more tests to improve your score.</p>
                                    <a href="javascript:;" class="commmongreenLink">See analytics <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg></span></a>
                                </div>
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

                                <div class="subjectScoreBlock">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="SubjectscorePannel">
                                                <div class="subjextscoreLeft">
                                                    <h6>Physics</h6>
                                                    <div class="d-flex justify-content-between">
                                                        <h4>38%</h4>
                                                        <div class="circle_percent mt-3" data-percent="38">
                                                            <div class="circle_inner">
                                                                <div class="round_per"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="SubjectscorePannel">
                                                <div class="subjextscoreLeft">
                                                    <h6>Chemistry</h6>
                                                    <div class="d-flex justify-content-between">
                                                        <h4>64%</h4>
                                                        <div class="circle_percent mt-3 orangegraph" data-percent="64">
                                                            <div class="circle_inner">
                                                                <div class="round_per"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="SubjectscorePannel mb-0">
                                                <div class="subjextscoreLeft ">
                                                    <h6>Mathematics</h6>
                                                    <div class="d-flex justify-content-between">
                                                        <h4>82%</h4>
                                                        <div class="circle_percent mt-3 greengraph" data-percent="82">
                                                            <div class="circle_inner">
                                                                <div class="round_per"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        <button class="btn btn-common-transparent nobg">Attempt Now</button>
                                    </div>
                                </div>

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
                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                        </p>
                                    </span>
                                </h3>
                                <a href="javascript:;" class="commmongreenLink mb-2">Task Center <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg></span></a>
                            </div>
                            <div class="fullbodyBox">
                                <div class="leftBox">
                                    <h4>Full Body Scan Test</h4>
                                    <p>to assess your preparedness and begin to improve it</p>
                                    <button class="btn btn-common-white">Attempt Now</button>
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
                                                    <span class="codevalue">0</span><span>/</span><span>0</span>
                                                </div>
                                            </div>
                                            <p class="dashSubtext mt-2">Please attempt the Full body scan test,
                                                so that we could generate tasks for you, based on your proficiency levels.</p>
                                            <div class="tasklisting">
                                                <ul class="commonlisting">
                                                    <li>
                                                        <div class="tasklistleft">
                                                            <h6>Task 1</h6>
                                                            <h4>Evaluation Skills</h4>
                                                            <h5>10 Questions | 15 mins</h5>
                                                        </div>
                                                        <div class="tasklistbtn">
                                                            <button class="btn btn-common-transparent nobg">Take test</button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="tasklistleft">
                                                            <h6>Task 1</h6>
                                                            <h4>Evaluation Skills</h4>
                                                            <h5>10 Questions | 15 mins</h5>
                                                        </div>
                                                        <div class="tasklistbtn">
                                                            <button class="btn btn-common-transparent nobg">Take test</button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="tasklistleft">
                                                            <h6>Task 1</h6>
                                                            <h4>Evaluation Skills</h4>
                                                            <h5>10 Questions | 15 mins</h5>
                                                        </div>
                                                        <div class="tasklistbtn">
                                                            <button class="btn btn-common-transparent nobg">Take test</button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="tasklistleft">
                                                            <h6>Task 1</h6>
                                                            <h4>Evaluation Skills</h4>
                                                            <h5>10 Questions | 15 mins</h5>
                                                        </div>
                                                        <div class="tasklistbtn">
                                                            <button class="btn btn-common-transparent nobg">Take test</button>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="moreTaskLink">
                                                    <a href="javascript:;" class="commmongreenLink mb-2">3 more tasks <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="weekly" class=" tab-pane">
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
                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                        </p>
                                    </span>
                                </h3>
                                <p class="dashSubtext">Supporting text for better interaction on this section</p>
                            </div>
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
                                                <div class="myqbottomSec">
                                                    <h3>12 <span class="topictext">Topics</span></h3>
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
                                            <a href="#needfocusmodal">
                                                <div class="myqinner">
                                                    <h6>Q2</h6>
                                                    <h5>Needs focus</h5>
                                                    <p>Give a little attention to these topics and take another step towards perfection. </p>
                                                </div>
                                                <div class="myqbottomSec">
                                                    <h3>23 <span class="topictext">Topics</span></h3>
                                                    <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="myqmatPannel myqcolor3">
                                            <a href="#hopefulmodal">
                                                <div class="myqinner">
                                                    <h6>Q3</h6>
                                                    <h5>Hopeful </h5>
                                                    <p>Topics that are hurdles in your journey. Do not save them for the last. </p>
                                                </div>
                                                <div class="myqbottomSec">
                                                    <h3>12 <span class="topictext">Topics</span></h3>
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
                                            <a href="#weakhmodal">
                                                <div class="myqinner">
                                                    <h6>Q4</h6>
                                                    <h5>Weak </h5>
                                                    <p>Find your weak topics here. Work hard to move these topics to other quadrants.</p>
                                                </div>
                                                <div class="myqbottomSec">
                                                    <h3>12 <span class="topictext">Topics</span></h3>
                                                    <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
                                        <button class="btn btn-common-transparent nobg">Attempt Now</button>
                                    </div>
                                </div>
                            </div>
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
                                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
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
                                                <p class="m-0">23rd May - 27th May</p>
                                            </div>
                                            <div class="plannedtestbox">
                                                <div class="plannedtest">
                                                    <p class="m-0 AttempType"> Planned Test</p>
                                                    <p class="m-0 testCount">0</p>
                                                </div>
                                                <div class="plannedtest">
                                                    <p class="m-0 AttempType">Attempted Test</p>
                                                    <p class="m-0 testCount">0</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gotoPlanner">
                                        <a href="">
                                            <span>Go to Planner</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
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
                                            <button class="btn btn-common-transparent nobg">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                        <path d="M10 18.333a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 6.666v6.667M6.666 10h6.667" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                <span>Add
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="allSubslider">
                                    <div class="dashborarSlider owl-carousel owl-theme">
                                        <div class="item">
                                            <div class="testPlanCard subCard physicsCard">
                                                <p class="m-0">Physics</p>
                                                <h3>Law of motion</h3>
                                                <div class="proficiencyper"><small>Proficiency</small><br><b>60%</b></div>
                                                <div class="attemptBtn">
                                                    <a href="" class="btn btn-common-green">Attempt Now</a>
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
                                        <div class="item">
                                            <div class="testPlanCard subCard mathCard">
                                                <p class="m-0">MATHEMATICS</p>
                                                <h3>Binomial Theorem</h3>
                                                <div class="proficiencyper"><small>Proficiency</small><br><b>60%</b></div>
                                                <div class="attemptBtn">
                                                    <a href="" class="btn btn-common-green">Attempt Now</a>
                                                </div>
                                                <div class="subIcon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="78" height="63" viewBox="0 0 78 63" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)" />
                                                        <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E" />
                                                        <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1" />
                                                        <path d="M15.12 58.838h20" stroke="#38B87B" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z" />
                                                        <path stroke="#38B87B" d="M50.873 59.018h26" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z" />
                                                        <path d="M4.71 45.103v-9.38" stroke="#38B87B" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z" />
                                                        <path stroke="#38B87B" d="M4.891 18.996V1.093" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z" />
                                                        <defs>
                                                            <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#3ABFB0" />
                                                                <stop offset="1" stop-color="#37B66B" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="testPlanCard subCard chemistryCard">
                                                <p class="m-0">MATHEMATICS</p>
                                                <h3>Binomial Theorem</h3>
                                                <div class="proficiencyper"><small>Proficiency</small><br><b>60%</b></div>
                                                <div class="attemptBtn">
                                                    <a href="" class="btn btn-common-green">Attempt Now</a>
                                                </div>
                                                <div class="subIcon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="78" height="63" viewBox="0 0 78 63" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)" />
                                                        <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E" />
                                                        <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1" />
                                                        <path d="M15.12 58.838h20" stroke="#38B87B" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z" />
                                                        <path stroke="#38B87B" d="M50.873 59.018h26" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z" />
                                                        <path d="M4.71 45.103v-9.38" stroke="#38B87B" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z" />
                                                        <path stroke="#38B87B" d="M4.891 18.996V1.093" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z" />
                                                        <defs>
                                                            <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#3ABFB0" />
                                                                <stop offset="1" stop-color="#37B66B" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="testPlanCard subCard physicsCard">
                                                <p class="m-0">Physics</p>
                                                <h3>Law of motion</h3>
                                                <div class="proficiencyper"><small>Proficiency</small><br><b>60%</b></div>
                                                <div class="attemptBtn">
                                                    <a href="" class="btn btn-common-green">Attempt Now</a>
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
                                        <div class="item">
                                            <div class="testPlanCard subCard mathCard">
                                                <p class="m-0">MATHEMATICS</p>
                                                <h3>Binomial Theorem</h3>
                                                <div class="proficiencyper"><small>Proficiency</small><br><b>60%</b></div>
                                                <div class="attemptBtn">
                                                    <a href="" class="btn btn-common-green">Attempt Now</a>
                                                </div>
                                                <div class="subIcon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="78" height="63" viewBox="0 0 78 63" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)" />
                                                        <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E" />
                                                        <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1" />
                                                        <path d="M15.12 58.838h20" stroke="#38B87B" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z" />
                                                        <path stroke="#38B87B" d="M50.873 59.018h26" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z" />
                                                        <path d="M4.71 45.103v-9.38" stroke="#38B87B" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z" />
                                                        <path stroke="#38B87B" d="M4.891 18.996V1.093" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z" />
                                                        <defs>
                                                            <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#3ABFB0" />
                                                                <stop offset="1" stop-color="#37B66B" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="testPlanCard subCard chemistryCard">
                                                <p class="m-0">MATHEMATICS</p>
                                                <h3>Binomial Theorem</h3>
                                                <div class="proficiencyper"><small>Proficiency</small><br><b>60%</b></div>
                                                <div class="attemptBtn">
                                                    <a href="" class="btn btn-common-green">Attempt Now</a>
                                                </div>
                                                <div class="subIcon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="78" height="63" viewBox="0 0 78 63" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)" />
                                                        <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E" />
                                                        <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1" />
                                                        <path d="M15.12 58.838h20" stroke="#38B87B" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z" />
                                                        <path stroke="#38B87B" d="M50.873 59.018h26" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z" />
                                                        <path d="M4.71 45.103v-9.38" stroke="#38B87B" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z" />
                                                        <path stroke="#38B87B" d="M4.891 18.996V1.093" />
                                                        <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z" />
                                                        <defs>
                                                            <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#3ABFB0" />
                                                                <stop offset="1" stop-color="#37B66B" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                    This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
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
                                                <canvas id="myChartProgress"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="graphDetail w-100">
                                                <div class="yourPacebox">
                                                    <p class="graphTitle">Ideal Pace</p>
                                                    <p>
                                                        <span class="weekCountline colorHline"></span>
                                                        <span class="weekCount">12</span>
                                                        <span class="weekText">chapters per week</span>
                                                    </p>
                                                </div>
                                                <div class="yourPacebox">
                                                    <p class="graphTitle">Your Pace</p>
                                                    <p>
                                                        <span class="weekCountline colorHline"></span>
                                                        <span class="weekCount">8</span>
                                                        <span class="weekText">chapters per week</span>
                                                    </p>
                                                </div>
                                                <div class="note">
                                                    <b>Note:</b> To achieve the ideal pace you have to complete 2 chapters this week
                                                </div>
                                            </div>
                                            <!-- <div class="graphDetailempty">
                                                <p>To achieve this pace, you must begin attempting chapter-wise questions and increase your accuracy</p>
                                                <button class="btn btn-common-transparent width150 nobg">Attempt Now</button>
                                            </div> -->
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
                                                    This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                                </p>
                                            </span>
                                        </h3>
                                    </div>
                                    <div class="journeyBoxcontainer">
                                        <div class="graphimg">
                                            <div class="graphholder">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="auto" viewBox="0 0 271 191" fill="none">
                                                    <path stroke="#E0E0E0" d="M1.5 8v183M2 190.5h258M3 145.5h256M3 99.5h256M3 53.5h256M3 7.5h256" />
                                                    <path transform="matrix(.81923 -.57346 .30416 .95262 1 191)" stroke="#05D6A1" stroke-width="2" stroke-linecap="round" d="M1-1h327.577" />
                                                    <path d="m2 190 25.532-37.903a31 31 0 0 1 25.711-13.681h13.514a31 31 0 0 0 25.71-13.681l11.353-16.853a31.001 31.001 0 0 1 25.711-13.681h22.173a30.999 30.999 0 0 0 17.618-5.493L263 24" stroke="#F7758F" stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                            </div>

                                        </div>
                                        <div class="graphDetail">
                                            <div class="dropbox">
                                                <div class="customDropdown dropdown">
                                                    <input class="text-box" type="text" placeholder="Mocktest" readonly>
                                                    <div class="options">
                                                        <div onclick="show('My score')">My score</div>
                                                        <div onclick="show('Peer average')">Peer average</div>
                                                        <div onclick="show('Peer average')">Top score</div>
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
                                            </div>
                                            <button class="btn btn-common-transparent width150 nobg">Attempt Now</button>
                                        </div>
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
                            Supporting text for better interaction on this section. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
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
    $trend_stu_scroe=$trend_avg_scroe=$trend_max_scroe=$aWeeks = $weekdates=[];
    $i = 1;
    if (!empty($trendResponse)) {
    foreach ($trendResponse as $key => $trend) {
    $week = "W" . $i;
    array_push($aWeeks, $week);
    $timestamp = strtotime( $trend['date']);
    $last_date=date("j M", $timestamp);
    $first_date = date('j M', strtotime('-6 days', $timestamp));
    array_push($weekdates, $first_date."-".$last_date);
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
    $weekdates_json = isset($weekdates) ? json_encode($weekdates) : [];
    $stu_scroe_json = isset($trend_stu_scroe) ? json_encode($trend_stu_scroe) : [];
    $avg_scroe_json = isset($trend_avg_scroe) ? json_encode($trend_avg_scroe) : [];
    $max_scroe_json = isset($trend_max_scroe) ? json_encode($trend_max_scroe) : [];
    $ideal = isset($ideal) ? json_encode($ideal) : [];
    $your_place = isset($your_place) ? json_encode($your_place) : [];
    $progress_cat = isset($progress_cat) ? json_encode($progress_cat) : [];
    @endphp

    <script>
        /* Score Pie Chart */
        Highcharts.chart('scorecontainer', {
            chart: {
                height: 160,
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false,
                spacingTop: 0,
                spacingBottom: 0,
                spacingRight: 0,
            },
            title: {
                text: '<span style=" font: normal normal 200 60px/80px Manrope; letter-spacing: 0px; color: #21ccff;">{{$corrent_score_per}}</span> <br><span style=" font: normal normal normal 14px/22px Manrope;letter-spacing: 0px;color: #21ccff;"> / 100 </span>',
                align: 'center',
                verticalAlign: 'middle',
                y: 60
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
                },
                series: {
                    enableMouseTracking: false
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
                        color: '#d0f3ff'
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
                categories: <?php echo $weekdates_json; ?>,

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
                formatter: function(tooltip) {
                    if (this.x == 'W5') {
                        var header = `<span style="color: Black;">${this.x}(Current Week)</span><br/>`;
                    } else {
                        var header = `<span style="color: Black;">${this.x}</span><br/>`;
                    }

                    return header + (tooltip.bodyFormatter(this.points).join(''))
                },
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
            $(".dashboard-cards-block .bg-white>small>img").click(function(event) {
                event.stopPropagation();
                $(".dashboard-cards-block .bg-white>small p>span").each(function() {
                    $(this).parent("p").hide();
                    $(this).parent("p").removeClass('show');
                });
                $(this).siblings("p").show();
                $(this).siblings("p").addClass('show');

            });
            $(".dashboard-cards-block .bg-white>small p>span").click(function() {
                $(this).parent("p").hide();
            });
        });
        $(document).on('click', function(e) {
            var card_opened = $('.tooltipclass').hasClass('show');
            if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
                $('.tooltipclass').hide();
            }
        });
    </script>
    <script language="JavaScript">
        $(document).ready(function() {
            var title = {
                text: ''
            };
            var subtitle = {
                text: ''
            };
            var xAxis = {
                title: {
                    text: 'Weeks'
                },
                categories: <?php echo $progress_cat; ?>,
                labels: {
                    useHTML: true,
                    rotation: 0,
                }
            };
            var yAxis = {
                title: {
                    text: 'No of Chapters'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            };
            var tooltip = {
                valueSuffix: ''
            }
            var legend = {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom',
                bottom: '-20px',
                floating: false,
                borderWidth: 0,
            };
            var series = [{
                    name: 'Ideal Pace',
                    data: <?php echo $ideal; ?>, //[0.0, 5.0, 10.0],
                    color: '#db2f36'
                },
                {
                    name: 'Your Pace',
                    data: <?php echo $your_place; ?>, //[0, 2, 5.7],
                    color: '#21ccff'
                }
            ];
            var credits = {
                enabled: false
            };
            var exporting = {
                enabled: false
            };
            var plotOptions = {

                series: {
                    events: {
                        legendItemClick: function() {
                            return false;
                        }
                    }

                }

            };
            var json = {};
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.series = series;
            json.credits = credits;
            json.exporting = exporting;
            json.plotOptions = plotOptions;
            $('.progressChart').highcharts(json);
            $('.progressChartExpend').highcharts(json);
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
        function show(value) {
            document.querySelector(".text-box").value = value;
        }

        let dropdown = document.querySelector(".customDropdown")
        dropdown.onclick = function() {
            dropdown.classList.toggle("active")
        }
    </script>



<script>
 const labels = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
];
const data = {
  labels: labels,
  datasets: [{
    label: 'My First dataset',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [0, 10, 5, 2, 20],
  },
  {
    label: 'My First dataset',
    backgroundColor: 'green',
    borderColor: 'green',
    data: [0, 20, 10, 10, 30],
  }]
};

  const config = {
    type: 'line',
    data: data,
    options: {
        plugins: {
            legend: {
                display: false
            }
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

  const myChart = new Chart(
    document.getElementById('myChartProgress'),
    config
  );

</script>
 




    @endsection