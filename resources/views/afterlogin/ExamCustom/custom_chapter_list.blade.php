@if(@isset($chapters) && !empty($chapters))
@foreach($chapters as $tKey=>$chap)
<div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
    <span class="mr-3 name-txt col-4 text-break">{{$chap->chapter_name}}</span>

    <div class="status-id d-flex align-items-center   ml-0 ml-md-3 rating col-3" data-vote="0">

        <div class="star hidden">
            <span class="full" data-value="0"></span>
            <span class="half" data-value="0"></span>
        </div>

        <div class="star">

            <span class="full" data-value="1"></span>
            <span class="half" data-value="0.5"></span>
            <span class="selected"></span>

        </div>

        <div class="star">

            <span class="full" data-value="2"></span>
            <span class="half" data-value="1.5"></span>
            <span class="selected"></span>

        </div>

        <div class="star">

            <span class="full" data-value="3"></span>
            <span class="half" data-value="2.5"></span>
            <span class="selected"></span>

        </div>

        <div class="star">

            <span class="full" data-value="4"></span>
            <span class="half" data-value="3.5"></span>
            <span class="selected"></span>

        </div>

        <div class="star">

            <span class="full" data-value="5"></span>
            <span class="half" data-value="4.5"></span>
            <span class="selected"></span>

        </div>

        <div class="score score-rating js-score">
            0%
        </div>
    </div>

    <span class="slbs-link  col-2 mx-3"><a class="expand-custom" aria-controls="chapter_{{$chap->chapter_id}}" data-bs-toggle="collapse" href="#chapter_{{$chap->chapter_id}}" role="button" aria-expanded="false" onclick="show_topic('{{$chap->chapter_id}}')">Expand to Topics</a></span>
    <form method="post" action="{{route('custom_exam')}}">
        @csrf
        <input type="hidden" name="subject_id" value="">
        <input type="hidden" name="chapter_id" value="{{$chap->chapter_id}}">
        <input type="hidden" name="question_count" value="30">

        <button class="btn btn-green-custom rounded-0 btn-lg ml-0 ml-md-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
    </form>

</div>
<div class="collapse mb-4" id="chapter_{{$chap->chapter_id}}">
    <div class="d-flex ps-4">
        <button class="btn filter-icon rotate-icon ms-auto mb-2 text-danger rounded-0" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true"></i></button>
        <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chap->chapter_id}}','prof_asc')" href="javascript:void(0);"> Low Proficiency</a></li>
            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chap->chapter_id}}','prof_desc')" href="javascript:void(0);"> High Proficiency</a></li>
            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chap->chapter_id}}','asc')" href="javascript:void(0);"> A to Z order</a></li>
            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chap->chapter_id}}','desc')" href="javascript:void(0);"> Z to A order</a></li>

        </ul>
    </div>
    <section id="topic_section_{{$chap->chapter_id}}" class="slick-slider mb-4">

    </section>
</div>
@endforeach
@endif