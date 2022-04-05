@if(!empty($result_data))
<input type="hidden" name="current_page" id="current_page" value="{{$current_page}}">
@foreach($result_data as $sche)
<ul class="speci-text">
    <li> <span class="sub-details">{{$sche->test_type}}</span>
    </li>
    <li><strong>Exam Date: {{date('d-m-Y', strtotime($sche->created_at));}}</strong>
    </li>
    <li><strong>Test Time: {{date('H:i:s', strtotime($sche->created_at));}} </strong>
    </li>
    <li>{{$sche->no_of_question}} Questions</a>
    </li>
    <li><a href="{{route('exam_review',$sche->id)}}">
            <button class="custom-btn-gray"></i>Review Exam
            </button>
        </a>
    </li>
</ul>
@endforeach
@else
<div class="text-center">
    <span class="sub-details">No result history available right now.</span>
</div>
@endif
