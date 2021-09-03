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

<body class=" h-100" id="main-body">
    <div id="mySidenav" class="sidenav d-flex align-items-center flex-column justify-content-center">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="side-nav-links">
            <a href="{{ route('subscriptions') }}" class="side-links">Subscription</a>
            <a href="{{ route('aboutexam') }}" class="side-links">About Exam</a>
            <a href="{{ route() }}" class="side-links">FAQ</a>
            <a href="{{ route('login') }}" class="side-links">Login</a>
            <a href="{{ route('register') }}" class="red-btn mt-2">Sign up</a>
        </div>

    </div>
    <div class="static-left-nav">
        <div class="logo-block bg-white p-4">
            <img src="{{URL::asset('public/images/UNIQ-black.png')}}" class="img-fluid">
        </div>
        <div class="yellow-block">
            <div class="p-5 bg-light d-flex flex-column align-items-center justify-content-center">
                <select class="form-select rounded-0 text-white bg-dark w-75 text-uppercase" aria-label="Default select example">
                    <option selected>JEE-Mains</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="d-flex flex-column  p-5 h-75 static-left-links">
                <span><a href="#" class="active-links"><img src="{{URL::asset('public/images/Group 3064.png')}}"> Brief</a></span>
                <span><a href="#"><img src="{{URL::asset('public/images/Group 3062@2x.png')}}"> Eligibility Criteria</a></span>
                <span><a href="#"><img src="{{URL::asset('public/images/Group 1826.png')}}"> Important Dates</a></span>
                <span><a href="#"><img src="{{URL::asset('public/images/Group 3059.png')}}"> Application Process</a></span>
                <span><a href="#"><img src="{{URL::asset('public/images/Group 3060.png')}}"> Cut-Off</a></span>
                <span><a href="#"><img src="{{URL::asset('public/images/Group 3061.png')}}"> Counselling Procedure</a></span>
                <span><a href="#"><img src="{{URL::asset('public/images/Group 3058@2x.png')}}"> Prepration Procedure</a></span>
                <span><a href="#"><img src="{{URL::asset('public/images/Group 3057@2x.png')}}"> Popular Cources </a></span>
            </div>
        </div>
    </div>
    <div class="prelogin-main-wrapper h-100">
        <header class="pre-login-header">
            <div class="container-fluid ">
                <div class="row">

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
                        <div class="about-exam pe-5">
                            <div class="row">
                                <div class="col-3"><span>Target Field</span> <span class="d-block">Engineering</span> </div>
                                <div class="col-3"><span>Tentative Month(s)</span> <span class="d-block">February, March, April, and
                                        May</span> </div>
                                <div class="col-3"><span>Duration</span> <span class="d-block">3 hours</span> </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-3"><span>Eligible Candidates</span> <span class="d-block">Standard 12th students</span>
                                </div>
                                <div class="col-3"><span>Applicants</span> <span class="d-block">Over 12 lakh</span> </div>
                                <div class="col-3"><span>Language</span> <span class="d-block">English, Hindi and Gujarati</span> </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-3"><span>Subjects</span> <span class="d-block">Physics, Chemistry, Mathematics</span>
                                </div>
                                <div class="col-3"><span>Qualify</span> <span class="d-block"> </span> </div>

                            </div>
                            <div class="row mt-5">
                                <div class="col-3"><span>Question Type</span> <span class="d-block">Objective</span> </div>

                            </div>
                            <h1 class="fs-1 mt-5 mb-3">What is JEE Main?</h1>
                            <p>JEE is one of the most prestigious and challenging entrance examinations in the country. Lakhs of
                                students appear for the exam every year to get admission in the best Engineering colleges. JEE Main is
                                also the qualifying exam for JEE Advanced, which is the eventual gateway for admission to any of the
                                IITs.</p>
                            <p>As per the Union Education Minister’s announcement, JEE Main 2021 will be held in four sessions, i.e.,
                                in February, March, April, and May 2021. The sessions will be held from 23rd to 26th February 2021, 15th
                                to 18th March, 27th to 30th April, and 24th to 28th May 2021. The exam will be held in two shifts,
                                morning session from 9 AM to 12 PM, afternoon shift from 3 PM to 6 PM.</p>
                            <p> Following are some important points and major changes in JEE Main 2021:</p>
                            <p> _Candidates can apply for one or more sessions together and pay the exam fee accordingly.</p>
                            <p>_Candidates can choose to apply for one session at a time, they can apply again for the remaining
                                session when the application window reopens after the declaration of the last held session.</p>
                            <p> _If a candidate doesn’t want to appear for the session for which the fee is already paid, they will
                                have to make a request during the application process and the amount will be refunded by NTA.</p>
                            <p> _If any candidate appears for more than one session, then their best score our of the multiple
                                attempts will be considered for preparation of merit list/ ranking.</p>
                            <p> _JEE Main 2021 exam pattern has been revised and the total number of questions will now be 90, unlike
                                75 in 2019. However, they need to attempt only 75 questions out of the total 90 questions.</p>
                            <p> _Physics, Chemistry, and Mathematics subjects have now been divided into two sections – Section A & B.
                                All three </p>
                            <table class="table-bordered table w-100 my-4">
                                <tr>
                                    <td>Exam Name</td>
                                    <td>JEE Main (Joint Entrance Exam)</td>
                                </tr>
                                <tr>
                                    <td>Exam Conducting Body</td>
                                    <td>JEE Main (Joint Entrance Exam)</td>
                                </tr>
                                <tr>
                                    <td>Exam Frequency</td>
                                    <td>JEE Main (Joint Entrance Exam)</td>
                                </tr>
                            </table>
                            <small>Read More:&nbsp;&nbsp; BITSAT Eligiblity &nbsp;| &nbsp;NTSE Eligiblity</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{URL::asset('public/js/jquery-2.2.4.min.js')}}"></script>
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
        // $(window).on('load', function() {
        //     $('#welcomeModal').modal('show');
        // });

        $('.scroll-div').slimscroll({
            height: '40vh'
        });
        $('.hScroll').slimscroll({
            height: '45vh'
        });

        $('.about-exam').slimscroll({
            height: '80vh'
        });
    </script>
</body>

</html>