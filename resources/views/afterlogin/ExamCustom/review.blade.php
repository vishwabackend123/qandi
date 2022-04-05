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

                            <div class="tab-content position-relative cust-tab-content bg-white reviewPanel" id="myTabContent">
                                <div id="scroll-mobile">
                                    <!-- Exam subject Tabs  -->
                                    <ul class="nav nav-tabs cust-tabs exam-panel " id="myTab" role="tablist">
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
                                            <div class="question question-height pb-3 pt-2"><span class="q-no">Q1.</span>
                                                {!! $question_text !!}
                                            </div>
                                            <div class="ans-block row mt-0">
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
                                            <div class="answer-btn-txt"><span class="text-uppercase">Answer:</span>
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
                                                <div class='percent_btn'>{{(isset($question_data->accuracy) && !empty($question_data->accuracy))? $question_data->accuracy. '%':'View Details'}}</div>
                                                <div class='expand_block'>
                                                    <div class="first_screen">
                                                        @if(isset($question_data->accuracy) && !empty($question_data->accuracy))
                                                        <div class="persent_std">
                                                            <span class="no-of-persent">{{$question_data->accuracy}}%</span><span class="attend">of the people got this question right</span>
                                                        </div>
                                                        @endif
                                                        <div class="propt_text">To answer this you need to have</div>
                                                        <div class="attemp_box row mt-0">
                                                            <div class="sub_att_1 col-md-6">
                                                                <p>Knowledge, Application of</p>
                                                                <a href="javascript:void(0);" class="detail_btn" style="cursor:default"> {{(isset($question_data->topic_name) && !empty($question_data->topic_name))?$question_data->topic_name:''}}</a>
                                                            </div>
                                                            <div class="sub_att_1 col-md-6">
                                                                <p>Knowledge of</p>
                                                                <a href="javascript:void(0);" class="detail_btn" style="cursor:default">{{(isset($question_data->concept_name) && !empty($question_data->concept_name))?$question_data->concept_name:''}}</a>
                                                            </div>
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


                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 rightSect test-review-right  for-review-screen">
                    <div class="bg-white d-flex flex-column   mb-4">
                        <span class="subtitle padding_26" title="{{$exam_name}}">{{$exam_name}}</span>
                        <div class="number_block_holder padding_26">
                            <p class="rightSectH">Answer Palette</p>
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
                        </div>

                        <div class="review_box_holder padding_26">
                            <div class="d-flex reviewBox2 review_heading1">
                                <div class="col-8 heading">
                                    <h5 class="review_heading"><strong>Review Questions</strong></h5>
                                </div>
                                <div class="col-4 text-end d-flex add_btn_new">
                                    <div class="review_list_expand_btn_box">
                                        <div class="expandbtn1">
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
                                        <div class="collapsebtn1" style="display: none;">
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

                                    <div class="dropdown">
                                        <a class="btn p-0 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" title="Filters">
                                            <!-- <i class="fa fa-sliders" aria-hidden="true"></i> -->
                                            <svg data-name="Group 2283" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                <path data-name="Path 194" d="M0 0h24v24H0z" style="fill:none" />
                                                <rect data-name="Rectangle 15" width="4" height="5" rx="1" transform="translate(4 6)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                                                <path data-name="Line 95" transform="translate(6 4)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v2" />
                                                <path data-name="Line 96" transform="translate(6 11)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v9" />
                                                <rect data-name="Rectangle 16" width="4" height="5" rx="1" transform="translate(10 14)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                                                <path data-name="Line 97" transform="translate(12 4)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v10" />
                                                <path data-name="Line 98" transform="translate(12 19)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v1" />
                                                <rect data-name="Rectangle 17" width="4" height="6" rx="1" transform="translate(16 5)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                                                <path data-name="Line 99" transform="translate(18 4)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v1" />
                                                <path data-name="Line 100" transform="translate(18 11)" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v9" />
                                            </svg>

                                        </a>


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


                            <div class="review-qus" id="review_question_list">
                                <!-- <div class="d-flex mb-3 reviewBox2">
                                    <div class="col-8 heading">
                                        <h5><strong>Review Questions</strong></h5>
                                    </div>
                                    <div class="col-4 text-end d-flex add_btn_new">
                                    <div class="review_list_expand_btn_box">
                                        <div class="expand_bnt1">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Component_226_4" data-name="Component 226 – 4" width="48" height="48" viewBox="0 0 48 48">
                                            <defs>
                                                <style>
                                                .cls-1, .cls-2 {
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
                                            <rect id="Rectangle_4849" data-name="Rectangle 4849" class="cls-1" width="48" height="48" rx="14"/>
                                            <g id="Group_5111" data-name="Group 5111" transform="translate(12 12)">
                                                <path id="Path_11580" data-name="Path 11580" class="cls-1" d="M0,0H24V24H0Z"/>
                                                <path id="Path_11581" data-name="Path 11581" class="cls-2" d="M16,4h4V8"/>
                                                <line id="Line_613" data-name="Line 613" class="cls-2" y1="6" x2="6" transform="translate(14 4.022)"/>
                                                <path id="Path_11582" data-name="Path 11582" class="cls-2" d="M8,20H4V16"/>
                                                <line id="Line_614" data-name="Line 614" class="cls-2" y1="6" x2="6" transform="translate(4 14.022)"/>
                                                <path id="Path_11583" data-name="Path 11583" class="cls-2" d="M16,20h4V16"/>
                                                <line id="Line_615" data-name="Line 615" class="cls-2" x2="6" y2="6" transform="translate(14 14.022)"/>
                                                <path id="Path_11584" data-name="Path 11584" class="cls-2" d="M8,4H4V8"/>
                                                <line id="Line_616" data-name="Line 616" class="cls-2" x2="6" y2="6" transform="translate(4 4.022)"/>
                                            </g>
                                            </svg>
                                        </div>  
                                    </div>
                                
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

                                </div> -->


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

</div>

<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->


<script type="text/javascript">
    $('.scroll-div').slimscroll({
        height: '40vh'
    });
    // $('.number-block').slimscroll({
    //     height: '34vh'
    // });
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





<style>
    .test-review-right,
    .rightSect .bg-white {
        height: 680px;
    }

    .review_box_holder {
        position: absolute;
        bottom: 25px;
        background: #fff;
        overflow: hidden;
    }
</style>









<!-----Start__Right_Review_Height_Calculation------->
<script>
    function review_right_Height() {
        var total_right_height = $(".test-review-right .flex-column").outerHeight();
        var total_right_width = $(".test-review-right .number_block_holder").outerWidth();

        $('.review_box_holder').css('width', total_right_width);
        // $('.test-review-right .flex-column').css('height', total_right_height);

        var number_block_holder_height = $(".number_block_holder").outerHeight();
        $('.number_block_holder').css('height', number_block_holder_height);


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
        var test_review_right_height = $(".test-review-right").outerHeight();
        var test_review_height_div = test_review_right_height / 2;
        $('.number_block_holder').css('height', test_review_height_div);
        $('.review_box_holder').css('height', test_review_height_div);




        var number_block_holdercontainer = $(".number_block_holder").outerHeight();
        var review_box_holdercontainer = $(".review_box_holder").outerHeight();
        // var review_question_list_height =   $('#review_question_list').css('height', test_review_height_div);

        // var min_height_q_list_h = review_question_list_height - 200 + "px";

        // $('#review_question_list').css('height', min_height_q_list_h);

        // var number_block_holdercontainerplus = number_block_holdercontainer + 100 + "px";
        // var review_box_holdercontainercontainerminus = review_box_holdercontainer - 100 + "px";

        // $('.number_block_holder').css('height', number_block_holdercontainerplus);
        // $('.review_box_holder').css('height', review_box_holdercontainercontainerminus);




        var number_block_holder_height = $(".number_block_holder").outerHeight();
        var numberblockHeight = number_block_holder_height - 170 + "px";

        var height_divided = number_block_holder_height - numberblockHeight;
        $('.number_block_holder .number-block').css('height', numberblockHeight);



        var review_box_holder_final_height = $(".test-review-right .review_box_holder").outerHeight();
        $('#review_question_list').css('height', review_box_holder_final_height);
        var review_expand_scroll_height = $("#review_question_list").outerHeight();
        var math_cal_height = review_expand_scroll_height - 80 + "px";
        $('#review_question_list').css('height', math_cal_height);




















    });
</script>

<!-----End__Right_Review_Height_Calculation------->

<script>
    $(document).ready(function() {
        $(".expandbtn1").on('click', function() {
            var review_box_q_height12 = $(".test-review-right .review_box_holder").outerHeight();

            var reviewBox2height = $(".test-review-right .reviewBox2").outerHeight();

            var number_block_holder_height = $(".test-review-right .number_block_holder").outerHeight();

            var onclickreviewbox = review_box_q_height12 + number_block_holder_height;

            var review_box_holder_total = onclickreviewbox - 80 + "px";


            $('.review_box_holder').css('height', review_box_holder_total);

            var scrollqheight = onclickreviewbox - reviewBox2height;

            // $('#review_question_list').css('height', scrollqheight);

            $(".review_box_holder").css("border-top-left-radius", "56px");
            $(".review_box_holder").css("border-top-right-radius", "56px");
            $(".review_box_holder").css("box-shadow", "0 -10px 20px -4px rgb(0 0 0 / 10%)");

            var review_box_holder_final_height = $(".test-review-right .review_box_holder").outerHeight();
            $('#review_question_list').css('height', review_box_holder_final_height);

            var review_expand_scroll_height = $("#review_question_list").outerHeight();
            var math_cal_height = review_expand_scroll_height - 50 + "px";
            $('#review_question_list').css('height', math_cal_height);






        });

        $(".collapsebtn1").on('click', function() {
            // var review_box_q_height12 = $(".test-review-right .review_box_holder").outerHeight();

            // var reviewBox2height = $(".test-review-right .reviewBox2").outerHeight();
            // var number_block_holder_height = $(".test-review-right .number_block_holder").outerHeight();
            // var onclickreviewbox = review_box_q_height12 - number_block_holder_height;
            // $('.review_box_holder').css('height', onclickreviewbox);
            // var scrollqheight = onclickreviewbox - reviewBox2height;

            // $('#review_question_list').css('height', scrollqheight);


            var review_box_q_height12 = $(".test-review-right .review_box_holder").outerHeight();

            var reviewBox2height = $(".test-review-right .reviewBox2").outerHeight();

            var number_block_holder_height = $(".test-review-right .number_block_holder").outerHeight();

            var onclickreviewbox = review_box_q_height12 - number_block_holder_height;

            var review_box_holder_total = onclickreviewbox + 80 + "px";


            $('.review_box_holder').css('height', review_box_holder_total);

            var scrollqheight = onclickreviewbox + reviewBox2height;

            $('#review_question_list').css('height', scrollqheight);

        

            $(".review_box_holder").css("border-top-left-radius", "0px");
            $(".review_box_holder").css("border-top-right-radius", "0px");
            $(".review_box_holder").css("box-shadow", "none");




        });

    });
</script>


<script>
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





<!-----Start__Left_Review_Height_calculation------->
<script>
    function setboxHeight() {
        var height = $(".rightSect .flex-column").outerHeight();
        $('.test-review').css('height', height);
        var calculatedHeight = height - 80 + "px";
        $('.test-review .cust-tab-content').css('height', height);
        $('#review_rques_blk').css('height', calculatedHeight);

    }

    setboxHeight();
    $("window").load(function() {
        setboxHeight();
    });


    $(window).resize(function() {
        setboxHeight();
    });
</script>
<!-----End_Left-Review_height_calculation------->

<!-----Start-for-review_height-click------->
<script>
    $(document).ready(function() {
        var left_review_sec_h = $("#review_rques_blk").outerHeight();
        var div_height = left_review_sec_h / 2;
        $('.answer-section').css('height', div_height);
        $('.question-block').css('height', div_height);
        var question_block_width = $("#review_rques_blk .question-block").outerWidth();
        $('.question-block').css('width', question_block_width);
        $('.answer-section').css('width', question_block_width);
        var question_block_height = $(".question-block").outerHeight();
        var question_block_height_cal = question_block_height - 10 + "px";
        $('.question-block').css('height', question_block_height_cal);


    });
</script>
<!-----End-for-review_height-click------->

<!-----Start-for-btn_click_height-click------->
<script>
    $(document).ready(function() {
        $(".expandbtn").on('click', function() {
            var review_rques_blk_height = $("#review_rques_blk").outerHeight();
            var review_qus_height = $(".question-height").outerHeight();
            var margin = review_qus_height - 20 + "px";
            var customheight = review_rques_blk_height - review_qus_height;
            var finalheight = customheight - 30 + "px";
            $('.answer-section').css('height', finalheight);
        });

    });

    $(".collapsebtn").on('click', function() {

        var left_review_sec_h1 = $("#review_rques_blk").outerHeight();
        var div_height1 = left_review_sec_h1 / 2;
        $('.answer-section').css('height', div_height1);
        $('.question-block').css('height', div_height1);
        var question_block_height = $(".question-block").outerHeight();
        var question_block_height_cal = question_block_height - 10 + "px";
        $('.question-block').css('height', question_block_height_cal);

    });
</script>

<!-----End-for-btn_click_height-click------->

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

<style>
    #review_rques_blk .answer-section {
        margin-top: 0px !important;
        position: absolute;
        overflow-x: hidden;
        bottom: 0px;
        width: 98%;
        border-radius: 40px;
    }

    .expandbtn {
        display: block;
    }


    .test-review-right .bg-white {
        background-color: red;
        position: relative;
    }

    .test-review-right .review-qus {
        background-color: #ffffff;
    }

    .add_btn_new {
        justify-content: end;
        flex-direction: row-reverse;
        align-items: center;
    }

    .review_list_expand_btn_box img,
    .expand_button img {
        width: 34px;
        cursor: pointer;
    }

    .expand_bnt1 svg,
    .expandbtn svg,
    .collapsebtn svg,
    .expandbtn1 svg,
    .collapsebtn1 svg {
        width: 37px !important;
        height: 37px !important;
        cursor: pointer;
    }

    .expand_bnt1 svg {
        margin-top: -7px;
    }

    #review_rques_blk .answer-section {
        height: 250px;
    }

    .review_box_holder .d-flex.reviewBox2.review_heading1 {
        padding-top: 0px;
    }

    .review_box_holder {
        border-bottom-left-radius: 56px;
        border-bottom-right-radius: 56px;
    }

    .rview-quses li::-webkit-scrollbar {
        height: 6px;
    }

    .review_heading {
        font-size: 18px;
        margin: 0px;
    }

    span.subtitle.padding_26 {
        white-space: nowrap;
        width: 90%;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: pointer;
    }

    .review_heading1 .heading {
        display: flex;
        align-items: center;
    }
</style>




@endsection