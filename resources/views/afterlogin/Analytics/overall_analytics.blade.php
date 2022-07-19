@extends('afterlogin.layouts.app_new')
@section('content')
@include('afterlogin.layouts.sidebar_new')
<div class="main-wrapper">
    @include('afterlogin.layouts.navbar_header_new')
    <div class="content-wrapper test_analytics_wrapper">
        <div class="tabMainblock">
            <div class="commontab aeck_commontab">
                <div class="tablist">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link qq1_2_3_4 active" data-bs-toggle="tab" href="#overall">Overall Analytics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#math">Math</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#physics">Physics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#chemistry">Chemistry</a>
                        </li>
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="tab-content aect_tabb_contantt">
                    <div id="overall" class=" tab-pane active">
                        <div class="overallmain">
                            <div class="overalltop">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="commonWhiteBox">
                                            <h3 class="boxheading d-flex align-items-center mb-5">Progress
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
                                            <div class="overall_percentage_chart">
                                                <canvas id="myChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="commonWhiteBox">
                                            <div class="subjectperform">
                                                <h3 class="boxheading d-flex align-items-center">Subject Performance
                                                    <span class="tooltipmain ml-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"></path>
                                                            </g>
                                                        </svg>
                                                        <p class="tooltipclass">
                                                            <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                                        </p>
                                                    </span>
                                                </h3>
                                                <div class="subjectperformLegend flexleg">
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar greenbar"></span>
                                                        <label class="text">Correct answer</label>
                                                    </div>
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar pinkbar"></span>
                                                        <label class="text">Incorrect answer</label>
                                                    </div>
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar graybar"></span>
                                                        <label class="text">Unattempted questions</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if(!empty($subProf))
                                                    @foreach($subProf as $key=>$sub)
                                                    <div class="col-md-6">
                                                        <div class="subjectblockOverall">
                                                            <div class="textblock">
                                                                <h3>{{$sub->subject_name}}</h3>
                                                                <h5>Proficiency</h5>
                                                                <h6>{{round($sub->score)}}%</h6>
                                                            </div>
                                                            <div class="halfdoughnutsmall">
                                                                @php
                                                                $correct_score=0;
                                                                $incorrect_ans=0;
                                                                $unanswered =0;
                                                                if(isset($sub->correct_ans) && $sub->correct_ans > 0)
                                                                {
                                                                $correct_score=$sub->correct_ans;
                                                                }
                                                                if(isset($sub->incorrect_ans) && $sub->incorrect_ans > 0)
                                                                {
                                                                $incorrect_ans=$sub->incorrect_ans;
                                                                }
                                                                if(isset($sub->unanswered) && $sub->unanswered > 0)
                                                                {
                                                                $unanswered=$sub->unanswered;
                                                                }
                                                                @endphp
                                                                <canvas id="subjectChart_{{$sub->subject_name}}"></canvas>
                                                                <script type="text/javascript">
                                                                var circuference = 180;
                                                                var data = {
                                                                    labels: ["Correct", "Incorrect", "Not Attempted"],
                                                                    datasets: [{
                                                                        label: "My First Dataset",
                                                                        data: [<?php echo $correct_score; ?>, <?php echo $incorrect_ans; ?>, <?php echo $unanswered; ?>],
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
                                                                var myCharted = new Chart("subjectChart_{{$sub->subject_name}}", config)

                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overallMidlle">
                                <div class="commonWhiteBox">
                                    <h3 class="boxheading">Time Management
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="timemanagement common_greenbadge_tabs">
                                                <h4 class="garphsubheading mt-2">Time for correct/incorrect answer</h4>
                                                <div class="barwithTAb">
                                                    <div class="subjectperformLegend ">
                                                        <div class="commonSubjectLeg">
                                                            <span class="bar greenbar"></span>
                                                            <label class="text">Correct Answers</label>
                                                        </div>
                                                        <div class="commonSubjectLeg">
                                                            <span class="bar pinkbar"></span>
                                                            <label class="text">Incorrect answers</label>
                                                        </div>
                                                    </div>
                                                    <div class="righttabBlock">
                                                        <ul class="nav nav-pills mb-4 d-inline-flex mt-4" id="marks-tab1" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link btn active" id="pills-Day1-tab" data-bs-toggle="pill" data-bs-target="#pills-Day1" type="button" role="tab" aria-controls="pills-Day1" aria-selected="true">Day</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link btn" id="pills-Week1-tab" data-bs-toggle="pill" data-bs-target="#pills-Week1" type="button" role="tab" aria-controls="pills-Week1" aria-selected="false">Week</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link btn" id="pills-Month1-tab" data-bs-toggle="pill" data-bs-target="#pills-Month1" type="button" role="tab" aria-controls="pills-Month1" aria-selected="false">Month</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-Day1" role="tabpanel" aria-labelledby="pills-Day1-tab">
                                                        <div>
                                                            <canvas id="timeManagementChart"></canvas>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-Week1" role="tabpanel" aria-labelledby="pills-Week1-tab">Week</div>
                                                    <div class="tab-pane fade" id="pills-Month1" role="tabpanel" aria-labelledby="pills-Month1-tab">Month</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="timemanagement">
                                                <h4 class="garphsubheading">Time spent on each question <span>(in Last week)</span></h4>
                                                <div class="subjectperformLegend ">
                                                    <div class="commonSubjectLeg spaceright">
                                                        <span class="bar bluebar"></span>
                                                        <label class="text">Class Average</label>
                                                    </div>
                                                    <div class="commonSubjectLeg spaceright">
                                                        <span class="bar greenbar"></span>
                                                        <label class="text">Student average</label>
                                                    </div>
                                                </div>
                                                <div class="chartspent">
                                                    <canvas id="timeSpent_Graph"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overallMidlle">
                            <div class="commonWhiteBox">
                                <h3 class="boxheading">Marks Trends
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="timemanagement common_greenbadge_tabs">
                                            <h4 class="garphsubheading mt-2">Correct and Incorrect answers</h4>
                                            <div class="barwithTAb">
                                                <div class="subjectperformLegend ">
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar greenbar"></span>
                                                        <label class="text">Class Average</label>
                                                    </div>
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar pinkbar"></span>
                                                        <label class="text">Student average</label>
                                                    </div>
                                                </div>
                                                <div class="righttabBlock">
                                                    <ul class="nav nav-pills mb-4 d-inline-flex mt-4" id="marks-tab2" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn active" id="pills-Day2-tab" data-bs-toggle="pill" data-bs-target="#pills-Day2" type="button" role="tab" aria-controls="pills-Day2" aria-selected="true">Day</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn" id="pills-Week2-tab" data-bs-toggle="pill" data-bs-target="#pills-Week2" type="button" role="tab" aria-controls="pills-Week2" aria-selected="false">Week</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn" id="pills-Month2-tab" data-bs-toggle="pill" data-bs-target="#pills-Month2" type="button" role="tab" aria-controls="pills-Month2" aria-selected="false">Month</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-content" id="pills-tabContent2">
                                                <div class="tab-pane fade show active" id="pills-Day2" role="tabpanel" aria-labelledby="pills-Day2-tab">
                                                    <div class="chartspent">
                                                        <canvas id="mark_trend"></canvas>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-Week2" role="tabpanel" aria-labelledby="pills-Week2-tab">Week2</div>
                                                <div class="tab-pane fade" id="pills-Month2" role="tabpanel" aria-labelledby="pills-Month2-tab">Month2</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="timemanagement">
                                            <h4 class="garphsubheading">Accuracy Percentage <span>(in Last week)</span></h4>
                                            <div class="subjectperformLegend ">
                                                <div class="commonSubjectLeg spaceright">
                                                    <span class="bar bluebar"></span>
                                                    <label class="text">Class Average</label>
                                                </div>
                                                <div class="commonSubjectLeg spaceright">
                                                    <span class="bar greenbar"></span>
                                                    <label class="text">Student average</label>
                                                </div>
                                            </div>
                                            <div class="chartspent">
                                                <canvas id="accuracy_graph"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="math" class=" tab-pane">
                        <div class="overallmain">
                            <div class="overalltop">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="commonWhiteBox h-auto subj_progress_card">
                                            <h3 class="boxheading d-flex align-items-center mb-5">Progress
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
                                            <div class="overall_percentage_chart">
                                                <canvas id="mathChart"></canvas>
                                            </div>
                                        </div>
                                        <div class="commonWhiteBox chapter_performance_card h-auto" style="margin-top:20px;">
                                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <h3 class="boxheading d-flex align-items-center mb-0">Chapter Performance
                                                    <span class="tooltipmain">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"></path>
                                                            </g>
                                                        </svg>
                                                        <p class="tooltipclass">
                                                            <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                                        </p>
                                                    </span>
                                                </h3>
                                                <div class="mock_inst_text_mock_test">
                                                    <a href="javascript:void(0)" class="text-decoration-none">Expand <i class="fa fa-angle-right" style="margin-left:8px" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between color_labels">
                                                <span><small></small> Correct answer</span>
                                                <span><small></small> Incorrect answer</span>
                                                <span><small></small> Unattempted questions</span>
                                            </div>
                                            <ul class="topic_score_lists mb-0">
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Permutations and Combinations</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width:50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <!--------------->
                                                        <div class="noofquestions-block">
                                                            <h5 style="font-size: 14px;font-weight: 600;color: #000;margin-bottom: 20px;">Number of questions</h5>
                                                            <div class="color_labels">
                                                                <span class="d-block"><small></small> Correct <b>6</b></span>
                                                                <span class="d-block mt-3 mb-3"><small></small> Incorrect <b>1</b></span>
                                                                <span class="d-block"><small></small> Not Attempted <b>1</b></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Permutations and Combinations</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width:50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Permutations and Combinations</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width:50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Permutations and Combinations</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width:50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="topic_score_bar">
                                                        <h4>Circular Motion And Gravitation</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar correct-bg" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar incorrect-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar not-attempted-bg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="commonWhiteBox">
                                            <div class="subjectperform">
                                                <h3 class="boxheading d-flex align-items-center">Core Learning Skill
                                                    <span class="tooltipmain ml-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"></path>
                                                            </g>
                                                        </svg>
                                                        <p class="tooltipclass">
                                                            <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                                        </p>
                                                    </span>
                                                </h3>
                                                <div class="codelearningBlock">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="commoncodeblock">
                                                                <div class="codelerheader">
                                                                    <h3>Evaluation</h3>
                                                                </div>
                                                                <div class="codelerninner">
                                                                    <h5>Evaluation tells you you problem solving skills</h5>
                                                                    <p> <strong>20%</strong> % of questions are of evaluation skills. This skill helps you to determine your <a href="javascript:;">read more...</a></p>
                                                                </div>
                                                                <div class="codebottom">
                                                                    <h6>Your accuracy</h6>
                                                                    <h2>50%</h2>
                                                                    <div class="percentageblock">
                                                                        <a href="#Evaluationmodal" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Evaluationmodal">Know more
                                                                            <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                                    <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="commoncodeblock">
                                                                <div class="codelerheader">
                                                                    <h3>Comprehension</h3>
                                                                </div>
                                                                <div class="codelerninner">
                                                                    <h5>It tells you your skill of understanding a problem</h5>
                                                                    <p> <strong>20%</strong> % of questions are of evaluation skills. This skill helps you to determine your <a href="javascript:;">read more...</a></p>
                                                                </div>
                                                                <div class="codebottom">
                                                                    <h6>Your accuracy</h6>
                                                                    <h2>20%</h2>
                                                                    <div class="percentageblock">
                                                                        <a href="javascript:;" class="commmongreenLink">Know more
                                                                            <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                                    <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="commoncodeblock mb-0">
                                                                <div class="codelerheader">
                                                                    <h3>Application</h3>
                                                                </div>
                                                                <div class="codelerninner">
                                                                    <h5>Evaluation tells you you problem solving skills</h5>
                                                                    <p> <strong>20%</strong> % of questions are of evaluation skills. This skill helps you to determine your <a href="javascript:;">read more...</a></p>
                                                                </div>
                                                                <div class="codebottom">
                                                                    <h6>Your accuracy</h6>
                                                                    <h2>40%</h2>
                                                                    <div class="percentageblock">
                                                                        <a href="javascript:;" class="commmongreenLink">Know more
                                                                            <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                                    <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="commoncodeblock mb-0">
                                                                <div class="codelerheader">
                                                                    <h3>Knowledge</h3>
                                                                </div>
                                                                <div class="codelerninner">
                                                                    <h5>Evaluation tells you you problem solving skills</h5>
                                                                    <p> <strong>20%</strong> % of questions are of evaluation skills. This skill helps you to determine your <a href="javascript:;">read more...</a></p>
                                                                </div>
                                                                <div class="codebottom">
                                                                    <h6>Your accuracy</h6>
                                                                    <h2>20%</h2>
                                                                    <div class="percentageblock">
                                                                        <a href="javascript:;" class="commmongreenLink">Know more
                                                                            <span class="greenarrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                                                    <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </span>
                                                                        </a>
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
                            <div class="overallMidlle">
                                <div class="commonWhiteBox">
                                    <h3 class="boxheading">Time Management
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="timemanagement common_greenbadge_tabs">
                                                <h4 class="garphsubheading mt-2">Time for correct/incorrect answer</h4>
                                                <div class="barwithTAb">
                                                    <div class="subjectperformLegend ">
                                                        <div class="commonSubjectLeg">
                                                            <span class="bar greenbar"></span>
                                                            <label class="text">Correct Answers</label>
                                                        </div>
                                                        <div class="commonSubjectLeg">
                                                            <span class="bar pinkbar"></span>
                                                            <label class="text">Incorrect answers</label>
                                                        </div>
                                                    </div>
                                                    <div class="righttabBlock">
                                                        <ul class="nav nav-pills mb-4 d-inline-flex mt-4" id="marks-tab3" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link btn active" id="pills-Day3-tab" data-bs-toggle="pill" data-bs-target="#pills-Day3" type="button" role="tab" aria-controls="pills-Day3" aria-selected="true">Day</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link btn" id="pills-Week3-tab" data-bs-toggle="pill" data-bs-target="#pills-Week3" type="button" role="tab" aria-controls="pills-Week3" aria-selected="false">Week</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link btn" id="pills-Month3-tab" data-bs-toggle="pill" data-bs-target="#pills-Month3" type="button" role="tab" aria-controls="pills-Month3" aria-selected="false">Month</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-Day3" role="tabpanel" aria-labelledby="pills-Day3-tab">
                                                        <div>
                                                            <canvas id="timeManagementChart2"></canvas>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-Week3" role="tabpanel" aria-labelledby="pills-Week3-tab">Week</div>
                                                    <div class="tab-pane fade" id="pills-Month3" role="tabpanel" aria-labelledby="pills-Month3-tab">Month</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="timemanagement">
                                                <h4 class="garphsubheading">Time spent on each question <span>(in Last week)</span></h4>
                                                <div class="subjectperformLegend ">
                                                    <div class="commonSubjectLeg spaceright">
                                                        <span class="bar bluebar"></span>
                                                        <label class="text">Class Average</label>
                                                    </div>
                                                    <div class="commonSubjectLeg spaceright">
                                                        <span class="bar greenbar"></span>
                                                        <label class="text">Student average</label>
                                                    </div>
                                                </div>
                                                <div class="chartspent">
                                                    <canvas id="timeSpent_Graph2"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overallMidlle">
                            <div class="commonWhiteBox">
                                <h3 class="boxheading">Marks Trends
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="timemanagement common_greenbadge_tabs">
                                            <h4 class="garphsubheading mt-2">Correct and Incorrect answers</h4>
                                            <div class="barwithTAb">
                                                <div class="subjectperformLegend ">
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar greenbar"></span>
                                                        <label class="text">Class Average</label>
                                                    </div>
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar pinkbar"></span>
                                                        <label class="text">Student average</label>
                                                    </div>
                                                </div>
                                                <div class="righttabBlock">
                                                    <ul class="nav nav-pills mb-4 d-inline-flex mt-4" id="marks-tab4" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn active" id="pills-Day4-tab" data-bs-toggle="pill" data-bs-target="#pills-Day4" type="button" role="tab" aria-controls="pills-Day4" aria-selected="true">Day</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn" id="pills-Week4-tab" data-bs-toggle="pill" data-bs-target="#pills-Week4" type="button" role="tab" aria-controls="pills-Week4" aria-selected="false">Week</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn" id="pills-Month4-tab" data-bs-toggle="pill" data-bs-target="#pills-Month4" type="button" role="tab" aria-controls="pills-Month4" aria-selected="false">Month</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-content" id="pills-tabContent2">
                                                <div class="tab-pane fade show active" id="pills-Day4" role="tabpanel" aria-labelledby="pills-Day4-tab">
                                                    <div class="chartspent">
                                                        <canvas id="mark_trend2"></canvas>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-Week4" role="tabpanel" aria-labelledby="pills-Week4-tab">Week2</div>
                                                <div class="tab-pane fade" id="pills-Month4" role="tabpanel" aria-labelledby="pills-Month4-tab">Month2</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="timemanagement">
                                            <h4 class="garphsubheading">Accuracy Percentage <span>(in Last week)</span></h4>
                                            <div class="subjectperformLegend ">
                                                <div class="commonSubjectLeg spaceright">
                                                    <span class="bar bluebar"></span>
                                                    <label class="text">Class Average</label>
                                                </div>
                                                <div class="commonSubjectLeg spaceright">
                                                    <span class="bar greenbar"></span>
                                                    <label class="text">Student average</label>
                                                </div>
                                            </div>
                                            <div class="chartspent">
                                                <canvas id="accuracy_graph2"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="physics" class=" tab-pane">
                        <div class="overallmain">Physics</div>
                    </div>
                    <div id="chemistry" class=" tab-pane">
                        <div class="overallmain">chem</div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>
    </div>
</div>
<!-- Evaluation-popup start  -->
<div class="modal fade overall_evaluationmodal_modal" id="Evaluationmodal">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                    <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="intraction_text_strength mt-0">Evaluation</div>
                    <hr>
                    <div class="instruction_text_content"><strong class="blackcolor">20 %</strong> of questions are of evaluation skills. This skill helps you to determine your ability to understand the complexity of information by breaking into parts and examine them individually and judge in accordance with the received information.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Evaluation-popup end -->
<script>
/*********** BarChart ***********/
/***overall-progress chart***** */
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Previous Score', 'Latest score'],
        datasets: [{
            data: [<?php echo $mockTestScorePre; ?>, <?php echo $mockTestScoreCurr; ?>],
            label: '',
            backgroundColor: [
                '#6ee7b7',
                '#56b663'
            ],
            barPercentage: 5,
            barThickness: 80,
            maxBarThickness: 80
        }]
    },
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
            },

            y: {
                beginAtZero: true
            }
        }
    }
});
/***overall-progress chart-End***** */

/***math-progress chart***** */
const ctxmath = document.getElementById('mathChart').getContext('2d');
const myChartmath = new Chart(ctxmath, {
    type: 'bar',
    data: {
        labels: ['Previous Score', 'Latest score'],
        datasets: [{
            data: [12, 22],
            label: '',
            backgroundColor: [
                '#6ee7b7',
                '#56b663'
            ],
            barPercentage: 5,
            barThickness: 80,
            maxBarThickness: 80
        }]
    },
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
            },

            y: {
                beginAtZero: true
            }
        }
    }
});
/***math-progress chart-end***** */


/***************** halfdoughnut - end *********************/
/*******spent-time-graph*********/
const data1 = {
    labels: ['13 May', '14 May', '15 May', '16 May', '17 May'],
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: [20, 30, 10, 20, 50],
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#7db9ff',
            borderColor: '#7db9ff',
            data: [0, 60, 30, 40, 50],
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
    document.getElementById('timeSpent_Graph'),
    config1
);
/*******spent-time-graph-end*********/
/*******time-graph2*********/

const datatm2 = {
    labels: ['13 May', '14 May', '15 May', '16 May', '17 May'],
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: [20, 30, 10, 20, 50],
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#7db9ff',
            borderColor: '#7db9ff',
            data: [0, 60, 30, 40, 50],
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

const configtm2 = {
    type: 'line',
    data: datatm2,
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

const myCharttm2 = new Chart(
    document.getElementById('timeSpent_Graph2'),
    configtm2
);
/****time-sheet2******* */




/*******accuracy-graph*********/
const data2 = {
    labels: ['13 May', '14 May', '15 May', '16 May', '17 May'],
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: [20, 30, 10, 20, 50],
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#7db9ff',
            borderColor: '#7db9ff',
            data: [0, 60, 30, 40, 50],
            borderwidth: 0.6,
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
            }

        }
    }
};

const myChart2 = new Chart(
    document.getElementById('accuracy_graph'),
    config2
);
/*******accuracy-graph-end*********/
/***accuracy-2******** */
const dataaccuracy = {
    labels: ['13 May', '14 May', '15 May', '16 May', '17 May'],
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: [20, 30, 10, 20, 50],
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#7db9ff',
            borderColor: '#7db9ff',
            data: [0, 60, 30, 40, 50],
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

const configaccuracy = {
    type: 'line',
    data: dataaccuracy,
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

const myChartaccuracy = new Chart(
    document.getElementById('accuracy_graph2'),
    configaccuracy
);
/*******accuracy2-end*********/

/*******mark-graph-graph*********/
const data3 = {
    labels: ['13 May', '14 May', '15 May', '16 May', '17 May'],
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: [20, 25, 20, 30, 20],
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#ff6678',
            borderColor: '#ff6678',
            data: [10, 8, 10, 20, 15, 10],
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

const config3 = {
    type: 'line',
    data: data3,
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

const myChart3 = new Chart(
    document.getElementById('mark_trend'),
    config3
);
/*******mark-graph-end*********/
/*****mark-trend2******* */
const datamarktrend = {
    labels: ['13 May', '14 May', '15 May', '16 May', '17 May'],
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: [20, 25, 20, 30, 20],
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#ff6678',
            borderColor: '#ff6678',
            data: [10, 8, 10, 20, 15, 10],
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

const configmarktrend = {
    type: 'line',
    data: datamarktrend,
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

const myChartmarktrend = new Chart(
    document.getElementById('mark_trend2'),
    configmarktrend
);

/************* mark trens end  *************/



/************* Time management bar chart  *************/
/**overall-timeManagementChart-End******** */

const labelsT = [<?php print_r($date1); ?>];
const dataT = {
    labels: labelsT,
    datasets: [{
            label: 'Correct Answers',
            data: [<?php print_r($correctTime1); ?>],
            backgroundColor: '#34d399',
            barThickness: 32
        },
        {
            label: 'Incorrect Answers',
            data: [<?php print_r($incorrectTime1); ?>],
            backgroundColor: '#f7758f',
            barThickness: 32
        },
    ]
};
const configT = {
    type: 'bar',
    data: dataT,
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Chart.js Bar Chart - Stacked'
            },
            legend: false
        },
        responsive: true,
        scales: {
            x: {
                stacked: true,
                grid: { display: false }
            },

            y: {
                stacked: true
            }
        }
    }
};

const DATA_COUNT = 7;
const NUMBER_CFG = { count: DATA_COUNT, min: -100, max: 100 };

const actions = [{
    name: 'Randomize',
    handler(chart) {
        chart.data.datasets.forEach(dataset => {
            dataset.data = Utils.numbers({ count: chart.data.labels.length, min: -100, max: 100 });
        });
        chart.update();
    }
}, ];

var myChartT = new Chart(
    document.getElementById('timeManagementChart'),
    configT
);
/**overall-timeManagementChart-End******** */


/**Subject-timeManagementChart******** */

const labels8 = ['13 May', '14 May', '15 May', '16 May', '17 May', '18 May', '19 May', '20 May'];
const data8 = {
    labels: labels8,
    datasets: [{
            label: 'Correct Answers',
            data: [12, 22, 5, 20, 10, 10, 5, 20],
            backgroundColor: '#34d399',
            barThickness: 32
        },
        {
            label: 'Incorrect Answers',
            data: [5, 10, 15, 20, 30, 20, 8, 10],
            backgroundColor: '#f7758f',
            barThickness: 32
        },
    ]
};
const config8 = {
    type: 'bar',
    data: data8,
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Chart.js Bar Chart - Stacked'
            },
            legend: false
        },
        responsive: true,
        scales: {
            x: {
                stacked: true,
                grid: { display: false }
            },

            y: {
                stacked: true
            }
        }
    }
};

const DATA_COUNT8 = 7;
const NUMBER_CFG8 = { count: DATA_COUNT8, min: -100, max: 100 };

const actions8 = [{
    name: 'Randomize',
    handler(chart) {
        chart.data.datasets.forEach(dataset => {
            dataset.data = Utils.numbers({ count: chart.data.labels.length, min: -100, max: 100 });
        });
        chart.update();
    }
}, ];

var myChart8 = new Chart(
    document.getElementById('timeManagementChart2'),
    config8
);

/**Subject-timeManagementChart-End******** */

</script>
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
                $('.customDropdown').removeClass('active');

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
           
        });
       
    </script>
@endsection
