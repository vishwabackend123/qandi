@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
@endphp
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
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
                <a href="javascript:void(0)" class="text-decoration-none"><i class="fa fa-angle-left" style="margin-right:8px"></i> Back to Dashboard</a>
            </div>
            <h3 class="commonheading">{{$exam_name}}</h3>
            <div class="d-flex mt-4 mb-4 align-items-end">
                <div class="question-attempted-block">
                    <span class="d-block mb-2 commontext">Questions Attempted</span>
                    <label class="m-0 commonboldtext">{{isset($scoreResponse->total_get_marks)?$scoreResponse->total_get_marks:0}}/{{isset($scoreResponse->total_exam_marks)?$scoreResponse->total_exam_marks:0}}</label>
                </div>
                <div class="time-date-block">
                    <span class="d-block mb-2 commontext">{{isset($scoreResponse->total_get_marks)?date('j F Y', strtotime($scoreResponse->test_attempted_date)):''}}</span>
                    <p class="m-0">
                        <small class="commontext me-5 pe-4">
                            <svg style="vertical-align: sub;" class="me-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.999 22c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.999 6v6l4 2" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            60 min
                        </small>
                        <small class="commontext">
                            <svg style="vertical-align: sub;" class="me-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.999 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.999 2h-6a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{isset($scoreResponse->total_exam_marks)?$scoreResponse->total_exam_marks:0}} marks
                        </small>
                    </p>
                </div>
                <div class="text-right flexgrow">
                    <a class="btn btn-common-transparent" style="min-width: auto;" href="{{route('exam_review', $scoreResponse->result_id) }}">
                        <svg style="vertical-align:middle;" class="me-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4.802h4.8a3.2 3.2 0 0 1 3.198 3.2v11.197a2.4 2.4 0 0 0-2.4-2.4H4V4.802zM19.998 4.802H15.2A3.2 3.2 0 0 0 12 8.002v11.197a2.4 2.4 0 0 1 2.4-2.4h5.598V4.802z" stroke="#56B663" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Review Question
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="commonWhiteBox commonblockDash test_myscrore_card borderRadius">
                        <h3 class="boxheading d-flex align-items-center">My Score
                            <span class="tooltipmain ml-2">
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
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="halfdoughnut2 position-relative">
                                    <canvas id="myscoregraph"></canvas>
                                    <div class="myScore">
                                        <h6 class="m-0">{{isset($scoreResponse->total_get_marks)?$scoreResponse->total_get_marks:0}}/{{isset($scoreResponse->total_exam_marks)?$scoreResponse->total_exam_marks:0}}</h6>
                                        <span>MARKS</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="color_labels">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Correct <b><small></small>{{isset($scoreResponse->correct_count)?$scoreResponse->correct_count:0}}</b></span>
                                        <span>Incorrect <b><small></small>{{isset($scoreResponse->wrong_count)?$scoreResponse->wrong_count:0}}</b></span>
                                    </div>
                                    <span>Not Attempted <b><small style="background-color: #e5eaee;"></small>{{isset($scoreResponse->not_answered)?$scoreResponse->not_answered:0}}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="commonWhiteBox commonblockDash borderRadius">
                        <h3 class="boxheading d-flex align-items-center">Marks Percentage
                            <span class="tooltipmain ml-2">
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
                                    <button class="nav-link btn active" id="pills-overall-tab" data-bs-toggle="pill" data-bs-target="#pills-overall" type="button" role="tab" aria-controls="pills-overall" aria-selected="true">Overall</button>
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
                                    <span class="d-block mb-1 commontext">Overall percentage</span>
                                    <label class="mb-3 commonboldtext" id="percentage" style="font-size: 24px;">{{isset($scoreResponse->result_percentage)?$scoreResponse->result_percentage:0}}%</label>
                                    <div class="overall_percentage_chart">
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
                    <div class="commonWhiteBox commonblockDash borderRadius">
                        <h3 class="boxheading d-flex align-items-center">Rank Analysis
                            <span class="tooltipmain ml-2">
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
                                <span class="d-block  commontext">Your rank</span>
                                <label class="m-0 commonboldtext" style="font-size:32px;">{{$rankResponse->user_rank}}</label>
                            </div>
                            <div class="total_participants">
                                <span class="d-block commontext">Total Participants</span>
                                <label class="m-0 commonboldtext" style="font-size:32px;">{{$rankResponse->total_participants}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7" id="subject_topic_section">

                </div>

            </div>
            <div class="mt-3 text-end">
                <button class="btn btn-common-transparent scroll-top" style="min-width: auto;">Scroll to top</button>
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
    $stuscore=$stuscore+$gh->student_score;
    $clsAvg=$clsAvg+$gh->class_score;
    }

    $stuscore_arr[]=round($stuscore,2);
    $stuscore_json=json_encode($stuscore_arr);
    $clsAvg_arr[]=round($clsAvg,2);
    $clsAvg_json=json_encode($clsAvg_arr);


    @endphp
    <!-- Footer Section -->
    @include('afterlogin.layouts.footer_new')
    <!-- footer Section end  -->
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
        /*********** BarChart ***********/
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['My Percentage', 'Class Average'],
                datasets: [{
                    data: ['{{$stuscore}}', '{{$clsAvg}}'],
                    label: '',
                    backgroundColor: [
                        '#6ee7b7',
                        '#56b663'
                    ],
                    barPercentage: 5,
                    barThickness: 80,
                    maxBarThickness: 80
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },

                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function resetData(subject_id) {
            /* var subject_data_json = JSON.parse($('#subject_data').val()); */

            if (subject_id == 'all') {



                myChart.data.datasets[0].data = ['{{$stuscore}}', '{{$clsAvg}}'];
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
                        studet_score.push(value.student_score)
                        studet_score.push(value.class_score)
                        var percentage = value.student_score
                    }
                }

                console.log(studet_score);
                myChart.data.datasets[0].data = studet_score;
                myChart.update();

                $("#percentage").val(percentage);
            }
        }



        /***********my-score************************* */
        const myscorecir = 260;
        const myscoredata = {
            labels: ["Correct", "Incorrect", "Not Attempted"],
            datasets: [{
                label: "My First Dataset",
                data: [10, 10, 55],
                backgroundColor: [
                    "#08d5a1",
                    "#fb7686",
                    "#f2f4f7"
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
                    if (index == 0) {
                        radius.innerStart = 20;
                        radius.outerStart = 20;
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
                    legend: false
                },
            }
        };
        const myscore = new Chart("myscoregraph", myscoreconfig)

        /***************** halfdoughnut - end *********************/
    </script>
    <script>
        $(document).ready(function() {


            url2 = "{{ url('exam_result_analysis_attempt/') }}";
            $.ajax({
                url: url2,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(result) {

                    $("#subject_topic_section").html(result);

                }
            });


        });
        /*$(".topicdiv-scroll").slimscroll({
            height: "50vh",
        });*/
    </script>
    @endsection