@php $quKee=1; @endphp
@if(isset($all_question_list) && !empty($all_question_list))

@foreach($all_question_list as $kee=>$value)
@php

$key_id=$value->question_id;
if ($value->attempt_status == 'Correct') {
$div_class = 'border-left-green5';
} elseif ($value->attempt_status == 'Incorrect') {
$div_class = 'border-left-red5';
} else {
$div_class = '';
}@endphp
<div class="d-flex align-items-center">
    <div class="review-questions-box {{$div_class}} mx-2 mb-3">
        <div class="d-flex">
            <div class="me-3">Q{{$value->seq}}. </div>
            <p class="mb-0">{!! $value->question !!} </p>
        </div>
    </div>
</div>
@php $quKee++; @endphp
@endforeach
@endif