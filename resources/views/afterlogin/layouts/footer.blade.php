<!-- Modal Export Analytics-->
<div class="modal fade" id="exportAnalytics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 px-5 ">
                <div class="text-center my-5">
                    <a href="{{route('export_analytics')}}" class="btn btn-danger px-5 rounded-0"><i class="fa fa-download"></i> &nbsp;Download</a>
                </div>
                <p class="text-center text-secondary mb-5">OR</p>
                <div class="input-group mb-3">
                    <div class="input-group-text bg-white rounded-0 border-0"><i class="fa fa-envelope-o text-secondary"></i>
                    </div>
                    <input type="text" class="form-control border-0 rounded-0 ps-0" id="specificSizeInputGroupUsername" placeholder="Enter e-mail ID">
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-text bg-white rounded-0 border-0"><i class="fas fa-lock text-secondary"></i> </div>
                    <select class="form-select border-0 rounded-0 ps-0" placeholder="Share it only this time">
                        <option class="text-secondary">Share it only this time</option>
                    </select>
                </div>
                <div class="text-center my-5">
                    <button class="btn btn-danger px-5 rounded-0"><i class="fa fa-share-alt"></i> &nbsp;Share</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal planner chapters-->
<div class="modal fade planner_chapter" id="plannerChapter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="select-planner-chapter" class="modal-body pt-0 px-5 ">

            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="{{URL::asset('public/js/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

<script src="{{URL::asset('public/js/bootstrap.bundle.min.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('public/js/jquery.slimscroll.min.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

<script>
    var firebaseConfig = {
        apiKey: "AIzaSyAXOEjCfj6qEKRi3Lm82j2DLMNIsXnJ0Nk",
        authDomain: "uniq-notifications.firebaseapp.com",
        databaseURL: 'https://uniq-notifications.firebaseio.com',
        projectId: "uniq-notifications",
        storageBucket: "uniq-notifications.appspot.com",
        messagingSenderId: "768896658565",
        appId: "1:768896658565:web:036b631c04c6d9c6280dec",
        measurementId: "G-8PJKZ9N25F"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    messaging.usePublicVapidKey('BA4Jhm824U8n2-c5HXWiLeCLSXWVwTOuixpQekWmqMDb6nmCOvE7uOo9dBRvNhjDrPPvZnH_iMEtZnkB1wFPWQ0');

    // Get Instance ID token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.

    messaging.requestPermission().then(function() {
        return messaging.getToken()
    }).then(function(response) {
        if (response) {
            console.log(response);
            /* const saveUrl = "https://api.uniqtoday.com/api/update_student_token";
            const saveData = {
                token: response,
                user_id: "{{Auth::user()->id}}"
            }
            $.post(saveUrl, saveData, function(data, status) {
                console.log('${data} and status is ${status}')
            }); */
            $.ajax({
                url: "{{ url('/saveFcmToken') }}",
                type: 'POST',

                data: {
                    "_token": "{{ csrf_token() }}",
                    fcm_token: response
                },

                success: function(response_data) {
                    console.log(response_data);
                },
                error: function(xhr, b, c) {
                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                }
            });

            /* sendTokenToServer(currentToken);
            updateUIForPushEnabled(currentToken); */
        } else {
            // Show permission request.
            console.log('No Instance ID token available. Request permission to generate one.');
            // Show permission UI.
            updateUIForPushPermissionRequired();
            setTokenSentToServer(false);
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);

    });

    messaging.onMessage((payload) => {
        console.log('Message received. ', payload);
        // ...
    });
</script>
<script type="text/javascript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    $(".scroll-div").slimscroll({
        height: "40vh",
    });
    $(".subject_chapter").slimscroll({
        height: "30vh",
    });

    $(".notification-scroll").slimscroll({
        height: "70vh",
    });
    $('#editprofile').click(function() {
        $('#profile-details').hide();
        $('#profile-form').show();
        $('.edit-icon').css({
            'display': 'flex'
        });
    });
    $('#cancelEdit').click(function() {
        $('#profile-details').show();
        $('#profile-form').hide();
    });

    $("#editProfile_form").validate({

        submitHandler: function(form) {


            $.ajax({
                url: "{{ url('/editProfile') }}",
                type: 'POST',
                data: $('#editProfile_form').serialize(),
                beforeSend: function() {},
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);
                    if (response.success == true) {
                        var user_name = response.user_name;
                        $('.activeUserName').html(user_name);
                        /* $('#profileUserName').html(user_name);
                        $('#activeUserName').html(user_name); */
                        $('#profile-details').show();
                        $('#profile-form').hide();

                    } else {
                        return false;
                    }



                },
                error: function(xhr, b, c) {
                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                }
            });
        }

    });

    $("#referalStudent_form").validate({
        rules: {
            refer_emails: {
                required: true,
            },
        },
        messages: {
            "refer_emails": {
                required: "Please enter at least one referral email Id."
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: "{{ url('/store_referral') }}",
                type: 'POST',
                data: $('#referalStudent_form').serialize(),
                beforeSend: function() {},
                success: function(response_data) {
                    /* console.log(response_data); */
                    var response = jQuery.parseJSON(response_data);

                    if (response[0].success == true) {
                        if (response[0].message != '') {
                            var sucessmsg = $("#successRef_auth").show();
                            sucessmsg[0].textContent = response[0].message;
                        }

                        if (response[0].duplicate_referrals.length > 0) {
                            const duplicate = response[0].duplicate_referrals.toString();

                            var errormsg = $("#errRef_auth").show();
                            errormsg[0].textContent = "Already referred Email ids : " + duplicate;
                        }

                        setTimeout(function() {
                            $('.errRef').fadeOut('fast');
                        }, 10000);
                    }

                },
                error: function(xhr, b, c) {
                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                }
            });
        }

    });
</script>
<script>
    $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.profile-pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $("#file-input").on('change', function() {
            readURL(this);
            var form_data = new FormData();
            form_data.append("file-input", document.getElementById('file-input').files[0]);
            form_data.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url: "{{ url('/editProfileImage') }}",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    //$('#uploaded_image').html(data);
                }
            });
        });

        $(".image-upload").on('click', function() {
            $(".file-upload").click();
        });
    });
</script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    var mesos = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    var dies = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];

    var dies_abr = [
        'S',
        'S',
        'M',
        'T',
        'W',
        'T',
        'F'
    ];

    Number.prototype.pad = function(num) {
        var str = '';
        for (var i = 0; i < (num - this.toString().length); i++)
            str += '0';
        return str += this.toString();
    }

    function calendari(widget, data) {

        var original = widget.getElementsByClassName('actiu')[0];

        if (typeof original === 'undefined') {
            original = document.createElement('table');
            original.setAttribute('data-actual',
                data.getFullYear() + '/' +
                data.getMonth().pad(2) + '/' +
                data.getDate().pad(2))
            widget.appendChild(original);
        }

        var diff = data - new Date(original.getAttribute('data-actual'));

        diff = new Date(diff).getMonth();

        var e = document.createElement('table');

        e.className = diff === 0 ? 'amagat-esquerra' : 'amagat-dreta';
        e.innerHTML = '';

        widget.appendChild(e);

        e.setAttribute('data-actual',
            data.getFullYear() + '/' +
            data.getMonth().pad(2) + '/' +
            data.getDate().pad(2))

        var fila = document.createElement('tr');
        var titol = document.createElement('th');
        titol.setAttribute('colspan', 7);

        var boto_prev = document.createElement('button');
        boto_prev.className = 'boto-prev';
        boto_prev.innerHTML = '&lt;';

        var boto_next = document.createElement('button');
        boto_next.className = 'boto-next';
        boto_next.innerHTML = '&gt;';

        titol.appendChild(boto_prev);
        titol.appendChild(document.createElement('span')).innerHTML =
            mesos[data.getMonth()] + '<span class="any">' + data.getFullYear() + '</span>';

        titol.appendChild(boto_next);

        boto_prev.onclick = function() {
            data.setMonth(data.getMonth() - 1);
            calendari(widget, data);
        };

        boto_next.onclick = function() {
            data.setMonth(data.getMonth() + 1);
            calendari(widget, data);
        };

        fila.appendChild(titol);
        e.appendChild(fila);

        fila = document.createElement('tr');

        for (var i = 1; i < 7; i++) {
            fila.innerHTML += '<th>' + dies_abr[i] + '</th>';
        }

        fila.innerHTML += '<th>' + dies_abr[0] + '</th>';
        e.appendChild(fila);

        /* Obtinc el dia que va acabar el mes anterior */
        var inici_mes =
            new Date(data.getFullYear(), data.getMonth(), -1).getDay();

        var actual = new Date(data.getFullYear(),
            data.getMonth(),
            -inici_mes);

        /* 6 setmanes per cobrir totes les posiblitats
         *  Quedaria mes consistent alhora de mostrar molts mesos
         *  en una quadricula */
        for (var s = 0; s < 6; s++) {
            var fila = document.createElement('tr');

            for (var d = 1; d < 8; d++) {
                var cela = document.createElement('td');
                var span = document.createElement('span');

                cela.appendChild(span);

                span.innerHTML = actual.getDate();

                if (actual.getMonth() !== data.getMonth())
                    cela.className = 'fora';

                /* Si es avui el decorem */
                if (data.getDate() == actual.getDate() &&
                    data.getMonth() == actual.getMonth())
                    cela.className = 'avui';

                actual.setDate(actual.getDate() + 1);
                fila.appendChild(cela);
            }

            e.appendChild(fila);
        }

        setTimeout(function() {
            e.className = 'actiu';
            original.className +=
                diff === 0 ? ' amagat-dreta' : ' amagat-esquerra';
        }, 20);

        original.className = 'inactiu';

        setTimeout(function() {
            var inactius = document.getElementsByClassName('inactiu');
            for (var i = 0; i < inactius.length; i++)
                widget.removeChild(inactius[i]);
        }, 1000);

    }

    calendari(document.getElementById('calendari'), new Date());

    // end of calender js


    $('#submenu').on('shown.bs.collapse', function() {
        $('body').addClass('move-mainwrapper');

    })

    $('#submenu').on('hidden.bs.collapse', function() {
        $('body').removeClass('move-mainwrapper');

    })

    $('#submenupreparation').on('shown.bs.collapse', function() {
        $('body').addClass('move-mainwrapper-lg');

    })

    $('#submenupreparation').on('hidden.bs.collapse', function() {
        $('body').removeClass('move-mainwrapper-lg');

    })

    $('#submenu2').on('shown.bs.collapse', function() {
        $('body').addClass('move-mainwrapper2');

    })

    $('#submenu2').on('hidden.bs.collapse', function() {
        $('body').removeClass('move-mainwrapper2');

    })

    $('#submenupreparation2').on('shown.bs.collapse', function() {
        $('body').addClass('move-mainwrapper-lg2');

    })

    $('#submenupreparation2').on('hidden.bs.collapse', function() {
        $('body').removeClass('move-mainwrapper-lg2');

    })
    $(document).on('click', function(e) {
        /* bootstrap collapse js adds "in" class to your collapsible element*/
        var menu_opened = $('#submenu').hasClass('show');

        if (!$(e.target).closest('#submenu').length &&
            !$(e.target).is('#submenu') &&
            menu_opened === true) {
            $('#submenu').collapse('toggle');
        }
        var menu_opened = $('#submenu2').hasClass('show');

        if (!$(e.target).closest('#submenu').length &&
            !$(e.target).is('#submenu2') &&
            menu_opened === true) {
            $('#submenu2').collapse('toggle');
        }

        var menu_opened = $('#submenupreparation').hasClass('show');

        if (!$(e.target).closest('#submenupreparation').length &&
            !$(e.target).is('#submenupreparation') &&
            menu_opened === true) {
            $('#submenupreparation').collapse('toggle');
        }

        var menu_opened = $('#submenupreparation2').hasClass('show');

        if (!$(e.target).closest('#submenupreparation').length &&
            !$(e.target).is('#submenupreparation2') &&
            menu_opened === true) {
            $('#submenupreparation2').collapse('toggle');
        }
    });
</script>
<script>
    /*  $(document).ajaxStart(function() {
        $('#overlay').fadeIn();
    });

    $(document).ajaxComplete(function() {
        $('#overlay').fadeOut();
    }); */
    $(document).ready(function() {
        $(".leaderNameBlock").slimscroll({
            height: "51.2vh",
        });
        $(".scroll-topic-ana").slimscroll({
            height: "20vh",
        });
        $(".scroll-achiv").slimscroll({
            height: "26vh",
        });
        $("#StartDate").change(function() {
            var start_date = this.value;
            var date = new Date(start_date);

            var first = date.getDate() - date.getDay() + 1;

            var last = first + 6; // last day is the first day + 6

            var firstday = new Date(date.setDate(first)).toUTCString();
            var lastday = new Date(date.setDate(last)).toUTCString();

            var firstDate = formatDate(firstday);
            var lastDate = formatDate(lastday);

            $('#StartDate').val(firstDate);
            $('#EndDate').val(lastDate);

        });


        $('#edit-planner-btn').click(function() {

            $('#sub-planner').addClass('open-sub-planner');
            $(this).addClass('close-sub-planner');
            $('#close-edit-planner-btn').removeClass('close-sub-planner');

        });
        $('#close-edit-planner-btn').click(function() {

            $('#sub-planner').removeClass('open-sub-planner');
            $(this).addClass('close-sub-planner');
            $('#edit-planner-btn').removeClass('close-sub-planner');

        });


        // editprofile js

        $('#profile-click').click(function() {

            $('#profile-block').toggleClass('d-none');
            $(this).toggleClass('activelink');
            $('#subscribe').addClass('d-none');
            $('#subscribe-click').removeClass('activelink');
            $('#logout-block').addClass('d-none');
            $('#logout-click').removeClass('activelink');

        });
        $('#subscribe-click').click(function() {
            $('#subscribe').toggleClass('d-none');
            $(this).toggleClass('activelink');
            $('#profile-block').addClass('d-none');
            $('#profile-click').removeClass('activelink');

            $('#logout-block').addClass('d-none');
            $('#logout-click').removeClass('activelink');
        });
        $('#logout-click').click(function() {
            $('#logout-block').toggleClass('d-none');
            $(this).toggleClass('activelink');
            $('#profile-block').addClass('d-none');
            $('#profile-click').removeClass('activelink');
            $('#subscribe').addClass('d-none');
            $('#subscribe-click').removeClass('activelink');
        });
    });

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

    function outputUpdate(value) {


        $('#slide-input').html(value);

    }

    function selectChapter(subject_id) {
        var limit = $('#customRange').val();
        var chapters = $('input[name="chapters[]"]').length;
        if (chapters >= limit) {
            var error_txt = 'You can not select more than ' + limit + ' chapter for selected week';
            $('#limit_error').html(error_txt);
            $('#limit_error').show();
            setTimeout(function() {
                $('#limit_error').fadeOut('fast');
            }, 5000);
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

            success: function(response_data) {
                $('#select-planner-chapter').html(response_data);
                $('#plannerChapter').modal('show');
            },


        });

    }

    function suffle_Chapter(chapt_id, subject_id) {
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
                console.log(response_data);
                var response = jQuery.parseJSON(response_data);
                res_chpter_id = response.chapter_id;
                res_chpter_name = response.chapter_name;

                $('#select_chapt_id' + chapt_id).val(res_chpter_id);
                $('#select_chapt_name' + chapt_id).html(res_chpter_name);

            },


        });

    }



    function handleChange(subject_id) {

        var limit = $('#customRange').val();
        var chapters = [];
        var chapters = $('input[name="chapters[]"]').length;
        var chapter_id = $('#planner_chapter_add').val();
        var chapter_name = $('#planner_chapter_add option:selected').text();

        if (chapter_id != '' || chapter_id != 0) {
            $('#planner_sub_' + subject_id).append('<div class="add-removeblock p-2 mb-2 d-flex align-items-center" id="chapter_' + chapter_id + '"><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' + chapter_id + '"><span id="select_chapt_name' + chapter_id + '" class="topic_name">' + chapter_name + '</span>' +
                '<span class="ms-auto"><a href="javascript:void(0)" onclick="suffle_Chapter(' + chapter_id + ',' + subject_id + ')" ><img class="mx-2" src="./public/after_login/images/refersh_ic.png"></a></span><span class=""><a href="javasceript:void(0)" class="chapter_remove"><img src="./public/after_login/images/remove_ic.png"></a></span></div>');
            $('#plannerChapter').modal('hide');
        } else {
            $('#errChptAdd_alert').html('Please select one option.');
            $('#errChptAdd_alert').show();
            setTimeout(function() {
                $('#errChptAdd_alert').fadeOut('fast');
            }, 5000);
            return false;
        }
    }
    $('.chaptbox').on('click', '.chapter_remove', function(e) {
        e.preventDefault();

        $(this).parent().parent().remove();
    });

    $("#plannerAddform").validate({

        submitHandler: function(form) {
            var limit = $('#customRange').val();
            var chapters = [];
            var chapters = $('input[name="chapters[]"]').length;
            if (chapters < limit) {
                $('#limit_error').html('Select minimum ' + limit + ' chapter for planner.');
                return false;
            }

            $.ajax({
                url: "{{ url('/addPlanner') }}",
                type: 'POST',
                data: $('#plannerAddform').serialize(),
                beforeSend: function() {
                    $('#overlay').fadeIn();
                },
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);
                    console.log(response);
                    if (response.success == true) {
                        var massage = response.massage;
                        $('#successPlanner_alert').html(massage);
                        $('#successPlanner_alert').show();
                        setTimeout(function() {
                            $('#successPlanner_alert').fadeOut('fast');
                        }, 8000);
                        $('#overlay').fadeOut();
                        location.reload();

                    } else {
                        var massage = response.massage;
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
                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                }
            });
        }

    });
</script>