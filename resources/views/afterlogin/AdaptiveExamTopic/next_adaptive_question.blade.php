@php
$question_text = isset($question_data->question)?$question_data->question:'';
$active_q_id = isset($activeq_id)?$activeq_id:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
$topic_id = isset($question_data->topic_id)?$question_data->topic_id:0;
$track = isset($question_data->track)?$question_data->track:'';
$template_type = isset($question_data->template_type)?$question_data->template_type:'';
$difficulty_level = isset($question_data->difficulty_level)?$question_data->difficulty_level:1;
$correct_answers = isset($question_data->answers)?json_decode($question_data->answers):"";

if($template_type==1){
$type_class='checkboxans';
$questtype='checkbox';
}else{
$type_class='radioans';
$questtype='radio';
}
@endphp
<script>
    $(document).ready(function() {
        var time_allowed = '{{(isset($question_data->time_allowed) && $question_data->time_allowed>0)?$question_data->time_allowed:1}}';

        var sec = time_allowed * 60;
        var interval = 1000;
        var qest = '{{$active_q_id}}';
        /* var aj_up_timer = '{{$aquestionTakenTime}}';

        alert(time_allowed_sec + " " + aj_up_timer);
        var ctxt = " Seconds";
        if (aj_up_timer >= 60) {
            var sec = 0;
        } else {
            var sec = 60 - aj_up_timer;
        }
 */
        $('#percentBar_{{$active_q_id}}').html('')
        $('#timespend_{{$active_q_id}}').val("");


        ctimer = setInterval(function() {
            sec--;

            progressBar_next(sec, $('#progressBar_{{$active_q_id}}'));

            if (sec == -1) {
                clearInterval(ctimer);
                $('#progressBar_{{$active_q_id}}').css('background-color', '#E4E4E4');
                $('#progressBar_{{$active_q_id}}').css('border-left', 'solid 4px #ff6060');
                $('#q_time_taken_{{$active_q_id}}').show();
                $('#avg_text_{{$active_q_id}}').hide();
                $('#progressBar_{{$active_q_id}}').hide();
            }
        }, interval);


        function progressBar_next(percent, $element) {
            var progressBarWidth = percent * $element.width() / (time_allowed * 60);

            $element.find('div').animate({
                width: progressBarWidth
            }, 500).html(percent + "%&nbsp;");
            if (percent <= 20) {
                $('#percentBar_{{$active_q_id}}').css('background-color', '#FFDC34');
            }
            if (percent <= 0) {
                $('#progressBar_{{$active_q_id}}').css('background-color', '#E4E4E4');
            }

        }
        var minutesLabel = document.getElementById("up_minutes_{{$active_q_id}}");
        var secondsLabel = document.getElementById("up_seconds_{{$active_q_id}}");
        //var totalSec = document.getElementById("tsec");
        var totalSeconds = -1;

        function setEachQuestionTimeNext() {
            setEachQuestionTimeNext_countdown = setInterval(function() {
                ++totalSeconds;
                $('#timespend_{{$active_q_id}}').val(totalSeconds);
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
    <div class="d-flex ">

        <div id="counter_{{$active_q_id}}" class="ms-auto counter mb-4 d-flex">
            <span id="avg_text_{{$active_q_id}}">Average Time :</span>
            <div id="progressBar_{{$active_q_id}}" class="progressBar tiny-green ms-2">
                <span class="seconds" id="seconds_{{$active_q_id}}"></span>

                <div id="percentBar_{{$active_q_id}}"></div>

            </div>
            <div class="time_taken_css" id="q_time_taken_{{$active_q_id}}" style="display:none;"><span>Time taken : </span><span id="up_minutes_{{$active_q_id}}"></span>:<span id="up_seconds_{{$active_q_id}}"></span>mins</div>

        </div>
    </div>
    <input type="hidden" name="question_spendtime" id="timespend_{{$active_q_id}}" value="" />


    <div class="question-block">

        <!-- Next and previous button -->

        <sapn class="question_difficulty_tag small">
            <span class="small me-2">Subject Id: {!! $subject_id !!}</span> |
            <span class="small mx-2">Chapter Id: {!! $chapter_id !!}</span> |
            <span class="small mx-2">Topic Id: {!! $topic_id !!}</span> |
            <span class="small mx-2">Question Id: {!! $activeq_id !!}</span> |
            <span class="small mx-2">Track: {!! $track !!}</span> |
            <span class="small ms-2">Difficulty Level: {!! $difficulty_level !!}</span>
        </sapn>

        <div class="question py-3 d-flex"><span class="q-no">Q{{$qNo}}.</span>{!! $question_text !!}</div>

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
        <a href="javascript:void(0);" class="btn px-5   btn-light-green rounded-0 saveanswer" onclick="saveAnswer('{{$activeq_id}}')">Save & Submit
        </a>
        @endif

        <a href="javascript:void(0);" class="btn px-4   ms-2 btn-light rounded-0 savemarkreview" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}')">Save & Mark for review</a>

        <a href="javascript:void(0);" class="btn px-4 ms-auto me-2 btn-light rounded-0" onclick="markforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')">Mark for review</a>

        <a href="javascript:void(0);" class="btn px-4   me-2 btn-secondary rounded-0 clearRes" onclick="clearResponse('{{$activeq_id}}','{{$subject_id}}',1)">Clear Response</a>
    </div>
</div>
<script>
    var question_id = '{{$active_q_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");
    $("#current_question").val(question_id);



    $("#exam_content_sec  #btn_" + question_id).focus();
    //$(".number-block #btn_" + question_id)[0].scrollIntoView();

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>