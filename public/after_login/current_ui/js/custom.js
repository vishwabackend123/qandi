$(".notificationnew").click(function() {
    $(".notification-block_new").show()
});
/************ Amit - Start **************/
/********** Sidebar *****/
$("ul.submenu-lists li.practice-menu>a").click(function(){
    $(this).parent().toggleClass("practice-menu-active");
    $(".practice-submenu").slideToggle();
});
// $("ul.sidebar-menu-lists>li").click(function(){
//     if( !$(this).hasClass("active") ){
//         $(this).addClass("active");
//         $(this).siblings().removeClass("active");
//     }
// });
$("ul.sidebar-menu-lists>li.sidebar-exam-menu").click(function(){
    $(this).toggleClass("active");
});
$(".sidebar-exam-menu").click(function(){
    $(".submenu-block").slideToggle();
    $(".submenu-block").toggleClass("submenu-block-active");
});
// $(document).on('click', function(e) {
//     var submenu_opened = $('.submenu-block').hasClass('submenu-block-active');
//     if (!$(e.target).closest('.submenu-block').length && !$(e.target).is('.submenu-block') && submenu_opened === true) {
//         $('.submenu-block').hide();
//     }
// });
$(document).on('click', function (e) {
    if ($(e.target).closest("aside").length === 0) {
        $(".submenu-block").hide();
        $(".sidebar-exam-menu").removeClass("active");
    }
});

/************* Dashboard Circular Progress Bar ************/
$(".circle_percent").each(function() {
    var $this = $(this),
		$dataV = $this.data("percent"),
		$dataDeg = $dataV * 3.6,
		$round = $this.find(".round_per");
	$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");	
	$this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
	$this.prop('Counter', 0).animate({Counter: $dataV},
	{
		duration: 2000, 
		easing: 'swing', 
		step: function (now) {
            $this.find(".percent_text").text(Math.ceil(now)+"%");
        }
    });
	if($dataV >= 51){
		$round.css("transform", "rotate(" + 360 + "deg)");
		setTimeout(function(){
			$this.addClass("percent_more");
		},1000);
		setTimeout(function(){
			$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
		},1000);
	} 
});
/************ Amit - End **************/


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

/*****show-hide-detalis-user-profile-page**********/
  $(document).ready(function(){
    $(".flip").click(function(){
        $("#panel").slideToggle("slow");
        $(this).text(function(i, v){
          return v === 'Show details' ? 'Hide details' : 'Show details'
      })
    });
});
/***************************************************/
/*****upload-user-picture-user-profile-page**********/
  $(document).ready(function(){
      function readFile(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
      
          reader.onload = function(e) {
            var htmlPreview =
              '<img width="64px" height="64px" style="border-radius:32px;margin-right:20px;" src="' + e.target.result + '" />'; 
      //        '<p>' + input.files[0].name + '</p>';
            var wrapperZone = $(input).parent();
            var previewZone = $(input).parent().parent().find('.preview-zone');
            var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');
      
            wrapperZone.removeClass('dragover');
            previewZone.removeClass('hidden');
            boxZone.empty();
            boxZone.append(htmlPreview);
          };
      
          reader.readAsDataURL(input.files[0]);
        }
      }
      
      function reset(e) {
        e.wrap('<form>').closest('form').get(0).reset();
        e.unwrap();
      }
      
      $(".dropzone").change(function() {
        readFile(this);
      });
      
      $('.dropzone-wrapper').on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
      });
      
      $('.dropzone-wrapper').on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
      });
      
      $('.remove-preview').on('click', function() {
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        var previewZone = $(this).parents('.preview-zone');
        var dropzone = $(this).parents('.form-group').find('.dropzone');
        boxZone.empty();
        previewZone.addClass('hidden');
        reset(dropzone);
      });
});
/***************************************************/
       

