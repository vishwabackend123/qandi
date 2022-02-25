<div class="col-12 mb-4">
    <button class="btn px-5 top-btn-pop text-white" data-bs-toggle="modal" data-bs-target="#exportAnalytics"><img src="{{URL::asset('public/after_login/new_ui/images/download-icn.png')}}">&nbsp;Export Analytics
    </button>
</div>
<div class="col-lg-4">
    <div class="bg-white shadow-lg box-shadow p-3 position-relative">
        <h5 class="dashboard-title mb-3 text-center">Total Score</h5>
        <div class="text-center">
            <!-- <img src="images/roundedgraph.jpg"> -->
            <div id="scorecontainer"></div>
        </div>
        <div class="row my-4">
            <div class="col">
                <span class="abrv-graph bg1"> </span>
                <span class="graph-txt">Correct Attempts</span>
            </div>
            <div class="col">
                <span class="abrv-graph bg2"> </span>
                <span class="graph-txt">Wrong Attempts</span>
            </div>
            <div class="col">
                <span class="abrv-graph bg3"> </span>
                <span class="graph-txt">Not Answered</span>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8">
    <div class="bg-white shadow-lg box-shadow p-3  position-relative">
        <div class="row">
            <div class="col-md-4">
                <h5 class="dashboard-title mb-3 text-center">Marks %</h5>
                <svg viewBox="0 0 36 36" class="circular-chart green">
                    <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="circle" stroke-dasharray="{{isset($response->result_percentage)?number_format($response->result_percentage,1):0}}, 100" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <text x="18" y="22.35" class="percentage">{{isset($response->result_percentage)?number_format($response->result_percentage,1):0}}%</text>
                </svg>
            </div>
            <div class="col-md-8">
                <div class="d-flex flex-column">
                    <div class="map-right-graph">
                        <div id="subjectScroe"></div>
                        <!-- <img src="images/right-graph.jpg"> -->
                    </div>
                    <div class="mt-auto btn-block">
                        <!-- <button class="btn w-100 mt-2 top-btn-pop text-white" onclick='resetData("all")'>Overall</button> -->
                        <div class="row mt-4">
                            @if(isset($response->subject_graph) && !empty($response->subject_graph))
                            @php $count_sub=count($response->subject_graph);
                            if($count_sub==1){
                            $disable_class="disabled" ;
                            }else{
                            $disable_class="";
                            }
                            @endphp
                            @foreach($response->subject_graph as $subject)
                            @php $subject=(object)$subject; @endphp
                            <div class="col"><button id="{{$subject->subject_name}}" {{$disable_class }} class="btn btn-outline-secondary w-100 top-btn-pop text-white" onclick='resetData("{{$subject->subject_id}}")'>{{$subject->subject_name}}</button></div>
                            @endforeach
                            @endif
                        </div>



                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@php
$correct_cnt=isset($response->correct_count)?$response->correct_count:0;
$incorrect_cnt=isset($response->wrong_count)?$response->wrong_count:0;
$not_attempt=isset($response->total_exam_marks)?$response->total_exam_marks:0;

$total_question = $response->no_of_question;

$total_makrs=isset($response->total_exam_marks)?$response->total_exam_marks:0;
$correct_score=isset($response->correct_score)?$response->correct_score:0;
$incorrect_score=isset($response->incorrect_score)?$response->incorrect_score:0;
$get_score=(isset($response->total_get_marks) && ($response->total_get_marks)>=0)?$response->total_get_marks:0;
$get_score_json=json_encode($get_score);
$class_average=(isset($response->class_average) && ($response->class_average)>=0)?$response->class_average:0;
$class_average_json=json_encode($class_average);

$correct_per_pie=!empty($total_question)?round((($correct_cnt/$total_question)*100),2):0;
$incorrect_per_pie=!empty($total_question)?round((($incorrect_cnt/$total_question)*100),2):0;

$not_attempt_per_pie=100-($correct_per_pie+$incorrect_per_pie);


$subject_graph=isset($response->subject_graph)?$response->subject_graph:0;
$stuscore_arr=$clsAvg_arr=[];
$stuscore=$clsAvg=0;
foreach($subject_graph as $key=>$gh){
$stuscore=$stuscore+$gh->student_score;
$clsAvg=$clsAvg+$gh->class_score;
}

$stuscore_arr[]=$stuscore;
$stuscore_json=json_encode($stuscore_arr);
$clsAvg_arr[]=$clsAvg;
$clsAvg_json=json_encode($clsAvg_arr);

@endphp

<script>
    Highcharts.chart('scorecontainer', {
        chart: {
            height: 224,
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: '<span style="font: normal normal normal 70px/136px Poppins;color: #2C3348;">{{$get_score}}</span><span style="font: normal normal normal 16px/30px Poppins;color: #2C3348;">/{{$total_makrs}} </span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 75

        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                point: {
                    events: {
                        legendItemClick: function() {
                            this.slice(null);
                            return false;
                        }
                    }
                },
                startAngle: -180,
                endAngle: 180,
                center: ['50%', '50%'],
                size: '100%'
            }
        },
        series: [{
            type: 'pie',

            innerSize: '90%',
            data: [{
                    name: 'Correct Attempts',
                    y: <?php echo $correct_per_pie; ?>,
                    color: '#AFF3D0' // Jane's color
                },
                {
                    name: 'Wrong Attempts',
                    y: <?php echo $incorrect_per_pie; ?>,
                    color: '#ff9999' // Jane's color
                },
                {
                    name: 'Not Answered',
                    y: <?php echo $not_attempt_per_pie; ?>,
                    color: '#e4e4e4' // Jane's color
                }
            ]
        }]
    });


    const chart = Highcharts.chart('subjectScroe', {
        chart: {
            type: 'column',
            height: 265,
        },
        title: {
            text: ''
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },


        xAxis: {
            categories: ['Scores']
        },
        plotOptions: {
            column: {
                borderRadius: 1
            },
            series: {
                events: {
                    legendItemClick: function() {
                        return false;
                    }
                }
            }
        },

        series: [{
            name: "Your Score",
            data: <?php echo $stuscore_json; ?>,
            color: '#AFF3D0'
        }, {
            name: "Class Average",
            data: <?php echo $clsAvg_json; ?>,
            color: '#FFFA6A'
        }]
    });


    function resetData(subject_id) {
        if (subject_id == 'all') {

            chart.series[0].setData(<?php echo $stuscore_json; ?>);
            chart.series[1].setData(<?php echo $clsAvg_json; ?>);
        } else {
            var graphArr = <?php echo json_encode($subject_graph); ?>;
            var studet_score = [];
            var class_score = [];
            const iterator = graphArr.values();
            for (const value of iterator) {
                if (value.subject_id == subject_id) {
                    studet_score.push(value.student_score)
                    class_score.push(value.class_score)

                }
            }

            chart.series[0].setData(studet_score);
            chart.series[1].setData(class_score);
        }
    }
</script>