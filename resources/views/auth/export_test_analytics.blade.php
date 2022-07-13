@extends('afterlogin.layouts.app_new')
@section('content')

<div class="main-wrapper">
    
    <header>
        <div class="headerMain">
            <div class="headerLeft">
            <h2>Dashboard</h2>
            <h6><label>Cource:</label> <span>JEE</span></h6>
            </div>
            <div class="headerRight">
            <span class="usertext"><a href="javascript:;">Hi Sakshi!</a></span>
            <span class="headericon notificationnew">
                <a draggable="false" id="nodificbell" data-bs-toggle="collapse" href="#collapseNotification2" role="button" aria-expanded="false" aria-controls="collapseNotification" title="Notification">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <g clip-path="url(#5ju4071vya)">
                        <path d="M15 6.768a5 5 0 0 0-10 0c0 5.833-2.5 7.5-2.5 7.5h15S15 12.6 15 6.768zM11.44 17.602a1.666 1.666 0 0 1-2.882 0" stroke="#363C4F" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"></path>
                        <circle cx="14" cy="4.102" r="4" fill="#F7758F" stroke="#fff" stroke-width="2"></circle>
                        </g>
                        <defs>
                        <clipPath id="5ju4071vya">
                            <path fill="#fff" transform="translate(0 .102)" d="M0 0h20v20H0z"></path>
                        </clipPath>
                        </defs>
                    </svg>
                </a>
            </span>
            <span class="headericon dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <path d="M16.666 17.602v-1.667a3.333 3.333 0 0 0-3.333-3.333H6.666a3.333 3.333 0 0 0-3.333 3.333v1.667M10 9.268a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666z" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile &amp; Subscription</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </span>
            </div>
        </div>
    </header>
    <aside>
        <span class="sidebar-logo d-inline-block">
        <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo">
        <span class="custom-border mt-3"></span>
        </span>
        <ul class="sidebar-menu-lists">
            <li class="active mb-4">
            <a href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.746-2.31-2.601-2.31H4.934c-1.855 0-2.601.665-2.601 2.31v5.285c0 1.657.746 2.31 2.601 2.31H9.65c1.855.012 2.601-.653 2.601-2.298zM12.25 23.065v-4.713c0-1.855-.746-2.602-2.601-2.602H4.934c-1.855 0-2.601.747-2.601 2.602v4.713c0 1.855.746 2.602 2.601 2.602H9.65c1.855 0 2.601-.747 2.601-2.602z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.747-2.31-2.602-2.31H4.935c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM12.25 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602H4.935c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="sidebar-menu-tooltip">Dashboard</span>
            </a>
            </li>
            <li class="mb-4 sidebar-exam-menu">
            <a href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#56B663" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#56B663" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="sidebar-menu-tooltip">Practice Test</span>
            </a>
            </li>
            <li class="mb-4">
            <a href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M22 12A10 10 0 0 0 12 2v10h10z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M22 12A10.001 10.001 0 0 0 12 2v10h10z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="sidebar-menu-tooltip">Test Analytics</span>
            </a>
            </li>
            <li class="mb-4">
            <a href="javascript:void(0)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="sidebar-menu-tooltip">Planner</span>
            </a>
            </li>
            <li class="mb-4">
            <a href="#referfrnd" class="openSharefrnd" data-bs-toggle="modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon-active">
                    <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="sidebar-menu-tooltip">Refer a friend</span>
            </a>
            </li>
        </ul>
        <div class="submenu-block">
            <h6 class="mb-5">Exam</h6>
            <ul class="submenu-lists ps-0">
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
                <div class="practice-submenu">
                    <a href="javascript:void(0)">Custom</a>
                    <a href="javascript:void(0)">Test Series</a>
                </div>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.334 13.95V3.892c0-1-.817-1.742-1.809-1.659h-.05c-1.75.15-4.408 1.042-5.891 1.975l-.142.092a.923.923 0 0 1-.883 0l-.209-.125c-1.483-.925-4.133-1.808-5.883-1.95a1.64 1.64 0 0 0-1.8 1.658V13.95c0 .8.65 1.55 1.45 1.65l.242.033c1.808.242 4.6 1.159 6.2 2.034l.033.016c.225.125.583.125.8 0 1.6-.883 4.4-1.808 6.217-2.05l.275-.033c.8-.1 1.45-.85 1.45-1.65zM10 4.575v12.5M6.458 7.075H4.583M7.083 9.575h-2.5" stroke="#234628" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Mock test
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.683 6.626a5.21 5.21 0 0 1 0 7.366 5.21 5.21 0 0 1-7.367 0 5.21 5.21 0 0 1 0-7.366 5.21 5.21 0 0 1 7.367 0zM6.875 18.034a8.241 8.241 0 0 1-4.092-3.55A8.242 8.242 0 0 1 1.74 9.275M4.875 3.733A8.28 8.28 0 0 1 10 1.967c1.892 0 3.633.641 5.033 1.708M13.125 18.034a8.241 8.241 0 0 0 4.092-3.55 8.242 8.242 0 0 0 1.041-5.209" stroke="#234628" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Live
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 5.834v8.333c0 2.5-1.25 4.167-4.167 4.167H6.667c-2.917 0-4.167-1.667-4.167-4.167V5.834c0-2.5 1.25-4.167 4.167-4.167h6.666c2.917 0 4.167 1.667 4.167 4.167z" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.083 3.75v1.667c0 .916.75 1.666 1.667 1.666h1.666M6.667 10.833H10M6.667 14.167h6.667" stroke="#234628" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Previous year exam
                </a>
            </li>
            </ul>
        </div>
    </aside>

    <div class="content-wrapper export_test_analytics_wrapper">
        <div class="container-fluid">
            <div class="mock_inst_text_mock_test mb-4">
                <a href="javascript:void(0)" class="text-decoration-none"><i class="fa fa-angle-left" style="margin-right:8px"></i> Back to Dashboard</a>
            </div>
            <div class="custom_container">
                <h3 class="commonheading">Live Test</h3>
                <div class="row mt-4 mb-4 align-items-end">
                    <div class="col-sm-3">
                        <div class="question-attempted-block">
                            <span class="d-block mb-2 commontext">Question Attempted</span>
                            <label class="m-0 commonboldtext">80/100</label>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="time-date-block">
                            <span class="d-block mb-2 commontext">13 June 2022</span>
                            <p class="m-0">
                                <small class="commontext me-5 pe-4">
                                    <svg  style="vertical-align: sub;" class="me-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.999 22c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M11.999 6v6l4 2" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    60 min
                                </small>
                                <small class="commontext">
                                    <svg  style="vertical-align: sub;" class="me-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.999 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.999 2h-6a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    200 marks
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="commonWhiteBox commonblockDash test_myscrore_card">
                    <h3 class="boxheading d-flex align-items-center">My Score 
                    </h3>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-5">
                            <div class="halfdoughnut2 position-relative">
                                <canvas id="myscoregraph"></canvas>
                                <div class="myScore">
                                    <h6 class="m-0">80/200</h6>
                                    <span>MARKS</span>
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="color_labels d-flex justify-content-between">
                                <span>Correct <b><small></small>60</b></span>
                                <span>Incorrect <b><small></small>20</b></span>
                                <span>Not Attempted <b><small></small>20</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="commonWhiteBox commonblockDash subject_score_card">
                    <h3 class="boxheading d-flex align-items-center">Subject Score </h3>
                    <p class="paratext" style="margin-bottom:32px;">Negative marking for incorrect answers is considered</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h5 class="mb-0">Maths</h5>
                            <div class="d-flex align-items-center">
                                <div class="halfdoughnut">
                                    <canvas id="subjectChart"></canvas>
                                </div>
                                <div class="color_labels ms-5">
                                    <span class="d-block">Correct <b><small></small>32</b></span>
                                    <span class="d-block mt-3 mb-3">Incorrect <b><small></small>4</b></span>
                                    <span class="d-block">Not Attempted <b><small style="background-color: #e5eaee;"></small>4</b></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="mb-0">Physics</h5>
                            <div class="d-flex align-items-center">
                                <div class="halfdoughnut">
                                    <canvas id="subjectChart-1"></canvas>
                                </div>
                                <div class="color_labels ms-5">
                                    <span class="d-block">Correct <b><small></small>32</b></span>
                                    <span class="d-block mt-3 mb-3">Incorrect <b><small></small>4</b></span>
                                    <span class="d-block">Not Attempted <b><small style="background-color: #e5eaee;"></small>4</b></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="mb-0">Chemistry</h5>
                            <div class="d-flex align-items-center">
                                <div class="halfdoughnut">
                                    <canvas id="subjectChart-2"></canvas>
                                </div>
                                <div class="color_labels ms-5">
                                    <span class="d-block">Correct <b><small></small>32</b></span>
                                    <span class="d-block mt-3 mb-3">Incorrect <b><small></small>4</b></span>
                                    <span class="d-block">Not Attempted <b><small style="background-color: #e5eaee;"></small>4</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="commonWhiteBox commonblockDash test_myscrore_card">
                    <h3 class="boxheading d-flex align-items-center">Cut-off’s Comparator </h3>
                    <p class="paratext" style="margin-bottom:25px;">This will compare your test scores with last year 2018 cut-off</p>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-4">
                            <div class="cutoff-score-bar">
                                <div class="box">
                                    <div class="cutoff_chart" data-percent="70" data-scale-color="#ffb400"></div>
                                    <div class="chartwrap">
                                        <div class="cutoff_chart-1" data-percent="25" data-scale-color="#ffb400"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="color_labels d-flex justify-content-between">
                                <span>Correct <b><small></small>60</b></span>
                                <span>Incorrect <b><small></small>20</b></span>
                                <span>Not Attempted <b><small></small>20</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="commonWhiteBox commonblockDash marks_percentage_export_card">
                    <h3 class="boxheading d-flex align-items-center" style="margin-bottom:20px;">Marks Percentage </h3>
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="d-block commontext">Overall percentage</span>
                            <label class="m-0 commonboldtext">64%</label>
                        </div>
                        <div>
                            <span class="d-block commontext">Class Average</span>
                            <label class="m-0 commonboldtext">35%</label>
                        </div>
                    </div>
                    <h3 class="boxheading subheading d-flex align-items-center" style="margin-bottom:16px;">Subject-wise Percentage </h3>
                    <div class="d-flex justify-content-between" style="max-width: 600px;">
                        <div class="sub-wise-per position-relative">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="64" height="64" rx="10" fill="#B5F7E3"/>
                                <path d="M44.688 11.129 20.316 11l12.058 6.809 12.314-6.68z" fill="url(#mu62oufnba)"/>
                                <path d="M44.688 11.129 20.316 11l12.058 6.809 12.314-6.68z" fill="url(#reshfpruvb)"/>
                                <path d="M56.87 31.683 44.43 38.75 32.37 17.809l12.314-6.68 12.186 20.554z" fill="url(#6px5oni96c)"/>
                                <path d="M56.87 31.683 44.43 38.75 32.37 17.809l12.314-6.68 12.186 20.554z" fill="url(#24bpjkehrd)"/>
                                <path d="M8 31.811 20.314 11l12.314 6.809L20.314 38.62 8 31.811z" fill="url(#ltovtaw4we)"/>
                                <path d="M8 31.811 20.314 11l12.314 6.809L20.314 38.62 8 31.811z" fill="url(#o001dtclnf)"/>
                                <path d="M43.918 52.366V38.839l13.084-7.284-13.084 20.811z" fill="url(#l5rdf1l9jg)"/>
                                <path d="M43.918 52.366V38.839l13.084-7.284-13.084 20.811z" fill="url(#ka6zoi6j9h)"/>
                                <path d="M44.3 38.62H20.44v14.002l23.474-.257.385-13.746z" fill="url(#yd4ibw0eli)"/>
                                <path d="M44.3 38.62H20.44v14.002l23.474-.257.385-13.746z" fill="url(#d1zj8k42hj)"/>
                                <path d="M20.442 52.622 8 31.81l12.442 6.808v14.003z" fill="url(#pt5i6yp5kk)"/>
                                <path d="M20.442 52.622 8 31.81l12.442 6.808v14.003z" fill="url(#7h8nj2zvfl)"/>
                                <path d="m20.313 38.618 12.185-20.811 12.186 20.811H20.313z" fill="url(#3kwmy4tk0m)"/>
                                <path d="m20.313 38.618 12.185-20.811 12.186 20.811H20.313z" fill="url(#0wesept4xn)"/>
                                <defs>
                                    <linearGradient id="mu62oufnba" x1="32.566" y1="11.129" x2="32.566" y2="17.809" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#D9D9D9"/>
                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="reshfpruvb" x1="32.566" y1="11.129" x2="32.566" y2="17.809" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#43E1CE"/>
                                        <stop offset="1" stop-color="#2899CA"/>
                                    </linearGradient>
                                    <linearGradient id="6px5oni96c" x1="44.749" y1="11.257" x2="44.749" y2="38.749" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#D9D9D9"/>
                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="24bpjkehrd" x1="44.749" y1="11.257" x2="44.749" y2="38.749" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#43E1CE"/>
                                        <stop offset="1" stop-color="#2899CA"/>
                                    </linearGradient>
                                    <linearGradient id="ltovtaw4we" x1="20.314" y1="11" x2="20.314" y2="38.62" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#D9D9D9"/>
                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="o001dtclnf" x1="20.314" y1="11" x2="20.314" y2="38.62" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#43E1CE"/>
                                        <stop offset="1" stop-color="#2899CA"/>
                                    </linearGradient>
                                    <linearGradient id="l5rdf1l9jg" x1="50.46" y1="31.555" x2="50.46" y2="52.366" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#D9D9D9"/>
                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="ka6zoi6j9h" x1="50.46" y1="31.555" x2="50.46" y2="52.366" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#43E1CE"/>
                                        <stop offset="1" stop-color="#2899CA"/>
                                    </linearGradient>
                                    <linearGradient id="yd4ibw0eli" x1="32.371" y1="38.619" x2="32.371" y2="52.622" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#D9D9D9"/>
                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="d1zj8k42hj" x1="32.371" y1="38.619" x2="32.371" y2="52.622" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#43E1CE"/>
                                        <stop offset="1" stop-color="#2899CA"/>
                                    </linearGradient>
                                    <linearGradient id="pt5i6yp5kk" x1="14.349" y1="32.068" x2="14.349" y2="52.879" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#D9D9D9"/>
                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="7h8nj2zvfl" x1="14.349" y1="32.068" x2="14.349" y2="52.879" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#43E1CE"/>
                                        <stop offset="1" stop-color="#2899CA"/>
                                    </linearGradient>
                                    <linearGradient id="3kwmy4tk0m" x1="32.498" y1="17.807" x2="32.498" y2="38.618" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#D9D9D9"/>
                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="0wesept4xn" x1="32.498" y1="17.807" x2="32.498" y2="38.618" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#43E1CE"/>
                                        <stop offset="1" stop-color="#2899CA"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                            <span class="d-block commontext">Physics</span>
                            <label class="m-0 commonboldtext">14%</label>
                        </div>
                        <div class="sub-wise-per position-relative">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="64" height="64" rx="10" fill="#ECFCCB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.138 12.945a.65.65 0 0 0-1.029.53v27.69c0 .36.292.651.651.651h38.768c.633 0 .893-.812.378-1.18L17.138 12.945zm4.737 8.68a.65.65 0 0 0-1.027.53v15.459c0 .359.291.65.65.65h21.783c.634 0 .894-.814.377-1.181L21.875 21.624z" fill="url(#f3bqxthvua)"/>
                                <path d="M33.17 52.444c-.314 0-.588-.056-.821-.168a1.092 1.092 0 0 1-.515-.504c-.107-.223-.134-.496-.08-.822.047-.28.137-.512.271-.696.136-.183.302-.33.498-.44.199-.112.414-.196.647-.252.236-.056.475-.097.719-.123.297-.03.538-.058.721-.084.185-.026.325-.065.417-.116a.338.338 0 0 0 .169-.246v-.02c.038-.243 0-.432-.117-.566-.116-.133-.31-.2-.582-.2a1.3 1.3 0 0 0-.718.187 1.181 1.181 0 0 0-.424.444l-1.061-.156a2.13 2.13 0 0 1 .55-.757c.233-.205.501-.358.805-.46a3.042 3.042 0 0 1 1.676-.07c.228.056.43.148.605.278.177.127.306.3.388.52.084.22.098.496.042.826l-.553 3.325H34.68l.117-.682h-.04a1.79 1.79 0 0 1-.361.388 1.836 1.836 0 0 1-.531.288 2.112 2.112 0 0 1-.696.106zm.444-.86a1.345 1.345 0 0 0 1.097-.514c.12-.156.196-.325.226-.508l.097-.586a.697.697 0 0 1-.2.084 2.95 2.95 0 0 1-.305.068c-.11.02-.219.037-.327.052l-.278.039a2.346 2.346 0 0 0-.492.116.993.993 0 0 0-.365.227.647.647 0 0 0-.178.369c-.035.213.016.376.152.488.136.11.327.165.573.165z" fill="#39BD9E"/>
                                <path d="m7 33.114 1.1-6.626h1.17l-.407 2.478h.052c.078-.12.182-.249.314-.385a1.695 1.695 0 0 1 1.252-.501c.384 0 .714.098.99.294.276.194.473.482.592.864.118.38.132.845.042 1.398-.09.545-.257 1.009-.498 1.39a2.59 2.59 0 0 1-.877.874c-.343.2-.71.3-1.1.3-.285 0-.513-.047-.686-.142-.17-.094-.3-.209-.391-.342a1.675 1.675 0 0 1-.198-.385h-.074l-.13.782H7zm1.562-2.485a2.36 2.36 0 0 0-.003.844c.052.242.153.43.304.566.153.134.355.201.605.201.257 0 .483-.069.68-.207.198-.14.362-.331.491-.573.13-.243.22-.52.272-.831.05-.308.05-.582 0-.822a.981.981 0 0 0-.3-.563c-.152-.135-.357-.203-.615-.203a1.18 1.18 0 0 0-.673.197c-.197.132-.36.316-.489.553-.13.237-.22.517-.272.838z" fill="#39BDA1"/>
                                <path d="M16.273 50.123h13.014" stroke="#38B87B" stroke-width=".651"/>
                                <path fill="#D4F4B9" stroke="#38B87B" stroke-width=".651" d="m16.06 49.366.84.841-.84.84-.842-.84z"/>
                                <path stroke="#38B87B" stroke-width=".651" d="M39.535 50.239h16.918"/>
                                <path fill="#D4F4B9" stroke="#38B87B" stroke-width=".651" d="m55.7 49.366.84.84-.84.841-.841-.84z"/>
                                <path d="M9.496 41.185V35.08" stroke="#38B87B" stroke-width=".651"/>
                                <path fill="#D4F4B9" stroke="#38B87B" stroke-width=".651" d="m8.74 41.4.842-.841.84.84-.84.841z"/>
                                <path stroke="#38B87B" stroke-width=".651" d="M9.612 24.196V12.547"/>
                                <path fill="#D4F4B9" stroke="#38B87B" stroke-width=".651" d="m8.741 13.302.841-.84.84.84-.84.84z"/>
                                <defs>
                                    <linearGradient id="f3bqxthvua" x1="17.493" y1="15.053" x2="49.914" y2="41.723" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#3ABFB0"/>
                                        <stop offset="1" stop-color="#37B66B"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                            <span class="d-block commontext">Maths</span>
                            <label class="m-0 commonboldtext">26%</label>
                        </div>
                        <div class="sub-wise-per position-relative">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="64" height="64" rx="10" fill="#C2F3F2"/>
                                <circle cx="43.907" cy="13.841" r="6.501" fill="url(#pwzgqmqfpa)"/>
                                <circle cx="14.978" cy="39.3" r="6.501" fill="url(#b7n7hmthcb)"/>
                                <circle cx="49.501" cy="50.157" r="6.501" fill="url(#4b6hevuegc)"/>
                                <path stroke="url(#amisrijw7d)" stroke-width="4.821" stroke-linecap="round" d="m19.655 37.124 9.552-3.057"/>
                                <path stroke="url(#8l98bw4eoe)" stroke-width="4.821" stroke-linecap="round" d="m38.31 26.846 4.201-9.956"/>
                                <path stroke="url(#fofl2fyeaf)" stroke-width="4.821" stroke-linecap="round" d="m42.937 40.259 4.113 6.173"/>
                                <circle cx="35.599" cy="33.119" r="10.088" fill="url(#6i9lj4elig)"/>
                                <defs>
                                    <linearGradient id="pwzgqmqfpa" x1="43.907" y1="7.34" x2="43.907" y2="20.342" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#78F8E1"/>
                                        <stop offset="1" stop-color="#099F7B"/>
                                    </linearGradient>
                                    <linearGradient id="b7n7hmthcb" x1="14.978" y1="32.799" x2="14.978" y2="45.801" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#78F8E1"/>
                                        <stop offset="1" stop-color="#099F7B"/>
                                    </linearGradient>
                                    <linearGradient id="4b6hevuegc" x1="49.501" y1="43.656" x2="49.501" y2="56.658" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#78F8E1"/>
                                        <stop offset="1" stop-color="#099F7B"/>
                                    </linearGradient>
                                    <linearGradient id="amisrijw7d" x1="23.98" y1="33.587" x2="25.123" y2="38.918" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#fff"/>
                                        <stop offset="1" stop-color="#DDC7C7"/>
                                    </linearGradient>
                                    <linearGradient id="8l98bw4eoe" x1="38.596" y1="20.894" x2="43.402" y2="23.475" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#fff"/>
                                        <stop offset="1" stop-color="#DDC7C7"/>
                                    </linearGradient>
                                    <linearGradient id="fofl2fyeaf" x1="46.783" y1="42.334" x2="41.929" y2="44.791" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#fff"/>
                                        <stop offset="1" stop-color="#DDC7C7"/>
                                    </linearGradient>
                                    <linearGradient id="6i9lj4elig" x1="45.815" y1="40.719" x2="30.54" y2="25.161" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#3776D5"/>
                                        <stop offset="1" stop-color="#37D5CF"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                            <span class="d-block commontext">Chemistry</span>
                            <label class="m-0 commonboldtext">32%</label>
                        </div>
                    </div>
                </div>
                <div class="commonWhiteBox commonblockDash efficiency_time_card">
                    <h3 class="boxheading">Efficiency - Time spent </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="avgTime">
                                <span class="d-block  commontext" style="color:#666;margin-bottom:4px;">Average time/ Question</span>
                                <label class="d-block">7<sub>sec</sub></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex efficiency_time_taken">
                                <div class="efficiency_time_bar">
                                    <canvas id="progressChart"></canvas>
                                </div>
                                <div class="avgTime">
                                    <span class="d-block  commontext" style="color:#666;margin-bottom:4px;margin-top: 14px;">Time taken</span>
                                    <label class="d-block" style="font-size: 20px;font-weight: 600;color:#000;">172/180<small style="font-size: 16px;font-weight: 500; color: #666;">mins</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="commonWhiteBox commonblockDash export_rank_card">
                        <h3 class="boxheading">Rank Analysis </h3>
                        <div class="d-flex justify-content-between mt-4">
                            <div class="your_rank position-relative" style="padding-left: 66px;">
                                <small>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 15a7 7 0 1 0 0-14 7 7 0 0 0 0 14z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.21 13.89 7 23l5-3 5 3-1.21-9.12" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </small>
                                <span class="d-block  commontext">Your rank</span>
                                <label class="m-0 commonboldtext" style="font-size:32px;">3<sub style="font-size: 16px;font-weight: 500;">rd</sub></label>
                            </div>
                            <div class="total_participants">
                                <span class="d-block commontext">Total Participants</span>
                                <label class="m-0 commonboldtext" style="font-size:32px;">15</label>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
<script> 
/************* subject *******/
const circuference = 260;
const data = {
  labels: ["Correct", "Incorrect", "Not Attempted"],
  datasets: [
    {
      label: "My First Dataset",
      data: [200, 100, 80],
      backgroundColor: [
        "#08d5a1",
        "#fb7686",
        "#f2f4f7"
      ]
    }
  ]
};
const config = {
  type: "doughnut",
  data: data,
  options: {   
    reponsive: true,
    maintainAspectRatio: false,
    rotation: (circuference / 2) * -1,
    circumference: circuference,
    cutout: "60%",
    borderWidth: 0,
    borderRadius: function (context, options) {
      const index = context.dataIndex;
      let radius = {};
      if (index == 0) {
        radius.innerStart = 0;
        radius.outerStart = 0;
      }
      if (index === context.dataset.data.length - 1) {
        radius.innerEnd = 0;
        radius.outerEnd = 0;
      }
      return radius;
    },
    plugins: {
      title: false,
      subtitle: false,
      legend: false
    },
  }
};
const myCharted = new Chart("subjectChart", config)

/*******subject-1**********/
const circuference_1 = 260;
const data_1 = {
  labels: ["Correct", "Incorrect", "Not Attempted"],
  datasets: [
    {
      label: "My First Dataset",
      data: [200, 100, 80],
      backgroundColor: [
        "#08d5a1",
        "#fb7686",
        "#f2f4f7"
      ]
    }
  ]
};
const config_1 = {
  type: "doughnut",
  data: data,
  options: {   
    reponsive: true,
    maintainAspectRatio: false,
    rotation: (circuference / 2) * -1,
    circumference: circuference,
    cutout: "60%",
    borderWidth: 0,
    borderRadius: function (context, options) {
      const index = context.dataIndex;
      let radius = {};
      if (index == 0) {
        radius.innerStart = 0;
        radius.outerStart = 0;
      }
      if (index === context.dataset.data.length - 1) {
        radius.innerEnd = 0;
        radius.outerEnd = 0;
      }
      return radius;
    },
    plugins: {
      title: false,
      subtitle: false,
      legend: false
    },
  }
};
const myCharted_1 = new Chart("subjectChart-1", config_1)

/********Subject-2*********/
const circuference_2 = 260;
const data_2 = {
  labels: ["Correct", "Incorrect", "Not Attempted"],
  datasets: [
    {
      label: "My First Dataset",
      data: [200, 100, 80],
      backgroundColor: [
        "#08d5a1",
        "#fb7686",
        "#f2f4f7"
      ]
    }
  ]
};
const config_2 = {
  type: "doughnut",
  data: data,
  options: {   
    reponsive: true,
    maintainAspectRatio: false,
    rotation: (circuference / 2) * -1,
    circumference: circuference,
    cutout: "60%",
    borderWidth: 0,
    borderRadius: function (context, options) {
      const index = context.dataIndex;
      let radius = {};
      if (index == 0) {
        radius.innerStart = 0;
        radius.outerStart = 0;
      }
      if (index === context.dataset.data.length - 1) {
        radius.innerEnd = 0;
        radius.outerEnd = 0;
      }
      return radius;
    },
    plugins: {
      title: false,
      subtitle: false,
      legend: false
    },
  }
};
const myCharted_2 = new Chart("subjectChart-2", config_2)

/***********my-score************************* */
const myscorecir = 260;
const myscoredata = {
  labels: ["Correct", "Incorrect", "Not Attempted"],
  datasets: [
    {
      label: "My First Dataset",
      data: [200, 100, 80],
      backgroundColor: [
        "#08d5a1",
        "#fb7686",
        "#f2f4f7"
      ]
    }
  ]
};
const myscoreconfig = {
  type: "doughnut",
  data: data,
  options: {   
    reponsive: true,
    maintainAspectRatio: false,
    rotation: (circuference / 2) * -1,
    circumference: circuference,
    cutout: "85%",
    borderWidth: 0,
    borderRadius: function (context, options) {
      const index = context.dataIndex;
      let radius = {};
      if (index == 0) {
        radius.innerStart = 20;
        radius.outerStart = 20;
      }
      if (index === context.dataset.data.length - 1) {
        radius.innerEnd = 20;
        radius.outerEnd = 20;
      }
      return radius;
    },
    plugins: {
      title: false,
      subtitle: false,
      legend: false
    },
  }
};
const myscore = new Chart("myscoregraph", myscoreconfig)

/********* Efficiency - Time spent progress - start ************/
const circuference9 = 180; // deg

const data9 = {
  labels: ["Progress"],
  datasets: [
    {
      label: "My First Dataset",
      data: [100, 50],
      backgroundColor: [
        "#56b663",
        "#f2f4f7"
      ]
    }
  ]
};

const config9 = {
  type: "doughnut",
  data: data9,
  options: {   
    reponsive: true,
    maintainAspectRatio: false,
    rotation: (circuference9 / 2) * -1,
    circumference: circuference9,
    cutout: "65%",
    borderWidth: 0,
    borderRadius: function (context, options) {
      const index = context.dataIndex;
      let radius = {};
      if (index == 0) {
        radius.innerStart = 0;
        radius.outerStart = 0;
      }
      if (index === context.dataset.data.length - 1) {
        radius.innerEnd = 0;
        radius.outerEnd = 0;
      }
      return radius;
    },
    plugins: {
      title: false,
      subtitle: false,
      legend: false
    },
  }
};

const myChart9 = new Chart("progressChart", config9);

/*********** Cut-off’s Progress bar *****************/
$(function() {
  $('.cutoff_chart').easyPieChart({
    size: 144,
    barColor: "#08d5a1",
    scaleLength: 0,
    lineWidth: 15,
    trackColor: "#f2f4f7",
    lineCap: "round",
    animate: 2000,
  });
  $('.cutoff_chart-1').easyPieChart({
    size: 95,
    barColor: "#7db9ff",
    scaleLength: 0,
    lineWidth: 15,
    trackColor: "#fff",
    lineCap: "round",
    animate: 2000,
  });
});
</script>  

@endsection