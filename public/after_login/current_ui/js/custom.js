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