<div class="col-lg-5">
    <div class="bg-white shadow box-shadow p-3 d-flex flex-column position-relative h-100 custom-box-shadow">
        <h5 class="dashboard-title mb-3">Subject Score</h5>

        @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
        @foreach($response->subject_wise_result as $subject)
        @php $subject=(object)$subject; @endphp
        @php
        $correct_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->correct_count/$subject->total_questions)*100),2):0;
        $incorrect_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->incorrect_count/$subject->total_questions)*100),2):0;
        $not_attempt_per=(isset($subject->total_questions) && $subject->total_questions>0)?round((($subject->unanswered_count/$subject->total_questions)*100),2):0;
        @endphp
        <div class="d-flex align-items-center mt-4 mb-2 pb-1">
            <span class="subj-name  col-3" title="{{$subject->subject_name}}">{{$subject->subject_name}}</span>
            <div class="progress ms-auto  col-8" style="overflow: visible;">
                @if($correct_per > 0)
                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{$correct_per}}%; overflow: visible;">
                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="{{$correct_per}}%">{{$subject->correct_count}}</span>
                </div>
                @endif
                @if($incorrect_per > 0)
                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{$incorrect_per}}%;overflow: visible;">
                    <span class="prog-box red" data-bs-custom-class="tooltip-red" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$incorrect_per}}">{{$subject->incorrect_count}}</span>
                </div>
                @endif
                @if($not_attempt_per > 0)
                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{$not_attempt_per}}%;overflow: visible;">
                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-gray" data-bs-placement="top" title="{{$not_attempt_per}}">{{$subject->unanswered_count}}</span>
                </div>
                @endif
            </div>
        </div>
        @endforeach
        @endif


            <div class="graphdotlisting my-4">
                <div class="garphlistincom">
                    <span class="abrv-graph bg1"> </span>
                    <span class="graph-txt">Correct Attempts</span>
                </div>
                <div class="garphlistincom">
                    <span class="abrv-graph bg2"> </span>
                    <span class="graph-txt">Wrong Attempts</span>
                </div>
                <div class="garphlistincom">
                    <span class="abrv-graph bg3"> </span>
                    <span class="graph-txt">Not Answered</span>
                </div>
            </div>
    </div>
</div>
<div class="col-lg-7">
    <div class="position-relative h-100">
        <div class="tab-wrapper h-100 box-shadow  custom-box-shadow">
            <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                @php $subx=1; @endphp
                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                @foreach($response->subject_wise_result as $subject)
                @php $subject=(object)$subject; @endphp
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if($subx==1) active @endif" id="{{$subject->subject_name}}_tab_subject" data-bs-toggle="tab" href="#{{$subject->subject_name}}_subject" role="tab" aria-controls="{{$subject->subject_name}}" aria-selected="true">{{$subject->subject_name}}</a>
                </li>
                @php $subx++; @endphp
                @endforeach
                @endif
            </ul>

            <div class="tab-content position-relative cust-tab-content bg-white sub-padding" id="myTabContent">
                @php $topx=1; @endphp
                @if(isset($response->subject_wise_result) && !empty($response->subject_wise_result))
                @foreach($response->subject_wise_result as $subject)
                @php $subject=(object)$subject;
                $subject_id=$subject->subject_id;
                @endphp
                <div class="tab-pane fade show @if($topx==1) active @endif" id="{{$subject->subject_name}}_subject" role="tabpanel" aria-labelledby="{{$subject->subject_name}}_tab_subject">

                    <div class="hScroll topicdiv-scroll pb-0">
                        @if(isset($response->topic_wise_result) && !empty($response->topic_wise_result))
                        @foreach($response->topic_wise_result as $topic)
                        @php $topic=(object)$topic; @endphp
                        @php
                        $tcorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?round((($topic->correct_count/$topic->total_questions)*100), 2):0;
                        $tincorrect_per=(isset($topic->total_questions) && $topic->total_questions>0)?round((($topic->incorrect_count/$topic->total_questions)*100), 2):0;
                        $tnot_attempt_per=(100-($tcorrect_per+$tincorrect_per));

                        @endphp
                        @if($topic->subject_id==$subject_id && !empty($topic->topic_name))

                        <div class="d-flex align-items-center mt-4 mb-2 pb-1 pe-3">
                            <span class="subj-name  col-4" title="{{!empty($topic->topic_name)?$topic->topic_name:''}}">{{!empty($topic->topic_name)?$topic->topic_name:''}}</span>
                            <div class="progress col-8 ms-auto " style="overflow: visible;">
                                @if($tcorrect_per > 0)
                                <div class="progress-bar bg-light-success position-relative" role="progressbar" style="width:{{$tcorrect_per}}%;overflow: visible;">
                                    <span class="prog-box green" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">{{$topic->correct_count}}</span>
                                </div>
                                @endif
                                @if($tincorrect_per > 0)
                                <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width:{{$tincorrect_per}}%;overflow: visible;">
                                    <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tincorrect_per}}">{{$topic->incorrect_count}}</span>
                                </div>
                                @endif
                                @if($tnot_attempt_per > 0)
                                <div class="progress-bar bg-light-secondary position-relative" role="progressbar" style="width:{{$tnot_attempt_per}}%;overflow: visible;">
                                    <span class="prog-box secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tnot_attempt_per}}">{{$topic->unanswered_count}}</span>
                                </div>
                                @endif

                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
                @php $topx++; @endphp
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    /*$(".topicdiv-scroll").slimscroll({
        height: "50vh",
    });*/
</script>
<script>
    $(document).ready(function() {
        $(".dashboard-cards-block .bg-white>small>img").click(function() {
            $(".dashboard-cards-block .bg-white>small p>span").each(function() {
                $(this).parent("p").hide();
            });
            $(this).siblings("p").show();
        });
        $(".dashboard-cards-block .bg-white>small p>span").click(function() {
            $(this).parent("p").hide();
        });
    });
</script>