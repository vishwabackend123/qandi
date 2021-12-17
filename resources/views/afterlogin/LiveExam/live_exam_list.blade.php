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
        <div class="container-fluid list-series">
            <div class="row">
                <div class="col-lg-12  p-lg-5">

                    <div class="tab-wrapper live-exam">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-circle text-danger me-3" aria-hidden="true"></i> LIVE EXAM</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="over-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="true"><i class="fa fa-circle text-danger me-3" aria-hidden="true"></i> LIVE EXAM RESULTS</a>
                                </li>


                            </ul>
                        </div>
                        <div class="tab-content cust-tab-content  bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                                <h4 class="py-3">Upcoming Live Exams</h4>
                                <div class="scroll-div-live-exm">
                                    @if(!empty($schedule_list))

                                    @foreach($schedule_list as $sche)
                                    @php
                                    $today = date("d-m-y", time());
                                    $start_date = $sche->start_date;
                                    $end_date =$sche->end_date;
                                    $test_completed_yn =$sche->test_completed_yn;
                                    @endphp
                                    @if($test_completed_yn == "N")
                                    <ul class="speci-text">
                                        <li> <span class="sub-details">{{$sche->subject_name}}({{$sche->exam_name}})</span>
                                        </li>
                                        <li><strong>Start Date: {{$start_date}}</strong>
                                        </li>
                                        <li><strong>End Date: {{$end_date}}</strong>
                                        </li>

                                        <li>{{$sche->questions_count}} Questions</a>
                                        </li>
                                        <li>
                                            @if($start_date<=$today && $end_date>=$today) <a href="{{route('live_exam',$sche->schedule_id)}}"> <button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Attempt
                                                        Exam</button></a>
                                                @endif
                                        </li>
                                    </ul>
                                    @else
                                    <ul class="speci-text">
                                        <li> <span class="sub-details">{{$sche->subject_name}}({{$sche->exam_name}})</span>
                                        </li>
                                        <li><strong>Start Date: {{$start_date}}</strong>
                                        </li>
                                        <li><strong>End Date: {{$end_date}}</strong>
                                        </li>

                                        <li>{{$sche->questions_count}} Questions</a>
                                        </li>
                                        <li><button disabled class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Attempted
                                            </button>

                                        </li>
                                    </ul>
                                    @endif

                                    @endforeach

                                    @else
                                    <div class="text-center">
                                        <span class="sub-details">No live exam available right now.</span>


                                    </div>
                                    @endif
                                </div>
                                <!-- <div class="active-bg-gray">
                                    <ul class="speci-text">
                                        <li> <span class="sub-details">UniQ Advance Level Exam - Series 4</span>
                                        </li>
                                        <li><strong>20-21 NOV 2021</strong>
                                        </li>
                                        <li>
                                            <p>Opens in next 5 days</p>
                                        </li>
                                        <li><a href="#" class="">
                                                <span class="show-detail">Show Details</span>
                                                <span class="hide-detail">Hide Detailwws</span>
                                            </a>
                                        </li>
                                        <li><button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Register</button>

                                        </li>
                                    </ul>
                                    <div class="details-exam">
                                        <ul>
                                            <li>
                                                <span>Details about the exam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. </span>
                                                <p>Time Slots: 9 am - 12 pm ; 12:30 pm - 3:30 pm </p>
                                            </li>
                                            <li>
                                                <p>No Of Questions</p>
                                                <p><strong>90 MCQ</strong> Questions</p>
                                            </li>
                                            <li>
                                                <p>Duration</p>
                                                <p><strong>180 </strong> minutes</p>
                                            </li>
                                            <li>
                                                <p>Marks</p>
                                                <p><strong>300</strong> Marks</p>
                                            </li>
                                            <li>
                                                <p>Subjects</p>
                                                <p><strong>Physics,Chemistry,&amp; Mathematics</strong></p>
                                            </li>

                                        </ul>
                                    </div>
                                </div> -->
                            </div>

                            <div class="tab-pane fade show" id="completed" role="tabpanel" aria-labelledby="over-tab">
                                <h4 class="py-3">Live Exams Results</h4>
                                <div class="scroll-div-live-exm">
                                    @if(!empty($completed_list))

                                    @foreach($completed_list as $sche)
                                    @php
                                    $today = date("d-m-y", time());
                                    $start_date = $sche->start_date;
                                    $end_date =$sche->end_date;
                                    @endphp
                                    <ul class="speci-text">
                                        <li> <span class="sub-details">{{$sche->subject_name}}({{$sche->exam_name}})</span>
                                        </li>
                                        <li><strong>Start Date: {{$start_date}}</strong>
                                        </li>
                                        <li><strong>End Date: {{$end_date}}</strong>
                                        </li>

                                        <li>{{$sche->questions_count}} Questions</a>
                                        </li>
                                        <li><a href="{{route('live_exam_result',$sche->result_id)}}">
                                                <button class="custom-btn-gray"></i>Exam Result
                                                </button>
                                            </a>

                                        </li>
                                    </ul>

                                    @endforeach

                                    @else
                                    <div class="text-center">
                                        <span class="sub-details">No live exam Result is available.</span>


                                    </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('afterlogin.layouts.footer_new')

<script type="text/javascript">
    $('.scroll-div-live-exm').slimscroll({
        height: '60vh'
    });
</script>
@endsection