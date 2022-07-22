@extends('afterlogin.layouts.app_new')
@section('content')
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
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
            <span class="headericon dropdown">
               <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                     <path d="M16.666 17.602v-1.667a3.333 3.333 0 0 0-3.333-3.333H6.666a3.333 3.333 0 0 0-3.333 3.333v1.667M10 9.268a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666z" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
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
   <section class="content-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="commontab">
               <div class="tablist">
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item pe-5 me-2">
                        <a class="nav-link qq1_2_3_4 active bg-transparent m-0" data-bs-toggle="tab" href="#qq1">Custom</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link qq1_2_3_4 bg-transparent" data-bs-toggle="tab" href="#qq2">Attempted</a>
                     </li>
                  </ul>
               </div>
               <!-- Tab panes -->
               <div class="tab-content bg-white exam_tabdata">
                  <div id="qq1" class=" tab-pane active">
                     <div class="common_greenbadge_tabs exam_topicbtn pb-4 mb-1">
                        <ul class="nav nav-pills d-inline-flex" id="marks-tab" role="tablist">
                           <li class="nav-item" role="presentation" type="button">
                              <button class="nav-link btn pt-0 pb-0 active">Mathematics</button>
                           </li>
                           <li class="nav-item" role="presentation" type="button">
                              <button class="nav-link pt-0 pb-0 btn">Physics</button>
                           </li>
                           <li class="nav-item" role="presentation">
                              <button class="nav-link pt-0 pb-0 btn" type="button">Chemistry</button>
                           </li>
                        </ul>
                     </div>
                     <div class="take-fulltest d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center clrsec">
                           <button type="button" class="btn btn-common-transparent bg-transparent me-3">Take test for selected topics</button>  
                           <a href="javascript:void(0);" class="clearsec">Clear Selection</a>
                        </div>
                        <div>
                           <a href="javascript:void(0)">
                              <svg class="me-4 align-bottom" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 9a8 8 0 0 1 8-8h28a8 8 0 0 1 8 8v28a8 8 0 0 1-8 8H9a8 8 0 0 1-8-8V9z" fill="#FCFDFD"/>
                                 <path d="M18 23h10m-12.5-5h15m-10 10h5" stroke="#56B663" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9 1.5h28v-1H9v1zM44.5 9v28h1V9h-1zM37 44.5H9v1h28v-1zM1.5 37V9h-1v28h1zM9 44.5A7.5 7.5 0 0 1 1.5 37h-1A8.5 8.5 0 0 0 9 45.5v-1zM44.5 37a7.5 7.5 0 0 1-7.5 7.5v1a8.5 8.5 0 0 0 8.5-8.5h-1zM37 1.5A7.5 7.5 0 0 1 44.5 9h1A8.5 8.5 0 0 0 37 .5v1zM9 .5A8.5 8.5 0 0 0 .5 9h1A7.5 7.5 0 0 1 9 1.5v-1z" fill="#56B663"/>
                              </svg>
                           </a>
                           <button type="button" class="btn btn-common-green">Take full test</button> 
                        </div>
                     </div>
                     <div class="accordion mt-4 pt-1" id="accordionExample">
                        <div class="allscrollbar">
                           <div class="accordion-item">
                              <div class="test-table d-flex align-items-center justify-content-between pb-3 mb-1">
                                 <h2 class="m-0">3D Geometry</h2>
                                 <h3 class="m-0">Proficiency : <span>65%</span></h3>
                                 <div class="accordion-header d-flex align-items-center" id="headingOne">
                                    <h4 data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="m-0">View topics</h4>
                                    <button type="button" class="btn btn-common-transparent bg-transparent ms-4">Take test</button>
                                 </div>
                              </div>
                              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                 <div class="accordion-body ps-0 pe-0 pt-4">
                                    <div class="testslider owl-carousel owl-theme">
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box selectbox">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn btn-common-green">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                       
                        <div class="accordion-item pt-4">
                           <div class="test-table d-flex align-items-center justify-content-between pb-3 mb-1">
                              <h2 class="m-0">Application of Derivaties</h2>
                              <h3 class="m-0">Proficiency : <span>30%</span></h3>
                              <div class="accordion-header d-flex align-items-center" id="headingTwo">
                                 <h4 data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" class="m-0">View topics</h4>
                                 <button type="button" class="btn btn-common-transparent bg-transparent ms-4">Take test</button>
                              </div>
                           </div>
                           <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                              <div class="accordion-body ps-0 pe-0 pt-4">
                                                 <div class="testslider owl-carousel owl-theme">
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box selectbox">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn btn-common-green">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                              </div>
                           </div>
                        </div>
                           <div class="accordion-item pt-4">
                           <div class="test-table d-flex align-items-center justify-content-between pb-3 mb-1">
                              <h2 class="m-0">Area Under Curves</h2>
                              <h3 class="m-0">Proficiency : <span>22%</span></h3>
                              <div class="accordion-header d-flex align-items-center" id="headingThree">
                                 <h4 data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" class="m-0">View topics</h4>
                                 <button type="button" class="btn btn-common-transparent bg-transparent ms-4">Take test</button>
                              </div>
                           </div>
                           <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                              <div class="accordion-body ps-0 pe-0 pt-4">
                                                 <div class="testslider owl-carousel owl-theme">
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box selectbox">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn btn-common-green">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="exam-box">
                                             <div class="exambox-heading d-flex align-items-center justify-content-between pb-3">
                                                <p>Basics of 3D Ge...</p>
                                                <h2>Proficiency : <span>65%</span></h2>
                                             </div>
                                             <div class="topic_score_bar mb-3">
                                                <div class="progress">
                                                   <div class="progress-bar examE" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examA" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examC" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                   <div class="progress-bar examK" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                             </div>
                                             <div class="exam-cate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                   <a href="javascript:void(0)">E</a>
                                                   <a href="javascript:void(0)">A</a> 
                                                   <a href="javascript:void(0)">C</a> 
                                                   <a href="javascript:void(0)">K</a> 
                                                </div>
                                                <button class="btn btn-common-transparent bg-transparent">Select</button>
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
                  <div id="qq2" class=" tab-pane">
                     A
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
</div>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $('.testslider').owlCarousel({
            stagePadding: 0,
            loop: false,
            margin: 15,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                    stagePadding: 40,
                    margin: 5,
                    loop: true,
                },
                700: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 4
                }
                

            }
        })
    </script>
</body>
@endsection