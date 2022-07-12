@extends('afterlogin.layouts.app_new')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<div class="exam-wrapper">
    <div class="content-wrapper">
        <div class="examSereenwrapper">
            <div class="examMaincontainer">
                <div class="examLeftpanel">
                    <div class="tabMainblock">
                        <div class="examScreentab">
                            <div class="examTabheader">
                                <div class="tablist">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4 active" data-bs-toggle="tab" href="#evaluation">Math <span class="qCount">65</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#application">Physics <span class="qCount">65</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#complrehension">Chemistry <span class="qCount">65</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="submitBtn">
                                    <a href="" class="submitBtnlink">
                                        <span class="btnText">Submit Test</span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path
                                                    d="M16.95 7.767 5.284 1.934a2.5 2.5 0 0 0-3.4 3.25l2 4.475a.883.883 0 0 1 0 .683l-2 4.475a2.5 2.5 0 0 0 2.283 3.517c.39-.004.774-.095 1.125-.267l11.667-5.833a2.5 2.5 0 0 0 0-4.467h-.009zm-.741 2.975L4.542 16.575a.833.833 0 0 1-1.125-1.083l1.992-4.475c.025-.06.048-.12.066-.183h5.742a.833.833 0 0 0 0-1.667H5.475a1.668 1.668 0 0 0-.066-.183L3.417 4.509a.833.833 0 0 1 1.125-1.084L16.209 9.26a.834.834 0 0 1 0 1.483z"
                                                    fill="#fff"
                                                />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="questionType">
                                <div class="questionTypeinner">
                                    <div class="questionChoiceType">
                                        <div class="questionChoice"><a class="singleChoice">Section A (20Q) - Single Choice</a> <a class="numericalChoice">Section B (10Q) - Numerical</a></div>
                                    </div>
                                    <div class="timeCounter">
                                        Average Time:
                                        <div id="progressBar"><div class="bar"></div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content aect_tabb_contantt">
                                <div id="evaluation" class="tab-pane active">
                                    <div class="questionsliderinner">
                                        <div class="questionSlider owl-carousel owl-theme">
                                            <div class="item">
                                                <div class="questionsliderbox">	
                                                    <div class="questionwrapper">
                                                        <div class="questionheader">
                                                            <div class="question">
                                                                <span class="q-no">Q1.</span>
                                                                <p>
                                                                    GivenGiven A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the
                                                                    value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then
                                                                    find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl. A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="questionOptionBlock">
                                                            <div class="fancy-radio-buttons row with-image">
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt1" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt1" class="image-bg"> <span class="seNo">A</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt2" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt2" class="image-bg"> <span class="seNo">B</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt3" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt3" class="image-bg"> <span class="seNo">C</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt4" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt4" class="image-bg"> <span class="seNo">D</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="questionsliderbox">	
                                                    <div class="questionwrapper">
                                                        <div class="questionheader">
                                                            <div class="question">
                                                                <span class="q-no">Q1.</span>
                                                                <p>
                                                                    GivenGiven A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the
                                                                    value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then
                                                                    find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl. A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="questionOptionBlock">
                                                            <div class="fancy-radio-buttons row with-image">
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt1" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt1" class="image-bg"> <span class="seNo">A</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt2" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt2" class="image-bg"> <span class="seNo">B</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt3" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt3" class="image-bg"> <span class="seNo">C</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt4" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt4" class="image-bg"> <span class="seNo">D</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="questionsliderbox">	
                                                    <div class="questionwrapper">
                                                        <div class="questionheader">
                                                            <div class="question">
                                                                <span class="q-no">Q1.</span>
                                                                <p>
                                                                    GivenGiven A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the
                                                                    value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then
                                                                    find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl. A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="questionOptionBlock">
                                                            <div class="fancy-radio-buttons row with-image">
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt1" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt1" class="image-bg"> <span class="seNo">A</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt2" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt2" class="image-bg"> <span class="seNo">B</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt3" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt3" class="image-bg"> <span class="seNo">C</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt4" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt4" class="image-bg"> <span class="seNo">D</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="item">
                                                <div class="questionsliderbox">	
                                                    <div class="questionwrapper">
                                                        <div class="questionheader">
                                                            <div class="question">
                                                                <span class="q-no">Q1.</span>
                                                                <p>
                                                                    GivenGiven A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the
                                                                    value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then
                                                                    find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl. A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="questionOptionBlock">
                                                            <div class="fancy-radio-buttons row with-image">
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt1" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt1" class="image-bg"> <span class="seNo">A</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt2" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt2" class="image-bg"> <span class="seNo">B</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt3" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt3" class="image-bg"> <span class="seNo">C</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt4" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt4" class="image-bg"> <span class="seNo">D</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="item">
                                                <div class="questionsliderbox">	
                                                    <div class="questionwrapper">
                                                        <div class="questionheader">
                                                            <div class="question">
                                                                <span class="q-no">Q1.</span>
                                                                <p>
                                                                    GivenGiven A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the
                                                                    value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then
                                                                    find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl. A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="questionOptionBlock">
                                                            <div class="fancy-radio-buttons row with-image">
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt1" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt1" class="image-bg"> <span class="seNo">A</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt2" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt2" class="image-bg"> <span class="seNo">B</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt3" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt3" class="image-bg"> <span class="seNo">C</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt4" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt4" class="image-bg"> <span class="seNo">D</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="item">
                                                <div class="questionsliderbox">	
                                                    <div class="questionwrapper">
                                                        <div class="questionheader">
                                                            <div class="question">
                                                                <span class="q-no">Q1.</span>
                                                                <p>
                                                                    GivenGiven A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the
                                                                    value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then
                                                                    find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl. A and B are sqaure matrices of order 3 such that lAl=-1lBl=3,
                                                                    then find the value of l3ABl.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="questionOptionBlock">
                                                            <div class="fancy-radio-buttons row with-image">
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt1" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt1" class="image-bg"> <span class="seNo">A</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt2" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt2" class="image-bg"> <span class="seNo">B</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt3" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt3" class="image-bg"> <span class="seNo">C</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                                <div class="colMargin">
                                                                    <div class="image-container">
                                                                        <input type="radio" id="opt4" name="ff-radiobuttons" class="correct" />
                                                                        <label for="opt4" class="image-bg"> <span class="seNo">D</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>




                                    
                                </div>
                                <div id="application" class="tab-pane">adasdas</div>
                                <div id="complrehension" class="tab-pane">complrehension</div>
                            </div>
                        </div>
                    </div>
                    <div class="btnbottom">
                        <div class="questionbtnBlock">
                            <div class="questionLeftbtns"><button class="btn questionbtn">Mark for Review</button> <button class="btn questionbtn Clearbtn">Clear Response</button></div>
                            <div class="questionRightbtns"><button class="btn questionbtn">Save & Mark for Review</button> <button class="btn questionbtn">Save & Next</button></div>
                        </div>
                    </div>
                </div>

                <div class="examRightpanel">
                    <div class="main-textexam-sec">
                        <div class="text-examtop-sec">
                            <p>
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity=".1" d="M20 40c11.046 0 20-8.954 20-20S31.046 0 20 0 0 8.954 0 20s8.954 20 20 20z" fill="#363C4F" />
                                    <path d="M31.896 32.835A17.503 17.503 0 1 1 20 2.5V20l11.896 12.835z" fill="#44CD7F" />
                                    <path d="M20 32.683c7.005 0 12.683-5.678 12.683-12.683 0-7.004-5.678-12.683-12.683-12.683S7.317 12.996 7.317 20c0 7.005 5.678 12.683 12.683 12.683z" fill="#EBEBED" />
                                    <path d="M20 26.41a6.19 6.19 0 1 0 0-12.38 6.19 6.19 0 0 0 0 12.38z" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20 17.582v2.457h1.638M15.905 12.668l-2.252 1.638M24.095 12.668l2.252 1.638" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>112 mins Left</span>
                                <label>
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="14" cy="14" r="8.4" fill="#fff" />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M25.2 14a11.2 11.2 0 1 1-22.4 0 11.2 11.2 0 0 1 22.4 0zM9.8 11.2a1.4 1.4 0 1 1 2.8 0v5.6a1.4 1.4 0 0 1-2.8 0v-5.6zm7-1.4a1.4 1.4 0 0 0-1.4 1.4v5.6a1.4 1.4 0 0 0 2.8 0v-5.6a1.4 1.4 0 0 0-1.4-1.4z"
                                            fill="#00AB16"
                                        />
                                    </svg>
                                </label>
                            </p>
                        </div>
                        <div class="text-exammid-sec">
                            <p>Overview</p>
                            <div class="exam-ans-sec top-first">
                                <div class="ans1">Answered</div>
                                <div class="ans-in-num">24</div>
                            </div>
                            <div class="exam-ans-sec">
                                <div class="ans2">Unanswered</div>
                                <div class="ans-in-num">2</div>
                            </div>
                            <div class="exam-ans-sec">
                                <div class="ans3">Marked for review</div>
                                <div class="ans-in-num">3</div>
                            </div>
                            <div class="exam-ans-sec">
                                <div class="ans4">Answered &amp; marked for review</div>
                                <div class="ans-in-num">1</div>
                            </div>
                        </div>

                        <div class="text-exambottom-sec">
                            <button type="button" class="btn" id="btn-ans">1</button>
                            <button type="button" class="btn" id="btn-ans">2</button>
                            <button type="button" class="btn" id="btn-ans">3</button>
                            <button type="button" class="btn" id="btn-ans">4</button>
                            <button type="button" class="btn" id="btn-ans">5</button>
                            <button type="button" class="btn" id="btn-ans">6</button>
                            <button type="button" class="btn" id="btn-ans">7</button>

                            <button type="button" class="btn" id="btn-ans">8</button>
                            <button type="button" class="btn" id="btn-ans">9</button>
                            <button type="button" class="btn" id="btn-ans">10</button>
                            <button type="button" class="btn pink-btn" id="btn-ans">11</button>
                            <button type="button" class="btn" id="btn-ans">12</button>
                            <button type="button" class="btn" id="btn-ans">13</button>
                            <button type="button" class="btn" id="btn-ans">14</button>

                            <button type="button" class="btn" id="btn-ans">15</button>
                            <button type="button" class="btn" id="btn-ans">16</button>
                            <button type="button" class="btn" id="btn-ans">17</button>
                            <button type="button" class="btn blue-btn" id="btn-ans">18</button>
                            <button type="button" class="btn" id="btn-ans">19</button>
                            <button type="button" class="btn" id="btn-ans">20</button>
                            <button type="button" class="btn" id="btn-ans">21</button>
                            <button type="button" class="btn" id="btn-ans">22</button>
                            <button type="button" class="btn border-btn" id="btn-ans">23</button>
                            <button type="button" class="btn" id="btn-ans">24</button>
                            <button type="button" class="btn" id="btn-ans">25</button>
                            <button type="button" class="btn" id="btn-ans">26</button>
                            <button type="button" class="btn" id="btn-ans">27</button>
                            <button type="button" class="btn" id="btn-ans">28</button>
                            <button type="button" class="btn" id="btn-ans">29</button>
                            <button type="button" class="btn" id="btn-ans">30</button>
                            <button type="button" class="btn" id="btn-ans">31</button>
                            <button type="button" class="btn" id="btn-ans">32</button>
                            <button type="button" class="btn" id="btn-ans">33</button>
                            <button type="button" class="btn" id="btn-ans">34</button>
                            <button type="button" class="btn" id="btn-ans">36</button>
                            <button type="button" class="btn" id="btn-ans">37</button>
                            <button type="button" class="btn" id="btn-ans">38</button>
                            <button type="button" class="btn" id="btn-ans">39</button>
                            <button type="button" class="btn" id="btn-ans">42</button>
                            <button type="button" class="btn" id="btn-ans">43</button>
                            <button type="button" class="btn" id="btn-ans">44</button>
                            <button type="button" class="btn" id="btn-ans">45</button>
                        </div>

                        <div class="custom-exam d-none">
                            <div class="text-examtop-sec">
                                <p>
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity=".1" d="M20 40c11.046 0 20-8.954 20-20S31.046 0 20 0 0 8.954 0 20s8.954 20 20 20z" fill="#363C4F" />
                                        <path d="M31.896 32.835A17.503 17.503 0 1 1 20 2.5V20l11.896 12.835z" fill="#44CD7F" />
                                        <path d="M20 32.683c7.005 0 12.683-5.678 12.683-12.683 0-7.004-5.678-12.683-12.683-12.683S7.317 12.996 7.317 20c0 7.005 5.678 12.683 12.683 12.683z" fill="#EBEBED" />
                                        <path d="M20 26.41a6.19 6.19 0 1 0 0-12.38 6.19 6.19 0 0 0 0 12.38z" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20 17.582v2.457h1.638M15.905 12.668l-2.252 1.638M24.095 12.668l2.252 1.638" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>112 mins Left</span>
                                    <label>
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="14" cy="14" r="8.4" fill="#fff" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M25.2 14a11.2 11.2 0 1 1-22.4 0 11.2 11.2 0 0 1 22.4 0zM9.8 11.2a1.4 1.4 0 1 1 2.8 0v5.6a1.4 1.4 0 0 1-2.8 0v-5.6zm7-1.4a1.4 1.4 0 0 0-1.4 1.4v5.6a1.4 1.4 0 0 0 2.8 0v-5.6a1.4 1.4 0 0 0-1.4-1.4z"
                                                fill="#00AB16"
                                            />
                                        </svg>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="bck-btn">Back</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 
<style>
    .questionsliderinner{
        position: relative;
    }


.customNavigation a {
  position: absolute;
  height: 40px;
  width: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;
  border-radius: 50%;
  opacity: 1;
  margin-top: auto;
  margin-bottom: auto;
  box-shadow: -2px 1px 10px #bdbdbd;
  top: calc(50% - 20px);
  cursor: pointer;
}
.customNavigation .prev {
  left: -15px;
}
.customNavigation .next {
  right: -15px;
}


.questionSlider {
    position: relative;
}
.questionSlider .owl-nav{
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
}

.questionSlider .owl-next span {
    right: 0;
    font-size: 17px;
    padding: 0px;
    position: absolute;
    bottom: -8px;
    text-align: center;
    margin: auto;
    color: #363c4f;
    background-color: #f5faf6;
    width: 28px;
    height: 28px;
    border: 1px solid #56b663;
    border-radius: 6px;
    font-weight: 700;
    box-shadow: 0 1px 2px 0 rgb(16 24 40 / 5%) !important;
 
}
.questionSlider .owl-prev span {
    left: 0;
    font-size: 17px;
    padding: 0px;
    position: absolute;
    bottom: -8px;
    text-align: center;
    margin: auto;
    color: #363c4f;
    background-color: #f5faf6;
    width: 28px;
    height: 28px;
    border: 1px solid #56b663;
    border-radius: 6px;
    font-weight: 700;
    box-shadow: 0 1px 2px 0 rgb(16 24 40 / 5%) !important;
   
}
 
button.owl-next.disabled span{
    box-shadow: 0 1px 2px 0 rgb(16 24 40 / 5%) !important;
    border: solid 1px rgb(126 128 133 / 50%) !important;
}

.examMaincontainer {
    display: flex;
}
.exam-wrapper {
    background: #f5faf6;
}
.examLeftpanel {
    width: calc(100% - 379px);
    height: 100vh;
}
.examScreentab {
    position: relative;
}
.btnText {
    padding-right: 8px;
}
.submitBtnlink {
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 800;
    font-stretch: normal;
    line-height: 1.6;
    color: #ffffff;
    background-color: #56b663;
    display: flex;
    align-items: center;
    height: 44px;
}
.examMaincontainer {
    display: flex;
}
.exam-wrapper {
    background: #f5faf6;
}
.examLeftpanel {
    width: calc(100% - 379px);
    height: 90vh;
    position: relative;
}
.examRightpanel {
    min-width: 379px;
    max-width: 379px;
    height: 90vh;
    margin: 0 0 0 40px;
    padding: 40px 28px 10px;
    border-radius: 20px;
    box-shadow: 0 8px 30px 0 rgba(172, 185, 176, 0.14);
    background-color: #ffffff;
}
.submitBtn {
    position: absolute;
    top: 0px;
    right: 0px;
}
.questionTypeinner {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.timeCounter {
    display: flex;
    align-items: center;
    font-size: 12px;
    font-weight: 500;
    line-height: 1.3;
    color: #363c4f;
    text-transform: uppercase;
}
#progressBar {
    width: 87px;
    height: 14px;
    flex-grow: 0;
    margin: 1px 0 1px 12px;
    padding: 0 59px 0 0;
    border-radius: 4px;
    background-color: rgba(54, 60, 79, 0.1);
}

#progressBar div {
    height: 100%;
    text-align: right;
    padding: 0 10px;
    line-height: 22px;
    width: 0;
    background-color: #56b663;
    box-sizing: border-box;
    border-radius: 4px;
}
.questionChoice {
    width: 490px;
    height: 36px;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    margin: 28px 132px 40px 0;
    padding: 3px;
    border-radius: 6px;
    background-color: #e0f5e3;
}

.singleChoice {
    flex-grow: 0;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 8px;
    padding: 4px 16px;
    border-radius: 4px;
    background-color: #56b663;
    font-size: 14px;
    font-weight: 600;
    line-height: 1.6;
    letter-spacing: normal;
    text-align: left;
    color: #ffffff;
}
.singleChoice:hover {
    color: #fff;
}
.numericalChoice:hover {
    color: #000000;
}
.numericalChoice {
    flex-grow: 0;
    font-family: Manrope;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.6;
    letter-spacing: normal;
    text-align: left;
    color: #363c4f;
}
.examScreentab .nav-tabs .nav-link {
    padding: 0px 0px 24px;
    opacity: 0.6;
    border: 0px;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.6;
    color: #363c4f;
    margin-right: 46px !important;
}
.qCount {
    position: relative;
    padding-left: 12px;
    margin-left: 4px;
}
.qCount:before {
    content: "";
    position: absolute;
    height: 5px;
    width: 5px;
    border-radius: 100%;
    background-color: #000000;
    top: 10px;
    left: 0px;
}
.examScreentab .nav-tabs {
    border-bottom: 1px solid #e0e0e0;
}
.examScreentab .nav-tabs .nav-item.show .nav-link,
.examScreentab .nav-tabs .nav-link.active {
    border: 0px;
    font-size: 16px;
    font-weight: 800;
    line-height: 1.6;
    color: #363c4f;
    border-bottom: 4px solid #363c4f;
    opacity: 1;
    background-color: transparent;
}
.questionwrapper {
    margin: auto;
    max-height: calc(100% - 270px);
    overflow: overlay;
    padding: 0px 100px;
}
.questionOptionBlock {
    padding-top: 100px;
    max-width: 710px;
    width: 100%;
    margin: auto;
}
.questionheader .q-no {
    padding-right: 16px;
}
.questionheader .question {
    flex-grow: 1;
    display: flex;
    font-family: Manrope;
    font-size: 16px;
    font-weight: bold;
    line-height: 1.4;
    letter-spacing: normal;
    text-align: left;
}
.fancy-radio-buttons input[type="radio"] {
    position: absolute;
    opacity: 0;
}
.fancy-radio-buttons input[type="radio"] + label:before {
    box-sizing: border-box;
}
.fancy-radio-buttons input[type="radio"] + label:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 1em;
    width: 1em;
    border-radius: 1em;
    border: 0.3em solid #ffffff;
    visibility: hidden;
}
.fancy-radio-buttons input[type="radio"] ~ .image-bg {
    border: 1px solid #a1a1a1;
    border-radius: 5px;
    display: block;
    cursor: pointer;
    width: 100%;
    height: auto;
    padding: 10px 221px 10px 14px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: bold;
    display: flex;
    background: #ffffff;
}
.fancy-radio-buttons input[type="radio"] + label:before {
    background: #ffffff;
    z-index: 1;
}
.fancy-radio-buttons input[type="radio"]:checked ~ .image-bg {
    box-shadow: 0 1px 2px 0 rgb(16 24 40 / 5%);
    border: solid 1px rgba(86, 182, 99, 0.5);
    background: #e0f6e3;
}
.fancy-radio-buttons input[type="radio"].correct:checked + label:before {
    background: #70c1b3;
}
.fancy-radio-buttons input[type="radio"]:disabled + label,
.fancy-radio-buttons input[type="radio"]:disabled + label:before,
.fancy-radio-buttons input[type="radio"]:disabled ~ .image-bg {
    opacity: 0.8;
    cursor: not-allowed;
}
.fancy-radio-buttons input[type="radio"].correct:disabled + label,
.fancy-radio-buttons input[type="radio"].correct:disabled + label:before,
.fancy-radio-buttons input[type="radio"].correct:disabled ~ .image-bg {
    opacity: 1;
    cursor: not-allowed;
}
.fancy-radio-buttons.with-image input[type="radio"] + label:before,
.fancy-radio-buttons.with-image input[type="radio"] + label:after {
    top: calc(50% - 0.5em);
}
.fancy-radio-buttons.with-image img {
    max-width: 100%;
}
.image-bg .seNo {
    width: 21px;
    height: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 10px;
    margin: 2px 19px 2px 0;
    padding: 1px 6px;
    border-radius: 2px;
    line-height: 18px;
}
.fancy-radio-buttons input[type="radio"].correct:checked ~ .image-bg .seNo {
    background-color: #56b663;
    color: #ffffff;
}
.fancy-radio-buttons.with-image {
    justify-content: center;
    flex-flow: wrap;
    display: flex;
}
.fancy-radio-buttons .colMargin {
    padding: 0px;
    max-width: 313px;
    min-height: 44px;
    margin: 0 38px 38px 0;
    width: 100%;
}
.questionbtnBlock {
    display: flex;
    justify-content: space-between;
}
.questionLeftbtns,
.questionRightbtns {
    display: flex;
    justify-content: space-between;
}
.btn.questionbtn {
    padding: 8px 16px;
    border-radius: 8px;
    border: solid 1px #56b663;
    background-color: #f5faf6;
    color: #56b663;
    font-size: 14px;
    font-weight: 800;
    height: 44px;
} 

.questionLeftbtns .questionbtn:first-child,
.questionRightbtns .questionbtn:first-child {
    padding-left: 16px;
    margin-right: 16px;
}
.btn.questionbtn.Clearbtn {
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    background-color: #f5faf6;
    color: rgba(54, 60, 79, 0.5);
    font-size: 14px;
    font-weight: 800;
    height: 44px;
}
.btnbottom {
    position: absolute;
    bottom: 0px;
    width: 100%;
}

/* shiv start css for text exam  */

.text-examtop-sec p span {
    font-size: 22px;
    color: #2c3348;
    font-weight: normal;
    display: inline-block;
    padding: 0px 32px;
}
.text-examtop-sec > p {
    text-align: center;
    margin: 0px;
    padding-bottom: 40px;
    border-bottom: 1px solid rgba(205, 227, 208, 0.5);
}

.text-exammid-sec > p {
    margin: 0;
    padding-top: 20px;
    font-size: 16px;
    font-weight: 800;
}

button#btn-ans {
    background: #56b663;
    color: #fff;
    width: 28px;
    height: 28px;
    font-size: 12px;
    font-weight: 800;
    padding: 0 !important;
}

.text-exambottom-sec {
    padding-top: 20px;
    border-top: 1px solid rgba(172, 185, 176, 0.14);
    display: flex;
    flex-flow: wrap;
    justify-content: start;
    height: 195px;
    overflow-y: scroll;
}

button#btn-ans {
    background: #56b663;
    color: #fff;
    width: 28px;
    height: 28px;
    font-size: 12px;
    font-weight: 800;
    padding: 0 !important;
    margin: 0px 20px 20px 0px;
    border: 1px solid #56b663;
}

.pink-btn {
    background: #fb7686 !important;
    border: 0px !important;
}
.blue-btn {
    background: #7db9ff !important;
    border: 0px !important;
}
.border-btn {
    background: #fff !important;
    color: #56b663 !important;
}

.bck-btn {
    text-align: center;
    padding-top: 10px;
    border-top: 1px solid rgba(205, 227, 208, 0.5);
    font-size: 14px;
    font-weight: 800;
    color: rgba(54, 60, 79, 0.8);
    position: absolute;
    width: 100%;
}
.main-textexam-sec {
    position: relative;
}
</style>
 
<!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

 <script>
    function progress(timeleft, timetotal, $element) {
    var progressBarWidth = timeleft * $element.width() / timetotal;
    $element.find('div').animate({ width: progressBarWidth }, 500).html(Math.floor(timeleft/60) + ":"+ timeleft%60);
    if(timeleft > 0) {
        setTimeout(function() {
            progress(timeleft - 1, timetotal, $element);
        }, 1000);
    }
};

progress(600, 600, $('#progressBar'));
    </script> -->

    <script type="text/javascript" src="http://localhost/Uniq_web/public/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $('.questionSlider').owlCarousel({
           
            loop: false,
            margin: 0,
            nav: true,
            dots: false,
            items: 1,
           
        })
    </script>













 