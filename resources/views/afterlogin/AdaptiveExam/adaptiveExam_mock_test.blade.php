@extends('afterlogin.layouts.app_new')
@section('content')

<body class="bg-content">
    <div class="main-wrapper">
        @include('afterlogin.layouts.navbar_header_new')
        @include('afterlogin.layouts.sidebar_new')
        <section class="content-wrapper MockTestMob">
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
                                        <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#mock_test1" id="mcoktest">Mock Test</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#attempted2" id="attempted">Attempted</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content bg-white exam_tabdata">
                                <div id="mock_test" class=" tab-pane active">
                                    <div class="jee_main_text_take_test__btn">
                                        <div class="mock_exam_jee_main_text">
                                            <h3>{{isset($exam_name)?$exam_name:'Full Body Scan Test'}}</h3>
                                        </div>
                                        <button type="button" class="btn btn-common-green mock_test_take_test_btn" id="take_test">Take test</button>
                                    </div>
                                    <div class="line_696"></div>
                                    <div class="mock_test_ques_dure_marks_sub d-flex">
                                        <div class="mock_test_ques_content">
                                            <div class="mock_test_q_d_m_s_text1">No. Of Questions</div>
                                            <div class="mock_test_qdms_text2">{{$questions_count}} MCQ</div>
                                        </div>
                                        <div class="mock_test_dure_content">
                                            <div class="mock_test_q_d_m_s_text1">Duration</div>
                                            <div class="mock_test_qdms_text2"><span>{{$exam_fulltime}}</span> <span>Mins</span></div>
                                        </div>
                                        <div class="mock_test_marks_content">
                                            <div class="mock_test_q_d_m_s_text1">Marks</div>
                                            <div class="mock_test_qdms_text2">{{$total_marks}}</div>
                                        </div>
                                        <div class="mock_test_sub_content">
                                            <div class="mock_test_q_d_m_s_text1">Subject</div>
                                            <div class="mock_test_qdms_text2">{{$tagrets}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div id="attempted2" class=" tab-pane">

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
    $('#take_test').click(function() {
        var url = "{{ route('mockExam','instruction') }}";
        window.location.href = url;
    });
    $('#mcoktest').click(function() {
        $('#mock_test').addClass('active');
        $('#attempted2').removeClass('active');
    });
    $('#attempted').click(function() {
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
                },
                error: function(data, errorThrown) {
                }
            });
        });
</script>
@include('afterlogin.layouts.footer_new')
@endsection