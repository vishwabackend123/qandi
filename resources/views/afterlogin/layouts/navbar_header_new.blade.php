<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ms-auto text-end">
                <div class="user-name-block d-flex align-items-center flex-row-reverse">
                    <a href='#'><span class="user-pic-block"><img src="{{URL::asset('public/after_login/new_ui/images/DSC_0004.png')}}" class="user-pic"></span></a>
                    <span class="user-name-block ps-3 pe-3">Welcome, <span id="activeUserName">{{ucwords($userData->user_name)}}</span></span>
                    <span class="notification me-5 ms-4" data-bs-toggle="collapse" href='#collapseNotification' role="button" aria-expanded="false" aria-controls="collapseNotification"><img src="{{URL::asset('public/after_login/new_ui/images/bell.png')}}"></span>
                    <span class="notification ms-4">
                        <a data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample">
                            <img src="{{URL::asset('public/after_login/new_ui/images/calender.png')}}">
                        </a>
                    </span>
                    <span class="notification ms-4"><a href="{{route('overall_analytics')}}"><img src="{{URL::asset('public/after_login/new_ui/images/Group1831.png')}}"></a></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Planner Section -->

<div class="planmner-block width collapse" id="collapsePlanner">

    <div class="planner-wrapper">
        <div class="planner-edit-mode" id="sub-planner">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 70vh;">
                <div class="planner-scroll" style="overflow: auto; width: auto; height: 70vh;">
                    <span class="valid-feedback m-0" role="alert" id="successPlanner_alert"> </span>
                    <span class="invalid-feedback m-0" role="alert" id="errPlanner_alert"> </span>

                    <form id="plannerAddform" action="{{route('addPlanner')}}" method="POST">
                        @csrf

                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <p class="fw-bold text-uppercase mt-3">Schedule test weeks</p>
                                <div class="d-flex align-items-center row">
                                    <div class="col-5 me-2">
                                        <label class="d-block">Start Date</label>
                                        <input type="date" id="StartDate" name="start_date" class="form-control bg-light border-0 p-2 text-center text-uppercase" required="" min="2021-11-29">
                                    </div>
                                    <div class="col-5">
                                        <label class="d-block">End Date</label>
                                        <input type="date" id="EndDate" name="end_date" class="form-control bg-light border-0 p-2 text-center text-uppercase" readonly="" required="">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <p class="fw-bold text-uppercase mt-3">Exams per week</p>
                                <input type="range" name="weekrange" class="exam_range" min="0" max="7" value="5" step="1" id="customRange" oninput="outputUpdate(value)" style="background: linear-gradient(to right, rgb(175, 243, 208) 0%, rgb(175, 243, 208) 0%, rgb(255, 255, 255) 0%, white 100%); width:92%;">
                                <span id="slide-input" class="badge bg-badge">0</span>
                            </div>
                            <span id="limit_error_1" class="text-danger"></span>
                        </div>

                        <div class=" row mt-4">
                            <span id="limit_error" class="text-danger"></span>
                            @if(isset($aSubjects) && !empty($aSubjects))
                            @foreach($aSubjects as $skey=>$sVal)

                            <div class="col col-md-4 mb-4 ">
                                <div class="d-flex align-items-center text-uppercase"><i class="me-2 fa fa-check-circle text-success" aria-hidden="true"></i> {{$sVal->subject_name}}</div>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 30vh;">
                                    <div class="subject_chapter" style="overflow: hidden; width: auto; height: 30vh;">
                                        <div id="planner_sub_{{$sVal->id}}" class="chaptbox pt-2">

                                        </div>
                                        <div class="chaptbox-add ">
                                            <a href="#" class="btn btn-light d-flex align-items-center justify-content-center" id="subject_chapter_{{$sVal->id}}" onClick="selectChapter('{{$sVal->id}}');">
                                                <span class=""><img src="{{URL::asset('public/after_login/new_ui/images/plusSign_ic.png')}}"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">
                                    </div>
                                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif


                        </div>
                        <div class="text-center">
                            <button class="btn greenBtnH rounded-0 text-uppercase px-5 w-25"><img src="{{URL::asset('public/after_login/new_ui/images/rightWhite_ic.png')}}">
                            </button>
                        </div>
                    </form>
                </div>
                <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">
                </div>
                <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                </div>
            </div>
        </div>
        <div class="planner-content p-3">
            <div class="d-flex align-items-center justify-content-between">
                <span class="fs-5 text-danger text-uppercase">Planner</span>
                <span>
                    <a href="javascript:void(0);" class="link-danger" id="edit-planner-btn"><img src="{{URL::asset('public/after_login/new_ui/images/blue-pen-v1.png')}}"></a>
                    <a href="javascript:void(0);" class="link-danger close-sub-planner" id="close-edit-planner-btn"><img style="width:24px;" src="{{URL::asset('public/after_login/new_ui/images/Layer-4.png')}}" class="bg-white"></a>
                    <a data-bs-toggle="collapse" href='#collapsePlanner' role="button" aria-expanded="false" aria-controls="collapseExample" id="close-planner-btn"><img src="{{URL::asset('public/after_login/new_ui/images/close.png')}}" width="35%"></a>

                </span>

                <!-- <span><a href="javascript:void(0);" class="text-secondary"><i class="fas fa-info-circle"></i></a></span> -->
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
                        <span><a href="javascript:void(0);" class="cal-txt2">Upcoming Test tomorrow &gt;</a></span>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="select-planner-chapter" class="modal-body pt-0 px-5 ">

            </div>

        </div>
    </div>
</div>

<!-- Planner section End -->

<!--notification-right End-->
<div class="notification-block width collapse" id="collapseNotification">
    <div class=" notification-wrapper ">
        <div class=" notification-right ">
            <a href="#" class="close-bnt"><img src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}"></a>
            <div class=" notification-scroll ">
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

<!--profile-section-->
<div class="main-profile-section">

    <div class="account-wrapper">
        <div class="profile-section">
            <ul>
                <li class="active"><a href="#" class="account-profile accountsidebar"><span><img src="{{URL::asset('public/after_login/new_ui/images/profile.png')}}"></span> Account</a>
                </li>
                <li><a href="#" class="subscription-profile accountsidebar"><span><img src="{{URL::asset('public/after_login/new_ui/images/subs.png')}}"></span> Subscription</a></li>
                <li><a href="#" class="log-out-btn accountsidebar"><span><img src="{{URL::asset('public/after_login/new_ui/images/log-out.png')}}"></span> Log out</a></li>
            </ul>
        </div>
        <!--profile-section-->

        <div class="leader-board right-sidebar">
            <h4><img src="{{URL::asset('public/after_login/new_ui/images/profile-star.png')}}"> Leader Board</h4>
            <div class="search-frnd">

                <input type="text" name="seacrh frnd" id="search_field" placeholder="Search Friend...">

            </div>
            <div class="profile-detail">
                <div id="leaderboard_box_div">
                    <ul>
                        @if(isset($leaderboard_list) && !empty($leaderboard_list))
                        @foreach($leaderboard_list as $lead)
                        @php
                        if (isset($lead->user_profile_img) && !empty($lead->user_profile_img)) {
                        $imgPath_deft = $lead->user_profile_img;
                        } else {
                        $imgPath_deft = url('/') . '/public/after_login/images/profile.png';
                        }

                        @endphp
                        <li>
                            <span class="profile-digit">{{$lead->user_rank}}.</span>
                            <span class="profile-img-user pt-0"><img class="leader-pic" src="{{$imgPath_deft}}"></span>
                            <span class="profile-text-user">
                                <h3>{{($lead->user_name) ? $lead->user_name : 'NA'}}</h3>
                                <p>{{$lead->score}} Unique score</p>
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
            <!--profile-detail-->
            <div class="profile-show">
                <div class="profile-picture-txt">
                    <div class="p-picture">
                        <img src="{{$imgPath}}" class="profile-pic uswereditpic">
                    </div>
                    <div class="p-text">
                        <h4 class="activeUserName">{{ucwords($userData->user_name)}}</h4>
                        <p>Class - {{$user_stage}}, Preparing
                            for {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</p>
                        <span class="text-success" role="alert" id="sucessAcc_edit"> </span>
                        <button class="edit-btn-show"><span><img src="{{URL::asset('public/after_login/new_ui/images/edit-icon.png')}}" alt=""></span>EDIT</button>
                    </div>
                    <div class="achievement">
                        <h4>Achievements</h4>
                        <ul>
                            <li>You attempted 5 consecutive exams on time!</li>
                            <li>You attempted 5 consecutive exams on time!</li>
                            <li>You attempted 5 consecutive exams on time!</li>
                            <li>You attempted 5 consecutive exams on time!</li>
                        </ul>
                    </div>
                </div>
                <!--profile-picture-->
            </div>
            <!--profile-show-->

            <div class="edit-form">
                <div class="edit-img">
                    <div class="p-picture">
                        <img src="{{$imgPath}}" id="profile_image" class="profile-pic uswereditpic">
                    </div>

                    <div class="edit-pic">
                        <form id="profile_pic_form" method="POST" id="contact" name="13" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <label for="file-input">

                                <img src="{{URL::asset('public/after_login/new_ui/images/blue-pen-v1.png')}}" alt=""></a>

                            </label>
                            <input id="file-input" name="file-input" hidden type="file" accept="image/png, image/jpg, image/jpeg" />
                        </form>

                    </div>

                </div>
                <span id="image-upload-response" class=""></span>

                <div class="btm-form-flds">
                    <form id="editProfile_form" action="{{route('editProfile')}}" method="POST" autocomplete="off">
                        <div class="form-flds">
                            <input type="text" name="firstname" autocomplete="off" id="firstname" value="{{$userData->first_name}}" placeholder="First Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required>
                        </div>
                        <div class="form-flds">
                            <input type="text" name="lastname" autocomplete="off" id="lastname" placeholder="Last Name" value="{{$userData->last_name}}" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                        </div>
                        <div class="form-flds">
                            <input type="text" name="username" id="username" autocomplete="off" value="{{ucwords($userData->user_name)}}" placeholder="Display Name" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                            <p class="">This could be your first, last or nick name</p>
                        </div>

                        <div class="form-flds" style="display:none">
                            <input type="text" name="display name" id="dname" placeholder="https://www.uniq.co.in/_userID_000987787">
                            <p class="">Your User ID</p>
                        </div>
                        <div class="form-flds">
                            <input type="email" name="useremail" autocomplete="off" id="useremail" value="{{$userData->email}}" required placeholder="Your e-Mail Id" />
                        </div>

                        <div class="form-flds">
                            <input type="text" name="user_mobile" id="user_mobile" autocomplete="off" value="{{$userData->mobile}}" minlength="10" maxlength="10" onkeypress="return isNumber(event)" placeholder="Your Contact Number" required />
                        </div>
                        <span class="text-danger" role="alert" id="errlog_edit"> </span>
                        <div class="form-btns">
                            <button type="button" id="cancelEdit" class="cancel-btn">cancel</button>
                            <button type="submit" id="saveEdit" class="save-btn">save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--edit-form-->

        </div>
        <!--leader-board-->

        <div class="subscription right-sidebar">
            <div class="profile-picture-txt">
                <div class="p-picture">
                    <img src="{{$imgPath}}" class="profile-pic uswereditpic">
                </div>
                <div class="p-text">
                    <h4 class="activeUserName">{{ucwords($userData->user_name)}}</h4>
                    <p>Class - {{$user_stage}}, Preparing for {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</p>

                </div>
                <div class="subscrived">
                    <div class="p-pictures">
                        <img src="{{URL::asset('public/after_login/new_ui/images/check.png')}}" alt="icon is missing">
                    </div>
                    <div class="p-text">
                        <?php
                        $todaydate = date("d-m-Y"); ?>
                        <h4 class="activeUserName">{{ucwords($userData->user_name)}}</h4>
                        @if(isset($subscription_details) && !empty($subscription_details))
                        <p>Subscribed for {{isset($subscription_details->subscription_name)?$subscription_details->subscription_name:''}}</p>

                        @endif

                    </div>
                </div>
                <h6 class="text-danger">*@php $expirydate=isset($subscription_details->subscription_end_date)? date("d-m-Y", strtotime($subscription_details->subscription_end_date)):''; @endphp
                    @if($suscription_status != 0) <p class="text-end text-danger mt-1">*Subscription expires
                        on {{!empty($expirydate)?date("jS F, Y", strtotime($expirydate)):''}}</p>
                    @else
                    <p class="text-end text-danger mt-1">*Subscription has already expired on {{!empty($expirydate)?date("jS F, Y", strtotime($expirydate)):''}}</p>
                    @endif
                </h6>
                <div class="form-btns">
                    <a href="{{route('subscriptions')}}"><button type="button" class="cancel-btn">see details</button></a>
                    <a href="{{route('subscriptions')}}"><button type="button" class="save-btn">Change course</button></a>
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
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            sessionStorage.clear();  document.getElementById('logout-form').submit();" "><button type=" button" class="save-btn">Log out</button></a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>
        <!--log-out-screen-->
    </div>
</div>
<!--main-profile-section-->