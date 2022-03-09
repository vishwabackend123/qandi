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
			<div class="Flat-left">
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
			  
              @isset($subject_list)
              @foreach($subject_list as $skey=>$sub)
			  
			  
              <div class="tab-pane fade show {{($skey==0)?'active':''}}" id="{{$sub->subject_name}}" role="tabpanel" aria-labelledby="{{$sub->subject_name}}-tab">

                <div class="d-flex px-4 py-2 align-items-center justify-content-between">
                 <!--<span class="  mr-3 name-txt ">{{$sub->subject_name}}</span>
                  <p class="mb-0 ms-auto me-4 tab-title">You can pick topics / sub-topics or</p>-->
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
                      <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860.png')}}" class="dsow">
                      <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860-white.png')}}" class="hsow">
                    </button>

                    <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','prof_asc')" href="javascript:void(0);">
                          <img src="{{URL::asset('public/after_login/new_ui/images/Group-4864.png')}}">
                          Low Proficiency</a></li>
                      <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','prof_desc')" href="javascript:void(0);">
                          <img src="{{URL::asset('public/after_login/new_ui/images/Group-2976.png')}}">
                          High Proficiency</a></li>
                      <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','asc')" href="javascript:void(0);">
                          <img src="{{URL::asset('public/after_login/new_ui/images/Group-2978.png')}}">
                          A to Z order</a></li>
                      <li><a class="dropdown-item" onclick="chapterlist_filter('{{$sub->id}}','desc')" href="javascript:void(0);">
                          <img src="{{URL::asset('public/after_login/new_ui/images/Group-2979.png')}}">
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
                        <button class="btn btn-light ms-auto text-danger rounded-0" id="dropdownMenuLink-topic" data-bs-toggle="dropdown" aria-expanded="false" title="Topics Filter">
                          <!-- <i class="fa fa-sliders" aria-hidden="true"></i> -->
                          <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860.png')}}" class="dsowl">
                          <img src="{{URL::asset('public/after_login/new_ui/images/Group-4860-white.png')}}" class="hsowl">
                        </button>
                        <ul class="dropdown-menu cust-dropdown" aria-labelledby="dropdownMenuLink-topic">
                          <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_asc')" href="javascript:void(0);">
                              <img src="{{URL::asset('public/after_login/new_ui/images/Group-4864.png')}}">
                              Low Proficiency</a></li>
                          <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','prof_desc')" href="javascript:void(0);">
                              <img src="{{URL::asset('public/after_login/new_ui/images/Group-2976.png')}}">
                              High Proficiency</a></li>
                          <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','priority')" href="javascript:void(0);">
                              <img src="{{URL::asset('public/after_login/new_ui/images/Group-2978.png')}}">
                              Order by Priority</a></li>
                          <li><a class="dropdown-item" onclick="topiclist_filter('{{$chapters->chapter_id}}','sequence')" href="javascript:void(0);">
                              <img src="{{URL::asset('public/after_login/new_ui/images/Group-2979.png')}}">
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
          </div>
        </div>
      </div>
    </div>
  </div>
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

  /*$('.slbs-link a').click(function() {
    $('#myTabContent .slick-slider').slick('refresh');
  })*/

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
          //$('#myTabContent .slick-slider').slick('refresh');
		  $("#chapter_" + chapt_id + ' .slick-slider').slick('refresh');
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
        //$('#myTabContent .slick-slider').slick('refresh');
		$("#chapter_" + chapt_id + ' .slick-slider').slick('refresh');

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

  };
  // $('.expandTopicCollapse').click(function(){
  //      $('.scroll-div').animate({
  //         scrollTop: $( $(this).attr('href') ).offset().top - 100
  //       }, 500);
  //   });
  // $('.scroll-div').scroll(function(){
  //      $('.expandTopicCollapse').click(function(){
  //      $('.scroll-div').animate({
  //         scrollTop: $( $(this).attr('href') ).offset().top - 100
  //       }, 500);
  //   });
  // });


  // $(document).ready(function() {
  //   $("#dropdownMenuLink").click(function() {

  //     if ($("#dropdownMenuLink").hasClass('show')) {
  //       $(".hsow").hide();
  //       $(".dsow").show();
  //     } else {
  //       $(".hsow").show();
  //       $(".dsow").hide();
  //     }

  //   });
  // });

  // $(document).ready(function() {
  //   $("#dropdownMenuLink-topic").click(function() {

  //     if ($("#dropdownMenuLink-topic").hasClass('show')) {
  //       $(".hsowl").hide();
  //       $(".dsowl").show();
  //     } else {
  //       $(".hsowl").show();
  //       $(".dsowl").hide();
  //     }

  //   });
  // });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

@endsection