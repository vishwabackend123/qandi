@extends('afterlogin.layouts.app_new')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- BS JavaScript -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- Have fun using Bootstrap JS -->
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
    #exam_content_sec .container {
        max-width: 1280px;

    }

    #exam_content_sec .tab-content {
        overflow-y: auto;

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

<div class="main-wrapper" style="padding-left:0px;">
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
                                    <div class="d-flex ">
                                        <div id="counter_{{$activeq_id}}" class="ms-auto counter mb-4 d-flex">
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
                                        <a href="javascript:void(0);" {{empty($prev_qKey)?'disabled':''}} id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qKey}}')" class="arrow prev-arow {{empty($prev_qKey)?'disabled':''}}"><i class="fa fa-angle-left"></i></a>
                                        <a href="javascript:void(0);" class="arrow next-arow {{empty($next_qKey)?'disabled':''}}" {{empty($next_qKey)?'disabled':''}} id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qKey}}')"><i class="fa fa-angle-right"></i></a>
                                        <!-- Next and previous button -->

                                        <sapn class="question_difficulty_tag small">
                                            <span class="small me-2">Subject Id: {!! $subject_id !!}</span> |
                                            <span class="small mx-2">Chapter Id: {!! $chapter_id !!}</span> |
                                            <span class="small mx-2">Topic Id: {!! $topic_id !!}</span> |
                                            <span class="small mx-2">Question Id: {!! $activeq_id !!}</span> |
                                            <span class="small mx-2">Track: {!! $track !!}</span> |
                                            <span class="small ms-2">Difficulty Level: {!! $difficulty_level !!}</span>
                                        </sapn>

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
                                    <div class="tab-btn-box  d-flex mt-3">
                                        @if(!empty($next_qKey))
                                        <a href="javascript:void(0);" class="btn px-5   btn-light-green rounded-0 saveanswer" onclick="saveAnswer('{{$activeq_id}}')">Save & Next</a>
                                        @else
                                        <button class="btn px-5   btn-light-green rounded-0 saveanswer" onclick="saveAnswer('{{$activeq_id}}')">Save & Submit
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
                        <form id="form_exam_submit" action="{{route('adaptive_chapter_exam_result')}}" method="post">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$session_id}}">
                            <input type="hidden" name="chapter_id" value="{{$chapter_id}}">
                            <div class="pull-right">
                                <button type="button" class="btn btn-outline-danger stop" onclick="stop();"><i class="fa fa-pause" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-outline-success start" onclick="start();" style="display: none"><i class="fa fa-play" aria-hidden="true"></i>
                                </button>
                            </div>
                            <button type="submit" id="submitExam" class="btn btn-light-green w-100 rounded-0 mt-3">Submit</button>
                            <!--  <a href="{{route('examresult')}}" class="btn btn-danger rounded-0 px-5 my-5">SEE ANALYTIS</a> -->
                        </form>


                        <div style=" min-height:300px">
                            <p class="rightSectH" style="display:none;">Question Palette</p>
                            <div class="number-block1" style="display:none;">
                                @if(isset($keys) && !empty($keys))
                                @foreach($keys as $ke=>$val)
                                <button type="button" class="next_button btn btn-light rounded-0 mb-4 @php if($activeq_id==$val){echo ' activequestion';} @endphp" id="btn_{{$val}}" onclick="qnext('{{$val}}')">{{$ke+1}}</button>
                                @endforeach
                                @endif
                            </div>

                            <p class="rightSectH" style="display:none;">Legends</p>
                            <div class="row" style="display:none;">
                                <div class="col-md-6 legends">
                                    <button class="btn btn-light  rounded-0"> </button>
                                    <p>Unread</p>
                                </div>
                                <div class="col-md-6 legends">
                                    <button class="btn btn-light-green rounded-0"> </button>
                                    <p>Answered </p>
                                </div>
                            </div>
                            <div class="row" style="display:none;">
                                <div class="col-md-6 legends">
                                    <button class="btn btn-secondary   rounded-0"> </button>
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
<div class="modal hide fade in" id="endExam" tabindex="-1" aria-labelledby="exampleModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 ">

            <div class="modal-body pt-0 text-center">
                <div class="text-center py-4">
                    <p class="mb-3">No more questions are available for this chapter, Kindly submit your exam!</p>

                    <button id="bt-modal-confirm_over" type="button" class="btn btn-light-green px-5 rounded-0 mt-3">
                        Submit TEST
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="FullTest_Exam_Panel_Interface_A" tabindex="-1" role="dialog" aria-labelledby="FullTest_Exam_Panel_Interface_A" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button id="bt-modal-cancel" type="button" class="btn btn-light px-5 rounded-0 mt-3" data-bs-dismiss="modal">
                        Review
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
<!-- browser back disable -->
<script>
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button"; //again because google chrome don't insert first hash into history
    window.onhashchange = function() {
        window.location.hash = "no-back-button";
    }
</script>
<script type="text/javascript">
    history.pushState(null, null, location.href);
    history.back();
    history.forward();
    window.onpopstate = function() {
        history.go(1);
    };
</script>
<!-- browser back disable -->

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
        $('#exam_content_sec').show();
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
        railVisible: true,
        alwaysVisible: true
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

    function stop() {
        setDisabled(stopBtn);
        removeDisabled(startBtn);
        $(".stop").hide();
        $(".start").show();
        // startBtn.innerHTML = "Continue";
        clearInterval(timerInterval);
        $("#resume-test").modal("show");
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
    function saveAnswer(question_id) {
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
                    $("#btn_" + question_id).removeClass("btn-light");
                    $("#btn_" + question_id).addClass("btn-light-green");
                }
            },
        });


    }


    function savemarkreview(quest_id, subject_id, chapt_id) {
        /* saving response */
        if (saveAnswer(quest_id) != false) {

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
                form.submit();
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