@extends('afterlogin.layouts.app')

@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper bg-gray">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-4">
                    <button class="btn btn-danger rounded-0 px-5" data-bs-toggle="modal" data-bs-target="#exportAnalytics"><i class="fas fa-download"></i> Export Analytics</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="bg-white shadow-lg p-3 position-relative">
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <h5 class="dashboard-title mb-3 text-center">Total Score</h5>
                        <div class="text-center">
                            <!--  <img src={{URL::asset('public/after_login/images//roundedgraph.jpg')}}"> -->
                            <div id="scorecontainer"></div>
                        </div>
                        <div class="row my-4">
                            <div class="col">
                                <span class="abrv-graph bg1"> </span>
                                <span class="graph-txt text-uppercase">Correct Attempts</span>
                            </div>
                            <div class="col">
                                <span class="abrv-graph bg2"> </span>
                                <span class="graph-txt text-uppercase">Wrong Attempts</span>
                            </div>
                            <div class="col">
                                <span class="abrv-graph bg3"> </span>
                                <span class="graph-txt text-uppercase">Not Answered</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="bg-white shadow-lg p-3  position-relative">
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>

                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="dashboard-title mb-3 text-center">Marks %</h5>
                                <svg viewBox="0 0 36 36" class="circular-chart green">
                                    <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle" stroke-dasharray="{{isset($response->result_percentage)?$response->result_percentage:0}}, 100" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <text x="18" y="22.35" class="percentage" style="font-size:9px;">{{isset($response->result_percentage)?number_format($response->result_percentage,1):0}}%</text>
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-column">
                                    <div class="">
                                        <figure class="highcharts-figure">
                                            <div id="subjectScroe"></div>

                                        </figure>
                                        <!-- <img src="{{URL::asset('public/after_login/images/right-graph.jpg')}}"> -->
                                    </div>
                                    <div class="mt-auto btn-block">
                                        <button class="btn btn-light-green rounded-0 w-100 mt-1" onclick='resetData("all")'>Overall</button>
                                        <div class="row mt-4">
                                            @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                            @foreach($response->subject_wise_result as $subject)
                                            @php $subject=(object)$subject; @endphp
                                            <div class="col">
                                                <button id="{{$subject->subject_name}}" class="btn btn-outline-secondary rounded-0 w-100" onclick='resetData("{{$subject->subject_id}}")'>{{$subject->subject_name}}</button>
                                            </div>
                                            <!-- <div class="col">
                                                <buton class="btn btn-outline-secondary rounded-0 w-100">Physics</buton>
                                            </div>
                                            <div class="col">
                                                <buton class="btn btn-outline-secondary rounded-0 w-100 ">Chemistry</buton>
                                            </div> -->
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
                    <div class="bg-white shadow p-3 d-flex flex-column position-relative h-100 ">
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <h5 class="dashboard-title mb-3">Subject Score</h5>
                        @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                        @foreach($response->subject_wise_result as $subject)
                        @php $subject=(object)$subject; @endphp
                        @php
                        $correct_per=(isset($subject->total_questions) && $subject->total_questions>0)?($subject->correct_count/$subject->total_questions)*100:0;
                        $incorrect_per=(isset($subject->total_questions) && $subject->total_questions>0)?($subject->incorrect_count/$subject->total_questions)*100:0;
                        $not_attempt_per=(isset($subject->total_questions) && $subject->total_questions>0)?($subject->unanswered_count/$subject->total_questions)*100:0;
                        @endphp
                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                            <span class="subj-name me-4 col-3">{{$subject->subject_name}}</span>
                            <div class="progress ms-auto  col-8" style="overflow: visible;">
                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{$correct_per}}%; overflow: visible;">
                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="{{$correct_per}}%">{{$subject->correct_count}}</span>
                                </div>
                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{$incorrect_per}}%;overflow: visible;">
                                    <span class="prog-box red" data-bs-custom-class="tooltip-red" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$incorrect_per}}%">{{$subject->incorrect_count}}</span>
                                </div>
                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{$not_attempt_per}}%;overflow: visible;">
                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-gray" data-bs-placement="top" title="{{$not_attempt_per}}">{{$subject->unanswered_count}}</span>
                                </div>
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
                <div class="col-7 ">
                    <div class="bg-white shadow position-relative"> <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <div class="tab-wrapper h-100 mt-0">
                            <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                                @php $subx=1; @endphp
                                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                @foreach($response->subject_wise_result as $subject)
                                @php $subject=(object)$subject; @endphp
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($subx==1) active @endif" id="{{$subject->subject_name}}-tab" data-bs-toggle="tab" href="#{{$subject->subject_name}}" role="tab" aria-controls="{{$subject->subject_name}}" aria-selected="true">{{$subject->subject_name}}</a>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Physics</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Chemistry</a>
                                </li> -->
                                @php $subx++; @endphp
                                @endforeach
                                @endif

                            </ul>

                            <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                                @php $topx=1; @endphp
                                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                                @foreach($response->subject_wise_result as $subject)
                                @php $subject=(object)$subject; @endphp
                                <div class="tab-pane fade show @if($topx==1) active @endif" id="{{$subject->subject_name}}" role="tabpanel" aria-labelledby="{{$subject->subject_name}}-tab">
                                    <div class="hScroll topicdiv-scroll">
                                        @if(isset($response->topic_wise_result) && !empty($response->topic_wise_result))
                                        @foreach($response->topic_wise_result as $topic)
                                        @php $topic=(object)$topic; @endphp
                                        @php
                                        $tcorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?($topic->correct_count/$topic->total_questions)*100:0;
                                        $tincorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?($topic->incorrect_count/$topic->total_questions)*100:0;
                                        $tnot_attempt_per=(100-($tcorrect_per+$tincorrect_per));
                                        @endphp
                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                                            <span class="subj-name me-4 col-3">Topic Name</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{$tcorrect_per}}%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tcorrect_per}}%">{{$topic->correct_count}}</span>
                                                </div>
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{$tincorrect_per}}%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tincorrect_per}}%">{{$topic->incorrect_count}}</span>
                                                </div>
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{$tnot_attempt_per}}%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tnot_attempt_per}}%">{{$topic->unanswered_count}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                </div>
                                @php $topx++; @endphp
                                @endforeach
                                @endif
                                <!--  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-9">
                    <div class="bg-white shadow p-5 position-relative">
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h5 class="dashboard-title mb-3 text-center">Rank Analysis</h5>
                                <img src="{{URL::asset('public/after_login/images/bottom-left.jpg')}}" />
                            </div>
                            <div class="col-md-8">
                                <div class="blue-block d-flex flex-column">
                                    <!--   <span>Your rank has improved (Previous Rank - 5987)</span> -->
                                    <span>Your Current Rank</span>
                                    <span class="text-success fs-1">{{$response->user_rank}}</span>
                                </div>
                                <div class="blue-block d-flex flex-column mt-4">
                                    <span>Total Participant</span>
                                    <span class="text-dark fs-1">{{$response->total_participants}}</span>
                                </div>
                            </div>
                            <!--  <div class="col-12 d-flex mt-5 mb-3">
                                <button class="btn btn-light-green rounded-0 px-4">Overall</button>
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

                        <span class="text-center w-100" style="height: 163px;"><img src="{{URL::asset('public/after_login/images/bottom-right.jpg')}}" /></span>
                        <a href="{{route('exam_review', $response->result_id) }}" class="btn-danger btn rounded-0 w-100 mt-3">Review Questions</a>
                        <a href="{{url('/dashboard')}}" class="btn-outline-secondary btn rounded-0 w-100 mt-3">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@include('afterlogin.layouts.footer')
@php
$correct=isset($response->correct_count)?$response->correct_count:0;
$incorrect=isset($response->wrong_count)?$response->wrong_count:0;
$not_attempt=isset($response->total_exam_marks)?$response->total_exam_marks:0;
$total_question=isset($response->no_of_question)?$response->no_of_question:0;

$total_makrs=isset($response->total_exam_marks)?$response->total_exam_marks:0;
$correct_score=isset($response->correct_score)?$response->correct_score:0;
$incorrect_score=isset($response->incorrect_score)?$response->incorrect_score:0;
$get_score=(isset($response->total_get_marks) && ($response->total_get_marks)>=0)?$response->total_get_marks:0;;

$correct_per=!empty($total_question)?number_format((($correct/$total_question)*100),2):0;
$incorrect_per=!empty($total_question)?number_format((($incorrect/$total_question)*100),2):0;
$not_attempt_per=100-($correct_per+$incorrect_per);

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


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://www.highcharts.com/samples/data/three-series-1000-points.js"></script>
<script>
    $(".topicdiv-scroll").slimscroll({
        height: "50vh",
    });
    Highcharts.chart('scorecontainer', {
        chart: {
            height: 250,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: '<span style="font-size:80px">{{$get_score}}</span> <span style="font-size:24px"> / {{$total_makrs}} </span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 70
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
                    y: <?php echo $correct_per; ?>,
                    color: '#AFF3D0' // Jane's color
                },
                {
                    name: 'Wrong Attempts',
                    y: <?php echo $incorrect_per; ?>,
                    color: '#ff9999' // Jane's color
                },
                {
                    name: 'Not Answered',
                    y: <?php echo $not_attempt_per; ?>,
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
@endsection