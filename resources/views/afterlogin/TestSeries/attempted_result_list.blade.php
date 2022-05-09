<div class="d-flex  p-4 mb-4">
                                    <a class="btn sectionBtn btn-primary me-2">ALL TEST SERIES</a>
                                    <a class="btn sectionBtn btn-outline-primary me-2">OPEN TEST SERIES</a>
                                    <a class="btn sectionBtn btn-outline-primary">LIVE TEST SERIES</a>
                                </div>
<div class="tab-pane fade show active" id="attempted" role="tabpanel" aria-labelledby="attempted-tab">
    <div class="scroll-div mt-4" id="chapter_list_1">
                                  @if(!empty($result_data))
                                  @foreach($result_data as $sche)
                                    <div class="compLeteS" id="chapter_box_{{$sche->id}}">
                                        <div class="ClickBack d-flex align-items-center justify-content-between bg-white  px-3 py-2 mb-2 listing-details w-100 flex-wrap result-list-table">
                                            <div class="d-flex align-items-start justify-content-between result-list-head">
                                                <h4 class="m-lg-0 p-0">@if($sche->test_series_name)
                                                  {{$sche->test_series_name}}
                                                  @elseif($sche->live_exam_name)
                                                  {{$sche->live_exam_name}}
                                                  @elseif($sche->test_type == 'Mocktest')
                                                  Mock Test
                                                  @else
                                                  {{$sche->test_type}}
                                                  @endif

                                                </h4>
                                                <p class="m-0 p-0">{{date('d F Y', strtotime($sche->created_at));}}</p>
                                            </div>
                                          <?php
                                          
                                          $time = date('H', strtotime($sche->created_at));  
                                          $slot = 0;                                       
                                          if ($time < "12") {
                                          $slot = "Morning";
                                          } else
                                         
                                          if ($time >= "12" && $time < "17") {
                                           $slot = "Afternoon";
                                          } else
                                          
                                          if ($time >= "17" && $time < "19") {
                                          $slot = "Evening";
                                          } else
                                          
                                          if ($time >= "19") {
                                          $slot = "Night";
                                          }
                                          ?>
                                            <div class="d-flex align-items-center justify-content-center morning-slot">
                                                <p class="m-0 p-0">{{$slot}} Slots</p>
                                                <span class="slbs-link ms-5 me-lg-0 me-2">
                                                    <a class="expand-custom expandTopicCollapse" aria-controls="chapter_{{$sche->id}}" data-bs-toggle="collapse" href="#chapter_{{$sche->id}}" role="button" aria-expanded="true" value="Expand to Topics"  id="clicktopic_{{$sche->id}}"><span id="expand_topic_{{$sche->id}}">Show Details</span></a></span>
                                            </div>
                                            <div class="result-list-btns">
                                                <a href="{{route('exam_review',[$sche->id,'attempted'])}}" class="btn result-review w-100">Review Exam</a>
                                            </div>
                                        </div>
                                        <div class="mb-4 collapse" id="chapter_{{$sche->id}}">
                                            <div class="p-3 pb-4 d-flex justify-content-between full-syllabus">
                                                <div class="score-show text-center">
                                                    <p class="p-0 mb-3">Score:<span>{{$sche->marks_gain}}</span>/{{$sche->no_of_question * 4}}</p>
                                                    <a href="{{route('get_exam_result_analytics',$sche->id)}}" class="btn result-analysis text-uppercase boder-0 text-white"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp;See Analytics</a>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center paper-summery ps-lg-5 ps-2 pe-2">
                                                    <div class="paper-sub">
                                                        <small>No of Question</small>
                                                        <span>{{$sche->no_of_question}} MCQ</span>
                                                    </div>
                                                    <div class="paper-sub">
                                                        <small>Duration</small>
                                                        <span>{{$sche->test_time/60}}</span> Minutes
                                                    </div>
                                                    <div class="paper-sub">
                                                        <small>Marks</small>
                                                        <span>{{$sche->no_of_question * 4}}</span>
                                                    </div>
                                                    <div class="paper-sub">
                                                        <small>Subjects</small>
                                                        <span>{{$sche->subject_name}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="text-center">
                                        <span class="sub-details">No result history available right now.</span>
                                    </div>
                                    @endif
                                </div>
</div>
<style>
.newelement {
    background: white !important;
    border-radius: 21px;
    border: 6px solid #f2f2f2;
    margin-top: 14px;
}

.newelement form {
    margin-bottom: 0px;
}

.newelement button#dropdownMenuLink-topic {
    margin-top: 0px;
}

.clear_div {
    justify-content: end;
}

.custom-page #myTabContent .dropdown ul.dropdown-menu.cust-dropdown.show {
    top: calc(100% - 35px) !important;
    right: 0px !important;
}

.clear_div .dropdown {
    margin-left: 20px;
}

.clear-filter {
    color: #21ccff;
    font-size: 16px;
    padding-left: 13px;
}

/*******06-04-2022*****/
.result-list-table {
    background: #f6f9fd;
    border-radius: 15px;
}

.result-list-table .result-list-head {
    flex: 2;
}

.result-list-head h4 {
    color: #231f20;
    font-size: 16px;
    font-weight: 600;
    flex: 1;
}

.result-list-head p {
    color: #231f20;
    font-size: 15px;
    font-weight: 600;
}

.morning-slot {
    flex: 2;
}

.morning-slot p {
    color: #231f20;
    font-size: 14px;
    font-weight: 600;
}

.result-list-btns {
    flex: 1;
}

.result-list-btns a {
    line-height: 37px;
    height: 48px;
    text-align: center;
    display: block;
    background: #f4f4f4;
    border-radius: 10px;
}

.result-list-btns a .fa {
    font-size: 17px;
    line-height: 48px;
}

.result-review {
    height: 48px;
    background: #f4f4f4;
    border-radius: 10px;
    color: #515151 !important;
    font-size: 16px;
    width: 75%;
}

.score-show {
    flex: 3;
    border-right: 1px solid #b9b9b9;
}

.score-show p {
    color: #231f20;
    font-size: 16px;
    font-weight: 600;
}

.score-show p span {
    color: #00baff;
}

.result-analysis {
    background: #13c5ff;
    background-color: #13c5ff;
    border-color: #13c5ff;
    -webkit-box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    -moz-box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    font-size: 14px;
    font-weight: 600;
    line-height: 32px;
    border-radius: 20px;
    height: 45px;
    width: 208px;
    border: 0;
}

.paper-summery {
    flex: 5;
}

.paper-sub {
    font-size: 13px;
    flex: 1;
    word-break: break-all;
}

.paper-sub span {
    color: #00baff;
    font-size: 14px;
    font-weight: 600;
}

.paper-sub small {
    display: block;
    color: #231f20;
    font-size: 13px;
    font-weight: 600;
}

.result-list-table .slbs-link a {
    font-size: 14px;
    font-weight: 600;
}

@media only screen and (max-width: 1199px) {
    .result-list-head h4 {
        font-size: 14px;
    }

    .result-list-head p {
        font-size: 14px;
        flex: 1;
    }
}

@media only screen and (max-width: 991px) {
    .result-list .d-flex.justify-content-between {
        display: flex !important;
    }

    .result-review {
        font-size: 13px;
    }
    .paper-sub small {
    font-size: 12px;
}
.paper-sub span {
    font-size: 13px;
}
}

</style>