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
                                        <form>
                                            <div class="sub-filter-type">
                                                <select class="selectpicker select select_filter" data-show-subtext="false" data-live-search="true">
                                                    <option value="" selected>Select Test</option>
                                                    <option value='Assessment'>Assessment</option>
                                                    <option value='Mocktest'>Mocktest</option>
                                                    <option value='Test-Series'>Test-Series</option>
                                                </select>
                                            </div>
                                            <!--div class="sub-search">
                                                <div class="input-group">
                                                    <input type="search" placeholder="What're you searching for?" aria-describedby="button-addon1" class="form-control">
                                                <div class="input-group-append">
                                                    <button id="button-addon1" type="submit" class=" "><i class="fa fa-search"></i></button>
                                                </div>
                                                </div>
                                            </div-->
                                        </form>
                                    </div>
                                </div>
                                <div class="scroll-div-live-exm pb-0 mb-3" id="pagingBox">
                                    @include('afterlogin.ExamViews.result_list')
                                </div>
                                <div class="pagination">
                                    <div id='page_navigation'></div>
                                    <div id="page_navigation">
                                        <a class="previous_link" href="javascript:void(0);">Prev</a>
                                        <a class="page_link first_class" href="javascript:void(0);" longdesc="0">1</a>
                                        <a class="page_link second_class" href="javascript:void(0);" longdesc="1">2</a>
                                        <a class="next_link" href="javascript:void(0);">Next</a>
                                    </div>
                                </div>
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
    $('.first_class').addClass('active_page');
    getExamResultData(1);
    $('.second_class').click(function() {
        $(this).addClass('active_page');
        $('.first_class').removeClass('active_page');
        $('.previous_link').removeClass('active_page');
        $('.next_link').removeClass('active_page');
        getExamResultData(2);
    });
    $('.first_class').click(function() {
        $(this).addClass('active_page');
        $('.second_class').removeClass('active_page');
        $('.previous_link').removeClass('active_page');
        $('.next_link').removeClass('active_page');
        getExamResultData(1);
    });
    $('.previous_link').click(function() {
        var page_no = parseInt($('#current_page').val() - 1);
        if (page_no > 0) {
            getExamResultData(page_no);
            $(this).addClass('active_page');
            $('.second_class').removeClass('active_page');
            $('.first_class').removeClass('active_page');
            $('.next_link').removeClass('active_page');
        }


    });
    $('.next_link').click(function() {
        $(this).addClass('active_page');
        $('.second_class').removeClass('active_page');
        $('.first_class').removeClass('active_page');
        $('.previous_link').removeClass('active_page');
        var current_page = $('#current_page').val();
        var page_no = parseInt(current_page) + 1;
        getExamResultData(page_no);
    });

    function getExamResultData(page_no) {
        $('.loader-block').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('get_exam_result_data') }}/" + page_no,
            type: 'GET',
            success: function(data) {
                $('.loader-block').hide();
                $('#pagingBox').html(data.html);
            },
        });
    }
    $('.select_filter').change(function(){
       var  filter_val = $(this).val();
       

    });
});

</script>
@endsection
