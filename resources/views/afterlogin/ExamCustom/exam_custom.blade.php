@extends('afterlogin.layouts.app_new')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<div class="main-wrapper">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="commontab">
                        <div class="tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item pe-5 me-2">
                                    <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#qq1">Custom</a>
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
                                <div class="take-fulltest d-lg-flex align-items-center justify-content-end {{($skey==0)?'d-lg-flex':'d-none'}}" id="{{$sub->subject_name}}_main">
                                    <div class="d-sm-flex align-items-center clrsec topic_form" id="{{$sub->subject_name}}_select">
                                        <form id="topic_form" method="post" action="{{route('custom_exam_topic','instruction')}}" class="topic_list_form text-sm-right">
                                            @csrf
                                            <input type="hidden" class="selected_topic" name="topics">
                                            <input type="hidden" id="selected_tab" name="selected_tab">
                                            <input type="hidden" name="question_count" value="30">
                                            <button type="submit" class="btn btn-common-transparent bg-transparent me-sm-3">Take test for selected topics</button>
                                        </form>
                                        <a href="javascript:void(0);" onclick="clearTopics();" class="clearsec">Clear Selection</a>
                                    </div>
                                    <div class="full_take position-relative {{($skey==0)?'d-flex':'d-none'}}" id="{{$sub->subject_name}}_test">
                                        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg class="me-4 align-bottom" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 9a8 8 0 0 1 8-8h28a8 8 0 0 1 8 8v28a8 8 0 0 1-8 8H9a8 8 0 0 1-8-8V9z" fill="#FCFDFD" />
                                                <path d="M18 23h10m-12.5-5h15m-10 10h5" stroke="#56B663" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M9 1.5h28v-1H9v1zM44.5 9v28h1V9h-1zM37 44.5H9v1h28v-1zM1.5 37V9h-1v28h1zM9 44.5A7.5 7.5 0 0 1 1.5 37h-1A8.5 8.5 0 0 0 9 45.5v-1zM44.5 37a7.5 7.5 0 0 1-7.5 7.5v1a8.5 8.5 0 0 0 8.5-8.5h-1zM37 1.5A7.5 7.5 0 0 1 44.5 9h1A8.5 8.5 0 0 0 37 .5v1zM9 .5A8.5 8.5 0 0 0 .5 9h1A7.5 7.5 0 0 1 9 1.5v-1z" fill="#56B663" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu filterdropdown">
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="chapterlist_filter('{{$sub->id}}','prof_asc')"> Low Proficiency</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="chapterlist_filter('{{$sub->id}}','prof_desc')"> High Proficiency</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="chapterlist_filter('{{$sub->id}}','asc')"> A - Z order</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="chapterlist_filter('{{$sub->id}}','desc')"> Z - A order</a></li>
                                        </ul>
                                        <form method="post" class="fulltestform" action="{{route('custom_exam','instruction')}}">
                                            @csrf
                                            <input type="hidden" name="subject_id" value="{{$sub->id}}">
                                            <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                                            <input type="hidden" name="question_count" value="30">
                                            <button type="submit" class="btn btn-common-green">Take full test</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="accordion mt-4 pt-1 subjectlist  {{($skey==0)?'d-block':'d-none'}} chapter_list_{{$sub->id}}" id="{{$sub->subject_name}}_list">
                                    <div class="testtablescroll allscrollbar">
                                        @if(@isset($subject_chapter_list[$sub->id]) && !empty($subject_chapter_list[$sub->id]))
                                        @foreach($subject_chapter_list[$sub->id] as $tKey=>$chapters)
                                        <div class="accordion-item">
                                            <div class="test-table d-md-flex align-items-center justify-content-between pb-md-3 mb-md-1 position-relative">
                                                <h2 class="m-0" title="{{$chapters->chapter_name}}">{{$chapters->chapter_name}}</h2>
                                                <h3 class="m-0">Proficiency : <span> @if(isset($chapters->chapter_score))
                                                        {{round($chapters->chapter_score)}}%
                                                        @else
                                                        0%
                                                        @endif</span></h3>
                                                <div class="accordion-header d-flex align-items-center justify-content-between pt-md-0 pt-4" id="headingTwo">
                                                    <h4 onclick="show_topic('{{$chapters->chapter_id}}','{{$sub->id}}')" class="m-0" id="chapter_list_{{$sub->id}}_expandTopic_{{$chapters->chapter_id}}">View topics</h4>
                                                    <form class="w-100 text-right" method="post" action="{{route('custom_exam_chapter','instruction')}}" class="mb-0">
                                                        @csrf
                                                        <input type="hidden" name="subject_id" value="">
                                                        <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                                                        <input type="hidden" name="chapter_id" value="{{$chapters->chapter_id}}">
                                                        <input type="hidden" name="question_count" value="30">
                                                        <button class="btn btn-common-transparent bg-transparent w-100">Take test</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="collapseTwo_custome_{{$chapters->chapter_id}}" class=" chapters-expend">
                                                <div class="accordion-body ps-0 pe-0 pt-4">
                                                    <div class="testslider owl-carousel owl-theme" id="topic_section_{{$chapters->chapter_id}}">
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
$('.topic_form').attr("style", "display: none !important");
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
    clearTopics();
}
$('.chapters-expend').hide();

function show_topic(chapt_id, sub_id) {
    var chapter_ex = $('#collapseTwo_custome_' + chapt_id).hasClass('show');
    if (chapter_ex === true) {
        $('#collapseTwo_custome_' + chapt_id).removeClass('show');
        $('#collapseTwo_custome_' + chapt_id).hide();
        $("#chapter_list_" + sub_id + "_expandTopic_" + chapt_id).text('View topics');
    } else {
        $('#collapseTwo_custome_' + chapt_id).show();
        $('#collapseTwo_custome_' + chapt_id).addClass('show');
        $("#chapter_list_" + sub_id + "_expandTopic_" + chapt_id).text('Hide topics');
    }
    var topic_length = $('#topic_list_' + chapt_id).length;
    if (topic_length == 0) {
        url = "{{ url('ajax_custom_topic/') }}/" + chapt_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            beforeSend: function() {
                $('#overlay').fadeIn();
            },
            success: function(result) {
                $(".chapters-expend  #topic_section_" + chapt_id).html(result);

                $("#topic_section_" + chapt_id).trigger('destroy.owl.carousel');
                $("#topic_section_" + chapt_id).owlCarousel({
                    stagePadding: 0,
                    loop: false,
                    margin: 15,
                    nav: false,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1,
                            nav: false,
                            stagePadding: 0,
                            margin: 5,
                            loop: true,
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



            }
        });
    }

}
$('#attempted').click(function() {
    url = "{{ url('ajax_exam_result_list') }}/Assessment";
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
            $('#testTypeDiv').attr("style", "display: none !important");
            $('#AssessmentTypeDiv').attr("style", "display: block !important");
        },
        error: function(data, errorThrown) {}
    });
});
var aTopics = [];

function addOrRemove(value) {
    var index = aTopics.indexOf(value);

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

}

function showSubfilter(subject) {
    $('.SubattemptActBtn').removeClass('active');
    $('.compLeteS').hide();
    if (subject == "all_subject") {
        $('.compLeteS').show();
        $("#all_subject_flt").addClass('active');
    } else {
        $('#' + subject + '_flt').addClass('active');
        $("#all_subject_flt").removeClass('active');
        $('.' + subject + '-rlt').show();
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
        }
    });
};

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

</script>
@include('afterlogin.layouts.footer_new')
@endsection
