
@extends('layouts.app')
@section('content')
<div class="fullbody_scan_wrapper" style="padding:50px;background-color: #f5faf6;">
    <div class="fullbody_scan_box d-flex">
        <div class="fullbody_scan_card w-50">
            <p class="border-bottom mt-0 pb-5 mb-5">Please attempt the Full Body Scan test, so that we can generate tasks for you, based on your proficiency levels.</p>
            <span class="custom-border"></span>
            <ul>
                <li class="mb-3">No of Questions: <span>75 questions</span></li>
                <li class="mb-3">Duration <span>3 hours</span></li>
                <li>Subjects <span>Mathematics, Physics & Chemistry</span></li>
            </ul>
        </div>
        <div class="fullbody_scan_test w-50 text-center position-relative">
            <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-big.png')}}"></span>
            <span><img src="{{URL::asset('public/after_login/current_ui/images/molecule-small.png')}}"></span>
            <img src="{{URL::asset('public/after_login/current_ui/images/note.png')}}">
            <h3 class="mb-0 mt-2">Full Body Scan Test</h3>
            <p class="my-3">to assess your preparedness and begin to improve it</p>
            <button class="btn btn-common-white">Attempt Now</button>
        </div>
    </div>
    <div class="mt-5 text-right">
        <button class="btn btn-common-transparent">Skip to Dashboard</button>
    </div>
</div>
@endsection