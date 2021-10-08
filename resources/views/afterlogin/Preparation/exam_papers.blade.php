@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper h-100">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')
    <div class="content-wrapper download-height">
        <div class="container-fluid h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-7 mx-auto">
                    <div class="d-flex flex-column align-items-center justify-content-center ">
                        <h4 class="download-head">Get free previous year questions papers</h4>
                        <form id="download_exam_form" method="post">
                            <div class="form-group mt-4 text-left">
                                <select class="form-control form-select rounded-0" style="width:350px" aria-label="Default select example" name="subject_id" id="subject_id">
                                    <option value="">Select subject</option>
                                    @foreach($subject_list as $value)
                                    <option value="{{$value->id}}">{{$value->subject_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-4 text-left">
                                <select class="form-control form-select rounded-0" style="width:350px" aria-label="Default select example" name="exam_year" id="exam_year">
                                    <option value="">Select Year</option>
                                    @for ($year = date('Y') - 10; $year < date('Y'); $year++) <option value="{{$year}}">{{$year}}</option>
                                        @endfor
                                </select>
                            </div>
                            <div class="w-100 text-left">
                                <span id="dwn_rep_error" class="text-danger small" style="display:none"></span>
                            </div>
                            <div class="w-100 text-center">
                                <button class="rounded-0 btn btn-danger px-5 mt-4" id="clicker"><i class="fa fa-download"></i> Download
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('afterlogin.layouts.footer')

<script>
    $(document).ready(function() {
        $("#download_exam_form").validate({
            rules: {
                subject_id: {
                    required: true,
                },
                exam_year: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                let subject_id = $("#subject_id").val();
                let exam_year = $("#exam_year").val();
                $.ajax({
                    url: "{{ url('download_exampaper') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        subject_id: subject_id,
                        exam_year: exam_year
                    },
                    success: function(response_data) {
                        var response = jQuery.parseJSON(response_data);
                        console.log(response);
                        if (response.status == 'success') {
                            var dwnurl = response.imgUrl;
                            window.location = response_data;
                        } else {
                            $("#dwn_rep_error").text(response.message);
                            $('#dwn_rep_error').show();
                            setTimeout(function() {
                                $('#dwn_rep_error').fadeOut('fast');
                            }, 8000);
                            return false;
                        }

                    },
                });
            }

        });
    });
</script>
@endsection