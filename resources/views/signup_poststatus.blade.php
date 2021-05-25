@extends('layouts.app')

@section('content')

<div id="main">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="bg-white white-box-big">
                <div class="welcome-heading">Tell us where do you stand right now.. </div>
                <p class="welcome-msg text-center">So that we can help you better</p>

                <div class="row text-center">
                    <div class="col p-4 ">
                        <div class="d-flex flex-column p-3 h-100 w-100 click-box">
                            <span><img src="{{URL::asset('public/images/pic1.png')}}"></span>
                            <p class="pt-4">Just starting out now</p>
                        </div>
                    </div>
                    <div class="col p-4">
                        <div class="d-flex flex-column p-3 h-100 w-100 click-box">
                            <span><img src="{{URL::asset('public/images/pic2.png')}}"></span>
                            <p class="pt-4">Completed (10+1) Syllabus</p>
                        </div>
                    </div>
                    <div class="col p-4">
                        <div class="d-flex flex-column p-3 h-100 w-100 click-box">
                            <span><img src="{{URL::asset('public/images/pic3.png')}}"></span>
                            <p class="pt-4">Completed (10+2) Syllabus</p>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-5"> <button class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Go Next ></button></div>

            </div>
        </div>
    </div>





</div>

@endsection