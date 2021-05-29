@extends('afterlogin.layouts.app')

@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12  p-lg-5">
                    <div class="tab-wrapper">
                        <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mathematics</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Physics</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Chemistry</a>
                            </li>
                        </ul>

                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="d-flex px-4 my-5 py-2 align-items-center justify-content-between">
                                    <span class="  mr-3 name-txt">Mathematics I - II</span>
                                    <p class="mb-0 text-danger ms-auto me-4">You can pick topics / sub-topics or</p>
                                    <a href="{{route('subject_exam')}}" class="btn btn-warning rounded-0 px-5 ml-0 ml-md-3 "><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take FULL Test</a>
                                    <button class="btn btn-light rotate-icon ms-2 text-danger rounded-0"><i class="fa fa-sliders" aria-hidden="true"></i></button>
                                </div>
                                <div class="scroll-div">
                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                                        <span class="mr-3 name-txt">Trigonometry</span>

                                        <div class="status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

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
                                                10 %
                                                <!-- <span>/</span>
                                  <span class="total">5</span> -->
                                            </div>
                                        </div>

                                        <span class="slbs-link mx-3"><a aria-controls="test1" data-bs-toggle="collapse" href="#test1" role="button" aria-expanded="false">Expand to Topics</a></span>
                                        <button class="btn btn-green rounded-0 btn-lg ml-0 ml-md-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
                                    </div>
                                    <div class="collapse mb-4" id="test1">
                                        <div class="d-flex px-4">
                                            <button class="btn btn-light rotate-icon ms-auto text-danger rounded-0"><i class="fa fa-sliders" aria-hidden="true"></i></button>
                                        </div>
                                        <section class="slick-slider mb-4">
                                            <div class="p-3">

                                                <div class="bg-light shadow p-3 d-flex flex-column">
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-3 name-txt-sml">Trigonometry</span>

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
                                                                <!-- <span>/</span>
                                          <span class="total">5</span> -->
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
                                                        <a href="#" class="btn btn-light rounded-0 ms-auto px-5">Select </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-3">

                                                <div class="bg-light shadow p-3 d-flex flex-column">
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-3 name-txt-sml">Trigonometry</span>

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
                                                                <!-- <span>/</span>
                                          <span class="total">5</span> -->
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
                                                        <a href="#" class="btn btn-light rounded-0 ms-auto px-5">Select </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-3">

                                                <div class="bg-light shadow p-3 d-flex flex-column">
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-3 name-txt-sml">Trigonometry</span>

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
                                                                5 %
                                                                <!-- <span>/</span>
                                          <span class="total">5</span> -->
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
                                                        <a href="#" class="btn btn-light rounded-0 ms-auto px-5">Select </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-3">

                                                <div class="bg-light shadow p-3 d-flex flex-column">
                                                    <div class="d-flex align-items-center">
                                                        <span class="mr-3 name-txt-sml">Trigonometry</span>

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
                                                                <span>/</span>
                                                                <span class="total">5</span>
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
                                                        <a href="#" class="btn btn-light rounded-0 ms-auto px-5">Select </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                                        <span class="mr-3 name-txt">Trigonometry</span>

                                        <div class="status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

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
                                                <!-- <span>/</span>
                                  <span class="total">5</span> -->
                                            </div>
                                        </div>

                                        <span class="slbs-link mx-3"><a aria-controls="test4" data-bs-toggle="collapse" href="#test4" role="button" aria-expanded="false">Expand to Topics</a></span>
                                        <button class="btn btn-green rounded-0 btn-lg ml-0 ml-md-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
                                    </div>
                                    <div class="collapse" id="test4">
                                        test
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap ">
                                        <span class="mr-3 name-txt">Trigonometry</span>

                                        <div class="status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

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
                                                <!-- <span>/</span>
                                  <span class="total">5</span> -->
                                            </div>
                                        </div>

                                        <span class="slbs-link mx-3"><a aria-controls="test2" data-bs-toggle="collapse" href="#test2" role="button" aria-expanded="false">Expand to Topics</a></span>
                                        <button class="btn btn-green rounded-0 btn-lg ml-0 ml-md-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
                                    </div>
                                    <div class="collapse" id="test2">
                                        test
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap ">
                                        <span class="mr-3 name-txt">Trigonometry</span>

                                        <div class="status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

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
                                                <!-- <span>/</span>
                                  <span class="total">5</span> -->
                                            </div>
                                        </div>

                                        <span class="slbs-link mx-3"><a aria-controls="test3" data-bs-toggle="collapse" href="#test3" role="button" aria-expanded="false">Expand to Topics</a></span>
                                        <button class="btn btn-green rounded-0 btn-lg ml-0 ml-md-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
                                    </div>
                                    <div class="collapse" id="test3">
                                        test
                                    </div>
                                </div>
                                <div class="text-right d-flex align-items-center mt-3">
                                    <a href="#" class="btn px-4 ms-auto me-2 btn-secondary rounded-0">Clear Selection</a>
                                    <button class="btn btn-warning rounded-0 px-5 ml-0 ml-md-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take test for selected topic</button>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('afterlogin.layouts.footer')

<script type="text/javascript">
    $('.scroll-div').slimscroll({
        height: '40vh'
    });

    var starClicked = false;

    $(function() {

        $('.star').click(function() {

            $(this).children('.selected').addClass('is-animated');
            $(this).children('.selected').addClass('pulse');

            var target = this;

            setTimeout(function() {
                $(target).children('.selected').removeClass('is-animated');
                $(target).children('.selected').removeClass('pulse');
            }, 1000);

            starClicked = true;
        })

        $('.half').click(function() {
            if (starClicked == true) {
                setHalfStarState(this)
            }
            $(this).closest('.rating').find('.js-score').text($(this).data('value'));

            $(this).closest('.rating').data('vote', $(this).data('value'));
            calculateAverage()
            console.log(parseInt($(this).data('value')));

        })

        $('.full').click(function() {
            if (starClicked == true) {
                setFullStarState(this)
            }
            $(this).closest('.rating').find('.js-score').text($(this).data('value'));

            $(this).find('js-average').text(parseInt($(this).data('value')));

            $(this).closest('.rating').data('vote', $(this).data('value'));
            calculateAverage()

            console.log(parseInt($(this).data('value')));
        })

        $('.half').hover(function() {
            if (starClicked == false) {
                setHalfStarState(this)
            }

        })

        $('.full').hover(function() {
            if (starClicked == false) {
                setFullStarState(this)
            }
        })

    })

    function updateStarState(target) {
        $(target).parent().prevAll().addClass('animate');
        $(target).parent().prevAll().children().addClass('star-colour');

        $(target).parent().nextAll().removeClass('animate');
        $(target).parent().nextAll().children().removeClass('star-colour');
    }

    function setHalfStarState(target) {
        $(target).addClass('star-colour');
        $(target).siblings('.full').removeClass('star-colour');
        updateStarState(target)
    }

    function setFullStarState(target) {
        $(target).addClass('star-colour');
        $(target).parent().addClass('animate');
        $(target).siblings('.half').addClass('star-colour');

        updateStarState(target)
    }

    function calculateAverage() {
        var average = 0

        $('.rating').each(function() {
            average += $(this).data('vote')
        })

        $('.js-average').text((average / $('.rating').length).toFixed(3))
    }

    $('.slick-slider').slick({
        slidesToScroll: 1,
        dots: false,
        centerMode: false,
        focusOnSelect: false,
        infinite: true,
        slidesToShow: 3,
        variableWidth: false,
        prevArrow: false,
        nextArrow: false
    });

    $('.slbs-link a').click(function() {

        $('.slick-slider').slick('refresh');
    })
</script>

@endsection