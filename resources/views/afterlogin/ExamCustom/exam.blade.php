@extends('afterlogin.layouts.app')

@section('content')
<style>
    .question p {
        display: inline;
    }
</style>
@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;

@endphp
<div class="main-wrapper p-0 bg-gray">

    <div class="content-wrapper py-4 ps-4" id="exam_content_sec" style="display:none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9  ">

                    <div class="tab-wrapper h-100">
                        <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                            <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">

                                @if(!empty($filtered_subject))
                                @foreach($filtered_subject as $key=>$sub)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif " id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true" onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}}</a>
                                </li>

                                @endforeach
                                @endif
                            </ul>
                        </ul>

                        <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                            <div id="question_section">
                                <div class="question-block py-3">
                                    <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><i class="fa fa-angle-left"></i></button>
                                    <button class="btn arrow next-arow {{empty($next_qid)?'disabled':''}}" id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><i class="fa fa-angle-right"></i></button>
                                    <div class="question pb-5 pt-5" id="question_blk"><span class="q-no">Q1.</span>{!! $question_text !!}</div>
                                    <div class="ans-block row mt-5">
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
                                            <input class="form-check-input radioans" type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
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
                                <div class="tab-btn-box  d-flex   mt-3">
                                    <button class="btn px-5   btn-light-green rounded-0 saveanswer" onclick="saveAnswer('{{$activeq_id}}')">Save & Next</button>
                                    <button href=" #" class="btn px-4   ms-2 btn-light rounded-0 savemarkreview" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}')">Save & Mark for review</button>
                                    <button class="btn px-4 ms-auto me-2 btn-light rounded-0 " onclick="markforreview('{{$activeq_id}}','{{$subject_id}}')">Mark for review</button>
                                    <button class="btn px-4   me-2 btn-secondary rounded-0">Clear Response</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="bg-white d-flex flex-column justify-content-center mb-4  px-5 py-3">
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
                        <form action="{{route('exam_result')}}" method="post">
                            @csrf
                            <input type="hidden" name="fulltime" value="00:30:00">
                            <input type="hidden" name="submit_time" value="00:10:00">
                            <button type="submit" class="btn btn-light-green w-100 rounded-0 mt-3">Submit</button>
                        </form>

                    </div>
                    <div class="bg-white d-flex flex-column justify-content-center mb-4  py-4 px-4">
                        <p>Question Palette</p>
                        <div class="number-block">
                            @if(isset($keys) && !empty($keys))
                            @foreach($keys as $ke=>$val)
                            <button type="button" class="btn btn-light rounded-0 mb-4" id="btn_{{$val}}" onclick="qnext('{{$val}}')">
                                {{$ke+1}}</button>
                            @endforeach
                            @endif

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
                            <button class="btn btn-secondary   rounded-0 "> </button>
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
                            <h1 class="text-danger text-uppercase">{{isset($exam_name)?$exam_name:'Mock Test'}} </h1>
                            <div class="scroll">
                                <div class="test-info">
                                    <div class="row justify-content-md-center">
                                        <div class="col col-lg-4 d-flex flex-column align-items-center">
                                            <div>
                                                <small>No. Of Questions</small>
                                                <span class="d-block inst-text"><span class="text-danger">{{$questions_count}} MCQ</span> Questions</span>
                                            </div>
                                        </div>
                                        <div class="col col-lg-4 d-flex flex-column align-items-center">
                                            <!-- <div>
                                                <small>Target</small>
                                                <span class="d-block inst-text"><span class="text-danger">Wave Theory</span></span>
                                            </div> -->
                                        </div>
                                        <div class="col col-lg-4 d-flex flex-column align-items-center">
                                            <div>
                                                <small>Duration</small>
                                                <span class="d-block inst-text"><span class="text-danger">{{$exam_fulltime}}</span> Minutes</span>
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

                            <h1 class="my-auto">All the Best! {{Auth::user()->user_name}} </h1>
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
    $('.radioans').click(function() {
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
            timeLeft = TIME_LIMIT - timePassed;;
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
</script>

@endsection