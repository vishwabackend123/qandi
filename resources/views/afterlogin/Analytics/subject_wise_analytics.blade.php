<div class="row" id="topicclose">
    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                <div class="bg-white shadow-lg py-3 px-3">
                    <div class="prgress-i-txt px-3">
                        <span class="progress_text">Progress</span>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="d-flex justify-content-center flex-column h-100 ">
                                <span class="text-center">

                                    <div id="subjectscorecontainer" class="text-right"></div>
                                </span>
                                <ul class="live-test mt-3">
                                    <li>
                                        <span class="last-live-test"></span>Last Test Score
                                    </li>
                                    <li>
                                        <span class="pre-test"></span>Previous Test
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                <div class="row position-relative" id="f-Numbr-sectin">
                    @if($skillPer)
                    <div class="col-6 mb-2 px-2">
                        <div class="bg-white d-flex justify-content-center flex-column h-100 noshadow">
                            <a class="box-block arrow-right-btm" data-bs-toggle="collapse" href="#arrow-right-btm">
                                <span>{{substr($skillPer[0]->skill_name, 0, 1)}}</span>
                                <span>{{number_format((float)$skillPer[0]->percentage, 2, '.', '')}}%</span>
                            </a>
                        </div>
                        <div class="collapse arrow-right-btm-content p-4" data-bs-dismiss="collapse" id="arrow-right-btm">
                            <h4 class="text-danger text-uppercase fw-2 fw-bold">{{$skillPer[0]->skill_name}}</h4>
                            <h4 class="text-danger text-uppercase fw-2">{{number_format((float)$skillPer[0]->percentage, 2, '.', '')}}%</h4>
                            <a class="inner-arrow-right-btm" data-bs-toggle="collapse" href="#arrow-right-btm"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-6 mb-2 px-2">
                        <div class="bg-white d-flex justify-content-center flex-column h-100 noshadow">
                            <a data-bs-toggle="collapse" href="#arrow-left-btm" class="box-block arrow-left-btm">
                                <span>{{substr($skillPer[1]->skill_name, 0, 1)}}</span>
                                <span>{{number_format((float)$skillPer[1]->percentage, 2, '.', '')}}%</span>
                            </a>
                        </div>
                        <div class="collapse arrow-right-btm-content p-4" data-bs-dismiss="collapse" id="arrow-left-btm">
                            <h4 class="text-danger text-uppercase fw-2 fw-bold">{{$skillPer[1]->skill_name}}</h4>
                         
                            <p class="arrow-box-content fw-bold"> <span class="text-danger text-uppercase fw-2">{{number_format((float)$skillPer[1]->percentage, 2, '.', '')}}% </span> of questions attempted are of comprehension skills.</p>

                            <p class="arrow-box-content fw-bold">Comprehension tells you your skills of understanding a problem.</p>

                            <p class="arrow-box-content fw-bold">65% is your accuracy in these questions</p>

                            <p class="arrow-box-content fw-bold">Click here to see your Comprehension MyQ Matrix</p> 
                            
                            <a class="inner-arrow-left-btm" data-bs-toggle="collapse" href="#arrow-left-btm"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-6 px-2">
                        <div class="bg-white d-flex justify-content-center flex-column h-100 noshadow">
                            <a data-bs-toggle="collapse" href="#arrow-right-top" class="box-block arrow-right-top">
                                <span>{{substr($skillPer[2]->skill_name, 0, 1)}}</span>
                                <span>{{number_format((float)$skillPer[2]->percentage, 2, '.', '')}}%</span>
                            </a>
                        </div>
                        <div class="collapse arrow-right-btm-content p-4" data-bs-dismiss="collapse" id="arrow-right-top">
                            <h4 class="text-danger text-uppercase fw-2 fw-bold">{{$skillPer[2]->skill_name}}</h4>
                            <h4 class="text-danger text-uppercase fw-2">{{number_format((float)$skillPer[2]->percentage, 2, '.', '')}}%</h4>
                            <!-- <p class="arrow-box-content">Evaluation measures the Lorems and Ipsum for your
                                performance in the test.</p>
                            <p class="arrow-box-content">Ideal Application score should be in the range 85%</p> -->
                            <a class="inner-arrow-right-top" data-bs-toggle="collapse" href="#arrow-right-top"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-6 px-2">
                        <div class="bg-white d-flex justify-content-center flex-column h-100 noshadow">
                            <a data-bs-toggle="collapse" href="#arrow-left-top" class="box-block arrow-left-top">
                                <span>{{substr($skillPer[3]->skill_name, 0, 1)}}</span>
                                <span>{{number_format((float)$skillPer[3]->percentage, 2, '.', '')}}%</span>
                            </a>
                        </div>
                        <div class="collapse arrow-right-btm-content p-4" data-bs-dismiss="collapse" id="arrow-left-top">
                            <h4 class="text-danger text-uppercase fw-2 fw-bold"> {{$skillPer[3]->skill_name}}</h4>
                            <h4 class="text-danger text-uppercase fw-2">{{number_format((float)$skillPer[3]->percentage, 2, '.', '')}}%</h4>
                            <!-- <p class="arrow-box-content">Evaluation measures the Lorems and Ipsum for your
                                performance in the test.</p>
                            <p class="arrow-box-content">Ideal Application score should be in the range 85%</p> -->
                            <a class="inner-arrow-left-top" data-bs-toggle="collapse" href="#arrow-left-top"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>


    </div>
    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12" id="topIIC">
        <div class="bg-white shadow-lg p-3">
            <div class="d-flex align-items-center px-3">
                <h5 class="dashboard-title ">Topics</h5>
            </div>
            <div class="scroll-topic-ana">
                @if($subProf)
                @foreach($subProf as $val)

                <div class="d-flex align-items-center mt-3 px-3">
                    <div class="d-flex align-items-center py-2 dashboard-listing-details w-100 sub">
                        <span class="mr-3 dashboard-name-txt SubjName" title="{{$val->topic_name}}">{{$val->topic_name}}</span>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 progress  ms-auto sub" style="overflow: visible;">
                        @if($val->correct_ans > 0)
                        <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{($val->total_questions>0)?round(($val->correct_ans * 100)/$val->total_questions):0}}%;overflow: visible;">
                            <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Correct">{{round($val->correct_ans)}}</span>
                        </div>
                        @endif
                        @if($val->incorrect_ans > 0)
                        <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{($val->total_questions>0)?round(($val->incorrect_ans * 100)/$val->total_questions):0}}%;overflow: visible;">
                            <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-red" title="Incorrect">{{round($val->incorrect_ans)}}</span>
                        </div>
                        @endif
                        @if($val->unanswered > 0)
                        <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{($val->total_questions>0)?round(($val->unanswered * 100)/$val->total_questions):0}}%;overflow: visible;">
                            <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Unanswered">{{round($val->unanswered)}}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif


            </div>

        </div>
    </div>
    <div class="row" id="time-Avg-quest">
        <div class="col-lg-6 mt-3">
            <div class="bg-white p-3 h-100 px-5 text-center">
                <p class="text-uppercase fw-bold text-start">Time Management</p>
                <div id="day" style="display:block"></div>
                <div id="week" style="display:none"></div>
                <div id="month" style="display:none"></div>
                <p class="text-center text-danger mt-3"><small>Investing your time in correctly answering questions is the key to success.</small></p>
                <div class="btn-block mt-3 d-flex justify-content-between">
                    <button class="btn btn-outline-secondary btn-light-green text-uppercase rounded-0 px-5 s_timeClass active" id="s_day_time" onclick="replace('day','week','month')">
                        Day
                    </button>
                    <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 s_timeClass" id="s_week_time" onclick="replace('week','day','month')">
                        Week
                    </button>
                    <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 s_timeClass" id="s_month_time" onclick="replace('month','day','week')">
                        Month
                    </button>
                </div>

            </div>
        </div>
        <div class="col-lg-6  mt-3">
            <div class="bg-white p-3 h-100 px-5">
                <p class="text-uppercase fw-bold text-start">Average Time Spent on each Question (Last Week)</p>
                <div id="accPerSubjectWise1"></div>
                <p class="text-center text-danger mt-3 px-5"><small>Lowering this average will add miles to your success journey</small></p>
            </div>
        </div>
    </div>
    <div class="row" id="marKs-trends">
        <div class="col-lg-5 mt-3">
            <div class="bg-white p-3 h-100 px-5 text-center">
                <p class="text-uppercase fw-bold text-start">Marks Trend</p>
                <div id="day1" style="display:block"></div>
                <div id="week1" style="display:none"></div>
                <div id="month1" style="display:none"></div>
                <p class="text-center text-danger mt-3"><small>Keep an upward trend to reach the success summit</small></p>
                <div class="btn-block mt-3 d-flex justify-content-between">
                    <button class="btn btn-outline-secondary btn-light-green text-uppercase rounded-0 px-5 s_classMark active" id="s_day_mark" onclick="s_replace1('day1','week1','month1')">
                        Day
                    </button>
                    <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 s_classMark" id="s_week_mark" onclick="s_replace1('week1','day1','month1')">
                        Week
                    </button>
                    <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 s_classMark" id="s_month_mark" onclick="s_replace1('month1','day1','week1')">
                        Month
                    </button>
                </div>

            </div>
        </div>
        <div class="col-lg-7 mt-3">
            <div class="bg-white pt-3  px-5">
                <p class="text-uppercase fw-bold text-start">Accuracy Percentage (Last Week)</p>
                <div id="accPerSubjectWise"></div>
                <p class="text-center text-danger mt-3"><small>Its not just about how much and how fast, how accurate you are will also add to your success</small></p>
            </div>
            <div class="bg-white pt-3  px-5" id="back2Dsh">
                <div class="d-flex">
                    <button class="btn btn-outline-secondary rounded-0 w-50 me-4"><a href="{{url('/dashboard')}}">Back to Dashboard</a></button>
                    <button class="btn btn-outline-danger rounded-0 w-50 ms-4 ms-auto" data-bs-toggle="modal" data-bs-target="#exportAnalytics"><i class="fa fa-download"></i> &nbsp;Export Analytics</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="close-block" id="topicopen">
    <div class="row">
        <div class="col-12  mb-5">

            <div class="d-flex align-items-center">
                <a class="topic-btn-collepse h5 text-dark" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>
                    {{isset($subScore[0]->subject_name)?ucwords($subScore[0]->subject_name):''}}</a>
                <button class="btn btn-warning px-4 text-uppercase rounded-0 ms-auto topic-btn-collepse" id="topic-btn-collepse"><i class="fa fa-compress" aria-hidden="true"></i>
                    COLLAPSE
                </button>
            </div>

        </div>
        @if($subProf)
        @foreach($subProf as $val)
        <div class="col-md-6 col-lg-4 mb-4 ">
            <div class="bg-white shadow-lg p-3 sub-topic-box active-box">
                <div class="d-flex align-items-center py-2 listing-details ">
                    <span class="mr-3 topics-name">{{$val->topic_name}}</span>

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
                <div class="progress" style="overflow: visible;">
                    <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">

                    </div>
                    <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">

                    </div>
                    <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">

                    </div>
                </div>
                <div class="d-flex align-items-center flex-wrap">
                    <button class="btn btn-light-green mb-4 mt-4 me-2 rounded-0">K
                    </button>
                    <button class="btn btn-light-green mb-4 mt-4 me-2 rounded-0">C
                    </button>
                    <button class="btn btn-light-red mb-4 mt-4 me-2 rounded-0">A
                    </button>
                    <button class="btn btn-light mb-4 mt-4 me-2 rounded-0">E</button>
                    <!-- <button class="btn btn-danger mb-4 mt-4 ms-auto rounded-0 px-5 selected-btn">
                        Select
                    </button> -->
                </div>
            </div>
        </div>
        @endforeach
        @endif

    </div>
</div>

@php
$preSocre = isset($subScore[0]->score) ? $subScore[0]->score : 0;
$currSocre = isset($subScore[1]->score) ? $subScore[1]->score : 0;
@endphp
<script>
    /*  $(".scroll-topic-ana").slimscroll({
        height: "42.5vh",
    }); */
    $("#topic-open-btn").click(function() {
        $("#topicclose").hide();
        $("#topicopen").show();

    });
    $(".topic-btn-collepse").click(function() {
        $("#topicopen").hide();
        $("#topicclose").show();
    });

    Highcharts.chart('day', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'column',
            height: 270
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: <?php print_r($date1); ?>
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Average Time Taken (sec)'
            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            },
            series: {
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },

        series: [{
            name: 'Correct Answer Time',
            data: <?php print_r($correctTime1); ?>,
            color: '#6ec986'
        }, {
            name: 'Incorrect Answer Time',
            data: <?php print_r($incorrectTime1); ?>,
            color: '#ff9999'
        }]
    });

    Highcharts.chart('week', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'column',
            height: 270
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: <?php print_r($date2); ?>
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Average Time Taken'
            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            },
            series: {
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },

        series: [{
            name: 'Correct Answer Time',
            data: <?php print_r($correctTime2); ?>,
            color: '#6ec986'
        }, {
            name: 'Incorrect Answer Time',
            data: <?php print_r($incorrectTime2); ?>,
            color: '#ff9999'
        }]
    });

    Highcharts.chart('month', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'column',
            height: 270
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: <?php print_r($date3); ?>
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Average Time Taken'
            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            },
            series: {
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },

        series: [{
            name: 'Correct Answer Time',
            data: <?php print_r($correctTime3); ?>,
            color: '#6ec986'
        }, {
            name: 'Incorrect Answer Time',
            data: <?php print_r($incorrectTime3); ?>,
            color: '#ff9999'
        }]
    });

    function replace(show, hide1, hide2) {
        if (show == 'day') {
            $(".s_timeClass").removeClass("active");
            $("#s_day_time").addClass("active");
        } else if (show == 'week') {
            $(".s_timeClass").removeClass("active");
            $("#s_week_time").addClass("active");
        } else {
            $(".s_timeClass").removeClass("active");
            $("#s_month_time").addClass("active");
        }
        document.getElementById(hide1).style.display = "none";
        document.getElementById(hide2).style.display = "none";
        document.getElementById(show).style.display = "block";
    }
</script>

<script>
    Highcharts.chart('day1', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line',
            height: 270
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: <?php print_r($date1); ?>
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Average Marks'
            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>';
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            },
            series: {
                label: false,
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },

        series: [{
            name: 'Correct Answer',
            data: <?php print_r($correctAns1); ?>,
            color: '#6ec986'
        }, {
            name: 'Incorrect Answer',
            data: <?php print_r($incorrectAns1); ?>,
            color: '#ff9999'
        }]
    });

    Highcharts.chart('week1', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line',
            height: 270
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: <?php print_r($date2); ?>
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Average Marks'
            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>';
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            },
            series: {
                label: false,
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },

        series: [{
            name: 'Correct Answer',
            data: <?php print_r($correctAns2); ?>,
            color: '#6ec986'
        }, {
            name: 'Incorrect Answer',
            data: <?php print_r($incorrectAns2); ?>,
            color: '#ff9999'
        }]
    });

    Highcharts.chart('month1', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line',
            height: 270
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: <?php print_r($date3); ?>
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Average Marks'
            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>';
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            },
            series: {
                label: false,
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },

        series: [{
            name: 'Correct Answer',
            data: <?php print_r($correctAns3); ?>,
            color: '#6ec986'
        }, {
            name: 'Incorrect Answer',
            data: <?php print_r($incorrectAns3); ?>,
            color: '#ff9999'
        }]
    });

    function s_replace1(show, hide1, hide2) {
        if (show == 'day1') {
            $(".s_classMark").removeClass("active");
            $("#s_day_mark").addClass("active");
        } else if (show == 'week1') {
            $(".s_classMark").removeClass("active");
            $("#s_week_mark").addClass("active");
        } else {
            $(".s_classMark").removeClass("active");
            $("#s_month_mark").addClass("active");
        }
        document.getElementById(hide1).style.display = "none";
        document.getElementById(hide2).style.display = "none";
        document.getElementById(show).style.display = "block";
    }
</script>

<script>
    Highcharts.chart('accPerSubjectWise', {
        chart: {
            type: 'spline',
            height: 270
        },
        credits: {
            enabled: false
        },
        legend: {
            symbolWidth: 40
        },

        title: {
            text: ''
        },
        yAxis: {
            title: {
                text: 'Accuracy Percentage'
            }
        },

        xAxis: {
            categories: <?php print_r($day); ?>
        },
        plotOptions: {

            series: {
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },
        series: [{
            name: 'Class Average',
            data: <?php print_r($classAcc); ?>,
            color: '#ff9999',
            dashStyle: 'ShortDash'
        }, {
            name: 'Student Average',
            data: <?php print_r($stuAcc); ?>,
            color: '#6ec986',
        }]
    });
</script>

<script>
    Highcharts.chart('accPerSubjectWise1', {
        chart: {
            type: 'spline',
            height: 270
        },
        credits: {
            enabled: false
        },
        legend: {
            symbolWidth: 40
        },

        title: {
            text: ''
        },
        yAxis: {
            title: {
                text: 'Average Time Spent'
            }
        },

        xAxis: {
            categories: <?php print_r($days); ?>
        },
        plotOptions: {

            series: {
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },
        series: [{
            name: 'Class Average',
            data: <?php print_r($classAccuracy); ?>,
            color: '#ff9999',
            dashStyle: 'ShortDash'
        }, {
            name: 'Student Average',
            data: <?php print_r($stuAccuracy); ?>,
            color: '#6ec986',
        }]
    });
</script>

<script>
    Highcharts.chart('subjectscorecontainer', {
        chart: {
            height: 130,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            spacingTop: 0,
            spacingBottom: 0,
            spacingRight: 0,
        },
        title: {
            text: '<span style="font: normal normal 200 48px/60px Manrope; letter-spacing: 0px; color: #21ccff;">{{isset($subScore[1]->score)?$subScore[1]->score:0}}</span> <br><span style="font: normal normal normal 14px/22px Manrope;letter-spacing: 0px;color: #21ccff;"> / 100 </span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
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
                    distance: -50,
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
            }
        },
        series: [{
            type: 'pie',
            innerSize: '85%',
            data: [{
                    name: 'Score',
                    y: <?php echo $preSocre; ?>,
                    color: '#21ccff' // Jane's color
                },
                {
                    name: 'Progress',
                    y: <?php echo $diffmock = ($currSocre - $preSocre) > 0 ? $currSocre - $preSocre : 0 ?>,
                    color: '#d0f3ff' // Jane's color
                },
                {
                    name: '',
                    y: <?php echo (100 - ($preSocre + $diffmock)); ?>,

                    color: '#e4e4e4' // Jane's color
                }
            ]
        }]
    });
</script>