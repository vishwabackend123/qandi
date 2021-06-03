@php
$question_text = isset($question_data->question)?$question_data->question:'';
@endphp
<div class="question-block">
    <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><i class="fa fa-angle-left"></i></button>
    <button class="btn arrow next-arow {{(isset($last_qid) && ($last_qid==$activeq_id))?'disabled':''}}" id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><i class="fa fa-angle-right"></i></button>
    <div class="question pb-5 pt-5" id="question_blk"><span class="q-no">Q{{$qNo}}.</span>{!! $question_text !!}</div>
    <div class="ans-block row mt-5">
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
            <div class="border p-3 ans">
                <div class="question m-0  "><span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</div>
            </div>
        </div>
        @php $no++; @endphp
        @endforeach
        @endif

    </div>
</div>
<div class="tab-btn-box  d-flex   mt-3">
    <a href="#" class="btn px-5   btn-light-green rounded-0">Save & Next</a>
    <a href="#" class="btn px-4   ms-2 btn-light rounded-0">Save & Mark for review</a>
    <a href="#" class="btn px-4 ms-auto me-2 btn-light rounded-0">Mark for review</a>
    <a href="#" class="btn px-4   me-2 btn-secondary rounded-0">Clear Response</a>

</div>