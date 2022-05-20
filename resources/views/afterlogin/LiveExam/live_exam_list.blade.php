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
        <div class="container-fluid list-series live-exam-list-wrapper">
            <div class="row">
                <div class="col-lg-12  p-lg-5">
                    <div class="tab-wrapper live-exam ">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-circle text-danger me-2" aria-hidden="true"></i> Live Exam</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="over-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="true"> Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content cust-tab-content  bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                 @if(!empty($schedule_list))
                                  @php
                                        $today_top = date("d-m-y", time());
                                        $start_date_top = $schedule_list[0]->start_date;
                                        $end_date_top =$schedule_list[0]->end_date;
                                        @endphp
                                <div class="live-exam-test-wrapp">
                                    <div class="exam_card">
                                        <span class="mb-4 d-block"><i class="fa fa-circle text-danger me-2" aria-hidden="true"></i> LIVE EXAM</span>
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <h2 class="mt-0">{{$schedule_list[0]->exam_name}}</h2>
                                            @if($start_date_top<=$today_top && $end_date_top>=$today_top)
                                                <a class="custom-btn-gray btn" href="{{route('live_exam',$schedule_list[0]->schedule_id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> TAKE TEST</a>       
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="mb-2">
                                                <span class="d-block" style=" font-weight: normal;color: #2c3348;font-size: 14px;">No. Of Questions</span>
                                                <label style=" font-weight: 600;color: #231f20;">{{$schedule_list[0]->questions_count}} Questions</label>
                                            </div>
                                        
                                            <div class="mb-2">
                                                <span class="d-block" style=" font-weight: normal;color: #2c3348;font-size: 14px;">Start Date</span>
                                                <label style=" font-weight: 600;color: #231f20;">{{$start_date_top}}</label>
                                            </div>
                                            <div class="mb-2">
                                                <span class="d-block" style=" font-weight: normal;color: #2c3348;font-size: 14px;">End Date</span>
                                                <label style=" font-weight: 600;color: #231f20;">{{$end_date_top}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 @endif
                                <div class="Upcoming-Live-Exams-wrapp">
                                <h4 class="py-3 mb-4 mt-5" style="color: #2c3348;font-weight: 600;">Upcoming Live Exams</h4>
                                <div class="scroll-div-live-exm">
                                    @if(!empty($schedule_list))
                                    @php 
                                    $dataAvail = 0;
                                    @endphp
                                    @foreach($schedule_list as $key=>$sche)
                                    @php
                                    $today = date("d-m-y", time());
                                    $start_date = $sche->start_date;
                                    $end_date =$sche->end_date;
                                    $test_completed_yn =$sche->test_completed_yn;
                                    if($key<1)
                                    {
                                        continue;
                                    }
                                    $dataAvail=1;
                                    @endphp

                                    @if($test_completed_yn == "N")
                                    <ul class="speci-text">
                                        <li> <span class="sub-details">{{$sche->exam_name}}</span>
                                        </li>
                                        <li><strong>Start Date: {{$start_date}}</strong>
                                        </li>
                                        <li><strong>End Date: {{$end_date}}</strong>
                                        </li>
                                        <li style="font-weight:600;">{{$sche->questions_count}} Questions</a>
                                        </li>
                                        <!-- <li>
                                            @if($start_date<=$today && $end_date>=$today)
                                                <a href="{{route('live_exam',$sche->schedule_id)}}">
                                                    <button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Attempt Exam</button>
                                                </a>
                                                @endif
                                        </li> -->
                                    </ul>
                                    @else
                                    <ul class="speci-text">
                                        <li> <span class="sub-details">{{$sche->exam_name}}</span>
                                        </li>
                                        <li><strong>Start Date: {{$start_date}}</strong>
                                        </li>
                                        <li><strong>End Date: {{$end_date}}</strong>
                                        </li>
                                        <li style="font-weight:600;">{{$sche->questions_count}} Questions</a>
                                        </li>
                                        
                                    </ul>
                                    @endif
                                    @endforeach
                                    @if(empty($dataAvail))
                                    <div class="text-center">
                                        <span class="sub-details">No upcoming live exams available</span>
                                    </div>
                                    @endif
                                    @else
                                    <div class="text-center">
                                        <span class="sub-details">No live exam available right now.</span>
                                    </div>
                                    @endif
                                </div>
                                </div>

                               
                            </div>
                            <div class="tab-pane fade show" id="completed" role="tabpanel" aria-labelledby="over-tab">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loader-block" style="display:none;">
    <img src="{{URL::asset('public/after_login/new_ui/images/loader.gif')}}">
</div>
@include('afterlogin.layouts.footer_new')
<script type="text/javascript">
/*$('.scroll-div-live-exm').slimscroll({
        height: '60vh'
    });*/
$(window).on('load', function() {
    $(".dash-nav-link a:first-child").removeClass("active-navlink");
    $(".dash-nav-link a:nth-child(2)").addClass("active-navlink");
});
 $('#over-tab').click(function() {
        $('.loader-block').show();
        url = "{{ url('ajax_exam_result_list') }}/Live";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            beforeSend: function() {

            },
            success: function(data) {
                $('.loader-block').hide();
                $("#completed").show();
                $('#completed').html(data.html);
                $('#testTypeDiv').attr("style", "display: none !important");

            },
            error: function(data, errorThrown) {
                $('.loader-block').hide();
            }
        });
    });

</script>
@endsection
