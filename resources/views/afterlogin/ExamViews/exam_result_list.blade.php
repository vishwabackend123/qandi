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
        <div class="container-fluid list-series">
            <div class="row">
                <div class="col-lg-12  p-lg-5">
                    <div class="tab-wrapper live-exam">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> Result list</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content cust-tab-content  bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="result-list-filter-row">
                                    <h4 class="py-3">Exam Result list</h4>
                                    <div class="sub-filter py-3">
                                        <form >
                                            <div class="sub-filter-type">
                                                <select class="selectpicker select" data-show-subtext="false" data-live-search="true">
                                                    <option disabled selected>Select Test</option>
                                                    <option value='Assessment'>Assessment</option>
                                                    <option value='Mocktest'>Mocktest</option> 
                                                    <option value='Test-Series'>Test-Series</option>
                                                </select>
                                            </div>
                                            <div class="sub-search">
                                                <div class="input-group">
                                                    <input type="search" placeholder="What're you searching for?" aria-describedby="button-addon1" class="form-control">
                                                <div class="input-group-append">
                                                    <button id="button-addon1" type="submit" class=" "><i class="fa fa-search"></i></button>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="scroll-div-live-exm pb-0 mb-3"  id="pagingBox">
                                    @if(!empty($result_data))
                                    @foreach($result_data as $sche)
                                   
                                    <ul class="speci-text">
                                        <li> <span class="sub-details">{{$sche->test_type}}</span>
                                        </li>
                                        <li><strong>Exam Date: {{date('d-m-Y', strtotime($sche->created_at));}}</strong>
                                        </li>
                                        <li><strong>Test Time: {{date('H:i:s', strtotime($sche->created_at));}} </strong>
                                        </li>
                                        <li>{{$sche->no_of_question}} Questions</a>
                                        </li>
                                        <li><a href="{{route('exam_review',$sche->id)}}">
                                                <button class="custom-btn-gray"></i>Exam Result
                                                </button>
                                            </a>
                                        </li>
                                    </ul>
                                    @endforeach
                                    @else
                                    <div class="text-center">
                                        <span class="sub-details">No result history available right now.</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="pagination">
                                <div id='page_navigation'></div>
                                <input type='hidden' id='current_page' />
                                    <input type='hidden' id='show_per_page' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('afterlogin.layouts.footer_new')
<script type="text/javascript">
</script>
@endsection

 

 

    