@extends('afterlogin.layouts.app_new')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- BS JavaScript -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
    $(window).load(function() {
        $("#endExam").modal({
            backdrop: "static",
            keyboard: false
        });
        $('#endExam').modal('show');
    });

    $(document).ready(function() {
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
    });
</script>




@section('content')
<!-- Side bar menu -->
<div class="main-wrapper bg-gray model_popup_live_result">

    <div class="modal fade show" id="endExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom_modal">
                <div class="modal-header pb-0 border-0">
                    <a href="{{route('live_exam_list')}}" type="button" class="btn-close closesvg"> <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M26 14 14 26M14 14l12 12" stroke="#1F1F1F" stroke-width="1.71" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
      </a>
                </div>


                @if(isset($autosubmit) && $autosubmit==true)
                <div class="modal-body text-center p-0">
                    <h5 class="mb-4 pb-2 autosub">Due to some illegal movement on the Live exam, your exam has been auto-submitted
                    </h5>
                    <a class="btn btn-common-green btntheme" href="{{route('live_exam_list')}}" type="button" class="btn-close">OK</a>
                </div>
                @else
                <div class="modal-body pt-3 pb-4 px-4 text-center">
                    <h2 class="mb-3">Impressive!</h2>
                    <p>You successfully completed the test.
                    </p>
                    <a class="btn btn-common-green btntheme mt-3" href="{{route('live_exam_list')}}" type="button" class="btn-close">OK</a>
                </div>
                @endif




            </div>
        </div>
    </div>
</div>
@include('afterlogin.layouts.footer_new')

@endsection
<script>
$('.submitBtnlink').click(function() {
    $('body').addClass("make_me_blue");
});
</script>