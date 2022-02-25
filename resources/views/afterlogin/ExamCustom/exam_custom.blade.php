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
    <div class="container-fluid custom-page">

      <div class="row">
        <div class="col-lg-12  p-lg-5 pt-none">

          <div class="tab-wrapper">
            <div id="scroll-mobile">
              <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                @isset($subject_list)
                @foreach($subject_list as $key=>$subject)
                <li class="nav-item" role="presentation">
                  <a class="nav-link all_div {{($key==0)?'active':''}}" id="{{$subject->subject_name}}-tab" data-bs-toggle="tab" href="#{{$subject->subject_name}}" role="tab" aria-controls="{{$subject->subject_name}}" aria-selected="{{($key==0)?'true':'false'}}">{{$subject->subject_name}}</a>
                </li>
                @endforeach
                @endisset
              </ul>
            </div>
            <!--scroll-mobile-->
            <div class="tab-content cust-tab-content" id="myTabContent">
              @isset($subject_list)
              @foreach($subject_list as $skey=>$sub)
              <div class="tab-pane fade show {{($skey==0)?'active':''}}" id="{{$sub->subject_name}}" role="tabpanel" aria-labelledby="{{$sub->subject_name}}-tab">

                <div class="d-flex px-4 py-2 align-items-center justify-content-between">
                  <span class="  mr-3 name-txt ">{{$sub->subject_name}}</span>
                  <p class="mb-0 ms-auto me-4 tab-title">You can pick topics / sub-topics or</p>
                  <form method="post" action="{{route('custom_exam')}}">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{$sub->id}}">
                    <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                    <input type="hidden" name="question_count" value="30">
                    <button type="submit" class="btn btn-warning rounded-0 px-5 ml-0 ml-md-3 active-btn"><i class=" fa fa-pencil-square-o" aria-hidden="true"></i> take FULL test</button>

                  </form>

                  <div class="dropdown">
                    <button class="btn btn-light rotate-icon ms-2 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true" title="Chapters Filter"></i></button>
                    <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','prof_asc')" href="javascript:void(0);">
                          <svg id="Group_4864" data-name="Group 4864" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <defs>
                              <style>
                                .cls-1,
                                .cls-2,
                                .cls-3,
                                .cls-4 {
                                  fill: none;
                                }

                                .cls-2,
                                .cls-3,
                                .cls-4 {
                                  stroke: #000;
                                  stroke-width: 1.5px;
                                }

                                .cls-3 {
                                  stroke-linejoin: round;
                                }

                                .cls-4 {
                                  stroke-linecap: square;
                                }
                              </style>
                            </defs>
                            <path id="Path_2676" data-name="Path 2676" class="cls-1" d="M0,0H24V24H0Z" />
                            <path id="Path_2677" data-name="Path 2677" class="cls-2" d="M4,15l3,3,3-3" />
                            <path id="Path_2678" data-name="Path 2678" class="cls-3" d="M7,6V18" />
                            <path id="Path_2679" data-name="Path 2679" class="cls-4" d="M17,3a2,2,0,0,1,2,2V8a2,2,0,0,1-4,0V5A2,2,0,0,1,17,3Z" />
                            <circle id="Ellipse_785" data-name="Ellipse 785" class="cls-4" cx="2" cy="2" r="2" transform="translate(15 14)" />
                            <path id="Path_2680" data-name="Path 2680" class="cls-4" d="M19,16v3a2,2,0,0,1-2,2H15.5" />
                          </svg>
                          Low Proficiency</a></li>
                      <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','prof_desc')" href="javascript:void(0);">
                          <svg id="Group_2976" data-name="Group 2976" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <defs>
                              <style>
                                .cls-1,
                                .cls-2,
                                .cls-3,
                                .cls-4 {
                                  fill: none;
                                }

                                .cls-2,
                                .cls-3,
                                .cls-4 {
                                  stroke: #000;
                                  stroke-width: 1.5px;
                                }

                                .cls-3 {
                                  stroke-linejoin: round;
                                }

                                .cls-4 {
                                  stroke-linecap: square;
                                }
                              </style>
                            </defs>
                            <path id="Path_2671" data-name="Path 2671" class="cls-1" d="M0,0H24V24H0Z" />
                            <path id="Path_2672" data-name="Path 2672" class="cls-2" d="M4,15l3,3,3-3" />
                            <path id="Path_2673" data-name="Path 2673" class="cls-3" d="M7,6V18" />
                            <path id="Path_2674" data-name="Path 2674" class="cls-4" d="M17,14a2,2,0,0,1,2,2v3a2,2,0,0,1-4,0V16A2,2,0,0,1,17,14Z" />
                            <circle id="Ellipse_784" data-name="Ellipse 784" class="cls-4" cx="2" cy="2" r="2" transform="translate(15 3)" />
                            <path id="Path_2675" data-name="Path 2675" class="cls-4" d="M19,5V8a2,2,0,0,1-2,2H15.5" />
                          </svg>
                          High Proficiency</a></li>
                      <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','asc')" href="javascript:void(0);">
                          <svg id="Group_2978" data-name="Group 2978" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <defs>
                              <style>
                                .cls-1,
                                .cls-2,
                                .cls-3,
                                .cls-4 {
                                  fill: none;
                                }

                                .cls-2,
                                .cls-3,
                                .cls-4 {
                                  stroke: #000;
                                  stroke-width: 1.5px;
                                }

                                .cls-2 {
                                  stroke-linecap: square;
                                }

                                .cls-4 {
                                  stroke-linejoin: round;
                                }
                              </style>
                            </defs>
                            <path id="Path_2681" data-name="Path 2681" class="cls-1" d="M0,0H24V24H0Z" />
                            <path id="Path_2682" data-name="Path 2682" class="cls-2" d="M15,10V5c0-1.38.62-2,2-2s2,.62,2,2v5m0-3H15" />
                            <path id="Path_2683" data-name="Path 2683" class="cls-2" d="M19,21H15l4-7H15" />
                            <path id="Path_2684" data-name="Path 2684" class="cls-3" d="M4,15l3,3,3-3" />
                            <path id="Path_2685" data-name="Path 2685" class="cls-4" d="M7,6V18" />
                          </svg>
                          A to Z order</a></li>
                      <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','desc')" href="javascript:void(0);">
                          <svg id="Group_2979" data-name="Group 2979" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <defs>
                              <style>
                                .cls-1,
                                .cls-2,
                                .cls-3,
                                .cls-4 {
                                  fill: none;
                                }

                                .cls-2,
                                .cls-3,
                                .cls-4 {
                                  stroke: #000;
                                  stroke-width: 1.5px;
                                }

                                .cls-2 {
                                  stroke-linecap: square;
                                }

                                .cls-4 {
                                  stroke-linejoin: round;
                                }
                              </style>
                            </defs>
                            <path id="Path_2686" data-name="Path 2686" class="cls-1" d="M0,0H24V24H0Z" />
                            <path id="Path_2687" data-name="Path 2687" class="cls-2" d="M15,21V16c0-1.38.62-2,2-2s2,.62,2,2v5m0-3H15" />
                            <path id="Path_2688" data-name="Path 2688" class="cls-2" d="M19,10H15l4-7H15" />
                            <path id="Path_2689" data-name="Path 2689" class="cls-3" d="M4,15l3,3,3-3" />
                            <path id="Path_2690" data-name="Path 2690" class="cls-4" d="M7,6V18" />
                          </svg>
                          Z to A order</a></li>

                    </ul>
                  </div>
                </div>
                <div class="scroll-div" id="chapter_list_{{$sub->id}}">
                  @if(@isset($subject_chapter_list[$sub->id]) && !empty($subject_chapter_list[$sub->id]))
                  @foreach($subject_chapter_list[$sub->id] as $tKey=>$chapters)
                  <div class="compLeteS">
                    <div class="ClickBack d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-2 listing-details w-100 flex-wrap  ">
                      <span class="mr-3 name-txt" title="{{$chapters->chapter_name}}">{{$chapters->chapter_name}}</span>

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
                            {{isset($chapters->chapter_score)?$chapters->chapter_score:0}}%
                          </div>
                        </div>
                      </div>

                      <span class="slbs-link mx-3">
                        <a class="expand-custom expandTopicCollapse" aria-controls="chapter_{{$chapters->chapter_id}}" data-bs-toggle="collapse" href="#chapter_{{$chapters->chapter_id}}" role="button" aria-expanded="false" value="Expand to topics" onclick="show_topic('{{$chapters->chapter_id}}')"><span id="expand_topic_{{$chapters->chapter_id}}">Expand to topics</span></a></span>

                      <div class="d-flex px-4">
                        <button class="btn btn-light rotate-icon ms-auto text-danger rounded-0" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false" title="Topics Filter"><i class="fa fa-sliders" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
                          <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_asc')" href="javascript:void(0);">
                              <svg xmlns="http://www.w3.org/2000/svg" id="Group_4864" data-name="Group 4864" width="24" height="24" viewBox="0 0 24 24">
                                <defs>
                                  <style>
                                    .cls-1,
                                    .cls-2,
                                    .cls-3,
                                    .cls-4 {
                                      fill: none;
                                    }

                                    .cls-2,
                                    .cls-3,
                                    .cls-4 {
                                      stroke: #000;
                                      stroke-width: 1.5px;
                                    }

                                    .cls-3 {
                                      stroke-linejoin: round;
                                    }

                                    .cls-4 {
                                      stroke-linecap: square;
                                    }
                                  </style>
                                </defs>
                                <path id="Path_2676" data-name="Path 2676" class="cls-1" d="M0,0H24V24H0Z" />
                                <path id="Path_2677" data-name="Path 2677" class="cls-2" d="M4,15l3,3,3-3" />
                                <path id="Path_2678" data-name="Path 2678" class="cls-3" d="M7,6V18" />
                                <path id="Path_2679" data-name="Path 2679" class="cls-4" d="M17,3a2,2,0,0,1,2,2V8a2,2,0,0,1-4,0V5A2,2,0,0,1,17,3Z" />
                                <circle id="Ellipse_785" data-name="Ellipse 785" class="cls-4" cx="2" cy="2" r="2" transform="translate(15 14)" />
                                <path id="Path_2680" data-name="Path 2680" class="cls-4" d="M19,16v3a2,2,0,0,1-2,2H15.5" />
                              </svg>
                              Low Proficiency</a></li>
                          <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_desc')" href="javascript:void(0);">
                              <svg id="Group_2976" data-name="Group 2976" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <defs>
                                  <style>
                                    .cls-1,
                                    .cls-2,
                                    .cls-3,
                                    .cls-4 {
                                      fill: none;
                                    }

                                    .cls-2,
                                    .cls-3,
                                    .cls-4 {
                                      stroke: #000;
                                      stroke-width: 1.5px;
                                    }

                                    .cls-3 {
                                      stroke-linejoin: round;
                                    }

                                    .cls-4 {
                                      stroke-linecap: square;
                                    }
                                  </style>
                                </defs>
                                <path id="Path_2671" data-name="Path 2671" class="cls-1" d="M0,0H24V24H0Z" />
                                <path id="Path_2672" data-name="Path 2672" class="cls-2" d="M4,15l3,3,3-3" />
                                <path id="Path_2673" data-name="Path 2673" class="cls-3" d="M7,6V18" />
                                <path id="Path_2674" data-name="Path 2674" class="cls-4" d="M17,14a2,2,0,0,1,2,2v3a2,2,0,0,1-4,0V16A2,2,0,0,1,17,14Z" />
                                <circle id="Ellipse_784" data-name="Ellipse 784" class="cls-4" cx="2" cy="2" r="2" transform="translate(15 3)" />
                                <path id="Path_2675" data-name="Path 2675" class="cls-4" d="M19,5V8a2,2,0,0,1-2,2H15.5" />
                              </svg>
                              High Proficiency</a></li>
                          <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','priority')" href="javascript:void(0);">
                              <svg id="Group_2978" data-name="Group 2978" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <defs>
                                  <style>
                                    .cls-1,
                                    .cls-2,
                                    .cls-3,
                                    .cls-4 {
                                      fill: none;
                                    }

                                    .cls-2,
                                    .cls-3,
                                    .cls-4 {
                                      stroke: #000;
                                      stroke-width: 1.5px;
                                    }

                                    .cls-2 {
                                      stroke-linecap: square;
                                    }

                                    .cls-4 {
                                      stroke-linejoin: round;
                                    }
                                  </style>
                                </defs>
                                <path id="Path_2681" data-name="Path 2681" class="cls-1" d="M0,0H24V24H0Z" />
                                <path id="Path_2682" data-name="Path 2682" class="cls-2" d="M15,10V5c0-1.38.62-2,2-2s2,.62,2,2v5m0-3H15" />
                                <path id="Path_2683" data-name="Path 2683" class="cls-2" d="M19,21H15l4-7H15" />
                                <path id="Path_2684" data-name="Path 2684" class="cls-3" d="M4,15l3,3,3-3" />
                                <path id="Path_2685" data-name="Path 2685" class="cls-4" d="M7,6V18" />
                              </svg>
                              Order by Priority</a></li>
                          <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','sequence')" href="javascript:void(0);">
                              <svg id="Group_2979" data-name="Group 2979" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <defs>
                                  <style>
                                    .cls-1,
                                    .cls-2,
                                    .cls-3,
                                    .cls-4 {
                                      fill: none;
                                    }

                                    .cls-2,
                                    .cls-3,
                                    .cls-4 {
                                      stroke: #000;
                                      stroke-width: 1.5px;
                                    }

                                    .cls-2 {
                                      stroke-linecap: square;
                                    }

                                    .cls-4 {
                                      stroke-linejoin: round;
                                    }
                                  </style>
                                </defs>
                                <path id="Path_2686" data-name="Path 2686" class="cls-1" d="M0,0H24V24H0Z" />
                                <path id="Path_2687" data-name="Path 2687" class="cls-2" d="M15,21V16c0-1.38.62-2,2-2s2,.62,2,2v5m0-3H15" />
                                <path id="Path_2688" data-name="Path 2688" class="cls-2" d="M19,10H15l4-7H15" />
                                <path id="Path_2689" data-name="Path 2689" class="cls-3" d="M4,15l3,3,3-3" />
                                <path id="Path_2690" data-name="Path 2690" class="cls-4" d="M7,6V18" />
                              </svg>
                              Order by Sequence</a></li>

                        </ul>
                      </div>


                      <form method="post" action="{{route('custom_exam_chapter')}}">
                        @csrf
                        <input type="hidden" name="subject_id" value="">
                        <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                        <input type="hidden" name="chapter_id" value="{{$chapters->chapter_id}}">
                        <input type="hidden" name="question_count" value="30">

                        <button class="btn rounded-0 btn-lg ml-0 ml-md-3 custom-btn-gray"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take Test</button>
                      </form>

                    </div>
                    <div class="collapse mb-4" id="chapter_{{$chapters->chapter_id}}">
                      <!--<div class="d-flex px-4">
                      <button class="btn btn-light rotate-icon ms-auto text-danger rounded-0" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false" title="Topics Filter"><i class="fa fa-sliders" aria-hidden="true"></i></button>
                      <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
                        <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_asc')" href="javascript:void(0);"> <i class="fas fa-sort-numeric-down"></i> Low Proficiency</a></li>
                        <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_desc')" href="javascript:void(0);"> <i class="fas fa-sort-numeric-down-alt"></i> High Proficiency</a></li>
                        <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','priority')" href="javascript:void(0);"><i class="fas fa-sort-alpha-down"></i>Order by Priority</a></li>
                        <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','sequence')" href="javascript:void(0);"><i class="fas fa-sort-alpha-down-alt"></i> Order by Sequence</a></li>

                      </ul>
                    </div>-->
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
              <form id="topic_form" method="post" action="{{route('custom_exam_topic')}}" class="topic_list_form text-right">
                @csrf
                <input type="hidden" id="selected_topic" name="topics">
                <input type="hidden" id="selected_tab" name="selected_tab">
                <input type="hidden" name="question_count" value="30">
                <span class="invalid-feedback m-0" role="alert" id="errlog_alert"> </span>
                <div id="topic_custom_footer" class="text-right d-none align-items-center mt-3">

                  <a href="javascript:void(0);" onclick="clearTopics();" class="btn px-4 ms-auto me-2 rounded-0 btn-clear-sel">Clear Selection</a>
                  <button type="submit" class="btn rounded-0 px-5 ml-0 ml-md-3 btn-topic"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take test for selected topic</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('afterlogin.layouts.footer_new')

<script type="text/javascript">
  $('.scroll-div').slimscroll({
    height: '55vh'
  });


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
      $('#topic_box_' + value).addClass('bdr-success');
    } else {
      aTopics.splice(index, 1);
      $('#chpt_topic_' + value).removeClass('topic_selected');
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
    // console.log(aTopics);
    $('#topic_custom_footer').removeClass('d-flex');
    $('#topic_custom_footer').addClass('d-none');
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
    variableWidth: false,
    prevArrow: '<button class="slick-prev"> < </button>',
    nextArrow: '<button class="slick-next"> > </button>',
  });

  $('.slbs-link a').click(function() {
    $('#myTabContent .slick-slider').slick('refresh');
  })

  $('a.expandTopicCollapse span').click(function() {
    var spanId = this.id;
    var curr_text = $("#" + spanId).text();
    var updatetext = ((curr_text == 'Expand to topics') ? 'Collapse topics' : 'Expand to topics');
    $("#" + spanId).text(updatetext);
  })

  /* function handleToggleClick() {
    this.value = (this.value == '+' ? '-' : '+');
  }
  document.getElementByName('expandTopicCollapse').onclick = handleToggleClick;
 */

  /* getting Next Question Data */
  function show_topic(chapt_id) {

    this.value = (this.value == 'Expand to topics' ? 'Collapse topics' : 'Expand to topics');

    var topic_length = $('#topic_section_' + chapt_id + ' .topicList').length;

    if (topic_length == 0) {
      url = "{{ url('ajax_custom_topic/') }}/" + chapt_id;
      $.ajax({
        url: url,
        data: {
          "_token": "{{ csrf_token() }}",
        },
        beforeSend: function() {
          $('#overlay').fadeIn();
        },
        success: function(result) {
          $("#topic_section_" + chapt_id + " div").remove();
          // $("#expand_topic_" + chapt_id).text("Collapse topics");
          $("#topic_section_" + chapt_id).html(result);
          $('#myTabContent .slick-slider').slick('refresh');
          $('#overlay').fadeOut();
          $('#topic_form').show();

        }
      });
    } else {

      $("#expand_topic_" + chapt_id).text("Expand to topics");
      $('#topic_form').toggle();

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
      },
      success: function(result) {

        $("#topic_section_" + chapt_id + " div").remove();
        $("#topic_section_" + chapt_id).html(result);
        /* $("#topic_section_" + chapt_id).html(result); */
        $('#myTabContent .slick-slider').slick('refresh');

        $('#overlay').fadeOut();
        $('#topic_form').show();

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
        /*  $('.slick-slider').slick('refresh'); */
        $('#overlay').fadeOut();


      }
    });

  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

@endsection