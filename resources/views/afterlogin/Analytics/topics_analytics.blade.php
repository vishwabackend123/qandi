<div class="accordion-body">
    <ul class="performance_chapter_sublists m-0">
        <li>
            <div class="performance_chapter_block d-md-flex align-items-center justify-content-between">
                <h3><span><img src="{{URL::asset('public/after_login/current_ui/images/dot.svg')}}"></span> Complex Numbers</h3>
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
                                    tooltip: false

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
                                    tooltip: false

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
                                    tooltip: false

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
                                    tooltip: false

                                },

                            }
                        };
                        var myCharted = new Chart("chapterPerformance_8", config)

                        </script>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
