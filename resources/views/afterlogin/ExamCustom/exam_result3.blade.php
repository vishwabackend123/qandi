<div class="col-md-9">
    <div class="bg-white shadow p-5 position-relative">

        <div class="row">
            <div class="col-md-4 text-center">
                <h5 class="dashboard-title mb-3 text-center">Rank Analysis</h5>
                <div id="rank"></div>

                <!-- <img src="images/bottom-left.jpg" /> -->
            </div>
            <div class="col-md-8">
                <div class="blue-block d-flex flex-column">
                    <span>Your Current Rank</span>
                    <span class="text-success fs-1">{{$response->user_rank}}</span>
                </div>
                <div class="blue-block d-flex flex-column mt-4">
                    <span>Total Participant</span>
                    <span class="text-dark fs-1">{{$response->total_participants}}</span>
                </div>
            </div>
            <!-- <div class="col-12 d-flex mt-5 mb-3">
                            <button class="btn px-4 top-btn-pop text-white">Overall</button>
                            <select class="form-select rounded-0 ms-3  w-25" aria-label="Default select example">
                                <option selected>Subject</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select rounded-0 ms-3 w-25" aria-label="Default select example">
                                <option selected>Topic</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div> -->
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="bg-white shadow p-5 d-flex flex-column position-relative">

        <span class="text-center w-100"><img src="{{URL::asset('public/after_login/new_ui/images/bottom-right.jpg')}}" /></span>
        <button class="btn w-100 mt-3 top-btn-pop text-white"><a href="{{route('exam_review', $response->result_id) }}">Review Questions</a></button>
        <button class="btn-outline-secondary btn rounded-0 w-100 mt-3 px-1"><a href="{{url('/dashboard')}}">Back to Dashboard</a></button>
    </div>
</div>


<script>
    Highcharts.setOptions({
        colors: ['#ff9999', '#fde98d', '#aff3d0']
    });
    Highcharts.chart('rank', {
        chart: {
            type: 'pyramid',
            height: 200
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        title: {
            text: '',
            x: -50
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> {point.y:,.0f}',
                    softConnector: true
                },
                center: ['40%', '50%'],
                width: '80%'
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Uniq users',
            data: [
                ['', <?php echo $response->total_participants; ?>],
                ['AIR', <?php echo $response->user_rank; ?>],
                ['', 1]
            ]
        }]
    });
</script>