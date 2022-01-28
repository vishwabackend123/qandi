<div class="modal fade" id="exportAnalytics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close"></button>
            </div>
            <div class="modal-body pt-0 px-5 ">
                <div class="text-center my-5">
                    <a href="{{route('export_analytics')}}"><button class="btn px-4 top-btn-pop text-white"><i class="fa fa-download"></i> &nbsp;Download PDF</button></a>
                </div>
                <!--  <p class="text-center text-secondary mb-5">OR</p>
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
                </div> -->
                <!-- <div class="text-center my-5">
                    <button class="btn px-5 top-btn-pop text-white"><i class="fa fa-share-alt"></i> &nbsp;Share</button>
                </div> -->
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="{{URL::asset('public/js/jquery-3.6.0.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<!-- <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script> -->

<script type="text/javascript" src="{{URL::asset('public/after_login/new_ui/js/jquery.slimscroll.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/funnel.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>

<script type="text/x-mathjax-config">
    MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});

</script>
<script>
    /** Your web app's Firebase configuration 
     * Copy from Login 
     *      Firebase Console -> Select Projects From Top Naviagation 
     *      -> Left Side bar -> Project Overview -> Project Settings
     *      -> General -> Scroll Down and Choose CDN for all the details
     */
    var firebaseConfig = {
        apiKey: "AIzaSyAWZZkXXuTHAyNqO2EHqi5nudL40exTmmc",
        authDomain: "uniq-notifications-9891c.firebaseapp.com",
        projectId: "uniq-notifications-9891c",
        storageBucket: "uniq-notifications-9891c.appspot.com",
        messagingSenderId: "426474366022",
        appId: "1:426474366022:web:0a94e98859fedd92bd9647",
        measurementId: "G-9QGWSEL82D"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    /**
     * We can start messaging using messaging() service with firebase object
     */
    var messaging = firebase.messaging();

    messaging.usePublicVapidKey('BF7HuS5x1c-2dYVum2tX1Td43VIvCLBw-IGj2c_uDWYiwilJfzvbazpQ6piLdb4YOVVivLQhfPn9Mlx59tWDz10');


    /** Register your service worker here
     *  It starts listening to incoming push notifications from here
     */
    navigator.serviceWorker.register('{{URL::asset("firebase-messaging-sw.js")}}')
        .then(function(registration) {
            /** Since we are using our own service worker ie firebase-messaging-sw.js file */
            messaging.useServiceWorker(registration);

            /** Lets request user whether we need to send the notifications or not */
            messaging.requestPermission()
                .then(function() {
                    /** Standard function to get the token */
                    messaging.getToken()
                        .then(function(token) {
                            /** Here I am logging to my console. This token I will use for testing with PHP Notification */
                            console.log(token);
                            /** SAVE TOKEN::From here you need to store the TOKEN by AJAX request to your server */
                            $.ajax({
                                url: "{{ url('/saveFcmToken') }}",
                                type: 'POST',

                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    fcm_token: token
                                },

                                success: function(response_data) {
                                    console.log(response_data);
                                },
                                error: function(xhr, b, c) {
                                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                                }
                            });
                        })
                        .catch(function(error) {
                            /** If some error happens while fetching the token then handle here */
                            //updateUIForPushPermissionRequired();
                            console.log('Error while fetching the token ' + error);
                        });
                })
                .catch(function(error) {
                    /** If user denies then handle something here */
                    console.log('Permission denied ' + error);
                });

            messaging.onMessage(function(payload) {
                console.log('Message received footer. ', payload);
                const title = payload.data.title;

                const body = payload.data.body;
                const time = payload.data.time;
                const options = {
                    body: payload.data.body,
                    time: payload.data.time,
                };
                new Notification(title, options);
                var ballicon = "{{URL::asset('public/after_login/new_ui/images/bell.jpg')}}";
                $('#recent_notify ').prepend($('<div class="notification-txt">' +
                    '<span class="bell-noti"><img src="' + ballicon + '"></span>' +
                    '<span class="text-notific">' + body + '</span>' +
                    '</div>'));


                // ...
            });
        })
        .catch(function() {
            console.log('Error in registering service worker');
        });

    /** What we need to do when the existing token refreshes for a user */
    messaging.onTokenRefresh(function() {
        messaging.getToken()
            .then(function(renewedToken) {
                console.log(renewedToken);
                /** UPDATE TOKEN::From here you need to store the TOKEN by AJAX request to your server */
            })
            .catch(function(error) {
                /** If some error happens while fetching the token then handle here */
                console.log('Error in fetching refreshed token ' + error);
            });
    });

    // Handle incoming messages
    messaging.onMessage(function(payload) {
        console.log("Payload: " + payload)
        const notificationTitle = 'Data Message Title';
        const notificationOptions = {
            body: 'Data Message body',
            icon: 'https://c.disquscdn.com/uploads/users/34896/2802/avatar92.jpg',
            image: 'https://c.disquscdn.com/uploads/users/34896/2802/avatar92.jpg'
        };

        return self.registration.showNotification(notificationTitle, notificationOptions);
    });
</script>
<script>
    $(document).ready(function() {
        /* close planner */
        $('.close').click(function() {
            $('#collapsePlanner').hide();

            calendari(document.getElementById('calendari'), new Date());
        });
    });
    /* end closeplanner */
    $(".notification-scroll").slimscroll({
        height: "70vh",
    });
    $(".btm-form-flds").slimscroll({
        height: "68vh",
    });
</script>
<script type="text/javascript">
    // $(window).on('load', function() {
    //     $('#welcomeModal').modal('show');
    // });

    // calender js
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
        'M',
        'T',
        'W',
        'T',
        'F',
        'S',
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
</script>
<!-- End Planner Section -->
<script>
    $(document).ready(function() {
        jQuery("#notification-tog").click(function() {
            jQuery("#collapseExample").hide();
            jQuery("#notification").show();
        });

        jQuery("#collapseExample-tog").click(function() {
            jQuery("#collapseExample").show();
            jQuery("#notification").hide();
        });
    });

    $(document).ready(function() {
        jQuery("#nodificbell").click(function() {
            refresh_notification();
            jQuery("#collapsePlanner").hide();
            jQuery("#collapseNotification").show();
            jQuery("#profileAcc").hide();
        });


        jQuery("#plannCal").click(function() {
            jQuery("#collapsePlanner").show();
            jQuery("#collapseNotification").hide();
            jQuery("#profileAcc").hide();
        });
        jQuery(".UserPro").click(function() {
            jQuery("#collapsePlanner").hide();
            jQuery("#collapseNotification").hide();
            //jQuery("#profileAcc").show();
        });


        function refresh_notification() {
            $.ajax({
                url: "{{ url('/refresh-notifications',) }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response_data) {
                    $('#recent_notify').html(response_data);

                },
            });
        }

    });

    document.getElementById("customRange").oninput = function() {
        $('#slide-input').html(this.value);
        var value = (this.value - this.min) / (this.max - this.min) * 100
        this.style.background = 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + value + '%, #fff ' + value +
            '%, white 100%)'
    };

    $(document).ready(function() {

        var today = new Date().toISOString().split('T')[0];

        var dateW = new Date(today);
        var firstW = dateW.getDate() - dateW.getDay() + 1;
        var firstdayW = new Date(dateW.setDate(firstW)).toUTCString();
        var firstDateW = formatDate(firstdayW);

        document.getElementsByName("start_date")[0].setAttribute('min', firstDateW);

        var range_val = $('#customRange').val();
        if (range_val > 0) {
            /* set range for */
            var rvalue = (range_val - 0) / (7 - 0) * 100;
            $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + rvalue + '%, #fff ' +
                rvalue + '%, white 100%)');

            var curr = new Date;
            var firstday = new Date(curr.setDate(curr.getDate() - curr.getDay() + 1));
            var lastday = new Date(curr.setDate(curr.getDate() - curr.getDay() + 7));
            /* var date = new Date(curr);
            var first = date.getDate() - date.getDay() + 1;

            var last = first + 6; // last day is the first day + 6

            var firstday = new Date(date.setDate(first)).toUTCString();
            var lastday = new Date(date.setDate(last)).toUTCString(); */
            var firstDate = formatDate(firstday);
            var lastDate = formatDate(lastday);
            $('#StartDate').val(firstDate);

            $('#EndDate').val(lastDate);

            var planned = <?php echo json_encode($current_week_plan); ?>;

            var count_range_attempted = 0;
            planned.forEach(function(item) {

                var base_path = "{{ url('/') }}";
                var subject_id = item.subject_id;
                var chapter_id = item.chapter_id;
                var chapter_name = item.chapter_name;
                var status = item.test_completed_yn;
                if (status == "Y") {
                    count_range_attempted = count_range_attempted + 1;
                    $('#planner_sub_' + subject_id).append(
                        '<div class="add-removeblock p-2 mb-2 d-flex align-items-center" id="chapter_' + chapter_id +
                        '"><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' +
                        chapter_id + '"><span id="select_chapt_name' + chapter_id + '" class="topic_name">' +
                        chapter_name + '</span>' +
                        '</div>'
                    );
                } else {
                    $('#planner_sub_' + subject_id).append(
                        '<div class="add-removeblock p-2 mb-2 d-flex align-items-center" id="chapter_' + chapter_id +
                        '"><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' +
                        chapter_id + '"><span id="select_chapt_name' + chapter_id + '" class="topic_name">' +
                        chapter_name + '</span>' +
                        '<span class="ms-auto"><a href="javascript:void(0)" onclick="Shuffle_Chapter(' + chapter_id + ',' +
                        subject_id +
                        ')" title="Shuffle Chapter"><img class="mx-2" src="' + base_path + '/public/after_login/images/refersh_ic.png"></a></span><span class=""><a href="javasceript:void(0)" class="chapter_remove" title="Remove Chapter"><img src="' + base_path + '/public/after_login/images/remove_ic.png"></a></span></div>'
                    );
                }
                if ($('#planner_sub_' + subject_id + ' .add-removeblock').length > 0) {

                    $('#added_subject_' + subject_id).removeClass('text-light');
                    $('#added_subject_' + subject_id).addClass('text-success');
                } else {
                    $('#added_subject_' + subject_id).removeClass('text-success');
                    $('#added_subject_' + subject_id).addClass('text-light');
                }
            });



        }
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

        $('#StartDate').change(function(event) {
            var start_date = this.value;

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
                        $("div").remove(".add-removeblock");
                        $('#customRange').val(response.range);
                        $('#slide-input').html(response.range);

                        var ran_value = (response.range - 0) / (7 - 0) * 100;
                        $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' +
                            ran_value + '%, #fff ' + ran_value + '%, white 100%)');


                        var planned_edit = response.planner;
                        var result = Object.values(planned_edit);


                        result.forEach(function(item) {

                            var subject_id = item.subject_id;
                            var chapter_id = item.chapter_id;
                            var chapter_name = item.chapter_name;
                            var status = item.test_completed_yn;
                            var base_path = "{{ url('/') }}";
                            if (status == "Y") {
                                count_range_attempted = count_range_attempted + 1;
                                $('#planner_sub_' + subject_id).append(
                                    '<div class="add-removeblock p-2 mb-2 d-flex align-items-center" id="chapter_' + chapter_id +
                                    '"><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' +
                                    chapter_id + '"><span id="select_chapt_name' + chapter_id + '" class="topic_name">' +
                                    chapter_name + '</span>' +
                                    '</div>'
                                );
                            } else {
                                $('#planner_sub_' + subject_id).append(
                                    '<div class="add-removeblock p-2 mb-2 d-flex align-items-center" id="chapter_' +
                                    chapter_id + '"><input type="hidden" id="select_chapt_id' + chapter_id +
                                    '" name="chapters[]" value="' + chapter_id + '"><span id="select_chapt_name' +
                                    chapter_id + '" class="topic_name">' + chapter_name + '</span>' +
                                    '<span class="ms-auto"><a href="javascript:void(0)" onclick="Shuffle_Chapter(' +
                                    chapter_id + ',' + subject_id +
                                    ')" title="Shuffle Chapter"><img class="mx-2" src="' + base_path + '/public/after_login/images/refersh_ic.png"></a></span><span class=""><a href="javasceript:void(0)" class="chapter_remove" title="Remove Chapter"><img src="' + base_path + '/public/after_login/images/remove_ic.png"></a></span></div>'
                                );
                            }

                        });

                    } else {
                        $("div").remove(".add-removeblock");
                        $('#customRange').val(response.range);
                        $('#slide-input').html(response.range);
                        var ran_value = (response.range - 0) / (7 - 0) * 100;
                        $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' +
                            ran_value + '%, #fff ' + ran_value + '%, white 100%)');

                    }

                    if ($('#planner_sub_' + subject_id + ' .add-removeblock').length > 0) {

                        $('#added_subject_' + subject_id).removeClass('text-light');
                        $('#added_subject_' + subject_id).addClass('text-success');
                    } else {
                        $('#added_subject_' + subject_id).removeClass('text-success');
                        $('#added_subject_' + subject_id).addClass('text-light');
                    }
                }
            });
        });

        $('#search_results').hide();
        $('#search_field').keyup(function(event) {
            var val = event.target.value;

            if (val != '') {
                $('#leaderboard_box_div').hide();
                $('#search_results').show();

                $.ajax({
                    url: "{{ url('/searchFreind',) }}",
                    type: "GET",
                    cache: false,
                    data: {
                        'search_text': event.target.value
                    },
                    success: function(response_data) {
                        let html = '';
                        var data = jQuery.parseJSON(response_data);

                        if (data.success === true) {
                            $.each(data.response, (ele, val) => {
                                if (val.user_profile_img) {
                                    var img_url = val.user_profile_img;
                                } else {
                                    var img_url = "{{url('/') . '/public/after_login/images/profile.png'}}";
                                }

                                html += `<li>
                            <span class="profile-digit">${val.user_rank}.</span>
                            <span class="profile-img-user pt-0"><img class="leader-pic"  src="${img_url}"></span>
                            <span class="profile-text-user">
                                <h3>${val.user_name}</h3>
                                <p>${val.score} Unique score</p>
                            </span>
                        </li>`;

                            });

                        } else {
                            html += `<p>Data not available!</p>`;
                        }
                        $('#search_results .leaderNameBlock-search').html(html);
                    }
                });
            } else {
                $('#search_results').hide();
                $('#leaderboard_box_div').show();
            }
        });
    });


    $(document).ready(function() {
        $(".notification").click(function() {
            $(".notification-right").show();
        });
        $(".close-bnt").click(function() {
            $(".notification-right").hide();
            $("#collapseNotification").collapse('toggle');
        });
    });

    // the following script for profile section
    $(document).ready(function() {

        $(".user-pic-block").click(function() {
            $(".main-profile-section").addClass("blure-bg")
            $(".main-profile-section").toggle();
        });
        /* $(".account-profile").click(function() {
            $(".main-profile-section").toggle();
        }); */
    });

    // the following script for leader board section
    $(document).ready(function() {
        $(".account-profile").click(function() {

            $(".leader-board").toggle();
            $(".subscription").hide();
            $(".log-out-screen").hide();
        });

    });

    // the following js for edit
    $(document).ready(function() {
        $(".edit-btn-show").click(function() {
            $(".edit-form").show();
        });
        $(".edit-btn-show").click(function() {
            $(".profile-show").hide();
        });
    });

    // the following js for and profile edit
    $(document).ready(function() {
        $(".cancel-btn").click(function() {
            $(".profile-show").show();

            $(".edit-form").hide();
            $('#editProfile_form').trigger("reset");
        });
    });

    // the following js for blure
    $(document).ready(function() {
        $(".main-profile-section.blure-bg").click(function() {
            $(".blure-bg").hide();
        });

    });

    // the following script for subscription section  log-out-screen
    $(document).ready(function() {
        $(".subscription-profile").click(function() {

            $(".subscription").toggle();
            $(".leader-board").hide();
            $(".log-out-screen").hide();

        });

    });

    // the following script for log out section
    $(document).ready(function() {
        $(".log-out-btn").click(function() {

            $(".log-out-screen").toggle();
            $(".subscription").hide();
            $(".leader-board").hide();
        });

    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.close').click(function() {
            $('#collapseExample').hide();

            calendari(document.getElementById('calendari'), new Date());
        });
        /*edit planner*/
        var chapters = $('input[name="chapters[]"]').length;
        var limit = $('#customRange').val();
        $('#slide-input').html(chapters);
        $('input[name="weekrange').val(chapters);
        var rvalue1 = (chapters - 0) / (7 - 0) * 100;
        $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + rvalue1 + '%, #fff ' +
            rvalue1 + '%, white 100%)');

        /*edit planner*/

        /*Refer Friend*/
        $('.btn-close').click(function() {
            $('#referEmails').val('');
        });
        /*Refer Friend*/
    });
</script>
<script>
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

            },


        });

    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function handleChange(subject_id) {

        var limit = $('#customRange').val();
        var chapters = [];
        var chapters = $('input[name="chapters[]"]').length;
        var chapter_id = $('#planner_chapter_add').val();
        var chapter_name = $('#planner_chapter_add option:selected').text();
        var base_path = "{{ url('/') }}";


        if (chapter_id != '' || chapter_id != 0) {
            $('#planner_sub_' + subject_id).append('<div class="add-removeblock p-2 mb-2 d-flex align-items-center" id="chapter_' + chapter_id + '"><input type="hidden" id="select_chapt_id' + chapter_id + '" name="chapters[]" value="' + chapter_id + '"><span id="select_chapt_name' + chapter_id + '" class="topic_name">' + chapter_name + '</span>' +
                '<span class="ms-auto"><a href="javascript:void(0)" onclick="Shuffle_Chapter(' + chapter_id + ',' + subject_id + ')" title="Shuffle Chapter"><img class="mx-2" src="' + base_path + '/public/after_login/images/refersh_ic.png"></a></span><span class=""><a href="javasceript:void(0)" class="chapter_remove" title="Remove Chapter"><img src="' + base_path + '/public/after_login/images/remove_ic.png"></a></span></div>');
            $('#plannerChapter').modal('hide');
        } else {
            $('#errChptAdd_alert').html('Please select one option.');
            $('#errChptAdd_alert').show();
            setTimeout(function() {
                $('#errChptAdd_alert').fadeOut('fast');
            }, 5000);
            return false;
        }
        if ($('#planner_sub_' + subject_id + ' .add-removeblock').length > 0) {

            $('#added_subject_' + subject_id).removeClass('text-light');
            $('#added_subject_' + subject_id).addClass('text-success');
        } else {
            $('#added_subject_' + subject_id).removeClass('text-success');
            $('#added_subject_' + subject_id).addClass('text-light');
        }
    }

    $('.chaptbox').on('click', '.chapter_remove', function(e) {
        e.preventDefault();

        $(this).parent().parent().remove();
    });
    $('#exportAnalytics').on('shown.bs.modal', function() {
        $('#specificSizeInputGroupUsername').val("");
        $('#specificSizeInputGroupUsername').focus();
    })

    $.validator.addMethod('dateBefore', function(value, element, params) {
        // if end date is valid, validate it as well
        var end = $(params);
        if (!end.data('validation.running')) {
            $(element).data('validation.running', true);
            setTimeout($.proxy(
                function() {
                    this.element(end);
                }, this), 0);
            // Ensure clearing the 'flag' happens after the validation of 'end' to prevent endless looping
            setTimeout(function() {
                $(element).data('validation.running', false);
            }, 0);
        }
        return this.optional(element) || this.optional(end[0]) || new Date(value) < new Date(end.val());

    }, 'Must be before corresponding end date');

    $.validator.addMethod('dateAfter', function(value, element, params) {
        // if start date is valid, validate it as well
        var start = $(params);
        if (!start.data('validation.running')) {
            $(element).data('validation.running', true);
            setTimeout($.proxy(
                function() {
                    this.element(start);
                }, this), 0);
            setTimeout(function() {
                $(element).data('validation.running', false);
            }, 0);
        }
        return this.optional(element) || this.optional(start[0]) || new Date(value) > new Date($(params).val());

    }, 'Must be after corresponding start date');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#plannerAddform").validate({
        rules: {
            start_date: {
                dateBefore: '#EndDate',
                required: true
            },
            end_date: {
                dateAfter: '#StartDate',
                required: true
            }
        },
        submitHandler: function(form) {

            var limit = $('#customRange').val();
            if (limit <= 0) {
                $('#limit_error_1').html('Please set at least one exam for the selected week.');
                $('#limit_error_1').show();
                setTimeout(function() {
                    $('#limit_error_1').fadeOut('fast');
                }, 5000);
                return false;
            }
            var chapters = [];
            var chapters = $('input[name="chapters[]"]').length;

            if (chapters < limit) {
                $('#limit_error').html('Select minimum ' + limit + ' chapter for planner.');
                /*setTimeout(function() {
                    $('#limit_error').fadeOut('fast');
                }, 5000);*/
                return false;
            }
            if (chapters > limit) {
                $('#limit_error').html('Select minimum ' + limit + ' chapter for planner.');
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
                },
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);

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
                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                }
            });
        }

    });


    $("#file-input").on('change', function() {

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
            success: function(response_data) {

                var response = jQuery.parseJSON(response_data);
                if (response.success == true) {
                    $(".profileimage").attr("src", response.filename);
                    $('#image-upload-response').removeClass('text-danger');
                    $('#image-upload-response').addClass('text-success');
                    $("#image-upload-response").text(response.message);
                    $("#image-upload-response").show();
                    setTimeout(function() {
                        $('#image-upload-response').fadeOut('fast');
                    }, 5000);
                } else {
                    $('#image-upload-response').removeClass('text-success');
                    $('#image-upload-response').addClass('text-danger');
                    $("#image-upload-response").text(response.message);
                    $("#image-upload-response").show();
                    setTimeout(function() {
                        $('#image-upload-response').fadeOut('fast');
                    }, 5000);
                }

                if (response.success === false) {
                    $('#image-upload-response').removeClass('text-success');
                    $('#image-upload-response').addClass('text-danger');
                    $("#image-upload-response").text(response.error.image[0]);
                    setTimeout(function() {
                        $('#image-upload-response').fadeOut('fast');
                    }, 5000);
                }


                //$('#uploaded_image').html(data);
            }
        });
    });


    $.validator.addMethod("mobileregx", function(value, element, regexpr) {
        return regexpr.test(value);
    }, 'Please enter valid mobile number.');
    $("#editProfile_form").validate({
        rules: {
            user_mobile: {
                mobileregx: /^[6-9][0-9]{9}$/,
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: "{{ url('/editProfile') }}",
                type: 'POST',
                data: $('#editProfile_form').serialize(),
                beforeSend: function() {},
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);
                    if (response.success == true) {

                        var user_name = response.user_info.user_name;
                        $('.activeUserName').html(user_name);

                        $(".profile-show").show();
                        $(".edit-form").hide();
                        $("#sucessAcc_edit").html("Profile data updated successfully.");
                        $("#sucessAcc_edit").fadeIn('slow');
                        $("#sucessAcc_edit").fadeOut(10000);
                    } else {
                        $("#errlog_edit").html(response.message);
                        $("#errlog_edit").fadeIn('slow');
                        $("#errlog_edit").fadeOut(10000);
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

<script>
    /* bhim custom js */
    /*Account menu item */
    jQuery(document).ready(function() {
        jQuery('.profile-section li').click(function() {
            jQuery('li.active').removeClass("active");
            jQuery(this).addClass("active");
        });
    });
    /*dashboard left navigation */
    jQuery(document).ready(function() {
        jQuery('.dash-nav-link a').click(function() {
            jQuery('a').removeClass("active");
            jQuery(this).addClass("active");
            //jQuery(this).removeClass("active");
        });
    });
</script>
<!-- planner section move from dashboard -->
<script>
    $(document).ready(function() {

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

    });

    /* refer a friends */
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
            $check = 0;
            var emails = $('#referEmails').val();
            var arrayEmails = emails.split(',');
            var countEmails = arrayEmails.length;

            arrayEmails.forEach(element => {
                var emval = element.trim();
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (re.test(String(emval).toLowerCase()) == false) {
                    $check = 1;
                }
            });


            if (countEmails == 1 && $check == 1) {
                $("#errRef_auth").html("Please enter a valid email")
                $("#errRef_auth").show();
                setTimeout(function() {
                    $('.errRef').fadeOut('fast');
                }, 5000);
                return false;
            }
            if (countEmails != 1 && $check == 1) {
                $("#errRef_auth").html("Please enter valid emails or use correct separator between two emails")
                $("#errRef_auth").show();
                setTimeout(function() {
                    $('.errRef').fadeOut('fast');
                }, 5000);
                return false;
            }
            $.ajax({
                url: "{{ url('/store_referral') }}",
                type: 'POST',
                data: $('#referalStudent_form').serialize(),
                beforeSend: function() {},
                success: function(response_data) {
                    var response = jQuery.parseJSON(response_data);


                    if (response.success == true) {


                        if ((typeof response.duplicate_referrals !== 'undefined') && (response.duplicate_referrals.length > 0)) {

                            const duplicate = response.duplicate_referrals.toString();

                            var errormsg = $("#errRef_auth").show();
                            errormsg[0].textContent = "Already referred Email ids : " + duplicate;
                        }

                        if (response.message != '') {
                            var sucessmsg = $("#successRef_auth").show();
                            sucessmsg[0].textContent = response.message;

                            setTimeout(function() {
                                $('.errRef').fadeOut('fast');
                            }, 3000);

                        }
                        setTimeout(function() {
                            $('.errRef').fadeOut('fast');
                        }, 5000);
                        $('#referEmails').val("");

                    } else {
                        var errormsg = $("#errRef_auth").show();
                        errormsg[0].textContent = "Email already referred";
                        setTimeout(function() {
                            $('.errRef').fadeOut('fast');
                        }, 5000);
                        $('#referEmails').val("");
                    }

                },
                error: function(xhr, b, c) {
                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                }
            });
        }

    });
</script>
<!-- end planner section move from dashboard -->
<script>
    $(window).scroll(function() {
        if ($(window).scrollTop() > 5) {

            $(".planmner-block").css({
                "margin-top": "0"
            }).css({
                "padding-top": "0"
            })
        } else {
            $(".planmner-block").css({
                "margin-top": "100px"
            }).css({
                "padding-top": "0px"
            })
        }
    });

    jQuery(window).scroll(function() {
        if (jQuery(window).scrollTop() > 5) {

            jQuery("#profileAcc").css({
                "margin-top": "0px"
            }).css({
                "padding-top": "15px"
            })
        } else {
            jQuery("#profileAcc").css({
                "margin-top": "100px"
            }).css({
                "padding-top": "0px"
            })
        }
    });
</script>