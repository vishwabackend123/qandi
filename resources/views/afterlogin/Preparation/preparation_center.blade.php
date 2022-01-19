@extends('afterlogin.layouts.app_new')

@php
$userData = Session::get('user_data');
@endphp


@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->

    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="row preparation">
                <div class="col-lg-12  p-lg-5 pt-none">

                    <div class="tab-wrapper">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                @php $subx=1; @endphp
                                @if(isset($aPreparation) && !empty($aPreparation))
                                @foreach($aPreparation as $sub)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($subx==1) active @endif" id="{{$sub->subject_name}}-tab" data-bs-toggle="tab" href="#{{$sub->subject_name}}" role="tab" aria-controls="{{$sub->subject_name}}" aria-selected="true">{{$sub->subject_name}}</a>
                                </li>

                                @php $subx++; @endphp
                                @endforeach
                                @endif

                            </ul>
                        </div>
                        <!--scroll-mobile-->
                        <div class="tab-content cust-tab-content pt-4" id="myTabContent">
                            @php $topx=1;@endphp
                            @if(isset($aPreparation) && !empty($aPreparation))
                            <?php
                            $pres = 0;
                            $notes = 0;
                            $video = 0;
                            $bmark = 0;
                            ?>
                            @foreach($aPreparation as $oSub)
                            @foreach($oSub->values as $val)
                            <?php
                            $pres += $val->Presentations;
                            $notes += $val->Notes;
                            $video += $val->Videos;
                            $bmark += $val->Bookmarks;
                            ?>
                            @endforeach
                            <div class="tab-pane fade show @if($topx==1) active @endif" id="{{$oSub->subject_name}}" role="tabpanel" aria-labelledby="{{$oSub->subject_name}}-tab">


                                <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                                    <span class="mr-3 name-txt">{{$oSub->subject_name}}</span>

                                    <span class="p-icons">
                                        <a href="javascript:void(0);" title="Presentation" onclick="get_preparationSubjectData('{{$oSub->subject_id}}','presentation')"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"><span>{{$pres}}</span></a>
                                        <a href="javascript:void(0);" title="Notes" onclick="get_preparationSubjectData('{{$oSub->subject_id}}','notes')"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"><span>{{$notes}}</span></a>
                                        <a href="javascript:void(0);" title="Videos" onclick="get_preparationSubjectData('{{$oSub->subject_id}}','videos')"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"><span>{{$video}}</span></a>
                                        <a href="javascript:void(0);" title="Bookmarks" onclick="get_preparationSubjectData('{{$oSub->subject_id}}','bookmark')"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"><span>{{$bmark}}</span></a>
                                    </span>
                                </div>
                                <div class="scroll-div">
                                    @foreach( $oSub->values as $val)
                                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                                        <span class="mr-3 name-txt">{{$val->chapter_name}}</span>

                                        <span class="p-icons">
                                            <a href="javascript:void(0);" title="Presentation" onclick="get_chapter_wise_data('{{$val->chapter_id}}', 'presentations')"><img src="{{URL::asset('public/after_login/images/Group3081@2x.png')}}"><span>{{$val->Presentations}}</span></a>
                                            <a href="javascript:void(0);" title="Notes" onclick="get_chapter_wise_data('{{$val->chapter_id}}', 'notes')"><img src="{{URL::asset('public/after_login/images/Group3082.png')}}"><span>{{$val->Notes}}</span></a>
                                            <a href="javascript:void(0);" title="Videos" onclick="get_chapter_wise_data('{{$val->chapter_id}}', 'videos')"><img src="{{URL::asset('public/after_login/images/Group3083.png')}}"><span>{{$val->Videos}}</span></a>
                                            <a href="javascript:void(0);" title="Bookmarks" onclick="get_chapter_wise_data('{{$val->chapter_id}}', 'bookmarks')"><img src="{{URL::asset('public/after_login/images/Group3084.png')}}"><span>{{$val->Bookmarks}}</span></a>
                                        </span>



                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            @php $topx++;
                            $pres = 0;
                            $notes = 0;
                            $video = 0;
                            $bmark = 0;
                            @endphp
                            @endforeach
                            @endif

                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--row-->
    </div>
</div>


<div class="modal fade" id="PreparationCenter_modal" tabindex="-1" aria-labelledby="PreparationCenter_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="PreparationCenter_modal_body" class="modal-body pt-0 px-5">

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

            </div>

        </div>
    </div>
</div>
@include('afterlogin.layouts.footer_new')

<script>
    $('.scroll-div').slimscroll({
        height: "50vh",
    });
    $(".modal .h-scroll-slim").slimscroll({
        height: "80vh",
    });

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

    function get_chapter_wise_data(chapter_id, type) {
        url = "{{ url('get_chapter_wise_data/') }}";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                chapter_id: chapter_id,
                type: type
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
</script>
@endsection