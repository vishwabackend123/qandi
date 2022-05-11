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
        <div class="container-fluid custom-page previousyear-exam-page">
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
                    <div class="result-list bg-white tab-wrapper">
                        <div id="scroll-mobile">
                            <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link all_div active" id="Mathematics-tab" data-bs-toggle="tab" href="#attempted" role="tab" aria-controls="attempted" aria-selected="true">Previous year exam</a>
                                </li>
                            </ul>
                        </div>
                        <!--scroll-mobile-->
                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="attempted" role="tabpanel" aria-labelledby="attempted-tab">
                                <div class="year_filter mb-2 p-3 mt-2">
                                    <label style="font-weight: 600;color: #6b707f;font-size: 15px;">Year Filter:</label>
                                    @php
                                    $latest_year = date('Y');
                                    @endphp
                                    <select class="form-control" id="filter_year">
                                        <option value="">Select Year</option>
                                        <option value="{{$latest_year - 3}}">{{$latest_year - 3}}</option>
                                        <option value="{{$latest_year - 2}}">{{$latest_year -2}}</option>
                                        <option value="{{$latest_year - 1}}">{{$latest_year -1}}</option>
                                        <option value="{{$latest_year}}">{{$latest_year}}</option>
                                    </select>
                                </div>
                                <div class="scroll-div mt-4" id="chapter_list_1">
                                    @if(!empty($result_data))
                                    @foreach($result_data as $sche)
                                    <div class="compLeteS filter_data_{{$sche->paper_year}}" >
                                        <div class="ClickBack d-flex align-items-center justify-content-between bg-white  px-3 py-2 mb-2 listing-details w-100 flex-wrap result-list-table">
                                            <div class="d-flex align-items-start justify-content-between result-list-head">
                                                <h4 class="m-lg-0 p-0">{{$sche->paper_name}} </h4>
                                                <h4 class="m-lg-0 p-0 text-center">{{$sche->paper_year}}</h4>
                                                <h4 class="m-lg-0 p-0" style="color: #21ccff;">{{$sche->paper_code}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="text-center">
                                        <span class="sub-details">No past year exam papaers available right now.</span>
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
    $(document).ready(function(){
        $('#filter_year').change(function(){

            var selected_val=$(this).val();
            if(selected_val)
            {
                $('.compLeteS').hide();
                $('.filter_data_' + selected_val).show();
            }else
            {
               $('.compLeteS').show(); 
            }
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

@media only screen and (max-width: 1199px) {
    .result-list-head h4 {
        font-size: 14px;
    }

    .result-list-head p {
        font-size: 14px;
        flex: 1;
    }
}

@media only screen and (max-width: 991px) {
    .result-list .d-flex.justify-content-between {
        display: flex !important;
    }

    .result-review {
        font-size: 13px;
    }

    .paper-sub small {
        font-size: 12px;
    }

    .paper-sub span {
        font-size: 13px;
    }
}

</style>
@endsection
