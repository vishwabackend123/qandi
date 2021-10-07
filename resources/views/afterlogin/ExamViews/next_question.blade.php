@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
$template_type = isset($question_data->template_type)?$question_data->template_type:'';
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

        var interval = 1000;
        var qest = '{{$activeq_id}}';
        var aj_up_timer = '{{$aquestionTakenTime}}';

        var totalSeconds = aj_up_timer;
        setEachQuestionTimeNext();

        function setEachQuestionTimeNext() {

            setEachQuestionTimeNext_countdown = setInterval(function() {
                ++totalSeconds;
                $('#timespend_{{$activeq_id}}').val(totalSeconds);

            }, 1000);
        }



    });
</script>
<div>
    <input type="hidden" name="question_spendtime" id="timespend_{{$activeq_id}}" value="" />
    <div class="question-block N_question-block ">

        <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><img src="{{URL::asset('public/after_login/images/arrowExamLeft_ic.png')}}" /></button>
        @if(isset($last_qid) && ($last_qid==$activeq_id))
        <button class="btn arrow next-arow {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}}" {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}} id="quesnext{{ $activeq_id }}"><img src="{{URL::asset('public/after_login/images/arrowExamRight_ic.png')}}" /></button>

        @else
        <button class="btn arrow next-arow " id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><img src="{{URL::asset('public/after_login/images/arrowExamRight_ic.png')}}" /></button>

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
                @if((isset($last_qid) && $last_qid==$activeq_id))
                <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer text-capitalize" onclick="saveAnswer('{{$activeq_id}}')" data-toggle="modal" data-target="#FullTest_Exam_Panel_Interface_A">Save & Submit</button>

                @else
                <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer text-capitalize" onclick="saveAnswer('{{$activeq_id}}')">Save & Next</button>
                @endif

                <button class="btn px-4 ms-2 btn-light rounded-0 btn-secon-clear savemarkreview text-capitalize" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')">Save & Mark for review</button>
            </div>
            <div class="pe-3" style="float:right">
                <button class="btn px-4 ms-2 btn-secon-clear btn-light rounded-0 text-capitalize" onclick="markforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')">Mark for review</button>
                <button class="btn px-4 ms-2 btn-secon-clear act rounded-0 text-capitalize" onclick="clearResponse('{{$activeq_id}}','{{$subject_id}}')">Clear Response</button>
            </div>
        </div>
    </div>
</div>

<script>
    var question_id = '{{$activeq_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");

    $("#current_question").val(question_id);

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>