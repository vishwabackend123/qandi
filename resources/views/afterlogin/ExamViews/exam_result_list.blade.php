@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
<style>
   .topic_selected {
   background-color: #5bc3ff !important;
   color: #ffffff !important;
   }
</style>
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">
   <!-- End start-navbar Section -->
   @include('afterlogin.layouts.navbar_header_new')
   <!-- End top-navbar Section -->
   <div class="content-wrapper">
      <div class="container-fluid custom-page">
         <div class="row">
            <div class="col-lg-12  p-lg-5 pt-none">
               <div class="tab-wrapper">
                  <div id="scroll-mobile">
                     <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <a class="nav-link all_div active" id="Mathematics-tab" data-bs-toggle="tab" href="#Mathematics" role="tab" aria-controls="Mathematics" aria-selected="true">Mock</a>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a class="nav-link all_div " id="Physics-tab" data-bs-toggle="tab" href="#Physics" role="tab" aria-controls="Physics" aria-selected="false">Attempted</a>
                        </li>
                     </ul>
                  </div>
                  <!--scroll-mobile-->
                  <div class="tab-content cust-tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="Mathematics" role="tabpanel" aria-labelledby="Mathematics-tab">
                        <div class="scroll-div mt-4" id="chapter_list_1">
                           <div class="compLeteS" id="chapter_box_324">
                              <div class="ClickBack d-flex align-items-center justify-content-between bg-white  px-3 py-2 mb-2 listing-details w-100 flex-wrap result-list-table">
                                 <div class="d-flex align-items-center justify-content-between result-list-head">
                                    <h4 class="m-0 p-0">JEE Main Full Syllabus 2021</h4>
                                    <p class="m-0 p-0">01st Sept 2021</p>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-center morning-slot">
                                    <p class="m-0 p-0">Morning Slots</p>
                                    <span class="slbs-link mx-3">
                                    <a class="expand-custom expandTopicCollapse" aria-controls="chapter_324" data-bs-toggle="collapse" href="#chapter_324" role="button" aria-expanded="true" value="Expand to Topics" onclick="show_topic('324','1')" id="clicktopic_324"><span id="expand_topic_324">Hide Details</span></a></span>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between result-list-btns">
                                    <a href="javascript:void(0);"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <button class="btn result-review ml-3">Review Exam</button>
                                 </div>
                              </div>
                              <div class="mb-4 collapse" id="chapter_324">
                                 <div class="p-3 pb-4 d-flex justify-content-between full-syllabus">
                                    <div class="score-show text-center">
                                       <p class="p-0 mb-3">Score:<span>102</span>/300</p>
                                       <button class="btn result-analysis text-uppercase boder-0 text-white"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp;See Analyics</button>
                                    </div>
                                    <div class="d-flex justify-content-between paper-summery ps-5 pe-2">
                                       <div class="paper-sub">
                                          <small>No of Question</small>
                                          <span>90 MCQ</span>
                                       </div>
                                       <div class="paper-sub">
                                          <small>Duration</small>
                                          <span>60</span> Minutes
                                       </div>
                                       <div class="paper-sub">
                                          <small>Marks</small>
                                          <span>300</span>
                                       </div>
                                       <div class="paper-sub">
                                          <small>Subjects</small>
                                          <span>Physics,mathematics & chemistry</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                               </div>
                             <div class="compLeteS" id="chapter_box_324">
                              <div class="ClickBack d-flex align-items-center justify-content-between bg-white  px-3 py-2 mb-2 listing-details w-100 flex-wrap result-list-table">
                                 <div class="d-flex align-items-center justify-content-between result-list-head">
                                    <h4 class="m-0 p-0">JEE Main Full Syllabus 2021</h4>
                                    <p class="m-0 p-0">01st Sept 2021</p>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-center morning-slot">
                                    <p class="m-0 p-0">Morning Slots</p>
                                    <span class="slbs-link mx-3">
                                    <a class="expand-custom expandTopicCollapse" aria-controls="chapter_324" data-bs-toggle="collapse" href="#chapter_325" role="button" aria-expanded="true" value="Expand to Topics" onclick="show_topic('324','1')" id="clicktopic_324"><span id="expand_topic_324">Hide Details</span></a></span>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between result-list-btns">
                                    <a href="javascript:void(0);"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <button class="btn result-review ml-3">Review Exam</button>
                                 </div>
                              </div>
                              <div class="mb-4 collapse" id="chapter_325">
                                 <div class="p-3 pb-4 d-flex justify-content-between full-syllabus">
                                    <div class="score-show text-center">
                                       <p class="p-0 mb-3">Score:<span>102</span>/300</p>
                                       <button class="btn result-analysis text-uppercase boder-0 text-white"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp;See Analyics</button>
                                    </div>
                                    <div class="d-flex justify-content-between paper-summery ps-5 pe-2">
                                       <div class="paper-sub">
                                          <small>No of Question</small>
                                          <span>90 MCQ</span>
                                       </div>
                                       <div class="paper-sub">
                                          <small>Duration</small>
                                          <span>60</span> Minutes
                                       </div>
                                       <div class="paper-sub">
                                          <small>Marks</small>
                                          <span>300</span>
                                       </div>
                                       <div class="paper-sub">
                                          <small>Subjects</small>
                                          <span>Physics,mathematics & chemistry</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                               </div>
                            
                            
                        </div>
                     </div>
                     <div class="tab-pane fade show " id="Physics" role="tabpanel" aria-labelledby="Physics-tab">
                        <div class="d-flex px-4 py-2 align-items-center clear_div ">
                           <div class="dropdown">
                              <button class="btn btn-light ms-2 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" title="Chapters Filter">
                                 <!-- <i class="fa fa-sliders" aria-hidden="true" title="Chapters Filter"></i>-->
                                 <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-4860.png" class="dsow">
                                    <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-4860-white.png" class="hsow"> -->
                                 <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4860" width="24" height="24" viewBox="0 0 24 24">
                                    <path data-name="Path 11531" d="M0 0h24v24H0z" style="fill:none"></path>
                                    <path data-name="Path 11532" d="m3 9 4-4 4 4M7 5v14" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                    <path data-name="Path 11533" d="m21 15-4 4-4-4m4 4V5" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                 </svg>
                              </button>
                              <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">
                                 <li>
                                    <a class="dropdown-item" onclick="chapterlist_filter('2','prof_asc')" href="javascript:void(0);">
                                       <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-4864.png"> -->
                                       <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4864" width="24" height="24" viewBox="0 0 24 24">
                                          <path data-name="Path 2676" d="M0 0h24v24H0z" style="fill:none"></path>
                                          <path data-name="Path 2677" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2678" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2679" d="M17 3a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0V5a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <circle data-name="Ellipse 785" cx="2" cy="2" r="2" transform="translate(15 14)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></circle>
                                          <path data-name="Path 2680" d="M19 16v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                       </svg>
                                       Low Proficiency
                                    </a>
                                 </li>
                                 <li>
                                    <a class="dropdown-item" onclick="chapterlist_filter('2','prof_desc')" href="javascript:void(0);">
                                       <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-2976.png"> -->
                                       <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                                          <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none"></path>
                                          <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></circle>
                                          <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                       </svg>
                                       High Proficiency
                                    </a>
                                 </li>
                                 <li>
                                    <a class="dropdown-item" onclick="chapterlist_filter('2','asc')" href="javascript:void(0);">
                                       <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-2978.png"> -->
                                       <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2978" width="24" height="24" viewBox="0 0 24 24">
                                          <path data-name="Path 2681" d="M0 0h24v24H0z" style="fill:none"></path>
                                          <path data-name="Path 2682" d="M15 10V5c0-1.38.62-2 2-2s2 .62 2 2v5m0-3h-4" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2683" d="M19 21h-4l4-7h-4" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2684" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2685" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                       </svg>
                                       A to Z order
                                    </a>
                                 </li>
                                 <li>
                                    <a class="dropdown-item" onclick="chapterlist_filter('2','desc')" href="javascript:void(0);">
                                       <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-2979.png"> -->
                                       <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2979" width="24" height="24" viewBox="0 0 24 24">
                                          <path data-name="Path 2686" d="M0 0h24v24H0z" style="fill:none"></path>
                                          <path data-name="Path 2687" d="M15 21v-5c0-1.38.62-2 2-2s2 .62 2 2v5m0-3h-4" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2688" d="M19 10h-4l4-7h-4" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2689" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 2690" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                       </svg>
                                       Z to A order
                                    </a>
                                 </li>
                              </ul>
                           </div>
                           <a class="clear-filter" href="javascript:void(0);" onclick="clear_chapter_filter('2','clear')" style="display:none">Clear</a>
                        </div>
                        <div class="scroll-div" id="chapter_list_2">
                           <div class="compLeteS" id="chapter_box_253">
                              <div class=" ClickBack d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-2 listing-details w-100 flex-wrap ">
                                 <span class=" mr-3 name-txt" title="Alternating current">Alternating current</span>
                                 <div class="status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">
                                    <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">
                                       <div class="star-ratings-css">
                                          <div class="star-ratings-css-top" style="width: 0%">
                                             <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                          </div>
                                          <div class="star-ratings-css-bottom">
                                             <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                          </div>
                                       </div>
                                       <div class="ms-1 score score-rating js-score">
                                          0%
                                       </div>
                                    </div>
                                 </div>
                                 <span class="slbs-link mx-3">
                                 <a class="expand-custom expandTopicCollapse" aria-controls="chapter_253" data-bs-toggle="collapse" href="#chapter_253" role="button" aria-expanded="false" value="Expand to Topics" onclick="show_topic('253','2')" id="clicktopic_253"><span id="expand_topic_253">Expand to Topics</span></a></span>
                                 <div class="d-flex px-4">
                                    <button class="btn btn-light ms-auto text-danger rounded-0" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false" title="Topics Filter">
                                       <!-- <i class="fa fa-sliders" aria-hidden="true"></i> -->
                                       <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-4860.png" class="dsowl">
                                          <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-4860-white.png" class="hsowl"> -->
                                       <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4860" width="24" height="24" viewBox="0 0 24 24">
                                          <path data-name="Path 11531" d="M0 0h24v24H0z" style="fill:none"></path>
                                          <path data-name="Path 11532" d="m3 9 4-4 4 4M7 5v14" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                          <path data-name="Path 11533" d="m21 15-4 4-4-4m4 4V5" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                       </svg>
                                    </button>
                                    <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
                                       <li>
                                          <a class="dropdown-item" onclick="topiclist_filter('253','prof_asc')" href="javascript:void(0);">
                                             <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-4864.png"> -->
                                             <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4864" width="24" height="24" viewBox="0 0 24 24">
                                                <path data-name="Path 2676" d="M0 0h24v24H0z" style="fill:none"></path>
                                                <path data-name="Path 2677" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <path data-name="Path 2678" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <path data-name="Path 2679" d="M17 3a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0V5a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <circle data-name="Ellipse 785" cx="2" cy="2" r="2" transform="translate(15 14)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></circle>
                                                <path data-name="Path 2680" d="M19 16v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                             </svg>
                                             Low Proficiency
                                          </a>
                                       </li>
                                       <li>
                                          <a class="dropdown-item" onclick="topiclist_filter('253','prof_desc')" href="javascript:void(0);">
                                             <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-2976.png"> -->
                                             <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                                                <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none"></path>
                                                <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></circle>
                                                <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                             </svg>
                                             High Proficiency
                                          </a>
                                       </li>
                                       <li>
                                          <a class="dropdown-item" onclick="topiclist_filter('253','priority')" href="javascript:void(0);">
                                             <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-2978.png"> -->
                                             <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                                                <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none"></path>
                                                <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></circle>
                                                <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                             </svg>
                                             Order by Priority
                                          </a>
                                       </li>
                                       <li>
                                          <a class="dropdown-item" onclick="topiclist_filter('253','sequence')" href="javascript:void(0);">
                                             <!-- <img src="http://app.thomsondigital2021.com/public/after_login/new_ui/images/Group-2979.png"> -->
                                             <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                                                <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none"></path>
                                                <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                                <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></circle>
                                                <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none"></path>
                                             </svg>
                                             Order by Sequence
                                          </a>
                                       </li>
                                    </ul>
                                 </div>
                                 <form method="post" action="http://app.thomsondigital2021.com/custom_exam_chapter">
                                    <input type="hidden" name="_token" value="Nkk2x4ZCUoSVNEV8tv3UnM1GOaJwR4VPgeB9F9JE">                        <input type="hidden" name="subject_id" value="">
                                    <input type="hidden" name="subject_name" value="Physics">
                                    <input type="hidden" name="chapter_id" value="253">
                                    <input type="hidden" name="question_count" value="30">
                                    <button class="btn rounded-0 btn-lg ml-0 ml-md-3 custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
                                 </form>
                              </div>
                              <div class="collapse mb-4" id="chapter_253">
                                 <section id="topic_section_253" class="slick-slider mb-4 slick-initialized">
                                    <div class="slick-list draggable">
                                       <div class="slick-track" style="opacity: 1; width: 0px; transform: translate3d(0px, 0px, 0px);"></div>
                                    </div>
                                 </section>
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
</div>
@include('afterlogin.layouts.footer_new')
<script type="text/javascript">
   $(document).ready(function() {
   
     $("#topic_form").validate({
   
       submitHandler: function(form) {
         var selected_topics = $('#selected_topic').val();
         var active_tab = $("a.active").attr("id");
         $('#selected_tab').val(active_tab);
   
         if (selected_topics == '' || selected_topics == null) {
           $('#errlog_alert').html('Please select at least one topic for exam.');
           $('#errlog_alert').show();
           setTimeout(function() {
             $('#errlog_alert').fadeOut('fast');
           }, 10000);
           return false;
         }
   
         form.submit();
       }
   
     });
   });
   var aTopics = [];
   
   function addOrRemove(value) {
     var index = aTopics.indexOf(value);
   
     if (index === -1) {
       aTopics.push(value);
       $('#chpt_topic_' + value).removeClass('btn-light');
       $('#chpt_topic_' + value).addClass('topic_selected');
       $('#chpt_topic_' + value).html('SELECTED');
       $('#topic_box_' + value).addClass('bdr-success');
     } else {
       aTopics.splice(index, 1);
       $('#chpt_topic_' + value).removeClass('topic_selected');
       $('#chpt_topic_' + value).html('SELECT');
       $('#topic_box_' + value).removeClass('bdr-success');
       $('#chpt_topic_' + value).addClass('btn-light');
     }
     $('#selected_topic').val(aTopics);
     if (aTopics.length > 0) {
       $('#topic_custom_footer').removeClass('d-none');
       $('#topic_custom_footer').addClass('d-flex');
     } else {
       $('#topic_custom_footer').removeClass('d-flex');
       $('#topic_custom_footer').addClass('d-none');
     }
   
     //console.log(aTopics.length);
   }
   
   function clearTopics() {
     aTopics = [];
     $('#selected_topic').val('');
     $('.addremovetopic').removeClass('topic_selected');
     $('.addremovetopic').html('SELECT');
     $('.topicboxdin').removeClass('bdr-success');
     // console.log(aTopics);
     $('#topic_custom_footer').removeClass('d-flex');
     $('#topic_custom_footer').addClass('d-none');
   }
   
   
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
   
   $('.slick-slider').slick({
     slidesToScroll: 1,
     dots: false,
     arrows: true,
     centerMode: false,
     focusOnSelect: false,
     infinite: false,
     slidesToShow: 3.2,
     variableWidth: false,
     prevArrow: '<button class="slick-prev"> < </button>',
     nextArrow: '<button class="slick-next"> > </button>',
   });
   
   function destroyCarousel(slick_id) {
     if ($(slick_id).hasClass('slick-initialized')) {
       $(slick_id).slick('unslick');
     }
   }
   
   
   function applySlider(slick_id) {
     $(slick_id).slick({
       slidesToScroll: 1,
       dots: false,
       arrows: true,
       centerMode: false,
       focusOnSelect: false,
       infinite: false,
       slidesToShow: 3.2,
       variableWidth: false,
       prevArrow: '<button class="slick-prev"> < </button>',
       nextArrow: '<button class="slick-next"> > </button>',
     });
   }
   
   
   $('a.expandTopicCollapse span').click(function() {
     var spanId = this.id;
     var curr_text = $("#" + spanId).text();
     var updatetext = ((curr_text == 'Expand to Topics') ? 'Collapse Topics' : 'Expand to Topics');
     $("#" + spanId).text(updatetext);
   })
   
   
   
   /* getting Next Question Data */
   function show_topic(chapt_id, sub_id) {
   
     this.value = (this.value == 'Expand to Topics' ? 'Collapse Topics' : 'Expand to Topics');
   
     var topic_length = $('#topic_section_' + chapt_id + ' .topicList').length;
   
     if (topic_length == 0) {
       url = "{{ url('ajax_custom_topic/') }}/" + chapt_id;
       $.ajax({
         url: url,
         data: {
           "_token": "{{ csrf_token() }}",
         },
         beforeSend: function() {
           $('#overlay').fadeIn();
         },
         success: function(result) {
           var slick_id = "#topic_section_" + chapt_id;
           destroyCarousel(slick_id); // destroy slick slider first
   
           $("#topic_section_" + chapt_id + " div").remove();
           $("#topic_section_" + chapt_id).html(result);
   
           applySlider(slick_id); // apply slick slider again
   
           $('#overlay').fadeOut();
           $('#topic_form').show();
           // scroll_topic(chapt_id, sub_id);
           $("#myTabContent #chapter_box_" + chapt_id)[0].scrollIntoView();
   
         }
       });
     } else {
   
       $("#expand_topic_" + chapt_id).text("Expand to Topics");
       $("clicktopic_" + chapt_id).focus();
       $('#topic_form').toggle();
   
     }
   }
   
   function topiclist_filter(chapt_id, filter_type) {
   
     url = "{{ url('ajax_custom_topic/') }}/" + chapt_id;
     $.ajax({
       url: url,
       data: {
         "_token": "{{ csrf_token() }}",
         "filter_type": filter_type
       },
       beforeSend: function() {
         $('#overlay').fadeIn();
       },
       success: function(result) {
   
         $("#topic_section_" + chapt_id + " div").remove();
         $("#topic_section_" + chapt_id).html(result);
         /* $("#topic_section_" + chapt_id).html(result); */
         //$('#myTabContent .slick-slider').slick('refresh');
         $("#chapter_" + chapt_id + ' .slick-slider').slick('refresh');
   
         $('#overlay').fadeOut();
         $('#topic_form').show();
   
       }
     });
   
   }
   
   function chapterlist_filter(sub_id, filter_type) {
     url = "{{ url('filter_subject_chapter/') }}/" + sub_id;
     $.ajax({
       url: url,
       data: {
         "_token": "{{ csrf_token() }}",
         "filter_type": filter_type
       },
       beforeSend: function() {
         $('#overlay').fadeIn();
       },
       success: function(result) {
         $("#chapter_list_" + sub_id).html('');
         $("#chapter_list_" + sub_id).html(result);
   
         $('#overlay').fadeOut();
         $('.clear-filter').show();
   
   
       }
     });
   
   };
   
   function clear_chapter_filter(sub_id, filter_type) {
     url = "{{ url('filter_subject_chapter/') }}/" + sub_id;
     $.ajax({
       url: url,
       data: {
         "_token": "{{ csrf_token() }}",
         "filter_type": filter_type
       },
       beforeSend: function() {
         $('#overlay').fadeIn();
       },
       success: function(result) {
         $("#chapter_list_" + sub_id).html('');
         $("#chapter_list_" + sub_id).html(result);
   
         $('#overlay').fadeOut();
         $('.clear-filter').hide();
   
   
       }
     });
   
   };
   $(window).on('load', function() {
     $(".dash-nav-link a:first-child").removeClass("active-navlink");
     $(".dash-nav-link a:nth-child(2)").addClass("active-navlink");
   });
</script>
<script>
   $("body").on("click", ".expandTopicCollapse", function(event) {
     $(this).parents('.ClickBack').toggleClass('newelement');
   });
   
   function scroll_topic(chapter_id, sub_id) {
     var scrollpas = $('#chapter_list_' + sub_id).scrollTop();
     var blockpos = $('#clicktopic_' + chapter_id).offset().top;
     var scrollblock = $($('#clicktopic_' + chapter_id).attr('href')).offset().top;
   
     if (scrollpas > 0) {
   
       if (blockpos > 400) {
         $('#chapter_list_' + sub_id).animate({
           scrollTop: scrollblock + scrollpas - blockpos + 150
         }, 500);
       } else {
         $('#chapter_list_' + sub_id).animate({
           scrollTop: scrollblock + scrollpas - blockpos
         }, 500);
       };
   
     } else {
       if (scrollpas <= 0 && blockpos < 300) {
         $('#chapter_list_' + sub_id).animate({
           scrollTop: scrollblock - blockpos
         }, 500);
       } else if (scrollpas <= 0 && blockpos > 350) {
         $('#chapter_list_' + sub_id).animate({
           scrollTop: scrollblock - blockpos + 50
         }, 500);
       } else {
         $('#chapter_list_' + sub_id).animate({
           scrollTop: scrollblock - blockpos + scrollpas
         }, 500);
       };
     }
   }
</script>
<style>
   .newelement {
   background: white !important;
   border-radius: 21px;
   border: 6px solid #f2f2f2;
   margin-top: 14px;
   }
   .newelement form {
   margin-bottom: 0px;
   }
   .newelement button#dropdownMenuLink-topic {
   margin-top: 0px;
   }
   .clear_div {
   justify-content: end;
   }
   .custom-page #myTabContent .dropdown ul.dropdown-menu.cust-dropdown.show {
   top: calc(100% - 35px) !important;
   right: 0px !important;
   }
   .clear_div .dropdown {
   margin-left: 20px;
   }
   .clear-filter {
   color: #21ccff;
   font-size: 16px;
   padding-left: 13px;
   }
   /*******06-04-2022*****/    
   .result-list-table {
   background: #f6f9fd;
   border-radius: 15px;
   }
   .result-list-table .result-list-head{
   flex: 2;
   }  
   .result-list-head h4{
   color: #231f20;
   font-size: 16px;
   font-weight: 600;
   }
   .result-list-head p{
   color: #231f20;
   font-size: 15px;
   font-weight: 600;
   }
   .morning-slot{
   flex: 1.8;    
   }
   .morning-slot p{
   color: #231f20;
   font-size: 14px;
   font-weight: 400; 
   }
   .result-list-btns{
   flex: 1.5;    
   }
   .result-list-btns a{
   width: 57px;
   height: 48px;
   text-align: center;
   display: block;
   background: #f4f4f4;
   border-radius: 10px;
   color: #515151;
   }
   .result-list-btns a .fa{
   font-size: 17px;
   line-height: 48px;
   }
   .result-review{
   height: 48px;
   background: #f4f4f4;
   border-radius: 10px;
   color: #515151 !important;
   font-size: 16px;
   width: 75%;
   }
   .score-show {
   flex: 3;
   border-right: 1px solid #b9b9b9;
   }
   .score-show p{
   color: #231f20;
   font-size: 16px;
   font-weight: 600;
   }
   .score-show p span{
   color: #00baff;
   }
   .result-analysis {
   background: #13c5ff;
   background-color: #13c5ff;
   border-color: #13c5ff;
   box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
   font-size: 14px;
   font-weight: 600;
   color: #fff;
   border-radius: 20px;
   height: 45px;
   width: 208px;
   border: 0;
   }
   .paper-summery{
   flex: 5;
   }
   .paper-sub {
   font-size: 13px;
   }
   .paper-sub span {
   color: #00baff;
   font-size: 14px;
   font-weight: 600;
   }
   .paper-sub small {
   display: block;
   color: #231f20;
   font-size: 13px;
   font-weight: 600;
   }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
@endsection