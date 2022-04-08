@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
<style>
    .topic_selected {
   background-color: #5bc3ff !important;
   color: #ffffff !important;
   }
</style>
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper">
        <div class="container-fluid custom-page">
            <div class="row">
                <div class="col-lg-12  p-lg-5 pt-none">
                    <div class="result-list bg-white tab-wrapper">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link all_div active" id="Mathematics-tab" data-bs-toggle="tab" href="#attempted" role="tab" aria-controls="attempted" aria-selected="true">Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <!--scroll-mobile-->
                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="attempted" role="tabpanel" aria-labelledby="attempted-tab">
                                <div class="scroll-div mt-4" id="chapter_list_1">
                                  @foreach($result_data as $sche)
                                    <div class="compLeteS" id="chapter_box_{{$sche->id}}">
                                        <div class="ClickBack d-flex align-items-center justify-content-between bg-white  px-3 py-2 mb-2 listing-details w-100 flex-wrap result-list-table">
                                            <div class="d-flex align-items-center justify-content-between result-list-head">
                                                <h4 class="m-lg-0 p-0">@if($sche->test_series_name)
                                                  {{$sche->test_series_name}}
                                                  @elseif($sche->live_exam_name)
                                                  {{$sche->live_exam_name}}
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
                                                    <a class="expand-custom expandTopicCollapse" aria-controls="chapter_{{$sche->id}}" data-bs-toggle="collapse" href="#chapter_{{$sche->id}}" role="button" aria-expanded="true" value="Expand to Topics"  id="clicktopic_{{$sche->id}}"><span id="expand_topic_{{$sche->id}}">Hide Details</span></a></span>
                                            </div>
                                            <div class="result-list-btns">
                                                <a href="{{route('exam_review',$sche->id)}}" class="btn result-review w-100">Review Exam</a>
                                            </div>
                                        </div>
                                        <div class="mb-4 collapse" id="chapter_{{$sche->id}}">
                                            <div class="p-3 pb-4 d-flex justify-content-between full-syllabus">
                                                <div class="score-show text-center">
                                                    <p class="p-0 mb-3">Score:<span>{{$sche->marks_gain}}</span>/{{$sche->no_of_question * 4}}</p>
                                                    <a href="{{route('get_exam_result_analytics',$sche->id)}}" class="btn result-analysis text-uppercase boder-0 text-white"><i class="fa fa-line-chart" aria-hidden="true"></i> &nbsp;See Analyics</a>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('afterlogin.layouts.footer_new')
<script type="text/javascript">
$('a.expandTopicCollapse span').click(function() {
    var spanId = this.id;
    var curr_text = $("#" + spanId).text();
    var updatetext = ((curr_text == 'Show Details') ? 'Hide Details' : 'Show Details');
    $("#" + spanId).text(updatetext);
});
$(window).on('load', function() {
    $(".dash-nav-link a:first-child").removeClass("active-navlink");
    $(".dash-nav-link a:nth-child(2)").addClass("active-navlink");
});
</script>
<script>
$("body").on("click", ".expandTopicCollapse", function(event) {
    $(this).parents('.ClickBack').toggleClass('newelement');
});

</script>
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
    width: 57px;
    height: 48px;
    text-align: center;
    display: block;
    background: #f4f4f4;
    border-radius: 10px;
    color: #515151;
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
    color: #fff;
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
        font-size: 15px;
        flex: 1;
        margin-right: 20px;
        margin-bottom: 0;
    }

    .result-list-head p {
        font-size: 15px;
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
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
@endsection
