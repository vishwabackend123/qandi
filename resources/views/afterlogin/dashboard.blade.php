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

    <div class="content-wrapper">
        <div class="container-fluid pt-0">

            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="bg-white shadow-lg py-5">
                        <div class="prgress-i-txt px-3 mb-1">
                            <span class="progress_text">Progress</span>
                            <!--  <span class="i-sms">!</span> -->
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-sm-12 col-md-8">
                                <div class="d-flex justify-content-center flex-column h-100 ">
                                    <div class="" id="scorecontainer"></div>

                                    <ul class="live-test mt-1">
                                        <li>
                                            <span class="last-live-test"></span>Last Test Score
                                        </li>
                                        <li>
                                            <span class="pre-test"></span>Previous Test
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 p-0 text-center seeAnico">
                                <span class="text-center"><img src="{{URL::asset('public/after_login/new_ui/images/right-circle-img.png')}}" alt="see analytics" title="See Analytics"></span>
                                <div class="button-sec  mt-3"><a href="{{route('overall_analytics')}}" title="See Analytics">See Analytics</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="bg-white shadow-lg py-5 ps-3 pe-1">
                        <!-- <h5 class="dashboard-title mb-5">Subject Performance</h5> -->
                        <div class="prgress-i-txt px-0">
                            <span class="progress_text">Subject Proficiency</span>
                            <!--                                 <span class="i-sms">!</span> -->
                        </div>
                        <div class="subject-scroll">
                            <ul class="course-star pe-2">
                                @if(!empty($subjectData))
                                @foreach($subjectData as $key=>$sub)
                                <li>
                                    <strong>{{$sub['subject_name']}}</strong>
                                    <span class="star-img">
                                        <div class="star-ratings-css ">
                                            <div class="star-ratings-css-top" style="width: {{round($sub['score'])}}%">
                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                            </div>
                                            <div class="star-ratings-css-bottom">
                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                            </div>
                                        </div>

                                    </span>
                                    <span>{{round($sub['score'])}}%</span>


                                </li>
                                @endforeach
                                @endif

                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="bg-white shadow-lg py-5 peragraph prgress-i-txt" style="overflow:hidden;">
                        <div class="prgress-i-txt px-3">
                            <span class="progress_text">Weekly Marks Trends</span>
                            <!-- <span class="i-sms">!</span> -->
                        </div>
                        <!-- <div id="trend_line_graph"></div> -->
                        <div id="marks_trend_graph"></div>
                        <!-- <h5 class="dashboard-title pb-4 px-3">Weekly Marks Trends</h5> -->
                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/right-graph.jpg')}}" class="img-fluid w-100 img-responsive"> -->
                    </div>
                </div>
            </div>
            <!--row-->

            <div class="cust-gallery">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @if(isset($prof_asst_test) && $prof_asst_test=='N')
                        <div class="swiper-slide bg-white AttmnowSec">
                            <div class="row">
                                <div class="col-lg-12 px-0">
                                    <p>Complete full body scan to</p>
                                    <h3>Unlock Daily Test</h3>
                                    <p>& complete platform features</p>
                                    <!-- <div> <span><img src="{{URL::asset('public/after_login/new_ui/images/star1.jpg')}}"></span> <span class="ms-1 score score-rating js-score">0%
                                        </span></div> -->
                                </div>
                            </div>
                            <div class="sign-btn">
                                <a href="{{route('exam','full_exam')}}"><button type="submit" class="btn btn-primary active-btn text-uppercase">
                                        <img src="{{URL::asset('public/after_login/new_ui/images/right-white.png')}}">attempt now!</button></a>

                            </div>
                        </div>
                        @endif


                        <div class="swiper-slide bg-white go2Planner">
                            <span>Weekly Plan</span>

                            <div class="test-attend text-center pt-2 pb-2">
                                <p>Tests Attempted</p>
                                <div class="ms-auto">
                                    @if(isset($planner) && !empty($planner))
                                    @foreach($planner as $key=>$val)
                                    @if($val->test_completed_yn=="Y")
                                    <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle text-success" aria-hidden="true"></i></a>
                                    @else
                                    <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle" aria-hidden="true"></i></a>

                                    @endif
                                    @endforeach
                                    @endif
                                </div>

                                <button class="custom-btn-gray mt-4" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/new_ui/images/planer.png')}}" alt="icon not find">Go To
                                    Planner</button>
                                <!--<label class="custom-checkbox"><input type="checkbox"><span class="checkmark"></span></label>-->
                            </div>

                        </div>
                        @if(isset($planner) && !empty($planner))

                        @foreach($planner as $key=>$val)
                        @if($val->test_completed_yn=="N")
                        <div class="swiper-slide bg-white">
                            <div class="row">
                                <div class="col-lg-12 px-0">
                                    <p>Level up in</p>
                                    <h3 class="chapter_name" title="{{$val->chapter_name}}">{{$val->chapter_name}}</h3>
                                    <!-- <div> <span><img src="{{URL::asset('public/after_login/new_ui/images/star1.jpg')}}"></span> <span class="ms-1 score score-rating js-score">0%
                                        </span></div> -->
                                </div>
                            </div>
                            <div class="sign-btn">
                                <!-- <form action="{{route('planner_exam',[$val->id,$val->chapter_id])}}" method="post"> -->
                                <form method="post" action="{{route('plannerExam',[$val->id])}}">
                                    @csrf
                                    <input type="hidden" name="chapter_name" value="{{$val->chapter_name}}">
                                    <input type="hidden" name="subject_id" value="{{$val->subject_id}}">
                                    <input type="hidden" name="chapter_id" value="{{$val->chapter_id}}">
                                    <input type="hidden" name="exam_id" value="{{$val->exam_id}}">
                                    <button type="submit" class="btn btn-primary active-btn text-uppercase">
                                        <img src="{{URL::asset('public/after_login/new_ui/images/right-white.png')}}">attempt now!</button>

                                    <!--  <a href="{{route('planner_exam',[$val->id,$val->chapter_id])}}"><button type="submit" class="btn btn-primary active-btn text-uppercase">
                                            <img src="{{URL::asset('public/after_login/new_ui/images/right-white.png')}}">attempt now!</button>
                                    </a> -->
                                </form>
                            </div>
                        </div>
                        @elseif($val->test_completed_yn=="Y")
                        <div class="swiper-slide bg-white testcompltd">
                            <div class="test-attend text-center pt-2 pb-2">
                                <p>Tests Attempted</p>
                                <div class="ms-auto">
                                    <h3><span class="text-secondary me-2 chapter_name"><i class="fas fa-check-circle text-success" aria-hidden="true"></i></span>{{$val->chapter_name}}</h3>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
                <!--swiper mySwiper-->


            </div>


        </div>
    </div>
</div>

<!-- Modal -->
@if($subjects_rating == null || empty($subjects_rating))
<div class="modal fade" id="welcomeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body pt-0 text-center">

                <p class="wl-user-title">Hello {{!empty($userData->user_name)?ucwords($userData->user_name):'Guest'}}!</p>
                <h3 class=" wel-msg">Welcome to the <span class="text-danger">Game</span></h3>

                @if(isset($subjects_rating) && empty($subjects_rating))
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5 fw-bold" onclick="welcome_back();">Let’s get you started ></a>
                @else
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5 fw-bold" onclick="welcome_back();">Let’s go ></a>
                @endif
                <!-- <a href="#" class="btn mb-4 btn-sm rounded-0 mt-4 btn-danger px-5" data-bs-toggle="modal" data-bs-target="#favSubResponse" data-bs-dismiss="modal">Let’s get you started ></a> -->
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="favSubResponse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body p-4 pt-0 text-center">

                <p class="rating-headline mt-5 mb-4"> How much do you like each of these subjects?</p>

                <div class="row">

                    @if(isset($aSubjects) && !empty($aSubjects))
                    @foreach($aSubjects as $sub)
                    <div class="col-md-12">
                        <div class="rating block">
                            <span class="lbl-text">{{$sub->subject_name}}</span>
                            <div class="rating-wrapper">
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="5" id="{{$sub->subject_name}}_5">
                                <label class="rating-heart" for="{{$sub->subject_name}}_5"><i class="fa fa-star"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="4" id="{{$sub->subject_name}}_4">
                                <label class="rating-heart" for="{{$sub->subject_name}}_4"><i class="fa fa-star"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="3" id="{{$sub->subject_name}}_3">
                                <label class="rating-heart" for="{{$sub->subject_name}}_3"><i class="fa fa-star"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="2" id="{{$sub->subject_name}}_2">
                                <label class="rating-heart" for="{{$sub->subject_name}}_2"><i class="fa fa-star"></i></label>
                                <input class="rating-input" type="radio" name="{{$sub->id}}" value="1" id="{{$sub->subject_name}}_1">
                                <label class="rating-heart" for="{{$sub->subject_name}}_1"><i class="fa fa-star"></i></label>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    @endif

                    <div class="d-flex align-items-center mt-5">

                        <a href="#" class="btn rating-next-btn disabled  rounded-0 ms-auto px-4" id="nxt-btn" onclick="store_rating();">Next&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endif

<!-- Modal -->

<!-- Full exam popup -->
@if(isset($prof_asst_test) && $prof_asst_test=='N')
<div class="modal fade" id="fullTest_Dashboard" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-modal="true" role="dialog" style="display: none; padding-left: 0px;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header pb-0 border-0">

                <!--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body pt-0 text-center">
                <p id="h1--P" class="h1-p text-success text-uppercase">Just one more step!</p>
                <p>Take a full body scan test to analyse and plan your preparation journey</p>
                <a id="full-txtBlock" href="{{route('exam','full_exam')}}" class="full-txtblock justify-content-center d-flex align-items-center mb-4 mt-5 mx-5 py-4">
                    <i class="fa-li fa fa-check" aria-hidden="true"></i>
                    <span class="text-white ms-4 ">Take full body scan of<br>75 questions test</span>
                </a>
                <a href="#" class="btn mb-4 btn-sm rounded-0 mt-5 btn-light text-danger px-4 skip-dashboard" data-bs-toggle="modal" data-bs-dismiss="modal">Skip to Dashboard &gt;</a>
            </div>

        </div>
    </div>
</div>
@endif
<!-- End full exam popup -->



<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->
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
    $(window).on('load', function() {
        if ($("#welcomeModal").length > 0) {
            $('#welcomeModal').modal('show');
        }

    });

    $(".rating-input").click(function() {
        $("#nxt-btn").removeClass("disabled");
    });
    /* $('.subject_scroll').slimscroll({
        height: '25vh'
    }); */

    function welcome_back() {
        $('#welcomeModal').modal('hide');

        if ($("#favSubResponse").length > 0) {
            $("#favSubResponse").modal("show");
        } else if ($("#fullTest_Dashboard").length > 0) {
            $("#fullTest_Dashboard").modal("show");
        }
    }

    function store_rating() {
        /* getting subject rating for new user */
        let subjects_rating = {};
        $('input[type=radio]:checked').each(function() {


            var name = $(this).attr('name');
            var value = $(this).val();

            subjects_rating[name] = value;
        });
        /*  console.log(subjects_rating);
         var existing = JSON.parse(localStorage.getItem("store_data") || '[]');
         console.log(existing);
         existing['subjects_rating'] = subjects_rating;
         console.log(existing['subjects_rating']);
         localStorage.setItem('store_data', JSON.stringify(existing));

         var storeddata = JSON.parse(localStorage.getItem("store_data"));

         console.log(storeddata); */
        $.ajax({
            url: "{{ url('/dailyWelcomeUpdates') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                storeddata: subjects_rating,
            },
            beforeSend: function() {},
            success: function(response_data) { //debugger;

                if (response_data == 'success') {
                    if ($("#favSubResponse").length > 0) {
                        $("#favSubResponse").modal("hide");
                    }

                    /*  $("#feelresponseModal").modal("hide"); */
                    if ($("#fullTest_Dashboard").length > 0) {
                        $("#fullTest_Dashboard").modal("show");
                    }
                }

            },
            error: function(xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });
    }

    $('.instructions').slimscroll({
        height: '33vh'
    });

    $(".rating-input").click(function() {
        $("#nxt-btn").removeClass("disabled");
    });
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

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            1920: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            1028: { // this is all desktop view of my laptop
                slidesPerView: 3,
                spaceBetween: 30
            },
            300: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });
</script>

<script>
    /* Score Pie Chart */
    Highcharts.chart('scorecontainer', {
        chart: {
            height: 130,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            spacingTop: 0,
            spacingBottom: 0,
            spacingRight: 0,
        },
        title: {
            text: '<span style=" font: normal normal 200 48px/60px Manrope; letter-spacing: 0px; color: #21ccff;">{{$corrent_score_per}}</span> <br><span style=" font: normal normal normal 14px/22px Manrope;letter-spacing: 0px;color: #21ccff;"> / 100 </span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
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
                    distance: 0,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                point: {
                    events: {
                        legendItemClick: function() {
                            this.slice(null);
                            return false;
                        }
                    }
                },
                startAngle: -140,
                endAngle: 140,
                center: ['50%', '50%'],
                size: '100%'
            }
        },
        series: [{
            type: 'pie',

            innerSize: '85%',
            data: [{
                    name: 'Score',
                    y: <?php echo $score; ?>,
                    color: '#21ccff'
                },
                {
                    name: 'Inprogress',
                    y: <?php echo $inprogress; ?>,
                    color: '#d0f3ff'
                },
                {
                    name: 'Progress',
                    y: <?php echo $progress; ?>,
                    color: '#d0f3ff'
                },
                {
                    name: '',
                    y: <?php echo $others; ?>,
                    color: '#e4e4e4'
                }


            ]

        }]
    });

    /* Mrks trend Graph */
    Highcharts.chart('marks_trend_graph', {
        chart: {
            type: 'areaspline',
            height: 180,
            plotBackgroundColor: null,
            zoomType: 'x',
            marginLeft: -10,
            marginRight: -10,
            spacingLeft: 0,
            spacingRight: 0
        },
        title: {
            text: ''
        },

        legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom',
            bottom: '-20px',
            floating: false,
            borderWidth: 0,

        },
        xAxis: {
            label: true,
            accessibility: {
                rangeDescription: 'Range: start to current week'
            },
            categories: <?php echo $weeks_json; ?>,

        },
        yAxis: {
            title: {
                text: null
            },
            labels: {
                enabled: true
            },

            min: 0
        },
        tooltip: {
            shared: true,
            valueSuffix: ' marks'
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.4
            },
            series: {
                marker: {
                    enabled: true
                },
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }

            }

        },
        series: [{
            name: 'Student Score',
            data: <?php echo $stu_scroe_json; ?>, //[0, 4, 4],
            color: '#007aff' // Jane's color
        }, {
            name: 'Class Avg',
            data: <?php echo $avg_scroe_json; ?>, //[16, 18, 17],
            color: '#dfe835'
        }, {
            name: 'Top Marks',
            data: <?php echo $max_scroe_json; ?>, // [16, 21, 23],
            color: '#eb4034'
        }],


    });
    /* Mrks trend Graph */
</script>
@endsection