@extends('layouts.app')

@section('content')
<div class="banner-block"></div>
<div class="banner-bottom-blue">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{URL::asset('public/images/banner-bottom.png')}}" class="img-fluid" />
            </div>
            <div class="col-12 text-center bg-system py-5">
                <div class="left-txt">
                    <h4>Everyone prepares for the big game,</h4>
                    <h3>Few become the game.</h3>
                    <p>
                        An AI/ML based self-assessment and self-analysis tool, UniQ,
                        offers the most exhaustive question bank, well researched
                        solutions and comprehensive practice tests, for students
                        aspiring to excel in All India level competitive exams.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="yellow-bg-block">
        What’s Exciting with <span class="text-danger">UniQ</span>
    </div>
    <div class="container">
        <div class="row align-items-center mt-5 pt-5">
            <div class="col-md-6">
                <img src="{{URL::asset('public/images/img1.png')}}" class="img-fluid" />
            </div>
            <div class="col-md-6 p-5">
                <h4 class="big-txt">Meticulous Self-assessment</h4>
                <h5 class="sml-txt">Based on Adaptive Learning</h5>
            </div>
        </div>
        <div class="row align-items-center mt-5 pt-5">
            <div class="col-md-5 text-end">
                <h4 class="big-txt">Thorough, <br />In-depth</h4>
                <h5 class="sml-txt">Analytics for better Understanding</h5>
            </div>
            <div class="col-md-7">
                <img src="{{URL::asset('public/images/img2.png')}}" class="img-fluid" />
            </div>
        </div>
        <div class="row align-items-center mt-5 pt-5">
            <div class="col-md-7">
                <img src="{{URL::asset('public/images/img3.png')}}" class="img-fluid" />
            </div>
            <div class="col-md-5 p-4 text-start">
                <h4 class="big-txt">Rigorous Practice sessions</h4>
                <h5 class="sml-txt">Questions that push your limits</h5>
            </div>
        </div>
        <div class="row align-items-center mt-5 pt-5">
            <div class="col-md-6 text-end">
                <h4 class="big-txt">Accurate Action points</h4>
                <h5 class="sml-txt">Algorithm based improvement</h5>
            </div>
            <div class="col-md-6">
                <img src="{{URL::asset('public/images/img4.png')}}" class="img-fluid" />
            </div>
        </div>
        <div class="row align-items-center mt-5 pt-5">
            <div class="col-md-6">
                <img src="{{URL::asset('public/images/img5.png')}}" class="img-fluid" />
            </div>
            <div class="col-md-6 p-0 text-start">
                <h4 class="big-txt">Innovative, Informative</h4>
                <h5 class="sml-txt">New age techniques, be future ready</h5>
            </div>
        </div>
        <div class="row align-items-center mt-5 pt-5">
            <div class="col-md-5 p-0 text-end">
                <h4 class="big-txt">Fuels Mental Agility</h4>
                <h5 class="sml-txt">Stress free, quick grasp</h5>
            </div>
            <div class="col-md-7">
                <img src="{{URL::asset('public/images/img6.png')}}" class="img-fluid" />
            </div>
        </div>
    </div>
    <div class="pic-block mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7 p-0 ms-auto">
                    <img src="{{URL::asset('public/images/img7.png')}}" class="img-fluid" />
                    <div class="">
                        <h4 class="big-txt text-white">Improves Physical Stamina</h4>
                        <h5 class="sml-txt text-white">
                            Replicates the exam hall scenario
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="right-game">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="right-game-txt text-center">
                        Choose the right <span class="text-danger">Game</span> for you
                    </h2>
                    <p class="right-game-txtsml text-center">
                        your dream exam to get into dream college
                    </p>
                    <div><img src="{{URL::asset('public/images/img8.png')}}" class="img-fluid" /></div>
                </div>
            </div>
        </div>
    </div>
    <div class="yellow-bg-block text-center py-5">
        <img src="{{URL::asset('public/images/yello-bg.png')}}" class="img-fluid" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="right-game-txt text-center">You Ready?</h2>
                <button class="btn btn-danger rounded-0 mt-5 px-5">
                    GO FOR IT <i class="fas fa-arrow-right ms-3"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="{{URL::asset('public/images/footer.png')}}" class="img-fluid" />
            </div>
        </div>
    </div>
</footer>
@endsection

<script>
    var top1 = $('#block1').offset().top;
    var top2 = $('#block2').offset().top;
    var top3 = $('#block3').offset().top;

    $(document).scroll(function() {
        var scrollPos = $(document).scrollTop();
        if (scrollPos >= top1 && scrollPos < top2) {
            $('#change').addClass('block1');
        } else if (scrollPos >= top2 && scrollPos < top3) {
            $('#change').addClass('block2');
            $('#change').removeClass('block1');
        } else if (scrollPos >= top3) {
            $('#change').addClass('block3');
            $('#change').removeClass('block2');
        } else if (scrollPos < top1) {
            $('#change').removeClass('block1');
            $('#change').removeClass('block2');
            $('#change').removeClass('block3');
        }
    });
</script>