@extends('layouts.app')

@section('content')
<div class="banner-block">

</div>
@endsection

<script>
    var top1 = $('#block1').offset().top;
    var top2 = $('#block2').offset().top;
    var top3 = $('#block3').offset().top;

    $(document).scroll(function() {
        var scrollPos = $(document).scrollTop();
        if (scrollPos >= top1 && scrollPos < top2) {
            $('#change').addClass('block1');
        } else if (scrollPos >= top2 && scrollPos < top3) {
            $('#change').addClass('block2');
            $('#change').removeClass('block1');
        } else if (scrollPos >= top3) {
            $('#change').addClass('block3');
            $('#change').removeClass('block2');
        } else if (scrollPos < top1) {
            $('#change').removeClass('block1');
            $('#change').removeClass('block2');
            $('#change').removeClass('block3');
        }
    });
</script>