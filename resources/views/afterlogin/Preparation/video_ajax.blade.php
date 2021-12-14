<div class="main-center">
    <h2>{{$preparation_list->chapter_name ?? $preparation_list->chapter_name}}</h2>
    <div class="d-flex align-items-center">
        <div>
            <!-- <div class="d-flex align-items-center">
                <p class="m-0 pe-3">Proficiency</p>
                <i class="fa fa-star text-secondary mx-2"></i>
                <i class="fa fa-star text-secondary mx-2"></i>
                <i class="fa fa-star text-secondary mx-2"></i>
                <i class="fa fa-star text-light mx-2"></i>
                <i class="fa fa-star text-light mx-2"></i>
            </div> -->
        </div>
        <div class="ms-auto">
            <span class="me-1"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#PreparationCenter_modal"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}" onclick="get_chapter_wise_data('{{$preparation_list->chapter_id}}','presentations')"> {{$preparation_list->total_presentations}}</a></span>
            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}" onclick="get_chapter_wise_data('{{$preparation_list->chapter_id}}','notes')"> {{$preparation_list->total_notes}}</a></span>
            <span class="me-1"><a href="javascript:void(0);" class="bg-light-red link-dark py-3 px-2 d-inline-block"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}" onclick="get_chapter_wise_data('{{$preparation_list->chapter_id}}','videos')"> {{$preparation_list->total_videos}}</a></span>
            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}" onclick="get_chapter_wise_data('{{$preparation_list->chapter_id}}','bookmarks')"> {{$preparation_list->total_bookmarks}}</a></span>
        </div>
    </div>
    <div class="h-scroll-slim">
        @if(!empty($preparation_list->videos))
        @foreach($preparation_list->videos as $pre)
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon8.svg')}}" /></span>
            <div>
                <p class="text-danger m-0 pb-1">{{$pre->resource_name}}</p>
                <p>{!! $pre->resource_desc !!}</p>
                <a href="{{$pre->resource_link }}" target="_blank"> click me to Video </a>
            </div>
        </div>

        @endforeach
        @else
        <div class="d-flex bg-white p-3 align-items-center mt-5">
            No Video available;
        </div>
        @endif

    </div>
</div>