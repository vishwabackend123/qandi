<div class="chapter_profici_nav__right_contant mb-0 chapterlistTop">
    <!-- <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb chapter_breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);" class="chapter_subject">{{$subject}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chapters</li>
        </ol>
    </nav> -->
    <div class="topicHeadingNew">Chapters</div>
    <div class="knowledge_left_clr_with_text_right_div KnowledgeNewBar">
        <div class=" knowledge_left_clr_with_text"><span class="cotogaty_right_text"> <strong>A:</strong> Application</span>
        </div>
        <div class=" knowledge_left_clr_with_text"><span class="cotogaty_right_text"><strong>E:</strong> Evaluation</span>
        </div>
        <div class=" knowledge_left_clr_with_text"><span class="cotogaty_right_text"><strong>C:</strong> Comprehension</span>
        </div>
        <div class=" knowledge_left_clr_with_text"><span class="cotogaty_right_text"><strong>K:</strong> Knowledge</span>
        </div>
    </div>
</div>
<!-- Tab panes -->
<div class="tab-content">
    <div id="overall_analytics" class="tab-pane">
    </div>
    <div id="maths" class="tab-pane active">
        <div class="accordion performance_chapter_accordion">
            @foreach($chapterList as $list)
            <div class="accordion-item">
                <div class="performance_chapter_block d-md-flex align-items-center">
                    @php
                    $topicname = Illuminate\Support\Str::limit($list['chapter_name'], 35, $end='...');
                    $topicnametitle = $list['chapter_name'];
                    @endphp
                    <h3>{{$topicnametitle}}</h3>
                    <label><b>{{round($list['chapter_score'])}}%</b> Proficiency</label>
                    <div class="chapter_Perfrom_Graph">
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_1_{{$list['chapter_id']}}"></canvas>
                            <span>A</span>
                            <script type="text/javascript">
                            var circuference = 360;
                            var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                    label: "My First Dataset",
                                    data: [10, 10, 10, 10],
                                    backgroundColor: [
                                        "#04c894",
                                        "#fcdbdb",
                                        "#fcf2de",
                                        "#d7efe9",
                                    ]
                                }]
                            };
                            var config = {
                                type: "doughnut",
                                data: data,
                                options: {
                                    reponsive: true,
                                    maintainAspectRatio: false,
                                    circumference: circuference,
                                    cutout: "80%",
                                    borderWidth: 0,
                                    borderRadius: function(context, options) {
                                        const index = context.dataIndex;
                                        let radius = {};
                                        if (index == 0) {
                                            radius.innerStart = 0;
                                            radius.outerStart = 0;
                                        }
                                        if (index === context.dataset.data.length - 1) {
                                            radius.innerEnd = 0;
                                            radius.outerEnd = 0;
                                        }
                                        return radius;
                                    },
                                    plugins: {
                                        title: false,
                                        subtitle: false,
                                        legend: false,
                                        tooltip: false

                                    },

                                }
                            };
                            var myCharted = new Chart("chapterPerformance_1_{{$list['chapter_id']}}", config)

                            </script>
                        </div>
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_2_{{$list['chapter_id']}}"></canvas>
                            <span>E</span>
                            <script type="text/javascript">
                            var circuference = 360;
                            var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                    label: "My First Dataset",
                                    data: [0, 0, 0, 0],
                                    backgroundColor: [
                                        "#f6c86d",
                                        "#fcdbdb",
                                        "#fcf2de",
                                        "#d7efe9",
                                    ]
                                }]
                            };
                            var config = {
                                type: "doughnut",
                                data: data,
                                options: {
                                    reponsive: true,
                                    maintainAspectRatio: false,
                                    circumference: circuference,
                                    cutout: "80%",
                                    borderWidth: 0,
                                    borderRadius: function(context, options) {
                                        const index = context.dataIndex;
                                        let radius = {};
                                        if (index == 0) {
                                            radius.innerStart = 0;
                                            radius.outerStart = 0;
                                        }
                                        if (index === context.dataset.data.length - 1) {
                                            radius.innerEnd = 0;
                                            radius.outerEnd = 0;
                                        }
                                        return radius;
                                    },
                                    plugins: {
                                        title: false,
                                        subtitle: false,
                                        legend: false,
                                        tooltip: false

                                    },

                                }
                            };
                            var myCharted = new Chart("chapterPerformance_2_{{$list['chapter_id']}}", config)

                            </script>
                        </div>
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_3_{{$list['chapter_id']}}"></canvas>
                            <span>C</span>
                            <script type="text/javascript">
                            var circuference = 360;
                            var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                    label: "My First Dataset",
                                    data: [0, 0, 0, 0],
                                    backgroundColor: [
                                        "#f66c6c",
                                        // "#04c894", green color
                                        // "#f6c86d", yellow color
                                        "#fcdbdb",

                                        "#fcf2de",
                                        "#d7efe9",
                                    ]
                                }]
                            };
                            var config = {
                                type: "doughnut",
                                data: data,
                                options: {
                                    reponsive: true,
                                    maintainAspectRatio: false,
                                    circumference: circuference,
                                    cutout: "80%",
                                    borderWidth: 0,
                                    borderRadius: function(context, options) {
                                        const index = context.dataIndex;
                                        let radius = {};
                                        if (index == 0) {
                                            radius.innerStart = 0;
                                            radius.outerStart = 0;
                                        }
                                        if (index === context.dataset.data.length - 1) {
                                            radius.innerEnd = 0;
                                            radius.outerEnd = 0;
                                        }
                                        return radius;
                                    },
                                    plugins: {
                                        title: false,
                                        subtitle: false,
                                        legend: false,
                                        tooltip: false

                                    },

                                }
                            };
                            var myCharted = new Chart("chapterPerformance_3_{{$list['chapter_id']}}", config)

                            </script>
                        </div>
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_4_{{$list['chapter_id']}}"></canvas>
                            <span>K</span>
                            <script type="text/javascript">
                            var circuference = 360;
                            var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                    label: "My First Dataset",
                                    data: [0, 0, 0, 0],
                                    backgroundColor: [
                                        "#f66c6c",
                                        // "#04c894", green color
                                        // "#f6c86d", yellow color
                                        "#fcdbdb",

                                        "#fcf2de",
                                        "#d7efe9",
                                    ]
                                }]
                            };
                            var config = {
                                type: "doughnut",
                                data: data,
                                options: {
                                    reponsive: true,
                                    maintainAspectRatio: false,
                                    circumference: circuference,
                                    cutout: "80%",
                                    borderWidth: 0,
                                    borderRadius: function(context, options) {
                                        const index = context.dataIndex;
                                        let radius = {};
                                        if (index == 0) {
                                            radius.innerStart = 0;
                                            radius.outerStart = 0;
                                        }
                                        if (index === context.dataset.data.length - 1) {
                                            radius.innerEnd = 0;
                                            radius.outerEnd = 0;
                                        }
                                        return radius;
                                    },
                                    plugins: {
                                        title: false,
                                        subtitle: false,
                                        legend: false,
                                        tooltip: false

                                    },

                                }
                            };
                            var myCharted = new Chart("chapterPerformance_4_{{$list['chapter_id']}}", config)

                            </script>
                        </div>
                    </div>
                    <div class="accordion-header" id="headingOne">
                        <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$list['chapter_id']}}" aria-expanded="false" aria-controls="collapseOne" onclick="show_topic_list({{$list['chapter_id']}})">
                            View Topics <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                <div id="collapseOne_{{$list['chapter_id']}}" class="accordion-collapse collapse" aria-labelledby="headingOne">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
$(".accordion-header").click(function() {
    $(this).parents(".accordion-item").toggleClass("accordion-open");
});

function show_topic_list(chapter_id) {
    url = "{{ url('topic-analytics/') }}/" + chapter_id;
    $.ajax({
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",

        },
        beforeSend: function() {

        },
        success: function(result) {
            $("#collapseOne_" + chapter_id).html(result.html);
        },
        error: function(data, errorThrown) {}
    });
}

</script>
