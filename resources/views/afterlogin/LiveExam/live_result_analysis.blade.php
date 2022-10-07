@extends('afterlogin.layouts.app_new')
@section('content')
<div class="main-wrapper">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <div class="content-wrapper test_analytics_wrapper">
        <div class="container-fluid">
            <div class="mock_inst_text_mock_test mb-4">
                <a href="{{ url('/dashboard') }}" class="text-decoration-none"><i class="fa fa-angle-left" style="margin-right:8px"></i> Back to Dashboard</a>
            </div>
            @if($type_name=='Assessment')
            <h3 class="commonheading">Custom Exam</h3>
            @else
            <h3 class="commonheading">{{$type_name}}</h3>
            @endif

            <div class="d-flex mt-4 mb-4 align-items-end">
                <div class="question-attempted-block">
                    <span class="d-block mb-2 commontext">Questions Attempted</span>
                    <label class="m-0 commonboldtext">{{($response->correct_count+$response->wrong_count)}}/{{$response->no_of_question}}</label>
                </div>
                <div class="time-date-block">
                    <span class="d-block mb-2 commontext">{{!empty($response->test_attempted_date)?date("j F Y", strtotime($response->test_attempted_date)):''}}</span>
                    <p class="m-0">
                        <small class="commontext me-5 pe-4">
                            <svg style="vertical-align: bottom;" class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.999 22c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.999 6v6l4 2" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{$response->total_test_time/60}} Mins
                        </small>
                        <small class="commontext">
                            <svg style="vertical-align: bottom;" class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.999 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.999 2h-6a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{$response->total_exam_marks}} Marks
                        </small>
                    </p>
                </div>
                @php

                $test_name = base64_encode($type_name);
                @endphp
                <div class="text-right flexgrow">
                    <a href="{{route('exam_review',[$result_id,'attempted',$test_name])}}" class="btn btn-common-transparent" style="min-width: auto;">
                        <svg style="vertical-align:middle;" class="me-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4.802h4.8a3.2 3.2 0 0 1 3.198 3.2v11.197a2.4 2.4 0 0 0-2.4-2.4H4V4.802zM19.998 4.802H15.2A3.2 3.2 0 0 0 12 8.002v11.197a2.4 2.4 0 0 1 2.4-2.4h5.598V4.802z" stroke="#56B663" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Review Questions
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="commonWhiteBox commonblockDash test_myscrore_card borderRadius">
                        <h3 class="boxheading d-flex align-items-center">My Score
                            <span class="tooltipmain ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                    </g>
                                </svg>
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    This score indicates your readiness, based on your most recent test. <br> Score = (Total number of correct answers x Marking for correct response) – (Total number of incorrect answers x Marking for incorrect response) </p>
                            </span>
                        </h3>
                        <div class="row align-items-center">
                            <div class="col-xl-6">
                                <div class="halfdoughnut2 position-relative">
                                    <canvas id="myscoregraph"></canvas>
                                    <div class="myScore">
                                        <h6 class="m-0">{{$response->total_get_marks}}/{{$response->total_exam_marks}}</h6>
                                        <span>MARKS</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="color_labels">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Correct <b><small></small>{{$response->correct_count}}</b></span>
                                        <span>Incorrect <b><small></small>{{$response->wrong_count}}</b></span>
                                    </div>
                                    <span>Not Attempted <b><small style="background-color: #e5eaee;"></small>{{$response->not_answered}}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($type_exam) && !empty($type_exam) && ($type_exam =='Mocktest' || $type_exam =='Live' || $type_exam =='PreviousYear'))
                    <div class="commonWhiteBox commonblockDash borderRadius">
                        <h3 class="boxheading d-flex align-items-center">Marks
                            <span class="tooltipmain ml-2">
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
                        <div class="common_greenbadge_tabs">
                            <ul class="nav nav-pills mb-4 d-inline-flex mt-4" id="marks-tab" role="tablist">
                                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                @php $count_sub=count($response->subject_wise_result);
                                if($count_sub==1){
                                $disable_class="disabled" ;
                                }else{
                                $disable_class="";
                                }
                                @endphp
                                @if(empty($disable_class))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link btn active" id="pills-overall-tab" data-bs-toggle="pill" data-bs-target="#pills-overall" type="button" role="tab" aria-controls="pills-overall" aria-selected="true" onclick='resetData("all")'>Overall</button>
                                </li>
                                @endif
                                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                @foreach($response->subject_wise_result as $subject)
                                @php $subject=(object)$subject; @endphp
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link btn" id="{{$subject->subject_name}}" {{$disable_class }} data-bs-toggle="pill" data-bs-target="#pills-physics" type="button" role="tab" aria-controls="pills-physics" aria-selected="false" onclick='resetData("{{$subject->subject_id}}")'>{{$subject->subject_name}}</button>
                                </li>
                                @endforeach
                                @endif
                                @endif
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-overall" role="tabpanel" aria-labelledby="pills-overall-tab">
                                    <span class="d-block mb-1 commontext">Overall Marks</span>
                                    <label class="mb-3 commonboldtext" id="percentage" style="font-size: 24px;">{{isset($response->result_percentage)?number_format($response->result_percentage,2):0}}</label>
                                    <div class="overall_percentage_chart graph_padd">
                                        <span class="yaxis_label" style="left:-10px;"><small> Marks  </small></span>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(isset($type_exam) && !empty($type_exam) && $type_exam =='Live')
                    <div class="commonWhiteBox commonblockDash borderRadius rank_analysis_block" style=" height: 180px;">
                        <h3 class="boxheading d-flex align-items-center">Rank Analysis
                            <span class="tooltipmain ml-2">
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
                        <div class="d-flex justify-content-between mt-4">
                            <div class="your_rank position-relative" style="padding-left: 66px;">
                                <small>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 15a7 7 0 1 0 0-14 7 7 0 0 0 0 14z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.21 13.89 7 23l5-3 5 3-1.21-9.12" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </small>
                                <span class="d-block  commontext" style="color: #666;">Your rank</span>
                                <label class="m-0 commonboldtext" style="font-size:32px;">{{$response->user_rank}}
                                    @php
                                    $number = $response->user_rank;
                                    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                                    if (($number %100) >= 11 && ($number%100) <= 13){ $abbreviation='th' ; } else { $abbreviation=$ends[$number % 10]; } @endphp <sub style="font-size: 16px;font-weight: 500;color: #1f1f1f;margin-left: -5px;top: -18px;">{{$abbreviation}}</sub></label>
                            </div>
                            <div class="total_participants">
                                <span class="d-block commontext" style="color: #666;">Total Participants</span>
                                <label class="m-0 commonboldtext" style="font-size:32px;">{{$response->total_participants}}</label>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-7">
                    @if(isset($type_exam) && !empty($type_exam) && ($type_exam =='Mocktest' || $type_exam =='Live' || $type_exam =='PreviousYear'))
                    <div class="commonWhiteBox commonblockDash subject_score_card borderRadius">
                        <h3 class="boxheading d-flex align-items-center">Subject Score
                            <span class="tooltipmain ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                    </g>
                                </svg>
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    Total score split into subject-wise performance.                                </p>
                            </span>
                        </h3>
                        <p class="dashSubtext mb-4">Negative marking for incorrect answers is considered.</p>
                        <div class="row">
                            @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                            @foreach($response->subject_wise_result as $subject)
                            @php $subject=(object)$subject; @endphp
                            @php
                            $correct_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->correct_count/$subject->total_questions)*100),2):0;
                            $incorrect_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->incorrect_count/$subject->total_questions)*100),2):0;
                            $not_attempt_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->unanswered_count/$subject->total_questions)*100),2):0;
                            @endphp
                            <div class="col-sm-6 mb-5 col-md-12 col-lg-6"">
                                <h5 class="mb-0">{{$subject->subject_name}}</h5>
                                <div class="d-flex align-items-center">
                                    <div class="halfdoughnut">
                                        <canvas id="subjectChart_{{$subject->subject_id}}"></canvas>
                                    </div>
                                    <script type="text/javascript">
                                        var ids = 'subjectChart_<?php echo $subject->subject_id ?>';
                                        var circuference = 180;
                                        var data = {
                                            labels: ["Correct", "Incorrect", "Not Attempted"],
                                            datasets: [{
                                                label: "My First Dataset",
                                                data: [<?php echo $correct_per; ?>, <?php echo $incorrect_per; ?>, <?php echo $not_attempt_per; ?>],
                                                backgroundColor: [
                                                    "#08d5a1",
                                                    "#fb7686",
                                                    "#f2f4f7"
                                                ]
                                            }]
                                        };
                                        var config = {
                                            type: "doughnut",
                                            data: data,
                                            options: {
                                                reponsive: true,
                                                maintainAspectRatio: false,
                                                rotation: (circuference / 2) * -1,
                                                circumference: circuference,
                                                cutout: "60%",
                                                borderWidth: 0,
                                                borderRadius: function(context, options) {
                                                    const index = context.dataIndex;
                                                    let radius = {};
                                                    if (index == 0) {
                                                        radius.innerStart = 0;
                                                        radius.outerStart = 0;
                                                    }
                                                    if (index === context.dataset.data.length - 1) {
                                                        radius.innerEnd = 0;
                                                        radius.outerEnd = 0;
                                                    }
                                                    return radius;
                                                },
                                                plugins: {
                                                    title: false,
                                                    subtitle: false,
                                                    legend: false
                                                },
                                            }
                                        };
                                        var myCharted = new Chart(ids, config)
                                    </script>
                                    <div class="color_labels ms-5">
                                        <span class="d-block">Correct <b><small></small>{{$subject->correct_count}}</b></span>
                                        <span class="d-block mt-3 mb-3">Incorrect <b><small></small>{{$subject->incorrect_count}}</b></span>
                                        <span class="d-block">Not Attempted <b><small style="background-color: #e5eaee;"></small>{{$subject->unanswered_count}}</b></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="commonWhiteBox commonblockDash borderRadius">
                        <h3 class="boxheading d-flex align-items-center">Topic Score
                            <span class="tooltipmain ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                    </g>
                                </svg>
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    Test analytics broken down to the topic level so that you can see the difference each topic makes.
                                </p>
                            </span>
                        </h3>

                        <div class="common_greenbadge_tabs">
                            <div class="row mt-4 align-items-center">
                                <div class="col-12">
                                    <div class="d-flex  color_labels mb-4">
                                        <span style="margin-left: 4px;"><small></small> Correct</span>
                                        <span class="colorLabels"><small></small> Incorrect</span>
                                        <span><small></small> Not Attempted</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="nav nav-pills  d-inline-flex" id="topic-tab" role="tablist">
                                        @php $subx=1; @endphp
                                        @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                        @foreach($response->subject_wise_result as $subject)
                                        @php $subject=(object)$subject; @endphp
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn @if($subx==1) active @endif" id="{{$subject->subject_name}}_tab_subject" data-bs-toggle="tab" href="#{{$subject->subject_name}}_subject" role="tab" aria-controls="{{$subject->subject_name}}" aria-selected="true">{{$subject->subject_name}}</a>
                                        </li>
                                        @php $subx++; @endphp
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                @php $topx=1; @endphp
                                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                @foreach($response->subject_wise_result as $subject)
                                @php $subject=(object)$subject;
                                $subject_id=$subject->subject_id;
                                @endphp
                                <div class="tab-pane fade show @if($topx==1) active @endif" id="{{$subject->subject_name}}_subject" role="tabpanel" aria-labelledby="{{$subject->subject_name}}_tab_subject">
                                    <!-- <ul class="topic_score_lists d-flex justify-content-between flex-wrap">
                                        @if(isset($response->topic_wise_result) && !empty($response->topic_wise_result))
                                        @foreach($response->topic_wise_result as $topic)
                                        @php $topic=(object)$topic; @endphp
                                        @php
                                        $tcorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?round((($topic->correct_count/$topic->total_questions)*100), 2):0;
                                        $tincorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?round((($topic->incorrect_count/$topic->total_questions)*100), 2):0;
                                        $tnot_attempt_per=(100-($tcorrect_per+$tincorrect_per));
                                        @endphp
                                        @if($topic->subject_id==$subject_id && !empty($topic->topic_name))
                                        <li>
                                            <div class="topic_score_bar dropdown">
                                                <h4>@if(!empty($topic->topic_name)) {{$topic->topic_name}}
                                                    @else
                                                    ""
                                                    @endif</h4>
                                                <div class="progress dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    @if($tcorrect_per > 0)
                                                    <div class="progress-bar correct-bg" role="progressbar" style="width: {{$tcorrect_per}}%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @endif
                                                    @if($tincorrect_per > 0)
                                                    <div class="progress-bar incorrect-bg" role="progressbar" style="width: {{$tincorrect_per}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @endif
                                                    @if($tnot_attempt_per > 0)
                                                    <div class="progress-bar not-attempted-bg" role="progressbar" style="width: {{$tnot_attempt_per}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @endif
                                                </div>
                                                <ul class="dropdown-menu noofquestions-block" aria-labelledby="dropdownMenuButton1">
                                                    <h5 style="font-size: 14px;font-weight: 600;color: #000;margin-bottom: 20px;">Number of questions</h5>
                                                    <div class="color_labels">
                                                        <span class="d-block"><small></small> Correct <b>{{$topic->correct_count}}</b></span>
                                                        <span class="d-block mt-3 mb-3"><small></small> Incorrect <b>{{$topic->incorrect_count}}</b></span>
                                                        <span class="d-block"><small></small> Not Attempted <b>{{$topic->unanswered_count}}</b></span>
                                                    </div>
                                                </ul>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif
                                    </ul> -->
                                    <ul class="topic_score_lists d-flex justify-content-between flex-wrap">
                                        @if(isset($response->topic_wise_result) && !empty($response->topic_wise_result))
                                        @foreach($response->topic_wise_result as $topic)
                                        @php $topic=(object)$topic; @endphp
                                        @php
                                        $tcorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?round((($topic->correct_count/$topic->total_questions)*100), 2):0;
                                        $tincorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?round((($topic->incorrect_count/$topic->total_questions)*100), 2):0;
                                        $tnot_attempt_per=(100-($tcorrect_per+$tincorrect_per));
                                        @endphp
                                        @if($topic->subject_id==$subject_id && !empty($topic->topic_name))
                                        <li>
                                            <div class="topic_score_bar">
                                                <h4>@if(!empty($topic->topic_name)) {{$topic->topic_name}}
                                                    @else
                                                    ""
                                                    @endif</h4>
                                                <div class="dropdown position-static d-inline-block">
                                                    <div class="Chapter_Main_Graph progress dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <canvas id="topicScore_{{$topic->topic_id}}"></canvas>
                                                        <script type="text/javascript">
                                                            var circuference = 360;
                                                            var data = {
                                                                labels: ["Correct", "Incorrect", "Not Attempted"],
                                                                datasets: [{
                                                                    label: "My First Dataset",
                                                                    data: [<?php echo $tcorrect_per; ?>,<?php echo $tincorrect_per; ?>,<?php echo $tnot_attempt_per; ?>],
                                                                    backgroundColor: [
                                                                        "#34d399",
                                                                        "#ff6678",
                                                                        "#7db9ff",
                                                                    ]
                                                                }]
                                                            };
                                                            var config = {
                                                                type: "doughnut",
                                                                data: data,
                                                                options: {
                                                                    reponsive: true,
                                                                    maintainAspectRatio: false,
                                                                    circumference: circuference,
                                                                    cutout: "50%",
                                                                    borderWidth: 0,
                                                                    borderRadius: function(context, options) {
                                                                        const index = context.dataIndex;
                                                                        let radius = {};
                                                                        if (index == 0) {
                                                                            radius.innerStart = 0;
                                                                            radius.outerStart = 0;
                                                                        }
                                                                        if (index === context.dataset.data.length - 1) {
                                                                            radius.innerEnd = 0;
                                                                            radius.outerEnd = 0;
                                                                        }
                                                                        return radius;
                                                                    },
                                                                    plugins: {
                                                                        title: false,
                                                                        subtitle: false,
                                                                        legend: false,
                                                                        tooltip: false

                                                                    },

                                                                }
                                                            };
                                                            var myCharted = new Chart("topicScore_{{$topic->topic_id}}", config)
                                                        </script>
                                                    </div>
                                                    <ul class="dropdown-menu noofquestions-block" aria-labelledby="dropdownMenuButton1">
                                                        <h5 style="font-size: 14px;font-weight: 600;color: #000;margin-bottom: 20px;">Number of questions</h5>
                                                        <div class="color_labels">
                                                            <span class="d-block"><small></small> Correct <b>{{$topic->correct_count}}</b></span>
                                                            <span class="d-block mt-3 mb-3"><small></small> Incorrect <b>{{$topic->incorrect_count}}</b></span>
                                                            <span class="d-block"><small></small> Not Attempted <b>{{$topic->unanswered_count}}</b></span>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                @php $topx++; @endphp
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end" style="margin-top:20px;">
                <button class="btn btn-common-transparent scroll-top" style="min-width: auto;">Scroll to top</button>
            </div>
        </div>
    </div>
</div>
@php
$correct_cnt=isset($response->correct_count)?$response->correct_count:0;
$incorrect_cnt=isset($response->wrong_count)?$response->wrong_count:0;
$not_attempt=isset($response->total_exam_marks)?$response->total_exam_marks:0;
$total_question = $response->no_of_question;
$total_makrs=isset($response->total_exam_marks)?$response->total_exam_marks:0;
$correct_score=isset($response->correct_score)?$response->correct_score:0;
$incorrect_score=isset($response->incorrect_score)?$response->incorrect_score:0;
$get_score=(isset($response->total_get_marks) && !empty($response->total_get_marks))?$response->total_get_marks:0;
$get_score_json=json_encode($get_score);
$class_average=(isset($response->class_average) && ($response->class_average)>=0)?$response->class_average:0;
$class_average_json=json_encode($class_average);
$correct_per_pie=!empty($total_question)?round((($correct_cnt/$total_question)*100),2):0;
$incorrect_per_pie=!empty($total_question)?round((($incorrect_cnt/$total_question)*100),2):0;

$not_attempt_per_pie=(100-($correct_per_pie+$incorrect_per_pie)>=0)? 100-($correct_per_pie+$incorrect_per_pie):0;

$subject_graph=isset($response->subject_graph)?$response->subject_graph:0;
$subject_wise_result=isset($response->subject_wise_result)?$response->subject_wise_result:0;
$subject_id = array_map(function($e) {
    return is_object($e) ? $e->subject_id : $e['subject_id'];
}, $subject_wise_result);
$stuscore_arr=$clsAvg_arr=[];
$stuscore=$clsAvg=0;
foreach($subject_graph as $key=>$gh){
    if (in_array($gh->subject_id, $subject_id))
    {
        $stuscore=$stuscore+$gh->student_score_percentage;
        $clsAvg=$clsAvg+$gh->class_score;
    }
}
//$total_sub=count($subject_graph);
$total_sub=count($subject_wise_result);

if($total_sub > 0)
{
    $stuscore=$stuscore/$total_sub;
    $clsAvg=$clsAvg/$total_sub;
}
$stuscore_arr[]=$stuscore;
$stuscore_json=json_encode($stuscore_arr);
$clsAvg_arr[]=round($clsAvg,2);
$clsAvg_json=json_encode($clsAvg_arr);
@endphp
@if(isset($type_exam) && !empty($type_exam) && ($type_exam =='Mocktest' || $type_exam =='Live' || $type_exam =='PreviousYear'))
<script>
    /*********** BarChart ***********/
    var student_scr = '<?php echo $stuscore ?>';
    var student_bar_color = '#56b663';
    if (student_scr < 0) {
        student_bar_color = '#E74969';
    }
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['My Marks', 'Class Average'],
            datasets: [{
                data: ['{{$stuscore}}', '{{$clsAvg}}'],
                label: '',
                backgroundColor: [
                    student_bar_color,
                    '#08d5a1'
                ],
                barPercentage: 5,
                barThickness: 80,
                maxBarThickness: 80
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
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
                },

                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function resetData(subject_id) {
        if (subject_id == 'all') {
            myChart.data.datasets[0].data = ['{{$stuscore}}', '{{$clsAvg}}'];
            myChart.data.datasets[0].backgroundColor = [student_bar_color, '#08d5a1'];
            myChart.update();
            let overall_percent = '<?php echo number_format($response->result_percentage, 2); ?>';
            $("#percentage").val(overall_percent);

        } else {
            var graphArr = <?php echo json_encode($subject_graph); ?>;
            var studet_score = [];
            var class_score = [];
            const iterator = graphArr.values();
            for (const value of iterator) {
                if (value.subject_id == subject_id) {
                    studet_score.push(value.student_score_percentage)
                    studet_score.push(value.class_score)
                    var percentage = value.student_score_percentage
                }
            }
            var student_subject_color = '#56b663';
            if (percentage < 0) {
                student_subject_color = '#E74969';
            }
            myChart.data.datasets[0].data = studet_score;
            myChart.data.datasets[0].backgroundColor = [student_subject_color, '#08d5a1'];
            myChart.update();

            $("#percentage").val(percentage);
        }
    }
</script>
@endif
<script>
    /***********my-score************************* */
    const myscorecir = 260;
    const myscoredata = {
        labels: ["Correct", "Incorrect", "Not Attempted"],
        datasets: [{
            label: "My First Dataset",
            data: [<?php echo $correct_per_pie; ?>, <?php echo $incorrect_per_pie; ?>, <?php echo $not_attempt_per_pie; ?>],
            backgroundColor: [
                "#08d5a1",
                "#fb7686",
                "#f2f4f7"
            ]
        }]
    };
    const myscoreconfig = {
        type: "doughnut",
        data: myscoredata,
        options: {
            reponsive: true,
            maintainAspectRatio: false,
            rotation: (myscorecir / 2) * -1,
            circumference: myscorecir,
            cutout: "85%",
            borderWidth: 0,
            borderRadius: function(context, options) {
                const index = context.dataIndex;
                let radius = {};
                // if (index == 0) {
                //     radius.innerStart = 20;
                //     radius.outerStart = 20;
                // }
                // if (index === context.dataset.data.length - 1) {
                //     radius.innerEnd = 20;
                //     radius.outerEnd = 20;
                // }
                if (index == 0) {
                    radius.innerStart = 20;
                    radius.outerStart = 20;
                    if (context.dataset.data[index + 1] == 0 && context.dataset.data[index + 2] == 0) {
                        radius.innerEnd = 20;
                        radius.outerEnd = 20;
                    }
                }
                if (index == 1) {
                    if (context.dataset.data[index - 1] == 0) {
                        radius.innerStart = 20;
                        radius.outerStart = 20;
                    }
                    if (context.dataset.data[index + 1] == 0) {
                        radius.innerEnd = 20;
                        radius.outerEnd = 20;
                    }
                }
                if (index == 2) {
                    if (context.dataset.data[index - 1] == 0 && context.dataset.data[index - 2] == 0) {
                        radius.innerStart = 20;
                        radius.outerStart = 20;
                    }
                }
                if (index === context.dataset.data.length - 1) {
                    radius.innerEnd = 20;
                    radius.outerEnd = 20;
                }
                return radius;
            },
            plugins: {
                title: false,
                subtitle: false,
                legend: false
            },
        }
    };
    const myscore = new Chart("myscoregraph", myscoreconfig)
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
    $(document).on('click', function(e) {
        var card_opened = $('.tooltipclass').hasClass('show');
        if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
            $('.tooltipclass').hide();
            $('.tooltipclass').removeClass('show');
        }
    });
    
    $(".topic_score_bar .dropdown").hover(function() {
        $(this).children(".progress.dropdown-toggle").trigger('click');
    });
   
</script>
@include('afterlogin.layouts.footer_new')
@endsection