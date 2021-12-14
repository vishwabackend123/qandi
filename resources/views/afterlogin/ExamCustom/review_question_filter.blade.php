@php $quKee=1; @endphp
@if(isset($all_question_list) && !empty($all_question_list))

@foreach($all_question_list as $kee=>$value)
@php

$key_id=$value->question_id;
@endphp
@if ($value->attempt_status == 'Correct')
<li class="correctans">
    <span class="qus-no">Q.{{$quKee}}</span>
    <span class="qus-txt">{!! $value->question !!}
    </span>
</li>
@elseif ($value->attempt_status == 'Incorrect')
<li class="incorrectans">
    <span class="qus-no">Q.{{$quKee}}</span>
    <span class="qus-txt">{!! $value->question !!}
    </span>
</li>
@else
<li class="notans">
    <span class="qus-no">Q.{{$quKee}}</span>
    <span class="qus-txt">{!! $value->question !!}
    </span>
</li>
@endif
@php $quKee++; @endphp
@endforeach
@endif