@if(@isset($chapters) && !empty($chapters))
@foreach($chapters as $tKey=>$chap)
<div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
    <span class="mr-3 name-txt">{{$chap->chapter_name}}</span>

    <div class="status-id d-flex align-items-center   ml-0 ml-md-3 rating col-3" data-vote="0">

        <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

            <div class="star-ratings-css">
                <div class="star-ratings-css-top" style="width: {{isset($chap->chapter_score)?$chap->chapter_score:0}}%">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <div class="star-ratings-css-bottom">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
            </div>

            <div class="ms-1 score score-rating js-score">
                {{isset($chap->chapter_score)?$chap->chapter_score:0}}%
            </div>
        </div>
    </div>

    <span class="slbs-link mx-3">
        <a class="expand-custom" aria-controls="chapter_{{$chap->chapter_id}}" data-bs-toggle="collapse" href="#chapter_{{$chap->chapter_id}}" role="button" aria-expanded="false" onclick="show_topic('{{$chap->chapter_id}}')">Expand to Topics</a></span>
    <form method="post" action="{{route('custom_exam_chapter')}}">
        @csrf
        <input type="hidden" name="subject_id" value="">
        <input type="hidden" name="chapter_id" value="{{$chap->chapter_id}}">
        <input type="hidden" name="question_count" value="30">

        <button class="btn rounded-0 btn-lg ml-0 ml-md-3 custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
    </form>

</div>
<div class="collapse mb-4" id="chapter_{{$chap->chapter_id}}">
    <div class="d-flex ps-4">
        <button class="btn btn-light rotate-icon ms-auto text-danger rounded-0" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true"></i></button>
        <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chap->chapter_id}}','prof_asc')" href="javascript:void(0);"> <i class="fas fa-sort-numeric-down"></i> Low Proficiency</a></li>
            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chap->chapter_id}}','prof_desc')" href="javascript:void(0);"> <i class="fas fa-sort-numeric-down-alt"></i> High Proficiency</a></li>
            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chap->chapter_id}}','priority')" href="javascript:void(0);"><i class="fas fa-sort-alpha-down"></i>Order by Priority</a></li>
            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chap->chapter_id}}','sequence')" href="javascript:void(0);"><i class="fas fa-sort-alpha-down-alt"></i> Order by Sequence</a></li>

        </ul>
    </div>
    <section id="topic_section_{{$chap->chapter_id}}" class="slick-slider mb-4">


    </section>
</div>
@endforeach
@endif

<script>
    $('.slick-slider').slick({
        slidesToScroll: 1,
        dots: false,
        centerMode: false,
        focusOnSelect: false,
        infinite: true,
        slidesToShow: 2,
        variableWidth: false,
        prevArrow: false,
        nextArrow: false
    });
</script>