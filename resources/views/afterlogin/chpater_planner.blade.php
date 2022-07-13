<option class="we" value="" selected disbled hidden>Select chapter</option>
@if(isset($chapter_list) && !empty($chapter_list))
@foreach($chapter_list as $key=>$val)
<option class="we2" value="{{$val->chapter_id}}" @if(in_array($val->chapter_id,$selected_chapter)) disabled @endif >{{$val->chapter_name}}</option>

@endforeach
@endif