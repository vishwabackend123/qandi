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

            input[type=text], select, textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 16px;
                resize: vertical;
            }

            input[type=submit] {
                background-color: #04AA6D;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
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
                    <div class="col-lg-12 ">
                        <div class="tab-wrapper mt-0">

                            <div class="container">
                                <form action="{{route('refund_form_submit')}}">
                                    <label for="fname">User Name</label>
                                    <input type="text" id="fname" name="firstname" placeholder="Your name..">
                                    <label for="lname">Bank Name</label>
                                    <input type="text" id="bank_name" name="bank_name" placeholder="Bank Name..">
                                    <label for="lname">Account No.</label>
                                    <input type="text" id="acc_no" name="acc_no" placeholder="Account No..">
                                    <label for="lname">IFSC Code</label>
                                    <input type="text" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code..">
                                    <label for="subject">Subject</label>
                                    <textarea id="subject" name="subject" placeholder="Write something.."
                                              style="height:200px"></textarea>

                                    <input type="submit" value="Submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('afterlogin.layouts.footer')
@endsection
