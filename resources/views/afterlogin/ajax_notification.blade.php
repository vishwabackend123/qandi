@if(isset($notifications) && !empty($notifications) && is_array($notifications))
@foreach($notifications as $val)
<div class="notification-txt">
    <div class="noti-box-scroll">
    <span class="bell-noti"><i class="fa fa-bell-o" aria-hidden="true"></i><div class="red-dot"></div></span>
    <span class="text-notific">{{ $val->message }}</span>
    </div>
    <div class="primary-secondry-btn">
        <button type="button" class="primary-btn1">primary</button>
        <button type="button" class="secondary-btn1">secondary</button>
    </div>
</div>
@endforeach
@endif