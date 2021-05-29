<div class="dash-sidebar">
    <div class="sidbar-block">
        <a href="{{ url('/') }}"><img src="{{URL::asset('public/after_login/images/inner-logo.png')}}" </a>
    </div>
    <div class="dash-nav-link">
        <a href="{{ url('/dashboard') }}"><img src="{{URL::asset('public/after_login/images/left-icon-1.svg')}}"></a>
        <a data-bs-toggle="collapse" href="#submenu" role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/images/left-icon-2.svg')}}"></a>
        <a href="#"><img src="{{URL::asset('public/after_login/images/left-icon-3.svg')}}"></a>
    </div>


    <div class="submenu-L1 collapse width" id="submenu">
        <div class="mt-5 mb-5 pb-5 pt-5"></div>
        <div class=" d-flex  flex-column h-100 mt-5 pt-4   text-start sublinks">
            <a class="nav-link" data-bs-toggle="collapse" href="#submenu2" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Practice</a>

            <a href="#" class="nav-link"><i class="far fa-edit"></i> Exam</a>
            <a href="#" class="nav-link"><i class="fas fa-external-link-alt"></i> Live</a>
        </div>

    </div>
    <div class="submenu-L2 collapse width" id="submenu2">
        <div class="mt-5 mb-5 pb-5 pt-5"></div>
        <div class=" d-flex  flex-column h-100 mt-5 pt-4   text-start sublinks">
            <a href="{{ url('/exam_custom') }}" class="nav-link"><i class="fas fa-sliders-h rotate-icon"></i> Custom</a>
            <a href="#" class="nav-link"><i class="fas fa-book-open"></i> Preset</a>

        </div>

    </div>


</div>