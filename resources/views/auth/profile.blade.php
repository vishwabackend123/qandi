@extends('layouts.app')
@section('content')
<body class="bg-content">
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
   <section class="all-content ml-5 pb-5">
      <div class="container">
         <div class="row">
            <div class="col-lg-4">
               <div class="info">
                  <h1 class="main-title pb-2">Personal info</h1>
                  <p>Update your personal details here.</p>
               </div>
            </div>
            <div class="col-lg-8">
               <div class="row pt-4">
                  <div class="col-lg-6">
                     <div class="custom-input pb-4">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First Name">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="custom-input pb-4">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="custom-input pb-4">
                        <label>Display Name</label>
                        <input type="text" class="form-control" placeholder="Display Name">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="custom-input pb-4">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Email">
                     </div>
                  </div>
                  <div class="col-lg-6 custom-input pb-4">
                     <label>State</label>
                     <select class="form-control selectdata">
                        <option class="we">Select</option>
                        <option class="we2">Punjab</option>
                        <option>Delhi</option>
                     </select>
                  </div>
                  <div class="col-lg-6 custom-input pb-4">
                     <label>City</label>
                     <select class="form-control selectdata">
                        <option class="we">Select</option>
                        <option class="we2">Punjab</option>
                        <option>Delhi</option>
                     </select>
                  </div>
               </div>
               <hr class="line">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="custom-input pb-4">
                        <label>Mobile</label>
                        <input type="text" maxlength="10" class="form-control bg-transparent" placeholder="Mobile no" value="9034424140">
                     </div>
                  </div>
               </div>
               <hr class="line mb-4">
               <div class="row mb-4">
                  <div class="col-lg-12">
                     <div class="d-flex custom-profileupload">
                        <div class="preview-zone hidden">
                           <div class="box box-solid">
                              <div class="box-body"></div>
                           </div>
                        </div>
                        <div class="dropzone-wrapper w-100">
                           <div class="dropzone-desc text-center">
                              <img src="{{URL::asset('public/after_login/current_ui/images/upload-img.jpg')}}" alt="performance">
                              <p><a href="javascript:void(0);">Click to upload</a> or drag and drop<br> <span>(SVG, PNG, JPG or GIF)</span></p>
                           </div>
                           <input type="file" name="img_logo" class="dropzone">
                        </div>
                     </div>
                  </div>
               </div>
               <hr class="line">
               <div class="d-flex justify-content-end mb-5 pb-4">   
                  <button class="btn cancle mr-2 bg-transparent disabled">Cancle</button>
                  <button class="btn savebtn text-white border-0 ml-1 disabled">Save</button>
               </div>
            </div>
         </div>
        <hr class="line mb-5 pb-4">
          <div class="row">
            <div class="col-lg-4">
               <div class="info">
                  <h1 class="main-title pb-2">Subscription</h1>
                  <p>Beginner • JEE MAIN</p>
               </div>
            </div>
            <div class="col-lg-8 pt-4">
            <div class="bg-white subscription-details">
             <h1 class="subs-heading d-inline-block">JEE MAIN Subscription</h1>
            <hr class="line">
            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
            <h2>Subscription type</h2>
            <h3>JEE 1 year Subscription</h3>
            </div>
            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
            <h2>Price</h2>
            <h3>₹15,000</h3>
            </div>
            <div class="d-flex align-items-center justify-content-between subs-alld mb-3">
            <h2>Active date</h2>
            <h3>20th April 2022</h3>
            </div>
            <div class="d-flex align-items-center justify-content-between subs-alld mb-3 planend">
            <h2>End date</h2>
            <h3>20th April 2023</h3>
            </div>
            <div id="panel">
            <hr class="line">
            <p>JEE-Main, which replaced AIEEE, is for admissions to the National Institutes of Technology (NITs), Indian Institutes of Information Technology (IIITs) and some other colleges designated as "centrally funded technical institutes" (CFTIs).</p>
            </div>
            <div class="flip d-inline-block">Show details</div> <i class="fa fa-angle-right text-success" aria-hidden="true"></i>
                </div>    
              </div>
          </div>
      </div>
   </section>   
   <script>

       
          
   </script>
</body>
@endsection