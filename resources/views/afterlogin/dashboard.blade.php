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
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block" id="alert">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-5">
                    <div class="bg-white shadow-lg ">
                        <div class="row">
                            <div class="col-8 pe-0">
                                <div class="d-flex justify-content-center flex-column h-100  position-relative">
                                    <a href="javascript:;" class="fa fa-info-circle fa-1x text-light ms-auto mt-2 position-absolute top-0 end-0" data-bs-toggle="popover" data-bs-content="And here's some amazing content. It's very engaging. Right?"></a>
                                    <!-- <span class=" p-3"><img src="{{URL::asset('public/after_login/images/left-graph.jpg')}}"></span> -->
                                    <div id="scorecontainer" class="text-right"></div>
                                    <span class=" bg-light p-3 d-flex  justify-content-center flex-column graph-bottom-block">
                                        <span class="abri"> <span class="abrv-mean bg1"></span>Last Mock Test Score</span>
                                        <span class="abri"> <span class="abrv-mean bg2"></span>Progress From Previous Score</span>
                                        <span class="abri"> <span class="abrv-mean bg3"></span>Next Mock Test Target</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-4  ">
                                <div class="d-flex flex-column h-100 montain-bg inactive-mountain">
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
                        <div class="d-flex ">
                            <h5 class="dashboard-title mb-3">Subject proficiency</h5>
                            <a href="javascript:;" class="fa fa-info-circle fa-1x text-light ms-auto" data-bs-toggle="popover" data-bs-content="And here's some amazing content. It's very engaging. Right?"></a>
                        </div>
                        @if(!empty($subjectData))
                        @foreach($subjectData as $key=>$sub)
                        <div class="anlytics_wrapper d-flex align-items-center justify-content-between  py-2 mb-3 dashboard-listing-details w-100 ">
                            <span class="mr-3 dashboard-name-txt">{{$sub['subject_name']}}</span>

                            <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                                <div class="star-ratings-css">
                                    <div class="star-ratings-css-top" style="width: {{round($sub['score'])}}%">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <div class="star-ratings-css-bottom">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                </div>

                                <div class="ms-2 score score-rating js-score">
                                    {{round($sub['score'])}} %
                                    <!-- <span>/</span>
                              <span class="total">5</span> -->
                                </div>
                            </div>
                            <div class="tooltip"><a href="{{route('overall_analytics')}}">See Analytics </a></div>
                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white shadow-lg p-3">
                        <h5 class="dashboard-title">Marks Trend</h5>
                        <figure class="highcharts-figure">
                            <div id="trend_graph"></div>

                        </figure>
                        <!-- <img src="{{URL::asset('public/after_login/images/graph.jpg')}}" class="img-fluid w-100" style="height: 219px;"> -->
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-3">
                <div class="col-6">
                    <span class="text-danger">This week Tests</span>
                    <!-- <a href="{{route('exam','full_exam')}}"><span class="text-danger">Take full body scan of 90 questions test </span></a> -->
                    <span><i class="fa fa-info-circle fa-1x text-light" data-bs-toggle="popover" data-bs-content="And here's some amazing content. It's very engaging. Right?"></i></span>
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
            <div class='swipe' id="plan_slider">
                <ul id='slider'>
                    <li class="gray prfile">
                        <div class="col swipLi">
                            <small class="TestLevel text-danger fs-5 mb-3">Level up</small>
                            <h3>One Last Step!</h3>
                            <p class="TestTitle text-danger fs-5">Unlock analytics and more</p>

                            <div class="checkBody fs-3">
                                <input class="inputCheck" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Take a test and get a complete analysis of your preparation!
                                </label>
                            </div>
                            <div class="btnBody">
                                <a href="{{route('exam','full_exam')}}" class="text-uppercase goto-exam-btn p-2 w-100 text-center"><i class="fas fa-link"></i> Attempt Now!</a>
                            </div>

                        </div>
                    </li>



                </ul>
            </div>
            <br />
            <div id="pagenavi"></div>
            <!--             <div class="row">
                <div class="col-12">
                    <section id="planner_div" class="slick-slider mb-4">
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
                                <small class="text-danger fs-5$.ajax({ url: " database/update.html", context: document.body, success: function(){ alert("done"); }}); mb-3">Level up</small>
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
            </div> -->
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

                <p class="wl-user-title">Hello {{Auth::user()->user_name}},</p>
                <h3 class=" wel-msg">Welcome to the <span class="text-danger">Game</span></h3>

                @if(isset($subjects_rating) && empty($subjects_rating))
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5 fw-bold" data-bs-toggle="modal" data-bs-target="#favSubResponse" data-bs-dismiss="modal">Let’s get you started ></a>
                @else
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5 fw-bold" onclick="store_rating();">Let’s go ></a>
                @endif
                <!-- <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5" data-bs-toggle="modal" data-bs-target="#favSubResponse" data-bs-dismiss="modal">Let’s get you started ></a> -->
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

                <p class="h1-p"> {{Auth::user()->user_name}},</p>
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

                <p class="h2-p mt-5 mb-4"> How would you rate these subjects according to your liking?</p>

                @if(isset($aSubjects) && !empty($aSubjects))
                @foreach($aSubjects as $sub)
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="rating block">
                            <span class="lbl-text">{{$sub->subject_name}}</span>
                            <div class="rating-wrapper">
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="5" id="{{$sub->subject_name}}_5">
                                <label class="rating-heart" for="{{$sub->subject_name}}_5"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="4" id="{{$sub->subject_name}}_4">
                                <label class="rating-heart" for="{{$sub->subject_name}}_4"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="3" id="{{$sub->subject_name}}_3">
                                <label class="rating-heart" for="{{$sub->subject_name}}_3"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="2" id="{{$sub->subject_name}}_2">
                                <label class="rating-heart" for="{{$sub->subject_name}}_2"><i class="fa fa-heart"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="1" id="{{$sub->subject_name}}_1">
                                <label class="rating-heart" for="{{$sub->subject_name}}_1"><i class="fa fa-heart"></i></label>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

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
                <!--  <p class="welcome-icons text-center mt-5">
                    <img src="{{URL::asset('public/after_login/images/happy.png')}}">
                    <img src="{{URL::asset('public/after_login/images/party.png')}}">

                </p> -->
                <p class="h1-p text-success text-uppercase">Just one more step!</p>
                <p>Take a test and get a complete analysis of your preparation!</p>
                <a href="{{route('exam','full_exam')}}" class="full-txtblock justify-content-center d-flex align-items-center mb-4 mt-5 mx-5 px-5 py-4">
                    <span> <img src="{{URL::asset('public/after_login/images/books.png')}}"> </span>
                    <span class="text-white ms-4 ">Take full body scan of<br>XX questions test</span>
                </a>
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-5 btn-light text-danger px-4 skip-dashboard" data-bs-toggle="modal" data-bs-dismiss="modal">Skip to Dashboard ></a>
            </div>

        </div>
    </div>
</div>


@include('afterlogin.layouts.footer')
@php
$trend_stu_scroe=$trend_avg_scroe=$trend_max_scroe=$aWeeks = [];
$i = 1;
if (!empty($trendResponse)) {
foreach ($trendResponse as $key => $trend) {
$week = "W" . $i;
array_push($aWeeks, $week);
array_push($trend_stu_scroe, $trend['student_score']);
array_push($trend_avg_scroe, $trend['average_score']);
array_push($trend_max_scroe, $trend['max_score']);

$i++;
}

}else{
array_push($trend_stu_scroe, 0);
array_push($trend_avg_scroe, 0);
array_push($trend_max_scroe, 0);
}

$weeks_json = isset($aWeeks) ? json_encode($aWeeks) : [];
$stu_scroe_json = isset($trend_stu_scroe) ? json_encode($trend_stu_scroe) : [];
$avg_scroe_json = isset($trend_avg_scroe) ? json_encode($trend_avg_scroe) : [];
$max_scroe_json = isset($trend_max_scroe) ? json_encode($trend_max_scroe) : [];

@endphp
<script type="text/javascript">
    console = window.console || {
        dir: new Function(),
        log: new Function()
    };
    var active = 0,
        as = document.getElementById('pagenavi').getElementsByTagName('a');
    for (var i = 0; i < as.length; i++) {
        (function() {
            var j = i;
            as[i].onclick = function() {
                t4.slide(j);
                return false;
            }
        })();
    }
    var t1 = new TouchSlider('slider', {
        duration: 800,
        interval: 3000,
        direction: 0,
        autoplay: false,
        align: 'left',
        mousewheel: false,
        mouse: true,
        fullsize: false
    });
    t4.on('before', function(m, n) {
        as[m].className = '';
        as[n].className = 'active';
    })
</script>

<!--end slider -->
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            url: "{{ url('/weekly_exams') }}",
            type: 'GET',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response_data) { //debugger;

                console.log(response_data);
                $(' #plan_slider').html(response_data);
            },
        });
    });
    $(window).on('load', function() {
        /* $('#welcomeModal').modal('show'); */

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

                if (response_data == 'success') {
                    $("#favSubResponse").modal("hide");
                    $("#feelresponseModal").modal("hide");
                    $("#fullTest_Dashboard").modal("show");
                }

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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script>
    Highcharts.chart('scorecontainer', {
        chart: {
            height: 150,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            spacingTop: 0,
            spacingBottom: 0,
            spacingRight: 0,
        },
        title: {
            text: '<span style="font-size:40px">{{$corrent_score_per}}</span> <br><span style="font-size:20px"> / 100 </span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 30,
            x: -110
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                startAngle: -120,
                endAngle: 120,
                center: ['20%', '50%'],
                size: '100%'
            }
        },
        series: [{
            type: 'pie',

            innerSize: '85%',
            data: [{
                    name: 'Score',
                    y: <?php echo $score; ?>,
                    color: '#ffdc34' // Jane's color
                },
                {
                    name: 'Inprogress',
                    y: <?php echo $inprogress; ?>,
                    color: '#fc2f00c7' // Jane's color
                },
                {
                    name: 'Progress',
                    y: <?php echo $progress; ?>,
                    color: '#ffa81d' // Jane's color
                },
                {
                    name: 'Others',
                    y: <?php echo $others; ?>,
                    color: '#e4e4e4' // Jane's color
                }


            ]

        }]
    });
</script>


<script>
    Highcharts.chart('trend_graph', {
        chart: {
            height: 215,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            spacingTop: 10,
            spacingBottom: 0,
            spacingRight: 0,
        },
        title: {
            text: ''
        },

        subtitle: {
            text: ''
        },

        yAxis: {
            title: {
                text: ''
            }
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },

        xAxis: {
            accessibility: {
                rangeDescription: 'Range: start to current week'
            },
            categories: <?php echo $weeks_json; ?>
        },


        series: [{
            name: 'Student Score',
            data: <?php echo $stu_scroe_json; ?>, //[0, 4, 4],
            color: '#7edd62' // Jane's color
        }, {
            name: 'Class Avg',
            data: <?php echo $avg_scroe_json; ?>, //[16, 18, 17],
            color: '#ffdc34'
        }, {
            name: 'Top Marks',
            data: <?php echo $max_scroe_json; ?>, // [16, 21, 23],
            color: '#7cb5ed'
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        enabled: false,
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });

    setTimeout(() => {
        $('#alert').hide();
    }, 5000);
</script>
@endsection