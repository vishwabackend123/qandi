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
         <div class="col-xl-8">
            <div class="bg-white planner-box">
               <div class="d-flex align-items-center justify-content-between planner-title pb-3 mb-1">
                  <h1>Planner</h1>
                  <button class="btn btn-common-green disabled">Save Test</button>
               </div>
               <h2 class="week-select pb-3">Select a week</h2>
               <div class="row">
                  <div class="col-lg-4">
                     <div class="planner-date"> 
                        <label>Start Date</label>
                        <input type="date" class="form-control">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="planner-date"> 
                        <label>End Date</label>
                        <input type="date" class="form-control">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="exam-select">
                        <span class="week-select d-block position-relative">Select exams per week</span>
                        <div class="d-flex lign-items-center incre-decre-value">
                           <div class="value-button border-right radius-left" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                           <input type="text" id="number" value="0" />
                           <div class="value-button border-left radius-right" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                        </div>
                     </div>
                  </div>
               </div>
              <p class="chapter-error pt-2 mb-0">
   <svg class="align-middle" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M10 18.333a8.333 8.333 0 1 0 0-16.666 8.333 8.333 0 0 0 0 16.666zM10 6.667V10M10 13.333h.008" stroke="#FB7686" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
   </svg>
   &nbsp; You cannot select more than 7 chapters for selected week.
</p>
<h2 class="week-select pb-3 pt-5">Select Chapters</h2>
<div class="d-flex align-items-center justify-content-between add-chapter position-relative">
   <p class="m-0">Mathematics</p>
   <label class="m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <svg class="position-relative" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M10 4.167v11.666M4.167 10h11.666" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      &nbsp; Add chapters
   </label>
   <div class="d-flex align-items-center add-subchapter">
      <div class="add-insubchapter mr-3">
         <p class="m-0">
            Binomial Theorem&nbsp; 
            <svg width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g clip-path="url(#h7dsf4yzaa)" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.25 3v4.5h-4.5M.75 15v-4.5h4.5"/>
                  <path d="M2.632 6.75A6.75 6.75 0 0 1 13.77 4.23l3.48 3.27m-16.5 3 3.48 3.27a6.75 6.75 0 0 0 11.137-2.52"/>
               </g>
               <defs>
                  <clipPath id="h7dsf4yzaa">
                     <path fill="#fff" d="M0 0h18v18H0z"/>
                  </clipPath>
               </defs>
            </svg>
            <svg width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="m13.5 4.5-9 9M4.5 4.5l9 9" stroke="#FB7686" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
         </p>
      </div>
      <div class="add-insubchapter">
         <p class="m-0">
            Complex Numbers&nbsp; 
            <svg width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g clip-path="url(#h7dsf4yzaa)" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.25 3v4.5h-4.5M.75 15v-4.5h4.5"/>
                  <path d="M2.632 6.75A6.75 6.75 0 0 1 13.77 4.23l3.48 3.27m-16.5 3 3.48 3.27a6.75 6.75 0 0 0 11.137-2.52"/>
               </g>
               <defs>
                  <clipPath id="h7dsf4yzaa">
                     <path fill="#fff" d="M0 0h18v18H0z"/>
                  </clipPath>
               </defs>
            </svg>
            <svg width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="m13.5 4.5-9 9M4.5 4.5l9 9" stroke="#FB7686" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
         </p>
      </div>
   </div>
</div>
<div class="d-flex align-items-center justify-content-between add-chapter">
   <p class="m-0">Physics</p>
   <label class="m-0">
      <svg class="position-relative" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M10 4.167v11.666M4.167 10h11.666" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      &nbsp; Add chapters
   </label>
</div>
<div class="d-flex align-items-center justify-content-between add-chapter">
   <p class="m-0">Chemistry</p>
   <label class="m-0">
      <svg class="position-relative" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M10 4.167v11.666M4.167 10h11.666" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      &nbsp; Add chapters
   </label>
</div>
</div>
</div>
<div class="col-xl-4">
  <div class="bg-white clander-box">
 <h1 class="Calendar-title pb-4 mb-3">Calendar</h1>      
 <div class="calendar-wrapper" id="calendar-wrapper"></div>
 <div class="pt-5 mt-5">
  <button class="btn btn-common-green disabled w-100">Save Test</button>    
  </div>
    </div>        
  </div>
</div>
</div>
</section>
</div>    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content custom_modal">
      <div class="modal-header border-0 p-0">
        <h5 class="modal-title pb-3 mb-1" id="exampleModalLabel">Mathematics</h5>
        <button type="button" class="btn-close border-0 bg-transparent" data-bs-dismiss="modal" aria-label="Close"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M18 6 6 18M6 6l12 12" stroke="#1F1F1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></button>
      </div>
      <div class="modal-body p-0">
        <div class="custom-input pb-5 mb-5">
                     <label>Select Chapters</label>
                     <select class="form-control selectdata">
                        <option class="we">Type Chapters</option>
                        <option class="we2">Math</option>
                        <option>Apple</option>
                     </select>
                  </div>
      </div>
        <div class="text-right addtestbtn">
        <button type="button" class="btn btn-common-green"><svg class="position-relative" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10.5 4.167v11.666M4.667 10h11.666" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>&nbsp; Add to test</button>
    </div>
    </div>
  </div>
</div>
<script>
   function increaseValue() {
     var value = parseInt(document.getElementById('number').value, 10);
     value = isNaN(value) ? 0 : value;
     value++;
     document.getElementById('number').value = value;
   }
   
   function decreaseValue() {
     var value = parseInt(document.getElementById('number').value, 10);
     value = isNaN(value) ? 0 : value;
     value < 1 ? value = 1 : '';
     value--;
     document.getElementById('number').value = value;
   }    
       
</script>    
    <script type="text/javascript">
      var config = `
function selectDate(date) {
  $('#calendar-wrapper').updateCalendarOptions({
    date: date
  });
  console.log(calendar.getSelectedDate());
}

var defaultConfig = {
  weekDayLength: 1,
  date: '08/05/2021',
  onClickDate: selectDate,
  showYearDropdown: true,
  startOnMonday: false,
};

var calendar = $('#calendar-wrapper').calendar(defaultConfig);
console.log(calendar.getSelectedDate());
`;
      eval(config);
      const flask = new CodeFlask('#editor', { 
        language: 'js', 
        lineNumbers: true 
      });
      flask.updateCode(config);
      flask.onUpdate((code) => {
        try {
          eval(code);
        } catch(e) {}
      });
    </script>
</body>
@endsection