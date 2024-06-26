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
    /* $(document).ready(function() { */
    var time_allowed = '{{(isset($question_data->time_allowed) && $question_data->time_allowed>0)?$question_data->time_allowed:1}}';
    var ctimer;
    var setEachQuestionTimeNext_countdownNext;
    var sec = time_allowed * 60;
    var interval = 1000;
    var qest = '{{$active_q_id}}';

    $('#percentBar_{{$active_q_id}}').html('')
    $('#timespend_{{$active_q_id}}').val("");

    function questionstartTimerNext() {
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
        }, 1000);
    }
    questionstartTimerNext();

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
    var totalSecondsNext = -1;

    function setEachQuestionTimeNext() {
        setEachQuestionTimeNext_countdownNext = setInterval(function() {
            ++totalSecondsNext;
            $('#timespend_{{$active_q_id}}').val(totalSecondsNext);
            secondsLabel.innerHTML = padnext(totalSecondsNext % 60);

            minutesLabel.innerHTML = padnext(parseInt(totalSecondsNext / 60));

        }, 1000);
    }
    setEachQuestionTimeNext();

    function padnext(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }
    /* }); */
</script>
<div class="questionType">
    <div class="questionTypeinner">
        <div class="questionChoiceType questionChoiceTypehide" style="visibility:hidden">
            <div class="questionChoice"><a class="singleChoice" href="javascript:;">Section A (20Q) - Single Choice</a> <a class="numericalChoice" href="javascript:;">Section B (10Q) - Numerical</a></div>
        </div>
        <div class="timeCounter">
            <div id="counter_{{$active_q_id}}" class="ms-auto counter mb-4 d-flex">
                <span id="avg_text_{{$active_q_id}}" class="avg-time">Average Time:</span>
                <div id="progressBar_{{$active_q_id}}" class="progressBar tiny-green ms-2">
                    <span class="seconds" id="seconds_{{$active_q_id}}"></span>

                    <div id="percentBar_{{$active_q_id}}"></div>

                </div>
                <div class="time_taken_css" id="q_time_taken_{{$active_q_id}}" style="display:none;"><span>Time taken: </span><span id="up_minutes_{{$active_q_id}}"></span>:<span id="up_seconds_{{$active_q_id}}"></span> mins</div>

            </div>
            <input type="hidden" name="question_spendtime" id="timespend_{{$active_q_id}}" value="" />
        </div>
    </div>
</div>
<div class="tab-content aect_tabb_contantt">
    <div class="tab-pane active">
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
                                            <textarea style="resize:none" placeholder="Answer here" rows="20" name="quest_option_{{$activeq_id}}" id="quest_option_{{$activeq_id}}" cols="40" class="ui-autocomplete-input allownumericwithdecimal" autocomplete="off" role="textbox" aria-autocomplete="list" maxlength="20" aria-haspopup="true" onchange="checkResponse('{{$activeq_id}}')">{{isset($aGivenAns[0])?$aGivenAns[0]:''}}</textarea>
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
                <span style="visibility:hidden">
                    <button type="button" class="qprev quest_btn {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')" {{empty($prev_qid)?'disabled':''}}>
                        <span class=" Previous">‹</span>
                    </button>


                    <!-- Next button -->

                    <button type="button" class="qnext quest_btn {{empty($next_qid)?'disabled':''}}" {{empty($next_qid)?'disabled':''}} id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')">
                        <span class="Next">›</span>
                    </button>
                </span>
            </div>
        </div>
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
    /*  $("#myTab .all_div").removeClass("active");
     $("#myTab .class_" + subject_id).addClass("active"); */

    var nextQidDiv = document.getElementById('btn_' + question_id);
    if (nextQidDiv === null) {
        $('#exam_content_sec').append(
            '<button type="button" class="next_button btn btn-ans border-btn disabled" id="btn_' + question_id + '" onclick="qnext(' + question_id + ')">' + curr_ques_no + '</button>');
    }
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
                $('#quest_option_' + question_id).focus();
            }
        }
        // $('#quest_option_' + question_id).focus();
    });
    /* Allow only numeric with decimal */
    (function($) {
        $.fn.inputFilter = function(callback, errMsg) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
                if (callback(this.value)) {
                    // Accepted value
                    if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                        $(this).removeClass("input-error");
                        this.setCustomValidity("");
                    }
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    // Rejected value - restore the previous one
                    //$(this).addClass("input-error");
                    //this.setCustomValidity(errMsg);
                    this.reportValidity();
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    // Rejected value - nothing to restore
                    this.value = "";
                }
            });
        };
    }(jQuery));
    jQuery(function($) {

        $('.allownumericwithdecimal').bind("cut copy paste", function(e) {
            e.preventDefault();
        });
        $(".allownumericwithdecimal").inputFilter(function(value) {
            return /^-?\d*[.]?\d{0,2}$/.test(value);
        });
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
    var quest_id = '{{$activeq_id}}';

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
        $('.clearBtn_response').attr("disabled", false);
        $('.clearBtn_response').addClass("Clearbtnenable");
    } else {
        $('.clearBtn_response').attr("disabled", true);
        $('.clearBtn_response').removeClass("Clearbtnenable");
    }
</script>

<!-- End check size of screen -->