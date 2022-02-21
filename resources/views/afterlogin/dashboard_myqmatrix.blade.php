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
    <div class="content-wrapper matrixpage-wrapper dashboard-cards-block">
        <div class="container-fluid custom-page">  
            <div class="row">
                <div class="col-md-3">
                    <div class="bg-white shadow-lg py-5 myqMatrix-card h-auto">
                        <span class="progress_text" style="padding-left: 15px;">MyQ Matrix</span>
                        <small>
                            <i class="fa  fa-info"></i>
                            <p>
                                <span><img style="width:34px;" src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></span>
                                <label>About MyQ Matrix</label>
                                A matrix created to analyse your attempts in various topics over time and sort them into your areas of strengths and weaknesses. <br /><br /> This data will keep on changing as you progress and diligently work on your identified and analysed weaknesses and strengths. It will also make visible those topics that can become your strength with a little more effort on your part. Align your preparation now!
                            </p>
                        </small>
                        <div class="topicBlocks mt-3">
                            <div class="topics-box">
                                <b>Q2</b>
                                <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                        <b>00</b>
                                        <small>Topic</small>
                                    </span>
                                </a>
                            </div>
                            <div class="topics-box">

                                <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                        <b>00</b>
                                        <small>Topic</small>
                                    </span></a>
                                <b style="margin:0 0 0 6px">Q1</b>
                            </div>
                            <div class="topics-box">
                                <b>Q3</b>
                                <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                        <b>00</b>
                                        <small>Topic</small>
                                    </span></a>
                            </div>
                            <div class="topics-box">
                                <a href="{{route('dashboard-MyQMatrix')}}"><span>
                                        <b>00</b>
                                        <small>Topic</small>
                                    </span></a>
                                <b style="margin:0 0 0 6px">Q4</b>
                            </div>
                        </div>
                        <ul class=" mt-5 mb-0 matrixLists" style="padding-left: 10px;">
                            <li><b>Q1</b> Your strength topics. Keep revising to stay on top.</li>
                            <li><b>Q2</b> Convert into strengths with focussed practice </li>
                            <li><b>Q3</b> Weakness which can be converted to strength with consistent efforts</li>
                            <li class="m-0"><b>Q4</b> Your weakness. Need considerable efforts to convert to strengths </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-wrapper">
                        <div>
                            <div class="position-relative">
                                <ul class="nav nav-tabs cust-tabs w-100" id="myTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="matrix-quesone-tab" data-bs-toggle="tab" href="#matrix-quesone" role="tab" aria-controls="matrix-quesone" aria-selected="true">Q1</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="matrix-questwo-tab" data-bs-toggle="tab" href="#matrix-questwo" role="tab" aria-controls="matrix-questwo" aria-selected="false">Q2</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="matrix-questhree-tab" data-bs-toggle="tab" href="#matrix-questhree" role="tab" aria-controls="matrix-questhree" aria-selected="false">Q3</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="matrix-quesfour-tab" data-bs-toggle="tab" href="#matrix-quesfour" role="tab" aria-controls="matrix-quesfour" aria-selected="false">Q4</a>
                                    </li>
                                </ul>
                                <a href="javascript:void(0)" class="backto-dash">BACK TO DASHBOARD</a>
                            </div>
                        </div>
                        <div class="tab-content cust-tab-content" id="myTabContents">
                            <div class="tab-pane  active" id="matrix-quesone" role="tabpanel" aria-labelledby="matrix-quesone-tab">
                                <div class="tabcontent-wrapper">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mb-4">
                                            <ul class="chapter-topic-menu ulStyle d-inline-flex">
                                                <li><a href="javascript:void(0)" class="active">CHAPTERS</a></li>
                                                <li><a href="javascript:void(0)">TOPICS</a></li>
                                            </ul>
                                            <span class="filtericon"><i class="fa fa-filter"></i></span>
                                        </div>
                                        <button class="btn btntheme mb-4">POLISH STRENGHTS</button>
                                    </div>
                                    <div class="chapter-topic-block">
                                        <ul class="chapter-topic-lists ulStyle">
                                            <li class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>Chemistry Equilibrium
                                                                <input type="radio" name="radio">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>

                                                                </span>
                                                                <span>90%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>Complex Numbers
                                                                <input type="radio" name="radio">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>

                                                                </span>
                                                                <span>80%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>Electromagnetic Inductions
                                                                <input type="radio" name="radio">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>

                                                                </span>
                                                                <span>60%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>Chemistry in  Everyday life
                                                                <input type="radio" name="radio">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>

                                                                </span>
                                                                <span>80%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="cus-radio-btn">
                                                            <label>Biomolecules
                                                                <input type="radio" name="radio">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <ul class="course-star pe-2 d-block" style="text-align: right;">
                                                            <li class="m-0">
                                                                <strong>Proficiency</strong>
                                                                <span class="star-img w-auto">
                                                                    <div class="star-ratings-css ">
                                                                        <div class="star-ratings-css-top">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                        <div class="star-ratings-css-bottom">
                                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                                        </div>
                                                                    </div>

                                                                </span>
                                                                <span>40%</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="matrix-questwo" role="tabpanel" aria-labelledby="matrix-questwo-tab">
                                
                            </div>
                            <div class="tab-pane" id="matrix-questhree" role="tabpanel" aria-labelledby="matrix-questhree-tab">
                                
                            </div>
                            <div class="tab-pane" id="matrix-quesfour" role="tabpanel" aria-labelledby="matrix-quesfour-tab">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<!--------- Modal ------>
<div class="modal fade" id="matrix">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <!-- <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
            </div> -->
            <div class="modal-body text-center">
                <p>Give more tests for this <br /> section to be populated</p>
                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-danger px-5" data-bs-dismiss="modal"> Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-------------------->

<script>
    $(window).on('load', function() {
        $('#matrix').modal('show');
    });
    $(document).ready(function() {
        $(".dashboard-cards-block .bg-white>small i").click(function() {
            $(this).siblings("p").show();
        });
        $(".dashboard-cards-block .bg-white>small p>span").click(function() {
            $(this).parent("p").hide();
        });
    });
</script>


<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->

@endsection