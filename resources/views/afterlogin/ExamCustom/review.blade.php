@extends('afterlogin.layouts.app')

@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper bg-gray">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9  ps-lg-4">
                    <button type="button" class="btn btn-danger back-to-d-btn">Back to dashboard</button>
                    <div class="tab-wrapper h-100">
                        <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mathematics</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Physics</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Chemistry</a>
                            </li>
                        </ul>

                        <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="question-block">
                                    <a href="#" class="arrow prev-arow"><i class="fa fa-angle-left"></i></a>
                                    <a href="#" class="arrow next-arow"><i class="fa fa-angle-right"></i></a>
                                    <p class="question pb-5 pt-5"><span class="q-no">Q1.</span>AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>
                                    <div class="ans-block row mt-5">
                                        <div class="col-md-6 mb-4">
                                            <div class="border p-3 ans">
                                                <p class="question m-0  "><span class="q-no">A.</span>2.5 radians</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6  mb-4">
                                            <div class="border p-3 ans btn-light-red">
                                                <p class="question m-0  "><span class="q-no">B.</span>2.5 radians</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6  mb-4">
                                            <div class="border p-3 ans btn-light-green">
                                                <p class="question m-0  "><span class="q-no">C.</span>2.5 radians</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6  mb-4">
                                            <div class="border p-3 ans">
                                                <p class="question m-0  "><span class="q-no">D.</span>2.5 radians</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="answer-block p-3 mb-5">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p class="mb-0 text-green">answer :</p>
                                        </div>

                                        <div class="col-md-7">
                                            <p class="mb-0 text-green">(C) 3.5 radians</p>
                                        </div>

                                        <div class="col-md-3 text-end">
                                            <button type="button" class="btn btn-success btn-green answer-percentage-btn" data-bs-toggle="collapse" data-bs-target="#perecent-box">21%</button>
                                        </div>
                                        <div class="col-md-12 percentage-box collapse" id="perecent-box">
                                            <div class="d-flex p-4 bg-gray">
                                                <div class="">
                                                    <h3>21%</h3>
                                                </div>
                                                <div class="">
                                                    <h5>Of the people have got this right</h5>
                                                </div>
                                            </div>
                                            <div class="bg-white p-3">
                                                <p>to answer this, you should have</p>

                                                <p class="mb-0">knowledge of</p>
                                                <button type="button" class="btn btn-danger mb-3" data-bs-toggle="collapse" data-bs-target="#perecent-box1">ARC & RADIUS</button>

                                                <p class="mb-0">knowledge and application of</p>
                                                <button type="button" class="btn btn-danger">Pythagoras Theorem</button>

                                            </div>

                                        </div>

                                        <div class="col-md-12 percentage-box arc-radius-box collapse" id="perecent-box1">
                                            <div class=" p-4 bg-gray">
                                                <div class="d-flex">
                                                    <div class="">
                                                        <h6 class="text-danger">ARC & RADIUS</h6>
                                                    </div>
                                                    <div class="text-end">
                                                        <ul>
                                                            <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                                            <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                                            <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                                            <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mt-3 pt-1">
                                                    <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                                        <ol class="breadcrumb mb-0">
                                                            <li class="breadcrumb-item text-danger">/ Basic Geometry /</li>
                                                            <li class="breadcrumb-item text-danger">Geometry /</li>
                                                        </ol>
                                                    </nav>
                                                </div>
                                            </div>
                                            <div class="bg-white p-4">
                                                <p>AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>

                                                <p class="mb-0">AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-7">
                                            Use the formula L = θ × r,<br>
                                            where<br>
                                            L = arc length = 42<br>
                                            cm θ is the angle AOB (in radians) and r = radius =<br>
                                            12 cm<br>
                                            <br>
                                            42 = θ × 12 ⇒ θ<br>
                                            = 42 ÷ 12<br>
                                            = 3.5<br>
                                            <br>
                                            The angle is 3.5 radians.
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-5 pt-2">

                    <div class="bg-white d-flex flex-column justify-content-center mb-4  py-4 px-4">
                        <p>Question Palette</p>
                        <div class="number-block">
                            <button class="btn btn-light-red mb-4 rounded-0">1</button>
                            <button class="btn btn-light-red mb-4 rounded-0">2</button>
                            <button class="btn btn-light-red mb-4 rounded-0">3</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">4</button>
                            <button class="btn btn-light-red rounded-0 mb-4">5</button>
                            <button class="btn btn-light mb-4 rounded-0">6</button>
                            <button class="btn btn-light-green mb-4 rounded-0">7</button>
                            <button class="btn btn-light-red  mb-4 rounded-0">8</button>
                            <button class="btn btn-light-red  mb-4 rounded-0">9</button>
                            <button class="btn btn-light-red rounded-0 mb-4">10</button>
                            <button class="btn btn-light mb-4 rounded-0">11</button>
                            <button class="btn btn-light mb-4 rounded-0">12</button>
                            <button class="btn btn-light mb-4 rounded-0">13</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">14</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">15</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">16</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">17</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">18</button>
                            <button class="btn btn-light-red  mb-4 rounded-0">19</button>
                            <button class="btn btn-light mb-4 rounded-0">20</button>
                            <button class="btn btn-light mb-4 rounded-0">21</button>
                            <button class="btn btn-light mb-4 rounded-0">22</button>
                            <button class="btn btn-light-red  mb-4 rounded-0">23</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">24</button>
                            <button class="btn btn-light-green  mb-4 rounded-0">25</button>

                        </div>
                    </div>
                    <div class="bg-white d-flex flex-column justify-content-center mb-4 py-4 px-4 review-questions">
                        <div class="d-flex mb-3">
                            <div class="col heading">
                                <h5>Review Questions.</h5>
                            </div>
                            <div class="col text-end">
                                <div class="dropdown">
                                    <a class="btn rotate-icon pt-0 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true"></i></a>


                                    <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"> Attempted</a></li>
                                        <li><a class="dropdown-item" href="#"> Wronged</a></li>
                                        <li><a class="dropdown-item" href="#"> Unattempted</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex align-items-center">
                            <div class="review-questions-box border-left-green5 mx-2 mb-3">
                                <div class="d-flex">
                                    <div class="me-3">Q1. </div>
                                    <p class="mb-0">AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center4">
                            <div class="review-questions-box border-left-green5 mx-2 mb-3">
                                <div class="d-flex">
                                    <div class="me-3">Q1. </div>
                                    <p class="mb-0">AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center4">
                            <div class="review-questions-box border-left-red5 mx-2 mb-3">
                                <div class="d-flex">
                                    <div class="me-3">Q1. </div>
                                    <p class="mb-0">AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center4">
                            <div class="review-questions-box border-left-red5 mx-2 mb-3">
                                <div class="d-flex">
                                    <div class="me-3">Q1. </div>
                                    <p class="mb-0">AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of </p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('afterlogin.layouts.footer')

<script type="text/javascript">
    $('.scroll-div').slimscroll({
        height: '40vh'
    });
    $('.number-block').slimscroll({
        height: '30vh'
    });
    $('.answer-block').slimscroll({
        height: '30vh'
    });
</script>

@endsection