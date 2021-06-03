@extends('afterlogin.layouts.app')

@section('content')

<div class="main-wrapper bg-gray">

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-4">
                    <button class="btn btn-danger rounded-0 px-5"><i class="fas fa-download"></i>Export Analytics</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="bg-white shadow-lg p-3 position-relative">
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <h5 class="dashboard-title mb-3 text-center">Total Score</h5>
                        <div class="text-center">
                            <img src="{{URL::asset('public/after_login/images/roundedgraph.jpg')}}">
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
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>

                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="dashboard-title mb-3 text-center">Marks %</h5>
                                <svg viewBox="0 0 36 36" class="circular-chart green">
                                    <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="circle" stroke-dasharray="60, 100" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <text x="18" y="22.35" class="percentage">30%</text>
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-column">
                                    <div class=""><img src="{{URL::asset('public/after_login/images/right-graph.jpg')}}"></div>
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
                    <div class="bg-white shadow p-3 d-flex flex-column position-relative">
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <h5 class="dashboard-title mb-3">Subject Score</h5>
                    </div>
                </div>
                <div class="col-7 ">
                    <div class="bg-white shadow position-relative"> <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <div class="tab-wrapper h-100">
                            <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
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

                                    tab 1
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
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h5 class="dashboard-title mb-3 text-center">Rank Analysis</h5>
                                <img src="{{URL::asset('public/after_login/images/bottom-left.jpg')}}" />
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
                    <div class="bg-white shadow p-5 d-flex flex-column position-relative">
                        <a href="#" class="i-icon"><i class="fas fa-info-circle"></i></a>
                        <span class="text-center w-100"><img src="{{URL::asset('public/after_login/images/bottom-right.jpg')}}" /></span>
                        <a href="{{route('exam_review')}}" class="btn-danger btn rounded-0 w-100 mt-3">Review Questions</a>
                        <a href="{{route('dashboard')}}" class="btn-outline-secondary btn rounded-0 w-100 mt-3">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('afterlogin.layouts.footer')



@endsection