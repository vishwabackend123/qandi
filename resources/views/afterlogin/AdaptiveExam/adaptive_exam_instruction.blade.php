@extends('afterlogin.layouts.app_new')
@php
$userData = Session::get('user_data');
$user_id = isset($userData->id)?$userData->id:'';
@endphp

<?php 
// For Mixpanel 
if($userData->grade_id == '1'){
$grade='JEE';
}
elseif($userData->grade_id == '2'){
$grade='NEET';
}
else{
$grade='NA';
}

?>

@section('content')
@include('afterlogin.layouts.sidebar_new')
<!-- sidebar menu end -->
@if($errors->any())
<script>
    $(window).on('load', function() {
        $('#matrix').modal('show');
    });
</script>
@endif

<!-- Mixpanel Started -->
<script type="text/javascript">
(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

// Enabling the debug mode flag is useful during implementation,
// but it's recommended you remove it for production

var exam_title = "{{isset($exam_title)?$exam_title:''}}

var mixpanelid="{{env('MIXPANEL_KEY')}}";
mixpanel.init(mixpanelid);
mixpanel.track('Loaded '+exam_title+' Instruction',{
        "$city" : '<?php echo $userData->city; ?>',
        }
);
</script>
<!-- Mixpanel Event Ended-->


<div class="main-wrapper exam-wrapperBg">
    <!-- End start-navbar Section -->
    @include('afterlogin.layouts.navbar_header_new')
    <div class="content-wrapper">
        <div class="exam_instruction_wrapper">
            <div class="mock_inst_text_mock_testmobile mobile_block">
                <a href="{{ url()->previous() }}" class="mocktestarrow"> <i class="fa fa-angle-right" aria-hidden="true"></i> Back</a>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-6 col-sm-12 col-xs-12 exam_instruction_col_eight">
                    <div class="mock_inst_text_mock_test">
                        <a href="{{ url()->previous() }}" class="mocktestarrow"> <i class="fa fa-angle-right" aria-hidden="true"></i> Back</a>
                    </div>
                    @if(isset($instructions) && !empty($instructions))
                    <div id="inst_details">{!!$instructions!!}</div>
                    @else
                    <div class="exam_instruction_text">INSTRUCTIONS</div>
                    <div class="exam_instruction_text_under_text">Please read the instructions carefully prior to taking the test.</div>
                    <div class="exam_instruction_scrolling">
                        <div>
                            <div class="exam_inst_sec_head"><b>1. <span>General<span></b></div>
                            <div class="line-693"></div>
                            <ul class="exam_inst_ul_li">
                                <li>The total duration of this test is <b>{{$exam_fulltime}} mins.</b></li>
                            </ul>
                        </div>
                        @php $i=1; @endphp
                        @if(isset($filtered_subject))
                        @foreach($filtered_subject as $sub)
                        @php $i++; @endphp

                        <div>
                            <div class="exam_inst_sec_head_flex">
                                <div class="exam_inst_sec_head"><b>{{$i}}. <span>{{$sub->subject_name}}</span></b></div>

                            </div>
                            <div class="line-693"></div>
                            <div class="mt-2">The following are the sections in the test:</div>

                            <ul class="exam_inst_ul_li">
                                <li>This section contains <b>questions of Single Choice.</b></li>
                                <li><b>For Single Choice questions</b>, +4 marks are allotted for each correct response, -1 mark will be deducted for each incorrect response, and 0 mark will be given for unanswered/ marked for review questions. </li>
                            </ul>


                        </div>
                        @endforeach
                        @endif

                    </div>
                    @endif
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-12 col-xs-12 exam_instruction_col_four">
                    <div class="exam_section_right_side">
                        <div class="exam_section_right_side_padding">
                            <div class="exam_section_right_side_jee_main">{{isset($exam_name)?$exam_name:''}}</div>
                            <div class="exam_inst_col_four_text_contant">
                                <div class="exam_inst_col_four_text_contant1">Duration</div>
                                <div class="exam_inst_col_four_text_contant2">{{$exam_fulltime}} Mins</div>
                            </div>
                            <div class="exam_inst_col_four_text_contant">
                                <div class="exam_inst_col_four_text_contant1">Subject</div>
                                <div class="exam_inst_col_four_text_contant2">{{$tagrets}}</div>
                            </div>
                        </div>
                        <div>
                            <div class="exam_inst_right_contant_green text-center">
                                <span class="green_circle leftenter"></span>
                                <span class="green_circle leftbottom"></span>
                                <span class="green_circle rightBottom"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="104" height="104" viewBox="0 0 104 104" fill="none" class="exam_inst_svg_right_green">
                                    <mask id="stq5c63rya" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="104" height="104">
                                        <path d="M0 0h104v96.18a7.82 7.82 0 0 1-7.82 7.82H0V0z" fill="#D9D9D9" />
                                    </mask>
                                    <g mask="url(#stq5c63rya)">
                                        <rect x="14.075" y="28.538" width="61.774" height="78.977" rx="1.564" transform="rotate(-12.796 14.075 28.538)" fill="#D4ECD8" />
                                        <rect x="22.054" y="20.718" width="61.774" height="78.977" rx="1.564" fill="#EDFFEF" />
                                        <rect x="26.746" y="54.343" width="7.82" height="7.82" rx="2.444" fill="#56B663" />
                                        <path d="m29.19 58.253.978.977 1.955-1.955" stroke="#E0F6E3" stroke-width=".977" stroke-linecap="round" stroke-linejoin="round" />
                                        <rect x="26.746" y="69.98" width="7.82" height="7.82" rx="2.444" fill="#56B663" />
                                        <path d="m29.19 73.889.977.977 1.955-1.955" stroke="#E0F6E3" stroke-width=".977" stroke-linecap="round" stroke-linejoin="round" />
                                        <path stroke="#B2D9B6" stroke-width="1.564" stroke-linecap="round" d="M38.475 55.122h11.73M38.475 70.761h11.73M28.309 36.356h32.842M28.309 42.613h22.677M65.844 36.356h13.293M38.475 60.596h20.331M38.475 76.236h20.331" />
                                        <path d="M71.485 83.871 63.6 78.785l-1.604 8.618c-.258 1.388 1.31 2.38 2.454 1.553l7.035-5.085z" fill="#56B663" />
                                        <path d="M87.759 41.33a3.128 3.128 0 0 1 4.324-.933l2.628 1.695a3.128 3.128 0 0 1 .933 4.324L71.484 83.87 63.6 78.785l24.16-37.455z" fill="#4A9453" />
                                        <path d="M87.759 41.33a3.128 3.128 0 0 1 4.324-.933l2.628 1.695a3.128 3.128 0 0 1 .933 4.324l-4.239 6.571-7.885-5.086 4.239-6.571z" fill="#E0F6E3" />
                                        <path fill="#56B663" d="m84.79 45.93 7.886 5.086-2.543 3.943-7.885-5.086z" />
                                    </g>
                                </svg>
                                <div class="exam_inst_all_the_best">All the Best, {{ucwords($userData->user_name)}}!</div>
                                <form class="form-horizontal ms-auto " action="{{$exam_url}}" method="post">
                                    @csrf
                                    <input type="hidden" name="ranSession" value="{{$ranSession}}" />
                                    <button type="submit" class="btn exam_inst_take_test_btn">Practice</button>
                                </form>
                                {{--<a href="{{$exam_url}}" class="btn exam_inst_take_test_btn">Practice</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- For Mixpanel -->

<script type="text/javascript">
    // Mixpanel Started 
    $('.exam_inst_take_test_btn').click(function() {
            var user_id = '<?php echo $user_id; ?>';
            mixpanel.identify(user_id);
            mixpanel.people.set({
            $phone : '<?php echo $userData->mobile; ?>',
            $email : '<?php echo $userData->email; ?>',
            "Email Verified" : '<?php echo $userData->email_verified; ?>',
            "Course" : '<?php echo $grade; ?>',
            "Exam Attempt Start At" : '<?php echo date("Y-m-d H:i:s"); ?>',
            });
            mixpanel.track("Custom Exam Topic Take Test Click",{
            $phone : '<?php echo $userData->mobile; ?>',
            $email: '<?php echo $userData->email; ?>', 
            "Email Verified": '<?php echo $userData->email_verified; ?>', 
            "Course": '<?php echo $grade; ?>', 
            "Exam Attempt Start At" : '<?php echo date("Y-m-d H:i:s"); ?>',
              });
            
        });
        // Mixpanel Event Ended

</script>

<!-- Footer Section -->
@include('afterlogin.layouts.footer_new')
<!-- footer Section end  -->
@endsection