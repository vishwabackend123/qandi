@extends('afterlogin.layouts.app')

@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper">
        <!-- dashboard html section-->

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
                        <h3 class="wel-msg">Welcome to the <span class="text-danger">Game</span></h3>
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
                        <a href="index.html" class="full-txtblock justify-content-center d-flex align-items-center mb-4 mt-5 mx-5 p-5">
                            <span> <img src="{{URL::asset('public/after_login/images/books.png')}}"> </span>
                            <span class="text-white ms-4 ">Take full body scan of<br> 90 questions test</span>

                        </a>
                        <a href="#" class="btn mb-4 btn-sm rounded-0 mt-5 btn-light text-danger px-5" data-bs-toggle="modal" data-bs-dismiss="modal">Skip to Dashboard ></a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal Test_Instruction-->
        <div class="modal fade" id="Test_Instruction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content rounded-0">
                    <div class="modal-header pb-0 border-0">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-3 p-6">
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="text-danger text-uppercase">Mock Test - III</h1>
                                <div class="scroll">
                                    <div class="test-info">
                                        <div class="row justify-content-md-center">
                                            <div class="col col-lg-4 d-flex flex-column align-items-center">
                                                <div>
                                                    <small>No. Of Questions</small>
                                                    <span class="d-block inst-text"><span class="text-danger">90 MCQ</span> Questions</span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-4 d-flex flex-column align-items-center">
                                                <div>
                                                    <small>Target</small>
                                                    <span class="d-block inst-text"><span class="text-danger">Wave Theory</span></span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-4 d-flex flex-column align-items-center">
                                                <div>
                                                    <small>Duration</small>
                                                    <span class="d-block inst-text"><span class="text-danger">180</span> Minutes</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <p class="inst mb-5">Please Read Carefully for any query before starting the test. Thank you.</p>
                                    <div class="instructions">
                                        <h3>Instructions</h3>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et</p>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et</p>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ps-lg-5 d-flex align-items-center justify-content-center flex-column">

                                <h1 class="my-auto">All the Best! Anuj </h1>
                                <div class="text-left   ">

                                    <button class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">GO FOR IT <i class="fas fa-arrow-right"></i></button>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
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

        console.log(storeddata);
        /* $("#favSubResponse").modal("hide");
                    $("#feelresponseModal").modal("hide");
                    $("#fullTest_Dashboard").modal("hide"); */

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
@endsection