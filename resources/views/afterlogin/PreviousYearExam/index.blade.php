@extends('afterlogin.layouts.app_new')
@section('content')
<div class="spinnerblock">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="main-wrapper exam-wrapperBg">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <section class="content-wrapper MockTestMob">
        <div class="container-fluid previous_exam_page_contain">
            @if(count($errors) > 0 )
            <div class="toastdata active">
                <div class="toast-content">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 17C1 8.163 8.163 1 17 1s16 7.163 16 16-7.163 16-16 16S1 25.837 1 17z" fill="#8DFDB3" />
                        <path d="M23.666 16.387V17a6.667 6.667 0 1 1-3.953-6.093m3.953.76L17 18.34l-2-2" stroke="#039855" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17 32C8.716 32 2 25.284 2 17H0c0 9.389 7.611 17 17 17v-2zm15-15c0 8.284-6.716 15-15 15v2c9.389 0 17-7.611 17-17h-2zM17 2c8.284 0 15 6.716 15 15h2c0-9.389-7.611-17-17-17v2zm0-2C7.611 0 0 7.611 0 17h2C2 8.716 8.716 2 17 2V0z" fill="#BDF3C5" />
                    </svg>
                    <div class="message">
                        <h5 class="mb-2"> </h5>
                        @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                        @endforeach
                    </div>
                </div>
                
                <div class="progress active"></div>
            </div>
            <script>
                $(function() {
                    setTimeout(function() {
                        $(".toastdata").removeClass('active');
                        $(".progress").removeClass('active');
                    }, 10000);
                });
            </script>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="commontab">
                        <div class="tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item pe-5 me-2">
                                    <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#mock_test" id="previous_year_tab">Previous Year Exams</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#attempted_tab" id="attempted">Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content bg-white exam_tabdata">
                            <div id="mock_test" class=" tab-pane active PrevousYearExam_wraper_contant1 mock_attempetd_head_wraper">
                                <div class="jee_main_text_take_test__btn previous_exam_head_with_drop">
                                    <div class="mock_exam_jee_main_text d-flex align-items-center">
                                        <p class="previous_exam_year_exam_paper_text"><span class="mobile_hide">Test your preparedness with </span>past year exam papers</p>
                                    </div>
                                    <div class="dropbox previous_dropbox_page">
                                        <div class="customDropdown dropdown">
                                            @php
                                            $latest_year = date('Y');
                                            @endphp
                                            <select class="form-control form-select" id="filter_year">
                                                <option value="">Select Year </option>
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
                                    <div class="allscrollbar tablescroll">
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
                                                        <button class="btn btn-common-transparent bg-transparent ms-4 tab_show">Take Test</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="collapseTwo_{{$sche->paper_id}}" class="accordion-collapse collapse " aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ps-0 pe-0">
                                                    <div class="mock_test_ques_dure_marks_sub d-flex justify-content-between">
                                                        <div class="mock_test_ques_content22">
                                                            <div class="mock_test_qdms_text1">No. of Questions</div>
                                                            <div class="mock_test_qdms_text2">{{$sche->total_ques}} Questions</div>
                                                        </div>
                                                        <div class="live_exam_diveder_div"></div>
                                                        <div class="mock_test_dure_content22">
                                                            <div class="mock_test_qdms_text1">Duration</div>
                                                            <div class="mock_test_qdms_text2"><span>{{$sche->test_duration}}</span> <span>Mins</span></div>
                                                        </div>
                                                        <div class="live_exam_diveder_div"></div>
                                                        <div class="mock_test_marks_content22">
                                                            <div class="mock_test_qdms_text1">Marks</div>
                                                            <div class="mock_test_qdms_text2">{{$sche->total_marks}}</div>
                                                        </div>
                                                        <div class="live_exam_diveder_div"></div>
                                                        <div class="mock_test_sub_content22">
                                                            <div class="mock_test_qdms_text1">Subjects</div>
                                                            @php
                                                            $subject_list = implode(', ',array_column($sche->subjects, 'subject_name'));
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
                                        <h5>No series available</h5>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div id="attempted_tab" class=" tab-pane mock_attempetd_head_wraper PrevousYearExam_wraper_contant2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $('.spinnerblock').hide();
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
    $('#previous_year_tab').click(function() {
        $('.spinnerblock').show();
        $('#mock_test').show();
        $('#attempted_tab').hide();
            setTimeout(function() {
            $('.spinnerblock').hide();
            }, 1000);

    });
    $('#attempted').click(function() {
        $('.spinnerblock').show();
        $('#mock_test').hide();
        $('#attempted_tab').show();
        url = "{{ url('ajax_exam_result_list') }}/PreviousYear";
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
            },
            error: function(data, errorThrown) {
                $('.spinnerblock').hide();
            }
        });
    });
    $('.view_detail_text_colleps2').click(function() {
        var text_data = $(this).text();
        $('.view_detail_text_colleps2').text('View details');
        $('.compLeteS').removeClass('list_active');
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