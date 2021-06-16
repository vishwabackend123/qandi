@extends('afterlogin.layouts.app')

@section('content')
<style>
    .anlytics_wrapper {

        -webkit-transform: translateZ(0);
        /* webkit flicker fix */
        -webkit-font-smoothing: antialiased;
        /* webkit text rendering fix */
    }

    .anlytics_wrapper .tooltip {
        background: #ececec;
        border-radius: 4px;
        font-size: 16px;
        bottom: 100%;
        color: #fff;
        display: block;
        right: 0px;
        margin-bottom: 5px;
        opacity: 0;
        padding: 10px 15px;
        pointer-events: none;
        position: absolute;

        -webkit-transform: translateY(10px);
        -moz-transform: translateY(10px);
        -ms-transform: translateY(10px);
        -o-transform: translateY(10px);
        transform: translateY(10px);
        -webkit-transition: all .25s ease-out;
        -moz-transition: all .25s ease-out;
        -ms-transition: all .25s ease-out;
        -o-transition: all .25s ease-out;
        transition: all .25s ease-out;
        -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
        -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
        -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
        -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
        box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    }

    .anlytics_wrapper .tooltip a {
        color: red;
    }

    /* This bridges the gap so you can mouse into the tooltip without it disappearing */
    .anlytics_wrapper .tooltip:before {
        bottom: -20px;
        content: " ";
        display: block;
        height: 20px;
        left: 0;
        position: absolute;
        width: 100%;
    }

    /* CSS Triangles - see Trevor's post */


    .anlytics_wrapper:hover .tooltip {
        opacity: 1;
        pointer-events: auto;
        -webkit-transform: translateY(0px);
        -moz-transform: translateY(0px);
        -ms-transform: translateY(0px);
        -o-transform: translateY(0px);
        transform: translateY(0px);
    }

    /* IE can just show/hide with no transition */
    .lte8 .anlytics_wrapper .tooltip {
        display: none;
    }

    .lte8 .anlytics_wrapper:hover .tooltip {
        display: block;
    }
</style>
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper">
        <!-- dashboard html section-->

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-5">
                    <div class="bg-white shadow-lg ">
                        <div class="row">
                            <div class="col-8">
                                <div class="d-flex justify-content-center flex-column h-100 ">
                                    <span class=" p-3"><img src="{{URL::asset('public/after_login/images/left-graph.jpg')}}"></span>
                                    <span class="mt-auto bg-light p-3 d-flex  justify-content-center flex-column">
                                        <span class="abri"> <span class="abrv-mean bg1"></span>Last Mock Test Score</span>
                                        <span class="abri"> <span class="abrv-mean bg2"></span>Progress from previous score</span>
                                        <span class="abri"> <span class="abrv-mean bg3"></span>Next Mock Test Target</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-4  montain-bg inactive-mountain">
                                <div class="d-flex flex-column h-100">
                                    <span></span>
                                    <span class="mt-auto mb-4  d-flex justify-content-center align-items-center  montain-txt">
                                        <span class="plus-sign">+</span>
                                        <small>Set target to<br> Reach next</small>
                                    </span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="bg-white shadow-lg p-3">
                        <h5 class="dashboard-title mb-3">Subject proficiency</h5>
                        <div class="anlytics_wrapper d-flex align-items-center justify-content-between  py-2 mb-4 dashboard-listing-details w-100 ">
                            <span class="mr-3 dashboard-name-txt">Mathematics</span>

                            <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

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
                            <div class="tooltip"><a href="{{route('overall_analytics')}}">See Analytics </a></div>
                        </div>
                        <div class="anlytics_wrapper d-flex align-items-center justify-content-between  py-2 mb-4 dashboard-listing-details w-100 ">
                            <span class="mr-3 dashboard-name-txt">Physics</span>

                            <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

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
                            <div class="tooltip"><a href="{{route('overall_analytics')}}">See Analytics </a></div>
                        </div>
                        <div class="anlytics_wrapper d-flex align-items-center justify-content-between  pt-2 mb-2 dashboard-listing-details w-100 ">
                            <span class="mr-3 dashboard-name-txt">Chemistry</span>

                            <div class="status-id  ms-auto d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

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

                            <div class="tooltip"><a href="{{route('overall_analytics')}}">See Analytics </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white shadow-lg p-3">
                        <h5 class="dashboard-title">Marks Trend</h5>
                        <img src="{{URL::asset('public/after_login/images/graph.jpg')}}" class="img-fluid w-100" style="height: 219px;">
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-3">
                <div class="col-6">
                    <a href="{{route('subject_exam')}}"><span class="text-danger">Take full body scan of 90 questions test </span></a>
                    <span><i class="fa fa-info-circle text-secondary"></i></span>
                </div>
                <div class="col-6 text-right d-flex">
                    <div class="ms-auto">
                        <a href="#" class="text-secondary"><i class="fas fa-check-circle"></i></a>
                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle"></i></a>
                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle"></i></a>
                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle"></i></a>
                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <section class="slick-slider mb-4">
                        <div class=" ">

                            <div class="bg-light shadow p-3 d-flex flex-column">
                                <small class="text-danger fs-5 mb-3">Level up</small>
                                <h3>One Last Step!</h3>
                                <p class="text-danger fs-5">Unlock analytics and more</p>

                                <div class="form-check my-4">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Take a test and get a complete analysis of your preparation!
                                    </label>
                                </div>
                                <a href="{{route('exam','full_exam')}}" class="btn btn-danger w-100 rounded-0 mt-3"><i class="fas fa-link"></i> Attempt Now!</a>
                            </div>
                        </div>
                        <div class=" ">

                            <div class="bg-light shadow p-3 d-flex flex-column inactive-block">
                                <small class="text-danger fs-5 mb-3">Level up</small>
                                <h3>One Last Step!</h3>
                                <p class="text-danger fs-5">Unlock analytics and more</p>

                                <div class="form-check my-4">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Take a test and get a complete analysis of your preparation!
                                    </label>
                                </div>
                                <button class="btn btn-danger w-100 rounded-0 mt-3"><i class="fas fa-link"></i> Attempt Now!</button>
                            </div>
                        </div>


                    </section>
                </div>
            </div>
        </div>
    </div>

</div>
<!--End dashboard html section-->

<!-- Modal -->
<div class="modal fade" id="welcomeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 text-center">

                <p class="h1-p">Hello {{Auth::user()->first_name}},</p>
                <h3 class=" wel-msg">Welcome to the <span class="text-danger">Game</span></h3>
                <p class="welcome-icons mt-4">
                    <img src="{{URL::asset('public/after_login/images/icon1.png')}}">
                    <img src="{{URL::asset('public/after_login/images/icon2.png')}}">
                    <img src="{{URL::asset('public/after_login/images/icon3.png')}}">
                    <img src="{{URL::asset('public/after_login/images/icon4.png')}}">
                    <img src="{{URL::asset('public/after_login/images/icon5.png')}}">
                    <img src="{{URL::asset('public/after_login/images/icon6.png')}}">
                    <img src="{{URL::asset('public/after_login/images/icon7.png')}}">
                    <img src="{{URL::asset('public/after_login/images/icon8.png')}}">
                    <img src="{{URL::asset('public/after_login/images/icon9.png')}}">
                </p>
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5" data-bs-toggle="modal" data-bs-target="#feelModal" data-bs-dismiss="modal">Let’s get you started ></a>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="feelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 text-center">

                <p class="h1-p"> {{Auth::user()->first_name}},</p>
                <p>Tell us how are you feeling today?</p>
                <p class="welcome-icons mt-5">
                    <a href="#" onclick="save_feelings(1)" class="emoji-block"><img src="{{URL::asset('public/after_login/images/smily1.png')}}"> <span>SAD</span></a>
                    <a href="#" onclick="save_feelings(2)" class="emoji-block"><img src="{{URL::asset('public/after_login/images/smily2.png')}}"><span>MEH</span></a>
                    <a href="#" onclick="save_feelings(3)" class="emoji-block"><img src="{{URL::asset('public/after_login/images/smily3.png')}}"><span>NON</span></a>
                    <a href="#" onclick="save_feelings(4)" class="emoji-block"><img src="{{URL::asset('public/after_login/images/smily4.png')}}"><span>Happy</span></a>
                    <a href="#" onclick="save_feelings(5)" class="emoji-block"><img src="{{URL::asset('public/after_login/images/smily5.png')}}"><span>PARTY</span></a>
                    {{--
                        <a href="#" onclick="save_feelings(5)" class="emoji-block" data-bs-toggle="modal" data-bs-target="#feelresponseModal" data-bs-dismiss="modal"><img src="{{URL::asset('public/after_login/images/smily5.png')}}"><span>PARTY</span></a>
                    --}}
                </p>

            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="feelresponseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 text-center">

                <p class="h2-p"> Perfect!</p>
                <p>Let’s have a quick overview to plan ahead!!</p>
                <p class="welcome-icons mt-5">
                    <img src="{{URL::asset('public/after_login/images/hand.png')}}">
                </p>
                @if(isset($subjects_rating) && empty($subjects_rating))
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5" data-bs-toggle="modal" data-bs-target="#favSubResponse" data-bs-dismiss="modal">Let’s go ></a>
                @else
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5" onclick="store_rating();">Let’s go ></a>
                @endif
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="favSubResponse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 text-center">
                <p class="welcome-icons mt-5">
                    <img src="{{URL::asset('public/after_login/images/love.png')}}">
                    <img src="{{URL::asset('public/after_login/images/book.png')}}">

                </p>
                <p class="h2-p mt-5 mb-4"> How would you rate these subjects according to your liking?</p>

                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="rating block">
                            <span class="lbl-text">MAthamatics</span>
                            <div class="rating-wrapper">
                                <input class="rating-input" type="radio" name="1" value="5" id="product_5">
                                <label class="rating-heart" for="product_5"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="1" value="4" id="product_4">
                                <label class="rating-heart" for="product_4"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="1" value="3" id="product_3">
                                <label class="rating-heart" for="product_3"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="1" value="2" id="product_2">
                                <label class="rating-heart" for="product_2"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="1" value="1" id="product_1">
                                <label class="rating-heart" for="product_1"><i class="fa fa-heart"></i></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="rating block">
                            <span class="lbl-text">Physics</span>
                            <div class="rating-wrapper">
                                <input class="rating-input" type="radio" name="2" value="5" id="product_6">
                                <label class="rating-heart" for="product_6"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="2" value="4" id="product_7">
                                <label class="rating-heart" for="product_7"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="2" value="3" id="product_8">
                                <label class="rating-heart" for="product_8"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="2" value="2" id="product_9">
                                <label class="rating-heart" for="product_9"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="2" value="1" id="product_10">
                                <label class="rating-heart" for="product_10"><i class="fa fa-heart"></i></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="rating block">
                            <span class="lbl-text">Chemistry</span>
                            <div class="rating-wrapper">
                                <input class="rating-input" type="radio" name="3" value="5" id="product_11">
                                <label class="rating-heart" for="product_11"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="3" value="4" id="product_12">
                                <label class="rating-heart" for="product_12"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="3" value="3" id="product_13">
                                <label class="rating-heart" for="product_13"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="3" value="2" id="product_14">
                                <label class="rating-heart" for="product_14"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="3" value="1" id="product_15">
                                <label class="rating-heart" for="product_15"><i class="fa fa-heart"></i></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-5">
                    <a href="#" class="btn btn-secondary rounded-0 px-4">
                        < Back</a>
                            <a href="#" class="btn btn-danger disabled  rounded-0 ms-auto px-4" id="nxt-btn" onclick="store_rating();">Next ></a>

                            {{--
                                    <a href="#" class="btn btn-danger disabled  rounded-0 ms-auto px-4" data-bs-toggle="modal" data-bs-target="#fullTest_Dashboard" data-bs-dismiss="modal" id="nxt-btn" onclick="store_rating();">Next ></a>
                                --}}
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="fullTest_Dashboard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 text-center">
                <p class="welcome-icons text-center mt-5">
                    <img src="{{URL::asset('public/after_login/images/happy.png')}}">
                    <img src="{{URL::asset('public/after_login/images/party.png')}}">

                </p>
                <p class="h1-p text-success">Just one more step!</p>
                <p>Take a test and get a complete analysis of your preparation!</p>
                <a href="{{route('exam','full_exam')}}" class="full-txtblock justify-content-center d-flex align-items-center mb-4 mt-5 mx-5 p-5">
                    <span> <img src="{{URL::asset('public/after_login/images/books.png')}}"> </span>
                    <span class="text-white ms-4 ">Take full body scan of<br> 90 questions test</span>

                </a>
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-5 btn-light text-danger px-5" data-bs-toggle="modal" data-bs-dismiss="modal">Skip to Dashboard ></a>
            </div>

        </div>
    </div>
</div>


@include('afterlogin.layouts.footer')

<script type="text/javascript">
    $(window).on('load', function() {
        /* $('#welcomeModal').modal('show') */

        if (sessionStorage.getItem('firstVisit') != '1') {
            $('#welcomeModal').modal('show');
        }
        sessionStorage.setItem('firstVisit', '1');
    });

    $(".rating-input").click(function() {
        $("#nxt-btn").removeClass("disabled");
    });

    function save_feelings(feel) {

        // Store
        var welcomeData = {
            'today_feeling': feel
        };
        //Add the text 'item1' to nameArr
        localStorage.setItem('store_data', JSON.stringify(welcomeData));


        $("#feelModal").modal("hide");
        $("#feelresponseModal").modal("show");
    }

    function store_rating() {
        /* getting subject rating for new user */
        let subjects_rating = {};
        $('input[type=radio]:checked').each(function() {

            var name = $(this).attr('name');
            var value = $(this).val();
            subjects_rating[name] = value;
        });


        var existing = JSON.parse(localStorage.getItem("store_data") || '[]');

        existing['subjects_rating'] = subjects_rating;

        localStorage.setItem('store_data', JSON.stringify(existing));

        var storeddata = JSON.parse(localStorage.getItem("store_data"));


        $.ajax({
            url: "{{ url('/dailyWelcomeUpdates') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                storeddata: storeddata,
            },
            beforeSend: function() {},
            success: function(response_data) { //debugger;

                $("#favSubResponse").modal("hide");
                $("#feelresponseModal").modal("hide");
                $("#fullTest_Dashboard").modal("show");

            },
            error: function(xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });
    }
</script>
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
        slidesToShow: 2,
        variableWidth: false,
        prevArrow: false,
        nextArrow: false
    });

    $('.slbs-link a').click(function() {

        $('.slick-slider').slick('refresh');
    })
</script>
@endsection