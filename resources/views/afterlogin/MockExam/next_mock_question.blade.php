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
<div class="questionType">
    <div class="questionTypeinner">
        <div class="questionChoiceType">
            <div class="questionChoice">
                @if(isset($aSections) && !empty($aSections))
                @foreach($aSections as $Vsec)
                @php $secId=$Vsec->id;@endphp
                @if(isset($aSubSecCount->$subject_id->$secId) && $aSubSecCount->$subject_id->$secId>0)
                <a class="singleChoice section_{{$secId}}" href="javascript:;" onclick="get_subject_Sec_question('{{$subject_id}}','{{$secId}}')">{{$Vsec->section_name}} ({{$aSubSecCount->$subject_id->$secId." Q"}}) - {{$Vsec->question_type_name}}</a>

                @endif
                @endforeach
                @endif
            </div>
        </div>
        <div class="timeCounter">
            Average Time:
            <div id="progressBar">
                <div class="bar"></div>
            </div>
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
                                    <p>{!! $question_text !!}
                                    </p>
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
                                            <input class="correct quest_option_{{$activeq_id}} checkboxans" type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}" />
                                            <label for="option_{{$activeq_id}}_{{$key}}" class="image-bg"> <span class="seNo">{{$alpha[$no]}}.</span> <span class="optionText">{!! $opt_value !!}</span> </label>
                                        </div>
                                    </div>
                                    @php $no++; @endphp
                                    @endforeach
                                    @endif
                                    @elseif($template_type==11)

                                    <div class="colMargin">
                                        <div class="inputAns">
                                            <label for="story">Answer</label>
                                            <textarea style="resize:none" placeholder="Answer here" rows="20" name="quest_option_{{$activeq_id}}" id="quest_option_{{$activeq_id}}" cols="40" class="ui-autocomplete-input allownumericwithdecimal" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">{{isset($aGivenAns[0])?$aGivenAns[0]:''}}</textarea>
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

    </div>
    <!-- <div id="application" class="tab-pane">adasdas</div>
                                <div id="complrehension" class="tab-pane">complrehension</div> -->
</div>

<script>
    var question_id = '{{$activeq_id}}';
    var template_type = '{{$template_type}}';
    var curr_ques_no = '{{$qNo}}';
    var subject_id = '{{$subject_id}}';
    var chapter_id = '{{$chapter_id}}';
    var subject_id = '{{$subject_id}}';
    var curr_section_id = '{{$section_id}}';
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

    $("#current_section_id").val(curr_section_id);



    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
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