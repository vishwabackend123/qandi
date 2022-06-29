@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<style>
    .dt_sec-1 span {
        font-weight: 600 !important;
    }

    .dt_sec-1 span img {
        max-width: 60px;
        padding-right: 5px;
    }

    .dtrow-left {
        background: #f2f2f2c4;
        border-radius: 30px;
        padding: 25px;
        margin: 10px;
    }

    .dtrow-left .btntheme {
        width: 100%;
        position: relative;
        top: 57%;
    }

    .dtrow-right {
        background: #f2f2f2c4;
        border-radius: 30px;
        padding: 25px;
        margin: 10px;
    }

    .dtrow-right .btntheme {
        width: 60%;
        position: relative;
        top: 2%;
    }

    @media only screen and (max-width: 767px) {

        /*kanchan css*/
        .dt_sec-1 span {
            font-weight: 600 !important;
        }

        .dt_sec-1 span img {
            max-width: 60px;
            padding-right: 5px;
        }

        .dtrow-left {
            background: #f2f2f2c4;
            border-radius: 30px;
            padding: 25px;
            margin: 10px;
        }

        .dtrow-left .btntheme {
            width: 100%;
            position: relative;
            top: 0%;
        }

        .dtrow-right {
            background: #f2f2f2c4;
            border-radius: 30px;
            padding: 25px;
            margin: 10px;
        }

        .dtrow-right .btntheme {
            width: 100%;
            position: relative;
            top: 2%;
        }
    }

    /*kanchan css*/
</style>
@if($errors->any())
<script>
    $(window).on('load', function() {
        $('#matrix').modal('show');
    });
</script>
@endif
<div class="main-wrapper dashboard">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper matrixpage-wrapper dashboard-cards-block dailytask-wrapper">
        <div class="container-fluid custom-page" style="padding-bottom: 30px;">
            <div class="row">
                <div class="col-md-6">
                    <div class="bg-white shadow-lg py-5 myqMatrix-card h-100 dt_sec-1">
                        <span class="progress_text" style="padding-left: 15px;"><img src="{{URL::asset('public/after_login/new_ui/images/daily-task-icon.png')}}"> Task for the Day</span>
                        @foreach($dailyTask as $key=>$data)
                        @if($data['category'] == 'skill' && $data['task_type'] == 'daily')
                        @php
                        $current_date=date("d");
                        if($current_date % 4 == 0){
                        $skill_task = 'Evaluation Skills';
                        $skill_category = 'evaluation';
                        }
                        else if($current_date % 4 == 1){
                        $skill_task = 'Knowledge Skills';
                        $skill_category = 'knowledge';
                        }
                        elseif($current_date % 4 == 2){
                        $skill_task = 'Application Skills';
                        $skill_category = 'application';
                        }
                        else{
                        $skill_task = 'Comprehension Skills';
                        $skill_category = 'comprehension';
                        }
                        @endphp
                        <div class="row mt-3 dtrow-left" style="padding: 20px 15px 5px;">
                            <div class="col-md-6">
                                <p><b>Task {{$key+1}} - {{$skill_task}}</b></p>
                                <p>Sharpen your {{(strtolower($skill_task))}} with this quick curated test</p>
                                <p><span class="text-danger">{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</span> Questions | Duration :
                                    <span class="text-danger">{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</span>
                                </p>
                            </div>
                            @if($data['allowed'] == '1')
                            <div class="col-md-6"><a class="btn btntheme" href="{{route('dailyTaskExamSkill',[$data['category'],$data['task_type'],$skill_category])}}">TAKE TEST</a></div>
                            @else
                            <div class="col-md-6"><a class="btn btntheme disabled" href="#">ALREADY ATTEMPTED</a></div>
                            @endif
                        </div>
                        @endif
                        @if($data['category'] == 'time' && $data['task_type'] == 'daily')
                        <div class="row mt-3 dtrow-left" style="padding: 20px 15px 5px;">
                            <div class="col-md-6">
                                <p><b>Task {{$key+1}} - Time Management</b></p>
                                <p>Work on your time management skills with this test</p>
                                <p><span class="text-danger">{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</span> Questions | Duration :
                                    <span class="text-danger">{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</span>
                                </p>
                            </div>
                            @if($data['allowed'] == '1')
                            <div class="col-md-6"><a class="btn btntheme" href="{{route('dailyTaskExam',[$data['category'],$data['task_type']])}}">TAKE TEST</a></div>
                            @else
                            <div class="col-md-6"><a class="btn btntheme disabled" href="#">ALREADY ATTEMPTED</a></div>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white shadow-lg py-5 myqMatrix-card h-100 dt_sec-1">
                        <span class="progress_text" style="padding-left: 15px;"><img src="{{URL::asset('public/after_login/new_ui/images/weekly-task-icon.png')}}"> Task for the Week</span>
                        @foreach($weekTask as $wkey=>$data)
                        @if($data['category'] == 'accuracy' && $data['task_type'] == 'weekly')
                        <div class="row mt-3 dtrow-left" style="padding: 20px 15px 5px;">
                            <div class="col-md-6">
                                <p><b>Task {{$wkey+1}} - Accuracy Test</b></p>
                                <p>Work on your accuracy with this test</p>
                                <p><span class="text-danger">{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</span> Questions | Duration :
                                    <span class="text-danger">{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</span>
                                </p>
                            </div>
                            @if($data['allowed'] == '1')
                            <div class="col-md-6"><a class="btn btntheme" href="{{route('dailyTaskExam',[$data['category'],$data['task_type']])}}">TAKE TEST</a></div>
                            @else
                            <div class="col-md-6"><a class="btn btntheme disabled" href="#">ALREADY ATTEMPTED</a></div>
                            @endif
                        </div>
                        @endif
                        @if($data['category'] == 'weak_topic' && $data['task_type'] == 'weekly')
                        <div class="row mt-3 dtrow-left" style="padding: 20px 15px 5px;">
                            <div class="col-md-6">
                                <p><b>Task {{$wkey+1}} - Weak Topic Test</b></p>
                                <p>Work on your weak topics with this test.</p>
                                <p><span class="text-danger">{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</span> Questions | Duration :
                                    <span class="text-danger">{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</span>
                                </p>
                            </div>
                            @if($data['allowed'] == '1')
                            <div class="col-md-6"><a class="btn btntheme" href="{{route('dailyTaskExam',[$data['category'],$data['task_type']])}}">TAKE TEST</a></div>
                            @else
                            <div class="col-md-6"><a class="btn btntheme disabled" href="#">ALREADY ATTEMPTED</a></div>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--------- Modal ------>
    <!-- <div class="modal fade" id="matrix" data-bs-backdrop="static" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 bg-light">
                <div class="modal-header pb-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Give more tests for this <br /> section to be populated</p>
                    <div class="text-center mb-4">
                        <a href="{{url('/dashboard')}}" class="btn btn-danger px-5"> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-------------------->
    <div class="modal fade" id="matrix" data-bs-backdrop="static" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 bg-light">
                <div class="modal-header pb-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Please practice more questions on our platform to enable this test.</p>
                    <div class="text-center mb-4">
                        <a href="javascript:void(0);" class="btn btn-danger px-5" data-bs-dismiss="modal" aria-label="Close" title="Close"> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(window).on('load', function() {
            //$('#matrix').modal('show');
        });
        $(document).ready(function() {
            $(".dashboard-cards-block .bg-white>small>img").click(function() {
                $(".dashboard-cards-block .bg-white>small p>span").each(function() {
                    $(this).parent("p").hide();
                });
                $(this).siblings("p").show();
            });
            $(".dashboard-cards-block .bg-white>small p>span").click(function() {
                $(this).parent("p").hide();
            });
        });
    </script>
    <!-- Footer Section -->
    @include('afterlogin.layouts.footer_new')
    <!-- footer Section end  -->
    @endsection