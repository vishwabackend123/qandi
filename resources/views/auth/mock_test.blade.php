@extends('afterlogin.layouts.app_new')
@section('content')

<body class="bg-content">
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
                           <path d="M15 6.768a5 5 0 0 0-10 0c0 5.833-2.5 7.5-2.5 7.5h15S15 12.6 15 6.768zM11.44 17.602a1.666 1.666 0 0 1-2.882 0" stroke="#363C4F" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                           <circle cx="14" cy="4.102" r="4" fill="#F7758F" stroke="#fff" stroke-width="2" />
                        </g>
                        <defs>
                           <clipPath id="5ju4071vya">
                              <path fill="#fff" transform="translate(0 .102)" d="M0 0h20v20H0z" />
                           </clipPath>
                        </defs>
                     </svg>
                  </a>
               </span>
               <span class="headericon dropdown">
                  <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <path d="M16.666 17.602v-1.667a3.333 3.333 0 0 0-3.333-3.333H6.666a3.333 3.333 0 0 0-3.333 3.333v1.667M10 9.268a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666z" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="#">Action</a></li>
                     <li><a class="dropdown-item" href="#">Another action</a></li>
                     <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
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
                     <path d="M25.667 9.94V4.643c0-1.645-.747-2.31-2.602-2.31h-4.713c-1.855 0-2.602.665-2.602 2.31v5.285c0 1.657.747 2.31 2.602 2.31h4.713c1.855.012 2.602-.653 2.602-2.298zM25.667 23.065v-4.713c0-1.855-.747-2.602-2.602-2.602h-4.713c-1.855 0-2.602.747-2.602 2.602v4.713c0 1.855.747 2.602 2.602 2.602h4.713c1.855 0 2.602-.747 2.602-2.602zM12.25 9.94V4.643c0-1.645-.746-2.31-2.601-2.31H4.934c-1.855 0-2.601.665-2.601 2.31v5.285c0 1.657.746 2.31 2.601 2.31H9.65c1.855.012 2.601-.653 2.601-2.298zM12.25 23.065v-4.713c0-1.855-.746-2.602-2.601-2.602H4.934c-1.855 0-2.601.747-2.601 2.602v4.713c0 1.855.746 2.602 2.601 2.602H9.65c1.855 0 2.601-.747 2.601-2.602z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </a>
            </li>
            <li class="mb-4">
               <a href="javascript:void(0)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                     <path d="M15.471 4.2 5.893 14.34c-.362.385-.712 1.143-.782 1.668l-.431 3.78c-.152 1.365.828 2.298 2.181 2.065l3.757-.642c.525-.093 1.26-.478 1.621-.875l9.579-10.138c1.656-1.75 2.403-3.745-.175-6.183-2.567-2.415-4.515-1.564-6.172.186z" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                     <path d="M13.871 5.89A7.147 7.147 0 0 0 20.23 11.9M3.5 25.668h21" stroke="#234628" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </a>
            </li>
            <li class="mb-4">
               <a href="javascript:void(0)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                     <path d="M21.21 15.89A10 10 0 1 1 8 2.83" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                     <path d="M22 12A10 10 0 0 0 12 2v10h10z" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </a>
            </li>
            <li class="mb-4">
               <a href="javascript:void(0)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                     <path d="M19 4H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM16 2v4M8 2v4M3 10h18" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </a>
            </li>
            <li class="mb-4">
               <a href="#sharefrnd" class="openSharefrnd" data-bs-toggle="modal">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                     <path d="M18 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM18 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98" stroke="#234628" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </a>
            </li>
         </ul>
      </aside>
      <section class="content-wrapper">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <div class="commontab">
                     <div class="tablist">
                        <ul class="nav nav-tabs" role="tablist">
                           <li class="nav-item pe-5 me-2">
                              <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#mock_test1">Mock Test</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#attempted2">Attempted</a>
                           </li>
                        </ul>
                     </div>
                     <!-- Tab panes -->
                     <div class="tab-content bg-white exam_tabdata">
                        <div id="mock_test1" class=" tab-pane active">
                           <div class="jee_main_text_take_test__btn">
                              <div class="mock_exam_jee_main_text">
                                 <h3>JEE Main - Full Syllabus -2021</h3>
                              </div>
                              <button type="button" class="btn btn-common-green mock_test_take_test_btn">Take test</button>
                           </div>
                           <div class="line_696"></div>
                           <div class="mock_test_ques_dure_marks_sub d-flex">
                              <div class="mock_test_ques_content">
                                 <div class="mock_test_qdms_text1">No. Of Questions</div>
                                 <div class="mock_test_qdms_text2">90 MCQ</div>
                              </div>
                              <div class="mock_test_dure_content">
                                 <div class="mock_test_qdms_text1">Duration</div>
                                 <div class="mock_test_qdms_text2"><span>180</span><span>Mins</span></div>
                              </div>
                              <div class="mock_test_marks_content">
                                 <div class="mock_test_qdms_text1">Marks</div>
                                 <div class="mock_test_qdms_text2">300</div>
                              </div>
                              <div class="mock_test_sub_content">
                                 <div class="mock_test_qdms_text1">Subject</div>
                                 <div class="mock_test_qdms_text2">Physics, Chemistry & Mathematics</div>
                              </div>
                           </div>
                        </div>
                        <div id="attempted2" class=" tab-pane">
                           <div class="accordion mt-4 pt-1" id="accordionExample">
                              <div class="allscrollbar">
                                 <div class="accordion-item">
                                    <div class="test-table d-flex align-items-center justify-content-between live_mock_exam_section">
                                       <h2 class="m-0">Mock Test</h2>
                                       <h3 class="m-0">15 April 2021</h3>
                                       <div class="accordion-header mock_btn_vie_detail d-flex align-items-center justify-content-between" id="headingOne">
                                          <h4 data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="m-0 view_detail_text_colleps">View details</h4>
                                          <div class="d-flex align-items-center see_analytics_mock_exam">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M15.267 10c2.166 0 3.066-.833 2.266-3.566-.541-1.842-2.125-3.425-3.966-3.967-2.734-.8-3.567.1-3.567 2.267v2.4C10 9.167 10.833 10 12.5 10h2.767z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M16.667 12.25a7.576 7.576 0 0 1-8.684 5.975c-3.158-.508-5.7-3.05-6.216-6.208a7.584 7.584 0 0 1 5.95-8.675" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             </svg>
                                             <h3>See analytics</h3>
                                          </div>
                                          <button type="button" class="btn btn-common-transparent bg-transparent ms-4">Review exam</button>
                                       </div>
                                    </div>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                       <div class="accordion-body ps-0 pe-0">
                                          <div class="mock_test_ques_dure_marks_sub d-flex">
                                             <div class="mock_test_ques_content2">
                                                <div class="mock_test_qdms_text1">No. Of Questions</div>
                                                <div class="mock_test_qdms_text2">90 MCQ</div>
                                             </div>
                                             <div class="mock_test_dure_content2">
                                                <div class="mock_test_qdms_text1">Duration</div>
                                                <div class="mock_test_qdms_text2"><span>180</span><span>Mins</span></div>
                                             </div>
                                             <div class="mock_test_marks_content2">
                                                <div class="mock_test_qdms_text1">Marks</div>
                                                <div class="mock_test_qdms_text2">300</div>
                                             </div>
                                             <div class="mock_test_marks_content2">
                                                <div class="mock_test_qdms_text1">Subject</div>
                                                <div class="mock_test_qdms_text2">Physics, Chemistry & Mathematics</div>
                                             </div>
                                             <div class="mock_test_marks_content2">
                                                <div class="mock_test_qdms_text1">Slot</div>
                                                <div class="mock_test_qdms_text2">Morning</div>
                                             </div>
                                             <div class="mock_test_sub_content2">
                                                <div class="mock_test_qdms_text1">Score</div>
                                                <div class="mock_test_qdms_text2"><span>102</span>/<span>300</span></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="accordion-item pt-4">
                                    <div class="test-table d-flex align-items-center justify-content-between live_mock_exam_section">
                                       <h2 class="m-0">Mock Test</h2>
                                       <h3 class="m-0">17 April 2021</h3>
                                       <div class="accordion-header mock_btn_vie_detail d-flex align-items-center justify-content-between" id="headingTwo">
                                          <h4 data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" class="m-0 view_detail_text_colleps">View details</h4>
                                          <div class="d-flex align-items-center see_analytics_mock_exam">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M15.267 10c2.166 0 3.066-.833 2.266-3.566-.541-1.842-2.125-3.425-3.966-3.967-2.734-.8-3.567.1-3.567 2.267v2.4C10 9.167 10.833 10 12.5 10h2.767z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M16.667 12.25a7.576 7.576 0 0 1-8.684 5.975c-3.158-.508-5.7-3.05-6.216-6.208a7.584 7.584 0 0 1 5.95-8.675" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             </svg>
                                             <h3>See analytics</h3>
                                          </div>
                                          <button type="button" class="btn btn-common-transparent bg-transparent ms-4">Review exam</button>
                                       </div>
                                    </div>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                       <div class="accordion-body ps-0 pe-0">
                                          <div class="mock_test_ques_dure_marks_sub d-flex">
                                             <div class="mock_test_ques_content2">
                                                <div class="mock_test_qdms_text1">No. Of Questions</div>
                                                <div class="mock_test_qdms_text2">90 MCQ</div>
                                             </div>
                                             <div class="mock_test_dure_content2">
                                                <div class="mock_test_qdms_text1">Duration</div>
                                                <div class="mock_test_qdms_text2"><span>180</span><span>Mins</span></div>
                                             </div>
                                             <div class="mock_test_marks_content2">
                                                <div class="mock_test_qdms_text1">Marks</div>
                                                <div class="mock_test_qdms_text2">300</div>
                                             </div>
                                             <div class="mock_test_marks_content2">
                                                <div class="mock_test_qdms_text1">Subject</div>
                                                <div class="mock_test_qdms_text2">Physics, Chemistry & Mathematics</div>
                                             </div>
                                             <div class="mock_test_marks_content2">
                                                <div class="mock_test_qdms_text1">Slot</div>
                                                <div class="mock_test_qdms_text2">Morning</div>
                                             </div>
                                             <div class="mock_test_sub_content2">
                                                <div class="mock_test_qdms_text1">Score</div>
                                                <div class="mock_test_qdms_text2"><span>102</span>/<span>300</span></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="accordion-item pt-4">
                                 <div class="test-table d-flex align-items-center justify-content-between live_mock_exam_section">
                                    <h2 class="m-0">Mock Test</h2>
                                    <h3 class="m-0">18 April 2021</h3>
                                    <div class="accordion-header mock_btn_vie_detail d-flex align-items-center justify-content-between" id="headingThree">
                                       <h4 data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="m-0 view_detail_text_colleps">View details</h4>
                                       <div class="d-flex align-items-center see_analytics_mock_exam">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                             <path d="M15.267 10c2.166 0 3.066-.833 2.266-3.566-.541-1.842-2.125-3.425-3.966-3.967-2.734-.8-3.567.1-3.567 2.267v2.4C10 9.167 10.833 10 12.5 10h2.767z" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M16.667 12.25a7.576 7.576 0 0 1-8.684 5.975c-3.158-.508-5.7-3.05-6.216-6.208a7.584 7.584 0 0 1 5.95-8.675" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                          <h3>See analytics</h3>
                                       </div>
                                       <button type="button" class="btn btn-common-transparent bg-transparent ms-4">Review exam</button>
                                    </div>
                                 </div>
                                 <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ps-0 pe-0">
                                       <div class="mock_test_ques_dure_marks_sub d-flex">
                                          <div class="mock_test_ques_content2">
                                             <div class="mock_test_qdms_text1">No. Of Questions</div>
                                             <div class="mock_test_qdms_text2">90 MCQ</div>
                                          </div>
                                          <div class="mock_test_dure_content2">
                                             <div class="mock_test_qdms_text1">Duration</div>
                                             <div class="mock_test_qdms_text2"><span>180</span><span>Mins</span></div>
                                          </div>
                                          <div class="mock_test_marks_content2">
                                             <div class="mock_test_qdms_text1">Marks</div>
                                             <div class="mock_test_qdms_text2">300</div>
                                          </div>
                                          <div class="mock_test_marks_content2">
                                             <div class="mock_test_qdms_text1">Subject</div>
                                             <div class="mock_test_qdms_text2">Physics, Chemistry & Mathematics</div>
                                          </div>
                                          <div class="mock_test_marks_content2">
                                             <div class="mock_test_qdms_text1">Slot</div>
                                             <div class="mock_test_qdms_text2">Morning</div>
                                          </div>
                                          <div class="mock_test_sub_content2">
                                             <div class="mock_test_qdms_text1">Score</div>
                                             <div class="mock_test_qdms_text2"><span>102</span>/<span>300</span></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </div>
   </section>
   </div>

</body>
@endsection