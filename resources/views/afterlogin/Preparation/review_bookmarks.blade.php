@extends('afterlogin.layouts.app')
<script type="text/javascript">
    $(window).on("load resize scroll", function(e) {
        var winHeight = $(window).height();
        $('.tab-wrapper, .rightPannerl').height(winHeight);
    });
</script>
@section('content')
@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;

@endphp
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<style>
    #content-review .container {
        max-width: 1280px;

    }

    #content-review .tab-content {
        overflow-y: auto;

    }

    .time_taken_css {
        border-left: 3px Solid #ff6060;
        width: 200px;
        font: 14px;
        color: #2C3348;
        font-weight: 500;
        background-color: #e4e4e4;
        text-align: center;
    }

    .time_taken_css span:first-child {

        font-weight: 200;

    }

    .answer-block p {
        margin-bottom: 0px;
    }
</style>
<div class="main-wrapper bg-gray">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper " id="content-review">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <a href="{{url('/preparation_center')}}" class="btn btn-danger back-to-d-btn">Back</a>
                    <div class="tab-wrapper m-0">
                        <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                            @if(!empty($filtered_subject))
                            @foreach($filtered_subject as $key=>$sub)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif " id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true" onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}}</a>
                            </li>

                            @endforeach
                            @endif
                        </ul>

                        <div class="tab-content position-relative p-4 bg-white" id="myTabContent">
                            <!-- <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> -->
                            <div id="review_rques_blk">
                                <div class="question-block px-2 pt-3 pb-2">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="question pb-3" id="question_blk"><span class="q-no">Q1.</span>{!! $question_text !!}</div>
                                            <div class="ans-block row my-4 N_radioans">
                                                @if(isset($option_data) && !empty($option_data))
                                                @php $no=0;
                                                $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
                                                @endphp

                                                @foreach($option_data as $key=>$opt_value)
                                                @php
                                                $dom = new DOMDocument();
                                                @$dom->loadHTML($opt_value);
                                                $anchor = $dom->getElementsByTagName('img')->item(0);
                                                $text = isset($anchor)? $anchor->getAttribute('alt') : '';
                                                $latex = "https://math.now.sh?from=".$text;
                                                $view_opt='<img src="'.$latex.'" />' ;


                                                $resp_class= '';
                                                @endphp
                                                <div class="col-md-6 mb-4">
                                                    <input class="form-check-input radioans" type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                                                    <div class=" ps-5 ans {{$resp_class}}">
                                                        <label class="question m-0   d-block " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
                                                    </div>
                                                </div>

                                                @php $no++; @endphp
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <a href="javascript:void(0);" id="bkm_{{$activeq_id}}" onclick="bookmarkforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')"> <i class="fa fa-bookmark-o text-dark pull-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-5 rightPannerl ">

                    <!-- <div class="bg-white d-flex flex-column justify-content-center  reviewBox palette_box ">
                        <span class="palette_title">Answer Palette</span>
                        <div class="number-block N_number-block">
                            @php $quKey=1; @endphp
                            @if(isset($all_question_list) && !empty($all_question_list))

                            @foreach($all_question_list as $ke=>$val)
                            @php
                            $key_id=$val->question_id;
                            $key_class = 'btn-light';
                            @endphp
                            <input type="hidden" name="question_id" id="question_id" value="{{ $key_id }}">
                            <button type="button" class="next_button btn {{$key_class}} rounded-0 mb-4" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">
                                {{$quKey}}</button>
                            @php $quKey++; @endphp
                            @endforeach
                            @endif


                        </div>
                    </div> -->
                    <div class="bg-white d-flex flex-column justify-content-center  review-questions palette_box pt-2 ">
                        <div class="d-flex mb-3 reviewBox2">
                            <div class="col-10 heading">
                                <h5>Bookmarks Questions </h5>
                            </div>


                        </div>
                        <div class="review-questions-blk h-100" id="filter_questions">
                            @php $quKee=1; @endphp
                            @if(isset($all_question_list) && !empty($all_question_list))

                            @foreach($all_question_list as $kee=>$value)
                            <?php //echo "<pre>"; print_r($value); die; 
                            ?>

                            @php

                            $key_id=$value->question_id;

                            $div_class = '';
                            @endphp
                            <div class="d-flex align-items-center1">
                                <div class="review-questions-box {{$div_class}} pb-2">
                                    <button type="button" class="next_button1 btn {{$key_class}} rounded-0" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">
                                        <div class="d-flex">
                                            <div class="me-3">Q{{$quKee}}. </div>
                                            <p class="mb-0"><span style="text-align: left;">{!! $value->question !!} </span></p>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            @php $quKee++; @endphp
                            @endforeach
                            @endif


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
        height: '40vh'
    });
    $('.number-block').slimscroll({
        height: '25vh'
    });
    $('.answer-block').slimscroll({
        height: '45vh'
    });

    $('.review-questions-blk').slimscroll({
        height: '68vh'
    });

    function bookmarkforreview(quest_id, subject_id, chapt_id) {
        $.ajax({
            url: "{{ route('markforreview') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                question_id: quest_id,
                subject_id: subject_id,
                chapter_id: chapt_id
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);

                if (response.success == true) {

                    $("#bkm_" + quest_id).html('<i class="fa fa-bookmark text-danger pull-right" aria-hidden="true"></i>');

                } else {

                }

            },
        });
    }

    /* getting Next Question Data */
    function qnext(question_id) {
        url = "{{ url('next_review_questionbookmark/') }}/" + question_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#review_rques_blk").html(result);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question_section"]);

            }
        });
    }

    function get_subject_question(subject_id) {

        url = "{{ url('ajax_review_next_subject_questionbookmark/') }}/" + subject_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#review_rques_blk").html(result);
            }
        });
    }

    function get_filtered_question(filter) {
        url = "{{ url('filter_review_question/') }}/" + filter;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#filter_questions").html(result);
            }
        });
    }
</script>

@endsection