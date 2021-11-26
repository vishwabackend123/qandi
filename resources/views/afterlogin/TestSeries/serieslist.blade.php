@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper h-100">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 ">

                    <div class="tab-wrapper">
                        <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="open-tab" data-bs-toggle="tab" href="#open" role="tab" aria-controls="home" aria-selected="true">Open Test Series</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="live-tab" data-bs-toggle="tab" href="#live" role="tab" aria-controls="home" aria-selected="true">Live Test Series</a>
                            </li>

                        </ul>

                        <div class="tab-content cust-tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">


                                @if(!empty($open_series))
                                <div class="row">
                                    @foreach($open_series as $open)
                                    <div class="col-md-6 col-lg-4 mb-4 ">
                                        <div class="bg-white shadow-lg p-3 sub-topic-box">
                                            <div class="d-flex align-items-center py-2 listing-details ">
                                                <span class="mr-3 topics-name">{{$open->test_series_name}}</span>
                                            </div>

                                            <div class="d-flex align-items-center flex-wrap">
                                                <small>{{$open->questions_count}} Questions | {{$open->time_allowed}} min</small>
                                                <form class="form-horizontal ms-auto " action="{{route('test_series')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="series_name" value="{{$open->test_series_name}}" />
                                                    <input type="hidden" name="series_id" value="{{$open->test_series_id}}" />
                                                    <input type="hidden" name="series_type" value="{{$open->series_type}}" />
                                                    <input type="hidden" name="time_allowed" value="{{$open->time_allowed}}" />
                                                    <input type="hidden" name="questions_count" value="{{$open->questions_count}}" />
                                                    <button class="btn btn-danger mb-4 mt-4  rounded-0 px-5">Start</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                @else
                                <div class="row text-center">
                                    <h5>No series avialable.</h5>
                                </div>
                                @endif
                            </div>

                            <div class="tab-pane fade show " id="live" role="tabpanel" aria-labelledby="live-tab">
                                @if(!empty($live_series))
                                <div class="row">
                                    @foreach($live_series as $live)
                                    <div class="col-md-6 col-lg-4 mb-4 ">
                                        <div class="bg-white shadow-lg p-3 sub-topic-box">
                                            <div class="d-flex align-items-center py-2 listing-details ">
                                                <span class="mr-3 topics-name">{{$live->test_series_name}}</span>
                                            </div>

                                            <div class="d-flex align-items-center flex-wrap">
                                                <small>{{$live->questions_count}} Questions | {{$live->time_allowed}} min</small>
                                                <form class="form-horizontal ms-auto " action="{{route('test_series')}}" method="post">
                                                    @csrf

                                                    <input type="hidden" name="series_name" value="{{$live->test_series_name}}" />
                                                    <input type="hidden" name="series_id" value="{{$live->test_series_id}}" />
                                                    <input type="hidden" name="series_type" value="{{$live->series_type}}" />
                                                    <input type="hidden" name="time_allowed" value="{{$live->time_allowed}}" />
                                                    <input type="hidden" name="questions_count" value="{{$live->questions_count}}" />
                                                    <button class="btn btn-danger mb-4 mt-4  rounded-0 px-5">Start</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                @else
                                <div class="row text-center">
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




@include('afterlogin.layouts.footer')


@endsection