@extends('afterlogin.layouts.app')

@section('content')
<style>
    .slick-slider {
        padding-left: 40px;
        overflow-x: hidden;
        overflow-y: hidden;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }



    .slide_box {
        display: inline-block;
    }
</style>
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12  p-lg-2">

                    <div class="tab-wrapper mt-0">
                        <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                            @isset($subject_list)
                            @foreach($subject_list as $key=>$subject)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{($key==0)?'active':''}}" id="{{$subject->subject_name}}-tab" data-bs-toggle="tab" href="#{{$subject->subject_name}}" role="tab" aria-controls="{{$subject->subject_name}}" aria-selected="{{($key==0)?'true':'false'}}">{{$subject->subject_name}}</a>
                            </li>
                            @endforeach
                            @endisset

                        </ul>

                        <div class="tab-content bg-white" id="myTabContent">
                            @isset($subject_list)

                            @foreach($subject_list as $skey=>$sub)

                            <div class="tab-pane fade show {{($skey==0)?'active':''}}" id="{{$sub->subject_name}}" role="tabpanel" aria-labelledby="{{$sub->subject_name}}-tab">
                                <div class="d-flex px-4 my-5 py-2 align-items-center justify-content-between">
                                    <span class="  mr-3 name-txt">{{$sub->subject_name}}</span>
                                    <p class="mb-0 text-danger ms-auto me-4 text-uppercase fw-bold">You can pick chapters / topics or</p>
                                    <form method="post" action="{{route('custom_exam')}}">
                                        @csrf
                                        <input type="hidden" name="subject_id" value="{{$sub->id}}">
                                        <input type="hidden" name="question_count" value="30">

                                        <button class="btn btn-warning-custom rounded-0 px-5 ml-0 ml-md-3 "><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take FULL Test</button>
                                    </form>
                                    <button class="btn btn-light rotate-icon ms-2 text-danger rounded-0"><i class="fa fa-sliders" aria-hidden="true"></i></button>
                                </div>
                                <div class="scroll-div">
                                    @if(@isset($subject_chapter_list[$sub->id]) && !empty($subject_chapter_list[$sub->id]))
                                    @foreach($subject_chapter_list[$sub->id] as $tKey=>$chapters)
                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                                        <span class="mr-3 name-txt col-4 text-break">{{$chapters->chapter_name}}</span>

                                        <div class="status-id d-flex align-items-center   ml-0 ml-md-3 rating col-3" data-vote="0">

                                            <div class="star hidden">
                                                <span class="full" data-value="0"></span>
                                                <span class="half" data-value="0"></span>
                                            </div>

                                            <div class="star">

                                                <span class="full" data-value="1"></span>
                                                <span class="half" data-value="0.5"></span>
                                                <span class="selected"></span>

                                            </div>

                                            <div class="star">

                                                <span class="full" data-value="2"></span>
                                                <span class="half" data-value="1.5"></span>
                                                <span class="selected"></span>

                                            </div>

                                            <div class="star">

                                                <span class="full" data-value="3"></span>
                                                <span class="half" data-value="2.5"></span>
                                                <span class="selected"></span>

                                            </div>

                                            <div class="star">

                                                <span class="full" data-value="4"></span>
                                                <span class="half" data-value="3.5"></span>
                                                <span class="selected"></span>

                                            </div>

                                            <div class="star">

                                                <span class="full" data-value="5"></span>
                                                <span class="half" data-value="4.5"></span>
                                                <span class="selected"></span>

                                            </div>

                                            <div class="score score-rating js-score">
                                                10 %
                                            </div>
                                        </div>

                                        <span class="slbs-link col-2 mx-3"><a aria-controls="chapter_{{$chapters->chapter_id}}" data-bs-toggle="collapse" href="#chapter_{{$chapters->chapter_id}}" role="button" aria-expanded="false" onclick="show_topic('{{$chapters->chapter_id}}')">Expand to Topics</a></span>
                                        <form method="post" action="{{route('custom_exam')}}">
                                            @csrf
                                            <input type="hidden" name="subject_id" value="{{$sub->id}}">
                                            <input type="hidden" name="chapter_id" value="{{$chapters->chapter_id}}">
                                            <input type="hidden" name="question_count" value="30">

                                            <button class="btn btn-green rounded-0 btn-lg ml-0 ml-md-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
                                        </form>

                                    </div>
                                    <div class="collapse mb-4" id="chapter_{{$chapters->chapter_id}}">
                                        <div class="d-flex px-4">
                                            <button class="btn btn-light rotate-icon ms-auto text-danger rounded-0"><i class="fa fa-sliders" aria-hidden="true"></i></button>
                                        </div>
                                        <section id="topic_section_{{$chapters->chapter_id}}" class="slick-slider mb-4">

                                        </section>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>

                                <form id="topic_form" method="post" action="{{route('custom_exam')}}" class="text-right">
                                    @csrf
                                    <input type="hidden" id="selected_topic" name="topics">
                                    <input type="hidden" name="question_count" value="30">
                                    <span class="invalid-feedback m-0" role="alert" id="errlog_alert"> </span>
                                    <div id="" class="text-right d-flex align-items-right mt-3">

                                        <a href="#" class="btn px-4 ms-auto me-2 btn-secondary-clear rounded-0" onclick="clearTopics();">Clear Selection</a>
                                        <button class="btn btn-warning-custom rounded-0 px-5 ml-0 ml-md-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take test for selected topic</button>
                                    </div>
                                </form>


                            </div>
                            @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('afterlogin.layouts.footer')

<script type="text/javascript">
    $('.scroll-div').slimscroll({
        height: '50vh'
    });
    $(document).ready(function() {

        $("#topic_form").validate({

            submitHandler: function(form) {
                var selected_topics = $('#selected_topic').val();
                if (selected_topics == '' || selected_topics == null) {
                    $('#errlog_alert').html('Please select atleast on topic for exam.');
                    $('#errlog_alert').show();
                    setTimeout(function() {
                        $('#errlog_alert').fadeOut('fast');
                    }, 10000);
                    return false;
                }

                form.submit();
            }

        });
    });
    var aTopics = [];

    function addOrRemove(value) {
        var index = aTopics.indexOf(value);

        if (index === -1) {
            aTopics.push(value);
            $('#chpt_topic_' + value).removeClass('btn-light');
            $('#chpt_topic_' + value).addClass('btn-primary');
        } else {
            aTopics.splice(index, 1);
            $('#chpt_topic_' + value).removeClass('btn-primary');
            $('#chpt_topic_' + value).addClass('btn-light');
        }
        $('#selected_topic').val(aTopics);
        //console.log(aTopics);
    }

    function clearTopics() {
        aTopics = [];
        $('#selected_topic').val('');
        $('.addremovetopic').removeClass('btn-primary');
        // console.log(aTopics);
    }


    var starClicked = false;

    $(function() {

        $('.star').click(function() {

            $(this).children('.selected').addClass('is-animated');
            $(this).children('.selected').addClass('pulse');

            var target = this;

            setTimeout(function() {
                $(target).children('.selected').removeClass('is-animated');
                $(target).children('.selected').removeClass('pulse');
            }, 1000);

            starClicked = true;
        })

        $('.half').click(function() {
            if (starClicked == true) {
                setHalfStarState(this)
            }
            $(this).closest('.rating').find('.js-score').text($(this).data('value'));

            $(this).closest('.rating').data('vote', $(this).data('value'));
            calculateAverage()
            console.log(parseInt($(this).data('value')));

        })

        $('.full').click(function() {
            if (starClicked == true) {
                setFullStarState(this)
            }
            $(this).closest('.rating').find('.js-score').text($(this).data('value'));

            $(this).find('js-average').text(parseInt($(this).data('value')));

            $(this).closest('.rating').data('vote', $(this).data('value'));
            calculateAverage()

            console.log(parseInt($(this).data('value')));
        })

        $('.half').hover(function() {
            if (starClicked == false) {
                setHalfStarState(this)
            }

        })

        $('.full').hover(function() {
            if (starClicked == false) {
                setFullStarState(this)
            }
        })

    })

    function updateStarState(target) {
        $(target).parent().prevAll().addClass('animate');
        $(target).parent().prevAll().children().addClass('star-colour');

        $(target).parent().nextAll().removeClass('animate');
        $(target).parent().nextAll().children().removeClass('star-colour');
    }

    function setHalfStarState(target) {
        $(target).addClass('star-colour');
        $(target).siblings('.full').removeClass('star-colour');
        updateStarState(target)
    }

    function setFullStarState(target) {
        $(target).addClass('star-colour');
        $(target).parent().addClass('animate');
        $(target).siblings('.half').addClass('star-colour');

        updateStarState(target)
    }

    function calculateAverage() {
        var average = 0

        $('.rating').each(function() {
            average += $(this).data('vote')
        })

        $('.js-average').text((average / $('.rating').length).toFixed(3))
    }

    $('.slick-slider').slick({
        slidesToScroll: 1,
        dots: false,
        centerMode: false,
        focusOnSelect: false,
        infinite: true,
        slidesToShow: 3,
        variableWidth: false,
        prevArrow: false,
        nextArrow: false
    });

    $('.slbs-link a').click(function() {

        $('.slick-slider').slick('refresh');
    })



    /* getting Next Question Data */
    function show_topic(chapt_id) {

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
                $("#topic_section_" + chapt_id).html('');
                $("#topic_section_" + chapt_id).html(result);
                $('.slick-slider').slick('refresh');
                $('#overlay').fadeOut();

            }
        });
    }
</script>

@endsection