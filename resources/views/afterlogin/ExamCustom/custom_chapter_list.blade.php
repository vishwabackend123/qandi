<div class="testtablescroll allscrollbar">
    @if(@isset($chapters) && !empty($chapters))
    @foreach($chapters as $tKey=>$chapters)
    <div class="accordion-item">
        <div class="test-table d-md-flex align-items-center justify-content-between pb-md-3 mb-md-1 position-relative">
            <h2 class="m-0">{{$chapters->chapter_name}}</h2>
            <h3 class="m-0">Proficiency : <span> @if(isset($chapters->chapter_score))
                    {{round($chapters->chapter_score)}}%
                    @else
                    0%
                    @endif</span></h3>
            <div class="accordion-header d-flex align-items-center justify-content-between pt-md-0 pt-4" id="headingTwo">
                <h4 onclick="show_topic('{{$chapters->chapter_id}}','{{$subject_id}}')" class="m-0" id="chapter_list_{{$subject_id}}_expandTopic_{{$chapters->chapter_id}}">View topics</h4>
                <form class="w-100 text-right" method="post" action="{{route('custom_exam_chapter','instruction')}}" class="mb-0">
                    @csrf
                    <input type="hidden" name="subject_id" value="">
                    <input type="hidden" name="subject_name" value="{{$filtered_subject->subject_name}}">
                    <input type="hidden" name="chapter_id" value="{{$chapters->chapter_id}}">
                    <input type="hidden" name="question_count" value="30">
                    <button class="btn btn-common-transparent bg-transparent w-100">Take test</button>
                </form>
            </div>
        </div>
        <div id="collapseTwo_custome_{{$chapters->chapter_id}}" class=" chapters-expend">
            <div class="accordion-body ps-0 pe-0 pt-4">
                <div class="testslider owl-carousel owl-theme" id="topic_section_{{$chapters->chapter_id}}">
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
<script type="text/javascript">
    $('.chapters-expend').hide();
</script>
