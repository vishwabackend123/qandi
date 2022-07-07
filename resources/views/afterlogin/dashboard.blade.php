@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"> 
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"> <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"/></g></svg>
                                        <p class="tooltipclass">
                                            <span ><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
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
                                  <a href="javascript:;" class="commmongreenLink">See analytics <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                              </div>
                          </div>
                            <div class="commonWhiteBox">
                                <div class="boxHeadingBlock">
                                        <h3 class="boxheading">Subject Performance
                                            <span class="tooltipmain">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"> <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"/></g></svg>
                                            
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
                                            <div class="SubjectscorePannel">
                                                <div class="subjextscoreLeft">
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
                                <div class="emptystate" style="display:none">
                                    <div class="emptystateInner">
                                        <div class="emptyicon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="81" viewBox="0 0 80 81" fill="none">
                                                <circle cx="40" cy="40.102" r="40" fill="#E0F6E3"/>
                                                <path d="M16.979 25.102h10.525a1 1 0 0 1 1 1v2.22a1 1 0 0 1-1 1h-5.87c-.458 0-.864.312-.91.768-.303 3.018 1.262 8.859 8.382 15.604.885.84.051 2.165-.937 1.45-10.105-7.32-12.436-16.283-12.146-21.179.03-.499.456-.863.956-.863zM64.021 25.102H53.496a1 1 0 0 0-1 1v2.22a1 1 0 0 0 1 1h5.87c.458 0 .864.312.91.768.303 3.018-1.262 8.859-8.382 15.604-.885.84-.051 2.165.937 1.45 10.104-7.32 12.436-16.283 12.146-21.179-.03-.499-.456-.863-.956-.863z" fill="#BEE9C4"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M40.206 21.102H27.588c-.04.465-.089.965-.14 1.494-.59 6.134-1.554 16.144 4.322 21.616 1.044.972 1.868 1.64 2.516 2.164 1.99 1.614 2.326 1.886 2.326 5.539v2.641h7.776v-2.641c0-3.653.335-3.925 2.326-5.539a44.9 44.9 0 0 0 2.516-2.164c5.876-5.472 4.912-15.482 4.322-21.616-.051-.529-.1-1.029-.14-1.494H40.206z" fill="#fff"/>
                                                <path d="M29 60.102a6 6 0 0 1 6-6h10a6 6 0 0 1 6 6v2H29v-2z" fill="#BEE9C4"/>
                                                <path d="M40.05 29.022a.5.5 0 0 1 .9 0l.825 1.691a.5.5 0 0 0 .376.275l1.856.275a.5.5 0 0 1 .278.85l-1.35 1.33a.5.5 0 0 0-.141.44l.317 1.87a.5.5 0 0 1-.728.525l-1.648-.877a.5.5 0 0 0-.47 0l-1.648.877a.5.5 0 0 1-.728-.525l.317-1.87a.5.5 0 0 0-.142-.44l-1.349-1.33a.5.5 0 0 1 .278-.85l1.856-.275a.5.5 0 0 0 .376-.275l.826-1.691z" fill="#56B663"/>
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
                                                     <div class="moreTaskLink">
                                                     <a href="javascript:;" class="commmongreenLink mb-2">3 more tasks <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none"><path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path></svg></span></a>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"> <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"/></g></svg>
                                            <p class="tooltipclass">
                                            <span ><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                            </p>
                                        </span>
                                    </h3>
                                    <p class="dashSubtext">Supporting text for better interaction on this section</p>
                                </div>
                                <div class="MyqMatrixMain mt-3" >
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
                                                     <h3>12 <span class="topictext" >Topics</span></h3>
                                                      <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
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
                                                    <p>Give a little attention to these topics and take another step towards perfection.  </p>
                                                 </div>
                                                 <div class="myqbottomSec">
                                                     <h3>23 <span class="topictext">Topics</span></h3>
                                                      <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
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
                                                    <p>Topics that are hurdles in your journey. Do not save them for the last.  </p>
                                                 </div>
                                                 <div class="myqbottomSec">
                                                     <h3>12 <span class="topictext">Topics</span></h3>
                                                      <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </span>
                                                 </div>
                                              </a>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class="myqmatPannel myqcolor4">
                                              <a href="#weakhmodal">
                                                 <div class="myqinner">
                                                   <h6>Q4</h6>
                                                    <h5>Weak </h5>
                                                    <p>Find your weak topics here. Work hard to move these topics to other quadrants.</p>
                                                 </div>
                                                 <div class="myqbottomSec">
                                                     <h3>12 <span class="topictext">Topics</span></h3>
                                                      <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </span>
                                                 </div>
                                               </a>
                                              </div>
                                          </div>
                                     </div>
                                </div>
                                <div class="emptystate mt-3" style="display:none">
                                  <div class="emptystateInner">
                                      <div class="emptyicon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="81" viewBox="0 0 80 81" fill="none">
                                            <circle cx="40" cy="40.102" r="40" fill="#E0F6E3"/>
                                            <path d="M16.979 25.102h10.525a1 1 0 0 1 1 1v2.22a1 1 0 0 1-1 1h-5.87c-.458 0-.864.312-.91.768-.303 3.018 1.262 8.859 8.382 15.604.885.84.051 2.165-.937 1.45-10.105-7.32-12.436-16.283-12.146-21.179.03-.499.456-.863.956-.863zM64.021 25.102H53.496a1 1 0 0 0-1 1v2.22a1 1 0 0 0 1 1h5.87c.458 0 .864.312.91.768.303 3.018-1.262 8.859-8.382 15.604-.885.84-.051 2.165.937 1.45 10.104-7.32 12.436-16.283 12.146-21.179-.03-.499-.456-.863-.956-.863z" fill="#BEE9C4"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M40.206 21.102H27.588c-.04.465-.089.965-.14 1.494-.59 6.134-1.554 16.144 4.322 21.616 1.044.972 1.868 1.64 2.516 2.164 1.99 1.614 2.326 1.886 2.326 5.539v2.641h7.776v-2.641c0-3.653.335-3.925 2.326-5.539a44.9 44.9 0 0 0 2.516-2.164c5.876-5.472 4.912-15.482 4.322-21.616-.051-.529-.1-1.029-.14-1.494H40.206z" fill="#fff"/>
                                            <path d="M29 60.102a6 6 0 0 1 6-6h10a6 6 0 0 1 6 6v2H29v-2z" fill="#BEE9C4"/>
                                            <path d="M40.05 29.022a.5.5 0 0 1 .9 0l.825 1.691a.5.5 0 0 0 .376.275l1.856.275a.5.5 0 0 1 .278.85l-1.35 1.33a.5.5 0 0 0-.141.44l.317 1.87a.5.5 0 0 1-.728.525l-1.648-.877a.5.5 0 0 0-.47 0l-1.648.877a.5.5 0 0 1-.728-.525l.317-1.87a.5.5 0 0 0-.142-.44l-1.349-1.33a.5.5 0 0 1 .278-.85l1.856-.275a.5.5 0 0 0 .376-.275l.826-1.691z" fill="#56B663"/>
                                         </svg>
                                      </div>
                                      <p class="emptytext">Attempt <strong>'Full body scan.'</strong>  to learn about your strengths and weaknesses. </p>
                                      <button class="btn btn-common-transparent nobg">Attempt Now</button>
                                  </div>
                             </div>
                            </div>
                         </div>
                </div>



                <section class="weeklyPlanWrapper cardWhiteBg">
                    <div class="planDetail">
                        <div class="planewrapper">
                            <div class="plantitleBox">
                                <div class="boxHeadingBlock">
                                <h3 class="boxheading">
                                    Weekly plan
                                    <span class="tooltipmain">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"></path>
                                            </g>
                                        </svg>
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
                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="testPlanCardholder">
                        <div class="testPlanCard testplannewuser">
                            <svg class="testplanNewimg" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80" fill="none">
                                <circle cx="40" cy="40" r="40" fill="#E0F6E3"/>
                                <path d="M23.988 27.418a4 4 0 0 1 3.966-4.518H56.79a4 4 0 0 1 3.966 3.483l3.653 28a4 4 0 0 1-3.966 4.517H31.607a4 4 0 0 1-3.966-3.482l-3.653-28z" fill="#BEE9C4"/>
                                <path d="M58.01 27.418a4 4 0 0 0-3.966-4.518H25.208a4 4 0 0 0-3.966 3.483l-3.653 28a4 4 0 0 0 3.966 4.517h28.836a4 4 0 0 0 3.966-3.482l3.653-28z" fill="#fff"/>
                                <path d="M53 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952H53zM35.399 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952h2.697z" fill="#56B663"/>
                                <path d="M24.07 31.544a.8.8 0 0 1 .784-.644h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM23.271 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM22.472 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM30.47 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM29.671 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM28.87 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4zM36.87 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.956l.48-2.4zM36.07 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM35.271 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM43.271 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM42.47 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM49.67 31.544a.8.8 0 0 1 .784-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM48.87 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4z" fill="#E0F6E3"/>
                            </svg>
                            <p class=" m-0">Start planning your week</p>
                            <div class="addPlanbtn">
                                <button class="btn btn-common-transparent">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M10 18.333a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 6.666v6.667M6.666 10h6.667" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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
                                        <path d="M58.975.373 19.797.166 39.18 11.111 58.975.373z" fill="url(#xbs2u8kpya)"/>
                                        <path d="M58.975.373 19.797.166 39.18 11.111 58.975.373z" fill="url(#pdstqsqm7b)"/>
                                        <path d="M78.562 33.415 58.56 44.773 39.178 11.112 58.973.373l19.589 33.042z" fill="url(#i6rag4r7fc)"/>
                                        <path d="M78.562 33.415 58.56 44.773 39.178 11.112 58.973.373l19.589 33.042z" fill="url(#s6bkns5edd)"/>
                                        <path d="M0 33.62 19.795.167 39.59 11.111 19.795 44.566 0 33.621z" fill="url(#ls4ucv1fue)"/>
                                        <path d="M0 33.62 19.795.167 39.59 11.111 19.795 44.566 0 33.621z" fill="url(#fpylq9jbjf)"/>
                                        <path d="M57.736 66.664V44.918L78.77 33.21 57.736 66.664z" fill="url(#xwkqjxxcog)"/>
                                        <path d="M57.736 66.664V44.918L78.77 33.21 57.736 66.664z" fill="url(#h5r5kftt9h)"/>
                                        <path d="M58.353 44.565H20v22.51l37.734-.414.62-22.096z" fill="url(#zy6p1fbq7i)"/>
                                        <path d="M58.353 44.565H20v22.51l37.734-.414.62-22.096z" fill="url(#sdlb5dxifj)"/>
                                        <path d="M20.001 67.076 0 33.621l20.001 10.945v22.51z" fill="url(#tg87y2hlqk)"/>
                                        <path d="M20.001 67.076 0 33.621l20.001 10.945v22.51z" fill="url(#4gvoyw248l)"/>
                                        <path d="M19.795 44.564 39.384 11.11l19.589 33.455H19.795z" fill="url(#62ss06008m)"/>
                                        <path d="M19.795 44.564 39.384 11.11l19.589 33.455H19.795z" fill="url(#bjzgc4z0ln)"/>
                                        <defs>
                                            <linearGradient id="xbs2u8kpya" x1="39.489" y1=".373" x2="39.489" y2="11.111" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="pdstqsqm7b" x1="39.489" y1=".373" x2="39.489" y2="11.111" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="i6rag4r7fc" x1="59.076" y1=".58" x2="59.076" y2="44.773" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="s6bkns5edd" x1="59.076" y1=".58" x2="59.076" y2="44.773" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="ls4ucv1fue" x1="19.795" y1=".166" x2="19.795" y2="44.566" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="fpylq9jbjf" x1="19.795" y1=".166" x2="19.795" y2="44.566" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="xwkqjxxcog" x1="68.252" y1="33.209" x2="68.252" y2="66.664" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="h5r5kftt9h" x1="68.252" y1="33.209" x2="68.252" y2="66.664" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="zy6p1fbq7i" x1="39.176" y1="44.565" x2="39.176" y2="67.074" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="sdlb5dxifj" x1="39.176" y1="44.565" x2="39.176" y2="67.074" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="tg87y2hlqk" x1="10.207" y1="34.034" x2="10.207" y2="67.489" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="4gvoyw248l" x1="10.207" y1="34.034" x2="10.207" y2="67.489" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="62ss06008m" x1="39.384" y1="11.109" x2="39.384" y2="44.564" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="bjzgc4z0ln" x1="39.384" y1="11.109" x2="39.384" y2="44.564" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
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
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)"/>
                                        <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E"/>
                                        <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1"/>
                                        <path d="M15.12 58.838h20" stroke="#38B87B"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z"/>
                                        <path stroke="#38B87B" d="M50.873 59.018h26"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z"/>
                                        <path d="M4.71 45.103v-9.38" stroke="#38B87B"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z"/>
                                        <path stroke="#38B87B" d="M4.891 18.996V1.093"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z"/>
                                        <defs>
                                            <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#3ABFB0"/>
                                            <stop offset="1" stop-color="#37B66B"/>
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
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)"/>
                                        <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E"/>
                                        <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1"/>
                                        <path d="M15.12 58.838h20" stroke="#38B87B"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z"/>
                                        <path stroke="#38B87B" d="M50.873 59.018h26"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z"/>
                                        <path d="M4.71 45.103v-9.38" stroke="#38B87B"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z"/>
                                        <path stroke="#38B87B" d="M4.891 18.996V1.093"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z"/>
                                        <defs>
                                            <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#3ABFB0"/>
                                            <stop offset="1" stop-color="#37B66B"/>
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
                                        <path d="M58.975.373 19.797.166 39.18 11.111 58.975.373z" fill="url(#xbs2u8kpya)"/>
                                        <path d="M58.975.373 19.797.166 39.18 11.111 58.975.373z" fill="url(#pdstqsqm7b)"/>
                                        <path d="M78.562 33.415 58.56 44.773 39.178 11.112 58.973.373l19.589 33.042z" fill="url(#i6rag4r7fc)"/>
                                        <path d="M78.562 33.415 58.56 44.773 39.178 11.112 58.973.373l19.589 33.042z" fill="url(#s6bkns5edd)"/>
                                        <path d="M0 33.62 19.795.167 39.59 11.111 19.795 44.566 0 33.621z" fill="url(#ls4ucv1fue)"/>
                                        <path d="M0 33.62 19.795.167 39.59 11.111 19.795 44.566 0 33.621z" fill="url(#fpylq9jbjf)"/>
                                        <path d="M57.736 66.664V44.918L78.77 33.21 57.736 66.664z" fill="url(#xwkqjxxcog)"/>
                                        <path d="M57.736 66.664V44.918L78.77 33.21 57.736 66.664z" fill="url(#h5r5kftt9h)"/>
                                        <path d="M58.353 44.565H20v22.51l37.734-.414.62-22.096z" fill="url(#zy6p1fbq7i)"/>
                                        <path d="M58.353 44.565H20v22.51l37.734-.414.62-22.096z" fill="url(#sdlb5dxifj)"/>
                                        <path d="M20.001 67.076 0 33.621l20.001 10.945v22.51z" fill="url(#tg87y2hlqk)"/>
                                        <path d="M20.001 67.076 0 33.621l20.001 10.945v22.51z" fill="url(#4gvoyw248l)"/>
                                        <path d="M19.795 44.564 39.384 11.11l19.589 33.455H19.795z" fill="url(#62ss06008m)"/>
                                        <path d="M19.795 44.564 39.384 11.11l19.589 33.455H19.795z" fill="url(#bjzgc4z0ln)"/>
                                        <defs>
                                            <linearGradient id="xbs2u8kpya" x1="39.489" y1=".373" x2="39.489" y2="11.111" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="pdstqsqm7b" x1="39.489" y1=".373" x2="39.489" y2="11.111" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="i6rag4r7fc" x1="59.076" y1=".58" x2="59.076" y2="44.773" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="s6bkns5edd" x1="59.076" y1=".58" x2="59.076" y2="44.773" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="ls4ucv1fue" x1="19.795" y1=".166" x2="19.795" y2="44.566" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="fpylq9jbjf" x1="19.795" y1=".166" x2="19.795" y2="44.566" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="xwkqjxxcog" x1="68.252" y1="33.209" x2="68.252" y2="66.664" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="h5r5kftt9h" x1="68.252" y1="33.209" x2="68.252" y2="66.664" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="zy6p1fbq7i" x1="39.176" y1="44.565" x2="39.176" y2="67.074" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="sdlb5dxifj" x1="39.176" y1="44.565" x2="39.176" y2="67.074" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="tg87y2hlqk" x1="10.207" y1="34.034" x2="10.207" y2="67.489" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="4gvoyw248l" x1="10.207" y1="34.034" x2="10.207" y2="67.489" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
                                            </linearGradient>
                                            <linearGradient id="62ss06008m" x1="39.384" y1="11.109" x2="39.384" y2="44.564" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#D9D9D9"/>
                                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                            </linearGradient>
                                            <linearGradient id="bjzgc4z0ln" x1="39.384" y1="11.109" x2="39.384" y2="44.564" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#43E1CE"/>
                                            <stop offset="1" stop-color="#2899CA"/>
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
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)"/>
                                        <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E"/>
                                        <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1"/>
                                        <path d="M15.12 58.838h20" stroke="#38B87B"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z"/>
                                        <path stroke="#38B87B" d="M50.873 59.018h26"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z"/>
                                        <path d="M4.71 45.103v-9.38" stroke="#38B87B"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z"/>
                                        <path stroke="#38B87B" d="M4.891 18.996V1.093"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z"/>
                                        <defs>
                                            <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#3ABFB0"/>
                                            <stop offset="1" stop-color="#37B66B"/>
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
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)"/>
                                        <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E"/>
                                        <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1"/>
                                        <path d="M15.12 58.838h20" stroke="#38B87B"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z"/>
                                        <path stroke="#38B87B" d="M50.873 59.018h26"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z"/>
                                        <path d="M4.71 45.103v-9.38" stroke="#38B87B"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z"/>
                                        <path stroke="#38B87B" d="M4.891 18.996V1.093"/>
                                        <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z"/>
                                        <defs>
                                            <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#3ABFB0"/>
                                            <stop offset="1" stop-color="#37B66B"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="graphCard my-4">
                    <div class="graphCardwrapper">
                        <div class="journeyGraph cardWhiteBg">
                            <div class="boxHeadingBlock">
                                <h3 class="boxheading">
                                Progress journey
                                <span class="tooltipmain">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"></path>
                                        </g>
                                    </svg>
                                </span>
                                </h3>
                            </div>
                            <div class="graphBoxcontainer">
                                <div class="graphimg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="auto" viewBox="0 0 271 191" fill="none">
                                        <path stroke="#E0E0E0" d="M1.5 8v183M2 190.5h258M3 145.5h256M3 99.5h256M3 53.5h256M3 7.5h256"/>
                                        <path transform="matrix(.81923 -.57346 .30416 .95262 1 191)" stroke="#05D6A1" stroke-width="2" stroke-linecap="round" d="M1-1h327.577"/>
                                        <path d="m2 190 25.532-37.903a31 31 0 0 1 25.711-13.681h13.514a31 31 0 0 0 25.71-13.681l11.353-16.853a31.001 31.001 0 0 1 25.711-13.681h22.173a30.999 30.999 0 0 0 17.618-5.493L263 24" stroke="#F7758F" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                  
                                
                                </div>
                                <div class="graphDetail">
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
                                <div class="graphDetailempty">
                                <p>To achieve this pace, you must begin attempting chapter-wise questions and increase your accuracy</p>
                                <button class="btn btn-common-transparent width150 nobg">Attempt Now</button>
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
                                            <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"></path>
                                        </g>
                                    </svg>
                                </span>
                                </h3>
                            </div>
                            <div class="journeyBoxcontainer">
                                <div class="graphimg">
                                    <div class="graphholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="auto" viewBox="0 0 271 191" fill="none">
                                        <path stroke="#E0E0E0" d="M1.5 8v183M2 190.5h258M3 145.5h256M3 99.5h256M3 53.5h256M3 7.5h256"/>
                                        <path transform="matrix(.81923 -.57346 .30416 .95262 1 191)" stroke="#05D6A1" stroke-width="2" stroke-linecap="round" d="M1-1h327.577"/>
                                        <path d="m2 190 25.532-37.903a31 31 0 0 1 25.711-13.681h13.514a31 31 0 0 0 25.71-13.681l11.353-16.853a31.001 31.001 0 0 1 25.711-13.681h22.173a30.999 30.999 0 0 0 17.618-5.493L263 24" stroke="#F7758F" stroke-width="2" stroke-linecap="round"/>
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
        
 

        <!-- <div class="container-fluid pt-0  dashboard-cards-block common-cards-boxshadow">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-7  col-sm-12">
                    <div class="bg-white shadow-lg">
                        <small>
                            <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                            <p class="tooltipclass">
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                
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
                <div class="col-xl-5  col-md-12 col-sm-12">
                    <div class="bg-white shadow-lg py-5 myqMatrix-card">
                        <span class="progress_text" style="padding-left: 15px;">MyQ Matrix</span>
                        <small>
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
            <div class="row ">
                <div class="col-xl-4 col-md-12">
                    <div class="bg-white shadow-lg py-5 progress-journey-card m-0">
                        <small>
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
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6">
                    <div class="bg-white shadow-lg py-5 m-0 newtabview">
                        <small>
                            
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
                        
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="bg-white shadow-lg py-5 task-center-block m-0 newtabview Task_Center12">
                        <small>
                            
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
                            
                            
                            <a class="btn btntheme" href="{{route('dashboard-DailyTask')}}">Daily TASK</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <span><img src="{{URL::asset('public/after_login/new_ui/images/weekly-task-icon.png')}}"></span>
                            <a class="btn btntheme" href="{{route('dashboard-DailyTask')}}">Weekly TASK</a>
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
                                            <img style="width:42px;" src="{{URL::asset('public/after_login/new_ui/images/test-check-green.png')}}">
                                        </a>
                                        @else
                                        <a href="#" class="text-secondary ms-2">
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
                            <small>
                                
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
                            
                        </div>
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            <img src="{{URL::asset('public/after_login/new_ui/images/chemistry-subject-icon.png')}}">
                            <div>
                                
                                <img src="{{URL::asset('public/after_login/new_ui/images/sm-tickmark.png')}}" style="width: 42px;margin:0px -6px 5px 0px;">
                                CHEMISTRY
                            </div>
                        </div>
                        <div class="swiper-slide bg-white text-center subject-placeholder-block">
                            <img src="{{URL::asset('public/after_login/new_ui/images/physics-subject-icon.png')}}">
                            <div>
                                
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
                                <div class="ms-auto">
                                    <span class="text-secondary chapter_name mb-2 d-block">
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
            </div>
        </div> -->
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
    <!-- Strengths-popup start  -->
    <div class="modal fade" id="strengthmodal">
         <div  class="modalcenter">
            <div class="modal-dialog">
                <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                        <a  href="javascript:;"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
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


         <!-- <div id="strengthmodal" class="overlay88">
            <div class="popup88">
                <a class="close" href="#">&times;</a>
               <div class="intraction_text_q1">Q1</div>
               <div class="intraction_text_strength">Strengths</div>
               <hr>
               <div class="instruction_text_content">
                  Supporting text for better interaction on this section. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
            </div>
         </div> -->
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
 

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
 
 

$('.dashborarSlider').owlCarousel({
    stagePadding: 10,
		loop: false, 
		margin: 0,
		nav: true,
        dots:false,
        // rewindNav:true,
      
    responsive:{
        0:{
            items: 1,
            nav: false,
            stagePadding: 40,
            margin: 0,
            loop: true,
        },
        600:{
            items:3
        },
        1000:{
            items:4
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


    @endsection