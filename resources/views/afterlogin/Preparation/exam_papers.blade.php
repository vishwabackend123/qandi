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
                        <h4 class="download-head">Get Free Access to JEE Main & Advanced previous year Sample Questions Papers with Solutions</h4>
                        <select class="form-select rounded-0 my-4 w-50" aria-label="Default select example">
                            <option selected>Select paper</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <button class="rounded-0 btn btn-danger px-5 mt-2" data-bs-toggle="modal" data-bs-target="#exportAnalytics"><i class="fa fa-download"></i> Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@include('afterlogin.layouts.footer')


@endsection