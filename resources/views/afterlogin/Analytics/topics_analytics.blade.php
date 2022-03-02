<div class="topics_breadcum bg-white">
      <div class="d-flex align-items-center mb-4">
         <a href="javascript:void(0);" onclick="backPage()" class="back_page"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0 m-0">
               <li class="breadcrumb-item"><a href="#" class="text-uppercase">{{$subject}}</a></li>
               <li class="breadcrumb-item"><a href="#" class="text-uppercase">Topics</a></li>
            </ol>
         </nav>
      </div>
      <div class="topic-details row m-0">
         @foreach($topicList as $list)
         <div class="col-lg-4" style="margin-bottom: 20px;">
            <div class="bg-white sub-details w-100">
               <div class="d-flex align-items-center justify-content-between sub-title">
                  <h3 class="m-0 p-0" title="{{$list['topic_name']}}"> {{ Illuminate\Support\Str::limit($list['topic_name'], 25, $end='...') }} </h3>
                  <div class="all-star d-flex align-items-center justify-content-between">
                     <ul class="m-0 p-0">
                        <li><img src="{{URL::asset('public/after_login/new_ui/images/fill-star.png')}}" alt="fill-star"></li>
                           <li><img src="{{URL::asset('public/after_login/new_ui/images/fill-star.png')}}" alt="fill-star"></li>
                        <li><img src="{{URL::asset('public/after_login/new_ui/images/fill-star.png')}}" alt="fill-star"></li>
                      <li><img src="{{URL::asset('public/after_login/new_ui/images/gray-star.png')}}" alt="gray-star"></li>
                        <li><img src="{{URL::asset('public/after_login/new_ui/images/gray-star.png')}}" alt="gray-star"></li>
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
         @endforeach
      </div>
   </div>