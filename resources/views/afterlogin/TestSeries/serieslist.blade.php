@extends('afterlogin.layouts.app_new')
@section('content')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
@endphp
<?php $redis_data = Session::get('redis_data'); ?>

<?php 
if($userData->grade_id == '1'){
$grade='JEE';
}
elseif($userData->grade_id == '2'){
$grade='NEET';
}
else{
$grade='NA';
}

?>
@section('content')

<div class="spinnerblock">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="main-wrapper  exam-wrapperBg">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <section class="content-wrapper MockTestMob TestseriesAttempt22 TestseriesAttempt22Score">
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
                                    <div class="allscrollbar tablescroll TestseriesContent">
                                        @if(!empty($open_series))
                                        @foreach($open_series as $open)
                                        <div class="accordion-item pt-4 m-0 pb-4">
                                        <div class="mock_test_test_series mock_test_ques_dure_marks_sub d-flex">
                                            <div class="mock_test_ques_content">
                                                <div class="mock_test_q_d_m_s_text1">Test Name</div>
                                                <div class="mock_test_qdms_text2">{{$open->test_series_name}}</div>
                                            </div>
                                            <div class="live_exam_diveder_div"></div> 
                                            <div class="mock_test_dure_content">
                                                <div class="mock_test_q_d_m_s_text1">No. of Questions</div>
                                                <div class="mock_test_qdms_text2"><span>{{$open->questions_count}} Questions</div>
                                            </div>
                                            <div class="live_exam_diveder_div"></div>
                                            <div class="mock_test_marks_content">
                                                <div class="mock_test_q_d_m_s_text1">Duration</div>
                                                <div class="mock_test_qdms_text2"><span>{{$open->time_allowed}}</span> <span>Mins</span></div>
                                            </div>
                                            <div class="live_exam_diveder_div"></div>
                                            <div class="mock_test_btn_content">
                                                <div class="accordion-header d-flex align-items-center" id="headingOne">
                                                    <form class="form-horizontal ms-auto " action="{{route('test_series','instruction')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="series_name" value="{{$open->test_series_name}}" />
                                                        <input type="hidden" name="series_id" value="{{$open->test_series_id}}" />
                                                        <input type="hidden" name="series_type" value="{{$open->series_type}}" />
                                                        <input type="hidden" name="time_allowed" value="{{$open->time_allowed}}" />
                                                        <input type="hidden" name="questions_count" value="{{$open->questions_count}}" />
                                                        <input type="hidden" name="exam_mode" value="Open" />
                                                        <button class="btn btn-common-transparent bg-transparent ms-4" id="exam_inst_take_test_btn">Take Test</button>
                                                    </form>
                                                 </div>
                                             </div>
                                        </div>
                                            <!-- <div class="test-table d-flex align-items-center justify-content-between pb-3 mb-1"> -->
                                                <!-- <h2 class="m-0">{{$open->test_series_name}}</h2> -->
                                                <!-- <h2 class="m-0 questiontext">{{$open->questions_count}} Questions</h2> -->
                                                <!-- <h2 class="m-0 mintext">{{$open->time_allowed}} minutes</h2> -->
                                                <!-- <div class="accordion-header d-flex align-items-center" id="headingOne">
                                                    <form class="form-horizontal ms-auto " action="{{route('test_series','instruction')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="series_name" value="{{$open->test_series_name}}" />
                                                        <input type="hidden" name="series_id" value="{{$open->test_series_id}}" />
                                                        <input type="hidden" name="series_type" value="{{$open->series_type}}" />
                                                        <input type="hidden" name="time_allowed" value="{{$open->time_allowed}}" />
                                                        <input type="hidden" name="questions_count" value="{{$open->questions_count}}" />
                                                        <input type="hidden" name="exam_mode" value="Open" />
                                                        <button class="btn btn-common-transparent bg-transparent ms-4">Take Test</button>
                                                    </form>
                                                </div> -->
                                            <!-- </div> -->
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="row text-center p-4">
                                            <h5>No series available</h5>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="accordion mt-4 pt-1" id="live_test_div">
                                    <div class="allscrollbar tablescroll TestseriesContent">
                                        @php
                                        $i=0;
                                        @endphp
                                        @if(!empty($live_series))
                                        @foreach($live_series as $live)
                                        @if($live->test_completed_yn === 'N')
                                        <div class="accordion-item pt-4 m-0">
                                            <div class="mock_test_test_series mock_test_ques_dure_marks_sub d-flex">
                                                <div class="mock_test_ques_content">
                                                    <div class="mock_test_q_d_m_s_text1">Test Name</div>
                                                    <div class="mock_test_qdms_text2">{{$live->test_series_name}}</div>
                                                </div>
                                                <div class="live_exam_diveder_div"></div> 
                                                <div class="mock_test_dure_content">
                                                    <div class="mock_test_q_d_m_s_text1">No. of Questions</div>
                                                    <div class="mock_test_qdms_text2"><span>{{$live->questions_count}} Questions</div>
                                                </div>
                                                <div class="live_exam_diveder_div"></div>
                                                <div class="mock_test_marks_content">
                                                    <div class="mock_test_q_d_m_s_text1">Duration</div>
                                                    <div class="mock_test_qdms_text2"><span>{{$live->time_allowed}}</span> <span>Mins</span></div>
                                                </div>
                                                <div class="live_exam_diveder_div"></div>
                                                <div class="mock_test_btn_content">
                                                    <div class="accordion-header d-flex align-items-center" id="headingOne">
                                                        <form class="form-horizontal ms-auto " action="{{route('test_series','instruction')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="series_name" value="{{$live->test_series_name}}" />
                                                            <input type="hidden" name="series_id" value="{{$live->test_series_id}}" />
                                                            <input type="hidden" name="series_type" value="{{$live->series_type}}" />
                                                            <input type="hidden" name="time_allowed" value="{{$live->time_allowed}}" />
                                                            <input type="hidden" name="questions_count" value="{{$live->questions_count}}" />
                                                            <input type="hidden" name="exam_mode" value="Live" />
                                                            <button class="btn btn-common-transparent bg-transparent ms-4" id="exam_inst_take_test_btn">Take Test</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="test-table d-flex align-items-center justify-content-between pb-3 mb-1">
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
                                                        <button class="btn btn-common-transparent bg-transparent ms-4">Take Test</button>
                                                    </form>
                                                </div>
                                            </div> -->
                                        </div>
                                        @php
                                        $i++;
                                        @endphp
                                        @endif
                                        @endforeach
                                        @else
                                        <div class="row text-center p-4">
                                            <h5>No series available</h5>
                                        </div>
                                        @endif
                                        @if(!empty($live_series) && $i <= 0) <div class="row text-center p-4">
                                            <h5>No series available</h5>
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
    $('.spinnerblock').hide();
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
    $('#test_series').click(function() {
        $('.spinnerblock').show();
        $('#qq1').show();
        $('#attempted_tab').hide();
        setTimeout(function() {
            $('.spinnerblock').hide();
        }, 1000);
    });
    $('#attempted').click(function() {
        $('.spinnerblock').show();
        $('#attempted_tab').show();
        $('#qq1').hide();
        url = "{{ url('ajax_exam_result_list') }}/Test-Series";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            beforeSend: function() {

            },
            success: function(data) {
                $('.spinnerblock').hide();
                $("#attempted_tab").show();
                $('#attempted_tab').html(data.html);
                $('.slot_div').hide();
            },
            error: function(data, errorThrown) {
                $('.spinnerblock').hide();
            }
        });
    });
    $(document).on('click', '.all_attemp', function() {
        $(this).addClass('active');
        $('.open_attemp').removeClass('active');
        $('.live_attemp').removeClass('active');
        $('.compLeteS').show();
        var data_open = $('.exam_mode_Open').length;
        var data_live = $('.exam_mode_Live').length;
        if (data_open > 0 || data_live > 0) {
            $('.no_data_found').hide();
        }

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
            $('#error_data').text('No result history available right now');
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
            $('#error_data').text('No result history available right now');
        }
    });
</script>

<script type="text/javascript">
    $('#exam_inst_take_test_btn').click(function() {
            var user_id = '<?php echo $user_id; ?>';
            var test_type = '<?php echo isset($exam_title)?$exam_title:''; ?>';
            
            mixpanel.identify(user_id);
            mixpanel.people.set({
            $phone : '<?php echo $userData->mobile; ?>',
            $email : '<?php echo $userData->email; ?>',
            "Email Verified" : '<?php echo $userData->email_verified; ?>',
            "Course" : '<?php echo $grade; ?>',
            "Exam Attempt Start At" : '<?php echo date("Y-m-d H:i:s"); ?>',
            });
            mixpanel.track("Test Series Take Test Click",{
                $phone : '<?php echo $userData->mobile; ?>',
            $email : '<?php echo $userData->email; ?>',
            "Email Verified": '<?php echo $userData->email_verified; ?>', 
            "Course": '<?php echo $grade; ?>', 
            "Exam Attempt Start At" : '<?php echo date("Y-m-d H:i:s"); ?>',
              });
            
        });

</script>

<!-- Mixpanel Start -->
<script type="text/javascript">
(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

// Enabling the debug mode flag is useful during implementation,
// but it's recommended you remove it for production
var mixpanelid="{{$redis_data['MIXPANEL_KEY']}}";
mixpanel.init(mixpanelid);
mixpanel.track('Loaded Test Series Listing Page ',{
        "$city" : '<?php echo $userData->city; ?>',
        });
</script>
<!-- Mixpanel Ended -->


@include('afterlogin.layouts.footer_new')
@endsection