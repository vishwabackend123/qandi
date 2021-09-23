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
                        <div class="d-flex flex-column align-items-center justify-content-center text-center">
                            <h4 class="download-head">Get free previous year questions papers</h4>
                            {{--                            <form action="{{route('download_exampaper')}}">--}}

                            <select class="form-select rounded-0 my-4 w-50" aria-label="Default select example"
                                    name="subject_id" id="subject_id">
                                <option selected>Select subject</option>
                                @foreach($subject_list as $value)
                                    <option value="{{$value->id}}">{{$value->subject_name}}</option>
                                @endforeach
                            </select>
                            <select class="form-select rounded-0 my-4 w-50" aria-label="Default select example"
                                    name="exam_year" id="exam_year">
                                <option value="">Select Year</option>
                                @for ($year = date('Y') - 10; $year < date('Y'); $year++)
                                    <option
                                        value="{{$year}}">{{$year}}</option>
                                @endfor
                            </select>
                            <button class="rounded-0 btn btn-danger px-5 mt-2" id="clicker"><i class="fa fa-download" ></i> Download
                            </button>
                            {{--                                <button  class="rounded-0 btn btn-danger px-5 mt-2" data-bs-toggle="modal"--}}
                            {{--                                         data-bs-target="#exportAnalytics"><i class="fa fa-download"></i> Download--}}
                            {{--                                </button>--}}
                            {{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('afterlogin.layouts.footer')

<script>
    $(document).ready(function() {
        $("#clicker").click(function () {
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
                success: function (response_data) {
                    console.log(response_data);
                    window.location = response_data;
                },
            });
        });
    });
</script>
@endsection
