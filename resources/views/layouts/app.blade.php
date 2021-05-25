<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UNIQ</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />

    <link href="{{URL::asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('public/css/style.css')}}">
</head>

<body class="login-body-bg">
    <div id="mySidenav" class="sidenav d-flex align-items-center flex-column justify-content-center">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="side-nav-links">
            <a href="#" class="side-links">Subscription</a>
            <a href="#" class="side-links">About Exam</a>
            <a href="#" class="side-links">FAQ</a>
            <a href="{{ route('login') }}" class="side-links">Login</a>
            <a href="{{ route('register') }}" class="red-btn mt-2">Sign up</a>
        </div>

    </div>
    <header class="pt-5 pb-4 px-7">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <a href="#" class="logo"><img src="{{URL::asset('public/images/main-logo.png')}}" class="img-fluid"></a>
                </div>
                <div class="col text-end">
                    <span onclick="openNav()" class="nav-btn-box"><span class="nav-btn"></span></span>
                </div>
            </div>
        </div>
    </header>

    <section class="px-7">

        @yield('content')

    </section>


    <script src="{{URL::asset('public/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{URL::asset('public/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>

    <script>
        /* Set the width of the side navigation to 250px */
        function openNav() {
            document.getElementById("mySidenav").style.width = "600px";
        }

        /* Set the width of the side navigation to 0 */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>


    </script>
</body>

</html>