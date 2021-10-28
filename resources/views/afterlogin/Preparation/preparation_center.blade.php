@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->

@include('afterlogin.layouts.sidebar')
<div class="main-wrapper">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="tab-wrapper mt-0">
                        <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                            @php $subx=1; @endphp
                            @if(isset($subject_list) && !empty($subject_list))
                            @foreach($subject_list as $sub)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($subx==1) active @endif" id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true">{{$sub->subject_name}}</a>
                            </li>
                            @php $subx++; @endphp
                            @endforeach
                            @endif

                        </ul>

                        <div class="tab-content cust-tab-content" id="myTabContent">
                            @php $topx=1;@endphp
                            @if(isset($subject_list) && !empty($subject_list))
                            @foreach($subject_list as $oSub)
                            @php $subjectData=isset($aPreparation[$oSub->id])?$aPreparation[$oSub->id]:[];
                            $sNotes= $sPrep=$sVideo=$sBmark=0;


                            @endphp

                            @if(isset($subjectData) && !empty($subjectData))
                            @foreach( $subjectData as $oKey=>$oVal)
                            @php

                            if(!empty($oVal->chapter_name)){
                            $sNotes= isset($oVal->Notes)?$sNotes+$oVal->Notes:0;
                            $sPrep=isset($oVal->Presentations)?$sPrep+$oVal->Presentations:0;
                            $sVideo=isset($oVal->Videos)?$sVideo+$oVal->Videos:0;
                            $sBmark=isset($oVal->Bookmarks)?$sBmark+$oVal->Bookmarks:0;
                            }

                            @endphp
                            @endforeach
                            @endif
                            <div class="tab-pane fade show @if($topx==1) active @endif" id="{{$oSub->subject_name}}" role="tabpanel" aria-labelledby="{{$oSub->subject_name}}-tab">
                                <div class="d-flex px-4 mt-4 mb-4 py-3 align-items-center justify-content-between">
                                    <span class=" col-md-6 mr-3 prep-name-txt">{{$oSub->subject_name}}</span>
                                    <div class="col-md-3  d-flex align-items-center">
                                        <span class="me-2"><a href="javascript:void(0);" onclick="get_preparationSubjectData('{{$oSub->id}}','presentation')"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> {{$sPrep}}</a></span>
                                        <span class="me-2"><a href="javascript:void(0);" onclick="get_preparationSubjectData('{{$oSub->id}}','notes')"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> {{$sNotes}}</a></span>
                                        <span class="me-2"><a href="javascript:void(0);" onclick="get_preparationSubjectData('{{$oSub->id}}','videos')"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> {{$sVideo}}</a></span>
                                        <span><a href="javascript:void(0);" onclick="get_preparationSubjectData('{{$oSub->id}}','bookmark')"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> {{$sBmark}}</a></span>
                                    </div>


                                    <div class="col-md-3 d-flex ">
                                        <p class="m-0 pe-3  w140">Overall Proficiency</p>
                                        <span>
                                            <i class="fa fa-star text-success mx-1"></i>
                                            <i class="fa fa-star text-success mx-1"></i>
                                            <i class="fa fa-star text-success mx-1"></i>
                                            <i class="fa fa-star text-secondary mx-1"></i>
                                            <i class="fa fa-star text-secondary mx-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="scroll-div">
                                    @if(!empty($aPreparation[$oSub->id]))
                                    @php $subjectData=$aPreparation[$oSub->id]; @endphp
                                    @foreach( $subjectData as $Key=>$val)

                                    @if(!empty($val->chapter_name))
                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 mt-4 mb-4 py-2 listing-details w-100 flex-wrap  ">
                                        <span class="col-md-6 mr-3 preparation-txt">{{$val->chapter_name}}</span>


                                        <div class="col-md-3  d-flex  align-items-center">
                                            <span class="me-2 flex-column"><a href="javascript:void(0);" onclick="chapter_presentation_resources('{{$val->chapter_id}}','{{json_encode($val)}}')"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> {{$val->Presentations}}</a></span>
                                            <span class="me-2 flex-column"><a href="javascript:void(0);" onclick="chapter_notes_resources('{{$val->chapter_id}}','{{json_encode($val)}}')"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> {{$val->Notes}}</a></span>
                                            <span class="me-2 flex-column"><a href="javascript:void(0);" onclick="chapter_videos_resources('{{$val->chapter_id}}','{{json_encode($val)}}')"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> {{$val->Videos}}</a></span>
                                            <span><a href="javascript:void(0);" onclick="chapter_bookmarks_resources('{{$val->chapter_id}}','{{json_encode($val)}}')"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> {{$val->Bookmarks}}</a></span>
                                        </div>


                                        <div class="col-md-3 d-flex ">
                                            <p class="m-0 pe-3 w140">Proficiency</p>
                                            <span class="">
                                                <i class="fa fa-star text-danger mx-1"></i>
                                                <i class="fa fa-star text-danger mx-1"></i>
                                                <i class="fa fa-star text-secondary mx-1"></i>
                                                <i class="fa fa-star text-secondary mx-1"></i>
                                                <i class="fa fa-star text-secondary mx-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif


                                </div>

                            </div>
                            @php $topx++; @endphp
                            @endforeach
                            @endif

                            <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="PreparationCenter_modal" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="PreparationCenter_modal_body" class="modal-body pt-0 px-5">
                <div class="main-center">
                    <h2>Trigonometry</h2>
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

                            <span class="me-1"><a href="javascript:void(0);" data-bs-toggle="modal" class="bg-light-red link-dark py-3 px-2 d-inline-block" data-bs-target="#PreparationCenter_modal"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                            <span><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>

                        </div>
                    </div>
                    <div class="h-scroll-slim">
                        <div class="d-flex bg-white p-3 align-items-center mt-5">
                            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon5.svg')}}" /></span>
                            <div>
                                <p class="text-danger m-0 pb-1">Presentation on Trigonometry I</p>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr</p>
                                <p class="mt-2 mb-0">36 Slides</p>
                            </div>
                        </div>
                        <div class="d-flex bg-white p-3 align-items-center mt-2">
                            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon5.svg')}}" /></span>
                            <div>
                                <p class="text-danger m-0 pb-1">Presentation on Trigonometry I</p>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr</p>
                                <p class="mt-2 mb-0">36 Slides</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="PreparationCenter_Notes" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="notes_modal_body" class="modal-body pt-0 px-5">
                <div class="main-center">
                    <h2>Trigonometry</h2>
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

                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                            <span class="me-1"><a href="javascript:void(0);" class="bg-light-red link-dark py-3 px-2 d-inline-block"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                            <span><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>

                        </div>
                    </div>
                    <div class="h-scroll-slim">
                        <div class="d-flex bg-white p-3 align-items-center mt-5">
                            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon6.svg')}}" /></span>
                            <div>
                                <p class="text-danger m-0 pb-1">Paper on Trigonometry - I</p>

                                <p class="mt-2 mb-0">JEE-A-QP-PCM-2022</p>
                            </div>
                        </div>
                        <div class="d-flex bg-white p-3 align-items-center mt-2">
                            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon6.svg')}}" /></span>
                            <div>
                                <p class="text-danger m-0 pb-1">Paper on Trigonometry - I</p>

                                <p class="mt-2 mb-0">JEE-A-QP-PCM-2022</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="PreparationCenter_Video" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="videos_modal_body" class="modal-body pt-0 px-5">
                <div class="main-center">
                    <h2>Trigonometry</h2>
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

                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                            <span class="me-1"><a href="javascript:void(0);" class="bg-light-red link-dark py-3 px-2 d-inline-block"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                            <span><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>

                        </div>
                    </div>
                    <div class="h-scroll-slim">
                        <div class="d-flex bg-white p-3 align-items-center mt-5">
                            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon8.svg')}}" /></span>
                            <div>

                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,</p>
                                <p class="mt-2 mb-0">30 mins</p>
                            </div>
                        </div>
                        <div class="d-flex bg-white p-3 align-items-center mt-2">
                            <span class="px-3"><img src="{{URL::asset('public/after_login/images/icon8.svg')}}" /></span>
                            <div>
                                <p class="text-danger m-0 pb-1">Paper on Trigonometry - I</p>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,</p>
                                <p class="mt-2 mb-0">30 mins</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="PreparationCenter_bookmark" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="bookmark_modal_body" class="modal-body pt-0 px-5">
                <div class="main-center">
                    <h2>Trigonometry</h2>
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

                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"> 34</a></span>
                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"> 41</a></span>
                            <span class="me-1"><a href="javascript:void(0);"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"> 28</a></span>
                            <span><a href="javascript:void(0);" class="bg-light-red link-dark py-3 px-2 d-inline-block"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"> 127</a></span>

                        </div>
                    </div>
                    <div class="h-scroll-slim">
                        <div class="d-flex bg-white p-3  mt-5">
                            <span class="px-3">Q1</span>
                            <div>

                                <p>AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>
                                <p class="mt-2 mb-0 text-end">JEE-A-QP-PCM-2022</p>
                            </div>
                        </div>
                        <div class="d-flex bg-white p-3  mt-2">
                            <span class="px-3">Q2</span>
                            <div>

                                <p>AB is an arc of length 42 cm on the circumference of a circle with center O and radius 12 cm. What is the size of angle AOB in radians?</p>
                                <p class="mt-2 mb-0 text-end">JEE-A-QP-PCM-2022</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('afterlogin.layouts.footer')


@endsection
<script>
    function get_preparationSubjectData(subject_id, preType) {
        url = "{{ url('preparation_center_subject/') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                subject_id: subject_id,
                preType: preType,
            },
            success: function(result) {
                console.log(result);
                $('#PreparationCenter_modal_body').html(result);
                $('#PreparationCenter_modal').modal('show');
                $('#PreparationCenter_Video').modal('hide');
                $('#PreparationCenter_Notes').modal('hide');
            }
        });
    }

    function chapter_presentation_resources(chapter_id, values) {
        url = "{{ url('presentations_chapter/') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                chapter_id: chapter_id,
                values: values,
            },
            success: function(result) {
                $('#PreparationCenter_modal_body').html(result);
                $('#PreparationCenter_modal').modal('show');
                $('#PreparationCenter_Video').modal('hide');
                $('#PreparationCenter_Notes').modal('hide');
                $('#PreparationCenter_bookmark').modal('hide');
            }
        });
    }

    function chapter_videos_resources(chapter_id, values) {
        url = "{{ url('videos_chapter/') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                chapter_id: chapter_id,
                values: values,
            },
            success: function(result) {
                $('#videos_modal_body').html(result);
                $('#PreparationCenter_Video').modal('show');
                $('#PreparationCenter_modal').modal('hide');
                $('#PreparationCenter_Notes').modal('hide');
                $('#PreparationCenter_bookmark').modal('hide');
            }
        });
    }

    function chapter_notes_resources(chapter_id, values) {
        url = "{{ url('notes_chapter/') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                chapter_id: chapter_id,
                values: values,
            },
            success: function(result) {
                $('#notes_modal_body').html(result);
                $('#PreparationCenter_Notes').modal('show');
                $('#PreparationCenter_Video').modal('hide');
                $('#PreparationCenter_modal').modal('hide');
                $('#PreparationCenter_bookmark').modal('hide');

            }
        });
    }

    function chapter_notes_resources(chapter_id, values) {
        url = "{{ url('notes_chapter/') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                chapter_id: chapter_id,
                values: values,
            },
            success: function(result) {
                $('#notes_modal_body').html(result);
                $('#PreparationCenter_Notes').modal('show');
                $('#PreparationCenter_Video').modal('hide');
                $('#PreparationCenter_modal').modal('hide');
                $('#PreparationCenter_bookmark').modal('hide');

            }
        });
    }

    function chapter_bookmarks_resources(chapter_id, values) {
        url = "{{ url('bookmarks_chapter') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                chapter_id: chapter_id,
                values: values,
            },
            success: function(result) {
                $('#bookmark_modal_body').html(result);
                $('#PreparationCenter_bookmark').modal('show');
                $('#PreparationCenter_Notes').modal('hide');
                $('#PreparationCenter_Video').modal('hide');
                $('#PreparationCenter_modal').modal('hide');

            }
        });
    }
</script>