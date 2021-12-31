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