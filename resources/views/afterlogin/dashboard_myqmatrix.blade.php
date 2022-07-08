@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
@endphp
@section('content')
<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
<div class="main-wrapper dashboard">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <!-- End top-navbar Section -->
    <div class="content-wrapper matrixpage-wrapper dashboard-cards-block matrix-page-wrapper">
        <div class="container-fluid custom-page" style="padding-bottom: 30px;">
            <div class="row">
            <div class="col-lg-4">
                <div class="commonWhiteBox">
                    <div class="boxHeadingBlock">
                            <h3 class="boxheading">MyQ Matrix 
                                <span class="tooltipmain">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g opacity=".2" stroke="#234628" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"> <path d="M10 18.833a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 13.833V10.5M10 7.166h.009"/></g></svg>
                                <p class="tooltipclass">
                                <span ><img style="width:34px;" src="http://localhost/Uniq_web/public/after_login/new_ui/images/cross.png"></span>
                                    This card represents a combination of your skill, expertise, and knowledge in the topics you have attempted. Build your proficiencies!
                                </p>
                            </span>
                        </h3>
                        <p class="dashSubtext">Supporting text for better interaction on this section</p>
                    </div>
                    <div class="MyqMatrixMain mt-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="myqmatPannel myqcolor1">
                                        <div class="myqinner">
                                        <h6>Q1</h6>
                                        <h5>Strengths</h5>
                                        <p>Going great. Find your strong topics here. Stay in the lead by revision</p>
                                        </div>
                                        <div class="myqbottomSec">
                                            <h3>12 <span class="topictext">Topics</span></h3>
                                            <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="myqmatPannel myqcolor2">
                                        <div class="myqinner">
                                        <h6>Q2</h6>
                                        <h5>Needs focus</h5>
                                        <p>Give a little attention to these topics and take another step towards perfection.  </p>
                                        </div>
                                        <div class="myqbottomSec">
                                            <h3>23 <span class="topictext">Topics</span></h3>
                                            <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="myqmatPannel myqcolor3">
                                        <div class="myqinner">
                                        <h6>Q3</h6>
                                        <h5>Hopeful </h5>
                                        <p>Topics that are hurdles in your journey. Do not save them for the last.  </p>
                                        </div>
                                        <div class="myqbottomSec">
                                            <h3>12 <span class="topictext">Topics</span></h3>
                                            <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="myqmatPannel myqcolor4">
                                        <div class="myqinner">
                                        <h6>Q4</h6>
                                        <h5>Weak </h5>
                                        <p>Find your weak topics here. Work hard to move these topics to other quadrants.</p>
                                        </div>
                                        <div class="myqbottomSec">
                                            <h3>12 <span class="topictext">Topics</span></h3>
                                            <span class="myqarrow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="m7.5 15 5-5-5-5" stroke="#000" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </div>

                <div class="col-lg-8 fortab">
                    <div class="commonWhiteBox">
                        <div class="tabMainblock">
                            <div class="commontab">
                                <div class="tablist">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                        <a class="nav-link qq1_2_3_4 active" data-bs-toggle="tab" href="#qq1">Q1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#qq2">Q2</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#qq3">Q3</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#qq4">Q4</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="qq1" class=" tab-pane active">
                                        <div class="mqmatric_topic">Topics</div>
                                            <div class="exam_instruction_scrolling">
                                                <table class="table mymatrix_table">
                                                    <tbody>
                                                    <tr>
                                                            <td class="mymatrix_table_point">
                                                                Chemical Equilibrium
                                                            </td>
                                                            <td>
                                                                <span class="mymatrix_proficiency">Proficiency : </span><span><b>65%</b></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="mymatrix_table_point">
                                                            Complex Numbers
                                                            </td>
                                                            <td>
                                                                <span class="mymatrix_proficiency">Proficiency : </span><span><b>30%</b></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="mymatrix_table_point">
                                                            Electromagnetic Induction
                                                            </td>
                                                            <td>
                                                                <span class="mymatrix_proficiency">Proficiency : </span><span><b>55%</b></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="mymatrix_table_point">
                                                            Chemistry in everyday Life
                                                            </td>
                                                            <td>
                                                                <span class="mymatrix_proficiency">Proficiency : </span><span><b>32%</b></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="mymatrix_table_point">
                                                            Biomolecules
                                                            </td>
                                                            <td>
                                                                <span class="mymatrix_proficiency">Proficiency : </span><span><b>65%</b></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="mymatrix_table_point">
                                                            Chemical Equilibrium
                                                            </td>
                                                            <td>
                                                                <span class="mymatrix_proficiency">Proficiency : </span><span><b>22%</b></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="mymatrix_table_point">
                                                                Chemical Equilibrium
                                                            </td>
                                                            <td>
                                                                <span class="mymatrix_proficiency">Proficiency : </span><span><b>65%</b></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="mymatrix_table_point">
                                                                Chemical Equilibrium
                                                            </td>
                                                            <td>
                                                                <span class="mymatrix_proficiency">Proficiency : </span><span><b>65%</b></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="qq2" class=" tab-pane">
                                        
                                    </div>
                                    <div id="qq3" class=" tab-pane">
                                    </div>
                                    <div id="qq4" class=" tab-pane">
                                    </div>
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
$(document).ready(function() {
    $('.filtericon').hide();
    // $(".dashboard-cards-block .bg-white>small>img").click(function() {
    //     $(".dashboard-cards-block .bg-white>small p>span").each(function() {
    //         $(this).parent("p").hide();
    //     })
    //     $(this).siblings("p").show();
    // });
    // $(".dashboard-cards-block .bg-white>small p>span").click(function() {
    //     $(this).parent("p").hide();
    // });
    $(".dashboard-cards-block .bg-white>small>img").click(function(event) {
        event.stopPropagation();
        $(".dashboard-cards-block .bg-white>small p>span").each(function() {
            $(this).parent("p").hide();
            $(this).parent("p").removeClass('show');
        });
        $(this).siblings("p").show();
        $(this).siblings("p").addClass('show');

    });
    $(".dashboard-cards-block .bg-white>small p>span").click(function() {
        $(this).parent("p").hide();
    });
    $(document).on('click', function(e) {
        var card_opened = $('.tooltipclass').hasClass('show');
        if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
            $('.tooltipclass').hide();
        }
    });
    var topic_data = '<?php echo $myq_bool; ?>';
    if (topic_data) {
        setInterval(function() {
            $('#matrix').modal('show');
        }, 1000);
    }
    var quadrant_name = '<?php echo $quadrant_name ?>';
    if(quadrant_name=='q_2')
    {
        questwo_tab();
    }
    if(quadrant_name=='q_1')
    {
        quesone_tab();
    }
    if(quadrant_name=='q_3')
    {
        questhree_tab();
    }
    if(quadrant_name=='q_4')
    {
        quesfour_tab();
    }
    $('#q2_box').on('click',function() {
        questwo_tab();
    });
    $('#q1_box').on('click',function() {
        quesone_tab();
    });
    $('#q3_box').on('click',function() {
        questhree_tab();
    });
    $('#q4_box').on('click',function() {
        quesfour_tab();
    });

});
function questwo_tab() {
        $('#matrix-questwo-tab').addClass('active');
        $('#matrix-questwo').addClass('active');
        $('#matrix-quesone-tab').removeClass('active');
        $('#matrix-quesone').removeClass('active');
        $('#matrix-questhree-tab').removeClass('active');
        $('#matrix-questhree').removeClass('active');
        $('#matrix-quesfour-tab').removeClass('active');
        $('#matrix-quesfour').removeClass('active');
}
function quesone_tab() {
    $('#matrix-quesone-tab').addClass('active');
        $('#matrix-quesone').addClass('active');
        $('#matrix-questwo-tab').removeClass('active');
        $('#matrix-questwo').removeClass('active');
        $('#matrix-questhree-tab').removeClass('active');
        $('#matrix-questhree').removeClass('active');
        $('#matrix-quesfour-tab').removeClass('active');
        $('#matrix-quesfour').removeClass('active');
}
function questhree_tab() {
    $('#matrix-questhree-tab').addClass('active');
        $('#matrix-questhree').addClass('active');
        $('#matrix-quesone-tab').removeClass('active');
        $('#matrix-quesone').removeClass('active');
        $('#matrix-questwo-tab').removeClass('active');
        $('#matrix-questwo').removeClass('active');
        $('#matrix-quesfour-tab').removeClass('active');
        $('#matrix-quesfour').removeClass('active');
}
function quesfour_tab() {
    $('#matrix-quesfour-tab').addClass('active');
        $('#matrix-quesfour').addClass('active');
        $('#matrix-questwo-tab').removeClass('active');
        $('#matrix-questwo').removeClass('active');
        $('#matrix-questhree-tab').removeClass('active');
        $('#matrix-questhree').removeClass('active');
        $('#matrix-quesone-tab').removeClass('active');
        $('#matrix-quesone').removeClass('active');
}

</script>
<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->
@endsection

