@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
<style>
    .topic_selected {
        background-color: #5bc3ff !important;
        color: #ffffff !important;
    }
</style>
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper">
        <div class="container-fluid list-series practice-series-lists">
            <div class="row">
                @if(count($errors) > 0 )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="p-0 m-0" style="list-style: none;">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="col-lg-12  p-lg-5 pt-none">
                    <div class="result-list bg-white tab-wrapper live-exam live-exam-custom">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link all_div active" id="Mathematics-tab" data-bs-toggle="tab" href="#attempted" role="tab" aria-controls="attempted" aria-selected="true">Previous year exam</a>
                                </li>
                            </ul>
                        </div>
                        <!--scroll-mobile-->
                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">
                                <div class="year_filter  p-3 mt-1">
                                    <label style="font-weight: 500;color: #6b707f;">Year Filter:</label>
                                    @php
                                    $latest_year = date('Y');
                                    @endphp
                                    <select class="form-control form-select" id="filter_year">
                                        <option value="">Select Year </option>

                                        @if(!empty($years_list))
                                        @foreach($years_list as $yr)
                                        <option value="{{$yr}}">{{$yr}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="">
                                    @if(!empty($upcomming_live_exam))
                                    <div class="scroll-div-live-exm p-4 listing-details pb-0 mb-3 pt-0">
                                        @foreach($upcomming_live_exam as $sche)
                                        <ul class="speci-text compLeteS filter_data_{{$sche->paper_year}}">
                                            <li class="a1TS"> <span class="sub-details">{{$sche->paper_name}}</span>
                                            </li>
                                            <li class="a2TS"><strong>{{$sche->paper_year}}</strong>
                                            </li>

                                            <li class="a4TS">
                                                <form class="form-horizontal ms-auto mb-0" action="{{route('previousYearExam')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="paper_name" value="{{$sche->paper_name}}" />
                                                    <input type="hidden" name="paper_id" value="{{$sche->paper_id}}" />
                                                    <button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> TAKE TEST</button>
                                                </form>
                                            </li>
                                        </ul>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class="row text-center p-4">
                                        <h5>No series available.</h5>
                                    </div>
                                    @endif
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
    $(document).ready(function() {
        $('#filter_year').change(function() {

            var selected_val = $(this).val();
            if (selected_val) {
                $('.compLeteS').hide();
                $('.filter_data_' + selected_val).show();
            } else {
                $('.compLeteS').show();
            }
        });
    });
</script>

@endsection