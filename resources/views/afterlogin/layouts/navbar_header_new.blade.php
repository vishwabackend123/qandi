<header>
    <style>
        body.overlay {
            position: fixed;
            overflow-y: hidden;
            padding-right: 15px;
            /* Avoid width reflow */
        }

        .notification {
            position: relative;

        }

        .notifications-count {
            position: absolute;
            top: 13px;
            right: 6px;
            width: auto;
            height: auto;
            color: #fff;
            font-size: 11px;
            font-family: Arial;
            font-weight: bold;
            text-align: center;
            line-height: 1;
            padding: 1px 4px;
            background-color: #da3225;
            border-radius: 50%;
            box-shadow: 0 0 0 2px #dfdfdf;
            transform: scale(50);
            opacity: 0;
            transition: 0.3s cubic-bezier(0, 0.24, 0.86, 1.08) all;
            z-index: 1;
            display: none;
        }

        .notifications-count.active {
            transform: scale(1);
            opacity: 1;
        }

        .notifications-count.zindex {
            z-index: 3;
        }

        .badge_nty {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 0px 5px;
            border-radius: 50%;
            background: red;
            color: rgb(255 255 255 / 80%);
            min-height: 12px;
            min-width: 12px;
            font-size: 12px;
            font-weight: 900;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ms-auto text-end">
                <div class="user-name-block d-flex align-items-center flex-row-reverse">
                    <span class="user-pic-block UserPro"><img src="{{$imgPath}}" class="user-pic profileimage" title="Profile Pic"></span>
                    <span class="user-name-block ps-3">Welcome, <span id="activeUserName">{{ucwords($userData->user_name)}}</span></span>

                    <span class="notification me-5 ms-4">

                        <a draggable="false" id="nodificbell" data-bs-toggle="collapse" href='#collapseNotification' role="button" aria-expanded="false" aria-controls="collapseNotification" title="Notification">

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="78" height="78" viewBox="0 0 78 78">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #f6f9fd;
                                        }

                                        .cls-1,
                                        .cls-2 {
                                            opacity: 0;
                                        }

                                        .cls-2 {
                                            fill: #f3f7ff;
                                        }

                                        .cls-3,
                                        .cls-4 {
                                            fill: none;
                                        }

                                        .cls-4 {
                                            stroke: #000;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-width: 1.5px;
                                        }

                                        .cls-5 {
                                            fill: #d71921;
                                        }

                                        .cls-6 {
                                            filter: url(#Rectangle_4404);
                                        }
                                    </style>
                                    <filter id="Rectangle_4404" x="0" y="0" width="78" height="78" filterUnits="userSpaceOnUse">
                                        <feOffset input="SourceAlpha" />
                                        <feGaussianBlur stdDeviation="5" result="blur" />
                                        <feFlood flood-color="#7b7b7b" flood-opacity="0.212" />
                                        <feComposite operator="in" in2="blur" />
                                        <feComposite in="SourceGraphic" />
                                    </filter>

                                </defs>
                                <g id="IconButton_Notification_Alert" data-name="IconButton / Notification / Alert" transform="translate(15 15)">
                                    <g class="cls-6" transform="matrix(1, 0, 0, 1, -15, -15)">
                                        <rect id="Rectangle_4404-2" data-name="Rectangle 4404" class="cls-1" width="48" height="48" rx="16" transform="translate(15 15)" />
                                    </g>
                                    <g id="Group_4539" data-name="Group 4539" transform="translate(9 8)">
                                        <rect id="Rectangle_2416" data-name="Rectangle 2416" class="cls-2" width="31" height="32" rx="8" />
                                        <g id="Group_1824" data-name="Group 1824" transform="translate(0.487 0.974)">
                                            <g id="Group_130" data-name="Group 130">
                                                <path id="Path_195" data-name="Path 195" class="cls-3" d="M0,0H30V30H0Z" />
                                                <path id="Path_196" data-name="Path 196" class="cls-4" d="M11.445,5.537a2.482,2.482,0,1,1,4.963,0,8.885,8.885,0,0,1,4.963,7.61v3.8a5.079,5.079,0,0,0,2.482,3.8H4a5.079,5.079,0,0,0,2.482-3.8v-3.8a8.885,8.885,0,0,1,4.963-7.61" transform="translate(1.073 0.805)" />
                                                <path id="Path_197" data-name="Path 197" class="cls-4" d="M9,17v1.158a3.651,3.651,0,0,0,3.8,3.475,3.651,3.651,0,0,0,3.8-3.475V17" transform="translate(2.195 4.561)" />
                                            </g>
                                        </g>
                                    </g>
                                </g>


                            </svg>
                            <div id="notificationscount" class="notifications-count active zindex">9</div>

                        </a></span>
                    <span class="notification ms-4 planmner_icon"><a draggable="false" id="plannCal" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample" title="Planner">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="78" height="78" viewBox="0 0 78 78">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #f6f9fd;
                                        }

                                        .cls-1,
                                        .cls-2,
                                        .cls-5 {
                                            opacity: 0;
                                        }

                                        .cls-2 {
                                            fill: #f3f7ff;
                                        }

                                        .cls-3,
                                        .cls-4 {
                                            fill: none;
                                        }

                                        .cls-4 {
                                            stroke: #000;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-width: 1.5px;
                                        }

                                        .cls-5 {
                                            fill: #d71921;
                                        }

                                        .cls-6 {
                                            filter: url(#Rectangle_4403);
                                        }
                                    </style>
                                    <filter id="Rectangle_4403" x="0" y="0" width="78" height="78" filterUnits="userSpaceOnUse">
                                        <feOffset input="SourceAlpha" />
                                        <feGaussianBlur stdDeviation="5" result="blur" />
                                        <feFlood flood-color="#7b7b7b" flood-opacity="0.2" />
                                        <feComposite operator="in" in2="blur" />
                                        <feComposite in="SourceGraphic" />
                                    </filter>
                                </defs>
                                <g id="IconButton_Planner_Default" data-name="IconButton / Planner / Default" transform="translate(15 15)">
                                    <g class="cls-6" transform="matrix(1, 0, 0, 1, -15, -15)">
                                        <rect id="Rectangle_4403-2" data-name="Rectangle 4403" class="cls-1" width="48" height="48" rx="16" transform="translate(15 15)" />
                                    </g>
                                    <g id="Group_4534" data-name="Group 4534" transform="translate(-14 9)">
                                        <rect id="Rectangle_2417" data-name="Rectangle 2417" class="cls-2" height="16" transform="translate(47 13.709)" />
                                        <g id="Group_1826" data-name="Group 1826" transform="translate(22.893)">
                                            <g id="Group_1825" data-name="Group 1825">
                                                <path id="Path_2319" data-name="Path 2319" class="cls-3" d="M0,0H30V30H0Z" />
                                                <rect id="Rectangle_2409" data-name="Rectangle 2409" class="cls-4" width="19.927" height="20.791" rx="2" transform="translate(5.036 5.836)" />
                                                <line id="Line_358" data-name="Line 358" class="cls-4" y2="4.99" transform="translate(19.985 3.373)" />
                                                <line id="Line_359" data-name="Line 359" class="cls-4" y2="4.99" transform="translate(10.015 3.373)" />
                                                <line id="Line_360" data-name="Line 360" class="cls-4" x2="19.927" transform="translate(5.036 13.338)" />
                                                <line id="Line_361" data-name="Line 361" class="cls-4" x2="1.663" transform="translate(13.338 19.154)" />
                                                <line id="Line_362" data-name="Line 362" class="cls-4" y2="3.327" transform="translate(15 19.151)" />
                                            </g>

                                        </g>
                                    </g>
                                </g>
                            </svg>

                        </a></span>

                    <span class="notification ms-4 analytics-icon"><a draggable="false" href="{{route('overall_analytics')}}" title="Analytics">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="78" height="78" viewBox="0 0 78 78">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #f6f9fd;
                                            box-shadow: 0 0 10px 0 rgba(0, 186, 255, 0.2);
                                        }

                                        .cls-1,
                                        .cls-2,
                                        .cls-5 {
                                            opacity: 0;
                                        }

                                        .cls-2 {
                                            fill: #f3f7ff;
                                        }

                                        .cls-3,
                                        .cls-4 {
                                            fill: none;
                                        }

                                        .cls-4 {
                                            stroke: #000;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-width: 1.5px;
                                        }

                                        .cls-5 {
                                            fill: #d71921;
                                        }

                                        .cls-6 {
                                            filter: url(#Path_9915);
                                        }
                                    </style>
                                    <filter id="Path_9915" x="0" y="0" width="78" height="78" filterUnits="userSpaceOnUse">
                                        <feOffset input="SourceAlpha" />
                                        <feGaussianBlur stdDeviation="5" result="blur" />
                                        <feFlood flood-color="#7b7b7b" flood-opacity="0.2" />
                                        <feComposite operator="in" in2="blur" />
                                        <feComposite in="SourceGraphic" />
                                    </filter>
                                </defs>
                                <g id="IconButton_Analytics_Default" data-name="IconButton / Analytics / Default" transform="translate(15 15)">
                                    <g class="cls-6" transform="matrix(1, 0, 0, 1, -15, -15)">
                                        <path id="Path_9915-2" data-name="Path 9915" class="cls-1" d="M16,0H32A16,16,0,0,1,48,16V32A16,16,0,0,1,32,48H16A16,16,0,0,1,0,32V16A16,16,0,0,1,16,0Z" transform="translate(15 15)" />
                                    </g>
                                    <g id="Group_4529" data-name="Group 4529" transform="translate(9 9)">
                                        <rect id="Rectangle_2418" data-name="Rectangle 2418" class="cls-2" width="30" height="30" rx="8" />
                                        <g id="Group_1831" data-name="Group 1831">
                                            <g id="Group_1830" data-name="Group 1830">
                                                <path id="Path_2320" data-name="Path 2320" class="cls-3" d="M0,0H30V30H0Z" />
                                                <path id="Path_2321" data-name="Path 2321" class="cls-4" d="M9.058,5H6.529A2.529,2.529,0,0,0,4,7.529V22.7a2.529,2.529,0,0,0,2.529,2.529h7.2" transform="translate(0.973 0.974)" />
                                                <path id="Path_2322" data-name="Path 2322" class="cls-4" d="M18,14v5.058h5.058" transform="translate(4.413 3.459)" />
                                                <path id="Path_2323" data-name="Path 2323" class="cls-4" d="M19.058,12.587V7.529A2.529,2.529,0,0,0,16.529,5H14" transform="translate(3.459 1.226)" />
                                                <rect id="Rectangle_2414" data-name="Rectangle 2414" class="cls-4" width="7.554" height="5.036" rx="2" transform="translate(9.983 3.424)" />
                                                <circle id="Ellipse_714" data-name="Ellipse 714" class="cls-4" cx="5.036" cy="5.036" r="5.036" transform="translate(17.344 17.344)" />
                                                <path id="Path_2324" data-name="Path 2324" class="cls-4" d="M8,11h5.058" transform="translate(1.977 2.75)" />
                                                <path id="Path_2325" data-name="Path 2325" class="cls-4" d="M8,15h3.794" transform="translate(1.983 3.75)" />
                                            </g>

                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a></span>
                </div>
            </div>
        </div>
    </div>
</header>







<style>
    .tooltip.top {
        margin-top: -36px;
        display: none;
    }

    .slider-track {
        position: absolute;
        cursor: pointer;
        background-image: -webkit-linear-gradient(top, #f5f5f5 0, #f9f9f9 100%);
        background-image: -o-linear-gradient(top, #f5f5f5 0, #f9f9f9 100%);
        background-image: linear-gradient(to bottom, #ffffff 0, #f9f9f9 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff5f5f5', endColorstr='#fff9f9f9', GradientType=0);
        -webkit-box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
        box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
        border-radius: 4px;
        border: 1px solid #e7e7e7;
    }


    .slider-selection {
        border-radius: 6px !important;
        box-shadow: 0 0 10px 0 #5bcbfa !important;
        background: #21ccff !important;
    }

    .slider-horizontal {
        width: 90%;
        height: 20px;
    }

    .slider-handle {
        background-color: #fff !important;
        background-image: none !important;
        -webkit-box-shadow: 1px 1px 24px -2px rgb(0 0 0 / 40%) !important;
        -moz-box-shadow: 1px 1px 24px -2px rgba(0, 0, 0, 0.40) !important;
        box-shadow: 1px 1px 24px -2px rgb(0 0 0 / 40%) !important;
        border: 3px solid #000;
        width: 20px;
        height: 20px;


    }

    .exam-week-bar {
        margin-top: 42px;
    }
</style>



<!-- Planner Section -->
<div class="planmner-block width collapse planner-scheduar-block" id="collapsePlanner">

    <div class="planner-wrapper">
        <div class="planner-edit-mode open-sub-planner" id="sub-planner">
            <div class="card-common-topheading">
                <span>SCHEDULER</span>
            </div>
            <div class="slimScrollDiv">
                <div class="planner-scroll">
                    <span class="valid-feedback m-0" role="alert" id="successPlanner_alert"> </span>
                    <span class="invalid-feedback m-0" role="alert" id="errPlanner_alert"> </span>

                    <form id="plannerAddform" action="{{route('addPlanner')}}" method="POST">
                        @csrf

                        <div class="row  mb-4">
                            <div class="col-xl-6">
                                <p class="fw-bold text-uppercase mt-3">Schedule week's tests</p>
                                <div class="d-flex align-items-center row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        <label class="d-block">Start Date</label>
                                        <input type="date" id="StartDate" name="start_date" class="form-control bg-light border-0 p-2 text-center text-uppercase" required="">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        <label class="d-block">End Date</label>
                                        <input type="date" id="EndDate" name="end_date" class="form-control bg-light border-0 p-2 text-center text-uppercase" readonly="" required="">
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6">
                                <p class="fw-bold text-uppercase mt-3">Exams per week</p>
                                <div class="position-relative exam-week-bar exam-week-tabe">

                                    <input type="range" name="weekrange" class="input-range" min="0" max="7" value="0" step="1" id='customRange' style="width:92%;" />

                                    <span id="slide-input" class="badge bg-badge">0</span>
                                </div>
                            </div>
                            <span id="limit_error_1" class="text-danger"></span>
                        </div>

                        <div class=" row mt-4 sub_box planersecdualsub">
                            <span id="limit_error" class="text-danger"></span>
                            @if(isset($aSubjects) && !empty($aSubjects))
                            @foreach($aSubjects as $skey=>$sVal)

                            <div class="col-xl-4 col-md-6 mb-4 col_max col_min">
                                <div class="d-flex align-items-center text-uppercase"><i id="added_subject_{{$sVal->id}}" class="subject_tik me-2 fa fa-check-circle text-light" aria-hidden="true"></i> {{$sVal->subject_name}} <span class="count_spam_div" id="count_spam_{{$sVal->id}}"></span></div>
                                <div class="slimScrollDiv">
                                    <div class="subject_chapter">
                                        <div id="planner_sub_{{$sVal->id}}" class="chaptbox pt-2">

                                        </div>
                                        <div class="chaptbox-add " title="Add Chapter">
                                            <a draggable="false" href="javascript:void(0);" class="btn btn-light d-flex align-items-center justify-content-center" id="subject_chapter_{{$sVal->id}}" onClick="selectChapter('{{$sVal->id}}');">
                                                <span class="" title="Add Chapter"><img src="{{URL::asset('public/after_login/new_ui/images/plusSign_ic.png')}}"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">
                                    </div>
                                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                    </div> -->
                                </div>
                            </div>
                            @endforeach
                            @endif


                        </div>
                        <div class="row justify-content-center planersavebtn">
                            <button class="btn greenBtnH rounded-0 text-uppercase px-5 text-white col-xl-3 col-lg-4 col-md-6 tickicon" title="Save Planner" id="saveplannerbutton">
                                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/rightWhite_ic.png')}}" >  -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="17.299" height="12.989" viewBox="0 0 20.299 15.989">
                                    <path data-name="Path 2641" d="m5 13.388 6.04 6.388L23.119 7" transform="translate(-3.91 -5.969)" style="fill:none;stroke:#fff;stroke-width:3px" />
                                </svg>

                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">
                </div>
                <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                </div> -->
            </div>
        </div>
        <div class="planner-content p-3">
            <div class="d-flex align-items-center justify-content-between">
                <span class="fs-5 text-danger text-uppercase">Planner</span>
                <!--
                <span>
                    <a draggable="false" href="javascript:void(0);" class="link-danger close-sub-planner" id="edit-planner-btn" title="Edit planner"><img src="{{URL::asset('public/after_login/new_ui/images/blue-pen-v1.png')}}"></a>
                    <a draggable="false" href="javascript:void(0);" class="link-danger " id="close-edit-planner-btn" title="Close edit planner"><img style="width:24px;" src="{{URL::asset('public/after_login/new_ui/images/Layer-4.png')}}" class="bg-white"></a>
                    <a draggable="false" data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample" id="close-planner-btn" title="Close Planner"><i class="fa fa-close"></i></a>

                </span>
-->

                <!--
<img src="{{URL::asset('public/after_login/new_ui/images/close.png')}}" width="35%">

<span><a href="javascript:void(0);" class="text-secondary"><i class="fas fa-info-circle"></i></a></span> -->
            </div>
            <div class="calender-block">
                <div id="calendari">
                    <table class="actiu" data-actual="2021/11/02">
                        <tr>
                            <th colspan="7"><button class="boto-prev">&lt;</button><span>December<span class="any">2021</span></span><button class="boto-next">&gt;</button></th>
                        </tr>
                        <tr>
                            <th>M</th>
                            <th>T</th>
                            <th>W</th>
                            <th>T</th>
                            <th>F</th>
                            <th>S</th>
                            <th>S</th>
                        </tr>
                        <tr>
                            <td class="fora"><span>29</span></td>
                            <td class="fora"><span>30</span></td>
                            <td><span>1</span></td>
                            <td class="avui"><span>2</span></td>
                            <td><span>3</span></td>
                            <td><span>4</span></td>
                            <td><span>5</span></td>
                        </tr>
                        <tr>
                            <td><span>6</span></td>
                            <td><span>7</span></td>
                            <td><span>8</span></td>
                            <td><span>9</span></td>
                            <td><span>10</span></td>
                            <td><span>11</span></td>
                            <td><span>12</span></td>
                        </tr>
                        <tr>
                            <td><span>13</span></td>
                            <td><span>14</span></td>
                            <td><span>15</span></td>
                            <td><span>16</span></td>
                            <td><span>17</span></td>
                            <td><span>18</span></td>
                            <td><span>19</span></td>
                        </tr>
                        <tr>
                            <td><span>20</span></td>
                            <td><span>21</span></td>
                            <td><span>22</span></td>
                            <td><span>23</span></td>
                            <td><span>24</span></td>
                            <td><span>25</span></td>
                            <td><span>26</span></td>
                        </tr>
                        <tr>
                            <td><span>27</span></td>
                            <td><span>28</span></td>
                            <td><span>29</span></td>
                            <td><span>30</span></td>
                            <td><span>31</span></td>
                            <td class="fora"><span>1</span></td>
                            <td class="fora"><span>2</span></td>
                        </tr>
                        <tr>
                            <td class="fora"><span>3</span></td>
                            <td class="fora"><span>4</span></td>
                            <td class="fora"><span>5</span></td>
                            <td class="fora"><span>6</span></td>
                            <td class="fora"><span>7</span></td>
                            <td class="fora"><span>8</span></td>
                            <td class="fora"><span>9</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bg-white shadow p-3" style="display:none;">
                <div class="d-flex cal-box">
                    <span class="cal-date">27</span>
                    <div class="d-flex flex-column ms-3">
                        <span class="cal-txt1">No Test Scheduled</span>
                        <span><a draggable="false" href="javascript:void(0);" class="cal-txt2">Upcoming Test tomorrow &gt;</a></span>
                        <!--  <span class="cal-txt3"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i></span> -->
                    </div>
                </div>
                <div class="d-flex remind-box">
                    <span class="remind-txt"><i class="fa fa-clock-o" aria-hidden="true"></i>Thursday, 27 May</span>
                    <span class="ms-auto">3:00 PM</span>
                </div>
                <div class="d-flex remind-box">
                    <span class="remind-txt"><i class="fa fa-calendar-o" aria-hidden="true"></i>Remind Me</span>
                    <span class="ms-auto">30 Mins before</span>
                </div>
                <div class="d-flex remind-box flex-column">
                    <span class="remind-txt"><i class="fas fa-bars" aria-hidden="true"></i><textarea placeholder="Add description" disabled=""></textarea></span>

                </div>
            </div>
        </div>


    </div>
</div>

<!-- Modal planner chapters-->
<div class="modal fade planner_chapter" id="plannerChapter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close" style="background:none;opacity:1;">
                    <img src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}">
                </button>
            </div>
            <div id="select-planner-chapter" class="modal-body pt-0 px-5 ">

            </div>

        </div>
    </div>
</div>

<!-- Planner section End -->

<!--notification-right End-->
<div class="notification-block width collapse" id="collapseNotification">
    <div class="planner-wrapper ">
        <div class=" notification-right ">
            <a draggable="false" href="javascript:void(0);" class="close-bnt" id="close-bar"><img src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></a>
            <div id="recent_notify" class=" notification-scroll ">

                @if(isset($notifications) && !empty($notifications) && is_array($notifications))
                @foreach($notifications as $val)
                <div class="notification-txt">
                    <span class="bell-noti"><img src="{{URL::asset('public/after_login/new_ui/images/bell.jpg')}}"></span>
                    <span class="text-notific">{{ $val->message }}</span>
                    <div class="primary-secondry-btn">
                        <button type="button" class="primary-btn1">primary</button>
                        <button type="button" class="secondary-btn1">secondary</button>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<!--notification-right End-->
<!--
<img src="{{ URL::asset('public/after_login/new_ui/images/subs.png')}}">
<img src="{{URL::asset('public/after_login/new_ui/images/profile.png')}}">
<img src="{{URL::asset('public/after_login/new_ui/images/log-out.png')}}">
-->
<!--profile-section-->
<div class="main-profile-section width collapse" id="profileAcc">

    <div class="account-wrapper new">
        <!-- <a draggable="false" href="javascript:void(0);" class="closeprofile"><img src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></a> -->
        <div class="profile-section">
            <ul>
                <li><a draggable="false" href="javascript:void(0);" class="account-profile accountsidebar">
                        <svg id="Icon_Profile" data-name="Icon / Profile" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <defs>
                                <style>
                                    .cls-1,
                                    .cls-2 {
                                        fill: none;
                                    }

                                    .cls-2 {
                                        stroke: #000;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                        stroke-width: 1.5px;
                                    }
                                </style>
                            </defs>
                            <path id="Path_11495" data-name="Path 11495" class="cls-1" d="M0,0H24V24H0Z" />
                            <circle id="Ellipse_1968" data-name="Ellipse 1968" class="cls-2" cx="4" cy="4" r="4" transform="translate(8 3)" />
                            <path id="Path_11496" data-name="Path 11496" class="cls-2" d="M6,21V19a4,4,0,0,1,4-4h4a4,4,0,0,1,4,4v2" />
                        </svg>
                        Account</a>
                </li>
                <li><a draggable="false" href="javascript:void(0);" class="subscription-profile accountsidebar">
                        <svg id="Icon_Subscription" data-name="Icon / Subscription" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: none;
                                    }
                                </style>
                            </defs>
                            <path id="Path_2294" data-name="Path 2294" class="cls-1" d="M0,0H24V24H0Z" />
                            <path id="Rectangle_2366" data-name="Rectangle 2366" d="M3-.75H15A3.754,3.754,0,0,1,18.75,3v8A3.754,3.754,0,0,1,15,14.75H3A3.754,3.754,0,0,1-.75,11V3A3.754,3.754,0,0,1,3-.75Zm12,14A2.253,2.253,0,0,0,17.25,11V3A2.253,2.253,0,0,0,15,.75H3A2.253,2.253,0,0,0,.75,3v8A2.253,2.253,0,0,0,3,13.25Z" transform="translate(3 5)" />
                            <path id="Line_330" data-name="Line 330" d="M18,.75H0A.75.75,0,0,1-.75,0,.75.75,0,0,1,0-.75H18a.75.75,0,0,1,.75.75A.75.75,0,0,1,18,.75Z" transform="translate(3 10)" />
                            <path id="Line_331" data-name="Line 331" transform="translate(7 15)" />
                            <path id="Line_332" data-name="Line 332" d="M2,.75H0A.75.75,0,0,1-.75,0,.75.75,0,0,1,0-.75H2A.75.75,0,0,1,2.75,0,.75.75,0,0,1,2,.75Z" transform="translate(11 15)" />
                        </svg>
                        Subscription</a></li>
                <li><a draggable="false" href="javascript:void(0);" class="log-out-btn accountsidebar">
                        <svg id="Icon_Logout" data-name="Icon / Logout" xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: none;
                                    }
                                </style>
                            </defs>
                            <g id="invisible_box" data-name="invisible box">
                                <rect id="Rectangle_2977" data-name="Rectangle 2977" class="cls-1" width="21" height="21" />
                            </g>
                            <g id="icons_Q2" data-name="icons Q2" transform="translate(1.749 1.749)">
                                <path id="Path_2599" data-name="Path 2599" d="M21.488,20.614V4.874A.874.874,0,0,0,20.614,4H4.874A.874.874,0,0,0,4,4.874V7.061a.874.874,0,0,0,1.006.874.918.918,0,0,0,.743-.918V5.749H19.74V19.74H5.749V18.428a.874.874,0,0,0-1.006-.874A.918.918,0,0,0,4,18.472v2.142a.874.874,0,0,0,.874.874h15.74A.874.874,0,0,0,21.488,20.614Z" transform="translate(-4 -4)" />
                                <path id="Path_2600" data-name="Path 2600" d="M12.088,22.357l3.891-3.935a.831.831,0,0,0,0-1.224l-3.891-3.935a.918.918,0,0,0-1.18-.087.831.831,0,0,0-.087,1.312l2.448,2.448H4.874a.874.874,0,1,0,0,1.749h8.395l-2.448,2.448a.831.831,0,0,0,.087,1.312.918.918,0,0,0,1.18-.087Z" transform="translate(-4 -9.066)" />
                            </g>
                        </svg> Log out</a></li>
            </ul>
        </div>
        <!--profile-section-->
        <!--leader-board-->
        <div class="leader-board right-sidebar" id="LeaDer">
            <h4><img src="{{URL::asset('public/after_login/new_ui/images/profile-star.png')}}"> Leader Board</h4>
            <div class="search-frnd">

                <input type="text" name="seacrh frnd" id="search_field" placeholder="Search a friend">

            </div>
            <div class="profile-detail">
                <div id="leaderboard_box_div">
                    <ul class="p-0 m-0">
                        @if(isset($leaderboard_list) && !empty($leaderboard_list))
                        @foreach($leaderboard_list as $lead)
                        @php

                        if (isset($lead->user_profile_img) && !empty($lead->user_profile_img)) {
                        $imgPath_deft = $lead->user_profile_img;
                        } else {
                        $imgPath_deft = url('/') . '/public/after_login/images/profile.png';
                        }

                        @endphp
                        <li class="{{($lead->user_id==$userData->id)?'active_user':''}}">
                            <span class="profile-digit">{{$lead->user_rank}}.</span>
                            <span class="profile-img-user pt-0"><img class="leader-pic" src="{{$imgPath_deft}}"></span>
                            <span class="profile-text-user">
                                <h3>{{($lead->user_name) ? $lead->user_name : 'NA'}}</h3>
                                <p>{{$lead->score}} Q&I score</p>
                            </span>
                        </li>
                        @endforeach
                        @endif


                    </ul>
                </div>
                <div id="search_results" class="py-1">
                    <ul class="leaderNameBlock-search">
                    </ul>
                </div>
            </div>



        </div>
        <!--leader-board-->
        <style>
            #EdiTbtnnn svg {
                position: relative;
                top: -2px;
            }
        </style>
        <!--profile-detail-->
        <div class="profile-show" style="min-height:650px;">
            <div class="profile-show-holder">
                <div class="profile-picture-txt">
                    <div class="p-picture">
                        <img src="{{$imgPath}}" class="profile-pic uswereditpic profileimage">
                    </div>
                    <div class="p-text">
                        <h4 class="activeUserName">{{ucwords($userData->user_name)}}</h4>
                        <p>Class - {{$user_stage}}, Preparing
                            for {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</p>
                        <span class="text-success" role="alert" id="sucessAcc_edit"> </span>
                        <button class="edit-btn-show" id="EdiTbtnnn"><span>
                                <!--<img src="{{URL::asset('public/after_login/new_ui/images/edit-icon.png')}}" alt=""> -->
                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 5034" width="18" height="18" viewBox="0 0 21 21">
                                    <path data-name="Path 2668" d="M0 0h24v24H0z" style="fill:none" />
                                    <path data-name="Path 2669" d="M4 20h4L18.5 9.5a2.828 2.828 0 0 0-4-4L4 16v4" style="stroke:#fff;stroke-linecap:square;stroke-width:1.5px;fill:none" />
                                    <path data-name="Line 460" transform="translate(13.5 6.5)" style="stroke-linejoin:round;stroke:#fff;stroke-linecap:square;stroke-width:1.5px;fill:none" d="m0 0 4 4" />
                                </svg>
                            </span>EDIT</button>
                    </div>
                    <!-- <div class="achievement">
                            <h4>Achievements</h4>
                            <ul>
                                <li>You attempted 5 consecutive exams on time!</li>
                                <li>You attempted 5 consecutive exams on time!</li>
                                <li>You attempted 5 consecutive exams on time!</li>
                                <li>You attempted 5 consecutive exams on time!</li>
                            </ul>
                        </div> -->
                </div>
            </div>
            <!--profile-picture-->

        </div>

        <!--profile-show-->

        <div class="edit-form">
            <div class="edit-img mb-2">
                <div class="p-picture ">
                    <img src="{{$imgPath}}" id="profile_image" class="profile-pic uswereditpic profileimage">
                </div>

                <div class="edit-pic">
                    <form id="profile_pic_form" method="POST" id="contact" name="13" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <label for="file-input" title="Edit Profile Pic">

                            <img src="{{URL::asset('public/after_login/new_ui/images/blue-pen-v1.png')}}" alt=""></a>

                        </label>
                        <input id="file-input" name="file-input" hidden type="file" accept="image/png, image/jpg, image/jpeg" />
                    </form>

                </div>

            </div>
            <span id="image-upload-response" class=""></span>

            <div class="btm-form-flds  pe-3 pb-5">
                <form id="editProfile_form" action="{{url('/editProfile')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="d-flex f_l_name_box">
                        <div class="form-flds">
                            <input type="text" name="firstname" autocomplete="off" id="firstname" value="{{$userData->first_name}}" placeholder="First Name" onkeypress="return lettersOnly(event)" required maxlength="15">
                        </div>
                        <div class="form-flds">
                            <input type="text" name="lastname" autocomplete="off" id="lastname" placeholder="Last Name" value="{{$userData->last_name}}" required onkeypress="return lettersOnly(event)" maxlength="15">
                        </div>
                    </div>
                    <div class="form-flds">
                        <input type="text" name="username" id="username" autocomplete="off" value="{{ucwords($userData->user_name)}}" placeholder="Display Name" required onkeypress="return lettersOnly(event)" maxlength="25">
                        <p>This could be your first, last or nick name</p>
                    </div>

                    <div class="form-flds flds form-group stateD" id="statebx">
                        <div class="svg_icon_input">
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 5073" width="24" height="24" viewBox="0 0 24 24">
                                <path data-name="Path 11571" d="M0 0h24v24H0z" style="fill:none" />
                                <path data-name="Path 11572" d="M5 12H3l9-9 9 9h-2" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                                <path data-name="Path 11573" d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                                <path data-name="Path 11574" d="M9 21v-6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v6" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                            </svg>
                        </div>

                        <input type="text" class="pass students select-grade" id="select-state" placeholder="Select your state" name="state" value="{{ucwords($userData->state)}}" required readonly onkeypress="return lettersOnly(event)" spellcheck="false">
                        <span class="currect-email currect-value"><img src="{{URL::asset('public/images_new/success-icon.png')}}"></span>

                        <div class=" country-code-name stu-grade" id="state_list" style="display:none"></div>
                    </div>

                    <div class="form-flds locationN">
                        <input type="text" name="country" id="country" autocomplete="off" value="India" placeholder="India" required readonly onkeypress="return lettersOnly(event)">
                    </div>

                    <div class="form-flds flds form-group " id="citybx">
                        <div class="svg_icon_input">
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 5074" width="24" height="24" viewBox="0 0 24 24">
                                <path data-name="Path 11575" d="M0 0h24v24H0z" style="fill:none" />
                                <path data-name="Path 11576" d="m8 9 5 5v7H8v-4m0 4H3v-7l5-5m1 1V4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v17h-8" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                                <path data-name="Line 609" transform="translate(13 7)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0h0" />
                                <path data-name="Line 610" transform="translate(17 7)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0h0" />
                                <path data-name="Line 611" transform="translate(17 11)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0h0" />
                                <path data-name="Line 612" transform="translate(17 15)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0h0" />
                            </svg>
                        </div>


                        <input type="text" class="pass students select-exam" id="select-city" placeholder="Select your city" name="city" value="{{ucwords($userData->city)}}" required readonly onkeypress="return lettersOnly(event)" spellcheck="false">
                        <span class="currect-email currect-value"><img src="{{URL::asset('public/images_new/success-icon.png')}}"></span>
                        <div class="country-code-name stu-exam" id="city_list" style="display:none;">
                        </div>
                        <p id="city_remark" style="display:none;">Select the nearest city if your city is not shown in the list</p>
                    </div>


                    <div class="form-flds" style="display:none">
                        <!-- <input type="text" name="display name" id="dname" placeholder="https://www.uniq.co.in/_userID_000987787"> -->
                        <p class="">Your User ID</p>
                    </div>
                    <div class="d-flex f_l_name_box">
                        <div class="form-flds user_email">
                            <input type="email" name="useremail" autocomplete="off" id="useremail" value="{{$userData->email}}" required placeholder="Your e-Mail Id" minlength="8" maxlength="64" />
                        </div>

                        <div class="form-flds user_no">
                            <input type="text" name="user_mobile" id="user_mobile" autocomplete="off" value="{{$userData->mobile}}" minlength="10" maxlength="10" onkeypress="return isNumber(event)" placeholder="Your Contact Number" required />
                        </div>
                    </div>
                    <span class="text-danger" role="alert" id="errlog_edit" style="color:#dc3545 !important"> </span>
                    <div class="form-btns mt-lg-3">
                        <button type="button" id="cancelEdit" class="cancel-btn">cancel</button>
                        <button type="submit" id="saveEdit" class="save-btn disabled-btn" disabled>save</button>
                    </div>
                </form>
            </div>
        </div>
        <!--edit-form-->


        <div class="subscription right-sidebar subscription-box">
            <div class="profile-picture-txt">
                <div class="profile_text_box_heading">
                    <div class="p-picture">
                        <img src="{{$imgPath}}" class="profile-pic uswereditpic profileimage">
                    </div>
                    <div class="p-text">
                        <h4 class="activeUserName">{{ucwords($userData->user_name)}}</h4>
                        <p>Class - {{$user_stage}}, Preparing for {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</p>

                    </div>
                </div>

                <div class="subscrived">
                    <div class="p-pictures">
                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/check.png')}}" alt="icon is missing"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60">
                            <g data-name="Group 5043" transform="translate(-1110 -408)">
                                <circle data-name="Ellipse 720" cx="30" cy="30" r="30" transform="translate(1110 408)" style="fill:#44cd7f" />
                                <path data-name="Path 2334" d="m9 20 10 10 20-20" transform="translate(1116 418)" style="fill:none;stroke:#fff;stroke-linecap:square;stroke-width:4px" />
                            </g>
                        </svg>

                    </div>
                    <div class="p-text">
                        <?php
                        $todaydate = date("d-m-Y"); ?>

                        @if(isset($subscription_details) && !empty($subscription_details))
                        <h3>Subscribed for {{isset($subscription_details->subscription_name)?$subscription_details->subscription_name:''}}</h3>

                        @endif

                    </div>
                </div>
                <h6 class="text-danger">
                    @php $expirydate=isset($subscription_details->subscription_end_date)? date("d-m-Y", strtotime($subscription_details->subscription_end_date)):''; @endphp
                    @if($suscription_status != 0) <p class="text-end text-danger mt-1">*Subscription expires
                        on {{!empty($expirydate)?date("jS F, Y", strtotime($expirydate)):''}}</p>
                    @else
                    <p class="text-end text-danger mt-1">*Subscription has already expired on {{!empty($expirydate)?date("jS F, Y", strtotime($expirydate)):''}}</p>
                    @endif
                </h6>
                <div class="form-btns mt-lg-3 res_flex d-flex">
                    <!--  <a draggable="false" href="{{route('subscriptions')}}"><button type="button" class="cancel-btn">see details</button></a> -->
                    @if(($suscription_status != 0) && ($subscription_type == 'T'))
                    <a  draggable="false" href="{{route('subscriptions')}}"><button  type="button" class="w-100 save-btn">Upgrade</button></a>
                    @elseif($suscription_status != 0 && $subscription_type == 'P')
                    <a class="savebtnmargin" draggable="false" href="{{route('subscriptions')}}"><button type="button" class="w-100 cancel-btn-see">see details</button></a>
                    <a draggable="false" href="{{route('refund_form')}}"><button type="button" class=" w-100 save-btn">Refund</button></a>
                    @endif
                </div>
            </div>
        </div>
        <!--subscription-->
        <div class="log-out-screen right-sidebar">

            <div class="edit-img">
                <div class="p-picture">
                    <img src="{{$imgPath}}">
                </div>
            </div>
            <h4 class="activeUserName">{{ucwords($userData->user_name)}}</h4>
            <p>Are you Sure?</p>
            <div class="form-btns">
                <a draggable="false" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 sessionStorage.clear();  document.getElementById('logout-form').submit();" ">
                                 <button type=" button" class="save-btn logout_btn_new">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" style="
                                        position: absolute;
                                        left: 62px;
                                        top: 20px;
                                    ">
                        <path data-name="Path 2331" d="M13 3v7h6l-8 11v-7H5l8-11" transform="translate(-5 -3)" style="fill:#fff"></path>
                    </svg>
                    Log out</button>
                </a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>
        <!--log-out-screen-->
    </div>
</div>
<!--main-profile-section-->
<script>
    function lettersOnly(evt) {

        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
            ((evt.which) ? evt.which : 0));
        if (charCode > 32 && (charCode < 65 || charCode > 90) &&
            (charCode < 97 || charCode > 122)) {

            return false;
        }
        return true;
    }
</script>

<style>
    .planner-content,
    #sub-planner {
        height: calc(100% - 120px) !important;
    }

    .planner-scheduar-block.show .planner-content {
        box-shadow: 0px 0px 6px -3px;
        background: #fff;
    }

    .clear_div .dropdown ul.dropdown-menu.cust-dropdown.show {
        transform: translate(-104px, 50px) !important;

    }

    .tickicon svg {
        margin-right: 5px;
    }


    .col-xl-4.col-lg-4.col-md-6.mb-4.col_max.col_min {
        max-width: 25%;
        min-width: 25%;
    }

    .sub_box {
        justify-content: space-around;
    }

    .sub_box .slimScrollDiv {
        padding: 10px;
    }
</style>