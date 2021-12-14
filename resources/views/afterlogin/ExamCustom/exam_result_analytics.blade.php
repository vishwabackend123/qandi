@extends('afterlogin.layouts.app_new')
<script type="text/javascript" src="{{URL::asset('public/js/jquery-3.6.0.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
</script>
<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
    $(window).load(function() {
        $("#endExam").modal({
            backdrop: "static",
            keyboard: false
        });
        $('#endExam').modal('show');
    });
</script>
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
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
@include('afterlogin.layouts.footer_new')
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