$(".notificationnew").click(function() {
    $(".notification-block_new").show()
});


$(document).ready(function() {
    $(".tooltipmain>svg").click(function(event) {
        alert('djjdj');
        event.stopPropagation();
        $(".tooltipmain").each(function() {
            $(this).siblings("p").show();
        });
        $(".tooltipmain").siblings("p").hide();
        // $(this).siblings("p").addClass('show');

    });
    $(".tooltipmain>span").click(function() {
        $(this).parent("p").hide();
    });
});
$(document).on('click', function(e) {
    var card_opened = $('.tooltipclass').hasClass('show');
    if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
        $('.tooltipclass').hide();
    }
});


// dashboard-circuler progress




