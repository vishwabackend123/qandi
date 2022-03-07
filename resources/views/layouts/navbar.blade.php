<nav class="py-0 px-7 navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{URL::asset('public/images_new/QI_Logo.png')}}" class="img-fluid" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-right navbar-collapse me-right " style="flex-direction: row-reverse;" id="navbarSupportedContent">
            <ul class="navbar-nav me-right mb-2 mb-lg-0">
                <li class="nav-item mx-3">
                    <a href="{{ route('subscriptions') }}" class="nav-link side-links">Subscription</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="https://www.uniqtoday.com/about-exam/" class="nav-link side-links">About Exam</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="https://www.uniqtoday.com/faqs/" class="nav-link side-links">FAQ</a>
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