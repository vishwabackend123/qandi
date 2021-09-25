<style>
    .btn-warning-custom {
        min-width: 220px !important;
    }
</style>
<div class="" id="topicclose">
    <div class="row">
        <div class="col-lg-5">
            <div class=" ">
                <div class="row">
                    <div class="col-7 pe-0">
                        <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                            <span class=" p-3">
                                <div id="scorecontainer" class="text-right"></div>
                            </span>
                            <span class="mt-auto me-0 bg-light p-3 d-flex  justify-content-center flex-column graph-bottom-block">
                                <span class="abri">
                                    <span class="abrv-mean bg1">
                                    </span>
                                    Last Mock Test Score
                                </span>
                                <span class="abri">
                                    <span class="abrv-mean bg2">
                                    </span>
                                    Progress From Previous Score
                                </span>
                                <span class="abri">
                                    <span class="abrv-mean bg3">
                                    </span>
                                    Next Mock Test Target
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-5 ">
                        <div class="row position-relative h-100">
                            @if($skillPer)
                            <div class="col-6 mb-2 pe-1 h-48">
                                <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                    <a class="box-block arrow-right-btm" data-bs-toggle="collapse" href="#arrow-right-btm">
                                        <span>{{substr($skillPer[0]->skill_name, 0, 1)}}</span>
                                        <span>{{round($skillPer[0]->percentage)}}%</span>
                                    </a>
                                </div>
                                <div class="collapse arrow-right-btm-content p-3" data-bs-dismiss="collapse" id="arrow-right-btm">
                                    <h4 class="text-danger text-uppercase skill-name">
                                        {{$skillPer[0]->skill_name}}
                                    </h4>
                                    <h4 class="text-danger text-uppercase fw-2">{{$skillPer[0]->percentage}}%</h4>
                                    <p></p>
                                    <a class="inner-arrow-right-btm" data-bs-toggle="collapse" href="#arrow-right-btm"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="col-6  mb-2 ps-1 h-48">
                                <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                    <a data-bs-toggle="collapse" href="#arrow-left-btm" class="box-block arrow-left-btm">
                                        <span>{{substr($skillPer[1]->skill_name, 0, 1)}}</span>
                                        <span>{{round($skillPer[1]->percentage)}}%</span>
                                    </a>
                                </div>
                                <div class="collapse arrow-right-btm-content p-3" data-bs-dismiss="collapse" id="arrow-left-btm">
                                    <h4 class="text-danger text-uppercase skill-name">
                                        {{$skillPer[1]->skill_name}}
                                    </h4>
                                    <h4 class="text-danger text-uppercase fw-2">{{$skillPer[1]->percentage}}%</h4>
                                    <p></p>
                                    <a class="inner-arrow-left-btm" data-bs-toggle="collapse" href="#arrow-left-btm"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="col-6 pe-1 h-48">
                                <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                    <a data-bs-toggle="collapse" href="#arrow-right-top" class="box-block arrow-right-top">
                                        <span>{{substr($skillPer[2]->skill_name, 0, 1)}}</span>
                                        <span>{{round($skillPer[2]->percentage)}}%</span>
                                    </a>
                                </div>
                                <div class="collapse arrow-right-btm-content p-3" data-bs-dismiss="collapse" id="arrow-right-top">
                                    <h4 class="text-danger text-uppercase skill-name">
                                        {{$skillPer[2]->skill_name}}
                                    </h4>
                                    <h4 class="text-danger text-uppercase fw-2">{{$skillPer[2]->percentage}}%</h4>
                                    <p></p>
                                    <a class="inner-arrow-right-top" data-bs-toggle="collapse" href="#arrow-right-top"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="col-6 ps-1 h-48">
                                <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                    <a data-bs-toggle="collapse" href="#arrow-left-top" class="box-block arrow-left-top">
                                        <span>{{substr($skillPer[3]->skill_name, 0, 1)}}</span>
                                        <span>{{round($skillPer[3]->percentage)}}%</span>
                                    </a>
                                </div>
                                <div class="collapse arrow-right-btm-content p-3" data-bs-dismiss="collapse" id="arrow-left-top">
                                    <h4 class="text-danger text-uppercase skill-name">
                                        {{$skillPer[3]->skill_name}}
                                    </h4>
                                    <h4 class="text-danger text-uppercase fw-2">{{$skillPer[3]->percentage}}%</h4>
                                    <p></p>
                                    <a class="inner-arrow-left-top" data-bs-toggle="collapse" href="#arrow-left-top"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="bg-white shadow-lg p-3 h-100">
                <div class="d-flex align-items-center">
                    <h5 class="dashboard-title ">Topics</h5>

                    <button class="btn btn-warning-custom px-4 ms-auto text-uppercase rounded-0" id="topic-open-btn">
                        <i class="fa fa-expand" aria-hidden="true"></i> Expand
                    </button>
                </div>
                <div class="scroll-topic-ana p-4">
                    @if($subProf)
                    @foreach($subProf as $val)
                    <div class="d-flex align-items-center mt-3 pb-1">
                        <div class="d-flex align-items-center   py-2 dashboard-listing-details w-100 me-5 ">
                            <span class="mr-3 dashboard-name-txt">{{$val->topic_name}}</span>

                        </div>
                        <div class="progress  ms-auto col-5" style="overflow: visible;">
                            <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{($val->total_questions>0)?round(($val->correct_ans * 100)/$val->total_questions):0}}%;overflow: visible;">
                                <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Correct">{{round($val->correct_ans)}}</span>
                            </div>
                            <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{($val->total_questions>0)?round(($val->incorrect_ans * 100)/$val->total_questions):0}}%;overflow: visible;">
                                <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-red" title="Incorrect">{{round($val->incorrect_ans)}}</span>
                            </div>
                            <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{($val->total_questions>0)?round(($val->unanswered * 100)/$val->total_questions):0}}%;overflow: visible;">
                                <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Unanswered">{{round($val->unanswered)}}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 mt-3">
            <div class="bg-white shadow-lg p-3 h-100 px-3 text-center">
                <p class="text-uppercase fw-bold text-start"> Marks Trend</p>
                <div id="day1" style="display:block"></div>
                <div id="week1" style="display:none"></div>
                <div id="month1" style="display:none"></div>
                <div class="btn-block mt-5 d-flex justify-content-between">
                    <button class="btn btn-light-green text-uppercase rounded-0 px-5" onclick="replace1('day1','week1','month1')">
                        Day
                    </button>
                    <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5" onclick="replace1('week1','day1','month1')">
                        Week
                    </button>
                    <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5" onclick="replace1('month1','day1','week1')">
                        Month
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-7  mt-3">
            <div class="bg-white shadow-lg p-3 h-100 px-3">
                <p class="text-uppercase fw-bold text-start">Average Time Spent on each
                    Question</p>
                <div id="accPerSubjectWise1"></div>
            </div>
        </div>
        <div class="col-lg-5 mt-3">
            <div class="bg-white shadow-lg p-3 h-100 px-3 text-center">
                <p class="text-uppercase fw-bold text-start">Time Management</p>
                <div id="day" style="display:block"></div>
                <div id="week" style="display:none"></div>
                <div id="month" style="display:none"></div>
                <div class="btn-block mt-5 d-flex justify-content-between">
                    <button class="btn btn-light-green text-uppercase rounded-0 px-5" onclick="replace('day','week','month')">
                        Day
                    </button>
                    <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5" onclick="replace('week','day','month')">
                        Week
                    </button>
                    <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5" onclick="replace('month','day','week')">
                        Month
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-7  mt-3">
            <div class="bg-white shadow-lg p-3  px-3">
                <p class="text-uppercase fw-bold text-start">Accuracy Percentage</p>
                <div id="accPerSubjectWise"></div>
            </div>
            <div class="bg-white shadow-lg p-3 mt-3 px-5">
                <div class="d-flex">
                    <a href="{{url('/dashboard')}}" class="btn btn-outline-secondary rounded-0 w-50 me-4">Back
                        to Dashboard
                    </a>
                    <button class="btn btn-outline-danger rounded-0 w-50 ms-4 ms-auto" data-bs-toggle="modal" data-bs-target="#exportAnalytics">
                        <i class="fa fa-download"></i> &nbsp;Export Analytics
                    </button>
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
                    {{ucwords($subScore[0]->subject_name)}}</a>
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


<script>
    $(".scroll-topic-ana").slimscroll({
        height: "42.5vh",
    });
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

    function replace1(show, hide1, hide2) {
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

        series: [{
            name: 'Class Average',
            data: <?php print_r($stuAcc); ?>,
            color: '#ff9999',
            dashStyle: 'ShortDash'
        }, {
            name: 'Student Average',
            data: <?php print_r($classAcc); ?>,
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

        series: [{
            name: 'Class Average',
            data: <?php print_r($stuAccuracy); ?>,
            color: '#ff9999',
            dashStyle: 'ShortDash'
        }, {
            name: 'Student Average',
            data: <?php print_r($classAccuracy); ?>,
            color: '#6ec986',
        }]
    });
</script>

<script>
    Highcharts.chart('scorecontainer', {
        chart: {
            height: 180,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            spacingTop: 0,
            spacingBottom: 0,
            spacingRight: 0,
        },
        title: {
            text: '<span style="font: normal normal 200 74px/111px Poppins; letter-spacing: 0px; color: #231F20;">{{isset($scoreArray["score"])?$scoreArray["score"]:0}}</span> <br><span style="font: normal normal normal 18px/27px Poppins;letter-spacing: 0px;color: #231F20;"> / 100 </span>',
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
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
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
                    y: <?php print_r($scoreArray['score']); ?>,
                    color: '#ffdc34' // Jane's color
                },
                {
                    name: 'Inprogress',
                    y: <?php print_r($scoreArray['inprogress']); ?>,
                    color: '#fc2f00c7' // Jane's color
                },
                {
                    name: 'Progress',
                    y: <?php print_r($scoreArray['progress']); ?>,
                    color: '#ffa81d' // Jane's color
                },
                {
                    name: 'Others',
                    y: <?php print_r($scoreArray['others']); ?>,
                    color: '#e4e4e4' // Jane's color
                }
            ]
        }]
    });
</script>