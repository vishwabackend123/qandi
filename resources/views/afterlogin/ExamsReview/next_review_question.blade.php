@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
$accuracy = isset($question_data->accuracy)?$question_data->accuracy:0;


$template_type = isset($question_data->template_type)?$question_data->template_type:'';
$difficulty_level = isset($question_data->difficulty_level)?$question_data->difficulty_level:1;

$question_type = '';
if($template_type == 1){
$type_class='checkboxans';
$questtype='checkbox';
$question_type = "Multi Choice";
}elseif($template_type == 2){
$type_class='radioans';
$questtype='radio';
$question_type = "Single Choice";
}elseif ($template_type == 11) {
$question_type = "Numerical";
}
@endphp
<div class="questionsliderinner">
    <div class="reviewscreenquestion">
        <div class="questionsliderbox">
            <div class="questionwrapper">
                <div class="questionheader">
                    <div class="question">
                        <span class="q-no">Q{{$qNo}}.</span>
                        <p>
                            {!! $question_text !!}
                        </p>
                    </div>
                </div>
                <!--  <div class="questionImggraph">

                                                    </div> -->
                <div class="questionOptionBlock">
                    <div class="fancy-radio-buttons row with-image">
                        @if($template_type==1 || $template_type==2)
                        @if(isset($option_data) && !empty($option_data))
                        @php $no=0;
                        $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
                        @endphp

                        @foreach($option_data as $key=>$opt_value)
                        @php
                        /*
                        $dom = new DOMDocument();
                        @$dom->loadHTML($opt_value);
                        $anchor = $dom->getElementsByTagName('img')->item(0);
                        $text = isset($anchor)? $anchor->getAttribute('alt') : '';
                        $latex = "https://math.now.sh?from=".$text;
                        $view_opt='<img src="'.$latex.'" />' ;
                        */
                        $attemptedByUser=isset($attempt_opt['Answer:'])?$attempt_opt['Answer:']:[];

                        if(in_array($key,$answerKeys) && in_array($key,$attemptedByUser)){
                        $resp_class= 'correctans';
                        }else if(in_array($key,$answerKeys) && !in_array($key,$attemptedByUser)){
                        $resp_class= 'correctans';
                        }else if(!in_array($key,$answerKeys) && in_array($key,$attemptedByUser)){
                        $resp_class= 'wronganswer';
                        }else{
                        $resp_class= '';
                        }
                        if(isset($attempt_opt['Answer:']) && in_array($key,$attempt_opt['Answer:'])){
                        $checked= "checked";
                        }else{
                        $checked='';
                        }

                        @endphp
                        <div class="colMargin">
                            <div class="image-container">
                                <input type="radio" id="option_{{$activeq_id}}_{{$key}}" name="quest_option_{{$activeq_id}}" value="{{$key}}" class="correct" {{$checked}} disabled />
                                <label for="opt1" class="image-bg  {{$resp_class}}" for="option_{{$activeq_id}}_{{$key}}"> <span class="seNo">{{$alpha[$no]}}</span> <span class="optionText">{!! !empty($text)?$view_opt:$opt_value; !!}</span> </label>
                            </div>
                        </div>
                        @php $no++; @endphp
                        @endforeach
                        @endif
                        @elseif($template_type==11)
                        @php $attemptedByUser=isset($attempt_opt['Answer:'][0])?$attempt_opt['Answer:'][0]:''; @endphp
                        <div class="colMargin">
                            <div class="inputAns">
                                <label for="story">Answer</label>
                                <textarea style="resize:none" placeholder="Answer here" rows="20" name="quest_option_{{$activeq_id}}" id="quest_option_{{$activeq_id}}" cols="40" class="ui-autocomplete-input allownumericwithdecimal" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" disabled>{{$attemptedByUser}}</textarea>
                            </div>
                        </div>
                        @endif


                    </div>
                </div>

            </div>
            <div class="answer-main-sec">
                <div class="anshead-top">
                    <span>Answer:</span>


                    <div class="review_expand">
                        <div class='percent_btn'><button class="btn btn-ans questionbtn">View details</button></div>
                        <div class='expand_block'>
                            <div class="first_screen">
                                <div class="questionright d-flex align-items-center justify-content-between mb-4">
                                    <h5>{{$accuracy}}%</h5>
                                    <h6>of the people got this question right</h6>
                                </div>


                                <div class="attemp_box row mt-0">
                                    <div class="sub_att_1 col-md-6">
                                        @if(isset($question_data->topic_name) && !empty($question_data->topic_name))
                                        <p>Topic pre-requisite</p>
                                        <a href="javascript:void(0);" class="detail_btn" style="cursor:default"> {{(isset($question_data->topic_name) && !empty($question_data->topic_name))?$question_data->topic_name:''}}</a>
                                        @endif

                                    </div>
                                    <div class="sub_att_1 col-md-6">

                                        @if(isset($question_data->concept_name) && !empty($question_data->concept_name))
                                        <p>Concept pre-requisite</p>
                                        <a href="javascript:void(0);" class="detail_btn" style="cursor:default">{{(isset($question_data->concept_name) && !empty($question_data->concept_name))?$question_data->concept_name:''}}</a>
                                        @endif

                                    </div>
                                </div>
                                <div class="box-border"></div>
                                <div class="learskill d-flex align-items-center justify-content-between">
                                    <p>Learning skill required:</p>
                                    <h3>{{isset($question_data->skill_name)?$question_data->skill_name:''}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="expandbtn1">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </label>
                    <label class="collapsebtn1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </label>
                </div>
                <div class="anshead-titletext">
                    <p> @php $mn=0; @endphp
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
                        @endforeach</p>
                </div>
                <div class="explanation-sec">
                    <div class="explanationdeteail">
                        @if(isset($question_data->explanation ) && !empty($question_data->explanation ))
                        <span>Explanation:</span>
                        <p>{!! $question_data->explanation !!}</p>
                        @endif
                    </div>

                </div>


            </div>


        </div>
    </div>

</div>

<!-----Start-for-percent-btn-click------->
<script>
    $(".percent_btn").click(function(e) {
        $(".expand_block").show();
        e.stopPropagation();
    });

    $(".expand_block").click(function(e) {
        e.stopPropagation();
    });

    $(document).click(function() {
        $(".expand_block").hide();
    });
</script>
<!-----End-for-percent-btn-click------->
<script>
    var question_id = '{{$activeq_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");

    $("#myTab .qcountout").removeClass("ReCountActive");
    $("#myTab .review_" + subject_id).addClass("ReCountActive");
</script>


<script>
    function review_right_Height() {
        var total_right_height = $(".reviewScreenright ").outerHeight();
        $('.reviewScreenleft ').css('height', total_right_height);
        $('.examScreentab ').css('height', total_right_height);
        var examTabheader_height = $(".examTabheader").outerHeight();
        var questionType_height = $(".questionType").outerHeight();
        var topheader_height = examTabheader_height + questionType_height;
        var cal_height = total_right_height - topheader_height;
        $('.tab-content ').css('height', cal_height);
        $('.questionsliderbox').css('height', cal_height);
        var answer_main_sec_height = $(".answer-main-sec ").outerHeight();
        var question_slider_box_height = $(".questionsliderbox").outerHeight();
        var mid_section_height = question_slider_box_height - answer_main_sec_height;
        $('.questionwrapper ').css('height', mid_section_height);

        var questionwrapper_final_height = $(".questionwrapper").outerHeight();
        var questfinal = question_slider_box_height - questionwrapper_final_height;
        $('.answer-main-sec ').css('height', questfinal);
        var answerfinalheight = $(".answer-main-sec").outerHeight();
        var extra_height = answerfinalheight - 20 + "px";
        $('.answer-main-sec ').css('height', extra_height);
        var answerfinalheight = $(".answer-main-sec").outerHeight();
        var answerfinalheight_145 = answerfinalheight - 145 + "px";
        $('.explanation-sec ').css('height', answerfinalheight_145);



    }

    review_right_Height();
    $("window").load(function() {
        review_right_Height();
    });


    $(window).resize(function() {
        review_right_Height();
    });
</script>
<script>
    $(document).ready(function() {
        $(".expandbtn1").on('click', function() {
            var expand_question_slider_box_height = $(".questionsliderbox").outerHeight();
            var questionheader_height = $(".questionheader").outerHeight();

            $('.answer-main-sec').css('height', expand_question_slider_box_height);
            var expand_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var final_height = expand_answer_main_sec_height - questionheader_height;
            $('.answer-main-sec').css('height', final_height);



            var ex_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var expand_anshead_titletext_height = $(".anshead-titletext").outerHeight();
            var expand_anshead_top_height = $(".anshead-top").outerHeight();
            var expand_totalpopup_height = expand_anshead_titletext_height + expand_anshead_top_height;
            var expand_height_popupSection = ex_answer_main_sec_height - expand_totalpopup_height;
            $('.explanation-sec').css('height', expand_height_popupSection);

            var ex_answer_main_sec_height_final = $(".explanation-sec").outerHeight();


            var ex_scroll_height = ex_answer_main_sec_height_final - 120 + "px";
            $('.explanation-sec').css('height', ex_scroll_height);




        });

        $(".collapsebtn1").on('click', function() {
            var coll_questionsliderbox_height = $(".questionsliderbox").outerHeight();
            var coll_questionwrapper_height = $(".questionwrapper").outerHeight();
            var coll_final_height = coll_questionsliderbox_height - coll_questionwrapper_height;
            $('.answer-main-sec').css('height', coll_final_height);
            var coll_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var coll_expand_anshead_titletext_height = $(".anshead-titletext").outerHeight();
            var coll_expand_anshead_top_height = $(".anshead-top").outerHeight();
            var coll_totalpopup_height = coll_expand_anshead_titletext_height + coll_expand_anshead_top_height;
            var coll_height_popupSection = coll_answer_main_sec_height - coll_totalpopup_height;
            $('.explanation-sec').css('height', coll_height_popupSection);
            var coll_answer_main_sec_height_final = $(".explanation-sec").outerHeight();
            var coll_scroll_height = coll_answer_main_sec_height_final - 90 + "px";
            $('.explanation-sec').css('height', coll_scroll_height);
            var answer_main_sec_height_coll = $(".answer-main-sec").outerHeight();
            var answer_main_sec_height_coll_sub = answer_main_sec_height_coll - 20 + "px";
            $('.answer-main-sec ').css('height', answer_main_sec_height_coll_sub);
            $('.explanation-sec').css('height', coll_scroll_height);
            var afterclikecoll = $(".explanation-sec").outerHeight();
            var afterclikecoll_cal = afterclikecoll - 30 + "px";
            $('.explanation-sec').css('height', afterclikecoll_cal);


        });
    });
</script>


<!-----Start__Right_Review_Height_Calculation------->
<script>
    function review_right_Height() {
        var review_Screen_right_height = $(".reviewScreenright").outerHeight();
        var test_review_height_div = review_Screen_right_height / 2;
        $('.custom-anstop').css('height', test_review_height_div);
        $('.reviewans-mainsec').css('height', test_review_height_div);
    }

    review_right_Height();
    $("window").load(function() {
        review_right_Height();
    });


    $(window).resize(function() {
        review_right_Height();
    });
</script>

<script>
    $(document).ready(function() {
        $(".expandbtn").on('click', function() {
            var review_Screen_right_height = $(".reviewScreenright").outerHeight();
            var review_ans_mainsec_heigth = $(".reviewans-mainsec").outerHeight();
            var custom_ans_top_heigth = $(".custom-anstop").outerHeight();
            var review_filter_top_height = $(".review-filter-top").outerHeight();
            var list_ans_height = $(".list-ans").outerHeight();
            var calculated_height = review_Screen_right_height - review_ans_mainsec_heigth;
            var onclick_review_box = custom_ans_top_heigth + calculated_height;
            $('.reviewans-mainsec').css('height', onclick_review_box);
            var afterExpandtotalheight = $(".reviewScreenright").outerHeight();
            var min_height_q_list_h = afterExpandtotalheight - 122 + "px";
            $('.reviewans-mainsec').css('height', min_height_q_list_h);
            var reviewans_final_height = $(".reviewans-mainsec").outerHeight();
            var scroll_height = reviewans_final_height - review_filter_top_height;
            var scroll_height_20 = scroll_height - 30 + "px";
            $('.list-ans').css('height', scroll_height_20)
        });

        /*$(".collapsebtn").on('click', function() {
            console.log("hello");
            var review_ans_mainsec_heigth = $(".reviewans-mainsec").outerHeight();
            var custom_ans_top_heigth = $(".custom-anstop").outerHeight();
            var onclick_review_box2 = review_ans_mainsec_heigth - custom_ans_top_heigth;
            var clickcollapesbtn = onclick_review_box2 + 122 + "px";
            $('.reviewans-mainsec').css('height', clickcollapesbtn);
            var coll_outer_height = $(".reviewans-mainsec").outerHeight();
            var coll_review_filter_to_height = $(".review-filter-top").outerHeight();
            var coll_review_divide_height = coll_outer_height - coll_review_filter_to_height;
            var coll_scroll_final_height = coll_review_divide_height - 20 + "px";
            $('.list-ans').css('height', coll_scroll_final_height)
        });*/
    });
</script>

<!-----End__Right_Review_Height_Calculation------->
<!-----Start-for-expand-btn-click------->
<script>
    $('.expandbtn').on('click', function() {
        $('.collapsebtn').css({
            display: "block"
        });
        $('.expandbtn').css({
            display: "none"
        });
    });

    $('.collapsebtn').on('click', function() {
        $('.collapsebtn').css({
            display: "none"
        });
        $('.expandbtn').css({
            display: "block"
        });
    });

    $('.expandbtn1').on('click', function() {
        $('.collapsebtn1').css({
            display: "block"
        });
        $('.expandbtn1').css({
            display: "none"
        });
    });

    $('.collapsebtn1').on('click', function() {
        $('.collapsebtn1').css({
            display: "none"
        });
        $('.expandbtn1').css({
            display: "block"
        });
    });
</script>
<!-----end-for-expand-btn-click------->


<script>
    if ($(window).height() < 900) {
        body {
            background - color: red;
        }

    } else {
        // change functionality for larger screens
    }
</script>