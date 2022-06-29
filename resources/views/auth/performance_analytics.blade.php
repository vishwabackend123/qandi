
@extends('layouts.app')
@section('content')
<section class="subscriptionsPage d-flex">
    <div class="subscriptionsLeftpannel">
        <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo">
        <div class="progress-box">
            <ul class="progressorder">
                <li class="progress__item  progress__item--active">
                    <p class="progress__title">Select Plan</p>
                    <p class="progress__info">Decide on the best plan for your preparation</p>
                </li>
                <li class="progress__item">
                    <p class="progress__title">Self Analysis</p>
                    <p class="progress__info">Rate your level of proficiency</p>
                </li>
                <li class="progress__item ">
                    <p class="progress__title">You order is out for delivery</p>
                    <p class="progress__info">Delivery Executive is out for delivery</p>
                </li>
            </ul>
        </div>
        <div class="verificationBox">
            <p>A verification link has been sent to<b> Sakshi@gmail.com</b>, please click the link to get your account verified</p>
            <a href="">Resend</a>
        </div>
    </div>
    <div class="selectPlan subscriptionsRightpannel">
        <div class="SelectPlane_text">
            <h3>Full Body Scan</h3>
            <p>To assess your preparedness</p>
        </div>
        <div class="fullbody_scan_wrapper">
            <div class="fullbody_scan_box d-flex">
                <div class="fullbody_scan_card w-50">
                    <p class="mt-0">Please attempt the Full Body Scan test, so that we can generate tasks for you, based on your proficiency levels.</p>
                    <span class="custom-border"></span>
                    <ul style="margin-top:32px">
                        <li class="mb-3">No of Questions: <span>75 questions</span></li>
                        <li class="mb-3">Duration <span>3 hours</span></li>
                        <li>Subjects <span>Mathematics, Physics & Chemistry</span></li>
                    </ul>
                </div>
                <div class="fullbody_scan_test w-50 text-center position-relative">
                    <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-big.png')}}"></span>
                    <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-small.png')}}"></span>
                    <img src="{{URL::asset('public/after_login/current_ui/images/note.png')}}" style="max-width: 85px;">
                    <h3 class="mb-0 mt-2">Full Body Scan Test</h3>
                    <p class="my-3">to assess your preparedness and begin to improve it</p>
                    <button class="btn btn-common-white">Attempt Now</button>
                </div>
            </div>
            <div class="mt-5 text-right">
                <button class="btn btn-common-transparent">Skip to Dashboard</button>
            </div>
        </div>
    </div>
</section>
@endsection