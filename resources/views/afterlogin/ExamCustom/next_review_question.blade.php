@php
$question_text = isset($question_data->question)?$question_data->question:'';
$option_data = (isset($question_data->question_options) && !empty($question_data->question_options))?json_decode($question_data->question_options):'';
$subject_id = isset($question_data->subject_id)?$question_data->subject_id:0;
$chapter_id = isset($question_data->chapter_id)?$question_data->chapter_id:0;
@endphp

<div class="question-block">
    <a href="javascript:void(0);" title="Bookmark" id="bkm_{{$activeq_id}}" onclick="bookmarkforreview('{{$activeq_id}}','{{$subject_id}}','{{$chapter_id}}')" class="arrow next-arow"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a>
    <div class="question pb-3 pt-2"><span class="q-no">Q{{$qNo}}.</span>
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
                <label class="question m-0 py-3 " for="option_{{$activeq_id}}_{{$key}}"><span class="q-no">{{$alpha[$no]}}.</span>{!! !empty($text)?$view_opt:$opt_value; !!}</label>
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
        <!-- <img  class="expandbtn" src="{{URL::asset('public/after_login/new_ui/images/Component1.png')}}"> -->
        <!-- <img  class="collapsebtn" style="display: none;" src="{{URL::asset('public/after_login/new_ui/images/Component1.png')}}"> -->
        <div class="expandbtn">
            <svg xmlns="http://www.w3.org/2000/svg" id="Component_226_4" data-name="Component 226 – 4" width="48" height="48" viewBox="0 0 48 48">
                <defs>
                    <style>
                        .cls-1,
                        .cls-2 {
                            fill: none;
                        }

                        .cls-2 {
                            stroke: #000;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke-width: 1.5px;
                        }
                    </style>
                </defs>
                <rect id="Rectangle_4849" data-name="Rectangle 4849" class="cls-1" width="48" height="48" rx="14" />
                <g id="Group_5111" data-name="Group 5111" transform="translate(12 12)">
                    <path id="Path_11580" data-name="Path 11580" class="cls-1" d="M0,0H24V24H0Z" />
                    <path id="Path_11581" data-name="Path 11581" class="cls-2" d="M16,4h4V8" />
                    <line id="Line_613" data-name="Line 613" class="cls-2" y1="6" x2="6" transform="translate(14 4.022)" />
                    <path id="Path_11582" data-name="Path 11582" class="cls-2" d="M8,20H4V16" />
                    <line id="Line_614" data-name="Line 614" class="cls-2" y1="6" x2="6" transform="translate(4 14.022)" />
                    <path id="Path_11583" data-name="Path 11583" class="cls-2" d="M16,20h4V16" />
                    <line id="Line_615" data-name="Line 615" class="cls-2" x2="6" y2="6" transform="translate(14 14.022)" />
                    <path id="Path_11584" data-name="Path 11584" class="cls-2" d="M8,4H4V8" />
                    <line id="Line_616" data-name="Line 616" class="cls-2" x2="6" y2="6" transform="translate(4 4.022)" />
                </g>
            </svg>
        </div>

        <div class="collapsebtn" style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" id="Component_226_6" data-name="Component 226 – 6" width="48" height="48" viewBox="0 0 48 48">
                <defs>
                    <style>
                        .cls-1,
                        .cls-2 {
                            fill: none;
                        }

                        .cls-2 {
                            stroke: #000;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke-width: 1.5px;
                        }

                        .cls-1,
                        .cls-2,
                        .cls-5 {
                            opacity: 1;
                        }
                    </style>
                </defs>
                <rect id="Rectangle_4849" data-name="Rectangle 4849" class="cls-1" width="48" height="48" rx="14" />
                <g id="Group_5112" data-name="Group 5112" transform="translate(12 12)">
                    <path id="Path_11585" data-name="Path 11585" class="cls-1" d="M0,0H24V24H0Z" />
                    <path id="Path_11586" data-name="Path 11586" class="cls-2" d="M5,9H9V5" />
                    <line id="Line_617" data-name="Line 617" class="cls-2" x2="6" y2="6" transform="translate(3 3)" />
                    <path id="Path_11587" data-name="Path 11587" class="cls-2" d="M5,15H9v4" />
                    <line id="Line_618" data-name="Line 618" class="cls-2" y1="6" x2="6" transform="translate(3 15)" />
                    <path id="Path_11588" data-name="Path 11588" class="cls-2" d="M19,9H15V5" />
                    <line id="Line_619" data-name="Line 619" class="cls-2" y1="6" x2="6" transform="translate(15 3)" />
                    <path id="Path_11589" data-name="Path 11589" class="cls-2" d="M19,15H15v4" />
                    <line id="Line_620" data-name="Line 620" class="cls-2" x2="6" y2="6" transform="translate(15 15)" />
                </g>
            </svg>
        </div>
    </div>
    <div class="review_expand">
        <div class='percent_btn'>21%</div>
        <div class='expand_block'>
            <div class="first_screen">
                <div class="persent_std">
                    <span class="no-of-persent">21%</span><span class="attend">of the people got this question right</span>
                </div>
                <div class="propt_text">To answer this you need to have</div>
                <div class="attemp_box row mt-0">
                    <div class="sub_att_1 col-md-6">
                        <p>knowledge,Application of</p>
                        <a class="detail_btn" onclick="openPopup('div1');"> Pythagoras therem</a>
                    </div>
                    <div class="sub_att_1 col-md-6">
                        <p>knowledge,Application of</p>
                        <a class="detail_btn">PYTHAGORAS THEREM</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.answer-block').slimscroll({
        height: '45vh'
    });
    var question_id = '{{$activeq_id}}';
    $(".next_button").removeClass("activequestion");
    $("#btn_" + question_id).addClass("activequestion");

    var subject_id = '{{$subject_id}}';
    $("#myTab .all_div").removeClass("active");
    $("#myTab .class_" + subject_id).addClass("active");
</script>
<!-----Start-for-review-section-expand-on-btn--click------->
<script>
    $(document).ready(function() {
        $(".expandbtn").on('click', function() {
            var review_rques_blk_height = $("#review_rques_blk").outerHeight();
            var review_qus_height = $(".question-block .question").outerHeight();
            var customheight = review_rques_blk_height - review_qus_height;
            $('.answer-section').css('height', customheight);
            $('.question-block .question').css('height', review_qus_height);

        });

    });

    $(".collapsebtn").on('click', function() {
        var ans_height = $(".answer-section").outerHeight();
        var que_height = $(".question-block").outerHeight();
        var intial_height = ans_height - que_height;
        $('.answer-section').css('height', intial_height);

    });
</script>
<!-----End-for-review-section-expand-on-btn--click------->

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
</script>
<!-----end-for-expand-btn-click------->

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