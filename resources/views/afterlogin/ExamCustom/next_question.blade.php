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

<div class="d-flex ">

    <div id="counter_{{$activeq_id}}" class="ms-auto counter mb-4 d-flex">
        <span id="avg_text_{{$activeq_id}}">Average Time taken : </span>
        <div id="progressBar_{{$activeq_id}}" class="progressBar tiny-green ms-2">
            <span class="seconds" id="seconds_{{$activeq_id}}"></span>

            <div id="percentBar_{{$activeq_id}}"></div>

        </div>
        <div class="time_taken_css" id="q_time_taken_{{$activeq_id}}" style="display:none;"><span>Time taken : </span><span id="up_minutes"></span>:<span id="up_seconds"></span>mins</div>

    </div>
</div>
<input type="hidden" name="time_spend_{{$activeq_id}}" id="timespend_{{$activeq_id}}" value="" />
<div class="question-block N_question-block">

    <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}','{{ $activeq_id }}')"><img src="{{URL::asset('public/after_login/images/arrowExamLeft_ic.png')}}" /></button>
    @if(isset($last_qid) && ($last_qid==$activeq_id))
    <button class="btn arrow next-arow {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}}" id="quesnext{{ $activeq_id }}"><img src="{{URL::asset('public/after_login/images/arrowExamRight_ic.png')}}" /></button>

    @else
    <button class="btn arrow next-arow " id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}','{{ $activeq_id }}')"><img src="{{URL::asset('public/after_login/images/arrowExamRight_ic.png')}}" /></button>

    @endif

    <!-- Questions -->
    <div class="question N_question" id="question_blk"><span class="q-no">Q{{$qNo}}.</span>{!! $question_text !!}</div>
    <!-- Options -->
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
            <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer text-capitalize" onclick="saveAnswer('{{$activeq_id}}');">Save & Next</button>
            <button class="btn px-4 ms-2 btn-light rounded-0 btn-secon-clear savemarkreview text-capitalize" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}')">Save & Mark for review</button>
        </div>
        <div class="pe-3" style="float:right">
            <button class="btn px-4 ms-2 btn-secon-clear btn-light rounded-0 text-capitalize" onclick="markforreview('{{$activeq_id}}','{{$subject_id}}')">Mark for review</button>
            <button class="btn px-4 ms-2 btn-secon-clear act rounded-0 text-capitalize" onclick="clearResponse('{{$activeq_id}}','{{$subject_id}}')">Clear Response</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var sec = 60;
        var interval = 1000;
        var qest = '{{$activeq_id}}';
        var aj_up_timer = 0;
        var ctxt = " Seconds";
        $('#percentBar_{{$activeq_id}}').html('')
        setEachQuestionTime();
        var aj_timer_up = setInterval(function() {
            aj_up_timer++;
            $('#timespend_{{$activeq_id}}').val(aj_up_timer);

        }, 1000);
        var ctimer = setInterval(function() {
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
            var progressBarWidth = percent * $element.width() / 60;

            $element.find('div').animate({
                width: progressBarWidth
            }, 500).html(percent + "%&nbsp;");
            if (percent <= 20) {
                $('#percentBar_{{$activeq_id}}').css('background-color', '#FFDC34');
            }
            if (percent <= 0) {
                $('#progressBar_{{$activeq_id}}').css('background-color', '#E4E4E4');
            }

        }
        var minutesLabel = document.getElementById("up_minutes");
        var secondsLabel = document.getElementById("up_seconds");
        //var totalSec = document.getElementById("tsec");
        var totalSeconds = 0;

        function setEachQuestionTime() {
            setInterval(function() {
                ++totalSeconds;
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
    });
</script>
<script>
    var question_id = '{{$activeq_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>