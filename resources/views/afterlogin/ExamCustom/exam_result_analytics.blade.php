@extends('afterlogin.layouts.app')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- BS JavaScript -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
    $(window).load(function() {
        $('#endExam').modal('show');
    });
</script>
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')

<div class="main-wrapper bg-gray">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div id="exam_result_analysis">

    </div>


</div>
<div class="modal fade" id="endExam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0  ">
            <div class="modal-header border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">

                <h2 class="mb-3">Impressive!</h2>
                <p>You successfully completed the test.
                    Now let's see how you did.</p>
                <button type="button" class="btn btn-danger rounded-0 px-5 mt-5" data-bs-dismiss="modal" aria-label="Close">SEE ANALYTICS</button>
            </div>

        </div>
    </div>
</div>
@include('afterlogin.layouts.footer')
<script>
    $(document).ready(function() {
        url = "{{ url('exam_result_analysis/') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {

                $("#exam_result_analysis").html(result);

            }
        });
    });
</script>

@endsection