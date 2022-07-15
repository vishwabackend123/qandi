@extends('layouts.app')
@php
$userData = Session::get('user_data');
@endphp
@section('content')

<!-- Side bar menu -->

<div class="main-wrapper">
    @include('afterlogin.layouts.navbar_header_new')
    @include('afterlogin.layouts.sidebar_new')

    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8">
                    <form id="plannerAddform" action="{{route('addPlanner')}}" method="POST">
                        @csrf
                        <div class="bg-white planner-box">
                            <div class="d-flex align-items-center justify-content-between planner-title pb-3 mb-1">
                                <h1>Planner</h1>
                                <button type="submit" class="btn btn-common-green disabled" id="saveplannerbutton">Save Test</button>
                            </div>
                            <span class="success-text" id="successPlanner_alert"></span>
                            <h2 class="week-select pb-3">Select a week</h2>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="planner-date position-relative">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" id="StartDate" name="start_date" min="{{$mondayDate}}" value="{{$mondayDate}}">
                                        <span class="position-absolute clander-icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.833 3.333H4.167C3.247 3.333 2.5 4.08 2.5 5v11.667c0 .92.746 1.666 1.667 1.666h11.666c.92 0 1.667-.746 1.667-1.666V5c0-.92-.746-1.667-1.667-1.667zM13.333 1.667V5M6.667 1.667V5M2.5 8.333h15" stroke="#CCC" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="planner-date position-relative">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" id="EndDate" name="end_date" value="{{$sundayDate}}">
                                        <span class="position-absolute clander-icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.833 3.333H4.167C3.247 3.333 2.5 4.08 2.5 5v11.667c0 .92.746 1.666 1.667 1.666h11.666c.92 0 1.667-.746 1.667-1.666V5c0-.92-.746-1.667-1.667-1.667zM13.333 1.667V5M6.667 1.667V5M2.5 8.333h15" stroke="#CCC" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="exam-select">
                                        <span class="week-select d-block position-relative">Select exams per week</span>
                                        <div class="d-flex lign-items-center incre-decre-value">
                                            <div class="value-button border-right radius-left" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                            <input type="text" id="number" value="{{$planner_cnt}}" min="0" max="7" readonly />
                                            <div class="value-button border-left radius-right" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="chapter-error pt-2 mb-0 " id="limit_error" style="display:none">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 18.333a8.333 8.333 0 1 0 0-16.666 8.333 8.333 0 0 0 0 16.666zM10 6.667V10M10 13.333h.008" stroke="#FB7686" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span class="ms-1"> </span>
                                &nbsp;
                            </p>
                            <h2 class="week-select pb-3 pt-5">Select Chapters</h2>
                            @if(isset($user_subjects) && !empty($user_subjects))
                            @foreach($user_subjects as $sub)
                            @php
                            $sub_planner = $planner->where('subject_id', $sub->id);
                            $sub_planner->all();

                            @endphp
                            <div class="d-flex align-items-center justify-content-between add-chapter position-relative">
                                <p class="m-0">{{$sub->subject_name}}</p>
                                <label class="m-0" onclick="selectChapter('{{$sub->id}}','{{$sub->subject_name}}');">
                                    <svg class="position-relative" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 4.167v11.666M4.167 10h11.666" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    &nbsp; Add chapters
                                </label>
                                @if(isset($sub_planner) && !empty($sub_planner))
                                <div class="d-flex align-items-center add-subchapter chaptbox" id="planner_sub_{{$sub->id}}">
                                    @foreach($sub_planner as $plan)

                                    <div class="add-insubchapter mr-3">
                                        <input type="hidden" id="select_chapt_id{{$plan->chapter_id}}" name="chapters[]" value="{{$plan->chapter_id}}">
                                        <p class="m-0">
                                            <span class="mr-2" id="select_chapt_name{{$plan->chapter_id}}">{{$plan->chapter_name}}</span>
                                            @if($plan->test_completed_yn=="N")
                                            <a href="javascript:void(0)" onclick="Shuffle_Chapter('{{$plan->chapter_id}}','{{$sub->id}}')" title="Shuffle Chapter">
                                                <svg width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#h7dsf4yzaa)" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M17.25 3v4.5h-4.5M.75 15v-4.5h4.5" />
                                                        <path d="M2.632 6.75A6.75 6.75 0 0 1 13.77 4.23l3.48 3.27m-16.5 3 3.48 3.27a6.75 6.75 0 0 0 11.137-2.52" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="h7dsf4yzaa">
                                                            <path fill="#fff" d="M0 0h18v18H0z" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                            <a href="javasceript:void(0)" value="{{$sub->id}}" class="chapter_remove" title="Remove Chapter">
                                                <svg width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="m13.5 4.5-9 9M4.5 4.5l9 9" stroke="#FB7686" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            @endif
                                        </p>
                                    </div>
                                    @endforeach

                                </div>
                                @endif
                            </div>
                            @endforeach
                            @endif

                        </div>
                    </form>
                </div>
                <div class="col-xl-4">
                    <div class="bg-white clander-box">
                        <h1 class="Calendar-title pb-4 mb-3">Calendar</h1>
                        <div class="calendar-wrapper" id="calendar-wrapper"></div>
                        <!--  <div class="pt-5 mt-5">
                            <button class="btn btn-common-green disabled w-100">Save Test</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="plannerChapter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content custom_modal">
            <div class="modal-header border-0 p-0">
                <h5 class="modal-title pb-3 mb-1" id="plannerChapterLabel">Mathematics</h5>
                <button type="button" class="btn-close border-0 bg-transparent" data-bs-dismiss="modal" aria-label="Close"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6 6 18M6 6l12 12" stroke="#1F1F1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg></button>
            </div>
            <div class="modal-body p-0">
                <input hidden name="chapt_subject_id" id="chapt_subject_id" value="">
                <div class="custom-input pb-5 mb-5">
                    <label>Select Chapters</label>
                    <select class="form-control selectdata" id="select-planner-chapter">
                        <option class="we">Type Chapters</option>
                        <option class="we2">Math</option>
                        <option>Apple</option>
                    </select>
                </div>
            </div>
            <div class="text-right addtestbtn">
                <button type="button" class="btn btn-common-green" id="addChapter" data-value=""><svg class="position-relative" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 4.167v11.666M4.667 10h11.666" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>&nbsp;&nbsp; Add to test</button>
            </div>
        </div>
    </div>
</div>
<!-- Footer Section -->

<!-- footer Section end  -->
<script type="text/javascript">
    function increaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 7) {
            value++;
        }

        document.getElementById('number').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('number').value = value;
    }


    function selectChapter(subject_id, subject_name) {

        var limit = $('#number').val();
        var chapters = $('input[name="chapters[]"]').length;


        if (limit == 0) {
            var error_txt = 'Please select Exams Per Week';
            $('#limit_error span').html(error_txt);
            $('#limit_error').show();
            setTimeout(function() {
                $('#limit_error ').fadeOut('fast');
            }, 10000);
            return false;
        }


        if (chapters >= limit) {

            var error_txt = 'You can not select more than ' + limit + ' chapter for selected week';

            $('#limit_error span').html(error_txt);
            $('#limit_error').show();
            setTimeout(function() {
                $('#limit_error').fadeOut('fast');
            }, 10000);
            return false;
        }

        var selected_chapters = $("input[name='chapters[]']")
            .map(function() {
                return $(this).val();
            }).get();

        $.ajax({
            url: "{{ url('/ajax_chapter_list/',) }}/" + subject_id,
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                selected_chapters: selected_chapters
            },
            beforeSend: function() {
                // $('.loader-block').show();
            },
            success: function(response_data) {
                $('#plannerChapterLabel').html(subject_name);
                $('#select-planner-chapter').html(response_data);
                $('#chapt_subject_id').val(subject_id);
                $('#plannerChapter').modal('show');
                //$('.loader-block').hide();
            },
            error: function(data, errorThrown) {
                //$('.loader-block').hide();
            }
        });

    }


    $('#addChapter').click(function() {
        var chapter_id = $('#select-planner-chapter').val();
        var chapter_name = $('#select-planner-chapter option:selected').text();
        var subject_id = $('#chapt_subject_id').val();

        if (chapter_id != '' || chapter_id != 0) {
            $('#planner_sub_' + subject_id).append(
                '<div class = "add-insubchapter mr-3" ><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' + chapter_id + '"><p class = "m-0" > <span class="mr-2" id="select_chapt_name="' + chapter_id + '">' + chapter_name + '</span>' +
                '<svg  onclick="Shuffle_Chapter(' + chapter_id + ',' + subject_id + ')" width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                '<g clip-path="url(#h7dsf4yzaa)" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                '<path d="M17.25 3v4.5h-4.5M.75 15v-4.5h4.5" />' +
                '<path d="M2.632 6.75A6.75 6.75 0 0 1 13.77 4.23l3.48 3.27m-16.5 3 3.48 3.27a6.75 6.75 0 0 0 11.137-2.52" />' +
                '</g>' +
                '<defs>' +
                '<clipPath id="h7dsf4yzaa">' +
                '<path fill="#fff" d="M0 0h18v18H0z" />' +
                '</clipPath>' +
                '</defs>' +
                ' </svg>' +
                '<a href="javasceript:void(0)" value="' + subject_id + '" class="chapter_remove" title="Remove Chapter"><svg width = "14" height = "14" viewBox = "0 0 18 18" fill = "none" xmlns = "http://www.w3.org/2000/svg" ><path d = "m13.5 4.5-9 9M4.5 4.5l9 9" stroke = "#FB7686" stroke-width = "2" stroke-linecap = "round" stroke-linejoin = "round" /></svg></a></p></div>');
            $('#plannerChapter').modal('hide');
        } else {
            $('#errChptAdd_alert').html('Please select one option.');
            $('#errChptAdd_alert').show();
            setTimeout(function() {
                $('#errChptAdd_alert').fadeOut('fast');
            }, 5000);
            return false;
        }


        var limitrange = $("#number").val();
        var chapterscount = $('input[name="chapters[]"]').length;
        if (limitrange == '0') {
            $('#saveplannerbutton').addClass('disabled');
        } else if (limitrange <= 0) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (chapterscount < limitrange) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (chapterscount > limitrange) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (limitrange == chapterscount) {
            $('#saveplannerbutton').removeClass('disabled');
        }

    });

    function Shuffle_Chapter(chapt_id, subject_id) {
        var selected_chapters = $("input[name='chapters[]']")
            .map(function() {
                return $(this).val();
            }).get();
        $.ajax({
            url: "{{ url('/shuffle_chapter/',) }}/" + subject_id,
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                current_chapter: chapt_id,
                selected_chapters: selected_chapters
            },

            success: function(response_data) {
                // console.log(response_data);
                var response = jQuery.parseJSON(response_data);
                res_chpter_id = response.chapter_id;
                res_chpter_name = response.chapter_name;

                $('#select_chapt_id' + chapt_id).val(res_chpter_id);
                $('#select_chapt_name' + chapt_id).html(res_chpter_name);
                /*   $('#select_chapt_name' + chapt_id).attr('title', res_chpter_name);
                 */
            },


        });

    }

    $("#plannerAddform").validate({
        rules: {
            start_date: {
                // dateBefore: '#EndDate',
                required: true
            },
            end_date: {
                // dateAfter: '#StartDate',
                required: true
            }
        },
        submitHandler: function(form) {

            var limit = $('#number').val();
            if (limit == '0') {
                var error_txt = 'Please select Exams Per Week';
                $('#limit_error span').html(error_txt);
                $('#limit_error').show();
                setTimeout(function() {
                    $('#limit_error').fadeOut('fast');
                }, 5000);
                return false;
            }
            if (limit <= 0) {
                $('#limit_error span').html('Please set at least one exam for the selected week.');
                $('#limit_error').show();
                setTimeout(function() {
                    $('#limit_error').fadeOut('fast');
                }, 5000);
                return false;
            }
            var chapters = [];
            var chapters = $('input[name="chapters[]"]').length;

            if (chapters < limit) {
                $('#limit_error').show();
                $('#limit_error span').html('Select minimum ' + limit + ' chapter for planner.');
                /*setTimeout(function() {
                    $('#limit_error').fadeOut('fast');
                }, 5000);*/
                return false;
            }
            if (chapters > limit) {
                $('#limit_error').show();
                $('#limit_error span').html('Select minimum ' + limit + ' chapter for planner.');
                /*setTimeout(function() {
                    $('#limit_error').fadeOut('fast');
                }, 5000);*/
                return false;
            }

            $.ajax({
                url: "{{ url('/addPlanner') }}",
                type: 'POST',
                data: $('#plannerAddform').serialize(),
                beforeSend: function() {
                    $('#overlay').fadeIn();
                    //$('.loader-block').show();
                },
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);
                    //$('.loader-block').hide();
                    if (response.success == true) {
                        var massage = response.massage;
                        $('#successPlanner_alert').html(massage);
                        $('#successPlanner_alert').show();
                        setTimeout(function() {
                            $('#successPlanner_alert').fadeOut('fast');
                        }, 8000);
                        $('#overlay').fadeOut();


                    } else {
                        var message = response.message;
                        $('#errPlanner_alert').html(message);
                        $('#errPlanner_alert').show();
                        setTimeout(function() {
                            $('#errPlanner_alert').fadeOut('fast');
                        }, 8000);
                        $('#overlay').fadeOut();
                        return false;
                    }

                },
                error: function(xhr, b, c) {
                    //$('.loader-block').hide();
                }
            });
        }

    });

    $('.chaptbox').on('click', '.chapter_remove', function(e) {
        e.preventDefault();

        $(this).parent().parent().remove();
        var pln_sub_id = $(this).parent().parent().attr('id');
        var subject_id = $(this).attr('value');

        var selected_count = $('#planner_sub_' + subject_id + ' div').length;

        var limitrange = $("#number").val();
        var chapterscount = $('input[name="chapters[]"]').length;
        if (limitrange == '0') {
            $('#saveplannerbutton').addClass('disabled');
        } else if (limitrange <= 0) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (chapterscount < limitrange) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (chapterscount > limitrange) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (limitrange == chapterscount) {
            $('#saveplannerbutton').removeClass('disabled');
        }
    });

    $("#StartDate").change(function() {
        var start_date = this.value;
        var date = new Date(start_date);


        /*  var first = date.getDate() - date.getDay() + 1;

         var last = first + 6; // last day is the first day + 6 */

        var firstday = new Date(date.setDate(date.getDate() - date.getDay() + 1));
        var lastday = new Date(date.setDate(date.getDate() - date.getDay() + 7));

        /*  var firstday = new Date(date.setDate(first)).toUTCString();
         var lastday = new Date(date.setDate(last)).toUTCString(); */

        var firstDate = formatDate(firstday);
        var lastDate = formatDate(lastday);

        $('#StartDate').val(firstDate);
        $('#EndDate').val(lastDate);

        $.ajax({
            url: "getWeeklyPlanSchedule",
            type: "GET",
            cache: false,
            data: {
                'start_date': start_date
            },
            success: function(response_data) {
                var response = jQuery.parseJSON(response_data);
                if (response.range > 0) {

                    $('#number').val(response.range);


                    var planned_edit = response.planner;
                    var result = Object.values(planned_edit);


                    result.forEach(function(item) {
                        console.log(item);
                        var subject_id = item.subject_id;
                        var chapter_id = item.chapter_id;
                        var chapter_name = item.chapter_name;
                        var status = item.test_completed_yn;
                        $('#planner_sub_' + subject_id).html("");
                        $('#planner_sub_' + subject_id).append(
                            '<div class = "add-insubchapter mr-3" ><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' + chapter_id + '"><p class = "m-0" > <span class="mr-2" id="select_chapt_name="' + chapter_id + '">' + chapter_name + '</span>' +
                            '<svg  onclick="Shuffle_Chapter(' + chapter_id + ',' + subject_id + ')" width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                            '<g clip-path="url(#h7dsf4yzaa)" stroke="#56B663" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                            '<path d="M17.25 3v4.5h-4.5M.75 15v-4.5h4.5" />' +
                            '<path d="M2.632 6.75A6.75 6.75 0 0 1 13.77 4.23l3.48 3.27m-16.5 3 3.48 3.27a6.75 6.75 0 0 0 11.137-2.52" />' +
                            '</g>' +
                            '<defs>' +
                            '<clipPath id="h7dsf4yzaa">' +
                            '<path fill="#fff" d="M0 0h18v18H0z" />' +
                            '</clipPath>' +
                            '</defs>' +
                            ' </svg>' +
                            '<a href="javasceript:void(0)" value="' + subject_id + '" class="chapter_remove" title="Remove Chapter"><svg width = "14" height = "14" viewBox = "0 0 18 18" fill = "none" xmlns = "http://www.w3.org/2000/svg" ><path d = "m13.5 4.5-9 9M4.5 4.5l9 9" stroke = "#FB7686" stroke-width = "2" stroke-linecap = "round" stroke-linejoin = "round" /></svg></a></p></div>');


                    });

                } else {

                    $('#number').val(response.range);
                    $('.add-subchapter').html("");

                }


            }
        });

    })

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }
</script>
<script type="text/javascript">
    var config = `
function selectDate(date) {
  $('#calendar-wrapper').updateCalendarOptions({
    date: date
  });
  console.log(calendar.getSelectedDate());
}

var defaultConfig = {
  weekDayLength: 1,
  date: '08/05/2021',
  onClickDate: selectDate,
  showYearDropdown: true,
  startOnMonday: false,
};

var calendar = $('#calendar-wrapper').calendar(defaultConfig);
console.log(calendar.getSelectedDate());
`;
    eval(config);
    const flask = new CodeFlask('#editor', {
        language: 'js',
        lineNumbers: true
    });
    flask.updateCode(config);
    flask.onUpdate((code) => {
        try {
            eval(code);
        } catch (e) {}
    });
</script>

@endsection