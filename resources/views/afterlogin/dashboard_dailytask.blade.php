@extends('afterlogin.layouts.app_new')

@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<style>
    .dt_sec-1 span{font-weight: 600 !important;}
    .dt_sec-1 span img{max-width: 60px;
    padding-right: 5px;}
   .dtrow-left {background: #f2f2f2c4;
    border-radius: 30px;
    padding: 25px;
    margin: 10px;}
    .dtrow-left .btntheme{width: 100%;
    position: relative;
    top: 57%;}
    .dtrow-right {background: #f2f2f2c4;
    border-radius: 30px;
    padding: 25px;
    margin: 10px;}
    .dtrow-right .btntheme{width: 60%;
    position: relative;
    top: 2%;}

    @media only screen and (max-width: 767px) {
 /*kanchan css*/
 .dt_sec-1 span{font-weight: 600 !important;}
    .dt_sec-1 span img{max-width: 60px;
    padding-right: 5px;}
   .dtrow-left {background: #f2f2f2c4;
    border-radius: 30px;
    padding: 25px;
    margin: 10px;}
    .dtrow-left .btntheme{width: 100%;
    position: relative;
    top: 0%;}
    .dtrow-right {background: #f2f2f2c4;
    border-radius: 30px;
    padding: 25px;
    margin: 10px;}
    .dtrow-right .btntheme{width: 100%;
    position: relative;
    top: 2%;}
    }
 /*kanchan css*/
</style>


<div class="main-wrapper dashboard">

    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper matrixpage-wrapper dashboard-cards-block">
        <div class="container-fluid custom-page">
            <div class="row">
                <div class="col-md-5">
                    <div class="bg-white shadow-lg py-5 myqMatrix-card h-auto dt_sec-1">
                        <span class="progress_text" style="padding-left: 15px;"><img src="{{URL::asset('public/after_login/new_ui/images/daily-task-icon.png')}}"> Task for the Day</span>
                        
                        <div class="row mt-3 dtrow-left">
                            <div class="col-md-6">
                                <p><b>Task 1 - Evaluation Skills</b></p>
                                <p>Sharpen your evaluation skills with this quick curated test</p>
                                <p><span class="text-danger">10</span> Questions | Duration :
                                 <span class="text-danger">15mins</span></p>
                            </div>
                            <div class="col-md-6"><a class="btn btntheme" href="#">TAKE TEST</a></div>
                        </div>

                        <div class="row mt-3 dtrow-left">
                            <div class="col-md-6">
                                <p><b>Task 2 - Time Management</b></p>
                                <p>Work on your time management skills with this test</p>
                                <p><span class="text-danger">10</span> Questions | Duration :
                                 <span class="text-danger">15mins</span></p>
                            </div>
                            <div class="col-md-6"><a class="btn btntheme" href="#">TAKE TEST</a></div>
                        </div>

                    </div>
                </div>
                <div class="col-md-7">
                <div class="bg-white shadow-lg py-5 myqMatrix-card h-auto dt_sec-1">
                        <span class="progress_text" style="padding-left: 15px;"><img src="{{URL::asset('public/after_login/new_ui/images/weekly-task-icon.png')}}"> Task for the Day</span>
                        
                        <div class="row mt-3 dtrow-left">
                            <div class="col-md-6">
                                <p><b>Task 3 - Accuracy Test</b></p>
                                <p>Work on your accuracy with test</p>
                                <p><span class="text-danger">10</span> Questions | Duration :
                                 <span class="text-danger">15mins</span></p>
                            </div>
                            <div class="col-md-6"><a class="btn btntheme" href="#">TAKE TEST</a></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="dtrow-right">
                                <p><b>Task 2 - Weak Topic Test</b></p>
                                <p>Work on your weak topics of <span class="text-danger"> Chemistry (Q4-MyQ Matrix)</span> with this test</p>
                                <p><span class="text-danger">25</span> Questions | Duration :
                                 <span class="text-danger">60mins</span></p>
                                 <a class="btn btntheme" href="#">TAKE TEST</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="dtrow-right">
                                <p><b>Task 2 - Benchmark Test</b></p>
                                <p>Take this benchmark in <span class="text-danger"> Quadratic Equations</span></p>
                                <p><span class="text-danger">25</span> Questions | Duration :
                                 <span class="text-danger">60mins</span></p>
                                 <a class="btn btntheme" href="#">TAKE TEST</a>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>

<!--------- Modal ------>
<div class="modal fade" id="matrix" data-bs-backdrop="static" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <!-- <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
            </div> -->
            <div class="modal-body text-center">
                <p>Give more tests for this <br /> section to be populated</p>
                <div class="text-center mb-4">
                    <a href="{{url('/dashboard')}}" class="btn btn-danger px-5"> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-------------------->

<script>
    $(window).on('load', function() {
        $('#matrix').modal('show');
    });
    $(document).ready(function() {
        $(".dashboard-cards-block .bg-white>small>img").click(function() {
            $(".dashboard-cards-block .bg-white>small p>span").each(function(){
                $(this).parent("p").hide();
            });
            $(this).siblings("p").show();
        });
        $(".dashboard-cards-block .bg-white>small p>span").click(function() {
            $(this).parent("p").hide();
        });
    });
</script>


<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->

@endsection