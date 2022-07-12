
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

    <div class="content-wrapper test_analytics_wrapper">
            <div class="tabMainblock">
                <div class="commontab aeck_commontab">
                    <div class="tablist">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link qq1_2_3_4 active" data-bs-toggle="tab" href="#overall">Overall Analytics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#math">Math</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#physics">Physics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#chemistry">Chemistry</a>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content aect_tabb_contantt">
                        <div id="overall" class=" tab-pane active">
                            <div class="overallmain">
                                <div class="overalltop">    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="commonWhiteBox">
                                                    <h3 class="boxheading d-flex align-items-center mb-5">Progress
                                                    <span class="tooltipmain">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                            <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                            </g>
                                                        </svg>
                                                        <p class="tooltipclass">
                                                            <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                                        </p>
                                                    </span>
                                                    </h3>
                                                <div class="overall_percentage_chart">
                                                    <canvas id="myChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="commonWhiteBox">
                                            <div class="subjectperform">
                                                    <h3 class="boxheading d-flex align-items-center">Subject Performance 
                                                            <span class="tooltipmain ml-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"> <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"></path></g></svg>
                                                                <p class="tooltipclass">
                                                                        <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                                            This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                                                        </p>
                                                            </span>
                                                    </h3>
                                                    <div class="subjectperformLegend flexleg">
                                                        <div class="commonSubjectLeg">
                                                            <span class="bar greenbar"></span>
                                                            <label class="text">Correct answer</label>
                                                        </div>  
                                                        <div class="commonSubjectLeg">
                                                            <span class="bar pinkbar"></span>
                                                            <label class="text">Incorrect answer</label>
                                                        </div>  
                                                        <div class="commonSubjectLeg">
                                                            <span class="bar graybar"></span>
                                                            <label class="text">Unattempted questions</label>
                                                        </div>  
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="subjectblockOverall">
                                                                <div class="textblock">
                                                                    <h3>Maths</h3>
                                                                    <h5>Proficiency</h5>
                                                                    <h6>64%</h6>
                                                                </div>
                                                                <div class="halfdoughnutsmall">
                                                                        <canvas id="subjectChart" ></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="subjectblockOverall">
                                                                <div class="textblock">
                                                                    <h3>Chemistry</h3>
                                                                    <h5>Proficiency</h5>
                                                                    <h6>42%</h6>
                                                                </div>
                                                                <div class="halfdoughnutsmall">
                                                                        <canvas id="subjectChart-1" ></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="subjectblockOverall">
                                                                <div class="textblock">
                                                                    <h3>Physics</h3>
                                                                    <h5>Proficiency</h5>
                                                                    <h6>84%</h6>
                                                                </div>
                                                                <div class="halfdoughnutsmall">
                                                                        <canvas id="subjectChart-2" ></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overallMidlle">
                                    <div class="commonWhiteBox">
                                    <h3 class="boxheading">Time Management
                                            <span class="tooltipmain">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                    </g>
                                                </svg>
                                                <p class="tooltipclass">
                                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                    This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                                </p>
                                            </span>
                                        </h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="timemanagement common_greenbadge_tabs">
                                                    <h4 class="garphsubheading mt-2">Time for correct/incorrect answer</h4>
                                                    <div class="barwithTAb">
                                                        <div class="subjectperformLegend ">
                                                                <div class="commonSubjectLeg">
                                                                    <span class="bar greenbar"></span>
                                                                    <label class="text">Class Average</label>
                                                                </div>  
                                                                <div class="commonSubjectLeg">
                                                                    <span class="bar pinkbar"></span>
                                                                    <label class="text">Student average</label>
                                                                </div> 
                                                            </div>
                                                            <div class="righttabBlock">
                                                                <ul class="nav nav-pills mb-4 d-inline-flex mt-4" id="marks-tab3" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                        <button class="nav-link btn active" id="pills-Day-tab" data-bs-toggle="pill" data-bs-target="#pills-Day" type="button" role="tab" aria-controls="pills-Day" aria-selected="true">Day</button>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                        <button class="nav-link btn" id="pills-Week-tab" data-bs-toggle="pill" data-bs-target="#pills-Week" type="button" role="tab" aria-controls="pills-Week" aria-selected="false">Week</button>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                        <button class="nav-link btn" id="pills-Month-tab" data-bs-toggle="pill" data-bs-target="#pills-Month" type="button" role="tab" aria-controls="pills-Month" aria-selected="false">Month</button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                    </div> 
                                                    <div class="tab-content" id="pills-tabContent">
                                                        <div class="tab-pane fade show active" id="pills-Day" role="tabpanel" aria-labelledby="pills-Day-tab">
                                                            
                                                            <div>
                                                                <canvas id="timeManagementChart"></canvas>
                                                            </div>    

                                                        </div>
                                                        <div class="tab-pane fade" id="pills-Week" role="tabpanel" aria-labelledby="pills-Week-tab">Week</div>
                                                        <div class="tab-pane fade" id="pills-Month" role="tabpanel" aria-labelledby="pills-Month-tab">Month</div>
                                                    </div>       
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="timemanagement">
                                                    <h4 class="garphsubheading">Time spent on each question <span>(in Last week)</span></h4>
                                                    <div class="subjectperformLegend ">
                                                        <div class="commonSubjectLeg spaceright">
                                                            <span class="bar bluebar"></span>
                                                            <label class="text">Class Average</label>
                                                        </div>  
                                                        <div class="commonSubjectLeg spaceright">
                                                            <span class="bar greenbar"></span>
                                                            <label class="text">Student average</label>
                                                        </div> 
                                                    </div>
                                                    <div class="chartspent">
                                                        <canvas id="timeSpent_Graph"></canvas>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div> 
                                    </div>
                               </div>  
                               <div class="overallMidlle">
                                    <div class="commonWhiteBox">
                                    <h3 class="boxheading">Marks Trends
                                            <span class="tooltipmain">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                                    </g>
                                                </svg>
                                                <p class="tooltipclass">
                                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                                    This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                                </p>
                                            </span>
                                        </h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="timemanagement common_greenbadge_tabs">
                                                    <h4 class="garphsubheading mt-2">Correct and Incorrect answers</h4>
                                                    <div class="barwithTAb">
                                                        <div class="subjectperformLegend ">
                                                                <div class="commonSubjectLeg">
                                                                    <span class="bar greenbar"></span>
                                                                    <label class="text">Class Average</label>
                                                                </div>  
                                                                <div class="commonSubjectLeg">
                                                                    <span class="bar pinkbar"></span>
                                                                    <label class="text">Student average</label>
                                                                </div> 
                                                            </div>
                                                            <div class="righttabBlock">
                                                                <ul class="nav nav-pills mb-4 d-inline-flex mt-4" id="marks-tab2" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                        <button class="nav-link btn active" id="pills-Day2-tab" data-bs-toggle="pill" data-bs-target="#pills-Day2" type="button" role="tab" aria-controls="pills-Day2" aria-selected="true">Day</button>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                        <button class="nav-link btn" id="pills-Week2-tab" data-bs-toggle="pill" data-bs-target="#pills-Week2" type="button" role="tab" aria-controls="pills-Week2" aria-selected="false">Week</button>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                        <button class="nav-link btn" id="pills-Month2-tab" data-bs-toggle="pill" data-bs-target="#pills-Month2" type="button" role="tab" aria-controls="pills-Month2" aria-selected="false">Month</button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                    </div> 
                                                    <div class="tab-content" id="pills-tabContent2">
                                                        <div class="tab-pane fade show active" id="pills-Day2" role="tabpanel" aria-labelledby="pills-Day2-tab">
                                                         <div class="chartspent">
                                                            <canvas id="mark_trend"></canvas>
                                                        </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="pills-Week2" role="tabpanel" aria-labelledby="pills-Week2-tab">Week2</div>
                                                        <div class="tab-pane fade" id="pills-Month2" role="tabpanel" aria-labelledby="pills-Month2-tab">Month2</div>
                                                    </div>       
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="timemanagement">
                                                    <h4 class="garphsubheading">Accuracy Percentage <span>(in Last week)</span></h4>
                                                    <div class="subjectperformLegend ">
                                                        <div class="commonSubjectLeg spaceright">
                                                            <span class="bar bluebar"></span>
                                                            <label class="text">Class Average</label>
                                                        </div>  
                                                        <div class="commonSubjectLeg spaceright">
                                                            <span class="bar greenbar"></span>
                                                            <label class="text">Student average</label>
                                                        </div> 
                                                    </div>
                                                    <div class="chartspent">
                                                        <canvas id="accuracy_graph"></canvas>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div> 
                                    </div>
                               </div>    
                            <div id="math" class=" tab-pane">sdfsf</div>
                            <div id="physics" class=" tab-pane">sdfsf</div>

                            <div id="chemistry" class=" tab-pane">sdfsf</div>

                    </div>
                </div>
            </div>
          <div>
        </div>
    </div>
</div>    

<script>
/*********** BarChart ***********/
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Previous Score', 'Latest score'],
        datasets: [{
            data: [12, 22, 50],
            label: '',
            backgroundColor: [
                '#6ee7b7',
                '#56b663'
            ],
            barPercentage: 5,
            barThickness: 80,
            maxBarThickness: 80
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                    grid: {
                    display: false
                    }
            },

            y: {
                beginAtZero: true
            }
        }
    }
});

/***************** halfdoughnut - start *********************/
const circuference = 180;
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



/***************** halfdoughnut - end *********************/
/*******spent-time-graph*********/
        const data1 = {
            labels: ['13 May', '14 May','15 May','16 May','17 May'],
            datasets: [{
                    label: 'Ideal Pace',
                    backgroundColor: '#56b663',
                    borderColor: '#56b663',
                    data:[20,30,10,20,50],
                    borderwidth: 0.6,
                    tension: 0.4
                },
                {
                    label: 'Your Pace',
                    backgroundColor: '#7db9ff',
                    borderColor: '#7db9ff',
                    data:[0,60,30,40,50],
                    borderwidth: 0.6,
                    tension: 0.4
                }
            ]
        };

        const config1 = {
            type: 'line',
            data: data1,
            options: {
                responsive: true,
                elements: {
                    point: {
                        radius: 0
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Line Chart - Cubic interpolation mode'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    }

                }
            }
        };

        const myChart1 = new Chart(
            document.getElementById('timeSpent_Graph'),
            config1
        );
/*******spent-time-graph-end*********/
/*******accuracy-graph*********/
const data2 = {
            labels: ['13 May', '14 May','15 May','16 May','17 May'],
            datasets: [{
                    label: 'Ideal Pace',
                    backgroundColor: '#56b663',
                    borderColor: '#56b663',
                    data:[20,30,10,20,50],
                    borderwidth: 0.6,
                    tension: 0.4
                },
                {
                    label: 'Your Pace',
                    backgroundColor: '#7db9ff',
                    borderColor: '#7db9ff',
                    data:[0,60,30,40,50],
                    borderwidth: 0.6,
                    tension: 0.4
                }
            ]
        };

        const config2 = {
            type: 'line',
            data: data2,
            options: {
                responsive: true,
                elements: {
                    point: {
                        radius: 0
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Line Chart - Cubic interpolation mode'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    }

                }
            }
        };

        const myChart2 = new Chart(
            document.getElementById('accuracy_graph'),
            config2
        );
/*******accuracy-graph-end*********/
/*******mark-graph-graph*********/
const data3 = {
            labels: ['13 May', '14 May','15 May','16 May','17 May'],
            datasets: [{
                    label: 'Ideal Pace',
                    backgroundColor: '#56b663',
                    borderColor: '#56b663',
                    data:[20,25,20,30,20],
                    borderwidth: 0.6,
                    tension: 0.4
                },
                {
                    label: 'Your Pace',
                    backgroundColor: '#ff6678',
                    borderColor: '#ff6678',
                    data:[10,8,10,20,15,10],
                    borderwidth: 0.6,
                    tension: 0.4
                }
            ]
        };

        const config3 = {
            type: 'line',
            data: data3,
            options: {
                responsive: true,
                elements: {
                    point: {
                        radius: 0
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Line Chart - Cubic interpolation mode'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    }

                }
            }
        };

        const myChart3 = new Chart(
            document.getElementById('mark_trend'),
            config3
        );
/*******mark-graph-end*********/

/************* Time management bar chart  *************/
const labelsT = ['13 May','14 May','15 May','16 May','17 May','18 May','19 May','20 May'];
const dataT = {
  labels: labelsT,
  datasets: [
    {
      label: 'Correct Answers',
      data: "20",
      backgroundColor:'#34d399',
      barThickness: 32
    },
    {
      label: 'Incorrect Answers',
      data: "10",
      backgroundColor: '#f7758f',
      barThickness: 32
    },
  ]
};
const configT = {
  type: 'bar',
  data: dataT,
  options: {
    plugins: {
      title: {
        display: false,
        text: 'Chart.js Bar Chart - Stacked'
      },
      legend: false
    },
    responsive: true,
    scales: {
      x: {
        stacked: true,
      },
      y: {
        stacked: true
      }
    }
  }
};

const DATA_COUNT = 7;
const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

const actions = [
  {
    name: 'Randomize',
    handler(chart) {
      chart.data.datasets.forEach(dataset => {
        dataset.data = Utils.numbers({count: chart.data.labels.length, min: -100, max: 100});
      });
      chart.update();
    }
  },
];

var myChartT = new Chart(
    document.getElementById('timeManagementChart'),
    configT
  );



</script>   

@endsection