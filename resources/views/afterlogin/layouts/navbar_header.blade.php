<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ms-auto text-end">
                <div class=" d-flex align-items-center flex-row-reverse">
                    <span class="user-pic-block"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="user-pic"></a></span>
                    <span class="user-name-block ps-3 me-3">Welcome, <span id="activeUserName">{{Auth::user()->user_name}}</span></span>

                    <span class="notification me-5 ms-4">
                        <a data-bs-toggle="collapse" href="#notification" role="button" aria-expanded="false" aria-controls="notification" class="top-link ">
                            <img src="{{URL::asset('public/after_login/images/bell.png')}}">
                            <span class="red-dot"></span>
                            <span class="hoverlink">Notification</span>
                        </a>
                    </span>
                    <span class="notification ms-4">
                        <a data-bs-toggle="collapse" class="top-link " href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <img src="{{URL::asset('public/after_login/images/calender.png')}}">
                            <span class="red-dot"></span>
                            <span class="hoverlink">Planner</span>
                        </a>
                    </span>
                    <span class="notification ms-4">
                        <a href="{{ route('overall_analytics') }}" class="top-link ">
                            <img src="{{URL::asset('public/after_login/images/Group1831.png')}}">
                            <span class="red-dot"></span>
                            <span class="hoverlink">Analitics</span>
                        </a>
                    </span>
                </div>
                <div class="profile-menu">
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

                        <div class="offcanvas-body">
                            <div class="d-flex flex-column justify-content-center align-items-start profile-links">
                                <span><a href="javascript:void(0);" id="profile-click"><img src="{{URL::asset('public/after_login/images/Group 3093.png')}}">Account</a></span>
                                <span><a href="javascript:void(0);" id="subscribe-click"><img src="{{URL::asset('public/after_login/images/Group 3105.png')}}">Subscription</a></span>

                                <span>
                                    <a href="javascript:void(0);" id="logout-click"><img src="{{URL::asset('public/after_login/images/Layer -7.png')}}">Logout</a>

                                </span>
                            </div>
                        </div>
                        <div id="profile-block" class="d-none">
                            <div class="d-flex flex-row-reverse">
                                <div class="myAccountblock" id="myAccount">
                                    <div class="d-flex text-start">
                                        <div class="leaderBoardBlock">
                                            <div class="bg-white p-4 text-left ms-2">
                                                <p class="text-uppercase py-4">Leader Board</p>
                                                <ol class="leaderNameBlock">
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <span><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="leader-pic" /></span>
                                                            <div class="leader-txt">
                                                                <p>Roshani Sonve</p>
                                                                <small>82.6 Unique score</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <span><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="leader-pic" /></span>
                                                            <div class="leader-txt">
                                                                <p>Roshani Sonve</p>
                                                                <small>82.6 Unique score</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <span><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="leader-pic" /></span>
                                                            <div class="leader-txt">
                                                                <p>Roshani Sonve</p>
                                                                <small>82.6 Unique score</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <span><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="leader-pic" /></span>
                                                            <div class="leader-txt">
                                                                <p>Roshani Sonve</p>
                                                                <small>82.6 Unique score</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <span><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="leader-pic" /></span>
                                                            <div class="leader-txt">
                                                                <p>Roshani Sonve</p>
                                                                <small>82.6 Unique score</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                                <div class="text-box mt-5">
                                                    <label class="ps-2 pb-2">Search a Friend</label>
                                                    <input type="text" name="searchname" id="searchname" class="ps-2" value="" minlength="10" maxlength="10" placeholder="Search By Name" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="myAccountblock" id="profile">
                                    <div class="d-flex text-start">
                                        <div class="leaderBoardBlockedit">
                                            <div class="bg-white p-4 text-left ms-4 read-mode">
                                                <span class="position-relative d-inline-block">
                                                    <img src="{{URL::asset('public/after_login/images/userpics.png')}}" class="uswereditpic" />
                                                    <a href="javascript:void(0);" class="edit-icon"><i class="fas fa-pencil-alt"></i></a>
                                                </span>
                                                <div id="profile-details">
                                                    <div class="my-5 profile-read">
                                                        <h5 id="profileUserName">{{Auth::user()->user_name}}</h5>
                                                        <small>Class - {{$user_stage}}, Preparing for {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</small>
                                                        <button class="btn-danger mt-4 rounded-0 btn-sm btn px-5 ms-2" id="editprofile">Edit Profile</button>
                                                    </div>
                                                    <div>
                                                        <h5 class="text-uppercase fw-bold">Achievements</h5>
                                                        <div class="scroll-achiv ">
                                                            <p class="d-flex align-items-center text-light mt-4 "><span>You attempted 5 consecutive exams on time!</span><a href="javascript:void(0);" class="text-light ms-auto fs-3"><i class="fas fa-share-alt"></i></a></p>
                                                            <p class="d-flex align-items-center text-light mt-4 "><span>You attempted 5 consecutive exams on time!</span><a href="javascript:void(0);" class="text-light ms-auto fs-3"><i class="fas fa-share-alt"></i></a></p>
                                                            <p class="d-flex align-items-center text-light mt-4 "><span>You attempted 5 consecutive exams on time!</span><a href="javascript:void(0);" class="text-light ms-auto fs-3"><i class="fas fa-share-alt"></i></a></p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile-form-block" id="profile-form">
                                                    <form id="editProfile_form" action="{{route('editProfile')}}" method="POST">
                                                        @csrf
                                                        <div class="text-box mt-5">

                                                            <input type="text" name="firstname" id="firstname" class="ps-2" value="{{Auth::user()->first_name}}" placeholder="First Name" required />

                                                        </div>

                                                        <div class="text-box mt-2">

                                                            <input type="text" name="lastname" id="lastname" class="ps-2" value="{{Auth::user()->last_name}}" required placeholder="Last Name" />

                                                        </div>
                                                        <div class="text-box mt-2">

                                                            <input type="text" name="username" id="username" class="ps-2" value="{{Auth::user()->user_name}}" required placeholder="Display Name" />
                                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                                        </div>
                                                        <div class="text-box mt-3">

                                                            <!--  <input type="text" name="searchname" id="searchname" class="ps-2" value="" minlength="10" maxlength="10" placeholder="https://www.uniq.co.in/_userID_000987787" /> -->
                                                            <div id="emailHelp" class="form-text">Your ID</div>
                                                        </div>
                                                        <div class="text-box mt-3">
                                                            <input type="email" name="useremail" id="useremail" class="ps-2" value="{{Auth::user()->email}}" required placeholder="Your Email Id" />
                                                        </div>
                                                        <div class="text-box mt-2">

                                                            <input type="text" name="user_mobile" id="user_mobile" class="ps-2" value="{{Auth::user()->mobile}}" minlength="10" maxlength="10" onkeypress="return isNumber(event)" placeholder="Your Contact Number" required />

                                                        </div>
                                                        <div class=" text-box mt-4 text-end">
                                                            <button type="button" id="cancelEdit" class="btn-light rounded-0 btn px-5 btn-sm">Cancel</button>
                                                            <button type="submit" id="saveEdit" class="btn-danger  rounded-0 btn-sm btn px-5 ms-2">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="myAccountblock d-none" id="subscribe">
                            <div class="d-flex text-start">
                                <div class="subscribeBlock">
                                    <div class="bg-white p-4 text-left ms-4 ">
                                        <div class="d-flex align-items-center">
                                            <span class="position-relative d-inline-block">
                                                <img src="{{URL::asset('public/after_login/images/userpics.png')}}" class="sml-pic" />

                                            </span>
                                            <div class="my-5 subscription-read">
                                                <h5>{{Auth::user()->user_name}}</h5>
                                                <small>Class - {{$user_stage}}, Preparing for {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</small>

                                            </div>
                                        </div>
                                        <div class="d-flex bg-light align-items-center px-4 py-3">
                                            <span><i class="fas fa-check-circle text-success fa-4x"></i></span>
                                            <div class="subscribe-detail">
                                                @if(isset($subscription_details) && !empty($subscription_details))
                                                <p class="mb-0">Subscribed for {{isset($subscription_details->subscription_name)?$subscription_details->subscription_name:''}}</p>
                                                <small>{{isset($subscription_details->subscription_details)?$subscription_details->subscription_details:''}}</small>
                                                @endif
                                                <!-- <p class="mb-0">Subscribed for JEE (Mains) 2022</p>
                                                <small>Includes 2 Mains Mock Test (Live), 4 Sample Tests</small> -->
                                            </div>
                                        </div>
                                        <p class="text-end text-danger mt-1">*Subscription expires on {{isset($subscription_details->subscription_end_date)?date("jS F, Y", strtotime($subscription_details->subscription_end_date)):''}}</p>
                                        <!-- <p class="text-end text-danger mt-1">*Subscription expires on 23rd April, 2022</p> -->
                                        {{-- <div class=" text-box mt-4 text-end">--}}
                                        {{-- <a href="{{route('subscriptions')}}" class="btn-light rounded-0 btn px-5 btn-sm">See Details</a>--}}
                                        {{-- <a href="{{route('subscriptions')}}" class="btn-danger rounded-0 btn-sm btn px-5 ms-2">Change Course</a>--}}
                                        {{-- </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="myAccountblock d-none" id="logout-block">
                            <div class="d-flex text-start align-items-center justify-content-center h-100">
                                <div class="logoutBlock">
                                    <div class="bg-white p-4 text-left ms-4 text-center">

                                        <p>Are you sure?</p>

                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            sessionStorage.clear();  document.getElementById('logout-form').submit();" class="btn btn-danger rounded-0 px-5">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>



                                    </div>
                                </div>
                            </div>
                        </div> <!-- login end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- notification START-->
<div class="collapse planmner-block width" id="notification">
    <div class="planner-wrapper">
        <div class="planner-content p-3">
            <h4 class="noti-heading">Notification</h4>
            <div class="notification-scroll">
                <p class="noti-subheading">Recent</p>
                <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                    <p>You have a test tomorrow on Wave Optics</p>
                    <span class="mb-2">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-light"></i>
                        <i class="fa fa-star text-light"></i>
                    </span>
                    <small>09:34PM</small>
                </div>
                <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                    <p>You have a test tomorrow on Wave Optics</p>
                    <span class="mb-2">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-light"></i>
                        <i class="fa fa-star text-light"></i>
                    </span>
                    <small>09:34PM</small>
                </div>
                <p class="noti-subheading mt-4">Older Notification</p>
                <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                    <p>You have a test tomorrow on Wave Optics</p>
                    <span class="mb-2">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-light"></i>
                        <i class="fa fa-star text-light"></i>
                    </span>
                    <small>09:34PM</small>
                </div>
                <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                    <p>You have a test tomorrow on Wave Optics</p>
                    <span class="mb-2">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-light"></i>
                        <i class="fa fa-star text-light"></i>
                    </span>
                    <small>09:34PM</small>
                </div>
                <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                    <p>You have a test tomorrow on Wave Optics</p>
                    <span class="mb-2">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-light"></i>
                        <i class="fa fa-star text-light"></i>
                    </span>
                    <small>09:34PM</small>
                </div>
                <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                    <p>You have a test tomorrow on Wave Optics</p>
                    <span class="mb-2">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-light"></i>
                        <i class="fa fa-star text-light"></i>
                    </span>
                    <small>09:34PM</small>
                </div>
                <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                    <p>You have a test tomorrow on Wave Optics</p>
                    <span class="mb-2">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-light"></i>
                        <i class="fa fa-star text-light"></i>
                    </span>
                    <small>09:34PM</small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- notification End-->
<div class="collapse planmner-block width" id="collapseExample">

    <div class="planner-wrapper">
        <div class="planner-edit-mode" id="sub-planner">
            <span class="valid-feedback m-0" role="alert" id="errlog_alert"> </span>
            <span class="invalid-feedback m-0" role="alert" id="errlog_alert"> </span>
            <p class="fw-bold text-uppercase">Exams per week</p>
            <form id="plannerAddform" action="{{route('addPlanner')}}" method="POST">
                @csrf
                <div class="row align-items-center mb-2">
                    <div class="col-md-6">
                        <input type="range" name="weekrange" class="form-range exam_range" min="0" max="7" value="5" step="1" id="customRange" oninput="outputUpdate(value)">
                    </div>
                    <div class="col-md-6">
                        <span id="slide-input" class="badge bg-secondary">5</span>
                    </div>
                </div>
                <p class="fw-bold text-uppercase">Schedule test weeks</p>
                <div class="d-flex align-items-center row">
                    <div class="col-3 me-2">
                        <label class="d-block">Start Date</label>
                        <input type="date" id="StartDate" name="start_date" class="form-control bg-light border-0 p-2 text-center text-uppercase" required />
                    </div>
                    <div class="col-3">
                        <label class="d-block">End Date</label>
                        <input type="date" id="EndDate" name="end_date" readonly class="form-control bg-light border-0 p-2 text-center text-uppercase" required />
                    </div>
                </div>
                <div class=" row mt-5">
                    <span id="limit_error" class="text-danger"></span>
                    @if(isset($aSubjects) && !empty($aSubjects))
                    @foreach($aSubjects as $skey=>$sVal)
                    <div class="col col-lg-4 mb-4 ">
                        <div class="d-flex align-items-center text-uppercase"><i class="me-2 fa fa-check-circle text-success" aria-hidden="true"></i> {{$sVal->subject_name}}</div>
                        <div class="subject_chapter">
                            <div id="planner_sub_{{$sVal->id}}" class="chaptbox pt-2">

                            </div>
                            <div class="chaptbox-add ">
                                <a href="#" class="btn btn-light  p-3 d-flex align-items-center justify-content-center" id="subject_chapter_{{$sVal->id}}" onClick="selectChapter('{{$sVal->id}}');">
                                    <span class=""><i class="fa fa-plus text-white  " aria-hidden="true"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="text-center">
                    <button class="btn-danger btn rounded-0 text-uppercase px-5 w-25"><i class="fa fa-check"></i></button>
                </div>
            </form>
        </div>
        <div class="planner-content p-3">
            <div class="d-flex align-items-center justify-content-between">
                <span>
                    <a href="javascript:void(0);" class="link-danger" id="edit-planner-btn"><img src="{{URL::asset('public/after_login/images/edit.png')}}"></a>
                    <a href="javascript:void(0);" class="link-danger close-sub-planner" id="close-edit-planner-btn"><img style="width:24px;" src="{{URL::asset('public/after_login/images/Layer-4.png')}}" class="bg-white"></a>
                </span>
                <span class="fs-5 text-danger text-uppercase">Planner</span>
                <span><a href="javascript:void(0);" class="text-secondary"><i class="fas fa-info-circle"></i></a></span>
            </div>
            <div class="calender-block">
                <div id="calendari"></div>
            </div>
            <div class="bg-white shadow p-3">
                <div class="d-flex cal-box">
                    <span class="cal-date">27</span>
                    <div class="d-flex flex-column ms-3">
                        <span class="cal-txt1">No Test Scheduled</span>
                        <span><a href="javascript:void(0);" class="cal-txt2">Upcoming Test tomorrow ></a></span>
                        <span class="cal-txt3"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> <i class="fa fa-star"></i></span>
                    </div>
                </div>
                <div class="d-flex remind-box">
                    <span class="remind-txt"><i class="fa fa-clock-o"></i>Thursday, 27 May</span>
                    <span class="ms-auto">3:00 PM</span>
                </div>
                <div class="d-flex remind-box">
                    <span class="remind-txt"><i class="fa fa-calendar-o"></i>Remind Me</span>
                    <span class="ms-auto">30 Mins before</span>
                </div>
                <div class="d-flex remind-box flex-column">
                    <span class="remind-txt"><i class="fas fa-bars"></i><textarea placeholder="Add description" disabled></textarea></span>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>