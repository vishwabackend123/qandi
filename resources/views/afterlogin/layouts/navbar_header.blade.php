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
                    <span class="notification ms-4"><a href=""><img src="{{URL::asset('public/after_login/images/calender.png')}}"></a></span>
                    <span class="notification ms-4"><a href=""><img src="{{URL::asset('public/after_login/images/Group 1831.png')}}"></a></span>
                </div>
            </div>
        </div>
    </div>
</header>