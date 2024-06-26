@if(isset($topics) && !empty($topics))
@foreach($topics as $key=>$topic)
<div class="item" id="topic_list_{{$chapter_id}}">
    <div class="exam-box">
        <div class="exambox-heading d-flex align-items-center justify-content-between">
            <p title="{{$topic->topic_name}}">{{$topic->topic_name}}</p>
        </div>
        
        <div class="exam-cate d-flex align-items-end justify-content-between">
            
            <div class="proficiency_graph_block">
                <h2>Proficiency:  </h2>
                    <?php
                    if (round($topic->topic_score) <= 40) {
                        $colorcls = "";
                    } elseif (round($topic->topic_score) <= 75) {
                        $colorcls = "yellowgraph";
                    } else {
                        $colorcls = "greengraph";
                    }
                    ?>
                <div class="proficiency_graph radial_progress_bar">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="-1 -1 34 34">
                    
                        <circle cx="16" cy="16" r="15.9155"
                                class="progress-bar__background" />
                        
                        <circle cx="16" cy="16" r="15.9155"
                                class="progress-bar__progress 
                                        js-progress-bar {{$colorcls}}" id="js-progress-bar{{$topic->id}}"  data-score="{{round($topic->topic_score)}}"/>
                    </svg>
                    <span class="proficiency_value">
                        @if(isset($topic->topic_score))
                        {{round($topic->topic_score)}}%
                        @else
                        0%
                        @endif
                    </span> 
                </div>
            </div>
            <button id="chpt_topic_{{$topic->id}}" onclick="addOrRemove('{{$topic->id}}','{{$subject_name}}')" class="btn btn-common-transparent bg-transparent addremovetopic topic_{{$subject_name}}">Select</button>
        </div>
    </div>
</div>

@endforeach
@else
<div class="p-3 text-center">
    <h5>Topic not available</h5>
</div>
@endif


