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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />
    <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!--  <link rel="stylesheet" href="css/style.css"> -->

    <link rel="stylesheet" href="{{URL::asset('public/css/style.css')}}">

    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/exam-analytics.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/exampage.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/new_ui/css/responsive.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
    <script type="text/javascript" src="{{URL::asset('public/js/jquery-3.6.0.min.js')}}"></script>

    <script>
        $(window).on('load', function() {
            if ($("#welcomeModal").length > 0) {
                $('#welcomeModal').modal('show');
            }
        });
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
</style>

<body class="login-body-bg" id="main-body">


    @yield('content')


</body>

</html>