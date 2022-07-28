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

        var sec = time_allowed * 60;
        var interval = 1000;
        var qest = '{{$active_q_id}}';
        /* var aj_up_timer = '{{$aquestionTakenTime}}';

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
                $('#percentBar1_{{$active_q_id}}').css('background-color', '#FFDC34');
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
<div class="questionsliderinner">
    <div class="questionSlider1">
        <div class="item" id="">
            <div class="questionsliderbox">
                <div class="questionwrapper">

                    <div class="questionheader">
                        <div class="question">
                            <span class="q-no">Q{{$qNo}}.</span>
                            <!-- <p>{!! $question_text !!}
                            </p> -->
                            <div class="quesbox">
                                <p>{!! $question_text !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="questionImggraph">
                    </div>
                    <div class="questionOptionBlock">
                        <div class="fancy-radio-buttons row with-image">

                            @if($template_type==1 || $template_type==2)
                            @if(isset($option_data) && !empty($option_data))
                            @php $no=0; @endphp
                            @foreach($option_data as $key=>$opt_value)
                            @php
                            $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
                            /* $dom = new DOMDocument();
                            @$dom->loadHTML($opt_value);
                            $anchor = $dom->getElementsByTagName('img')->item(0);
                            $text = isset($anchor)? $anchor->getAttribute('alt') : '';
                            $latex = "https://math.now.sh?from=".$text;
                            $view_opt='<img src="'.$latex.'" />' ; */
                            @endphp

                            <div class="colMargin">
                                <div class="image-container markerDiv">
                                    <input class="correct quest_option_{{$activeq_id}} checkboxans" type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}" onclick="checkResponse('{{$activeq_id}}')" />
                                    <label for="option_{{$activeq_id}}_{{$key}}" class="image-bg"> <span class="seNo">{{$alpha[$no]}}</span> <span class="optionText">{!! $opt_value !!}</span> </label>
                                </div>
                            </div>
                            @php $no++; @endphp
                            @endforeach
                            @endif
                            @elseif($template_type==11)

                            <div class="colMargin">
                                <div class="inputAns">
                                    <label for="story">Answer</label>
                                    <textarea style="resize:none" placeholder="Answer here" rows="20" name="quest_option_{{$activeq_id}}" id="quest_option_{{$activeq_id}}" cols="40" class="ui-autocomplete-input allownumericwithdecimal" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" onchange="checkResponse('{{$activeq_id}}')">{{isset($aGivenAns[0])?$aGivenAns[0]:''}}</textarea>
                                </div>
                            </div>
                            @endif


                            <span class="qoption_error text-danger" id="qoption_err_{{$activeq_id}}"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="examQuestionarrow">
        <!-- Previous button -->

        <button type="button" class="qprev quest_btn {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')" {{empty($prev_qid)?'disabled':''}}>
            <span class=" Previous">‹</span>
        </button>


        <!-- Next button -->

        <button type="button" class="qnext quest_btn {{empty($next_qid)?'disabled':''}}" {{empty($next_qid)?'disabled':''}} id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')">
            <span class="Next">›</span>
        </button>
    </div>
</div>
<!-- exam footer -->
<script>
    var question_id = '{{$active_q_id}}';
    var template_type = '{{$template_type}}';
    var curr_ques_no = '{{$qNo}}';

    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");
    $("#current_question").val(question_id);
    $("#current_question_type").val(template_type);
    $("#current_question_no").val(curr_ques_no);

    //$("#exam_content_sec  #btn_" + question_id).focus();
    // $(".number-block #btn_" + question_id)[0].scrollIntoView();


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
<script type="text/javascript">
    /*  $('#clearBtn_response').attr("disabled", true);
    $('#clearBtn_response').removeClass("Clearbtnenable"); */
    var quest_id = '{{$activeq_id}}';
    alert()
    var option_id = [];
    var current_question_type = $("#current_question_type").val();

    if (current_question_type == 11) {
        var res_value = $("#quest_option_" + quest_id).val();

        if (res_value != '') {
            option_id.push($("#quest_option_" + quest_id).val());
        }

    } else {
        $.each($("input[name='quest_option_" + quest_id + "']:checked"), function() {
            option_id.push($(this).val());
        });
    }
    console.log(option_id);
    if (option_id.length > 0) {
        $('#clearBtn_response').attr("disabled", false);
        $('#clearBtn_response').addClass("Clearbtnenable");
    } else {
        $('#clearBtn_response').attr("disabled", true);
        $('#clearBtn_response').removeClass("Clearbtnenable");
    }
</script>
<!-- End check size of screen -->