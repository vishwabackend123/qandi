<div class="commonWhiteBox commonblockDash subject_score_card borderRadius">
    <h3 class="boxheading d-flex align-items-center">Subject Score
        <span class="tooltipmain ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                </g>
            </svg>
            <p class="tooltipclass">
                <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
            </p>
        </span>
    </h3>
    <p class="dashSubtext mb-4">Negative marking for incorrect answers is considered</p>
    <div class="row">
        @if(isset($response->subject_wise_result))
        @foreach($response->subject_wise_result as $subData)
        <div class="col-sm-6 mb-3">
            <h5 class="mb-0">{{$subData->subject_name}}</h5>
            <div class="d-flex align-items-center">
                <div class="halfdoughnut">
                    <canvas id="subjectChart_{{$subData->subject_id}}"></canvas>
                </div>
                <div class="color_labels ms-5">
                    <span class="d-block">Correct <b><small></small>{{$subData->correct_count}}</b></span>
                    <span class="d-block mt-3 mb-3">Incorrect <b><small></small>{{$subData->incorrect_count}}</b></span>
                    <span class="d-block">Not Attempted <b><small style="background-color: #e5eaee;"></small>{{$subData->unanswered_count}}</b></span>
                </div>
            </div>
        </div>
        @endforeach
        @endif
       
    </div>
</div>
<div class="commonWhiteBox commonblockDash borderRadius">
    <h3 class="boxheading d-flex align-items-center">Topic Score
        <span class="tooltipmain ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                </g>
            </svg>
            <p class="tooltipclass">
                <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
            </p>
        </span>
    </h3>
    <div class="common_greenbadge_tabs">
        <div class="row mb-4 mt-4 align-items-center">
            <div class="col-md-6">
                <ul class="nav nav-pills  d-inline-flex" id="topic-tab" role="tablist">
                    @if(isset($response->subject_wise_result))
                    @foreach($response->subject_wise_result as $skey=>$subData)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn @if($skey==0) active @endif" id="pills-{{$subData->subject_name}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$subData->subject_name}}" type="button" role="tab" aria-controls="pills-{{$subData->subject_name}}" aria-selected="true">{{$subData->subject_name}}</button>
                    </li>
                    @endforeach
                    @endif
                   
                </ul>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between color_labels">
                    <span><small></small> Correct</span>
                    <span><small></small> Incorrect</span>
                    <span><small></small> Not Attempted</span>
                </div>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            @if(isset($response->subject_wise_result))
            @foreach($response->subject_wise_result as $key=>$subDataTopic)
            <div class="tab-pane fade show @if($key==0) active @endif" id="pills-{{$subDataTopic->subject_name}}" role="tabpanel" aria-labelledby="pills-{{$subDataTopic->subject_name}}-tab">
                <ul class="topic_score_lists d-flex justify-content-between flex-wrap">
                    @if(isset($response->topic_wise_result))
                    @foreach($response->topic_wise_result as $key=>$tdata)
                    @if($tdata->subject_id==$subDataTopic->subject_id)
                    @php
                    $corr_Per=(isset($tdata->total_questions)&& !empty($tdata->total_questions))?$tdata->correct_count*100/$tdata->total_questions:0;
                    $incorr_Per=(isset($tdata->incorrect_count)&& !empty($tdata->total_questions))?$tdata->incorrect_count*100/$tdata->total_questions:0;
                    $unanswered_Per=(isset($tdata->unanswered_count)&& !empty($tdata->total_questions))?$tdata->unanswered_count*100/$tdata->total_questions:0;
                    @endphp

                    <li>
                        <div class="topic_score_bar dropdown">
                            <h4>{{$tdata->topic_name}}</h4>
                            <div class="progress dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="progress-bar correct-bg" role="progressbar" style="width:{{$corr_Per}}%" aria-valuenow=" {{$corr_Per}}" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar incorrect-bg" role="progressbar" style="width:{{$incorr_Per}}%" aria-valuenow=" {{$incorr_Per}}" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar not-attempted-bg" role="progressbar" style="width: {{$unanswered_Per}}%" aria-valuenow=" {{$unanswered_Per}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <ul class="dropdown-menu noofquestions-block" aria-labelledby="dropdownMenuButton1">
                                <h5 style="font-size: 14px;font-weight: 600;color: #000;margin-bottom: 20px;">Number of questions</h5>
                                <div class="color_labels">
                                    <span class="d-block"><small></small> Correct <b>{{$tdata->correct_count}}</b></span>
                                    <span class="d-block mt-3 mb-3"><small></small> Incorrect <b>{{$tdata->incorrect_count}}</b></span>
                                    <span class="d-block"><small></small> Not Attempted <b>{{$tdata->unanswered_count}}</b></span>
                                </div>
                            </ul>
                            <!-- <div class="noofquestions-block">
                                <h5 style="font-size: 14px;font-weight: 600;color: #000;margin-bottom: 20px;">Number of questions</h5>
                                <div class="color_labels">
                                    <span class="d-block"><small></small> Correct <b>{{$tdata->correct_count}}</b></span>
                                    <span class="d-block mt-3 mb-3"><small></small> Incorrect <b>{{$tdata->incorrect_count}}</b></span>
                                    <span class="d-block"><small></small> Not Attempted <b>{{$tdata->unanswered_count}}</b></span>
                                </div>
                            </div> -->
                        </div>
                    </li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </div>
            @endforeach
            @endif
            <!--  <div class="tab-pane fade" id="pills-physicssub" role="tabpanel" aria-labelledby="pills-physicssub-tab">...</div>
            <div class="tab-pane fade" id="pills-chemistrysub" role="tabpanel" aria-labelledby="pills-chemistrysub-tab">...</div> -->
        </div>
    </div>
</div>
 
<script>
    /***************** halfdoughnut - start *********************/
    var graphArr = <?php echo json_encode($response->subject_wise_result); ?>;
    var studet_score = [];
    var class_score = [];
    var data = 'data';
    var m = 'circuference';
    var i = 0;
    const iterator = graphArr.values();
    for (const value of iterator) {
        var subId = value.subject_id;
        var correct_count = value.correct_count;
        var incorrect_count = value.incorrect_count;
        var unanswered_count = value.unanswered_count;
        /* eval('var ' + data + subId + '= '';');
        console.log(data); */



        var circuference = 260;
        var data = {
            labels: ["Correct", "Incorrect", "Not Attempted"],
            datasets: [{
                label: "My First Dataset",
                data: [correct_count, incorrect_count, unanswered_count],
                backgroundColor: [
                    "#08d5a1",
                    "#fb7686",
                    "#f2f4f7"
                ]
            }]
        };
        const config = {
            type: "doughnut",
            data: data,
            options: {
                reponsive: true,
                maintainAspectRatio: false,
                rotation: (circuference / 2) * -1,
                circumference: circuference,
                cutout: "60%",
                borderWidth: 0,
                borderRadius: function(context, options) {
                    const index = context.dataIndex;
                    let radius = {};
                    if (index == 0) {
                        radius.innerStart = 0;
                        radius.outerStart = 0;
                    }
                    if (index === context.dataset.data.length - 1) {
                        radius.innerEnd = 0;
                        radius.outerEnd = 0;
                    }
                    return radius;
                },
                plugins: {
                    title: false,
                    subtitle: false,
                    legend: false
                },
            }
        };
        const myCharted = new Chart("subjectChart_" + subId, config)
    }
    $("span.tooltipmain svg").click(function(event) {
            event.stopPropagation();

            var card_open = $(this).siblings("p").hasClass('show');
            if (card_open === true) {
                $(this).siblings("p").hide();
                $(this).siblings("p").removeClass('show');
            } else {
                $("span.tooltipmain p.tooltipclass span").each(function() {
                    $(this).parent("p").hide();
                    $(this).parent("p").removeClass('show');
                });
                $(this).siblings("p").show();
                $(this).siblings("p").addClass('show');
            }

        });
    $("span.tooltipmain p.tooltipclass span").click(function() {
        $(this).parent("p").hide();
        $(this).parent("p").removeClass('show');
    });
    $(document).on('click', function(e) {
        var card_opened = $('.tooltipclass').hasClass('show');
        if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
            $('.tooltipclass').hide();
            $('.tooltipclass').removeClass('show');
        }
    });
</script>