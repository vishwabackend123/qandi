@extends('afterlogin.layouts.app_new')

@php
$userData = Session::get('user_data');
@endphp
@section('content')

@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
@endphp
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML-full"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
<div class="main-wrapper">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">

                    <div class="tab-wrapper h-100">

                        <div class="test-review">

                            <div class="tab-content position-relative cust-tab-content bg-white" id="myTabContent">
                                <div id="scroll-mobile">
                                    <!-- Exam subject Tabs  -->
                                    <ul class="nav nav-tabs cust-tabs exam-panel" id="myTab" role="tablist">
                                        @if(!empty($filtered_subject))
                                        @foreach($filtered_subject as $key=>$sub)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link all_div class_{{$sub->id}} @if($activesub_id==$sub->id) active @endif" id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true" onclick="get_subject_question('{{$sub->id}}')">{{$sub->subject_name}} </a>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                    <span class="back-to-dashbord"><a href="{{url('/dashboard')}}">Back To Dashboard</a></span>
                                </div>
                                <!-- End Exam subject Tabs -->
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div id="review_rques_blk">
                                        <div class="question-block">
                                            <a href="javascript:void(0);" id="bkm_{{$activeq_id}}" onclick="bookmarkforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')" class="arrow next-arow" title="Bookmark"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a>
                                            <div class="question pb-3 pt-2"><span class="q-no">Q1.</span>
                                                {!! $question_text !!}
                                            </div>
                                            <div class="ans-block row mt-0">
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
                                                $attemptedByUser=isset($attempt_opt['Answer:'])?$attempt_opt['Answer:']:[];

                                                if(in_array($key,$answerKeys) && in_array($key,$attemptedByUser)){
                                                $resp_class= 'correctAnswer';
                                                }else if(in_array($key,$answerKeys) && !in_array($key,$attemptedByUser)){
                                                $resp_class= 'correctAnswer';
                                                }else if(!in_array($key,$answerKeys) && in_array($key,$attemptedByUser)){
                                                $resp_class= 'incorrectAnswer';
                                                }else{
                                                $resp_class= '';
                                                }
                                                if(isset($attempt_opt['Answer:']) && in_array($key,$attempt_opt['Answer:'])){
                                                $checked= "checked";
                                                }else{
                                                $checked='';
                                                }

                                                @endphp
                                                <div class="col-md-6 mb-4">
                                                    <input class="form-check-input checkboxans" {{$checked}} disabled type="checkbox" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}">
                                                    <div class="border ps-3 ans {{$resp_class}}">
                                                        <label class="question m-0 py-3 " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}. </span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
                                                    </div>
                                                </div>@php $no++; @endphp
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="answer-section">
                                            <div class="answer-btn-txt"><span>Answer:</span>
                                                <span> @php $mn=0; @endphp
                                                    @foreach($correct_ans as $akey=>$ans_value)
                                                    @php
                                                    $ans_dom = new DOMDocument();
                                                    @$ans_dom->loadHTML($ans_value);
                                                    $ans_anchor = $ans_dom->getElementsByTagName('img')->item(0);
                                                    $atext = isset($ans_anchor)? $ans_anchor->getAttribute('alt') : '';
                                                    $alatex = "https://math.now.sh?from=".$atext;
                                                    $view_ans='<img src="'.$alatex.'" />' ;
                                                    @endphp
                                                    {!! !empty($atext)?$view_ans:$ans_value; !!}
                                                    @php $mn++; @endphp
                                                    @endforeach</span>
                                                <!-- <button class="percentage-digit">21 %</button> -->
                                            </div>
                                            <div class="ans-txt">
                                                @if(isset($question_data->explanation ) && !empty($question_data->explanation ))
                                                <sapn>Explanation :</sapn>
                                                <p>{!! $question_data->explanation !!}</p>
                                                @endif
                                                @if(isset($question_data->reference_text ) && !empty($question_data->reference_text ))

                                                <span>Reference :</span>

                                                <p>{!! $question_data->reference_text !!}</p>
                                                @endif
                                            </div>

                                            
                                                <div class="expand_button">
                                                    <img class="expandbtn" src="{{URL::asset('public/after_login/new_ui/images/Component1.png')}}">
                                                    <img class="collapsebtn" src="{{URL::asset('public/after_login/new_ui/images/Component1.png')}}">
                                                </div>
                                                <div class="review_expand">
                                                    
                                                    <button class="open percent_btn">21%</button>
                                                    <div class="popup-content">
                                                        <div class="sa">
                                                            <div class="first_screen first_screen_popup">
                                                                <div class="persent_std">
                                                                    <span class="no-of-persent">21%</span><span class="attend">of the people got this question right</span>
                                                                </div> 
                                                                <div class="propt_text">To answer this you need to have</div>
                                                                <div class="attemp_box row mt-0">
                                                                    <div class="sub_att_1 col-md-6">
                                                                    <p>knowledge,Application of</p>
                                                                    <a class="detail_btn">Pythagoras therem</a>
                                                                    </div>
                                                                    <div class="sub_att_1 col-md-6">
                                                                    <p>knowledge,Application of</p>
                                                                    <a class="detail_btn2">Pythagoras therem</a>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="other_screen  second_screen_popup">
                                                                <div class="detail_text-heading">
                                                                        <div class="left_box">
                                                                            <p class="detail_h">Pythagoras therem</p>
                                                                            <p class="main-catgy">Maths / Geometry</p>
                                                                        </div>  
                                                                        <div class="right_box">
                                                                            <ul>
                                                                                <li><a href="javascript:void(0);"><i class="fa fa-bookmark-o" aria-hidden="true"></i><span>2</span></a></li>
                                                                                <li><a href="javascript:void(0);"><i class="fa fa-bookmark-o" aria-hidden="true"></i><span>2</span></a></li>
                                                                                <li><a href="javascript:void(0);"><i class="fa fa-bookmark-o" aria-hidden="true"></i><span>2</span></a></li>
                                                                                <li><a href="javascript:void(0);"><i class="fa fa-bookmark-o" aria-hidden="true"></i><span>2</span></a></li>
                                                                                <li><a href="javascript:void(0);"><i class="fa fa-bookmark-o" aria-hidden="true"></i><span>2</span></a></li>
                                                                            </ul>
                                                                        </div> 
                                                                </div>
                                                                <p class="detail_text_content">Arc & Radius is a concept from Geometry that helps you get around 12 marks in the final exam.
                                                                If you are able to get the knowledge, you can easily get 4 marks. If you are able to comprehend and apply the concept, you can get the remaining 8 marks.</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <!--answer-section-->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--test-review-->
                    </div>
                </div>
                <!-- Right Side Area -->

<script>
$(".open").on("click", function() {
  $(".first_screen_popup").addClass("active");
});

$(".detail_btn").on("click", function() {
  $(".second_screen_popup").addClass("active");
});
</script>

 
<script>
        $(document).ready(function(){
        $(".expandbtn").on('click',function() { 
            $(".review-qus").css({'height':'400'}); 
            $(".answer-section").css({'height':'400'}); 
        });

        $(".collapsebtn").on('click',function() { 
            $(".review-qus").css({'height':'210'}); 
            $(".answer-section").css({'height':'200'}); 
        });
        });
</script>

<script>
    
    $(document).ready(function(){
        $(".expandbtn").on('click',function() { 
            $(".expandbtn").css({'display':'none'}); 
            $(".collapsebtn").css({'display':'block'}); 
            
        });

        $(".collapsebtn").on('click',function() { 
            $(".collapsebtn").css({'display':'none'}); 
            $(".expandbtn").css({'display':'block'}); 
            
        });

    });
</script>






<style>
.expand_button{
    position: absolute;
    top: 8%;
    right: 2%;
}
.collapsebtn{
    display:none;
}

.right_box ul{
    padding:0px;
    margin:0px;
}

.right_box  span {
    padding-left: 5px;
}

.right_box ul li a{
    color: #605f5f;
}
.detail_text_content{
    font-size: 14px;
    color: #2c3348;
    opacity: .99;
    max-height: 90px;
    overflow-y: scroll;
}

.right_box ul li{
    list-style: none;
    display: inline-block;
    padding: 0px 6px;
    color: red;

} 

.detail_text-heading{
    display: flex;
    justify-content: space-between;
    align-items: self-start;
}

.detail_text-heading p{
    font-size:13px;
}

.review_expand .detail_h{
    color: #00baff;
    font-size: 12px;
    font-weight: bold;
    width: auto;
    display: block;
    text-transform: uppercase;
    text-align: left;
    cursor: pointer;
}

.main-catgy {
    color:#2c3348;
}

.review_expand .left_box  p{
    padding: 0px;

}

.review_expand .expand_button{
    position: absolute;
    top: 15px;
    right: 15px;
}
.percent_btn {
    color: #ffffff;
    background-color: #00bdff;
    border-radius: 17px;
    padding: 10px 60px;
    border: navajowhite;
    font-size: 14px;
}

.first_screen_popup.active {
    display: block;
    z-index: 999;
}

.second_screen_popup.active  ,.thired_screen_popup.active {
    display: block;
}

.other_screen{
    padding: 14px !important;
    border-radius: 18px;
    box-shadow: 0 0 20px 0 rgb(0 0 0 / 10%);
    background-color: #ffffff;
    max-height: 193px;
    width: 100%;
    min-width: 400px;
}
.first_screen {
    padding: 14px !important;
    border-radius: 18px;
    box-shadow: 0 0 20px 0 rgb(0 0 0 / 10%);
    background-color: #ffffff;
    width:315px;
}

.no-of-persent{
    font-size: 36px;
    font-weight: 600;
    color: #37c027;
}
.attend{
    width: 178px;
    object-fit: contain;
    font-size: 16px;
    opacity: .99;
    color: #231f20;
    padding-left: 14px;
}

.persent_std{
    display: flex;
    align-items: center;
    border-bottom: 2px solid #86878b9e;
}

.attemp_box span{
    font-size:12px;
    color: #2c3348;
}

.attemp_box a{
    color: #00baff;
    font-size: 12px;
    font-weight: bold;
    width: auto;
    display: block;
    text-transform: uppercase;
    width: 100px;
    text-align:left;    cursor: pointer;
}
.attemp_box{
    display:flex;
}

.sub_att_1  p{
    font-size: 11px;
    margin-bottom: 0px;
    color: #2c3348;
    text-align: left;
    opacity: .99;
}
.propt_text{
    padding: 20px 0px;
    text-align: left;
    font-size: 14px;
    color: #2c3348;
    opacity: .99;
}
.main-catgy{
    font-size: 14px;
    color: #2c3348;
    opacity: .99;
}
.review_expand .button {
    background-color:#ccc;
    width:60px;
}

.first_screen_popup, .second_screen_popup, .thired_screen_popup{
    display: none;
}

.review_expand{
    position: absolute;
    top: 20%;
    right: 10%;
}
.sa{
    display: flex;
    flex-direction: row-reverse;
    position: relative; top: -41px;
}
.second_screen_popup , .thired_screen_popup {
    position: absolute;
    right: 295px;
}

.answer-section {
 
    position: absolute;
    bottom: 0px;
    width: 98%;
}
#review_rques_blk{
    position: relative;
}

</style>
<script>
$(".button").click(function(e){
    $(".dropdown").show();
     e.stopPropagation();
});

$(".dropdown").click(function(e){
    e.stopPropagation();
});

$(document).click(function(){
    $(".dropdown").hide();
});
</script>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 rightSect test-review-right">
                    <div class="bg-white d-flex flex-column justify-content-center mb-4   p-5">



                        <p class="rightSectH">Answer</p>
                        <div class="number-block">
                            @php $quKey=1; @endphp
                            @if(isset($all_question_list) && !empty($all_question_list))

                            @foreach($all_question_list as $ke=>$val)
                            @php
                            $key_id=$val->question_id;
                            @endphp

                            @if ($val->attempt_status == 'Correct')
                            <button class="btn btn-light-green mb-4 rounded-0 next_button" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @elseif ($val->attempt_status == 'Incorrect')
                            <button class="btn btn-danger mb-4 rounded-0 next_button" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @else
                            <button class="btn btn-light rounded-0 mb-4 next_button" id="btn_{{$key_id}}" onclick="qnext('{{$key_id}}')">{{$quKey}}</button>
                            @endif
                            @php $quKey++; @endphp
                            @endforeach
                            @endif
                        </div>

                        <div class="review-qus" id="review_question_list">
                            <div class="d-flex mb-3 reviewBox2">
                                <div class="col-10 heading">
                                    <h5><strong>Review Questions</strong></h5>
                                </div>
                                <div class="col text-end">
                                    <div class="dropdown">
                                        <a class="btn rotate-icon pt-0 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" title="Filters"><i class="fa fa-sliders" aria-hidden="true"></i></a>


                                        <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('all')">
                                                    All</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Correct')"> Corrected</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Incorrect')"> Wronged</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="get_filtered_question('Unanswered')"> Unattempted</a></li>

                                        </ul>
                                    </div>
                                </div>

                            </div>


                            <ul class="rview-quses" id="filter_questions">
                                @php $quKee=1; @endphp
                                @if(isset($all_question_list) && !empty($all_question_list))
                                @foreach($all_question_list as $kee=>$value)
                                @php

                                $key_id=$value->question_id;
                                @endphp
                                @if ($value->attempt_status == 'Correct')
                                <li class="correctans">
                                    <span class="qus-no">Q.{{$quKee}}</span>
                                    <span class="qus-txt">{!! $value->question !!}
                                    </span>
                                </li>
                                @elseif ($value->attempt_status == 'Incorrect')
                                <li class="incorrectans">
                                    <span class="qus-no">Q.{{$quKee}}</span>
                                    <span class="qus-txt">{!! $value->question !!}
                                    </span>
                                </li>
                                @else
                                <li class="notans">
                                    <span class="qus-no">Q.{{$quKee}}</span>
                                    <span class="qus-txt">{!! $value->question !!}
                                    </span>
                                </li>
                                @endif
                                @php $quKee++; @endphp
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <!--review-qus-->


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->


<script type="text/javascript">
    $('.scroll-div').slimscroll({
        height: '40vh'
    });
    $('.number-block').slimscroll({
        height: '34vh'
    });
    $('.answer-block').slimscroll({
        height: '45vh'
    });

    $('.review-questions-blk').slimscroll({
        height: '58vh'
    });
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "review_question_list"]);

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

        url = "{{ url('next_review_question/') }}/" + question_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {

                $("#review_rques_blk").html(result);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub, "review_rques_blk"]);

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









 
 
<script>
 
    function setboxHeight() {
        var height = $(".rightSect .flex-column").outerHeight();
        $('.test-review').css('height', height);
        var calculatedHeight = height - 64 + "px";
        $('#review_rques_blk').css('height', calculatedHeight);
       
    }

        setboxHeight();
        $( "window" ).load(function() {
        setboxHeight();
        });
    

    $(window).resize(function() {
        setboxHeight();
    });
 
</script>
 
 
@endsection