@if(isset($topics) && !empty($topics))
@foreach($topics as $key=>$topic)
<div class="p-3">

    <div class="bg-light shadow p-3 d-flex flex-column">
        <div class="d-flex align-items-center">
            <span class="mr-3 name-txt-sml">{{$topic->topic_name}}</span>

            <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                <div class="star-ratings-css">
                    <div class="star-ratings-css-top" style="width:  {{isset($topic->topic_score)?$topic->topic_score:0}}%">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="star-ratings-css-bottom">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                </div>

                <div class="ms-1 score score-rating js-score">
                    {{isset($topic->topic_score)?$topic->topic_score:0}}%
                </div>
            </div>
        </div>

        <div class="range-gauge">
            <div class="range-bar">
                <div class="gauge-bubble"> </div>
                <div class="bar-green"> </div>
                <div class="bar-red"></div>
            </div>
        </div>
        <div class="d-flex align-items-center sub-subject">
            <a href="#" class="btn rounded-0 me-2 bar-green"><strong>K</strong></a>
            <a href="#" class="btn rounded-0 me-2 bar-green"><strong>C</strong></a>
            <a href="#" class="btn rounded-0 me-2 bar-red"><strong>A</strong></a>
            <a href="#" class="btn rounded-0 me-2"><strong>E</strong></a>
            <a id="chpt_topic_{{$topic->id}}" href="javascript:void(0);" onclick="addOrRemove('{{$topic->id}}')" class="btn btn-light rounded-0 ms-auto px-5 addremovetopic">Select </a>
        </div>
    </div>
</div>
@endforeach
@else
<div class="p-3 text-center">
    <h5>Topic not available</h5>
</div>

@endif