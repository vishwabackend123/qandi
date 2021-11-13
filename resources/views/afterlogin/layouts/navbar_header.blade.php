<header>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-6 ms-auto text-end">
                <div class=" d-flex align-items-center flex-row-reverse">
                    <span class="user-pic-block"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><img src="{{$imgPath}}" class="user-pic"></a></span>
                    <span class="user-name-block ps-3 me-3">Welcome, <span class="activeUserName" id="activeUserName">{{ucwords(Auth::user()->user_name)}}</span></span>

                    <span class="notification me-5 ms-4">
                        <a data-bs-toggle="collapse" href="#notification" role="button" aria-expanded="false" aria-controls="notification" class="top-link " id="notification-tog">
                            <img src="{{URL::asset('public/after_login/images/Group3205.png')}}">
                            <span class="red-dot" id="red-dot-notifiction" style="display:none"></span>
                            <span class="hoverlink">Notification</span>
                        </a>
                    </span>
                    <span class="notification ms-4">
                        <a data-bs-toggle="collapse" class="top-link " href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" id="collapseExample-tog">
                            <img src="{{URL::asset('public/after_login/images/calender.png')}}">
                            <!--  <span class="red-dot"></span> -->
                            <span class="hoverlink">Planner</span>
                        </a>
                    </span>
                    <span class="notification ms-4">
                        <a href="{{ route('overall_analytics') }}" class="top-link ">
                            <img src="{{URL::asset('public/after_login/images/Group1831.png')}}">
                            <!-- <span class="red-dot"></span> -->
                            <span class="hoverlink">Analytics</span>
                        </a>
                    </span>
                </div>
                <div class="profile-menu">
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

                        <div class="offcanvas-body">
                            <div class="d-flex flex-column justify-content-center align-items-start profile-links">
                                <span><a href="javascript:void(0);" id="profile-click"><img src="{{URL::asset('public/after_login/images/Group 3093.png')}}">Account</a></span>
                                <span><a href="javascript:void(0);" id="subscribe-click"><img src="{{URL::asset('public/after_login/images/Group 3105.png')}}">Subscription</a></span>

                                <span>
                                    <a href="javascript:void(0);" id="logout-click"><img src="{{URL::asset('public/after_login/images/Layer -7.png')}}">Logout</a>

                                </span>
                            </div>
                        </div>
                        <div id="profile-block" class="d-none">
                            <div class="d-flex flex-row-reverse h-100">
                                <div class="myAccountblock profileAccount" id="myAccount">
                                    <div class="d-flex text-start h-100">
                                        <div class="leaderBoardBlock">
                                            <div class="bg-white p-3 text-left ms-2 h-100">
                                                <p class="text-uppercase ps-4 py-2">Leader Board</p>
                                                <ol class="leaderNameBlock">
                                                    @if(isset($leaderboard_list) && !empty($leaderboard_list))
                                                    @foreach($leaderboard_list as $lead)
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <span class="sno me-3">{{$lead->user_rank}}.</span>
                                                            @php
                                                            if (isset($lead->user_profile_img) && !empty($lead->user_profile_img)) {
                                                            $imgPath_deft = $lead->user_profile_img;
                                                            } else {
                                                            $imgPath_deft = url('/') . '/public/after_login/images/profile.png';
                                                            }

                                                            @endphp
                                                            {{--<span><img src="{{URL::asset('public/after_login/images/DSC_0004.png')}}" class="leader-pic" /></span> --}}
                                                            <span><img src="{{$imgPath_deft}}" class="leader-pic" /></span>
                                                            <div class="leader-txt">
                                                                <p>{{($lead->user_name) ? $lead->user_name : 'NA'}}</p>
                                                                <small>{{$lead->score}} Unique score</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                    @endif

                                                </ol>
                                                <div class="text-box mt-3">
                                                    <label class="ps-0 pb-1">Search a Friend</label>
                                                    <input type="text" name="search_field" id="search_field" class="ps-2" value="" placeholder="Search By Name" />
                                                </div>
                                                <div id="search_results" class="py-1">
                                                    <ol class="leaderNameBlock-search">
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="myAccountblock profileAccount" id="profile">
                                    <div class="d-flex text-start h-100">
                                        <div class="leaderBoardBlockedit">
                                            <div class="bg-white p-3 text-left ms-4 read-mode h-100">
                                                <span class="position-relative d-inline-block ">
                                                    <img src="{{$imgPath}}" class="profile-pic uswereditpic" />

                                                    <form id="profile_pic_form" method="POST" id="contact" name="13" class="form-horizontal" enctype="multipart/form-data">
                                                        <span class="image-upload">
                                                            <label for="file-input">
                                                                <span class="btn edit-icon"><i class="fas fa-pencil-alt"></i></span>
                                                            </label>
                                                            <input id="file-input" name="file-input" type="file" accept="image/png, image/jpg, image/jpeg" />
                                                        </span>
                                                    </form>
                                                </span>
                                                <span id="image-upload-response" class=""></span>
                                                <div id="profile-details" class="" style="padding-top:-20px">
                                                    <div class="mb-2 mt-3 profile-read">
                                                        <h5 id="profileUserName" class="activeUserName">{{ucwords(Auth::user()->user_name)}}</h5>
                                                        <small>Class - {{$user_stage}}, Preparing
                                                            for {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</small>
                                                        <button class="btn-danger mt-4 rounded-0 btn-sm btn px-5 " id="editprofile">Edit Profile
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <h5 class="text-uppercase fw-bold">Achievements</h5>
                                                        <div class="scroll-achiv  pe-3">
                                                            <p class="d-flex align-items-center text-light mt-4 "><span class="achive-txt">You attempted 5 consecutive exams on time!</span><a href="javascript:void(0);" class="text-light ms-auto fs-3"><img src="{{URL::asset('public/after_login/images/shareGray_ic.png')}}" /></a>
                                                            </p>
                                                            <p class="d-flex align-items-center text-light mt-4 "><span class="achive-txt">You attempted 5 consecutive exams on time!</span><a href="javascript:void(0);" class="text-light ms-auto fs-3"><img src="{{URL::asset('public/after_login/images/shareGray_ic.png')}}" /></a>
                                                            </p>
                                                            <p class="d-flex align-items-center text-light mt-4 "><span class="achive-txt">You attempted 5 consecutive exams on time!</span><a href="javascript:void(0);" class="text-light ms-auto fs-3"><img src="{{URL::asset('public/after_login/images/shareGray_ic.png')}}" /></a>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile-form-block profilescrollblock pe-3 pb-2" id="profile-form">
                                                    <form id="editProfile_form" action="{{route('editProfile')}}" method="POST" autocomplete="off">
                                                        @csrf
                                                        <div class="text-box mt-3">

                                                            <input type="text" name="firstname" id="firstname" class="ps-2" value="{{Auth::user()->first_name}}" placeholder="First Name" onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required />

                                                        </div>

                                                        <div class="text-box mt-2">

                                                            <input type="text" name="lastname" id="lastname" class="ps-2" value="{{Auth::user()->last_name}}" required placeholder="Last Name" onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" />

                                                        </div>
                                                        <div class="text-box mt-2">

                                                            <input type="text" name="username" id="username" class="ps-2" value="{{ucwords(Auth::user()->user_name)}}" required placeholder="Display Name" onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" />
                                                            <div id="emailHelp" class="form-text">This could be your
                                                                first, last or nick name.
                                                            </div>
                                                        </div>
                                                        <div class="text-box mt-2">

                                                            <!--  <input type="text" name="searchname" id="searchname" class="ps-2" value="" minlength="10" maxlength="10" placeholder="https://www.uniq.co.in/_userID_000987787" /> -->
                                                            <div id="emailHelp" class="form-text">Your User ID</div>
                                                        </div>
                                                        <div class="text-box mt-3">
                                                            <input type="email" name="useremail" id="useremail" class="ps-2" value="{{Auth::user()->email}}" required placeholder="Your Email Id" />
                                                        </div>

                                                        <div class="text-box mt-2">

                                                            <input type="text" name="user_mobile" id="user_mobile" class="ps-2" value="{{Auth::user()->mobile}}" minlength="10" maxlength="10" onkeypress="return isNumber(event)" placeholder="Your Contact Number" required />

                                                        </div>
                                                        <span class="invalid-feedback m-0" role="alert" id="errlog_edit"> </span>

                                                        <div class=" text-box mt-4 text-end">
                                                            <button type="button" id="cancelEdit" class="btn-light rounded-0 btn px-5 btn-sm">Cancel
                                                            </button>
                                                            <button type="submit" id="saveEdit" class="btn-danger  rounded-0 btn-sm btn px-5 ms-2">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="myAccountblock d-none" id="subscribe">
                            <div class="d-flex text-start">
                                <div class="subscribeBlock">
                                    <div class="bg-white p-4 text-left ms-4 ">
                                        <div class="d-flex align-items-center">
                                            <span class="position-relative d-inline-block">
                                                <img src="{{URL::asset('public/after_login/images/userpics.png')}}" class=" sml-pic" />
                                            </span>
                                            <div class="my-5 subscription-read">
                                                <h5 class="activeUserName">{{ucwords(Auth::user()->user_name)}}</h5>
                                                <small>Class - {{$user_stage}}, Preparing
                                                    for {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</small>

                                            </div>
                                        </div>
                                        <div class="d-flex bg-light align-items-center px-4 py-3">
                                            <span><i class="fas fa-check-circle text-success fa-4x"></i></span>
                                            <?php
                                            $fromdate = isset($subscription_details->subscription_end_date) ? date("d-m-Y", strtotime($subscription_details->subscription_end_date)) : '';
                                            $todaydate = date("d-m-Y"); ?>
                                            <div class="subscribe-detail">
                                                @if(isset($subscription_details) && !empty($subscription_details))
                                                <p class="mb-0">Subscribed
                                                    for {{isset($subscription_details->subscription_name)?$subscription_details->subscription_name:''}}</p>
                                                <small>{{isset($subscription_details->subscription_details)?$subscription_details->subscription_details:''}}</small>
                                                @endif
                                                <!-- <p class="mb-0">Subscribed for JEE (Mains) 2022</p>
                                                <small>Includes 2 Mains Mock Test (Live), 4 Sample Tests</small> -->
                                            </div>
                                        </div>
                                        @php $expirydate=isset($subscription_details->subscription_end_date)? date("d-m-Y", strtotime($subscription_details->subscription_end_date)):''; @endphp
                                        @if($fromdate > $todaydate)
                                        <p class="text-end text-danger mt-1">*Subscription expires
                                            on {{!empty($expirydate)?date("jS F, Y", strtotime($expirydate)):''}}</p>
                                        @else
                                        <p class="text-end text-danger mt-1">*Subscription already expired</p>
                                        @endif


                                        <!-- <p class="text-end text-danger mt-1">*Subscription expires on 23rd April, 2022</p> -->
                                        <div class=" text-box mt-4 text-end">
                                            <a href="{{route('subscriptions')}}" class="btn-light rounded-0 btn px-5 btn-sm">See Details</a>
                                            <a href="{{route('subscriptions')}}" class="btn-danger rounded-0 btn-sm btn px-5 ms-2">Change Subscription</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="myAccountblock d-none" id="logout-block">
                            <div class="d-flex text-start align-items-center justify-content-center h-100">
                                <div class="logoutBlock">
                                    <div class="bg-white p-4 text-left ms-4 text-center">

                                        <p>Are you sure?</p>

                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            sessionStorage.clear();  document.getElementById('logout-form').submit();" class="btn btn-danger rounded-0 px-5">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div> <!-- login end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- notification START-->
<div class="collapse planmner-block width" id="notification">
    <div class="planner-wrapper">
        <div class="notification-content p-3">
            <h4 class="noti-heading text-center">Notification</h4>
            <div class="notification-scroll pe-3">
                <p class="noti-subheading">Recent</p>
                <div id="recent_notify">
                    <!-- <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                        <p class="mb-0">You have a test tomorrow on Wave Optics</p>
                        <span class="mb-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-light"></i>
                            <i class="fa fa-star text-light"></i>
                        </span>
                        <small>09:34PM</small>
                    </div>
                    <div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">
                        <p class="mb-0">You have a test tomorrow on Wave Optics</p>
                        <span class="mb-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-light"></i>
                            <i class="fa fa-star text-light"></i>
                        </span>
                        <small>09:34PM</small>
                    </div> -->
                </div>
                <p class="noti-subheading mt-4">Older Notification
                    @if(isset($notifications) && !empty($notifications) && is_array($notifications))
                    <span style="margin-left: 190px;">
                        <a href="{{route('clearAllNotifications')}}">Clear All</a>
                    </span>
                    @endif
                </p>
                <div id="old_notify">

                    @if(isset($notifications) && !empty($notifications) && is_array($notifications))
                    @foreach($notifications as $val)
                    <div class="border-bottom d-flex flex-column py-2 px-3 notify-block">

                        <h6 class="mb-0">{{ $val->title }}</h6>
                        <p class="mb-0">{{ $val->message }}</p>

                        <small>{{ $val->notification_date }}</small>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- notification End-->
<div class="collapse planmner-block width" id="collapseExample">

    <div class="planner-wrapper">
        <div class="planner-edit-mode" id="sub-planner">
            <span class="valid-feedback m-0" role="alert" id="successPlanner_alert"> </span>
            <span class="invalid-feedback m-0" role="alert" id="errPlanner_alert"> </span>
            <p class="fw-bold text-uppercase">Exams per week</p>
            <form id="plannerAddform" action="{{route('addPlanner')}}" method="POST">
                @csrf
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <input type="range" name="weekrange" class="exam_range" min="0" max="7" value="5" step="1" id="customRange" oninput="outputUpdate(value)">
                    </div>
                    <div class="col-md-6">
                        <span id="slide-input" class="badge bg-badge">5</span>
                    </div>
                    <span id="limit_error_1" class="text-danger"></span>
                </div>
                <p class="fw-bold text-uppercase mt-3">Schedule test weeks</p>
                <div class="d-flex align-items-center row">
                    <div class="col-3 me-2">
                        <label class="d-block">Start Date</label>
                        <input type="date" id="StartDate" name="start_date" class="form-control bg-light border-0 p-2 text-center text-uppercase" required />
                    </div>
                    <div class="col-3">
                        <label class="d-block">End Date</label>
                        <input type="date" id="EndDate" name="end_date" class="form-control bg-light border-0 p-2 text-center text-uppercase" readonly required />
                    </div>
                </div>
                <div class=" row mt-4">
                    <span id="limit_error" class="text-danger"></span>
                    @if(isset($aSubjects) && !empty($aSubjects))
                    @foreach($aSubjects as $skey=>$sVal)
                    <div class="col col-lg-4 mb-4 ">
                        <div class="d-flex align-items-center text-uppercase"><i class="me-2 fa fa-check-circle text-success" aria-hidden="true"></i> {{$sVal->subject_name}}</div>
                        <div class="subject_chapter">
                            <div id="planner_sub_{{$sVal->id}}" class="chaptbox pt-2">

                            </div>
                            <div class="chaptbox-add ">
                                <a href="#" class="btn btn-light d-flex align-items-center justify-content-center" id="subject_chapter_{{$sVal->id}}" onClick="selectChapter('{{$sVal->id}}');">
                                    <span class=""><img src="{{URL::asset('public/after_login/images/plusSign_ic.png')}}" /></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="text-center">
                    <button class="btn greenBtnH rounded-0 text-uppercase px-5 w-25"><img src="{{URL::asset('public/after_login/images/rightWhite_ic.png')}}" />
                    </button>
                </div>
            </form>
        </div>
        <div class="planner-content p-3">
            <div class="d-flex align-items-center justify-content-between">
                <span>
                    <a href="javascript:void(0);" class="link-danger" id="edit-planner-btn"><img src="{{URL::asset('public/after_login/images/edit.png')}}"></a>
                    <a href="javascript:void(0);" class="link-danger close-sub-planner" id="close-edit-planner-btn"><img style="width:24px;" src="{{URL::asset('public/after_login/images/Layer-4.png')}}" class="bg-white"></a>
                    <a href="javascript:void(0);" class="close" data-dismiss="modal" id="close-planner-btn"><img src="{{URL::asset('public/after_login/images/close.png')}}" width="35%"></a>

                </span>
                <span class="fs-5 text-danger text-uppercase">Planner</span>
                <!-- <span><a href="javascript:void(0);" class="text-secondary"><i class="fas fa-info-circle"></i></a></span> -->
            </div>
            <div class="calender-block">
                <div id="calendari"></div>
            </div>
            <div class="bg-white shadow p-3">
                <div class="d-flex cal-box">
                    <span class="cal-date">27</span>
                    <div class="d-flex flex-column ms-3">
                        <span class="cal-txt1">No Test Scheduled</span>
                        <span><a href="javascript:void(0);" class="cal-txt2">Upcoming Test tomorrow ></a></span>
                        <!--  <span class="cal-txt3"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> <i class="fa fa-star"></i></span> -->
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

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        jQuery("#notification-tog").click(function() {
            jQuery("#collapseExample").hide();
            jQuery("#notification").show();
        });

        jQuery("#collapseExample-tog").click(function() {
            jQuery("#collapseExample").show();
            jQuery("#notification").hide();
        });
    });

    document.getElementById("customRange").oninput = function() {
        $('#slide-input').html(this.value);
        var value = (this.value - this.min) / (this.max - this.min) * 100
        this.style.background = 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + value + '%, #fff ' + value + '%, white 100%)'
    };

    $(document).ready(function() {

        var today = new Date().toISOString().split('T')[0];

        var dateW = new Date(today);
        var firstW = dateW.getDate() - dateW.getDay() + 1;
        var firstdayW = new Date(dateW.setDate(firstW)).toUTCString();
        var firstDateW = formatDate(firstdayW);

        document.getElementsByName("start_date")[0].setAttribute('min', firstDateW);

        var range_val = $('#customRange').val();
        if (range_val > 0) {
            /* set range for */
            var rvalue = (range_val - 0) / (7 - 0) * 100;
            $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + rvalue + '%, #fff ' + rvalue + '%, white 100%)');

            var curr = new Date;
            var date = new Date(curr);
            var first = date.getDate() - date.getDay() + 1;

            var last = first + 6; // last day is the first day + 6

            var firstday = new Date(date.setDate(first)).toUTCString();
            var lastday = new Date(date.setDate(last)).toUTCString();
            var firstDate = formatDate(firstday);
            var lastDate = formatDate(lastday);
            $('#StartDate').val(firstDate);

            $('#EndDate').val(lastDate);

            var planned = <?php echo json_encode($current_week_plan); ?>;
            console.log(planned);
            planned.forEach(function(item) {

                var subject_id = item.subject_id;
                var chapter_id = item.chapter_id;
                var chapter_name = item.chapter_name;
                var status = item.test_completed_yn;
                $('#planner_sub_' + subject_id).append('<div class="add-removeblock p-2 mb-2 d-flex align-items-center" id="chapter_' + chapter_id + '"><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' + chapter_id + '"><span id="select_chapt_name' + chapter_id + '" class="topic_name">' + chapter_name + '</span>' +
                    '<span class="ms-auto"><a href="javascript:void(0)" onclick="suffle_Chapter(' + chapter_id + ',' + subject_id + ')" ><img class="mx-2" src="./public/after_login/images/refersh_ic.png"></a></span><span class=""><a href="javasceript:void(0)" class="chapter_remove"><img src="./public/after_login/images/remove_ic.png"></a></span></div>');
            });

        }


        $('#StartDate').change(function(event) {
            var start_date = this.value;

            $.ajax({
                url: "{{ 'getWeeklyPlanSchedule' }}",
                type: "GET",
                cache: false,
                data: {
                    'start_date': start_date
                },
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);
                    if (response.range > 0) {
                        $("div").remove(".add-removeblock");
                        $('#customRange').val(response.range);
                        $('#slide-input').html(response.range);

                        var ran_value = (response.range - 0) / (7 - 0) * 100;
                        $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + ran_value + '%, #fff ' + ran_value + '%, white 100%)');


                        var planned_edit = response.planner;
                        var result = Object.values(planned_edit);


                        result.forEach(function(item) {
                            console.log(item);
                            var subject_id = item.subject_id;
                            var chapter_id = item.chapter_id;
                            var chapter_name = item.chapter_name;
                            var status = item.test_completed_yn;
                            $('#planner_sub_' + subject_id).append('<div class="add-removeblock p-2 mb-2 d-flex align-items-center" id="chapter_' + chapter_id + '"><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' + chapter_id + '"><span id="select_chapt_name' + chapter_id + '" class="topic_name">' + chapter_name + '</span>' +
                                '<span class="ms-auto"><a href="javascript:void(0)" onclick="suffle_Chapter(' + chapter_id + ',' + subject_id + ')" ><img class="mx-2" src="./public/after_login/images/refersh_ic.png"></a></span><span class=""><a href="javasceript:void(0)" class="chapter_remove"><img src="./public/after_login/images/remove_ic.png"></a></span></div>');
                        });

                    } else {
                        $("div").remove(".add-removeblock");
                        $('#customRange').val(response.range);
                        $('#slide-input').html(response.range);
                        var ran_value = (response.range - 0) / (7 - 0) * 100;
                        $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + ran_value + '%, #fff ' + ran_value + '%, white 100%)');

                    }
                }
            });
        });

        $('#search_field').keyup(function(event) {
            $.ajax({
                url: "{{ 'searchFreind' }}",
                type: "GET",
                cache: false,
                data: {
                    'search_text': event.target.value
                },
                success: function(data) {

                    let html = '';

                    if (data.success === true) {
                        $.each(data.response, (ele, val) => {
                            if (val.user_profile_img) {
                                var img_url = val.user_profile_img;
                            } else {
                                var img_url = "{{URL::asset('public/after_login/images/profile.png')}}";
                            }
                            html += `<li><div class="d-flex align-items-center"><span class="sno me-3">${val.user_rank}.</span>
                                                                <span><img src="${img_url}" class="leader-pic"/></span>
                                                                <div class="leader-txt">
                                                                    <p>${val.user_name}</p>
                                                                    <small>${val.score} Unique score</small>
                                                                </div>
                                                            </div>
                                                        </li>`;
                        });

                    } else {
                        html += `<p>Data not available!</p>`;
                    }
                    $('#search_results .leaderNameBlock-search').html(html);
                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.close').click(function() {
            $('#collapseExample').hide();

            calendari(document.getElementById('calendari'), new Date());
        });
        /*edit planner*/
        var chapters = $('input[name="chapters[]"]').length;
        var limit = $('#customRange').val();
        $('#slide-input').html(chapters);
        $('input[name="weekrange').val(chapters);
        var rvalue1 = (chapters - 0) / (7 - 0) * 100;
        $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + rvalue1 + '%, #fff ' + rvalue1 + '%, white 100%)');

        /*edit planner*/

        /*Refer Firend*/
        $('.btn-close').click(function() {
            $('#referEmails').val('');
        });
        /*Refer Firend*/
    });
</script>