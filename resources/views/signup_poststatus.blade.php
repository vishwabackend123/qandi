@extends('layouts.app')

@section('content')

<div id="main" class="py-5 h-100">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5 py-3">
            <div class="bg-white white-box-big">
                <div class="welcome-heading">Tell us where do you stand right now.. </div>
                <p class="welcome-msg text-center">So that we can help you better</p>

                <div class="row text-center">
                    <div class="col p-4 ">
                        <div class="d-flex flex-column p-3 h-100 w-100 click-box" id="startjust" onclick="user_stand('1', this.id);">
                            <span><img src="{{URL::asset('public/images/pic1.png')}}"></span>
                            <p class="pt-4">Just starting out now</p>
                        </div>
                    </div>
                    <div class="col p-4">
                        <div class="d-flex flex-column p-3 h-100 w-100 click-box" id="eleventh" onclick="user_stand('2', this.id);">
                            <span><img src="{{URL::asset('public/images/pic2.png')}}"></span>
                            <p class="pt-4">Completed (10+1) Syllabus</p>
                        </div>
                    </div>
                    <div class="col p-4">
                        <div class="d-flex flex-column p-3 h-100 w-100 click-box" id="twelfth" onclick="user_stand('3', this.id);">
                            <span><img src="{{URL::asset('public/images/pic3.png')}}"></span>
                            <p class="pt-4">Completed (10+2) Syllabus</p>
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


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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