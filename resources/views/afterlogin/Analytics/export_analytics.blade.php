@extends('afterlogin.layouts.app')

@section('content')

<!-- Side bar menu -->
@include('afterlogin.layouts.sidebar')
<div class="main-wrapper  h-100">
    <!-- top navbar -->
    @include('afterlogin.layouts.navbar_header')

</div>



@include('afterlogin.layouts.footer')
<script type="text/javascript">
    $('.scroll-div-live-exm').slimscroll({
        height: '60vh'
    });
</script>

@endsection