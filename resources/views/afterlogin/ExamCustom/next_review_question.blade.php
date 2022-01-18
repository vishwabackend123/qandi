@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;


@endphp
<div class="question-block">
    <a href="javascript:void(0);" title="Bookmark" id="bkm_{{$activeq_id}}" onclick="bookmarkforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')" class="arrow next-arow"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a>
    <div class="question pb-3 pt-2"><span class="q-no">Q{{$qNo}}.</span>
        {!! $question_text !!}
    </div>
    <div class="ans-block row mt-0">
        @if(isset($option_data) && !empty($option_data))
        @php $no=0;
        $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
        @endphp

        @foreach($option_data as $key=>$opt_value)
        @php
        $dom = new DOMDocument();
        @$dom->loadHTML($opt_value);
        $anchor = $dom->getElementsByTagName('img')->item(0);
        $text = isset($anchor)? $anchor->getAttribute('alt') : '';
        $latex = "https://math.now.sh?from=".$text;
        $view_opt='<img src="'.$latex.'" />' ;
        $attemptedByUser=isset($attempt_opt['Answer:'])?$attempt_opt['Answer:']:[];

        if(in_array($key,$answerKeys) && in_array($key,$attemptedByUser)){
        $resp_class= 'correctAnswer';
        }else if(in_array($key,$answerKeys) && !in_array($key,$attemptedByUser)){
        $resp_class= 'correctAnswer';
        }else if(!in_array($key,$answerKeys) && in_array($key,$attemptedByUser)){
        $resp_class= 'incorrectAnswer';
        }else{
        $resp_class= '';
        }

        if(isset($attempt_opt['Answer:']) && in_array($key,$attempt_opt['Answer:'])){
        $checked= "checked";
        }else{
        $checked='';
        }

        @endphp
        <div class="col-md-6 mb-4">
            <input class="form-check-input checkboxans" {{$checked}} disabled type="checkbox" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
            <div class="border ps-3 ans {{$resp_class}}">
                <label class="question m-0 py-3 " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}.</span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
            </div>
        </div>@php $no++; @endphp
        @endforeach
        @endif
    </div>
</div>
<div class="answer-section">
    <div class="answer-btn-txt"><span>Answer:</span>
        <span> @php $mn=0; @endphp
            @foreach($correct_ans as $akey=>$ans_value)
            @php
            $ans_dom = new DOMDocument();
            @$ans_dom->loadHTML($ans_value);
            $ans_anchor = $ans_dom->getElementsByTagName('img')->item(0);
            $atext = isset($ans_anchor)? $ans_anchor->getAttribute('alt') : '';
            $alatex = "https://math.now.sh?from=".$atext;
            $view_ans='<img src="'.$alatex.'" />' ;
            @endphp
            {!! !empty($atext)?$view_ans:$ans_value; !!}
            @php $mn++; @endphp
            @endforeach</span>
        <!-- <button class="percentage-digit">21 %</button> -->
    </div>
    <div class="ans-txt">
        @if(isset($question_data->explanation ) && !empty($question_data->explanation ))
        <sapn>Explanation :</sapn>
        <p>{!! $question_data->explanation !!}</p>
        @endif
        @if(isset($question_data->reference_text ) && !empty($question_data->reference_text ))

        <span>Reference :</span>

        <p>{!! $question_data->reference_text !!}</p>
        @endif
    </div>
</div>
<script>
    $('.answer-block').slimscroll({
        height: '45vh'
    });
    var question_id = '{{$activeq_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>