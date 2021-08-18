@extends('afterlogin.layouts.app')
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML-full"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(window).on("load resize scroll", function(e) {
        var winHeight = $(window).height() - 10;
        $('.tab-wrapper').height(winHeight - 82);
        $('.tab-content').height(winHeight - 135);
    });
</script>
@section('content')
<style>
    .activequestion {

        border: 4px solid !important;
        border-color: #ffc107 !important;
    }
</style>

@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$template_type = isset($question_data->template_type)?$question_data->template_type:'';
if($template_type==1){
$type_class='checkboxans';
$questtype='checkbox';
}else{
$type_class='radioans';
$questtype='radio';
}

@endphp

<div class="main-wrapper p-0 bg-gray">

    <div class="content-wrapper " id="exam_content_sec" style="display:none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9  ps-lg-5">

                    <div class="tab-wrapper">
                        <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">

                            @if(!empty($filtered_subject))
                            @foreach($filtered_subject as $key=>$sub)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif " id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true" onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}} ({{$sub->count}})</a>
                            </li>

                            @endforeach
                            @endif
                        </ul>


                        <div class="tab-content bg-white" id="myTabContent">
                            <div id="question_section" class="">
                                <div class="question-block N_question-block">
                                    <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><i class="fa fa-angle-left"></i></button>
                                    <button class="btn arrow next-arow {{empty($next_qid)?'disabled':''}}" id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><i class="fa fa-angle-right"></i></button>
                                    <!-- question -->
                                    <div class="question N_question" id="question_blk"><span class="q-no">Q1.</span>{!! $question_text !!}</div>
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
                                            <input class="form-check-input selctbtn {{$type_class}}" type="{{$questtype}}" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                                            <div class="border ps-3 ans">
                                                <label class="question m-0 py-3   d-block " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
                                            </div>
                                        </div>

                                        @php $no++; @endphp
                                        @endforeach
                                        @endif

                                    </div>
                                    <span class="qoption_error" id="qoption_err_{{$activeq_id}}"></span>
                                </div>
                                <div class="tab-btn-box  d-flex mt-3 N_tab-btn-box">
                                    <div class="N_tab-btn-box_list">
                                        <div style="float:left">
                                        <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer" onclick="saveAnswer('{{$activeq_id}}')">Save & Next</button>
                                        <button class="btn px-4 ms-2 btn-light rounded-0 btn-secon-clear savemarkreview" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}')">Save & Mark for review</button>
                                        </div>
                                        <div style="float:right">
                                        <button class="btn px-4 ms-2 btn-secon-clear btn-light rounded-0 " onclick="markforreview('{{$activeq_id}}','{{$subject_id}}')">Mark for review</button>
                                        <button class="btn px-4 ms-2 btn-secon-clear act rounded-0">Clear Response</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 ">
                    <div class="bg-white d-flex flex-column justify-content-center mb-4 N_timer">
                        <div class="d-flex align-items-center">
                            <div id="app">
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
                                    <i class="fa fa-stopwatch-20 watch-icon"></i>
                                </div>
                            </div>
                            <span class="timing">
                                <span id="base-timer-label" class="base-timer__label"></span> Time left
                            </span>
                        </div>

                        <button type="button" id="submitExam" class="btn btn-light-green w-100 rounded-0 mt-3">Submit</button>
                    </div>
                    <div class="bg-white d-flex flex-column justify-content-center mb-4  py-4 px-4">
                        <p><b>Question Palette</b></p>
                        <div class="number-block N_number-block">
                            @if(isset($keys) && !empty($keys))
                            @foreach($keys as $ke=>$val)
                            <button type="button" class="next_button btn btn-light rounded-0 mb-4 @php if($activeq_id==$val){echo ' activequestion';} @endphp" id="btn_{{$val}}" onclick="qnext('{{$val}}')">
                                {{$ke+1}}</button>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="bg-white d-flex flex-column justify-content-center mb-4  py-4 px-4 N_legends">
                        <p>Legends</p>
                        <div class="d-flex align-items-center legends">
                            <button class="btn btn-light  rounded-0"> </button>
                            <p>Unread</p>
                        </div>
                        <div class="d-flex align-items-center  legends">
                            <button class="btn btn-light-green rounded-0"> </button>
                            <p>Answered </p>
                        </div>
                        <div class="d-flex align-items-center  legends">
                            <button class="btn btn-secondary   rounded-0"> </button>
                            <p>Marked for Review</p>
                        </div>
                        <div class="d-flex align-items-start legends">
                            <button class="btn btn-secondary p-0 rounded-0"><i class="fa fa-check text-light"></i></button>
                            <p>Answered & Marked for Review</p>
                        </div>

                    </div>
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
                <a type="button" class="btn-close" aria-label="Close" href="{{url('/dashboard')}}"></a>
            </div>
            <div class="modal-body pt-3 p-6">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="text-danger text-uppercase"><img src="{{URL::asset('public/after_login/images/write.png')}}" style="    vertical-align: bottom;margin-right:10px;">{{$exam_name}}</h1>
                        <div class="scroll">
                            <div class="test-info">
                                <div class="row justify-content-md-center">
                                    <div class="col col-lg-4 d-flex   align-items-center">
                                        <div class="me-2"><img src="{{URL::asset('public/after_login/images/edit-pencil.png')}}"></div>
                                        <div>
                                            <small>No. Of Questions</small>
                                            <span class="d-block inst-text"><span class="text-danger">{{$questions_count}} MCQ</span> Questions</span>
                                        </div>
                                    </div>
                                    <div class="col col-lg-4 d-flex flex-column align-items-center">
                                        <div>
                                            <small>Target</small>
                                            <span class="d-block inst-text"><span class="text-danger">{{$tagrets}}</span></span>
                                        </div>
                                    </div>
                                    <div class="col col-lg-4 d-flex   align-items-center">
                                        <div class="me-2 ms-auto"><img src="{{URL::asset('public/after_login/images/timmer.png')}}"></div>
                                        <div>
                                            <small>Duration</small>
                                            <span class="d-block inst-text"><span class="text-danger">{{$exam_fulltime}}</span> Minutes</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <p class="inst mb-5">(Please Read Carefully for any query before starting the test. Thank you.)</p>
                            <div class="instructions pe-3">
                                <h3 class="text-uppercase">Instructions</h3>
                                <p>This will give multiple opportunities to the candidates to improve their scores in the
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

                            <span class="d-block mt-3 fw-bold">All the Best! {{Auth::user()->user_name}}</span>

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
</div>


<!-- Modal END Exam -->
<div class="modal fade" id="endExam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 ">
            <div class="modal-header border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 text-center">
                <div class="text-center py-4">


                </div>
                <h2 class="mb-3">Awesome!</h2>
                <p>You Did It! Let's See How You Did.</p>
                <form id="form_exam_submit" action="{{route('exam_result')}}" method="post">
                    @csrf
                    <input type="hidden" name="fulltime" value="00:30:00">
                    <input type="hidden" name="submit_time" value="00:10:00">
                    <button type="submit" class="btn btn-danger rounded-0 px-5 my-5">SEE ANALYTIS</button>
                    <!--  <a href="{{route('examresult')}}" class="btn btn-danger rounded-0 px-5 my-5">SEE ANALYTIS</a> -->
                </form>


            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="FullTest_Exam_Panel_Interface_A" tabindex="-1" aria-labelledby="FullTest_Exam_Panel_Interface_A" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-5">
                <div class="
                            d-flex
                            align-items-center
                            w-100
                            justify-content-center
                            my-3
                          ">
                    <span>timmer</span>
                    <p class="m-0 ms-3"><strong>38 mins </strong>Left</p>
                </div>
                <h3>You still have 38mins left!</h3>
                <p>
                    You haven’t attempted all of the questions. Do you
                    want to have a quick review before you Submit?
                </p>
                <div>
                    <button type="button" class="btn btn-light px-5 rounded-0 mt-3" data-bs-dismiss="modal">
                        Review
                    </button>
                    <button type="button" class="btn btn-light-green px-5 rounded-0 mt-3">
                        Submit TEST
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



@include('afterlogin.layouts.footer')

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
        if (withReset) {
            resetVars();
        }
        startTimer();
    }

    function stop() {
        setDisabled(stopBtn);
        removeDisabled(startBtn);
        startBtn.innerHTML = "Continue";
        clearInterval(timerInterval);
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            timePassed = timePassed += 1;
            timeLeft = TIME_LIMIT - timePassed;
            timeLabel.innerHTML = formatTime(timeLeft);
            setCircleDasharray();

            if (timeLeft === 0) {
                timeIsUp();
            }
        }, 1000);
    }

    window.addEventListener("load", () => {
        startTimer();
        timeLabel.innerHTML = formatTime(TIME_LIMIT);
        setDisabled(stopBtn);
    });

    //---------------------------------------------
    //HELPER METHODS
    //---------------------------------------------
    function setDisabled(button) {
        button.setAttribute("disabled", "disabled");
    }

    function removeDisabled(button) {
        button.removeAttribute("disabled");
    }

    function timeIsUp() {
        setDisabled(startBtn);
        removeDisabled(stopBtn);
        clearInterval(timerInterval);
        let confirmReset = confirm("Time is UP! Wanna restart?");
        if (confirmReset) {
            reset();
            startTimer();
        } else {
            reset();
        }
    }

    function resetVars() {
        removeDisabled(startBtn);
        setDisabled(stopBtn);
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




    /* getting Next Question Data */
    function qnext(question_id) {

        url = "{{ url('ajax_next_question/') }}/" + question_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#question_section").html(result);

            }
        });
    }


    /* mark or review */
    function markforreview(quest_id, subject_id) {
        $.ajax({
            url: "{{ route('markforreview') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                question_id: quest_id,
                subject_id: subject_id,
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);

                if (response.success == true) {
                    $("#btn_" + quest_id).removeClass("btn-light");
                    $("#btn_" + quest_id).addClass("btn-secondary");
                } else {

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

        $.ajax({
            url: "{{ route('saveAnswer') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                question_id: question_id,
                option_id: option_id,
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);

                if (response.status == 200) {
                    $("#btn_" + question_id).removeClass("btn-light");
                    $("#btn_" + question_id).addClass("btn-light-green");
                    $("#quesnext" + question_id).click();
                }
            },
        });
    }


    function savemarkreview(quest_id, subject_id) {
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
                },
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);
                    console.log(response);
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

    function get_subject_question(subject_id) {

        url = "{{ url('ajax_next_subject_question/') }}/" + subject_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#question_section").html(result);
            }
        });


    }


    $('#submitExam').click(function() {

        $('#endExam').modal('show');
    });
</script>

@endsection