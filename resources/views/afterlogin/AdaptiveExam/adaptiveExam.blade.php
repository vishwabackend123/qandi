@extends('afterlogin.layouts.app_new')
<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
@section('content')
@php
$userData = Session::get('user_data');
@endphp
@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
$topic_id = isset($question_data->topic_id)?$question_data->topic_id:0;
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
<style>
    .mjx-chtml {
        line-height: 0.5 !important;
    }


    .time_taken_css {
        border-left: 3px Solid #ff6060;
        width: 200px;
        font: 14px;
        color: #2C3348;
        font-weight: 500;
        background-color: #e4e4e4;
        text-align: center;
    }

    .time_taken_css span:first-child {

        font-weight: 200;

    }

    .counter {
        position: relative;
        right: 25px;
        margin-left: auto;
        margin-right: -50px;
    }

    .counter .progressBar .seconds {
        width: 100%;
        position: absolute;
        text-align: center;
        color: #FFF;
        font-weight: 600;
        top: -2px;

    }

    .tiny-green {
        position: relative;
        padding: 0px;
        width: 180px;
        background-color: #E4E4E4;
        height: 18px;
    }

    .tiny-green div {
        font-family: arial;
        font-size: 3px;
        height: inherit;
        color: white;
        text-align: right;
        text-shadow: 0px 0px 2px #000;
        text-indent: 9999px;
        overflow: hidden;
        background-color: #44CD7F;
        /*  background-image: -webkit-gradient(linear, 71% 25%, 71% 69%, color-stop(0, rgb(247, 7, 7)), color-stop(0.47, rgb(118, 177, 1)), color-stop(0.48, rgb(102, 153, 0)), color-stop(1, rgb(102, 153, 0)));
        background-image: -webkit-linear-gradient(-90deg, rgb(247, 7, 7) 0%, rgb(118, 177, 1) 47%, rgb(102, 153, 0) 48%, rgb(102, 153, 0) 100%);
        background-image: -moz-linear-gradient(71% 25% -180deg, rgb(247, 7, 7) 0%, rgb(118, 177, 1) 47%, rgb(102, 153, 0) 48%, rgb(102, 153, 0) 100%);
        background-image: linear-gradient(-180deg, rgb(247, 7, 7) 0%, rgb(118, 177, 1) 47%, rgb(102, 153, 0) 48%, rgb(102, 153, 0) 100%);
 */


    }
</style>
<div class="main-wrapper exam-wrapperBg" id="mainDiv" style="padding-left:0px; display:none;">
    <div class="content-wrapper examSect" id="exam_content_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 mb-lg-0 mb-4">
                    <div class="tab-wrapper h-100">
                        <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                            <input type="hidden" id="current_question" value="{{$activeq_id}}" />
                            <input type="hidden" id="current_question_type" value="{{$template_type}}" />
                            <input type="hidden" id="current_question_no" value="1" />

                            <!-- Exam subject Tabs  -->
                            <div id="scroll-mobile" class="tabintablet">
                                <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                    @if(!empty($filtered_subject))
                                    @foreach($filtered_subject as $key=>$sub)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif " id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="false" @if(count($filtered_subject)>1) onclick="get_subject_question('{{$sub->id}}')" @endif>{{$sub->subject_name}}({{$sub->count}})</a>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- End Exam subject Tabs -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div id="question_section" class="">
                                    <div>
                                        <div class="d-flex" id="pause-start">
                                            <!-- question Type Tag -->
                                            <span class="fw-bold text-uppercase">{{$question_type}}</span>
                                            <!-- question Type Tag -->
                                            <div id="counter_{{$activeq_id}}" class="counter  d-flex">
                                                <span id="avg_text" class="avg-time">Average Time:</span>
                                                <div id="progressBar_{{$activeq_id}}" class="progressBar_first tiny-green ms-2">
                                                    <span class="seconds" id="seconds_{{$activeq_id}}"></span>
                                                    <div id="percentBar_{{$activeq_id}}"></div>
                                                </div>
                                                <div class="time_taken_css" id="q_time_taken_first" style="display:none;">
                                                    <span>Time taken : </span><span id="up_minutes"></span>:<span id="up_seconds"></span> mins
                                                </div>
                                            </div>
                                            <input type="hidden" name="question_spendtime" class="timespend_first" id="timespend_{{ $activeq_id }}" value=" " />
                                        </div>
                                        <div class="question-block">
                                            <!-- Next and previous button -->
                                            <button href="javascript:void(0);" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')" class="arrow prev-arow {{empty($prev_qid)?'d-none':''}}"><i class="fa fa-angle-left" title="Previous Question"></i></button>
                                            <button href="javascript:void(0);" class="arrow next-arow {{empty($next_qid)?'disabled':''}}" {{empty($next_qid)?'disabled':''}} id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><i class="fa fa-angle-right" title="Next Question"></i></button>
                                            <!-- Next and previous button -->
                                            <div class="question py-3"><span class="q-no">Q1.</span>{!! $question_text !!}</div>
                                            <div class="ans-block row my-3">
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
                                                $view_opt='<img src="'.$latex.'" />' ;
                                                */
                                                @endphp
                                                <div class="col-md-6 mb-4 markerDiv">
                                                    <input class="form-check-input quest_option_{{$activeq_id}} checkboxans" type="{{$questtype}}" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                                                    <div class="border ps-3 ans">
                                                        <label class="question m-0 py-3 d-block " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}</span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
                                                    </div>
                                                </div>
                                                @php $no++; @endphp
                                                @endforeach
                                                @endif
                                                @elseif($template_type==11)
                                                <div class="col-md-5 mb-4">

                                                    <div class="numeric-input-box">
                                                        <span>Answer here</span>
                                                        <input class="form-input allownumericwithdecimal" type="text" id="quest_option_{{$activeq_id}}" name="quest_option_{{$activeq_id}}" autofocus value="{{isset($aGivenAns[0])?$aGivenAns[0]:''}}" maxlength="20">
                                                    </div>

                                                </div>
                                                @endif
                                            </div>
                                            <span class="qoption_error text-danger" id="qoption_err_{{$activeq_id}}"></span>
                                        </div>

                                        <div class="tab-btn-box  d-flex mt-3">
                                            @if(!empty($next_qid))
                                            <a href="javascript:void(0);" class="btn px-5   btn-light-green rounded-0 saveanswer quesBtn" onclick="saveAnswer('{{$activeq_id}}',1)">Save & Next</a>
                                            @else
                                            <button class="btn px-5   btn-light-green rounded-0 saveanswer quesBtn" onclick="saveAnswer('{{$activeq_id}}',1)">Save & Submit
                                            </button>
                                            @endif
                                            <a href="javascript:void(0);" class="btn px-4   ms-2 btn-light rounded-0 savemarkreview quesBtn" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}')">Save & Mark for Review</a>
                                            <a href="javascript:void(0);" class="btn px-4 ms-auto me-2 btn-light rounded-0 quesBtn" onclick="markforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')">Mark for Review</a>
                                            <a href="javascript:void(0);" class="btn px-4   me-2 btn-secondary rounded-0 clearRes quesBtn" onclick="clearResponse('{{$activeq_id}}','{{$subject_id}}',1)">Clear Response</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side Area -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 rightSect">
                    <div class="bg-white d-flex flex-column justify-content-center mb-4 p-5">
                        <div class="d-flex align-items-center">
                            <div class="" id="app">
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
                                    <img class="watch-icon" src="{{URL::asset('public/after_login/images/timer_Exam_page_ic.png')}}" />
                                </div>
                            </div>
                            <span class="timing">
                                <span id="base-timer-label" class="base-timer__label"></span> Time left
                            </span>
                        </div>
                        <form id="form_exam_submit" action="{{route('exam_result')}}" method="post">
                            @csrf
                            <input type="hidden" name="fulltime" value="{{gmdate('H:i:s',$exam_fulltime*60)}}">
                            <input type="hidden" name="submit_time" id="final_submit_time" value="">
                            <input type="hidden" name="test_type" value="{{$test_type}}">
                            <input type="hidden" name="exam_type" value="{{$exam_type}}">
                            <input type="hidden" name="planner_id" value="{{isset($planner_id)?$planner_id:0}}">
                            <div class="pull-right lowhight">
                                <button type="button" class="btn btn-outline-danger stop" onclick="stop();"><i class="fa fa-pause" aria-hidden="true" title="Pause"></i>
                                </button>
                                <button type="button" class="btn btn-outline-success start" onclick="start();" style="display: none"><i class="fa fa-play" aria-hidden="true" title="Resume"></i>
                                </button>
                            </div>
                            <button type="submit" id="submitExam" class="btn btn-light-green w-100 rounded-0 mt-3" onclick="stop('submit');"><span class="btnSubic">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 18">
                                        <path data-name="Path 2331" d="M13 3v7h6l-8 11v-7H5l8-11" transform="translate(-5 -3)" style="fill:#fff" />
                                    </svg>
                                </span>&nbsp;&nbsp;&nbsp;Submit</button>
                            <!--  <a href="{{route('examresult')}}" class="btn btn-danger rounded-0 px-5 my-5">SEE ANALYTICS</a> -->
                        </form>
                        <p class="rightSectH">Question</p>
                        <div class="number-block">
                            @if(isset($keys) && !empty($keys))
                            @php $i = 1; @endphp
                            @foreach($keys as $ke=>$val)
                            <button type="button" class="next_button btn btn-light rounded-0 mb-4 @php if($activeq_id==$val){echo ' activequestion';} @endphp" id="btn_{{$val}}" onclick="qnext('{{$val}}')">{{$i}}</button>
                            @php $i++; @endphp
                            @endforeach
                            @endif
                            <!-- <button class="btn btn-secondary  mb-4 rounded-0">2</button>
                            <button class="btn btn-secondary  mb-4 rounded-0">3</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">4</button>
                            <button class="btn btn-light rounded-0 mb-4">5</button>
                            <button class="btn btn-light mb-4 rounded-0">6</button>
                            <button class="btn btn-secondary  mb-4 rounded-0"><i class="fa fa-check text-light"></i></button>
                            <button class="btn btn-secondary  mb-4 rounded-0"><i class="fa fa-check text-light"></i></button>
                            <button class="btn btn-light-green  mb-4 rounded-0">9</button>
                            <button class="btn btn-outline-warning text-dark rounded-0 mb-4">10</button>
                            <button class="btn btn-light mb-4 rounded-0">11</button>
                            <button class="btn btn-light mb-4 rounded-0">12</button>
                            <button class="btn btn-light mb-4 rounded-0">13</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">14</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">15</button> -->
                        </div>
                        <!--  <p class="rightSectH">Legends</p> -->
                        <div class="row mt-4">
                            <div class="col-md-6 legends">
                                <button class="btn btn-light p-0 rounded-0"> </button>
                                <p>Unread</p>
                            </div>
                            <div class="col-md-6 legends ">
                                <button class="btn btn-light-green p-0 rounded-0"> </button>
                                <p>Answered </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 legends">
                                <button class="btn btn-secondary p-0  rounded-0"> </button>
                                <p>Marked for Review</p>
                            </div>
                            <div class="col-md-6 legends">
                                <button class="btn btn-secondary p-0 rounded-0"><i class="fa fa-check text-light"></i></button>
                                <p>Answered & <br>Marked for Review</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Test_Instruction-->
<div class="modal fade" id="FullTest_Exam_Panel_Interface_A" tabindex="-1" role="dialog" aria-labelledby="FullTest_Exam_Panel_Interface_A" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="start()" title="Close"><img src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}" /></a>
            </div>
            <div class="modal-body text-center pt-2 pb-5">
                <div class="d-flex align-items-center w-100 justify-content-center my-3">
                    <div id="app">
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
                    </div>
                    <p class="m-0 ms-3 lefttime"><strong id="lefttime_pop_h"></strong> Left</p>
                </div>
                <h3 class="testtimehead">You still have <span id="lefttime_pop_s"> </span> left!</h3>
                <p>
                    You haven’t attempted all of the questions.<br>Do you want to have a quick review before you Submit?
                </p>
                <div>
                    <button id="bt-modal-cancel" type="button" class="btn btn-light px-5 rounded-0 mt-3 reviewbtn" data-bs-dismiss="modal" onclick="start()">
                        REVIEW
                    </button>
                    <button id="bt-modal-confirm" type="button" class="btn btn-light-green px-5 rounded-0 mt-3 textsubmit">
                        <span class="btnSubic">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 18">
                                <path data-name="Path 2331" d="M13 3v7h6l-8 11v-7H5l8-11" transform="translate(-5 -3)" style="fill:#fff"></path>
                            </svg>
                        </span> &nbsp;&nbsp;&nbsp;Submit TEST
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="test_instruction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">
                <a type="button" class="btn-close" aria-label="Close" href="{{ url('dashboard') }}" title="Close">
                    <img src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}" />
                </a>
            </div>
            <div class="modal-body pt-3 p-5">
                <div class="row">
                    <div class="col-lg-12 col-xl-8">
                        <h1 class="text-danger text-uppercase examhead mb-0 pb-0 mt-4 pt-2">{{isset($exam_name)?$exam_name:''}}</h1>
                        <div class="scroll">
                            <div class="test-info">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-5 col-lg-5">
                                        <div class="me-2"></div>
                                        <div>
                                            <small>No. of Questions</small>
                                            <span class="d-block inst-text"><span>{{$questions_count}} Questions </span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div>
                                            <small>Subject</small>
                                            <span class="d-block inst-text"><span>{{$tagrets}}</span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="me-2 ms-auto"></div>
                                        <div>
                                            <small>Duration</small>
                                            <span class="d-block inst-text"><span>{{$exam_fulltime}}</span> Minutes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="inst mb-3">(Please Read the instructions carefully for any query before starting the test. Thank you.)</p>
                            <div class="instructions pe-3 uniform-scroll">
                                <h3 class="text-uppercase">Instructions</h3>
                                <p>This will give you multiple opportunities to improve your scores in the
                                    examination if you are not able to give your best in one attempt.</p>
                                <p>In first attempt, you will get a first-hand experience of taking an
                                    examination and you will know your mistakes which you can improve while attempting
                                    for the next time.</p>
                                <p>This will reduce your chance of dropping a year due to inadequate preparation.</p>
                                <p>You will not have to yet again lose another year.</p>
                                <p>If you missed the examination due to reasons beyond control (such as Board examination), then you will not have to wait for one full year and you need not appear in all the four sessions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-4 ps-xl-5 ps-lg-2 d-flex align-items-lg-center justify-content-center flex-column">
                        <h1 class="my-auto text-center">
                            <span class="d-block mt-3 fw-bold">All the Best,</span> <span class="unaaame fw-bold">{{$userData->user_name}}!</span>
                        </h1>
                        <div class="row justify-content-center mt-xl-0 mt-3">
                            <button class="btn  text-uppercase rounded-0 px-5 col-lg-12 col-sm-6 goto-exam-btn" id="goto-exam-btn" data-bs-dismiss="modal" aria-label="Close">GO FOR IT &nbsp;&nbsp;&nbsp; <img src="{{URL::asset('public/after_login/images/goforimgit.png')}}" /></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal END Exam -->
<div class="modal hide fade in" id="endExam" tabindex="-1" aria-labelledby="exampleModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 ">
            <div class="modal-body p-5 text-center">
                <div class="text-center py-4">
                    <h2 class="mb-3">Time Over!</h2>
                    <button id="bt-modal-confirm_over" type="button" class="btn btn-light-green px-5 rounded-0 mt-3">
                        Submit TEST
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade examModal 10" id="resume-test" tabindex="-1" role="dialog" aria-labelledby="resume-test" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modalcenter">
        <div class="modal-dialog">
            <div class="modal-content exammodal_content">
                <div class="modal-body exam-paused-body">
                    <div class="modal-header-exam text-center ">
                        <div class="exam-overview ">
                            <label>Exam Paused</label>
                        </div>
                    </div>
                    <div class="exam_duration_block text-center">
                        <img src="{{URL::asset('public/after_login/current_ui/images/exam-clock.svg')}}" />
                        <label class="d-block">Duration of time paused </label>
                        <span class="exam_duration d-block" id="pauseTime">03 mins</span>
                    </div>
                     <p>Your last assessment is on hold; click resume to go back to it.</p>
                     <!-- <p class="exittext">Do you want to exit the test? </P>
                    <p class="exittext-subheading">You can always come back and resume the test </p> -->
                   <div class="exam-footer-sec">
                        <div class="task-btn tasklistbtn text-center">
                            <button id="bt-modal-cancel" onclick="start();" class="btn btn-common-green" data-bs-dismiss="modal"> Resume <label class="p-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 17.259V6.741a1 1 0 0 1 1.504-.864l9.015 5.26a1 1 0 0 1 0 1.727l-9.015 5.259A1 1 0 0 1 7 17.259z" fill="#fff" />
                                    </svg>
                                </label>
                            </button>
                        </div>
                    </div>
                    <!-- <div id="button_width" class="exam-footer-sec width-50">
                        <div class="task-btn tasklistbtn">
                            <button class="btn btn-common-transparent nobg reviewbtn submitPopupBtn" data-bs-dismiss="modal" onclick="start()" id="back_to_restart">Back To test</button>
                            <a href="{{url('exam_custom')}}" id="bt-modal-confirm" class="btn btn-common-green green50 submitPopupBtn">Exit Test<label>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z" fill="#fff" />
                                    </svg> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                    <path d="M11.4998 18.9515C10.1574 19.1083 8.79687 18.9579 7.52111 18.5116C6.24535 18.0654 5.08775 17.3349 4.13582 16.3755C3.05866 15.2982 2.27257 13.9652 1.85118 12.5013C1.42979 11.0373 1.38688 9.49039 1.72649 8.00535C2.0661 6.52031 2.7771 5.14577 3.79289 4.0105C4.80868 2.87523 6.09602 2.01637 7.53432 1.51438C8.97261 1.0124 10.5148 0.883716 12.0164 1.14039C13.518 1.39706 14.9299 2.03068 16.1198 2.98191C17.3097 3.93313 18.2386 5.17082 18.8197 6.57905C19.4007 7.98727 19.6148 9.51993 19.4418 11.0335" stroke="#F2F4F7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 5.01123V10.0112L12.5 12.0112M15.5 15.0112V20.0112M19.5 15.0112V20.0112" stroke="#F2F4F7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </label>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loader-block" style="display:none;">
    <img src="{{URL::asset('public/after_login/new_ui/images/loader.gif')}}">
</div>
@include('afterlogin.layouts.footer_new')
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
    document.addEventListener('visibilitychange', function() {
        $insCheck = $('#test_instruction').hasClass('show');
        $endExamCheck = $('#endExam').hasClass('show');
        if ((document.visibilityState == 'hidden') && $insCheck == false && $endExamCheck == false) {
            $('#FullTest_Exam_Panel_Interface_A').modal('hide');
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
<script>
    var activeques_id = '{{$activeq_id}}';
    /* Allow only numeric with decimal */
    $('.allownumericwithdecimal').bind("cut copy paste", function(e) {
        e.preventDefault();
    })
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
        document.oncontextmenu = function() {
            return false;
        };

        $(document).mousedown(function(e) {
            if (e.button == 2) {

                return false;
            }
            return true;
        });
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
        var newWindowWidth = $(window).width();
        if (newWindowWidth < 768) {
            $("#questNo  #btn_" + activeques_id).focusout();
            $('#quest_option_' + activeques_id).focusout();
        } else {
            $("#questNo  #btn_" + activeques_id).focus();
            $('#quest_option_' + activeques_id).focus();
        }
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
    /*$('.number-block').slimscroll({
        height: '20vh'
    });

    $('.answer-block').slimscroll({
        height: '30vh'
    });*/

    $(window).on('load', function() {
        $("#test_instruction").modal({
            backdrop: "static",
            keyboard: false
        });
        $('#test_instruction').modal('show');

    });
    $('#goto-exam-btn').click(function() {
        $('#mainDiv').show();
        $('#exam_content_sec').show();
        setboxHeight();
        startTimer();
        questionstartTimer();
        setEachQuestionTime();
        if ($('#quest_option_' + activeques_id).length > 0) {
            $('#quest_option_' + activeques_id).focus();
        }
    });
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
        // console.log(timePassed, timeLeft);

        timeLabel.innerHTML = formatTime(TIME_LIMIT);
    }

    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;

        if (seconds < 10) {
            seconds = `0${seconds}`;
        }

        return `${minutes} mins ${seconds} sec`;
    }

    function calculateTimeFraction() {
        const rawTimeFraction = timeLeft / TIME_LIMIT;
        return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
    }

    function setCircleDasharray() {
        const circleDasharray = `${(
                calculateTimeFraction() * FULL_DASH_ARRAY
            ).toFixed(0)} 283`;
        // console.log("setCircleDashArray: ", circleDasharray);
        timer.setAttribute("stroke-dasharray", circleDasharray);
    }


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

        url = "{{ url('adaptive_next_question/') }}/" + question_id;
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
                    $("#btn_" + quest_id).removeClass("btn-light");
                    $("#btn_" + quest_id).addClass("btn-secondary");
                } else {

                }
                if ($("#quesnext" + quest_id).is(":disabled") == true) {

                    $("#submitExam").click();
                } else {
                    $("#quesnext" + quest_id).click();

                }

            },
        });
    }

    /* Saved question response */
    function saveAnswer(question_id, qNo) {
        $('#question_section .quesBtn').attr("disabled", true);
        $('#question_section .quesBtn').addClass("disabled");
        var question_id = question_id;
        var option_id = [];
        var current_question_type = $("#current_question_type").val();

        if (current_question_type == 11) {
            var res_value = $("#quest_option_" + question_id).val();

            if (res_value != '') {
                const str = res_value;
                const last = str.charAt(str.length - 1);
                var decarr = res_value.split(".");

                const noSpecialCharacters = str.replace(/[^0-9 ]/g, '');
                var subject = /^0+$/;

                if (noSpecialCharacters.match(subject) && noSpecialCharacters.length > 1) {
                    var vld_msg = "Enter valid answer.";
                } else if (res_value == '-' || res_value == '-.' || res_value == '-.0' || res_value == '-0') {
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
                q_submit_time: q_submit_time
            },
            beforeSend: function() {
                //$('.loader-block').show();
            },
            success: function(response_data) {
                //$('.loader-block').hide();
                var response = jQuery.parseJSON(response_data);

                if (response.status == 200) {
                    $("#btn_" + question_id).find('i').remove();
                    $("#btn_" + question_id).html(qNo);
                    $("#btn_" + question_id).removeClass("btn-light");
                    $("#btn_" + question_id).addClass("btn-light-green");
                }
            },
            complete: function() { // Set our complete callback, removed disabled 
                $('#question_section .quesBtn').attr("disabled", false);
                $('#question_section .quesBtn').removeClass("disabled");
            }
        });
        if ($("#quesnext" + question_id).is(":disabled") == true) {

            $("#submitExam").click();
        } else {
            $("#quesnext" + question_id).click();

        }
    }

    function saveAnswerAjax(question_id, qNo) {
        $('#question_section .quesBtn').attr("disabled", true);
        $('#question_section .quesBtn').addClass("disabled");

        var question_id = question_id;
        var isValid = 0;
        var option_id = [];
        var current_question_type = $("#current_question_type").val();

        if (current_question_type == 11) {
            var res_value = $("#quest_option_" + question_id).val();

            if (res_value != '') {
                const str = res_value;
                const last = str.charAt(str.length - 1);
                var decarr = res_value.split(".");

                const noSpecialCharacters = str.replace(/[^0-9 ]/g, '');
                var subject = /^0+$/;

                if (noSpecialCharacters.match(subject) && noSpecialCharacters.length > 1) {
                    var vld_msg = "Enter valid answer.";
                } else if (res_value == '-' || res_value == '-.' || res_value == '-.0' || res_value == '-0') {
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
                q_submit_time: q_submit_time
            },
            beforeSend: function() {
                //$('.loader-block').show();
            },
            success: function(response_data) {
                //$('.loader-block').hide();
                var response = jQuery.parseJSON(response_data);
                if (response.status == 200) {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question_section"]);

                    isValid = 1;
                    return true;
                } else {
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


    function savemarkreview(quest_id, subject_id, chapt_id) {
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
                        $("#btn_" + quest_id).removeClass("btn-light");
                        $("#btn_" + quest_id).removeClass("btn-light-green");
                        $("#btn_" + quest_id).addClass("btn-secondary");
                        $("#btn_" + quest_id).html('<i class="fa fa-check text-light"></i>');
                    }

                },
            });
            if ($("#quesnext" + quest_id).is(":disabled") == true) {

                $("#submitExam").click();
            } else {
                $("#quesnext" + quest_id).click();

            }
            return true;
        }
    }

    function clearResponse(quest_id, subject_id, qNo) {
        var response = [];
        var current_question_type = $("#current_question_type").val();

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

        $("#btn_" + quest_id).addClass("btn-light");
        $("#btn_" + quest_id).removeClass("btn-light-green");
        $("#btn_" + quest_id).removeClass("btn-secondary");

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

            },
        });

    }

    function get_subject_question(subject_id) {
        var act_question = $("#current_question").val();
        var q_submit_time = $("#timespend_" + act_question).val();

        saveQuestionTime(act_question, q_submit_time);

        url = "{{ url('adaptive_next_subject_question/') }}/" + subject_id;
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
                    let lefttime_exam_h = document.getElementById("lefttime_pop_h");
                    let lefttime_exam_s = document.getElementById("lefttime_pop_s");

                    const circleDasharray = `${(
                            calculateTimeFraction() * FULL_DASH_ARRAY
                        ).toFixed(0)} 283`;
                    // console.log("setCircleDashArray: ", circleDasharray);
                    timer_left.setAttribute("stroke-dasharray", circleDasharray);

                    lefttime_exam_h.innerHTML = formatTime(timeLeft);
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
</script>
@endsection