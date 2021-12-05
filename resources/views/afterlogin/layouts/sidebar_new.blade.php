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
        <a id="practice_exam" data-bs-toggle="collapse" href="#submenu" role="button" aria-expanded="false" aria-controls="collapseExample">
            <img src="{{URL::asset('public/after_login/new_ui/images/left-icon-2.svg')}}">
        </a>
        <a id="preparation_center" data-bs-toggle="collapse" href="#submenupreparation" id="submenupreparationlink">
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