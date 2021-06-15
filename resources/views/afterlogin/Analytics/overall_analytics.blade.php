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

                    <div class="tab-wrapper">
                        <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="overall-tab" data-bs-toggle="tab" href="#overall" role="tab" aria-controls="home" aria-selected="true">OVERALL</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mathematics</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Physics</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Chemistry</a>
                            </li>
                            <li class="ms-auto">
                                <a class="btn btn-danger rounded-0 py-2 px-5 h-100 d-flex justify-content-center align-items-center" href="#"><i class="me-2 fa fa-download"></i> Export Analytics</a>
                            </li>
                        </ul>

                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overall" role="tabpanel" aria-labelledby="overall-tab">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="bg-white shadow-lg ">
                                            <div class="row">
                                                <div class="col-8 pe-0">
                                                    <div class="d-flex justify-content-center flex-column h-100 ">
                                                        <span class=" p-3"><img src="{{URL::asset('public/after_login/images/left-graph.jpg')}}"></span>
                                                        <span class="mt-auto bg-light p-3 d-flex  justify-content-center flex-column graph-bottom-block">
                                                            <span class="abri"> <span class="abrv-mean bg1"></span>Last Mock Test Score</span>
                                                            <span class="abri"> <span class="abrv-mean bg2"></span>Progress from previous score</span>
                                                            <span class="abri"> <span class="abrv-mean bg3"></span>Next Mock Test Target</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-4 ">
                                                    <div class="d-flex flex-column h-100 montain-bg">
                                                        <span></span>
                                                        <span class="mt-auto mb-4  d-flex justify-content-center align-items-center  montain-txt">
                                                            <span class="plus-sign">12</span>
                                                            <small>Set target to<br> Reach next</small>
                                                        </span>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="bg-white shadow-lg p-3">
                                            <h5 class="dashboard-title mb-3">Subject proficiency</h5>
                                            <div class="d-flex align-items-center mt-3 pb-1">
                                                <div class="d-flex align-items-center   py-2 dashboard-listing-details w-100 ">
                                                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                                                    <div class="status-id   d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                                                        <div class="star hidden">
                                                            <span class="full" data-value="0"></span>
                                                            <span class="half" data-value="0"></span>
                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="1"></span>
                                                            <span class="half" data-value="0.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="2"></span>
                                                            <span class="half" data-value="1.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="3"></span>
                                                            <span class="half" data-value="2.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="4"></span>
                                                            <span class="half" data-value="3.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="5"></span>
                                                            <span class="half" data-value="4.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="score score-rating js-score">
                                                            0 %
                                                            <!-- <span>/</span>
                                              <span class="total">5</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress  ms-auto col-6" style="overflow: visible;">
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
                                            <div class="d-flex align-items-center mt-3 pb-1">
                                                <div class="d-flex align-items-center   py-2 dashboard-listing-details w-100 ">
                                                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                                                    <div class="status-id   d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                                                        <div class="star hidden">
                                                            <span class="full" data-value="0"></span>
                                                            <span class="half" data-value="0"></span>
                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="1"></span>
                                                            <span class="half" data-value="0.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="2"></span>
                                                            <span class="half" data-value="1.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="3"></span>
                                                            <span class="half" data-value="2.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="4"></span>
                                                            <span class="half" data-value="3.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="5"></span>
                                                            <span class="half" data-value="4.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="score score-rating js-score">
                                                            0 %
                                                            <!-- <span>/</span>
                                              <span class="total">5</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress  ms-auto col-6" style="overflow: visible;">
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
                                            <div class="d-flex align-items-center mt-3 pb-1">
                                                <div class="d-flex align-items-center   py-2 dashboard-listing-details w-100 ">
                                                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                                                    <div class="status-id   d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                                                        <div class="star hidden">
                                                            <span class="full" data-value="0"></span>
                                                            <span class="half" data-value="0"></span>
                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="1"></span>
                                                            <span class="half" data-value="0.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="2"></span>
                                                            <span class="half" data-value="1.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="3"></span>
                                                            <span class="half" data-value="2.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="4"></span>
                                                            <span class="half" data-value="3.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="5"></span>
                                                            <span class="half" data-value="4.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="score score-rating js-score">
                                                            0 %
                                                            <!-- <span>/</span>
                                              <span class="total">5</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress  ms-auto col-6" style="overflow: visible;">
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


                                        </div>
                                    </div>
                                    <div class="col-lg-5 mt-3">
                                        <div class="bg-white shadow-lg p-3 h-100 px-5 text-center">
                                            <p class="text-uppercase fw-bold text-start">Time Management</p>
                                            <img src="{{URL::asset('public/after_login/images/innergraph1.png')}}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-lg-7  mt-3">
                                        <div class="bg-white shadow-lg p-3 h-100 px-5">
                                            <p class="text-uppercase fw-bold text-start">Average Time Spent on each Question</p>
                                            <img src="{{URL::asset('public/after_login/images/innergraph2.png')}}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 mt-3">
                                        <div class="bg-white shadow-lg p-3 h-100 px-5 text-center">
                                            <p class="text-uppercase fw-bold text-start">Marks Trend</p>
                                            <img src="{{URL::asset('public/after_login/images/innergraph1.png')}}" class="img-fluid">
                                            <div class="btn-block mt-5 d-flex justify-content-between">
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5">Day</button>
                                                <button class="btn btn-light-green text-uppercase rounded-0 px-5">Week</button>
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5">Month</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7  mt-3">
                                        <div class="bg-white shadow-lg p-3  px-5">
                                            <p class="text-uppercase fw-bold text-start">Acuracy Percentage</p>
                                            <img src="{{URL::asset('public/after_login/images/innergraph2.png')}}" class="img-fluid">
                                        </div>
                                        <div class="bg-white shadow-lg p-3 mt-3 px-5">
                                            <div class="d-flex">
                                                <button class="btn btn-outline-secondary rounded-0 w-50 me-4">Back to Dashboard</button>
                                                <button class="btn btn-outline-danger rounded-0 w-50 ms-4 ms-auto"><i class="fa fa-download"></i> &nbsp;Export Analytics</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class=" ">
                                            <div class="row">
                                                <div class="col-7 pe-0">
                                                    <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                                        <span class=" p-3"><img src="{{URL::asset('public/after_login/images/left-graph.jpg')}}"></span>
                                                        <span class="mt-auto me-0 bg-light p-3 d-flex  justify-content-center flex-column graph-bottom-block">
                                                            <span class="abri"> <span class="abrv-mean bg1"></span>Last Mock Test Score</span>
                                                            <span class="abri"> <span class="abrv-mean bg2"></span>Progress from previous score</span>
                                                            <span class="abri"> <span class="abrv-mean bg3"></span>Next Mock Test Target</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-5 ">
                                                    <div class="row position-relative">
                                                        <div class="col-6 mb-3">
                                                            <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                                                <a class="box-block arrow-right-btm" data-bs-toggle="collapse" href="#arrow-right-btm">
                                                                    <span>A</span>
                                                                    <span>89%</span>
                                                                </a>
                                                            </div>
                                                            <div class="collapse arrow-right-btm-content p-4" data-bs-dismiss="collapse" id="arrow-right-btm">
                                                                <h4 class="text-danger text-uppercase fw-2 fw-bold">Evaluation</h4>
                                                                <h4 class="text-danger text-uppercase fw-2">54%</h4>
                                                                <p class="arrow-box-content">Evaluation measures the Lorems and Ipsum for your performance in the test.</p>
                                                                <p class="arrow-box-content">Ideal Application score should be in the range 85%</p>
                                                                <a class="inner-arrow-right-btm" data-bs-toggle="collapse" href="#arrow-right-btm"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-6  mb-3">
                                                            <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                                                <a data-bs-toggle="collapse" href="#arrow-left-btm" class="box-block arrow-left-btm">
                                                                    <span>A</span>
                                                                    <span>89%</span>
                                                                </a>
                                                            </div>
                                                            <div class="collapse arrow-right-btm-content p-4" data-bs-dismiss="collapse" id="arrow-left-btm">
                                                                <h4 class="text-danger text-uppercase fw-2 fw-bold">Evaluation</h4>
                                                                <h4 class="text-danger text-uppercase fw-2">54%</h4>
                                                                <p class="arrow-box-content">Evaluation measures the Lorems and Ipsum for your performance in the test.</p>
                                                                <p class="arrow-box-content">Ideal Application score should be in the range 85%</p>
                                                                <a class="inner-arrow-left-btm" data-bs-toggle="collapse" href="#arrow-left-btm"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                                                <a data-bs-toggle="collapse" href="#arrow-right-top" class="box-block arrow-right-top">
                                                                    <span>A</span>
                                                                    <span>89%</span>
                                                                </a>
                                                            </div>
                                                            <div class="collapse arrow-right-btm-content p-4" data-bs-dismiss="collapse" id="arrow-right-top">
                                                                <h4 class="text-danger text-uppercase fw-2 fw-bold">Evaluation</h4>
                                                                <h4 class="text-danger text-uppercase fw-2">54%</h4>
                                                                <p class="arrow-box-content">Evaluation measures the Lorems and Ipsum for your performance in the test.</p>
                                                                <p class="arrow-box-content">Ideal Application score should be in the range 85%</p>
                                                                <a class="inner-arrow-right-top" data-bs-toggle="collapse" href="#arrow-right-top"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="bg-white shadow-lg d-flex justify-content-center flex-column h-100 ">
                                                                <a data-bs-toggle="collapse" href="#arrow-left-top" class="box-block arrow-left-top">
                                                                    <span>A</span>
                                                                    <span>89%</span>
                                                                </a>
                                                            </div>
                                                            <div class="collapse arrow-right-btm-content p-4" data-bs-dismiss="collapse" id="arrow-left-top">
                                                                <h4 class="text-danger text-uppercase fw-2 fw-bold">Evaluation</h4>
                                                                <h4 class="text-danger text-uppercase fw-2">54%</h4>
                                                                <p class="arrow-box-content">Evaluation measures the Lorems and Ipsum for your performance in the test.</p>
                                                                <p class="arrow-box-content">Ideal Application score should be in the range 85%</p>
                                                                <a class="inner-arrow-left-top" data-bs-toggle="collapse" href="#arrow-left-top"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="bg-white shadow-lg p-3">
                                            <h5 class="dashboard-title mb-3">Subject proficiency</h5>
                                            <div class="d-flex align-items-center mt-3 pb-1">
                                                <div class="d-flex align-items-center   py-2 dashboard-listing-details w-100 ">
                                                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                                                    <div class="status-id   d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                                                        <div class="star hidden">
                                                            <span class="full" data-value="0"></span>
                                                            <span class="half" data-value="0"></span>
                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="1"></span>
                                                            <span class="half" data-value="0.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="2"></span>
                                                            <span class="half" data-value="1.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="3"></span>
                                                            <span class="half" data-value="2.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="4"></span>
                                                            <span class="half" data-value="3.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="5"></span>
                                                            <span class="half" data-value="4.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="score score-rating js-score">
                                                            0 %
                                                            <!-- <span>/</span>
                                              <span class="total">5</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress  ms-auto col-6" style="overflow: visible;">
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
                                            <div class="d-flex align-items-center mt-3 pb-1">
                                                <div class="d-flex align-items-center   py-2 dashboard-listing-details w-100 ">
                                                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                                                    <div class="status-id   d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                                                        <div class="star hidden">
                                                            <span class="full" data-value="0"></span>
                                                            <span class="half" data-value="0"></span>
                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="1"></span>
                                                            <span class="half" data-value="0.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="2"></span>
                                                            <span class="half" data-value="1.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="3"></span>
                                                            <span class="half" data-value="2.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="4"></span>
                                                            <span class="half" data-value="3.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="5"></span>
                                                            <span class="half" data-value="4.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="score score-rating js-score">
                                                            0 %
                                                            <!-- <span>/</span>
                                              <span class="total">5</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress  ms-auto col-6" style="overflow: visible;">
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
                                            <div class="d-flex align-items-center mt-3 pb-1">
                                                <div class="d-flex align-items-center   py-2 dashboard-listing-details w-100 ">
                                                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                                                    <div class="status-id   d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                                                        <div class="star hidden">
                                                            <span class="full" data-value="0"></span>
                                                            <span class="half" data-value="0"></span>
                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="1"></span>
                                                            <span class="half" data-value="0.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="2"></span>
                                                            <span class="half" data-value="1.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="3"></span>
                                                            <span class="half" data-value="2.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="4"></span>
                                                            <span class="half" data-value="3.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="star">

                                                            <span class="full" data-value="5"></span>
                                                            <span class="half" data-value="4.5"></span>
                                                            <span class="selected"></span>

                                                        </div>

                                                        <div class="score score-rating js-score">
                                                            0 %
                                                            <!-- <span>/</span>
                                              <span class="total">5</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress  ms-auto col-6" style="overflow: visible;">
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


                                        </div>
                                    </div>
                                    <div class="col-lg-5 mt-3">
                                        <div class="bg-white shadow-lg p-3 h-100 px-5 text-center">
                                            <p class="text-uppercase fw-bold text-start">Time Management</p>
                                            <img src="{{URL::asset('public/after_login/images/innergraph1.png')}}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-lg-7  mt-3">
                                        <div class="bg-white shadow-lg p-3 h-100 px-5">
                                            <p class="text-uppercase fw-bold text-start">Average Time Spent on each Question</p>
                                            <img src="{{URL::asset('public/after_login/images/innergraph2.png')}}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 mt-3">
                                        <div class="bg-white shadow-lg p-3 h-100 px-5 text-center">
                                            <p class="text-uppercase fw-bold text-start">Marks Trend</p>
                                            <img src="{{URL::asset('public/after_login/images/innergraph1.png')}}" class="img-fluid">
                                            <div class="btn-block mt-5 d-flex justify-content-between">
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5">Day</button>
                                                <button class="btn btn-light-green text-uppercase rounded-0 px-5">Week</button>
                                                <button class="btn btn-outline-secondary text-uppercase rounded-0 px-5">Month</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7  mt-3">
                                        <div class="bg-white shadow-lg p-3  px-5">
                                            <p class="text-uppercase fw-bold text-start">Acuracy Percentage</p>
                                            <img src="{{URL::asset('public/after_login/images/innergraph2.png')}}" class="img-fluid">
                                        </div>
                                        <div class="bg-white shadow-lg p-3 mt-3 px-5">
                                            <div class="d-flex">
                                                <button class="btn btn-outline-secondary rounded-0 w-50 me-4">Back to Dashboard</button>
                                                <button class="btn btn-outline-danger rounded-0 w-50 ms-4 ms-auto"><i class="fa fa-download"></i> &nbsp;Export Analytics</button>
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
    </div>
</div>




@include('afterlogin.layouts.footer')
<script type="text/javascript">
    $('.scroll-div-live-exm').slimscroll({
        height: '60vh'
    });
</script>

@endsection