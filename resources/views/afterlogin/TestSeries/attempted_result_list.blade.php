<div class="common_greenbadge_tabs exam_topicbtn pb-4 mb-1" id="testTypeDiv">
    <ul class="nav nav-pills d-inline-flex" id="marks-tab" role="tablist">
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
<div class="common_greenbadge_tabs exam_topicbtn pb-4 mb-1" id="AssessmentTypeDiv" style="display:none !important">
    <ul class="nav nav-pills d-inline-flex" id="marks-tab" role="tablist">
        <li class="nav-item" role="presentation" type="button">
            <button class="nav-link btn pt-0 pb-0 SubattemptActBtn active" onclick="showSubfilter('all_subject');" id="all_subject_flt">ALL SUBJECTS</button>
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
@if(!empty($result_data))
@foreach($result_data as $sche)
<div class="compLeteS accordion-item pt-4 {{$sche->subject_name}}-rlt exam_mode_{{$sche->exam_mode}}">
    <div class="test-table d-flex align-items-baseline justify-content-between live_mock_exam_section">
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
        <div class="accordion-header mock_btn_vie_detail d-flex align-items-center justify-content-between;" id="headingTwo">
            <a href="javascript:void(0);" class="m-0 view_detail_text_colleps">
                <h4 class="view_details" data-id="{{$sche->id}}">View details</h4>
            </a>
            <div class="d-flex align-items-center see_analytics_mock_exam">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M15.267 10c2.166 0 3.066-.833 2.266-3.566-.541-1.842-2.125-3.425-3.966-3.967-2.734-.8-3.567.1-3.567 2.267v2.4C10 9.167 10.833 10 12.5 10h2.767z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.667 12.25a7.576 7.576 0 0 1-8.684 5.975c-3.158-.508-5.7-3.05-6.216-6.208a7.584 7.584 0 0 1 5.95-8.675" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                @php 
                $test_type = base64_encode($sche->test_type);
                @endphp
                <a href="{{route('get_exam_result_analytics',[$sche->id,$test_type])}}">
                    <h3>See analytics</h3>
                </a>
            </div>
            <a href="{{route('exam_review',[$sche->id,'attempted'])}}" class="btn btn-common-transparent bg-transparent ms-4">Review exam</a>
        </div>
    </div>
    <div id="chapter_{{$sche->id}}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body ps-0 pe-0">
            <div class="mock_test_ques_dure_marks_sub d-flex">
                <div class="mock_test_ques_content2">
                    <div class="mock_test_q_d_m_s_text1">No. Of Questions</div>
                    <div class="mock_test_qdms_text2">{{$sche->no_of_question}} MCQ</div>
                </div>
                <div class="mock_test_dure_content2">
                    <div class="mock_test_q_d_m_s_text1">Duration</div>
                    <div class="mock_test_qdms_text2"><span>{{$sche->test_time/60}}</span><span>Mins</span></div>
                </div>
                <div class="mock_test_marks_content2">
                    <div class="mock_test_q_d_m_s_text1">Marks</div>
                    <div class="mock_test_qdms_text2">{{$sche->no_of_question * 4}}</div>
                </div>
                <div class="mock_test_marks_content2">
                    <div class="mock_test_q_d_m_s_text1">Subject</div>
                    <div class="mock_test_qdms_text2">{{$sche->subject_name}}</div>
                </div>
                <div class="mock_test_marks_content2">
                    <div class="mock_test_q_d_m_s_text1">Slot</div>
                    <div class="mock_test_qdms_text2">Morning</div>
                </div>
                <div class="mock_test_sub_content2">
                    <div class="mock_test_q_d_m_s_text1">Score</div>
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
@if(!empty($result_data))
<div class="no_data_found text-center">
    <span class="sub-details" id="error_data">No result history available right now.</span>
</div>
@endif
<script type="text/javascript">
$('.no_data_found').hide();
$('.view_details').click(function() {
   
    var text_data = $(this).text();
    var ids = parseInt($(this).attr('data-id'));
    var toggel = $('#chapter_' + ids).hasClass('show');
    if (text_data === 'View details') {
        $(this).parents('.test-table').addClass('list_active');
        $(this).text('Hide details');
        $('#chapter_' + ids).addClass('show');
    } else if (text_data === 'Hide details') {
        $(this).parents('.test-table').removeClass('list_active');
        $(this).text('View details');
        $('#chapter_' + ids).removeClass('show');
    }
});

</script>
