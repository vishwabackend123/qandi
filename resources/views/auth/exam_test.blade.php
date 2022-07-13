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
                        <div class="text-exammid-sec borederbot">
                            <p>Overview</p>
                            <div class="overviewtest">
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
                       
                    </div>
                    <div class="bck-btn"><a href="javascript:;"> Back</a></div>
                </div>
            </div>
        </div>
    </div>
</div>


 
<style>

.inputAns textarea {
  width: 360px;
  height:90px;
  transition: background-color 0.2s ease 0s;
  padding: 10px 14px;
  border-radius: 8px;
  box-shadow: 0 1px 2px 0 rgba(16, 24, 40, 0.05);
  border: solid 1px #cde3d0;
  background-color: #ffffff;
}
.inputAns textarea:focus {
    background: none repeat scroll 0 0 #FFFFFF;
    outline-width: 0;
}

.inputAns textarea::placeholder {
  color: rgba(54, 60, 79, 0.5);
  font-size: 14px;
  font-weight: normal;
  font-stretch: normal;
  font-style: normal;
  line-height: 1.71;
  letter-spacing: normal;
  text-align: left;
}

.inputAns textarea:-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: rgba(54, 60, 79, 0.5);
    font-size: 14px;
  font-weight: normal;
  font-stretch: normal;
  font-style: normal;
  line-height: 1.71;
  letter-spacing: normal;
  text-align: left;
}

.inputAns textarea::-ms-input-placeholder { /* Microsoft Edge */
    color: rgba(54, 60, 79, 0.5);
    font-size: 14px;
  font-weight: normal;
  font-stretch: normal;
  font-style: normal;
  line-height: 1.71;
  letter-spacing: normal;
  text-align: left;
}
.inputAns label{
    font-size: 14px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    letter-spacing: normal;
    text-align: left;
    color: #363c4f;
    margin-bottom: 6px;
    padding-bottom: 0px;
}

.questionImggraph{
    text-align:center;
}

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
 .borederbot{    border-bottom: 1px solid rgba(172, 185, 176, 0.14);}
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
    padding-right:40px;
}
.examLeftpanel .tabMainblock {
    margin-top: 0px;
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
.submitBtnlink:hover,.submitBtnlink:focus{color:#fff;text-decoration:none}
.examMaincontainer {
    display: flex;
}
.exam-wrapper {
    background: #f5faf6;
}
.examLeftpanel {
    width: calc(100% - 379px);
    height: 89vh;
    position: relative;
}
.examRightpanel {
    min-width: 379px;
    max-width: 379px;
    min-height: 100%;
    /* margin: 0 0 0 40px; */
    padding: 40px 28px 10px;
    border-radius: 20px;
    box-shadow: 0 8px 30px 0 rgba(172, 185, 176, 0.14);
    background-color: #ffffff;position:relative;
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
.questionChoice a:hover{text-decoration:none}
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
    color: #ffffff !important;
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
    padding-top:78px;
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
    border: 1px solid #cde3d0;
    border-radius: 8px;
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
    padding-right:40px
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
    margin-top: 20px;
    height: 38vh;
    overflow-y: auto;
    margin-right: -10px;
}

button#btn-ans {
    display:inline-block;
    background: #56b663;
    color: #fff;
    width: 28px;
    height: 28px;
    font-size: 12px;
    font-weight: 800;
    padding: 0 !important;
    margin: 0px 18px 20px 0px;
    border: 1px solid #56b663;
}
button#btn-ans:nth-child(7n){margin-right:0px}
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
.bck-btn  {    text-align: center;
    padding-top: 10px;
    border-top: 1px solid rgba(205, 227, 208, 0.5);
    position: absolute;
    width: 100%;
    font-size: 14px;
    left: 0;
    bottom: 0px;
    padding-bottom: 10px;background-color:#fff;    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;}
.bck-btn a{
    font-weight: 800;
    color: rgba(54, 60, 79, 0.8);text-decoration:none;
}
.bck-btn a:hover{color:#56b663;text-decoration:none}
.main-textexam-sec {
    position: relative;
}
.overviewtest{height: 20vh;
    min-height: 186px;}
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













 