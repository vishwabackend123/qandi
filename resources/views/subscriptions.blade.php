@extends('layouts.app')

@section('content')

<div id="main">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h1 class="main-heading">WHAT's your game ?</h1>
            <div id="scrollDiv">
                <div class="row">
                    @if($errors->any())
                    <div class="col-md-12 ">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{$errors->first()}}
                        </div>
                    </div>
                    @endif
                    @if(isset($subscriptions) && !empty($subscriptions))
                    @foreach($subscriptions as $sub)
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small">
                            <h5 class="cource-name">{{strtoupper($sub->exam_name)}}</h5>
                            <p class="price">Rs. {{$sub->exam_price}}/ {{$sub->day_month_count}}{{$sub->day_unit}}</p>
                            <p class="box-content">{{$sub->exam_description}}</p>
                            <p class="box-content">NATIONAL ELIGIBILITY CUM ENTRANCE TEST is conducted by National Testing Agency (NTA) for admission to MBBS/BDS Courses and other undergraduate medical courses in approved/recognized Medical/Dental & other Colleges/ Institutes in India.</p>
                            <div class="text-center mt-5">
                                <form action="{{route('checkout')}}" if="checkout" method="post">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{$sub->exam_id}}">
                                    <input type="hidden" name="exam_period" value="{{$sub->day_month_count}}">
                                    <input type="hidden" name="period_unit" value="{{$sub->day_unit}}">
                                    <input type="hidden" name="exam_price" value="{{$sub->exam_price}}">

                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                </form>
                            </div>
                            <div class="text-center mt-2">
                                <a href="{{route('trial_subscription',1)}}" class="text-danger text-decoration-underline">Try 14 days trial ></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small">
                            <h5 class="cource-name">NEET</h5>
                            <p class="price">Rs. 2500/ month</p>
                            <p class="box-content">NATIONAL ELIGIBILITY CUM ENTRANCE TEST is conducted by National Testing Agency (NTA) for admission to MBBS/BDS Courses and other undergraduate medical courses in approved/recognized Medical/Dental & other Colleges/ Institutes in India.</p>
                            <div class="text-center mt-5">

                                <button class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">GO FOR IT <i class="fas fa-arrow-right"></i></button>

                            </div>
                            <div class="text-center mt-2">
                                <a href="#" class="text-danger text-decoration-underline">Try 14 days trial ></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small inactive-block h-100">
                            <h5 class="cource-name">NEET</h5>
                            <p class="price">Rs. 2500/ month</p>
                            <p class="box-content">NATIONAL ELIGIBILITY CUM ENTRANCE TEST is conducted by National Testing Agency (NTA) for admission to MBBS/BDS Courses and other undergraduate medical courses in approved/recognized Medical/Dental & other Colleges/ Institutes in India.</p>
                            <div class="text-center mt-5">

                                <button class="btn btn-gray text-uppercase rounded-0 px-5" id="goto-otp-btn">Available Soon</button>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small inactive-block h-100">
                            <h5 class="cource-name">NEET</h5>
                            <p class="price">Rs. 2500/ month</p>
                            <p class="box-content">NATIONAL ELIGIBILITY CUM ENTRANCE TEST is conducted by National Testing Agency (NTA) for admission to MBBS/BDS Courses and other undergraduate medical courses in approved/recognized Medical/Dental & other Colleges/ Institutes in India.</p>
                            <div class="text-center mt-5">

                                <button class="btn btn-gray text-uppercase rounded-0 px-5" id="goto-otp-btn">Available Soon</button>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small inactive-block h-100">
                            <h5 class="cource-name">NEET</h5>
                            <p class="price">Rs. 2500/ month</p>
                            <p class="box-content">NATIONAL ELIGIBILITY CUM ENTRANCE TEST is conducted by National Testing Agency (NTA) for admission to MBBS/BDS Courses and other undergraduate medical courses in approved/recognized Medical/Dental & other Colleges/ Institutes in India.</p>
                            <div class="text-center mt-5">

                                <button class="btn btn-gray text-uppercase rounded-0 px-5" id="goto-otp-btn">Available Soon</button>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small inactive-block h-100">
                            <h5 class="cource-name">NEET</h5>
                            <p class="price">Rs. 2500/ month</p>
                            <p class="box-content">NATIONAL ELIGIBILITY CUM ENTRANCE TEST is conducted by National Testing Agency (NTA) for admission to MBBS/BDS Courses and other undergraduate medical courses in approved/recognized Medical/Dental & other Colleges/ Institutes in India.</p>
                            <div class="text-center mt-5">
                                <button class="btn btn-gray text-uppercase rounded-0 px-5" id="goto-otp-btn">Available Soon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small inactive-block h-100">
                            <h5 class="cource-name">NEET</h5>
                            <p class="price">Rs. 2500/ month</p>
                            <p class="box-content">NATIONAL ELIGIBILITY CUM ENTRANCE TEST is conducted by National Testing Agency (NTA) for admission to MBBS/BDS Courses and other undergraduate medical courses in approved/recognized Medical/Dental & other Colleges/ Institutes in India.</p>
                            <div class="text-center mt-5">

                                <button class="btn btn-gray text-uppercase rounded-0 px-5" id="goto-otp-btn">Available Soon</button>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small inactive-block h-100">
                            <h5 class="cource-name">NEET</h5>
                            <p class="price">Rs. 2500/ month</p>
                            <p class="box-content">NATIONAL ELIGIBILITY CUM ENTRANCE TEST is conducted by National Testing Agency (NTA) for admission to MBBS/BDS Courses and other undergraduate medical courses in approved/recognized Medical/Dental & other Colleges/ Institutes in India.</p>
                            <div class="text-center mt-5">
                                <button class="btn btn-gray text-uppercase rounded-0 px-5" id="goto-otp-btn">Available Soon</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection