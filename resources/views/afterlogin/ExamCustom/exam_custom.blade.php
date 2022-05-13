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
    <div class="container-fluid custom-page practice_custom_page">

      <div class="row">
        <div class="col-lg-12  p-lg-5 pt-none">

          <div class="tab-wrapper">
                <div id="scroll-mobile">
                  <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="custom-tab" data-bs-toggle="tab" href="#custom" role="tab" aria-controls="home" aria-selected="true">Custom</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link " id="attempted-tab" data-bs-toggle="tab" href="#attempted" role="tab" aria-controls="home" aria-selected="true">Attempted</a>
                    </li>
                  </ul>
            </div>
            <!--scroll-mobile-->
            <div class="tab-content cust-tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="custom" role="tabpanel" aria-labelledby="custom-tab">
                <div class="d-flex  pt-4  pb-4">
                  @isset($subject_list)
                  @foreach($subject_list as $key=>$subject)
                  <a class="btn sectionBtn SubActBtn me-2 {{($key==0)?'open_test btn-primary ':'live_tes btn-outline-primary'}}" onclick="showSubChapters('{{$subject->subject_name}}');" id="{{$subject->subject_name}}_btn">{{$subject->subject_name}}</a>

                  @endforeach
                  @endisset

                </div>
                <div class="Flat-left">
                  <form id="topic_form" method="post" action="{{route('custom_exam_topic')}}" class="topic_list_form text-right">
                    @csrf
                    <input type="hidden" id="selected_topic" name="topics">
                    <input type="hidden" id="selected_tab" name="selected_tab">
                    <input type="hidden" name="question_count" value="30">
                    <span class="invalid-feedback m-0" role="alert" id="errlog_alert"> </span>
                    <div id="topic_custom_footer" class="text-right d-none align-items-center mt-3">

                      <a href="javascript:void(0);" onclick="clearTopics();" class="btn px-4 ms-auto me-2 rounded-0 btn-clear-sel">Clear Selection</a>
                      <button type="submit" class="btn rounded-0 px-5 ml-0 ml-md-3 btn-topic"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take test for selected topics</button>
                    </div>
                  </form>
                </div>
                @isset($subject_list)
                @foreach($subject_list as $skey=>$sub)
                <div class="subjectlist  {{($skey==0)?'active d-block':'d-none'}}" id="{{$sub->subject_name}}_list">
                  <div class="d-flex px-4 py-2 align-items-center clear_div ">
                    <div class="Flat-right">
                      <form method="post" action="{{route('custom_exam')}}">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{$sub->id}}">
                        <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                        <input type="hidden" name="question_count" value="30">
                        <button type="submit" class="btn btn-warning rounded-0 px-5 ml-0 ml-md-3 active-btn"><i class=" fa fa-pencil-square-o" aria-hidden="true"></i> take FULL test</button>

                      </form>
                    </div>

                    <div class="dropdown">

                      <button class="btn btn-light ms-2 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" title="Chapters Filter">
                        <!-- <i class="fa fa-sliders" aria-hidden="true" title="Chapters Filter"></i>-->
                        <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860.png')}}" class="dsow">
                      <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860-white.png')}}" class="hsow"> -->

                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4860" width="24" height="24" viewBox="0 0 24 24">
                          <path data-name="Path 11531" d="M0 0h24v24H0z" style="fill:none" />
                          <path data-name="Path 11532" d="m3 9 4-4 4 4M7 5v14" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                          <path data-name="Path 11533" d="m21 15-4 4-4-4m4 4V5" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                        </svg>
                      </button>

                      <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','prof_asc')" href="javascript:void(0);">
                            <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-4864.png')}}"> -->
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4864" width="24" height="24" viewBox="0 0 24 24">
                              <path data-name="Path 2676" d="M0 0h24v24H0z" style="fill:none" />
                              <path data-name="Path 2677" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2678" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2679" d="M17 3a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0V5a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                              <circle data-name="Ellipse 785" cx="2" cy="2" r="2" transform="translate(15 14)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2680" d="M19 16v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            </svg>
                            Low Proficiency
                          </a></li>
                        <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','prof_desc')" href="javascript:void(0);">
                            <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2976.png')}}"> -->
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                              <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none" />
                              <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                              <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                            </svg>
                            High Proficiency
                          </a></li>
                        <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','asc')" href="javascript:void(0);">
                            <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2978.png')}}"> -->
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2978" width="24" height="24" viewBox="0 0 24 24">
                              <path data-name="Path 2681" d="M0 0h24v24H0z" style="fill:none" />
                              <path data-name="Path 2682" d="M15 10V5c0-1.38.62-2 2-2s2 .62 2 2v5m0-3h-4" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2683" d="M19 21h-4l4-7h-4" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2684" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2685" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                            </svg>
                            A to Z order
                          </a></li>
                        <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','desc')" href="javascript:void(0);">
                            <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2979.png')}}"> -->
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2979" width="24" height="24" viewBox="0 0 24 24">
                              <path data-name="Path 2686" d="M0 0h24v24H0z" style="fill:none" />
                              <path data-name="Path 2687" d="M15 21v-5c0-1.38.62-2 2-2s2 .62 2 2v5m0-3h-4" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2688" d="M19 10h-4l4-7h-4" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2689" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 2690" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                            </svg>
                            Z to A order
                          </a></li>

                      </ul>
                    </div>
                    <a class="clear-filter" href="javascript:void(0);" onclick="clear_chapter_filter('{{$sub->id}}','clear')" style="display:none">Clear</a>
                  </div>
                  <div class="scroll-div" id="chapter_list_{{$sub->id}}">
                    @if(@isset($subject_chapter_list[$sub->id]) && !empty($subject_chapter_list[$sub->id]))
                    @foreach($subject_chapter_list[$sub->id] as $tKey=>$chapters)
                    <div class="compLeteS" id="chapter_box_{{$chapters->chapter_id}}">
                      <div class=" ClickBack d-flex align-items-center justify-content-between bg-white  listing-details w-100 flex-wrap ">
                        <span class=" mr-3 name-txt" title="{{$chapters->chapter_name}}" style="text-transform:none">{{$chapters->chapter_name}}</span>

                        <div class="status-id d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                          <div class="status-id  ms-auto  d-flex align-items-center justify-content-center ml-0 ml-md-3 rating" data-vote="0">

                            <div class="star-ratings-css">
                              <div class="star-ratings-css-top" style="width: {{isset($chapters->chapter_score)?$chapters->chapter_score:0}}%">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                              </div>
                              <div class="star-ratings-css-bottom">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                              </div>
                            </div>

                            <div class="ms-1 score score-rating js-score">
                              @if(isset($chapters->chapter_score))
                              {{round($chapters->chapter_score)}}%
                              @else
                              0%
                              @endif
                            </div>
                          </div>
                        </div>

                        <span class="slbs-link mx-3">
                          <a class="expand-custom expandTopicCollapse" aria-controls="chapter_{{$chapters->chapter_id}}" data-bs-toggle="collapse" href="#chapter_{{$chapters->chapter_id}}" role="button" aria-expanded="false" value="Show Topics" onclick="show_topic('{{$chapters->chapter_id}}','{{$sub->id}}')" id="clicktopic_{{$chapters->chapter_id}}"><span id="expand_topic_{{$chapters->chapter_id}}"><i class="fa fa-arrow-down"></i> Show Topics</span></a></span>

                        <div class="d-flex px-4">
                          <button class="btn btn-light ms-auto text-danger rounded-0 expand_filter_{{$chapters->chapter_id}} disabled" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false" title="Topics Filter">
                            <!-- <i class="fa fa-sliders" aria-hidden="true"></i> -->
                            <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860.png')}}" class="dsowl">
                          <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860-white.png')}}" class="hsowl"> -->
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4860" width="24" height="24" viewBox="0 0 24 24">
                              <path data-name="Path 11531" d="M0 0h24v24H0z" style="fill:none" />
                              <path data-name="Path 11532" d="m3 9 4-4 4 4M7 5v14" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                              <path data-name="Path 11533" d="m21 15-4 4-4-4m4 4V5" style="stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" />
                            </svg>
                          </button>
                          <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
                            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_asc')" href="javascript:void(0);">
                                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-4864.png')}}"> -->
                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4864" width="24" height="24" viewBox="0 0 24 24">
                                  <path data-name="Path 2676" d="M0 0h24v24H0z" style="fill:none" />
                                  <path data-name="Path 2677" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2678" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2679" d="M17 3a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0V5a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <circle data-name="Ellipse 785" cx="2" cy="2" r="2" transform="translate(15 14)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2680" d="M19 16v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                </svg>
                                Low Proficiency
                              </a></li>
                            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_desc')" href="javascript:void(0);">
                                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2976.png')}}"> -->

                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                                  <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none" />
                                  <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                </svg>
                                High Proficiency
                              </a></li>
                            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','priority')" href="javascript:void(0);">
                                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2978.png')}}"> -->
                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                                  <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none" />
                                  <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                </svg>
                                Order by Priority
                              </a></li>
                            <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','sequence')" href="javascript:void(0);">
                                <!-- <img src="{{URL::asset('public/after_login/new_ui/images/Group-2979.png')}}"> -->
                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 2976" width="24" height="24" viewBox="0 0 24 24">
                                  <path data-name="Path 2671" d="M0 0h24v24H0z" style="fill:none" />
                                  <path data-name="Path 2672" d="m4 15 3 3 3-3" style="stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2673" d="M7 6v12" style="stroke-linejoin:round;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2674" d="M17 14a2 2 0 0 1 2 2v3a2 2 0 0 1-4 0v-3a2 2 0 0 1 2-2z" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <circle data-name="Ellipse 784" cx="2" cy="2" r="2" transform="translate(15 3)" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                  <path data-name="Path 2675" d="M19 5v3a2 2 0 0 1-2 2h-1.5" style="stroke-linecap:square;stroke:#000;stroke-width:1.5px;fill:none" />
                                </svg>
                                Order by Sequence
                              </a></li>

                          </ul>
                        </div>


                        <form method="post" action="{{route('custom_exam_chapter')}}" class="mb-0">
                          @csrf
                          <input type="hidden" name="subject_id" value="">
                          <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                          <input type="hidden" name="chapter_id" value="{{$chapters->chapter_id}}">
                          <input type="hidden" name="question_count" value="30">

                          <button class="btn rounded-0 btn-lg ml-0 ml-md-3 custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take This Test</button>
                        </form>

                      </div>
                      <div class="collapse mb-4" id="chapter_{{$chapters->chapter_id}}">

                        <section id="topic_section_{{$chapters->chapter_id}}" class="slick-slider mb-4">


                        </section>
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>




                </div>
                @endforeach
                @endisset
              </div>
              <div class="tab-pane fade show" id="attempted" role="tabpanel" aria-labelledby="attempted-tab">

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

    $("#topic_form").validate({

      submitHandler: function(form) {
        var selected_topics = $('#selected_topic').val();
        var active_tab = $("a.active").attr("id");
        $('#selected_tab').val(active_tab);

        if (selected_topics == '' || selected_topics == null) {
          $('#errlog_alert').html('Please select at least one topic for exam.');
          $('#errlog_alert').show();
          setTimeout(function() {
            $('#errlog_alert').fadeOut('fast');
          }, 10000);
          return false;
        }

        form.submit();
      }

    });
  });
  var aTopics = [];

  function addOrRemove(value) {
    var index = aTopics.indexOf(value);

    if (index === -1) {
      aTopics.push(value);
      $('#chpt_topic_' + value).removeClass('btn-light');
      $('#chpt_topic_' + value).addClass('topic_selected');
      $('#chpt_topic_' + value).html('SELECTED');
      $('#topic_box_' + value).addClass('bdr-success');
    } else {
      aTopics.splice(index, 1);
      $('#chpt_topic_' + value).removeClass('topic_selected');
      $('#chpt_topic_' + value).html('SELECT');
      $('#topic_box_' + value).removeClass('bdr-success');
      $('#chpt_topic_' + value).addClass('btn-light');
    }
    $('#selected_topic').val(aTopics);
    if (aTopics.length > 0) {
      $('#topic_custom_footer').removeClass('d-none');
      $('#topic_custom_footer').addClass('d-flex');
    } else {
      $('#topic_custom_footer').removeClass('d-flex');
      $('#topic_custom_footer').addClass('d-none');
    }

    //console.log(aTopics.length);
  }

  function clearTopics() {
    aTopics = [];
    $('#selected_topic').val('');
    $('.addremovetopic').removeClass('topic_selected');
    $('.addremovetopic').html('SELECT');
    $('.topicboxdin').removeClass('bdr-success');
    // console.log(aTopics);
    $('#topic_custom_footer').removeClass('d-flex');
    $('#topic_custom_footer').addClass('d-none');
  }

  function showSubChapters(subject) {
    $('.SubActBtn').removeClass('open_test btn-primary');
    $('.SubActBtn').addClass('live_tes btn-outline-primary');
    $('#' + subject + '_btn').removeClass('live_tes btn-outline-primary');
    $('#' + subject + '_btn').addClass('open_test btn-primary');


    $('.subjectlist').removeClass('d-block');
    $('.subjectlist').addClass('d-none');
    $('#' + subject + '_list').removeClass('d-none');
    $('#' + subject + '_list').addClass('d-block');

  }

  function showSubfilter(subject) {
    $('.SubattemptActBtn').removeClass('btn-primary');
    $('.SubattemptActBtn').addClass('btn-outline-primary');
    $('#' + subject + '_flt').removeClass('btn-outline-primary');
    $('#' + subject + '_flt').addClass('btn-primary');

    if (subject != "all_subject") {
      $('.compLeteS').attr("style", "display: none !important");
      $('.' + subject + '-rlt').attr("style", "display: block !important");
    } else {
      $('.compLeteS').attr("style", "display: block !important");
    }

  }


  var starClicked = false;

  $(function() {

    $('.star').click(function() {
      $(this).children('.selected').addClass('is-animated');
      $(this).children('.selected').addClass('pulse');

      var target = this;

      setTimeout(function() {
        $(target).children('.selected').removeClass('is-animated');
        $(target).children('.selected').removeClass('pulse');
      }, 1000);

      starClicked = true;
    })

    $('.half').click(function() {
      if (starClicked == true) {
        setHalfStarState(this)
      }
      $(this).closest('.rating').find('.js-score').text($(this).data('value'));

      $(this).closest('.rating').data('vote', $(this).data('value'));
      calculateAverage()
      console.log(parseInt($(this).data('value')));

    })

    $('.full').click(function() {
      if (starClicked == true) {
        setFullStarState(this)
      }
      $(this).closest('.rating').find('.js-score').text($(this).data('value'));

      $(this).find('js-average').text(parseInt($(this).data('value')));

      $(this).closest('.rating').data('vote', $(this).data('value'));
      calculateAverage()

      console.log(parseInt($(this).data('value')));
    })

    $('.half').hover(function() {
      if (starClicked == false) {
        setHalfStarState(this)
      }

    })

    $('.full').hover(function() {
      if (starClicked == false) {
        setFullStarState(this)
      }
    })

  })

  function updateStarState(target) {
    $(target).parent().prevAll().addClass('animate');
    $(target).parent().prevAll().children().addClass('star-colour');

    $(target).parent().nextAll().removeClass('animate');
    $(target).parent().nextAll().children().removeClass('star-colour');
  }

  function setHalfStarState(target) {
    $(target).addClass('star-colour');
    $(target).siblings('.full').removeClass('star-colour');
    updateStarState(target)
  }

  function setFullStarState(target) {
    $(target).addClass('star-colour');
    $(target).parent().addClass('animate');
    $(target).siblings('.half').addClass('star-colour');

    updateStarState(target)
  }

  function calculateAverage() {
    var average = 0

    $('.rating').each(function() {
      average += $(this).data('vote')
    })

    $('.js-average').text((average / $('.rating').length).toFixed(3))
  }

  $('.slick-slider').slick({
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    centerMode: false,
    focusOnSelect: false,
    infinite: false,
    slidesToShow: 3.2,
    responsive: [{
        breakpoint: 1199,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1
        }
      }
    ],
    variableWidth: false,
    prevArrow: '<button class="slick-prev"> < </button>',
    nextArrow: '<button class="slick-next"> > </button>',

    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]

  });

  function destroyCarousel(slick_id) {
    if ($(slick_id).hasClass('slick-initialized')) {
      $(slick_id).slick('unslick');
    }
  }


  function applySlider(slick_id) {
    $(slick_id).slick({
      slidesToScroll: 1,
      dots: false,
      arrows: true,
      centerMode: false,
      focusOnSelect: false,
      infinite: false,
      slidesToShow: 3.2,
      responsive: [{
          breakpoint: 1199,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1
          }
        }
      ],
      variableWidth: false,
      prevArrow: '<button class="slick-prev"> < </button>',
      nextArrow: '<button class="slick-next"> > </button>',
    });
  }

  /* 
    $('a.expandTopicCollapse span').click(function() {
      var spanId = this.id;
      var curr_text = $("#" + spanId).text();
      var updatetext = ((curr_text == 'Expand to Topics') ? 'Collapse Topics' : 'Show Topics');
      $("#" + spanId).text(updatetext);

    }) */



  /* getting Next Question Data */
  function show_topic(chapt_id, sub_id) {

    var curr_text = $("#chapter_list_" + sub_id + " #expand_topic_" + chapt_id).text();

    var updatetext = ((curr_text == 'Show Topics') ? 'Hide Details' : 'Show Topics');
    $("#chapter_list_" + sub_id + " #expand_topic_" + chapt_id).text(updatetext);

    if (updatetext == 'Hide Details') {
      $('.expand_filter_' + chapt_id).removeClass('disabled');
    } else {
      $('.expand_filter_' + chapt_id).addClass('disabled');

    }

    /*  this.value = (this.value == 'Expand to Topics' ? 'Collapse Topics' : 'Expand to Topics'); */
    var topic_length = $('#topic_section_' + chapt_id + ' .topicboxdin').length;
    if (topic_length == 0) {
      //if (labelname == 'Collapse Topics') {
      url = "{{ url('ajax_custom_topic/') }}/" + chapt_id;
      $.ajax({
        url: url,
        data: {
          "_token": "{{ csrf_token() }}",
        },
        beforeSend: function() {
          $('.loader-block').show();
          $('#overlay').fadeIn();
        },
        success: function(result) {
          $('.loader-block').hide();
          var slick_id = "#topic_section_" + chapt_id;
          destroyCarousel(slick_id); // destroy slick slider first

          $("#topic_section_" + chapt_id + " div").remove();
          $("#topic_section_" + chapt_id).html(result);

          applySlider(slick_id); // apply slick slider again

          $('#overlay').fadeOut();
          $('#topic_form').show();
          // scroll_topic(chapt_id, sub_id);
          $("#myTabContent #chapter_box_" + chapt_id)[0].scrollIntoView();

        }
      });
    } else {

      // $("#expand_topic_" + chapt_id).text("Expand to Topics");
      $("clicktopic_" + chapt_id).focus();
      //$('#topic_form').toggle();

    }
  }

  function topiclist_filter(chapt_id, filter_type) {

    url = "{{ url('ajax_custom_topic/') }}/" + chapt_id;
    $.ajax({
      url: url,
      data: {
        "_token": "{{ csrf_token() }}",
        "filter_type": filter_type
      },
      beforeSend: function() {
        $('#overlay').fadeIn();
        $('.loader-block').show();
      },
      success: function(result) {
        $('.loader-block').hide();

        /*$("#topic_section_" + chapt_id + " div").remove();
        $("#topic_section_" + chapt_id).html(result);
        $("#chapter_" + chapt_id + ' .slick-slider').slick('refresh');

        $('#overlay').fadeOut();
        $('#topic_form').show(); */

        var slick_id = "#topic_section_" + chapt_id;
        destroyCarousel(slick_id); // destroy slick slider first

        $("#topic_section_" + chapt_id + " div").remove();
        $("#topic_section_" + chapt_id).html(result);

        var selected_topics = $('#selected_topic').val();

        if (selected_topics != '' || selected_topics != null) {
          var sArr = selected_topics.split(',');
          $.each(sArr, function(index, value) {
            if ($("#topic_section_" + chapt_id + ' #chpt_topic_' + value).length > 0) {
              $("#topic_section_" + chapt_id + ' #chpt_topic_' + value).removeClass('btn-light');
              $("#topic_section_" + chapt_id + ' #chpt_topic_' + value).addClass('topic_selected');
              $("#topic_section_" + chapt_id + ' #chpt_topic_' + value).html('SELECTED');
              $("#topic_section_" + chapt_id + ' #topic_box_' + value).addClass('bdr-success');
            }
          });
        }

        applySlider(slick_id); // apply slick slider again

        $('#overlay').fadeOut();
        $('#topic_form').show();
        // scroll_topic(chapt_id, sub_id);
        $("#myTabContent #chapter_box_" + chapt_id)[0].scrollIntoView();

      }
    });

  }

  function chapterlist_filter(sub_id, filter_type) {
    url = "{{ url('filter_subject_chapter/') }}/" + sub_id;
    $.ajax({
      url: url,
      data: {
        "_token": "{{ csrf_token() }}",
        "filter_type": filter_type
      },
      beforeSend: function() {
        $('#overlay').fadeIn();
      },
      success: function(result) {
        $("#chapter_list_" + sub_id).html('');
        $("#chapter_list_" + sub_id).html(result);


        var selected_topics = $('#selected_topic').val();

        if (selected_topics != '' || selected_topics != null) {
          var sArr = selected_topics.split(',');
          $.each(sArr, function(index, value) {
            if ($(".slick-slider #chpt_topic_" + value).length > 0) {
              $(".slick-slider #chpt_topic_" + value).removeClass('btn-light');
              $(".slick-slider #chpt_topic_" + value).addClass('topic_selected');
              $(".slick-slider #chpt_topic_" + value).html('SELECTED');
              $(".slick-slider #topic_box_" + value).addClass('bdr-success');
            }
          });
        }

        $('#overlay').fadeOut();
        $('.clear-filter').show();
      }
    });
  };

  function clear_chapter_filter(sub_id, filter_type) {
    url = "{{ url('filter_subject_chapter/') }}/" + sub_id;
    $.ajax({
      url: url,
      data: {
        "_token": "{{ csrf_token() }}",
        "filter_type": filter_type
      },
      beforeSend: function() {
        $('#overlay').fadeIn();
      },
      success: function(result) {
        $("#chapter_list_" + sub_id).html('');
        $("#chapter_list_" + sub_id).html(result);

        $('#overlay').fadeOut();
        $('.clear-filter').hide();


      }
    });

  };
  $(window).on('load', function() {
    $(".dash-nav-link a:first-child").removeClass("active-navlink");
    $(".dash-nav-link a:nth-child(2)").addClass("active-navlink");
  });
</script>

<script>
  $("body").on("click", ".expandTopicCollapse", function(event) {
    $(this).parents('.ClickBack').toggleClass('newelement');
  });

  function scroll_topic(chapter_id, sub_id) {
    var scrollpas = $('#chapter_list_' + sub_id).scrollTop();
    var blockpos = $('#clicktopic_' + chapter_id).offset().top;
    var scrollblock = $($('#clicktopic_' + chapter_id).attr('href')).offset().top;

    if (scrollpas > 0) {

      if (blockpos > 400) {
        $('#chapter_list_' + sub_id).animate({
          scrollTop: scrollblock + scrollpas - blockpos + 150
        }, 500);
      } else {
        $('#chapter_list_' + sub_id).animate({
          scrollTop: scrollblock + scrollpas - blockpos
        }, 500);
      };

    } else {
      if (scrollpas <= 0 && blockpos < 300) {
        $('#chapter_list_' + sub_id).animate({
          scrollTop: scrollblock - blockpos
        }, 500);
      } else if (scrollpas <= 0 && blockpos > 350) {
        $('#chapter_list_' + sub_id).animate({
          scrollTop: scrollblock - blockpos + 50
        }, 500);
      } else {
        $('#chapter_list_' + sub_id).animate({
          scrollTop: scrollblock - blockpos + scrollpas
        }, 500);
      };
    }
  }

  $('#attempted-tab').click(function() {
    $('.loader-block').show();
    url = "{{ url('ajax_exam_result_list') }}/Assessment";
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
        $('#AssessmentTypeDiv').attr("style", "display: block !important");

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
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

@endsection