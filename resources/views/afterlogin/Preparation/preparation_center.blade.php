@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->

@include('afterlogin.layouts.sidebar')
<div class="main-wrapper">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12  p-lg-5">

                    <div class="tab-wrapper">
                        <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
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

                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="d-flex px-4 my-5 py-2 align-items-center justify-content-between">
                                    <span class="  mr-3 name-txt">Mathematics I - II</span>
                                    <div>
                                        <span class="me-2"><a href="#" data-bs-toggle="modal" data-bs-target="#PreparationCenter_modal"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                                        <span class="me-2"><a href="#" data-bs-toggle="modal" data-bs-target="#PreparationCenter_Notes"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                                        <span class="me-2"><a href="#" data-bs-toggle="modal" data-bs-target="#PreparationCenter_Video"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                                        <span><a href="#" data-bs-toggle="modal" data-bs-target="#PreparationCenter_bookmark"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>
                                    </div>


                                    <div class="d-flex align-items-center">
                                        <p class="m-0 pe-3">Overall Proficiency</p>
                                        <i class="fa fa-star text-success mx-2"></i>
                                        <i class="fa fa-star text-success mx-2"></i>
                                        <i class="fa fa-star text-success mx-2"></i>
                                        <i class="fa fa-star text-secondary mx-2"></i>
                                        <i class="fa fa-star text-secondary mx-2"></i>
                                    </div>
                                </div>
                                <div class="scroll-div">
                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                                        <span class="mr-3 name-txt">Trigonometry</span>


                                        <div>
                                            <span class="me-2"><a href="#" data-bs-toggle="modal" data-bs-target="#PreparationCenter_modal"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                                            <span class="me-2"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                                            <span class="me-2"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                                            <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>
                                        </div>


                                        <div class="d-flex align-items-center">
                                            <p class="m-0 pe-3">Proficiency</p>
                                            <i class="fa fa-star text-danger mx-2"></i>
                                            <i class="fa fa-star text-danger mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                        </div>
                                    </div>


                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                                        <span class="mr-3 name-txt">Trigonometry</span>

                                        <div>
                                            <span class="me-2"><a href="#" data-bs-toggle="modal" data-bs-target="#PreparationCenter_modal"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                                            <span class="me-2"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                                            <span class="me-2"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                                            <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>
                                        </div>


                                        <div class="d-flex align-items-center">
                                            <p class="m-0 pe-3">Proficiency</p>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap ">
                                        <span class="mr-3 name-txt">Trigonometry</span>

                                        <div>
                                            <span class="me-2"><a href="#" data-bs-toggle="modal" data-bs-target="#PreparationCenter_modal"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                                            <span class="me-2"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                                            <span class="me-2"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                                            <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>
                                        </div>


                                        <div class="d-flex align-items-center">
                                            <p class="m-0 pe-3">Proficiency</p>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                        </div>

                                    </div>

                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                                        <span class="mr-3 name-txt">Trigonometry</span>

                                        <div>
                                            <span class="me-2"><a href="#" data-bs-toggle="modal" data-bs-target="#PreparationCenter_modal"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                                            <span class="me-2"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                                            <span class="me-2"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                                            <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>
                                        </div>


                                        <div class="d-flex align-items-center">
                                            <p class="m-0 pe-3">Proficiency</p>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-success mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                            <i class="fa fa-star text-secondary mx-2"></i>
                                        </div>
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
<!-- Modal -->
<div class="modal fade" id="PreparationCenter_modal" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 px-5">
                <h2>Trigonometry</h2>
                <div class="d-flex align-items-center">
                    <div>
                        <div class="d-flex align-items-center">
                            <p class="m-0 pe-3">Proficiency</p>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-light mx-2"></i>
                            <i class="fa fa-star text-light mx-2"></i>
                        </div>
                    </div>
                    <div class="ms-auto">

                        <span class="me-1"><a href="#" data-bs-toggle="modal" class="bg-light-red link-dark py-3 px-2 d-inline-block" data-bs-target="#PreparationCenter_modal"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                        <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>

                    </div>
                </div>
                <div class="h-scroll-slim">
                    <div class="d-flex bg-white p-3 align-items-center mt-5">
                        <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon5.svg')}}" /></span>
                        <div>
                            <p class="text-danger m-0 pb-1">Presentation on Trigonometry I</p>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr</p>
                            <p class="mt-2 mb-0">36 Slides</p>
                        </div>
                    </div>
                    <div class="d-flex bg-white p-3 align-items-center mt-2">
                        <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon5.svg')}}" /></span>
                        <div>
                            <p class="text-danger m-0 pb-1">Presentation on Trigonometry I</p>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr</p>
                            <p class="mt-2 mb-0">36 Slides</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="PreparationCenter_Notes" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 px-5">
                <h2>Trigonometry</h2>
                <div class="d-flex align-items-center">
                    <div>
                        <div class="d-flex align-items-center">
                            <p class="m-0 pe-3">Proficiency</p>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-light mx-2"></i>
                            <i class="fa fa-star text-light mx-2"></i>
                        </div>
                    </div>
                    <div class="ms-auto">

                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                        <span class="me-1"><a href="#" class="bg-light-red link-dark py-3 px-2 d-inline-block"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                        <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>

                    </div>
                </div>
                <div class="h-scroll-slim">
                    <div class="d-flex bg-white p-3 align-items-center mt-5">
                        <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon6.svg')}}" /></span>
                        <div>
                            <p class="text-danger m-0 pb-1">Paper on Trigonometry - I</p>

                            <p class="mt-2 mb-0">JEE-A-QP-PCM-2022</p>
                        </div>
                    </div>
                    <div class="d-flex bg-white p-3 align-items-center mt-2">
                        <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon6.svg')}}" /></span>
                        <div>
                            <p class="text-danger m-0 pb-1">Paper on Trigonometry - I</p>

                            <p class="mt-2 mb-0">JEE-A-QP-PCM-2022</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="PreparationCenter_Video" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 px-5">
                <h2>Trigonometry</h2>
                <div class="d-flex align-items-center">
                    <div>
                        <div class="d-flex align-items-center">
                            <p class="m-0 pe-3">Proficiency</p>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-light mx-2"></i>
                            <i class="fa fa-star text-light mx-2"></i>
                        </div>
                    </div>
                    <div class="ms-auto">

                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                        <span class="me-1"><a href="#" class="bg-light-red link-dark py-3 px-2 d-inline-block"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                        <span><a href="#"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>

                    </div>
                </div>
                <div class="h-scroll-slim">
                    <div class="d-flex bg-white p-3 align-items-center mt-5">
                        <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon8.svg')}}" /></span>
                        <div>

                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,</p>
                            <p class="mt-2 mb-0">30 mins</p>
                        </div>
                    </div>
                    <div class="d-flex bg-white p-3 align-items-center mt-2">
                        <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon8.svg')}}" /></span>
                        <div>
                            <p class="text-danger m-0 pb-1">Paper on Trigonometry - I</p>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,</p>
                            <p class="mt-2 mb-0">30 mins</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="PreparationCenter_bookmark" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 px-5">
                <h2>Trigonometry</h2>
                <div class="d-flex align-items-center">
                    <div>
                        <div class="d-flex align-items-center">
                            <p class="m-0 pe-3">Proficiency</p>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-secondary mx-2"></i>
                            <i class="fa fa-star text-light mx-2"></i>
                            <i class="fa fa-star text-light mx-2"></i>
                        </div>
                    </div>
                    <div class="ms-auto">

                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                        <span class="me-1"><a href="#"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                        <span><a href="#" class="bg-light-red link-dark py-3 px-2 d-inline-block"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>

                    </div>
                </div>
                <div class="h-scroll-slim">
                    <div class="d-flex bg-white p-3  mt-5">
                        <span class="px-3">Q1</span>
                        <div>

                            <p>AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>
                            <p class="mt-2 mb-0 text-end">JEE-A-QP-PCM-2022</p>
                        </div>
                    </div>
                    <div class="d-flex bg-white p-3  mt-2">
                        <span class="px-3">Q2</span>
                        <div>

                            <p>AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>
                            <p class="mt-2 mb-0 text-end">JEE-A-QP-PCM-2022</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




@include('afterlogin.layouts.footer')


@endsection