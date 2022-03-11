@extends('layouts.app')

@section('content')
<nav class="py-0 px-7 navbar navbar-expand-lg trans-navbar">
    <div class="container-fluid"><a href="{{ env('LANDING_URL') }}" class="navbar-brand"><img src="{{URL::asset('public/images/main-logo.png')}}" class="img-fluid" /></a></div>
</nav>
<div id="main" class=" h-100">
    <div class="row">
        <div class="col-md-8 mx-auto  ">
            <div class="bg-white white-box-big">
                <div class="welcome-heading">How far are you in your preparation journey?</div>
                <p class="welcome-msg text-center">Tell us so we can personalise Q&I experience especially for you</p>

                <div class="row text-center pt-3">
                    <div class="col">
                        <div class="d-flex flex-column  h-100 w-100 click-box" id="startjust" onclick="user_stand('1', this.id);">
                            <span><img class="img-responsive stand-image" src="{{URL::asset('public/images/10.png')}}"></span>
                            <p class="pt-2">Just starting out</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex flex-column h-100 w-100 click-box" id="eleventh" onclick="user_stand('2', this.id);">
                            <span><img class="img-responsive stand-image" src="{{URL::asset('public/images/10+1.png')}}"></span>
                            <p class="pt-2">Completed (10+1) Syllabus</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex flex-column  h-100 w-100 click-box" id="twelfth" onclick="user_stand('3', this.id);">
                            <span><img class="img-responsive stand-image" src="{{URL::asset('public/images/10+2.png')}}"></span>
                            <p class="pt-2">Completed (10+2) Syllabus</p>
                        </div>
                    </div>
                </div>
                <form id="stand-form" method="post" action="{{route('standupstore')}}">
                    @csrf
                    <input type="hidden" name="user_stand_value" id="user_stand_value" value="" />
                    <span class="invalid-feedback m-0" role="alert" id="errlog_alert"> </span>
                    <div class="text-end mt-5">
                        <button class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-next-btn">Go Next ></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>

<script>
    function user_stand(div_val, div_id) {
        $('.click-box').removeClass('active');
        $('#' + div_id).addClass('active');

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