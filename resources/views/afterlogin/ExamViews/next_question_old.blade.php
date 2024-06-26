@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
$template_type = isset($question_data->template_type)?$question_data->template_type:'';
$difficulty_level = isset($question_data->difficulty_level)?$question_data->difficulty_level:1;


if($template_type==1){
$type_class='checkboxans';
$questtype='checkbox';
}elseif($template_type==2){
$type_class='radioans';
$questtype='radio';
}
@endphp

<script>
    $(document).ready(function() {
        var time_allowed = '{{(isset($question_data->time_allowed) && $question_data->time_allowed>0)?$question_data->time_allowed:1}}';
        var questionTime = parseInt(time_allowed) * 60;

        var sec = parseInt(time_allowed) * 60;
        var interval = 1000;
        var qest = '{{$activeq_id}}';
        var aj_up_timer = '{{$aquestionTakenTime}}';

        var ctxt = " Seconds";
        if (aj_up_timer >= questionTime) {
            var sec = 0;
        } else {
            var sec = questionTime - aj_up_timer;
        }

        $('#percentBar_{{$activeq_id}}').html('')
        $('#timespend_{{$activeq_id}}').val("");


        ctimer = setInterval(function() {
            sec--;

            progressBar_next(sec, $('#progressBar_{{$activeq_id}}'));

            if (sec == -1) {
                clearInterval(ctimer);
                $('#progressBar_{{$activeq_id}}').css('background-color', '#E4E4E4');
                $('#progressBar_{{$activeq_id}}').css('border-left', 'solid 4px #ff6060');
                $('#q_time_taken_{{$activeq_id}}').show();
                $('#avg_text_{{$activeq_id}}').hide();
                $('#progressBar_{{$activeq_id}}').hide();
            }
        }, interval);


        function progressBar_next(percent, $element) {
            var progressBarWidth = percent * $element.width() / (time_allowed * 60);

            $element.find('div').animate({
                width: progressBarWidth
            }, 500).html(percent + "%&nbsp;");
            if (percent <= 20) {
                $('#percentBar1_{{$activeq_id}}').css('background-color', '#FFDC34');
            }
            if (percent <= 0) {
                $('#progressBar_{{$activeq_id}}').css('background-color', '#E4E4E4');
            }

        }
        var minutesLabel = document.getElementById("up_minutes_{{$activeq_id}}");
        var secondsLabel = document.getElementById("up_seconds_{{$activeq_id}}");
        //var totalSec = document.getElementById("tsec");
        var totalSeconds = aj_up_timer;

        function setEachQuestionTimeNext() {
            setEachQuestionTimeNext_countdown = setInterval(function() {
                ++totalSeconds;
                $('#timespend_{{$activeq_id}}').val(totalSeconds);
                secondsLabel.innerHTML = pad(totalSeconds % 60);

                minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
                //totalSec.innerHTML = pad(totalSeconds);
            }, 1000);
        }
        setEachQuestionTimeNext();

        function pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
        }
    });
</script>
<div>
    <div class="d-flex d-none-imp">

        <div id="counter_{{$activeq_id}}" class="ms-auto counter mb-4 d-flex">
            <span id="avg_text_{{$activeq_id}}" class="avg-time">Average Time:</span>
            <div id="progressBar_{{$activeq_id}}" class="progressBar tiny-green ms-2">
                <span class="seconds" id="seconds_{{$activeq_id}}"></span>

                <div id="percentBar1_{{$activeq_id}}"></div>

            </div>
            <div class="time_taken_css" id="q_time_taken_{{$activeq_id}}" style="display:none;"><span>Time taken: </span><span id="up_minutes_{{$activeq_id}}"></span>:<span id="up_seconds_{{$activeq_id}}"></span> mins</div>

        </div>
    </div>
    <input type="hidden" name="question_spendtime" id="timespend_{{$activeq_id}}" value="" />
    <div class="question-block N_question-block ">

        <button class="btn arrow prev-arow {{($qNo==1)?'d-none':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><img src="{{URL::asset('public/after_login/images/arrowExamLeft_ic.png')}}" /></button>
        @if(isset($last_qid) && ($last_qid==$activeq_id))
        <button class="btn arrow next-arow {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}}" {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}} id="quesnext{{ $activeq_id }}"><img src="{{URL::asset('public/after_login/images/arrowExamRight_ic.png')}}" /></button>

        @else
        <button class="btn arrow next-arow " id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><img src="{{URL::asset('public/after_login/images/arrowExamRight_ic.png')}}" /></button>

        @endif

        <!-- Questions -->
        <sapn class="question_difficulty_tag small"><span class="small">Difficulty Level: </span>{!! $difficulty_level !!}</sapn>

        <div class="question N_question" id="question_blk"><span class="q-no">Q{{$qNo}}.</span>{!! $question_text !!}</div>
        <!-- Options -->
        <div class="ans-block row mt-5 N_radioans">
            @if(isset($option_data) && !empty($option_data))
            @php $no=0; @endphp
            @foreach($option_data as $key=>$opt_value)
            @php
            $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
            /*
            $dom = new DOMDocument();
            @$dom->loadHTML($opt_value);
            $anchor = $dom->getElementsByTagName('img')->item(0);
            $text = isset($anchor)? $anchor->getAttribute('alt') : '';
            $latex = "https://math.now.sh?from=".$text;
            $view_opt='<img src="'.$latex.'" />' ;
            */
            @endphp
            <div class="col-md-6 mb-4">
                <input class="form-check-input selctbtn quest_option_{{$activeq_id}} {{$type_class}}" @php if(in_array($key,$aGivenAns)){echo 'checked' ; } @endphp type="{{$questtype}}" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                <div class="border ps-5 ans">
                    <label class="question m-0 py-3   d-block " for="option_{{$activeq_id}}_{{$key}}">
                        <span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}
                    </label>
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
            <div class="ps-3" style="float:left">
                @if((isset($last_qid) && $last_qid==$activeq_id))
                <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer text-capitalize" onclick="saveAnswer('{{$activeq_id}}')" data-toggle="modal" data-target="#FullTest_Exam_Panel_Interface_A">Save & Submit</button>

                @else
                <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer text-capitalize" onclick="saveAnswer('{{$activeq_id}}')">Save & Next</button>
                @endif

                <button class="btn px-4 ms-2 btn-light rounded-0 btn-secon-clear savemarkreview text-capitalize" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')">Save & Mark for Review</button>
            </div>
            <div class="pe-3" style="float:right">
                <button class="btn px-4 ms-2 btn-secon-clear btn-light rounded-0 text-capitalize" onclick="markforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')">Mark for Review</button>
                <button class="btn px-4 ms-2 btn-secon-clear act rounded-0 text-capitalize" onclick="clearResponse('{{$activeq_id}}','{{$subject_id}}','{{$qNo}}')">Clear Response</button>
            </div>
        </div>
    </div>
</div>

<script>
    var question_id = '{{$activeq_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");
    $('.next_button').prop('autofocus', false);
    $("#btn_" + question_id).prop('autofocus', true);

    $("#exam_content_sec  #btn_" + question_id).focus();
    //$("#exam_content_sec  #btn_" + question_id)[0].scrollIntoView();

    $("#current_question").val(question_id);

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>