@extends('afterlogin.layouts.app_new')
<script type="text/javascript" src="{{URL::asset('public/js/jquery-3.6.0.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
</script>
<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
    $(window).load(function() {
        $("#endExam").modal({
            backdrop: "static",
            keyboard: false
        });
        $('#endExam').modal('show');
    });
</script>
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper" id="exam_result_analysis">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')

    <div class="content-wrapper">
        <div class="container-fluid exam-analytics">
            <div class="row">
                <div class="col-12 mb-4">
                    <button class="btn px-5 top-btn-pop text-white" data-bs-toggle="modal" data-bs-target="#exportAnalytics">
                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4887" width="20" height="24" viewBox="0 0 24 24">
                                        <path data-name="Path 82" d="M0 0h24v24H0z" style="fill:none"></path>
                                        <path data-name="Path 83" d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                        <path data-name="Path 84" d="m7 11 5 5 5-5" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                        <path data-name="Line 45" transform="translate(11.79 4)" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v12"></path>
                                    </svg>       
                                    &nbsp;Export Analytics</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="bg-white shadow-lg p-3 position-relative">

                        <h5 class="dashboard-title mb-3 text-center">Total Score</h5>
                        <div class="text-center">
                            <!-- <img src="images/roundedgraph.jpg"> -->
                            <div id="scorecontainer"></div>
                        </div>
                        <div class="row my-4">
                            <div class="col">
                                <span class="abrv-graph bg1"> </span>
                                <span class="graph-txt">Correct Attempts</span>
                            </div>
                            <div class="col">
                                <span class="abrv-graph bg2"> </span>
                                <span class="graph-txt">Wrong Attempts</span>
                            </div>
                            <div class="col">
                                <span class="abrv-graph bg3"> </span>
                                <span class="graph-txt">Not Answered</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="bg-white shadow-lg p-3  position-relative">


                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="dashboard-title mb-3 text-center">Marks %</h5>
                                <svg viewBox="0 0 36 36" class="circular-chart green">
                                    <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle" stroke-dasharray="{{isset($response->result_percentage)?number_format($response->result_percentage,1):0}}, 100" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <text x="18" y="22.35" class="percentage">{{isset($response->result_percentage)?number_format($response->result_percentage,1):0}}%</text>
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-column">
                                    <div class="map-right-graph">
                                        <div id="subjectScroe"></div>
                                        <!-- <img src="images/right-graph.jpg"> -->
                                    </div>
                                    <div class="mt-auto btn-block">
                                        <button class="btn w-100 mt-2 top-btn-pop text-white" onclick='resetData("all")'>Overall</button>
                                        <div class="row mt-2">
                                            @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                            @foreach($response->subject_wise_result as $subject)
                                            @php $subject=(object)$subject; @endphp
                                            <div class="col"><button id="{{$subject->subject_name}}" class="btn btn-outline-secondary w-100 top-btn-pop text-white" onclick='resetData("{{$subject->subject_id}}")'>{{$subject->subject_name}}</button></div>
                                            @endforeach
                                            @endif
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row mt-5 mb-3">
                <div class="col-5">
                    <div class="bg-white shadow p-3 d-flex flex-column position-relative h-100">

                        <h5 class="dashboard-title mb-3">Subject Score</h5>

                        @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                        @foreach($response->subject_wise_result as $subject)
                        @php $subject=(object)$subject; @endphp
                        @php
                        $correct_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->correct_count/$subject->total_questions)*100),2):0;
                        $incorrect_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->incorrect_count/$subject->total_questions)*100),2):0;
                        $not_attempt_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->unanswered_count/$subject->total_questions)*100),2):0;
                        @endphp
                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                            <span class="subj-name me-4 col-3">{{$subject->subject_name}}</span>
                            <div class="progress ms-auto  col-8" style="overflow: visible;">
                                @if($correct_per > 0)
                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{$correct_per}}%; overflow: visible;">
                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="{{$correct_per}}%">{{$subject->correct_count}}</span>
                                </div>
                                @endif
                                @if($incorrect_per > 0)
                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{$incorrect_per}}%;overflow: visible;">
                                    <span class="prog-box red" data-bs-custom-class="tooltip-red" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$incorrect_per}}">{{$subject->incorrect_count}}</span>
                                </div>
                                @endif
                                @if($not_attempt_per > 0)
                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{$not_attempt_per}}%;overflow: visible;">
                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-gray" data-bs-placement="top" title="{{$not_attempt_per}}">{{$subject->unanswered_count}}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @endif


                        <div class="row py-4 mt-4 mb-5">
                            <div class="col d-flex align-items-center">
                                <span class="abrv-graph bg1"> </span>
                                <span class="graph-txt d-inline-block ms-2">Correct Attempts</span>
                            </div>
                            <div class="col d-flex align-items-center">
                                <span class="abrv-graph bg2"> </span>
                                <span class="graph-txt d-inline-block ms-2">Wrong Attempts</span>
                            </div>
                            <div class="col d-flex align-items-center">
                                <span class="abrv-graph bg3"> </span>
                                <span class="graph-txt d-inline-block ms-2">Not Answered</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="bg-white shadow position-relative">
                        <div class="tab-wrapper h-100">
                            <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                                @php $subx=1; @endphp
                                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                @foreach($response->subject_wise_result as $subject)
                                @php $subject=(object)$subject; @endphp
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($subx==1) active @endif" id="{{$subject->subject_name}}_tab_subject" data-bs-toggle="tab" href="#{{$subject->subject_name}}_subject" role="tab" aria-controls="{{$subject->subject_name}}" aria-selected="true">{{$subject->subject_name}}</a>
                                </li>
                                @php $subx++; @endphp
                                @endforeach
                                @endif


                            </ul>

                            <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                                @php $topx=1; @endphp
                                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                @foreach($response->subject_wise_result as $subject)
                                @php $subject=(object)$subject;
                                $subject_id=$subject->subject_id;
                                @endphp
                                <div class="tab-pane fade show @if($topx==1) active @endif" id="{{$subject->subject_name}}_subject" role="tabpanel" aria-labelledby="{{$subject->subject_name}}_tab_subject">

                                    <div class="hScroll topicdiv-scroll">
                                        @if(isset($response->topic_wise_result) && !empty($response->topic_wise_result))
                                        @foreach($response->topic_wise_result as $topic)
                                        @php $topic=(object)$topic; @endphp
                                        @php
                                        $tcorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?round((($topic->correct_count/$topic->total_questions)*100), 2):0;
                                        $tincorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?round((($topic->incorrect_count/$topic->total_questions)*100), 2):0;
                                        $tnot_attempt_per=(100-($tcorrect_per+$tincorrect_per));

                                        @endphp
                                        @if($topic->subject_id==$subject_id && !empty($topic->topic_name))

                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1 pe-3">
                                            <span class="subj-name  col-4">{{!empty($topic->topic_name)?$topic->topic_name:''}}</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                @if($tcorrect_per > 0)
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{$tcorrect_per}}%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">{{$topic->correct_count}}</span>
                                                </div>
                                                @endif
                                                @if($tincorrect_per > 0)
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{$tincorrect_per}}%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tincorrect_per}}">{{$topic->incorrect_count}}</span>
                                                </div>
                                                @endif
                                                @if($tnot_attempt_per > 0)
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{$tnot_attempt_per}}%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tnot_attempt_per}}">{{$topic->unanswered_count}}</span>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @php $topx++; @endphp
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-9">
                    <div class="bg-white shadow p-5 position-relative">

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h5 class="dashboard-title mb-3 text-center">Rank Analysis</h5>
                                <div id="rank"></div>

                                <!-- <img src="images/bottom-left.jpg" /> -->
                            </div>
                            <div class="col-md-8">
                                <div class="blue-block d-flex flex-column">
                                    <span>Your Current Rank</span>
                                    <span class="text-success fs-1">{{$response->user_rank}}</span>
                                </div>
                                <div class="blue-block d-flex flex-column mt-4">
                                    <span>Total Participant</span>
                                    <span class="text-dark fs-1">{{$response->total_participants}}</span>
                                </div>
                            </div>
                            <!-- <div class="col-12 d-flex mt-5 mb-3">
                            <button class="btn px-4 top-btn-pop text-white">Overall</button>
                            <select class="form-select rounded-0 ms-3  w-25" aria-label="Default select example">
                                <option selected>Subject</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select rounded-0 ms-3 w-25" aria-label="Default select example">
                                <option selected>Topic</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-white shadow p-5 d-flex flex-column position-relative">

                        <span class="text-center w-100"><img src="{{URL::asset('public/after_login/new_ui/images/bottom-right.jpg')}}" /></span>
                        <button class="btn w-100 mt-3 top-btn-pop text-white"><a href="{{route('exam_review', $response->result_id) }}">Review Questions</a></button>
                        <button class="btn-outline-secondary btn rounded-0 w-100 mt-3 px-1"><a href="{{url('/dashboard')}}">Back to Dashboard</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('afterlogin.layouts.footer_new')

@php
$correct_cnt=isset($response->correct_count)?$response->correct_count:0;
$incorrect_cnt=isset($response->wrong_count)?$response->wrong_count:0;
$not_attempt=isset($response->total_exam_marks)?$response->total_exam_marks:0;

$total_question = $response->no_of_question;

$total_makrs=isset($response->total_exam_marks)?$response->total_exam_marks:0;
$correct_score=isset($response->correct_score)?$response->correct_score:0;
$incorrect_score=isset($response->incorrect_score)?$response->incorrect_score:0;
$get_score=(isset($response->total_get_marks) && ($response->total_get_marks)>=0)?$response->total_get_marks:0;
$get_score_json=json_encode($get_score);
$class_average=(isset($response->class_average) && ($response->class_average)>=0)?$response->class_average:0;
$class_average_json=json_encode($class_average);

$correct_per_pie=!empty($total_question)?round((($correct_cnt/$total_question)*100),2):0;
$incorrect_per_pie=!empty($total_question)?round((($incorrect_cnt/$total_question)*100),2):0;

$not_attempt_per_pie=100-($correct_per_pie+$incorrect_per_pie);

$subject_graph=isset($response->subject_graph)?$response->subject_graph:0;
$stuscore_arr=$clsAvg_arr=[];
$stuscore=$clsAvg=0;
foreach($subject_graph as $key=>$gh){
$stuscore=$stuscore+$gh->student_score;
$clsAvg=$clsAvg+$gh->class_score;
}

$stuscore_arr[]=$stuscore;
$stuscore_json=json_encode($stuscore_arr);
$clsAvg_arr[]=$clsAvg;
$clsAvg_json=json_encode($clsAvg_arr);

@endphp

<script>
    $(".topicdiv-scroll").slimscroll({
        height: "50vh",
    });
    Highcharts.chart('scorecontainer', {
        chart: {
            height: 224,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: '<span style="font: normal normal normal 70px/136px Poppins;color: #2C3348;">{{$get_score}}</span><span style="font: normal normal normal 16px/30px Poppins;color: #2C3348;">/{{$total_makrs}} </span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 75

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
                startAngle: -180,
                endAngle: 180,
                center: ['50%', '50%'],
                size: '100%'
            }
        },
        series: [{
            type: 'pie',

            innerSize: '90%',
            data: [{
                    name: 'Correct Attempts',
                    y: <?php echo $correct_per_pie; ?>,
                    color: '#AFF3D0' // Jane's color
                },
                {
                    name: 'Wrong Attempts',
                    y: <?php echo $incorrect_per_pie; ?>,
                    color: '#ff9999' // Jane's color
                },
                {
                    name: 'Not Answered',
                    y: <?php echo $not_attempt_per_pie; ?>,
                    color: '#e4e4e4' // Jane's color
                }


            ]
        }]
    });


    const chart = Highcharts.chart('subjectScroe', {
        chart: {
            type: 'column',
            height: 265,
        },
        title: {
            text: ''
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },


        xAxis: {
            categories: ['Scores']
        },
        plotOptions: {
            column: {
                borderRadius: 1
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
            name: "Your Score",
            data: <?php echo $stuscore_json; ?>,
            color: '#AFF3D0'
        }, {
            name: "Class Average",
            data: <?php echo $clsAvg_json; ?>,
            color: '#FFFA6A'
        }]
    });


    function resetData(subject_id) {
        if (subject_id == 'all') {

            chart.series[0].setData(<?php echo $stuscore_json; ?>);
            chart.series[1].setData(<?php echo $clsAvg_json; ?>);
        } else {
            var graphArr = <?php echo json_encode($subject_graph); ?>;
            var studet_score = [];
            var class_score = [];
            const iterator = graphArr.values();
            for (const value of iterator) {
                if (value.subject_id == subject_id) {
                    studet_score.push(value.student_score)
                    class_score.push(value.class_score)

                }
            }

            chart.series[0].setData(studet_score);
            chart.series[1].setData(class_score);
        }
    }
</script>

<script>
    Highcharts.setOptions({
        colors: ['#ff9999', '#fde98d', '#aff3d0']
    });
    Highcharts.chart('rank', {
        chart: {
            type: 'pyramid',
            height: 200
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        title: {
            text: '',
            x: -50
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> {point.y:,.0f}',
                    softConnector: true
                },
                center: ['40%', '50%'],
                width: '80%'
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Unique users',
            data: [
                ['', <?php echo $response->total_participants; ?>],
                ['AIR', <?php echo $response->user_rank; ?>],
                ['', 1]
            ]
        }]
    });
</script>

@endsection