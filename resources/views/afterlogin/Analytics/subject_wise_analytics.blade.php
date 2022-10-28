 <div class="overallmain">
    <div class="overalltop">
        <div class="row">
            <div class="col-lg-12 col-xl-6">
                <div class="commonWhiteBox h-auto subj_progress_card">
                <div class="HeadingWithfilter">
                        <h3 class="boxheading d-flex align-items-center mb-5 smalltextheading">Progress
                            <span class="tooltipmain">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                    </g>
                                </svg>
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    Compare your previous score with your latest score.
                                </p>
                            </span>
                        </h3>
                        <div class="dropbox mb-5">
                            <div class="customDropdown1 dropdown" id ="subjectdeopdown">
                                <input class="text-box markstrend subject_text_box" type="text" placeholder="Practice Test" readonly>
                                <div class="options">
                                    <div style=" overflow-y: auto;  height: 145px;">
                                        <div class="active markstrend" onclick="showSubjectProgress('Assessment','Practice Test')">Practice Test</div>
                                        <div class="markstrend" onclick="showSubjectProgress('Mocktest','Mock Test')">Mock Test</div>
                                        <div class="markstrend" onclick="showSubjectProgress('Test-Series','Test Series')">Test Series</div>
                                        <div class="markstrend" onclick="showSubjectProgress('Live','Live Test')">Live Test</div>
                                        <div class="markstrend" onclick="showSubjectProgress('PreviousYear','Previous Year')">Previous Year</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="overall_percentage_chart graph_padd">
                        <span class="yaxis_label"><small> Score% </small></span>
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
                                    Know your skills, expertise, and proficiency in the topics and chapters you have attempted.
                                </p>
                            </span>
                        </h3>
                        <div class="mock_inst_text_mock_test">
                            <a href="javascript:void(0)" class="text-decoration-none" onclick="expandChapterAnalytics({{$sub_id}})">Expand <i class="fa fa-angle-right" style="margin-left:8px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="subjectperformLegend flexleg" style="margin-bottom:12px;">
                        <div class="commonSubjectLeg">
                            <span class="bar greenbar"></span>
                            <label class="text">Correct Answers</label>
                        </div>
                        <div class="commonSubjectLeg">
                            <span class="bar pinkbar"></span>
                            <label class="text">Incorrect Answers</label>
                        </div>
                        <div class="commonSubjectLeg">
                            <span class="bar graybar"></span>
                            <label class="text">Not Attempted Questions</label>
                        </div>
                    </div>
                    <!-- <ul class="topic_score_lists mb-0">
                        @if($subProf)
                        @foreach($subProf as $val)
                        <li>
                            <div class="topic_score_bar">
                                <h4>{{$val->chapter_name}}</h4>
                                <div class="progress">
                                    @if($val->correct_ans > 0)
                                    <div class="progress-bar correct-bg" role="progressbar" style="width: {{($val->total_questions>0)?round(($val->correct_ans * 100)/$val->total_questions):0}}%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" title="Correct({{round($val->correct_ans)}})"></div>
                                    @endif
                                    @if($val->incorrect_ans > 0)
                                    <div class="progress-bar incorrect-bg" role="progressbar" style="width: {{($val->total_questions>0)?round(($val->incorrect_ans * 100)/$val->total_questions):0}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" title="Incorrect({{round($val->incorrect_ans)}})"></div>
                                    @endif
                                    @if($val->unanswered > 0)
                                    <div class="progress-bar not-attempted-bg" role="progressbar" style="width: {{($val->total_questions>0)?round(($val->unanswered * 100)/$val->total_questions):0}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" title="Unanswered({{round($val->unanswered)}})"></div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @endif
                    </ul> -->
                    <ul class="chapter_performance_lists mb-0">
                        @if($subProf)
                        @foreach($subProf as $val)
                        @php
                        $correct_ans =($val->total_questions>0)?round(($val->correct_ans * 100)/$val->total_questions):0;
                        $incorrect_ans =($val->total_questions>0)?round(($val->incorrect_ans * 100)/$val->total_questions):0;
                        $unanswered =($val->total_questions>0)?round(($val->unanswered * 100)/$val->total_questions):0;
                        @endphp
                        <li class="topic_score_bar">
                            <h4 class="m-0" title="{{$val->chapter_name}}">{{$val->chapter_name}}</h4>
                            <div class="dropdown">
                                <div class="Chapter_Main_Graph progress dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <canvas id="chapterPerformance_{{$val->chapter_id}}"></canvas>
                                    <script type="text/javascript">
                                    var circuference = 360;
                                    var data = {
                                        labels: ["Correct answer", "Incorrect answer", "Unattempted questions"],
                                        datasets: [{
                                            label: "My First Dataset",
                                            data: [<?php echo $correct_ans; ?>,<?php echo $incorrect_ans; ?>,<?php echo $unanswered; ?>],
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
                                    var myCharted = new Chart("chapterPerformance_{{$val->chapter_id}}", config)

                                    </script>
                                </div>
                                <ul class="dropdown-menu noofquestions-block" aria-labelledby="dropdownMenuButton1">
                                    <h5 style="font-size: 14px;font-weight: 600;color: #000;margin-bottom:12px;">Number of questions</h5>
                                    <div class="color_labels">
                                        <span class="d-block"><small></small> Correct <b>{{$val->correct_ans}}</b></span>
                                        <span class="d-block mt-2 mb-2"><small></small> Incorrect <b>{{$val->incorrect_ans}}</b></span>
                                        <span class="d-block"><small></small> Not Attempted <b>{{$val->unanswered}}</b></span>
                                    </div>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6">
                <div class="commonWhiteBox">
                    <div class="subjectperform">
                        <h3 class="boxheading d-flex align-items-center">Core Learning Skills
                            <span class="tooltipmain ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"></path>
                                    </g>
                                </svg>
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    Get an in-depth analysis of your core learning skill.
                                </p>
                            </span>
                        </h3>
                        <div class="codelearningBlock">
                            @if($skillPer)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="commoncodeblock">
                                        <div class="codelerheader">
                                            <h3>{{$skillPer[0]->skill_name}}</h3>
                                        </div>
                                        <div class="commoncodeblock_content">
                                            <div class="codelerninner">
                                                <h5>Your ability to understand complex information by breaking it into parts, examining the parts individually and judging them according to the received information.</h5>
                                                <p> <strong>{{(int)$skillPer[0]->percentage}}%</strong> of all questions solved are of this skill.
                                                  <!-- <a href="#Evaluationmodal" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Evaluationmodal">read more...</a> -->
                                                </p>
                                            </div>
                                            <div class="codebottom">
                                                <h6>Your accuracy</h6>
                                                <h2>{{(int)$skillPer[0]->accuracy_percentage}}%</h2>
                                            </div>
                                            <div class="text-center mobile_block">
                                                <a href="#Evaluation" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Evaluation"> Know more 
                                                    <span class="greenarrow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
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
                                            <h3>{{$skillPer[1]->skill_name}}</h3>
                                        </div>
                                        <div class="commoncodeblock_content">
                                            <div class="codelerninner">
                                                <h5>Your ability to understand the meaning and correctly interpret instructions and problems. </h5>
                                                <p> <strong>{{(int)$skillPer[1]->percentage}}%</strong>  of all questions solved are of this skill. 
                                                <!-- <a href="#Comprehensionmodal" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Comprehensionmodal">read more...</a> -->
                                            </p>
                                            </div>
                                            <div class="codebottom">
                                                <h6>Your accuracy</h6>
                                                <h2>{{(int)$skillPer[1]->accuracy_percentage}}%</h2>
                                            </div>
                                            <div class="text-center mobile_block">
                                                <a href="#Comprehension" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Comprehension"> Know more 
                                                    <span class="greenarrow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
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
                                            <h3>{{$skillPer[2]->skill_name}}</h3>
                                        </div>
                                        <div class="commoncodeblock_content">
                                            <div class="codelerninner">
                                                <h5>Your ability to execute or implement the information provided.</h5>
                                                <p> <strong>{{(int)$skillPer[2]->percentage}}%</strong>  of all questions solved are of this skill.  
                                                <!-- <a href="#Applicationmodal" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Applicationmodal">read more...</a> -->
                                            </p>

                                            </div>
                                            <div class="codebottom">
                                                <h6>Your accuracy</h6>
                                                <h2>{{(int)$skillPer[2]->accuracy_percentage}}%</h2>
                                            </div>
                                            <div class="text-center mobile_block">
                                                <a href="#Application" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Application"> Know more 
                                                    <span class="greenarrow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
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
                                            <h3>{{$skillPer[3]->skill_name}}</h3>
                                        </div>
                                        <div class="commoncodeblock_content">
                                            <div class="codelerninner">
                                                <h5> Your ability to recognize and recall factual information and basic concepts. </h5>

                                                <p> <strong>{{(int)$skillPer[3]->percentage}}%</strong> of all questions solved are of this skill.    
                                                <!-- <a href="#Knowledgemodal" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Knowledgemodal">read more...</a> -->
                                            </p>
                                            </div>
                                            <div class="codebottom">
                                                <h6>Your accuracy</h6>
                                                <h2>{{(int)$skillPer[3]->accuracy_percentage}}%</h2>
                                            </div>
                                            <div class="text-center mobile_block">
                                                <a href="#Knowledge" class="commmongreenLink" data-bs-toggle="modal" data-bs-target="#Knowledge"> Know more 
                                                    <span class="greenarrow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                            <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        Track your time spent on correct and incorrect answers. 
                    </p>
                </span>
            </h3>
            <div class="row">
                <div class="col-lg-12 col-xl-6">
                    <div class="timemanagement common_greenbadge_tabs">
                        <h4 class="garphsubheading mt-2 mb-0">Time spent on correct/incorrect answers</h4>
                        <div class="barwithTAb">
                            <div class="subjectperformLegend ">
                                <div class="commonSubjectLeg">
                                    <span class="bar greenbar"></span>
                                    <label class="text">Correct Answers</label>
                                </div>
                                <div class="commonSubjectLeg">
                                    <span class="bar pinkbar2"></span>
                                    <label class="text">Incorrect Answers</label>
                                </div>
                            </div>
                            <div class="righttabBlock">
                                <ul class="nav nav-pills mb-0 d-inline-flex" id="marks-tab3" role="tablist">
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
                                <div class="bargraph_scroll">    
                                    <div class="graph_padd bargraph_size">
                                        <span class="yaxis_label yaxis_label_2"><small> Total Time Taken (sec) </small> </span>
                                        <canvas id="timeManagementChartDay2"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-Week3" role="tabpanel" aria-labelledby="pills-Week3-tab">
                                <div class="bargraph_scroll">    
                                    <div class="graph_padd bargraph_size">
                                        <span class="yaxis_label yaxis_label_2"><small> Total Time Taken (sec) </small> </span>
                                        <canvas id="timeManagementChartWeek2"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-Month3" role="tabpanel" aria-labelledby="pills-Month3-tab">
                                <div class="bargraph_scroll">    
                                    <div class="graph_padd bargraph_size">
                                        <span class="yaxis_label yaxis_label_2"><small> Total Time Taken (sec) </small> </span>
                                        <canvas id="timeManagementChartMonth2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-6">
                    <div class="timemanagement timespentquestion">
                        <h4 class="garphsubheading mb-0 mt-2">Time spent on each question <span>(in Last week)</span></h4>
                        <div class="subjectperformLegend ">
                            <div class="commonSubjectLeg spaceright">
                                <span class="bar bluebar"></span>
                                <label class="text">Class Average</label>
                            </div>
                            <div class="commonSubjectLeg spaceright">
                                <span class="bar greenbar2"></span>
                                <label class="text">Student Average</label>
                            </div>
                        </div>
                        <div class="chartspent  bargraph_scroll"> 
                            <div class="graph_padd bargraph_size">  
                                <span class="yaxis_label yaxis_label_2"><small> Average  Time Taken (sec) </small> </span>
                                <canvas id="timeSpent_Graph2"></canvas>
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
        <h3 class="boxheading">Marks Trend
            <span class="tooltipmain">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                    </g>
                </svg>
                <p class="tooltipclass">
                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                    Get insights on your progress over time. 
                </p>
            </span>
        </h3>
        <div class="row">
            <div class="col-lg-12 col-xl-6">
                <div class="timemanagement common_greenbadge_tabs">
                    <h4 class="garphsubheading mt-2 mb-0">Correct and Incorrect Answers</h4>
                    <div class="barwithTAb">
                        <div class="subjectperformLegend ">
                            <div class="commonSubjectLeg">
                                <span class="bar greenbar3"></span>
                                <label class="text">Correct Answers</label>
                            </div>
                            <div class="commonSubjectLeg">
                                <span class="bar pinkbar2"></span>
                                <label class="text">Incorrect Answers</label>
                            </div>
                        </div>
                        <div class="righttabBlock">
                            <ul class="nav nav-pills mb-0 d-inline-flex" id="marks-tab4" role="tablist">
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
                            <div class="chartspent  bargraph_scroll">
                                <div class="graph_padd bargraph_size">
                                    <span class="yaxis_label yaxis_label_3 "><small> No. of Answers </small> </span>
                                    <canvas id="mark_trend_day_2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Week4" role="tabpanel" aria-labelledby="pills-Week4-tab">
                            <div class="chartspent  bargraph_scroll">
                                <div class="graph_padd bargraph_size">
                                    <span class="yaxis_label yaxis_label_3 "><small> No. of Answers </small> </span>
                                    <canvas id="mark_trend_week_2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Month4" role="tabpanel" aria-labelledby="pills-Month4-tab">
                            <div class="chartspent  bargraph_scroll">
                                <div class="graph_padd bargraph_size">
                                    <span class="yaxis_label yaxis_label_3 "><small> No. of Answers </small> </span>
                                    <canvas id="mark_trend_month_2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6">
                <div class="timemanagement timespentquestion">
                    <h4 class="garphsubheading mt-2 mb-0">Accuracy Percentage <span>(in Last week)</span></h4>
                    <div class="subjectperformLegend ">
                        <div class="commonSubjectLeg spaceright">
                            <span class="bar bluebar"></span>
                            <label class="text">Class Average</label>
                        </div>
                        <div class="commonSubjectLeg spaceright">
                            <span class="bar greenbar2"></span>
                            <label class="text">Student Average</label>
                        </div>
                    </div>
                    <div class="chartspent bargraph_scroll">
                        <div class="graph_padd bargraph_size">
                            <span class="yaxis_label  yaxis_label_4"><small> Accuracy Percentage </small> </span>
                            <canvas id="accuracy_graph2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- KnowMore-popup start  -->
<div class="modal fade overall_evaluationmodal_modal" id="Evaluation">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                    <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="intraction_text_strength mt-0">Evaluation</div>
                    <hr>
                    <div class="instruction_text_content">
                        Your ability to understand complex information by breaking it into parts, examining the parts individually and judging them according to the received information. 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade overall_evaluationmodal_modal" id="Comprehension">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                    <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="intraction_text_strength mt-0">Comprehension</div>
                    <hr>
                    <div class="instruction_text_content">
                        Your ability to understand the meaning and correctly interpret instructions and problems. 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade overall_evaluationmodal_modal" id="Application">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                    <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="intraction_text_strength mt-0">Application</div>
                    <hr>
                    <div class="instruction_text_content">
                        Your ability to execute or implement the information provided.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade overall_evaluationmodal_modal" id="Knowledge">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                    <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="intraction_text_strength mt-0">Knowledge</div>
                    <hr>
                    <div class="instruction_text_content">
                         Your ability to recognize and recall factual information and basic concepts.  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- KnowMore-popup end -->
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
                    <div class="instruction_text_content"><strong class="blackcolor">{{(int)$skillPer[0]->percentage}}%</strong> of questions are of evaluation skills. This skill helps you to determine your ability to understand the complexity of information by breaking into parts and examine them individually and judge in accordance with the received information.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Evaluation-popup end -->
<div class="modal fade overall_evaluationmodal_modal" id="Comprehensionmodal">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                    <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="intraction_text_strength mt-0">Comprehension</div>
                    <hr>
                    <div class="instruction_text_content"><strong class="blackcolor">{{(int)$skillPer[1]->percentage}}%</strong> of questions are of Comprehension/Understanding skills. This skill helps you understand the meaning, translation, interpolation and interpretation of instructions and problems.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade overall_evaluationmodal_modal" id="Applicationmodal">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                    <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="intraction_text_strength mt-0">Application</div>
                    <hr>
                    <div class="instruction_text_content"><strong class="blackcolor">{{(int)$skillPer[2]->percentage}}%</strong> of questions are of application skills. This skill helps you to determine your ability to execute or implement the information.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade overall_evaluationmodal_modal" id="Knowledgemodal">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content strengthmodal_content">
                <div class="modal-header1">
                    <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="intraction_text_strength mt-0">Knowledge</div>
                    <hr>
                    <div class="instruction_text_content"><strong class="blackcolor">{{(int)$skillPer[3]->percentage}}% </strong> of questions are of Knowledge/Remembering skills. This skill helps you determine your ability to recognize and recall information.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
$lastscore = $progress = 0;
$preSocre = isset($subScore[1]->score) ? $subScore[1]->score : 0;
$currSocre = isset($subScore[0]->score) ? $subScore[0]->score : 0;
$lastscore = ($currSocre >= $preSocre) ? $preSocre : $currSocre;
$progress = ($currSocre >= $preSocre) ? ($currSocre - $preSocre) : 0;
@endphp
<script type="text/javascript">
/***math-progress chart***** */
var mockTestScorePre = '<?php echo $preSocre ?>';
    var mockTestScorePre_color = '#6ee7b7';
    if (mockTestScorePre < 0) {
        mockTestScorePre_color = '#E74969';
    }
     var mockTestScoreCurr = '<?php echo $currSocre ?>';
     var mockTestScoreCurr_color = '#56b663';
     if (mockTestScoreCurr < 0) {
        mockTestScoreCurr_color = '#E74969';
     }
var ctxmath = document.getElementById('mathChart').getContext('2d');
var myChartmath = new Chart(ctxmath, {
    type: 'bar',
    data: {
        labels: ['Previous Score', 'Latest Score'],
        datasets: [{
            data: [<?php echo $preSocre; ?>, <?php echo $currSocre; ?>],
            label: '',
            backgroundColor: [
                mockTestScorePre_color,
                mockTestScoreCurr_color
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
            },
            tooltip: {
                displayColors: false,
                // yAlign: 'bottom',
                backgroundColor: colorItems
            },
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                    ticks: {
                        color: '#1f1f1f',
                        font: {
                            size: 14,
                            weight: 500,
                            family: 'Manrope',
                            style: 'normal'
                        }
                 }
            },

            y: {
                beginAtZero: true
            }
        }
    }
});
/***math-progress chart-end***** */

/**Subject-timeManagementChart******** */

var labels8 = <?php print_r($date1); ?>;
var data8 = {
    labels: labels8,
    datasets: [{
            label: 'Correct Answers',
            data: <?php print_r($correctTime1); ?>,
            backgroundColor: '#34d399',
            borderColor: '#148059',
            borderWidth: {
                top: 0,
                left: 0.6,
                right: 0.6
                },
            barThickness: 26
        },
        {
            label: 'Incorrect Answers',
            data: <?php print_r($incorrectTime1); ?>,
            backgroundColor: '#f7758f',
            borderColor: '#c44760',
            borderWidth: {
                top: 0.6,
                left: 0.6,
                right: 0.6
                },
            barThickness: 26
        },
    ]
};
var config8 = {
    type: 'bar',
    data: data8,
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Chart.js Bar Chart - Stacked'
            },
            legend: false,
            tooltip: {
                displayColors: false,
                // yAlign: 'bottom',
                backgroundColor: colorItems
            },
        },
        responsive: true,
        maintainAspectRatio: false,
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

var DATA_COUNT8 = 7;
var NUMBER_CFG8 = { count: DATA_COUNT8, min: -100, max: 100 };

var actions8 = [{
    name: 'Randomize',
    handler(chart) {
        chart.data.datasets.forEach(dataset => {
            dataset.data = Utils.numbers({ count: chart.data.labels.length, min: -100, max: 100 });
        });
        chart.update();
    }
}, ];

var myChart8 = new Chart(
    document.getElementById('timeManagementChartDay2'),
    config8
);
/*------------week---------------*/

var labels9 = <?php print_r($date2); ?>;
var data9 = {
    labels: labels9,
    datasets: [{
            label: 'Correct Answers',
            data: <?php print_r($correctTime2); ?>,
            backgroundColor: '#34d399',
            barThickness: 32
        },
        {
            label: 'Incorrect Answers',
            data: <?php print_r($incorrectTime2); ?>,
            backgroundColor: '#f7758f',
            barThickness: 32
        },
    ]
};
var config9 = {
    type: 'bar',
    data: data9,
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Chart.js Bar Chart - Stacked'
            },
            legend: false,
            tooltip: {
                displayColors: false,
                // yAlign: 'bottom',
                backgroundColor: colorItems
            },
        },
        responsive: true,
        maintainAspectRatio: false,
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

var DATA_COUNT9 = 7;
var NUMBER_CFG9 = { count: DATA_COUNT8, min: -100, max: 100 };

var actions9 = [{
    name: 'Randomize',
    handler(chart) {
        chart.data.datasets.forEach(dataset => {
            dataset.data = Utils.numbers({ count: chart.data.labels.length, min: -100, max: 100 });
        });
        chart.update();
    }
}, ];

var myChart9 = new Chart(
    document.getElementById('timeManagementChartWeek2'),
    config9
);
/*-------------month---------------------*/
var labels7 = <?php print_r($date3); ?>;
var data7 = {
    labels: labels7,
    datasets: [{
            label: 'Correct Answers',
            data: <?php print_r($correctTime3); ?>,
            backgroundColor: '#34d399',
            barThickness: 32
        },
        {
            label: 'Incorrect Answers',
            data: <?php print_r($incorrectTime3); ?>,
            backgroundColor: '#f7758f',
            barThickness: 32
        },
    ]
};
var config7 = {
    type: 'bar',
    data: data7,
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Chart.js Bar Chart - Stacked'
            },
            legend: false,
            tooltip: {
                displayColors: false,
                // yAlign: 'bottom',
                backgroundColor: colorItems
            },
        },
        responsive: true,
        maintainAspectRatio: false,
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

var DATA_COUNT7 = 7;
var NUMBER_CFG7 = { count: DATA_COUNT8, min: -100, max: 100 };

var actions7 = [{
    name: 'Randomize',
    handler(chart) {
        chart.data.datasets.forEach(dataset => {
            dataset.data = Utils.numbers({ count: chart.data.labels.length, min: -100, max: 100 });
        });
        chart.update();
    }
}, ];

var myChart7 = new Chart(
    document.getElementById('timeManagementChartMonth2'),
    config7
);
/***accuracy-2******** */
var dataaccuracy = {
    labels: <?php print_r($day); ?>,
    datasets: [{
            label: 'Class Average',
            backgroundColor: '#7db9ff',
            borderColor: '#7db9ff',
            data: <?php print_r($classAcc); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Student Average',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: <?php print_r($stuAcc); ?>,
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

var configaccuracy = {
    type: 'line',
    data: dataaccuracy,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        elements: {
            point: {
                radius: 0
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                displayColors: false,
                // yAlign: 'bottom',
                backgroundColor: colorItems
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
                ticks: {
                    align:'start'
                 },
                grid: {
                    display: false
                }
            }

        }
    }
};

var myChartaccuracy = new Chart(
    document.getElementById('accuracy_graph2'),
    configaccuracy
);
/*****mark-trend2******* */
var datamarktrend = {
    labels: <?php print_r($date1); ?>,
    datasets: [{
            label: 'Correct Answer',
            backgroundColor: '#08d5a1',
            borderColor: '#08d5a1',
            data: <?php print_r($correctAns1); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Incorrect Answer',
            backgroundColor: '#f7758f',
            borderColor: '#f7758f',
            data: <?php print_r($incorrectAns1); ?>,
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

var configmarktrend = {
    type: 'line',
    data: datamarktrend,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        elements: {
            point: {
                radius: 2
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                displayColors: false,
                // yAlign: 'bottom',
                backgroundColor: colorItems
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
                ticks: {
                    align:'start'
                 },
                grid: {
                    display: false
                }
            }

        }
    }
};

var myChartmarktrend = new Chart(
    document.getElementById('mark_trend_day_2'),
    configmarktrend
);
/*------------week------------------*/
var datamarktrendw = {
    labels: <?php print_r($date2); ?>,
    datasets: [{
            label: 'Correct Answer',
            backgroundColor: '#08d5a1',
            borderColor: '#08d5a1',
            data: <?php print_r($correctAns2); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Incorrect Answer',
            backgroundColor: '#f7758f',
            borderColor: '#f7758f',
            data: <?php print_r($incorrectAns2); ?>,
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

var configmarktrendw = {
    type: 'line',
    data: datamarktrendw,
    options: {
        responsive: true,
        maintainAspectRatio: false,
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
                ticks: {
                    align:'start'
                 },
                grid: {
                    display: false
                }
            }

        }
    }
};

var myChartmarktrendw = new Chart(
    document.getElementById('mark_trend_week_2'),
    configmarktrendw
);
/*-------------month----------------------*/
var datamarktrendm = {
    labels: <?php print_r($date3); ?>,
    datasets: [{
            label: 'Correct Answer',
            backgroundColor: '#08d5a1',
            borderColor: '#08d5a1',
            data: <?php print_r($correctAns3); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Incorrect Answer',
            backgroundColor: '#f7758f',
            borderColor: '#f7758f',
            data: <?php print_r($incorrectAns3); ?>,
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

var configmarktrendm = {
    type: 'line',
    data: datamarktrendm,
    options: {
        responsive: true,
        maintainAspectRatio: false,
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
                ticks: {
                    align:'start'
                 },
                grid: {
                    display: false
                }
            }

        }
    }
};

var myChartmarktrendm = new Chart(
    document.getElementById('mark_trend_month_2'),
    configmarktrendm
);

/************* mark trens end  *************/
/*******time-graph2*********/

var datatm2 = {
    labels: <?php print_r($days); ?>,
    datasets: [{
            label: 'Class Average',
            backgroundColor: '#7db9ff',
            borderColor: '#7db9ff',
            data: <?php print_r($classAccuracy); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Student Average',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: <?php print_r($stuAccuracy); ?>,
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

var configtm2 = {
    type: 'line',
    data: datatm2,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        elements: {
            point: {
                radius: 0
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                displayColors: false,
                // yAlign: 'bottom',
                backgroundColor: colorItems
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
                ticks: {
                    align:'start'
                 },
                grid: {
                    display: false
                }
            }

        }
    }
};

var myCharttm2 = new Chart(
    document.getElementById('timeSpent_Graph2'),
    configtm2
);
/****time-sheet2******* */

function colorItems(tooltipItem) {
    const tooltipBackColor = tooltipItem.tooltip.labelColors[0].backgroundColor;
    return tooltipBackColor;
}

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
/*******dropdown******** */
var dropdownsubject = document.querySelector("#subjectdeopdown")

    dropdownsubject.onclick = function() {
    dropdownsubject.classList.toggle("active1")
        }
/*******dropdown-end******** */
function showSubjectProgress(exam_type, value) {
    var sub_id = '<?php echo $sub_id; ?>';
    document.querySelector(".subject_text_box").value = value;
    url = "{{ url('subject_progress_graph/') }}/" + sub_id + '/' + exam_type;
    $.ajax({
        type: 'GET',
        url: url,
        dataType: "json",
        success: function(response) {
            myChartmath.data.datasets[0].data = [response.preSocre, response.currSocre]; 
            var mockTestScorePre = response.preSocre;
                var mockTestScorePre_color = '#6ee7b7';
                if (mockTestScorePre < 0) {
                    mockTestScorePre_color = '#E74969';
                }
                var mockTestScoreCurr = response.currSocre;
                var mockTestScoreCurr_color = '#56b663';
                if (mockTestScoreCurr < 0) {
                    mockTestScoreCurr_color = '#E74969';
                }
            myChartmath.data.datasets[0].backgroundColor = [mockTestScorePre_color, mockTestScoreCurr_color];  
            myChartmath.update();
        }
    });
}

$(".topic_score_bar .dropdown").hover(function() {
        $(this).children(".progress.dropdown-toggle").trigger('click');
    });
</script>
