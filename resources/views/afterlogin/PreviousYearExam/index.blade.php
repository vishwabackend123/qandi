@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
<style>
    .topic_selected {
        background-color: #5bc3ff !important;
        color: #ffffff !important;
    }
    .noHover{
        pointer-events: none;
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
        <div class="container-fluid previous_year_exam_page">
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
                    <div class="result-list tab-wrapper live-exam">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link all_div active" id="open-tab" data-bs-toggle="tab" href="#open" role="tab" aria-controls="open" aria-selected="true">Previous year exam</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link all_div" id="pre_attempted-tab" data-bs-toggle="tab" href="#pre_attempted" role="tab" aria-controls="attempted" aria-selected="true">Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <!--scroll-mobile-->
                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">
                                <div class="exam_attempted_common_page">
                                    <div class="year_filter  p-3 mt-1 mb-3">
                                        <label style="font-weight:600;font-size: 18px;">Test your preparedness with Past year exam papers </label>
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
                                    @if(!empty($upcomming_live_exam))
                                    <div class="previous_year_exam_lists">
                                        @foreach($upcomming_live_exam as $sche)
                                        <div class="compLeteS filter_data_{{$sche->paper_year}}">
                                            <div class="ClickBack d-md-flex align-items-center justify-content-between bg-white   listing-details w-100 flex-wrap result-list-table">
                                                <div class="d-flex align-items-start justify-content-between result-list-head">
                                                    <h4 class="m-lg-0 p-0"> {{$sche->paper_name}}
                                                    </h4>
                                                    <p class="m-0 ps-4">{{$sche->paper_year}}</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center morning-slot">
                                                    <!--span style="font-weight:500;">Evening Slot</span-->
                                                    <span class="slbs-link ms-lg-5 ms-2">
                                                        <a class="expand-custom expandTopicCollapseAttempt" aria-controls="chapter_{{$sche->paper_id}}" data-bs-toggle="collapse" href="#chapter_{{$sche->paper_id}}" role="button" aria-expanded="true" value="Expand to Topics" id="clicktopic_{{$sche->paper_id}}">
                                                            <span class="hideallexpend" id="expand_topic_{{$sche->paper_id}}" data-id="chapter_{{$sche->paper_id}}">
                                                                <i class="fa fa-arrow-down"></i>
                                                                Show Details
                                                            </span>
                                                        </a>
                                                    </span>
                                                </div>
                                                @if($sche->test_completed_yn == 'N')
                                                <div class="result-list-btns">
                                                    <form class="form-horizontal ms-auto mb-0" action="{{route('previousYearExam')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="paper_name" value="{{$sche->paper_name}}" />
                                                        <input type="hidden" name="paper_id" value="{{$sche->paper_id}}" />
                                                        <button class="custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> TAKE TEST</button>
                                                    </form>
                                                </div>
                                                @else
                                                <div class="result-list-btns">
                                                    <button class="custom-btn-gray noHover disabled" disabled></i> Attempted</button>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="collapse" id="chapter_{{$sche->paper_id}}">
                                                <div class="p-4 pb-4 d-md-flex justify-content-between full-syllabus">
                                                    <div class="d-flex justify-content-between  paper-summery pe-3">
                                                        <div class="paper-sub">
                                                            <small>No. Of Questions</small>
                                                            <span>{{$sche->total_ques}} MCQ <b style="font-weight:normal;">Questions</b></span>
                                                        </div>
                                                        <div class="paper-sub">
                                                            <small>Duration</small>
                                                            <span>{{$sche->test_duration}} <b style="font-weight:normal;">Mins</b></span>
                                                        </div>
                                                        <div class="paper-sub">
                                                            <small>Marks</small>
                                                            <span>{{$sche->total_marks}}</span>
                                                        </div>
                                                        <div class="paper-sub">
                                                            <small>Subjects</small>
                                                            @php
                                                            $subject_list = implode(',',array_column($sche->subjects, 'subject_name'));
                                                            @endphp
                                                            <span style="word-break: keep-all;">{{$subject_list}}</span>
                                                        </div>
                                                    </div>
                                                    <!--div class="score-show text-md-center ps-3">
                                                        <div class="paper-sub">
                                                            <p style="font-size:14px;text-align:left;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                                <br /><br /> <span style="font-size:14px;">Time Slots : Morning Slot</span></p>
                                                        </div>
                                                    </div-->
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class="row text-center p-4">
                                        <h5>No series available.</h5>
                                    </div>
                                    @endif
                                </div>
                                <!-- <div class="">
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
                                </div> -->
                            </div>
                            <div class="tab-pane fade" id="pre_attempted" role="tabpanel" aria-labelledby="attempted-tab">
                                @include('afterlogin.TestSeries.attempted_result_list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loader-block" style="display:none;">
    <img src="{{URL::asset('public/after_login/new_ui/images/loader.gif')}}">
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
    $('#pre_attempted-tab').click(function() {
        url = "{{ url('ajax_exam_result_list') }}/PreviousYear";
        $.ajax({
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            beforeSend: function() {
                $('.loader-block').show();
            },
            success: function(data) {
                $('.loader-block').hide();
                $("#pre_attempted").show();
                $('#pre_attempted').html(data.html);
                $('#testTypeDiv').attr("style", "display: none !important");

            },
            error: function(data, errorThrown) {
                $('.loader-block').hide();
                $('#testTypeDiv').attr("style", "display: none !important");
            }
        });
    });
});

</script>
<style>
.newelement {
    background: white !important;
    border-radius: 21px;
    border: 6px solid #f2f2f2;
    margin-top: 14px;
}

.newelement form {
    margin-bottom: 0px;
}

.newelement button#dropdownMenuLink-topic {
    margin-top: 0px;
}

.clear_div {
    justify-content: end;
}

.custom-page #myTabContent .dropdown ul.dropdown-menu.cust-dropdown.show {
    top: calc(100% - 35px) !important;
    right: 0px !important;
}

.clear_div .dropdown {
    margin-left: 20px;
}

.clear-filter {
    color: #21ccff;
    font-size: 16px;
    padding-left: 13px;
}

/*******06-04-2022*****/
.result-list-table {
    background: #f6f9fd;
    border-radius: 15px;
}

.result-list-table .result-list-head {
    flex: 2;
}

.result-list-head h4 {
    color: #231f20;
    font-size: 16px;
    font-weight: 600;
    flex: 1;
}

.result-list-head p {
    color: #231f20;
    font-size: 15px;
    font-weight: 600;
}

.morning-slot {
    flex: 2;
}

.morning-slot p {
    color: #231f20;
    font-size: 14px;
    font-weight: 600;
}

.result-list-btns {
    flex: 1;
}

.result-list-btns a {
    line-height: 37px;
    height: 48px;
    text-align: center;
    display: block;
    background: #f4f4f4;
    border-radius: 10px;
}

.result-list-btns a .fa {
    font-size: 17px;
    line-height: 48px;
}

.result-review {
    height: 48px;
    background: #f4f4f4;
    border-radius: 10px;
    color: #515151 !important;
    font-size: 16px;
    width: 75%;
}

.score-show {
    flex: 3;
    border-right: 1px solid #b9b9b9;
}

.score-show p {
    color: #231f20;
    font-size: 16px;
    font-weight: 600;
}

.score-show p span {
    color: #00baff;
}

.result-analysis {
    background: #13c5ff;
    background-color: #13c5ff;
    border-color: #13c5ff;
    -webkit-box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    -moz-box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    box-shadow: inset 0 3px 10px 0 rgb(255 255 255 / 80%);
    font-size: 14px;
    font-weight: 600;
    line-height: 32px;
    border-radius: 20px;
    height: 45px;
    width: 208px;
    border: 0;
}

.paper-summery {
    flex: 5;
}

.paper-sub {
    font-size: 13px;
    flex: 1;
    word-break: break-all;
}

.paper-sub span {
    color: #00baff;
    font-size: 14px;
    font-weight: 600;
}

.paper-sub small {
    display: block;
    color: #231f20;
    font-size: 13px;
    font-weight: 600;
}

.result-list-table .slbs-link a {
    font-size: 14px;
    font-weight: 600;
}

</style>
@endsection
