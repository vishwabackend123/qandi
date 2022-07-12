@extends('afterlogin.layouts.app_new')
 

 

<div class="exam-wrapper">
    
    <div class="content-wrapper">
        <div class="examSereenwrapper">
            <div class="examMaincontainer">
                <div class="examLeftpanel">left panel</div>
                
                <div class="examRightpanel">
                    <div class="text-examtop-sec">
                        <p><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity=".1" d="M20 40c11.046 0 20-8.954 20-20S31.046 0 20 0 0 8.954 0 20s8.954 20 20 20z" fill="#363C4F"/>
                                <path d="M31.896 32.835A17.503 17.503 0 1 1 20 2.5V20l11.896 12.835z" fill="#44CD7F"/>
                                <path d="M20 32.683c7.005 0 12.683-5.678 12.683-12.683 0-7.004-5.678-12.683-12.683-12.683S7.317 12.996 7.317 20c0 7.005 5.678 12.683 12.683 12.683z" fill="#EBEBED"/>
                                <path d="M20 26.41a6.19 6.19 0 1 0 0-12.38 6.19 6.19 0 0 0 0 12.38z" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 17.582v2.457h1.638M15.905 12.668l-2.252 1.638M24.095 12.668l2.252 1.638" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>112 mins Left</span> <label><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="14" cy="14" r="8.4" fill="#fff"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2 14a11.2 11.2 0 1 1-22.4 0 11.2 11.2 0 0 1 22.4 0zM9.8 11.2a1.4 1.4 0 1 1 2.8 0v5.6a1.4 1.4 0 0 1-2.8 0v-5.6zm7-1.4a1.4 1.4 0 0 0-1.4 1.4v5.6a1.4 1.4 0 0 0 2.8 0v-5.6a1.4 1.4 0 0 0-1.4-1.4z" fill="#00AB16"/>
                            </svg>
                            </label></p>
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
                                <button type="button" class="btn" id="btn-ans">23</button>
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
                                
                                
                                
                            </div>
                    
                </div>
            </div>

        </div>
    </div>
 
</div>

 
<style>
.examMaincontainer{
    display: flex;
}
.exam-wrapper {
    background: #f5faf6;
}

.examLeftpanel{
    width:calc(100% - 379px);
    height: 100vh;

}
.examRightpanel{
    min-width: 379px;
    max-width: 379px;
    height: 100vh;
    margin: 0 0 0 40px;
    padding: 40px 28px 10px;
    border-radius: 20px;
    box-shadow: 0 8px 30px 0 rgba(172, 185, 176, 0.14);
    background-color: #ffffff;
}
.submitBtn{
    position: absolute;
    top: 0px;
    right: 0px;
}


/* shiv start css for text exam  */

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
    justify-content: start;height: 195px;
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
    margin: 0px 20px 20px 0px;    border: 1px solid #56b663;
}

.pink-btn {background: #fb7686 !important; border:0px !important;}
.blue-btn{background:#7db9ff !important; border:0px !important;}
.border-btn{background:#fff !important; color:#56b663 !important;}

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
.main-textexam-sec{position: relative;}

/* .text-examtop-sec {display: flex;width: 100%;align-items: center;justify-content: center;} */

</style>
 


 