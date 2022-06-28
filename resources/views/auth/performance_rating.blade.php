
@extends('layouts.app')
@section('content')
<section class="subscriptionsPage d-flex">
    <div class="subscriptionsLeftpannel">
        <img src="https://app.thomsondigital2021.com/public/images_new/QI_Logo.gif" class="logo">
        <div class="progress-box">
            <ul class="progressorder">
                <li class="progress__item  progress__item--active">
                    <p class="progress__title">Select Plan</p>
                    <p class="progress__info">Decide on the best plan for your preparation</p>
                </li>
                <li class="progress__item">
                    <p class="progress__title">Self Analysis</p>
                    <p class="progress__info">Rate your level of proficiency</p>
                </li>
                <li class="progress__item ">
                    <p class="progress__title">You order is out for delivery</p>
                    <p class="progress__info">Delivery Executive is out for delivery</p>
                </li>
            </ul>
        </div>
        <div class="verificationBox">
            <p>A verification link has been sent to<b> Sakshi@gmail.com</b>, please click the link to get your account verified</p>
            <a href="">Resend</a>
        </div>
    </div>
    <div class="selectPlan subscriptionsRightpannel">
        <div class="SelectPlane_text">
            <h3>Self Analysis</h3>
            <p>Rate your level of proficiency</p>
        </div>
        <div class="performance_rating_wrapper">
            <div class="subject-level-proficiency mb-5">
                <h5>Mathematics</h5>
                <ul class="proficiency-level-lists d-flex justify-content-beween flex-wrap">
                    <li>
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Beginner</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Foundation level</label>
                    </li>
                    <li class="selected-level">
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Intermediate</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b></b>
                            <b></b>
                            <b></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                        </span>
                        <label class="mb-0">Proficient</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b></b>
                            <b></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Expert</label>
                    </li>
                </ul>
            </div>
            <div class="subject-level-proficiency mb-5">
                <h5>Chemistry</h5>
                <ul class="proficiency-level-lists d-flex justify-content-beween flex-wrap">
                    <li>
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Beginner</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Foundation level</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Intermediate</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b></b>
                            <b></b>
                            <b></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                        </span>
                        <label class="mb-0">Proficient</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b></b>
                            <b></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Expert</label>
                    </li>
                </ul>
            </div>
            <div class="subject-level-proficiency">
                <h5>Physics</h5>
                <ul class="proficiency-level-lists d-flex justify-content-beween flex-wrap">
                    <li>
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Beginner</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Foundation level</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Intermediate</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b></b>
                            <b></b>
                            <b></b>
                            <b class="rate-level-active"></b>
                            <b class="rate-level-active"></b>
                        </span>
                        <label class="mb-0">Proficient</label>
                    </li>
                    <li>
                        <span class="mr-3">
                            <b></b>
                            <b></b>
                            <b class="rate-level-active"></b>
                            <b></b>
                            <b></b>
                        </span>
                        <label class="mb-0">Expert</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection