@if(!empty($data))
<div class="d-flex align-items-center justify-content-between ">
    <div class="web-intro">
        <span class="web-subtitle">Crash Course Tutorial</span>
        <span class="web-maintitle">
            Introduction to {{$data->session_name}}
        </span>
        <p class="mt-4 mb-0">
            <i class="fas fa-calendar-check-o"></i>
            {{ date('l jS', strtotime(date('Y-m-d')))}}
        </p>
        <p class=" mb-0">
            <i class="far fa-clock"></i> {{ date('H:i a',$data->session_start_time)}} IST
        </p>
    </div>
    <div class="px-5">By</div>
    <div class="web-author text-center d-flex flex-column h-100">
        <img src="{{URL::asset('public/after_login/images/userpics.png')}}" class="author-pic" />
        <h5 class="mt-3 mb-2">{{$data->session_taken_by}}</h5>
        <p class=" mb-2"></p>
        <small class="mb-0"></small>
    </div>
</div>
<button class="pull-right btn btn-danger mt-4 rounded-0 fw-normal" onclick="upcomming_tutorials_signup('{{$data->tutorial_id}}')">
    Let’s get you registered >
</button>
@else
<div class="w-100 text-center fs-3 align-items-center my-auto justify-content-center h-100 flex-column" style="min-height:200px;">
    No tutorial session available.
</div>
@endif
