
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<section class="weeklyPlanWrapper cardWhiteBg">
            <div class="planDetail">

               <div class="planewrapper">
                    <div class="plantitleBox">
                            Thsi is auto generater
                    </div>
                    <div class="planDetailBox">
                        <div class="selectedWeek">
                            <p class="m-0">This week </p>
                            <p class="m-0">23rd May - 27th May</p>
                        </div>
                        <div class="plannedtestbox">
                            <div class="plannedtest">
                                <p class="m-0 AttempType"> Planned Test</p>
                                <p class="m-0 testCount">0</p>
                            </div>
                            <div class="plannedtest">
                                <p class="m-0 AttempType">Attempted Test</p>
                                <p class="m-0 testCount">0</p>
                            </div>
                        
                        </div>
                    </div>
               </div>
                <div class="gotoPlanner"><a href=""><span>Go to Planner</span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="m6 12 4-4-4-4" stroke="#56B663" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                </svg></a></div>
            </div>


            <div class="testPlanCardholder">
                <!-- <div class="testPlanCard testplannewuser">
                    <svg class="testplanNewimg" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80" fill="none">
                        <circle cx="40" cy="40" r="40" fill="#E0F6E3"/>
                        <path d="M23.988 27.418a4 4 0 0 1 3.966-4.518H56.79a4 4 0 0 1 3.966 3.483l3.653 28a4 4 0 0 1-3.966 4.517H31.607a4 4 0 0 1-3.966-3.482l-3.653-28z" fill="#BEE9C4"/>
                        <path d="M58.01 27.418a4 4 0 0 0-3.966-4.518H25.208a4 4 0 0 0-3.966 3.483l-3.653 28a4 4 0 0 0 3.966 4.517h28.836a4 4 0 0 0 3.966-3.482l3.653-28z" fill="#fff"/>
                        <path d="M53 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952H53zM35.399 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952h2.697z" fill="#56B663"/>
                        <path d="M24.07 31.544a.8.8 0 0 1 .784-.644h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM23.271 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM22.472 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM30.47 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM29.671 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM28.87 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4zM36.87 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.956l.48-2.4zM36.07 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM35.271 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM43.271 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM42.47 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM49.67 31.544a.8.8 0 0 1 .784-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM48.87 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4z" fill="#E0F6E3"/>
                    </svg>
                    
                    <p class=" m-0">Start planning your week</p>
                    <div class="addPlanbtn">
                        <button class="btn btn-common-transparent">
                            <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10 18.333a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 6.666v6.667M6.666 10h6.667" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span>Add
                            </span>                       
                        </button>
                    </div>
                </div> -->
    
                <div class="testPlanCard subCard physicsCard">
                    <p class="m-0">Physics</p>
                    <h3>Law of motion</h3>
                    <div class="proficiencyper">Proficiency<br><b>60%</b></p></div>
                    <div class="attemptBtn">
                        <a href="" class="btn btn-common-green">Attempt Now</a>
                    </div>
                    <div class="subIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="79" height="68" viewBox="0 0 79 68" fill="none">
                            <path d="M58.975.373 19.797.166 39.18 11.111 58.975.373z" fill="url(#xbs2u8kpya)"/>
                            <path d="M58.975.373 19.797.166 39.18 11.111 58.975.373z" fill="url(#pdstqsqm7b)"/>
                            <path d="M78.562 33.415 58.56 44.773 39.178 11.112 58.973.373l19.589 33.042z" fill="url(#i6rag4r7fc)"/>
                            <path d="M78.562 33.415 58.56 44.773 39.178 11.112 58.973.373l19.589 33.042z" fill="url(#s6bkns5edd)"/>
                            <path d="M0 33.62 19.795.167 39.59 11.111 19.795 44.566 0 33.621z" fill="url(#ls4ucv1fue)"/>
                            <path d="M0 33.62 19.795.167 39.59 11.111 19.795 44.566 0 33.621z" fill="url(#fpylq9jbjf)"/>
                            <path d="M57.736 66.664V44.918L78.77 33.21 57.736 66.664z" fill="url(#xwkqjxxcog)"/>
                            <path d="M57.736 66.664V44.918L78.77 33.21 57.736 66.664z" fill="url(#h5r5kftt9h)"/>
                            <path d="M58.353 44.565H20v22.51l37.734-.414.62-22.096z" fill="url(#zy6p1fbq7i)"/>
                            <path d="M58.353 44.565H20v22.51l37.734-.414.62-22.096z" fill="url(#sdlb5dxifj)"/>
                            <path d="M20.001 67.076 0 33.621l20.001 10.945v22.51z" fill="url(#tg87y2hlqk)"/>
                            <path d="M20.001 67.076 0 33.621l20.001 10.945v22.51z" fill="url(#4gvoyw248l)"/>
                            <path d="M19.795 44.564 39.384 11.11l19.589 33.455H19.795z" fill="url(#62ss06008m)"/>
                            <path d="M19.795 44.564 39.384 11.11l19.589 33.455H19.795z" fill="url(#bjzgc4z0ln)"/>
                            <defs>
                                <linearGradient id="xbs2u8kpya" x1="39.489" y1=".373" x2="39.489" y2="11.111" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D9D9D9"/>
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                </linearGradient>
                                <linearGradient id="pdstqsqm7b" x1="39.489" y1=".373" x2="39.489" y2="11.111" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#43E1CE"/>
                                    <stop offset="1" stop-color="#2899CA"/>
                                </linearGradient>
                                <linearGradient id="i6rag4r7fc" x1="59.076" y1=".58" x2="59.076" y2="44.773" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D9D9D9"/>
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                </linearGradient>
                                <linearGradient id="s6bkns5edd" x1="59.076" y1=".58" x2="59.076" y2="44.773" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#43E1CE"/>
                                    <stop offset="1" stop-color="#2899CA"/>
                                </linearGradient>
                                <linearGradient id="ls4ucv1fue" x1="19.795" y1=".166" x2="19.795" y2="44.566" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D9D9D9"/>
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                </linearGradient>
                                <linearGradient id="fpylq9jbjf" x1="19.795" y1=".166" x2="19.795" y2="44.566" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#43E1CE"/>
                                    <stop offset="1" stop-color="#2899CA"/>
                                </linearGradient>
                                <linearGradient id="xwkqjxxcog" x1="68.252" y1="33.209" x2="68.252" y2="66.664" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D9D9D9"/>
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                </linearGradient>
                                <linearGradient id="h5r5kftt9h" x1="68.252" y1="33.209" x2="68.252" y2="66.664" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#43E1CE"/>
                                    <stop offset="1" stop-color="#2899CA"/>
                                </linearGradient>
                                <linearGradient id="zy6p1fbq7i" x1="39.176" y1="44.565" x2="39.176" y2="67.074" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D9D9D9"/>
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                </linearGradient>
                                <linearGradient id="sdlb5dxifj" x1="39.176" y1="44.565" x2="39.176" y2="67.074" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#43E1CE"/>
                                    <stop offset="1" stop-color="#2899CA"/>
                                </linearGradient>
                                <linearGradient id="tg87y2hlqk" x1="10.207" y1="34.034" x2="10.207" y2="67.489" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D9D9D9"/>
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                </linearGradient>
                                <linearGradient id="4gvoyw248l" x1="10.207" y1="34.034" x2="10.207" y2="67.489" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#43E1CE"/>
                                    <stop offset="1" stop-color="#2899CA"/>
                                </linearGradient>
                                <linearGradient id="62ss06008m" x1="39.384" y1="11.109" x2="39.384" y2="44.564" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D9D9D9"/>
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                </linearGradient>
                                <linearGradient id="bjzgc4z0ln" x1="39.384" y1="11.109" x2="39.384" y2="44.564" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#43E1CE"/>
                                    <stop offset="1" stop-color="#2899CA"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>

                <div class="testPlanCard subCard mathCard">
                    <p class="m-0">MATHEMATICS</p>
                    <h3>Binomial Theorem</h3>
                    <div class="proficiencyper">Proficiency<br><b>60%</b></p></div>
                    <div class="attemptBtn">
                        <a href="" class="btn btn-common-green">Attempt Now</a>
                    </div>
                    <div class="subIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="78" height="63" viewBox="0 0 78 63" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)"/>
                            <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E"/>
                            <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1"/>
                            <path d="M15.12 58.838h20" stroke="#38B87B"/>
                            <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z"/>
                            <path stroke="#38B87B" d="M50.873 59.018h26"/>
                            <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z"/>
                            <path d="M4.71 45.103v-9.38" stroke="#38B87B"/>
                            <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z"/>
                            <path stroke="#38B87B" d="M4.891 18.996V1.093"/>
                            <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z"/>
                            <defs>
                                <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3ABFB0"/>
                                    <stop offset="1" stop-color="#37B66B"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>

                <div class="testPlanCard subCard chemistryCard">
                    <p class="m-0">MATHEMATICS</p>
                    <h3>Binomial Theorem</h3>
                    <div class="proficiencyper">Proficiency<br><b>60%</b></p></div>
                    <div class="attemptBtn">
                        <a href="" class="btn btn-common-green">Attempt Now</a>
                    </div>
                    <div class="subIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="78" height="63" viewBox="0 0 78 63" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.454 1.706a1 1 0 0 0-1.581.813v42.557a1 1 0 0 0 1 1h59.58c.972 0 1.373-1.248.58-1.814L16.455 1.706zm7.277 13.336a1 1 0 0 0-1.579.816v23.757a1 1 0 0 0 1 1H56.63c.974 0 1.373-1.251.579-1.815L23.73 15.042z" fill="url(#f50oe3uzra)"/>
                            <path d="M41.092 62.407c-.484 0-.905-.086-1.263-.258a1.678 1.678 0 0 1-.79-.776c-.166-.341-.207-.762-.125-1.262.073-.431.213-.788.418-1.07a2.41 2.41 0 0 1 .766-.675c.305-.173.636-.302.994-.388.361-.086.73-.15 1.104-.19.457-.045.827-.089 1.108-.128.285-.04.5-.1.642-.18a.52.52 0 0 0 .258-.377v-.03c.06-.375 0-.665-.179-.87-.179-.206-.477-.308-.895-.308-.437 0-.805.096-1.103.288-.299.192-.516.42-.652.681l-1.63-.238c.205-.465.487-.852.845-1.164.358-.315.77-.55 1.238-.706.47-.159.973-.238 1.506-.238.365 0 .721.043 1.07.129.35.086.66.229.929.427.272.196.47.463.596.8.13.339.151.761.065 1.269l-.85 5.11h-1.73l.179-1.049h-.06a2.749 2.749 0 0 1-.557.597c-.228.182-.5.33-.815.442-.315.11-.671.164-1.069.164zm.681-1.322c.361 0 .686-.071.975-.214.288-.146.525-.338.71-.576a1.71 1.71 0 0 0 .349-.781l.149-.9c-.067.047-.17.09-.309.13a4.49 4.49 0 0 1-.467.104c-.169.03-.336.056-.502.08l-.428.059a3.613 3.613 0 0 0-.755.179 1.527 1.527 0 0 0-.562.348.996.996 0 0 0-.273.567c-.053.328.024.578.233.75.209.17.502.254.88.254z" fill="#39BD9E"/>
                            <path d="m.873 32.7 1.69-10.182h1.8l-.626 3.808h.08c.119-.186.28-.383.481-.592.206-.212.466-.393.781-.542.315-.152.696-.228 1.143-.228.59 0 1.098.15 1.522.452.424.298.727.74.91 1.327.182.584.203 1.3.064 2.148-.139.839-.394 1.551-.765 2.138-.372.587-.82 1.034-1.348 1.342a3.293 3.293 0 0 1-1.69.463c-.438 0-.789-.073-1.054-.22a1.716 1.716 0 0 1-.602-.526 2.574 2.574 0 0 1-.303-.592h-.114l-.2 1.203H.874zm2.401-3.819c-.08.494-.08.927-.005 1.298.08.371.236.661.468.87.235.205.545.308.93.308a1.77 1.77 0 0 0 1.043-.318c.305-.216.557-.509.756-.88.199-.375.338-.8.418-1.278.076-.474.076-.895 0-1.263-.073-.367-.227-.656-.463-.865-.232-.208-.547-.313-.944-.313-.388 0-.733.101-1.034.303a2.356 2.356 0 0 0-.751.85 4.002 4.002 0 0 0-.418 1.288z" fill="#39BDA1"/>
                            <path d="M15.12 58.838h20" stroke="#38B87B"/>
                            <path fill="#D4F4B9" stroke="#38B87B" d="m14.79 57.676 1.294 1.293-1.293 1.292-1.293-1.292z"/>
                            <path stroke="#38B87B" d="M50.873 59.018h26"/>
                            <path fill="#D4F4B9" stroke="#38B87B" d="m75.715 57.676 1.292 1.293-1.292 1.292-1.293-1.292z"/>
                            <path d="M4.71 45.103v-9.38" stroke="#38B87B"/>
                            <path fill="#D4F4B9" stroke="#38B87B" d="m3.55 45.432 1.292-1.293 1.292 1.293-1.292 1.292z"/>
                            <path stroke="#38B87B" d="M4.891 18.996V1.093"/>
                            <path fill="#D4F4B9" stroke="#38B87B" d="M3.549 2.252 4.842.959l1.292 1.293-1.292 1.293z"/>
                            <defs>
                                <linearGradient id="f50oe3uzra" x1="17" y1="4.945" x2="66.825" y2="45.933" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3ABFB0"/>
                                    <stop offset="1" stop-color="#37B66B"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="owl-carousel owl-theme">
                <div class="item">
                        <div class="testPlanCard testplannewuser">
                            <svg class="testplanNewimg" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80" fill="none">
                                <circle cx="40" cy="40" r="40" fill="#E0F6E3"/>
                                <path d="M23.988 27.418a4 4 0 0 1 3.966-4.518H56.79a4 4 0 0 1 3.966 3.483l3.653 28a4 4 0 0 1-3.966 4.517H31.607a4 4 0 0 1-3.966-3.482l-3.653-28z" fill="#BEE9C4"/>
                                <path d="M58.01 27.418a4 4 0 0 0-3.966-4.518H25.208a4 4 0 0 0-3.966 3.483l-3.653 28a4 4 0 0 0 3.966 4.517h28.836a4 4 0 0 0 3.966-3.482l3.653-28z" fill="#fff"/>
                                <path d="M53 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952H53zM35.399 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952h2.697z" fill="#56B663"/>
                                <path d="M24.07 31.544a.8.8 0 0 1 .784-.644h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM23.271 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM22.472 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM30.47 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM29.671 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM28.87 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4zM36.87 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.956l.48-2.4zM36.07 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM35.271 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM43.271 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM42.47 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM49.67 31.544a.8.8 0 0 1 .784-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM48.87 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4z" fill="#E0F6E3"/>
                            </svg>
                            
                            <p class=" m-0">Start planning your week</p>
                            <div class="addPlanbtn">
                                <button class="btn btn-common-transparent">
                                    <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M10 18.333a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 6.666v6.667M6.666 10h6.667" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span>Add
                                    </span>                       
                                </button>
                            </div>
                        </div>
                    
                </div>

                <div class="item">
                        <div class="testPlanCard testplannewuser">
                            <svg class="testplanNewimg" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80" fill="none">
                                <circle cx="40" cy="40" r="40" fill="#E0F6E3"/>
                                <path d="M23.988 27.418a4 4 0 0 1 3.966-4.518H56.79a4 4 0 0 1 3.966 3.483l3.653 28a4 4 0 0 1-3.966 4.517H31.607a4 4 0 0 1-3.966-3.482l-3.653-28z" fill="#BEE9C4"/>
                                <path d="M58.01 27.418a4 4 0 0 0-3.966-4.518H25.208a4 4 0 0 0-3.966 3.483l-3.653 28a4 4 0 0 0 3.966 4.517h28.836a4 4 0 0 0 3.966-3.482l3.653-28z" fill="#fff"/>
                                <path d="M53 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952H53zM35.399 22.9a4.8 4.8 0 1 0-6.585 4.455l1.003-2.503a2.103 2.103 0 1 1 2.885-1.952h2.697z" fill="#56B663"/>
                                <path d="M24.07 31.544a.8.8 0 0 1 .784-.644h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM23.271 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM22.472 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM30.47 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM29.671 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM28.87 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4zM36.87 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.956l.48-2.4zM36.07 37.942a.8.8 0 0 1 .784-.643h2.369a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM35.271 44.342a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.957l.48-2.4zM43.271 31.544a.8.8 0 0 1 .785-.644h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.369a.8.8 0 0 1-.784-.956l.48-2.4zM42.47 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .784.957l-.48 2.4a.8.8 0 0 1-.784.643h-2.368a.8.8 0 0 1-.785-.957l.48-2.4zM49.67 31.544a.8.8 0 0 1 .784-.644h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.785-.956l.48-2.4zM48.87 37.942a.8.8 0 0 1 .785-.643h2.368a.8.8 0 0 1 .785.957l-.48 2.4a.8.8 0 0 1-.785.643h-2.368a.8.8 0 0 1-.784-.957l.48-2.4z" fill="#E0F6E3"/>
                            </svg>
                            
                            <p class=" m-0">Start planning your week</p>
                            <div class="addPlanbtn">
                                <button class="btn btn-common-transparent">
                                    <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M10 18.333a8.333 8.333 0 1 0 0-16.667 8.333 8.333 0 0 0 0 16.667zM10 6.666v6.667M6.666 10h6.667" stroke="#56B663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span>Add
                                    </span>                       
                                </button>
                            </div>
                        </div>
                    
                </div>
               
            </div>

        </section>
        

        <style>
.wrapper{
padding: 30px;
background-color: red;;
}
.cardWhiteBg{
background: #ffffff;
border-radius: 20px;
box-shadow: 0 8px 30px 0 rgb(172 185 176 / 14%);

}
.weeklyPlanWrapper{
margin:30px;
padding: 32px;;

}
.planDetail{
display: flex;


justify-content: space-between;
}
.plantitleBox {

padding-right: 300px;
}
.planDetailBox{

display: flex;
border-left: 1px solid #e1e3ed;

padding-left: 20px;
}
.selectedWeek{
font-size: 16px;
font-weight: 500;

line-height: 1.6;


color: #363c4f;
padding-right: 100px;
}
.plannedtestbox{
display: flex;
}
.plannedtest{
padding-right: 45px;
}
.testCount{
font-size: 20px;
font-weight: 800;
line-height: 1.6;
color: #363c4f;
}
.AttempType{
opacity: 0.6;
font-family: Manrope;
font-size: 14px;
font-weight: 500;
font-stretch: normal;
font-style: normal;
line-height: 1.6;
letter-spacing: normal;
text-align: left;
color: #363c4f;
}
.gotoPlanner a{
font-size: 16px;
font-weight: 800;
line-height: 10px;
text-align: right;
color: #56b663;
display: flex;
align-items: center;
justify-content: inherit;
}

.gotoPlanner a span{
padding-right: 10px;;
}
.gotoPlanner a svg{
    padding-top: 3px;
}
.gotoPlanner{
    display: flex;
    align-items: end;
}
.planewrapper{
    display: flex;
}


.subCard{
 
    padding: 20px !important;
    position: relative;

   
}
.physicsCard{
    background-color: #b5f7e3 !important;
}
.mathCard{
    background-color: #ecfccb !important; 
}
.chemistryCard{
    background-color: #c2f3f2 !important;
}
 
.subIcon{
    display: inline-flex;
    padding: 5px;
    position: absolute;
    top: 0px;
    right: 0px;
    padding: 18.2px 8.2px 14.9px 13px;
    background-color: rgba(0, 0, 0, 0.04);
}

.subCard p {
    opacity: 0.6;
    font-family: Manrope;
    font-size: 12px;
    font-weight: bold;
 
    line-height: 1.6;
    letter-spacing: 0.96px;
   
    color: #363c4f;
    text-transform: uppercase;
}

.subCard h3{
    font-size: 20px;
    font-weight: 800;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.6;
    letter-spacing: normal;
    text-align: left;
    color: #363c4f;
    margin-bottom: 16px;
}
.proficiencyper b{
    font-size: 14px;
    font-weight: 800;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.6;
    letter-spacing: normal;
    text-align: left;
    color: #363c4f;
}

.proficiencyper{
    opacity: 0.6;
  font-family: Manrope;
  font-size: 14px;
  font-weight: 500;
  font-stretch: normal;
  font-style: normal;
  line-height: 1.6;
  letter-spacing: normal;
  text-align: left;
  color: #363c4f;
}
         
         
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        .testPlanCardholder{display: flex;}
        
        .testPlanCard{
            width: 330px;
            margin: 32px 0 0 0;
            padding: 20px 83px 20px 84px;
            border-radius: 10px;
            border: solid 1px #e1e3ed;
            background-color: #ffffff;
        }
        .testplannewuser{
            text-align: center;
        }
        .testplannewuser p {
            padding: 0px 0px 11px 0px;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.6;
        }
        .addPlanbtn .btn{
            width:114px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.6;
            color:#56b663;
        }
         
        .addPlanbtn .btn span {
            display: flex;
              
         
        }
        .addPlanbtn .btn span:nth-child(2) {
            padding-left: 5px;  
        }
            </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>

$('.owl-carousel').owlCarousel({
    stagePadding: 20,
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
</script>

@endsection