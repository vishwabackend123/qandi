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
  <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>

  <link href="{{URL::asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::asset('public/css/style.css')}}">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

</head>

<body class="pageBg ">
  <nav class="py-0 px-7 navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="{{URL::asset('public/images/main-logo-red.png')}}" class="img-fluid" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-right navbar-collapse me-right " style="flex-direction: row-reverse;" id="navbarSupportedContent">
        <ul class="navbar-nav me-right mb-2 mb-lg-0">
          <li class="nav-item mx-3">
            <a href="{{ route('subscriptions') }}" class="nav-link side-links">Subscription</a>
          </li>
          <li class="nav-item mx-3">
            <a href="{{ route('aboutexam') }}" class="nav-link side-links">About Exam</a>
          </li>
          <li class="nav-item mx-3">
            <a href="{{ route('faq') }}" class="nav-link side-links">FAQ</a>
          </li>
          <li class="nav-item redLink">


            @auth
            <div>
              <a class="nav-link mx-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
            @else
            <a href="{{ route('login') }}" class="nav-link ">Login / Sign up</a>
            @endauth
          </li>

        </ul>

      </div>
    </div>
  </nav>


  @yield('content')




  <script type="text/javascript" src="{{URL::asset('public/js/jquery-2.2.4.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('public/js/bootstrap.bundle.min.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>

  <script type="text/javascript" src="{{URL::asset('public/js/jquery.slimscroll.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
      document.getElementById("mySidenav").style.width = "600px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

    $('#scrollDiv').slimscroll({
      height: '70vh'
    });
    $('.scroll-content').slimscroll({
      height: '20vh'
    });
    $('.scroll-achiv').slimscroll({
      height: '25vh'
    });
  </script>



</body>

</html>