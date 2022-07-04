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
    <div class="chapter_preficiency_warpper">
        <div class="col-lg-12 fortab">
            <div class="">
                <div class="tabMainblock">
                    <div class="commontab">
                        <div class="tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                <a class="nav-link " data-bs-toggle="tab" href="#overall_analytics">Overall Analytics</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#maths">Maths</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#physics">Physics</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#chemistry">Chemistry</a>
                                </li>
                            </ul>
                        </div>
                        <div class="chapter_profici_nav__right_contant">
                            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Maths</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chapters</li>
                                </ol>
                            </nav>
                            <div class="knowledge_left_clr_with_text_right_div">
                                <div class=" knowledge_left_clr_with_text">
                                    <span class="knowledge_left_clr"></span> <span class="cotogaty_right_text">Knowledge</span>
                                </div>
                                <div class=" knowledge_left_clr_with_text">
                                    <span class="aomprehension_left_clr"></span> <span class="cotogaty_right_text">Comprehension</span>
                                </div>
                                <div class=" knowledge_left_clr_with_text">
                                    <span class="application_left_clr"></span> <span class="cotogaty_right_text">Application</span>
                                </div>
                                <div class=" knowledge_left_clr_with_text">
                                    <span class="evaluation_left_clr"></span> <span class="cotogaty_right_text">Evaluation</span>
                                </div>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="overall_analytics" class="tab-pane">
                                
                            </div>
                            <div id="maths" class="tab-pane active">  
                                <div class="row chapter_of_row_col_paddin_zero">
                                    <div class="col">
                                        <div class="chapter_proficincy_point_anylytics">
                                            <div>Application of Derivatives</div>
                                            <div></div>
                                            <div>
                                                <div><sapn>28%</span> <span>Proficiency</span></div>
                                                <div>Open topics <b>></b></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="chapter_proficincy_point_anylytics">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="chapter_proficincy_point_anylytics">

                                        </div>
                                    </div>
                                </div>                           
                            </div>
                            <div id="physics" class=" tab-pane">
                            </div>
                            <div id="chemistry" class=" tab-pane">
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection