@if(@isset($chapters) && !empty($chapters))
@foreach($chapters as $tKey=>$chapters)
<div class="compLeteS" id="chapter_box_{{$chapters->chapter_id}}">
    <div class=" ClickBack d-flex align-items-center justify-content-between bg-white  listing-details w-100 flex-wrap ">
        <span class=" mr-3 name-txt" title="{{$chapters->chapter_name}}" style="text-transform:none">{{$chapters->chapter_name}}</span>

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
                    @if(isset($chapters->chapter_score))
                        {{round($chapters->chapter_score)}}%
                        @else
                        0%
                    @endif
                </div>
            </div>
        </div>

        <span class="slbs-link mx-3">
            <a class="expand-custom expandTopicCollapse" aria-controls="chapter_{{$chapters->chapter_id}}" data-bs-toggle="collapse" href="#chapter_{{$chapters->chapter_id}}" role="button" aria-expanded="false" value="Show Topics" onclick="show_topic('{{$chapters->chapter_id}}','{{$subject_id}}')" id="clicktopic_{{$chapters->chapter_id}}"><span id="expandTopic_{{$chapters->chapter_id}}"><i class="fa fa-arrow-down"></i> Show Topics</span></a></span>

        <div class="d-flex pe-4">
            <button class="btn btn-light ms-auto text-danger rounded-0 expand_filter_{{$chapters->chapter_id}} disabled" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false" title="Topics Filter">
                <!-- <i class="fa fa-sliders" aria-hidden="true"></i> -->
                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860.png')}}" class="dsowl">
                          <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860-white.png')}}" class="hsowl"> -->
                <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4860" width="24" height="24" viewBox="0 0 24 24">
                    <path data-name="Path 11531" d="M0 0h24v24H0z" style="fill:none" />
                    <path data-name="Path 11532" d="m3 9 4-4 4 4M7 5v14" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                    <path data-name="Path 11533" d="m21 15-4 4-4-4m4 4V5" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                </svg>
            </button>
            <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
                <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_asc')" href="javascript:void(0);">
                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-4864.png')}}"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4864" width="24" height="24" viewBox="0 0 24 24">
                            <path data-name="Path 2676" d="M0 0h24v24H0z" style="fill:none" />
                            <path data-name="Path 2677" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2678" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2679" d="M17 3a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0V5a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            <circle data-name="Ellipse 785" cx="2" cy="2" r="2" transform="translate(15 14)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2680" d="M19 16v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                        </svg>
                        Low Proficiency
                    </a></li>
                <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_desc')" href="javascript:void(0);">
                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2976.png')}}"> -->

                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                            <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none" />
                            <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                        </svg>
                        High Proficiency
                    </a></li>
                <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','priority')" href="javascript:void(0);">
                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2978.png')}}"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                            <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none" />
                            <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                        </svg>
                        Order by Priority
                    </a></li>
                <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','sequence')" href="javascript:void(0);">
                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2979.png')}}"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                            <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none" />
                            <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                        </svg>
                        Order by Sequence
                    </a></li>

            </ul>
        </div>


        <form method="post" action="{{route('custom_exam_chapter')}}" class="mb-0">
            @csrf
            <input type="hidden" name="subject_id" value="">

            <input type="hidden" name="chapter_id" value="{{$chapters->chapter_id}}">
            <input type="hidden" name="question_count" value="30">

            <button class="btn rounded-0 btn-lg ml-0 ml-md-3 custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take This Test</button>
        </form>

    </div>
    <div class="collapse mb-4" id="chapter_{{$chapters->chapter_id}}">

        <section id="topic_section_{{$chapters->chapter_id}}" class="slick-slider mb-4">


        </section>
    </div>
</div>
@endforeach
@endif