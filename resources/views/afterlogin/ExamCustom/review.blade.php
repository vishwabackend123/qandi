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

@endphp
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')

<div class="main-wrapper bg-gray">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9  ps-lg-5">
                    <a href="{{url('/dashboard')}}" class="btn btn-danger back-to-d-btn">Back to dashboard</a>
                    <div class="tab-wrapper h-100 m-0">
                        <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                            @if(!empty($filtered_subject))
                            @foreach($filtered_subject as $key=>$sub)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif " id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true" onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}}</a>
                            </li>

                            @endforeach
                            @endif
                        </ul>

                        <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                            <!-- <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> -->
                            <div id="review_rques_blk">
                                <div class="question-block">
                                    <button class="btn arrow prev-arow {{empty($prev_qid)?'disabled':''}}" id="quesprev{{ $activeq_id }}" onclick="qnext('{{$prev_qid}}')"><i class="fa fa-angle-left"></i></button>
                                    <button class="btn arrow next-arow {{empty($next_qid)?'disabled':''}}" id="quesnext{{ $activeq_id }}" onclick="qnext('{{$next_qid}}')"><i class="fa fa-angle-right"></i></button>
                                    <div class="question pb-5" id="question_blk"><span class="q-no">Q1.</span>{!! $question_text !!}</div>
                                    <div class="ans-block row mt-5">
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

                                        if(in_array($key,$answerKeys) && in_array($key,$attempt_opt)){
                                        $resp_class= 'btn-light-green';
                                        }else if(in_array($key,$answerKeys) && !in_array($key,$attempt_opt)){
                                        $resp_class= 'btn-light-green';
                                        }else if(!in_array($key,$answerKeys) && in_array($key,$attempt_opt)){
                                        $resp_class= 'btn-light-red';
                                        }else{
                                        $resp_class= '';
                                        }
                                        @endphp
                                        <div class="col-md-6 mb-4">
                                            <input class="form-check-input radioans" type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                                            <div class="border ps-5 ans {{$resp_class}}">
                                                <label class="question m-0 py-3   d-block " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
                                            </div>
                                        </div>

                                        @php $no++; @endphp
                                        @endforeach
                                        @endif
                                    </div>

                                    <div class="answer-block p-3 ">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <p class="mb-0 text-green">answer :</p>
                                            </div>

                                            <div class="col-md-7">
                                                @php $mn=0; @endphp
                                                @foreach($correct_ans as $akey=>$ans_value)
                                                @php
                                                $ans_dom = new DOMDocument();
                                                @$ans_dom->loadHTML($ans_value);
                                                $ans_anchor = $ans_dom->getElementsByTagName('img')->item(0);
                                                $atext = isset($ans_anchor)? $ans_anchor->getAttribute('alt') : '';
                                                $alatex = "https://math.now.sh?from=".$atext;
                                                $view_ans='<img src="'.$alatex.'" />' ;
                                                @endphp
                                                <p class="mb-0 text-green"> {!! !empty($atext)?$view_ans:$ans_value; !!}</p>
                                                @php $mn++; @endphp
                                                @endforeach
                                            </div>

                                            <!--  <div class="col-md-3 text-end">
                                                <button type="button" class="btn btn-success btn-green answer-percentage-btn" data-bs-toggle="collapse" data-bs-target="#perecent-box">21%</button>
                                            </div> -->
                                            <div class="col-md-12 percentage-box collapse" id="perecent-box">
                                                <div class="d-flex p-4 bg-gray">
                                                    <div class="">
                                                        <h3>21%</h3>
                                                    </div>
                                                    <div class="">
                                                        <h5>Of the people have got this right</h5>
                                                    </div>
                                                </div>
                                                <div class="bg-white p-3">
                                                    <p>to answer this, you should have</p>

                                                    <p class="mb-0">knowledge of</p>
                                                    <button type="button" class="btn btn-danger mb-3" data-bs-toggle="collapse" data-bs-target="#perecent-box1">ARC & RADIUS</button>

                                                    <p class="mb-0">knowledge and application of</p>
                                                    <button type="button" class="btn btn-danger">Pythagoras Theorem</button>

                                                </div>

                                            </div>

                                            <div class="col-md-12 percentage-box arc-radius-box collapse" id="perecent-box1">
                                                <div class=" p-4 bg-gray">
                                                    <div class="d-flex">
                                                        <div class="">
                                                            <h6 class="text-danger">ARC & RADIUS</h6>
                                                        </div>
                                                        <div class="text-end">
                                                            <ul>
                                                                <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                                                <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                                                <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                                                <li><a href=""><i class="fa fa-bookmark-o" aria-hidden="true"></i> 2</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 pt-1">
                                                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                                            <ol class="breadcrumb mb-0">
                                                                <li class="breadcrumb-item text-danger">/ Basic Geometry /</li>
                                                                <li class="breadcrumb-item text-danger">Geometry /</li>
                                                            </ol>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <div class="bg-white p-4">
                                                    <p>AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>

                                                    <p class="mb-0">AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-7">
                                                {!! $question_data->reference_text !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-5 rightPannerl">

                    <div class="bg-white d-flex flex-column justify-content-center mb-4  py-4 px-4 reviewBox">
                        <p><b>Answer Palette</b></p>
                        <div class="number-block">
                            @php $quKey=1; @endphp
                            @if(isset($all_question_list) && !empty($all_question_list))

                            @foreach($all_question_list as $ke=>$val)
                            @php
                            $key_id=$val->question_id;
                            if ($val->attempt_status == 'Correct') {
                            $key_class = 'btn-light-green';
                            } elseif ($val->attempt_status == 'Incorrect') {
                            $key_class = 'btn-light-red';
                            } else {
                            $key_class = 'btn-light';
                            }@endphp
                            <button type="button" class="btn {{$key_class}} rounded-0 mb-4" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">
                                {{$quKey}}</button>
                            @php $quKey++; @endphp
                            @endforeach
                            @endif


                        </div>
                    </div>
                    <div class="bg-white d-flex flex-column justify-content-center py-4 px-4 review-questions">
                        <div class="d-flex mb-3 reviewBox2">
                            <div class="col-8 heading">
                                <h5>Review Questions.</h5>
                            </div>
                            <div class="col text-end">
                                <div class="dropdown">
                                    <a class="btn rotate-icon pt-0 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true"></i></a>


                                    <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"> Attempted</a></li>
                                        <li><a class="dropdown-item" href="#"> Wronged</a></li>
                                        <li><a class="dropdown-item" href="#"> Unattempted</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="review-questions-blk">
                            @php $quKee=1; @endphp
                            @if(isset($all_question_list) && !empty($all_question_list))

                            @foreach($all_question_list as $kee=>$value)
                            @php

                            $key_id=$value->question_id;
                            if ($value->attempt_status == 'Correct') {
                            $div_class = 'border-left-green5';
                            } elseif ($value->attempt_status == 'Incorrect') {
                            $div_class = 'border-left-red5';
                            } else {
                            $div_class = '';
                            }@endphp
                            <div class="d-flex align-items-center">
                                <div class="review-questions-box {{$div_class}} mx-2 mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">Q{{$quKee}}. </div>
                                        <p class="mb-0">{!! $value->question !!} </p>
                                    </div>
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
        height: '30vh'
    });
    $('.answer-block').slimscroll({
        height: '30vh'
    });

    $('.review-questions-blk').slimscroll({
        height: '70vh'
    });


    /* getting Next Question Data */
    function qnext(question_id) {

        url = "{{ url('next_review_question/') }}/" + question_id;
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

    function get_subject_question(subject_id) {

        url = "{{ url('ajax_review_next_subject_question/') }}/" + subject_id;
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
</script>

@endsection