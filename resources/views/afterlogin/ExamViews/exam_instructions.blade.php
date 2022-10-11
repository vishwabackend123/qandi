@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
@endphp
@section('content')
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
@if($errors->any())
<script>
    $(window).on('load', function() {
        $('#matrix').modal('show');
    });
</script>
@endif
<div class="main-wrapper exam-wrapperBg">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <div class="content-wrapper">
        <div class="exam_instruction_wrapper">
            <div class="mock_inst_text_mock_testmobile mobile_block">
                <a href="{{ url()->previous() }}" class="mocktestarrow"> <i class="fa fa-angle-right" aria-hidden="true"></i> Back</a>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-6 col-sm-12 col-xs-12 exam_instruction_col_eight">
                    <div class="mock_inst_text_mock_test">
                        <a href="{{ url()->previous() }}" class="mocktestarrow"> <i class="fa fa-angle-right" aria-hidden="true"></i> Back</a>
                    </div>
                    <div class="exam_instruction_text">INSTRUCTIONS</div>
                    <div class="exam_instruction_text_under_text">Please read the instructions carefully prior to taking the test.</div>
                    <div class="exam_instruction_scrolling">
                        <div>
                            <div class="exam_inst_sec_head"><b>1. <span>General<span></b></div>
                            <div class="line-693"></div>
                            <ul class="exam_inst_ul_li">
                                <li>The total duration of this test is <b>{{$exam_fulltime}} mins.</b></li>
                                <li>This test is of <b>{{$total_marks}} marks.</b></li>
                                <li>There will be <b>{{$questions_count}} questions</b> in the test.</li>
                                <!--  <li class="exam_instr_li_one_disk_none">The following are the sections in the test:</li> -->
                            </ul>
                        </div>
                        @php $i=1; @endphp
                        @if(isset($filtered_subject))
                        @foreach($filtered_subject as $sub)
                        @php $i++; @endphp

                        <div>
                            <div class="exam_inst_sec_head_flex">
                                <div class="exam_inst_sec_head"><b>{{$i}}. <span>{{$sub->subject_name}}</span></b></div>
                                <div class="exam_inst_sec_head_padding">
                                    <span>Total Marks:</span>
                                    <span><b>{{$sub->count*4}}</b></span>
                                </div>
                            </div>
                            <div class="line-693"></div>
                            <div class="mt-2">The following are the sections in the test:</div>

                            <ul class="exam_inst_ul_li">
                                <li>This section contains {{$sub->count}} <b>questions of Single Choice.</b></li>
                                <li><b>For Single Choice questions</b>, +4 marks are allotted for each correct response, -1 mark will be deducted for each incorrect response, and 0 mark will be given for unanswered/ marked for review questions. </li>

                            </ul>


                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-12 col-xs-12 exam_instruction_col_four">
                    <div class="exam_section_right_side">
                        <div class="exam_section_right_side_padding">
                            <div class="exam_section_right_side_jee_main">{{isset($exam_name)?$exam_name:''}}</div>
                            <!-- <div class="line-692"></div> -->
                            <div class="exam_inst_col_four_text_contant">
                                <div class="exam_inst_col_four_text_contant1">Duration</div>
                                <div class="exam_inst_col_four_text_contant2">{{$exam_fulltime}} Mins</div>
                            </div>
                            <div class="exam_inst_col_four_text_contant">
                                <div class="exam_inst_col_four_text_contant1">No. of Questions</div>
                                <div class="exam_inst_col_four_text_contant2">{{$questions_count}} Questions</div>
                            </div>
                            <div class="exam_inst_col_four_text_contant">
                                <div class="exam_inst_col_four_text_contant1">{{(isset($subCounts) && $subCounts>1)?'Subjects':'Subject'}}</div>
                                <div class="exam_inst_col_four_text_contant2">{{$tagrets}}</div>
                            </div>
                        </div>
                        <div>
                            <div class="exam_inst_right_contant_green text-center">
                               <span class="green_circle leftenter"></span>
                                <span class="green_circle leftbottom"></span>
                                <span class="green_circle rightBottom"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="104" height="104" viewBox="0 0 104 104" fill="none" class="exam_inst_svg_right_green">
                                    <mask id="stq5c63rya" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="104" height="104">
                                        <path d="M0 0h104v96.18a7.82 7.82 0 0 1-7.82 7.82H0V0z" fill="#D9D9D9" />
                                    </mask>
                                    <g mask="url(#stq5c63rya)">
                                        <rect x="14.075" y="28.538" width="61.774" height="78.977" rx="1.564" transform="rotate(-12.796 14.075 28.538)" fill="#D4ECD8" />
                                        <rect x="22.054" y="20.718" width="61.774" height="78.977" rx="1.564" fill="#EDFFEF" />
                                        <rect x="26.746" y="54.343" width="7.82" height="7.82" rx="2.444" fill="#56B663" />
                                        <path d="m29.19 58.253.978.977 1.955-1.955" stroke="#E0F6E3" stroke-width=".977" stroke-linecap="round" stroke-linejoin="round" />
                                        <rect x="26.746" y="69.98" width="7.82" height="7.82" rx="2.444" fill="#56B663" />
                                        <path d="m29.19 73.889.977.977 1.955-1.955" stroke="#E0F6E3" stroke-width=".977" stroke-linecap="round" stroke-linejoin="round" />
                                        <path stroke="#B2D9B6" stroke-width="1.564" stroke-linecap="round" d="M38.475 55.122h11.73M38.475 70.761h11.73M28.309 36.356h32.842M28.309 42.613h22.677M65.844 36.356h13.293M38.475 60.596h20.331M38.475 76.236h20.331" />
                                        <path d="M71.485 83.871 63.6 78.785l-1.604 8.618c-.258 1.388 1.31 2.38 2.454 1.553l7.035-5.085z" fill="#56B663" />
                                        <path d="M87.759 41.33a3.128 3.128 0 0 1 4.324-.933l2.628 1.695a3.128 3.128 0 0 1 .933 4.324L71.484 83.87 63.6 78.785l24.16-37.455z" fill="#4A9453" />
                                        <path d="M87.759 41.33a3.128 3.128 0 0 1 4.324-.933l2.628 1.695a3.128 3.128 0 0 1 .933 4.324l-4.239 6.571-7.885-5.086 4.239-6.571z" fill="#E0F6E3" />
                                        <path fill="#56B663" d="m84.79 45.93 7.886 5.086-2.543 3.943-7.885-5.086z" />
                                    </g>
                                </svg>
                                <div class="exam_inst_all_the_best">All the Best, {{ucwords($userData->user_name)}}!</div>
                                <form class="form-horizontal ms-auto " action="{{$exam_url}}" method="post">
                                    @csrf
                                    <input type="hidden" name="ranSession" value="{{$ranSession}}" />
                                    <button type="submit" class="btn exam_inst_take_test_btn">{{(isset($test_type) && (($test_type=='Live') || ($test_type=='Profiling')))?'Take Test': 'Practice' }}</button>
                                </form>
                                {{-- <a href="{{$exam_url}}" class="btn exam_inst_take_test_btn">{{(isset($test_type) && (($test_type=='Live') || ($test_type=='Profiling')))?'Take Test': 'Practice' }}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->
@endsection