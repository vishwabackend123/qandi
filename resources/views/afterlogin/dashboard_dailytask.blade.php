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

<style>
    .task-day-top {
    display: flex;
    justify-content: left;
    position: relative;
}

.note-img {
    position: absolute;
    right: -30px;
    top: -32px;
    overflow: hidden;
}
.task-day-top h2 {font-size: 24px; font-weight: 800; color: #1f1f1f; }
.task-day {border-radius: 32px;padding-bottom: 150px;}
.task1 > p {
    font-size: 14px;
    font-weight: 500;
    font-family: Manrope;
    color: #868a95;
}
.task1 p span {font-size: 12px; text-transform: uppercase; font-weight: 600; }
.task1 > h3 {font-size: 16px; font-weight: 800; color: #1f1f1f; }
.btn-sec {border-bottom: 1px solid #e5eaee; display: flex; padding-bottom: 8px; margin-bottom: 12px; }
.task-btn.tasklistbtn {flex-grow: 1;text-align: right;}
.qust-sec,.dura-sec {flex-grow: 1;}
.task-btn.tasklistbtn .btn.btn-common-transparent.nobg {text-transform: capitalize; font-size: 14px; }
.qust-sec span,.dura-sec span {color: #1f1f1f; font-size: 14px; font-weight: 500; }
.qust-sec p label,.dura-sec p label {font-size: 16px; font-weight: 800; vertical-align: middle; }


</style>
<div class="main-wrapper dashboard">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper">
        <!-- <div class="container-fluid custom-page" style="padding-bottom: 30px;">
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
        </div> -->
     <div class="container-fluid">
         <div class="row">
                <div class="col-lg-6">
                   <div class="task-day commonWhiteBox">
                        <div class="task-day-top">
                            <h2>Task for the day</h2>
                            <div class="note-img">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h68c17.673 0 32 14.327 32 32v68H0V0z" fill="#E0F6E3"/>
                                    <rect x="23" y="19.131" width="53.016" height="66.697" rx="4.608" fill="#fff"/>
                                    <rect x="36.682" y="14" width="27.363" height="10.261" rx="2.304" fill="#CDE3D0"/>
                                    <path d="m28.13 37.087 1.711 1.71 4.276-4.275M28.13 54.188l1.711 1.71 4.276-4.275M28.13 69.58l1.711 1.711 4.276-4.275" stroke="#56B663" stroke-width="1.152" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path stroke="#CDE3D0" stroke-width="1.152" stroke-linecap="round" d="M40.678 33.945h21.08M40.678 39.076h12.529M40.678 51.047h22.79M40.678 66.44h22.79M40.678 56.178h14.239M40.678 71.57h14.239M56.069 39.076h12.53"/>
                                </svg>
                            </div>
                        </div>
                        <div class="task1">
                                <p><span>Task 1 </span></p>
                                <h3>Evaluation Skills</h3>
                                <p>Sharpen your evaluation skills with this quick curated test</p>
                                <div class="btn-sec">
                                    <div class="qust-sec">
                                        <span>Question</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <label>10</label>
                                        </p>
                                    </div>
                                    <div class="dura-sec">
                                        <span>Duration</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <label>15 mins</label>
                                        </p>
                                    </div>
                                            <div class="task-btn tasklistbtn">
                                            <button class="btn btn-common-transparent nobg">Take test</button>
                                            </div>
                                </div>
                            </div>

                            <div class="task1 task2 ">
                                <p><span>Task 2 </span></p>
                                <h3>Time Management</h3>
                                <p>Sharpen your evaluation skills with this quick curated test</p>
                                <div class="btn-sec">
                                    <div class="qust-sec">
                                        <span>Question</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <label>10</label>
                                        </p>
                                    </div>
                                    <div class="dura-sec">
                                        <span>Duration</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <label>15 mins</label>
                                        </p>
                                    </div>
                                            <div class="task-btn tasklistbtn">
                                            <button class="btn btn-common-transparent nobg">Take test</button>
                                            </div>
                                </div>
                            </div>
                   </div>
                </div>
              
                <div class="col-lg-6">
                   <div class="task-day task-week commonWhiteBox">
                        <div class="task-day-top">
                            <h2>Task for the week</h2>
                            <div class="note-img">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h68c17.673 0 32 14.327 32 32v68H0V0z" fill="#E0F6E3"/>
                                    <rect x="23" y="19.131" width="53.016" height="66.697" rx="4.608" fill="#fff"/>
                                    <rect x="36.682" y="14" width="27.363" height="10.261" rx="2.304" fill="#CDE3D0"/>
                                    <path d="m28.13 37.087 1.711 1.71 4.276-4.275M28.13 54.188l1.711 1.71 4.276-4.275M28.13 69.58l1.711 1.711 4.276-4.275" stroke="#56B663" stroke-width="1.152" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path stroke="#CDE3D0" stroke-width="1.152" stroke-linecap="round" d="M40.678 33.945h21.08M40.678 39.076h12.529M40.678 51.047h22.79M40.678 66.44h22.79M40.678 56.178h14.239M40.678 71.57h14.239M56.069 39.076h12.53"/>
                                </svg>
                            </div>
                        </div>
                        <div class="task1">
                                <p><span>Task 1 </span></p>
                                <h3>Accuracy Test</h3>
                                <p>Work on your accuracy with this test</p>
                                <div class="btn-sec">
                                    <div class="qust-sec">
                                        <span>Question</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <label>10</label>
                                        </p>
                                    </div>
                                    <div class="dura-sec">
                                        <span>Duration</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <label>15 mins</label>
                                        </p>
                                    </div>
                                            <div class="task-btn tasklistbtn">
                                            <button class="btn btn-common-transparent nobg">Take test</button>
                                            </div>
                                </div>
                            </div>

                            <div class="task1 task2 ">
                                <p><span>Task 2 </span></p>
                                <h3>Weak topic Test</h3>
                                <p>Work on your accuracy with this test</p>
                                <div class="btn-sec">
                                    <div class="qust-sec">
                                        <span>Question</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <label>25</label>
                                        </p>
                                    </div>
                                    <div class="dura-sec">
                                        <span>Duration</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <label>60 mins</label>
                                        </p>
                                    </div>
                                            <div class="task-btn tasklistbtn">
                                            <button class="btn btn-common-transparent nobg">Take test</button>
                                            </div>
                                </div>
                            </div>
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