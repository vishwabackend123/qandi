@if(isset($topics) && !empty($topics))
@foreach($topics as $key=>$topic)

<div class="p-3 slide_box border-0">
    <div class="bg-light shadow p-3 d-flex flex-column">
        <div class="d-flex align-items-center">
            <span class="mr-3 name-txt-sml">{{$topic->topic_name}} </span>

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
                    0 %

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
            <a href="#" class="btn btn-light-green rounded-0 me-2">K</a>
            <a href="#" class="btn btn-light-green rounded-0 me-2">C</a>
            <a href="#" class="btn btn-light-red rounded-0 me-2">A</a>
            <a href="#" class="btn btn-light rounded-0 me-2">E</a>
            <a id="chpt_topic_{{$topic->id}}" href="javascript:void(0);" class="btn btn-light rounded-0 ms-auto px-5 addremovetopic" onclick="addOrRemove('{{$topic->id}}')">Select </a>
        </div>
    </div>
</div>

@endforeach
@else

<div class="p-3 text-center">
    <h5>Topic not available</h5>
</div>

@endif