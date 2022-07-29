<div class="jee_main_text_take_test__btn previous_exam_head_with_drop">
    <div class="mock_exam_jee_main_text d-flex align-items-center">
        <p class="previous_exam_year_exam_paper_text">Test your preparedness with Past year exam papers</p>
    </div>
    <div class="dropbox previous_dropbox_page">
        <div class="customDropdown dropdown">
            <select class="form-control form-select" id="filter_attemp_year">
                <option value="">Select Year </option>
                @if(!empty($years_list))
                @foreach($years_list as $yr)
                <option value="{{$yr}}">{{$yr}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <!-- <div class="customDropdown dropdown">
            <input class="text-box markstrend" type="text" id="markstrend_graph" placeholder="All Test" readonly>
            <div class="options">
                <div style=" overflow-y: auto;  height: 145px;">
                    <div class="active markstrend">2021</div>
                    <div class="active markstrend">2020</div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<div class="accordion mt-4 pt-1" id="accordionExampleTwo">
    <div class="allscrollbar">
        @if(!empty($result_data))
        @foreach($result_data as $sche)
        @php
        $year = date('Y', strtotime($sche->created_at));
        @endphp
        <div class="accordion-item pt-4 compLeteA filter_year_{{$year}}">
            <div class="test-table d-flex align-items-center justify-content-between live_mock_exam_section">
                <h2 class="m-0">
                    @if($sche->test_series_name)
                    {{$sche->test_series_name}}
                    @elseif($sche->live_exam_name)
                    {{$sche->live_exam_name}}
                    @elseif($sche->test_type == 'Mocktest')
                    Mock Test
                    @elseif($sche->test_type == 'PreviousYear')
                    {{$sche->py_paper_name}}
                    @else
                    {{$sche->test_type}}
                    @endif
                </h2>
                <h3 class="m-0">{{date('d F Y', strtotime($sche->created_at));}}</h3>
                <div class="accordion-header mock_btn_vie_detail d-flex align-items-center" id="headingTwoTwo">
                    <h4 data-bs-toggle="collapse" data-bs-target="#collapseTwoTwo_{{$sche->id}}" aria-expanded="true" aria-controls="collapseTwoTwo" class="m-0 view_detail_text_colleps view_details">View details</h4>
                    <a href="{{route('get_exam_result_analytics',$sche->id)}}">
                        <div class="d-flex align-items-center see_analytics_mock_exam see_analytics_mock_exam_previoues_border">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M15.267 10c2.166 0 3.066-.833 2.266-3.566-.541-1.842-2.125-3.425-3.966-3.967-2.734-.8-3.567.1-3.567 2.267v2.4C10 9.167 10.833 10 12.5 10h2.767z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.667 12.25a7.576 7.576 0 0 1-8.684 5.975c-3.158-.508-5.7-3.05-6.216-6.208a7.584 7.584 0 0 1 5.95-8.675" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                    <a href="{{route('exam_review',[$sche->id,'attempted'])}}" class="btn btn-common-transparent bg-transparent ms-4">Review exam</a>
                </div>
            </div>
            <div id="collapseTwoTwo_{{$sche->id}}" class="accordion-collapse collapse" aria-labelledby="headingTwoTwo" data-bs-parent="#accordionExampleTwo">
                <div class="accordion-body ps-0 pe-0">
                    <div class="mock_test_ques_dure_marks_sub d-flex justify-content-between">
                        <div class="mock_test_ques_content22">
                            <div class="mock_test_qdms_text1">No. Of Questions</div>
                            <div class="mock_test_qdms_text2">{{$sche->no_of_question}} MCQ</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_dure_content22">
                            <div class="mock_test_qdms_text1">Duration</div>
                            <div class="mock_test_qdms_text2"><span>{{$sche->test_time/60}}</span> <span>Mins</span></div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_sub_content22">
                            <div class="mock_test_qdms_text1">Marks</div>
                            <div class="mock_test_qdms_text2">{{$sche->no_of_question * 4}}</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_sub_content22">
                            <div class="mock_test_qdms_text1">Subject</div>
                            <div class="mock_test_qdms_text2">{{$sche->subject_name}}</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_marks_content22">
                            <div class="mock_test_qdms_text1">Slot</div>
                            <div class="mock_test_qdms_text2">Morning</div>
                        </div>
                        <div class="live_exam_diveder_div"></div>
                        <div class="mock_test_sub_content22">
                            <div class="mock_test_qdms_text1">Score</div>
                            <div class="mock_test_qdms_text2"><span>{{$sche->marks_gain}}</span>/<span>{{$sche->no_of_question * 4}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="text-center">
            <span class="sub-details">No result history available right now.</span>
        </div>
        @endif
    </div>
</div>
<script type="text/javascript">
$('.view_details').click(function() {
   
    var text_data = $(this).text();
    if (text_data === 'View details') {
        $(this).parents('.compLeteS').addClass('list_active');
        $(this).text('Hide details');
    } else if (text_data === 'Hide details') {
        $(this).parents('.compLeteS').removeClass('list_active');
        $(this).text('View details');
    }
});
$('#filter_attemp_year').change(function() {

    var selected_val = $(this).val();
    if (selected_val) {
        $('.compLeteA').hide();
        $('.filter_year_' + selected_val).show();
    } else {
        $('.compLeteA').show();
    }
});

</script>
