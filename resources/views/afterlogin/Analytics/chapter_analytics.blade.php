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
        <div class=" knowledge_left_clr_with_text"><span class="cotogaty_right_text"><strong>E:</strong>  Evaluation</span>
        </div>
        <div class=" knowledge_left_clr_with_text"><span class="cotogaty_right_text"><strong>C:</strong>  Comprehension</span>
        </div>
        <div class=" knowledge_left_clr_with_text"><span class="cotogaty_right_text"><strong>K:</strong>  Knowledge</span>
        </div>
    </div>
</div>
<!-- Tab panes -->
<div class="tab-content">
    <div id="overall_analytics" class="tab-pane">
    </div>
    <div id="maths" class="tab-pane active">
        <!-- <div class="row chapter_of_row_col_paddin_zero">
            @foreach($chapterList as $list)
            @php
            $topicname = Illuminate\Support\Str::limit($list['chapter_name'], 35, $end='...');
            $topicnametitle = $list['chapter_name'];
            @endphp
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="chapter_proficincy_point_anylytics">
                    <div class="chapter_profici_application_deves_text" title="{{$topicnametitle}}">{{$topicnametitle}} </div>
                    <div class="common_bars">
                        <div class="d-flex common_bars_flex">
                            <span class="common_bar_sky_blue common_bar_width position-relative" style="width:{{$list['K_ques_attempted']}}% !important"></span>
                            <span class="common_bar_dark_green common_bar_width position-relative" style="width:{{$list['C_ques_attempted']}}% !important"></span>
                            <span class="common_bar_green common_bar_width position-relative" style="width:{{$list['A_ques_attempted']}}% !important"></span>
                            <span class="common_bar_navi_blue common_bar_width position-relative" style="width:{{$list['E_ques_attempted']}}% !important"></span>
                        </div>
                    </div>
                    <div class="chapter_profici_percentage_profincy">
                        <div class="chapter_profici_percent">
                            <span>{{round($list['chapter_score'])}}%</span> <span>Proficiency</span>
                        </div>
                        @php $chpatername=base64_encode($list['chapter_name']);
                        @endphp
                        <div class="chapter_profici_open_topic"><a href="javascript:void(0);" onclick="expandTopicAnalytics({{$list['chapter_id']}},'{{$subject}}','{{$chpatername}}')">Open Topics <b>></b></a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div> -->
        
        <div class="accordion performance_chapter_accordion">
            <div class="accordion-item">
                <div class="performance_chapter_block d-md-flex align-items-center justify-content-between">
                    <h3>Units and Dimentions</h3>
                    <label><b>80%</b> Proficiency</label>
                    <div class="chapter_Perfrom_Graph">
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_1"></canvas>
                            <span>A</span>
                            <script type="text/javascript">
                                var circuference = 360;
                                var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                        label: "My First Dataset",
                                        data: [80, 0, 0, 5],
                                        backgroundColor: [
                                            // "#f66c6c",
                                            "#04c894",
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
                                            tooltip:false
                                            
                                        },

                                    }
                                };
                                var myCharted = new Chart("chapterPerformance_1", config)
                            </script>
                        </div>
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_2"></canvas>
                            <span>E</span>
                            <script type="text/javascript">
                                var circuference = 360;
                                var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                        label: "My First Dataset",
                                        data: [30, 0, 10, 5],
                                        backgroundColor: [
                                            // "#f66c6c",
                                            // "#04c894", green color
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
                                            tooltip:false
                                            
                                        },

                                    }
                                };
                                var myCharted = new Chart("chapterPerformance_2", config)
                            </script>
                        </div>
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_3"></canvas>
                            <span>C</span>
                            <script type="text/javascript">
                                var circuference = 360;
                                var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                        label: "My First Dataset",
                                        data: [30, 20, 10, 5],
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
                                            tooltip:false
                                            
                                        },

                                    }
                                };
                                var myCharted = new Chart("chapterPerformance_3", config)
                            </script>
                        </div>
                        <div class="Chapter_Main_Graph">
                            <canvas id="chapterPerformance_4"></canvas>
                            <span>K</span>
                            <script type="text/javascript">
                                var circuference = 360;
                                var data = {
                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                datasets: [{
                                        label: "My First Dataset",
                                        data: [30, 20, 10, 5],
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
                                            tooltip:false
                                            
                                        },

                                    }
                                };
                                var myCharted = new Chart("chapterPerformance_4", config)
                            </script>
                        </div>
                    </div>
                    <div class="accordion-header" id="headingOne">
                        <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            View Topics <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <ul class="performance_chapter_sublists m-0">
                            <li>
                                <div class="performance_chapter_block d-md-flex align-items-center justify-content-between">
                                    <h3><span><img  src="{{URL::asset('public/after_login/current_ui/images/dot.svg')}}"></span> Complex Numbers</h3>
                                    <label><b>34%</b> Proficiency</label>
                                    <div class="chapter_Perfrom_Graph">
                                        <div class="Chapter_Main_Graph">
                                            <canvas id="chapterPerformance_5"></canvas>
                                            <span>A</span>
                                            <script type="text/javascript">
                                                var circuference = 360;
                                                var data = {
                                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                                datasets: [{
                                                        label: "My First Dataset",
                                                        data: [30, 20, 10, 5],
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
                                                            tooltip:false
                                                            
                                                        },

                                                    }
                                                };
                                                var myCharted = new Chart("chapterPerformance_5", config)
                                            </script>
                                        </div>
                                        <div class="Chapter_Main_Graph">
                                            <canvas id="chapterPerformance_6"></canvas>
                                            <span>E</span>
                                            <script type="text/javascript">
                                                var circuference = 360;
                                                var data = {
                                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                                datasets: [{
                                                        label: "My First Dataset",
                                                        data: [30, 20, 10, 5],
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
                                                            tooltip:false
                                                            
                                                        },

                                                    }
                                                };
                                                var myCharted = new Chart("chapterPerformance_6", config)
                                            </script>
                                        </div>
                                        <div class="Chapter_Main_Graph">
                                            <canvas id="chapterPerformance_7"></canvas>
                                            <span>C</span>
                                            <script type="text/javascript">
                                                var circuference = 360;
                                                var data = {
                                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                                datasets: [{
                                                        label: "My First Dataset",
                                                        data: [30, 20, 10, 5],
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
                                                            tooltip:false
                                                            
                                                        },

                                                    }
                                                };
                                                var myCharted = new Chart("chapterPerformance_7", config)
                                            </script>
                                        </div>
                                        <div class="Chapter_Main_Graph">
                                            <canvas id="chapterPerformance_8"></canvas>
                                            <span>K</span>
                                            <script type="text/javascript">
                                                var circuference = 360;
                                                var data = {
                                                labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                                                datasets: [{
                                                        label: "My First Dataset",
                                                        data: [30, 20, 10, 5],
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
                                                            tooltip:false
                                                            
                                                        },

                                                    }
                                                };
                                                var myCharted = new Chart("chapterPerformance_8", config)
                                            </script>
                                        </div>
                                    </div>  
                                </div>
                            </li>
                            <li>
                                <div class="performance_chapter_block d-md-flex align-items-center justify-content-between">
                                    <h3> <span><img  src="{{URL::asset('public/after_login/current_ui/images/dot.svg')}}"></span>Complex Numbers</h3>
                                    <label><b>34%</b> Proficiency</label>
                                    <div></div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <div class="performance_chapter_block d-md-flex align-items-center justify-content-between">
                    <h3>Complex Numbers</h3>
                    <label><b>34%</b> Proficiency</label>
                    <div></div>
                    <div class="accordion-header" id="headingTwo">
                        <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            View Topics <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                    <div class="accordion-body">
                        <ul class="performance_chapter_sublists">
                            <li>
                                <div class="performance_chapter_block d-md-flex align-items-center justify-content-between">
                                    <h3>Complex Numbers</h3>
                                    <label><b>34%</b> Proficiency</label>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div class="performance_chapter_block d-md-flex align-items-center justify-content-between">
                                    <h3>Complex Numbers</h3>
                                    <label><b>34%</b> Proficiency</label>
                                    <div></div>
                                </div>
                            </li>
                            <li>
                                <div class="performance_chapter_block d-md-flex align-items-center justify-content-between">
                                    <h3>Complex Numbers</h3>
                                    <label><b>34%</b> Proficiency</label>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(".accordion-header").click(function(){
        $(this).parents(".accordion-item").toggleClass("accordion-open");
        // $(this).children().toggleHTML('View Topics','Hide Topics');
    }); 
</script>   