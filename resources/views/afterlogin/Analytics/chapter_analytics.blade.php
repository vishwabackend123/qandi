<div class="topics_breadcum bg-white">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:void(0);" onclick="backPage()" class="back_page"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item"><a href="#" class="text-uppercase">{{$subject}}</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-uppercase">chapters</a></li>
            </ol>
        </nav>
    </div>
    <div class="topic-details row m-0">
        @foreach($chapterList as $list)
        <div class="col-lg-4" style="margin-bottom: 20px;">
            <div class="bg-white sub-details w-100">
                <div class="d-flex align-items-center justify-content-between sub-title">
                    @php
                    $topicname = Illuminate\Support\Str::limit($list['chapter_name'], 16, $end='...');
                    $topicnametitle = $list['chapter_name'];
                    @endphp
                    <h3 class="m-0 p-0" style="text-transform: none;" title="{{Str::ucfirst(Str::lower($topicnametitle))}}"> {{Str::ucfirst(Str::lower($topicname))}} </h3>
                    <div class="all-star d-flex align-items-center justify-content-between">
                        <ul class="m-0 p-0">
                            @if($list['chapter_score'] >0 && $list['chapter_score'] <= 20 || $list['chapter_score']> 20)
                                <li>
                                    <!-- <img src="{{URL::asset('public/after_login/new_ui/images/fill-star.png')}}" alt="fill-star"> -->
                                    <span class="fill-star-color">★</span>
                                </li>
                                @else
                                <li>
                                    <!-- <img src="{{URL::asset('public/after_login/new_ui/images/gray-star.png')}}" alt="gray-star"> -->
                                    <span class="gray-star-color">★</span>
                                </li>
                                @endif
                                @if($list['chapter_score'] >20 && $list['chapter_score'] <= 40 || $list['chapter_score']> 40)
                                    <li>
                                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/fill-star.png')}}" alt="fill-star"> -->
                                        <span class="fill-star-color">★</span>
                                    </li>
                                    @else
                                    <li>
                                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/gray-star.png')}}" alt="gray-star"> -->
                                        <span class="gray-star-color">★</span>
                                    </li>
                                    @endif
                                    @if($list['chapter_score'] >40 && $list['chapter_score'] <= 60 || $list['chapter_score']> 60)
                                        <li>
                                            <!-- <img src="{{URL::asset('public/after_login/new_ui/images/fill-star.png')}}" alt="fill-star"> -->
                                            <span class="fill-star-color">★</span>
                                        </li>
                                        @else
                                        <li>
                                            <!-- <img src="{{URL::asset('public/after_login/new_ui/images/gray-star.png')}}" alt="gray-star"> -->
                                            <span class="gray-star-color">★</span>
                                        </li>
                                        @endif
                                        @if($list['chapter_score'] >60 && $list['chapter_score'] <= 80 || $list['chapter_score']> 80)
                                            <li>
                                                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/fill-star.png')}}" alt="fill-star"> -->
                                                <span class="fill-star-color">★</span>
                                            </li>
                                            @else
                                            <li>
                                                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/gray-star.png')}}" alt="gray-star"> -->
                                                <span class="gray-star-color">★</span>
                                            </li>
                                            @endif
                                            @if($list['chapter_score'] >80 && $list['chapter_score'] <= 100) <li>
                                                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/fill-star.png')}}" alt="fill-star"> -->
                                                <span class="fill-star-color">★</span>
                                            </li>
                                                @else
                                                <li>
                                                    <!-- <img src="{{URL::asset('public/after_login/new_ui/images/gray-star.png')}}" alt="gray-star"> -->
                                                    <span class="gray-star-color">★</span>
                                                </li>
                                                @endif
                        </ul>
                        <span>{{round($list['chapter_score'])}}%</span>
                    </div>
                </div>
                <div class="colorfull-bars">
                    <div class="d-flex">
                        <span class="green_bar position-relative" style="width:{{$list['K_ques_attempted']}}% !important"></span>
                        <span class="yellow_bar position-relative" style="width:{{$list['C_ques_attempted']}}% !important"></span>
                        <span class="red_bar position-relative" style="width:{{$list['A_ques_attempted']}}% !important"></span>
                        <span class="skyblue_bar position-relative" style="width:{{$list['E_ques_attempted']}}% !important"></span>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between subject-box-expend">            
                <ul class="d-flex align-items-center p-0 m-0 subject-name">
                    <li>K</li>
                    <li>C</li>
                    <li>A</li>
                    <li>E</li>
                </ul>
                @php $chpatername=base64_encode($list['chapter_name']); 
                @endphp
                     <button class="customgray" onclick="expandTopicAnalytics({{$list['chapter_id']}},'{{$subject}}','{{$chpatername}}')">
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4932" width="24" height="24" viewBox="0 0 24 24">
                            <path data-name="Path 11546" d="M0 0h24v24H0z" style="fill:none"></path>
                            <path data-name="Path 11547" d="M4 8V6a2 2 0 0 1 2-2h2" style="stroke:#2c3e50;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                            <path data-name="Path 11548" d="M4 16v2a2 2 0 0 0 2 2h2" style="stroke:#2c3e50;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                            <path data-name="Path 11549" d="M16 4h2a2 2 0 0 1 2 2v2" style="stroke:#2c3e50;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                            <path data-name="Path 11550" d="M16 20h2a2 2 0 0 0 2-2v-2" style="stroke:#2c3e50;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                        </svg>
                        EXPAND</button>
                </div>    
            </div>
        </div>
        @endforeach
    </div>
</div>           