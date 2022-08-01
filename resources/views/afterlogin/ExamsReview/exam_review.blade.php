@extends('afterlogin.layouts.app_new')
@section('content')
@php
$userData = Session::get('user_data');
@endphp
@section('content')

@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;


$template_type = isset($question_data->template_type)?$question_data->template_type:'';
$difficulty_level = isset($question_data->difficulty_level)?$question_data->difficulty_level:1;

$question_type = '';
if($template_type == 1){
$type_class='checkboxans';
$questtype='checkbox';
$question_type = "Multi Choice";
}elseif($template_type == 2){
$type_class='radioans';
$questtype='radio';
$question_type = "Single Choice";
}elseif ($template_type == 11) {
$question_type = "Numerical";
}
@endphp
<!-- Side bar menu -->

<!-- sidebar menu end -->
<div class="exam-wrapper">

    <!-- End top-navbar Section -->
    <div class="content-wrapper">
        <div class="examSereenwrapper">
            <div class="examMaincontainer">
                <div class="examLeftpanel reviewScreenleft">
                    <div class="tabMainblock">
                        <div class="examScreentab">
                            <div class="examTabheader">
                                <div class="tablist">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @if(!empty($filtered_subject))
                                        @foreach($filtered_subject as $key=>$sub)
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4  all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true" onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}} <span class="qCount">{{count($all_question_array[$sub->id])}}</span></a>
                                        </li>
                                        @endforeach
                                        @endif
                                        <!--   <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#application">Physics <span class="qCount">65</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#complrehension">Chemistry <span class="qCount">65</span></a>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="reviewexamType">
                                    <a href="javascript:void(0);" style="cursor:default">
                                        {{$exam_name}}
                                    </a>
                                </div>
                            </div>
                            <div class="questionType" style="visibility:hidden">
                                <div class="questionTypeinner">
                                    <div class="questionChoiceType">
                                        <div class="questionChoice"><a class="singleChoice" href="javascript:;">Section A (20Q) - Single Choice</a> <a class="numericalChoice" href="javascript:;">Section B (10Q) - Numerical</a></div>
                                    </div>
                                    <div class="timeCounter">
                                        Average Time:
                                        <div id="progressBar">
                                            <div class="bar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content aect_tabb_contantt">
                                <div id="evaluation" class="tab-pane active">
                                    <div id="review_rques_blk">
                                        <div class="questionsliderinner">
                                            <div class="reviewscreenquestion">
                                                <div class="questionsliderbox">
                                                    <div class="questionwrapper">
                                                        <div class="questionheader">
                                                            <div class="question">
                                                                <span class="q-no">Q1.</span>
                                                                <div class="quesbox">
                                                                    <p>
                                                                        {!! $question_text !!}
                                                                    </p>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <!--  <div class="questionImggraph">

                                                    </div> -->
                                                        <div class="questionOptionBlock">
                                                            <div class="fancy-radio-buttons row with-image">
                                                                @if($template_type==1 || $template_type==2)
                                                                @if(isset($option_data) && !empty($option_data))
                                                                @php $no=0;
                                                                $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
                                                                @endphp

                                                                @foreach($option_data as $key=>$opt_value)
                                                                @php
                                                                /*
                                                                $dom = new DOMDocument();
                                                                @$dom->loadHTML($opt_value);
                                                                $anchor = $dom->getElementsByTagName('img')->item(0);
                                                                $text = isset($anchor)? $anchor->getAttribute('alt') : '';
                                                                $latex = "https://math.now.sh?from=".$text;
                                                                $view_opt='<img src="'.$latex.'" />' ;
                                                                */
                                                                $attemptedByUser=isset($attempt_opt['Answer:'])?$attempt_opt['Answer:']:[];

                                                                if(in_array($key,$answerKeys) && in_array($key,$attemptedByUser)){
                                                                $resp_class= 'correctAnswer';
                                                                }else if(in_array($key,$answerKeys) && !in_array($key,$attemptedByUser)){
                                                                $resp_class= 'correctAnswer';
                                                                }else if(!in_array($key,$answerKeys) && in_array($key,$attemptedByUser)){
                                                                $resp_class= 'incorrectAnswer';
                                                                }else{
                                                                $resp_class= '';
                                                                }
                                                                if(isset($attempt_opt['Answer:']) && in_array($key,$attempt_opt['Answer:'])){
                                                                $checked= "checked";
                                                                }else{
                                                                $checked='';
                                                                }

                                                                @endphp
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}" class="correct" {{$checked}} disabled />
                                                                        <label for="opt1" class="image-bg" for="option_{{$activeq_id}}_{{$key}}"> <span class="seNo">{{$alpha[$no]}}</span> <span class="optionText">{!! !empty($text)?$view_opt:$opt_value; !!}</span> </label>
                                                                    </div>
                                                                </div>
                                                                @php $no++; @endphp
                                                                @endforeach
                                                                @endif
                                                                @elseif($template_type==11)
                                                                @php $attemptedByUser=isset($attempt_opt['Answer:'][0])?$attempt_opt['Answer:'][0]:''; @endphp
                                                                <div class="colMargin">
                                                                    <div class="inputAns">
                                                                        <label for="story">Answer</label>
                                                                        <textarea style="resize:none" placeholder="Answer here" rows="20" name="quest_option_{{$activeq_id}}" id="quest_option_{{$activeq_id}}" cols="40" class="ui-autocomplete-input allownumericwithdecimal" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" disabled>{{$attemptedByUser}}</textarea>
                                                                    </div>
                                                                </div>
                                                                @endif


                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="answer-main-sec">
                                                        <div class="anshead-top">
                                                            <span>Answer:</span>


                                                            <div class="review_expand">
                                                                <div class='percent_btn'><button class="btn btn-ans questionbtn">View details</button></div>
                                                                <div class='expand_block'>
                                                                    <div class="first_screen">

                                                                        <div class="persent_std">
                                                                            <span class="attend">To answer you need to have</span>
                                                                        </div>


                                                                        <div class="attemp_box row mt-0">
                                                                            <div class="sub_att_1 col-md-6">
                                                                                @if(isset($question_data->topic_name) && !empty($question_data->topic_name))
                                                                                <p>Knowledge, Application of</p>
                                                                                <a href="javascript:void(0);" class="detail_btn" style="cursor:default"> {{(isset($question_data->topic_name) && !empty($question_data->topic_name))?$question_data->topic_name:''}}</a>
                                                                                @endif
                                                                                <p>Knowledge, Application of</p>
                                                                                <a href="javascript:void(0);" class="detail_btn" style="cursor:default"> EQUATION OF CIRCLE</a>

                                                                            </div>
                                                                            <div class="sub_att_1 col-md-6">

                                                                                @if(isset($question_data->concept_name) && !empty($question_data->concept_name))
                                                                                <p>Knowledge of</p>
                                                                                <a href="javascript:void(0);" class="detail_btn" style="cursor:default">{{(isset($question_data->concept_name) && !empty($question_data->concept_name))?$question_data->concept_name:''}}</a>
                                                                                @endif

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <label class="expandbtn1" title="Expand">
                                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </label>
                                                            <label class="collapsebtn1" title="Collapse">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                                    <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </label>
                                                        </div>
                                                        <div class="anshead-titletext">
                                                            <p> @php $mn=0; @endphp
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
                                                                @endforeach</p>
                                                        </div>
                                                        <div class="explanation-sec">
                                                            <div class="explanationdeteail">
                                                                @if(isset($question_data->explanation ) && !empty($question_data->explanation ))
                                                                <span>Explanation:</span>
                                                                <p>{!! $question_data->explanation !!}</p>
                                                                @endif
                                                            </div>

                                                        </div>


                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="examRightpanel reviewScreenright ans-panel">
                    <div class="custom-anstop">
                        <p><span>Answer Palette</span></p>
                        <div class="text-exambottom-sec">
                            @php $quKey=1; @endphp
                            @if(isset($all_question_list) && !empty($all_question_list))

                            @foreach($all_question_list as $ke=>$val)
                            @php
                            $key_id=$val->question_id;
                            @endphp


                            @if ($val->attempt_status == 'Correct')
                            <button type="button" class="btn btn-ans" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @elseif ($val->attempt_status == 'Incorrect')
                            <button type="button" class="btn btn-ans red-btn" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @else
                            <button type="button" class="btn btn-ans border-btn" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @endif
                            @php $quKey++; @endphp
                            @endforeach
                            @endif



                        </div>
                    </div>
                    <div class="reviewans-mainsec">
                        <div class="review-filter-top">
                            <span>Review Questions</span>

                            <div id="filterBy">
                                <label class="filter" data-bs-toggle="dropdown" aria-expanded="false" title="Filter">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor:pointer">
                                        <path d="M16.5 2.25h-15l6 7.095v4.905l3 1.5V9.345l6-7.095z" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </label>
                                <ul class="dropdown-menu filterdropdown">
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('all')">All</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Correct')"> Corrected</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Incorrect')"> Wronged</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Unanswered')"> Unattempted</a></li>
                                </ul>
                            </div>

                            




                            <label class="expandbtn" title="Expand">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </label>
                            <label class="collapsebtn" title="Collapse">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </label>
                        </div>
                        <div class="list-ans" id="filter_questions">

                            @php $quKee=1; @endphp
                            @if(isset($all_question_list) && !empty($all_question_list))
                            @foreach($all_question_list as $kee=>$value)
                            @php

                            $key_id=$value->question_id;
                            @endphp
                            @if ($value->attempt_status == 'Correct')
                            <div class="d-flex quistion-2 greenborder-left">
                                <div class="flex-shrink-0" style="padding-left: 16px;">
                                    Q{!! $value->quest_id !!}.
                                </div>
                                <div class="flex-grow-1 ms-3 quistion-content ">
                                    {!! $value->question !!}
                                </div>
                            </div>
                            @elseif ($value->attempt_status == 'Incorrect')
                            <div class="d-flex quistion-1 redborder-left ">
                                <div class="flex-shrink-0" style="padding-left: 16px;">
                                    Q{!! $value->quest_id !!}.
                                </div>
                                <div class="flex-grow-1 ms-3 quistion-content ">
                                    {!! $value->question !!}
                                </div>
                            </div>
                            @else
                            <div class="d-flex quistion-1  ">
                                <div class="flex-shrink-0" style="padding-left: 16px;">
                                    Q{!! $value->quest_id !!}.
                                </div>
                                <div class="flex-grow-1 ms-3 quistion-content ">
                                    {!! $value->question !!}
                                </div>
                            </div>
                            @endif
                            @php $quKee++; @endphp
                            @endforeach
                            @endif


                        </div>
                    </div>
                    <a class="btn bck-btn" href="{{url()->previous()}}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->

 
  <!-- <style> .fancy-radio-buttons .correct input[type="radio"].correct:checked~.image-bg .seNo {background-color: #56b663;color: #ffffff;}.review_expand {position: absolute;top: 5%;right: 70px;}.expand_block {display: none;position: absolute;right: 0;TOP: 0PX;z-index: 999;}.first_screen {padding: 20px 40px !important;border-radius: 8px;box-shadow: 0 8px 30px 0 rgba(157, 170, 160, 0.3);background-color: #fff;min-width: 541px;z-index: 999;}.persent_std {padding-bottom: 40px;}.propt_text {padding: 20px 0;text-align: left;font-size: 14px;color: #2c3348;opacity: .99;}.attemp_box {display: flex;}.sub_att_1 p {font-size: 14px;font-weight: 500;font-stretch: normal;font-style: normal;line-height: normal;letter-spacing: normal;text-align: left;color: #1f1f1f;padding: 0px;margin: 0px;}.attemp_box a {font-size: 14px;font-weight: bold;font-stretch: normal;font-style: normal;line-height: normal;letter-spacing: normal;text-transform: uppercase;width: 100px;text-align: left;cursor: pointer;word-break: break-word;color: #56b663;}.questionsliderbox {position: relative;}.attend {font-size: 14px;font-weight: bold;font-stretch: normal;font-style: normal;line-height: normal;letter-spacing: normal;text-align: left;color: #1f1f1f;}.expandbtn, .expandbtn1 {display: block;cursor: pointer;}.collapsebtn, .collapsebtn1 {display: none;cursor: pointer;}.reviewans-mainsec {position: absolute;bottom: 25px;background: #fff;overflow: hidden;margin-right: 15px;min-width: 335px;max-width: 335px;}.reviewexamType a {font-size: 16px;font-weight: 800;font-stretch: normal;font-style: normal;line-height: 1.6;letter-spacing: normal;text-align: left;color: #1f1f1f;position: absolute;right: 0px;top: 0px;}.reviewScreenleft .examScreentab .nav-tabs .nav-link {padding: 0px 0 12px;}.reviewScreenleft .questionwrapper {max-height: initial;}.reviewScreenleft .questionOptionBlock {padding-top: 45px;}.answer-main-sec {background: #fff;padding: 20px;border-radius: 20px;position: absolute;bottom: 0px;width: 100%;padding-right: 8px;}.anshead-top {display: flex;align-items: center;padding-right: 20px;}.anshead-top .btn.questionbtn {background: #fff !important;}.anshead-top>span {flex-grow: 1;font-size: 16px;font-weight: 800;color: #039855;}.anshead-top>label {padding-left: 20px;}.anshead-titletext p {font-size: 16px;font-weight: 800;color: #1f1f1f;}.explanation-sec {height: 20vh;overflow-y: auto;;padding-left: 135px;}.explanationdeteail>span {font-size: 16px;font-weight: 800;color: #363c4f;padding-bottom: 3px;display: inline-block;}.explanationdeteail>p {margin: 0px;font-size: 16px;font-weight: 500;}.explanation-bottom span {display: block;font-size: 16px;font-weight: 500;color: #363c4f;}.explanation-bottom {padding: 25px 0px;}.custom-anstop>p {margin: 0;padding-bottom: 20px;font-weight: 800;border-bottom: 1px solid rgba(205, 227, 208, 0.5);}.red-btn {background: #d92d20 !important;border: 1px solid #d92d20 !important;}.border-btn {background: #fff !important;color: #56b663 !important;}.review-filter-top {display: flex;padding-bottom: 20px;padding-top: 20px;border-bottom: 1px solid rgba(205, 227, 208, 0.5);}.review-filter-top>span {font-weight: 800;font-size: 16px;flex-grow: 1;}label.filter {padding-right: 20px;}.list-ans {padding-top: 20px;height: 33vh;overflow-y: auto;}.list-ans div {font-size: 16px;font-weight: 500;line-height: 1.4;color: #363c4f;padding-bottom: 10px;position: relative;}.redborder-left:before {content: "";width: 4px;background: #d92d20;position: absolute;height: 66px;border-radius: 20px;}.greenborder-left:before {content: "";width: 4px;background: #56b663;position: absolute;height: 66px;border-radius: 20px;}.bck-btn:hover {cursor: pointer;}.examRightpanel.ans-panel {padding-top: 24px !important;}</style> -->
 

<script type="text/javascript">
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
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, "review_rques_blk"]);

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

<!-----Start-for-percent-btn-click------->
<script>
    $(".percent_btn").click(function(e) {
        $(".expand_block").show();
        e.stopPropagation();
    });

    $(".expand_block").click(function(e) {
        e.stopPropagation();
    });

    $(document).click(function() {
        $(".expand_block").hide();
    });
</script>
<!-----End-for-percent-btn-click------->

<script>
    function review_right_Height() {
        var total_right_height = $(".reviewScreenright ").outerHeight();
        $('.reviewScreenleft ').css('height', total_right_height);
        $('.examScreentab ').css('height', total_right_height);
        var examTabheader_height = $(".examTabheader").outerHeight();
        var questionType_height = $(".questionType").outerHeight();
        var topheader_height = examTabheader_height + questionType_height;
        var cal_height = total_right_height - topheader_height;
        $('.tab-content ').css('height', cal_height);
        $('.questionsliderbox').css('height', cal_height);
        var answer_main_sec_height = $(".answer-main-sec ").outerHeight();
        var question_slider_box_height = $(".questionsliderbox").outerHeight();
        var mid_section_height = question_slider_box_height - answer_main_sec_height;
        $('.questionwrapper ').css('height', mid_section_height);
    }

    review_right_Height();
    $("window").load(function() {
        review_right_Height();
    });


    $(window).resize(function() {
        review_right_Height();
    });
</script>
<script>
    $(document).ready(function() {
        $(".expandbtn1").on('click', function() {
            var expand_question_slider_box_height = $(".questionsliderbox").outerHeight();
            var questionheader_height = $(".questionheader").outerHeight();

            $('.answer-main-sec').css('height', expand_question_slider_box_height);
            var expand_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var final_height = expand_answer_main_sec_height - questionheader_height;
            $('.answer-main-sec').css('height', final_height);



            var ex_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var expand_anshead_titletext_height = $(".anshead-titletext").outerHeight();
            var expand_anshead_top_height = $(".anshead-top").outerHeight();
            var expand_totalpopup_height = expand_anshead_titletext_height + expand_anshead_top_height;
            var expand_height_popupSection = ex_answer_main_sec_height - expand_totalpopup_height;
            $('.explanation-sec').css('height', expand_height_popupSection);

            var ex_answer_main_sec_height_final = $(".explanation-sec").outerHeight();


            var ex_scroll_height = ex_answer_main_sec_height_final - 120 + "px";
            $('.explanation-sec').css('height', ex_scroll_height);




        });

        $(".collapsebtn1").on('click', function() {
            var coll_questionsliderbox_height = $(".questionsliderbox").outerHeight();
            var coll_questionwrapper_height = $(".questionwrapper").outerHeight();
            var coll_final_height = coll_questionsliderbox_height - coll_questionwrapper_height;
            $('.answer-main-sec').css('height', coll_final_height);
            var coll_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var coll_expand_anshead_titletext_height = $(".anshead-titletext").outerHeight();
            var coll_expand_anshead_top_height = $(".anshead-top").outerHeight();
            var coll_totalpopup_height = coll_expand_anshead_titletext_height + coll_expand_anshead_top_height;
            var coll_height_popupSection = coll_answer_main_sec_height - coll_totalpopup_height;
            $('.explanation-sec').css('height', coll_height_popupSection);
            var coll_answer_main_sec_height_final = $(".explanation-sec").outerHeight();
            var coll_scroll_height = coll_answer_main_sec_height_final - 60 + "px";
            $('.explanation-sec').css('height', coll_scroll_height);


        });
    });
</script>


<!-----Start__Right_Review_Height_Calculation------->
<script>
    function review_right_Height() {
        var review_Screen_right_height = $(".reviewScreenright").outerHeight();
        var test_review_height_div = review_Screen_right_height / 2;
        $('.custom-anstop').css('height', test_review_height_div);
        $('.reviewans-mainsec').css('height', test_review_height_div);
    }

    review_right_Height();
    $("window").load(function() {
        review_right_Height();
    });


    $(window).resize(function() {
        review_right_Height();
    });
</script>

<script>
    $(document).ready(function() {
        $(".expandbtn").on('click', function() {
            var review_Screen_right_height = $(".reviewScreenright").outerHeight();
            var review_ans_mainsec_heigth = $(".reviewans-mainsec").outerHeight();
            var custom_ans_top_heigth = $(".custom-anstop").outerHeight();
            var review_filter_top_height = $(".review-filter-top").outerHeight();
            var list_ans_height = $(".list-ans").outerHeight();
            var calculated_height = review_Screen_right_height - review_ans_mainsec_heigth;
            var onclick_review_box = custom_ans_top_heigth + calculated_height;
            $('.reviewans-mainsec').css('height', onclick_review_box);
            var afterExpandtotalheight = $(".reviewScreenright").outerHeight();
            var min_height_q_list_h = afterExpandtotalheight - 122 + "px";
            $('.reviewans-mainsec').css('height', min_height_q_list_h);
            var reviewans_final_height = $(".reviewans-mainsec").outerHeight();
            var scroll_height = reviewans_final_height - review_filter_top_height;
            var scroll_height_20 = scroll_height - 20 + "px";
            $('.list-ans').css('height', scroll_height_20)
        });

        $(".collapsebtn").on('click', function() {
            var review_ans_mainsec_heigth = $(".reviewans-mainsec").outerHeight();
            var custom_ans_top_heigth = $(".custom-anstop").outerHeight();
            var onclick_review_box2 = review_ans_mainsec_heigth - custom_ans_top_heigth;
            var clickcollapesbtn = onclick_review_box2 + 122 + "px";
            $('.reviewans-mainsec').css('height', clickcollapesbtn);
            var coll_outer_height = $(".reviewans-mainsec").outerHeight();
            var coll_review_filter_to_height = $(".review-filter-top").outerHeight();
            var coll_review_divide_height = coll_outer_height - coll_review_filter_to_height;
            var coll_scroll_final_height = coll_review_divide_height - 20 + "px";
            $('.list-ans').css('height', coll_scroll_final_height)
        });
    });
</script>

<!-----End__Right_Review_Height_Calculation------->
<!-----Start-for-expand-btn-click------->
<script>
    $('.expandbtn').on('click', function() {
        $('.collapsebtn').css({
            display: "block"
        });
        $('.expandbtn').css({
            display: "none"
        });
    });

    $('.collapsebtn').on('click', function() {
        $('.collapsebtn').css({
            display: "none"
        });
        $('.expandbtn').css({
            display: "block"
        });
    });

    $('.expandbtn1').on('click', function() {
        $('.collapsebtn1').css({
            display: "block"
        });
        $('.expandbtn1').css({
            display: "none"
        });
    });

    $('.collapsebtn1').on('click', function() {
        $('.collapsebtn1').css({
            display: "none"
        });
        $('.expandbtn1').css({
            display: "block"
        });
    });
</script>
<!-----end-for-expand-btn-click------->


<script>
    if ($(window).height() < 900) {
        body {
            background - color: red;
        }

    } else {
        // change functionality for larger screens
    }
</script>
@endsection