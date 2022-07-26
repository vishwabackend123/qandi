@extends('layouts.app')
@section('content')
@php
$userData = Session::get('user_data');
$user_name = isset($userData->user_name)?$userData->user_name:'';
@endphp
<div>
    <div class="plan_successfull_wrapper">
        <div class="plan_successfull_heder_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="66" viewBox="0 0 64 66" fill="none" class="plan_successfull_heder_icon_img">
                <g filter="url(#67epj5et9a)">
                    <path d="M32 6H8v24h24V6zM55.993 30.002H31.994V54h24V30z" fill="#38D430" />
                    <path d="M55.993 6H31.994v24h24V6z" fill="#00AB16" />
                    <path d="m46.775 23.281 2.018 2.08h2.33l-3.245-3.36 2.08-2.413V17.18l-3.183 3.68-3.057-3.162.894-.64c1.04-.77 2.08-1.788 2.08-3.244 0-2.101-1.6-3.495-3.785-3.495-1.893 0-3.744 1.352-3.744 3.599 0 1.372 1.019 2.475 1.705 3.2l.437.457-.291.208c-1.56 1.144-2.58 2.24-2.58 4.098 0 1.892 1.457 3.766 4.16 3.766 1.664 0 2.933-.938 4.181-2.365zM40.91 13.81a1.958 1.958 0 0 1 1.997-1.997c1.227 0 2.038.873 2.038 1.955 0 .728-.312 1.352-1.206 1.997l-1.103.832-.582-.624c-.562-.562-1.144-1.31-1.144-2.164zm-.728 7.924c0-1.144.665-1.872 1.477-2.475l.728-.562 3.307 3.432-.125.146c-.853.977-1.789 1.747-2.954 1.747-1.518 0-2.433-1.144-2.433-2.288zM27.64 18.001a7.653 7.653 0 1 0-7.667 7.68 7.452 7.452 0 0 0 4.374-1.472l1.259 1.264h3.638l-3.075-3.088a7.5 7.5 0 0 0 1.47-4.384zm-3.453 2.4-2.093-2.099h-3.636l3.92 3.936a4.9 4.9 0 1 1 1.81-1.837zm15.26 14.24h9.12v2.699h-3.123v9.323h3.11v2.697h-9.12v-2.694h3.13v-9.323h-3.117v-2.702z" fill="#1F1F1F" />
                </g>
                <defs>
                    <filter id="67epj5et9a" x="0" y="2" width="63.993" height="64.001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="4" />
                        <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow_532_2530" />
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="4" />
                        <feGaussianBlur stdDeviation="4" />
                        <feColorMatrix values="0 0 0 0 0.641667 0 0 0 0 0.67375 0 0 0 0 0.7 0 0 0 0.1 0" />
                        <feBlend in2="effect1_dropShadow_532_2530" result="effect2_dropShadow_532_2530" />
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow_532_2530" result="shape" />
                    </filter>
                </defs>
            </svg>
            <div class="plan_success_massage d-flex justify-content-center">
                <div class="plan_box_status">
                    <div class="plan_box_status_msg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewBox="0 0 61 60" fill="none" class="plan_successfull_heder_icon2">
                            <path d="M2.5 30c0-15.464 12.536-28 28-28s28 12.536 28 28-12.536 28-28 28-28-12.536-28-28z" fill="#8DFDB3" />
                            <path d="M42.167 28.927V30a11.667 11.667 0 1 1-6.919-10.663m6.919 1.33L30.5 32.345l-3.5-3.5" stroke="#039855" stroke-width="2.333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M30.5 56c-14.36 0-26-11.64-26-26h-4c0 16.569 13.431 30 30 30v-4zm26-26c0 14.36-11.64 26-26 26v4c16.569 0 30-13.431 30-30h-4zm-26-26c14.36 0 26 11.64 26 26h4c0-16.569-13.431-30-30-30v4zm0-4C13.931 0 .5 13.431.5 30h4c0-14.36 11.64-26 26-26V0z" fill="#BDF3C5" />
                        </svg>
                        <div class="plan_success_congrats_msg">
                            <div class="plan_success_congrats_msg_name">Congratulations {{$user_name}}</div>
                            <div class="plan_success_congrats_msg_text">Thank you for your purchase. You have now been upgraded to the 1-year plan. We hope you continue to enjoy your learning journey.</div>
                        </div>
                    </div>
                    <div class="plan_box_status_contant">
                        <div class="plan_box_status_contant_order_qi d-flex justify-content-between align-items-center">
                            <div class=" plan_box_status_contant_order">Order summary</div>
                            <div class="plan_box_status_contant_qi">Q&I Subscription </div>
                        </div>
                        <div class="line-692"></div>
                        <div>
                            <div class="d-flex justify-content-between align-items-center plan_order_sumry_subscription">
                                <div class="plan_order_summary">Transaction ID:</div>
                                <div class="plan_subscribption">{{$transaction_data->id}}</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center plan_order_sumry_subscription">
                                <div class="plan_order_summary">Order No:</div>
                                <div class="plan_subscribption">{{$transaction_data->order_id}}</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center plan_order_sumry_subscription">
                                <div class="plan_order_summary">Subscription type</div>
                                <div class="plan_subscribption">
                                    @if(isset($transaction_data->notes->exam_id) && $transaction_data->notes->exam_id==1)
                                    JEE 1 year Subscription
                                    @else
                                    NEET 1 year Subscription
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center plan_order_sumry_subscription">
                                <div class="plan_order_summary">Active date</div>
                                <div class="plan_subscribption">{{date('jS F Y', $transaction_data->created_at)}}</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center plan_order_sumry_subscription">
                                <div class="plan_order_summary">End date</div>
                                @php
                                $subscription_month=$transaction_data->notes->month;
                                @endphp
                                <div class="plan_subscribption">{{date('jS F Y',strtotime("+$subscription_month month",$transaction_data->created_at))}}</div>
                            </div>
                        </div>
                        <div class="line-692"></div>
                        <div class="text-center ">
                            <a href="{{route('dashboard')}}" class="plan_successfull_go_to_dashboard btn btn-common-green">Continue</a>
                        </div>
                        <div class="plan_subscribption"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center plan_order_sumry_subscription">
                        <div class="plan_order_summary"></div>
                        <div class="plan_subscribption"></div>
                    </div>
                </div>
                <div class="line-692"> </div>
            </div>
            <div>
            </div>
        </div>
    </div>
    <!-- Plan successfully purchesed  end -->
</div>
<!-- Plan purchesed Pending  start -->
@endsection
