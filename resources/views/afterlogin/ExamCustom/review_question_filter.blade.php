@php $quKee=1; @endphp
@if(isset($all_question_list) && !empty($all_question_list))
@foreach($all_question_list as $kee=>$value)
@php
$key_id=$value->question_id;
@endphp
@if ($value->attempt_status == 'Correct')
<div class="d-flex quistion-2 greenborder-left">
    <div class="flex-shrink-0" style="padding-left: 16px;">
        Q{!! $value->quest_id !!}.
    </div>
    <div class="flex-grow-1 ms-3 quistion-content ">
        {!! $value->question !!}
    </div>
</div>
@elseif ($value->attempt_status == 'Incorrect')
<div class="d-flex quistion-1 redborder-left ">
    <div class="flex-shrink-0" style="padding-left: 16px;">
        Q{!! $value->quest_id !!}.
    </div>
    <div class="flex-grow-1 ms-3 quistion-content ">
        {!! $value->question !!}
    </div>
</div>
@else
<div class="d-flex quistion-1  ">
    <div class="flex-shrink-0" style="padding-left: 16px;">
        Q{!! $value->quest_id !!}.
    </div>
    <div class="flex-grow-1 ms-3 quistion-content ">
        {!! $value->question !!}
    </div>
</div>
@endif
@php $quKee++; @endphp
@endforeach
@endif
