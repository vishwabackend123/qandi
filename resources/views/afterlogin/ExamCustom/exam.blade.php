@extends('afterlogin.layouts.app')

@section('content')
<style>
    .question p {
        display: inline;
    }
</style>
@php
$question_text = isset($question_data->question)?$question_data->question:'';

@endphp
<div class="main-wrapper p-0 bg-gray">

    <div class="content-wrapper py-4 ps-4" id="exam_content_sec" style="display:none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9  ">

                    <div class="tab-wrapper h-100">
                        <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mathematics</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Physics</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Chemistry</a>
                            </li>
                        </ul>

                        <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="question-block">
                                    <a href="#" class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}"><i class="fa fa-angle-left"></i></a>
                                    <a href="#" class="btn arrow next-arow {{empty($next_qid)?'disabled':''}}"><i class="fa fa-angle-right"></i></a>
                                    <p class="question pb-5 pt-5" id="question_blk"><span class="q-no">Q1.</span>{!! $question_text !!}</p>
                                    <div class="ans-block row mt-5">
                                        @if(isset($question_data->question_options) && !empty($question_data->question_options))
                                        @php $optiosArr=json_decode($question_data->question_options); @endphp
                                        @foreach($optiosArr as $key=>$opt_value)
                                        @php
                                        $dom = new DOMDocument();
                                        @$dom->loadHTML($opt_value);
                                        $anchor = $dom->getElementsByTagName('img')->item(0);
                                        $text = isset($anchor)? $anchor->getAttribute('alt') : '';
                                        $latex = "https://math.now.sh?from=".$text;
                                        $view_opt='<img src="'.$latex.'" />' ;
                                        @endphp
                                        <div class="col-md-6 mb-4">
                                            <div class="border p-3 ans">
                                                <p class="question m-0  "><span class="q-no mr-1">{{$key}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif

                                    </div>
                                </div>
                                <div class="tab-btn-box  d-flex   mt-3">
                                    <a href="#" class="btn px-5   btn-light-green rounded-0">Save & Next</a>
                                    <a href="#" class="btn px-4   ms-2 btn-light rounded-0">Save & Mark for review</a>
                                    <a href="#" class="btn px-4 ms-auto me-2 btn-light rounded-0">Mark for review</a>
                                    <a href="#" class="btn px-4   me-2 btn-secondary rounded-0">Clear Response</a>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="bg-white d-flex flex-column justify-content-center mb-4   p-5">
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
                                30min <br>
                                <span id="base-timer-label" class="base-timer__label"></span> Time left
                            </span>
                        </div>
                        <a href="{{route('exam_result')}}" class="btn btn-light-green w-100 rounded-0 mt-3">Submit</a>
                    </div>
                    <div class="bg-white d-flex flex-column justify-content-center mb-4  py-4 px-4">
                        <p>Question Palette</p>
                        <div class="number-block">
                            <button class="btn btn-secondary  mb-4 rounded-0">1</button>
                            <button class="btn btn-secondary  mb-4 rounded-0">2</button>
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
                            <button class="btn btn-light-green  mb-4 rounded-0">15</button>
                        </div>
                    </div>
                    <div class="bg-white d-flex flex-column justify-content-center mb-4  py-4 px-4">
                        <p>Legends</p>
                        <div class="d-flex align-items-center legends  mb-4">
                            <button class="btn btn-light  rounded-0"> </button>
                            <p>Unread</p>
                        </div>
                        <div class="d-flex align-items-center  mb-4  legends">
                            <button class="btn btn-light-green rounded-0"> </button>
                            <p>Answered </p>
                        </div>
                        <div class="d-flex align-items-center  mb-4  legends">
                            <button class="btn btn-secondary   rounded-0"> </button>
                            <p>Marked for Review</p>
                        </div>
                        <div class="d-flex align-items-start legends">
                            <button class="btn btn-secondary p-0 rounded-0"><i class="fa fa-check text-light"></i></button>
                            <p>Answered & <br>Marked for Review</p>
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
                            <h1 class="text-danger text-uppercase">Mock Test - III</h1>
                            <div class="scroll">
                                <div class="test-info">
                                    <div class="row justify-content-md-center">
                                        <div class="col col-lg-4 d-flex flex-column align-items-center">
                                            <div>
                                                <small>No. Of Questions</small>
                                                <span class="d-block inst-text"><span class="text-danger">90 MCQ</span> Questions</span>
                                            </div>
                                        </div>
                                        <div class="col col-lg-4 d-flex flex-column align-items-center">
                                            <div>
                                                <small>Target</small>
                                                <span class="d-block inst-text"><span class="text-danger">Wave Theory</span></span>
                                            </div>
                                        </div>
                                        <div class="col col-lg-4 d-flex flex-column align-items-center">
                                            <div>
                                                <small>Duration</small>
                                                <span class="d-block inst-text"><span class="text-danger">180</span> Minutes</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p class="inst mb-5">Please Read Carefully for any query before starting the test. Thank you.</p>
                                <div class="instructions pe-3">
                                    <h3>Instructions</h3>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et</p>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et</p>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ps-lg-5 d-flex align-items-center justify-content-center flex-column">

                            <h1 class="my-auto">All the Best! Anuj </h1>
                            <div class="text-left   ">

                                <button class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-exam-btn" data-bs-dismiss="modal" aria-label="Close">GO FOR IT <i class="fas fa-arrow-right"></i></button>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



@include('afterlogin.layouts.footer')

<script type="text/javascript">
    $(window).on('load', function() {
        $('#test_instruction').modal('show');

    });
    $('#goto-exam-btn').click(function() {
        $('#exam_content_sec').show();
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
    const TIME_LIMIT = 1800; //in seconds
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

        return `${minutes}:${seconds}`;
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
</script>

@endsection