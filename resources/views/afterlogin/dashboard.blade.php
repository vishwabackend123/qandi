@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')
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
                <p class="rating-headline mt-5 mb-4"> How well do you generally perform in these subjects?</p>
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
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper dashbaordContainer">
        <div class="dashboardTopSection">
            <div  class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                         <div class="commondashboardTop">
                              <h3 class="boxheading">MyQ Today
                                  <span class="tooltipmain">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"> <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"/></g></svg>
                                  <p class="tooltipclass">
                                   <span ><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                     This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                  </p>
                              </span>
                          </h3>
                          <div class="myqTodayGraphSec">
                             <div class="graphBlock"></div>
                              <div class="textblock">
                                  <h6 class="dashSubHeading">You are doing great!</h6>
                                  <p class="dashSubtext">Attempt more tests to improve your score.</p>
                                  <a href="javascript:;" class="commmongreenLink">See analytics <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                              </div>
                          </div>
                          <div class="commonWhiteBox mt-4">
                             <div class="boxHeadingBlock">
                                    <h3 class="boxheading">Subject Performance
                                        <span class="tooltipmain">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"> <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"/></g></svg>
                                        <p class="tooltipclass">
                                        <span ><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
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
                                                    <div class="circle_percent mt-3" data-percent="75">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                             <div class="subjectGarph">
                                                
                                              
                                             </div> 
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="SubjectscorePannel">
                                             <div class="subjextscoreLeft">
                                                <h6>Chemistry</h6>
                                                <div class="d-flex justify-content-between">
                                                    <h4>64%</h4>
                                                    <div class="circle_percent mt-3" data-percent="75">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div> 
                                             </div>
                                             <div class="subjectGarph">
                                             </div> 
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="SubjectscorePannel">
                                             <div class="subjextscoreLeft">
                                                <h6>Mathematics</h6>
                                                <div class="d-flex justify-content-between">
                                                    <h4>82%</h4>
                                                    <div class="circle_percent mt-3" data-percent="75">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div> 
                                             </div>
                                             <div class="subjectGarph">
                                             </div> 
                                         </div>
                                     </div>
                                 </div>
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="col-lg-4">
                          <div class="commonWhiteBox mt-4">
                             <div class="boxHeadingBlock flexblock">
                                    <h3 class="boxheading">My Task Center
                                        <span class="tooltipmain">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"> <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"/></g></svg>
                                        <p class="tooltipclass">
                                        <span ><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                        </p>
                                    </span>
                                </h3>
                                <a href="javascript:;" class="commmongreenLink mb-2">Task Center <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path></svg></span></a>
                             </div>
                            <div class="fullbodyBox">
                                 <div class="leftBox">
                                 <h4>Full Body Scan Test</h4>
                                   <p>to assess your preparedness and begin to improve it</p>
                                    <button class="btn btn-common-white">Attempt Now</button>
                                 </div>
                                 <div class="rightImgBox">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="107" height="105" viewBox="0 0 107 105" fill="none">
                                            <rect y="17.496" width="79" height="101" rx="2" transform="rotate(-12.796 0 17.496)" fill="#D4ECD8"/>
                                            <rect x="10.203" y="7.494" width="79" height="101" rx="2" fill="#EDFFEF"/>
                                            <rect x="16.203" y="50.494" width="10" height="10" rx="3.125" fill="#56B663"/>
                                            <path d="m19.328 55.494 1.25 1.25 2.5-2.5" stroke="#E0F6E3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <rect x="16.203" y="70.494" width="10" height="10" rx="3.125" fill="#56B663"/>
                                            <path d="m19.328 75.494 1.25 1.25 2.5-2.5" stroke="#E0F6E3" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path stroke="#B2D9B6" stroke-width="2" stroke-linecap="round" d="M31.203 51.494h15M31.203 71.494h15M18.203 27.494h42M18.203 35.494h29M66.203 27.494h17M31.203 58.494h26M31.203 78.494h26"/>
                                            <path d="m73.418 88.26-10.084-6.504-2.05 11.02c-.331 1.776 1.674 3.045 3.137 1.988l8.997-6.503z" fill="#56B663"/>
                                            <path d="M94.23 33.856a4 4 0 0 1 5.53-1.194l3.361 2.169a3.999 3.999 0 0 1 1.193 5.53L73.418 88.26l-10.085-6.505 30.897-47.9z" fill="#4A9453"/>
                                            <path d="M94.23 33.856a4 4 0 0 1 5.53-1.194l3.361 2.169a3.999 3.999 0 0 1 1.193 5.53l-5.42 8.403-10.084-6.505 5.42-8.403z" fill="#E0F6E3"/>
                                            <path fill="#56B663" d="m90.436 39.738 10.084 6.505-3.252 5.042-10.084-6.505z"/>
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
                                                              <button class="btn btn-common-transparent nobg" >Take test</button>
                                                          </div>
                                                        </li>
                                                        <li>
                                                            <div class="tasklistleft">
                                                             <h6>Task 1</h6>
                                                             <h4>Evaluation Skills</h4>
                                                             <h5>10 Questions | 15 mins</h5>
                                                          </div>
                                                          <div class="tasklistbtn">
                                                              <button class="btn btn-common-transparent nobg" >Take test</button>
                                                          </div>
                                                        </li><li>
                                                            <div class="tasklistleft">
                                                             <h6>Task 1</h6>
                                                             <h4>Evaluation Skills</h4>
                                                             <h5>10 Questions | 15 mins</h5>
                                                          </div>
                                                          <div class="tasklistbtn">
                                                              <button class="btn btn-common-transparent nobg" >Take test</button>
                                                          </div>
                                                        </li><li>
                                                            <div class="tasklistleft">
                                                             <h6>Task 1</h6>
                                                             <h4>Evaluation Skills</h4>
                                                             <h5>10 Questions | 15 mins</h5>
                                                          </div>
                                                          <div class="tasklistbtn">
                                                              <button class="btn btn-common-transparent nobg" >Take test</button>
                                                          </div>
                                                        </li>
                                                     </ul>
                                                </div>
                                        </div>
                                        <div id="weekly" class=" tab-pane">
                                        </div>
                                    </div>
                                </div>  
                            </div>
                          </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        
 

        <div class="container-fluid pt-0  dashboard-cards-block common-cards-boxshadow">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-7  col-sm-12">
                    <div class="bg-white shadow-lg">
                        <small>
                            <!-- <i class="fa  fa-info"></i> -->
                            <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                            <p class="tooltipclass">
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                <!-- <label>About MyQ Today</label> -->
                                A score derived from the detailed analysis of your test patterns that gives a clear understanding of your
                                 current level of preparation in comparison to an ideal one. Measure your real-time probability of reaching 
                                 the goal with your current pattern of preparation. Set your goal!
                            </p>
                        </small>
                        <div class="row h-100">
                            <div class="col-lg-7 col-sm-12 col-md-7 padd-right-0">
                                <div style="padding:20px 0 0;">
                                    <div class="prgress-i-txt px-3 mb-1" style="padding-left:30px!important;">
                                        <span class="progress_text">MyQ Today</span>
                                    </div>
                                    <div class="d-flex justify-content-center flex-column h-100 ">
                                        <div class="" id="scorecontainer"></div>
                                        <ul class="live-test">
                                            <li class="dashbaordmargin">
                                                <span class="last-live-test" style="vertical-align:middle;"></span>MyQ Today Score
                                            </li>
                                            <!-- <li>
                                                <span class="pre-test"></span>Previous Test
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12  text-center seeAnico" style="padding-left:0;">
                                <div class="analytics-thumbnail-bg h-100">
                                    <div class="button-sec mb-4 mt-3"><a href="{{route('overall_analytics')}}" title="See Analytics">See Analytics</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-5 col-sm-12">
                    <div class="bg-white shadow-lg py-5 ps-3 pe-1 Subject_box12">
                        <small>
                            <!-- <i class="fa  fa-info"></i> -->
                            <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                            <p class="tooltipclass">
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                            </p>
                        </small>
                        <div class="prgress-i-txt px-0">
                            <span class="progress_text">Subject Performance</span>
                        </div>
                        <div class="subject-scroll">
                            <ul class="course-star">
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
                                    <span class="">{{round($sub['score'])}}%</span>
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
                <div class="col-xl-5  col-md-12 col-sm-12">
                    <div class="bg-white shadow-lg py-5 myqMatrix-card">
                        <span class="progress_text" style="padding-left: 15px;">MyQ Matrix</span>
                        <small>
                            <!-- <i class="fa  fa-info"></i> -->
                            <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                            <p class="tooltipclass">
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                A matrix created to analyse your attempts in various topics over time and sort them into your areas of strengths and weaknesses. <br /> This data will keep on changing as you progress and diligently work on your identified and analysed weaknesses and strengths. It will also make visible those topics that can become your strength with a little more effort on your part. Align your preparation now!
                            </p>
                        </small>
                        <div class="row align-items-xl-start align-items-center">
                            <div class="col-md-6">
                                <div class="topics-box">
                                    <b>Q2</b>
                                    <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                            @if(isset($myq_matrix[1]))
                                            <b>{{ str_pad($myq_matrix[1], 2, '0', STR_PAD_LEFT);}}</b>
                                            @else
                                            <b>00</b>
                                            @endif
                                            <small>Topic</small>
                                        </span>
                                    </a>
                                </div>
                                <div class="topics-box">
                                    <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                            @if(isset($myq_matrix[0]))
                                            <b>{{ str_pad($myq_matrix[0], 2, '0', STR_PAD_LEFT);}}</b>
                                            @else
                                            <b>00</b>
                                            @endif
                                            <small>Topic</small>
                                        </span></a>
                                    <b style="margin:0 0 0 6px">Q1</b>
                                </div>
                                <div class="topics-box">
                                    <b>Q3</b>
                                    <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                            @if(isset($myq_matrix[2]))
                                            <b>{{ str_pad($myq_matrix[2], 2, '0', STR_PAD_LEFT);}}</b>
                                            @else
                                            <b>00</b>
                                            @endif
                                            <small>Topic</small>
                                        </span></a>
                                </div>
                                <div class="topics-box">
                                    <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                            @if(isset($myq_matrix[3]))
                                            <b>{{ str_pad($myq_matrix[3], 2, '0', STR_PAD_LEFT);}}</b>
                                            @else
                                            <b>00</b>
                                            @endif
                                            <small>Topic</small>
                                        </span></a>
                                    <b style="margin:0 0 0 6px">Q4</b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="p-0 m-0 matrixLists">
                                    <li><b>Q1</b> Your topics of strength. Keep revising to stay on top.</li>
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
            <div class="row ">
                <div class="col-xl-4 col-md-12">
                    <div class="bg-white shadow-lg py-5 progress-journey-card m-0">
                        <small>
                            <!-- <i class="fa  fa-info"></i> -->
                            <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                            <p class="tooltipclass">
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                Mapping your progress journey against an ideal path lets you draw valuable insights about the rate at which you are progressing with respect to the ideal path that will lead you to success. It will help you judge whether you are keeping pace or lagging behind, for you to take corrective action. Pick up your pace!
                            </p>
                        </small>
                        <div class="prgress-i-txt mb-2">
                            <span class="progress_text" style="padding-left: 15px;">Progress Journey</span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progressChart" style="height:180px;margin-top:18px;">
                                </div>
                                <button class="btn btnzoom-in-out" data-bs-toggle="modal" data-bs-target="#graphExpand">
                                    <i class="fa fa-arrows" style="margin-right:3px;font-size: 10px"></i>click to expand</button>
                            </div>
                            <!-- <div class="col-md-6">
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
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6">
                    <div class="bg-white shadow-lg py-5 m-0 newtabview">
                        <small>
                            <!-- <i class="fa  fa-info"></i> -->
                            <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                            <p class="tooltipclass">
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
                <div class="col-xl-3 col-md-6">
                    <div class="bg-white shadow-lg py-5 task-center-block m-0 newtabview Task_Center12">
                        <small>
                            <!-- <i class="fa  fa-info"></i> -->
                            <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                            <p class="tooltipclass">
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                A list of customized tasks specially personalized for you based on the in-depth analysis of your completed tests. Strengthen your core learning and strategic skills through these quick customized tests. Build on your strengths and work on your weaker areas to progressively improve them. Improve on your proficiency!
                            </p>
                        </small>
                        <div class="prgress-i-txt mb-4">
                            <span class="progress_text" style="padding-left: 15px;">My Task Center</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span><img src="{{URL::asset('public/after_login/new_ui/images/daily-task-icon.png')}}"></span>
                            <!--a class="btn btntheme" href="{{route('dashboard-DailyTask')}}">Daily TASK</a-->
                            <a class="btn btntheme" href="{{route('dashboard-DailyTask')}}">Daily TASK</a>
                            <!-- <button class="btn btntheme" data-bs-toggle="modal" data-bs-target="#matrix">Daily TASK</button> -->
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <span><img src="{{URL::asset('public/after_login/new_ui/images/weekly-task-icon.png')}}"></span>
                            <a class="btn btntheme" href="{{route('dashboard-DailyTask')}}">Weekly TASK</a>
                            <!--a class="btn btntheme" href="{{route('dashboard-DailyTask')}}">Weekly TASK</a-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="cust-gallery p-0 dashGallery">
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
                                <!-- <i class="fa  fa-info"></i> -->
                                <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                    To reduce uncertainty and increase your efficiency and chances of success, it is absolutely essential that you plan your preparation with great care. With effective planning comes motivation, productivity, satisfaction, and ultimately success. Go ahead and plan your week!
                                </p>
                            </small>
                            <span style="color: #2c3348;">Weekly Plan</span>
                            <div class="test-attend text-center pt-2 pb-2">
                                <div class="text-center" style="font-size: 14px;max-width: 180px;margin: 0 auto;">
                                    <b>Plan Tests</b> <br />
                                    Plan upto seven tests on chapters of your choice
                                </div>
                                <button class="custom-btn-gray mt-4 goto-planner-btn" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/new_ui/images/clock-icon.png')}}" alt="icon not find" style="width:15px;margin-top: -1px;">Go To
                                    Planner</button>
                            </div>
                        </div>
                        @elseif(isset($planner) && !empty($planner))
                        <div class="swiper-slide bg-white go2Planner weekylplan-block" style="padding: 18px 35px 35px;">
                            <small>
                                <!-- <i class="fa  fa-info"></i> -->
                                <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                    To reduce uncertainty and increase your efficiency and chances of success, it is absolutely essential that you plan your preparation with great care. With effective planning comes motivation, productivity, satisfaction, and ultimately success. Go ahead and plan your week!
                                </p>
                            </small>
                            <span style="color: #2c3348;">Weekly Plan</span>
                            <div class="test-attend text-center pt-2 pb-2">
                                <div class="text-center" style="font-size: 14px;max-width: 180px;margin: 15px auto;">
                                    <b> Tests Attempted</b>
                                    <div class="ms-auto">
                                        @foreach($planner as $key=>$val)
                                        @if($val->test_completed_yn=="Y")
                                        <a href="#" class="text-secondary ms-2">
                                            <!-- <i class="fas fa-check-circle text-success" aria-hidden="true"></i> -->
                                            <img style="width:42px;" src="{{URL::asset('public/after_login/new_ui/images/test-check-green.png')}}">
                                        </a>
                                        @else
                                        <a href="#" class="text-secondary ms-2">
                                            <!-- <i class="fas fa-check-circle" aria-hidden="true"></i> -->
                                            <img style="width:42px;" src="{{URL::asset('public/after_login/new_ui/images/test-check-grey.png')}}">
                                        </a>
                                        @endif
                                        @endforeach
                                    </div>
                                    <button class="custom-btn-gray goto-planner-btn" style="margin-top:24px;" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/new_ui/images/clock-icon.png')}}" alt="icon not find" style="width:15px;margin-top: -1px;">Go To
                                        Planner</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($planner) && empty($planner))
                        <div class="swiper-slide bg-white">
                            <!----- Weekly tests ---->
                            <small>
                                <!-- <i class="fa  fa-info"></i> -->
                                <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                                <p class="tooltipclass">
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
                                    <button style="background-color: #fff;text-transform: none;" class="custom-btn-gray mt-4 goto-planner-btn" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample"><i style="margin-right: 5px;" class="fa fa-angle-left"></i> Click on GO TO Planner</button>
                                </div>
                            </div>
                            <!-------------------->
                        </div>
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            <img src="{{URL::asset('public/after_login/new_ui/images/chemistry-subject-icon.png')}}">
                            <div>
                                <!-- <i class="fas fa-check-circle text-success" style="margin-right: 5px;"></i> -->
                                <img src="{{URL::asset('public/after_login/new_ui/images/sm-tickmark.png')}}" style="width: 42px;margin:0px -6px 5px 0px;">
                                CHEMISTRY
                            </div>
                        </div>
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            <img src="{{URL::asset('public/after_login/new_ui/images/physics-subject-icon.png')}}">
                            <div>
                                <!-- <i class="fas fa-check-circle text-success" style="margin-right: 5px;"></i> -->
                                <img src="{{URL::asset('public/after_login/new_ui/images/sm-tickmark.png')}}" style="width: 42px;margin:0px -6px 5px 0px;">
                                PHYSICS
                            </div>
                        </div>
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            <span>
                                <img style="z-index: 1;" src="{{URL::asset('public/after_login/new_ui/images/chemistry-subject-icon.png')}}">
                                <img src="{{URL::asset('public/after_login/new_ui/images/physics-subject-icon.png')}}">
                            </span>
                            <div style="margin-top: -8px;">
                                <!-- <i class="fas fa-check-circle text-success" style="margin-right: 5px;"></i> -->
                                <img src="{{URL::asset('public/after_login/new_ui/images/sm-tickmark.png')}}" style="width: 42px;margin:0px -6px 5px 0px;">
                                MORE
                            </div>
                        </div>
                        @elseif(isset($planner) && !empty($planner))
                        @foreach($planner as $key=>$val)
                        @if($val->test_completed_yn=="N")
                        <div class="swiper-slide bg-white">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-sm-flex">
                                        <span class="subjectIcon" style="margin-right: 20px;"><img style="width:80px;" src="{{$val->url}}"></span>
                                        <div>
                                            <p>Level up in</p>
                                            <h3 class="chapter_name mb-0" title="{{$val->chapter_name}}">{{$val->chapter_name}}</h3>
                                            <ul class="course-star pe-2 m-0">
                                                <li style="float:none;">
                                                    <strong style="width:auto;">Proficiency</strong>
                                                    <span class="star-img" style="width:auto;">
                                                        <div class="star-ratings-css ">
                                                            <div class="star-ratings-css-top" style="width: {{round($val->chapter_score, 0)}}%">
                                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                            </div>
                                                            <div class="star-ratings-css-bottom">
                                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                            </div>
                                                        </div>
                                                    </span>
                                                    <span> {{ round($val->chapter_score, 0)}}%</span>
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
                                    <span class="text-secondary chapter_name mb-2 d-block">
                                        <!-- <i class="fas fa-check-circle text-success" aria-hidden="true"></i> -->
                                        <img style="width:55px;" src="{{URL::asset('public/after_login/new_ui/images/tickmark.png')}}">
                                    </span>
                                    <h3 class="mb-0" title="{{$val->chapter_name}}">{{$val->chapter_name}}</h3>
                                    <ul class="course-star mt-3 mb-0">
                                        <li style="float:none;">
                                            <strong style="width:auto;" class="d-block">Proficiency</strong>
                                            <span class="star-img" style="width:auto;">
                                                <div class="star-ratings-css ">
                                                    <div class="star-ratings-css-top" style="width: {{round($val->chapter_score, 0)}}%">
                                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                    </div>
                                                    <div class="star-ratings-css-bottom">
                                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                    </div>
                                                </div>
                                            </span>
                                            <span> {{round($val->chapter_score, 0)}}%</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @if(isset($subjectPlanner_miss) && $subjectPlanner_miss==true)
                        @foreach($user_subjects as $sKey=>$sVal)
                        @if(!in_array($sVal->id,$planner_subject))
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            @if(isset($sVal->subject_thumbnail_image_path) && !empty($sVal->subject_thumbnail_image_path))
                            <img src="{{isset($sVal->subject_thumbnail_image_path)?$sVal->subject_thumbnail_image_path:''}}">
                            @else
                            <span>
                                <img style="z-index: 1;" src="{{URL::asset('public/after_login/new_ui/images/chemistry-subject-icon.png')}}">
                                <img src="{{URL::asset('public/after_login/new_ui/images/physics-subject-icon.png')}}">
                            </span>
                            @endif
                            <div>
                                <!-- <i class="fas fa-check-circle text-success" style="margin-right: 5px;"></i> -->
                                <img src="{{URL::asset('public/after_login/new_ui/images/sm-tickmark.png')}}" style="width: 42px;margin:0px -6px 5px 0px;">
                                {{strtoupper($sVal->subject_name)}}
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                        @endif
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
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
<!-- Full exam popup -->
@if(isset($prof_asst_test) && $prof_asst_test=='N')
<div class="modal fade" id="fullTest_Dashboard" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-modal="true" role="dialog" style="display: none; padding-left: 0px;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">
                <!--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body pt-0 text-center">
                <p id="h1--P" class="h1-p text-success">Get your Performance Analytics!</p>
                <p>Take a test and get a complete analysis of your preparation</p>
                <a id="full-txtBlock" href="{{route('exam','full_exam')}}" class="full-txtblock justify-content-center d-flex align-items-center mb-4 mt-5 mx-5 py-4">
                    <!-- <i class="fa-li fa fa-check" aria-hidden="true"></i> -->
                    <img style="width:65px;margin-right: 20px;" src="{{URL::asset('public/after_login/new_ui/images/full-scan-check.png')}}">
                    <span class="text-white ms-4 ">Take full body scan of<br>{{$prof_test_qcount}} questions test</span>
                </a>
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-5 btn-light text-danger px-4 skip-dashboard" data-bs-toggle="modal" data-bs-dismiss="modal">SKIP</a>
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
<!--------- Modal trial-box------>
@if(isset($date_difference) && ($date_difference > 0) && ($date_difference < 13) && $trial_expired_yn=='Y' ) <div class="modal fade custommodal" id="trialbox">
    <div class="modal-dialog modal-dialog-centered trialbox">
        <div class="modal-content rounded-0 bg-light p-5">
            <div class="modal-body text-center p-0">
                <p class="pb-5 mt-4 m-0">Your trial expires in <span>{{$date_difference+1}} days</span> <br>Subscribe now!</p>
                <div class="text-center mb-4">
                    <a href="{{route('subscriptions')}}" class="btn btn-danger text-white px-5 col-lg-7"> Get Subscription</a>
                </div>
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-dismiss="modal">Do it later</a>
            </div>
        </div>
    </div>
    </div>
    @endif
    <!-------------------->
    <!--------- Graph Expand ------>
    <div class="modal fade" id="graphExpand" data-bs-backdrop="static" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 100%; max-height: 100%;margin: 1.75rem 20px">
            <div class="modal-content rounded-0 bg-light">
                <div class="modal-header pb-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <div class="progressChartExpend"></div>
                </div>
            </div>
        </div>
    </div>
    <!-------------------->
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
    <script type="text/javascript">
        $(".rating-input").click(function() {
            $("#nxt-btn").removeClass("disabled");
        });
        /* $('.subject_scroll').slimscroll({
            height: '25vh'
        }); */

        $(window).on('load', function() {

            if (sessionStorage.getItem('firstVisit') != '1') {
                $('#trialbox').modal('show');
            }
            sessionStorage.setItem('firstVisit', '1');

        });



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
                // console.log(parseInt($(this).data('value')));

            })

            $('.full').click(function() {
                if (starClicked == true) {
                    setFullStarState(this)
                }
                $(this).closest('.rating').find('.js-score').text($(this).data('value'));

                $(this).find('js-average').text(parseInt($(this).data('value')));

                $(this).closest('.rating').data('vote', $(this).data('value'));
                calculateAverage()

                // console.log(parseInt($(this).data('value')));
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
            slidesPerView: 'auto',
            spaceBetween: 30,
            freeMode: true,
            slideToClickedSlide: false,
            focusableElements: false,
            pagination: {
                el: ".swiper-pagination",
                clickable: false,

            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                1920: {
                    slidesPerView: 'auto',
                    spaceBetween: 30,

                },
                1028: { // this is all desktop view of my laptop
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                },
                300: {
                    slidesPerView: 'auto',
                    spaceBetween: 30
                }
            }
        });
    </script>
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
    @endsection