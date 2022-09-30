@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
@if($errors->any())
<script>
    $(window).on('load', function() {
        $('#matrix').modal('show');
    });
</script>
@endif
<div class="main-wrapper dashboard taskcenter_wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row mobile_hide">
                <div class="col-lg-6">
                    @foreach($dailyTask as $key=>$data)
                    @if($data['category'] == 'skill' && $data['task_type'] == 'daily')
                    @php
                    $current_date=date("d");
                    if($current_date % 4 == 0){
                    $skill_task = 'Evaluation Skill';
                    $skill_category = 'evaluation';
                    }
                    else if($current_date % 4 == 1){
                    $skill_task = 'Knowledge Skill';
                    $skill_category = 'knowledge';
                    }
                    elseif($current_date % 4 == 2){
                    $skill_task = 'Application Skill';
                    $skill_category = 'application';
                    }
                    else{
                    $skill_task = 'Comprehension Skill';
                    $skill_category = 'comprehension';
                    }
                    @endphp
                    <div class="task-day commonWhiteBox">
                        <div class="task-day-top">
                            <h2>Task for the day</h2>
                            <div class="note-img">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h68c17.673 0 32 14.327 32 32v68H0V0z" fill="#E0F6E3" />
                                    <rect x="23" y="19.131" width="53.016" height="66.697" rx="4.608" fill="#fff" />
                                    <rect x="36.682" y="14" width="27.363" height="10.261" rx="2.304" fill="#CDE3D0" />
                                    <path d="m28.13 37.087 1.711 1.71 4.276-4.275M28.13 54.188l1.711 1.71 4.276-4.275M28.13 69.58l1.711 1.711 4.276-4.275" stroke="#56B663" stroke-width="1.152" stroke-linecap="round" stroke-linejoin="round" />
                                    <path stroke="#CDE3D0" stroke-width="1.152" stroke-linecap="round" d="M40.678 33.945h21.08M40.678 39.076h12.529M40.678 51.047h22.79M40.678 66.44h22.79M40.678 56.178h14.239M40.678 71.57h14.239M56.069 39.076h12.53" />
                                </svg>
                            </div>
                        </div>
                        <div class="task1">
                            <p><span>Task {{$key+1}}</span></p>
                            <h3>{{$skill_task}}</h3>
                            <p>Quickly sharpen your {{$skill_category}} skill with this curated test.</p>
                            <div class="btn-sec">
                                <div class="qust-sec">
                                    <span>Questions</span>
                                    <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <label>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</label>
                                    </p>
                                </div>
                                <div class="dura-sec">
                                    <span>Duration</span>
                                    <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <label>{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</label>
                                    </p>
                                </div>
                                @if($data['allowed'] == '1')
                                <div class="task-btn tasklistbtn">
                                    <a href="{{route('dailyTaskExamSkill',[$data['category'],$data['task_type'],'instruction',$skill_category])}}" class="btn btn-common-transparent nobg">Practice</a>
                                </div>
                                @else
                                <div class="task-btn tasklistbtn">
                                    <button class="btn btn-common-transparent nobg disabled" disabled style="cursor: default;">Already Attempted</button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if($data['category'] == 'time' && $data['task_type'] == 'daily')
                        <div class="task1 task2 ">
                            <p><span>Task {{$key+1}}</span></p>
                            <h3>Time Management</h3>
                            <p>Take this test to improve your time management skills.</p>
                            <div class="btn-sec">
                                <div class="qust-sec">
                                    <span>Questions</span>
                                    <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <label>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</label>
                                    </p>
                                </div>
                                <div class="dura-sec">
                                    <span>Duration</span>
                                    <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <label>{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</label>
                                    </p>
                                </div>
                                @if($data['allowed'] == '1')
                                <div class="task-btn tasklistbtn">
                                    <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                </div>
                                @else
                                <div class="task-btn tasklistbtn">
                                    <button class="btn btn-common-transparent nobg disabled" disabled style="cursor: default;">Already Attempted</button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="col-lg-6">
                    <div class="task-day task-week commonWhiteBox">
                        <div class="task-day-top">
                            <h2>Task for the week</h2>
                            <div class="note-img">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h68c17.673 0 32 14.327 32 32v68H0V0z" fill="#E0F6E3" />
                                    <rect x="23" y="19.131" width="53.016" height="66.697" rx="4.608" fill="#fff" />
                                    <rect x="36.682" y="14" width="27.363" height="10.261" rx="2.304" fill="#CDE3D0" />
                                    <path d="m28.13 37.087 1.711 1.71 4.276-4.275M28.13 54.188l1.711 1.71 4.276-4.275M28.13 69.58l1.711 1.711 4.276-4.275" stroke="#56B663" stroke-width="1.152" stroke-linecap="round" stroke-linejoin="round" />
                                    <path stroke="#CDE3D0" stroke-width="1.152" stroke-linecap="round" d="M40.678 33.945h21.08M40.678 39.076h12.529M40.678 51.047h22.79M40.678 66.44h22.79M40.678 56.178h14.239M40.678 71.57h14.239M56.069 39.076h12.53" />
                                </svg>
                            </div>
                        </div>
                        @foreach($weekTask as $wkey=>$data)
                        @if($data['category'] == 'accuracy' && $data['task_type'] == 'weekly')
                        <div class="task1">
                            <p><span>Task {{$wkey+1}} </span></p>
                            <h3>Accuracy Test</h3>
                            <p>Work on your accuracy with this test.</p>
                            <div class="btn-sec">
                                <div class="qust-sec">
                                    <span>Questions</span>
                                    <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <label>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</label>
                                    </p>
                                </div>
                                <div class="dura-sec">
                                    <span>Duration</span>
                                    <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <label>{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</label>
                                    </p>
                                </div>
                                @if($data['allowed'] == '1')
                                <div class="task-btn tasklistbtn">
                                    <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                </div>
                                @else
                                <div class="task-btn tasklistbtn">
                                    <button class="btn btn-common-transparent nobg disabled" disabled style="cursor: default;">Already Attempted</button>
                                </div>
                                @endif
                            </div>
                            @endif
                            @if($data['category'] == 'weak_topic' && $data['task_type'] == 'weekly')
                            <div class="task1 task2 ">
                                <p><span>Task {{$wkey+1}} </span></p>
                                <h3>Weak Topic Test</h3>
                                <p>Take this test to work on your weak topics.</p>
                                <div class="btn-sec">
                                    <div class="qust-sec">
                                        <span>Questions</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <label>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</label>
                                        </p>
                                    </div>
                                    <div class="dura-sec">
                                        <span>Duration</span>
                                        <p><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <label>{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</label>
                                        </p>
                                    </div>
                                    @if($data['allowed'] == '1')
                                    <div class="task-btn tasklistbtn">
                                        <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                    </div>
                                    @else
                                    <div class="task-btn tasklistbtn">
                                        <button class="btn btn-common-transparent nobg disabled" disabled style="cursor: default;">Already Attempted</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!--------- Mobile View ------------->
            <div class="mobile_block">
                <div class="mock_inst_text_mock_test">
                    <a href="{{url('/dashboard')}}" class="text-decoration-none"><i class="fa fa-angle-left" style="margin-right:8px"></i> Back to Dashboard</a>
                </div>
                <div class="commontab">
                    <div class="tablist">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link qq1_2_3_4 active m-0" id="daily_tasks-tab" data-bs-toggle="tab" data-bs-target="#daily_tasks" type="button" role="tab" aria-controls="daily_tasks" aria-selected="true">
                                    Daily Tasks
                                    <span>{{count($dailyTask)}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link qq1_2_3_4 m-0" id="weekly_tasks-tab" data-bs-toggle="tab" data-bs-target="#weekly_tasks" type="button" role="tab" aria-controls="weekly_tasks" aria-selected="false">Weekly Tasks
                                    <span>{{count($weekTask)}}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" style="padding:16px 0 0;">
                            <div class="tab-pane fade show active" id="daily_tasks" role="tabpanel" aria-labelledby="daily_tasks-tab">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="commonboldtext m-0" style="color: #363c4f;">Task completed</h5>
                                    <label class="m-0 commonboldtext" style="color: #363c4f;">{{$completeddailyTask}} <span style="font-weight:600;color: rgba(54,60,79,0.5);">/{{(isset($dailyTask) && count($dailyTask)>0)?count($dailyTask):0}}</span></label>
                                </div>
                                <ul class="task_center_lists">
                                    @foreach($dailyTask as $key=>$data)
                                    @if($data['category'] == 'skill' && $data['task_type'] == 'daily')
                                    @php
                                    $current_date=date("d");
                                    if($current_date % 4 == 0){
                                    $skill_task = 'Evaluation Skill';
                                    $skill_category = 'evaluation';
                                    }
                                    else if($current_date % 4 == 1){
                                    $skill_task = 'Knowledge Skill';
                                    $skill_category = 'knowledge';
                                    }
                                    elseif($current_date % 4 == 2){
                                    $skill_task = 'Application Skill';
                                    $skill_category = 'application';
                                    }
                                    else{
                                    $skill_task = 'Comprehension Skill';
                                    $skill_category = 'comprehension';
                                    }
                                    @endphp
                                    <li>
                                        <div class="task1">
                                            <p class="m-0"><span>Task {{$key+1}}</span></p>
                                            <div class="d-flex justify-content-between align-items-center skill_para_toggle">
                                                <h3>{{$skill_task}}</h3>
                                                <span><i class="fa fa-angle-down"></i></span>
                                            </div>
                                            <p style="display:none;" class="m-0">Quickly sharpen your {{$skill_category}} skills with this curated test.</p>
                                            <div class="btn-sec">
                                                <div class="qust-sec">
                                                    <span>Questions</span>
                                                    <p>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        <label>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</label>
                                                    </p>
                                                </div>
                                                <div class="dura-sec">
                                                    <span>Duration</span>
                                                    <p>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        <label>15 mins</label>
                                                    </p>
                                                </div>
                                                <!-- <div class="task-btn tasklistbtn">
                                                    <a href="http://localhost/Uniq_web/DailyTask-Skill-Exam/skill/daily/instruction/knowledge" class="btn btn-common-transparent nobg">Practice</a>
                                                </div> -->
                                                @if($data['allowed'] == '1')
                                                <div class="task-btn tasklistbtn">
                                                    <a href="{{route('dailyTaskExamSkill',[$data['category'],$data['task_type'],'instruction',$skill_category])}}" class="btn btn-common-transparent nobg">Practice</a>
                                                </div>
                                                @else
                                                <div class="task-btn tasklistbtn">
                                                    <button class="btn btn-common-transparent nobg disabled" disabled style="cursor: default;">Already Attempted</button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($data['category'] == 'time' && $data['task_type'] == 'daily')
                                    <li>
                                        <div class="task1">
                                            <p class="m-0"><span>Task {$key+1}}</span></p>
                                            <div class="d-flex justify-content-between align-items-center skill_para_toggle">
                                                <h3>Time Management</h3>
                                                <span><i class="fa fa-angle-down"></i></span>
                                            </div>
                                            <p style="display:none;" class="m-0">Take this test to improve your time management skills.</p>
                                            <div class="btn-sec">
                                                <div class="qust-sec">
                                                    <span>Questions</span>
                                                    <p>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        <label>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</label>
                                                    </p>
                                                </div>
                                                <div class="dura-sec">
                                                    <span>Duration</span>
                                                    <p>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        <label>{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</label>
                                                    </p>
                                                </div>
                                                @if($data['allowed'] == '1')
                                                <div class="task-btn tasklistbtn">
                                                    <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                                </div>
                                                @else
                                                <div class="task-btn tasklistbtn">
                                                    <button class="btn btn-common-transparent nobg disabled" disabled style="cursor: default;">Already Attempted</button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="weekly_tasks" role="tabpanel" aria-labelledby="weekly_tasks-tab">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="commonboldtext m-0" style="color: #363c4f;">Task completed</h5>
                                    <label class="m-0 commonboldtext" style="color: #363c4f;">{{$completeddailyTask}} <span style="font-weight:600;color: rgba(54,60,79,0.5);">/{{(isset($dailyTask) && count($dailyTask)>0)?count($dailyTask):0}}</span></label>
                                </div>
                                <ul class="task_center_lists">
                                    @foreach($weekTask as $wkey=>$data)
                                    @if($data['category'] == 'accuracy' && $data['task_type'] == 'weekly')

                                    <li>
                                        <div class="task1">
                                            <p class="m-0"><span>Task {{$wkey+1}}</span></p>
                                            <div class="d-flex justify-content-between align-items-center skill_para_toggle">
                                                <h3>Accuracy Test</h3>
                                                <span><i class="fa fa-angle-down"></i></span>
                                            </div>
                                            <p style="display:none;" class="m-0">Work on your accuracy with this test.</p>
                                            <div class="btn-sec">
                                                <div class="qust-sec">
                                                    <span>Questions</span>
                                                    <p>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        <label>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</label>
                                                    </p>
                                                </div>
                                                <div class="dura-sec">
                                                    <span>Duration</span>
                                                    <p>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        <label>{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</label>
                                                    </p>
                                                </div>
                                                <!-- <div class="task-btn tasklistbtn">
                                                    <a href="http://localhost/Uniq_web/DailyTask-Skill-Exam/skill/daily/instruction/knowledge" class="btn btn-common-transparent nobg">Practice</a>
                                                </div> -->
                                                @if($data['allowed'] == '1')
                                                <div class="task-btn tasklistbtn">
                                                    <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                                </div>
                                                @else
                                                <div class="task-btn tasklistbtn">
                                                    <button class="btn btn-common-transparent nobg disabled" disabled style="cursor: default;">Already Attempted</button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($data['category'] == 'weak_topic' && $data['task_type'] == 'weekly')
                                    <li>
                                        <div class="task1">
                                            <p class="m-0"><span>Task {{$wkey+1}}</span></p>
                                            <div class="d-flex justify-content-between align-items-center skill_para_toggle">
                                                <h3>Weak Topic Test</h3>
                                                <span><i class="fa fa-angle-down"></i></span>
                                            </div>
                                            <p style="display:none;" class="m-0">Take this test to work on your weak topics.</p>
                                            <div class="btn-sec">
                                                <div class="qust-sec">
                                                    <span>Questions</span>
                                                    <p>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.666 2.668h1.333a1.333 1.333 0 0 1 1.334 1.333v9.334a1.333 1.333 0 0 1-1.334 1.333H4a1.333 1.333 0 0 1-1.333-1.333V4a1.333 1.333 0 0 1 1.333-1.333h1.334" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M10 1.332H6a.667.667 0 0 0-.666.667v1.333c0 .368.298.667.667.667h4a.667.667 0 0 0 .666-.667V1.999a.667.667 0 0 0-.666-.667z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        <label>{{(isset($data['total_questions']) && !empty($data['total_questions']))?$data['total_questions']:0}}</label>

                                                    </p>
                                                </div>
                                                <div class="dura-sec">
                                                    <span>Duration</span>
                                                    <p>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8 14.665A6.667 6.667 0 1 0 8 1.332a6.667 6.667 0 0 0 0 13.333z" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M8 4v4l2.667 1.333" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        <label>{{(isset($data['time_allowed']) && !empty($data['time_allowed']))?$data['time_allowed']:0}} mins</label>
                                                    </p>
                                                </div>
                                                @if($data['allowed'] == '1')
                                                <div class="task-btn tasklistbtn">
                                                    <a href="{{route('dailyTaskExam',[$data['category'],$data['task_type'],'instruction'])}}" class="btn btn-common-transparent nobg">Practice</a>
                                                </div>
                                                @else
                                                <div class="task-btn tasklistbtn">
                                                    <button class="btn btn-common-transparent nobg disabled" disabled style="cursor: default;">Already Attempted</button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!----------------------------------->
        </div>
        <div class="modal fade" id="matrix">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content  bg-light">
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
        <div class="modal fade" id="summarymodal" aria-modal="true" role="dialog">
            <div class="modalcenter">
                <div class="modal-dialog">
                    <div class="modal-content exammodal_content">
                        <div class="modal-body">
                            <div class="modal-header-exam">
                                <div class="exam-overview">
                                    <label>Exam Overview</label>
                                </div>
                                <div class="exam-overview-time">
                                    <label><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity=".1" d="M20 40c11.046 0 20-8.954 20-20S31.046 0 20 0 0 8.954 0 20s8.954 20 20 20z" fill="#363C4F" />
                                            <path d="M31.896 32.835A17.503 17.503 0 1 1 20 2.5V20l11.896 12.835z" fill="#44CD7F" />
                                            <path d="M20 32.683c7.005 0 12.683-5.678 12.683-12.683 0-7.004-5.678-12.683-12.683-12.683S7.317 12.996 7.317 20c0 7.005 5.678 12.683 12.683 12.683z" fill="#EBEBED" />
                                            <path d="M20 26.41a6.19 6.19 0 1 0 0-12.38 6.19 6.19 0 0 0 0 12.38z" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M20 17.582v2.457h1.638M15.905 12.668l-2.252 1.638M24.095 12.668l2.252 1.638" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </label>
                                    <span>112 mins Left</span>
                                </div>
                            </div>
                            <div class="exam-ans-sec top-first">
                                <div class="ans1">Answered</div>
                                <div class="ans-in-num">24</div>
                            </div>
                            <div class="exam-ans-sec">
                                <div class="ans2">Unanswered</div>
                                <div class="ans-in-num">2</div>
                            </div>
                            <div class="exam-ans-sec">
                                <div class="ans3">Marked for Review</div>
                                <div class="ans-in-num">3</div>
                            </div>
                            <div class="exam-ans-sec">
                                <div class="ans4">Answered & Marked for Review</div>
                                <div class="ans-in-num">1</div>
                            </div>
                            <div class="exam_text_content">
                                No changes will be allowed after submission. Are you sure you want to submit test for final marking?
                            </div>
                            <div class="exam-footer-sec">
                                <div class="task-btn tasklistbtn">
                                    <button class="btn btn-common-transparent nobg">Back To test</button>
                                    <button class="btn btn-common-green"> Submit Test <label><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z" fill="#fff" />
                                            </svg>
                                        </label>
                                    </button>
                                </div>
                            </div>
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

            $(".skill_para_toggle span").click(function() {
                $(this).parent().next("p").slideToggle();
                $(this).children().toggleClass("fa-angle-down fa-angle-up");
            });
        </script>
        <!-- Footer Section -->
        @include('afterlogin.layouts.footer_new')
        <!-- footer Section end  -->
        @endsection