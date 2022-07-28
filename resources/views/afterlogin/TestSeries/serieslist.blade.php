@extends('afterlogin.layouts.app_new')
@section('content')
<div class="main-wrapper">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <section class="content-wrapper">
        @if(session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="commontab">
                        <div class="tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item pe-5 me-2">
                                    <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#qq1" id="test_series">Test Series</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#attempted_tab" id="attempted">Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content bg-white exam_tabdata">
                            <div id="qq1" class=" tab-pane active">
                                <div class="common_greenbadge_tabs exam_topicbtn pb-4 mb-1">
                                    <ul class="nav nav-pills d-inline-flex" id="marks-tab" role="tablist">
                                        <li class="nav-item" role="presentation" type="button">
                                            <button class="nav-link btn pt-0 pb-0 open_test active">Open Test Series</button>
                                        </li>
                                        <li class="nav-item" role="presentation" type="button">
                                            <button class="nav-link pt-0 pb-0 btn live_test">Live Test Series</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="accordion mt-4 pt-1" id="open_test_div">
                                    <div class="allscrollbar tablescroll">
                                        @if(!empty($open_series))
                                        @foreach($open_series as $open)
                                        <div class="accordion-item pt-4">
                                            <div class="test-table d-flex align-items-center justify-content-between pb-3 mb-1">
                                                <h2 class="m-0">{{$open->test_series_name}}</h2>
                                                <h2 class="m-0 questiontext">{{$open->questions_count}} Questions</h2>
                                                <h2 class="m-0 mintext">{{$open->time_allowed}} minutes</h2>
                                                <div class="accordion-header d-flex align-items-center" id="headingOne">
                                                    <form class="form-horizontal ms-auto " action="{{route('test_series','instruction')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="series_name" value="{{$open->test_series_name}}" />
                                                        <input type="hidden" name="series_id" value="{{$open->test_series_id}}" />
                                                        <input type="hidden" name="series_type" value="{{$open->series_type}}" />
                                                        <input type="hidden" name="time_allowed" value="{{$open->time_allowed}}" />
                                                        <input type="hidden" name="questions_count" value="{{$open->questions_count}}" />
                                                        <input type="hidden" name="exam_mode" value="Open" />
                                                        <button class="btn btn-common-transparent bg-transparent ms-4"> TAKE TEST</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="row text-center p-4">
                                            <h5>No series available.</h5>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="accordion mt-4 pt-1" id="live_test_div">
                                    <div class="allscrollbar tablescroll">
                                        @php
                                        $i=0;
                                        @endphp
                                        @if(!empty($live_series))
                                        @foreach($live_series as $live)
                                        @if($live->test_completed_yn === 'N')
                                        <div class="accordion-item pt-4">
                                            <div class="test-table d-flex align-items-center justify-content-between pb-3 mb-1">
                                                <h2 class="m-0">{{$live->test_series_name}}</h2>
                                                <h2 class="m-0 questiontext">{{$live->questions_count}} Questions</h2>
                                                <h2 class="m-0 mintext">{{$live->time_allowed}} minutes</h2>
                                                <div class="accordion-header d-flex align-items-center" id="headingOne">
                                                    <form class="form-horizontal ms-auto " action="{{route('test_series','instruction')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="series_name" value="{{$live->test_series_name}}" />
                                                        <input type="hidden" name="series_id" value="{{$live->test_series_id}}" />
                                                        <input type="hidden" name="series_type" value="{{$live->series_type}}" />
                                                        <input type="hidden" name="time_allowed" value="{{$live->time_allowed}}" />
                                                        <input type="hidden" name="questions_count" value="{{$live->questions_count}}" />
                                                        <input type="hidden" name="exam_mode" value="Live" />
                                                        <button class="btn btn-common-transparent bg-transparent ms-4">Take test</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $i++;
                                        @endphp
                                        @endif
                                        @endforeach
                                        @else
                                        <div class="row text-center p-4">
                                            <h5>No series avialable.</h5>
                                        </div>
                                        @endif
                                        @if(!empty($live_series) && $i <= 0) <div class="row text-center p-4">
                                            <h5>No series avialable.</h5>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="attempted_tab" class=" tab-pane">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
$('.testslider').owlCarousel({
    stagePadding: 0,
    loop: false,
    margin: 15,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 1,
            nav: false,
            stagePadding: 40,
            margin: 5,
            loop: true,
        },
        700: {
            items: 2
        },
        1000: {
            items: 3
        },
        1200: {
            items: 4
        }


    }
});
$('#live_test_div').hide();
$('.open_test').click(function() {
    $('#open_test_div').show();
    $('#live_test_div').hide();
    $(this).addClass('active');
    $('.live_test').removeClass('active');
});
$('.live_test').click(function() {
    $('#open_test_div').hide();
    $('#live_test_div').show();
    $(this).addClass('active');
    $('.open_test').removeClass('active');
});
$('#attempted').click(function() {
    url = "{{ url('ajax_exam_result_list') }}/Test-Series";
    $.ajax({
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",
        },
        beforeSend: function() {

        },
        success: function(data) {
            $("#attempted_tab").show();
            $('#attempted_tab').html(data.html);
        },
        error: function(data, errorThrown) {}
    });
});
$(document).on('click', '.all_attemp', function() {
    $(this).addClass('active');
    $('.open_attemp').removeClass('active');
    $('.live_attemp').removeClass('active');
    $('.compLeteS').show();

});
$(document).on('click', '.open_attemp', function() {
    $(this).addClass('active');
    $('.all_attemp').removeClass('active');
    $('.live_attemp').removeClass('active');
    $('.compLeteS').hide();
    $('.exam_mode_Open').show();
    var data_list = $('.exam_mode_Open').length;
    if (data_list > 0) {
        $('.no_data_found').hide();
    } else {
        $('.no_data_found').show();
        $('#error_data').text('No result history available right now.');
    }
});
$(document).on('click', '.live_attemp', function() {
    $(this).addClass('active');
    $('.all_attemp').removeClass('active');
    $('.open_attemp').removeClass('active');
    $('.compLeteS').hide();
    $('.exam_mode_Live').show();
    var data_list = $('.exam_mode_Live').length;
    if (data_list > 0) {
        $('.no_data_found').hide();
    } else {
        $('.no_data_found').show();
        $('#error_data').text('No result history available right now.');
    }
});

</script>
@include('afterlogin.layouts.footer_new')
@endsection
