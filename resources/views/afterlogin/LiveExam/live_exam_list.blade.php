@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper bg-gray h-100">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12  p-lg-2">

                    <div class="tab-wrapper mt-0">
                        <ul class="nav nav-tabs cust-tabs-white" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-circle text-danger me-3" aria-hidden="true"></i> LIVE EXAM</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="over-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="true"><i class="fa fa-circle text-danger me-3" aria-hidden="true"></i> LIVE EXAM RESULTS</a>
                            </li>

                        </ul>

                        <div class="tab-content cust-tab-content  bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="scroll-div-live-exm">
                                    @if(!empty($schedule_list))
                                    <div class=" h-100  bg-blue p-3">
                                        <div class="row">
                                            @foreach($schedule_list as $sche)
                                            @php
                                            $today = date("d-m-y", time());
                                            $start_date = $sche->start_date;
                                            $end_date =$sche->end_date;
                                            @endphp
                                            <div class="col-md-6 col-lg-4 mb-4 ">
                                                <div class="bg-white shadow-lg p-3 sub-topic-box h-100">
                                                    <div class="d-flex align-items-center pb-2 listing-details ">
                                                        <span class="mr-3 topics-name fw-bold">{{$sche->subject_name}}({{$sche->exam_name}})</span>

                                                    </div>

                                                    <div class=" d-flex py-2 listing-details w-100 ">
                                                        <p class="date-start-left mb-0 me-3">Start Date</br>{{$start_date}}</span>
                                                        <p class="date-end-right ms-auto mb-0 text-right">End Date</br>{{$end_date}}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center pt-2 flex-wrap">
                                                        <small>{{$sche->questions_count}} Questions </small>
                                                        @if($start_date<=$today && $end_date>=$today)
                                                            <a href="{{route('live_exam',$sche->schedule_id)}}" class="btn btn-danger px-5 rounded-0 ms-auto"> Start</a>
                                                            @endif
                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach

                                        </div>

                                    </div>
                                    @else
                                    <div class=" h-100  bg-blue p-3">
                                        <div class="row">
                                            <div class="d-flex align-items-center justify-content-center h-100 flex-column bg-blue">
                                                <!-- <p>Please wait for the Exam to start…</p> -->
                                                <p>No live exam available right now...</p>
                                            </div>
                                        </div>
                                    </div>

                                    @endif

                                </div>


                            </div>
                            <div class="tab-pane fade show" id="completed" role="tabpanel" aria-labelledby="over-tab">
                                <div class="scroll-div-live-exm">

                                    <div class=" h-100  bg-blue p-3">
                                        @if(!empty($completed_list))
                                        <div class="row">

                                            @foreach($completed_list as $sche)
                                            @php
                                            $today = date("d-m-y", time());
                                            $start_date = $sche->start_date;
                                            $end_date =$sche->end_date;
                                            @endphp
                                            <div class="col-md-6 col-lg-4 mb-4 ">
                                                <div class="bg-white shadow-lg p-3 sub-topic-box h-100">
                                                    <div class="d-flex align-items-center pb-2 listing-details ">
                                                        <span class="mr-3 topics-name fw-bold">{{$sche->subject_name}}({{$sche->exam_name}})</span>
                                                    </div>

                                                    <div class=" d-flex py-2 listing-details w-100 ">
                                                        <p class="date-start-left mb-0 me-3">Start Date</br>{{$start_date}}</span>
                                                        <p class="date-end-right ms-auto mb-0 text-right">End Date</br>{{$end_date}}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center pt-2 flex-wrap">
                                                        <small>{{$sche->questions_count}} Questions </small>

                                                        <a href="{{route('live_exam_result',$sche->result_id)}}" class="btn btn-danger px-5 rounded-0 ms-auto"> Result</a>

                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                        @else


                                        <div class="d-flex align-items-center justify-content-center h-100 flex-column bg-blue ">
                                            <p class="align-middle">No live exam results available right now...</p>
                                        </div>
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
</div>
</div>




@include('afterlogin.layouts.footer')

<script type="text/javascript">
    $('.scroll-div-live-exm').slimscroll({
        height: '70vh'
    });
</script>
@endsection