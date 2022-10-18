@extends('afterlogin.layouts.app_new')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<div class="spinnerblock">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="main-wrapper exam-wrapperBg">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <section class="content-wrapper exam-wrapperpadding TestseriesAttempt22 custom_exam_page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="commontab">
                        <div class="tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item pe-md-5 pe-4 me-2">
                                    <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#qq1" id="custom_tab">Custom</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#attempted_tab" id="attempted">Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <!-- <div class="toastdata">
   <div class="toast-content">
      <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M1 17C1 8.163 8.163 1 17 1s16 7.163 16 16-7.163 16-16 16S1 25.837 1 17z" fill="#8DFDB3"/>
         <path d="M23.666 16.387V17a6.667 6.667 0 1 1-3.953-6.093m3.953.76L17 18.34l-2-2" stroke="#039855" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
         <path d="M17 32C8.716 32 2 25.284 2 17H0c0 9.389 7.611 17 17 17v-2zm15-15c0 8.284-6.716 15-15 15v2c9.389 0 17-7.611 17-17h-2zM17 2c8.284 0 15 6.716 15 15h2c0-9.389-7.611-17-17-17v2zm0-2C7.611 0 0 7.611 0 17h2C2 8.716 8.716 2 17 2V0z" fill="#BDF3C5"/>
      </svg>
      <div class="message">
         <h5 class="mb-2">Email Verification Link Sent </h5>
         <p>A verification link has been sent, please click the link to get your account verified</p>
      </div>
   </div>
   <div class="toast-close" onclick="toastClose()">
      <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M26 14 14 26M14 14l12 12" stroke="#1F1F1F" stroke-width="1.71" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
   </div>
   <div class="progress"></div>
</div> -->
                        <!--<button class="toast-btn" onclick="toastFunction()">toast</button>        -->
                        <!-- Tab panes -->
                        <div class="tab-content bg-white exam_tabdata">
                            <div id="qq1" class=" tab-pane active">
                                <div class="common_greenbadge_tabs exam_topicbtn pb-4 mb-1">
                                    <ul class="nav nav-pills d-inline-flex" id="marks-tab" role="tablist">
                                        @isset($subject_list)
                                        @foreach($subject_list as $key=>$subject)
                                        <li class="nav-item" role="presentation" type="button">
                                            <button class="nav-link btn pt-0 pb-0 SubActBtn {{($key==0)?'active':''}}" onclick="showSubChapters('{{$subject->subject_name}}');" id="{{$subject->subject_name}}_btn">{{$subject->subject_name}}</button>
                                        </li>
                                        @endforeach
                                        @endisset
                                    </ul>
                                </div>
                                @isset($subject_list)
                                @foreach($subject_list as $skey=>$sub)
                                <div class="take-fulltest d-lg-flex2 align-items-center justify-content-end {{($skey==0)?'d-lg-flex2':'d-none2'}}" id="{{$sub->subject_name}}_main">
                                    <div class="d-sm-flex align-items-center clrsec topic_form" id="{{$sub->subject_name}}_select">
                                        <form id="topic_form" method="post" action="{{route('custom_exam_topic','instruction')}}" class="topic_list_form text-sm-right">
                                            @csrf
                                            <input type="hidden" class="selected_topic" name="topics">
                                            <input type="hidden" id="selected_tab" name="selected_tab">
                                            <input type="hidden" name="question_count" value="30">
                                            <button type="text" class="btn btn-common-transparent me-sm-3">Practice for selected topics</button>
                                        </form>
                                        <a href="javascript:void(0);" onclick="clearTopics();" class="clearsec">Clear Selection</a>
                                    </div>
                                    <div class="full_take position-relative {{($skey==0)?'d-flex':'d-none'}}" id="{{$sub->subject_name}}_test">
                                        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg class="me-3 align-bottom" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 9a8 8 0 0 1 8-8h28a8 8 0 0 1 8 8v28a8 8 0 0 1-8 8H9a8 8 0 0 1-8-8V9z" fill="#FCFDFD" />
                                                <path d="M18 23h10m-12.5-5h15m-10 10h5" stroke="#56B663" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M9 1.5h28v-1H9v1zM44.5 9v28h1V9h-1zM37 44.5H9v1h28v-1zM1.5 37V9h-1v28h1zM9 44.5A7.5 7.5 0 0 1 1.5 37h-1A8.5 8.5 0 0 0 9 45.5v-1zM44.5 37a7.5 7.5 0 0 1-7.5 7.5v1a8.5 8.5 0 0 0 8.5-8.5h-1zM37 1.5A7.5 7.5 0 0 1 44.5 9h1A8.5 8.5 0 0 0 37 .5v1zM9 .5A8.5 8.5 0 0 0 .5 9h1A7.5 7.5 0 0 1 9 1.5v-1z" fill="#56B663" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu filterdropdown">
                                            <li><a class="dropdown-item filterCha_{{$sub->id}} activeFilter" id="prof_asc_{{$sub->id}}" href="javascript:void(0);" onclick="chapterlist_filter('{{$sub->id}}','prof_asc')"> Low Proficiency</a></li>
                                            <li><a class="dropdown-item filterCha_{{$sub->id}}" id="prof_desc_{{$sub->id}}" href="javascript:void(0);" onclick="chapterlist_filter('{{$sub->id}}','prof_desc')"> High Proficiency</a></li>
                                            <li><a class="dropdown-item filterCha_{{$sub->id}}" id="asc_{{$sub->id}}" href="javascript:void(0);" onclick="chapterlist_filter('{{$sub->id}}','asc')"> A - Z Order</a></li>
                                            <li><a class="dropdown-item filterCha_{{$sub->id}}" id="desc_{{$sub->id}}" href="javascript:void(0);" onclick="chapterlist_filter('{{$sub->id}}','desc')"> Z - A Order</a></li>
                                        </ul>
                                        <form method="post" class="fulltestform" action="{{route('custom_exam','instruction')}}">
                                            @csrf
                                            <input type="hidden" name="subject_id" value="{{$sub->id}}">
                                            <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                                            <input type="hidden" name="question_count" value="30">
                                            <button type="submit" class="btn btn-common-green">Full Practice</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="accordion mt-4 pt-1 subjectlist  {{($skey==0)?'d-block':'d-none'}} chapter_list_{{$sub->id}}" id="{{$sub->subject_name}}_list">
                                    <div class="testtablescroll allscrollbar">
                                        @if(@isset($subject_chapter_list[$sub->id]) && !empty($subject_chapter_list[$sub->id]))
                                        @foreach($subject_chapter_list[$sub->id] as $tKey=>$chapters)
                                        <div class="accordion-item" id="collapseTwo_accordian_{{$chapters->chapter_id}}">
                                            <div class="test-table d-md-flex align-items-center justify-content-between pb-md-3 mb-md-1 position-relative">
                                                <h2 class="m-0" title="{{$chapters->chapter_name}}">{{$chapters->chapter_name}}</h2>
                                                <h3 class="m-0">Proficiency: <span> @if(isset($chapters->chapter_score))
                                                        {{round($chapters->chapter_score)}}%
                                                        @else
                                                        0%
                                                        @endif</span></h3>
                                                <div class="accordion-header d-flex align-items-center justify-content-between pt-md-0 pt-4" id="headingTwo">
                                                    <h4 onclick="show_topic('{{$chapters->chapter_id}}','{{$sub->id}}','{{$sub->subject_name}}')" class="m-0 view-topic-scrolling-position" id="chapter_list_{{$sub->id}}_expandTopic_{{$chapters->chapter_id}}">View Topics</h4>
                                                    <form class="w-100 text-right" method="post" action="{{route('custom_exam_chapter','instruction')}}" class="mb-0">
                                                        @csrf
                                                        <input type="hidden" name="subject_id" value="">
                                                        <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                                                        <input type="hidden" name="chapter_id" value="{{$chapters->chapter_id}}">
                                                        <input type="hidden" name="question_count" value="30">
                                                        <button class="btn btn-common-transparent w-100">Practice</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="collapseTwo_custome_{{$chapters->chapter_id}}" class=" chapters-expend">
                                                <div class="accordion-body ps-0 pe-0 pt-4">
                                                    <div class="testslider owl-carousel owl-theme customSlider" id="topic_section_{{$chapters->chapter_id}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                @endisset
                            </div>
                            <div id="attempted_tab" class=" tab-pane MockTestMob CoustomAttempted">
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
    $('.topic_form').attr("style", "display: none !important");
    $('.spinnerblock').hide();
    $(".clearsec").click(function() {
        $(".take-fulltest").removeClass("mobile-test");
    });

    function showSubChapters(subject) {
        $('.SubActBtn').removeClass('active');
        $('.subjectlist').removeClass('d-block');
        $('.subjectlist').addClass('d-none');
        $('#' + subject + '_btn').addClass('active');
        $('#' + subject + '_list').removeClass('d-none');
        $('#' + subject + '_list').addClass('d-block');
        $('.full_take').removeClass('d-flex');
        $('.full_take').addClass('d-none');
        $('#' + subject + '_test').removeClass('d-none');
        $('#' + subject + '_test').addClass('d-flex');
        $('.topic_form').attr("style", "display: none  !important");
        $('.take-fulltest').attr("style", "display: none  !important");
        $('#' + subject + '_main').attr("style", "display: flex");
        let is_select = false;
        $(".topic_" + subject).each(function() {

            if ($(this).hasClass('topic_selected')) {
                is_select = true;
            }

        });
        if (is_select) {
            $('#' + subject + '_select').attr("style", "display: flex");
        }

        //clearTopics();
    }
    $('.chapters-expend').hide();

    function show_topic(chapt_id, sub_id, subject_name) {
   
        $('.spinnerblock').show();
       
        var chapter_ex = $('#collapseTwo_custome_' + chapt_id).hasClass('show');
        if (chapter_ex === true) {
            $('#collapseTwo_custome_' + chapt_id).removeClass('show');
            $('#collapseTwo_custome_' + chapt_id).hide();
            $("#chapter_list_" + sub_id + "_expandTopic_" + chapt_id).text('View Topics');
        } else {
            $('#collapseTwo_custome_' + chapt_id).show();
            $('#collapseTwo_custome_' + chapt_id).addClass('show');
            $("#chapter_list_" + sub_id + "_expandTopic_" + chapt_id).text('Hide Topics');
        }
        var slider_open = $("#topic_section_" + chapt_id).hasClass('show_div_' + chapt_id);
        if (slider_open) {
            setTimeout(function() {
                $('.spinnerblock').hide();
            }, 1000);

        } else {
            url = "{{ url('ajax_custom_topic/') }}/" + chapt_id + '/' + subject_name;
            $.ajax({
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function() {
                    $('#overlay').fadeIn();
                },
                success: function(result) {
                    $('.spinnerblock').hide();
                    $(".chapters-expend  #topic_section_" + chapt_id).html(result);
                    $("#topic_section_" + chapt_id).addClass('show_div_' + chapt_id);

                    $("#topic_section_" + chapt_id).trigger('destroy.owl.carousel');
                    $("#topic_section_" + chapt_id).owlCarousel({

                        stagePadding: 0,
                        loop: false,
                        responsiveClass:true,
                        margin: 14,
                        nav: true,
                        dots: false,
                        autoplay:false,
                        responsive: {
                            0: {
                                items: 1,
                                // nav: false,
                                // stagePadding: 0,
                                margin: 5,
                                // loop: true,
                            },
                            590: {
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
                    $('.js-progress-bar').each(function () {
                        var ids=this.id;
                        var scrore_val =$(this).attr('data-score');
                        var percentageComplete = scrore_val;
                        var strokeDashOffsetValue = 100 - percentageComplete;
                        var progressBar = $("#"+ids);
                        progressBar.css("stroke-dashoffset", strokeDashOffsetValue);
                    });
                }
            });
        };
      $('.testtablescroll #collapseTwo_accordian_' + chapt_id)[0].scrollIntoView();
        
    }
</script>
<script type="text/javascript">
var subject_name='';
$('#custom_tab').click(function() {
    $('.spinnerblock').show();
    $('#qq1').show();
    $('#attempted_tab').hide();
    setTimeout(function() {
            $('.spinnerblock').hide();
            }, 1000);
});
    $('#attempted').click(function() {
        $('.spinnerblock').show();
        url = "{{ url('ajax_exam_result_list') }}/Assessment";
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
                $('#testTypeDiv').attr("style", "display: none !important");
                $('#AssessmentTypeDiv').attr("style", "display: block !important");
                $('.slot_div').hide();
            },
            error: function(data, errorThrown) {
                $('.spinnerblock').hide();
            }
        });
    });
    var aTopics = [];

    function addOrRemove(value,subject) {
        var index = aTopics.indexOf(value);
        if (subject_name) {
            if (subject_name == subject) {
                $('.addremovetopic').prop('disabled', true);
                $('.topic_'+subject).prop('disabled', false);
            }else
            {
               $('.topic_'+subject).prop('disabled', true); 
               return false; 
            }

        }
        else 
        {
            subject_name = subject;  
            $('.addremovetopic').prop('disabled', true);
            $('.topic_'+subject).prop('disabled', false);  
        }
        

        if (index === -1) {
            aTopics.push(value);
            $('#chpt_topic_' + value).addClass('topic_selected');
            $('#chpt_topic_' + value).addClass('btn-common-green');
            $('#chpt_topic_' + value).removeClass('btn-common-transparent');
            $('#chpt_topic_' + value).removeClass('bg-transparent');
            $('#chpt_topic_' + value).html('Selected');
        } else {
            aTopics.splice(index, 1);
            $('#chpt_topic_' + value).removeClass('topic_selected');
            $('#chpt_topic_' + value).removeClass('btn-common-green');
            $('#chpt_topic_' + value).addClass('btn-common-transparent');
            $('#chpt_topic_' + value).addClass('bg-transparent');
            $('#chpt_topic_' + value).html('Select');
        }
        $('.selected_topic').val(aTopics);
        if (aTopics.length > 0) {
            $('.topic_form').attr("style", "display: none  !important");
            $(".SubActBtn").each(function() {
                if ($(this).hasClass('active')) {
                    var ids = $(this).attr('id');
                    ids = ids.replace("_btn", "_select");
                    $('#' + ids).attr("style", "display: flex");
                }

            });

            $('.take-fulltest').addClass('mobile-test');
        } else {
            $('.topic_form').attr("style", "display: none  !important");
            $('.take-fulltest').removeClass('mobile-test');
            $('.addremovetopic').prop('disabled', false);
            subject_name = '';
        }


    }

    function clearTopics() {
        aTopics = [];
        $('.selected_topic').val('');
        $('.addremovetopic').removeClass('topic_selected');
        $('.addremovetopic').removeClass('btn-common-green');
        $('.addremovetopic').addClass('btn-common-transparent');
        $('.addremovetopic').addClass('bg-transparent');
        $('.addremovetopic').html('Select');
        $('.exam-box').removeClass('examborderchange');
        $('.topic_form').attr("style", "display: none  !important");
        subject_name = '';
        $('.addremovetopic').prop('disabled', false);

    }

    function showSubfilter(subject) {
        $('.SubattemptActBtn').removeClass('active');
        $('.compLeteS').hide();
        $('.no_data_found').hide();
        if (subject == "all_subject") {
            $('.compLeteS').show();
            $("#all_subject_flt").addClass('active');
        } else {
            $('#' + subject + '_flt').addClass('active');
            $("#all_subject_flt").removeClass('active');
            $('.' + subject + '-rlt').show();
            var data_list =$('.' + subject + '-rlt').length;
            if(data_list > 0)
            {
                $('.no_data_found').hide();
            } else {
                $('.no_data_found').show();
                $('#error_data').text('No result history available right now.');
            }
        }

    }

    function chapterlist_filter(sub_id, filter_type) {
        url = "{{ url('filter_subject_chapter/') }}/" + sub_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                "filter_type": filter_type
            },
            beforeSend: function() {
                $('#overlay').fadeIn();
            },
            success: function(result) {
                $(".chapter_list_" + sub_id).html('');
                $(".chapter_list_" + sub_id).html(result);

                $('.filterCha_' + sub_id).removeClass('activeFilter');
                $('#' + filter_type + '_' + sub_id).addClass('activeFilter');

            }
        });
    }

    function clear_chapter_filter(sub_id, filter_type) {
        url = "{{ url('filter_subject_chapter/') }}/" + sub_id;

        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                "filter_type": filter_type
            },
            beforeSend: function() {
                $('#overlay').fadeIn();
            },
            success: function(result) {
                $(".chapter_list_" + sub_id).html('');
                $(".chapter_list_" + sub_id).html(result);
            }
        });

    };
$(document).on('click', '.addremovetopic', function(event) {
    $(this).parent().parent().toggleClass('examborderchange');
});
</script>

@include('afterlogin.layouts.footer_new')
@endsection