<script type="text/javascript" src="{{URL::asset('public/js/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

<script src="{{URL::asset('public/js/bootstrap.bundle.min.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('public/js/jquery.slimscroll.min.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $('.submenu-L1').on('shown.bs.collapse', function() {
        $('body').addClass('move-mainwrapper');

    })

    $('.submenu-L1').on('hidden.bs.collapse', function() {
        $('body').removeClass('move-mainwrapper');

    })
    $('.submenu-L2').on('shown.bs.collapse', function() {
        $('body').addClass('move-mainwrapper2');

    })

    $('.submenu-L2').on('hidden.bs.collapse', function() {
        $('body').removeClass('move-mainwrapper2');

    })
    $(document).on('click', function(e) {
        /* bootstrap collapse js adds "in" class to your collapsible element*/
        var menu_opened = $('.submenu-L1, .submenu-L2').hasClass('show');

        if (!$(e.target).closest('.submenu-L1').length &&
            !$(e.target).is('.submenu-L1, .submenu-L2') &&
            menu_opened === true) {
            $('.submenu-L1, .submenu-L2').collapse('toggle');
        }

    });
</script>