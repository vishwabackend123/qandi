@if(isset($topics) && !empty($topics))
@foreach($topics as $key=>$topic)
<div class="p-3 custOmSld">

    <div id="topic_box_{{$topic->id}}" class="bg-light shadow p-3 d-flex flex-column">
        <div class="d-flex align-items-center">
            <span class="mr-3 name-txt-sml" title="{{$topic->topic_name}}">{{$topic->topic_name}}</span>

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


        <div class="colorfull-bars">
            <div class="d-flex">
                <span class="green_bar position-relative"></span>
                <span class="yellow_bar position-relative"></span>
                <span class="red_bar position-relative"></span>
                <span class="skyblue_bar position-relative"></span>
            </div>
        </div>

        <div class="d-flex align-items-center sub-subject">
            <a href="#" class="btn rounded-0 me-2 bar-green Kn" title="KNOWLEDGE"><strong>K</strong></a>
            <a href="#" class="btn rounded-0 me-2 bar-green Co" title="COMPREHENSION"><strong>C</strong></a>
            <a href="#" class="btn rounded-0 me-2 bar-red Ap" title="APPLICATION"><strong>A</strong></a>
            <a href="#" class="btn rounded-0 me-2 Ev" title="EVALUATION"><strong>E</strong></a>
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