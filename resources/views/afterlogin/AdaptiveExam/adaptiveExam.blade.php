@extends('afterlogin.layouts.app')
<style>
    html {
        user-select: none;
    }
</style>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- BS JavaScript -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
    $(window).load(function () {
        $("#endExam").modal({
            backdrop: "static",
            keyboard: false
        });

        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    });
</script>
@section('content')
    @php
        $userData = Session::get('user_data');

    @endphp

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(window).on("load resize ", function (e) {
            var winHeight = $(window).height() - 10;
            $('.tab-wrapper').height(winHeight - 90);
            $('.tab-content').height(winHeight - 130);
        });

        /*  $(window).bind("cut copy paste contextmenu", function(e) {
             e.preventDefault();
         }); */
    </script>

    @php
        $question_text = isset($question_data->question)?$question_data->question:'';
        $subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
        $chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
        $topic_id = isset($question_data->topic_id)?$question_data->topic_id:0;
        $template_type = isset($question_data->template_type)?$question_data->template_type:'';
        $difficulty_level = isset($question_data->difficulty_level)?$question_data->difficulty_level:1;


        if($template_type==1){
        $type_class='checkboxans';
        $questtype='checkbox';
        }else{
        $type_class='radioans';
        $questtype='radio';
        }
    @endphp
    <style>
        #exam_content_sec .container {
            max-width: 1280px;
        }

        #exam_content_sec .tab-content {
            overflow-y: auto;

        }

        /*
        .N_radioans p,
        .N_radioans span {
            font: normal normal normal 18px/28px Poppins !important;
            flex-wrap: wrap !important;
            display: flex;
        } */
    </style>

    <div class="main-wrapper p-0 bg-gray">

        <div class="content-wrapper " id="exam_content_sec" style="display:none;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">

                        <div class="tab-wrapper">
                            <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">

                                @if(!empty($filtered_subject))
                                    @foreach($filtered_subject as $key=>$sub)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif "
                                               id="{{$sub->subject_name}}-tab" data-bs-toggle="tab"
                                               href="#{{$sub->subject_name}}" role="tab"
                                               aria-controls="{{$sub->subject_name}}" aria-selected="true"
                                               onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}}
                                                ({{$sub->count}})</a>
                                        </li>

                                    @endforeach
                                @endif
                            </ul>
                            <div class="tab-content bg-white " id="myTabContent">

                                <input type="hidden" id="current_question" value="{{$activeq_id}}"/>


                                <div id="question_section" class="">
                                    <div>
                                        <div class="d-flex d-none-imp">
                                            <div id="counter_{{$activeq_id}}" class="ms-auto counter mb-4 d-flex">
                                                <span id="avg_text">Average Time :</span>
                                                <div id="progressBar_{{$activeq_id}}"
                                                     class="progressBar_first tiny-green ms-2">
                                                    <span class="seconds" id="seconds_{{$activeq_id}}"></span>
                                                    <div id="percentBar_{{$activeq_id}}"></div>
                                                </div>
                                                <div class="time_taken_css" id="q_time_taken_first"
                                                     style="display:none;"><span>Time taken : </span><span
                                                        id="up_minutes"></span>:<span id="up_seconds"></span>mins
                                                </div>
                                            </div>
                                            <input type="hidden" name="question_spendtime" class="timespend_first"
                                                   id="timespend_{{ $activeq_id }}" value=" "/>
                                        </div>

                                        <div class="question-block N_question-block">
                                            <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}"
                                                    id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><img
                                                    src="{{URL::asset('public/after_login/images/arrowExamLeft_ic.png')}}"/>
                                            </button>
                                            <button class="btn arrow next-arow {{empty($next_qid)?'disabled':''}}"
                                                    {{empty($next_qid)?'disabled':''}} id="quesnext{{ $activeq_id }}"
                                                    onclick="qnext('{{$next_qid}}')"><img
                                                    src="{{URL::asset('public/after_login/images/arrowExamRight_ic.png')}}"/>
                                            </button>
                                            <!-- question -->

                                            <sapn class="question_difficulty_tag small">
                                                <span class="small me-2">Subject Id: {!! $subject_id !!}</span> |
                                                <span class="small mx-2">Chapter Id: {!! $chapter_id !!}</span> |
                                                <span class="small mx-2">Topic Id: {!! $topic_id !!}</span> |
                                                <span class="small mx-2">Question Id: {!! $activeq_id !!}</span> |
                                                <span class="small ms-2">Difficulty Level: {!! $difficulty_level !!}</span>
                                            </sapn>
                                            <div class="question N_question" id="question_blk"><span
                                                    class="q-no">Q1.</span>{!! $question_text !!}</div>
                                            <!-- options -->
                                            <div class="ans-block row mt-5 N_radioans">
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
                                                            <input class="form-check-input selctbtn quest_option_{{$activeq_id}} {{$type_class}}"
                                                                   type="{{$questtype}}"
                                                                   id="option_{{$activeq_id}}_{{$key}}"
                                                                   name="quest_option_{{$activeq_id}}" value="{{$key}}">
                                                            <div class=" ps-5 ans">
                                                                <label class="question m-0 py-3   d-block "
                                                                       for="option_{{$activeq_id}}_{{$key}}"><span
                                                                        class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}
                                                                </label>
                                                            </div>
                                                        </div>

                                                        @php $no++; @endphp
                                                    @endforeach
                                                @endif

                                            </div>
                                            <span class="qoption_error" id="qoption_err_{{$activeq_id}}"></span>
                                        </div>
                                        <div class="tab-btn-box  d-flex N_tab-btn-box">
                                            <div class="N_tab-btn-box_list">
                                                <div class="ps-3" style="float:left">
                                                    @if(!empty($next_qid))
                                                        <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer text-capitalize"
                                                                onclick="saveAnswer('{{$activeq_id}}')">Save & Next
                                                        </button>
                                                    @else
                                                        <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer text-capitalize"
                                                                onclick="saveAnswer('{{$activeq_id}}')"
                                                                data-toggle="modal"
                                                                data-target="#FullTest_Exam_Panel_Interface_A">Save &
                                                            Submit
                                                        </button>
                                                    @endif
                                                    <button class="btn px-4 ms-2 btn-light rounded-0 btn-secon-clear savemarkreview text-capitalize"
                                                            onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}')">
                                                        Save & Mark for review
                                                    </button>
                                                </div>
                                                <div class="pe-3" style="float:right">
                                                    <button class="btn px-4 ms-2 btn-secon-clear btn-light rounded-0 text-capitalize"
                                                            onclick="markforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')">
                                                        Mark for review
                                                    </button>
                                                    <button class="btn px-4 ms-2 btn-secon-clear act rounded-0 text-capitalize"
                                                            onclick="clearResponse('{{$activeq_id}}','{{$subject_id}}',1)">
                                                        Clear Response
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 ">
                        <div class="bg-white d-flex flex-column justify-content-center palette_box N_timer">
                            <div class="d-flex align-items-center">
                                <div id="app">
                                    <div class="base-timer">
                                        <svg class="base-timer__svg" viewBox="0 0 100 100"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g class="base-timer__circle">
                                                <circle class="base-timer__path-elapsed" cx="50" cy="50"
                                                        r="45"></circle>
                                                <path id="base-timer-path-remaining" stroke-dasharray="283"
                                                      class="base-timer__path-remaining arc" d="
                                     M 50, 50
                                     m -45, 0
                                     a 45,45 0 1,0 90,0
                                     a 45,45 0 1,0 -90,0
                                     "></path>
                                            </g>
                                        </svg>
                                        <img class="watch-icon"
                                             src="{{URL::asset('public/after_login/images/timer_Exam_page_ic.png')}}"/>
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
                                <input type="hidden" name="planner_id" value="0">
                                <input type="hidden" name="live_exam_id" value="0">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-outline-danger stop"
                                            onclick="stop();"><i class="fa fa-pause" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-success start"
                                            onclick="start();" style="display: none"><i class="fa fa-play"
                                                                                        aria-hidden="true"></i>
                                    </button>
                                </div>
                                <button type="submit" id="submitExam" class="btn btn-light-green w-100 rounded-0 mt-3">
                                    Submit
                                </button>
                            <!--  <a href="{{route('examresult')}}" class="btn btn-danger rounded-0 px-5 my-5">SEE ANALYTIS</a> -->
                            </form>


                        </div>
                        <div class="bg-white d-flex flex-column justify-content-center palette_box">
                            <p class="palette-hd">Question Palette</p>
                            <div id="number_block_id" class="number-block N_number-block">
                                @if(isset($keys) && !empty($keys))
                                    @foreach($keys as $ke=>$val)
                                        <button type="button"
                                                class="next_button btn btn-light rounded-0 mb-4 @php if($activeq_id==$val){echo ' activequestion';} @endphp"
                                                id="btn_{{$val}}" onclick="qnext('{{$val}}')">
                                            {{$ke+1}}</button>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="bg-white d-flex flex-column justify-content-center palette_box N_legends">
                            <p class="palette-hd">Legends</p>

                            <div class="d-flex align-items-center legends">
                                <button class="btn btn-light  rounded-0"></button>
                                <p>Unread</p>
                            </div>
                            <div class="d-flex align-items-center  legends">
                                <button class="btn btn-light-green rounded-0"></button>
                                <p>Answered </p>
                            </div>
                            <div class="d-flex align-items-center  legends">
                                <button class="btn btn-secondary   rounded-0"></button>
                                <p>Marked for Review</p>
                            </div>
                            <div class="d-flex align-items-start legends">
                                <button class="btn btn-secondary rounded-0 align-items-center"><img
                                        src="{{URL::asset('public/after_login/images/rightWhite_ic.png')}}"/>
                                </button>
                                <p>Answered & Marked for Review</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Test_Instruction-->
    <div class="modal fade" id="test_instruction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
         data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded-0">
                <div class="modal-header pb-0 border-0">
                    <a type="button" class="btn-close" aria-label="Close" href="{{ url()->previous() }}"></a>
                </div>
                <div class="modal-body pt-3 p-5">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="text-danger text-uppercase">{{isset($exam_name)?$exam_name:'Full Body Scan Test'}}</h1>
                            <div class="scroll">
                                <div class="test-info">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-5 col-lg-5 d-flex   align-items-center">
                                            <div class="me-2"></div>
                                            <div>
                                                <small>No. Of Questions</small>
                                                <span class="d-block inst-text"><span class="text-danger">{{$questions_count}} MCQ</span> Questions</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 d-flex  align-items-center ms-auto me-left">
                                            <div>
                                                <small>Target</small>
                                                <span class="d-block inst-text"><span
                                                        class="text-danger">{{$tagrets}}</span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 d-flex   align-items-center">
                                            <div class="me-2 ms-auto"></div>
                                            <div>
                                                <small>Duration</small>
                                                <span class="d-block inst-text"><span
                                                        class="text-danger">{{$exam_fulltime}}</span> Minutes</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p class="inst mb-3">(Please Read Carefully for any query before starting the test.
                                    Thank you.)</p>
                                <div class="instructions pe-3">
                                    <h3 class="text-uppercase">Instructions</h3>
                                    <p>This will give multiple opportunities to the candidates to improve their scores
                                        in the
                                        examination if they are not able to give their best in one attempt</p>
                                    <p>In first attempt, the students will get a first-hand experience of taking an
                                        examination and will know their mistakes which they can improve while attempting
                                        for the next time.</p>
                                    <p>This will reduce the chances of dropping a year and droppers would not have to
                                        waste a full year.</p>
                                    <p>If anyone missed the examination due to reasons beyond control (such as Board
                                        examination), then he/she will not have to wait for one full year.</p>
                                    <p> A candidate need not appear in all the four Sessions</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ps-lg-5 d-flex align-items-center justify-content-center flex-column">

                            <h1 class="my-auto text-center">

                                <span class="d-block mt-3 fw-bold">All the Best! {{$userData->user_name}}</span>

                            </h1>
                            <div class="text-left   ">

                                <button class="btn  text-uppercase rounded-0 px-5 goto-exam-btn" id="goto-exam-btn"
                                        data-bs-dismiss="modal" aria-label="Close">GO FOR IT <i
                                        class="fas fa-arrow-right"></i></button>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>


    <!-- Modal END Exam -->
    <div class="modal hide fade in" id="endExam" tabindex="-1" aria-labelledby="exampleModalLabel" data-keyboard="false"
         data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 ">

                <div class="modal-body pt-0 text-center">
                    <div class="text-center py-4">
                        <h2 class="mb-3">Time Over!</h2>

                        <button id="bt-modal-confirm_over" type="button"
                                class="btn btn-light-green px-5 rounded-0 mt-3">
                            Submit TEST
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="FullTest_Exam_Panel_Interface_A" tabindex="-1" role="dialog"
         aria-labelledby="FullTest_Exam_Panel_Interface_A" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
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
                                        <path id="base-timer-path-remaining_alt" stroke-dasharray="283"
                                              class="base-timer__path-remaining arc" d="
                                     M 50, 50
                                     m -45, 0
                                     a 45,45 0 1,0 90,0
                                     a 45,45 0 1,0 -90,0
                                     "></path>
                                    </g>
                                </svg>
                                <img class="watch-icon"
                                     src="{{URL::asset('public/after_login/images/timer_Exam_page_ic.png')}}"/>
                            </div>
                        </div>
                        <p class="m-0 ms-3"><strong id="lefttime_pop_h"></strong> Left</p>
                    </div>
                    <h3>You still have <span id="lefttime_pop_s"> </span> left!</h3>
                    <p>
                        Do you want to review all your answers before you submit the test?
                    </p>
                    <div>
                        <button id="bt-modal-cancel" type="button" class="btn btn-light px-5 rounded-0 mt-3"
                                data-bs-dismiss="modal">
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

    <div class="modal fade" id="resume-test" tabindex="-1" role="dialog"
         aria-labelledby="FullTest_Exam_Panel_Interface_A" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content rounded-0">
                <div class="modal-body text-center pt-2 pb-5">
                    <div class="d-flex align-items-center w-100 justify-content-center my-3">
                        <button id="bt-modal-cancel" onclick="start();" type="button" class="btn btn-green-custom px-5 rounded-0 mt-3"
                                data-bs-dismiss="modal">
                            Resume Test
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('afterlogin.layouts.footer')

    <script type="text/javascript"
            src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML-full"></script>


    <script type="text/javascript">
        $('.number-block').slimscroll({
            height: '20vh'
        });

        $('.answer-block').slimscroll({
            height: '30vh'
        });

        $(window).on('load', function () {
            $('#test_instruction').modal('show');

        });
        $('#goto-exam-btn').click(function () {
            $('#exam_content_sec').show();
            startTimer();
            questionstartTimer();
            setEachQuestionTime();
        });
        $('.selctbtn').click(function () {
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

            timer_countdown = setInterval(function () {
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
            setEachQuestionTimeNext_countdown = setInterval(function () {
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
                success: function (result) {
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
            $.ajax({
                url: "{{ route('markforreview') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    question_id: quest_id,
                    subject_id: subject_id,
                    chapter_id: chapt_id
                },
                success: function (response_data) {
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
            $.each($("input[name='quest_option_" + question_id + "']:checked"), function () {
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
                url: "{{ route('saveAnswer') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    question_id: question_id,
                    option_id: option_id,
                    q_submit_time: q_submit_time
                },
                success: function (response_data) {
                    var response = jQuery.parseJSON(response_data);

                    if (response.status == 200) {
                        $("#btn_" + question_id).removeClass("btn-light");
                        $("#btn_" + question_id).addClass("btn-light-green");
                    }
                },
            });
            if ($("#quesnext" + question_id).is(":disabled") == true) {

                $("#submitExam").click();
            } else {
                $("#quesnext" + question_id).click();

            }
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
                    success: function (response_data) {
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
            $.each($("input[name='quest_option_" + quest_id + "']:checked"), function () {
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
                url: "{{ route('clearResponse') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    question_id: quest_id,
                    subject_id: subject_id,
                },
                success: function (response_data) {
                    var response = jQuery.parseJSON(response_data);
                    if (response.status == 200) {
                        $("#btn_" + quest_id).find('i').remove();
                        $("#btn_" + quest_id).html(qNo);
                    }

                },
            });

        }

        function get_subject_question(subject_id) {

            url = "{{ url('adaptive_next_subject_question/') }}/" + subject_id;
            $.ajax({
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (result) {
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
                success: function (response_data) {
                    var response = jQuery.parseJSON(response_data);
                    if (response.status == 200) {

                    }
                }
            });


        }


        $(document).ready(function () {
            $("#form_exam_submit").validate({

                submitHandler: function (form) {
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

            $('#bt-modal-confirm').click(function () {

                $('#form_exam_submit')[0].submit();
            });
            $('#bt-modal-confirm_over').click(function () {

                $('#form_exam_submit')[0].submit();
            });
        });
    </script>

@endsection
