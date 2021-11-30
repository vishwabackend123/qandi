@extends('afterlogin.layouts.app')

@section('content')


<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper  h-100">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="tab-wrapper mt-0">
                        <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="overall-tab" data-bs-toggle="tab" href="#overall" role="tab" aria-controls="home" aria-selected="true" onclick="nxtTab(null)">OVERALL</a>
                            </li>
                            @foreach($user_subjects as $val)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="home-tab-{{$val->id}}" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="nxtTab('{{$val->id}}')">{{$val->subject_name}}</a>
                            </li>
                            @endforeach
                            <li class="ms-auto d-flex">
                                <button onclick="get_upcomming_tutorials()" class="btn btn-outline-danger px-4 text-uppercase  rounded-0 ms-auto me-3 ">
                                    Upcoming Tutorial
                                </button>
                                <a class="btn btn-danger rounded-0 py-2 px-5 h-100 d-flex justify-content-center align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#exportAnalytics"><i class="me-2 fa fa-download"></i> Export Analytics</a>
                            </li>
                        </ul>
                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overall" role="tabpanel" aria-labelledby="overall-tab">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="bg-white shadow-lg h-100">
                                            <div class="row p-0 m-0">
                                                <div class="col-12 ps-0 pe-0">
                                                    <div class="d-flex justify-content-center flex-column h-100  position-relative">
                                                        <div id="scorecontainer" class="text-right"></div>
                                                        <span class=" bg-light p-3 d-flex  justify-content-center flex-column ">
                                                            <span class="abri"> <span class="abrv-mean bg1"></span>Last
                                                                Mock Test Score</span>
                                                            <span class="abri"> <span class="abrv-mean bg2"></span>Progress from previous
                                                                score</span>
                                                            <span class="abri"> <span class="abrv-mean bg3"></span>Next
                                                                Mock Test Target</span>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 ">
                                        <div class="bg-white shadow-lg p-3 h-100">
                                            <h5 class="dashboard-title mb-3">Subject proficiency</h5>
                                            @if(!empty($subProf))
                                            @foreach($subProf as $key=>$sub)
                                            <div class="d-flex align-items-center m-2 mt-3 pb-1">

                                                <div class=" d-flex align-items-center   py-2 dashboard-listing-details w-100  me-4">
                                                    <span class="mr-3 dashboard-name-txt sub-name-box">{{$sub->subject_name}}</span>

                                                    <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                                                        <div class="star-ratings-css">
                                                            <div class="star-ratings-css-top" style="width: {{round($sub->score)}}%">
                                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                            </div>
                                                            <div class="star-ratings-css-bottom">
                                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                            </div>
                                                        </div>

                                                        <div class="ms-1 score score-rating js-score">
                                                            {{round($sub->score)}}%
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress  col-md-6" style="overflow: visible;">
                                                    @if(isset($sub->correct_ans) && $sub->correct_ans > 0)
                                                    <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{($sub->total_questions>0)?round(($sub->correct_ans * 100)/$sub->total_questions):0}}%;overflow: visible;">
                                                        <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Correct">{{round($sub->correct_ans)}}</span>
                                                    </div>
                                                    @endif
                                                    @if(isset($sub->incorrect_ans) && $sub->incorrect_ans > 0)
                                                    <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{($sub->total_questions>0)?round(($sub->incorrect_ans * 100)/$sub->total_questions):0}}%;overflow: visible;">
                                                        <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-red" title="Incorrect">{{round($sub->incorrect_ans)}}</span>
                                                    </div>
                                                    @endif
                                                    @if(isset($sub->unanswered) && $sub->unanswered > 0)
                                                    <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{($sub->total_questions>0)?round(($sub->unanswered * 100)/$sub->total_questions):0}}%;overflow: visible;">
                                                        <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Unanswered">{{round($sub->unanswered)}}
                                                        </span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-5 mt-3">
                                        <div id="timeManagementBox" class="bg-white shadow-lg p-3 h-100 px-4 text-center">
                                            <p class="text-uppercase fw-bold text-start">Time Management</p>
                                            <div id="day" style="display:block"></div>
                                            <div id="week" style="display:none"></div>
                                            <div id="month" style="display:none"></div>
                                            <div id="timeManagementButtons" class="btn-block mt-5 d-flex justify-content-between">
                                                <button class="btn btn-outline-secondary btn-light-green text-uppercase rounded-0 px-5 timeClass" id="day_time" onclick="replace('day','week','month')">
                                                    Day
                                                </button>
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 timeClass" id="week_time" onclick="replace('week','day','month')">
                                                    Week
                                                </button>
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 timeClass" id="month_time" onclick="replace('month','day','week')">
                                                    Month
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7  mt-3">
                                        <div class="bg-white shadow-lg p-3 h-100 px-4">
                                            <p class="text-uppercase fw-bold text-start">Average Time Spent on each
                                                Question</p>
                                            <div id="accPer1"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 mt-3">
                                        <div class="bg-white shadow-lg p-3 h-100 px-4 text-center">
                                            <p class="text-uppercase fw-bold text-start"> Marks Trend</p>
                                            <div id="day1" style="display:block"></div>
                                            <div id="week1" style="display:none"></div>
                                            <div id="month1" style="display:none"></div>
                                            <div class="btn-block mt-5 d-flex justify-content-between">
                                                <button class="btn btn-outline-secondary btn-light-green text-uppercase rounded-0 px-5 classMark" id="day_mark" onclick="replace1('day1','week1','month1')">
                                                    Day
                                                </button>
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 classMark" id="week_mark" onclick="replace1('week1','day1','month1')">
                                                    Week
                                                </button>
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 classMark" id="month_mark" onclick="replace1('month1','day1','week1')">
                                                    Month
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-7  mt-3">
                                        <div class="bg-white shadow-lg p-3  px-4">
                                            <p class="text-uppercase fw-bold text-start">Accuracy Percentage</p>
                                            <div id="accPer"></div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="upcoming-tutorials" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-2">
                <p class="fs-5">
                    <img src="{{URL::asset('public/images/main-logo-red.png')}} " class="me-2 " />Presents
                </p>
                <div id="tutorials_content">

                </div>
                <p id="tutorial_response" class="mt-4 w-100"></p>
            </div>

        </div>
    </div>
</div>


@include('afterlogin.layouts.footer')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@if(isset($active_id) && !empty($active_id))
<script type="text/javascript">
    $(document).ready(function() {
        var tab_id = '{{$active_id}}';
        $("#home-tab-" + tab_id).click();
    });
</script>
@endif
<script type="text/javascript">
    $(".scroll-topic-ana").slimscroll({
        height: "20vh",
    });
    $('.scroll-div-live-exm').slimscroll({
        height: '60vh'
    });
    $(document).ready(function() {
        $('#topic-open-btn').click(function() {
            $('#topicclose').addClass('close-block');
            $('#topicopen').addClass('open-block');
            $('#topicopen').removeClass('close-block');
        });
        $('#topic-btn').click(function() {
            $('#topicclose').removeClass('close-block');
            $('#topicopen').removeClass('open-block');
            $('#topicopen').addClass('close-block');
        });
    });

    function get_upcomming_tutorials() {

        url = "{{ route('tutorials_session') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },

            success: function(result) {
                $("#tutorials_content").html(result);
                $('#upcoming-tutorials').modal('show');
            }
        });
    }

    function upcomming_tutorials_signup(tutorial_id) {

        url = "{{ url('tutorials_signup') }}/" + tutorial_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },

            success: function(result) {
                var response_data = jQuery.parseJSON(result);
                if (response_data.success == true) {
                    $('#tutorial_response').html('<span class="alert alert-success" role="alert">' + response_data.response + '</span>');
                } else {
                    $('#tutorial_response').html('<span class="alert alert-danger" role="alert">' + response_data.response + '</span>');
                }
                $("#tutorial_response").show();
                $("#tutorial_response").fadeOut(8000);
            }
        });
    }
</script>

<script>
    Highcharts.chart('scorecontainer', {
        chart: {
            height: 185,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            spacingTop: 0,
            spacingBottom: 0,
            spacingRight: 0,
        },
        title: {
            text: '<span style="font: normal normal 200 74px/111px Poppins; letter-spacing: 0px; color: #231F20;">{{$corrent_score_per}}</span> <br><span style="font: normal normal normal 18px/27px Poppins;letter-spacing: 0px;color: #231F20;"> / 100 </span>',
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
                    y: <?php echo $score; ?>,
                    color: '#ffdc34' // Jane's color
                },
                {
                    name: 'Inprogress',
                    y: <?php echo $inprogress; ?>,
                    color: '#fc2f00c7' // Jane's color
                },
                {
                    name: 'Progress',
                    y: <?php echo $progress; ?>,
                    color: '#ffa81d' // Jane's color
                },
                {
                    name: 'Others',
                    y: <?php echo $others; ?>,
                    color: '#e4e4e4' // Jane's color
                }
            ]
        }]
    });
</script>

<script>
    function nxtTab(sub_id) {
        if (sub_id === null) {
            window.location.reload();
        } else {
            url = "{{ url('next_tab/') }}/" + sub_id;
            $.ajax({
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    scoreArray: <?php echo json_encode($scoreArray); ?>
                },
                beforeSend: function() {
                    $('#overlay').fadeIn();
                },
                success: function(result) {
                    $("#overall").html(result);
                    $('#overlay').fadeOut();
                }
            });
        }
    }
</script>

<script>
    Highcharts.chart('accPer', {
        chart: {
            type: 'spline',
            height: 270
        },
        credits: {
            enabled: false
        },
        exporting: {
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
            data: <?php print_r($stuAcc);  ?>,
            color: '#6ec986',

        }]
    });
</script>

<script>
    Highcharts.chart('accPer1', {
        chart: {
            type: 'spline',
            height: 270
        },
        credits: {
            enabled: false
        },
        exporting: {
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
                text: 'Time Spent'
            }
        },
        xAxis: {
            categories: <?php print_r($days); ?>
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
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
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
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
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
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
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
            $(".timeClass").removeClass("btn-light-green");
            $("#day_time").addClass("btn-light-green");
        } else if (show == 'week') {
            $(".timeClass").removeClass("btn-light-green");
            $("#week_time").addClass("btn-light-green");
        } else {
            $(".timeClass").removeClass("btn-light-green");
            $("#month_time").addClass("btn-light-green");
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
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
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
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
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
        exporting: {
            enabled: false
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
        if (show == 'day1') {
            $(".classMark").removeClass("btn-light-green");
            $("#day_mark").addClass("btn-light-green");
        } else if (show == 'week1') {
            $(".classMark").removeClass("btn-light-green");
            $("#week_mark").addClass("btn-light-green");
        } else {
            $(".classMark").removeClass("btn-light-green");
            $("#month_mark").addClass("btn-light-green");
        }
        document.getElementById(hide1).style.display = "none";
        document.getElementById(hide2).style.display = "none";
        document.getElementById(show).style.display = "block";
    }
</script>
@endsection
