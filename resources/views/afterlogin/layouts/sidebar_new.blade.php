@php
$userData = Session::get('user_data');
@endphp

<?php $redis_data = Session::get('redis_data'); ?>

<!-------- Mobile Sidebar -- jjknjk------------>
<section class="sidebar_block mobile_block_tab mobilemenu">
    <div class="userprofile headericon d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            @if(isset($userData->user_profile_img))
            <img src="{{ $imgPath ?? '' }}" class="profileicon" height="20px" width="20px" />
            @else
            <a href="javascript:void(0)" title="User">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                    <path d="M16.666 17.602v-1.667a3.333 3.333 0 0 0-3.333-3.333H6.666a3.333 3.333 0 0 0-3.333 3.333v1.667M10 9.268a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666z" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
            @endif

            <strong>Hi {{ucwords($userData->user_name)}}! </strong>
        </div>
        <span>{{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</span>
    </div>

    <div class="main_menu_block">
        <a href="{{ route('profile') }}" class="d-flex justify-content-between align-items-center pro_sub_label">
            Profile & Subcription
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="m6 12 4-4-4-4" stroke="#868A95" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <ul class="mob_sidebar_lists m-0">
            <li class="active current_dashboard">
                <a href="{{ url('/dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                        <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.746-2.31-2.601-2.31H4.934c-1.855 0-2.601.665-2.601 2.31v5.285c0 1.657.746 2.31 2.601 2.31H9.65c1.855.012 2.601-.653 2.601-2.298zM12.25 23.065v-4.713c0-1.855-.746-2.602-2.601-2.602H4.934c-1.855 0-2.601.747-2.601 2.602v4.713c0 1.855.746 2.602 2.601 2.602H9.65c1.855 0 2.601-.747 2.601-2.602z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                        <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.747-2.31-2.602-2.31H4.935c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM12.25 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602H4.935c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="current_practice">
                <a href="javascript:void(0)" class="testsubmenu_open">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                        <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                        <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#56B663" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#56B663" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Assessments</span>
                </a>
            </li>
            <li class="current_analytics">
                <a href="{{route('overall_analytics')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 12A10 10 0 0 0 12 2v10h10z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 12A10.001 10.001 0 0 0 12 2v10h10z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Analytics</span>
                </a>
            </li>
            <li class="current_planner">
                <a href="{{ url('/planner') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                        <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Planner</span>
                </a>
            </li>
            <li class="current_refer">
                <a href="#referfrnd" data-bs-toggle="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                        <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Refer friends</span>
                </a>
            </li>
            <li>
                <a href="{{env('CMS_URL')}}contact-us/" target="_blank">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 9h1a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-1V9zM5 9H4a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1V9z" stroke="#234628" stroke-width="2" stroke-linejoin="round" />
                        <path d="M19 9.531c0-4.172-3.135-7.554-7-7.554-3.866 0-7 3.382-7 7.554" stroke="#234628" stroke-width="2" />
                        <path d="M11.505 20.671H16a3 3 0 0 0 3-3" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <rect x="10.449" y="19.347" width="3" height="3" rx="1.5" fill="#234628" stroke="#234628" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                        <path d="M19 9h1a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-1V9zM5 9H4a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1V9z" stroke="#56B663" stroke-width="2" stroke-linejoin="round" />
                        <path d="M19 9.531c0-4.172-3.135-7.554-7-7.554-3.866 0-7 3.382-7 7.554" stroke="#56B663" stroke-width="2" />
                        <path d="M11.505 19.671a1 1 0 1 0 0 2v-2zm8.494-2a1 1 0 1 0-2 0h2zm-4 2h-4.494v2H16v-2zm2-2a2 2 0 0 1-2 2v2a4 4 0 0 0 4-4h-2z" fill="#56B663" />
                        <rect x="10.449" y="19.347" width="3" height="3" rx="1.5" fill="#56B663" stroke="#56B663" />
                    </svg>
                    <span>Contact us</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="submenu_menu_block" style="display:none;">
        <label class="d-flex  align-items-center pro_sub_label">
            <span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m6 12 4-4-4-4" stroke="#868A95" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Back
            </span>
        </label>
        <span>Exam</span>
        <ul class="submenu-lists mb-0">
            <li class="practice-menu">
                <a href="javascript:void(0)">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.167 1.667H7.5c-4.166 0-5.833 1.667-5.833 5.833v5c0 4.167 1.667 5.834 5.833 5.834h5c4.167 0 5.834-1.667 5.834-5.834v-1.666" stroke="#234628" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M13.367 2.516 6.8 9.083c-.25.25-.5.742-.55 1.1l-.358 2.508c-.134.909.508 1.542 1.416 1.417l2.509-.358c.35-.05.841-.3 1.1-.55l6.566-6.567c1.134-1.133 1.667-2.45 0-4.117-1.666-1.666-2.983-1.133-4.116 0z" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.425 3.458a5.954 5.954 0 0 0 4.116 4.117" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="practice-icon-active">
                        <path d="M9.167 1.667H7.5c-4.166 0-5.833 1.667-5.833 5.833v5c0 4.167 1.667 5.834 5.833 5.834h5c4.167 0 5.834-1.667 5.834-5.834v-1.666" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M13.367 2.516 6.8 9.083c-.25.25-.5.742-.55 1.1l-.358 2.508c-.134.909.508 1.542 1.416 1.417l2.509-.358c.35-.05.841-.3 1.1-.55l6.566-6.567c1.134-1.133 1.667-2.45 0-4.117-1.666-1.666-2.983-1.133-4.116 0z" stroke="#56B663" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.425 3.458a5.954 5.954 0 0 0 4.116 4.117" stroke="#56B663" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Practice <span class="practice-toggle-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                </a>
                <div class="practice-submenu" style="display: none;">
                    <a href="{{ url('/exam_custom') }}">Custom</a>
                    <a href="{{ url('/series_list') }}">Test Series</a>
                </div>
            </li>
            <li>
                <a href="{{route('mockExamTest')}}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.334 13.95V3.892c0-1-.817-1.742-1.809-1.659h-.05c-1.75.15-4.408 1.042-5.891 1.975l-.142.092a.923.923 0 0 1-.883 0l-.209-.125c-1.483-.925-4.133-1.808-5.883-1.95a1.64 1.64 0 0 0-1.8 1.658V13.95c0 .8.65 1.55 1.45 1.65l.242.033c1.808.242 4.6 1.159 6.2 2.034l.033.016c.225.125.583.125.8 0 1.6-.883 4.4-1.808 6.217-2.05l.275-.033c.8-.1 1.45-.85 1.45-1.65zM10 4.575v12.5M6.458 7.075H4.583M7.083 9.575h-2.5" stroke="#234628" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Mock Exam
                </a>
            </li>
            <li>
                <a href="{{route('live_exam_list')}}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.683 6.626a5.21 5.21 0 0 1 0 7.366 5.21 5.21 0 0 1-7.367 0 5.21 5.21 0 0 1 0-7.366 5.21 5.21 0 0 1 7.367 0zM6.875 18.034a8.241 8.241 0 0 1-4.092-3.55A8.242 8.242 0 0 1 1.74 9.275M4.875 3.733A8.28 8.28 0 0 1 10 1.967c1.892 0 3.633.641 5.033 1.708M13.125 18.034a8.241 8.241 0 0 0 4.092-3.55 8.242 8.242 0 0 0 1.041-5.209" stroke="#234628" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Live Exam
                </a>
            </li>
            <li>
                <a href="{{route('previous_year_exam')}}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 5.834v8.333c0 2.5-1.25 4.167-4.167 4.167H6.667c-2.917 0-4.167-1.667-4.167-4.167V5.834c0-2.5 1.25-4.167 4.167-4.167h6.666c2.917 0 4.167 1.667 4.167 4.167z" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.083 3.75v1.667c0 .916.75 1.666 1.667 1.666h1.666M6.667 10.833H10M6.667 14.167h6.667" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Previous year exams
                </a>
            </li>
        </ul>
    </div>

    <div class="mobileview_logout position-relative">
        <a href="{{ route('logout') }}" class="btn btn-common-transparent">Logout</a>
    </div>
</section>
<!-------------- End --------------->
<aside>
    <span class="sidebar-logo d-inline-block">
        <a href="{{env('CMS_URL')}}" target="_blank">
            <svg width="55" height="56" viewBox="0 0 55 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27.756.894H.926V28h26.83V.894zM54.584 28.001h-26.83v27.105h26.83V28.001z" fill="#38D430" />
                <path d="M54.584.894h-26.83V28h26.83V.894z" fill="#00AB16" />
                <path d="m44.268 20.41 2.256 2.35h2.604l-3.627-3.795 2.325-2.725V13.52l-3.558 4.156-3.418-3.57 1-.723c1.163-.87 2.325-2.02 2.325-3.665 0-2.373-1.788-3.947-4.231-3.947-2.116 0-4.186 1.527-4.186 4.064 0 1.55 1.14 2.796 1.907 3.614l.488.517-.325.235c-1.744 1.292-2.884 2.53-2.884 4.628 0 2.138 1.628 4.254 4.65 4.254 1.86 0 3.28-1.06 4.674-2.671zM37.711 9.714a2.23 2.23 0 0 1 .64-1.608 2.186 2.186 0 0 1 1.593-.647c1.371 0 2.278.987 2.278 2.208 0 .822-.349 1.527-1.348 2.255l-1.233.94-.65-.705c-.629-.634-1.28-1.48-1.28-2.443zm-.813 8.95c0-1.292.743-2.114 1.65-2.795l.814-.634 3.697 3.876-.14.164c-.952 1.104-1.999 1.973-3.301 1.973-1.697 0-2.72-1.291-2.72-2.584zm-14.022-4.215a8.707 8.707 0 0 0-1.455-4.794 8.575 8.575 0 0 0-3.843-3.171A8.476 8.476 0 0 0 12.638 6 8.53 8.53 0 0 0 8.264 8.37a8.673 8.673 0 0 0-2.337 4.423 8.727 8.727 0 0 0 .486 4.99 8.627 8.627 0 0 0 3.145 3.878 8.496 8.496 0 0 0 4.747 1.461 8.276 8.276 0 0 0 4.89-1.662l1.407 1.428h4.068l-3.438-3.488a8.528 8.528 0 0 0 1.644-4.951zm-3.86 2.71-2.34-2.37h-4.065l4.383 4.445a5.43 5.43 0 0 1-3.8.647 5.469 5.469 0 0 1-3.28-2.04 5.572 5.572 0 0 1 .426-7.274 5.437 5.437 0 0 1 7.193-.539 5.539 5.539 0 0 1 2.068 3.284 5.582 5.582 0 0 1-.584 3.847zm17.06 16.083h10.196v3.048H42.78v10.53h3.477v3.046H36.062v-3.043h3.499v-10.53h-3.484v-3.051z" fill="#1F1F1F" />
            </svg>

        </a>
        <span class="custom-border mt-3"></span>
    </span>
    <ul class="sidebar-menu-lists">
        <li class="active mb-4 current_dashboard">
            <a href="{{ url('/dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.746-2.31-2.601-2.31H4.934c-1.855 0-2.601.665-2.601 2.31v5.285c0 1.657.746 2.31 2.601 2.31H9.65c1.855.012 2.601-.653 2.601-2.298zM12.25 23.065v-4.713c0-1.855-.746-2.602-2.601-2.602H4.934c-1.855 0-2.601.747-2.601 2.602v4.713c0 1.855.746 2.602 2.601 2.602H9.65c1.855 0 2.601-.747 2.601-2.602z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.747-2.31-2.602-2.31H4.935c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM12.25 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602H4.935c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="sidebar-menu-tooltip">Dashboard</span>
            </a>
        </li>
        <li class="mb-4 sidebar-exam-menu current_practice">
            <a href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#56B663" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#56B663" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="sidebar-menu-tooltip">Assessments</span>
            </a>
        </li>
        @if(isset($userStatus) && $userStatus==false)
        <li class="mb-4 current_analytics">
            <a href="{{route('overall_analytics')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M22 12A10 10 0 0 0 12 2v10h10z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M22 12A10.001 10.001 0 0 0 12 2v10h10z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="sidebar-menu-tooltip">Analytics</span>
            </a>
        </li>
        @endif
        <li class="mb-4 current_planner">
            <a href="{{ url('/planner') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="sidebar-menu-tooltip">Planner</span>
            </a>
        </li>
        <li class="mb-4 current_refer">
            <a onclick="openDialog()" href="#referfrnd" class="openSharefrnd ref_class" data-bs-toggle="modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="ref_class">
                    <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ref_class" />
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active ref_class">
                    <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ref_class" />
                </svg>
                <span class="sidebar-menu-tooltip">Refer a Friend</span>
            </a>
        </li>
        <li class="contactus-menu">
            <a href="{{env('CMS_URL')}}contact-us/" target="_blank">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 9h1a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-1V9zM5 9H4a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1V9z" stroke="#234628" stroke-width="2" stroke-linejoin="round" />
                    <path d="M19 9.531c0-4.172-3.135-7.554-7-7.554-3.866 0-7 3.382-7 7.554" stroke="#234628" stroke-width="2" />
                    <path d="M11.505 20.671H16a3 3 0 0 0 3-3" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="10.449" y="19.347" width="3" height="3" rx="1.5" fill="#234628" stroke="#234628" />
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M19 9h1a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-1V9zM5 9H4a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1V9z" stroke="#56B663" stroke-width="2" stroke-linejoin="round" />
                    <path d="M19 9.531c0-4.172-3.135-7.554-7-7.554-3.866 0-7 3.382-7 7.554" stroke="#56B663" stroke-width="2" />
                    <path d="M11.505 19.671a1 1 0 1 0 0 2v-2zm8.494-2a1 1 0 1 0-2 0h2zm-4 2h-4.494v2H16v-2zm2-2a2 2 0 0 1-2 2v2a4 4 0 0 0 4-4h-2z" fill="#56B663" />
                    <rect x="10.449" y="19.347" width="3" height="3" rx="1.5" fill="#56B663" stroke="#56B663" />
                </svg>
                <span class="sidebar-menu-tooltip">Contact us</span>
            </a>
        </li>
    </ul>
    <div class="submenu-block">
        <h6 class="mb-5">Exam</h6>
        <ul class="submenu-lists ps-0">
            <li class="practice-menu">
                <a href="javascript:void(0)">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.167 1.667H7.5c-4.166 0-5.833 1.667-5.833 5.833v5c0 4.167 1.667 5.834 5.833 5.834h5c4.167 0 5.834-1.667 5.834-5.834v-1.666" stroke="#234628" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.367 2.516 6.8 9.083c-.25.25-.5.742-.55 1.1l-.358 2.508c-.134.909.508 1.542 1.416 1.417l2.509-.358c.35-.05.841-.3 1.1-.55l6.566-6.567c1.134-1.133 1.667-2.45 0-4.117-1.666-1.666-2.983-1.133-4.116 0z" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.425 3.458a5.954 5.954 0 0 0 4.116 4.117" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="practice-icon-active">
                        <path d="M9.167 1.667H7.5c-4.166 0-5.833 1.667-5.833 5.833v5c0 4.167 1.667 5.834 5.833 5.834h5c4.167 0 5.834-1.667 5.834-5.834v-1.666" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.367 2.516 6.8 9.083c-.25.25-.5.742-.55 1.1l-.358 2.508c-.134.909.508 1.542 1.416 1.417l2.509-.358c.35-.05.841-.3 1.1-.55l6.566-6.567c1.134-1.133 1.667-2.45 0-4.117-1.666-1.666-2.983-1.133-4.116 0z" stroke="#56B663" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.425 3.458a5.954 5.954 0 0 0 4.116 4.117" stroke="#56B663" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Practice <span class="practice-toggle-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <div class="practice-submenu">
                    <a href="{{ url('/exam_custom') }}">Custom</a>
                    <a href="{{ url('/series_list') }}">Test Series</a>
                </div>
            </li>
            <li>
                <a href="{{route('mockExamTest')}}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.334 13.95V3.892c0-1-.817-1.742-1.809-1.659h-.05c-1.75.15-4.408 1.042-5.891 1.975l-.142.092a.923.923 0 0 1-.883 0l-.209-.125c-1.483-.925-4.133-1.808-5.883-1.95a1.64 1.64 0 0 0-1.8 1.658V13.95c0 .8.65 1.55 1.45 1.65l.242.033c1.808.242 4.6 1.159 6.2 2.034l.033.016c.225.125.583.125.8 0 1.6-.883 4.4-1.808 6.217-2.05l.275-.033c.8-.1 1.45-.85 1.45-1.65zM10 4.575v12.5M6.458 7.075H4.583M7.083 9.575h-2.5" stroke="#234628" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Mock Exam
                </a>
            </li>
            <li>
                <a href="{{route('live_exam_list')}}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.683 6.626a5.21 5.21 0 0 1 0 7.366 5.21 5.21 0 0 1-7.367 0 5.21 5.21 0 0 1 0-7.366 5.21 5.21 0 0 1 7.367 0zM6.875 18.034a8.241 8.241 0 0 1-4.092-3.55A8.242 8.242 0 0 1 1.74 9.275M4.875 3.733A8.28 8.28 0 0 1 10 1.967c1.892 0 3.633.641 5.033 1.708M13.125 18.034a8.241 8.241 0 0 0 4.092-3.55 8.242 8.242 0 0 0 1.041-5.209" stroke="#234628" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Live Exam
                </a>
            </li>
            <li>
                <a href="{{route('previous_year_exam')}}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 5.834v8.333c0 2.5-1.25 4.167-4.167 4.167H6.667c-2.917 0-4.167-1.667-4.167-4.167V5.834c0-2.5 1.25-4.167 4.167-4.167h6.666c2.917 0 4.167 1.667 4.167 4.167z" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.083 3.75v1.667c0 .916.75 1.666 1.667 1.666h1.666M6.667 10.833H10M6.667 14.167h6.667" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Previous Year Exams
                </a>
            </li>
        </ul>
    </div>
</aside>
<div class="modal fade modal-popup-customize emaillinkholder" id="referfrnd" tabindex="-1">
    <div class="modal-dialog">
        <div class="modalcenter">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6 6 18M6 6l12 12" stroke="#1F1F1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-profile-sec">
                        <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" fill="#E0F6E3" />
                            <g opacity=".5" fill="#56B663">
                                <path d="M29.346 43.02c-2.025.223-3.284.745-4.363 1.817-1.437 1.422-2.003 3.172-2.123 6.553-.089 2.33.231 4.02 1.073 5.696 1.832 3.679 5.413 5.347 8.809 4.11 2.442-.885 4.438-3.35 5.13-6.344.254-1.102.32-1.995.269-3.447-.12-3.396-.685-5.146-2.123-6.568-.916-.909-1.943-1.415-3.41-1.683-.64-.112-2.673-.194-3.262-.134zM25.176 62.56c-3.589.774-5.458 1.6-6.806 3.015-.923.968-1.489 2.152-1.839 3.835-.26 1.274-.387 2.614-.484 5.079-.09 2.554-.134 2.368.663 3.127 2.018 1.929 5.972 3.113 11.333 3.41 7.387.403 13.62-.9 16.248-3.41.79-.752.753-.566.663-3.09-.082-2.137-.164-3.247-.313-4.222-.73-4.699-2.859-6.53-9.025-7.79l-.893-.178-.29.268c-.961.864-2.28 1.303-3.932 1.303-1.006 0-1.631-.111-2.48-.424-.544-.209-1.244-.64-1.534-.953-.216-.231-.104-.231-1.31.03z" />
                            </g>
                            <g opacity=".3" fill="#56B663">
                                <path d="M68.706 50.015c-1.473.162-2.388.541-3.174 1.32-1.045 1.035-1.456 2.308-1.543 4.766-.065 1.695.168 2.925.78 4.143 1.332 2.675 3.937 3.888 6.406 2.99 1.776-.645 3.228-2.438 3.731-4.615.184-.801.233-1.45.195-2.507-.086-2.47-.498-3.742-1.543-4.776-.666-.66-1.414-1.029-2.48-1.224-.466-.081-1.944-.14-2.372-.097zM65.673 64.224c-2.61.563-3.97 1.164-4.95 2.193-.67.704-1.082 1.565-1.337 2.79-.19.925-.281 1.9-.352 3.692-.065 1.858-.097 1.722.482 2.275 1.468 1.402 4.343 2.263 8.242 2.48 5.372.292 9.905-.655 11.816-2.48.574-.547.547-.412.482-2.248-.06-1.554-.119-2.36-.227-3.07-.531-3.417-2.08-4.75-6.563-5.664l-.65-.13-.212.195c-.698.628-1.657.947-2.859.947-.73 0-1.186-.08-1.803-.308-.395-.152-.904-.466-1.116-.694-.157-.167-.075-.167-.953.022z" />
                            </g>
                            <path d="M74.75 30.125a14.665 14.665 0 0 1-1.575 6.65A14.875 14.875 0 0 1 59.875 45c-2.17.006-4.314-.47-6.276-1.392a1.039 1.039 0 0 0-.77-.051l-7.682 2.56a1 1 0 0 1-1.264-1.264l2.56-7.683a1.039 1.039 0 0 0-.05-.77A14.664 14.664 0 0 1 45 30.126a14.875 14.875 0 0 1 8.225-13.3 14.665 14.665 0 0 1 6.65-1.575h.875a14.84 14.84 0 0 1 14 14v.875z" fill="#56B663" />
                            <path d="M61.145 27.25v-3c0-.597-.24-1.169-.67-1.591A2.305 2.305 0 0 0 58.86 22l-3.049 6.75V37h8.597a1.54 1.54 0 0 0 1.004-.357c.28-.234.465-.56.52-.918l1.052-6.75a1.477 1.477 0 0 0-.357-1.21 1.522 1.522 0 0 0-1.167-.515h-4.314zM55.81 37h-1.286c-.404 0-.792-.158-1.078-.44A1.488 1.488 0 0 1 53 35.5v-5.25c0-.398.16-.78.446-1.06.286-.282.674-.44 1.078-.44h1.286" fill="#fff" />
                        </svg>
                        <h2 class="refer-frnd">Refer a Friend</h2>
                    </div>
                    <form id="referalStudent_form" action="{{route('store_referral')}}" method="POST">
                        @csrf
                        <input type="hidden" name="refer_code" id="refer_code" value="{{ session()->get('referal_code') }}">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="text" class="refer_email_input emaillink form-control" placeholder="Email address" id="referEmails" name="refer_emails" autocomplete="off" required>
                        </div>
                        <p class="use-text"><span class="Note">Note:</span>Use comma (,) between two email addresses</p>
                        <p class="invalid-feedback m-0 alert-success errRef p-1 mb-1" id="successRef_auth"> </p>
                        <p class="invalid-feedback m-0 alert-danger errRef p-1" id="errRef_auth"> </p>
                        <div class="_btn-green"><button type="submit" class="btn btn-common-green"> Send Invite</button></div>
                    </form>
                    <div class="bottom-sec">
                        <p class="successRef_copy" style="color:green;"></p>
                        <label for="exampleFormControlInput1" class="form-label">Or Share via link</label>
                        <div class="share-link-input">
                            @php
                            $refer_code = Illuminate\Support\Str::limit(session()->get('referal_link') , 28, $end='...');
                            @endphp
                            <p class="referfriendlink">{{$refer_code}}</p>
                            <input type="share" class="form-control" id="linkInput" value="{{session()->get('referal_link')}}" style="display: none;">
                            <a href="javascript:void(0);" onclick="copylinkfunction()">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.461 9H8.538C7.688 9 7 9.895 7 11v9c0 1.105.689 2 1.538 2h6.923c.85 0 1.539-.895 1.539-2v-9c0-1.105-.689-2-1.539-2z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.308 15h-.77c-.408 0-.799-.21-1.087-.586C2.162 14.04 2 13.53 2 13V4c0-.53.162-1.04.45-1.414C2.74 2.21 3.13 2 3.539 2h6.923c.409 0 .8.21 1.088.586C11.838 2.96 12 3.47 12 4v1" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg> <span style="padding-left:12px">Copy<span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- New Ui Modal for invation -->
<div class="modal fade modal-popup-customize onsendshow" id="referedfrnd" tabindex="-1">
    <div class="modal-dialog">
        <div class="modalcenter">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6 6 18M6 6l12 12" stroke="#1F1F1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-profile-sec">
                        <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" fill="#E0F6E3" />
                            <g opacity=".5" fill="#56B663">
                                <path d="M29.346 43.02c-2.025.223-3.284.745-4.363 1.817-1.437 1.422-2.003 3.172-2.123 6.553-.089 2.33.231 4.02 1.073 5.696 1.832 3.679 5.413 5.347 8.809 4.11 2.442-.885 4.438-3.35 5.13-6.344.254-1.102.32-1.995.269-3.447-.12-3.396-.685-5.146-2.123-6.568-.916-.909-1.943-1.415-3.41-1.683-.64-.112-2.673-.194-3.262-.134zM25.176 62.56c-3.589.774-5.458 1.6-6.806 3.015-.923.968-1.489 2.152-1.839 3.835-.26 1.274-.387 2.614-.484 5.079-.09 2.554-.134 2.368.663 3.127 2.018 1.929 5.972 3.113 11.333 3.41 7.387.403 13.62-.9 16.248-3.41.79-.752.753-.566.663-3.09-.082-2.137-.164-3.247-.313-4.222-.73-4.699-2.859-6.53-9.025-7.79l-.893-.178-.29.268c-.961.864-2.28 1.303-3.932 1.303-1.006 0-1.631-.111-2.48-.424-.544-.209-1.244-.64-1.534-.953-.216-.231-.104-.231-1.31.03z" />
                            </g>
                            <g opacity=".3" fill="#56B663">
                                <path d="M68.706 50.015c-1.473.162-2.388.541-3.174 1.32-1.045 1.035-1.456 2.308-1.543 4.766-.065 1.695.168 2.925.78 4.143 1.332 2.675 3.937 3.888 6.406 2.99 1.776-.645 3.228-2.438 3.731-4.615.184-.801.233-1.45.195-2.507-.086-2.47-.498-3.742-1.543-4.776-.666-.66-1.414-1.029-2.48-1.224-.466-.081-1.944-.14-2.372-.097zM65.673 64.224c-2.61.563-3.97 1.164-4.95 2.193-.67.704-1.082 1.565-1.337 2.79-.19.925-.281 1.9-.352 3.692-.065 1.858-.097 1.722.482 2.275 1.468 1.402 4.343 2.263 8.242 2.48 5.372.292 9.905-.655 11.816-2.48.574-.547.547-.412.482-2.248-.06-1.554-.119-2.36-.227-3.07-.531-3.417-2.08-4.75-6.563-5.664l-.65-.13-.212.195c-.698.628-1.657.947-2.859.947-.73 0-1.186-.08-1.803-.308-.395-.152-.904-.466-1.116-.694-.157-.167-.075-.167-.953.022z" />
                            </g>
                            <path d="M74.75 30.125a14.665 14.665 0 0 1-1.575 6.65A14.875 14.875 0 0 1 59.875 45c-2.17.006-4.314-.47-6.276-1.392a1.039 1.039 0 0 0-.77-.051l-7.682 2.56a1 1 0 0 1-1.264-1.264l2.56-7.683a1.039 1.039 0 0 0-.05-.77A14.664 14.664 0 0 1 45 30.126a14.875 14.875 0 0 1 8.225-13.3 14.665 14.665 0 0 1 6.65-1.575h.875a14.84 14.84 0 0 1 14 14v.875z" fill="#56B663" />
                            <path d="M61.145 27.25v-3c0-.597-.24-1.169-.67-1.591A2.305 2.305 0 0 0 58.86 22l-3.049 6.75V37h8.597a1.54 1.54 0 0 0 1.004-.357c.28-.234.465-.56.52-.918l1.052-6.75a1.477 1.477 0 0 0-.357-1.21 1.522 1.522 0 0 0-1.167-.515h-4.314zM55.81 37h-1.286c-.404 0-.792-.158-1.078-.44A1.488 1.488 0 0 1 53 35.5v-5.25c0-.398.16-.78.446-1.06.286-.282.674-.44 1.078-.44h1.286" fill="#fff" />
                        </svg>
                        <h2 class="refer-frnd">Refer a Friend</h2>
                    </div>
                    <div class="invation-sec">
                        <p><span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="12" fill="#56B663" />
                                    <path d="m7 12.5 3.667 3.5L18 9" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>Invitation sent!
                        </p>
                    </div>

                    <div class="bottom_back-sec">
                        <p class="successRef_copy" style="color:green;"></p>
                        <label class="backtobtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg> Back</label>
                        <a href="javascript:void(0);" class="copy" onclick="copylinkfunction()">
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.461 9H8.538C7.688 9 7 9.895 7 11v9c0 1.105.689 2 1.538 2h6.923c.85 0 1.539-.895 1.539-2v-9c0-1.105-.689-2-1.539-2z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.308 15h-.77c-.408 0-.799-.21-1.087-.586C2.162 14.04 2 13.53 2 13V4c0-.53.162-1.04.45-1.414C2.74 2.21 3.13 2 3.539 2h6.923c.409 0 .8.21 1.088.586C11.838 2.96 12 3.47 12 4v1" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></span> Copy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Test Summary Modal -->
<script>
    var url = window.location.pathname.split("/");
    var action_method = url[1];
    var exam_flow = ['exam_custom', 'series_list', 'mockExamTest', 'previous_year_exam', 'live_exam_list', 'custom_exam', 'exam_result_analytics', 'get_exam_result_analytics', 'custom_exam_chapter', 'custom_exam_topic', 'test_series', 'mock_exam', 'live_exam', 'previousYearExam'];
    console.log(url);
    if (action_method == 'overall_analytics') {
        $('.current_dashboard').removeClass('active');
        $('.current_analytics').addClass('active');
    } else if (action_method == 'planner') {
        $('.current_dashboard').removeClass('active');
        $('.current_planner').addClass('active');
    } else if (exam_flow.includes(action_method)) {
        $('.current_dashboard').removeClass('active');
        $('.current_practice').addClass('active');
    }
    if (action_method == 'profile') {
        $('.user_profile_tab').addClass('active_usericon');
        $('.pro_sub_label').addClass('mobile_active_usericon');
        $('.current_dashboard').removeClass('active');
    } else {
        $('.user_profile_tab').removeClass('active_usericon');
        $('.pro_sub_label').removeClass('mobile_active_usericon');
    }

    function stateHandle() {
        if (document.querySelector(".emaillink").value === "") {
            button.disabled = false;
        } else {
            button.disabled = false;
        }
    }
    $('.current_refer').click(function() {
        $('.mb-4').removeClass('active');
        $('.current_refer').addClass('active');
    })
    $('.btn-close').click(function() {
        if (action_method == 'overall_analytics') {
            $('.current_refer').removeClass('active');
            $('.current_analytics').addClass('active');
        } else if (action_method == 'planner') {
            $('.current_refer').removeClass('active');
            $('.current_planner').addClass('active');
        } else {
            $('.current_dashboard').addClass('active');
            $('.current_refer').removeClass('active');
        }
    });
    $('#referfrnd').on('click', function(e) {
        if (e.target !== this)
            return;
        if (action_method == 'overall_analytics') {
            $('.current_refer').removeClass('active');
            $('.current_analytics').addClass('active');
        } else if (action_method == 'planner') {
            $('.current_refer').removeClass('active');
            $('.current_planner').addClass('active');
        } else {
            $('.current_dashboard').addClass('active');
            $('.current_refer').removeClass('active');
        }

    });
</script>

<script type="text/javascript">
            // (function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
            // for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
            // MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

            // Enabling the debug mode flag is useful during implementation,
            // but it's recommended you remove it for production
            var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
            mixpanel.init(mixpanelid); 


            function openDialog(){
            mixpanel.track('Loaded Refer a Friend');
            }
            
            function copylinkfunction() {


            mixpanel.track('Refer a friend share via link');

        /* Get the text field */
        var copyText = document.getElementById("linkInput");

      

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
        $(".successRef_copy").text("Copied!");
        $(".successRef_copy").show();
        $(".successRef_copy").addClass('showtext');
        setTimeout(function() {
            $(".successRef_copy").text("");
            $(".successRef_copy").hide();
        }, 1000);
    }
</script>
<script>
    $(".backtobtn").click(function() {
        $('#referfrnd').modal('show');
        $('#referedfrnd').modal('hide');
        $(".successRef_copy").text("");
        $(".successRef_copy").hide();
    });

    $(".testsubmenu_open").click(function() {
        $(".main_menu_block").hide();
        $(".submenu_menu_block").show();
    });
    $(".submenu_menu_block .pro_sub_label span").click(function() {
        $(".main_menu_block").show();
        $(".submenu_menu_block").hide();
    });
</script>