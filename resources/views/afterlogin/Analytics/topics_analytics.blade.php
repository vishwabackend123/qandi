<div class="accordion-body">
    <ul class="performance_chapter_sublists m-0">
        @foreach($topicList as $list)
        @php
        $topicname = Illuminate\Support\Str::limit($list['topic_name'], 35, $end='...');
        $topicnametitle = $list['topic_name'];
        @endphp
        <li>
            <div class="performance_chapter_block d-md-flex align-items-center">
                <h3><span><img src="{{URL::asset('public/after_login/current_ui/images/dot.svg')}}"></span> {{$topicnametitle}}</h3>
                <label><b>{{round($list['topic_score'])}}%</b> Proficiency</label>
                @php
                    $correct_score = 0;
                    $incorrect = 0;
                    $attempted = 0;
                    $not_attempted = 0;
                    $color_code='';
                    $tooltip_color='';
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
                        $tooltip_color='yellowTooltip';
                        
                    }
                    if($list['A_ques_attempted'] > 75)
                    {
                        $correct_score=$list['A_ques_attempted'];
                        $not_attempted = 100-$list['A_ques_attempted'];
                        $color_code= "#04c894";
                        $tooltip_color='greenTooltip';
                        
                    }
                    @endphp
                <div class="chapter_Perfrom_Graph">
                    <div class="Chapter_Main_Graph">
                        <canvas id="chapterPerformance_5_{{$list['id']}}"></canvas>
                        <span>A</span>
                        <div class="scoreTooltip {{$tooltip_color}}">Application: <small>{{$list['A_ques_attempted']}}%</small></div>
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
                        var myCharted = new Chart("chapterPerformance_5_{{$list['id']}}", config)

                        </script>
                    </div>
                    <div class="Chapter_Main_Graph">
                        @php
                        $correct_score = 0;
                        $incorrect = 0;
                        $attempted = 0;
                        $not_attempted = 0;
                        $color_code='';
                        $tooltip_color='';
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
                            $tooltip_color='yellowTooltip';
                            
                        }
                        if($list['E_ques_attempted'] > 75)
                        {
                            $correct_score=$list['E_ques_attempted'];
                            $not_attempted = 100-$list['E_ques_attempted'];
                            $color_code= "#04c894";
                            $tooltip_color='greenTooltip';
                            
                        }
                        @endphp
                        <canvas id="chapterPerformance_6_{{$list['id']}}"></canvas>
                        <span>E</span>
                        <div class="scoreTooltip {{$tooltip_color}}">Evaluation: <small>{{$list['E_ques_attempted']}}%</small></div>
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
                        var myCharted = new Chart("chapterPerformance_6_{{$list['id']}}", config)

                        </script>
                    </div>
                    <div class="Chapter_Main_Graph">
                        @php
                        $correct_score = 0;
                        $incorrect = 0;
                        $attempted = 0;
                        $not_attempted = 0;
                        $color_code='';
                        $tooltip_color='';
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
                            $tooltip_color='yellowTooltip';
                            
                        }
                        if($list['C_ques_attempted'] > 75)
                        {
                            $correct_score=$list['C_ques_attempted'];
                            $not_attempted = 100-$list['C_ques_attempted'];
                            $color_code= "#04c894";
                            $tooltip_color='greenTooltip';
                            
                        }
                        @endphp
                        <canvas id="chapterPerformance_7_{{$list['id']}}"></canvas>
                        <span>C</span>
                        <div class="scoreTooltip {{$tooltip_color}}">Comprehension: <small>{{$list['C_ques_attempted']}}%</small></div>
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
                        var myCharted = new Chart("chapterPerformance_7_{{$list['id']}}", config)

                        </script>
                    </div>
                    <div class="Chapter_Main_Graph">
                        @php                    
                        $correct_score = 0;
                        $incorrect = 0;
                        $attempted = 0;
                        $not_attempted = 0;
                        $color_code='';
                        $tooltip_color='';
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
                            $tooltip_color='yellowTooltip';
                            
                        }
                        if($list['K_ques_attempted'] > 75)
                        {
                            $correct_score=$list['K_ques_attempted'];
                            $not_attempted = 100-$list['K_ques_attempted'];
                            $color_code= "#04c894";
                            $tooltip_color='greenTooltip';
                            
                        }
                        @endphp
                        <canvas id="chapterPerformance_8_{{$list['id']}}"></canvas>
                        <span>K</span>
                        <div class="scoreTooltip {{$tooltip_color}}"> Knowledge: <small>{{$list['K_ques_attempted']}}%</small></div>
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
                        var myCharted = new Chart("chapterPerformance_8_{{$list['id']}}", config)

                        </script>
                    </div>
                </div>
                <div class="accordion-header"></div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
