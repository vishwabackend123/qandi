@extends('afterlogin.layouts.app')

@section('content')
@php
$userData = Session::get('user_data');

@endphp
<style>
    #refund_block_form .text-box input,
    #refund_block_form .text-box textarea {
        background: #f2f2f2;
        color: #2c3348;
        font-size: 18px;
        line-height: 22px;
        border: 1px solid #ccc;
        display: block;
        width: 100%;
        padding: 5px 10px !important;
    }
</style>

<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper my-4">
        <!-- dashboard html section-->
        <div class="container-fluid">
            <!--  -->
            <div class="row">
                <div class=" form-group col-lg-6 m-auto border rounded">
                    <div class=" p-3" id="refund_block_form">
                        <form id="refund_form" action="{{route('refund_form_submit')}}">
                            @csrf
                            <div class="text-box mt-0">
                                <label for="fname">User Name</label>
                                <input type="text" id="fname" class="form-control" name="firstname" placeholder="Your name.." required>
                            </div>
                            <div class="text-box mt-2">
                                <label for="lname">Bank Name</label>
                                <input type="text" id="bank_name" class="form-control" name="bank_name" placeholder="Bank Name.." required>
                            </div>
                            <div class="text-box mt-2">
                                <label for="lname">Account No.</label>
                                <input type="text" id="acc_no" class="form-control" name="acc_no" placeholder="Account No.." required>
                            </div>
                            <div class="text-box mt-2">
                                <label for="lname">IFSC Code</label>
                                <input type="text" id="ifsc_code" class="form-control" name="ifsc_code" placeholder="IFSC Code.." required>
                            </div>
                            <div class="text-box mt-2">
                                <label for="subject">Subject</label>
                                <textarea id="subject" name="subject" placeholder="Write something.." row="4" required></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit" id="saveEdit" class="btn btn-danger  rounded  ">
                                    Save
                                </button>
                            </div>
                            <div class="col-md-12 text-center">
                                <span id="refund_response" class=""></span>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div>
<!--End dashboard html section-->




@include('afterlogin.layouts.footer')


<script type="text/javascript">
    $(document).ready(function() {
        $("#refund_form").validate({

            submitHandler: function(form) {

                $.ajax({
                    url: "{{ url('/refund_form_submit') }}",
                    type: 'POST',
                    data: $('#refund_form').serialize(),
                    beforeSend: function() {},
                    success: function(response_data) {
                        var response = jQuery.parseJSON(response_data);

                        if (response.success == true) {
                            $('#refund_form').each(function() {
                                this.reset();
                            });
                            var message = response.message;
                            $("#refund_response").html(message);
                            $("#refund_response").addClass("text-success");
                            $("#refund_response").fadeIn('slow');
                            $("#refund_response").fadeOut(10000);


                        } else {
                            var message = "Somthing wrong try again!!"
                            $("#refund_response").html(message);
                            $("#refund_response").addClass("text-danger");
                            $("#refund_response").fadeIn('slow');
                            $("#refund_response").fadeOut(10000);
                            return false;
                        }
                    },
                    error: function(xhr, b, c) {
                        console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                    }
                });
            }

        });
    });
</script>
@endsection