@extends('afterlogin.layouts.app_new')
@section('content')
@include('afterlogin.layouts.sidebar_new')
<div class="main-wrapper">
    @include('afterlogin.layouts.navbar_header_new')
    <div class="content-wrapper test_analytics_wrapper overall_analytics_page">
        <div class="tabMainblock">
            <div class="commontab aeck_commontab">
                <div class="tablist mobilescrolltab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link qq1_2_3_4 active" data-bs-toggle="tab" href="#overall" onclick="nxtTab(null)">Overall Analytics</a>
                        </li>
                        @foreach($user_subjects as $val)
                        <li class="nav-item">
                            <a class="nav-link qq1_2_3_4" id="home-tab-{{$val->id}}" data-bs-toggle="tab" href="#math" onclick="nxtTab('{{$val->id}}')">{{$val->subject_name}}</a>
                        </li>
                        @endforeach
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
                                            <div class="HeadingWithfilter">
                                                    <h3 class="boxheading d-flex align-items-center mb-5">Progress
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
                                                        <div class="customDropdown1 dropdown">
                                                            <input class="text-box markstrend" type="text" placeholder="All Test" readonly>
                                                            <div class="options">
                                                                <div style=" overflow-y: auto;  height: 145px;">
                                                                    <div class="active markstrend" onclick="show('All Test', 'all')">All Test</div>
                                                                    <div class="active markstrend" onclick="show('Mock Test', 'Mocktest')">Mock Test</div>
                                                                    <div class="markstrend" onclick="show('Practice Test', 'Assessment')">Practice Test</div>
                                                                    <div class="markstrend" onclick="show('Test Series', 'Test-Series')">Test Series</div>
                                                                    <div class="markstrend" onclick="show('Live', 'Live')">Live </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   </div>
                                            </div>
                                            <div class="overall_percentage_chart graph_padd">
                                                <span class="yaxis_label"><small> Score% </small></span>
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
                                                            Check your proficiency levels across subjects.
                                                        </p>
                                                    </span>
                                                </h3>
                                                <div class="subjectperformLegend flexleg">
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar greenbar"></span>
                                                        <label class="text">Correct Answer</label>
                                                    </div>
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar pinkbar"></span>
                                                        <label class="text">Incorrect Answer</label>
                                                    </div>
                                                    <div class="commonSubjectLeg">
                                                        <span class="bar graybar"></span>
                                                        <label class="text">Not Attempted questions</label>
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
                                                                            "#34d399",
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
                                                Track your time spent on correct and incorrect answers.
                                            </p>
                                        </span>
                                    </h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="timemanagement common_greenbadge_tabs">
                                                <h4 class="garphsubheading mb-0 mt-2">Time spent on correct/incorrect answer</h4>
                                                <div class="barwithTAb">
                                                    <div class="subjectperformLegend">
                                                        <div class="commonSubjectLeg">
                                                            <span class="bar greenbar"></span>
                                                            <label class="text">Correct Answers</label>
                                                        </div>
                                                        <div class="commonSubjectLeg ">
                                                            <span class="bar pinkbar2"></span>
                                                            <label class="text">Incorrect Answers</label>
                                                        </div>
                                                    </div>
                                                    <div class="righttabBlock">
                                                        <ul class="nav nav-pills mb-0 d-inline-flex" id="marks-tab1" role="tablist">
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
                                                        <div class="bargraph_scroll">    
                                                            <div class="graph_padd bargraph_size">
                                                                <span class="yaxis_label yaxis_label_2"><small> Average Time Taken (sec) </small> </span>
                                                                <canvas id="timeManagementChart"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-Week1" role="tabpanel" aria-labelledby="pills-Week1-tab">
                                                        <div class="bargraph_scroll">    
                                                            <div class="graph_padd bargraph_size">
                                                                <span class="yaxis_label yaxis_label_2"><small> Average Time Taken (sec) </small> </span>
                                                                <canvas id="timeManagementChartWeek"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-Month1" role="tabpanel" aria-labelledby="pills-Month1-tab">
                                                        <div class="bargraph_scroll">    
                                                            <div class="graph_padd bargraph_size">
                                                                <span class="yaxis_label yaxis_label_2"><small> Average Time Taken (sec) </small> </span>
                                                                <canvas id="timeManagementChartMonth"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="timemanagement">
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
                                                <div class="chartspent bargraph_scroll">
                                                    <div class="graph_padd bargraph_size">
                                                        <span class="yaxis_label yaxis_label_2"><small> Average time taken (sec) </small> </span>
                                                        <canvas id="timeSpent_Graph"></canvas>
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
                                    <div class="col-md-6">
                                        <div class="timemanagement common_greenbadge_tabs">
                                            <h4 class="garphsubheading mt-2 mb-0">Correct and Incorrect answers</h4>
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
                                                    <ul class="nav nav-pills mb-0 d-inline-flex" id="marks-tab2" role="tablist">
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
                                                    <div class="chartspent  bargraph_scroll">
                                                        <div class="graph_padd bargraph_size">
                                                            <span class="yaxis_label yaxis_label_2 yaxis_label_3"><small> Average Marks </small> </span>
                                                            <canvas id="mark_trend_day"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-Week2" role="tabpanel" aria-labelledby="pills-Week2-tab">
                                                    <div class="chartspent  bargraph_scroll">
                                                        <div class="graph_padd bargraph_size">
                                                            <span class="yaxis_label yaxis_label_2 yaxis_label_3"><small> Average Marks </small> </span>
                                                            <canvas id="mark_trend_week"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-Month2" role="tabpanel" aria-labelledby="pills-Month2-tab">
                                                    <div class="chartspent  bargraph_scroll">
                                                        <div class="graph_padd bargraph_size">
                                                            <span class="yaxis_label yaxis_label_2 yaxis_label_3"><small> Average Marks </small> </span>
                                                            <canvas id="mark_trend_month"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="timemanagement">
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
                                            <div class="chartspent  bargraph_scroll">
                                                <div class="graph_padd bargraph_size">
                                                    <span class="yaxis_label  yaxis_label_2"><small> Accuracy Percentage  </small> </span>
                                                    <canvas id="accuracy_graph"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="math" class=" tab-pane">
                    </div>
                    <div class="chapter_analytics">
                        @include('afterlogin.Analytics.chapter_analytics')
                    </div>
                    <div class="topics_analytics">
                        @include('afterlogin.Analytics.topics_analytics')
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>
    </div>
</div>
<script>
$(".chapter_analytics").hide();
$(".topics_analytics").hide();
/*********** BarChart ***********/
/***overall-progress chart***** */
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Previous Score', 'Latest Score'],
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
                beginAtZero: true,
                text: 'amit'
            }
        }
    }
});
/***overall-progress chart-End***** */




/***************** halfdoughnut - end *********************/
/*******spent-time-graph*********/
const data1 = {
    labels: <?php print_r($days); ?>,
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: <?php print_r($classAccuracy); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#7db9ff',
            borderColor: '#7db9ff',
            data: <?php print_r($stuAccuracy); ?>,
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

const myChart1 = new Chart(
    document.getElementById('timeSpent_Graph'),
    config1
);
/*******spent-time-graph-end*********/



/*******accuracy-graph*********/
const data2 = {
    labels: <?php print_r($day); ?>,
    datasets: [{
            label: 'Class Average',
            backgroundColor: '#56b663',
            borderColor: '#56b663',
            data: <?php print_r($classAcc); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Student Average',
            backgroundColor: '#7db9ff',
            borderColor: '#7db9ff',
            data: <?php print_r($stuAcc);  ?>,
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

const myChart2 = new Chart(
    document.getElementById('accuracy_graph'),
    config2
);
/*******accuracy-graph-end*********/


/*******mark-graph-graph*********/
var data3 = {
    labels: <?php print_r($date1); ?>,
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#34d399',
            borderColor: '#34d399',
            data: <?php print_r($correctAns1); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#f7758f',
            borderColor: '#f7758f',
            data: <?php print_r($incorrectAns1); ?>,
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

var config3 = {
    type: 'line',
    data: data3,
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

var myChart3 = new Chart(
    document.getElementById('mark_trend_day'),
    config3
);
/*-----------week-----------------*/
var data4 = {
    labels: <?php print_r($date2); ?>,
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#34d399',
            borderColor: '#34d399',
            data: <?php print_r($correctAns2); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#f7758f',
            borderColor: '#f7758f',
            data: <?php print_r($incorrectAns2); ?>,
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

var config4 = {
    type: 'line',
    data: data4,
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

var myChart4 = new Chart(
    document.getElementById('mark_trend_week'),
    config4
);
/*---------------------month----------------------*/
const data5 = {
    labels: <?php print_r($date3); ?>,
    datasets: [{
            label: 'Ideal Pace',
            backgroundColor: '#34d399',
            borderColor: '#34d399',
            data: <?php print_r($correctAns3); ?>,
            borderwidth: 0.6,
            tension: 0.4
        },
        {
            label: 'Your Pace',
            backgroundColor: '#f7758f',
            borderColor: '#f7758f',
            data: <?php print_r($incorrectAns3); ?>,
            borderwidth: 0.6,
            tension: 0.4
        }
    ]
};

const config5 = {
    type: 'line',
    data: data5,
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

const myChart5 = new Chart(
    document.getElementById('mark_trend_month'),
    config5
);
/*******mark-graph-end*********/

/************* Time management bar chart  *************/
/**overall-timeManagementChart-End******** */

const labelsT = <?php print_r($date1); ?>;
const dataT = {
    labels: labelsT,
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

/**overall weeek */
var labelsW = <?php print_r($date2); ?>;
var dataW = {
    labels: labelsW,
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
var configW = {
    type: 'bar',
    data: dataW,
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Chart.js Bar Chart - Stacked'
            },
            legend: false
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

var DATA_COUNTW = 7;
var NUMBER_CFGW = { count: DATA_COUNTW, min: -100, max: 100 };

var actionsW = [{
    name: 'Randomize',
    handler(chart) {
        chart.data.datasets.forEach(dataset => {
            dataset.data = Utils.numbers({ count: chart.data.labels.length, min: -100, max: 100 });
        });
        chart.update();
    }
}, ];

var myChartW = new Chart(
    document.getElementById('timeManagementChartWeek'),
    configW
);
/** month */
var labelsM = <?php print_r($date3); ?>;
var dataM = {
    labels: labelsM,
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
var configM = {
    type: 'bar',
    data: dataM,
    options: {
        plugins: {
            title: {
                display: false,
                text: 'Chart.js Bar Chart - Stacked'
            },
            legend: false
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

var DATA_COUNTM = 7;
var NUMBER_CFGM = { count: DATA_COUNTW, min: -100, max: 100 };

var actionsM = [{
    name: 'Randomize',
    handler(chart) {
        chart.data.datasets.forEach(dataset => {
            dataset.data = Utils.numbers({ count: chart.data.labels.length, min: -100, max: 100 });
        });
        chart.update();
    }
}, ];

var myChartM = new Chart(
    document.getElementById('timeManagementChartMonth'),
    configM
);
/**overall-timeManagementChart-End******** */



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
<script>
function nxtTab(sub_id) {
    $('.chapter_analytics').hide();
    $(".topics_analytics").hide();
    if (sub_id === null) {
        window.location.reload();
    } else {
        $(".topics_analytics").hide();
        $("#overall").show();
        url = "{{ url('next_tab/') }}/" + sub_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",

            },
            beforeSend: function() {
                $('#overlay').fadeIn();
            },
            success: function(result) {
                $("#overall").html(result);
                $('#overlay').fadeOut();
            },
            error: function(data, errorThrown) {}
        });
    }
}

function expandChapterAnalytics(sub_id) {
    url = "{{ url('chapter-analytics') }}/" + sub_id;
    $.ajax({
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",
        },
        beforeSend: function() {

        },
        success: function(data) {
            $(".chapter_analytics").show();
            $('.chapter_analytics').html(data.html);
            $('#overall').hide();
        },
        error: function(data, errorThrown) {}
    });
}

function expandTopicAnalytics(sub_id, subject_name, chapter_name) {
    url = "{{ url('topic-analytics') }}/" + sub_id;
    $.ajax({
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",
            "subject_name": subject_name,
            "chapter_name": chapter_name
        },
        beforeSend: function() {
            // $('.loader-block').show();
        },
        success: function(data) {
            $('.chapter_analytics').hide();
            $(".topics_analytics").show();
            $('.topics_analytics').html(data.html);
            $('#overall').hide();

        },
        error: function(data, errorThrown) {}
    });
}
$(document).on('click', '.chapter_subject', function(event) {
    $('#overall').show();
    $('.chapter_analytics').hide();
    $(".topics_analytics").hide();
});
$(document).on('click', '.chapter_topic', function(event) {
    $('#overall').hide();
    $('.chapter_analytics').show();
    $(".topics_analytics").hide();
});

/*******dropdown******** */
let dropdown = document.querySelector(".customDropdown1")
        dropdown.onclick = function() {
            dropdown.classList.toggle("active1")
        }
/*******dropdown-end******** */

</script>
@include('afterlogin.layouts.footer_new')
<style>
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
