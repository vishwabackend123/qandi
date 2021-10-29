@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subt_id)?$question_data->subt_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;

@endphp

<div class="question-block px-2 pt-3 pb-2">
    <div class="row">
        <div class="col-md-10">
            <div class="question pb-3 " id="question_blk"><span class="q-no">Q{{$qNo}}.</span>{!! $question_text !!}</div>
            <div class="ans-block row my-4 N_radioans">
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

                $resp_class= '';
                @endphp
                <div class="col-md-6 mb-4">
                    <input class="form-check-input radioans" type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                    <div class="border ps-5 ans  {{$resp_class}}">
                        <label class="question m-0 py-3   d-block " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
                    </div>
                </div>

                @php $no++; @endphp
                @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-2 text-right">
            <a href="javascript:void(0);" id="bkm_{{$activeq_id}}" onclick="bookmarkforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')"> <i class="fa fa-bookmark-o text-dark pull-right" aria-hidden="true"></i></a>
        </div>
    </div>
    

</div>
<script>
    $('.answer-block').slimscroll({
        height: '45vh'
    });
    var question_id = '{{$activeq_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion1");

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>