@extends('layouts.app')
@section('content')
<section class="login-bg-img">
    <span class="outer-logo"><a href="{{ env('LANDING_URL') }}"><img src="{{URL::asset('public/images_new/QI_Logo.gif')}}" alt="logo not find"></a></span>
    <!--subject_screen-->
    <div id="main" class="subject_screen">
        <div class="row">
            <div class="col-md-12 mx-auto  ">
                @if(count($errors) > 0 )
                <div class="toastdata active">
                    <div class="toast-content">
                        <i class="fa fa-exclamation-triangle check" aria-hidden="true"></i>
                         <div class="message">
                            @foreach($errors->all() as $error)
                            <span class="text text-2">{{$error}}</span>
                            @endforeach
                        </div>
                    </div>
                    <i class="fa fa-times close" aria-hidden="true"></i>
                    <div class="progress active"></div>
                </div>
                @endif
                <div class="bg-white white-box-big" id="chooseSub">
                    <div class="welcome-heading">How far are you in your preparation journey?</div>
                    <p class="welcome-msg text-center">This will help us personalise the Q&I experience for you</p>
                    <div class="row text-center pt-3">
                        <div class="col">
                            <div class="d-flex flex-column  h-100 w-100 click-box" id="startjust" onclick="user_stand('1', this.id);">
                                <span><img class="img-responsive stand-image" src="{{URL::asset('public/images_new/10.png')}}"></span>
                                <p class="pt-2">Just starting out</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column h-100 w-100 click-box" id="eleventh" onclick="user_stand('2', this.id);">
                                <span><img class="img-responsive stand-image" src="{{URL::asset('public/images_new/10+1.png')}}"></span>
                                <p class="pt-2">Completed (10+1) Syllabus</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column  h-100 w-100 click-box" id="twelfth" onclick="user_stand('3', this.id);">
                                <span><img class="img-responsive stand-image" src="{{URL::asset('public/images_new/10+2.png')}}"></span>
                                <p class="pt-2">Completed (10+2) Syllabus</p>
                            </div>
                        </div>
                    </div>
                    <form class="m-0" id="stand-form" method="post" action="{{route('standupstore')}}" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="user_stand_value" id="user_stand_value" value="" />
                        <span class="invalid-feedback m-0" role="alert" id="errlog_alert"> </span>
                        <div class="text-end mt-4">
                            <button class="btn btn-danger text-uppercase disbaled-btn rounded-0 px-5" id="goto-next-btn">Go Next &gt;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--subject_screen-->
</section>
<style type="text/css">
    
.toastdata.active {
    display: block;
}

.toastdata {
    border-radius: 12px;
    background: #fff;
    padding: 20px 35px 20px 25px;
    box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.1);
    display: none;
    position: absolute;
    width: 33%;
    z-index: 999;
    top: 12px;
    right: 25px;
}



.toastdata .toast-content {
    display: flex;
    align-items: center;
}

.toast-content .check {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 35px;
    min-width: 35px;
    background-color: #4070f4;
    color: #fff;
    font-size: 20px;
    border-radius: 50%;
}

.toast-content .message {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text {
    font-size: 16px;
    font-weight: 600;
    color: #00000091;
}

.message .text.text-1 {
    font-weight: 600;
    color: #333;
}

.toastdata .close {
    position: absolute;
    top: 10px;
    right: 15px;
    padding: 5px;
    cursor: pointer;
    color: #000;
}

.toastdata .close:hover {
    opacity: 1;
}

.toastdata .progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    border-radius: 12px;
}

.toastdata .progress:before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    height: 100%;
    width: 100%;
    background-color: #4070f4;
}

.progress.active:before {
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100% {
        right: 100%;
    }
}
</style>

<script>
function user_stand(div_val, div_id) {
    $('.click-box').removeClass('active');
    $('#' + div_id).addClass('active');

    $('#goto-next-btn').removeClass('disbaled-btn');
    $('#goto-next-btn').addClass('active-btn');

    $('#user_stand_value').val(div_val);
    $('#errlog_alert').hide();
}

$(document).ready(function() {
    $("#stand-form").validate({

        submitHandler: function(form) {
            var stand_for = $('#user_stand_value').val();
            if (stand_for == '' || stand_for == null) {
                $('#errlog_alert').html('Please select one option.');
                $('#errlog_alert').show();
                setTimeout(function() {
                    $('#errlog_alert').fadeOut('fast');
                }, 10000);
                return false;
            }

            form.submit();
        }

    });
    $(document).on('keypress', function(e) {
      var hasclass = $('#goto-next-btn').hasClass('disbaled-btn');
        if (e.which == 13 && e.which != true) {
            event.preventDefault();
            $("#goto-next-btn").trigger("click");
        }
    });
    setTimeout(() => {
        $('.toastdata').removeClass('active');
    }, 5000); //1s = 1000 milliseconds

    setTimeout(() => {
        $('.progress').removeClass('active');
    }, 5300);
    $('.close').click(function(){
        $('.toastdata').removeClass('active');
        $('.progress').removeClass('active');

    });
});

</script>
@endsection
