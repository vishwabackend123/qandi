@if(isset($topics) && !empty($topics))
@foreach($topics as $key=>$topic)

<div class="topicList">
    <div class="topic_box d-flex flex-column">
        <div class="d-flex align-items-center">
            <div class="mr-3 name-txt-sml w-100 text-wrap">{{$topic->topic_name}} </div>

            <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                <div class="star-ratings-css">
                    <div class="star-ratings-css-top" style="width: {{$topic->score}}%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="star-ratings-css-bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>

                <div class="ms-1 score score-rating js-score">
                    {{$topic->score}}%
                </div>
            </div>
        </div>

        <div class="range-gauge">
            <div class="range-bar">
                <div class="gauge-bubble" style="left:30%"> </div>
                <div class="bar" style="left:0%;width:30%;background-color:#AFF3D0"> </div>
                <div class="bar" style="left:30%;width:30%;background-color: #FF9999"></div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <button href="#" class="btn skill-btn green rounded-0 me-2">K</button>
            <button href="#" class="btn skill-btn green rounded-0 me-2">C</button>
            <button href="#" class="btn skill-btn red rounded-0 me-2">A</button>
            <button href="#" class="btn skill-btn gray rounded-0 me-2">E</button>
            <button id="chpt_topic_{{$topic->id}}" href="javascript:void(0);" class="btn ms-auto topic-btn-select rounded-0 addremovetopic" onclick="addOrRemove('{{$topic->id}}')">Select </button>

        </div>
    </div>
</div>

@endforeach
@else

<div class="p-3 text-center">
    <h5>Topic not available</h5>
</div>

@endif