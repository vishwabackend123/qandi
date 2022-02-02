@extends('afterlogin.layouts.app_new')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- BS JavaScript -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
    $(window).load(function() {
        $("#endExam").modal({
            backdrop: "static",
            keyboard: false
        });

    });
</script>
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML-full"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

@section('content')
@php
$userData = Session::get('user_data');
@endphp
<style>
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
@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
$topic_id = isset($question_data->topic_id)?$question_data->topic_id:0;
$track = isset($question_data->track)?$question_data->track:'';
$difficulty_level = isset($question_data->difficulty_level)?$question_data->difficulty_level:1;
$template_type = isset($question_data->template_type)?$question_data->template_type:'';
$correct_answers = isset($question_data->answers)?json_decode($question_data->answers):"";
if($template_type==1){
$type_class='checkboxans';
$questtype='checkbox';
}else{
$type_class='radioans';
$questtype='radio';
}
@endphp

<div class="main-wrapper" id="mainDiv" style="padding-left:0px; display:none;">
    <div class="content-wrapper examSect" id="exam_content_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
                    <div class="tab-wrapper h-100">
                        <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                            <input type="hidden" id="current_question" value="{{$activeq_id}}" />
                            <!-- Exam subject Tabs  -->
                            <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                                @if(!empty($filtered_subject))
                                @foreach($filtered_subject as $key=>$sub)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif " id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true" onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}}</a>
                                </li>

                                @endforeach
                                @endif
                            </ul>
                            <!-- End Exam subject Tabs -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <input type="hidden" id="current_question" value="{{$activeq_id}}" />
                                <div id="question_section" class="">
                                    <div class="d-flex " id="pause-start">
                                        <div id="counter_{{$activeq_id}}" class="counter  d-flex">
                                            <span id="avg_text">Average Time :</span>
                                            <div id="progressBar_{{$activeq_id}}" class="progressBar_first tiny-green ms-2">
                                                <span class="seconds" id="seconds_{{$activeq_id}}"></span>

                                                <div id="percentBar_{{$activeq_id}}"></div>

                                            </div>
                                            <div class="time_taken_css" id="q_time_taken_first" style="display:none;"><span>Time taken : </span><span id="up_minutes"></span>:<span id="up_seconds"></span>mins</div>
                                        </div>
                                        <input type="hidden" name="question_spendtime" class="timespend_first" id="timespend_{{ $activeq_id }}" value=" " />
                                    </div>

                                    <div class="question-block">
                                        <!-- Next and previous button -->
                                        <span style="visibility:hidden">
                                            <button href="javascript:void(0);" {{empty($prev_qKey)?'disabled':''}} id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qKey}}')" class="arrow prev-arow {{empty($prev_qKey)?'disabled':''}}"><i class="fa fa-angle-left" title="Previous Question"></i></button>
                                            <button href="javascript:void(0);" class="arrow next-arow {{empty($next_qKey)?'disabled':''}}" {{empty($next_qKey)?'disabled':''}} id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qKey}}')"><i class="fa fa-angle-right" title="Next Question"></i></button>
                                        </span>
                                        <!-- Next and previous button -->

                                        <div class="question py-3 d-flex"><span class="q-no">Q1.</span>{!! $question_text !!}</div>

                                        <div class="ans-block row my-3">
                                            @if(isset($option_data) && !empty($option_data))
                                            @php $no=0; @endphp
                                            @foreach($option_data as $key=>$opt_value)
                                            @php
                                            $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
                                            $dom = new DOMDocument();
                                            @$dom->loadHTML($opt_value);
                                            $anchor = $dom->getElementsByTagName('img')->item(0);
                                            $text = isset($anchor)? $anchor->getAttribute('alt') : '';
                                            $latex = "https://math.now.sh?from=".$text;
                                            $view_opt='<img src="'.$latex.'" />' ;
                                            @endphp
                                            <div class="col-md-6 mb-4">
                                                <input class="form-check-input quest_option_{{$activeq_id}} checkboxans" type="{{$questtype}}" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                                                <div class="border ps-3 ans">
                                                    <label class="question m-0 py-3 d-block " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}.</span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
                                                </div>
                                            </div>
                                            @php $no++; @endphp
                                            @endforeach
                                            @endif

                                        </div>

                                    </div>
                                    <span class="qoption_error text-danger" id="qoption_err_{{$activeq_id}}"></span>
                                    <div class="tab-btn-box  d-flex mt-3">
                                        @if(!empty($next_qKey))
                                        <a href="javascript:void(0);" class="btn px-5   btn-light-green rounded-0 saveanswer" onclick="saveAnswer('{{$activeq_id}}',1)">Save & Next</a>
                                        @else
                                        <button class="btn px-5   btn-light-green rounded-0 saveanswer" onclick="saveAnswer('{{$activeq_id}}',1)">Save & Submit
                                        </button>
                                        @endif

                                        <a href="javascript:void(0);" class="btn px-4   ms-2 btn-light rounded-0 savemarkreview" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}')">Save & Mark for review</a>

                                        <a href="javascript:void(0);" class="btn px-4 ms-auto me-2 btn-light rounded-0" onclick="markforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')">Mark for review</a>

                                        <a href="javascript:void(0);" class="btn px-4   me-2 btn-secondary rounded-0 clearRes" onclick="clearResponse('{{$activeq_id}}','{{$subject_id}}',1)">Clear Response</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side Area -->

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 rightSect">
                    <div class="bg-white d-flex flex-column justify-content-center mb-4   p-5">
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
                        <form id="form_exam_submit" action="{{route('planner_exam_result')}}" method="post">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$session_id}}">
                            <input type="hidden" name="chapter_id" value="{{$chapter_id}}">
                            <input type="hidden" name="planner_id" value="{{isset($planner_id)?$planner_id:0}}">
                            <div class="pull-right">
                                <button type="button" class="btn btn-outline-danger stop" onclick="stop();"><i class="fa fa-pause" aria-hidden="true" title="Pause"></i>
                                </button>
                                <button type="button" class="btn btn-outline-success start" onclick="start();" style="display: none"><i class="fa fa-play" aria-hidden="true" title="Resume"></i>
                                </button>
                            </div>
                            <button type="submit" id="submitExam" class="btn btn-light-green w-100 rounded-0 mt-3" onclick="stop('submit');"><span class="btnSubic"><img src="{{URL::asset('public/after_login/new_ui/images/submit-iconn.png')}}"></span>Submit</button>
                            <!--  <a href="{{route('examresult')}}" class="btn btn-danger rounded-0 px-5 my-5">SEE ANALYTIS</a> -->
                        </form>


                        <div style="visibility: hidden;">
                            <p class="rightSectH">Question</p>
                            <div class="number-block">
                                @if(isset($keys) && !empty($keys))
                                @foreach($keys as $ke=>$val)
                                <button type="button" class="next_button btn btn-light rounded-0 mb-4 @php if($activeq_id==$val){echo ' activequestion';} @endphp" id="btn_{{$val}}" onclick="qnext('{{$val}}')">{{$ke+1}}</button>
                                @endforeach
                                @endif
                            </div>

                            <!-- <p class="rightSectH">Legends</p> -->
                            <div class="row mt-4">
                                <div class="col-md-6 legends">
                                    <button class="btn btn-light p-0 rounded-0"> </button>
                                    <p>Unread</p>
                                </div>
                                <div class="col-md-6 legends">
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
</div>
<!-- Modal END Exam -->
<div class="modal fade" id="endExam" tabindex="-1" role="dialog" aria-labelledby="endExam" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 ">
            <div class="modal-body p-5 text-center">
                <div class="text-center py-4">
                    <p class="mb-3">No more questions are available for this chapter, Kindly submit your exam!</p>

                    <button id="bt-modal-confirm_over" type="button" class="btn btn-light-green px-5 rounded-0 mt-3 goto-exam-btn">
                        Submit TEST
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Test_Instruction-->
<div class="modal fade" id="test_instruction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">
                <a type="button" class="btn-close" aria-label="Close" href="{{ url()->previous() }}" title="Close"></a>
            </div>
            <div class="modal-body pt-3 p-5">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="text-danger text-uppercase">{{$test_name}} </h3>
                        <div class="scroll">
                            <div class="test-info">
                                <div class="row justify-content-md-center">

                                    <div class="col col-lg-6 d-flex flex-column align-items-center">
                                        <div>
                                            <small>Subject</small>
                                            <span class="d-block inst-text"><span class="text-danger">{{$tagrets}}</span></span>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 d-flex flex-column align-items-center">
                                        <div>
                                            <small>Duration</small>
                                            <span class="d-block inst-text"><span class="text-danger">{{$exam_fulltime}}</span> Minutes</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <p class="inst mb-3">Please read carefully for any query before starting the test.</p>
                            <div class="instructions pe-3">
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
                    <div class="col-md-4 ps-lg-5 d-flex align-items-center justify-content-center flex-column">

                        <h1 class="my-auto text-center">

                            <span class="d-block mt-3 fw-bold">All the Best! </span><span class="unaaame fw-bold">{{$userData->user_name}}</span>

                        </h1>
                        <div class="text-left   ">

                            <button class="btn  text-uppercase rounded-0 px-5 goto-exam-btn" id="goto-exam-btn" data-bs-dismiss="modal" aria-label="Close">GO FOR IT <i class="fas fa-arrow-right"></i></button>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="FullTest_Exam_Panel_Interface_A" tabindex="-1" role="dialog" aria-labelledby="FullTest_Exam_Panel_Interface_A" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="start()" title="Close"></button>
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
                    <p class="m-0 ms-3"><strong id="lefttime_pop_h"></strong> Left</p>
                </div>
                <h3>You still have <span id="lefttime_pop_s"> </span> left!</h3>
                <p>
                    You haven’t attempted all of the questions. Do you
                    want to have a quick review before you Submit?
                </p>
                <div>
                    <button id="bt-modal-cancel" type="button" onclick="start()" class="btn btn-light px-5 rounded-0 mt-3" data-bs-dismiss="modal">
                        Continue
                    </button>
                    <button id="bt-modal-confirm" type="button" class="btn btn-light-green px-5 rounded-0 mt-3">
                        Submit TEST
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resume-test" tabindex="-1" role="dialog" aria-labelledby="FullTest_Exam_Panel_Interface_A" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content rounded-0">
            <div class="modal-body text-center pt-2 pb-5">
                <div class="d-flex align-items-center w-100 justify-content-center my-3">
                    <button id="bt-modal-cancel" onclick="start();" type="button" class="btn btn-green-custom px-5 rounded-0 mt-3" data-bs-dismiss="modal">
                        Resume Test
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('afterlogin.layouts.footer_new')
<!-- page referesh disabled -->
<script>
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
    });
</script>
<!-- /page referesh disabled -->
<!-- browser back disable -->

<script type="text/javascript">
    $(document).ready(function() {
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
    });
</script>
<!-- /browser back disable -->

<script type="text/javascript">
    $('.number-block').slimscroll({
        height: '20vh'
    });
    $('.answer-block').slimscroll({
        height: '30vh'
    });

    $(window).on('load', function() {
        $('#test_instruction').modal('show');

    });
    $('#goto-exam-btn').click(function() {
        $('#mainDiv').show();
        $('#exam_content_sec').show();
        setboxHeight();
        startTimer();
        questionstartTimer();
        setEachQuestionTime();
    });
    $('.selctbtn').click(function() {
        $('.qoption_error').hide();
    });

    $('.instructions').slimscroll({
        height: '33vh',
        color: '#ff9999',

    });

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
    }

    function stop(type = '') {
        setDisabled(stopBtn);
        removeDisabled(startBtn);
        $(".stop").hide();
        $(".start").show();
        // startBtn.innerHTML = "Continue";
        clearInterval(timerInterval);
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
        console.log(timePassed, timeLeft);

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
        console.log("setCircleDashArray: ", circleDasharray);
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



    /* getting Next Question Data */
    function qnext(question_key) {

        var act_question = $("#current_question").val();
        var q_submit_time = $("#timespend_" + act_question).val();

        saveQuestionTime(act_question, q_submit_time);

        url = "{{ url('ajax_adaptive_question_chapter/') }}/" + question_key;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                "session_id": "{{$session_id}}",
                "chapter_id": "{{$chapter_id}}",

            },
            success: function(result) {
                if (result.status == "success") {
                    clearInterval(ctimer);
                    clearInterval(timer_countdown);
                    clearInterval(setEachQuestionTimeNext_countdown);

                    $("#question_section div").remove();
                    $("#question_section").html(result.html);
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question_section"]);
                } else {
                    $('#endExam').modal('show');
                }
            }
        });
    }


    /* mark or review */
    function markforreview(quest_id, subject_id, chapt_id) {
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
        var question_id = question_id;
        var option_id = [];
        $.each($("input[name='quest_option_" + question_id + "']:checked"), function() {
            option_id.push($(this).val());
        });
        if (option_id.length === 0) {
            $('#qoption_err_' + question_id).html("Please select your response.");
            $('#qoption_err_' + question_id).addClass('text-danger');
            $('#qoption_err_' + question_id).fadeIn('fast');
            return false;
        }

        var q_submit_time = $("#timespend_" + question_id).val();
        $.ajax({
            url: "{{ route('saveAdaptiveAnswer') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                question_id: question_id,
                option_id: option_id,
                q_submit_time: q_submit_time
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);

                if (response.status == 200) {
                    $("#quesnext" + question_id).click();
                    $("#btn_" + question_id).find('i').remove();
                    $("#btn_" + question_id).html(qNo);
                    $("#btn_" + question_id).removeClass("btn-light");
                    $("#btn_" + question_id).addClass("btn-light-green");
                }
            },
        });


    }


    function savemarkreview(quest_id, subject_id, chapt_id) {
        /* saving response */
        if (saveAnswer(quest_id, '') != false) {

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
        }
    }

    function clearResponse(quest_id, subject_id, qNo) {
        var response = [];
        $.each($("input[name='quest_option_" + quest_id + "']:checked"), function() {
            response = $(this).prop('checked', false);
        });

        if (response.length == 0) {
            $('#qoption_err_' + quest_id).html("No option has been selected to clear.");
            $('#qoption_err_' + quest_id).addClass('text-danger');
            $('#qoption_err_' + quest_id).fadeIn('fast');
            return false;
        }

        $("#btn_" + quest_id).addClass("btn-light");
        $("#btn_" + quest_id).removeClass("btn-light-green");
        $("#btn_" + quest_id).removeClass("btn-secondary");

        $.ajax({
            url: "{{ route('adaptiveClearResponse') }}",
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

    /* function get_subject_question(subject_id) {

        url = "{{ url('ajax_next_subject_question/') }}/" + subject_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#question_section").html(result);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question_section"]);
            }
        });


    } */

    function saveQuestionTime(question_id, time) {
        url = "{{ url('saveAdaptiveTimeSession') }}/" + question_id;
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'q_time': time
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);
                if (response.status == 200) {

                }
            }
        });


    }


    /* $('#submitExam').click(function() {

        $('#endExam').modal('show');
    }); */


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
                    console.log("setCircleDashArray: ", circleDasharray);
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