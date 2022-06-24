@extends('afterlogin.layouts.app')
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


<div class="main-wrapper bg-gray">

    <div class="modal fade show" id="endExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0  ">
                <div class="modal-header pb-0 border-0">
                    <a href="{{route('live_exam_list')}}" type="button" class="btn-close"></a>
                </div>


                @if(isset($autosubmit) && $autosubmit==true)
                <div class="modal-body pt-3 pb-5 px-5 text-center">
                    <h5 class="mb-3">Due to some illegal movement on the Live exam, your exam has been auto-submitted.
                    </h5>
                    <a class="btn btntheme" href="{{route('live_exam_list')}}" type="button" class="btn-close">Ok</a>
                </div>
                @else
                <div class="modal-body pt-3 pb-5 px-5 text-center">
                    <h2 class="mb-3">Impressive!</h2>
                    <p>You successfully completed the test.
                    </p>
                </div>
                @endif




            </div>
        </div>
    </div>
</div>
@include('afterlogin.layouts.footer_new')

@endsection