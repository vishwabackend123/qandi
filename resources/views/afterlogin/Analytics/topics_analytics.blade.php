@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper dashboard">
   <!-- End start-navbar Section -->
   @include('afterlogin.layouts.navbar_header_new')
   <!-- End top-navbar Section -->
   <div class="topics_breadcum bg-white">
      <div class="d-flex align-items-center mb-4">
         <a href="javascript:void(0);" class="back_page"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0 m-0">
               <li class="breadcrumb-item"><a href="#" class="text-uppercase">Chemistry</a></li>
               <li class="breadcrumb-item"><a href="#" class="text-uppercase">Chapter: Biomolecules</a></li>
               <li class="breadcrumb-item"><a href="#" class="text-uppercase">Topics</a></li>
            </ol>
         </nav>
      </div>
      <div class="topic-details row m-0">
         <div class="col-lg-4">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0">Basic Biomolecules</h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                     </ul>
                     <span>50%</span>
                  </div>
               </div>
               <div class="colorfull-bars">
                  <div class="d-flex">
                     <span class="green_bar position-relative"></span>
                     <span class="yellow_bar position-relative"></span>
                     <span class="red_bar position-relative"></span>
                     <span class="skyblue_bar position-relative"></span>
                  </div>
               </div>
               <ul class="d-flex align-items-center p-0 m-0 subject-name">
                  <li>K</li>
                  <li>C</li>
                  <li>A</li>
                  <li>E</li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0">Carbon molecules</h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                     </ul>
                     <span>00%</span>
                  </div>
               </div>
               <div class="colorfull-bars">
               </div>
               <ul class="d-flex align-items-center p-0 m-0 subject-name">
                  <li>K</li>
                  <li>C</li>
                  <li>A</li>
                  <li>E</li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0">Basic Biomolecules</h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                     </ul>
                     <span>50%</span>
                  </div>
               </div>
               <div class="colorfull-bars">
                  <div class="d-flex">
                     <span class="green_bar position-relative"></span>
                     <span class="yellow_bar position-relative"></span>
                     <span class="red_bar position-relative"></span>
                     <span class="skyblue_bar position-relative"></span>
                  </div>
               </div>
               <ul class="d-flex align-items-center p-0 m-0 subject-name">
                  <li>K</li>
                  <li>C</li>
                  <li>A</li>
                  <li>E</li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0">Basic Biomolecules-1</h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                     </ul>
                     <span>00%</span>
                  </div>
               </div>
               <div class="colorfull-bars">
               </div>
               <ul class="d-flex align-items-center p-0 m-0 subject-name">
                  <li>K</li>
                  <li>C</li>
                  <li>A</li>
                  <li>E</li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0">Basic Biomolecules</h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                     </ul>
                     <span>50%</span>
                  </div>
               </div>
               <div class="colorfull-bars">
                  <div class="d-flex">
                     <span class="green_bar position-relative"></span>
                     <span class="yellow_bar position-relative"></span>
                     <span class="red_bar position-relative"></span>
                     <span class="skyblue_bar position-relative"></span>
                  </div>
               </div>
               <ul class="d-flex align-items-center p-0 m-0 subject-name">
                  <li>K</li>
                  <li>C</li>
                  <li>A</li>
                  <li>E</li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0">Basic Biomolecules</h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                     </ul>
                     <span>50%</span>
                  </div>
               </div>
               <div class="colorfull-bars">
                  <div class="d-flex">
                     <span class="green_bar position-relative"></span>
                     <span class="yellow_bar position-relative"></span>
                     <span class="red_bar position-relative"></span>
                     <span class="skyblue_bar position-relative"></span>
                  </div>
               </div>
               <ul class="d-flex align-items-center p-0 m-0 subject-name">
                  <li>K</li>
                  <li>C</li>
                  <li>A</li>
                  <li>E</li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0">Basic Biomolecules-4</h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                     </ul>
                     <span>27%</span>
                  </div>
               </div>
               <div class="colorfull-bars">
                  <div class="d-flex">
                     <span class="red_bar position-relative"></span>
                  </div>
               </div>
               <ul class="d-flex align-items-center p-0 m-0 subject-name">
                  <li>K</li>
                  <li>C</li>
                  <li>A</li>
                  <li>E</li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0">Basic Biomolecules-4</h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/fill-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/half-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                        <li><img src="http://localhost/Uniq_web/public/after_login/new_ui/images/gray-star.png"></li>
                     </ul>
                     <span>25%</span>
                  </div>
               </div>
               <div class="colorfull-bars">
                  <div class="d-flex">
                     <span class="yellow_bar position-relative"></span>
                  </div>
               </div>
               <ul class="d-flex align-items-center p-0 m-0 subject-name">
                  <li>K</li>
                  <li>C</li>
                  <li>A</li>
                  <li>E</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->
@endsection