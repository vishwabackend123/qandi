@extends('layouts.app')
@section('content')
<section class="login-bg-img">
    <span class="outer-logo"><a href="{{ env('LANDING_URL') }}"><img src="{{URL::asset('public/images_new/QI_Logo.gif')}}" alt="logo not find"></a></span>
    <!--subject_screen-->
    <div id="main" class="subject_screen">
        <div class="row">
            <div class="col-md-12 mx-auto  ">
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
});

</script>
@endsection
