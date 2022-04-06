@extends('afterlogin.layouts.app_new')
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
    <div class="content-wrapper">
        <div class="container-fluid list-series">
            <div class="row">
                <div class="col-lg-12  p-lg-5">
                    <div class="tab-wrapper live-exam">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-circle text-danger me-3" aria-hidden="true"></i> LIVE EXAM</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="over-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="true"><i class="fa fa-circle text-danger me-3" aria-hidden="true"></i> LIVE EXAM RESULTS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content cust-tab-content  bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h4 class="py-3">Upcoming Live Exams</h4>
                                <div class="scroll-div-live-exm pb-0 mb-3">
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="completed" role="tabpanel" aria-labelledby="over-tab">
                                <h4 class="py-3">Live Exams Results</h4>
                                <div class="scroll-div-live-exm pb-0 mb-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('afterlogin.layouts.footer_new')
<script type="text/javascript">
/*$('.scroll-div-live-exm').slimscroll({
        height: '60vh'
    });*/
$(window).on('load', function() {
    $(".dash-nav-link a:first-child").removeClass("active-navlink");
    $(".dash-nav-link a:nth-child(2)").addClass("active-navlink");
});

</script>
@endsection
