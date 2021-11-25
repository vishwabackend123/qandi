<div class="main-center">
    @php
    $userData = Session::get('user_data');

    $user_id = $userData->id;
    $exam_id = $userData->grade_id;
    @endphp
    <h2>{{$values->subject_name}}</h2>
    <div class="d-flex align-items-center">
        <div>
            <div class="d-flex align-items-center">
                <p class="m-0 pe-3">Proficiency</p>
                <i class="fa fa-star text-secondary mx-2"></i>
                <i class="fa fa-star text-secondary mx-2"></i>
                <i class="fa fa-star text-secondary mx-2"></i>
                <i class="fa fa-star text-light mx-2"></i>
                <i class="fa fa-star text-light mx-2"></i>
            </div>
        </div>
        <div class="ms-auto">

            <span class="me-1"><a href="javascript:void(0);" @if($preType=='presentation' )class="bg-light-red link-dark py-3 px-2 d-inline-block" @endif onclick="get_preparationSubjectData('{{$values->subject_id}}','presentation')"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> {{$values->total_presentations}}</a></span>
            <span class="me-1"><a href="javascript:void(0);" @if($preType=='notes' )class="bg-light-red link-dark py-3 px-2 d-inline-block" @endif onclick="get_preparationSubjectData('{{$values->subject_id}}','notes')"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> {{$values->total_notes}}</a></span>
            <span class="me-1"><a href="javascript:void(0);" @if($preType=='videos' )class="bg-light-red link-dark py-3 px-2 d-inline-block" @endif onclick="get_preparationSubjectData('{{$values->subject_id}}','videos')"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> {{$values->total_videos}}</a></span>
            <span class="me-1"><a href="javascript:void(0);" @if($preType=='bookmark' )class="bg-light-red link-dark py-3 px-2 d-inline-block" @endif onclick="get_preparationSubjectData('{{$values->subject_id}}','bookmark')"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> {{$values->total_bookmarks}}</a></span>

        </div>
    </div>
    <div class="h-scroll-slim">
        @if($preType=='presentation' )
        @if(!empty($preparation_list))
        @foreach($preparation_list as $pre)
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon5.svg')}}" /></span>
            <div>
                <p class="text-danger m-0 pb-1">{{$pre->resource_name}}</p>
                <p>{!! $pre->resource_desc !!}</p>
                <!-- <p class="mt-2 mb-0">36 Slides</p> -->
            </div>
        </div>

        @endforeach
        @else
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            No Presentations available;
        </div>
        @endif
        @elseif($preType=='notes')
        @if(!empty($preparation_list))
        @foreach($preparation_list as $pre)
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon6.svg')}}" /></span>
            <div>
                <p class="text-danger m-0 pb-1">{{$pre->resource_name}}</p>
                <p>{!! $pre->resource_desc !!}</p>
                <!-- <p class="mt-2 mb-0">36 Slides</p> -->
            </div>
        </div>

        @endforeach
        @else
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            No Presentations available;
        </div>
        @endif
        @elseif($preType=='videos')
        @if(!empty($preparation_list))
        @foreach($preparation_list as $pre)
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon8.svg')}}" /></span>
            <div>
                <p class="text-danger m-0 pb-1">{{$pre->resource_name}}</p>
                <p>{!! $pre->resource_desc !!}</p>
            </div>
        </div>

        @endforeach
        @else
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            No Presentations available;
        </div>
        @endif
        @elseif($preType=='bookmark')
        @if(!empty($preparation_list))
        @foreach($preparation_list as $key => $pre)
        <div class="d-flex bg-white p-3  mt-5">
            <span class="px-3">Q{{ $key + 1 }}</span>
            <div>
                <p>{!! $pre->question !!}</p>
            </div>
        </div>
        @endforeach
        <div class="d-flex p-3  mt-3">
            <div style="float: right;">
                <p><a href="{{ route('review_bookmarks') }}">view all</a></p>
            </div>
        </div>
        @else
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            No Bookmark available;
        </div>
        @endif
        @endif

    </div>
</div>