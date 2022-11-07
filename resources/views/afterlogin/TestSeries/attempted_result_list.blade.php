@php
$userData = Session::get('user_data');
@endphp
<?php $redis_data = Session::get('redis_data'); ?>
<script type="text/javascript">
(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);
    var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
    mixpanel.init(mixpanelid); 
    mixpanel.track('Attempted Page Load', {
        "$city": '<?php echo $userData->city; ?>',
    });
</script>

<div class="common_greenbadge_tabs exam_topicbtn pb-4 mb-1 m mobilescrolltab" id="testTypeDiv">
    <div class="mobilehoriontal450">
        <ul class="nav nav-pills d-inline-flex mobilescrolltabNew" id="marks-tab" role="tablist">
            <li class="nav-item" role="presentation" type="button">
                <button class="nav-link btn pt-0 pb-0 all_attemp active">All Test Series</button>
            </li>
            <li class="nav-item" role="presentation" type="button">
                <button class="nav-link btn pt-0 pb-0 open_attemp">Open Test Series</button>
            </li>
            <li class="nav-item" role="presentation" type="button">
                <button class="nav-link pt-0 pb-0 btn live_attemp">Live Test Series</button>
            </li>
        </ul>
    </div>
</div>
<div class="common_greenbadge_tabs exam_topicbtn pb-4 mb-1 mobilescrolltab" id="AssessmentTypeDiv" style="display:none !important">
    <div class="mobilehoriontal550">
        <ul class="nav nav-pills d-inline-flex" id="marks-tab" role="tablist">
            <li class="nav-item" role="presentation" type="button">
                <button class="nav-link btn pt-0 pb-0 SubattemptActBtn active" onclick="showSubfilter('all_subject');" id="all_subject_flt">All subjects</button>
            </li>
            @isset($cSubjects)
            @foreach($cSubjects as $key=>$subject)
            <li class="nav-item" role="presentation" type="button">
                <button class="nav-link btn pt-0 pb-0 SubattemptActBtn " onclick="showSubfilter('{{$subject->subject_name}}');" id="{{$subject->subject_name}}_flt">{{$subject->subject_name}}</button>
            </li>
            @endforeach
            @endisset
        </ul>
    </div>
</div>
<div class="accordion" id="accordionExample">
    <div class="tablescroll MockTestMob Testseriesattemb mock_attemptepted_spacing">
        @if(!empty($result_data))
        @foreach($result_data as $sche)
        <div class="compLeteS accordion-item  {{$sche->subject_name}}-rlt exam_mode_{{$sche->exam_mode}}">
            <div class="test-table d-flex align-items-center justify-content-between live_mock_exam_section">
                @php
                $testname="";
                $marks =$sche->no_of_question * 4;
                if($sche->test_series_name)
                {
                $testname = $sche->test_series_name;
                }elseif($sche->live_exam_name)
                {
                $testname = $sche->live_exam_name;
                }
                elseif($sche->test_type == 'Mocktest')
                {
                $testname = 'Mock Exam';
                if($sche->no_of_question == 90)
                {
                $marks=300;
                }
                if($sche->no_of_question == 200)
                {
                $marks=720;
                }

                }elseif($sche->test_type == 'PreviousYear')
                {
                $testname = $sche->py_paper_name;
                }elseif($sche->test_type == 'Assessment'){
                $testname = 'Custom Exam';
                }else
                {
                $testname =$sche->test_type;
                }

                @endphp
                <h2 class="m-0 mt-1">

                    @if($sche->test_series_name)
                    {{$sche->test_series_name}}
                    @elseif($sche->live_exam_name)
                    {{$sche->live_exam_name}}
                    @elseif($sche->test_type == 'Mocktest')
                    Mock Exam
                    @elseif($sche->test_type == 'Assessment')
                    Custom Exam
                    @else
                    {{$sche->test_type}}
                    @endif
                </h2>
                <h3 class="m-0">{{date('d F Y', strtotime($sche->created_at));}}</h3>
                <div class="accordion-header mock_btn_vie_detail d-flex align-items-center justify-content-between;" id="headingTwo">
                    <a href="javascript:void(0);" class="m-0 view_detail_text_colleps">
                        <!-- <h4 class="view_details" data-id="{{$sche->id}}">View details</h4> -->
                        <h4 data-bs-toggle="collapse" data-bs-target="#chapter_{{$sche->id}}" aria-expanded="true" aria-controls="headingTwo" class="view_details" data-id="{{$sche->id}}">View details</h4>

                    </a>
                    <div class="d-flex align-items-center see_analytics_mock_exam">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M15.267 10c2.166 0 3.066-.833 2.266-3.566-.541-1.842-2.125-3.425-3.966-3.967-2.734-.8-3.567.1-3.567 2.267v2.4C10 9.167 10.833 10 12.5 10h2.767z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.667 12.25a7.576 7.576 0 0 1-8.684 5.975c-3.158-.508-5.7-3.05-6.216-6.208a7.584 7.584 0 0 1 5.95-8.675" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        @php
                        $test_type = base64_encode($sche->test_type);
                        $test_name = base64_encode($testname);
                        @endphp
                        <a href="{{route('get_exam_result_analytics',[$sche->id,$test_type,$test_name])}}">
                            <h3>See analytics</h3>
                        </a>
                    </div>
                    <a href="{{route('exam_review',[$sche->id,'attempted',$test_name])}}" class="btn btn-common-transparent bg-transparent ms-4 mobile_hide">Review exam</a>
                </div>
            </div>
            <div id="chapter_{{$sche->id}}" class="accordion-collapse collapse all_show_hide" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body ps-0 pe-0">
                    <div class="mock_test_ques_dure_marks_sub d-flex">
                        <div class="mock_test_ques_content2">
                            <div class="mock_test_q_d_m_s_text1">No. of Questions</div>
                            <div class="mock_test_qdms_text2">{{$sche->no_of_question}} Questions</div>
                        </div>

                        @if($sche->test_type == 'Live')
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_dure_content2 liveexamMobileOrder3">
                            <div class="mock_test_q_d_m_s_text1">Start Date</div>
                            <div class="mock_test_qdms_text2"><span>{{date('d F Y', strtotime($sche->stat_date));}}</span></div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_marks_content2 liveexamMobileOrder4">
                            <div class="mock_test_q_d_m_s_text1">End Date</div>
                            <div class="mock_test_qdms_text2">{{date('d F Y', strtotime($sche->end_date));}}</div>
                        </div>
                        @else
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_dure_content2">
                            <div class="mock_test_q_d_m_s_text1">Duration</div>
                            <div class="mock_test_qdms_text2"><span>{{$sche->test_time/60}}</span> <span>Mins</span></div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_marks_content">
                            <div class="mock_test_q_d_m_s_text1">Marks</div>
                            <div class="mock_test_qdms_text2">{{$marks}}</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_sub_content">
                            <div class="mock_test_q_d_m_s_text1">{{($subject_count>1)?'Subjects':'Subject'}}</div>
                            <div class="mock_test_qdms_text2">{{$sche->subject_name}}</div>
                        </div>
                        <div class="live_exam_diveder_div slot_div"></div>
                        <div class="mock_test_marks_content2 slot_div">
                            <div class="mock_test_q_d_m_s_text1">Slot</div>
                            <div class="mock_test_qdms_text2">Morning</div>
                        </div>
                        @endif
                        @if($sche->test_type == 'Live')
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_dure_content2 align_left_text_div liveexamOnlyOrder2">
                            <div class="mock_test_q_d_m_s_text1">Score</div>
                            <div class="mock_test_qdms_text2"><span>{{$sche->marks_gain}}</span>/<span>{{$marks}}</span></div>
                        </div>
                        @else
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_dure_content2 align_left_text_div">
                            <div class="mock_test_q_d_m_s_text1">Score</div>
                            <div class="mock_test_qdms_text2"><span>{{$sche->marks_gain}}</span>/<span>{{$marks}}</span></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{route('exam_review',[$sche->id,'attempted',$test_name])}}" class="btn btn-common-transparent bg-transparent mobile_block">Review exam</a>

        </div>
        @endforeach
        @else
        <div class="text-center">
            <span class="sub-details">No result history available right now</span>
        </div>
        @endif
        @if(!empty($result_data))
        <div class="no_data_found text-center">
            <span class="sub-details" id="error_data">No result history available right now</span>
        </div>
        @endif
    </div>
</div>
<script type="text/javascript">
    $('.no_data_found').hide();
    $('.view_details').click(function() {


        /*mixpanel start*/
        var user_id = '<?php echo $userData->id; ?>';
        var test_type = '<?php echo isset($sche->test_type) ? $sche->test_type : 'Live'; ?>';
        mixpanel.identify(user_id);
        mixpanel.people.set({
            "$city": '<?php echo $userData->city; ?>',
            "test type": test_type,
        });

        mixpanel.track(test_type + " - click view details", {
            "city": '<?php echo $userData->city; ?>',
            "test type": test_type,
        });
        /*mixpanel end*/

        var text_data = $(this).text();
        var ids = parseInt($(this).attr('data-id'));
        var toggel = $('#chapter_' + ids).hasClass('show');
        $('#chapter_' + ids).hasClass('show');
        $('.compLeteS').removeClass('list_active');

        $('.all_show_hide').removeClass('show');
        $('.view_details').text('View details');
        if (text_data === 'View details') {
            $(this).parents('.compLeteS').addClass('list_active');
            $(this).text('Hide details');
            $('#chapter_' + ids).addClass('show');
        } else if (text_data === 'Hide details') {
            $(this).parents('.compLeteS').removeClass('list_active');
            $(this).text('View details');
            $('#chapter_' + ids).removeClass('show');
        }
    });

    $('.see_analytics').click(function() {

        /*mixpanel start*/
        var user_id = '<?php echo $userData->id; ?>';
        var test_type = '<?php echo isset($sche->test_type) ? $sche->test_type : 'Live'; ?>';
        mixpanel.identify(user_id);
        mixpanel.people.set({
            "$city": '<?php echo $userData->city; ?>',
            "test type": test_type,
        });

        mixpanel.track(test_type + " - click see analytics", {
            "city": '<?php echo $userData->city; ?>',
            "test type": test_type,
        });
        /*mixpanel end*/

    });
</script>