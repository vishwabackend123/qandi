@php
$question_text = isset($question_data->question)?$question_data->question:'';
$active_q_id = isset($activeq_id)?$activeq_id:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
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

<script>
    $(document).ready(function() {
        var time_allowed = '{{(isset($question_data->time_allowed) && $question_data->time_allowed>0)?$question_data->time_allowed:1}}';
        var questionTime = parseInt(time_allowed) * 60;

        var sec = parseInt(time_allowed) * 60;
        var interval = 1000;
        var qest = '{{$active_q_id}}';
        var aj_up_timer = '{{$aquestionTakenTime}}';

        var ctxt = " Seconds";
        if (aj_up_timer >= questionTime) {
            var sec = 0;
        } else {
            var sec = questionTime - aj_up_timer;
        }

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
                $('#percentBar1_{{$active_q_id}}').css('background-color', '#FFDC34');
            }
            if (percent <= 0) {
                $('#progressBar_{{$active_q_id}}').css('background-color', '#E4E4E4');
            }

        }
        var minutesLabel = document.getElementById("up_minutes_{{$active_q_id}}");
        var secondsLabel = document.getElementById("up_seconds_{{$active_q_id}}");
        //var totalSec = document.getElementById("tsec");
        var totalSeconds = aj_up_timer;

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
        <!-- question Type Tag -->
        <span class="fw-bold text-uppercase">{{$question_type}}</span>
        <!-- question Type Tag -->
        <div id="counter_{{$active_q_id}}" class="ms-auto counter mb-4 d-flex">
            <span id="avg_text_{{$active_q_id}}" class="avg-time">Average Time :</span>
            <div id="progressBar_{{$active_q_id}}" class="progressBar tiny-green ms-2">
                <span class="seconds" id="seconds_{{$active_q_id}}"></span>

                <div id="percentBar1_{{$active_q_id}}"></div>

            </div>
            <div class="time_taken_css" id="q_time_taken_{{$active_q_id}}" style="display:none;"><span>Time taken : </span><span id="up_minutes_{{$active_q_id}}"></span>:<span id="up_seconds_{{$active_q_id}}"></span>mins</div>

        </div>
    </div>
    <input type="hidden" name="question_spendtime" id="timespend_{{$active_q_id}}" value="" />


    <div class="question-block">
        <!-- Next and previous button -->
        <button href="javascript:void(0);" id="quesprev{{ $active_q_id }}" onclick="qnext('{{$prev_qid}}','{{ $active_q_id }}')" class="arrow prev-arow {{($qNo==1)?'d-none':''}}"><i class="fa fa-angle-left" title="Previous Question"></i></button>
        @if(isset($last_qid) && ($last_qid==$active_q_id))

        <button href="javascript:void(0);" class="arrow next-arow {{(isset($last_qid) && ($last_qid==$active_q_id))?'d-none':''}}" {{(isset($last_qid) && ($last_qid==$active_q_id))?'disabled':''}} id="quesnext{{ $active_q_id }}"><i class="fa fa-angle-right" title="Next Question"></i></button>
        @else

        <button href="javascript:void(0);" class="arrow next-arow " id="quesnext{{ $active_q_id }}" onclick="qnext('{{$next_qid}}','{{ $active_q_id }}')"><i class="fa fa-angle-right" title="Next Question"></i></button>
        @endif
        <!-- Next and previous button -->

        <div class="question py-3 d-flex"><span class="q-no">Q{{$qNo}}.</span>{!! $question_text !!}</div>

        <div class="ans-block row my-3">
            @if($template_type==1 || $template_type==2)
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
            <div class="col-md-6 mb-4 markerDiv">
                <input class="form-check-input quest_option_{{$active_q_id}} checkboxans" @php if(in_array($key,$aGivenAns)){echo 'checked' ; } @endphp type="{{$questtype}}" id="option_{{$active_q_id}}_{{$key}}" name="quest_option_{{$active_q_id}}" value="{{$key}}">
                <div class=" border ps-3 ans">
                    <label class="question m-0 py-3 d-block " for="option_{{$active_q_id}}_{{$key}}"> <span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
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
        @if(isset($last_qid) && ($last_qid==$active_q_id))
        <a href="javascript:void(0);" class="btn px-5   btn-light-green rounded-0 saveanswer quesBtn" onclick="saveAnswer('{{$active_q_id}}','{{$qNo}}');" id="save_submit">Save & Submit</a>
        @else
        <a href="javascript:void(0);" class="btn px-5   btn-light-green rounded-0 saveanswer quesBtn" onclick="saveAnswer('{{$active_q_id}}','{{$qNo}}');">Save & Next
        </a>
        @endif

        <a href="javascript:void(0);" class="btn px-4   ms-2 btn-light rounded-0 savemarkreview quesBtn" onclick="savemarkreview('{{$active_q_id}}','{{$subject_id}}','{{$chapter_id}}')">Save & Mark for Review</a>

        <a href="javascript:void(0);" class="btn px-4 ms-auto me-2 btn-light rounded-0 quesBtn" onclick="markforreview('{{$active_q_id}}','{{$subject_id}}','{{$chapter_id}}')">Mark for Review</a>

        <a href="javascript:void(0);" class="btn px-4   me-2 btn-secondary rounded-0 clearRes quesBtn" onclick="clearResponse('{{$active_q_id}}','{{$subject_id}}','{{$qNo}}')">Clear Response</a>

    </div>
</div>
<script>
    var question_id = '{{$active_q_id}}';
    var template_type = '{{$template_type}}';
    var curr_ques_no = '{{$qNo}}';
    $(".next_button").removeClass("activequestion");

    /* $(".number-block #btn_" + question_id)[0].scrollIntoView(); */
    //$("#exam_content_sec  #btn_" + question_id).focus();

    $("#btn_" + question_id).addClass("activequestion");
    $("#current_question").val(question_id);
    $("#current_question_type").val(template_type);
    $("#current_question_no").val(curr_ques_no);

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>

<!-- check size of screen -->
<script>
    $(document).ready(function() {
        $(window).on("resize", function(e) {
            checkScreenSize();
        });

        checkScreenSize();

        function checkScreenSize() {
            var newWindowWidth = $(window).width();
            if (newWindowWidth < 768) {
                //$('.right').insertBefore('.left');
                $("#exam_content_sec  #btn_" + question_id).focusout();
            } else {
                //$('.left').insertBefore('.right');
                $("#exam_content_sec  #btn_" + question_id).focus();


            }
        }
        $('#quest_option_' + question_id).focus();
    });
    /* Allow only numeric with decimal */
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


    jQuery(function() {
        jQuery(".markerDiv").click(function() {
            if (template_type == 2) {
                $('input[type=radio]', this).prop("checked", true);
            } else {
                var $checks = $(this).find('input[type=checkbox]');

                $checks.prop("checked", !$checks.is(":checked"));

            }
        });
    });
</script>

<!-- End check size of screen -->