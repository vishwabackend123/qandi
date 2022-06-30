
@extends('layouts.app')
@section('content')
<div class="main-wrapper">
    <header>
      <div class="headerMain">
         <div class="headerLeft">
            <h2>Dashboard</h2>
            <h6><label>Cource:</label> <span>JEE</span></h6>
         </div>
         <div class="headerRight">
            <span class="usertext"><a href="javascript:;">Hi Sakshi!</a></span>
            <span class="headericon notificationnew">
               <a draggable="false" id="nodificbell" data-bs-toggle="collapse" href='#collapseNotification2' role="button" aria-expanded="false" aria-controls="collapseNotification" title="Notification">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                     <g clip-path="url(#5ju4071vya)">
                        <path d="M15 6.768a5 5 0 0 0-10 0c0 5.833-2.5 7.5-2.5 7.5h15S15 12.6 15 6.768zM11.44 17.602a1.666 1.666 0 0 1-2.882 0" stroke="#363C4F" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="14" cy="4.102" r="4" fill="#F7758F" stroke="#fff" stroke-width="2"/>
                     </g>
                     <defs>
                        <clipPath id="5ju4071vya">
                           <path fill="#fff" transform="translate(0 .102)" d="M0 0h20v20H0z"/>
                        </clipPath>
                     </defs>
                  </svg>
               </a>
            </span>
            <span class="headericon">
               <a href="javascript:;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                     <path d="M16.666 17.602v-1.667a3.333 3.333 0 0 0-3.333-3.333H6.666a3.333 3.333 0 0 0-3.333 3.333v1.667M10 9.268a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666z" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
               </a>
            </span>
         </div>
      </div>
   </header>
   <aside>
      <span class="sidebar-logo d-inline-block">
      <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo">
      <span class="custom-border mt-3"></span>
      </span>
      <ul class="sidebar-menu-lists">
         <li class="active mb-4">
            <a href="javascript:void(0)">
               <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                  <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.746-2.31-2.601-2.31H4.934c-1.855 0-2.601.665-2.601 2.31v5.285c0 1.657.746 2.31 2.601 2.31H9.65c1.855.012 2.601-.653 2.601-2.298zM12.25 23.065v-4.713c0-1.855-.746-2.602-2.601-2.602H4.934c-1.855 0-2.601.747-2.601 2.602v4.713c0 1.855.746 2.602 2.601 2.602H9.65c1.855 0 2.601-.747 2.601-2.602z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
            </a>
         </li>
         <li class="mb-4">
            <a href="javascript:void(0)">
               <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                  <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
            </a>
         </li>
         <li class="mb-4">
            <a href="javascript:void(0)">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M22 12A10 10 0 0 0 12 2v10h10z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
            </a>
         </li>
         <li class="mb-4">
            <a href="javascript:void(0)">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
            </a>
         </li>
         <li class="mb-4">
            <a href="#sharefrnd" class="openSharefrnd" data-bs-toggle="modal">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
            </a>
         </li>
      </ul>
   </aside>
    <div class="content-wrapper">
        <div class="exam_instruction_wrapper">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 exam_instruction_col_eight">
                    <div class="mock_inst_text_mock_test">
                        <a href=""><b><</b> Mock Test</a>
                    </div>
                    <div class="exam_instruction_text">INSTRUCTIONS</div>
                    <div class="exam_instruction_text_under_text">Prior to taking the test, please read through all of the instruction sections carefully.</div>
                    <div class="exam_instruction_scrolling">    
                        <div>
                            <div class="exam_inst_sec_head"><b>1. General</b></div>
                            <div class="line-693"></div>
                            <ul class="exam_inst_ul_li">
                                <li>The total duration of this test is <b>180 minutes</b></li>
                                <li>This test is of <b>300 marks</b></li>
                                <li>There will be <b>90 questions</b> in the test</li>
                                <li class="exam_instr_li_one_disk_none">The following are the sections in the test:</li>
                            </ul>
                        </div>
                        <div>
                            <div class="exam_inst_sec_head_flex">
                                <div class="exam_inst_sec_head"><b>2. Physics</b></div>
                                <div class="exam_inst_sec_head_padding">
                                    <span>Total Marks:</span>
                                    <span><b>100</b></span>
                                </div>
                            </div>
                            <div class="line-693"></div>
                            <div class="exam_instruct_section_subject"><b>Section A</b></div>
                            <ul class="exam_inst_ul_li">
                                <li>This section contains 15 <b>questions of Single Choice.</b></li>
                                <li><b>For Single Choice question</b>, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</li>
                            </ul>
                            <div class="exam_instruct_section_subject"><b>Section B</b></div>
                            <ul class="exam_inst_ul_li">
                                <li>This section contains 15 <b>questions of Numerical Choice.</b></li>
                                <li>Out of 15 questions only <b>10 questions</b> need to be attempted</li>
                                <li>For Single Choice question, 4 mark(s) is allotted for each correct <br>response, 1 mark(s) will be deducted for each incorrect response</li>
                            </ul>
                        </div>
                        <div>
                            <div class="exam_inst_sec_head_flex">
                                <div class="exam_inst_sec_head"><b>3. Chemistry</b></div>
                                <div class="exam_inst_sec_head_padding">
                                    <span>Total Marks:</span>
                                    <span><b>100</b></span>
                                </div>
                            </div>
                            <div class="line-693"></div>
                            <div class="exam_instruct_section_subject"><b>Section A</b></div>
                            <ul class="exam_inst_ul_li">
                                <li>This section contains 15 <b>questions of Single Choice.</b></li>
                                <li><b>For Single Choice question</b>, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</li>
                            </ul>
                            <div class="exam_instruct_section_subject"><b>Section B</b></div>
                            <ul class="exam_inst_ul_li">
                                <li>This section contains 15 <b>questions of Numerical Choice.</b></li>
                                <li>Out of 15 questions only <b>10 questions</b> need to be attempted</li>
                                <li>For Single Choice question, 4 mark(s) is allotted for each correct <br>response, 1 mark(s) will be deducted for each incorrect response</li>
                            </ul>
                        </div>
                        <div>
                            <div class="exam_inst_sec_head_flex">
                                <div class="exam_inst_sec_head"><b>4. Mathematics</b></div>
                                <div class="exam_inst_sec_head_padding">
                                    <span>Total Marks:</span>
                                    <span><b>100</b></span>
                                </div>
                            </div>
                            <div class="line-693"></div>
                            <div class="exam_instruct_section_subject"><b>Section A</b></div>
                            <ul class="exam_inst_ul_li">
                                <li>This section contains 15 <b>questions of Single Choice.</b></li>
                                <li><b>For Single Choice question</b>, 4 mark(s) is allotted for each correct response, 1 mark(s) will be deducted for each incorrect response, and 0 mark(s) are given for partial answers</li>
                            </ul>
                            <div class="exam_instruct_section_subject"><b>Section B</b></div>
                            <ul class="exam_inst_ul_li">
                                <li>This section contains 15 <b>questions of Numerical Choice.</b></li>
                                <li>Out of 15 questions only <b>10 questions</b> need to be attempted</li>
                                <li>For Single Choice question, 4 mark(s) is allotted for each correct <br>response, 1 mark(s) will be deducted for each incorrect response</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 exam_instruction_col_four">
                    <div class="exam_section_right_side">
                        <div class="exam_section_right_side_padding">
                            <div class="exam_section_right_side_jee_main">JEE Main - Full Syllabus -2021</div>
                            <div class="line-692"></div>
                            <div class="exam_inst_col_four_text_contant">    
                                <div class="exam_inst_col_four_text_contant1">Duration</div>
                                <div class="exam_inst_col_four_text_contant2">180 Mins</div>
                            </div>
                            <div class="exam_inst_col_four_text_contant">    
                                <div class="exam_inst_col_four_text_contant1">No. Of Questions</div>
                                <div class="exam_inst_col_four_text_contant2">90 MCQ Questions</div>
                            </div>
                            <div class="exam_inst_col_four_text_contant">    
                                <div class="exam_inst_col_four_text_contant1">Subject</div>
                                <div class="exam_inst_col_four_text_contant2">Physics, Chemistry<br>& Mathematics</div>
                            </div>
                        </div>
                        <div class="exam_inst_right_contant_green text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="104" height="104" viewBox="0 0 104 104" fill="none" class="exam_inst_svg_right_green">
                            <mask id="stq5c63rya" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="104" height="104">
                                <path d="M0 0h104v96.18a7.82 7.82 0 0 1-7.82 7.82H0V0z" fill="#D9D9D9"/>
                            </mask>
                            <g mask="url(#stq5c63rya)">
                                <rect x="14.075" y="28.538" width="61.774" height="78.977" rx="1.564" transform="rotate(-12.796 14.075 28.538)" fill="#D4ECD8"/>
                                <rect x="22.054" y="20.718" width="61.774" height="78.977" rx="1.564" fill="#EDFFEF"/>
                                <rect x="26.746" y="54.343" width="7.82" height="7.82" rx="2.444" fill="#56B663"/>
                                <path d="m29.19 58.253.978.977 1.955-1.955" stroke="#E0F6E3" stroke-width=".977" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="26.746" y="69.98" width="7.82" height="7.82" rx="2.444" fill="#56B663"/>
                                <path d="m29.19 73.889.977.977 1.955-1.955" stroke="#E0F6E3" stroke-width=".977" stroke-linecap="round" stroke-linejoin="round"/>
                                <path stroke="#B2D9B6" stroke-width="1.564" stroke-linecap="round" d="M38.475 55.122h11.73M38.475 70.761h11.73M28.309 36.356h32.842M28.309 42.613h22.677M65.844 36.356h13.293M38.475 60.596h20.331M38.475 76.236h20.331"/>
                                <path d="M71.485 83.871 63.6 78.785l-1.604 8.618c-.258 1.388 1.31 2.38 2.454 1.553l7.035-5.085z" fill="#56B663"/>
                                <path d="M87.759 41.33a3.128 3.128 0 0 1 4.324-.933l2.628 1.695a3.128 3.128 0 0 1 .933 4.324L71.484 83.87 63.6 78.785l24.16-37.455z" fill="#4A9453"/>
                                <path d="M87.759 41.33a3.128 3.128 0 0 1 4.324-.933l2.628 1.695a3.128 3.128 0 0 1 .933 4.324l-4.239 6.571-7.885-5.086 4.239-6.571z" fill="#E0F6E3"/>
                                <path fill="#56B663" d="m84.79 45.93 7.886 5.086-2.543 3.943-7.885-5.086z"/>
                            </g>
                        </svg>
                        <div class="exam_inst_all_the_best">All the Best Sakshi!</div>
                        <button class="btn exam_inst_take_test_btn">Take Test</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection