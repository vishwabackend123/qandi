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
