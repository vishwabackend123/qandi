$(".notificationnew").click(function() {
    $(".notification-block_new").show()
});
/************ Sidebar **************/
$("ul.submenu-lists li.practice-menu>a").click(function(){
    $(this).parent().toggleClass("practice-menu-active");
    $(".practice-submenu").slideToggle();
});
$("ul.sidebar-menu-lists>li").click(function(){
    if( !$(this).hasClass("active") ){
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
    }
});
$(".sidebar-exam-menu").click(function(){
    $(".submenu-block").slideToggle({ direction: "left" }, 1000);
});
$(document).on('click', function (e) {
    if ($(e.target).closest("aside").length === 0) {
        $(".submenu-block").hide();
        $(".sidebar-exam-menu").removeClass("active");
    }
});
/************ Sidebar End **************/


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




