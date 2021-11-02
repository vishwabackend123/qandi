@extends('layouts.app')

@section('content')
<nav class="py-0 px-7 navbar navbar-expand-lg trans-navbar">
    <div class="container-fluid"><a class="navbar-brand" href="{{url('/')}}"><img src="{{URL::asset('public/images/main-logo.png')}}" class="img-fluid" /></a></div>
</nav>
<div id="main">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h1 class="main-heading">WHAT's your game ?</h1>
            <div id="scrollDiv">
                <div class="row">
                    @if($errors->any())
                    <div class="col-md-12 ">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{$errors->first()}}
                        </div>
                    </div>
                    @endif
                    @if(isset($subscriptions) && !empty($subscriptions))
                    @foreach($subscriptions as $sub)
                    @php
                    $subspriceData=(isset($sub->subs_price) && !empty($sub->subs_price))?(array)json_decode($sub->subs_price):[];

                    $subsprice=(!empty($subspriceData))?head(array_values($subspriceData)):0;

                    @endphp

                    @if(in_array($sub->subscript_id,$purchased_ids) )
                    @php
                    $subscription_type='';
                    $filtered = $aPurchased->where('subscription_id', $sub->subscript_id);
                    $filtered_data = $filtered->first();
                    $subscription_type = $filtered_data->subscription_t;
                    $subscribed_id = $filtered_data->subscription_id;
                    @endphp


                    @if($subscription_type=="P")

                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small subscriptionBox inactive-block  ">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content me-3">{{$sub->subscription_details}}</p>

                            <div class="text-center mt-5">
                                <button type="button" class="btn btn-danger text-uppercase rounded-0 px-5 disabled" id="goto-otp-btn">Already Purchased </i></button>
                            </div>
                        </div>
                    </div>
                    @elseif($subscription_type=="T")
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small subscriptionBox   ">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content me-3">{{$sub->subscription_details}}</p>



                            <div class="text-center mt-4">
                                <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                    <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                    <input type="hidden" name="exam_period" value="12">
                                    <input type="hidden" name="period_unit" value="month">
                                    <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                </form>
                            </div>
                            <div class="text-center mt-2">
                                <apan class="text-success text-decoration-underline">Already in 14 days trail Period. </apan>
                            </div>

                        </div>
                    </div>
                    @endif
                    @else
                    <div class="col-md-4 p-4 ">
                        <div class="bg-white white-box-small subscriptionBox  ">
                            <h5 class="cource-name">{{strtoupper($sub->subscription_name)}}</h5>
                            <p class="price">Rs. {{$subsprice}}</p>
                            <p class="box-content scroll-content me-3">{{$sub->subscription_details}}</p>

                            <div class="text-center mt-4">
                                <form action="{{route('checkout')}}" if="checkout_{{$sub->subscript_id}}" @if(isset(Auth::user()->id) && !empty(Auth::user()->id)) onsubmit="return confirm('Previous subscription will not be valid after new subscription.');" @endif method="post">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{$sub->class_exam_id}}">
                                    <input type="hidden" name="subscript_id" value="{{$sub->subscript_id}}">
                                    <input type="hidden" name="exam_period" value="12">
                                    <input type="hidden" name="period_unit" value="month">
                                    <input type="hidden" name="exam_price" value="{{$subsprice}}">

                                    <button type="submit" class="btn btn-danger text-uppercase rounded-0 px-5" id="goto-otp-btn">Subscribe Now <i class="fas fa-arrow-right"></i></button>
                                </form>
                            </div>
                            <div class="text-center mt-2">
                                <a href="{{route('trial_subscription',$sub->subscript_id)}}" class="text-danger text-decoration-underline" @if(isset(Auth::user()->id) && !empty(Auth::user()->id)) onclick="return confirm('Previous subscription will not be valid after new subscription.');" @endif >Try 14 days trial ></a>
                            </div>

                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{URL::asset('public/js/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

<script src="{{URL::asset('public/js/bootstrap.bundle.min.js')}}"></script>

<script>
    /*  function submitSubscription(subs_id) {
        if (!confirm("Do you really want to do this?")) {
            return false;
        }


        document.getElementById('checkout_' + subs_id).submit();
    } */
    /* $(document).ready(function() {
        $("#checkout").validate({

            submitHandler: function(form) {
               
                //this.form.submit();
            }

        });
    }); */
</script>
@endsection