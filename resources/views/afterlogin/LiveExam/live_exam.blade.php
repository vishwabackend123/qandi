@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper bg-gray h-100">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12  p-lg-2">

                    <div class="tab-wrapper mt-0">
                        <ul class="nav nav-tabs cust-tabs-white" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-circle text-danger me-3" aria-hidden="true"></i> LIVE EXAM</a>
                            </li>

                        </ul>

                        <div class="tab-content cust-tab-content  bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="scroll-div-live-exm">

                                    <div class="d-flex align-items-center justify-content-center h-100 flex-column bg-blue">
                                        <!-- <p>Please wait for the Exam to start…</p> -->
                                        <p>No live exam available right now...</p>
                                    </div>





                                </div>

                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@include('afterlogin.layouts.footer')

<script type="text/javascript">
    $('.scroll-div-live-exm').slimscroll({
        height: '70vh'
    });
</script>
@endsection