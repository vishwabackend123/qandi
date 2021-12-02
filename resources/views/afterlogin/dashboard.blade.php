<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UNIQ</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!--  <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>

@php
$userData = Session::get('user_data');

@endphp
<style>
    .star-ratings-css {
        unicode-bidi: bidi-override;
        color: #c5c5c5;
        font-size: 22px;
        margin: 0 auto;
        position: relative;
        padding: 0;
        /* text-shadow: 0px 1px 0 #a2a2a2; */
    }

    .star-ratings-css-top {
        color: #ffdc34;
        padding: 0;
        position: absolute;
        z-index: 1;
        display: block;
        top: 0;
        left: 0;
        overflow: hidden;
    }

    .star-ratings-css-bottom {
        padding: 0;
        display: block;
        z-index: 0;
    }
</style>

<body class="login-body-bg" id="main-body">
    <div class="dash-sidebar">
        <div class="sidbar-block">
            <a href="#"><img src="{{URL::asset('public/after_login/new_ui/images/inner-logo.png')}}" </a>
        </div>
        <div class="dash-nav-link   d-flex flex-column">
            <a href="{{ url('/dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="71" viewBox="0 0 120 71">
                    <defs>
                        <style>
                            .a {
                                fill: #00baff;
                            }

                            .b,
                            .h {
                                fill: none;
                            }

                            .b,
                            .c {
                                stroke: #fff;
                                stroke-width: 1.5px;
                                opacity: 1;
                            }

                            .c {
                                fill: #d71922;
                            }

                            .d {
                                opacity: 0;
                            }

                            .e {
                                fill: #f2f2f2;
                            }

                            .f {
                                fill: #231f20;
                                font-size: 14px;
                                font-family: Poppins-Light, Poppins;
                                font-weight: 300;
                            }

                            .g {
                                stroke: none;
                            }

                            .i {
                                filter: url(#a);
                            }
                        </style>
                        <filter id="a" x="0" y="0" width="120" height="43" filterUnits="userSpaceOnUse">
                            <feOffset dy="3" input="SourceAlpha" />
                            <feGaussianBlur stdDeviation="3" result="b" />
                            <feFlood flood-opacity="0.161" />
                            <feComposite operator="in" in2="b" />
                            <feComposite in="SourceGraphic" />
                        </filter>
                    </defs>
                    <g transform="translate(9 6)">
                        <rect class="a" width="48" height="48" rx="8" transform="translate(0 17)" />
                        <g transform="translate(1 18)">
                            <g transform="translate(11 11)">
                                <g class="b" transform="translate(0)">
                                    <rect class="g" width="10" height="10" rx="3" />
                                    <rect class="h" x="0.75" y="0.75" width="8.5" height="8.5" rx="2.25" />
                                </g>
                                <g class="b" transform="translate(0 14)">
                                    <rect class="g" width="10" height="10" rx="3" />
                                    <rect class="h" x="0.75" y="0.75" width="8.5" height="8.5" rx="2.25" />
                                </g>
                                <g class="b" transform="translate(14)">
                                    <rect class="g" width="10" height="10" rx="3" />
                                    <rect class="h" x="0.75" y="0.75" width="8.5" height="8.5" rx="2.25" />
                                </g>
                                <g class="b" transform="translate(14 14)">
                                    <rect class="g" width="10" height="10" rx="3" />
                                    <rect class="h" x="0.75" y="0.75" width="8.5" height="8.5" rx="2.25" />
                                </g>
                                <g class="c" transform="translate(10 10)">
                                    <circle class="g" cx="2" cy="2" r="2" />
                                    <circle class="h" cx="2" cy="2" r="1.25" />
                                </g>
                            </g>
                        </g>
                        <g class="d" transform="translate(0 -3)">
                            <g class="i" transform="matrix(1, 0, 0, 1, -9, -3)">
                                <rect class="e" width="102" height="25" transform="translate(9 6)" />
                            </g><text class="f" transform="translate(12 21)">
                                <tspan x="0" y="0">Dashboard</tspan>
                            </text>
                        </g>
                    </g>
                </svg>
            </a>
            <a data-bs-toggle="collapse" href="#submenu" role="button" aria-expanded="false" aria-controls="collapseExample">
                <img src="{{URL::asset('public/after_login/new_ui/images/left-icon-2.svg')}}">
            </a>
            <a data-bs-toggle="collapse" href="#submenupreparation" id="submenupreparationlink">
                <img src="{{URL::asset('public/after_login/new_ui/images/left-icon-3.svg')}}">
            </a>

        </div>
        <div class="submenu-L1 collapse width" id="submenu">
            <div class="mt-5 mb-5 pb-5 pt-5"></div>
            <div class=" d-flex  flex-column h-100 mt-5 pt-4   text-start sublinks">
                <a class="nav-link" data-bs-toggle="collapse" href="#submenu2" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Practice</a>
                <a href="{{route('adaptive_mock_exam')}}" class="nav-link"><i class="far fa-edit"></i> Exam</a>
                <a href="{{route('live_exam_list')}}" class="nav-link"><i class="fas fa-external-link-alt"></i> Live</a>
            </div>

        </div>
        <div class="submenu-L2 collapse width" id="submenu2">
            <div class="mt-5 mb-5 pb-5 pt-5"></div>
            <div class=" d-flex  flex-column h-100 mt-5 pt-4   text-start sublinks">
                <a href="{{ url('/exam_custom') }}" class="nav-link"><i class="fas fa-sliders-h rotate-icon"></i> Custom</a>

                <a href="{{ url('/series_list') }}" class="nav-link"><i class="fas fa-book-open"></i> Test Series</a>
            </div>

        </div>
        <div class="submenu-L1 collapse width" id="submenupreparation">
            <div class="mt-5 mb-5 pb-5 pt-5"></div>
            <div class=" d-flex  flex-column h-100 mt-5 pt-4   text-start sublinks">

                <a href="{{route('preparation_center')}}" class="nav-link"><i class="far fa-edit"></i> Preparation Center</a>
                <a href="{{route('refund_form')}}" class="nav-link"><i class="far fa-edit"></i> Refund Form</a>

            </div>

        </div>
    </div>
    <div class="main-wrapper">
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 ms-auto text-end">
                        <div class="user-name-block d-flex align-items-center flex-row-reverse">
                            <a href='#'><span class="user-pic-block"><img src="{{URL::asset('public/after_login/new_ui/images/DSC_0004.png')}}" class="user-pic"></span></a>
                            <span class="user-name-block ps-3 pe-3">Welcome, Sakshi J</span>
                            <span class="notification me-5 ms-4"><a href=""><img src="{{URL::asset('public/after_login/new_ui/images/bell.png')}}"></a></span>
                            <span class="notification ms-4"><a data-bs-toggle="collapse" href='#' role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/new_ui/images/calender.png')}}"></a></span>
                            <span class="notification ms-4"><a href="{{route('overall_analytics')}}"><img src="{{URL::asset('public/after_login/new_ui/images/Group1831.png')}}"></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-wrapper">
            <div class="container-fluid pt-0">

                <div class="row">
                    <div class="col-xl-5 col-lg-8 col-md-8 col-sm-12">
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
                                                <span class="last-live-test"></span>Last Live Test Score
                                            </li>
                                            <li>
                                                <span class="pre-test"></span>Previous Test
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 p-0 text-center seeAnico">
                                    <span class="text-center"><img src="{{URL::asset('public/after_login/new_ui/images/right-circle-img.jpg')}}" alt="image not find"></span>
                                    <div class="button-sec  mt-3"><a href="{{route('overall_analytics')}}">See Analytics</a></div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12">
                        <div class="bg-white shadow-lg py-5 px-3">
                            <!-- <h5 class="dashboard-title mb-5">Subject Performance</h5> -->
                            <div class="prgress-i-txt px-0">
                                <span class="progress_text">Subject Proficiency</span>
                                <!--                                 <span class="i-sms">!</span> -->
                            </div>
                            <ul class="course-star">
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
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
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
                            <div class="swiper-slide bg-white">
                                <div class="row">
                                    <div class="col-lg-12 px-0">
                                        <p>Complete full body scan to</p>
                                        <h3>Unlock Daily Test</h3>
                                        <p>& complete plateform features</p>
                                        <div> <span><img src="{{URL::asset('public/after_login/new_ui/images/star1.jpg')}}"></span> <span class="ms-1 score score-rating js-score">0%
                                            </span></div>
                                    </div>
                                </div>
                                <div class="sign-btn">
                                    <button type="submit" class="btn btn-primary active-btn text-uppercase">
                                        <img src="{{URL::asset('public/after_login/new_ui/images/right-white.png')}}">attempt now!</button>

                                </div>
                            </div>
                            @endif

                            @if(isset($planner) && !empty($planner))
                            <div class="swiper-slide bg-white">

                                <div class="test-attend text-center pt-2 pb-2">
                                    <p>Tests Attempted</p>
                                    <div class="ms-auto">
                                        <a href="#" class="text-secondary"><i class="fas fa-check-circle" aria-hidden="true"></i></a>
                                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle" aria-hidden="true"></i></a>
                                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle" aria-hidden="true"></i></a>
                                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle" aria-hidden="true"></i></a>
                                        <a href="#" class="text-secondary ms-2"><i class="fas fa-check-circle" aria-hidden="true"></i></a>
                                    </div>

                                    <button class="custom-btn-gray mt-4"><img src="{{URL::asset('public/after_login/new_ui/images/planer.png')}}" alt="icon not find">Go To
                                        Planner</button>
                                    <!--<label class="custom-checkbox"><input type="checkbox"><span class="checkmark"></span></label>-->
                                </div>

                            </div>
                            @foreach($planner as $key=>$val)
                            @if($val->test_completed_yn=="N")
                            <div class="swiper-slide bg-white">
                                <div class="row">
                                    <div class="col-lg-12 px-0">
                                        <p>Level up in</p>
                                        <h3>{{$val->chapter_name}}</h3>
                                        <div> <span><img src="{{URL::asset('public/after_login/new_ui/images/star1.jpg')}}"></span> <span class="ms-1 score score-rating js-score">0%
                                            </span></div>
                                    </div>
                                </div>
                                <div class="sign-btn">
                                    <a href="{{route('planner_exam',[$val->id,$val->chapter_id])}}"><button type="submit" class="btn btn-primary active-btn text-uppercase">
                                            <img src="{{URL::asset('public/after_login/new_ui/images/right-white.png')}}">attempt now!</button>
                                    </a>
                                </div>
                            </div>
                            @elseif($val->test_completed_yn=="Y")
                            <div class="swiper-slide bg-white">
                                <div class="row">
                                    <div class="col-lg-12 px-0">
                                        <p>Level up in</p>
                                        <h3>{{$val->chapter_name}}</h3>
                                        <div> <span><img src="{{URL::asset('public/after_login/new_ui/images/star1.jpg')}}"></span> <span class="ms-1 score score-rating js-score">0%
                                            </span></div>
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
    <div class="modal fade" id="welcomeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-header pb-0 border-0">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 text-center">

                    <p class="wl-user-title">Hello {{!empty($userData->user_name)?ucwords($userData->user_name):'Guest'}},</p>
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

    <!-- Modal -->
    <div class="modal fade" id="feelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-header pb-0 border-0">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 text-center">

                    <p class="h1-p"> {{ucwords($userData->user_name)}},</p>
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
    @if($subjects_rating == null || empty($subjects_rating))
    <div class="modal fade" id="favSubResponse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-header pb-0 border-0">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0 text-center">

                    <p class="rating-headline mt-5 mb-4"> How much do you like each of these subjects?</p>

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
                        <!-- <a href="#" class="btn rating-back-btn px-4 ">
                        <i class="fa fa-chevron-left"></i> &nbsp;&nbsp;Back </a> -->
                        <a href="#" class="btn rating-next-btn disabled  rounded-0 ms-auto px-4" id="nxt-btn" onclick="store_rating();">Next&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>

                    </div>

                </div>

            </div>
        </div>
    </div>
    @endif
    <!-- Modal -->
    @if(isset($prof_asst_test) && $prof_asst_test=='N')
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
                    <p>Take a full body scan test to analyse and plan your preparation journey</p>
                    <a href="{{route('exam','full_exam')}}" class="full-txtblock justify-content-center d-flex align-items-center mb-4 mt-5 mx-5 px-5 py-4">

                        <span class="text-white ms-4 ">Take full body scan of<br>75 questions test</span>
                    </a>
                    <a href="#" class="btn mb-4 btn-sm rounded-0 mt-5 btn-light text-danger px-4 skip-dashboard" data-bs-toggle="modal" data-bs-dismiss="modal">Skip to Dashboard ></a>
                </div>

            </div>
        </div>
    </div>
    @endif
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


    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <!-- <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script> -->

    <script type="text/javascript" src="{{URL::asset('public/after_login/new_ui/js/jquery.slimscroll.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script type="text/javascript">
        // $(window).on('load', function() {
        //     $('#welcomeModal').modal('show');
        // });

        // calender js
        var mesos = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        var dies = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];

        var dies_abr = [

            'S',
            'M',
            'T',
            'W',
            'T',
            'F',
            'S',
        ];

        Number.prototype.pad = function(num) {
            var str = '';
            for (var i = 0; i < (num - this.toString().length); i++)
                str += '0';
            return str += this.toString();
        }

        function calendari(widget, data) {

            var original = widget.getElementsByClassName('actiu')[0];

            if (typeof original === 'undefined') {
                original = document.createElement('table');
                original.setAttribute('data-actual',
                    data.getFullYear() + '/' +
                    data.getMonth().pad(2) + '/' +
                    data.getDate().pad(2))
                widget.appendChild(original);
            }

            var diff = data - new Date(original.getAttribute('data-actual'));

            diff = new Date(diff).getMonth();

            var e = document.createElement('table');

            e.className = diff === 0 ? 'amagat-esquerra' : 'amagat-dreta';
            e.innerHTML = '';

            widget.appendChild(e);

            e.setAttribute('data-actual',
                data.getFullYear() + '/' +
                data.getMonth().pad(2) + '/' +
                data.getDate().pad(2))

            var fila = document.createElement('tr');
            var titol = document.createElement('th');
            titol.setAttribute('colspan', 7);

            var boto_prev = document.createElement('button');
            boto_prev.className = 'boto-prev';
            boto_prev.innerHTML = '&lt;';

            var boto_next = document.createElement('button');
            boto_next.className = 'boto-next';
            boto_next.innerHTML = '&gt;';

            titol.appendChild(boto_prev);
            titol.appendChild(document.createElement('span')).innerHTML =
                mesos[data.getMonth()] + '<span class="any">' + data.getFullYear() + '</span>';

            titol.appendChild(boto_next);

            boto_prev.onclick = function() {
                data.setMonth(data.getMonth() - 1);
                calendari(widget, data);
            };

            boto_next.onclick = function() {
                data.setMonth(data.getMonth() + 1);
                calendari(widget, data);
            };

            fila.appendChild(titol);
            e.appendChild(fila);

            fila = document.createElement('tr');

            for (var i = 1; i < 7; i++) {
                fila.innerHTML += '<th>' + dies_abr[i] + '</th>';
            }

            fila.innerHTML += '<th>' + dies_abr[0] + '</th>';
            e.appendChild(fila);

            /* Obtinc el dia que va acabar el mes anterior */
            var inici_mes =
                new Date(data.getFullYear(), data.getMonth(), -1).getDay();

            var actual = new Date(data.getFullYear(),
                data.getMonth(),
                -inici_mes);

            /* 6 setmanes per cobrir totes les posiblitats
             *  Quedaria mes consistent alhora de mostrar molts mesos 
             *  en una quadricula */
            for (var s = 0; s < 6; s++) {
                var fila = document.createElement('tr');

                for (var d = 1; d < 8; d++) {
                    var cela = document.createElement('td');
                    var span = document.createElement('span');

                    cela.appendChild(span);

                    span.innerHTML = actual.getDate();

                    if (actual.getMonth() !== data.getMonth())
                        cela.className = 'fora';

                    /* Si es avui el decorem */
                    if (data.getDate() == actual.getDate() &&
                        data.getMonth() == actual.getMonth())
                        cela.className = 'avui';

                    actual.setDate(actual.getDate() + 1);
                    fila.appendChild(cela);
                }

                e.appendChild(fila);
            }

            setTimeout(function() {
                e.className = 'actiu';
                original.className +=
                    diff === 0 ? ' amagat-dreta' : ' amagat-esquerra';
            }, 20);

            original.className = 'inactiu';

            setTimeout(function() {
                var inactius = document.getElementsByClassName('inactiu');
                for (var i = 0; i < inactius.length; i++)
                    widget.removeChild(inactius[i]);
            }, 1000);

        }

        calendari(document.getElementById('calendari'), new Date());

        // end of calender js
        $('.instructions').slimscroll({
            height: '33vh'
        });

        $(".rating-input").click(function() {
            $("#nxt-btn").removeClass("disabled");
        });

        $('.submenu-L1').on('shown.bs.collapse', function() {
            $('body').addClass('move-mainwrapper');

        })

        $('.submenu-L1').on('hidden.bs.collapse', function() {
            $('body').removeClass('move-mainwrapper');

        })
        $('.submenu-L2').on('shown.bs.collapse', function() {
            $('body').addClass('move-mainwrapper2');

        })

        $('.submenu-L2').on('hidden.bs.collapse', function() {
            $('body').removeClass('move-mainwrapper2');

        })
        $(document).on('click', function(e) {
            /* bootstrap collapse js adds "in" class to your collapsible element*/
            var menu_opened = $('.submenu-L1, .submenu-L2').hasClass('show');

            if (!$(e.target).closest('.submenu-L1').length &&
                !$(e.target).is('.submenu-L1, .submenu-L2') &&
                menu_opened === true) {
                $('.submenu-L1, .submenu-L2').collapse('toggle');
            }

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
    <script>
        $(document).ready(function() {
            $('#edit-planner-btn').click(function() {

                $('#sub-planner').addClass('open-sub-planner');
                $(this).addClass('close-sub-planner');
                $('#close-edit-planner-btn').removeClass('close-sub-planner');

            });
            $('#close-edit-planner-btn').click(function() {

                $('#sub-planner').removeClass('open-sub-planner');
                $(this).addClass('close-sub-planner');
                $('#edit-planner-btn').removeClass('close-sub-planner');

            });

        });
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
        });
    </script>

    <script>
        /* Score Pie Chart */
        Highcharts.chart('scorecontainer', {
            chart: {
                height: 120,
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false,
                spacingTop: 0,
                spacingBottom: 0,
                spacingRight: 0,
            },
            title: {
                text: '<span style=" font: normal normal 200 50px/60px Poppins-ExtraLight; letter-spacing: 0px; color: #21ccff;">{{$corrent_score_per}}</span> <br><span style=" font: normal normal normal 18px/27px Poppins-ExtraLight;letter-spacing: 0px;color: #21ccff;"> / 100 </span>',
                align: 'center',
                verticalAlign: 'middle',
                y: 45
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
                        color: '#fc2f00c7'
                    },
                    {
                        name: 'Progress',
                        y: <?php echo $progress; ?>,
                        color: '#ffa81d'
                    },
                    {
                        name: 'Others',
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
                height: 150,
                plotBackgroundColor: null,
                zoomType: 'x',
                marginLeft: 0,
                marginRight: 0,
                spacingLeft: 0,
                spacingRight: 0
            },
            title: {
                text: ''
            },

            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 0.5,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#000000'
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
                valueSuffix: ' units'
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
                        enabled: false
                    },

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
</body>

</html>