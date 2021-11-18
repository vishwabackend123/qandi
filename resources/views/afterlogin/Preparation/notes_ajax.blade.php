<div class="main-center">
    <h2>{{$values->chapter_name}}</h2>
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

            <span class="me-1"><a href="javascript:void(0);" data-bs-toggle="modal"
                                  data-bs-target="#PreparationCenter_modal"><img
                        src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> {{$values->Presentations}}</a></span>
            <span class="me-1"><a href="javascript:void(0);"
                                  class="bg-light-red link-dark py-3 px-2 d-inline-block"><img
                        src="{{URL::asset('public/after_login/images/Group3082.png')}}"> {{$values->Notes}}</a></span>
            <span class="me-1"><a href="javascript:void(0);"><img
                        src="{{URL::asset('public/after_login/images/Group3083.png')}}"> {{$values->Videos}}</a></span>
            <span><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> {{$values->Bookmarks}}</a></span>

        </div>
    </div>
    <div class="h-scroll-slim">
        @if(!empty($preparation_list))
            @foreach($preparation_list as $pre)
                <div class="d-flex bg-white p-3 align-items-center mt-5">
                    <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon6.svg')}}"/></span>
                    <div>
                        <p class="text-danger m-0 pb-1">{{$pre->resource_name}}</p>
                        <p>{!! $pre->resource_desc !!}</p>
                        <a href="{{"https://student-resource.s3.ap-south-1.amazonaws.com/". $pre->resource_file }}" target="_blank" > click me to Notes </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="d-flex bg-white p-3 align-items-center mt-5">
                No Presentations available;
            </div>
        @endif

    </div>
</div>
