@extends('afterlogin.layouts.app_new')
@section('content')


<div class="exam-wrapper">
    <div class="content-wrapper">
        <div class="examSereenwrapper">
            <div class="examMaincontainer">
                <div class="examLeftpanel reviewScreenleft">
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
                                        <div class="questionChoice"><a class="singleChoice" href="javascript:;">Section A (20Q) - Single Choice</a> <a class="numericalChoice" href="javascript:;">Section B (10Q) - Numerical</a></div>
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
                                        <div class="reviewscreenquestion">
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
                                                    <div class="questionImggraph">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="379" height="121" viewBox="0 0 379 121" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M75.097 27.125a1 1 0 0 0-1.582.813V75.42a1 1 0 0 0 1 1h66.475c.972 0 1.372-1.248.581-1.814L75.097 27.125zm8.064 14.78a1 1 0 0 0-1.578.816v26.647a1 1 0 0 0 1 1h37.547c.974 0 1.373-1.252.579-1.816L83.161 41.906z" fill="url(#12jrlffpfa)"/>
                                                            <path d="M102.572 94.518c-.536 0-1.003-.095-1.399-.286a1.857 1.857 0 0 1-.876-.86c-.184-.378-.23-.844-.138-1.4.081-.477.235-.871.463-1.184.231-.312.514-.562.848-.75a4.258 4.258 0 0 1 1.102-.429 9.688 9.688 0 0 1 1.223-.21c.507-.05.917-.098 1.229-.142.316-.044.553-.11.711-.199a.575.575 0 0 0 .286-.419v-.033c.066-.415 0-.736-.198-.964-.198-.227-.529-.341-.992-.341-.485 0-.892.106-1.223.32-.331.212-.571.464-.722.754l-1.807-.264a3.63 3.63 0 0 1 .937-1.29c.396-.349.854-.61 1.372-.782a5.176 5.176 0 0 1 1.669-.265c.404 0 .799.048 1.185.144.389.095.732.253 1.03.473.301.217.522.513.661.888.143.374.167.843.072 1.404l-.942 5.664h-1.918l.199-1.162h-.067a3.011 3.011 0 0 1-1.52 1.151 3.6 3.6 0 0 1-1.185.182zm.755-1.465c.4 0 .76-.08 1.08-.237a2.3 2.3 0 0 0 .788-.64c.206-.264.334-.552.385-.864l.166-.998a1.2 1.2 0 0 1-.342.144 5.013 5.013 0 0 1-.518.115c-.187.033-.373.063-.556.089l-.474.066a4.01 4.01 0 0 0-.838.198c-.249.092-.457.22-.622.386-.162.161-.263.37-.303.628-.059.363.027.64.259.832.231.187.556.28.975.28z" fill="#39BD9E"/>
                                                            <path d="m58 61.595 1.873-11.283h1.995l-.694 4.22h.088c.132-.206.31-.424.534-.656.228-.235.516-.435.865-.6.35-.17.772-.254 1.267-.254.654 0 1.216.167 1.686.502.47.33.807.82 1.009 1.47.202.647.226 1.44.071 2.381-.154.93-.437 1.719-.848 2.37-.412.65-.91 1.145-1.493 1.487a3.65 3.65 0 0 1-1.874.512c-.484 0-.874-.08-1.168-.242a1.901 1.901 0 0 1-.666-.584 2.852 2.852 0 0 1-.336-.656h-.127l-.22 1.333H58zm2.661-4.231c-.088.547-.09 1.027-.005 1.438.088.411.26.733.518.964.26.228.604.342 1.03.342a1.96 1.96 0 0 0 1.157-.353c.338-.239.617-.564.837-.975.22-.415.375-.887.463-1.416.085-.525.085-.992 0-1.4-.08-.407-.251-.727-.512-.958-.257-.232-.606-.347-1.047-.347-.43 0-.812.112-1.146.336a2.61 2.61 0 0 0-.832.942c-.22.404-.375.88-.463 1.427z" fill="#39BDA1"/>
                                                            <path d="M73.788 90.563h22.165" stroke="#38B87B"/>
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m73.424 89.198 1.51 1.509-1.51 1.509-1.509-1.51z"/>
                                                            <path stroke="#38B87B" d="M113.412 90.816h28.814"/>
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m140.943 89.198 1.51 1.51-1.51 1.508-1.509-1.509z"/>
                                                            <path d="M62.253 75.342V64.946" stroke="#38B87B"/>
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m60.889 75.706 1.509-1.51 1.509 1.51-1.51 1.509z"/>
                                                            <path stroke="#38B87B" d="M62.506 46.409v-19.84"/>
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m60.889 27.852 1.509-1.509 1.508 1.509-1.508 1.509z"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M252.255 27.125a1 1 0 0 0-1.581.813V75.42a1 1 0 0 0 1 1h66.474c.973 0 1.373-1.248.581-1.814l-66.474-47.481zm8.065 14.78a1 1 0 0 0-1.579.816v26.647a1 1 0 0 0 1 1h37.547c.975 0 1.374-1.252.579-1.816L260.32 41.906z" fill="url(#eonjfqketb)"/>
                                                            <path d="M279.731 94.518c-.537 0-1.003-.095-1.4-.286a1.857 1.857 0 0 1-.876-.86c-.184-.378-.229-.844-.138-1.4.081-.477.235-.871.463-1.184.232-.312.514-.562.849-.75a4.244 4.244 0 0 1 1.102-.429c.4-.095.808-.165 1.223-.21.507-.05.916-.098 1.228-.142.316-.044.553-.11.711-.199a.576.576 0 0 0 .287-.419v-.033c.066-.415 0-.736-.199-.964-.198-.227-.529-.341-.991-.341-.485 0-.893.106-1.224.32-.33.212-.571.464-.721.754l-1.807-.264c.227-.515.539-.945.936-1.29a3.94 3.94 0 0 1 1.372-.782 5.182 5.182 0 0 1 1.67-.265c.404 0 .798.048 1.184.144.389.095.733.253 1.03.473.302.217.522.513.662.888.143.374.167.843.071 1.404l-.942 5.664h-1.917l.198-1.162h-.066a3.06 3.06 0 0 1-.617.661 3.136 3.136 0 0 1-.904.49 3.598 3.598 0 0 1-1.184.182zm.754-1.465c.401 0 .761-.08 1.08-.237.32-.162.583-.375.788-.64.206-.264.335-.552.386-.864l.165-.998c-.073.052-.187.1-.341.144a5.072 5.072 0 0 1-.518.115c-.188.033-.373.063-.557.089l-.474.066a4 4 0 0 0-.837.198c-.25.092-.457.22-.623.386a1.11 1.11 0 0 0-.303.628c-.058.363.028.64.259.832.232.187.557.28.975.28z" fill="#39BD9E"/>
                                                            <path d="m235.158 61.595 1.874-11.283h1.994l-.694 4.22h.088c.132-.206.311-.424.535-.656.227-.235.516-.435.865-.6.349-.17.771-.254 1.267-.254.654 0 1.216.167 1.686.502.47.33.806.82 1.008 1.47.202.647.226 1.44.072 2.381-.155.93-.437 1.719-.849 2.37-.411.65-.909 1.145-1.493 1.487a3.648 3.648 0 0 1-1.873.512c-.485 0-.874-.08-1.168-.242a1.902 1.902 0 0 1-.667-.584 2.871 2.871 0 0 1-.336-.656h-.127l-.22 1.333h-1.962zm2.662-4.231c-.089.547-.09 1.027-.006 1.438.088.411.261.733.518.964.261.228.604.342 1.03.342a1.96 1.96 0 0 0 1.157-.353c.338-.239.617-.564.838-.975.22-.415.375-.887.463-1.416.084-.525.084-.992 0-1.4-.081-.407-.252-.727-.513-.958-.257-.232-.606-.347-1.047-.347-.429 0-.811.112-1.146.336a2.618 2.618 0 0 0-.832.942c-.22.404-.374.88-.462 1.427z" fill="#39BDA1"/>
                                                            <path d="M250.947 90.563h22.164" stroke="#38B87B"/>
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m250.583 89.198 1.51 1.51-1.51 1.508-1.509-1.509z"/>
                                                            <path stroke="#38B87B" d="M290.57 90.816h28.814"/>
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m318.101 89.198 1.51 1.51-1.51 1.508-1.509-1.509z"/>
                                                            <path d="M239.412 75.342V64.946" stroke="#38B87B"/>
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m238.047 75.706 1.509-1.509 1.509 1.509-1.51 1.509z"/>
                                                            <path stroke="#38B87B" d="M239.665 46.409v-19.84"/>
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m238.047 27.852 1.509-1.509 1.509 1.51-1.51 1.508z"/>
                                                            <defs>
                                                            <linearGradient id="12jrlffpfa" x1="75.88" y1="30.743" x2="131.226" y2="76.331" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#3ABFB0"/>
                                                            <stop offset="1" stop-color="#37B66B"/>
                                                            </linearGradient>
                                                            <linearGradient id="eonjfqketb" x1="253.039" y1="30.743" x2="308.384" y2="76.331" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#3ABFB0"/>
                                                            <stop offset="1" stop-color="#37B66B"/>
                                                            </linearGradient>
                                                            </defs>
                                                        </svg>
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
                                                            <div class="colMargin">
                                                                <div class="inputAns">
                                                                    <label for="story">Answer</label>
                                                                    <textarea style="resize:none" placeholder="Answer here" rows="20" name="comment[text]" id="comment_text" cols="40" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="answer-main-sec">
                                                    <div class="anshead-top">
                                                        <span>Answer:</span><button class="btn questionbtn">View details</button> 
                                                            <label class="expandbtn1">
                                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </label>
                                                            <label class="collapsebtn1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                                    <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </label>
                                                    </div>
                                                    <div class="anshead-titletext">
                                                        <p>1, 0, 2</p>
                                                    </div>
                                                    <div class="explanation-sec">
                                                        <div class="explanationdeteail">
                                                            <span>Explanation:</span>
                                                            <p>The locus of the point (x,y) Which is equidistant from the given fixed point (0,2) is a circle</p>
                                                        </div>
                                                        <div class="explanation-bottom">
                                                            <span>lAl=-1lBl=3</span>
                                                            <span>lAl=-1lBl=3</span>
                                                        </div>
                                                        <div class="explanationdeteail">
                                                            <p>The locus of the point (x,y) Which is equidistant from the given fixed point (0,2) is a circle</p>
                                                        </div>
                                                        <div class="explanation-bottom">
                                                            <span>lAl=-1lBl=3</span>
                                                            <span>lAl=-1lBl=3</span>
                                                        </div>

                                                        <div class="explanationdeteail">
                                                            <p>The locus of the point (x,y) Which is equidistant from the given fixed point (0,2) is a circle</p>
                                                        </div>
                                                        <div class="explanation-bottom">
                                                            <span>lAl=-1lBl=3</span>
                                                            <span>lAl=-1lBl=3</span>
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
                    
                </div>
                <div class="examRightpanel reviewScreenright ans-panel">
                    <div class="custom-exam-ansplatemain">
                        <div class="custom-anstop">
                            <p><span>Answer Palette</span></p>
                            <div class="text-exambottom-sec">
                                
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
                                    <label class="expandbtn">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </label>
                                    <label class="collapsebtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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
.questionsliderbox{
    position: relative;
}
.Explanationbox{
  
  
}

.expandbtn, .expandbtn1{
    display:block;cursor: pointer;
}
.collapsebtn, .collapsebtn1{
    display:none;cursor: pointer;
}
.reviewans-mainsec{
    position: absolute;
    bottom: 25px;
    background: #fff;
    overflow: hidden;
    margin-right: 15px;
}













/* shiv start ans left */
.answer-main-sec {
    background: #fff;
    padding: 20px;border-radius: 20px;
    height:232px;
    position: absolute;
    bottom: 0px;
    width: 100%;
}
.anshead-top {display: flex;align-items: center}

.anshead-top .btn.questionbtn {
    background: #fff !important;
}
.anshead-top > span {flex-grow: 1;font-size: 16px;
    font-weight: 800;
    color: #039855;}
    .anshead-top > label {
    padding-left: 20px;
}
.anshead-titletext p {
    font-size: 16px;
    font-weight: 800;
    color: #1f1f1f;
}
.explanation-sec {
    height: 77px;
    overflow-y: scroll;
    padding-left: 135px;
}
.explanationdeteail > span {
    font-size: 16px;
    font-weight: 800;
    color: #363c4f;
    padding-bottom: 3px;
    display: inline-block;
}
.explanationdeteail > p {
    margin: 0px; font-size: 16px;
    font-weight: 500;
}
.explanation-bottom span {
    display: block;
    font-size: 16px;
    font-weight: 500;
    color: #363c4f;
}
.explanation-bottom {
    padding: 25px 0px;
}
.custom-anstop > p {
    margin: 0;
    padding-bottom: 20px;
    font-weight: 800;
}
.red-btn {
    background: #d92d20 !important;
    border: 1px solid #d92d20 !important;
}
.border-btn {
    background: #fff !important;
    color: #56b663 !important;
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
 
.examRightpanel.ans-panel {
    padding-top: 24px !important;
}
/* shiv end css */

</style>




<!-----End__Right_Review_Height_Calculation------->

<script>
    $(document).ready(function() {
        $(".expandbtn").on('click', function() {
            var customanstopheigth = $(".custom-anstop").outerHeight();
            var reviewansmainsecheigth = $(".reviewans-mainsec").outerHeight();
            var onclickreviewbox = customanstopheigth + reviewansmainsecheigth;
            $('.reviewans-mainsec').css('height', onclickreviewbox);
        });

        $(".collapsebtn").on('click', function() {
            var reviewansmainsecheigth = $(".reviewans-mainsec").outerHeight();
            var customanstopheigth = $(".custom-anstop").outerHeight();
            var onclickreviewbox2 = reviewansmainsecheigth - customanstopheigth;
            $('.reviewans-mainsec').css('height', onclickreviewbox2);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".expandbtn1").on('click', function() {
        
            var questionwrapperheigth = $(".questionImggraph").outerHeight();
            var answermainsecheigth = $(".questionOptionBlock").outerHeight();
            var sac = questionwrapperheigth + answermainsecheigth;
            var answermainsecheigth = $(".answer-main-sec").outerHeight();
            var total = sac - answermainsecheigth; 
            $('.answer-main-sec').css('height', sac);
 
        });

        $(".collapsebtn1").on('click', function() {
            var answermainsecheigth = $(".answer-main-sec").outerHeight();
            var total = sac - answermainsecheigth; 
            $('.answer-main-sec').css('height', sac);
           
        });
    });
</script>



<!-----Start-for-expand-btn-click------->
<script>
    $('.expandbtn').on('click', function() {
        $('.collapsebtn').css({
            display: "block"
        });
        $('.expandbtn').css({
            display: "none"
        });
    });

    $('.collapsebtn').on('click', function() {
        $('.collapsebtn').css({
            display: "none"
        });
        $('.expandbtn').css({
            display: "block"
        });
    });
 
    $('.expandbtn1').on('click', function() {
        $('.collapsebtn1').css({
            display: "block"
        });
        $('.expandbtn1').css({
            display: "none"
        });
    });

    $('.collapsebtn1').on('click', function() {
        $('.collapsebtn1').css({
            display: "none"
        });
        $('.expandbtn1').css({
            display: "block"
        });
    });
</script>
<!-----end-for-expand-btn-click------->
@endsection