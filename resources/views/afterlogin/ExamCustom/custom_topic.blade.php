@if(isset($topics) && !empty($topics))
@foreach($topics as $key=>$topic)

<div class="topicList">
    <div class="topic_box d-flex flex-column">
        <div class="d-flex align-items-center">
            <div class="mr-3 name-txt-sml w-100 text-wrap">{{$topic->topic_name}} </div>

            <div class="status-id d-flex align-items-center justify-content-center ms-auto rating" data-vote="0">

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