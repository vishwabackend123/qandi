@if(isset($topics) && !empty($topics))
@foreach($topics as $key=>$topic)
<div class="item" id="topic_list_{{$chapter_id}}">
    <div class="exam-box">
        <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
            <p title="{{$topic->topic_name}}">{{$topic->topic_name}}</p>
            <h2>Proficiency: <span>
                    @if(isset($topic->topic_score))
                    {{round($topic->topic_score)}}%
                    @else
                    0%
                    @endif
                </span>
            </h2>
        </div>
        <div class="topic_score_bar mb-3">
            <div class="progress">
                <div class="progress-bar examE" role="progressbar" style="width: {{$topic->E_ques_attempted}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar examA" role="progressbar" style="width:{{$topic->A_ques_attempted}} %" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar examC" role="progressbar" style="width: {{$topic->C_ques_attempted}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar examK" role="progressbar" style="width: {{$topic->K_ques_attempted}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="exam-cate d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <a href="javascript:void(0)" style="cursor:default;pointer-events: none;">E</a>
                <a href="javascript:void(0)" style="cursor:default;pointer-events: none;">A</a>
                <a href="javascript:void(0)" style="cursor:default;pointer-events: none;">C</a>
                <a href="javascript:void(0)" style="cursor:default;pointer-events: none;">K</a>
            </div>
            <button id="chpt_topic_{{$topic->id}}" onclick="addOrRemove('{{$topic->id}}')" class="btn btn-common-transparent bg-transparent addremovetopic topic_{{$subject_name}}">Select</button>
        </div>
    </div>
</div>
@endforeach
@else
<div class="p-3 text-center">
    <h5>Topic not available</h5>
</div>
@endif
<script>
    $(document).ready(function() {
        $('.addremovetopic').on('click', function(e) {
            $(this).parent().parent().toggleClass('examborderchange');
        });
    });
</script>