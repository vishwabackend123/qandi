@extends('afterlogin.layouts.app_new')
 
 

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
                                        <li class="nav-item"><a class="nav-link qq1_2_3_4 active" data-bs-toggle="tab" href="#evaluation">Math <span class="qCount">65</span></a></li>
                                        <li class="nav-item"><a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#application">Physics <span class="qCount">65</span></a></li>
                                        <li class="nav-item"><a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#complrehension">Chemistry <span class="qCount">65</span></a></li>
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
                                    <div class="questionwrapper">
                                        <div class="questionheader">
                                            <div class="question">
                                                <span class="q-no">Q1.</span>
                                                <p>
                                                    GivenGiven A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of
                                                    l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of
                                                    l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of
                                                    l3ABl.Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl. A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value of l3ABl.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="questionOptionBlock">
                                            <div class="fancy-radio-buttons row with-image">
                                                <div class="col-md-6">
                                                    <div class="image-container">
                                                        <input type="radio" id="opt1" name="ff-radiobuttons" class="correct" />
                                                        <label for="opt1" class="image-bg"> <span class="seNo">A</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="image-container">
                                                        <input type="radio" id="opt2" name="ff-radiobuttons" class="correct" />
                                                        <label for="opt2" class="image-bg"> <span class="seNo">B</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="image-container">
                                                        <input type="radio" id="opt3" name="ff-radiobuttons" class="correct" />
                                                        <label for="opt3" class="image-bg"> <span class="seNo">C</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="image-container">
                                                        <input type="radio" id="opt4" name="ff-radiobuttons" class="correct" />
                                                        <label for="opt4" class="image-bg"> <span class="seNo">D</span> <span class="optionText">cccccccccccccccccccccccccc</span> </label>
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
                <div class="examRightpanel">dfdfd</div>
            </div>
        </div>
    </div>
</div>


 
<style> 
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
.qCount{
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
    padding: 5px 100px;
}
.questionOptionBlock {
    padding-top: 100px;
    width: 70%;
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
    align-items: center;
}
.fancy-radio-buttons input[type="radio"] + label:before {
    background: #ffffff;
    z-index: 1;
}
.fancy-radio-buttons input[type="radio"]:checked ~ .image-bg {
    box-shadow: 0 1px 2px 0 rgb(16 24 40 / 5%);
    border: solid 1px rgba(86, 182, 99, 0.5);
    background: white;
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
.fancy-radio-buttons .col-md-6 {
    margin-bottom: 30px;
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

</style>
 
 <!--
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

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

    

 