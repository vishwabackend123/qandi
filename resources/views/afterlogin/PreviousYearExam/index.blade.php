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
                                        <p class="previous_exam_year_exam_paper_text"><span class="mobile_hide">Test your preparedness with </span>Past year exam papers</p>
                                    </div>
                                    <div class="dropbox previous_dropbox_page">
                                        <!-- <div class="customDropdown dropdown">
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
                                        </div> -->
                                        <div class="customDropdown1 dropdown" id="dropdown1">
                                            <input class="text-box markstrend" type="text" id="markstrend_graph2" placeholder="Select Year" readonly>
                                            <div class="options">
                                                <div style=" overflow-y: auto;  height: 145px;">
                                                    <div class="active markstrend">All Test</div>
                                                    <div class="markstrend">Mock Test</div>
                                                    <div class="markstrend">Practice Test</div>
                                                    <div class="markstrend">Test Series</div>
                                                    <div class="markstrend">Live Test</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion mt-4 pt-1" id="accordionExample">
                                    @if(!empty($upcomming_live_exam))
                                    <div class="allscrollbar tablescroll">
                                        @foreach($upcomming_live_exam as $sche)

                                        <div class="accordion-item pt-4 mt-1 compLeteS filter_data_{{$sche->paper_year}}">
                                            <div class="test-table d-flex align-items-center justify-content-between live_mock_exam_section">
                                                <h2 class="m-0" title="{{$sche->paper_name}}">{{$sche->paper_name}}</h2>
                                                <h3 class="m-0 d-flex justify-content-center notbold">{{$sche->paper_year}}</h3>
                                                <div class="accordion-header mock_btn_vie_detail d-flex align-items-center" id="headingTwo">
                                                    <h4 data-bs-toggle="collapse" data-bs-target="#collapseTwo_{{$sche->paper_id}}" aria-expanded="true" aria-controls="collapseTwo_{{$sche->paper_id}}" class="m-0 view_detail_text_colleps2">View details</h4>
                                                    <form class="form-horizontal ms-auto mb-0" action="{{route('previousYearExam','instruction')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="paper_name" value="{{$sche->paper_name}}" />
                                                        <input type="hidden" name="paper_id" value="{{$sche->paper_id}}" />
                                                        <input type="hidden" name="paper_year" value="{{$sche->paper_year}}" />
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
                                    <div class=" text-center p-5">
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

    let dropdown1 = document.querySelector("#dropdown1")
        dropdown1.onclick = function() {
            dropdown1.classList.toggle("active1")
        }


</script>
@include('afterlogin.layouts.footer_new')

<style>
        .customDropdown1 {
            position: relative;
            width: 100%;
            border-radius: 10px;
            height: 60px;
        }

        .customDropdown1::before {
            content: "";
            background: url(https://app.thomsondigital2021.com/public/after_login/current_ui/images/arrow_drop_down.svg);
            position: absolute;
            top: 27px;
            right: 20px;
            z-index: 1;
            width: 21px;
            height: 8px;
            transition: 0.5s;
            pointer-events: none;
            background-size: revert;
            background-position: center;
            width: 13.1px;
            height: 10px;
        }

        .customDropdown1.active1::before {
            top: 22px;
            transform: rotate(-180deg);
        }

        .customDropdown1 input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            background: #f6f9fd;
            border: none;
            outline: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            letter-spacing: normal;
        }

        .customDropdown1 .options {
            position: absolute;
            top: 70px;
            width: 100%;
            background: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            -moz-scrollbar-position: outside;
            overflow: hidden;
            display: none;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            letter-spacing: normal;
            color: #1f1f1f;
        }

        .customDropdown1.active1 .options {
            display: block;
            z-index: 9;
        }

        .customDropdown1 .options .markstrend {
            padding: 12px 20px;
            cursor: pointer;
        }

        .journeyBoxcontainer .customDropdown1 .options .markstrend:hover {
            background: #f0fcf2;
        }

        .customDropdownpdown1 input::-webkit-input-placeholder {
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            text-align: left;
            color: #1f1f1f;
        }

        .customDropdown1 input::-webkit-input-placeholder {
            /* Edge */
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            text-align: left;
            color: #1f1f1f;
        }

        .customDropdown1 input:-ms-input-placeholder {
            /* Internet Explorer 10-11 */
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            text-align: left;
            color: #1f1f1f;
        }

        .customDropdown1 input::placeholder {
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            text-align: left;
            color: #1f1f1f;
        }
    </style>

@endsection

