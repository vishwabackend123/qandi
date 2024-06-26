@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($que_sub_id)?$que_sub_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
$template_type = isset($question_data->template_type)?$question_data->template_type:'';
$difficulty_level = isset($question_data->difficulty_level)?$question_data->difficulty_level:1;
$question_type='';

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
    var ctimer;
    var setEachQuestionTimeNext_countdownNext;
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


    function questionstartTimerNext() {
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
    }
    questionstartTimerNext();


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
    var totalSecondsNext = aj_up_timer;

    function setEachQuestionTimeNext() {
        setEachQuestionTimeNext_countdownNext = setInterval(function() {
            ++totalSecondsNext;
            $('#timespend_{{$activeq_id}}').val(totalSecondsNext);
            secondsLabel.innerHTML = padNext(totalSecondsNext % 60);

            minutesLabel.innerHTML = padNext(parseInt(totalSecondsNext / 60));
            //totalSec.innerHTML = pad(totalSeconds);
        }, 1000);
    }
    setEachQuestionTimeNext();

    function padNext(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }
</script>
<div class="questionType">
    <div class="questionTypeinner">
        <div class="questionChoiceType questionChoiceTypehide" style="visibility:hidden">
            <div class="questionChoice"><a class="singleChoice" href="javascript:;">Section A (20Q) - Single Choice</a> <a class="numericalChoice" href="javascript:;">Section B (10Q) - Numerical</a></div>
        </div>
        <div class="timeCounter">
            <!--  Average Time:123
            <div id="progressBar">
                <div class="bar"></div>
            </div> -->
            <div id="counter_{{$activeq_id}}" class="ms-auto counter mb-4 d-flex qiestionTimer">
                <span id="avg_text_{{$activeq_id}}" class="avg-time">Average Time:</span>
                <div id="progressBar_{{$activeq_id}}" class="progressBar tiny-green ms-2">
                    <span class="seconds" id="seconds_{{$activeq_id}}"></span>

                    <div id="percentBar1_{{$activeq_id}}"></div>

                </div>
                <div class="time_taken_css" id="q_time_taken_{{$activeq_id}}" style="display:none;"><span>Time taken: </span><span id="up_minutes_{{$activeq_id}}"></span>:<span id="up_seconds_{{$activeq_id}}"></span> mins</div>

            </div>
            <input type="hidden" name="question_spendtime" id="timespend_{{$activeq_id}}" value="" />
        </div>
    </div>
</div>
<div class="tab-content aect_tabb_contantt">
    <div id="evolution" class="tab-pane active">
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
                                            <input class="correct quest_option_{{$activeq_id}} checkboxans" @php if(in_array($key,$aGivenAns)){echo 'checked' ; } @endphp type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}" onclick="checkResponse('{{$activeq_id}}')" />
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
                                            <textarea inputmode="text" style="resize:none" placeholder="Answer here" rows="20" name="quest_option_{{$activeq_id}}" id="quest_option_{{$activeq_id}}" cols="40" class="ui-autocomplete-input allownumericwithdecimal" autocomplete="off" role="textbox" aria-autocomplete="list" maxlength="20" aria-haspopup="true" onchange="checkResponse('{{$activeq_id}}')">{{isset($aGivenAns[0])?$aGivenAns[0]:''}}</textarea>
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

                <button type="button" class="qprev quest_btn {{(isset($prev_qid) && ($prev_qid==$activeq_id))?'disabled':''}} {{empty($prev_qid)?'disabled':''}}" {{(isset($prev_qid) && ($prev_qid==$activeq_id))?'disabled':''}} id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')" {{empty($prev_qid)?'disabled':''}}>
                    <span class=" Previous">‹</span>
                </button>


                <!-- Next button -->

                <button type="button" class="qnext quest_btn {{empty($next_qid)?'disabled':''}} {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}}" {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}} id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')">
                    <span class="Next">›</span>
                </button>
            </div>
        </div>
    </div>
</div>



<script>
    var question_id = '{{$activeq_id}}';
    var template_type = '{{$template_type}}';
    var curr_ques_no = '{{$qNo}}';
    var subject_id = '{{$subject_id}}';
    var chapter_id = '{{$chapter_id}}';
    var subject_id = '{{$subject_id}}';
    var last_qId = '{{$last_qid}}';

    $('#myTabContent .quesBtn').attr("disabled", false);
    $('#myTabContent .quesBtn').removeClass("disabled");
    /*  $(".next_button").removeClass("activequestion");
     */
    /* $(".number-block #btn_" + question_id)[0].scrollIntoView(); */
    //$("#exam_content_sec  #btn_" + question_id).focus();

    /*     $("#btn_" + question_id).addClass("activequestion"); */
    $("#current_question").val(question_id);
    $("#current_question_type").val(template_type);
    $("#current_question_no").val(curr_ques_no);
    $("#current_chapter_id").val(chapter_id);
    $("#current_subject_id").val(subject_id);


    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");

    $("#myTab .qcountout").removeClass("countActive");
    $("#myTab .qcountout_" + subject_id).addClass("countActive");

    if (last_qId == question_id) {
        $('#saveNext').html('Save & Submit');
    } else {
        $('#saveNext').html('Save & Next');
    }
</script>
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
                $("#questNo  #btn_" + question_id).focusout();
            } else {
                //$('.left').insertBefore('.right');
                $("#questNo  #btn_" + question_id).focus();
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