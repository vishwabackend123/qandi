<header>
    <div class="headerMain">
        <div class="headerLeft">
            <h2>Dashboard</h2>
            <h6><label>Cource:</label>
                <span>{{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</span>
            </h6>
        </div>
        <div class="headerRight">
            <span class="usertext"><a href="javascript:;">Hi {{ucwords($userData->user_name)}}</a></span>
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
            <span class="headericon dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <path d="M16.666 17.602v-1.667a3.333 3.333 0 0 0-3.333-3.333H6.666a3.333 3.333 0 0 0-3.333 3.333v1.667M10 9.268a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666z" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profile & Subscription</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </span>
        </div>
    </div>
</header>
<!--notification-right End-->
<div class="notification-block_new  collapse" id="collapseNotification2">
    <div class="planner-wrapper ">
        <div class="notification-main">
            <h2>Notifications <a href="{{route('clearAllNotifications')}}">Clear all</a></h2>
            <div class="new_notification_main_sec">
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
                @endif
            </div>
        </div>
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
