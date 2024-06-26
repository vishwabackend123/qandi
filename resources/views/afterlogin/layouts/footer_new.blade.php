<style type="text/css">
    .leader-board ul li span p {
        font-size: 12px;
        opacity: 0.5;
        color: #2c3348;
        font-weight: normal;
        text-transform: none;
    }
</style>
<div class="modal fade" id="exportAnalytics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 bg-light">
            <div class="modal-header pb-0 border-0">
                <button type="button" class="btn-close dwnlod_pdf_btn" data-bs-dismiss="modal" aria-label="Close" title="Close">
                    <img src="{{URL::asset('public/after_login/new_ui/images/cross.png')}}">
                </button>
            </div>
            <div class="modal-body pt-0 px-5 ">
                <div class="text-center my-5">
                    <a href="javascript:void(0);"><button class="btn px-4 top-btn-pop text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Group 4887" width="20" height="24" viewBox="0 0 24 24">
                                <path data-name="Path 82" d="M0 0h24v24H0z" style="fill:none"></path>
                                <path data-name="Path 83" d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                <path data-name="Path 84" d="m7 11 5 5 5-5" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none"></path>
                                <path data-name="Line 45" transform="translate(11.79 4)" style="stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.5px;fill:none" d="M0 0v12"></path>
                            </svg>
                            &nbsp;Download PDF</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loader-block" style="display:none;">
    <img src="{{URL::asset('public/after_login/new_ui/images/loader.gif')}}">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{URL::asset('public/after_login/new_ui/js/jquery.slimscroll.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/funnel.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-messaging.js"></script>
<script src="{{URL::asset('public/after_login/current_ui/js/custom.js')}}"></script>

<!------------------ Current Js ----------------------------------->
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>
<script>
    (function($) {
        $(document).ready(function() {
            $('.input-range').each(function() {
                var value = $(this).attr('value');

                var separator = value.indexOf(',');
                if (separator !== -1) {
                    value = value.split(',');
                    value.forEach(function(item, i, arr) {
                        arr[i] = parseFloat(item);
                    });
                } else {
                    value = parseFloat(value);
                }
                $(this).slider({
                    formatter: function(value) {

                        $('#slide-input').html(value);

                        return '$' + value;
                    },
                    min: parseFloat($(this).attr('min')),
                    max: parseFloat($(this).attr('max')),
                    range: $(this).attr('range'),

                });
            });

        });
    })(jQuery);
</script>
<script>
    /** Your web app's Firebase configuration 
     * Copy from Login 
     *      Firebase Console -> Select Projects From Top Naviagation 
     *      -> Left Side bar -> Project Overview -> Project Settings
     *      -> General -> Scroll Down and Choose CDN for all the details
     */
    var firebaseConfig = {
        apiKey: "{{$secretKeysRedis['apiKey']}}",
        authDomain: "{{$secretKeysRedis['authDomain']}}",
        projectId: "{{$secretKeysRedis['projectId']}}",
        storageBucket: "{{$secretKeysRedis['storageBucket']}}",
        messagingSenderId: "{{$secretKeysRedis['messagingSenderId']}}",
        appId: "{{$secretKeysRedis['appId']}}",
        measurementId: "{{$secretKeysRedis['measurementId']}}"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    /**
     * We can start messaging using messaging() service with firebase object
     */
    var messaging = firebase.messaging();



    // Handle incoming messages
    messaging.onMessage(function(payload) {
        console.log("Payload: " + payload)
        const notificationTitle = 'Data Message Title';
        const notificationOptions = {

            body: payload.data.body,
            time: payload.data.time,
        };
        $('#recent_notify').prepend($('<div class="notification-txt">' +
            '<span class="bell-noti"><img src="{{URL::asset(`public/after_login/new_ui/images/bell.jpg`)}}"></span>' +
            '<span class="text-notific">' + payload.data.title + '</span>' +
            '</div>'));

        console.log(notificationOptions);

        //return self.registration.showNotification(notificationTitle, notificationOptions);
    });

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
</script>
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
        $(".notification").click(function() {
            $(".notification-right").show();
        });
        $(".close-bnt").click(function() {
            $(".notification-right").hide();
            $("#collapseNotification").collapse('toggle');
        });

        /* function for select sity */
        $('#select-city').on("click keyup", function(event) {
            $('#state_list').hide();
            var val = event.target.value;
            var state = $('#select-state').val();
            $('.loader-block').show();


            $.ajax({
                url: "{{ url('/getCity',) }}",
                type: "GET",
                cache: false,
                data: {
                    'search_text': event.target.value,
                    'state': state,
                },
                success: function(response_data) {
                    $('.loader-block').hide();
                    let html = '';
                    var data = jQuery.parseJSON(response_data);

                    if (data.success === true) {

                        html += data.response;

                    } else {
                        html += `<ul><li>Cities</li></ul>`;
                    }
                    $('#city_list').html(html);
                    $('#city_list').show();
                    $('#city_remark').show();
                    $("#myInput").focus();

                }
            });
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
        if (chapters == '0') {
            $('#saveplannerbutton').addClass('disabled');
        }
        var limit = $('#customRange').val();
        $('#slide-input').html(chapters);

        $('.input-range').slider('setValue', chapters);

        $('input[name="weekrange').val(chapters);

        var rvalue1 = (chapters - 0) / (7 - 0) * 100;
        $('#customRange').css("background", 'linear-gradient(to right, #AFF3D0 0%, #AFF3D0 ' + rvalue1 + '%, #fff ' +
            rvalue1 + '%, white 100%)');

        /*edit planner*/


    });
</script>
<script>
    $(document).on('click', function(e) {
        /* bootstrap collapse js adds "in" class to your collapsible element*/
        var menu_opened = $('#submenu').hasClass('show');

        if (!$(e.target).closest('#submenu').length &&
            !$(e.target).is('#submenu') &&
            menu_opened === true) {
            var url = window.location.pathname.split("/");
            var pathurl = url[1];
            if (pathurl == 'overall_analytics') {
                $(".dash-nav-link a:nth-child(2)").removeClass("active-navlink");
                $(".dash-nav-link a:first-child").removeClass("active-navlink");
                $('.practiceClass').removeClass('practiceopen');
            }

            $('#submenu').collapse('toggle');
        }
        var menu_opened = $('#submenu2').hasClass('show');

        if (!$(e.target).closest('#submenu').length &&
            !$(e.target).is('#submenu2') &&
            menu_opened === true) {
            $('#submenu2').collapse('toggle');
        }
        var menu_opened = $('#submenu3').hasClass('show');

        if (!$(e.target).closest('#submenu').length &&
            !$(e.target).is('#submenu3') &&
            menu_opened === true) {
            $('#submenu3').collapse('toggle');
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
    $('.wrapper-dashboard').click(function() {
        $(".dash-nav-link a:nth-child(2)").removeClass("active-navlink");
        $(".dash-nav-link a:first-child").addClass("active-navlink");
        $('.practiceClass').removeClass('practiceopen');

    });
    $('.menu2').click(function() {
        var menu_opened = $('#submenu3').hasClass('show');

        if (menu_opened === true) {
            $('#submenu3').collapse('toggle');
        }
    });
    $('.menu3').click(function() {
        var menu_opened = $('#submenu2').hasClass('show');

        if (menu_opened === true) {
            $('#submenu2').collapse('toggle');
        }
    });




    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }






    $('#exportAnalytics').on('shown.bs.modal', function() {
        $('#specificSizeInputGroupUsername').val("");
        $('#specificSizeInputGroupUsername').focus();
    })
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
            jQuery('.dash-nav-link a').removeClass("active");
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
        $('#referEmails').keyup('keyup', function() {
            var inputdata = $(this).val();
            if (inputdata == '') {
                $('#errRef_auth').hide();
            }
        });

    });

    /* refer a friends */
    var validator = $("#referalStudent_form").validate({
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
                emval = emval.replaceAll('"', '');
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
                            errormsg[0].textContent = "Already referred Email id : " + duplicate;
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
                        $('#referfrnd').modal('hide');
                        $('#referedfrnd').modal('show');

                    } else {
                        if ((typeof response.duplicate_referrals !== 'undefined') && (response.duplicate_referrals.length > 0)) {

                            const duplicate = response.duplicate_referrals.toString();

                            var errormsg = $("#errRef_auth").show();
                            errormsg[0].textContent = "Already referred Email id : " + duplicate;
                        } else {
                            var errormsg = $("#errRef_auth").show();
                            errormsg[0].textContent = response.message;
                        }
                        setTimeout(function() {
                            $('.errRef').fadeOut('fast');
                        }, 5000);
                    }

                },
                error: function(xhr, b, c) {
                    console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                }
            });
        }

    });
    /*Refer Friend*/
    $('.btn-close').click(function() {
        $('#referEmails').val('');
        validator.resetForm();
    });
    /*Refer Friend*/
</script>
<!-- end planner section move from dashboard -->
<script>
    $(window).scroll(function() {
        if ($(window).scrollTop() > 5) {

            $(".planmner-block").css({
                "margin-top": "-6px"
            }).css({
                "padding-top": "0"
            })
        } else {
            $(".planmner-block").css({
                "margin-top": "70px"
            }).css({
                "padding-top": "0px"
            })
        }
    });

    jQuery(window).scroll(function() {
        if (jQuery(window).scrollTop() > 5) {

            jQuery("#profileAcc").css({
                "margin-top": "-6px"
            }).css({
                "padding-top": "15px"
            })
        } else {
            jQuery("#profileAcc").css({
                "margin-top": "70px"
            }).css({
                "padding-top": "0px"
            })
        }
    });


    $(".dash-nav-link a").click(function() {
        if (!$(this).hasClass("active-navlink")) {
            $(this).addClass("active-navlink");
            $(this).siblings().removeClass("active-navlink");
        }
    });


    jQuery(window).scroll(function() {
        if (jQuery(window).scrollTop() > 5) {

            jQuery("div#collapseNotification").css({
                "margin-top": "-6px"
            }).css({
                "padding-top": "15px"
            })
        } else {
            jQuery("div#collapseNotification").css({
                "margin-top": "70px"
            }).css({
                "padding-top": "0px"
            })
        }
    });
</script>
<script>
    $("#sharefrnd .btn-close").click(function() {
        $(".dash-nav-link a:last-child").removeClass("active-navlink");
        $(".dash-nav-link a:first-child").addClass("active-navlink");
    });
    $("#close-planner-btn , .close-bnt").click(function() {
        $("span.notification.ms-4").removeClass("notification-icons-active");
        var url = window.location.pathname.split("/");
        var pathurl = url[1];
        if (pathurl == 'overall_analytics') {
            $(".analytics-icon").addClass("notification-icons-active");
        }
    });
    $('#sharefrnd').click(function(event) {

        event.stopPropagation();
        var url = window.location.pathname.split("/");
        var pathurl = url[1];
        if (pathurl == 'overall_analytics') {
            $(".dash-nav-link a:last-child").removeClass("active-navlink");
            $(".dash-nav-link a:first-child").removeClass("active-navlink");
        } else {
            $(".dash-nav-link a:last-child").removeClass("active-navlink");
            $(".dash-nav-link a:first-child").addClass("active-navlink");
        }

        $('.openSharefrnd').removeClass('popupopen');
        $("#sharefrnd").modal('hide');

    });
    $('.refereModel').click(function(event) {
        event.stopPropagation();
        $(".dash-nav-link a:last-child").addClass("active-navlink");
        $(".dash-nav-link a:first-child").removeClass("active-navlink");

    });
    $('.openSharefrnd').click(function(event) {
        $('.practiceClass').removeClass('practiceopen');
        if (isDoubleClicked($(this))) return;
        var validator = $("#referalStudent_form").validate();
        validator.resetForm();
        $('#referEmails').val("");
        $('#errRef_auth').css('display', 'none');
        if ($(this).hasClass('popupopen')) {
            $(this).removeClass('popupopen');
            var url = window.location.pathname.split("/");
            var pathurl = url[1];
            if (pathurl == 'overall_analytics') {
                $(".dash-nav-link a:last-child").removeClass("active-navlink");
                $(".dash-nav-link a:first-child").removeClass("active-navlink");
            } else {
                $(".dash-nav-link a:last-child").removeClass("active-navlink");
                $(".dash-nav-link a:first-child").addClass("active-navlink");
            }

        } else {
            $(this).addClass('popupopen');
        }
    });
    $('.refereModel').on('click', '.btn-close', function(event) {
        event.stopPropagation();
        var url = window.location.pathname.split("/");
        var pathurl = url[1];
        if (pathurl == 'overall_analytics') {
            $(".dash-nav-link a:last-child").removeClass("active-navlink");
            $(".dash-nav-link a:first-child").removeClass("active-navlink");
        } else {
            $(".dash-nav-link a:last-child").removeClass("active-navlink");
            $(".dash-nav-link a:first-child").addClass("active-navlink");
        }

    });
    $('.practiceClass').click(function(e) {
        $('#sharefrnd').modal('hide');
        if (isDoubleClicked($(this))) return;
        $('.openSharefrnd').removeClass('popupopen');
        var url = window.location.pathname.split("/");
        var pathurl = url[1];
        if (pathurl == 'dashboard') {
            if ($(this).hasClass('practiceopen')) {
                $(this).removeClass('practiceopen');
                $(".dash-nav-link a:nth-child(2)").removeClass("active-navlink");
                $(".dash-nav-link a:first-child").addClass("active-navlink");
            } else {
                $(this).addClass('practiceopen');
            }
        } else if (pathurl == 'overall_analytics') {
            if ($(this).hasClass('practiceopen')) {
                $(this).removeClass('practiceopen');
                $(".dash-nav-link a:nth-child(2)").removeClass("active-navlink");
                $(".dash-nav-link a:first-child").removeClass("active-navlink");
            } else {
                $(this).addClass('practiceopen');
            }
        }

    });
</script>
<script>
    $(".dash-nav-link a:last-child").click(function() {
        $("body").addClass("refer-modal-open")
    });
    $("#sharefrnd .btn-close").click(function() {
        $("body").removeClass("refer-modal-open")
    });
    $("#customRange").change(function() {
        var limit = $(this).val();
        var chapters = $('input[name="chapters[]"]').length;
        if (limit == '0') {
            $('#saveplannerbutton').addClass('disabled');
        } else if (limit <= 0) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (chapters < limit) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (chapters > limit) {
            $('#saveplannerbutton').addClass('disabled');
        } else if (limit == chapters) {
            $('#saveplannerbutton').removeClass('disabled');
        }
    });

    $(".user-pic-block.UserPro").click(function() {
        $(".user-name-block span.notification").removeClass("notification-icons-active")
    });

    $(".notification.me-5.ms-4").click(function() {
        if ($(this).hasClass("notification-icons-active")) {
            $("div#collapseNotification.notification-block").addClass("notification-block-active");
        } else {
            $("div#collapseNotification.notification-block").removeClass("notification-block-active");
            var url = window.location.pathname.split("/");
            var pathurl = url[1];
            if (pathurl == 'overall_analytics') {
                $(".analytics-icon").addClass("notification-icons-active");
            }
        }
    });
    $("#collapseNotification .notification-right a , .notification.ms-4.planmner_icon , .user-pic-block.UserPro").click(function() {
        $("div#collapseNotification.notification-block").removeClass("notification-block-active");


        if (!$('.planmner_icon').hasClass("notification-icons-active")) {
            var url = window.location.pathname.split("/");
            var pathurl = url[1];
            if (pathurl == 'overall_analytics') {
                $(".analytics-icon").addClass("notification-icons-active");
            }
        }

    });
    $(".goto-planner-btn").click(function() {
        $("html, body, .wrapper-dashboard").animate({
            scrollTop: 0
        }, "100");
        $(".planmner_icon").addClass("notification-icons-active");
        $("#collapsePlanner").show();
    });

    $(".user-pic-block.UserPro").on('click', function() {
        $("#LeaDer , .profile-show").addClass("animateAccountCard");
        $(".profile-section ul li:first-child").addClass("active");
        $(".profile-section ul li:nth-child(2) , .profile-section ul li:nth-child(3)").removeClass("active");
        if ($(".profile-section ul li:first-child").hasClass("active")) {
            $("#LeaDer , .profile-show").addClass("showCard");
            $(".log-out-screen , .subscription-box").removeClass("showCard");
        }
    });
    $(".profile-picture-txt #EdiTbtnnn").click(function() {
        $("#LeaDer , .profile-show").removeClass("showCard");
    });
    $("#editProfile_form #cancelEdit").click(function() {
        $("#LeaDer , .profile-show").addClass("showCard");
    });

    function isDoubleClicked(element) {
        //if already clicked return TRUE to indicate this click is not allowed
        if (element.data("isclicked")) return true;

        //mark as clicked for 1 second
        element.data("isclicked", true);
        setTimeout(function() {
            element.removeData("isclicked");
        }, 1000);

        //return FALSE to indicate this click was allowed
        return false;
    }
</script>
<script>
    $(".dropdown-menu.cust-dropdown li").click(function() {
        $(this).parent().prev().parent().addClass("category_selct");
    });
    $("a.clear-filter").click(function() {
        $(this).prev().removeClass(" category_selct");
    });

    function searchCity() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        if (input.value.length >= 3 || input.value == '') {

            $.ajax({
                url: "{{ url('/searchCity',) }}",
                type: "GET",
                cache: false,
                data: {
                    'search_text': input.value
                },
                success: function(response_data) {
                    let html = '';
                    var data = jQuery.parseJSON(response_data);

                    if (data.success === true) {

                        html += data.response;

                    } else {
                        html += `<li>Cities</li>`;
                    }
                    $('#myMenu').html(html);
                }
            });
        }
    }

    function searchState() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInputState");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myStateList");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            txtValue = li[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>



<script>
    /*********Notification-Scrolljs*************/
    $('a[href="#referfrnd"]').click(function() {
        $('.mobilemenu').removeClass("showmenu");
        $('#menumobilehide').hide();
        $("#menumobile").show();
        $('body').removeClass('sidebartoggle');
        $('html').removeClass("windowhidden");
    });
    $('.notificationnew').click(function() {
        $('.mobilemenu').removeClass("showmenu");
        $('#menumobilehide').hide();
        $("#menumobile").show();
        $('body').removeClass('sidebartoggle');
        $(this).toggleClass('bellactive');
        $('.notification-block_new').toggleClass('activeblock');
        if ($('.notification-block_new').hasClass('activeblock')) {
            $('html').addClass("scrollnone");
        } else {
            $('html').removeClass("scrollnone");
        };
    });
    $('.headericon.dropdown,.sidebar-menu-lists a').click(function() {
        $('.notification-block_new').removeClass('activeblock');
        $('.notification-block_new').removeClass('show');
        $('.notificationnew').removeClass('bellactive');
        $('html').removeClass("scrollnone");
    });
    $('#referfrnd,#referedfrnd').on('shown.bs.modal', function (e) {
          $('body').addClass('refrerpopUp');  
        })
        $('#referfrnd,#referedfrnd').on('hidden.bs.modal', function (e) {
             $('body').removeClass('refrerpopUp');
        })

    /*********Notification-Js*****/
    </script>


<script>
    $('.submitBtnlink').click(function() {
        $('body').addClass("make_me_blue");
    });
</script>
<script>
/*************Mobiletab-scroll **************/
$.fn.tabbing = function (options) {
    var opts = {delayTime : 300};
    options = options || {};
    opts = $.extend(opts,options);    
    return this.each(function () {
        $(this).on('click', function (event) {
            event.preventDefault();
            var sum = 0;
            $(this).prevAll().each(function(){  sum += $(this).width();});
          var get = document.querySelector('.mobilescrolltabNew').scrollWidth
            var dist = sum - ( $(this).parent().width() - $(this).width()) / 2;
          if(dist < 0){
            dist = 0;
          }
          /* else if(dist+sum > get){
            dist = get-sum+dist+dist;
          } */
            $(this).parent().animate({
                scrollLeft: dist
            },opts['delayTime']);
        });
    });
};
$('.mobilescrolltabNew li,.mobilescrolltabNew  .singleChoice ').tabbing();
/**************Mobiletab-scroll-end*****************/
</script>