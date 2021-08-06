@php
$question_text = isset($question_data->question)?$question_data->question:'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
@endphp

<div class="question-block N_question-block">
    <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><i class="fa fa-angle-left"></i></button>
    @if(isset($last_qid) && ($last_qid==$activeq_id))
    <button class="btn arrow next-arow {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}}" id="quesnext{{ $activeq_id }}"><i class="fa fa-angle-right"></i></button>

    @else
    <button class="btn arrow next-arow " id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><i class="fa fa-angle-right"></i></button>

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
            <input class="form-check-input radioans" @php if(in_array($key,$aGivenAns)){echo 'checked' ; } @endphp type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
            <div class="border ps-3 ans">
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
        <button class="btn px-5  pull-left btn-light-green rounded-0 saveanswer" onclick="saveAnswer('{{$activeq_id}}')">Save & Next</button>
        <button class="btn px-4 ms-2 btn-light rounded-0 savemarkreview" onclick="savemarkreview('{{$activeq_id}}','{{$subject_id}}')">Save & Mark for review</button>
        <button class="btn px-4 ms-2 btn-light rounded-0 " onclick="markforreview('{{$activeq_id}}','{{$subject_id}}')">Mark for review</button>
        <button class="btn px-4 ms-2 btn-secondary rounded-0">Clear Response</button>

    </div>
</div>
<script>
    var question_id = '{{$activeq_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>