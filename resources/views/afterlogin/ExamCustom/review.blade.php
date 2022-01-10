@extends('afterlogin.layouts.app_new')

@php
$userData = Session::get('user_data');
@endphp
@section('content')

@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
@endphp
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">

                    <div class="tab-wrapper h-100">

                        <div class="test-review">

                            <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                                <div id="scroll-mobile">
                                    <!-- Exam subject Tabs  -->
                                    <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                                        @if(!empty($filtered_subject))
                                        @foreach($filtered_subject as $key=>$sub)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif" id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true" onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}} </a>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                    <span class="back-to-dashbord"><a href="{{url('/dashboard')}}">Back To Dashboard</a></span>
                                </div>
                                <!-- End Exam subject Tabs -->
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div id="review_rques_blk">
                                        <div class="question-block">
                                            <a href="javascript:void(0);" id="bkm_{{$activeq_id}}" onclick="bookmarkforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')" class="arrow next-arow"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a>
                                            <div class="question pb-3 pt-2"><span class="q-no">Q1.</span>
                                                {!! $question_text !!}
                                            </div>
                                            <div class="ans-block row mt-0">
                                                @if(isset($option_data) && !empty($option_data))
                                                @php $no=0;
                                                $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
                                                @endphp

                                                @foreach($option_data as $key=>$opt_value)
                                                @php
                                                $dom = new DOMDocument();
                                                @$dom->loadHTML($opt_value);
                                                $anchor = $dom->getElementsByTagName('img')->item(0);
                                                $text = isset($anchor)? $anchor->getAttribute('alt') : '';
                                                $latex = "https://math.now.sh?from=".$text;
                                                $view_opt='<img src="'.$latex.'" />' ;

                                                if(in_array($key,$answerKeys) && in_array($key,$attempt_opt)){
                                                $resp_class= 'btn-light-green';
                                                }else if(in_array($key,$answerKeys) && !in_array($key,$attempt_opt)){
                                                $resp_class= 'btn-light-green';
                                                }else if(!in_array($key,$answerKeys) && in_array($key,$attempt_opt)){
                                                $resp_class= 'btn-light-red';
                                                }else{
                                                $resp_class= '';
                                                }
                                                if(isset($attempt_opt['Answer:']) && in_array($key,$attempt_opt['Answer:'])){
                                                $checked= "checked";
                                                }else{
                                                $checked='';
                                                }
                                                @endphp
                                                <div class="col-md-6 mb-4">
                                                    <input class="form-check-input checkboxans" {{$checked}} disabled type="checkbox" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                                                    <div class="border ps-3 ans">
                                                        <label class="question m-0 py-3   d-block " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
                                                    </div>
                                                </div>@php $no++; @endphp
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="answer-section">
                                            <div class="answer-btn-txt"><span>Answer:</span>
                                                <span> @php $mn=0; @endphp
                                                    @foreach($correct_ans as $akey=>$ans_value)
                                                    @php
                                                    $ans_dom = new DOMDocument();
                                                    @$ans_dom->loadHTML($ans_value);
                                                    $ans_anchor = $ans_dom->getElementsByTagName('img')->item(0);
                                                    $atext = isset($ans_anchor)? $ans_anchor->getAttribute('alt') : '';
                                                    $alatex = "https://math.now.sh?from=".$atext;
                                                    $view_ans='<img src="'.$alatex.'" />' ;
                                                    @endphp
                                                    {!! !empty($atext)?$view_ans:$ans_value; !!}
                                                    @php $mn++; @endphp
                                                    @endforeach</span>
                                                <!-- <button class="percentage-digit">21 %</button> -->
                                            </div>
                                            <div class="ans-txt">
                                                @if(isset($question_data->explanation ) && !empty($question_data->explanation ))
                                                <sapn>Explanation :</sapn>
                                                <p>{!! $question_data->explanation !!}</p>
                                                @endif
                                                @if(isset($question_data->reference_text ) && !empty($question_data->reference_text ))

                                                <span>Reference :</span>

                                                <p>{!! $question_data->reference_text !!}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <!--answer-section-->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--test-review-->
                    </div>
                </div>
                <!-- Right Side Area -->

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 rightSect test-review-right">
                    <div class="bg-white d-flex flex-column justify-content-center mb-4   p-5">



                        <p class="rightSectH">Answer Palette</p>
                        <div class="number-block">
                            @php $quKey=1; @endphp
                            @if(isset($all_question_list) && !empty($all_question_list))

                            @foreach($all_question_list as $ke=>$val)
                            @php
                            $key_id=$val->question_id;
                            @endphp

                            @if ($val->attempt_status == 'Correct')
                            <button class="btn btn-light-green mb-4 rounded-0 next_button" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @elseif ($val->attempt_status == 'Incorrect')
                            <button class="btn btn-danger mb-4 rounded-0 next_button" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @else
                            <button class="btn btn-light rounded-0 mb-4 next_button" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @endif
                            @php $quKey++; @endphp
                            @endforeach
                            @endif
                        </div>

                        <div class="review-qus">
                            <div class="d-flex mb-3 reviewBox2">
                                <div class="col-10 heading">
                                    <h5><strong>Review Questions</strong></h5>
                                </div>
                                <div class="col text-end">
                                    <div class="dropdown">
                                        <a class="btn rotate-icon pt-0 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true"></i></a>


                                        <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('all')">
                                                    All</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Correct')"> Corrected</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Incorrect')"> Wronged</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Unanswered')"> Unattempted</a></li>

                                        </ul>
                                    </div>
                                </div>

                            </div>


                            <ul class="rview-quses" id="filter_questions">
                                @php $quKee=1; @endphp
                                @if(isset($all_question_list) && !empty($all_question_list))
                                @foreach($all_question_list as $kee=>$value)
                                @php

                                $key_id=$value->question_id;
                                @endphp
                                @if ($value->attempt_status == 'Correct')
                                <li class="correctans">
                                    <span class="qus-no">Q.{{$quKee}}</span>
                                    <span class="qus-txt">{!! $value->question !!}
                                    </span>
                                </li>
                                @elseif ($value->attempt_status == 'Incorrect')
                                <li class="incorrectans">
                                    <span class="qus-no">Q.{{$quKee}}</span>
                                    <span class="qus-txt">{!! $value->question !!}
                                    </span>
                                </li>
                                @else
                                <li class="notans">
                                    <span class="qus-no">Q.{{$quKee}}</span>
                                    <span class="qus-txt">{!! $value->question !!}
                                    </span>
                                </li>
                                @endif
                                @php $quKee++; @endphp
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <!--review-qus-->


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->


<script type="text/javascript">
    $('.scroll-div').slimscroll({
        height: '40vh'
    });
    $('.number-block').slimscroll({
        height: '34vh'
    });
    $('.answer-block').slimscroll({
        height: '45vh'
    });

    $('.review-questions-blk').slimscroll({
        height: '58vh'
    });

    function bookmarkforreview(quest_id, subject_id, chapt_id) {
        $.ajax({
            url: "{{ route('markforreview') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                question_id: quest_id,
                subject_id: subject_id,
                chapter_id: chapt_id
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);

                if (response.success == true) {

                    $("#bkm_" + quest_id).html('<i class="fa fa-bookmark text-danger pull-right" aria-hidden="true"></i>');

                } else {

                }

            },
        });
    }

    /* getting Next Question Data */
    function qnext(question_id) {

        url = "{{ url('next_review_question/') }}/" + question_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#review_rques_blk").html(result);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-block"]);

            }
        });
    }

    function get_subject_question(subject_id) {

        url = "{{ url('ajax_review_next_subject_question/') }}/" + subject_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#review_rques_blk").html(result);
            }
        });
    }

    function get_filtered_question(filter) {
        url = "{{ url('filter_review_question/') }}/" + filter;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#filter_questions").html(result);
            }
        });
    }
</script>
@endsection