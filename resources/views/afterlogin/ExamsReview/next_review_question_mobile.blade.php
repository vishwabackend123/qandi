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
<div class="answer-main-sec">
    <div class="anshead-top">
        <span>Answer:</span>


        <div class="review_expand">
            <div class='percent_btn'><button class="btn btn-ans questionbtn">View details</button></div>
            <div class='expand_block'>
                <div class="first_screen">
                    <!-- <div class="questionright d-flex align-items-center justify-content-between mb-4">
                                            <h5>{{$accuracy}}%</h5>
                                            <h6>of the people got this question right</h6>
                                        </div> -->

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
                    <div class="questionright d-flex align-items-center justify-content-between  mt-4 mb-2">
                        <h5>{{$accuracy}}%</h5>
                        <h6>of the people got this question right</h6>
                    </div>
                    <div class="box-border"></div>
                    <div class="learskill d-flex align-items-center justify-content-between">
                        <p>Learning skill required:</p>
                        <h3>{{isset($question_data->skill_name)?$question_data->skill_name:''}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <label class="expandbtn1 hideonmobile" title="Expand">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </label>
        <label class="collapsebtn1 hideonmobile" title="Collapse">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </label>


        <div class="viewdetailmobclik hideondesktop">
            <label class="expandbtnmob1" title="Expand">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </label>
            <label class="collapsebtnmob1" title="Collapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </label>
        </div>
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