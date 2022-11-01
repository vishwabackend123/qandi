<div class="jee_main_text_take_test__btn previous_exam_head_with_drop">
    <div class="mock_exam_jee_main_text d-flex align-items-center">
        <p class="previous_exam_year_exam_paper_text"><span class="mobile_hide">Test your preparedness with </span>Past year exam papers</p>
    </div>
    <div class="dropbox previous_dropbox_page">
        <!-- <div class="customDropdown dropdown">
            <select class="form-control form-select" id="filter_attemp_year">
                <option value="">Select Year </option>
                @if(!empty($years_list))
                @foreach($years_list as $yr)
                <option value="{{$yr}}">{{$yr}}</option>
                @endforeach
                @endif
            </select>
        </div> -->
        <div class="customDropdown1 dropdown" id="dropdown2">
            <input class="text-box markstrend" type="text" id="filter_attemp_year" placeholder="Select Year" readonly>
            <div class="options">
                <div style=" overflow-y: auto; max-height: 145px;">
                    <div class="markstrend" onclick="showAttempedFiter('')">Select Year</div>
                    @if(!empty($years_list))
                    @foreach($years_list as $yr)
                    <div class="markstrend" onclick="showAttempedFiter('{{$yr}}')">{{$yr}}</div>
                    @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
<div class="accordion mt-4 pt-1" id="accordionExampleTwo">
    <div class="allscrollbar tablescroll">
        @if(!empty($result_data))
        @foreach($result_data as $sche)
        @php
        $year = isset($sche->paper_year) ? $sche->paper_year : '';
        $marks =$sche->no_of_question * 4;
        if($sche->no_of_question == 90)
        {
        $marks=300;
        }
        if($sche->no_of_question == 200)
        {
        $marks=720;
        }
        @endphp
        <div class="accordion-item pt-4 compLeteA filter_year_{{$year}}">
            <div class="test-table d-flex align-items-center justify-content-between live_mock_exam_section">
                <h2 class="m-0" title="{{$sche->py_paper_name}}">
                    @if($sche->test_series_name)
                    {{$sche->test_series_name}}
                    @elseif($sche->live_exam_name)
                    {{$sche->live_exam_name}}
                    @elseif($sche->test_type == 'Mocktest')
                    Mock Exam
                    @elseif($sche->test_type == 'PreviousYear')
                    {{$sche->py_paper_name}}
                    @else
                    {{$sche->test_type}}
                    @endif
                </h2>
                @php
                $test_type = base64_encode($sche->test_type);
                $test_name = base64_encode($sche->py_paper_name);
                @endphp
                <h3 class="m-0 notbold">{{date('d F Y', strtotime($sche->created_at));}}</h3>
                <div class="accordion-header mock_btn_vie_detail d-flex align-items-center" id="headingTwoTwo">
                    <h4 data-bs-toggle="collapse" data-bs-target="#collapseTwoTwo_{{$sche->id}}" aria-expanded="true" aria-controls="collapseTwoTwo" class="m-0 view_detail_text_colleps view_details">View details</h4>
                    <a onclick="sendEvent()" title="See analytics" href="{{route('get_exam_result_analytics',[$sche->id,$test_type,$test_name])}}">
                        <div class="d-flex align-items-center see_analytics_mock_exam see_analytics_mock_exam_previoues_border mobile_hide">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M15.267 10c2.166 0 3.066-.833 2.266-3.566-.541-1.842-2.125-3.425-3.966-3.967-2.734-.8-3.567.1-3.567 2.267v2.4C10 9.167 10.833 10 12.5 10h2.767z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.667 12.25a7.576 7.576 0 0 1-8.684 5.975c-3.158-.508-5.7-3.05-6.216-6.208a7.584 7.584 0 0 1 5.95-8.675" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                    <div class="d-flex align-items-center see_analytics_mock_exam mobile_block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M15.267 10c2.166 0 3.066-.833 2.266-3.566-.541-1.842-2.125-3.425-3.966-3.967-2.734-.8-3.567.1-3.567 2.267v2.4C10 9.167 10.833 10 12.5 10h2.767z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.667 12.25a7.576 7.576 0 0 1-8.684 5.975c-3.158-.508-5.7-3.05-6.216-6.208a7.584 7.584 0 0 1 5.95-8.675" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <a href="{{route('get_exam_result_analytics',[$sche->id,$test_type,$test_name])}}">
                            <h3 class="previous_attempt_exam_mob_block"><b>See analytics</b></h3>
                        </a>
                    </div>
                    <a href="{{route('exam_review',[$sche->id,'attempted',$test_name])}}" class="btn btn-common-transparent bg-transparent ms-4 mobile_hide">Review exam</a>
                </div>
            </div>
            <div id="collapseTwoTwo_{{$sche->id}}" class="accordion-collapse collapse" aria-labelledby="headingTwoTwo" data-bs-parent="#accordionExampleTwo">
                <div class="accordion-body ps-0 pe-0">
                    <div class="mock_test_ques_dure_marks_sub d-flex justify-content-between">
                        <div class="mock_test_ques_content22">
                            <div class="mock_test_qdms_text1">No. of Questions</div>
                            <div class="mock_test_qdms_text2">{{$sche->no_of_question}} Questions</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_dure_content22">
                            <div class="mock_test_qdms_text1">Duration</div>
                            <div class="mock_test_qdms_text2"><span>{{$sche->test_time/60}}</span> <span>Mins</span></div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_sub_content22 mock_test_marks_content">
                            <div class="mock_test_qdms_text1">Marks</div>
                            <div class="mock_test_qdms_text2">{{$marks}}</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_sub_content22 mock_test_sub_content ">
                            <div class="mock_test_qdms_text1">{{($subject_count>1)?'Subjects':'Subject'}}</div>
                            <div class="mock_test_qdms_text2">{{$sche->subject_name}}</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_marks_content22 " id="mock_test_slot_content222">
                            <div class="mock_test_qdms_text1">Slot</div>
                            <div class="mock_test_qdms_text2">Morning</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_sub_content22">
                            <div class="mock_test_qdms_text1">Score</div>
                            <div class="mock_test_qdms_text2"><span>{{$sche->marks_gain}}</span>/<span>{{$marks}}</span></div>
                        </div>
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
    </div>
</div>
<?php $redis_data = Session::get('redis_data'); ?>
<script type="text/javascript">
    // Mixpanel Started
    (function(f, b) {
        if (!b.__SV) {
            var e, g, i, h;
            window.mixpanel = b;
            b._i = [];
            b.init = function(e, f, c) {
                function g(a, d) {
                    var b = d.split(".");
                    2 == b.length && (a = a[b[0]], d = b[1]);
                    a[d] = function() {
                        a.push([d].concat(Array.prototype.slice.call(arguments, 0)))
                    }
                }
                var a = b;
                "undefined" !== typeof c ? a = b[c] = [] : c = "mixpanel";
                a.people = a.people || [];
                a.toString = function(a) {
                    var d = "mixpanel";
                    "mixpanel" !== c && (d += "." + c);
                    a || (d += " (stub)");
                    return d
                };
                a.people.toString = function() {
                    return a.toString(1) + ".people (stub)"
                };
                i = "disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
                for (h = 0; h < i.length; h++) g(a, i[h]);
                var j = "set set_once union unset remove delete".split(" ");
                a.get_group = function() {
                    function b(c) {
                        d[c] = function() {
                            call2_args = arguments;
                            call2 = [c].concat(Array.prototype.slice.call(call2_args, 0));
                            a.push([e, call2])
                        }
                    }
                    for (var d = {}, e = ["get_group"].concat(Array.prototype.slice.call(arguments, 0)), c = 0; c < j.length; c++) b(j[c]);
                    return d
                };
                b._i.push([e, f, c])
            };
            b.__SV = 1.2;
            e = f.createElement("script");
            e.type = "text/javascript";
            e.async = !0;
            e.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ?
                MIXPANEL_CUSTOM_LIB_URL : "file:" === f.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
            g = f.getElementsByTagName("script")[0];
            g.parentNode.insertBefore(e, g)
        }
    })(document, window.mixpanel || []);

    // Enabling the debug mode flag is useful during implementation,
    // but it's recommended you remove it for production

    function sendEvent() {
        var mixpanelid = "{{$redis_data['MIXPANEL_KEY']}}";
        mixpanel.init(mixpanelid);
        mixpanel.track('clicked to see analytics of PY exam');
    }

    // Mixpanel Event Ended

    $('.view_details').click(function() {

        var text_data = $(this).text();
        $('.view_details').text('View details');
        $('.compLeteA').removeClass('list_active');

        if (text_data === 'View details') {

            // Mixpanel Started 
            var mixpanelid = "{{$redis_data['MIXPANEL_KEY']}}";
            mixpanel.init(mixpanelid);
            mixpanel.track('Clicked to view details of PY exam');
            // Mixpanel Event Ended

            $(this).parents('.compLeteA').addClass('list_active');
            $(this).text('Hide details');
        } else if (text_data === 'Hide details') {
            $(this).parents('.compLeteA').removeClass('list_active');
            $(this).text('View details');
        }
    });
    /*$('#filter_attemp_year').change(function() {

        var selected_val = $(this).val();
        if (selected_val) {
            $('.compLeteA').hide();
            $('.filter_year_' + selected_val).show();
        } else {
            $('.compLeteA').show();
        }
    }); */
    function showAttempedFiter(selected_val) {
        document.querySelector("#filter_attemp_year").value = selected_val;
        if (selected_val) {
            $('.compLeteA').hide();
            $('.filter_year_' + selected_val).show();
        } else {
            $('.compLeteA').show();
        }
    }
    var dropdowns = document.querySelector("#dropdown2")
    dropdowns.onclick = function() {
        dropdowns.classList.toggle("active1")
    }
</script>