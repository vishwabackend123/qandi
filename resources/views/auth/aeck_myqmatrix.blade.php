@extends('layouts.app')
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
                    <a draggable="false" id="nodificbell" data-bs-toggle="collapse" href='#collapseNotification2' role="button" aria-expanded="false" aria-controls="collapseNotification" title="Notification">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <g clip-path="url(#5ju4071vya)">
                                <path d="M15 6.768a5 5 0 0 0-10 0c0 5.833-2.5 7.5-2.5 7.5h15S15 12.6 15 6.768zM11.44 17.602a1.666 1.666 0 0 1-2.882 0" stroke="#363C4F" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="14" cy="4.102" r="4" fill="#F7758F" stroke="#fff" stroke-width="2" />
                            </g>
                            <defs>
                                <clipPath id="5ju4071vya">
                                    <path fill="#fff" transform="translate(0 .102)" d="M0 0h20v20H0z" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </span>
                <span class="headericon">
                    <a href="javascript:;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <path d="M16.666 17.602v-1.667a3.333 3.333 0 0 0-3.333-3.333H6.666a3.333 3.333 0 0 0-3.333 3.333v1.667M10 9.268a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666z" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
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
                        <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.746-2.31-2.601-2.31H4.934c-1.855 0-2.601.665-2.601 2.31v5.285c0 1.657.746 2.31 2.601 2.31H9.65c1.855.012 2.601-.653 2.601-2.298zM12.25 23.065v-4.713c0-1.855-.746-2.602-2.601-2.602H4.934c-1.855 0-2.601.747-2.601 2.602v4.713c0 1.855.746 2.602 2.601 2.602H9.65c1.855 0 2.601-.747 2.601-2.602z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>
            <li class="mb-4">
                <a href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                        <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>
            <li class="mb-4">
                <a href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 12A10 10 0 0 0 12 2v10h10z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>
            <li class="mb-4">
                <a href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>
            <li class="mb-4">
                <a href="#sharefrnd" class="openSharefrnd" data-bs-toggle="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>
        </ul>
    </aside>
    <div class="content-wrapper aeck_mqmatrix_wrapper">
        <div class="aeck_text_back_to_analytics"><a href="#">
            <span><</span>Back to Analytics</a></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="commonWhiteBox">
                        <div class="boxHeadingBlock">
                            <h3 class="boxheading">MyQ Matrix
                                <span class="tooltipmain">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                        <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                        </g>
                                    </svg>
                                    <p class="tooltipclass">
                                        <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                        This card represents a combination of your skill, expertise, and knowledge in
                                        the topics you have attempted. Build your proficiencies!
                                    </p>
                                </span>
                            </h3>
                            <p class="dashSubtext">Supporting text for better interaction on this section</p>
                        </div>
                        <div class="MyqMatrixMain mt-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="myqmatPanneaeck myqcolorenvSec1">
                                        <div class="aeck_Evaluation_text aeck_myqcolorenvl">
                                            <h6>Evaluation</h6>
                                        </div>
                                        <div class="aeck_myqinner_p">
                                            <p>Evaluation tells you your problem solving skills.
                                            </p>
                                        </div>
                                        <div class="myqbottomSec aeck_myqbottomSec">
                                            <h3>12 <span class="topictext">Topics</span></h3>
                                            <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="myqmatPanneaeck myqcolorenvSec2">
                                        <div class="aeck_Evaluation_text aeck_myqcolorenv2">
                                            <h6>Application</h6>
                                        </div>
                                        <div class="aeck_myqinner_p">
                                            <p>Application tells you your problem solving skills.
                                            </p>
                                        </div>
                                        <div class="myqbottomSec aeck_myqbottomSec">
                                            <h3>21 <span class="topictext">Topics</span></h3>
                                            <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="myqmatPanneaeck myqcolorenvSec3">
                                        <div class="aeck_Evaluation_text aeck_myqcolorenv3">
                                            <h6>Comprehension</h6>
                                        </div>
                                        <div class="aeck_myqinner_p">
                                            <p>Comprehension tells you your problem solving skills.
                                            </p>
                                        </div>
                                        <div class="myqbottomSec aeck_myqbottomSec">
                                            <h3>32 <span class="topictext">Topics</span></h3>
                                            <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="myqmatPanneaeck myqcolorenvSec4">
                                        <div class="aeck_Evaluation_text aeck_myqcolorenv4">
                                            <h6>Knowledge</h6>
                                        </div>
                                        <div class="aeck_myqinner_p">
                                            <p>Knowledge tells you your problem solving skills.
                                            </p>
                                        </div>
                                        <div class="myqbottomSec aeck_myqbottomSec">
                                            <h3>13 <span class="topictext">Topics</span></h3>
                                            <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 fortab">
                    <div class="commonWhiteBox">
                        <div class="tabMainblock">
                            <div class="commontab aeck_commontab">
                                <div class="tablist">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4 active" data-bs-toggle="tab" href="#evaluation">Evaluation</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#application">Application</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#complrehension">Complrehension</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#knowledge">Knowledge</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content aect_tabb_contantt">
                                    <div id="evaluation" class=" tab-pane active">
                                        <!-- <div class="d-flex justify-content-between align-items-center aeck_top_of_table_right_left_btn">
                                                <div class="aeck_chapter_topic_btn">
                                                    <div class="btn-group aeck_btn_group_left">
                                                        <a href="#" class="btn active" aria-current="page">Chapters</a>
                                                        <a href="#" class="btn btn-primary">Topics</a>
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="">
                                                        <button class="btn aeck_filter_btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="M5 10h10M2.5 5h15m-10 10h5" stroke="#56B663" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        </button>
                                                        <button class="btn aeck_polish_strength_btn">Polish Strenghts</button>
                                                    </div>
                                                </div>    
                                            </div> -->
                                        <div class="aeck_tab_in_tab_chapter_topic">
                                            <div class="mb-4 mt-4 align-items-center d-flex justify-content-between align-items-center aeck_tab_in_tab_chapter_topic_section">
                                                <div>
                                                    <ul class="nav nav-pills  d-inline-flex" id="topic-tab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn active" id="pills-chapters-tab" data-bs-toggle="pill" data-bs-target="#pills-chapters" type="button" role="tab" aria-controls="pills-chapters" aria-selected="true">Chapters</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link btn" id="pills-opics-tab" data-bs-toggle="pill" data-bs-target="#pills-topics" type="button" role="tab" aria-controls="pills-topics" aria-selected="false">Topics</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div>
                                                    <button class="btn aeck_filter_btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="M5 10h10M2.5 5h15m-10 10h5" stroke="#56B663" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                    <button class="btn aeck_polish_strength_btn">Polish Strenghts</button>
                                                </div>
                                            </div>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade active show" id="pills-chapters" role="tabpanel" aria-labelledby="pills-mathssub-tab">
                                                    <div class="exam_instruction_scrolling aeck_table_scrolling">
                                                        <table class="table mymatrix_table eack_table_mymq">
                                                            <tbody>
                                                                <tr class="aeck_table_tr">
                                                                    <td class="mymatrix_table_point">
                                                                        <input type="radio"><span>Chemical Equilibrium</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="mymatrix_proficiency">Proficiency : </span><span><b>65%</b></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mymatrix_table_point">
                                                                        <input type="radio"><span>Complex Numbers</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="mymatrix_proficiency">Proficiency : </span><span><b>30%</b></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mymatrix_table_point">
                                                                        <input type="radio"><span>Electromagnetic Induction</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="mymatrix_proficiency">Proficiency : </span><span><b>55%</b></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mymatrix_table_point">
                                                                        <input type="radio"><span>Chemistry in everyday Life</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="mymatrix_proficiency">Proficiency : </span><span><b>32%</b></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mymatrix_table_point">
                                                                        <input type="radio"><span>Biomolecules</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="mymatrix_proficiency">Proficiency : </span><span><b>65%</b></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mymatrix_table_point">
                                                                        <input type="radio"><span>Chemical Equilibrium</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="mymatrix_proficiency">Proficiency : </span><span><b>22%</b></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mymatrix_table_point">
                                                                        <input type="radio"><span>Chemical Equilibrium</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="mymatrix_proficiency">Proficiency : </span><span><b>65%</b></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mymatrix_table_point">
                                                                        <input type="radio"><span>Chemical Equilibrium</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="mymatrix_proficiency">Proficiency : </span><span><b>65%</b></span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-topics" role="tabpanel" aria-labelledby="pills-topics-tab">...</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="application" class=" tab-pane">
                                    application
                                    </div>
                                    <div id="complrehension" class=" tab-pane">
                                    complrehension
                                    </div>
                                    <div id="knowledge" class=" tab-pane">
                                    knowledge
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection