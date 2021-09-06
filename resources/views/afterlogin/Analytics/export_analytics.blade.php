@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->

<div class="main-wrapper  h-100">
  <!-- top navbar -->

  <div class="content-wrapper py-5 my-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10 ps-lg-5 mx-auto">
          <a href="#" class="export-btn"><img src="{{URL::asset('public/after_login/images/Group3140@2x.png')}}"></a>
          <a href="{{ url()->previous() }}" class="close-btn"><img src="{{URL::asset('public/after_login/images/close.png')}}"></a>
          <div class="bg-white">
            <div class="report-block1 p-4">
              <div class="
                      d-flex
                      justify-content-between
                      align-items-center
                      border-bottom
                    ">
                <span><img src="{{URL::asset('public/images/main-logo-red.png')}}" /></span>
                <span class="text-light">June 10, 2021</span>
                <span class="text-light-danger">Analytics</span>
              </div>
              <div class="export-block">
                <h2 class="fw-light text-center mt-5 h1">1607312</h2>

                <p class="text-center">
                  No. Of students participated for the exam.
                </p>
                <h1 class="greentxt">3456</h1>
                <p class="text-center fw-bold mt-5">
                  Your current rank has improved
                </p>
                <p class="text-center text-ligth">
                  From <span class="text-light-danger">5987</span>
                </p>
                <div class="row">
                  <div class="mx-auto col-md-10">
                    <div class="bg-white shadow-lg p-5 report-analysis-block">
                      <div class="d-flex align-items-center border-bottom pb-4">
                        <div>
                          <h1 class="reportHeading">
                            Report <span>Analysis</span>
                          </h1>
                        </div>
                        <div class="ms-auto d-flex align-items-center">
                          <div>
                            <img src="{{URL::asset('public/after_login/images/userpics.png')}}" class="exportUserpic" />
                          </div>
                          <div class="exportUsertxt">
                            <p>Anuj Bharadwaj</p>
                            <small><strong>Class - 12th</strong>, Preparingfor
                              JEE(M), April 2022
                            </small>
                          </div>
                        </div>
                      </div>
                      <div class="row py-5">
                        <div class="col-md-4 text-center">
                          <img src="{{URL::asset('public/after_login/images/left-graph.jpg')}}" />
                          <div class="
                                  d-flex
                                  align-items-center
                                  justify-content-center
                                  mt-4
                                ">
                            <i class="fa fa-star text-warning me-2" aria-hidden="true"></i>
                            <i class="fa fa-star text-warning me-2" aria-hidden="true"></i>
                            <i class="fa fa-star text-warning me-2" aria-hidden="true"></i>
                            <i class="fa fa-star text-warning me-2" aria-hidden="true"></i>
                            <i class="fa fa-star-half text-warning me-2" aria-hidden="true"></i>
                            <span class="me-3">95%</span>
                          </div>
                          <p class="text-center text-light mt-3">
                            Overall Proficiency
                          </p>
                        </div>
                        <div class="col-md-8">
                          <div class="d-flex mt-2">
                            <i class="
                                    fa fa-check-square
                                    me-3
                                    mt-1
                                    text-success
                                  " aria-hidden="true"></i>
                            <label class="form-check-label" for="flexCheckDefault">
                              Lorem Ipsum has been the industry's standard
                              dummy text ever since the 1500s,
                            </label>
                          </div>
                          <div class="d-flex mt-2">
                            <i class="
                                    fa fa-check-square
                                    me-3
                                    mt-1
                                    text-success
                                  " aria-hidden="true"></i>
                            <label class="form-check-label" for="flexCheckDefault">
                              Lorem Ipsum has been the industry's standard
                              dummy text ever since the 1500s,
                            </label>
                          </div>
                          <div class="d-flex mt-2">
                            <i class="
                                    fa fa-check-square
                                    me-3
                                    mt-1
                                    text-warning
                                  " aria-hidden="true"></i>
                            <label class="form-check-label" for="flexCheckDefault">
                              Lorem Ipsum has been the industry's standard
                              dummy text ever since the 1500s,
                            </label>
                          </div>
                          <div class="d-flex mt-2">
                            <i class="
                                    fa fa-check-square
                                    me-3
                                    mt-1
                                    text-warning
                                  " aria-hidden="true"></i>
                            <label class="form-check-label" for="flexCheckDefault">
                              Lorem Ipsum has been the industry's standard
                              dummy text ever since the 1500s,
                            </label>
                          </div>
                          <div class="d-flex mt-2">
                            <i class="
                                    fa fa-check-square
                                    me-3
                                    mt-1
                                    text-light-danger
                                  " aria-hidden="true"></i>
                            <label class="form-check-label" for="flexCheckDefault">
                              Lorem Ipsum has been the industry's standard
                              dummy text ever since the 1500s,
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="report-block2 p-5">
              <div class="d-flex">
                <span class="me-auto"><img src="{{URL::asset('public/images/main-logo-red.png')}}" /></span>
                <span class="text-end text-light">
                  Detailed Report Analysis<br />
                  Weekly UniQ Performace Report<br />June 10 2021
                </span>
              </div>
              <div class="bg-white shadow-lg p-3 mt-5">
                <h5 class="dashboard-title mb-3">Subject proficiency</h5>
                <div class="d-flex align-items-center mt-3 pb-1">
                  <div class="
                          d-flex
                          align-items-center
                          py-2
                          dashboard-listing-details
                          w-100
                        ">
                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                    <div class="
                            status-id
                            d-flex
                            align-items-center
                            justify-content-center
                            ml-0 ml-md-3
                            rating
                          " data-vote="0">
                      <div class="star hidden animate">
                        <span class="full star-colour" data-value="0"></span>
                        <span class="half star-colour" data-value="0"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="1"></span>
                        <span class="half star-colour" data-value="0.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="2"></span>
                        <span class="half" data-value="1.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="3"></span>
                        <span class="half" data-value="2.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="4"></span>
                        <span class="half" data-value="3.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="5"></span>
                        <span class="half" data-value="4.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="score score-rating js-score">
                        0%
                        <!-- <span>/</span>
                                        <span class="total">5</span> -->
                      </div>
                    </div>
                  </div>
                  <div class="progress ms-auto col-6" style="overflow: visible">
                    <div class="
                            progress-bar
                            bg-light-success
                            position-relative
                          " role="progressbar" style="width: 40%; overflow: visible">
                      <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Tooltip on top">1</span>
                    </div>
                    <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width: 30%; overflow: visible">
                      <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-red" title="Tooltip on top">1</span>
                    </div>
                    <div class="
                            progress-bar
                            bg-light-secondary
                            position-relative
                          " role="progressbar" style="width: 20%; overflow: visible">
                      <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center mt-3 pb-1">
                  <div class="
                          d-flex
                          align-items-center
                          py-2
                          dashboard-listing-details
                          w-100
                        ">
                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                    <div class="
                            status-id
                            d-flex
                            align-items-center
                            justify-content-center
                            ml-0 ml-md-3
                            rating
                          " data-vote="0">
                      <div class="star hidden">
                        <span class="full" data-value="0"></span>
                        <span class="half" data-value="0"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="1"></span>
                        <span class="half" data-value="0.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="2"></span>
                        <span class="half" data-value="1.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="3"></span>
                        <span class="half" data-value="2.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="4"></span>
                        <span class="half" data-value="3.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="5"></span>
                        <span class="half" data-value="4.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="score score-rating js-score">
                        0%
                        <!-- <span>/</span>
                                        <span class="total">5</span> -->
                      </div>
                    </div>
                  </div>
                  <div class="progress ms-auto col-6" style="overflow: visible">
                    <div class="
                            progress-bar
                            bg-light-success
                            position-relative
                          " role="progressbar" style="width: 40%; overflow: visible">
                      <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Tooltip on top">1</span>
                    </div>
                    <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width: 30%; overflow: visible">
                      <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-red" title="Tooltip on top">1</span>
                    </div>
                    <div class="
                            progress-bar
                            bg-light-secondary
                            position-relative
                          " role="progressbar" style="width: 20%; overflow: visible">
                      <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center mt-3 pb-1">
                  <div class="
                          d-flex
                          align-items-center
                          py-2
                          dashboard-listing-details
                          w-100
                        ">
                    <span class="mr-3 dashboard-name-txt">Trigonometry</span>

                    <div class="
                            status-id
                            d-flex
                            align-items-center
                            justify-content-center
                            ml-0 ml-md-3
                            rating
                          " data-vote="0">
                      <div class="star hidden">
                        <span class="full" data-value="0"></span>
                        <span class="half" data-value="0"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="1"></span>
                        <span class="half" data-value="0.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="2"></span>
                        <span class="half" data-value="1.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="3"></span>
                        <span class="half" data-value="2.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="4"></span>
                        <span class="half" data-value="3.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="star">
                        <span class="full" data-value="5"></span>
                        <span class="half" data-value="4.5"></span>
                        <span class="selected"></span>
                      </div>

                      <div class="score score-rating js-score">
                        0%
                        <!-- <span>/</span>
                                        <span class="total">5</span> -->
                      </div>
                    </div>
                  </div>
                  <div class="progress ms-auto col-6" style="overflow: visible">
                    <div class="
                            progress-bar
                            bg-light-success
                            position-relative
                          " role="progressbar" style="width: 40%; overflow: visible">
                      <span class="prog-box green" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-green" data-bs-placement="top" title="Tooltip on top">1</span>
                    </div>
                    <div class="progress-bar bg-light-red position-relative" role="progressbar" style="width: 30%; overflow: visible">
                      <span class="prog-box red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-red" title="Tooltip on top">1</span>
                    </div>
                    <div class="
                            progress-bar
                            bg-light-secondary
                            position-relative
                          " role="progressbar" style="width: 20%; overflow: visible">
                      <span class="prog-box secondary" data-bs-custom-class="tooltip-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">1</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-white shadow-lg p-3 h-100 px-5 mt-3 text-center">
                <p class="text-uppercase fw-bold text-start">
                  Time Management
                </p>
                <img src="{{URL::asset('public/after_login/images/innergraph1.png')}} " class="img-fluid" />
              </div>
              <div class="bg-white shadow-lg p-3 h-100 mt-3 px-5">
                <p class="text-uppercase fw-bold text-start">
                  Average Time Spent on each Question
                </p>
                <img src="{{URL::asset('public/after_login/images/innergraph2.png')}}" class="img-fluid" />
              </div>
              <div class="bg-white shadow-lg p-3 px-5 mt-3">
                <p class="text-uppercase fw-bold text-start">
                  Acuracy Percentage
                </p>
                <img src="{{URL::asset('public/after_login/images/innergraph2.png')}}" class="img-fluid" />
              </div>
              <h4 class="my-5 text-dark text-center fw-light">
                Detailed Report Analysis
              </h4>
            </div>
            <div class="report-block1 p-5">
              <div class="d-flex align-items-center p-5">
                <div class="w-34">
                  <h1 class="reportHeading w-100">Inferences</h1>
                </div>
                <div class="ms-auto d-flex align-items-center">
                  <div>
                    <img src="{{URL::asset('public/after_login/images/userpics.png')}}" class="exportUserpic" />
                  </div>
                  <div class="exportUsertxt">
                    <p>Anuj Bharadwaj</p>
                    <small><strong>Class - 12th</strong>, Preparingfor JEE(M),
                      April 2022
                    </small>
                  </div>
                </div>
              </div>
              <div class="p-5">
                <div class="d-flex mt-3">
                  <i class="fa fa-check-square me-3 mt-1 text-warning" aria-hidden="true"></i>
                  <label class="form-check-label" for="flexCheckDefault">
                    Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s,
                  </label>
                </div>
                <div class="d-flex mt-4">
                  <i class="fa fa-check-square me-3 mt-1 text-warning" aria-hidden="true"></i>
                  <label class="form-check-label" for="flexCheckDefault">
                    Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s,
                  </label>
                </div>
                <div class="d-flex mt-4">
                  <i class="fa fa-check-square me-3 mt-1 text-warning" aria-hidden="true"></i>
                  <label class="form-check-label" for="flexCheckDefault">
                    Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s,
                  </label>
                </div>
                <div class="d-flex mt-4">
                  <i class="fa fa-check-square me-3 mt-1 text-warning" aria-hidden="true"></i>
                  <label class="form-check-label" for="flexCheckDefault">
                    Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s,
                  </label>
                </div>
              </div>
              <p class="text-center mt-5 pt-5">
                <a href="https://www.uniq.co.edu/signup" class="link-primary" target="_blank">To Know more: https://www.uniq.co.edu/signup</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@include('afterlogin.layouts.footer')
<script type="text/javascript">
  $('.scroll-div-live-exm').slimscroll({
    height: '60vh'
  });
</script>

@endsection