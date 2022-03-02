@extends('afterlogin.layouts.app_new')

@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')

    <div class="content-wrapper">
        <div class="container-fluid list-series">
            <div class="row">
                <div class="col-lg-12  p-lg-5">

                    <div class="tab-wrapper live-exam">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="open-tab" data-bs-toggle="tab" href="#open" role="tab" aria-controls="home" aria-selected="true">Open Test Series</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="live-tab" data-bs-toggle="tab" href="#live" role="tab" aria-controls="home" aria-selected="true">Live Test Series</a>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-content cust-tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">


                                @if(!empty($open_series))
                                <div class="scroll-div-live-exm p-4 listing-details">
                                    @foreach($open_series as $open)
                                    <ul class="speci-text">
                                        <li class="a1TS"> <span class="sub-details">{{$open->test_series_name}}</span>
                                        </li>
                                        <li class="a2TS"><strong>{{$open->questions_count}} Questions</strong>
                                        </li>
                                        <li class="a3TS"><strong>{{$open->time_allowed}} min</strong>
                                        </li>
                                        <li class="a4TS">
                                            <form class="form-horizontal ms-auto " action="{{route('test_series')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="series_name" value="{{$open->test_series_name}}" />
                                                <input type="hidden" name="series_id" value="{{$open->test_series_id}}" />
                                                <input type="hidden" name="series_type" value="{{$open->series_type}}" />
                                                <input type="hidden" name="time_allowed" value="{{$open->time_allowed}}" />
                                                <input type="hidden" name="questions_count" value="{{$open->questions_count}}" />
                                                <input type="hidden" name="exam_mode" value="Live" />
                                                <button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Attempt
                                                    Exam</button>
                                            </form>

                                        </li>
                                    </ul>

                                    @endforeach

                                </div>
                                @else
                                <div class="row text-center p-4">
                                    <h5>No series avialable.</h5>
                                </div>
                                @endif
                            </div>

                            <div class="tab-pane fade show " id="live" role="tabpanel" aria-labelledby="live-tab">
                                @if(!empty($live_series))
                                <div class="scroll-div-live-exm p-4 listing-details">
                                    @foreach($live_series as $live)
                                    <ul class="speci-text">
                                        <li class="a1TS"> <span class="sub-details">{{$live->test_series_name}}</span>
                                        </li>
                                        <li class="a2TS"><strong>{{$live->questions_count}} Questions</strong>
                                        </li>
                                        <li class="a3TS"><strong>{{$live->time_allowed}} min</strong>
                                        </li>
                                        <li class="a4TS">
                                            <form class="form-horizontal ms-auto " action="{{route('test_series')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="series_name" value="{{$live->test_series_name}}" />
                                                <input type="hidden" name="series_id" value="{{$live->test_series_id}}" />
                                                <input type="hidden" name="series_type" value="{{$live->series_type}}" />
                                                <input type="hidden" name="time_allowed" value="{{$live->time_allowed}}" />
                                                <input type="hidden" name="questions_count" value="{{$live->questions_count}}" />
                                                <input type="hidden" name="exam_mode" value="Live" />
                                                @if($live->test_completed_yn === 'N')
                                                <button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Start</button>
                                                @else
                                                <button class="custom-btn-gray" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Start</button>
                                                @endif
                                            </form>

                                        </li>
                                    </ul>
                                    @endforeach
                                </div>
                                @else
                                <div class="row text-center p-4">
                                    <h5>No series avialable.</h5>
                                </div>
                                @endif

                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@include('afterlogin.layouts.footer_new')


@endsection