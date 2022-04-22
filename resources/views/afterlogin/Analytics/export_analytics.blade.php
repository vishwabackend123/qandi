@extends('afterlogin.layouts.app_new')

@section('content')
@php
$userData = Session::get('user_data');
@endphp
<!-- Side bar menu -->

<div class="h-100" id="dialog-pdf" title="pdf">
    <!-- top navbar -->

    <div id="contentHtml" class="content-wrapper py-5 exportAnaylisis">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 mx-auto">

                    <div class="bg-white dashboard-cards-block">
                        <div class="report-block1 pb-0 p-6">
                            <div class="
                      d-flex
                      justify-content-between
                      align-items-center
                      border-bottom headeranaylsismain
                    ">
                                <span><img src="{{URL::asset('public/after_login/new_ui/images/QI_Logo_al.gif')}}" style="padding-bottom:20px;" /></span>
                                <span class="text-light">{{date("F j, Y")}}</span>
                                <span class="text-light-danger">Analytics</span>
                            </div>
                            <div class="export-block">
                                <div class="rankholder">
                                    <h2 class="fw-light text-center mt-5 h1">{{$overallAnalytics->total_participants}}</h2>
                                    <p class="text-center">
                                        No. Of students participated for the exam.
                                    </p>
                                    <h1 class="greentxt">{{$overallAnalytics->user_rank}}</h1>
                                </div>


                                <div class="row">
                                    <div class="mx-auto col-md-10">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="report-block2 p-6">
                            <div class="d-flex">
                                <span class="me-auto anaylticslogo"><img src="{{URL::asset('public/after_login/new_ui/images/QnI_Logo.gif')}}" /></span>
                                <span class="text-end detailedtext">
                                    <b>Detailed</b> <span> Report Analysis<br />
                                        Weekly Q&I Performace Report<br />{{date("F j, Y")}}</span>
                                </span>
                            </div>
                            <div class="bg-white mt-5 shadow-lg p-5 report-analysis-block">
                                <small>
                                    <!-- <i class="fa  fa-info"></i> -->
                                    <img style="width:16px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                                    <p>
                                        <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                        <!-- <label>About MyQ Today</label> -->
                                        A score derived from the detailed analysis of your test patterns that gives a clear understanding of your current level of preparation in comparison to an ideal one. Measure your real-time probability of reaching the goal with your current pattern of preparation. Set your goal!
                                    </p>
                                </small>
                                <div class="d-flex align-items-center border-bottom pb-4">
                                    <div>
                                        <h1 class="reportHeading">
                                            Report <span>Analysis</span>
                                        </h1>
                                    </div>
                                    <div class="ms-auto d-flex align-items-center">
                                        <div>
                                            <img id="imageid" src="{{$imgPath}}" class="exportUserpic" alt="image" />
                                        </div>
                                        <div class="exportUsertxt">
                                            <p>{{ucwords($userData->user_name)}}</p>
                                            <small><strong>Class - {{$user_stage}}</strong>, Preparing
                                                for
                                                {{isset($subscription_details->subscription_name)?$subscription_details->subscription_name:''}}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-5">
                                    <div class="col-md-12 text-center">
                                        <div class="prgress-i-txt px-3">
                                            <span class="progress_text">Progress</span>
                                        </div>
                                        <!-- <div id="scorecontainer"></div> -->
                                        <div id="comparegraph"></div>
                                        <div class="status-id-disable     d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">
                                            <div class="star-ratings-css m-0 me-3">
                                                <div class="star-ratings-css-top" style="width: {{round($overall_prof_perc)}}%">
                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                </div>
                                                <div class="star-ratings-css-bottom">
                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                </div>
                                            </div>
                                            <div class="ms-1 score score-rating js-score">
                                                {{round($overall_prof_perc)}}%
                                            </div>

                                        </div>
                                        <p class="text-center text-light mt-3">
                                            Overall Subjects Proficiency
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <div id="myTabContent" class="bg-white shadow-lg p-3 mt-5">
                                <small>
                                    <!-- <i class="fa  fa-info"></i> -->
                                    <img style="width:16px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                                    <p>
                                        <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                        This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                    </p>
                                </small>
                                <h5 class="dashboard-title mb-3">Subject Performance </h5>
                                @if(!empty($subProf))
                                @foreach($subProf as $key=>$sub)
                                <div class="d-flex align-items-center mt-3 pb-1">
                                    <div class="  col-6 col-lg-7 col-md-6">
                                        <div class="row d-flex  align-items-center py-2 dashboard-listing-details  w-100 ">
                                            <span class="col-md-5 mr-3 dashboard-name-txt">{{$sub->subject_name}}</span>
                                            <div class="col-md-7 pe-5">
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
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 progress  ms-auto" style="overflow: visible;">
                                        @if($sub->correct_ans > 0)
                                        <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{($sub->total_questions>0)?round(($sub->correct_ans * 100)/$sub->total_questions):0}}%;overflow: visible;">
                                            <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Correct">{{round($sub->correct_ans)}}</span>
                                        </div>
                                        @endif
                                        @if($sub->incorrect_ans > 0)
                                        <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{($sub->total_questions>0)?round(($sub->incorrect_ans * 100)/$sub->total_questions):0}}%;overflow: visible;">
                                            <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-red" title="Incorrect">{{round($sub->incorrect_ans)}}</span>
                                        </div>
                                        @endif
                                        @if($sub->unanswered > 0)
                                        <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{($sub->total_questions>0)?round(($sub->unanswered * 100)/$sub->total_questions):0}}%;overflow: visible;">
                                            <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Unanswered">{{round($sub->unanswered)}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                <!--p class="text-center text-danger"><small>Work on your weak subject to increase the number of questions answered correctly</small></p-->
                            </div>
                            <div class="bg-white shadow-lg p-3 mt-5">
                                <h5 class="dashboard-title mb-3 fw-bold">Unit proficiency</h5>
                                <div class="row">
                                    @if(!empty($unitProf))
                                    @foreach($unitProf as $key=>$unit)
                                    <div class="col-md-12 border-bottom pt-2">
                                        <span class="dashboard-name-txt fw-bold">{{$unit->subject_name}}</span>
                                        <div class="px-4">
                                            @if(isset($unit->unit_score))
                                            @foreach($unit->unit_score as $unit)
                                            <div class="d-flex align-items-center  ">
                                                <div class="row d-flex  align-items-center py-1 dashboard-listing-details  w-100 col-6">
                                                    <span class="col-md-8 mr-3 dashboard-name-txt">{{$unit->uni_name}}</span>
                                                    <div class="col-md-4">
                                                        <div class="status-id-disable  m-0  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">
                                                            <div class="star-ratings-css m-0">
                                                                <div class="star-ratings-css-top" style="width:{{round($unit->score)}}%">
                                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                </div>
                                                                <div class="star-ratings-css-bottom">
                                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                </div>
                                                            </div>
                                                            <div class="ms-1 score score-rating js-score">
                                                                {{round($unit->score)}}%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="bg-white shadow-lg p-3 h-100 px-5 mt-3 text-center">
                                <small>
                                    <!-- <i class="fa  fa-info"></i> -->
                                    <img style="width:16px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                                    <p>
                                        <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                        In a limited duration test, it is absolutely essential to manage your time and use it wisely to smartly choose the right questions to attempt. This will greatly increase your chances of achieving the magic score. Invest your time wisely!
                                    </p>
                                </small>
                                <p class="text-uppercase fw-bold text-start garphheading">
                                    Time Management
                                </p>
                                <div id="time_management"></div>
                                <!--p class="text-center text-danger mt-3"><small>Investing your time in correctly answering questions is the key to success.</small></p-->
                            </div>
                            <div class="bg-white shadow-lg p-3 h-100 mt-3 px-5">
                                <small>
                                    <!-- <i class="fa  fa-info"></i> -->
                                    <img style="width:16px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                                    <p>
                                        <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                        Keep your average time spent on each question low by allocating appropriate time to questions based on their difficulty. Lowering this average and add miles to your success!
                                    </p>
                                </small>
                                <p class="text-uppercase fw-bold text-start garphheading">
                                    Average Time Spent on each Question (Last Week)
                                </p>
                                <div id="accPer1"></div>
                                <!--p class="text-center text-danger mt-3 px-5"><small>Lowering this average will add miles to your success journey</small></p-->
                            </div>
                            <div class="bg-white shadow-lg p-3 px-5 mt-3">
                                <small>
                                    <!-- <i class="fa  fa-info"></i> -->
                                    <img style="width:16px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                                    <p>
                                        <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                        It is not always about how many and how fast but how accurate you are in answering within the limited time. Be informed about how you are making efficient use of your time on the right questions. Strategize better for your next test!
                                    </p>
                                </small>
                                <p class="text-uppercase fw-bold text-start garphheading">
                                    Accuracy Percentage (Last Week)
                                </p>
                                <div id="accPer"></div>
                                <!--p class="text-center text-danger mt-3"><small>Its not just about how much and how fast, how accurate you are will also add to your success</small></p-->
                            </div>
                            <p class="text-center mt-5 pt-5">
                                <a href="{{ route('register') }}" class="link-primary" target="_blank">To Know
                                    more: {{ route('register') }}</a>
                            </p>
                            <!-- <h4 class="my-5 text-dark text-center fw-light">
                                    Detailed Report Analysis
                                </h4> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="editor"></div>
<!-- <a id="cmd" href="javascript:void(0);" class="export-btn" onclick="CreatePDFfromHTML()"><img src="{{URL::asset('public/after_login/new_ui/images/download-iccon.png')}}"></a>
 -->

<a style="box-shadow: none;padding: 0;" href="javascript:void(0);" class="export-btn" onclick="window.print()" title="Download Print">
    <!-- <img style="width: 65px;" src="{{URL::asset('public/after_login/new_ui/images/export-download-icon.png')}}"> -->
    <img style="width: 65px;" src="{{URL::asset('public/after_login/new_ui/images/Icon_Download.png')}}">






</a>


<a style="box-shadow: none;padding: 0;" href="{{ url('/dashboard') }}" class="close-btn"><img style="width: 65px;" src="{{URL::asset('public/after_login/new_ui/images/export-cross-icon.png')}}" title="Close" style="width: 30px;"></a>




@include('afterlogin.layouts.footer_new')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>



<script type="text/javascript">
    //Create PDf from HTML...
    function CreatePDFfromHTML() {
        // set attributes and src
        var HTML_Width = $("#contentHtml").width();
        var HTML_Height = $("#contentHtml").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;
        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

        html2canvas($("#contentHtml")[0]).then(function(canvas) {
            var imgData = canvas.toDataURL("image/jpg", 1.0);
            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'jpg', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'jpg', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
            }
            pdf.save("Analytics.pdf");
        });
    }
</script>
<script>
    /* time management */
    Highcharts.chart('time_management', {
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

    /* avegare time spend */

    Highcharts.chart('accPer1', {
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
                text: 'Average Time Spent (Sec)'
            }
        },
        exporting: {
            enabled: false
        },
        xAxis: {
            categories: <?php print_r($days); ?>
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

    /* ACCURACY PERCENTAGE */
    Highcharts.chart('accPer', {
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
        exporting: {
            enabled: false
        },
        xAxis: {
            categories: <?php print_r($day); ?>
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

    $(document).ready(function() {
        $(".dashboard-cards-block .bg-white>small>img").click(function() {
            $(".dashboard-cards-block .bg-white>small p>span").each(function() {
                $(this).parent("p").hide();
            });
            $(this).siblings("p").show();
        });
        $(".dashboard-cards-block .bg-white>small p>span").click(function() {
            $(this).parent("p").hide();
        });
    });
</script>
<script>
    /* score comparison graph */
    Highcharts.chart('comparegraph', {
        chart: {
            type: 'column',
            height: 185,
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['']
        },
        yAxis: [{
            min: 0,
            max: 100,
            title: {
                text: 'Score %'
            }
        }, {
            title: {
                text: ''
            },
            opposite: true
        }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true,
            enabled: false
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            },
            series: {
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },

        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        series: [{
            name: 'Previous score',
            color: '#d0f3ff',
            data: [<?php echo $mockTestScorePre; ?>],
            pointPadding: 0.3,
            pointPlacement: 0,
            dataLabels: {
                enabled: true,
                align: 'left',
                x: 0,
                y: 0,
                rotation: 0,
            }
        }, {
            name: 'Latest score',
            color: '#21ccff',
            data: [<?php echo $mockTestScoreCurr; ?>],
            pointPadding: 0.3,
            pointPlacement: 0.1,
            dataLabels: {
                enabled: true,
                align: 'left',
                x: 0,
                y: 0,
                rotation: 0,
            }
        }]
    });
    /* score comparison graph */


    /* Score Pie Chart */
    /* Highcharts.chart('scorecontainer', {
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
            text: '<span style=" font: normal normal 200 60px/80px Manrope; letter-spacing: 0px; color: #21ccff;">{{$myqScore}}</span> <br><span style=" font: normal normal normal 14px/22px Manrope;letter-spacing: 0px;color: #21ccff;"> / 100 </span>',
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
            }
        },
        series: [{
            type: 'pie',

            innerSize: '85%',
            data: [{
                    name: 'Score',
                    y: <?php echo $myqScore; ?>,
                    color: '#21ccff'
                },
                {
                    name: '',
                    y: <?php echo $myqOther; ?>,
                    color: '#d0f3ff'
                }
            ]

        }]
    }); */
</script>

@endsection