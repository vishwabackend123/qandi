<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Q&I</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />
    <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!--  <link rel="stylesheet" href="css/style.css"> -->
    @if(env('MINIFY_STATIC_ASSETS') == 'true')
    <!-- <link rel="stylesheet" href="{{URL::asset('public/css/style.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/style.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/exam-analytics.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/exampage.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/responsive.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/tab-responsive.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/mobile-responsive.min.css')}}"> -->
    <!------   current css ------>
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/style.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/page_clander.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/custom_clander.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/theme_clander.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/mobile.min.css')}}">
    @else
    <!-- <link rel="stylesheet" href="{{URL::asset('public/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/exam-analytics.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/exampage.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/responsive.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/tab-responsive.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/mobile-responsive.css')}}"> -->
    <!------   current css ------>
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/page_clander.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/custom_clander.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/theme_clander.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/mobile.css')}}">
    @endif

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
    <script type="text/javascript" src="{{URL::asset('public/js/jquery-3.6.0.min.js')}}"></script>
    <!-- <script type="text/javascript" src="{{URL::asset('public/js/bootstrap.min.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
<script  src="{{URL::asset('public/after_login/current_ui/js/calendar.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

    <script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML-full"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
        
            menuSettings: {
    context: "Browser"
  }
            });
</script>
    <!-- <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML-full"></script>
 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(window).on('load', function() {
            if ($("#welcomeModal").length > 0) {
                $('#welcomeModal').modal('show');
            }
        });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src=https://www.googletagmanager.com/gtag/js?id=G-5M3C3F04YY></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());



        gtag('config', 'G-5M3C3F04YY');


        /* no back prevention code */
        /*  $(document).ready(function() {
             window.history.pushState(null, "", window.location.href);
             window.onpopstate = function() {
                 window.history.pushState(null, "", window.location.href);
             };
         }); */
        /* no back prevention code */
    </script>


</head>

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

    html {
        user-select: none;
    }

    p:empty {
        display: none;
    }
</style>

<body class="login-body-bg" id="main-body">


    @yield('content')


</body>

</html>