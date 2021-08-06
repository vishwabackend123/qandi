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
                <div class="col-lg-12  p-lg-5">

                    <div class="tab-wrapper">
                        <ul class="nav nav-tabs cust-tabs-white" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-circle text-danger me-3" aria-hidden="true"></i> LIVE EXAM</a>
                            </li>

                        </ul>

                        <div class="tab-content cust-tab-content  bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form method="post" action="{{route('live_exam')}}" id="live_exam_form">
                                    <div class="scroll-div-live-exm">

                                        <div class="d-flex align-items-center justify-content-center h-100 flex-column">
                                            <p>Please enter your Registration ID and Passcode for live exam session</p>

                                            @csrf
                                            <div class="col-5 text-box mt-4 mb-3">
                                                <span class="text-icon"><img src="{{URL::asset('public/after_login/images/user-icon.png')}}"></span>
                                                <input type="email" placeholder="Registration ID">
                                            </div>
                                            <div class="col-5 text-box mt-4 ">
                                                <span class="text-icon"><img src="{{URL::asset('public/after_login/images/password.png')}}"></span>
                                                <input type="password" placeholder="Passcode">
                                            </div>
                                            <div class="col-5 text-center mt-4 ">
                                                <button class="btn btn-danger col-5 px-5 rounded-0">Sign In</button>
                                            </div>

                                        </div>

                                    </div>
                                </form>
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
        height: '60vh'
    });
</script>

@endsection