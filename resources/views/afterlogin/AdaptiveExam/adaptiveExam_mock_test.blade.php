@extends('afterlogin.layouts.app_new')
@section('content')
@php
$userData = Session::get('user_data');
@endphp
<?php $redis_data = Session::get('redis_data'); ?>


<div class="spinnerblock">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<body class="bg-content">
    <div class="main-wrapper exam-wrapperBg">
        @include('afterlogin.layouts.navbar_header_new')
        @include('afterlogin.layouts.sidebar_new')
        <section class="content-wrapper MockTestMob TestseriesAttempt22Score">
            <div class="container-fluid">
                <div class="row">
                    @if(count($errors) > 0 )
                    <div class="toastdata active">
                        <div class="toast-content">
                            <i class="fa fa-exclamation-triangle check" aria-hidden="true"></i>
                            <div class="message">
                                @foreach($errors->all() as $error)
                                <span class="text text-2">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>
                        <i class="fa fa-times close" aria-hidden="true"></i>
                        <div class="progress active"></div>
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="commontab">
                            <div class="tablist">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item pe-5 me-2">
                                        <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#mock_test1" id="mcoktest">Mock Exam</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#attempted2" id="attempted">Attempted</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content bg-white exam_tabdata ">
                                <div id="mock_test" class=" tab-pane active bg-white-bg_mob">
                                    <div class="jee_main_text_take_test__btn">
                                        <div class="mock_exam_jee_main_text">
                                            <h3>{{isset($exam_name)?$exam_name:''}}</h3>
                                        </div>
                                        <button type="button" class="btn btn-common-green mock_test_take_test_btn mobile_hide tab_hide" id="take_test">Take Test</button>
                                    </div>
                                    <div class="line_696"></div>
                                    <div class="attemptedscroll">
                                        <div class="mock_test_ques_dure_marks_sub d-flex">
                                            <div class="mock_test_ques_content">
                                                <div class="mock_test_q_d_m_s_text1">No. of Questions</div>
                                                <div class="mock_test_qdms_text2">{{$questions_count}} Questions</div>
                                            </div>
                                            <div class="live_exam_diveder_div"></div>
                                            <div class="mock_test_dure_content">
                                                <div class="mock_test_q_d_m_s_text1">Duration</div>
                                                <div class="mock_test_qdms_text2"><span>{{$exam_fulltime}}</span> <span>Mins</span></div>
                                            </div>
                                            <div class="live_exam_diveder_div"></div>
                                            <div class="mock_test_marks_content">
                                                <div class="mock_test_q_d_m_s_text1">Marks</div>
                                                <div class="mock_test_qdms_text2">{{$total_marks}}</div>
                                            </div>
                                            <div class="live_exam_diveder_div"></div>
                                            <div class="mock_test_sub_content">
                                                <div class="mock_test_q_d_m_s_text1">Subjects</div>
                                                <div class="mock_test_qdms_text2">{{$tagrets}}</div>
                                            </div>
                                            <button type="button" class="btn btn-common-green mock_test_take_test_btn mock_test_take_test_btn_for_mob mobile_block" id="take_test_mobile">Take Test</button>
                                        </div>
                                    </div>

                                </div>
                                <div id="attempted2" class=" tab-pane mock_attempetd_head_wraper mock_attemptepted_spacing">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
</body>
<script type="text/javascript">
    $('.spinnerblock').hide();
    $('#take_test, #take_test_mobile').click(function() {
        var url = "{{ route('mockExam','instruction') }}";
        window.location.href = url;
    });
    $('#mcoktest').click(function() {
        $('.spinnerblock').show();
        $('#mock_test').addClass('active');
        $('#attempted2').removeClass('active');
        $("#attempted2").hide();
        setTimeout(function() {
            $('.spinnerblock').hide();
        }, 1000);
    });
    $('#attempted').click(function() {
        $('.spinnerblock').show();
        url = "{{ url('ajax_exam_result_list') }}/Mocktest";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            beforeSend: function() {

            },
            success: function(data) {
                $("#attempted2").show();
                $('#attempted2').html(data.html);
                $('#testTypeDiv').attr("style", "display: none !important");
                $('.slot_div').hide();
                $('.spinnerblock').hide();
            },
            error: function(data, errorThrown) {
                $('.spinnerblock').hide();
            }
        });
    });
</script>
<!-- mixpanel start -->
<script type="text/javascript">
(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

// Enabling the debug mode flag is useful during implementation,
// but it's recommended you remove it for production
var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
mixpanel.track('Loaded Mock Exam Page');
</script>
<!-- mixpanel end -->

@include('afterlogin.layouts.footer_new')
@endsection