<div class="spinnerblock">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
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
                    $correct_score = 0;
                    $incorrect = 0;
                    $attempted = 0;
                    $not_attempted = 0;
                    $color_code='';
                    if($list['A_ques_attempted'] < 40)
                    {
                        $correct_score=$list['A_ques_attempted'];
                        $incorrect =40-$list['A_ques_attempted'];
                        $attempted = 35;
                        $not_attempted = 25;
                        $color_code= "#f66c6c";
                        
                    }
                    if($list['A_ques_attempted'] >= 40 && $list['A_ques_attempted'] <= 75)
                    {
                        $correct_score=$list['A_ques_attempted'];
                        $attempted = 75-$list['A_ques_attempted'];
                        $not_attempted = 25;
                        $color_code= "#f6c86d";
                        
                    }
                    if($list['A_ques_attempted'] > 75)
                    {
                        $correct_score=$list['A_ques_attempted'];
                        $not_attempted = 100-$list['A_ques_attempted'];
                        $color_code= "#04c894";
                        
                    }
                    @endphp
                    <h3>{{$topicnametitle}}</h3>
                    <label><b>{{round($list['chapter_score'])}}%</b> Proficiency</label>
                    <div class="chapter_Perfrom_Graph">
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_1_{{$list['chapter_id']}}"></canvas>
                            <span>A</span>
                            <div class="scoreTooltip">Application: <small>{{$list['A_ques_attempted']}}%</small></div>
                            <script type="text/javascript">
                            var circuference = 360;
                            var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                    label: "My First Dataset",
                                    data: [<?php echo $correct_score; ?>, <?php echo $incorrect; ?>, <?php echo $attempted; ?>, <?php echo $not_attempted; ?>],
                                    backgroundColor: [
                                        "<?php echo $color_code; ?>",
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
                        @php
                        $correct_score = 0;
                        $incorrect = 0;
                        $attempted = 0;
                        $not_attempted = 0;
                        $color_code='';
                        if($list['E_ques_attempted'] < 40)
                        {
                            $correct_score=$list['E_ques_attempted'];
                            $incorrect =40-$list['E_ques_attempted'];
                            $attempted = 35;
                            $not_attempted = 25;
                            $color_code= "#f66c6c";
                            
                        }
                        if($list['E_ques_attempted'] >= 40 && $list['E_ques_attempted'] <= 75)
                        {
                            $correct_score=$list['E_ques_attempted'];
                            $attempted = 75-$list['E_ques_attempted'];
                            $not_attempted = 25;
                            $color_code= "#f6c86d";
                            
                        }
                        if($list['E_ques_attempted'] > 75)
                        {
                            $correct_score=$list['E_ques_attempted'];
                            $not_attempted = 100-$list['E_ques_attempted'];
                            $color_code= "#04c894";
                            
                        }
                        @endphp
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_2_{{$list['chapter_id']}}"></canvas>
                            <span>E</span>
                            <div class="scoreTooltip">Evaluation: <small>{{$list['E_ques_attempted']}}%</small></div>
                            <script type="text/javascript">
                            var circuference = 360;
                            var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                    label: "My First Dataset",
                                    data: [<?php echo $correct_score; ?>, <?php echo $incorrect; ?>, <?php echo $attempted; ?>, <?php echo $not_attempted; ?>],
                                    backgroundColor: [
                                        "<?php echo $color_code; ?>",
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
                        @php
                        $correct_score = 0;
                        $incorrect = 0;
                        $attempted = 0;
                        $not_attempted = 0;
                        $color_code='';
                        if($list['C_ques_attempted'] < 40)
                        {
                            $correct_score=$list['C_ques_attempted'];
                            $incorrect =40-$list['C_ques_attempted'];
                            $attempted = 35;
                            $not_attempted = 25;
                            $color_code= "#f66c6c";
                            
                        }
                        if($list['C_ques_attempted'] >= 40 && $list['C_ques_attempted'] <= 75)
                        {
                            $correct_score=$list['C_ques_attempted'];
                            $attempted = 75-$list['C_ques_attempted'];
                            $not_attempted = 25;
                            $color_code= "#f6c86d";
                            
                        }
                        if($list['C_ques_attempted'] > 75)
                        {
                            $correct_score=$list['C_ques_attempted'];
                            $not_attempted = 100-$list['C_ques_attempted'];
                            $color_code= "#04c894";
                            
                        }
                        @endphp
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_3_{{$list['chapter_id']}}"></canvas>
                            <span>C</span>
                            <div class="scoreTooltip">Comprehension: <small>{{$list['C_ques_attempted']}}%</small></div>
                            <script type="text/javascript">
                            var circuference = 360;
                            var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                    label: "My First Dataset",
                                   data: [<?php echo $correct_score; ?>, <?php echo $incorrect; ?>, <?php echo $attempted; ?>, <?php echo $not_attempted; ?>],
                                    backgroundColor: [
                                        "<?php echo $color_code; ?>",
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
                        @php                    
                        $correct_score = 0;
                        $incorrect = 0;
                        $attempted = 0;
                        $not_attempted = 0;
                        $color_code='';
                        if($list['K_ques_attempted'] < 40)
                        {
                            $correct_score=$list['K_ques_attempted'];
                            $incorrect =40-$list['K_ques_attempted'];
                            $attempted = 35;
                            $not_attempted = 25;
                            $color_code= "#f66c6c";
                            
                        }
                        if($list['K_ques_attempted'] >= 40 && $list['K_ques_attempted'] <= 75)
                        {
                            $correct_score=$list['K_ques_attempted'];
                            $attempted = 75-$list['K_ques_attempted'];
                            $not_attempted = 25;
                            $color_code= "#f6c86d";
                            
                        }
                        if($list['K_ques_attempted'] > 75)
                        {
                            $correct_score=$list['K_ques_attempted'];
                            $not_attempted = 100-$list['K_ques_attempted'];
                            $color_code= "#04c894";
                            
                        }
                        @endphp
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_4_{{$list['chapter_id']}}"></canvas>
                            <span>K</span>
                            <div class="scoreTooltip"> Knowledge: <small>{{$list['K_ques_attempted']}}%</small></div>
                            <script type="text/javascript">
                            var circuference = 360;
                            var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                    label: "My First Dataset",
                                    data: [<?php echo $correct_score; ?>, <?php echo $incorrect; ?>, <?php echo $attempted; ?>, <?php echo $not_attempted; ?>],
                                    backgroundColor: [
                                        "<?php echo $color_code; ?>",
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
                        <span class="accordion-button collapsed" id="topic_spam_{{$list['chapter_id']}}" type="button" data-bs-toggle="collapse"  aria-expanded="false" aria-controls="collapseOne" onclick="show_topic_list({{$list['chapter_id']}})">
                            <span id="topic_title_{{$list['chapter_id']}}">View Topics</span> <i class="fa fa-angle-down" aria-hidden="true"></i>
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
$('.spinnerblock').hide();
$(".accordion-header").click(function() {
    $(this).parents(".accordion-item").toggleClass("accordion-open");
});

function show_topic_list(chapter_id) {
    $('.spinnerblock').show();
    var title_text=$('#topic_title_'+chapter_id).text();
    $('#topic_spam_'+chapter_id).css("cursor","default");
    if (title_text == 'View Topics') {

        $('#topic_title_'+chapter_id).text('Hide Topics');
        url = "{{ url('topic-analytics/') }}/" + chapter_id;
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",

            },
            beforeSend: function() {

            },
            success: function(result) {
                $("#collapseOne_"+chapter_id).collapse('show');
                $('.spinnerblock').hide();
                $("#collapseOne_" + chapter_id).html(result.html);
                $('#topic_spam_'+chapter_id).css("cursor","pointer");

            },
            error: function(data, errorThrown) {
                $('.spinnerblock').hide();
            }
        });
    }
    if (title_text == 'Hide Topics') {
        $('#topic_title_'+chapter_id).text('View Topics');
        $("#collapseOne_"+chapter_id).collapse('hide');
        $('#topic_spam_'+chapter_id).css("cursor","default");
        setTimeout(function(){
            $('.spinnerblock').hide();
            $('#topic_spam_'+chapter_id).css("cursor","pointer");
        },1000)
        
    }
    
}

</script>
