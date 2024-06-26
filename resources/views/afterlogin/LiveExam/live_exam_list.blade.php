@extends('afterlogin.layouts.app_new')
@section('content')
@php
$userData = Session::get('user_data');
@endphp

<?php $redis_data = Session::get('redis_data'); ?>
<!-- mixpanel start -->
<script type="text/javascript">
(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

// Enabling the debug mode flag is useful during implementation,
// but it's recommended you remove it for production
var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
mixpanel.init(mixpanelid);
mixpanel.track('Loaded Live Exam Listing',{
        "$city" : '<?php echo $userData->city; ?>',
        }

);
</script>
<!-- mixpanel end -->


<div class="spinnerblock">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="main-wrapper exam-wrapperBg">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <section class="content-wrapper MockTestMob LiveExamMob LiveExamMob22">
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
                                $today_top = date('Y-m-d');
                                $now = new DateTime($today_top);

                                $start_date_top = $schedule_list[0]->start_date;
                                list( $day,$month, $year) =explode("-",$start_date_top);
                                $year=date('Y');
                                $updateStart_date=$year.'-'.$month.'-'.$day;
                                $startDate=new DateTime($updateStart_date);


                                $end_date_top =$schedule_list[0]->end_date;
                                list( $day,$month, $year) =explode("-",$end_date_top);
                                $year=date('Y');
                                $updateEnd_date=$year.'-'.$month.'-'.$day;
                                $endDate=new DateTime($updateEnd_date);

                                $testCompleted_yn=$schedule_list[0]->test_completed_yn;
                                $sched_id=$schedule_list[0]->schedule_id;

                                @endphp
                                @if($testCompleted_yn=="N" )
                                <div class="jee_main_text_take_test__btn">
                                    <div class="mock_exam_jee_main_text d-flex align-items-center">
                                        <div class="live_exam_red_dot me-3"></div>
                                        <h3>{{$schedule_list[0]->exam_name}}</h3>
                                    </div>
                                    @if(($startDate <= $now && $now <=$endDate)) <a class="btn btn-common-green mock_test_take_test_btn mobile_hide tab_hide" href="{{route('live_exam',[$sched_id,'instruction'])}}">Take Test
                                        </a>
                                        @endif
                                </div>
                                <div class="line_696"></div>
                                <div class="mock_test_ques_dure_marks_sub d-flex nojusify">
                                    <div class="mock_test_ques_content">
                                        <div class="mock_test_qdms_text1">No. of Questions</div>
                                        <div class="mock_test_qdms_text2"><span>{{$schedule_list[0]->questions_count}}</span> Questions</div>
                                    </div>
                                    @php
                                    list( $day,$month, $year) =explode("-",$start_date_top);
                                    $year=date("Y");
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
                                    $year=date("Y");
                                    $update_date=$day.'-'.$month.'-'.$year;
                                    $newDate = date("d M Y", strtotime($update_date));
                                    $end_date_new = date('jS F Y', strtotime($newDate));
                                    @endphp
                                    <div class="mock_test_sub_content">

                                        <div class="mock_test_qdms_text1">End Date</div>
                                        <div class="mock_test_qdms_text2">{{$end_date_new}}</div>
                                    </div>
                                </div>
                                @if(($startDate <= $now && $now <=$endDate)) <a type="button" class="btn btn-common-green mock_test_take_test_btn mock_test_take_test_btn_for_mob mobile_block" id="take_test_mobile" href="{{route('live_exam',[$sched_id,'instruction'])}}">Take Test</a>
                                    @endif

                                    @endif
                                    @endif
                                    <div>
                                        @if(!empty($schedule_list))
                                        <div class="live_exam_upcoming_text">Upcoming Live Exams</div>
                                        @endif
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
                                                $year=date("Y");
                                                $update_date=$day.'-'.$month.'-'.$year;
                                                $newDate = date("d M Y", strtotime($update_date));
                                                $start_date_new = date('jS F Y', strtotime($newDate));
                                                @endphp
                                                <div class="col live_exam_jee_main_date_st_ed_ques">Start Date: <span>{{$start_date_new}}</span></div>
                                                @php
                                                list( $day,$month, $year) =explode("-",$end_date_up);
                                                $year=date("Y");
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
                                        $year=date("Y");
                                        $update_date=$day.'-'.$month.'-'.$year;
                                        $newDate = date("d M Y", strtotime($update_date));
                                        $start_date_new = date('jS F Y', strtotime($newDate));
                                        list( $day,$month, $year) =explode("-",$end_date_up);
                                        $year=date("Y");
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
                                            <span class="sub-details">No upcoming live exam available</span>
                                        </div>
                                        @endif
                                        @else
                                        <div class="text-center">
                                            <span class="sub-details">No live exam available right now</span>
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
    $('.spinnerblock').hide();
    $('#attempted').click(function() {

        
        /*mixpanel start*/
        var user_id = '<?php echo $userData->id; ?>';
        mixpanel.identify(user_id);
        mixpanel.people.set({
        "$city" :'<?php echo $userData->city; ?>',
        "$name" :'<?php echo $userData->user_name; ?>',
        "State" :'<?php echo $userData->state; ?>',
        "$email" : '<?php echo $userData->email; ?>',
        "Email Verified" : '<?php echo $userData->email_verified; ?>',
        "test type" : "Live",
        });

        mixpanel.track("Live Exam Attempted",{
        "$city" :'<?php echo $userData->city; ?>',
        "$name" :'<?php echo $userData->user_name; ?>',
        "State" :'<?php echo $userData->state; ?>',
        "$email" : '<?php echo $userData->email; ?>',
        "Email Verified" : '<?php echo $userData->email_verified; ?>',
        "test type" : "Live",
        });
        /*mixpanel event end*/


        $("#attempted_tab").show();
        $('.spinnerblock').show();
        url = "{{ url('ajax_exam_result_list') }}/Live";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            beforeSend: function() {

            },
            success: function(data) {
                $('.spinnerblock').hide();
                $('#attempted_tab').html(data.html);
                $('#testTypeDiv').attr("style", "display: none !important");
                $('#mock_test').hide();
            },
            error: function(data, errorThrown) {
                $('.spinnerblock').hide();
            }
        });
    });
    $('#live_exam').click(function() {
        $('.spinnerblock').show();
        $("#attempted_tab").hide();
        $('#mock_test').show();
        setTimeout(function() {
            $('.spinnerblock').hide();
        }, 1000);
    });
    $('#take_test').click(function() {

/*mixpanel start*/
var user_id = '<?php echo $userData->id; ?>';
mixpanel.identify(user_id);
mixpanel.people.set({
    "$city" :'<?php echo $userData->city; ?>',
    "$name" :'<?php echo $userData->user_name; ?>',
    "State" :'<?php echo $userData->state; ?>',
    "test type" : "Live",
});

mixpanel.track("Live Exam Click Take Live exam",{
    "$city" :'<?php echo $userData->city; ?>',
    "$name" :'<?php echo $userData->user_name; ?>',
    "State" :'<?php echo $userData->state; ?>',
    "test type" : "Live",
});
/*mixpanel end*/
});
</script>
@include('afterlogin.layouts.footer_new')
@endsection