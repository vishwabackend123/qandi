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
                    <button class="btn btn-danger rounded-0 px-5" data-bs-toggle="modal" data-bs-target="#exportAnalytics">
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
                        <!-- <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a> -->
                        <h5 class="dashboard-title mb-3 text-center">Total Score</h5>
                        <div class="text-center">
                            <img src="{{URL::asset('public/after_login/images//roundedgraph.jpg')}}">
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
                        <!-- <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a> -->

                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="dashboard-title mb-3 text-center">Marks Percentage</h5>
                                <svg viewBox="0 0 36 36" class="circular-chart green">
                                    <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle" stroke-dasharray="30, 100" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <text x="18" y="22.35" class="percentage">30%</text>
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-column">
                                    <div class=""><img src="{{URL::asset('public/after_login/images//right-graph.jpg')}}"></div>
                                    <div class="mt-auto btn-block">
                                        <buton class="btn btn-light-green rounded-0 w-100 mt-5">Overall</buton>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <buton class="btn btn-outline-secondary rounded-0 w-100">Mathematics</buton>
                                            </div>
                                            <div class="col">
                                                <buton class="btn btn-outline-secondary rounded-0 w-100">Physics</buton>
                                            </div>
                                            <div class="col">
                                                <buton class="btn btn-outline-secondary rounded-0 w-100 ">Chemistry</buton>
                                            </div>
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
                        <!-- <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a> -->
                        <h5 class="dashboard-title mb-3">Subject Score</h5>
                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                            <span class="subj-name me-4 col-3">Mathematics</span>
                            <div class="progress ms-auto  col-8" style="overflow: visible;">
                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Tooltip on top">1</span>
                                </div>
                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                    <span class="prog-box red" data-bs-custom-class="tooltip-red" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                </div>
                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-gray" data-bs-placement="top" title="Tooltip on top">1</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                            <span class="subj-name me-4 col-3">Physics</span>
                            <div class="progress  ms-auto col-8" style="overflow: visible;">
                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Tooltip on top">1</span>
                                </div>
                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-red" title="Tooltip on top">1</span>
                                </div>
                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                    <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                            <span class="subj-name me-4 col-3">Chemistry</span>
                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Tooltip on top">1</span>
                                </div>
                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-red" data-bs-placement="top" title="Tooltip on top">1</span>
                                </div>
                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-gray" data-bs-placement="top" title="Tooltip on top">1</span>
                                </div>
                            </div>
                        </div>

                        <div class="graphdotlisting my-4">
                            <div class="garphlistincom">
                                <span class="abrv-graph bg1"> </span>
                                <span class="graph-txt">Correct Attempts</span>
                            </div>
                            <div class="garphlistincom">
                                <span class="abrv-graph bg2"> </span>
                                <span class="graph-txt">Wrong Attempts</span>
                            </div>
                            <div class="garphlistincom">
                                <span class="abrv-graph bg3"> </span>
                                <span class="graph-txt">Not Answered</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-7 ">
                    <div class="bg-white shadow position-relative">
                        <!-- <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a> -->
                        <div class="tab-wrapper h-100">
                            <ul class="nav nav-tabs cust-tabs exam-panel widthAuto" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mathematics</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Physics</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Chemistry</a>
                                </li>
                            </ul>

                            <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                    <div class="hScroll">
                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                                            <span class="subj-name me-4 col-3">Chemistry</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                                            <span class="subj-name me-4 col-3">Chemistry</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                                            <span class="subj-name me-4 col-3">Chemistry</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                                            <span class="subj-name me-4 col-3">Chemistry</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                                            <span class="subj-name me-4 col-3">Chemistry</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                                            <span class="subj-name me-4 col-3">Chemistry</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
                                            <span class="subj-name me-4 col-3">Chemistry</span>
                                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:40%;overflow: visible;">
                                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:30%;overflow: visible;">
                                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:20%;overflow: visible;">
                                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-9">
                    <div class="bg-white shadow p-5 position-relative">
                        <!-- <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a> -->
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h5 class="dashboard-title mb-3 text-center">Rank Analysis</h5>
                                <img src="{{URL::asset('public/after_login/images//bottom-left.jpg')}}" />
                            </div>
                            <div class="col-md-8">
                                <div class="blue-block d-flex flex-column">
                                    <span>Your rank has improved (Previous Rank - 5987)</span>
                                    <span class="text-success fs-1">3456</span>
                                </div>
                                <div class="blue-block d-flex flex-column mt-4">
                                    <span>Your rank has improved (Previous Rank - 5987)</span>
                                    <span class="text-dark fs-1">1607312</span>
                                </div>
                            </div>
                            <div class="col-12 d-flex mt-5 mb-3">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-white shadow p-4 d-flex flex-column position-relative">
                        <!-- <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a> -->
                        <span class="text-center w-100"><img src="{{URL::asset('public/after_login/images//bottom-right.svg')}}" /></span>
                        <a href="{{route('examreview')}}" class="btn-danger btn rounded-0 w-100 mt-3">Review Questions</a>
                        <a href="{{route('dashboard')}}" class="btn-outline-secondary btn rounded-0 w-100 mt-3">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Export Analytics-->
<div class="modal fade" id="exportAnalytics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
            </div>
            <div class="modal-body pt-0 px-5 ">
                <div class="text-center my-5">
                    <button class="btn btn-danger px-5 rounded-0">
                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4887" width="20" height="24" viewBox="0 0 24 24">
                                        <path data-name="Path 82" d="M0 0h24v24H0z" style="fill:none"></path>
                                        <path data-name="Path 83" d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                        <path data-name="Path 84" d="m7 11 5 5 5-5" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                        <path data-name="Line 45" transform="translate(11.79 4)" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v12"></path>
                                    </svg>  
                    &nbsp;Download</button>
                </div>
                <p class="text-center text-secondary mb-5">OR</p>
                <div class="input-group mb-3">
                    <div class="input-group-text bg-white rounded-0 border-0"><i class="fa fa-envelope-o text-secondary"></i></div>
                    <input type="text" class="form-control border-0 rounded-0 ps-0" id="specificSizeInputGroupUsername" placeholder="Enter e-mail ID">
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-text bg-white rounded-0 border-0"><i class="fas fa-lock text-secondary"></i> </div>
                    <select class="form-select border-0 rounded-0 ps-0" placeholder="Share it only this time">
                        <option class="text-secondary">Share it only this time</option>
                    </select>
                </div>
                <div class="text-center my-5">
                    <button class="btn btn-danger px-5 rounded-0"><i class="fa fa-share-alt"></i> &nbsp;Share</button>
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


@endphp

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
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
</script>
@endsection