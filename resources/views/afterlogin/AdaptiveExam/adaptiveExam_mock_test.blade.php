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
        <div class="container-fluid custom-page mocktest-attempted-wrapper">
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
                                    <a class="nav-link all_div active" id="mocktest-tab" data-bs-toggle="tab" href="#mocktest" role="tab" aria-controls="mocktest" aria-selected="true">MOCK TEST</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link all_div" id="attempted-tab" data-bs-toggle="tab" href="#attempted" role="tab" aria-controls="attempted" aria-selected="true">Attempted</a>
                                </li>
                            </ul>
                        </div>
                        <!--scroll-mobile-->
                        <div class="tab-content cust-tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="mocktest" role="tabpanel" aria-labelledby="mocktest-tab">
                                <div class="exam_card">
                                    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
                                        <h2 class="mb-4">{{isset($exam_name)?$exam_name:'Full Body Scan Test'}}</h2>
                                        <button class="custom-btn-gray" id="take_test"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> TAKE TEST</button>
                                    </div>
                                    <div class="d-md-flex justify-content-between flex-wrap">
                                        <div class="mb-2">
                                            <span class="d-block" style=" font-weight: normal;color: #2c3348;font-size: 14px;">No. Of Questions</span>
                                            <label style=" font-weight: 600;color: #231f20;">{{$questions_count}} Questions</label>
                                        </div>
                                        <div class="mb-2">
                                            <span class="d-block" style=" font-weight: normal;color: #2c3348;font-size: 14px;">Marks</span>
                                            <label style=" font-weight: 600;color: #231f20;">{{$total_marks}} Marks</label>
                                        </div>
                                        <div class="mb-2">
                                            <span class="d-block" style=" font-weight: normal;color: #2c3348;font-size: 14px;">Duration</span>
                                            <label style=" font-weight: 600;color: #231f20;">{{$exam_fulltime}} Minutes</label>
                                        </div>
                                        <div class="mb-2">
                                            <span class="d-block" style=" font-weight: normal;color: #2c3348;font-size: 14px;">Subject</span>
                                            <label style=" font-weight: 600;color: #231f20;">{{$tagrets}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="attempted" role="tabpanel" aria-labelledby="attempted-tab">

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
        $('a.expandTopicCollapse span').click(function() {
            var spanId = this.id;
            var curr_text = $("#" + spanId).text();
            var updatetext = ((curr_text == 'Hide Details') ? 'Show Details' : 'Hide Details');
            $("#" + spanId).text(updatetext);
        });
        $(window).on('load', function() {
            $(".dash-nav-link a:first-child").removeClass("active-navlink");
            $(".dash-nav-link a:nth-child(2)").addClass("active-navlink");
        });
    </script>
    <script>
        $("body").on("click", ".expandTopicCollapse", function(event) {
            $(this).parents('.ClickBack').toggleClass('newelement');
        });
        $('#take_test').click(function() {
            var url = "{{ route('mockExam') }}";
            window.location.href = url;
        });
        $('#attempted-tab').click(function() {
            $('.loader-block').show();
            url = "{{ url('ajax_exam_result_list') }}/Mocktest";
            $.ajax({
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function() {

                },
                success: function(data) {
                    $('.loader-block').hide();
                    $("#attempted").show();
                    $('#attempted').html(data.html);
                    $('#testTypeDiv').attr("style", "display: none !important");

                },
                error: function(data, errorThrown) {
                    $('.loader-block').hide();
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

        /* @media only screen and (max-width: 1199px) {
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
        } */
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    @endsection