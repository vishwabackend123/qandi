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
                <div class="chapter_Perfrom_Graph">
                    <div class="Chapter_Main_Graph">
                        <canvas id="chapterPerformance_5_{{$list['id']}}"></canvas>
                        <span>A</span>
                        <script type="text/javascript">
                        var circuference = 360;
                        var data = {
                            labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                            datasets: [{
                                label: "My First Dataset",
                                data: [0, 0, 0, 0],
                                backgroundColor: [
                                    "#f66c6c",
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
                        <canvas id="chapterPerformance_6_{{$list['id']}}"></canvas>
                        <span>E</span>
                        <script type="text/javascript">
                        var circuference = 360;
                        var data = {
                            labels: ["Correct", "Incorrect", "Not Attempted", "Not Attempted2", "Not Attempted3"],
                            datasets: [{
                                label: "My First Dataset",
                                data: [0, 0, 0, 0],
                                backgroundColor: [
                                    "#f66c6c",
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
                        <canvas id="chapterPerformance_7_{{$list['id']}}"></canvas>
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
                        <canvas id="chapterPerformance_8_{{$list['id']}}"></canvas>
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
