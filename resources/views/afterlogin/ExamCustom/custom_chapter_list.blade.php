@if(@isset($chapters) && !empty($chapters))
@foreach($chapters as $tKey=>$chapters)
<div class="compLeteS">
    <div class="ClickBack d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-2 listing-details w-100 flex-wrap  ">
        <span class="mr-3 name-txt" title="{{$chapters->chapter_name}}">{{$chapters->chapter_name}}</span>

        <div class="status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

            <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                <div class="star-ratings-css">
                    <div class="star-ratings-css-top" style="width: {{isset($chapters->chapter_score)?$chapters->chapter_score:0}}%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="star-ratings-css-bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>

                <div class="ms-1 score score-rating js-score">
                    {{isset($chapters->chapter_score)?$chapters->chapter_score:0}}%
                </div>
            </div>
        </div>

        <span class="slbs-link mx-3">
            <a class="expand-custom expandTopicCollapse" aria-controls="chapter_{{$chapters->chapter_id}}" data-bs-toggle="collapse" href="#chapter_{{$chapters->chapter_id}}" role="button" aria-expanded="false" value="Expand to topics" onclick="show_topic('{{$chapters->chapter_id}}')"><span id="expand_topic_{{$chapters->chapter_id}}">Expand to topics</span></a></span>

        <div class="d-flex px-4">
            <button class="btn btn-light ms-auto text-danger rounded-0" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false" title="Topics Filter">
                <!-- <i class="fa fa-sliders" aria-hidden="true"></i> -->
                <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860.png')}}" class="dsowl">
                <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860-white.png')}}" class="hsowl">
            </button>
            <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
                <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_asc')" href="javascript:void(0);">
                        <img src="{{URL::asset('public/after_login/new_ui/images/Group-4864.png')}}">
                        Low Proficiency</a></li>
                <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_desc')" href="javascript:void(0);">
                        <img src="{{URL::asset('public/after_login/new_ui/images/Group-2976.png')}}">
                        High Proficiency</a></li>
                <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','priority')" href="javascript:void(0);">
                        <img src="{{URL::asset('public/after_login/new_ui/images/Group-2978.png')}}">
                        Order by Priority</a></li>
                <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','sequence')" href="javascript:void(0);">
                        <img src="{{URL::asset('public/after_login/new_ui/images/Group-2979.png')}}">
                        Order by Sequence</a></li>

            </ul>
        </div>


        <form method="post" action="{{route('custom_exam_chapter')}}">
            @csrf
            <input type="hidden" name="subject_id" value="">
            <input type="hidden" name="chapter_id" value="{{$chapters->chapter_id}}">
            <input type="hidden" name="question_count" value="30">

            <button class="btn rounded-0 btn-lg ml-0 ml-md-3 custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
        </form>

    </div>
    <div class="collapse mb-4" id="chapter_{{$chapters->chapter_id}}">

        <section id="topic_section_{{$chapters->chapter_id}}" class="slick-slider mb-4">


        </section>
    </div>
</div>
@endforeach
@endif
<script>
    $('.slick-slider').slick({
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        centerMode: false,
        focusOnSelect: false,
        infinite: false,
        slidesToShow: 3.2,
        variableWidth: false,
        prevArrow: '<button class="slick-prev"> < </button>',
        nextArrow: '<button class="slick-next"> > </button>',
    });
</script>