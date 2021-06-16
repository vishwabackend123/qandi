<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ms-auto text-end">
                <div class="user-name-block d-flex align-items-center flex-row-reverse">
                    <span class="user-pic-block"><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="user-pic"></span>
                    <span class="user-name-block ps-3">Welcome, {{Auth::user()->first_name}}</span>
                    <span class="notification me-5 "><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   sessionStorage.clear();  document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </span>
                    <span class="notification me-5 ms-4"><a href=""><img src="{{URL::asset('public/after_login/images/bell.png')}}"></a></span>
                    <span class="notification ms-4"><a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/images/calender.png')}}"></a></span>
                    <span class="notification ms-4"><a href=""><img src="{{URL::asset('public/after_login/images/Group1831.png')}}"></a></span>
                </div>
            </div>
        </div>
    </div>
</header>
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