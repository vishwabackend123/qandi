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
                                <div class="reviewexamType">
                                    <a href="#">
                                        Custom Exam

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
                                        <div id="progressBar">
                                            <div class="bar"></div>
                                        </div>
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
                                                            <div class="quesbox">
                                                                <p>
                                                                    Given A and B are sqaure matrices of order 3 such that lAl=-1lBl=3, then find the value.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="questionImggraph">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="379" height="121" viewBox="0 0 379 121" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M75.097 27.125a1 1 0 0 0-1.582.813V75.42a1 1 0 0 0 1 1h66.475c.972 0 1.372-1.248.581-1.814L75.097 27.125zm8.064 14.78a1 1 0 0 0-1.578.816v26.647a1 1 0 0 0 1 1h37.547c.974 0 1.373-1.252.579-1.816L83.161 41.906z" fill="url(#12jrlffpfa)" />
                                                            <path d="M102.572 94.518c-.536 0-1.003-.095-1.399-.286a1.857 1.857 0 0 1-.876-.86c-.184-.378-.23-.844-.138-1.4.081-.477.235-.871.463-1.184.231-.312.514-.562.848-.75a4.258 4.258 0 0 1 1.102-.429 9.688 9.688 0 0 1 1.223-.21c.507-.05.917-.098 1.229-.142.316-.044.553-.11.711-.199a.575.575 0 0 0 .286-.419v-.033c.066-.415 0-.736-.198-.964-.198-.227-.529-.341-.992-.341-.485 0-.892.106-1.223.32-.331.212-.571.464-.722.754l-1.807-.264a3.63 3.63 0 0 1 .937-1.29c.396-.349.854-.61 1.372-.782a5.176 5.176 0 0 1 1.669-.265c.404 0 .799.048 1.185.144.389.095.732.253 1.03.473.301.217.522.513.661.888.143.374.167.843.072 1.404l-.942 5.664h-1.918l.199-1.162h-.067a3.011 3.011 0 0 1-1.52 1.151 3.6 3.6 0 0 1-1.185.182zm.755-1.465c.4 0 .76-.08 1.08-.237a2.3 2.3 0 0 0 .788-.64c.206-.264.334-.552.385-.864l.166-.998a1.2 1.2 0 0 1-.342.144 5.013 5.013 0 0 1-.518.115c-.187.033-.373.063-.556.089l-.474.066a4.01 4.01 0 0 0-.838.198c-.249.092-.457.22-.622.386-.162.161-.263.37-.303.628-.059.363.027.64.259.832.231.187.556.28.975.28z" fill="#39BD9E" />
                                                            <path d="m58 61.595 1.873-11.283h1.995l-.694 4.22h.088c.132-.206.31-.424.534-.656.228-.235.516-.435.865-.6.35-.17.772-.254 1.267-.254.654 0 1.216.167 1.686.502.47.33.807.82 1.009 1.47.202.647.226 1.44.071 2.381-.154.93-.437 1.719-.848 2.37-.412.65-.91 1.145-1.493 1.487a3.65 3.65 0 0 1-1.874.512c-.484 0-.874-.08-1.168-.242a1.901 1.901 0 0 1-.666-.584 2.852 2.852 0 0 1-.336-.656h-.127l-.22 1.333H58zm2.661-4.231c-.088.547-.09 1.027-.005 1.438.088.411.26.733.518.964.26.228.604.342 1.03.342a1.96 1.96 0 0 0 1.157-.353c.338-.239.617-.564.837-.975.22-.415.375-.887.463-1.416.085-.525.085-.992 0-1.4-.08-.407-.251-.727-.512-.958-.257-.232-.606-.347-1.047-.347-.43 0-.812.112-1.146.336a2.61 2.61 0 0 0-.832.942c-.22.404-.375.88-.463 1.427z" fill="#39BDA1" />
                                                            <path d="M73.788 90.563h22.165" stroke="#38B87B" />
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m73.424 89.198 1.51 1.509-1.51 1.509-1.509-1.51z" />
                                                            <path stroke="#38B87B" d="M113.412 90.816h28.814" />
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m140.943 89.198 1.51 1.51-1.51 1.508-1.509-1.509z" />
                                                            <path d="M62.253 75.342V64.946" stroke="#38B87B" />
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m60.889 75.706 1.509-1.51 1.509 1.51-1.51 1.509z" />
                                                            <path stroke="#38B87B" d="M62.506 46.409v-19.84" />
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m60.889 27.852 1.509-1.509 1.508 1.509-1.508 1.509z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M252.255 27.125a1 1 0 0 0-1.581.813V75.42a1 1 0 0 0 1 1h66.474c.973 0 1.373-1.248.581-1.814l-66.474-47.481zm8.065 14.78a1 1 0 0 0-1.579.816v26.647a1 1 0 0 0 1 1h37.547c.975 0 1.374-1.252.579-1.816L260.32 41.906z" fill="url(#eonjfqketb)" />
                                                            <path d="M279.731 94.518c-.537 0-1.003-.095-1.4-.286a1.857 1.857 0 0 1-.876-.86c-.184-.378-.229-.844-.138-1.4.081-.477.235-.871.463-1.184.232-.312.514-.562.849-.75a4.244 4.244 0 0 1 1.102-.429c.4-.095.808-.165 1.223-.21.507-.05.916-.098 1.228-.142.316-.044.553-.11.711-.199a.576.576 0 0 0 .287-.419v-.033c.066-.415 0-.736-.199-.964-.198-.227-.529-.341-.991-.341-.485 0-.893.106-1.224.32-.33.212-.571.464-.721.754l-1.807-.264c.227-.515.539-.945.936-1.29a3.94 3.94 0 0 1 1.372-.782 5.182 5.182 0 0 1 1.67-.265c.404 0 .798.048 1.184.144.389.095.733.253 1.03.473.302.217.522.513.662.888.143.374.167.843.071 1.404l-.942 5.664h-1.917l.198-1.162h-.066a3.06 3.06 0 0 1-.617.661 3.136 3.136 0 0 1-.904.49 3.598 3.598 0 0 1-1.184.182zm.754-1.465c.401 0 .761-.08 1.08-.237.32-.162.583-.375.788-.64.206-.264.335-.552.386-.864l.165-.998c-.073.052-.187.1-.341.144a5.072 5.072 0 0 1-.518.115c-.188.033-.373.063-.557.089l-.474.066a4 4 0 0 0-.837.198c-.25.092-.457.22-.623.386a1.11 1.11 0 0 0-.303.628c-.058.363.028.64.259.832.232.187.557.28.975.28z" fill="#39BD9E" />
                                                            <path d="m235.158 61.595 1.874-11.283h1.994l-.694 4.22h.088c.132-.206.311-.424.535-.656.227-.235.516-.435.865-.6.349-.17.771-.254 1.267-.254.654 0 1.216.167 1.686.502.47.33.806.82 1.008 1.47.202.647.226 1.44.072 2.381-.155.93-.437 1.719-.849 2.37-.411.65-.909 1.145-1.493 1.487a3.648 3.648 0 0 1-1.873.512c-.485 0-.874-.08-1.168-.242a1.902 1.902 0 0 1-.667-.584 2.871 2.871 0 0 1-.336-.656h-.127l-.22 1.333h-1.962zm2.662-4.231c-.089.547-.09 1.027-.006 1.438.088.411.261.733.518.964.261.228.604.342 1.03.342a1.96 1.96 0 0 0 1.157-.353c.338-.239.617-.564.838-.975.22-.415.375-.887.463-1.416.084-.525.084-.992 0-1.4-.081-.407-.252-.727-.513-.958-.257-.232-.606-.347-1.047-.347-.429 0-.811.112-1.146.336a2.618 2.618 0 0 0-.832.942c-.22.404-.374.88-.462 1.427z" fill="#39BDA1" />
                                                            <path d="M250.947 90.563h22.164" stroke="#38B87B" />
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m250.583 89.198 1.51 1.51-1.51 1.508-1.509-1.509z" />
                                                            <path stroke="#38B87B" d="M290.57 90.816h28.814" />
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m318.101 89.198 1.51 1.51-1.51 1.508-1.509-1.509z" />
                                                            <path d="M239.412 75.342V64.946" stroke="#38B87B" />
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m238.047 75.706 1.509-1.509 1.509 1.509-1.51 1.509z" />
                                                            <path stroke="#38B87B" d="M239.665 46.409v-19.84" />
                                                            <path fill="#D4F4B9" stroke="#38B87B" d="m238.047 27.852 1.509-1.509 1.509 1.51-1.51 1.508z" />
                                                            <defs>
                                                                <linearGradient id="12jrlffpfa" x1="75.88" y1="30.743" x2="131.226" y2="76.331" gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#3ABFB0" />
                                                                    <stop offset="1" stop-color="#37B66B" />
                                                                </linearGradient>
                                                                <linearGradient id="eonjfqketb" x1="253.039" y1="30.743" x2="308.384" y2="76.331" gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#3ABFB0" />
                                                                    <stop offset="1" stop-color="#37B66B" />
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

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="answer-main-sec">
                                                    <div class="anshead-top">
                                                        <span>Answer:</span>


                                                        <div class="review_expand">
                                                            <div class='percent_btn'><button class="btn btn-ans questionbtn">View details</button></div>
                                                            <div class='expand_block'>
                                                                <div class="first_screen">

                                                                    <div class="persent_std">
                                                                        <span class="attend">To answer you need to have</span>
                                                                    </div>


                                                                    <div class="attemp_box row mt-0">
                                                                        <div class="sub_att_1 col-md-6">

                                                                            <p>Knowledge, Application of</p>
                                                                            <a href="javascript:void(0);" class="detail_btn" style="cursor:default"> EQUATION OF CIRCLE</a>

                                                                        </div>
                                                                        <div class="sub_att_1 col-md-6">

                                                                            <p>Knowledge of</p>
                                                                            <a href="javascript:void(0);" class="detail_btn" style="cursor:default"> CIRCLE AS A LOCUS OF A POINT</a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



































                                                        <label class="expandbtn1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </label>
                                                        <label class="collapsebtn1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                                <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
                    <div class="custom-anstop">
                        <p><span>Answer Palette</span></p>
                        <div class="text-exambottom-sec">

                            <button type="button" class="btn btn-ans red-btn" id="">1</button>
                            <button type="button" class="btn btn-ans" id="">2</button>
                            <button type="button" class="btn btn-ans" id="">3</button>
                            <button type="button" class="btn btn-ans" id="">4</button>
                            <button type="button" class="btn btn-ans" id="">5</button>
                            <button type="button" class="btn btn-ans red-btn" id="">6</button>
                            <button type="button" class="btn btn-ans" id="">7</button>

                            <button type="button" class="btn btn-ans" id="">8</button>
                            <button type="button" class="btn btn-ans" id="">9</button>
                            <button type="button" class="btn btn-ans" id="">10</button>
                            <button type="button" class="btn btn-ans pink-btn" id="">11</button>
                            <button type="button" class="btn btn-ans" id="">12</button>
                            <button type="button" class="btn btn-ans" id="">13</button>
                            <button type="button" class="btn btn-ans" id="">14</button>

                            <button type="button" class="btn btn-ans red-btn" id="">15</button>
                            <button type="button" class="btn btn-ans" id="">16</button>
                            <button type="button" class="btn btn-ans" id="">17</button>
                            <button type="button" class="btn btn-ans red-btn" id="">18</button>
                            <button type="button" class="btn btn-ans" id="">19</button>
                            <button type="button" class="btn btn-ans" id="">20</button>
                            <button type="button" class="btn btn-ans" id="">21</button>
                            <button type="button" class="btn btn-ans" id="">22</button>
                            <button type="button" class="btn btn-ans border-btn" id="">23</button>
                            <button type="button" class="btn btn-ans" id="">24</button>
                            <button type="button" class="btn btn-ans" id="">25</button>
                            <button type="button" class="btn btn-ans" id="">26</button>
                            <button type="button" class="btn btn-ans" id="">27</button>
                            <button type="button" class="btn btn-ans" id="">28</button>
                            <button type="button" class="btn btn-ans" id="">29</button>
                            <button type="button" class="btn btn-ans" id="">30</button>


                        </div>
                    </div>
                    <div class="reviewans-mainsec">
                        <div class="review-filter-top">
                            <span>Review Questions</span>
                            <div class="filter_cate">
                                <label class="filter" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.5 2.25h-15l6 7.095v4.905l3 1.5V9.345l6-7.095z" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </label>


                                <ul class="dropdown-menu filterdropdown">
                                    <li><a class="dropdown-item" href="javascript:void(0);"> Low Proficiency</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"> High Proficiency</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"> A - Z Order</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"> Z - A Order</a></li>
                                </ul>




                            </div>


                            <label class="expandbtn">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.25 1.25h4.5m0 0v4.5m0-4.5L9.5 6.5m-3.75 8.25h-4.5m0 0v-4.5m0 4.5L6.5 9.5" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </label>
                            <label class="collapsebtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M3 10.5h4.5m0 0V15m0-4.5-5.25 5.25M15 7.5h-4.5m0 0V3m0 4.5 5.25-5.25" stroke="#363C4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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

                            <div class="d-flex quistion-3 greenborder-left">
                                <div class="flex-shrink-0" style="padding-left: 16px;">
                                    Q3.
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


                            <div class="d-flex quistion-3 greenborder-left">
                                <div class="flex-shrink-0" style="padding-left: 16px;">
                                    Q3.
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



<style>
    .fancy-radio-buttons .correct input[type="radio"].correct:checked~.image-bg .seNo {
        background-color: #56b663;
        color: #ffffff;
    }

    .review_expand {
        position: absolute;
        top: 5%;
        right: 70px;
    }

    .expand_block {
        display: none;
        position: absolute;
        right: 0;
        TOP: 0PX;
    }

    .first_screen {
        padding: 20px 40px !important;
        border-radius: 8px;
        box-shadow: 0 8px 30px 0 rgba(157, 170, 160, 0.3);
        background-color: #fff;
        min-width: 541px;
        z-index: 999;
    }

    .persent_std {
        padding-bottom: 40px;
    }

    .propt_text {
        padding: 20px 0;
        text-align: left;
        font-size: 14px;
        color: #2c3348;
        opacity: .99;
    }

    .attemp_box {
        display: flex;
    }

    .sub_att_1 p {
        font-size: 14px;
        font-weight: 500;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: #1f1f1f;
        padding: 0px;
        margin: 0px;
    }

    .attemp_box a {
        font-size: 14px;
        font-weight: bold;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-transform: uppercase;
        width: 100px;
        text-align: left;
        cursor: pointer;
        word-break: break-word;
        color: #56b663;
    }

    .questionsliderbox {
        position: relative;
    }

    .attend {
        font-size: 14px;
        font-weight: bold;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: left;
        color: #1f1f1f;
    }

    .expandbtn,
    .expandbtn1 {
        display: block;
        cursor: pointer;
    }

    .collapsebtn,
    .collapsebtn1 {
        display: none;
        cursor: pointer;
    }

    .reviewans-mainsec {
        position: absolute;
        bottom: 25px;
        background: #fff;
        overflow: hidden;
        margin-right: 15px;
    }

    .reviewexamType a {
        font-size: 16px;
        font-weight: 800;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.6;
        letter-spacing: normal;
        text-align: left;
        color: #1f1f1f;
        position: absolute;
        right: 0px;
        top: 0px;

    }

    .reviewScreenleft .examScreentab .nav-tabs .nav-link {
        padding: 0px 0 12px;
    }

    .reviewScreenleft .questionwrapper {
        max-height: initial;
    }

    .reviewScreenleft .questionOptionBlock {
        padding-top: 45px;
    }













    /* shiv start ans left */
    .answer-main-sec {
        background: #fff;
        padding: 20px;
        border-radius: 20px;
        /* height:291px; */
        position: absolute;
        bottom: 0px;
        width: 100%;
        padding-right: 8px;
    }

    .anshead-top {
        display: flex;
        align-items: center;
        padding-right: 20px;
    }

    .anshead-top .btn.questionbtn {
        background: #fff !important;
    }

    .anshead-top>span {
        flex-grow: 1;
        font-size: 16px;
        font-weight: 800;
        color: #039855;
    }

    .anshead-top>label {
        padding-left: 20px;
    }

    .anshead-titletext p {
        font-size: 16px;
        font-weight: 800;
        color: #1f1f1f;
    }

    .explanation-sec {
        height: 20vh;
        overflow-y: auto;
        ;
        padding-left: 135px;
    }

    .explanationdeteail>span {
        font-size: 16px;
        font-weight: 800;
        color: #363c4f;
        padding-bottom: 3px;
        display: inline-block;
    }

    .explanationdeteail>p {
        margin: 0px;
        font-size: 16px;
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

    .custom-anstop>p {
        margin: 0;
        padding-bottom: 20px;
        font-weight: 800;
        border-bottom: 1px solid rgba(205, 227, 208, 0.5);
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

    .review-filter-top>span {
        font-weight: 800;
        font-size: 16px;
        flex-grow: 1;
    }

    label.filter {
        padding-right: 20px;
    }

    .list-ans {
        padding-top: 20px;
        height: 33vh;
        overflow-y: auto;
    }

    .list-ans div {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.4;
        color: #363c4f;
        padding-bottom: 10px;
        position: relative;
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
        background: #56b663;
        position: absolute;
        height: 66px;
        border-radius: 20px;
    }

    .bck-btn:hover {
        cursor: pointer;
    }

    .examRightpanel.ans-panel {
        padding-top: 24px !important;
    }

    /* shiv end css */
</style>



<!-----Start-for-percent-btn-click------->
<script>
    $(".percent_btn").click(function(e) {
        $(".expand_block").show();
        e.stopPropagation();
    });

    $(".expand_block").click(function(e) {
        e.stopPropagation();
    });

    $(document).click(function() {
        $(".expand_block").hide();
    });
</script>
<!-----End-for-percent-btn-click------->

<script>
    function review_right_Height() {
        var total_right_height = $(".reviewScreenright ").outerHeight();
        $('.reviewScreenleft ').css('height', total_right_height);
        $('.examScreentab ').css('height', total_right_height);
        var examTabheader_height = $(".examTabheader").outerHeight();
        var questionType_height = $(".questionType").outerHeight();
        var topheader_height = examTabheader_height + questionType_height;
        var cal_height = total_right_height - topheader_height;
        $('.tab-content ').css('height', cal_height);
        $('.questionsliderbox').css('height', cal_height);
        var answer_main_sec_height = $(".answer-main-sec ").outerHeight();
        var question_slider_box_height = $(".questionsliderbox").outerHeight();
        var mid_section_height = question_slider_box_height - answer_main_sec_height;
        $('.questionwrapper ').css('height', mid_section_height);
    }

    review_right_Height();
    $("window").load(function() {
        review_right_Height();
    });


    $(window).resize(function() {
        review_right_Height();
    });
</script>
<script>
    $(document).ready(function() {
        $(".expandbtn1").on('click', function() {
            var expand_question_slider_box_height = $(".questionsliderbox").outerHeight();
            var questionheader_height = $(".questionheader").outerHeight();

            $('.answer-main-sec').css('height', expand_question_slider_box_height);
            var expand_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var final_height = expand_answer_main_sec_height - questionheader_height;
            $('.answer-main-sec').css('height', final_height);



            var ex_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var expand_anshead_titletext_height = $(".anshead-titletext").outerHeight();
            var expand_anshead_top_height = $(".anshead-top").outerHeight();
            var expand_totalpopup_height = expand_anshead_titletext_height + expand_anshead_top_height;
            var expand_height_popupSection = ex_answer_main_sec_height - expand_totalpopup_height;
            $('.explanation-sec').css('height', expand_height_popupSection);

            var ex_answer_main_sec_height_final = $(".explanation-sec").outerHeight();


            var ex_scroll_height = ex_answer_main_sec_height_final - 120 + "px";
            $('.explanation-sec').css('height', ex_scroll_height);




        });

        $(".collapsebtn1").on('click', function() {
            var coll_questionsliderbox_height = $(".questionsliderbox").outerHeight();
            var coll_questionwrapper_height = $(".questionwrapper").outerHeight();
            var coll_final_height = coll_questionsliderbox_height - coll_questionwrapper_height;
            $('.answer-main-sec').css('height', coll_final_height);
            var coll_answer_main_sec_height = $(".answer-main-sec").outerHeight();
            var coll_expand_anshead_titletext_height = $(".anshead-titletext").outerHeight();
            var coll_expand_anshead_top_height = $(".anshead-top").outerHeight();
            var coll_totalpopup_height = coll_expand_anshead_titletext_height + coll_expand_anshead_top_height;
            var coll_height_popupSection = coll_answer_main_sec_height - coll_totalpopup_height;
            $('.explanation-sec').css('height', coll_height_popupSection);
            var coll_answer_main_sec_height_final = $(".explanation-sec").outerHeight();
            var coll_scroll_height = coll_answer_main_sec_height_final - 60 + "px";
            $('.explanation-sec').css('height', coll_scroll_height);


        });
    });
</script>


<!-----Start__Right_Review_Height_Calculation------->
<script>
    function review_right_Height() {
        var review_Screen_right_height = $(".reviewScreenright").outerHeight();
        var test_review_height_div = review_Screen_right_height / 2;
        $('.custom-anstop').css('height', test_review_height_div);
        $('.reviewans-mainsec').css('height', test_review_height_div);
    }

    review_right_Height();
    $("window").load(function() {
        review_right_Height();
    });


    $(window).resize(function() {
        review_right_Height();
    });
</script>

<script>
    $(document).ready(function() {
        $(".expandbtn").on('click', function() {
            var review_Screen_right_height = $(".reviewScreenright").outerHeight();
            var review_ans_mainsec_heigth = $(".reviewans-mainsec").outerHeight();
            var custom_ans_top_heigth = $(".custom-anstop").outerHeight();
            var review_filter_top_height = $(".review-filter-top").outerHeight();
            var list_ans_height = $(".list-ans").outerHeight();
            var calculated_height = review_Screen_right_height - review_ans_mainsec_heigth;
            var onclick_review_box = custom_ans_top_heigth + calculated_height;
            $('.reviewans-mainsec').css('height', onclick_review_box);
            var afterExpandtotalheight = $(".reviewScreenright").outerHeight();
            var min_height_q_list_h = afterExpandtotalheight - 122 + "px";
            $('.reviewans-mainsec').css('height', min_height_q_list_h);
            var reviewans_final_height = $(".reviewans-mainsec").outerHeight();
            var scroll_height = reviewans_final_height - review_filter_top_height;
            var scroll_height_20 = scroll_height - 20 + "px";
            $('.list-ans').css('height', scroll_height_20)
        });

        $(".collapsebtn").on('click', function() {
            var review_ans_mainsec_heigth = $(".reviewans-mainsec").outerHeight();
            var custom_ans_top_heigth = $(".custom-anstop").outerHeight();
            var onclick_review_box2 = review_ans_mainsec_heigth - custom_ans_top_heigth;
            var clickcollapesbtn = onclick_review_box2 + 122 + "px";
            $('.reviewans-mainsec').css('height', clickcollapesbtn);
            var coll_outer_height = $(".reviewans-mainsec").outerHeight();
            var coll_review_filter_to_height = $(".review-filter-top").outerHeight();
            var coll_review_divide_height = coll_outer_height - coll_review_filter_to_height;
            var coll_scroll_final_height = coll_review_divide_height - 20 + "px";
            $('.list-ans').css('height', coll_scroll_final_height)
        });
    });
</script>

<!-----End__Right_Review_Height_Calculation------->
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




</style>
@endsection