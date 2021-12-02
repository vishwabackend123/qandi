<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UNIQ</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>
@php
$userData = Session::get('user_data');

@endphp
<style>
  .star-ratings-css {
    unicode-bidi: bidi-override;
    color: #c5c5c5;
    font-size: 22px;
    margin: 0 auto;
    position: relative;
    padding: 0;
    /* text-shadow: 0px 1px 0 #a2a2a2; */
  }

  .star-ratings-css-top {
    color: #ffdc34;
    padding: 0;
    position: absolute;
    z-index: 1;
    display: block;
    top: 0;
    left: 0;
    overflow: hidden;
  }

  .star-ratings-css-bottom {
    padding: 0;
    display: block;
    z-index: 0;
  }
</style>

<body class="login-body-bg" id="main-body">
  <div class="dash-sidebar">
    <div class="sidbar-block">
      <a href="#"><img src="{{URL::asset('public/after_login/new_ui/images/inner-logo.png')}}" </a>
    </div>
    <div class="dash-nav-link   d-flex flex-column">
      <a href="{{ url('/dashboard') }}">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="71" viewBox="0 0 120 71">
          <defs>
            <style>
              .a {
                fill: #00baff;
              }

              .b,
              .h {
                fill: none;
              }

              .b,
              .c {
                stroke: #fff;
                stroke-width: 1.5px;
                opacity: 1;
              }

              .c {
                fill: #d71922;
              }

              .d {
                opacity: 0;
              }

              .e {
                fill: #f2f2f2;
              }

              .f {
                fill: #231f20;
                font-size: 14px;
                font-family: Poppins-Light, Poppins;
                font-weight: 300;
              }

              .g {
                stroke: none;
              }

              .i {
                filter: url(#a);
              }
            </style>
            <filter id="a" x="0" y="0" width="120" height="43" filterUnits="userSpaceOnUse">
              <feOffset dy="3" input="SourceAlpha" />
              <feGaussianBlur stdDeviation="3" result="b" />
              <feFlood flood-opacity="0.161" />
              <feComposite operator="in" in2="b" />
              <feComposite in="SourceGraphic" />
            </filter>
          </defs>
          <g transform="translate(9 6)">
            <rect class="a" width="48" height="48" rx="8" transform="translate(0 17)" />
            <g transform="translate(1 18)">
              <g transform="translate(11 11)">
                <g class="b" transform="translate(0)">
                  <rect class="g" width="10" height="10" rx="3" />
                  <rect class="h" x="0.75" y="0.75" width="8.5" height="8.5" rx="2.25" />
                </g>
                <g class="b" transform="translate(0 14)">
                  <rect class="g" width="10" height="10" rx="3" />
                  <rect class="h" x="0.75" y="0.75" width="8.5" height="8.5" rx="2.25" />
                </g>
                <g class="b" transform="translate(14)">
                  <rect class="g" width="10" height="10" rx="3" />
                  <rect class="h" x="0.75" y="0.75" width="8.5" height="8.5" rx="2.25" />
                </g>
                <g class="b" transform="translate(14 14)">
                  <rect class="g" width="10" height="10" rx="3" />
                  <rect class="h" x="0.75" y="0.75" width="8.5" height="8.5" rx="2.25" />
                </g>
                <g class="c" transform="translate(10 10)">
                  <circle class="g" cx="2" cy="2" r="2" />
                  <circle class="h" cx="2" cy="2" r="1.25" />
                </g>
              </g>
            </g>
            <g class="d" transform="translate(0 -3)">
              <g class="i" transform="matrix(1, 0, 0, 1, -9, -3)">
                <rect class="e" width="102" height="25" transform="translate(9 6)" />
              </g><text class="f" transform="translate(12 21)">
                <tspan x="0" y="0">Dashboard</tspan>
              </text>
            </g>
          </g>
        </svg>
      </a>
      <a data-bs-toggle="collapse" href="#submenu" role="button" aria-expanded="false" aria-controls="collapseExample">
        <img src="{{URL::asset('public/after_login/new_ui/images/left-icon-2.svg')}}">
      </a>
      <a data-bs-toggle="collapse" href="#submenupreparation" id="submenupreparationlink">
        <img src="{{URL::asset('public/after_login/new_ui/images/left-icon-3.svg')}}">
      </a>

    </div>
    <div class="submenu-L1 collapse width" id="submenu">
      <div class="mt-5 mb-5 pb-5 pt-5"></div>
      <div class=" d-flex  flex-column h-100 mt-5 pt-4   text-start sublinks">
        <a class="nav-link" data-bs-toggle="collapse" href="#submenu2" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Practice</a>
        <a href="{{route('adaptive_mock_exam')}}" class="nav-link"><i class="far fa-edit"></i> Exam</a>
        <a href="{{route('live_exam_list')}}" class="nav-link"><i class="fas fa-external-link-alt"></i> Live</a>
      </div>

    </div>
    <div class="submenu-L2 collapse width" id="submenu2">
      <div class="mt-5 mb-5 pb-5 pt-5"></div>
      <div class=" d-flex  flex-column h-100 mt-5 pt-4   text-start sublinks">
        <a href="{{ url('/exam_custom') }}" class="nav-link"><i class="fas fa-sliders-h rotate-icon"></i> Custom</a>

        <a href="{{ url('/series_list') }}" class="nav-link"><i class="fas fa-book-open"></i> Test Series</a>
      </div>

    </div>
    <div class="submenu-L1 collapse width" id="submenupreparation">
      <div class="mt-5 mb-5 pb-5 pt-5"></div>
      <div class=" d-flex  flex-column h-100 mt-5 pt-4   text-start sublinks">

        <a href="{{route('preparation_center')}}" class="nav-link"><i class="far fa-edit"></i> Preparation Center</a>
        <a href="{{route('refund_form')}}" class="nav-link"><i class="far fa-edit"></i> Refund Form</a>

      </div>

    </div>
  </div>
  <div class="main-wrapper">
    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 ms-auto text-end">
            <div class="user-name-block d-flex align-items-center flex-row-reverse">
              <a href='#'><span class="user-pic-block"><img src="{{URL::asset('public/after_login/new_ui/images/DSC_0004.png')}}" class="user-pic"></span></a>
              <span class="user-name-block ps-3 pe-3">Welcome, <span id="activeUserName">{{ucwords($userData->user_name)}}</span></span>
              <span class="notification me-5 ms-4"><a href=""><img src="{{URL::asset('public/after_login/new_ui/images/bell.png')}}"></a></span>
              <span class="notification ms-4"><a data-bs-toggle="collapse" href='#' role="button" aria-expanded="false" aria-controls="collapseExample"><img src="{{URL::asset('public/after_login/new_ui/images/calender.png')}}"></a></span>
              <span class="notification ms-4"><a href="{{route('overall_analytics')}}"><img src="{{URL::asset('public/after_login/new_ui/images/Group1831.png')}}"></a></span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12  p-lg-5 pt-none">

            <div class="tab-wrapper">
              <div id="scroll-mobile">
                <ul class="nav nav-tabs cust-tabs" id="myTab" role="tablist">
                  @isset($subject_list)
                  @foreach($subject_list as $key=>$subject)
                  <li class="nav-item" role="presentation">
                    <a class="nav-link {{($key==0)?'active':''}}" id="{{$subject->subject_name}}-tab" data-bs-toggle="tab" href="#{{$subject->subject_name}}" role="tab" aria-controls="{{$subject->subject_name}}" aria-selected="{{($key==0)?'true':'false'}}">{{$subject->subject_name}}</a>
                  </li>
                  @endforeach
                  @endisset
                  <!-- <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mathematics</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Physics</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Chemistry</a>
                  </li> -->
                </ul>
              </div>
              <!--scroll-mobile-->
              <div class="tab-content cust-tab-content" id="myTabContent">
                @isset($subject_list)

                @foreach($subject_list as $skey=>$sub)

                <div class="tab-pane fade show {{($skey==0)?'active':''}}" id="{{$sub->subject_name}}" role="tabpanel" aria-labelledby="{{$sub->subject_name}}-tab">

                  <div class="d-flex px-4 py-2 align-items-center justify-content-between">
                    <span class="  mr-3 name-txt">{{$sub->subject_name}}</span>
                    <p class="mb-0 ms-auto me-4 tab-title">You can pick topics / sub-topics or</p>
                    <form method="post" action="{{route('custom_exam')}}">
                      @csrf
                      <input type="hidden" name="subject_id" value="{{$sub->id}}">
                      <input type="hidden" name="subject_name" value="{{$sub->subject_name}}">
                      <input type="hidden" name="question_count" value="30">
                      <button type="button" class="btn btn-warning rounded-0 px-5 ml-0 ml-md-3 active-btn" onclick=" submitToPopup(form)""><i class=" fa fa-pencil-square-o" aria-hidden="true"></i> take FULL test</button>

                    </form>


                    <div class="dropdown">
                      <button class="btn btn-light rotate-icon ms-2 text-danger rounded-0" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true"></i></button>


                      <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">


                        <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','prof_asc')" href="javascript:void(0);"> <i class="fas fa-sort-numeric-down"></i> Low Proficiency</a></li>
                        <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','prof_desc')" href="javascript:void(0);"> <i class="fas fa-sort-numeric-down-alt"></i> High Proficiency</a></li>
                        <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','asc')" href="javascript:void(0);"><i class="fas fa-sort-alpha-down"></i> A to Z order</a></li>
                        <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','desc')" href="javascript:void(0);"><i class="fas fa-sort-alpha-down-alt"></i> Z to A order</a></li>

                      </ul>
                    </div>
                  </div>
                  <div class="scroll-div" id="chapter_list_{{$sub->id}}">
                    @if(@isset($subject_chapter_list[$sub->id]) && !empty($subject_chapter_list[$sub->id]))
                    @foreach($subject_chapter_list[$sub->id] as $tKey=>$chapters)
                    <div class="d-flex align-items-center justify-content-between bg-white px-4 py-2 mb-4 listing-details w-100 flex-wrap  ">
                      <span class="mr-3 name-txt">{{$chapters->chapter_name}}</span>

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
                        <a class="expand-custom" aria-controls="chapter_{{$chapters->chapter_id}}" data-bs-toggle="collapse" href="#chapter_{{$chapters->chapter_id}}" role="button" aria-expanded="false" onclick="show_topic('{{$chapters->chapter_id}}')">Expand to Topics</a></span>
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
                      <div class="d-flex px-4">
                        <button class="btn btn-light rotate-icon ms-auto text-danger rounded-0"><i class="fa fa-sliders" aria-hidden="true"></i></button>
                      </div>
                      <section id="topic_section_{{$chapters->chapter_id}}" class="slick-slider mb-4">


                      </section>
                    </div>
                    @endforeach
                    @endif



                  </div>

                  <form id="topic_form" method="post" action="{{route('custom_exam_topic')}}" class="topic_list_form text-right">
                    @csrf
                    <input type="hidden" id="selected_topic" name="topics">
                    <input type="hidden" id="selected_tab" name="selected_tab">
                    <input type="hidden" name="question_count" value="30">
                    <span class="invalid-feedback m-0" role="alert" id="errlog_alert"> </span>
                    <div id="topic_custom_footer" class="text-right d-flex align-items-center mt-3">

                      <a href="javascript:void(0);" onclick="clearTopics();" class="btn px-4 ms-auto me-2 rounded-0 btn-clear-sel">Clear Selection</a>
                      <button type="submit" class="btn rounded-0 px-5 ml-0 ml-md-3 btn-topic"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Take test for selected topic</button>
                    </div>
                  </form>


                </div>
                @endforeach
                @endisset
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <script type="text/javascript" src="{{URL::asset('public/after_login/new_ui/js/jquery.slimscroll.min.js')}}"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script type="text/javascript">
    function submitToPopup(f) {


      var w = window.open('', 'form-target', 'toolbar=no,scrollbars=yes,resizable=yes,location=no,menubar=no,width=auto,height=auto');
      f.target = 'form-target';
      f.submit();
    };

    function go_full_screen() {
      window.open(url("/custom_exam"), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,location=no,menubar=no,width=auto,height=auto");
    }
    $('.scroll-div').slimscroll({
      height: '44vh'
    });
    $('#topic_form').hide();
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
      } else {
        aTopics.splice(index, 1);
        $('#chpt_topic_' + value).removeClass('topic_selected');
        $('#chpt_topic_' + value).addClass('btn-light');
      }
      $('#selected_topic').val(aTopics);
      //console.log(aTopics);
    }

    function clearTopics() {
      aTopics = [];
      $('#selected_topic').val('');
      $('.addremovetopic').removeClass('topic_selected');
      // console.log(aTopics);
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
      centerMode: false,
      focusOnSelect: false,
      infinite: true,
      slidesToShow: 2,
      variableWidth: false,
      prevArrow: false,
      nextArrow: false
    });

    $('.slbs-link a').click(function() {

      $('.slick-slider').slick('refresh');
    })



    /* getting Next Question Data */
    function show_topic(chapt_id) {
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
            $("#topic_section_" + chapt_id).html('');
            $("#topic_section_" + chapt_id).html(result);
            $('.slick-slider').slick('refresh');
            $('#overlay').fadeOut();
            $('#topic_form').show();

          }
        });
      } else {
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
          $('.slick-slider').slick('refresh');
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
</body>

</html>