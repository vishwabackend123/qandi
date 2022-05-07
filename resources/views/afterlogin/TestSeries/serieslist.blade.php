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

    <div class="content-wrapper">
        <div class="container-fluid list-series practice-series-lists">
            <div class="row">
                <div class="col-lg-12  p-lg-5">

                    <div class="tab-wrapper live-exam">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="open-tab" data-bs-toggle="tab" href="#open" role="tab" aria-controls="home" aria-selected="true">Test series</a>
                                </li>
								
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="live-tab" data-bs-toggle="tab" href="#live" role="tab" aria-controls="home" aria-selected="true">Attempted</a>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-content cust-tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">

                                <div class="d-flex  p-4 mb-4">
                                    <a class="btn sectionBtn btn-primary me-2">OPEN TEST SERIES</a>
                                    <a class="btn sectionBtn btn-outline-primary">LIVE TEST SERIES</a>
                                </div>

                                @if(!empty($open_series))
                                <div class="scroll-div-live-exm p-4 listing-details pb-0 mb-3 pt-0">
                                    @foreach($open_series as $open)
                                    <ul class="speci-text">
                                        <li class="a1TS"> <span class="sub-details">{{$open->test_series_name}}</span>
                                        </li>
                                        <li class="a2TS"><strong>{{$open->questions_count}} Questions</strong>
                                        </li>
                                        <li class="a3TS"><strong>{{$open->time_allowed}} min</strong>
                                        </li>
                                        <li class="a4TS">
                                            <form class="form-horizontal ms-auto " action="{{route('test_series')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="series_name" value="{{$open->test_series_name}}" />
                                                <input type="hidden" name="series_id" value="{{$open->test_series_id}}" />
                                                <input type="hidden" name="series_type" value="{{$open->series_type}}" />
                                                <input type="hidden" name="time_allowed" value="{{$open->time_allowed}}" />
                                                <input type="hidden" name="questions_count" value="{{$open->questions_count}}" />
                                                <input type="hidden" name="exam_mode" value="Live" />
                                                <button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> TAKE TEST</button>
                                            </form>

                                        </li>
                                    </ul>

                                    @endforeach

                                </div>
                                @else
                                <div class="row text-center p-4">
                                    <h5>No series available.</h5>
                                </div>
                                @endif
                            </div>

                            <div class="tab-pane fade show " id="live" role="tabpanel" aria-labelledby="live-tab">

                                <div class="d-flex  p-4 mb-4">
                                    <a class="btn sectionBtn btn-primary me-2">ALL TEST SERIES</a>
                                    <a class="btn sectionBtn btn-outline-primary me-2">OPEN TEST SERIES</a>
                                    <a class="btn sectionBtn btn-outline-primary">LIVE TEST SERIES</a>
                                </div>

                                <div class="scroll-div mt-4">
                                    <div class="compLeteS">
                                        <div class="ClickBack d-flex align-items-center justify-content-between bg-white   listing-details w-100 flex-wrap result-list-table">
                                            <div class="d-flex align-items-start justify-content-between result-list-head">
                                                <h4 class="m-lg-0 p-0">                                                  Series B
                                                  
                                                </h4>
                                                <p class="m-0 p-0">06 May 2022</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center morning-slot">
                                                <span class="slbs-link me-5">
                                                    <a class="expand-custom expandTopicCollapse" aria-controls="chapter_561" data-bs-toggle="collapse" href="#chapter_561" role="button" aria-expanded="true" value="Expand to Topics" id="clicktopic_561"><span id="expand_topic_561"><i class="fa fa-arrow-down me-1"></i> Show Details</span></a>
                                                </span>
                                                <a href="http://app.thomsondigital2021.com/get_exam_result_analytics/561" class="btn result-analysis"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp;View Analytics</a>
                                            </div>
                                            <div class="result-list-btns">
                                                <a href="http://app.thomsondigital2021.com/exam_review/561/attempted" class="btn result-review w-100">Review Exam</a>
                                            </div>
                                        </div>
                                        <div class="collapse" id="chapter_561">
                                            <div class="p-3 pb-4 d-flex justify-content-between full-syllabus">
                                                <div class="score-show text-center">
                                                    <p class="p-0 mb-3">Score:<span>-1</span>/20</p>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center paper-summery ps-lg-5 ps-2 pe-2">
                                                    <div class="paper-sub">
                                                        <small>No of Question</small>
                                                        <span>5 MCQ</span>
                                                    </div>
                                                    <div class="paper-sub">
                                                        <small>Duration</small>
                                                        <span>10</span> Minutes
                                                    </div>
                                                    <div class="paper-sub">
                                                        <small>Marks</small>
                                                        <span>20</span>
                                                    </div>
                                                    <div class="paper-sub">
                                                        <small>Subjects</small>
                                                        <span>Physics</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- @if(!empty($live_series))
                                <div class="scroll-div-live-exm p-4 listing-details pb-0 mb-3 pt-0">
                                    @foreach($live_series as $live)
                                    <ul class="speci-text">
                                        <li class="a1TS"> <span class="sub-details">{{$live->test_series_name}}</span>
                                        </li>
                                        <li class="a2TS"><strong>{{$live->questions_count}} Questions</strong>
                                        </li>
                                        <li class="a3TS"><strong>{{$live->time_allowed}} min</strong>
                                        </li>
                                        <li class="a4TS">
                                            <form class="form-horizontal ms-auto " action="{{route('test_series')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="series_name" value="{{$live->test_series_name}}" />
                                                <input type="hidden" name="series_id" value="{{$live->test_series_id}}" />
                                                <input type="hidden" name="series_type" value="{{$live->series_type}}" />
                                                <input type="hidden" name="time_allowed" value="{{$live->time_allowed}}" />
                                                <input type="hidden" name="questions_count" value="{{$live->questions_count}}" />
                                                <input type="hidden" name="exam_mode" value="Live" />
                                                @if($live->test_completed_yn === 'N')
                                                <button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Start</button>
                                                @else
                                                <button class="custom-btn-gray" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Start</button>
                                                @endif
                                            </form>

                                        </li>
                                    </ul>
                                    @endforeach
                                </div>
                                @else
                                <div class="row text-center p-4">
                                    <h5>No series avialable.</h5>
                                </div>
                                @endif -->

                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .result-list-table {
    background: #f6f9fd;
    border-radius: 15px;
}

.result-list-table .result-list-head {
    flex: 2;
}

.result-list-head h4 {
    color: #231f20;
    font-size: 16px;
    font-weight: 600;
    flex: 1;
}

.result-list-head p {
    color: #231f20;
    font-size: 15px;
    font-weight: 600;
}

.morning-slot {
    flex: 2;
}

.morning-slot p {
    color: #231f20;
    font-size: 14px;
    font-weight: 600;
}

.result-list-btns {
    flex: 1;
}

.result-list-btns a {
    line-height: 37px;
    height: 48px;
    text-align: center;
    display: block;
    background: #f4f4f4;
    border-radius: 10px;
}

.result-list-btns a .fa {
    font-size: 17px;
    line-height: 48px;
}

.result-review {
    height: 48px;
    background: #f4f4f4;
    border-radius: 10px;
    color: #515151 !important;
    font-size: 16px;
    width: 75%;
}

.score-show {
    flex: 3;
    border-right: 1px solid #b9b9b9;
}

.score-show p {
    color: #231f20;
    font-size: 16px;
    font-weight: 600;
}

.score-show p span {
    color: #00baff;
}

.result-analysis {
    background: #13c5ff;
    background-color: #13c5ff;
    border-color: #13c5ff;
    -webkit-box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    -moz-box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    font-size: 14px;
    font-weight: 600;
    line-height: 32px;
    border-radius: 20px;
    height: 45px;
    width: 208px;
    border: 0;
}

.paper-summery {
    flex: 5;
}

.paper-sub {
    font-size: 13px;
    flex: 1;
    word-break: break-all;
}

.paper-sub span {
    color: #00baff;
    font-size: 14px;
    font-weight: 600;
}

.paper-sub small {
    display: block;
    color: #231f20;
    font-size: 13px;
    font-weight: 600;
}

.result-list-table .slbs-link a {
    font-size: 14px;
    font-weight: 600;
}

@media only screen and (max-width: 1199px) {
    .result-list-head h4 {
        font-size: 14px;
    }

    .result-list-head p {
        font-size: 14px;
        flex: 1;
    }
}

@media only screen and (max-width: 991px) {
    .result-list .d-flex.justify-content-between {
        display: flex !important;
    }

    .result-review {
        font-size: 13px;
    }

    .paper-sub small {
        font-size: 12px;
    }

    .paper-sub span {
        font-size: 13px;
    }
}

</style>

<script>
    $(window).on('load', function() {
        $(".dash-nav-link a:first-child").removeClass("active-navlink");
        $(".dash-nav-link a:nth-child(2)").addClass("active-navlink");
    });
</script>



@include('afterlogin.layouts.footer_new')


@endsection