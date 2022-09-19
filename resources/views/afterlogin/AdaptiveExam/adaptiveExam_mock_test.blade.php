@extends('afterlogin.layouts.app_new')
@section('content')
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
                                            <h3>{{isset($exam_name)?$exam_name:'Full Body Scan Test'}}</h3>
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
                                            <button type="button" class="btn btn-common-green mock_test_take_test_btn mock_test_take_test_btn_for_mob mobile_block" id="take_test">Take Test</button>
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
    $('#take_test').click(function() {
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
@include('afterlogin.layouts.footer_new')
@endsection