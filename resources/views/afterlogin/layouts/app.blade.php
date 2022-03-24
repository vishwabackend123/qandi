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
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />
    <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>
    <link href="{{URL::asset('public/after_login/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="{{URL::asset('public/after_login/css/style.css')}}">
    <link href='{{URL::asset("public/after_login/css/style-slider.css")}}' rel='stylesheet' />
    <script src="{{URL::asset('public/after_login/js/touchslider.js')}}"></script>
    <style>
    #overlay {
        background: #ffffff;
        color: #666666;
        position: fixed;
        height: 100%;
        width: 100%;
        z-index: 5000;
        top: 0;
        left: 0;
        float: left;
        text-align: center;
        padding-top: 25%;
        opacity: .80;
    }



    .spinner {
        margin: 0 auto;
        height: 64px;
        width: 64px;
        animation: rotate 0.8s infinite linear;
        border: 5px solid firebrick;
        border-right-color: transparent;
        border-radius: 50%;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .ans-block.row.mt-5.N_radioans .mb-4 .ans .mjx-chtml,
    .ans-block.row.mt-5.N_radioans .mb-4 .ans .MathJax,
    .ans-block.row.mt-5.N_radioans .mb-4 .ans .mjx-char,
    .ans-block.row.mt-5.N_radioans .mb-4 .ans .math,
    .ans-block.row.mt-5.N_radioans .mb-4 .ans .MathJax,
    .ans-block.row.mt-5.N_radioans .mb-4 .ans .MathJax_CHTML {
        top: 4px;
    }

    </style>
</head>

<body class="login-body-bg  h-100" id="main-body">
    <div id="overlay" style="display:none;">
        <div class="spinner"></div>
        <br />
        Loading...
    </div>
    @yield('content')
</body>

</html>
