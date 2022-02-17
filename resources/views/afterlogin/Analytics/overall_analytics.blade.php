@extends('afterlogin.layouts.app_new')

@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="tab-wrapper">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="overall-tab" data-bs-toggle="tab" href="#overall" role="tab" aria-controls="home" aria-selected="true" onclick="nxtTab(null)">OVERALL</a>
                                </li>
                                @foreach($user_subjects as $val)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="home-tab-{{$val->id}}" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="nxtTab('{{$val->id}}')">{{$val->subject_name}}</a>
                                </li>
                                @endforeach

                                <!--   <li class="ms-auto">
                                <a onclick="get_upcomming_tutorials()" class="Ex-anal btn rounded-0 py-2 px-5 h-100 d-flex justify-content-center align-items-center" href="#">Upcoming Tutorial</a>
                            </li> -->
                                <li class="ms-auto">
                                    <a class="Ex-anal btn rounded-0 py-2 px-5 h-100 d-flex justify-content-center align-items-center" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exportAnalytics"><img src="{{URL::asset('public/after_login/new_ui/images/download-icn.png')}}"> &nbsp;<span class="Ex--an">Export Analytics</span></a>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overall" role="tabpanel" aria-labelledby="overall-tab">
                                <div class="row padingTT">
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <div class="bg-white shadow-lg py-5 px-3">
                                            <div class="prgress-i-txt px-3">
                                                <span class="progress_text">Progress</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 col-md-12">
                                                    <div class="d-flex justify-content-center flex-column h-100 ">
                                                        <span class="text-center">
                                                            <div id="scorecontainer"></div>
                                                        </span>
                                                        <ul class="live-test mb-0">
                                                            <li>
                                                                <span class="last-live-test"></span>Last Test Score
                                                            </li>
                                                            <li>
                                                                <span class="pre-test"></span>Previous Test
                                                            </li>
                                                        </ul>
                                                        <!--  <p class="text-center text-danger px-4"><small>Reach your target score with a steady progress over each test</small></p> -->
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                                        <div class="bg-white shadow-lg py-5 px-3">
                                            <div class="prgress-i-txt px-3">
                                                <span class="progress_text">Subject proficiency</span>
                                            </div>
                                            <div id="prof_scroll" class="scroll-topic-ana pe-2">
                                                @if(!empty($subProf))
                                                @foreach($subProf as $key=>$sub)
                                                <div class="d-flex align-items-center px-3 row">
                                                    <div class="d-flex align-items-center py-2 dashboard-listing-details col-md-6 col-sm-12">
                                                        <span class="mr-3 dashboard-name-txt SubjName">{{$sub->subject_name}}</span>

                                                        <div class="status-id   d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

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
                                                    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 progress  ms-auto px-0" style="overflow: visible;">
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
                                                            <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Unanswered">{{round($sub->unanswered)}}</span>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                            <!-- <p class="text-center text-danger"><small>Work on your weak subject to increase the number of questions answered correctly</small></p> -->
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
                                            <div id="timeManagementButtons" class="btn-block mt-2 d-flex justify-content-between">
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5 timeClass active" id="day_time" onclick="replace('day','week','month')">
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
                                    <div class="col-lg-6  mt-3">
                                        <div class="bg-white p-3 h-100 px-5">
                                            <p class="text-uppercase fw-bold text-start">Average Time Spent on each Question (Last Week)</p>
                                            <div id="accPer1"></div>
                                            <p class="text-center text-danger mt-3 "><small>Lowering this average will add miles to your success journey</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="marKs-trends">
                                    <div class="col-lg-6 mt-3">
                                        <div class="bg-white p-3 h-100 px-5 text-center">
                                            <p class="text-uppercase fw-bold text-start">Marks Trend</p>
                                            <div id="day1" style="display:block"></div>
                                            <div id="week1" style="display:none"></div>
                                            <div id="month1" style="display:none"></div>
                                            <p class="text-center text-danger mt-3"><small>Keep an upward trend to reach the success summit</small></p>
                                            <div class="btn-block mt-2 d-flex justify-content-between">
                                                <button class="btn btn-outline-secondary btn-light-green text-uppercase rounded-0 px-5 classMark active" id="day_mark" onclick="replace1('day1','week1','month1')">
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
                                    <div class="col-lg-6  mt-3">
                                        <div class="bg-white pt-3  px-5">
                                            <p class="text-uppercase fw-bold text-start">Accuracy Percentage (Last Week)</p>
                                            <div id="accPer"></div>
                                            <p class="text-center text-danger mt-3 mb-0"><small>Its not just about how much and how fast, how accurate you are will also add to your success</small></p>
                                        </div>
                                        <div class="bg-white  px-5" id="back2Dsh">
                                            <div class="d-flex">
                                                <button class="btn btn-outline-secondary rounded-0 w-50 me-4"><a href="{{url('/dashboard')}}">Back to Dashboard</a></button>
                                                <button class="btn btn-outline-danger rounded-0 w-50 ms-4 ms-auto" data-bs-toggle="modal" data-bs-target="#exportAnalytics"><img src="{{URL::asset('public/after_login/new_ui/images/download-icn-blk.png')}}"> &nbsp;Export Analytics</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
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


@include('afterlogin.layouts.footer_new')

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
    /* $(".scroll-topic-ana").slimscroll({
        height: "20vh",
    }); */
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
            height: 130,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            spacingTop: 0,
            spacingBottom: 0,
            spacingRight: 0,
        },
        title: {
            text: '<span style="font: normal normal 200 48px/60px Manrope; letter-spacing: 0px; color: #21ccff;">{{$mockTestScoreCurr??0}}</span> <br><span style="font: normal normal normal 14px/22px Manrope;letter-spacing: 0px;color: #21ccff;"> / 100 </span>',
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
                    name: 'Last Mock Test Score',
                    y: <?php echo $mockTestScorePre ?? 0; ?>,
                    color: '#21ccff' // Jane's color
                },
                {
                    name: 'Progress From Previous Score',
                    y: <?php echo $diffmock = (isset($mockTestScoreCurr) && isset($mockTestScorePre)) ? ($mockTestScoreCurr - $mockTestScorePre) : 0; ?>,
                    color: '#d0f3ff' // Jane's color
                },
                {
                    name: '',
                    y: <?php echo (100 - ($mockTestScorePre + $diffmock)); ?>,
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
                stacking: 'normal',
                label: false,
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
                text: 'Average Time Taken (sec)'
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
            $(".timeClass").removeClass("active");
            $("#day_time").addClass("active");
        } else if (show == 'week') {
            $(".timeClass").removeClass("active");
            $("#week_time").addClass("active");
        } else {
            $(".timeClass").removeClass("active");
            $("#month_time").addClass("active");
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
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
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
        exporting: {
            enabled: false
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

    function replace1(show, hide1, hide2) {
        if (show == 'day1') {
            $(".classMark").removeClass("active");
            $("#day_mark").addClass("active");
        } else if (show == 'week1') {
            $(".classMark").removeClass("active");
            $("#week_mark").addClass("active");
        } else {
            $(".classMark").removeClass("active");
            $("#month_mark").addClass("active");
        }
        document.getElementById(hide1).style.display = "none";
        document.getElementById(hide2).style.display = "none";
        document.getElementById(show).style.display = "block";
    }
    $(window).on('load',function(){
        $(".analytics-icon").addClass("notification-icons-active");
    });
</script>

@endsection