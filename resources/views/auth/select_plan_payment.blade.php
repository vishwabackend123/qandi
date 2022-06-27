<style>
    .fullbody_scan_card{border-top-left-radius: 30px;border-bottom-left-radius:30px;padding: 20px 40px;box-shadow: 0 8px 30px 0 rgba(172, 185, 176, 0.14);border: solid 3px #fff;background-color: #fff;color: #363c4f;}
    .fullbody_scan_card p{font-weight:500;font-size:16px;    color: #363c4f;}
    .fullbody_scan_card ul li{font-size:14px;display: flex;justify-content: space-between;}
    .fullbody_scan_card ul li span{font-weight:600;}
    .custom-border{ display: block;background-color: rgba(86, 182, 99, 0.2);}
    .fullbody_scan_test {padding:15px 0 40px 0px;background-color: #56b663;border-top-right-radius: 30px;border-bottom-right-radius: 30px;background-image: url(public/after_login/current_ui/images/fullscan-card-bg.png);
    background-repeat: no-repeat;background-size: cover;}
    .fullbody_scan_test span:first-child {position: absolute;right: 0px;top:10px;}
    .fullbody_scan_test span:nth-child(2) {position: absolute;left: 0px;top: 50%;transform: translateY(-50%);}
    .fullbody_scan_test h3 {font-size: 24px;font-weight: 800;color: #fff;}
    .fullbody_scan_test p{font-size: 16px;font-weight: 600;color: #fff;max-width: 235px;margin: 0 auto;}
    .btn.btn-common-white {border-radius: 8px;background-color: #fff;font-size: 14px;font-weight: 800;color: #56b663;padding: 8px;min-width: 160px;}
    .btn.btn-common-transparent {padding: 8px 16px;border-radius: 8px;border: solid 1px #56b663;background-color: #f5faf6;color: #56b663;font-size: 14px;font-weight: 800;min-width: 250px;}
</style>
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