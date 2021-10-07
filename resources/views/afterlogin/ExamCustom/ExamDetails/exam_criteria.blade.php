@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper h-100">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper download-height mb-5">
        <div class="container-fluid h-100">
            <div class="row h-100  ">
                <div class="col-md-10 mx-auto">
                    <div class="about-exam pe-5">
                        <div class="row">
                            <div class="col-3"><span>Target Field</span> <span class="d-block">Engineering</span> </div>
                            <div class="col-3"><span>Tentative Month(s)</span> <span class="d-block">February, March, April, and May</span> </div>
                            <div class="col-3"><span>Duration</span> <span class="d-block">3 hours</span> </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3"><span>Eligible Candidates</span> <span class="d-block">Standard 12th students</span> </div>
                            <div class="col-3"><span>Applicants</span> <span class="d-block">Over 12 lakh</span> </div>
                            <div class="col-3"><span>Language</span> <span class="d-block">English, Hindi and Gujarati</span> </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3"><span>Subjects</span> <span class="d-block">Physics, Chemistry, Mathematics</span> </div>
                            <div class="col-3"><span>Qualify</span> <span class="d-block"> </span> </div>

                        </div>
                        <div class="row mt-5">
                            <div class="col-3"><span>Question Type</span> <span class="d-block">Objective</span> </div>

                        </div>
                        <h1 class="fs-1 mt-5 mb-3">What is JEE Main?</h1>
                        <p>JEE is one of the most prestigious and challenging entrance examinations in the country. Lakhs of students appear for the exam every year to get admission in the best Engineering colleges. JEE Main is also the qualifying exam for JEE Advanced, which is the eventual gateway for admission to any of the IITs.</p>
                        <p>As per the Union Education Minister’s announcement, JEE Main 2021 will be held in four sessions, i.e., in February, March, April, and May 2021. The sessions will be held from 23rd to 26th February 2021, 15th to 18th March, 27th to 30th April, and 24th to 28th May 2021. The exam will be held in two shifts, morning session from 9 AM to 12 PM, afternoon shift from 3 PM to 6 PM.</p>
                        <p> Following are some important points and major changes in JEE Main 2021:</p>
                        <p> _Candidates can apply for one or more sessions together and pay the exam fee accordingly.</p>
                        <p>_Candidates can choose to apply for one session at a time, they can apply again for the remaining session when the application window reopens after the declaration of the last held session.</p>
                        <p> _If a candidate doesn’t want to appear for the session for which the fee is already paid, they will have to make a request during the application process and the amount will be refunded by NTA.</p>
                        <p> _If any candidate appears for more than one session, then their best score our of the multiple attempts will be considered for preparation of merit list/ ranking.</p>
                        <p> _JEE Main 2021 exam pattern has been revised and the total number of questions will now be 90, unlike 75 in 2019. However, they need to attempt only 75 questions out of the total 90 questions.</p>
                        <p> _Physics, Chemistry, and Mathematics subjects have now been divided into two sections – Section A & B. All three </p>
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




@include('afterlogin.layouts.footer')
<script>
    $('.about-exam').slimscroll({
        height: '80vh'
    });
</script>

@endsection