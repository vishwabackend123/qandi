@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')

<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
    window.onload = function() {

        $("#endExam").modal({
            backdrop: "static",
            keyboard: false
        });
        //$('#endExam').modal('show');
    }
</script>
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div id="exam_result_analysis">
        <div class="content-wrapper">
            <div class="container-fluid exam-analytics">
                <div class="row" id="score_block">
                </div>
                <div class="row mt-5 mb-3" id="attempt_count_block">
                </div>
                <div class="row mb-4" id="rank_block">
                </div>
            </div>
        </div>
        <!-- Modal Export Analytics-->
        <div class="modal fade" id="exportAnalytics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0 bg-light">
                    <div class="modal-header pb-0 border-0">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
                    </div>
                    <div class="modal-body pt-0 px-5 ">
                        <div class="text-center my-5">
                            <a href="{{route('export_analytics')}}">
                                <button class="btn px-4 top-btn-pop text-white">
                                    <i class="fa fa-download"></i> &nbsp;Download PDF
                                </button>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
<div class="modal fade" id="endExam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0  ">
            <div class="modal-header border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
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
        url1 = "{{ url('exam_result_analysis_score/') }}";


        $.ajax({
            url: url1,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {

                $("#score_block").html(result);

            }
        });

        url2 = "{{ url('exam_result_analysis_attempt/') }}";
        $.ajax({
            url: url2,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {

                $("#attempt_count_block").html(result);

            }
        });

        url3 = "{{ url('exam_result_analysis_rank/') }}";
        $.ajax({
            url: url3,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {

                $("#rank_block").html(result);

            }
        });
    });
    $(".topicdiv-scroll").slimscroll({
        height: "50vh",
    });
</script>

@endsection