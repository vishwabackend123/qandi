@extends('afterlogin.layouts.app_new')

@section('content')

<script type="text/javascript">
    /* check browser tab refreshed or reload */
    if (window.performance) {
        console.info("window.performance works fine on this browser");
    }
    console.info(performance.navigation.type);
    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
        console.info("This page is reloaded");
        window.location = "{{url('previous_year_exam')}}";
    } else {
        console.info("This page is not reloaded");
    }
    /* check browser tab changed or not */

    document.addEventListener('visibilitychange', function() {

        $endExamCheck = $('#endExam').hasClass('show');
        if ((document.visibilityState == 'hidden') && $endExamCheck == false) {
            $(".examModal").modal('hide');

            stop();
        }
    });
    $(window).load(function() {
        $("#endExam").modal({
            backdrop: "static",
            keyboard: false
        });
        $("#FullTest_Exam_Panel_Interface_A").modal({
            backdrop: "static",
            keyboard: false
        });
    });
</script>
@php
$userData = Session::get('user_data');
@endphp
@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
$template_type = isset($question_data->template_type)?$question_data->template_type:'';
$difficulty_level = isset($question_data->difficulty_level)?$question_data->difficulty_level:1;
$section_id = isset($question_data->section_id)?$question_data->section_id:'';
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
<div class="exam-wrapper testscreenmob">
    <div class="content-wrapper">
        <div class="examSereenwrapper">
            <div class="examMaincontainer" id="myTabContent">

                <input type="hidden" id="current_question" value="{{$activeq_id}}" />
                <input type="hidden" id="current_question_type" value="{{$template_type}}" />
                <input type="hidden" id="current_question_no" value="1" />
                <input type="hidden" id="current_chapter_id" value="{{$chapter_id}}" />
                <input type="hidden" id="current_subject_id" value="{{$subject_id}}" />
                <input type="hidden" id="current_section_id" value="{{$section_id}}" />




                <div class="examLeftpanel examLeftpanelmob">
                    <div class="tabMainblock">
                        <div class="examScreentab">
                            <div class="examTabheader">
                                <div class="tablist">
                                    <ul class="nav nav-tabs mobilescrolltab" role="tablist" id="myTab">
                                        @if(!empty($filtered_subject))
                                        @foreach($filtered_subject as $key=>$sub)
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4 all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif " id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" @if(count($filtered_subject)>1) onclick="get_subject_question('{{$sub->id}}')" @endif >{{$sub->subject_name}}</a>
                                            <span class="qCount qcountout qcountout_{{$sub->id}} @if($activesub_id==$sub->id) countActive @endif">{{$sub->count}}</span>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="submitBtn">
                                    <form id="form_exam_submit" action="{{route('exam_result')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="fulltime" value="{{gmdate('H:i:s',$exam_fulltime*60)}}">
                                        <input type="hidden" name="submit_time" id="final_submit_time" value="">
                                        <input type="hidden" name="total_marks" id="total_marks" value="{{$total_marks}}">
                                        <input type="hidden" name="test_type" value="{{$test_type}}">
                                        <input type="hidden" name="exam_type" value="{{$exam_type}}">
                                        <input type="hidden" name="planner_id" value="{{isset($planner_id)?$planner_id:0}}">
                                        <input type="hidden" name="exam_mode" value="{{isset($exam_mode)?$exam_mode:''}}">
                                        <input type="hidden" name="py_paperid" value="{{isset($paper_id)?$paper_id:0}}">

                                        <button class="btn submitBtnlink" id="submitExam" onclick="stop('submit');">
                                            <span class="btnText">Submit Test</span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z" fill="#fff" />
                                                </svg>
                                            </span>
                                        </button>
                                        <!--  <a href="{{route('examresult')}}" class="btn btn-danger rounded-0 px-5 my-5">SEE ANALYTICS</a> -->
                                    </form>

                                </div>
                            </div>
                            <div id="question_section">
                                <div class="questionType">
                                    <div class="questionTypeinner">
                                        <div class="questionChoiceType">
                                            <div class="questionChoice">
                                                @if(isset($aSections) && !empty($aSections))
                                                @foreach($aSections as $sKey=>$section)
                                                @if(isset($aSubSecCount[$subject_id][$section->id]) && $aSubSecCount[$subject_id][$section->id] > 0)
                                                <a class="singleChoice @if($sKey==0) single_Choice_active @endif" href="javascript:;" onclick="get_subject_Sec_question('{{$subject_id}}','{{$section->id}}')">{{$section->section_name}} ({{$aSubSecCount[$subject_id][$section->id]."Q"}}) - {{$section->question_type_name}}</a>

                                                @endif
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="timeCounter">
                                            <div id="counter_{{$activeq_id}}" class="counter  d-flex">
                                                <span id="avg_text" class="avg-time">Average Time:</span>
                                                <div id="progressBar_{{$activeq_id}}" class="progressBar_first tiny-green ms-2">
                                                    <span class="seconds" id="seconds_{{$activeq_id}}"></span>
                                                    <div id="percentBar_{{$activeq_id}}"></div>
                                                </div>
                                                <div class="time_taken_css" id="q_time_taken_first" style="display:none;">
                                                    <span>Time taken: </span><span id="up_minutes"></span>:<span id="up_seconds"></span>mins
                                                </div>
                                            </div>
                                            <input type="hidden" name="question_spendtime" class="timespend_first" id="timespend_{{ $activeq_id }}" value=" " />
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content aect_tabb_contantt">
                                    <div id="evolution" class="tab-pane active">

                                        <div class="questionsliderinner">
                                            <div class="questionSlider1">
                                                <div class="item" id="">
                                                    <div class="questionsliderbox">
                                                        <div class="questionwrapper">

                                                            <div class="questionheader">
                                                                <div class="question">
                                                                    <span class="q-no">Q1.</span>
                                                                    <!-- <p>{!! $question_text !!}
                                                                    </p> -->
                                                                    <div class="quesbox">
                                                                        <p>{!! $question_text !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="questionImggraph">
                                                            </div>
                                                            <div class="questionOptionBlock">
                                                                <div class="fancy-radio-buttons row with-image">

                                                                    @if($template_type==1 || $template_type==2)
                                                                    @if(isset($option_data) && !empty($option_data))
                                                                    @php $no=0; @endphp
                                                                    @foreach($option_data as $key=>$opt_value)
                                                                    @php
                                                                    $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
                                                                    /* $dom = new DOMDocument();
                                                                    @$dom->loadHTML($opt_value);
                                                                    $anchor = $dom->getElementsByTagName('img')->item(0);
                                                                    $text = isset($anchor)? $anchor->getAttribute('alt') : '';
                                                                    $latex = "https://math.now.sh?from=".$text;
                                                                    $view_opt='<img src="'.$latex.'" />' ; */
                                                                    @endphp

                                                                    <div class="colMargin">
                                                                        <div class="image-container markerDiv">
                                                                            <input class="correct quest_option_{{$activeq_id}} checkboxans" type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}" onclick="checkResponse('{{$activeq_id}}')" />
                                                                            <label for="option_{{$activeq_id}}_{{$key}}" class="image-bg"> <span class="seNo">{{$alpha[$no]}}</span> <span class="optionText">{!! $opt_value !!}</span> </label>
                                                                        </div>
                                                                    </div>
                                                                    @php $no++; @endphp
                                                                    @endforeach
                                                                    @endif
                                                                    @elseif($template_type==11)

                                                                    <div class="colMargin">
                                                                        <div class="inputAns">
                                                                            <label for="story">Answer</label>
                                                                            <textarea style="resize:none" placeholder="Answer here" rows="20" name="quest_option_{{$activeq_id}}" id="quest_option_{{$activeq_id}}" cols="40" class="ui-autocomplete-input allownumericwithdecimal" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" onchange="checkResponse('{{$activeq_id}}')">{{isset($aGivenAns[0])?$aGivenAns[0]:''}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    @endif


                                                                    <span class="qoption_error text-danger" id="qoption_err_{{$activeq_id}}"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="examQuestionarrow">
                                                <!-- Previous button -->

                                                <button type="button" class="qprev quest_btn {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')" {{empty($prev_qid)?'disabled':''}}>
                                                    <span class=" Previous">‹</span>
                                                </button>


                                                <!-- Next button -->

                                                <button type="button" class="qnext quest_btn {{empty($next_qid)?'disabled':''}}" {{empty($next_qid)?'disabled':''}} id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')">
                                                    <span class="Next">›</span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <div id="application" class="tab-pane">adasdas</div>
                                <div id="complrehension" class="tab-pane">complrehension</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btnbottom hideonmobile">
                        <div class="questionbtnBlock">
                            <div class="questionLeftbtns">
                                <button class="btn questionbtn quesBtn" onclick="markforreview()">Mark for Review</button>
                                <button id="clearBtn_response" class="btn questionbtn Clearbtn quesBtn" disabled onclick="clearResponse()">Clear Response</button>
                            </div>
                            <div class="questionRightbtns">
                                <button class="btn questionbtn quesBtn" onclick="savemarkreview()">Save & Mark for Review</button>
                                <button id="saveNext" class="btn questionbtn quesBtns" onclick="saveAnswer()">Save & Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btnformobietest hideondesktop">
                    <div class="btnbottom">
                        <div class="questionbtnBlock">
                            <button class="btn questionbtn quesBtn" onclick="savemarkreview()">Save & Mark for Review</button>
                            <button id="saveNext" class="btn questionbtn quesBtns" onclick="saveAnswer()">Save & Next</button>
                            <button id="clearBtn_response" class="btn questionbtn Clearbtn quesBtn" disabled onclick="clearResponse()">Clear Response</button>
                            <button class="btn questionbtn quesBtn markReviwebtn" onclick="markforreview()">Mark for Review</button>
                            <!-- <button class="btn questionbtn Clearbtn disabled quesBtn" onclick="clearResponse()">Clear Response</button> -->


                        </div>
                    </div>
                </div>
                <div class="overlaydiv"></div>

                <div class="examRightpanel examRightpanelmob">
                    <div class="main-textexam-sec">
                        <div class="text-examtop-sec hideonmobile d-flex align-items-center justify-content-between">
                            <div id="app" class="me-4 pe-2 mb-2">
                                <div class="base-timer">
                                    <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <g class="base-timer__circle">
                                            <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                                            <path id="base-timer-path-remaining" stroke-dasharray="283" class="base-timer__path-remaining arc" d="
                                     M 50, 50
                                     m -45, 0
                                     a 45,45 0 1,0 90,0
                                     a 45,45 0 1,0 -90,0
                                     "></path>
                                        </g>
                                    </svg>
                                    <img class="watch-icon" src="{{URL::asset('public/after_login/images/timer_Exam_page_ic@2x.png')}}" />
                                </div>
                            </div>
                            <!-- <svg width="70" height="70" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path id="base-timer-path-remaining" opacity=".1" d="M20 40c11.046 0 20-8.954 20-20S31.046 0 20 0 0 8.954 0 20s8.954 20 20 20z" fill="#363C4F" />
                                    <path d="M31.896 32.835A17.503 17.503 0 1 1 20 2.5V20l11.896 12.835z" fill="#44CD7F" />
                                    <path d="M20 32.683c7.005 0 12.683-5.678 12.683-12.683 0-7.004-5.678-12.683-12.683-12.683S7.317 12.996 7.317 20c0 7.005 5.678 12.683 12.683 12.683z" fill="#EBEBED" />
                                    <path d="M20 26.41a6.19 6.19 0 1 0 0-12.38 6.19 6.19 0 0 0 0 12.38z" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20 17.582v2.457h1.638M15.905 12.668l-2.252 1.638M24.095 12.668l2.252 1.638" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg> -->
                            <span id="base-timer-label" class="base-timer__label"> Left</span>
                            <button type="button" class="btn stop" onclick="stop();">
                                <label>
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="14" cy="14" r="8.4" fill="#fff" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2 14a11.2 11.2 0 1 1-22.4 0 11.2 11.2 0 0 1 22.4 0zM9.8 11.2a1.4 1.4 0 1 1 2.8 0v5.6a1.4 1.4 0 0 1-2.8 0v-5.6zm7-1.4a1.4 1.4 0 0 0-1.4 1.4v5.6a1.4 1.4 0 0 0 2.8 0v-5.6a1.4 1.4 0 0 0-1.4-1.4z" fill="#00AB16" />
                                    </svg>
                                </label>
                            </button>
                            <button type="button" class="btn start" onclick="start();" style="display: none">
                                <label>
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="14" cy="14" r="8.4" fill="#fff" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2 14a11.2 11.2 0 1 1-22.4 0 11.2 11.2 0 0 1 22.4 0zM9.8 11.2a1.4 1.4 0 1 1 2.8 0v5.6a1.4 1.4 0 0 1-2.8 0v-5.6zm7-1.4a1.4 1.4 0 0 0-1.4 1.4v5.6a1.4 1.4 0 0 0 2.8 0v-5.6a1.4 1.4 0 0 0-1.4-1.4z" fill="#00AB16" />
                                    </svg>
                                </label>
                            </button>
                        </div>
                        <div class="text-exammid-sec borederbot">
                            <p>Overview</p>
                            <div class="overviewtest">
                                <div class="exam-ans-sec top-first">
                                    <div class="ans1">Answered</div>
                                    <div class="ans-in-num" id="ans_cnt">0</div>
                                </div>
                                <div class="exam-ans-sec">
                                    <div class="ans2">Unanswered</div>
                                    <div class="ans-in-num" id="unans_cnt">{{$exam_ques_count}}</div>
                                </div>
                                <div class="exam-ans-sec">
                                    <div class="ans3">Marked for Review</div>
                                    <div class="ans-in-num" id="rev_cnt">0</div>
                                </div>
                                <div class="exam-ans-sec">
                                    <div class="ans4">Answered &amp; marked for Review</div>
                                    <div class="ans-in-num" id="ans_rev_cnt">0</div>
                                </div>
                            </div>
                        </div>

                        <div class="text-exambottom-sec">
                            <!-- <button type="button" class="btn" id="btn-ans">1</button>
                            <button type="button" class="btn pink-btn" id="btn-ans">11</button>
                            <button type="button" class="btn blue-btn" id="btn-ans">18</button>
                            <button type="button" class="btn border-btn" id="btn-ans">23</button> -->
                            @if(isset($keys) && !empty($keys))
                            @foreach($keys as $ke=>$val)
                            <button type="button" class="next_button btn btn-ans border-btn " id="btn_{{$val}}" onclick="qnext('{{$val}}')">{{$ke+1}}</button>


                            @endforeach
                            @endif

                        </div>

                        <div class="custom-exam d-none">
                            <div class="text-examtop-sec">
                                <p>
                                    <svg width="70" height="70" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity=".1" d="M20 40c11.046 0 20-8.954 20-20S31.046 0 20 0 0 8.954 0 20s8.954 20 20 20z" fill="#363C4F" />
                                        <path d="M31.896 32.835A17.503 17.503 0 1 1 20 2.5V20l11.896 12.835z" fill="#44CD7F" />
                                        <path d="M20 32.683c7.005 0 12.683-5.678 12.683-12.683 0-7.004-5.678-12.683-12.683-12.683S7.317 12.996 7.317 20c0 7.005 5.678 12.683 12.683 12.683z" fill="#EBEBED" />
                                        <path d="M20 26.41a6.19 6.19 0 1 0 0-12.38 6.19 6.19 0 0 0 0 12.38z" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20 17.582v2.457h1.638M15.905 12.668l-2.252 1.638M24.095 12.668l2.252 1.638" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>112 mins Left</span>
                                    <label>
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="14" cy="14" r="8.4" fill="#fff" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2 14a11.2 11.2 0 1 1-22.4 0 11.2 11.2 0 0 1 22.4 0zM9.8 11.2a1.4 1.4 0 1 1 2.8 0v5.6a1.4 1.4 0 0 1-2.8 0v-5.6zm7-1.4a1.4 1.4 0 0 0-1.4 1.4v5.6a1.4 1.4 0 0 0 2.8 0v-5.6a1.4 1.4 0 0 0-1.4-1.4z" fill="#00AB16" />
                                        </svg>
                                    </label>
                                </p>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="bck-btn"><a href="javascript:;"> Back</a></div> -->
                </div>
                <div class="btn123 hideondesktop">
                    <div class="text-examtop-sec d-flex align-items-center ">
                        <div id="app" class="me-4 pe-2 mb-2">
                            <div class="base-timer">
                                <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <g class="base-timer__circle">
                                        <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                                        <path id="base-timer-path-remaining" stroke-dasharray="283" class="base-timer__path-remaining arc" d="
                                    M 50, 50
                                    m -45, 0
                                    a 45,45 0 1,0 90,0
                                    a 45,45 0 1,0 -90,0
                                    "></path>
                                    </g>
                                </svg>
                                <img class="watch-icon" src="{{URL::asset('public/after_login/images/timer_Exam_page_ic@2x.png')}}" />
                            </div>
                        </div>

                        <span id="base-timer-label" class="base-timer__label"> Left</span>
                        <button type="button" class="btn stop" onclick="stop();">
                            <label>
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="14" cy="14" r="8.4" fill="#fff" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2 14a11.2 11.2 0 1 1-22.4 0 11.2 11.2 0 0 1 22.4 0zM9.8 11.2a1.4 1.4 0 1 1 2.8 0v5.6a1.4 1.4 0 0 1-2.8 0v-5.6zm7-1.4a1.4 1.4 0 0 0-1.4 1.4v5.6a1.4 1.4 0 0 0 2.8 0v-5.6a1.4 1.4 0 0 0-1.4-1.4z" fill="#00AB16" />
                                </svg>
                            </label>
                        </button>
                        <button type="button" class="btn start" onclick="start();" style="display: none">
                            <label>
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="14" cy="14" r="8.4" fill="#fff" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2 14a11.2 11.2 0 1 1-22.4 0 11.2 11.2 0 0 1 22.4 0zM9.8 11.2a1.4 1.4 0 1 1 2.8 0v5.6a1.4 1.4 0 0 1-2.8 0v-5.6zm7-1.4a1.4 1.4 0 0 0-1.4 1.4v5.6a1.4 1.4 0 0 0 2.8 0v-5.6a1.4 1.4 0 0 0-1.4-1.4z" fill="#00AB16" />
                                </svg>
                            </label>
                        </button>

                    </div>
                    <button type="button" class="showyes bottomfixarrow"><span class="Previous">‹</span></button>
                    <button class="hideyes bottomfixarrow"><span class="Previous">‹</span></button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade examModal" id="FullTest_Exam_Panel_Interface_A" tabindex="-1" role="dialog" aria-labelledby="FullTest_Exam_Panel_Interface_A" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content exammodal_content">
                <div class="modal-body">
                    <div class="modal-header-exam">
                        <div class="exam-overview">
                            <label>Exam Overview</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-center exam-overview-time">
                            <div class="base-timer">
                                <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <g class="base-timer__circle">
                                        <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                                        <path id="base-timer-path-remaining_alt" stroke-dasharray="283" class="base-timer__path-remaining arc" d="
                                     M 50, 50
                                     m -45, 0
                                     a 45,45 0 1,0 90,0
                                     a 45,45 0 1,0 -90,0
                                     "></path>
                                    </g>
                                </svg>
                                <img class="watch-icon" src="{{URL::asset('public/after_login/images/timer_Exam_page_ic.png')}}" />
                            </div>
                            <!-- <label><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity=".1" d="M20 40c11.046 0 20-8.954 20-20S31.046 0 20 0 0 8.954 0 20s8.954 20 20 20z" fill="#363C4F" />
                                    <path d="M31.896 32.835A17.503 17.503 0 1 1 20 2.5V20l11.896 12.835z" fill="#44CD7F" />
                                    <path d="M20 32.683c7.005 0 12.683-5.678 12.683-12.683 0-7.004-5.678-12.683-12.683-12.683S7.317 12.996 7.317 20c0 7.005 5.678 12.683 12.683 12.683z" fill="#EBEBED" />
                                    <path d="M20 26.41a6.19 6.19 0 1 0 0-12.38 6.19 6.19 0 0 0 0 12.38z" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20 17.582v2.457h1.638M15.905 12.668l-2.252 1.638M24.095 12.668l2.252 1.638" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </label> -->
                            <span><span id="lefttime_pop_s"> </span> Left</span>
                        </div>
                    </div>
                    <div class="exam-ans-sec top-first">
                        <div class="ans1">Answered</div>
                        <div class="ans-in-num" id="ans_cnt_2">0</div>
                    </div>
                    <div class="exam-ans-sec">
                        <div class="ans2">Unanswered</div>
                        <div class="ans-in-num" id="unans_cnt_2">{{$exam_ques_count}}</div>
                    </div>
                    <div class="exam-ans-sec">
                        <div class="ans3">Marked for Review</div>
                        <div class="ans-in-num" id="rev_cnt_2">0</div>
                    </div>
                    <div class="exam-ans-sec">
                        <div class="ans4">Answered & Marked for Review</div>
                        <div class="ans-in-num" id="ans_rev_cnt_2">0</div>
                    </div>
                    <div class="exam_text_content">
                        No changes will be allowed after submission. Are you sure you want to submit test for final marking?
                    </div>
                    <div class="exam-footer-sec">
                        <div class="task-btn tasklistbtn">
                            <button class="btn btn-common-transparent nobg reviewbtn" data-bs-dismiss="modal" onclick="start()">Back To test</button>
                            <button id="bt-modal-confirm" class="btn btn-common-green"> Submit Test <label><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z" fill="#fff" />
                                    </svg>
                                </label>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade examModal" id="endExam" tabindex="-1" role="dialog" aria-labelledby="endExam" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content exammodal_content">
                <div class="modal-body">
                    <div class="modal-header-exam text-center ">
                        <div class="exam-overview ">
                            <label>Exam Time Over</label>
                        </div>

                    </div>
                    <div class="exam-footer-sec  p-4">
                        <div class="task-btn tasklistbtn text-center">
                            <button id="bt-modal-confirm_over" class="btn btn-common-green"> Submit Test <label><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z" fill="#fff" />
                                    </svg>
                                </label>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade examModal" id="resume-test" tabindex="-1" role="dialog" aria-labelledby="resume-test" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content exammodal_content">
                <div class="modal-body">
                    <div class="modal-header-exam text-center ">
                        <div class="exam-overview ">
                            <label>Exam Paused</label>
                        </div>
                    </div>
                    <div class="exam-footer-sec  p-4">
                        <div class="task-btn tasklistbtn text-center">
                            <button id="bt-modal-cancel" onclick="start();" class="btn btn-common-green" data-bs-dismiss="modal"> Resume <label><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z" fill="#fff" />
                                    </svg>
                                </label>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade examModal" id="attemptlimit" tabindex="-1" aria-labelledby="exampleModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content exammodal_content">
                <div class="modal-body">
                    <div class="modal-header-exam text-center ">
                        <div class="exam-overview ">
                            <label id="attempt-alert-text">Exam Paused</label>
                        </div>
                    </div>
                    <div class="exam-footer-sec  p-4">
                        <div class="task-btn tasklistbtn text-center">
                            <button id="bt-modal-cancel" onclick="start();" class="btn btn-common-green" data-bs-dismiss="modal"> Ok <label><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z" fill="#fff" />
                                    </svg>
                                </label>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('.questionSlider').owlCarousel({

        loop: false,
        margin: 0,
        nav: true,
        dots: false,
        items: 1,

    })
</script>

<!-- @ include('afterlogin.layouts.footer_new') -->
@include('afterlogin.layouts.exam_footer')

<!-- page referesh disabled -->
<script>
    var activeques_id = '{{$activeq_id}}';

    var saveArr = [];
    var markForReviewArr = [];
    var saveMarkReviewArr = [];
    var totalQCount = '{{$exam_ques_count}}';

    /* Allow only numeric with decimal */
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        //this.value = this.value.replace(/[^0-9\.]/g,'');

        $(this).val($(this).val().replace(/(?!^-)[^0-9.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 45 || event.which > 57 || event.which == 47)) {
            event.preventDefault();
        }
        var text = $(this).val();
        if ((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 2) && (event.which != 0 && event.which != 8) && ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
        }

        if (event.charCode === 46) {
            // if dot is the first symbol
            if (event.target.value.length === 0) {
                event.preventDefault();
                return;
            }

            // if there are dots already 
            if (event.target.value.indexOf('.') !== -1) {
                event.preventDefault();
                return;
            }

        }
    });
    /* Sachin screen changes */
    function setboxHeight() {
        var height = $(".rightSect .flex-column").outerHeight();
        $('.cust-tab-content').css('height', height);

    }
    /*  setboxHeight();
     $("window").load(function() {
         setboxHeight();
     }); */

    $(window).resize(function() {
        setboxHeight();
    });
    /* /Sachin screen changes */

    /* page referesh disabled */
    $(document).ready(function() {

        /* mouse rightclick */
        /*  document.oncontextmenu = function() {
             return false;
         };

         $(document).mousedown(function(e) {
             if (e.button == 2) {

                 return false;
             }
             return true;
         }); */
        /* mouse rightclick */

        document.onkeydown = function(e) {
            // disable F12 key
            if (e.keyCode == 123 || e.keyCode == 116) {
                return false;
            }
            /* Ctrl+A */
            if (e.keyCode == 65 && e.ctrlKey) {

                return false;
            }
            /* Ctrl+R */
            if (e.keyCode == 82 && e.ctrlKey) {

                return false;
            }

            // disable ctrl+shift+I key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                return false;
            }

            // disable ctrl+shift+J key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                return false;
            }

            // disable ctrl+U key
            if (e.ctrlKey && e.keyCode == 85) {
                return false;
            }

            // disable ctrl+P key
            if (e.ctrlKey && e.keyCode == 80) {
                return false;
            }
        }
        $('#quest_option_' + activeques_id).focus();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
    });
</script>
<!-- browser back disable -->
<script type="text/javascript">
    $(window).on('load', function() {
        $('#test_instruction').modal('show');
        setboxHeight();
        startTimer();
        questionstartTimer();
        setEachQuestionTime();
        if ($('#quest_option_' + activeques_id).length > 0) {
            $('#quest_option_' + activeques_id).focus();
        }
    });
    /* 
            $('#goto-exam-btn').click(function() {
                $('#mainDiv').show();
                $('#exam_content_sec').show();
               
            }); */
    $('.selctbtn').click(function() {
        $('.qoption_error').hide();
    });

    jQuery(function() {
        jQuery(".markerDiv").click(function() {
            var template_type = $("#current_question_type").val();
            if (template_type == 2) {

                $('input[type=radio]', this).prop("checked", true);
            } else {
                var $checks = $(this).find('input[type=checkbox]');

                $checks.prop("checked", !$checks.is(":checked"));

            }
        });
    });

    $(document).on('keydown', function(e) {
        if ($(document.activeElement).is('button') && (e.keyCode === 13 || e.keyCode === 32))
            e.preventDefault();
    });
    /*$('.instructions').slimscroll({
        height: '33vh',
        color: '#ff9999',
        railVisible: true,
         alwaysVisible: true 
    });*/


    const FULL_DASH_ARRAY = 283;
    const RESET_DASH_ARRAY = `-57 ${FULL_DASH_ARRAY}`;

    //All buttons
    let startBtn = document.querySelector(".start");
    let stopBtn = document.querySelector(".stop");
    let resetBtn = document.querySelector(".reset");

    //DOM elements
    let timer = document.querySelector("#base-timer-path-remaining");
    let timeLabel = document.getElementById("base-timer-label");

    //Time related vars
    const TIME_LIMIT = '{{$exam_fulltime*60}}'; //in seconds
    let timePassed = -1;
    let timeLeft = TIME_LIMIT;
    let timerInterval = null;


    function reset() {
        clearInterval(timerInterval);
        resetVars();
        startBtn.innerHTML = "Start";
        timer.setAttribute("stroke-dasharray", RESET_DASH_ARRAY);
    }

    function start(withReset = false) {
        setDisabled(startBtn);
        removeDisabled(stopBtn);
        $(".stop").show();
        $(".start").hide();
        if (withReset) {
            resetVars();
        }
        startTimer();
        questionstartTimer();
        setEachQuestionTime();
        $('body').removeClass("make_me_blue");

    }

    function stop(type = '') {
        setDisabled(stopBtn);
        removeDisabled(startBtn);
        $(".stop").hide();
        $(".start").show();
        // startBtn.innerHTML = "Continue";
        clearInterval(timerInterval);
        clearInterval(timer_countdown);
        clearInterval(setEachQuestionTimeNext_countdown);
        if (type !== 'submit') {
            $("#resume-test").modal("show");
            $('body').addClass("make_me_blue");

        }
    }



    function startTimer() {
        timerInterval = setInterval(() => {
            timePassed = timePassed += 1;
            timeLeft = TIME_LIMIT - timePassed;
            $('#final_submit_time').val(timePassed);
            timeLabel.innerHTML = formatTime(timeLeft);
            setCircleDasharray();

            if (timeLeft === 0) {

                timeIsUp();
            }
        }, 1000);
    }

    window.addEventListener("load", () => {
        // startTimer();
        timeLabel.innerHTML = formatTime(TIME_LIMIT);
        // setDisabled(stopBtn);
    });

    //---------------------------------------------
    //HELPER METHODS
    //---------------------------------------------
    function setDisabled(button) {
        button.setAttribute("disabled", true);
    }

    function removeDisabled(button) {
        button.removeAttribute("disabled");
    }

    function timeIsUp() {

        /*  setDisabled(startBtn);
         removeDisabled(stopBtn); */
        clearInterval(timerInterval);
        $('#endExam').modal('show');

        /* let confirmReset = confirm("Time is UP! Wanna restart?");
        if (confirmReset) {
            reset();
            startTimer();
        } else {
            reset();
        } */
    }

    function resetVars() {
        // removeDisabled(startBtn);
        // setDisabled(stopBtn);
        timePassed = -1;
        timeLeft = TIME_LIMIT;


        timeLabel.innerHTML = formatTime(TIME_LIMIT);
    }

    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;

        if (seconds < 10) {
            seconds = `0${seconds}`;
        }

        return `${minutes} min ${seconds} sec`;
    }

    function calculateTimeFraction() {
        const rawTimeFraction = timeLeft / TIME_LIMIT;
        return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
    }

    function setCircleDasharray() {
        const circleDasharray = `${(
                calculateTimeFraction() * FULL_DASH_ARRAY
            ).toFixed(0)} 283`;

        timer.setAttribute("stroke-dasharray", circleDasharray);
    }

    /* per question timer */
    /*  var setEachQuestionTimeNext_countdown;
     var totalSeconds = -1;

     function setEachQuestionTime() {
         setEachQuestionTimeNext_countdown = setInterval(function() {
             ++totalSeconds;
             $('.timespend_first').val(totalSeconds);


         }, 1000);
     } */
    /* per question timer */
    var time_allowed = '{{(isset($question_data->time_allowed) && $question_data->time_allowed>0)?$question_data->time_allowed:1}}';
    var fsec = time_allowed * 60;
    var up_timer = 0;
    var countdown_txt = " Seconds";
    var upcounter_txt = " Mins";
    var ctimer;
    var setEachQuestionTimeNext_countdown;
    var timer_countdown;

    function questionstartTimer() {

        timer_countdown = setInterval(function() {
            fsec--;
            //$('#counter_{{$activeq_id}} span.seconds').text(fsec-- + countdown_txt);
            progressBar(fsec, $('.progressBar_first'));
            if (fsec == -1) {
                clearInterval(timer_countdown);
                $('.progressBar_first').css('background-color', '#E4E4E4');
                $('.progressBar_first').css('border-left', 'solid 4px #ff6060');
                $('#q_time_taken_first').show();
                $('#avg_text').hide();
                $('.progressBar_first').hide();
            }

        }, 1000);

    }


    function progressBar(percent, $element) {
        var progressBarWidth = percent * $element.width() / (time_allowed * 60);
        $element.find('div').animate({
            width: progressBarWidth
        }, 500).html(percent + "%&nbsp;");
        if (percent <= 20) {
            $('#percentBar_{{$activeq_id}}').css('background-color', '#FFDC34');
        }
        if (percent <= 0) {
            $('.progressBar_first').css('background-color', '#E4E4E4');
            $('.progressBar_first').css('border-left', 'solid 4px #ff6060');
        }
    }

    var minutesLabel = document.getElementById("up_minutes");
    var secondsLabel = document.getElementById("up_seconds");
    //var totalSec = document.getElementById("tsec");
    var totalSeconds = -1;


    function setEachQuestionTime() {
        setEachQuestionTimeNext_countdown = setInterval(function() {
            ++totalSeconds;
            $('.timespend_first').val(totalSeconds);
            secondsLabel.innerHTML = pad(totalSeconds % 60);

            minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
            //totalSec.innerHTML = pad(totalSeconds);
        }, 1000);
    }

    function pad(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }

    /* per question timer end */
    /* per question timer end */


    /* getting Next Question Data */
    function qnext(question_id) {

        var act_question = $("#current_question").val();
        var q_submit_time = $("#timespend_" + act_question).val();

        saveQuestionTime(act_question, q_submit_time);

        url = "{{ url('mock_next_question/') }}/" + question_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                clearInterval(ctimer);
                clearInterval(timer_countdown);
                clearInterval(setEachQuestionTimeNext_countdown);

                $("#question_section div").remove();
                $("#question_section").html(result);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question_section"]);

            }
        });
    }


    /* mark or review */
    function markforreview(quest_id, subject_id, chapt_id) {
        var quest_id = $("#current_question").val();
        var subject_id = $("#current_subject_id").val();
        var chapt_id = $("#current_chapter_id").val();
        var cur_quest_no = $('#current_question_no').val();

        var option_id = [];
        var current_question_type = $("#current_question_type").val();

        if (current_question_type == 11) {
            var res_value = $("#quest_option_" + quest_id).val();

            if (res_value != '') {
                option_id.push($("#quest_option_" + quest_id).val());
            }

        } else {
            $.each($("input[name='quest_option_" + quest_id + "']:checked"), function() {
                option_id.push($(this).val());
            });
        }
        if (option_id.length > 0) {
            clearResponse(quest_id, subject_id, cur_quest_no);
        }

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
                    $("#btn_" + quest_id).removeClass("border-btn");
                    $("#btn_" + quest_id).removeClass("blue-btn");
                    $("#btn_" + quest_id).addClass("pink-btn");

                    updateCountValue(quest_id, 'onlyReview');

                    if ($("#quesnext" + quest_id).is(":disabled") == true) {

                        $("#submitExam").click();
                    } else {
                        $("#quesnext" + quest_id).click();

                    }

                } else {

                }


            },
        });
    }



    /* Saved question response */
    function saveAnswer() {
        var question_id = $("#current_question").val();
        var qNo = $("#current_question_no").val();

        $('#question_section .quesBtn').attr("disabled", true);
        $('#question_section .quesBtn').addClass("disabled");
        var question_id = question_id;

        var option_id = [];
        var current_question_type = $("#current_question_type").val();
        var current_subject_id = $("#current_subject_id").val();
        var current_section_id = $("#current_section_id").val();

        if (current_question_type == 11) {
            var res_value = $("#quest_option_" + question_id).val();

            if (res_value != '') {
                const str = res_value;
                const last = str.charAt(str.length - 1);
                var decarr = res_value.split(".");

                if (res_value == '-' || res_value == '-.') {
                    var vld_msg = "Enter valid answer.";
                } else if (last === '.') {
                    var vld_msg = "Numeric values cannot end with a decimal.";
                } else if ((decarr.length > 1) && (decarr[1].length > 2)) {
                    var vld_msg = "Numerical values were allowed up to two decimal places.";
                } else {
                    option_id.push($("#quest_option_" + question_id).val());
                }
            } else {
                var vld_msg = "Please fill your response.";
            }

        } else {
            $.each($("input[name='quest_option_" + question_id + "']:checked"), function() {
                option_id.push($(this).val());
            });
            var vld_msg = "Please select your response.";
        }
        if (option_id.length === 0) {
            $('#qoption_err_' + question_id).html(vld_msg);
            $('#qoption_err_' + question_id).addClass('text-danger');
            $('#qoption_err_' + question_id).fadeIn('fast');
            $('#qoption_err_' + question_id)[0].scrollIntoView();

            $('#question_section .quesBtn').attr("disabled", false);
            $('#question_section .quesBtn').removeClass("disabled");
            setTimeout(function() {
                $('#qoption_err_' + question_id).fadeOut("fast");
            }, 8000);
            return false;
        }

        var err_sts = true;
        var q_submit_time = $("#timespend_" + question_id).val();

        $.ajax({
            url: "{{ route('saveAnswer') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                question_id: question_id,
                option_id: option_id,
                q_submit_time: q_submit_time,
                current_subject_id: current_subject_id,
                current_section_id: current_section_id,
            },
            beforeSend: function() {
                //$('.loader-block').show();
            },
            success: function(response_data) {
                //$('.loader-block').hide();
                var response = jQuery.parseJSON(response_data);

                if (response.status == 200) {
                    $("#btn_" + question_id).removeClass("pink-btn");
                    $("#btn_" + question_id).removeClass("blue-btn");
                    $("#btn_" + question_id).removeClass("border-btn");

                    updateCountValue(question_id, 'saveAns');

                    if ($("#quesnext" + question_id).is(":disabled") == true) {

                        $("#submitExam").click();
                    } else {

                        $("#quesnext" + question_id).click();

                    }
                } else if (response.status == 400) {
                    $('#attempt-alert-text').text(response.message);
                    $('#attemptlimit').modal('show');


                    err_sts = false;
                }
            },
            complete: function() { // Set our complete callback, removed disabled 
                $('#question_section .quesBtn').attr("disabled", false);
                $('#question_section .quesBtn').removeClass("disabled");
            }
        });

    }

    function saveAnswerAjax() {
        var question_id = $("#current_question").val();
        var qNo = $("#current_question_no").val();

        $('#question_section .quesBtn').attr("disabled", true);
        $('#question_section .quesBtn').addClass("disabled");

        var question_id = question_id;
        var isValid = 1;
        var option_id = [];
        var current_question_type = $("#current_question_type").val();
        var current_subject_id = $("#current_subject_id").val();
        var current_section_id = $("#current_section_id").val();

        if (current_question_type == 11) {
            var res_value = $("#quest_option_" + question_id).val();

            if (res_value != '') {
                const str = res_value;
                const last = str.charAt(str.length - 1);
                var decarr = res_value.split(".");

                if (res_value == '-' || res_value == '-.') {
                    var vld_msg = "Enter valid answer.";
                } else if (last === '.') {
                    var vld_msg = "Numeric values cannot end with a decimal.";
                } else if ((decarr.length > 1) && (decarr[1].length > 2)) {
                    var vld_msg = "Numerical values were allowed up to two decimal places.";
                } else {
                    option_id.push($("#quest_option_" + question_id).val());
                }
            } else {
                var vld_msg = "Please fill your response.";
            }

        } else {
            $.each($("input[name='quest_option_" + question_id + "']:checked"), function() {
                option_id.push($(this).val());
            });
            var vld_msg = "Please select your response.";
        }
        if (option_id.length === 0) {
            $('#qoption_err_' + question_id).html(vld_msg);
            $('#qoption_err_' + question_id).addClass('text-danger');
            $('#qoption_err_' + question_id).fadeIn('fast');
            $('#qoption_err_' + question_id)[0].scrollIntoView();

            $('#question_section .quesBtn').attr("disabled", false);
            $('#question_section .quesBtn').removeClass("disabled");
            setTimeout(function() {
                $('#qoption_err_' + question_id).fadeOut("fast");
            }, 8000);
            return false;
        }

        var q_submit_time = $("#timespend_" + question_id).val();

        $.ajax({
            url: "{{ route('saveAnswer') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                question_id: question_id,
                option_id: option_id,
                q_submit_time: q_submit_time,
                current_subject_id: current_subject_id,
                current_section_id: current_section_id,
            },
            beforeSend: function() {
                //$('.loader-block').show();
            },
            success: function(response_data) {
                //$('.loader-block').hide();
                var response = jQuery.parseJSON(response_data);
                if (response.status == 200) {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question_section"]);

                    if ($("#quesnext" + question_id).is(":disabled") == true) {

                        $("#submitExam").click();
                    } else {
                        $("#quesnext" + question_id).click();

                    }
                    isValid = 1;

                } else if (response.status == 400) {
                    $('#attempt-alert-text').text(response.message);
                    $('#attemptlimit').modal('show');
                    //alert(response.message);
                    isValid = 0;

                }
            },
            complete: function() { // Set our complete callback, removed disabled 
                $('#question_section .quesBtn').attr("disabled", false);
                $('#question_section .quesBtn').removeClass("disabled");
            },
            async: false
        });

        if (isValid == 1) {
            return true;
        } else {
            return false;
        }
    }


    function savemarkreview() {
        var quest_id = $("#current_question").val();
        var subject_id = $("#current_subject_id").val();
        var chapt_id = $("#current_chapter_id").val();
        /* saving response */
        var current_question_no = $("#current_question_no").val();
        var response = saveAnswerAjax(quest_id, current_question_no);


        if (response != false) {


            // marking for review
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
                        $("#btn_" + quest_id).removeClass("border-btn");
                        $("#btn_" + quest_id).removeClass("pink-btn");
                        $("#btn_" + quest_id).addClass("blue-btn");

                        updateCountValue(quest_id, 'saveAnsReview');
                    }

                },
            });

            return true;
        }
    }

    function clearResponse() {
        var quest_id = $("#current_question").val();
        var subject_id = $("#current_subject_id").val();
        var qNo = $("#current_question_no").val();


        var response = [];
        var current_question_type = $("#current_question_type").val();
        var current_subject_id = $("#current_subject_id").val();
        var current_section_id = $("#current_section_id").val();

        if (current_question_type == 11) {
            var res_value = $("#quest_option_" + quest_id).val();

            if (res_value === '') {
                $('#qoption_err_' + quest_id).html("To be clear, nothing is filled.");
                $('#qoption_err_' + quest_id).addClass('text-danger');
                $('#qoption_err_' + quest_id).fadeIn('fast');
                $('#qoption_err_' + quest_id)[0].scrollIntoView();

            } else {
                $("#quest_option_" + quest_id).val('');
            }
        } else {
            $.each($("input[name='quest_option_" + quest_id + "']:checked"), function() {
                response = $(this).prop('checked', false);
            });

            if (response.length == 0) {
                $('#qoption_err_' + quest_id).html("No option has been selected to clear.");
                $('#qoption_err_' + quest_id).addClass('text-danger');
                $('#qoption_err_' + quest_id).fadeIn('fast');
                $('#qoption_err_' + quest_id)[0].scrollIntoView();

            }
        }

        $("#btn_" + quest_id).addClass("border-btn");
        $("#btn_" + quest_id).removeClass("pink-btn");
        $("#btn_" + quest_id).removeClass("blue-btn");

        $.ajax({
            url: "{{ route('clearResponse') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                question_id: quest_id,
                subject_id: subject_id,
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);
                if (response.status == 200) {
                    $("#btn_" + quest_id).find('i').remove();
                    $("#btn_" + quest_id).html(qNo);
                }
                checkResponse(quest_id);
                updateCountValue(quest_id, 'clear');
            },
        });

    }

    function checkResponse(quest_id) {
        var option_id = [];
        var current_question_type = $("#current_question_type").val();

        if (current_question_type == 11) {
            var res_value = $("#quest_option_" + quest_id).val();

            if (res_value != '') {
                option_id.push($("#quest_option_" + quest_id).val());
            }

        } else {
            $.each($("input[name='quest_option_" + quest_id + "']:checked"), function() {
                option_id.push($(this).val());
            });
        }
        console.log(option_id);
        if (option_id.length > 0) {
            $('#clearBtn_response').attr("disabled", false);
            $('#clearBtn_response').addClass("Clearbtnenable");
        } else {
            $('#clearBtn_response').attr("disabled", true);
            $('#clearBtn_response').removeClass("Clearbtnenable");
        }
    }

    function get_subject_question(subject_id) {
        var act_question = $("#current_question").val();
        var q_submit_time = $("#timespend_" + act_question).val();

        saveQuestionTime(act_question, q_submit_time);

        url = "{{ url('mock_next_subject_question/') }}/" + subject_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                clearInterval(ctimer);
                clearInterval(timer_countdown);
                clearInterval(setEachQuestionTimeNext_countdown);

                $("#myTabContent #question_section div").remove();
                $("#myTabContent #question_section").html(result);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question_section"]);
            }
        });


    }

    function get_subject_Sec_question(subject_id, section_id) {
        var act_question = $("#current_question").val();
        var q_submit_time = $("#timespend_" + act_question).val();

        saveQuestionTime(act_question, q_submit_time);

        url = "{{ url('mock_next_subject_question/') }}/" + subject_id + "/" + section_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                clearInterval(ctimer);
                clearInterval(timer_countdown);
                clearInterval(setEachQuestionTimeNext_countdown);

                $("#myTabContent #question_section div").remove();
                $("#myTabContent #question_section").html(result);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question_section"]);
            }
        });

    }

    function saveQuestionTime(question_id, time) {

        url = "{{ url('saveQuestionTimeSession') }}/" + question_id;
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'q_time': time
            },
            beforeSend: function() {
                //$('.loader-block').show();
            },
            success: function(response_data) {
                // $('.loader-block').hide();
                var response = jQuery.parseJSON(response_data);
                if (response.status == 200) {

                }
            }
        });


    }


    $(document).ready(function() {
        $("#form_exam_submit").validate({

            submitHandler: function(form) {
                if (timeLeft >= 1) {
                    let timer_left = document.querySelector("#base-timer-path-remaining_alt");


                    const circleDasharray = `${(calculateTimeFraction() * FULL_DASH_ARRAY).toFixed(0)} 283`;

                    timer_left.setAttribute("stroke-dasharray", circleDasharray);



                    let lefttime_exam_s = document.getElementById("lefttime_pop_s");
                    lefttime_exam_s.innerHTML = formatTime(timeLeft);
                    $('#FullTest_Exam_Panel_Interface_A').modal('show');

                } else {
                    form.submit();
                }


            }

        });

        $('#bt-modal-confirm').click(function() {

            $('#form_exam_submit')[0].submit();
        });
        $('#bt-modal-confirm_over').click(function() {

            $('#form_exam_submit')[0].submit();
        });
    });


    function updateCountValue(quest_id, type) {




        var saveArrIndex = saveArr.indexOf(quest_id);
        if (saveArrIndex !== -1) {
            saveArr.splice(saveArrIndex, 1);
        }


        var markForReviewArrIndex = markForReviewArr.indexOf(quest_id);
        if (markForReviewArrIndex !== -1) {
            markForReviewArr.splice(markForReviewArrIndex, 1);

        }

        var saveMarkReviewArrIndex = saveMarkReviewArr.indexOf(quest_id);
        if (saveMarkReviewArrIndex !== -1) {
            saveMarkReviewArr.splice(saveMarkReviewArrIndex, 1);

        }

        if (type === 'onlyReview') {
            markForReviewArr.push(quest_id);
        } else if (type === 'saveAns') {
            var arrlength = saveArr.length;
            saveArr.push(quest_id);
        } else if (type === 'saveAnsReview') {
            saveMarkReviewArr.push(quest_id);
        } else {

        }

        var save_count = saveArr.length;
        var r_count = markForReviewArr.length;
        var s_r_count = saveMarkReviewArr.length;
        var unanswered = totalQCount - (save_count + r_count + s_r_count);

        console.log(save_count, r_count, s_r_count, unanswered);

        $('#ans_cnt_2').html(save_count);
        $('#ans_cnt').html(save_count);

        $('#unans_cnt_2').html(unanswered);
        $('#unans_cnt').html(unanswered);

        $('#rev_cnt_2').html(r_count);
        $('#rev_cnt').html(r_count);

        $('#ans_rev_cnt_2').html(s_r_count);
        $('#ans_rev_cnt').html(s_r_count);

    }
</script>
<script>
    $('.showyes').click(function() {
        // $('.text-exammid-sec').show(500);

        $('.main-textexam-sec').slideToggle({
            direction: "up"
        }, 300);

        $(this).toggleClass('Close');

        $('.showyes').hide(0);
        $('.hideyes').show(0);
        $('.overlaydiv').show(0);

    });
    $('.hideyes').click(function() {
        $('.main-textexam-sec').slideToggle({
            direction: "down"
        }, 300);

        $(this).toggleClass('Close');
        $('.showyes').show(0);
        $('.hideyes').hide(0);
        $('.overlaydiv').hide(0);
    });
</script>
@endsection