@extends('afterlogin.layouts.app_new')
@section('content')
<div class="main-wrapper">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <section class="content-wrapper MockTestMob LiveExamMob">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="commontab">
                        <div class="tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item pe-5 me-2">
                                    <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#mock_test" id="live_exam">Live Exam</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#attempted_tab" id="attempted">Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content bg-white exam_tabdata">
                            <div id="mock_test" class=" tab-pane active bg-white-bg_mob">
                                @if(!empty($schedule_list))
                                @php
                                $today_top = date('d-m-y');;
                                $start_date_top = $schedule_list[0]->start_date;
                                $end_date_top =$schedule_list[0]->end_date;
                                $testCompleted_yn=$schedule_list[0]->test_completed_yn;
                                $sched_id=$schedule_list[0]->schedule_id;
                                @endphp
                                @if($testCompleted_yn=="N" )
                                <div class="jee_main_text_take_test__btn">
                                    <div class="mock_exam_jee_main_text d-flex align-items-center">
                                        <div class="live_exam_red_dot me-3"></div>
                                        <h3>{{$schedule_list[0]->exam_name}}</h3>
                                    </div>
                                    @if(($today_top >= $start_date_top) && ($today_top <= $end_date_top)) <a class="btn btn-common-green mock_test_take_test_btn mobile_hide" href="{{route('live_exam',[$sched_id,'instruction'])}}">Take test
                                        </a>
                                        @endif
                                </div>
                                <div class="line_696"></div>
                                <div class="mock_test_ques_dure_marks_sub d-flex nojusify">
                                    <div class="mock_test_ques_content">
                                        <div class="mock_test_qdms_text1">No. Of Questions</div>
                                        <div class="mock_test_qdms_text2"><span>{{$schedule_list[0]->questions_count}}</span> Questions</div>
                                    </div>
                                    @php
                                    list( $day,$month, $year) =explode("-",$start_date_top);
                                    $year=2000+$year;
                                    $update_date=$day.'-'.$month.'-'.$year;
                                    $newDate = date("d M Y", strtotime($update_date));
                                    $start_date_new = date('jS F Y', strtotime($newDate));
                                    @endphp
                                    <div class="mock_test_dure_content">
                                        <div class="mock_test_qdms_text1">Start Date</div>
                                        <div class="mock_test_qdms_text2">{{$start_date_new}}</div>
                                    </div>
                                    @php
                                    list( $day,$month, $year) =explode("-",$end_date_top);
                                    $year=2000+$year;
                                    $update_date=$day.'-'.$month.'-'.$year;
                                    $newDate = date("d M Y", strtotime($update_date));
                                    $end_date_new = date('jS F Y', strtotime($newDate));
                                    @endphp
                                    <div class="mock_test_sub_content">
                                    
                                    <div class="mock_test_qdms_text1">End Date</div>
                                        <div class="mock_test_qdms_text2">{{$end_date_new}}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-common-green mock_test_take_test_btn mock_test_take_test_btn_for_mob mobile_block" id="take_test">Take test</button>
                                @endif
                                @endif
                                <div>
                                    <div class="live_exam_upcoming_text">Upcoming Live Exams</div>
                                    <div class="liveexamScroll liveexamScrollContant">
                                    @if(!empty($schedule_list))
                                    @php
                                    $dataAvail = 0;
                                    @endphp
                                    @foreach($schedule_list as $key=>$sche)
                                    @php
                                    $cDate = date('d-m-y');
                                    $start_date_up = $sche->start_date;
                                    $end_date_up =$sche->end_date;
                                    $test_completed_yn =$sche->test_completed_yn;
                                    if($key < 1) { continue; } $dataAvail=1; @endphp @if($test_completed_yn=="N" ) <div class="row mock_test_ques_dure_marks_sub">
                                        <div class="col live_exam_jee_main_ttext">{{$sche->exam_name}}</div>
                                        @php
                                        list( $day,$month, $year) =explode("-",$start_date_up);
                                        $year=2000+$year;
                                        $update_date=$day.'-'.$month.'-'.$year;
                                        $newDate = date("d M Y", strtotime($update_date));
                                        $start_date_new = date('jS F Y', strtotime($newDate));
                                        @endphp
                                        <div class="col live_exam_jee_main_date_st_ed_ques">Start Date: <span>{{$start_date_new}}</span></div>
                                        @php
                                        list( $day,$month, $year) =explode("-",$end_date_up);
                                        $year=2000+$year;
                                        $update_date=$day.'-'.$month.'-'.$year;
                                        $newDate = date("d M Y", strtotime($update_date));
                                        $end_date_new = date('jS F Y', strtotime($newDate));
                                        @endphp
                                        <div class="col live_exam_jee_main_date_st_ed_ques">End Date: <span>{{$end_date_new}}</span></div>
                                        <div class="col live_exam_jee_main_date_st_ed_ques"><span>{{$sche->questions_count}}</span> Questions</div>
                                </div>
                                <div class="line_715 mock_test_ques_dure_marks_sub"></div>
                                @else
                                @php
                                list( $day,$month, $year) =explode("-",$start_date_up);
                                $year=2000+$year;
                                $update_date=$day.'-'.$month.'-'.$year;
                                $newDate = date("d M Y", strtotime($update_date));
                                $start_date_new = date('jS F Y', strtotime($newDate));
                                list( $day,$month, $year) =explode("-",$end_date_up);
                                $year=2000+$year;
                                $update_date=$day.'-'.$month.'-'.$year;
                                $newDate = date("d M Y", strtotime($update_date));
                                $end_date_new = date('jS F Y', strtotime($newDate));
                                @endphp
                                <div class="row mock_test_ques_dure_marks_sub">
                                    <div class="col live_exam_jee_main_ttext">{{$sche->exam_name}}</div>
                                    <div class="col live_exam_jee_main_date_st_ed_ques">Start Date: <span>{{$start_date_new}}</span></div>
                                    <div class="col live_exam_jee_main_date_st_ed_ques">End Date: <span>{{$end_date_new}}</span></div>
                                    <div class="col live_exam_jee_main_date_st_ed_ques"><span>{{$sche->questions_count}}</span> Questions</div>
                                </div>
                                <div class="line_715 mock_test_ques_dure_marks_sub"></div>
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
                        <div id="attempted_tab" class=" tab-pane mock_attempetd_head_wraper">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script type="text/javascript">
    $('#attempted').click(function() {
        $("#attempted_tab").show();
        url = "{{ url('ajax_exam_result_list') }}/Live";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            beforeSend: function() {

            },
            success: function(data) {
                
                $('#attempted_tab').html(data.html);
                $('#testTypeDiv').attr("style", "display: none !important");
                $('#mock_test').hide();
            },
            error: function(data, errorThrown) {}
        });
    });
    $('#live_exam').click(function() {
        $("#attempted_tab").hide();
        $('#mock_test').show();
    });
</script>
@include('afterlogin.layouts.footer_new')
@endsection