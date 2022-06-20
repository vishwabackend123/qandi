@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper dashboard">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper matrixpage-wrapper dashboard-cards-block matrix-page-wrapper">
        <div class="container-fluid custom-page" style="padding-bottom: 30px;">
            <div class="row">
                <div class="col-lg-3">
                    <div class="bg-white shadow-lg py-5 myqMatrix-card  mb-lg-0 mb-4">
                        <span class="progress_text" style="padding-left: 15px;">MyQ Matrix</span>
                        <small>
                            <!-- <i class="fa  fa-info"></i> -->
                            <img style="width:18px;" src="{{URL::asset('public/after_login/new_ui/images/tooltip-icon.png')}}">
                            <p class="tooltipclass">
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                <label>About MyQ Matrix</label>
                                A matrix created to analyse your attempts in various topics over time and sort them into your areas of strengths and weaknesses. <br /> This data will keep on changing as you progress and diligently work on your identified and analysed weaknesses and strengths. It will also make visible those topics that can become your strength with a little more effort on your part. Align your preparation now!
                            </p>
                        </small>
                        <div class="topicBlocks mt-3">
                            <div class="topics-box">
                                <b>Q2</b>
                                <a href="javascript:void(0);"><span>
                                        @if(isset($myq_matrix[1]))
                                        <b>{{ str_pad($myq_matrix[1], 2, '0', STR_PAD_LEFT);}}</b>
                                        @else
                                        <b>00</b>
                                        @endif
                                        <small>Topic</small>
                                    </span>
                                </a>
                            </div>
                            <div class="topics-box">
                                <a href="javascript:void(0);"><span>
                                        @if(isset($myq_matrix[0]))
                                        <b>{{ str_pad($myq_matrix[0], 2, '0', STR_PAD_LEFT);}}</b>
                                        @else
                                        <b>00</b>
                                        @endif
                                        <small>Topic</small>
                                    </span></a>
                                <b class="mgq">Q1</b>
                            </div>
                            <div class="topics-box">
                                <b>Q3</b>
                                <a href="javascript:void(0);"><span>
                                        @if(isset($myq_matrix[2]))
                                        <b>{{ str_pad($myq_matrix[2], 2, '0', STR_PAD_LEFT);}}</b>
                                        @else
                                        <b>00</b>
                                        @endif
                                        <small>Topic</small>
                                    </span></a>
                            </div>
                            <div class="topics-box">
                                <a href="javascript:void(0);"><span>
                                        @if(isset($myq_matrix[3]))
                                        <b>{{ str_pad($myq_matrix[3], 2, '0', STR_PAD_LEFT);}}</b>
                                        @else
                                        <b>00</b>
                                        @endif
                                        <small>Topic</small>
                                    </span></a>
                                <b class="mgq">Q4</b>
                            </div>
                        </div>
                        <ul class=" mt-5 mb-0 matrixLists" style="padding-left: 10px;">
                            <li><b>Q1</b> Your topics of strength. Keep revising to stay on top.</li>
                            <li><b>Q2</b> Convert into strengths with focussed practice </li>
                            <li><b>Q3</b> Weakness which can be converted to strength with consistent efforts</li>
                            <li class="m-0"><b>Q4</b> Your weakness. Need considerable efforts to convert to strengths </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-wrapper">
                        <div>
                            <div class="position-relative">
                                <ul class="nav nav-tabs cust-tabs w-100 mytab" id="myTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="matrix-quesone-tab" data-bs-toggle="tab" href="#matrix-quesone" role="tab" aria-controls="matrix-quesone" aria-selected="true">Q1
                                        <span class="circleL"></span>
                                        <span class="circleR"></span>
                                        <span class="squareL"></span>
                                        <span class="squareR"></span>
                                    </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="matrix-questwo-tab" data-bs-toggle="tab" href="#matrix-questwo" role="tab" aria-controls="matrix-questwo" aria-selected="false">Q2
                                        <span class="circleL"></span>
                                        <span class="circleR"></span>
                                        <span class="squareL"></span>
                                        <span class="squareR"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="matrix-questhree-tab" data-bs-toggle="tab" href="#matrix-questhree" role="tab" aria-controls="matrix-questhree" aria-selected="false">Q3
                                        <span class="circleL"></span>
                                        <span class="circleR"></span>
                                        <span class="squareL"></span>
                                        <span class="squareR"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="matrix-quesfour-tab" data-bs-toggle="tab" href="#matrix-quesfour" role="tab" aria-controls="matrix-quesfour" aria-selected="false">Q4
                                        <span class="circleL"></span>
                                        <span class="circleR"></span>
                                        <span class="squareL"></span>
                                        <span class="squareR"></span>
                                        </a>
                                    </li>
                                </ul>
                                <a href="{{url('/dashboard')}}" class="backto-dash">BACK TO DASHBOARD</a>
                            </div>
                        </div>
                        <div class="tab-content cust-tab-content" id="myTabContents">
                            <div class="tab-pane  active" id="matrix-quesone" role="tabpanel" aria-labelledby="matrix-quesone-tab">
                                <div class="tabcontent-wrapper">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="mb-4">
                                            <ul class="chapter-topic-menu ulStyle d-inline-flex">
                                                <!--li><a href="javascript:void(0)" >CHAPTERS</a></li-->
                                                <li><a href="javascript:void(0)" class="active">TOPICS</a></li>
                                            </ul>
                                            <span class="filtericon d-none"><i class="fa fa-filter"></i></span>
                                        </div>
                                        <!--button class="btn btntheme mb-4">POLISH STRENGTHS</button-->
                                    </div>
                                    <div class="chapter-topic-block">
                                        @if(isset($myq_matrix_topic['Q1']) && $myq_matrix_topic['Q1'])
                                        <ul class="chapter-topic-lists ulStyle">
                                            @foreach($myq_matrix_topic['Q1'] as $matrix_one)
                                            <li class="mb-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>{{$matrix_one['topic_name']}}
                                                                <input type="radio" name="radio">
                                                                <!--span class="checkmark"></span-->
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top" style="width:{{$matrix_one['proficiency']}}%">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                                <span> {{number_format($matrix_one['proficiency'], 0)}}%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p class="text-center">
                                            <strong>No record found</strong>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="matrix-questwo" role="tabpanel" aria-labelledby="matrix-questwo-tab">
                                <div class="tabcontent-wrapper">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="mb-4">
                                            <ul class="chapter-topic-menu ulStyle d-inline-flex">
                                                <!--li><a href="javascript:void(0)" >CHAPTERS</a></li-->
                                                <li><a href="javascript:void(0)" class="active">TOPICS</a></li>
                                            </ul>
                                            <span class="filtericon d-none"><i class="fa fa-filter"></i></span>
                                        </div>
                                        <!--button class="btn btntheme mb-4">POLISH STRENGTHS</button-->
                                    </div>
                                    <div class="chapter-topic-block">
                                        @if(isset($myq_matrix_topic['Q2']) && $myq_matrix_topic['Q2'])
                                        <ul class="chapter-topic-lists ulStyle">
                                            @foreach($myq_matrix_topic['Q2'] as $matrix_one)
                                            <li class="mb-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>{{$matrix_one['topic_name']}}
                                                                <input type="radio" name="radio">
                                                                <!--span class="checkmark"></span-->
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top" style="width:{{$matrix_one['proficiency']}}%">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                                <span>{{number_format($matrix_one['proficiency'], 0)}}%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p class="text-center">
                                            <strong>No record found</strong>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="matrix-questhree" role="tabpanel" aria-labelledby="matrix-questhree-tab">
                                <div class="tabcontent-wrapper">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="mb-4">
                                            <ul class="chapter-topic-menu ulStyle d-inline-flex">
                                                <!--li><a href="javascript:void(0)" >CHAPTERS</a></li-->
                                                <li><a href="javascript:void(0)" class="active">TOPICS</a></li>
                                            </ul>
                                            <span class="filtericon d-none"><i class="fa fa-filter"></i></span>
                                        </div>
                                        <!--button class="btn btntheme mb-4">POLISH STRENGTHS</button-->
                                    </div>
                                    <div class="chapter-topic-block">
                                        @if(isset($myq_matrix_topic['Q3']) && $myq_matrix_topic['Q3'])
                                        <ul class="chapter-topic-lists ulStyle">
                                            @foreach($myq_matrix_topic['Q3'] as $matrix_one)
                                            <li class="mb-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>{{$matrix_one['topic_name']}}
                                                                <input type="radio" name="radio">
                                                                <!--span class="checkmark"></span-->
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top" style="width:{{$matrix_one['proficiency']}}%">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                                <span>{{number_format($matrix_one['proficiency'], 0)}}%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p class="text-center">
                                            <strong>No record found</strong>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="matrix-quesfour" role="tabpanel" aria-labelledby="matrix-quesfour-tab">
                                <div class="tabcontent-wrapper">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="mb-4">
                                            <ul class="chapter-topic-menu ulStyle d-inline-flex">
                                                <!--li><a href="javascript:void(0)" >CHAPTERS</a></li-->
                                                <li><a href="javascript:void(0)" class="active">TOPICS</a></li>
                                            </ul>
                                            <span class="filtericon d-none"><i class="fa fa-filter"></i></span>
                                        </div>
                                        <!--button class="btn btntheme mb-4">POLISH STRENGTHS</button-->
                                    </div>
                                    <div class="chapter-topic-block">
                                        @if(isset($myq_matrix_topic['Q4']) && $myq_matrix_topic['Q4'])
                                        <ul class="chapter-topic-lists ulStyle">
                                            @foreach($myq_matrix_topic['Q4'] as $matrix_one)
                                            <li class="mb-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>{{$matrix_one['topic_name']}}
                                                                <input type="radio" name="radio">
                                                                <!--span class="checkmark"></span-->
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top" style="width:{{$matrix_one['proficiency']}}%">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                                <span>{{number_format($matrix_one['proficiency'], 0)}}%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p class="text-center">
                                            <strong>No record found</strong>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--------- Modal ------>
<div class="modal fade" id="matrix" data-bs-backdrop="static" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <!-- <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
            </div> -->
            <div class="modal-body text-center">
                <p>Give more tests for this <br /> section to be populated</p>
                <div class="text-center mb-4">
                    <a href="{{url('/dashboard')}}" class="btn btn-danger px-5"> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-------------------->
<script>
$(document).ready(function() {
    $('.filtericon').hide();
    // $(".dashboard-cards-block .bg-white>small>img").click(function() {
    //     $(".dashboard-cards-block .bg-white>small p>span").each(function() {
    //         $(this).parent("p").hide();
    //     })
    //     $(this).siblings("p").show();
    // });
    // $(".dashboard-cards-block .bg-white>small p>span").click(function() {
    //     $(this).parent("p").hide();
    // });
    $(".dashboard-cards-block .bg-white>small>img").click(function(event) {
        event.stopPropagation();
        $(".dashboard-cards-block .bg-white>small p>span").each(function() {
            $(this).parent("p").hide();
            $(this).parent("p").removeClass('show');
        });
        $(this).siblings("p").show();
        $(this).siblings("p").addClass('show');

    });
    $(".dashboard-cards-block .bg-white>small p>span").click(function() {
        $(this).parent("p").hide();
    });
    $(document).on('click', function(e) {
        var card_opened = $('.tooltipclass').hasClass('show');
        if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
            $('.tooltipclass').hide();
        }
    });
    var topic_data = '<?php echo $myq_bool; ?>';
    if (topic_data) {
        setInterval(function() {
            $('#matrix').modal('show');
        }, 1000);
    }


});

</script>
<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->
@endsection

<style>
    .mytab .nav-link.active:before,  .mytab .nav-link.active:after{
        display:none !important;
    }
    .mytab .nav-link{
        padding-left:0px !important;
    }
    a#matrix-questwo-tab {
        padding-left:0px !important;    padding-right: 0px !important;
}
.cust-tabs .nav-link.active {
    /* color: #231f20; */
    color: #2c3348;
    background-color: #fff !important;
    border-color: transparent;
    border-radius: 0;
    font-weight: 600;
    padding-right: 20px;
    padding-left: 20px;
    border-top-left-radius: 30px !important;
    border-top-right-radius: 30px !important;
    position: relative;
}

.cust-tabs .nav-link.active .circleL{
    width: 20px;
    height: 20px;
    -webkit-border-radius: 10px;
    -moz-border-radius:    10px;
    border-radius:         10px;
    background: #f6f9fd;
    z-index: 2;
    position: absolute;
    left: -21px;
    bottom: 0px;
    cursor: default;
}
.cust-tabs .nav-link.active .circleR {
    width: 20px; 
  height: 20px;
  -webkit-border-radius: 10px;
  -moz-border-radius:    10px;
  border-radius:         10px;
  background: #f6f9fd;
  z-index: 2;
  position: absolute;
  right: -21px;
    bottom: 0px;
}
.cust-tabs .nav-link.active .squareL {
    background:#fff;
  width: 10px;
  height: 10px;
  z-index: 1;
  position: absolute;
  left: -11px;
    bottom: -1px;
}
.cust-tabs .nav-link.active .squareR{
    background: #fff;
    width: 10px;
    height: 10px;
    z-index: 1;
    position: absolute;
    right: -11px;
    bottom: -1px;
}

.cust-tabs  .nav-item , .cust-tabs .nav-link{
    z-index: 999999999;
}
ul#myTabs {
    padding-left: 2px !important;
}    
    </style>