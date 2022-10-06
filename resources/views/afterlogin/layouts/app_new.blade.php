<!DOCTYPE html>


<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Q&I</title>
    <meta name="description" content="">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .circletop {
    position: relative;
    overflow: hidden;
    font-size: 119px;
    min-width: 1em;
    height: 1em;
    border-radius: 100%;
    display: inline-block;
    top: -15px;
}
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />
    <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    @if(env('MINIFY_STATIC_ASSETS') == 'true')

    <!------   current css ------>
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/style.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/page_clander.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/custom_clander.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/theme_clander.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/mobile.min.css')}}">
    @else
    <!------   current css ------>
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/page_clander.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/custom_clander.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/theme_clander.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/mobile.css')}}">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script type="text/javascript" src="{{URL::asset('public/js/jquery-3.6.0.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="{{URL::asset('public/after_login/current_ui/js/calendar.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <script src="https://d3js.org/d3.v4.js"></script>

    <script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML-full"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
            messageStyle: "none",
            menuSettings: {
                zoom: "None",
    context: "Browser"
  }
            });
</script>
    <script>
        $(window).on('load', function() {
            if ($("#welcomeModal").length > 0) {
                $('#welcomeModal').modal('show');
            }
        });
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src=https://www.googletagmanager.com/gtag/js?id=G-2HBNQEQHDQ></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-2HBNQEQHDQ');
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
<style>
    .time_taken_css span:first-child {
        font-weight: 600;
    }

    .counter {
        position: relative;
        right: 25px;
        margin-left: auto;
        margin-right: -50px;
    }

    .counter .progressBar .seconds {
        width: 100%;
        position: absolute;
        text-align: center;
        color: #FFF;
        font-weight: 600;
        top: -2px;

    }

    .tiny-green {
        position: relative;
        padding: 0px;
        width: 87px;
        background-color: #E4E4E4;
        height: 14px;
        border-radius: 4px;
    }

    .tiny-green div {
        font-family: arial;
        font-size: 3px;
        height: inherit;
        color: white;
        text-align: right;
        text-shadow: 0px 0px 2px #000;
        text-indent: 9999px;
        overflow: hidden;
        background-color: #56b663;
        border-radius: 4px;
    }
</style>

<body class="login-body-bg" id="main-body">


    @yield('content')


</body>

</html>