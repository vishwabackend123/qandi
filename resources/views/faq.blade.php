<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>/title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link href="{{URL::asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{URL::asset('public/css/pre-login-style.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>

<body class="faq-page h-100" id="main-body">
    <div id="mySidenav" class="sidenav d-flex align-items-center flex-column justify-content-center">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="side-nav-links">
            <a href="{{ route('subscriptions') }}" class="side-links">Subscription</a>
            <a href="https://www.uniqtoday.com/about-exam/" class="side-links">About Exam</a>
            <a href="https://www.uniqtoday.com/faqs/" class="side-links">FAQ</a>
            <a href="{{ route('login') }}" class="side-links">Login</a>
            <a href="{{ route('register') }}" class="red-btn mt-2">Sign up</a>
        </div>
    </div>
    <div class="static-left-nav">
        <div class="logo-block bg-white p-4">
        </div>
        <div class="yellow-block">
            <div class="p-5 bg-light d-flex flex-column align-items-center justify-content-center">
            </div>
            <div class="d-flex flex-column  p-5 h-75 static-left-links">
            </div>
        </div>
    </div>
    <div class="prelogin-main-wrapper h-100">
        <header class="pre-login-header">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col ">
                        <img src="{{URL::asset('public/images/UNIQ-black.png')}}" class="img-fluid">
                    </div>
                    <div class="col ms-auto text-end">
                        <span onclick="openNav()" class="nav-btn-box"><span class="nav-btn"></span></span>
                    </div>
                </div>
            </div>
        </header>
        <div class="content-wrapper download-height">
            <div class="container-fluid h-100">
                <div class="row h-100  ">
                    <div class="col-md-10 mx-auto">
                        <h1 class="fs-1 mt-5 mb-3 fw-800 text-center text-uppercase">Frequently Asked Questions</h1>
                        <div class="about-exam">
                            <div class="accordion" id="accordionExample">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        I am unable to login?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How do I reset my password?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        How do I update my profile?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        How do I set a goal for me?
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="headingfive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                        Can I go back and change the goals anytime ?
                                    </button>
                                </h2>
                                <div id="collapsefive" class="accordion-collapse collapse" aria-labelledby="headingfive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        The system is running slow?
                                    </button>
                                </h2>
                                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading6">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapseThree">
                                        Image based questions are taking time to load?
                                    </button>
                                </h2>
                                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6"" id=" #accordionExample">
                                    " data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading7">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                        Do you have a mobile app too?
                                    </button>
                                </h2>
                                <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading8">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                        How will this tool help me in preparing in my exam?
                                    </button>
                                </h2>
                                <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading9">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                        How does the tool help in personalizing learning?
                                    </button>
                                </h2>
                                <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading10">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                        How does the tool help in personalizing learning?
                                    </button>
                                </h2>
                                <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading11">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                        On how many devices can I log in using pin/pwd
                                    </button>
                                </h2>
                                <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="heading12">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                        Is there a guided tour or set of instructions to start using the tool?
                                    </button>
                                </h2>
                                <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('public/js/jquery-3.6.0
.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('public/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{URL::asset('public/js/jquery.slimscroll.min.js')}}"></script>
    <script type="text/javascript">
    /* Set the width of the side navigation to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "600px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    $('.scroll-div').slimscroll({
        height: '40vh'
    });
    $('.hScroll').slimscroll({
        height: '45vh'
    });

    $('.about-exam').slimscroll({
        height: '80vh'
    });
    var starClicked = false;

    </script>
</body>

</html>
