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
        <div class="planner-content p-3">
            <div class="d-flex align-items-center justify-content-between">
                <span><a href="#" class="link-danger"><i class="fa fa-pencil"></i></a></span>
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
                        <span class="cal-txt3"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></span>
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