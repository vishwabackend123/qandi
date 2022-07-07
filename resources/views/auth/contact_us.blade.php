
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
      <div class="contacrus_page_wrapper">
         <div class="contactus_customer_support_text">Customer Support</div>
         <div class="contactus_customer_support_text_under_text">Do you need assistance with your Q& I service or product?<br>We will get you assistance you require.</div>
         <div class="contactus_free_get_need">Toll Free</div>
         <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M10 6.667 13.333 10 10 13.333" stroke="#1F1F1F" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.667 2.667v4.666A2.667 2.667 0 0 0 5.333 10h8" stroke="#1F1F1F" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="contactus_free_get_need_span">0120-4511500</span>
         </div>
         <div class="contactus_free_get_need">Get in touch</div>
         <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M10 6.667 13.333 10 10 13.333" stroke="#1F1F1F" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.667 2.667v4.666A2.667 2.667 0 0 0 5.333 10h8" stroke="#1F1F1F" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="contactus_free_get_need_span">Mail us</span>
         </div>
         <div class="contactus_free_get_need">Need to tell us something?</div>
         <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M10 6.667 13.333 10 10 13.333" stroke="#1F1F1F" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.667 2.667v4.666A2.667 2.667 0 0 0 5.333 10h8" stroke="#1F1F1F" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="contactus_free_get_need_span">Chat with us</span>
         </div>
         <div class="contectus_bottom_img_svg">
            <svg xmlns="http://www.w3.org/2000/svg" width="330" height="326" viewBox="0 0 330 326" fill="none">
            <circle cx="12" cy="150" r="12" fill="#56B663"/>
            <circle cx="318" cy="61" r="12" fill="#CDE3D0"/>
            <circle cx="318" cy="224" r="12" fill="#CDE3D0"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M70 85c-5.523 0-10 4.477-10 10v44.333L49 150h139c5.523 0 10-4.477 10-10V95c0-5.523-4.477-10-10-10H70z" fill="#56B663"/>
            <rect x="77" y="99" width="80" height="8" rx="4" fill="#CDE3D0"/>
            <rect x="77" y="118" width="42" height="8" rx="4" fill="#CDE3D0"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M260 170c5.523 0 10 4.477 10 10v44.333L281 235H142c-5.523 0-10-4.477-10-10v-45c0-5.523 4.477-10 10-10h118z" fill="#CDE3D0"/>
            <rect width="80" height="8" rx="4" transform="matrix(-1 0 0 1 226 184)" fill="#56B663"/>
            <rect width="42" height="8" rx="4" transform="matrix(-1 0 0 1 188 203)" fill="#56B663"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M260 0c5.523 0 10 4.477 10 10v44.333L281 65h-73c-5.523 0-10-4.477-10-10V10c0-5.523 4.477-10 10-10h52z" fill="#CDE3D0"/>
            <rect width="26" height="8" rx="4" transform="matrix(-1 0 0 1 237 14)" fill="#56B663"/>
            <rect width="42" height="8" rx="4" transform="matrix(-1 0 0 1 253 33)" fill="#56B663"/>
            <circle cx="12" cy="314" r="12" fill="#56B663"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M70 249c-5.523 0-10 4.477-10 10v44.333L49 314h62c5.523 0 10-4.477 10-10v-45c0-5.523-4.477-10-10-10H70z" fill="#56B663"/>
            <circle cx="78" cy="272" r="4" fill="#CDE3D0"/>
            <circle cx="78" cy="289" r="4" fill="#CDE3D0"/>
            <path d="M91.5 293.198c0 1.547 1.266 2.829 2.785 2.532A14.505 14.505 0 0 0 106 281.5a14.5 14.5 0 0 0-11.715-14.23c-1.519-.297-2.785.985-2.785 2.532 0 1.548 1.285 2.76 2.756 3.24a8.894 8.894 0 0 1 3.534 14.748c-1 1-2.214 1.738-3.534 2.168-1.471.48-2.756 1.692-2.756 3.24z" fill="#CDE3D0"/>
            </svg>
         </div>
      </div>
   </div>
</div>
   
@endsection