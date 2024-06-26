@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
@endphp
@section('content')

<!-- Mixpanel Started -->

<?php $redis_data = Session::get('redis_data'); ?>

<script type="text/javascript">
    (function(f, b) {
        if (!b.__SV) {
            var e, g, i, h;
            window.mixpanel = b;
            b._i = [];
            b.init = function(e, f, c) {
                function g(a, d) {
                    var b = d.split(".");
                    2 == b.length && (a = a[b[0]], d = b[1]);
                    a[d] = function() {
                        a.push([d].concat(Array.prototype.slice.call(arguments, 0)))
                    }
                }
                var a = b;
                "undefined" !== typeof c ? a = b[c] = [] : c = "mixpanel";
                a.people = a.people || [];
                a.toString = function(a) {
                    var d = "mixpanel";
                    "mixpanel" !== c && (d += "." + c);
                    a || (d += " (stub)");
                    return d
                };
                a.people.toString = function() {
                    return a.toString(1) + ".people (stub)"
                };
                i = "disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
                for (h = 0; h < i.length; h++) g(a, i[h]);
                var j = "set set_once union unset remove delete".split(" ");
                a.get_group = function() {
                    function b(c) {
                        d[c] = function() {
                            call2_args = arguments;
                            call2 = [c].concat(Array.prototype.slice.call(call2_args, 0));
                            a.push([e, call2])
                        }
                    }
                    for (var d = {}, e = ["get_group"].concat(Array.prototype.slice.call(arguments, 0)), c = 0; c < j.length; c++) b(j[c]);
                    return d
                };
                b._i.push([e, f, c])
            };
            b.__SV = 1.2;
            e = f.createElement("script");
            e.type = "text/javascript";
            e.async = !0;
            e.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ?
                MIXPANEL_CUSTOM_LIB_URL : "file:" === f.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
            g = f.getElementsByTagName("script")[0];
            g.parentNode.insertBefore(e, g)
        }
    })(document, window.mixpanel || []);

    try {

        // Enabling the debug mode flag is useful during implementation,
        // but it's recommended you remove it for production
        var correct_answer = {{$scoreResponse->correct_count}};

        var wrong_answer = {{$scoreResponse->wrong_count}};

        var total_question = {{$scoreResponse->no_of_question}};

        var total_time = '{{$rankResponse->test_total_time/60}}';

        var grade = "";

        var test_name = "{{ isset($scoreResponse->test_name) ? $scoreResponse->test_name : 'Custom Exam'}}";

        var grade_id = "{{$userData->grade_id}}"


        if (grade_id == '1') {
            grade = 'JEE';
        } else if (grade_id == '2') {
            grade = 'NEET';
        } else {
            grade = 'NA';
        }


        let position = test_name.search("Chapter Test");
        var event_exam_type = "{{isset($scoreResponse->test_type)?$scoreResponse->test_type:$exam_type}}";
        if (position > 0) {
            event_exam_type = "Custom Chapter Test"
        } else if (position < 0) {
            position = test_name.search("Topic Adaptive Exam")
            if (position > 0) {
                event_exam_type = "Topic Adaptive Exam";
            }
        }

        if (position > 0 && grade == "NEET" && total_time == 60) {
            total_question = 60;
            //console.log("1");
            /*NEET
                        - Subject/chapter test - 60mins - 60 Questions(Q)
                         if the attempted(A) questions count is less then (Q)
                        percentage completion is A/Q*100 else 100*/
        } else if (position > 0 && grade == "JEE" && total_time == 60) {
            total_question = 30;
            //console.log("2");
            /*JEE
                        Subject/chapter test - 60mins - 30 Questions(Q)
                        if the attempted(A) questions count is less then (Q)
                        percentage completion is A/Q*100 else 100
                         */
        }

        if (position > 0 && grade == "NEET" && total_time == 30) {
            total_question = 30;
            //console.log("3");
            /*NEET
                        -  single/multi topic test - 30mins - 30 Questions(Q)
                         if the attempted(A) questions count is less then (Q)
                        percentage completion is A/Q*100 else 100*/
        } else if (position > 0 && grade == "JEE" && total_time == 30) {
            total_question = 15;
            //console.log("4");
            /*JEE
                        - single/multi topic test - 30mins - 15 Questions(Q)
                        if the attempted(A) questions count is less then (Q)
                        percentage completion is A/Q*100 else 100
                         */
        }
        //console.log(correct_answer);
        //console.log(wrong_answer);
        //console.log(total_question);

        let total_percentage = Math.round(((correct_answer + wrong_answer) / total_question) * 100);

        //console.log(total_percentage);

        if (total_percentage >= 100){
            total_percentage = 100;
        }


        var mixpanelid = "{{$redis_data['MIXPANEL_KEY']}}";
        mixpanel.init(mixpanelid);
        if (event_exam_type == 'assessment') {
            event_exam_type = 'custom subject exam';
        }

        mixpanel.track("Loaded " + event_exam_type + " Result Analytics", {
            // test_type variable is used for mixpanel purpose as we need exam_type 
            "$city": '<?php echo $userData->city; ?>',
            "Percentage Completion": total_percentage,
        });

    } catch (err) {
        console.log(err.message);
    }
</script>

<!-- Mixpanel Event Ended -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


<!-- Modal -->
@if($subjects_rating == null || empty($subjects_rating))
@endif
<!-- Modal -->
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->

<div class="main-wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper test_analytics_wrapper">
        <div class="container-fluid">
            <div class="mock_inst_text_mock_test mb-4">
                <a href="{{url('/dashboard')}}" class="text-decoration-none"><i class="fa fa-angle-left" style="margin-right:8px"></i> Back to Dashboard</a>
            </div>
            @if(isset($scoreResponse->test_type) && $scoreResponse->test_type =='Assessment')
            <h3 class="commonheading">{{isset($scoreResponse->test_name)?$scoreResponse->test_name:'Custom Exam'}}</h3>
            @else
            <h3 class="commonheading">{{isset($scoreResponse->test_name)?$scoreResponse->test_name:$exam_name}}</h3>
            @endif
            <div class="d-flex mt-4 mb-4 align-items-end">
                <div class="question-attempted-block">
                    <span class="d-block mb-2 commontext">Questions Attempted</span>
                    <label class="m-0 commonboldtext">{{($scoreResponse->correct_count+$scoreResponse->wrong_count)}}/{{$scoreResponse->no_of_question}}</label>
                </div>
                <div class="time-date-block">
                    <span class="d-block mb-2 commontext">{{isset($scoreResponse->total_get_marks)?date('j F Y', strtotime($scoreResponse->test_attempted_date)):''}}</span>
                    <p class="m-0">
                        <small class="commontext me-5 pe-4">
                            <svg style="vertical-align: bottom;" class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.999 22c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.999 6v6l4 2" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{$rankResponse->test_total_time/60}} Mins
                        </small>
                        <small class="commontext">
                            <svg style="vertical-align: bottom;" class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.999 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.999 2h-6a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{isset($scoreResponse->total_exam_marks)?$scoreResponse->total_exam_marks:0}} Marks
                        </small>
                    </p>
                </div>
                <div class="text-right flexgrow">
                    <a onclick="sendEvent()" class="btn btn-common-transparent" style="min-width: auto;" href="{{route('exam_review', $scoreResponse->result_id) }}">
                        <svg style="vertical-align:middle;" class="me-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4.802h4.8a3.2 3.2 0 0 1 3.198 3.2v11.197a2.4 2.4 0 0 0-2.4-2.4H4V4.802zM19.998 4.802H15.2A3.2 3.2 0 0 0 12 8.002v11.197a2.4 2.4 0 0 1 2.4-2.4h5.598V4.802z" stroke="#56B663" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Review Questions
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="commonWhiteBox commonblockDash test_myscrore_card borderRadius">
                        <h3 class="boxheading d-flex align-items-center">My Score
                            <span class="tooltipmain2 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                    </g>
                                </svg>
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    This score indicates your readiness, based on your most recent test. <br>
                                    Score = (Total number of correct answers x Marking for correct response) – (Total number of incorrect answers x Marking for incorrect response)

                                </p>
                            </span>
                        </h3>
                        <div class="row align-items-center">
                            <div class="col-xl-6">
                                <div class="halfdoughnut2 position-relative">
                                    <canvas id="myscoregraph"></canvas>
                                    <div class="my_Score">
                                        <h6 class="m-0">{{isset($scoreResponse->total_get_marks)?$scoreResponse->total_get_marks:0}}/{{isset($scoreResponse->total_exam_marks)?$scoreResponse->total_exam_marks:0}}</h6>
                                        <span>MARKS</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="color_labels">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Correct <b><small></small>{{isset($scoreResponse->correct_count)?$scoreResponse->correct_count:0}}</b></span>
                                        <span>Incorrect <b><small></small>{{isset($scoreResponse->wrong_count)?$scoreResponse->wrong_count:0}}</b></span>
                                    </div>
                                    <span>Not Attempted <b><small style="background-color: #7db9ff;"></small>{{isset($scoreResponse->not_answered)?$scoreResponse->not_answered:0}}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($scoreResponse->test_type) && ($scoreResponse->test_type =='Live' || $scoreResponse->test_type =='Mocktest' || $scoreResponse->test_type =='PreviousYear'))
                    <div class="commonWhiteBox commonblockDash borderRadius marsk_result_card">
                        <h3 class="boxheading d-flex align-items-center">Marks
                            <span class="tooltipmain2 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                    </g>
                                </svg>
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                </p>
                            </span>
                        </h3>
                        <div class="common_greenbadge_tabs">
                            <ul class="nav nav-pills mb-4 d-inline-flex mt-4" id="marks-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link btn active" id="pills-overall-tab" data-bs-toggle="pill" data-bs-target="#pills-overall" type="button" role="tab" aria-controls="pills-overall" aria-selected="true" onclick='resetData("all")'>Overall</button>
                                </li>
                                @if(isset($scoreResponse->subject_graph) && !empty($scoreResponse->subject_graph))
                                @foreach($scoreResponse->subject_graph as $subject)
                                @php $subject=(object)$subject; @endphp

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link btn" id="{{$subject->subject_name}}" data-bs-toggle="pill" data-bs-target="#pills-physics" type="button" role="tab" aria-controls="pills-physics" aria-selected="false" onclick='resetData("{{$subject->subject_id}}")'>{{$subject->subject_name}}</button>
                                </li>
                                @endforeach
                                @endif
                                <!--  <li class="nav-item" role="presentation">
                                    <button class="nav-link btn" id="pills-physics-tab" data-bs-toggle="pill" data-bs-target="#pills-physics" type="button" role="tab" aria-controls="pills-physics" aria-selected="false">Physics</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link btn" id="pills-chemistry-tab" data-bs-toggle="pill" data-bs-target="#pills-chemistry" type="button" role="tab" aria-controls="pills-chemistry" aria-selected="false">Chemistry</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link btn" id="pills-maths-tab" data-bs-toggle="pill" data-bs-target="#pills-maths" type="button" role="tab" aria-controls="pills-maths" aria-selected="false">Maths</button>
                                </li> -->
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-overall" role="tabpanel" aria-labelledby="pills-overall-tab">
                                    <span class="d-block mb-1 commontext">Overall % Marks</span>
                                    <label class="mb-3 commonboldtext" id="percentage" style="font-size: 24px;">{{isset($scoreResponse->result_percentage)?number_format($scoreResponse->result_percentage,2):0}} %</label>
                                    <div class="overall_percentage_chart graph_padd">
                                        <span class="yaxis_label" style="left:-10px;"><small>% Marks </small></span>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                                <!--  <div class="tab-pane fade" id="pills-physics" role="tabpanel" aria-labelledby="pills-physics-tab">...</div>
                                <div class="tab-pane fade" id="pills-chemistry" role="tabpanel" aria-labelledby="pills-chemistry-tab">...</div>
                                <div class="tab-pane fade" id="pills-maths" role="tabpanel" aria-labelledby="pills-maths-tab">...</div>
                             -->
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(isset($test_type) && $test_type=='Live')
                    <div class="commonWhiteBox commonblockDash borderRadius" style=" height: 180px;">
                        <h3 class="boxheading d-flex align-items-center">Rank Analysis
                            <span class="tooltipmain2 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009" />
                                    </g>
                                </svg>
                                <p class="tooltipclass">
                                    <span><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                </p>
                            </span>
                        </h3>
                        <div class="d-flex justify-content-between mt-4">
                            <div class="your_rank position-relative" style="padding-left: 66px;">
                                <small>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 15a7 7 0 1 0 0-14 7 7 0 0 0 0 14z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.21 13.89 7 23l5-3 5 3-1.21-9.12" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </small>
                                <span class="d-block  commontext" style="color: #666;">Your rank</span>
                                <label class="m-0 commonboldtext" style="font-size:32px;">{{$rankResponse->user_rank}}
                                    @php
                                    $number = $rankResponse->user_rank;
                                    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                                    if (($number %100) >= 11 && ($number%100) <= 13){ $abbreviation='th' ; } else { $abbreviation=$ends[$number % 10]; } @endphp <sub style="font-size: 16px;font-weight: 500;color: #1f1f1f;margin-left: -5px;top: -18px;">{{$abbreviation}}</sub></label>
                            </div>
                            <div class="total_participants">
                                <span class="d-block commontext" style="color: #666;">Total Participants</span>
                                <label class="m-0 commonboldtext" style="font-size:32px;">{{$rankResponse->total_participants}}</label>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-7" id="subject_topic_section">

                </div>

            </div>
            <div class="text-end scrollbtn" style="margin-top:20px;">
                <button class="btn btn-common-transparent scroll-top" style="min-width: auto;">Scroll to top</button>
            </div>
        </div>
    </div>
</div>
@php
$correct_cnt=isset($scoreResponse->correct_count)?$scoreResponse->correct_count:0;
$incorrect_cnt=isset($scoreResponse->wrong_count)?$scoreResponse->wrong_count:0;
$not_attempt=isset($scoreResponse->total_exam_marks)?$scoreResponse->total_exam_marks:0;

$total_question = $scoreResponse->no_of_question;

$total_makrs=isset($scoreResponse->total_exam_marks)?$scoreResponse->total_exam_marks:0;
$correct_score=isset($scoreResponse->correct_score)?$scoreResponse->correct_score:0;
$incorrect_score=isset($scoreResponse->incorrect_score)?$scoreResponse->incorrect_score:0;
$get_score=(isset($scoreResponse->total_get_marks) && !empty($scoreResponse->total_get_marks))?$scoreResponse->total_get_marks:0;
$get_score_json=json_encode($get_score);
$class_average=(isset($scoreResponse->class_average) && ($scoreResponse->class_average)>=0)?$scoreResponse->class_average:0;
$class_average_json=json_encode($class_average);

$correct_per_pie=!empty($total_question)?round((($correct_cnt/$total_question)*100),2):0;
$incorrect_per_pie=!empty($total_question)?round((($incorrect_cnt/$total_question)*100),2):0;

$not_attempt_per_pie=100-($correct_per_pie+$incorrect_per_pie);


$subject_graph=isset($scoreResponse->subject_graph)?$scoreResponse->subject_graph:0;
$stuscore_arr=$clsAvg_arr=[];
$stuscore=$clsAvg=0;
foreach($subject_graph as $key=>$gh){
$stuscore=$stuscore+$gh->student_score_percentage;
$clsAvg=$clsAvg+$gh->class_score;
}
$total_sub=count($subject_graph);
if($total_sub > 0)
{
$stuscore=$stuscore/$total_sub;
$clsAvg=$clsAvg/$total_sub;
}
$stuscore_arr[]=round($stuscore,2);
$stuscore_json=json_encode($stuscore_arr);
$clsAvg_arr[]=round($clsAvg,2);
$clsAvg_json=json_encode($clsAvg_arr);


@endphp
<script type="text/javascript">
    // For Mixpanel
    function sendEvent() {

        mixpanel.track('Clicked to review PY exam', {
            "$city": '<?php echo $userData->city; ?>',
        });
    }


    $(document).ready(function() {
        $(document).on('click', 'span.tooltipmain2 svg', function(event) {
            //$("span.tooltipmain svg").click(function(event) {
            console.log("hello");
            event.stopPropagation();

            var card_open = $(this).siblings("p").hasClass('show');
            if (card_open === true) {
                $(this).siblings("p").hide();
                $(this).siblings("p").removeClass('show');
            } else {
                $("span.tooltipmain2 p.tooltipclass span").each(function() {
                    $(this).parent("p").hide();
                    $(this).parent("p").removeClass('show');
                });
                $(this).siblings("p").show();
                $(this).siblings("p").addClass('show');
            }
            $('.customDropdown').removeClass('active');

        });
        $("span.tooltipmain2 p.tooltipclass span").click(function() {
            $(this).parent("p").hide();
            $(this).parent("p").removeClass('show');
        });
    });
    $(document).on('click', function(e) {
        var card_opened = $('.tooltipclass').hasClass('show');
        if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
            $('.tooltipclass').hide();
            $('.tooltipclass').removeClass('show');
        }

    });
</script>
@if(isset($scoreResponse->test_type) && $scoreResponse->test_type !='Assessment')
<script type="text/javascript">
    var student_scr = '<?php echo $stuscore ?>';
    var student_bar_color = '#56b663';
    if (student_scr < 0) {
        student_bar_color = '#E74969';
    }
    /*********** BarChart ***********/
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['My Marks', 'Class Average'],
            datasets: [{
                data: ['{{$stuscore}}', '{{$clsAvg}}'],
                label: '',
                backgroundColor: [
                    student_bar_color,
                    '#08d5a1'
                ],
                barPercentage: 5,
                barThickness: 80,
                maxBarThickness: 80
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: (item) =>
                            `${item.formattedValue} %`,
                    },
                    displayColors: false,
                    // yAlign: 'bottom',
                    backgroundColor: colorItems_1
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },

                y: {
                    beginAtZero: true,
                }
            }
        }
    });

    function colorItems_1(tooltipItem) {
        const tooltipBackColor = tooltipItem.tooltip.labelColors[0].backgroundColor;
        return tooltipBackColor;
    }

    function resetData(subject_id) {
        /* var subject_data_json = JSON.parse($('#subject_data').val()); */

        if (subject_id == 'all') {
            myChart.data.datasets[0].data = ['{{$stuscore}}', '{{$clsAvg}}'];
            myChart.data.datasets[0].backgroundColor = [student_bar_color, '#08d5a1'];
            myChart.update();
            let overall_percent = '<?php echo number_format($scoreResponse->result_percentage, 2); ?>';
            $("#percentage").val(overall_percent);

        } else {
            var graphArr = <?php echo json_encode($subject_graph); ?>;
            var studet_score = [];
            var class_score = [];
            const iterator = graphArr.values();
            for (const value of iterator) {
                if (value.subject_id == subject_id) {
                    studet_score.push(value.student_score_percentage)
                    studet_score.push(value.class_score)
                    var percentage = value.student_score_percentage
                }
            }
            var student_subject_color = '#56b663';
            if (percentage < 0) {
                student_subject_color = '#E74969';
            }
            myChart.data.datasets[0].data = studet_score;
            myChart.data.datasets[0].backgroundColor = [student_subject_color, '#08d5a1'];
            myChart.update();

            $("#percentage").val(percentage);
        }
    }
</script>
@endif
<!-- browser back disable -->

<script type="text/javascript">
    $(document).ready(function() {

        window.history.pushState(null, "", window.location.href);

        window.onpopstate = function() {

            window.history.pushState(null, "", window.location.href);

        };

    });
</script>
<!-- browser back disable -->
<script>
    /***********my-score************************* */
    const myscorecir = 260;
    const myscoredata = {
        labels: ["Correct", "Incorrect", "Not Attempted"],
        datasets: [{
            label: "My First Dataset",
            data: [<?php echo $correct_per_pie; ?>, <?php echo $incorrect_per_pie; ?>, <?php echo $not_attempt_per_pie; ?>],
            backgroundColor: [
                "#08d5a1",
                "#fb7686",
                "#7db9ff"
            ]
        }]
    };
    const myscoreconfig = {
        type: "doughnut",
        data: myscoredata,
        options: {
            reponsive: true,
            maintainAspectRatio: false,
            rotation: (myscorecir / 2) * -1,
            circumference: myscorecir,
            cutout: "85%",
            borderWidth: 0,
            borderRadius: function(context, options) {
                const index = context.dataIndex;
                let radius = {};
                // if (index == 0) {
                //     radius.innerStart = 20;
                //     radius.outerStart = 20;
                // }
                // if (index === context.dataset.data.length - 1) {
                //     radius.innerEnd = 20;
                //     radius.outerEnd = 20;
                // }
                if (index == 0) {
                    radius.innerStart = 20;
                    radius.outerStart = 20;
                    if (context.dataset.data[index + 1] == 0 && context.dataset.data[index + 2] == 0) {
                        radius.innerEnd = 20;
                        radius.outerEnd = 20;
                    }
                }
                if (index == 1) {
                    if (context.dataset.data[index - 1] == 0) {
                        radius.innerStart = 20;
                        radius.outerStart = 20;
                    }
                    if (context.dataset.data[index + 1] == 0) {
                        radius.innerEnd = 20;
                        radius.outerEnd = 20;
                    }
                }
                if (index == 2) {
                    if (context.dataset.data[index - 1] == 0 && context.dataset.data[index - 2] == 0) {
                        radius.innerStart = 20;
                        radius.outerStart = 20;
                    }
                }
                if (index === context.dataset.data.length - 1) {
                    radius.innerEnd = 20;
                    radius.outerEnd = 20;
                }
                return radius;
            },
            plugins: {
                title: false,
                subtitle: false,
                legend: false,
                tooltip: {
                    displayColors: false,
                    // yAlign: 'bottom',
                    backgroundColor: colorItems
                }
            },
        }
    };
    const myscore = new Chart("myscoregraph", myscoreconfig)

    function colorItems(tooltipItem) {
        const tooltipBackColor = tooltipItem.tooltip.labelColors[0].backgroundColor;
        return tooltipBackColor;
    }


    /***************** halfdoughnut - end *********************/
</script>

<script>
    $(document).ready(function() {
        var test_type = '<?php echo $scoreResponse->test_type; ?>';
        url2 = "{{ url('exam_result_analysis_attempt/') }}";
        $.ajax({
            url: url2,
            data: {
                "_token": "{{ csrf_token() }}",
                'result_id': "{{$result_id}}"
            },
            success: function(result) {

                $("#subject_topic_section").html(result);
                $('.subject_score_card').hide();
                if (test_type == 'Mocktest' || test_type == 'Live' || test_type == 'PreviousYear') {
                    $('.subject_score_card').show();
                }

            }
        });
    });
</script>

<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->
@endsection