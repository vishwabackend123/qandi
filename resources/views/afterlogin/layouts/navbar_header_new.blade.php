@php
$userData = Session::get('user_data');
$action = Route::currentRouteName();
if($action =='dashboard')
{
$name = "Dashboard";
}elseif($action == 'dashboard-DailyTask')
{
$name = 'Task Center';
}elseif($action == 'dashboard-MyQMatrix')
{
$name = 'MyQ Matrix';
}
else
{
$name = $action;
}
@endphp
<header>
    <div class="headerMain">
        <div class="headerLeft">
            <span class="sidebar-logo d-inline-block mobile_block">
                <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo">
            </span>
            <h2 class="text-capitalize mobile_hide">{{isset($header_title)?$header_title:$name}}</h2>
            <h6 class="mobile_hide"><label>Course:</label>
                <span>{{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</span>
            </h6>
        </div>
        <div class="headerRight">
            <span class="usertext mobile_hide"><a href="javascript:;">Hi {{ucwords($userData->user_name)}}<span>!</span></a></span>
            <span class="headericon notificationnew">
                <a draggable="false" id="nodificbell" data-bs-toggle="collapse" href='#collapseNotification2' role="button" aria-expanded="false" aria-controls="collapseNotification" title="Notification">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <g clip-path="url(#5ju4071vya)">
                            <path d="M15 6.768a5 5 0 0 0-10 0c0 5.833-2.5 7.5-2.5 7.5h15S15 12.6 15 6.768zM11.44 17.602a1.666 1.666 0 0 1-2.882 0" stroke="#363C4F" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                            @if(isset($notifications) && !empty($notifications) && is_array($notifications))
                            <circle cx="14" cy="4.102" r="4" fill="#F7758F" stroke="#fff" stroke-width="2" />
                            @endif
                        </g>
                        <defs>
                            <clipPath id="5ju4071vya">
                                <path fill="#fff" transform="translate(0 .102)" d="M0 0h20v20H0z" />
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </span>
            <span class="headericon  mobile_block mobilenav" id="menumobile">
                <a href="javascript:;">
                    <img src="public/after_login/current_ui/images/mobile-nav.svg" alt="" class="mobileicon">
                </a>
            </span>
            <span class="headericon  mobile_block mobilenav" id="menumobilehide">
                <a href="javascript:;">
                    <img src="public/after_login/current_ui/images/cross-menu.svg" alt="" class="mobileicon">
                </a>
            </span>
            <span class="headericon dropdown mobile_hide">
                <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="User">
                    @if(isset($userData->user_profile_img))
                    <img src="{{ $imgPath ?? '' }}" class="profileicon" />
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <path d="M16.666 17.602v-1.667a3.333 3.333 0 0 0-3.333-3.333H6.666a3.333 3.333 0 0 0-3.333 3.333v1.667M10 9.268a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666z" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    @endif
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profile & Subscription</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </span>
        </div>
    </div>
    <div class="mobilemenu"></div>
</header>

<!--notification-right End-->
<div class="notification-block_new  collapse" id="collapseNotification2">
    <div class="notificationOverlay"></div>

    <div class="planner-wrapper ">
        <div class="notification-main">
            <h2>Notifications <a href="javascript:void(0);" id="clearAll">Clear all</a></h2>
            <div class="new_notification_main_sec" id="recent_notify">
                @if(isset($notifications) && !empty($notifications) && is_array($notifications))
                @foreach($notifications as $val)
                <div class="notification-list">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="20" fill="#E0F6E3" />
                                <path d="M26 16a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9zM21.73 29a2 2 0 0 1-3.46 0" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="main-text">{{ $val->message }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div>No new notification!</div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--main-profile-section-->

<script>
      
    $(".notificationOverlay").click(function() {
        $(".notification-block_new").removeClass("activeblock");
        $(".notification-block_new").removeClass("show");
        $(".notificationnew").removeClass("bellactive");
        $(".notification-main").hide();
        $('html').removeClass("scrollnone");
    });
    $(".notificationnew").click(function() {
        $(".notification-main").show();

    });
</script>


<script>
    $(document).on('click', '#nodificbell', function(event) {
        refresh_notification();
    });

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

    function refresh_notification() {
        $.ajax({
            url: "{{ url('/refresh-notifications',) }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response_data) {
                $('#recent_notify').html(response_data);

            },
        });
    }

    /*****Mobile-menu js*********** */
    $("#menumobile").click(function() {
        $('html').addClass("windowhidden")
        $('body').addClass("sidebartoggle")
        $(this).hide();
        $('#menumobilehide').show();
        $('.sidebar_block').addClass('showmenu');
    });
    $("#menumobilehide").click(function() {
        $('html').removeClass("windowhidden")
        $('body').removeClass("sidebartoggle")
        $(this).hide();
        $("#menumobile").show();
        $('.sidebar_block').removeClass('showmenu');
    });

    // $('.notificationnew').click(function() {
    //     $('body').removeClass("sidebartoggle")
    //     $('.sidebar_block').removeClass('showmenu');
    // });

    /*****Mobile-menu js*********** */
    $('#clearAll').click(function() {
        $.ajax({
            url: "{{route('clearAllNotifications')}}",
            type: 'GET',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response_data) {
                $('#collapseNotification2').removeClass('show');
                $('#collapseNotification2').removeClass('activeblock');

                $('.notificationnew').removeClass('bellactive');
                $('html').removeClass("scrollnone");
            },
        });
    });
</script>
<script>
    $(window).scroll(function() {
	var $height = $(window).scrollTop();
    if($height > 10 && $height < 20) {
        $('.notification-main').css("top", "-15px");
        } else if ($height > 20 && $height < 34) {
            $('.notification-main').css("top", "-22px");
        }else if ($height > 40){
            $('.notification-main').css("top", "-45px");
        } else if ($height > 34) {
            $('.notification-main').css("top", "-35px");
        }  else {
            $('.notification-main').css("top", "7px");
        } {
        }
    });
  
</script>
 