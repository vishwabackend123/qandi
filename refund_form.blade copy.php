@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper  h-100">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 5px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 2px;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class=" form-group col-lg-6 m-auto ">
                    <div class="tab-wrapper mt-0">

                        <div class="container">
                            <form id="refund_form" action="{{route('refund_form_submit')}}">
                                @csrf
                                <div class="text-box mt-3">
                                    <label for="fname">User Name</label>
                                    <input type="text" id="fname" class="form-control" name="firstname" placeholder="Your name.." required>
                                </div>
                                <div class="text-box mt-3">
                                    <label for="lname">Bank Name</label>
                                    <input type="text" id="bank_name" class="form-control" name="bank_name" placeholder="Bank Name.." required>
                                </div>
                                <div class="text-box mt-3">
                                    <label for="lname">Account No.</label>
                                    <input type="text" id="acc_no" class="form-control" name="acc_no" placeholder="Account No.." required>
                                </div>
                                <div class="text-box mt-3">
                                    <label for="lname">IFSC Code</label>
                                    <input type="text" id="ifsc_code" class="form-control" name="ifsc_code" placeholder="IFSC Code.." required>
                                </div>
                                <div class="text-box mt-3">
                                    <label for="subject">Subject</label>
                                    <textarea id="subject" name="subject" placeholder="Write something.." row="3" required></textarea>
                                </div>
                                <div class="-3">
                                    <input type="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('afterlogin.layouts.footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        $("#refund_form").validate({
            submitHandler: function(form) {

                $.ajax({
                    url: "{{ url('/refund_form_submit') }}",
                    type: 'POST',
                    data: $('#refund_form').serialize(),
                    beforeSend: function() {},
                    success: function(response_data) {


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