<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ms-auto text-end">
                <div class=" d-flex align-items-center flex-row-reverse">
                    <span class="user-pic-block"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="user-pic"></a></span>
                    <span class="user-name-block ps-3 me-3">Welcome, {{Auth::user()->first_name}}</span>

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
                        <a href="#" class="top-link ">
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
                                <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group 3093.png')}}">Account</a></span>
                                <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group 3105.png')}}">Subscription</a></span>
                                <span>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   sessionStorage.clear();  document.getElementById('logout-form').submit();">
                                        <img src="{{URL::asset('public/after_login/images/Layer -7.png')}}"> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </span>
                            </div>
                        </div>
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
            <p class="fw-bold text-uppercase">Exams per week</p>
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <div class="progress">
                        <div class="progress-bar bg-light-green" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="badge bg-secondary">5</span>
                </div>
            </div>
            <p class="fw-bold text-uppercase">Schedule test weeks</p>
            <div class="d-flex align-items-center">
                <div class="me-2">
                    <label class="d-block">Start Date</label>
                    <input type="date" class="bg-light border-0 p-2 text-center text-uppercase" />
                </div>
                <div>
                    <label class="d-block">End Date</label>
                    <input type="date" class="bg-light border-0 p-2 text-center text-uppercase" />
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex align-items-center text-uppercase"><i class="me-2 fa fa-check-circle text-success" aria-hidden="true"></i> Mathematics</div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex align-items-center text-uppercase"><i class="me-2 fa fa-check-circle text-success" aria-hidden="true"></i> Physics</div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex align-items-center text-uppercase"><i class="me-2 fa fa-check-circle text-success" aria-hidden="true"></i> Chemistry</div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="add-removeblock p-3 d-flex align-items-center">
                        <span>Application of Calculus</span>
                        <span class="ms-auto"><i class="fa fa-repeat me-3 cust-repeat-icon" aria-hidden="true"></i></span>
                        <span class=""><i class="fa fa-minus-circle text-light-danger  cust-remove-icon" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="add-removeblock p-3 d-flex align-items-center">
                        <span>Application of Calculus</span>
                        <span class="ms-auto"><i class="fa fa-repeat me-3 cust-repeat-icon" aria-hidden="true"></i></span>
                        <span class=""><i class="fa fa-minus-circle text-light-danger  cust-remove-icon" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="add-removeblock p-3 d-flex align-items-center">
                        <span>Application of Calculus</span>
                        <span class="ms-auto"><i class="fa fa-repeat me-3 cust-repeat-icon" aria-hidden="true"></i></span>
                        <span class=""><i class="fa fa-minus-circle text-light-danger  cust-remove-icon" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="add-removeblock p-3 d-flex align-items-center">
                        <span>Application of Calculus</span>
                        <span class="ms-auto"><i class="fa fa-repeat me-3 cust-repeat-icon" aria-hidden="true"></i></span>
                        <span class=""><i class="fa fa-minus-circle text-light-danger  cust-remove-icon" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="add-removeblock p-3 d-flex align-items-center">
                        <span>Application of Calculus</span>
                        <span class="ms-auto"><i class="fa fa-repeat me-3 cust-repeat-icon" aria-hidden="true"></i></span>
                        <span class=""><i class="fa fa-minus-circle text-light-danger  cust-remove-icon" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-light  p-3 d-flex align-items-center justify-content-center">


                        <span class=""><i class="fa fa-plus text-white  " aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-light  p-3 d-flex align-items-center justify-content-center">


                        <span class=""><i class="fa fa-plus text-white  " aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-light  p-3 d-flex align-items-center justify-content-center">


                        <span class=""><i class="fa fa-plus text-white  " aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn-danger btn rounded-0 text-uppercase px-5 w-25"><i class="fa fa-check"></i></button>
            </div>
        </div>
        <div class="planner-content p-3">
            <div class="d-flex align-items-center justify-content-between">
                <span>
                    <a href="#" class="link-danger" id="edit-planner-btn"><img src="{{URL::asset('public/after_login/images/edit.png')}}"></a>
                    <a href="#" class="link-danger close-sub-planner" id="close-edit-planner-btn"><img style="width:24px;" src="{{URL::asset('public/after_login/images/Layer-4.png')}}" class="bg-white"></a>
                </span>
                <span class="fs-5 text-danger text-uppercase">Planner</span>
                <span><a href="#" class="text-secondary"><i class="fas fa-info-circle"></i></a></span>
            </div>
            <div class="calender-block">
                <div id="calendari"></div>
            </div>
            <div class="bg-white shadow p-3">
                <div class="d-flex cal-box">
                    <span class="cal-date">27</span>
                    <div class="d-flex flex-column ms-3">
                        <span class="cal-txt1">No Test Scheduled</span>
                        <span><a href="#" class="cal-txt2">Upcoming Test tomorrow ></a></span>
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