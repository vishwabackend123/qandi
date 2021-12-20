@extends('afterlogin.layouts.app_new')

@section('content')
@php
$userData = Session::get('user_data');
@endphp
<!-- Side bar menu -->

<div class="  h-100" id="dialog-pdf" title="pdf" stye="display:none;">
    <!-- top navbar -->

    <div id="contentHtml" class="content-wrapper py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 mx-auto">

                    <div class="bg-white">
                        <div class="report-block1 p-4">
                            <div class="
                      d-flex
                      justify-content-between
                      align-items-center
                      border-bottom
                    ">
                                <span><img src="{{URL::asset('public/images_new/uniq.png')}}" style="width:100px;" /></span>
                                <span class="text-light">{{date("F j, Y")}}</span>
                                <span class="text-light-danger">Analytics</span>
                            </div>
                            <div class="export-block">
                                <h2 class="fw-light text-center mt-5 h1">{{$overallAnalytics->total_participants}}</h2>
                                <p class="text-center">
                                    No. Of students participated for the exam.
                                </p>
                                <h1 class="greentxt">{{$overallAnalytics->user_rank}}</h1>
                                <!--  <p class="text-center fw-bold mt-5">
                                          Your current rank has improved
                                        </p>
                                        <p class="text-center text-ligth">
                                          From <span class="text-light-danger">5987</span>
                                        </p> -->
                                <div class="row">
                                    <div class="mx-auto col-md-10">
                                        <div class="bg-white shadow-lg p-5 report-analysis-block">
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
                                                    <div id="scorecontainer" class="text-right"></div>
                                                    <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">
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
                                                        Overall Proficiency
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="report-block2 p-5">
                            <div class="d-flex">
                                <span class="me-auto"><img src="{{URL::asset('public/images/main-logo-red.png')}}" /></span>
                                <span class="text-end text-light">
                                    Detailed Report Analysis<br />
                                    Weekly UniQ Performace Report<br />{{date("F j, Y")}}
                                </span>
                            </div>
                            <div class="bg-white shadow-lg p-3 mt-5">
                                <h5 class="dashboard-title mb-3">Subject proficiency</h5>
                                @if(!empty($subProf))
                                @foreach($subProf as $key=>$sub)
                                <div class="d-flex align-items-center mt-3 pb-1">
                                    <div class="  col-6">
                                        <div class="row d-flex  align-items-center py-2 dashboard-listing-details  w-100 col-6">
                                            <span class="col-md-6 mr-3 dashboard-name-txt">{{$sub->subject_name}}</span>
                                            <div class="col-md-6 status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">
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
                                    <div class="progress ms-auto col-6" style="overflow: visible">
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

                            </div>
                            <div class="bg-white shadow-lg p-3 mt-5">
                                <h5 class="dashboard-title mb-3">Unit proficiency</h5>
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
                                                    <span class="col-md-6 mr-3 dashboard-name-txt">{{$unit->uni_name}}</span>
                                                    <div class="col-md-6 status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">
                                                        <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">
                                                            <div class="star-ratings-css">
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
                        </div>
                        <div class="bg-white shadow-lg p-3 h-100 px-5 mt-3 text-center">
                            <p class="text-uppercase fw-bold text-start">
                                Time Management
                            </p>
                            <div id="time_management"></div>
                        </div>
                        <div class="bg-white shadow-lg p-3 h-100 mt-3 px-5">
                            <p class="text-uppercase fw-bold text-start">
                                Average Time Spent on each Question
                            </p>
                            <div id="accPer1"></div>
                        </div>
                        <div class="bg-white shadow-lg p-3 px-5 mt-3">
                            <p class="text-uppercase fw-bold text-start">
                                Accuracy Percentage
                            </p>
                            <div id="accPer"></div>
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
<div id="editor"></div>
<a id="cmd" href="javascript:void(0);" class="export-btn" onclick="CreatePDFfromHTML()"><img src="{{URL::asset('public/after_login/images/Group3140@2x.png')}}"></a>
<a href="{{ url('/dashboard') }}" class="close-btn"><img src="{{URL::asset('public/after_login/images/close.png')}}"></a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
@include('afterlogin.layouts.footer_new')

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
                text: 'Average Time Spent'
            }
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
</script>
@endsection