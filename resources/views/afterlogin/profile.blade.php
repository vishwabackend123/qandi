@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')

<body class="bg-content">
    <div class="main-wrapper">
        @include('afterlogin.layouts.navbar_header_new')
        @include('afterlogin.layouts.sidebar_new')
        <section class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="info">
                            <h1 class="main-title">Personal info</h1>
                            <p>Update your personal details here.</p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row pt-4">
                            <div class="col-lg-6">
                                <div class="custom-input pb-4">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" value="{{$userData->first_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-input pb-4">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" value="{{$userData->last_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-input pb-4">
                                    <label>Display Name</label>
                                    <input type="text" class="form-control" placeholder="Display Name" value="{{$userData->user_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-input pb-4">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email" value="{{$userData->email}}">
                                </div>
                            </div>
                            <div class="col-lg-6 custom-input pb-4">
                                <label>State</label>
                                <select class="form-control selectdata">
                                    <option class="we" value="">Select</option>
                                    @foreach($state_list as $state)
                                    <option class="we" value="{{$state}}">{{$state}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 custom-input pb-4">
                                <label>City</label>
                                <select class="form-control selectdata">
                                    <option class="we">Select</option>
                                    <option class="we2">Punjab</option>
                                    <option>Delhi</option>
                                </select>
                            </div>
                        </div>
                        <hr class="line">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="custom-input pb-4">
                                    <label>Mobile</label>
                                    <input type="text" maxlength="10" class="form-control bg-transparent" placeholder="Mobile no" value="9034424140">
                                </div>
                            </div>
                        </div>
                        <hr class="line mb-4">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="d-flex custom-profileupload">
                                    <div class="preview-zone hidden">
                                        <div class="box box-solid">
                                            <div class="box-body"></div>
                                        </div>
                                    </div>
                                    <div class="dropzone-wrapper w-100">
                                        <div class="dropzone-desc text-center">
                                            <img src="{{URL::asset('public/after_login/current_ui/images/upload-img.jpg')}}" alt="performance">
                                            <p><a href="javascript:void(0);">Click to upload</a> or drag and drop<br> <span>(SVG, PNG, JPG or GIF)</span></p>
                                        </div>
                                        <input type="file" name="img_logo" class="dropzone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="line">
                        <div class="d-flex justify-content-end mb-5 pb-5">
                            <button class="btn cancle mr-2 bg-transparent disabled">Cancle</button>
                            <button class="btn savebtn text-white border-0 ml-1 disabled">Save</button>
                        </div>
                    </div>
                </div>
                <hr class="line pb-5 mb-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="info">
                            <h1 class="main-title">Subscription</h1>
                            <p>Beginner • {{isset($exam_data->class_exam_cd)?$exam_data->class_exam_cd:''}}</p>
                        </div>
                    </div>
                    <div class="col-lg-8 pt-4">
                        <div class="bg-white subscription-details">
                            <h1 class="subs-heading d-inline-block">JEE MAIN Subscription</h1>
                            <hr class="line">
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Subscription type</h2>
                                <h3>JEE 1 year Subscription</h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Price</h2>
                                <h3>₹15,000</h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
                                <h2>Active date</h2>
                                <h3>20th April 2022</h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-between subs-alld mb-3 planend">
                                <h2>End date</h2>
                                <h3>20th April 2023</h3>
                            </div>
                            <div id="panel">
                                <hr class="line">
                                <p>JEE-Main, which replaced AIEEE, is for admissions to the National Institutes of Technology (NITs), Indian Institutes of Information Technology (IIITs) and some other colleges designated as "centrally funded technical institutes" (CFTIs).</p>
                            </div>
                            <div class="flip d-inline-block">Show details</div>
                            <i class="fa fa-angle-right text-success" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
@include('afterlogin.layouts.footer_new')
@endsection
