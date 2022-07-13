@extends('afterlogin.layouts.app_new')
 
 

<div class="exam-wrapper">
    <div class="content-wrapper">
        <div class="examSereenwrapper">
            <div class="examMaincontainer">
                <div class="examLeftpanel">
                        <div class="answer-main-sec">
                            <div class="anshead-top">
                                <span>Answer:</span><button class="btn questionbtn">View details</button> 
                                <label><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                </label>
                            </div>
                        </div>
                </div>
                <div class="examRightpanel ans-panel">
                    <div class="custom-exam-ansplatemain">
                        <div class="custom-anstop">
                            <p><span>Answer Palette</span></p>
                            <div class="custom-exambtn-sec">
                                
                                <button type="button" class="btn red-btn" id="btn-ans">1</button>
                                <button type="button" class="btn" id="btn-ans">2</button>
                                <button type="button" class="btn" id="btn-ans">3</button>
                                <button type="button" class="btn" id="btn-ans">4</button>
                                <button type="button" class="btn" id="btn-ans">5</button>
                                <button type="button" class="btn red-btn" id="btn-ans">6</button>
                                <button type="button" class="btn" id="btn-ans">7</button>
                             
                                <button type="button" class="btn" id="btn-ans">8</button>
                                <button type="button" class="btn" id="btn-ans">9</button>
                                <button type="button" class="btn" id="btn-ans">10</button>
                                <button type="button" class="btn pink-btn" id="btn-ans">11</button>
                                <button type="button" class="btn" id="btn-ans">12</button>
                                <button type="button" class="btn" id="btn-ans">13</button>
                                <button type="button" class="btn" id="btn-ans">14</button>
                                
                                <button type="button" class="btn red-btn" id="btn-ans">15</button>
                                <button type="button" class="btn" id="btn-ans">16</button>
                                <button type="button" class="btn" id="btn-ans">17</button>
                                <button type="button" class="btn red-btn" id="btn-ans">18</button>
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
                               
                                
                            </div>
                        </div>
                         <div class="reviewans-mainsec">
                             <div class="review-filter-top">
                                    <span>Review Questions</span> 
                                    <label class="filter"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 2.25h-15l6 7.095v4.905l3 1.5V9.345l6-7.095z" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                    </label>
                                    <label>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </label>
                             </div>
                                <div class="list-ans">
                                    <div class="d-flex quistion-1 redborder-left ">
                                        <div class="flex-shrink-0" style="padding-left: 16px;">
                                                 Q1.
                                        </div>
                                        <div class="flex-grow-1 ms-3 quistion-content ">
                                            This is some content from a media component. You can replace this with any content and adjust it as needed.
                                        </div>
                                    </div>
                                    <div class="d-flex quistion-2 greenborder-left">
                                        <div class="flex-shrink-0" style="padding-left: 16px;">
                                                 Q2.
                                        </div>
                                        <div class="flex-grow-1 ms-3 quistion-content ">
                                            This is some content from a media component. You can replace this with any content and adjust it as needed.
                                        </div>
                                    </div>
                                    <div class="d-flex quistion-3 greenborder-left">
                                        <div class="flex-shrink-0" style="padding-left: 16px;">
                                                 Q3.
                                        </div>
                                        <div class="flex-grow-1 ms-3 quistion-content ">
                                            This is some content from a media component. You can replace this with any content and adjust it as needed.
                                        </div>
                                    </div>
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
/* shiv start css */
.custom-anstop > p {
    margin: 0;
    padding-bottom: 20px;
    font-weight: 800;
}
.custom-exambtn-sec {
    padding-top: 20px;
    border-top: 1px solid rgba(172, 185, 176, 0.14);
    display: flex;height: 195px;
    overflow-y: scroll;
    flex-flow: wrap;
    justify-content: space-evenly;
    
}

.red-btn {
    background: #d92d20 !important;
    border: 1px solid #d92d20 !important;
}
.border-btn {
    background: #fff !important;
    color: #56b663 !important;
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
.review-filter-top {
    display: flex;
    padding-bottom: 20px;
    padding-top: 20px;
    border-bottom: 1px solid rgba(205, 227, 208, 0.5);
}
.review-filter-top > span {
    font-weight: 800;
    font-size: 16px;flex-grow: 1;
}
label.filter {
    padding-right: 20px;
}
.list-ans {
    padding-top: 20px;
    height: 269px;
    overflow-y: scroll;
}

.list-ans div {
    font-size: 16px;
    font-weight: 500;
    line-height: 1.4;
    color: #363c4f;
    padding-bottom: 10px;position: relative;
}

.redborder-left:before {
    content: "";
    width: 4px;
    background: #d92d20;
    position: absolute;
    height: 66px;
    border-radius: 20px;
}

.greenborder-left:before {
    content: "";
    width: 4px;
    background:  #56b663;
    position: absolute;
    height: 66px;
    border-radius: 20px;
}
.bck-btn:hover {cursor: pointer;}


.bck-btn {
    text-align: center;
    padding-top: 10px;
    border-top: 1px solid rgba(205, 227, 208, 0.5);
    font-size: 14px;
    font-weight: 800;
    color: rgba(54, 60, 79, 0.8);
    position: absolute;
    width: 100%;
    left: 0;
    bottom: 10;
}

.examRightpanel.ans-panel {
    padding-top: 24px !important;
}

/* shiv end css */

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
    height: 100vh;
    margin: 0 0 0 40px;
    padding: 40px 28px 10px;
    border-radius: 20px;
    box-shadow: 0 8px 30px 0 rgba(172, 185, 176, 0.14);
    background-color: #ffffff;
    position: relative;
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

    

 