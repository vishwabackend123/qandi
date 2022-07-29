@extends('afterlogin.layouts.app_new')
@section('content')
<div class="main-wrapper">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <section class="content-wrapper">
        <div class="container-fluid previous_exam_page_contain">
            <div class="row">
                <div class="col-lg-12">
                    <div class="commontab">
                        <div class="tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item pe-5 me-2">
                                    <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#mock_test">Previous Year Exam</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#attempted_tab" id="attempted">Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content bg-white exam_tabdata">
                            <div id="mock_test" class=" tab-pane active">
                                <div class="jee_main_text_take_test__btn previous_exam_head_with_drop">
                                    <div class="mock_exam_jee_main_text d-flex align-items-center">
                                        <p class="previous_exam_year_exam_paper_text">Test your preparedness with Past year exam papers</p>
                                    </div>
                                    <div class="dropbox previous_dropbox_page">
                                        <div class="customDropdown dropdown">
                                            @php
                                            $latest_year = date('Y');
                                            @endphp
                                            <select class="form-control form-select" id="filter_year">
                                                <option value="">Select year </option>
                                                @if(!empty($years_list))
                                                @foreach($years_list as $yr)
                                                <option value="{{$yr}}">{{$yr}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion mt-4 pt-1" id="accordionExample">
                                    @if(!empty($upcomming_live_exam))
                                    <div class="allscrollbar">
                                        @foreach($upcomming_live_exam as $sche)
                                        <div class="accordion-item pt-4 mt-1 compLeteS filter_data_{{$sche->paper_year}}">
                                            <div class="test-table d-flex align-items-center justify-content-between live_mock_exam_section">
                                                <h2 class="m-0">{{$sche->paper_name}}</h2>
                                                <h3 class="m-0 d-flex justify-content-center notbold">{{$sche->paper_year}}</h3>
                                                <div class="accordion-header mock_btn_vie_detail d-flex align-items-center" id="headingTwo">
                                                    <h4 data-bs-toggle="collapse" data-bs-target="#collapseTwo_{{$sche->paper_id}}" aria-expanded="true" aria-controls="collapseTwo_{{$sche->paper_id}}" class="m-0 view_detail_text_colleps2">View details</h4>
                                                    <form class="form-horizontal ms-auto mb-0" action="{{route('previousYearExam','instruction')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="paper_name" value="{{$sche->paper_name}}" />
                                                        <input type="hidden" name="paper_id" value="{{$sche->paper_id}}" />
                                                        <button class="btn btn-common-transparent bg-transparent ms-4">Take test</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="collapseTwo_{{$sche->paper_id}}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ps-0 pe-0">
                                                    <div class="mock_test_ques_dure_marks_sub d-flex justify-content-between">
                                                        <div class="mock_test_ques_content22">
                                                            <div class="mock_test_qdms_text1">No. Of Questions</div>
                                                            <div class="mock_test_qdms_text2">{{$sche->total_ques}} MCQ</div>
                                                        </div>
                                                        <div class="live_exam_diveder_div"></div>
                                                        <div class="mock_test_dure_content22">
                                                            <div class="mock_test_qdms_text1">Duration</div>
                                                            <div class="mock_test_qdms_text2"><span>{{$sche->test_duration}}</span><span>Mins</span></div>
                                                        </div>
                                                        <div class="live_exam_diveder_div"></div>
                                                        <div class="mock_test_marks_content22">
                                                            <div class="mock_test_qdms_text1">Marks</div>
                                                            <div class="mock_test_qdms_text2">{{$sche->total_marks}}</div>
                                                        </div>
                                                        <div class="live_exam_diveder_div"></div>
                                                        <div class="mock_test_sub_content22">
                                                            <div class="mock_test_qdms_text1">Subject</div>
                                                            @php
                                                            $subject_list = implode(',',array_column($sche->subjects, 'subject_name'));
                                                            @endphp
                                                            <div class="mock_test_qdms_text2">{{$subject_list}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class=" text-center p-4">
                                        <h5>No series available.</h5>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div id="attempted_tab" class=" tab-pane">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script>
$('#filter_year').change(function() {

    var selected_val = $(this).val();
    if (selected_val) {
        $('.compLeteS').hide();
        $('.filter_data_' + selected_val).show();
    } else {
        $('.compLeteS').show();
    }
});
let dropdown = document.querySelector(".customDropdown")
dropdown.onclick = function() {
    dropdown.classList.toggle("active")
}

</script>
<script type="text/javascript">
$('#attempted').click(function() {
    url = "{{ url('ajax_exam_result_list') }}/PreviousYear";
    $.ajax({
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",
        },
        beforeSend: function() {

        },
        success: function(data) {
            $("#attempted_tab").show();
            $('#attempted_tab').html(data.html);
            $('#testTypeDiv').attr("style", "display: none !important");
        },
        error: function(data, errorThrown) {}
    });
});
$('.view_detail_text_colleps2').click(function() {
        var text_data = $(this).text();
        if (text_data === 'View details') {
            $(this).parents('.compLeteS').addClass('list_active');
            $(this).text('Hide details');
        } else if (text_data === 'Hide details') {
            $(this).parents('.compLeteS').removeClass('list_active');
            $(this).text('View details');
        }
     });

</script>
@include('afterlogin.layouts.footer_new')
@endsection
