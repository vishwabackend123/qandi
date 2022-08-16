
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
$(document).on('click', function (e) {
    if ($(e.target).closest("aside").length === 0) {
        $(".submenu-block").hide();
        $(".sidebar-exam-menu").removeClass("active");
    }
     var url = window.location.pathname.split("/");
    var action_method = url[1];
    if (action_method == 'overall_analytics') {
        $('.current_dashboard').removeClass('active');
        $('.current_analytics').addClass('active');
    } else if (action_method == 'planner') {
        $('.current_dashboard').removeClass('active');
        $('.current_planner').addClass('active');
    } else if (action_method == 'exam_custom' || action_method == 'series_list' || action_method == 'mockExamTest' || action_method == 'previous_year_exam' || action_method == 'live_exam_list') {
        $('.current_dashboard').removeClass('active');
        $('.current_practice').addClass('active');
    }
});

/************* Dashboard- Subject Performance Circular Progress Bar ************/
$(".circle_percent").each(function() {
    var $this = $(this),
		$dataV = $this.data("percent"),
		$dataDeg = $dataV * 3.6,
		$round = $this.find(".round_per");
	$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");	
	$this.append('<div class="circle_inbox"></div>');
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

/************* Dashboard- MyQ Today  Circular Progress Bar ************/
$(".mq_circle_percent").each(function() {
    var $this = $(this),
		$dataV = $this.data("percent"),
		$dataDeg = $dataV * 3.6,
		$round = $this.find(".mq_round_per");
	$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");	
	$this.append('<div class="mq_circle_inbox"><div class="valeblocktop"><div class="valeblockmyq"><span class="mq_percent_text"></span><span class="mq_percent_outoff">/100</span></div></div></div>');
	
	if($dataV >= 51){
		$round.css("transform", "rotate(" + 360 + "deg)");
		setTimeout(function(){
			$this.addClass("mq_percent_more");
		},1000);
		setTimeout(function(){
			$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
		},1000);
	} 
});
var percent_data =$('.mq_circle_percent').attr('data-percent');
var headingpercent = Math.ceil(percent_data);
if( headingpercent == 0){
     $('.dashSubHeading').text('Begin your journey to success.');
}
else if( headingpercent > 0 &&headingpercent < 40){
    $('.dashSubHeading').text('Good start, but long way to go.');
    $('.mq_circle_percent').addClass('mq_circle_red');
}else if(headingpercent > 39 && headingpercent < 75){
     $('.dashSubHeading').text('It’s time to push your limits.');
     $('.mq_circle_percent').addClass('mq_circle_yellow');
}else if(headingpercent > 75){
    $('.dashSubHeading').text('You are doing great!');
    $('.mq_circle_percent').addClass('mq_circle_green');
}
$(".mq_percent_text").text(Math.ceil(percent_data))
/************ Tooltip *********/
/*$(document).ready(function() {
    $("span.tooltipmain svg").click(function(event) {
        event.stopPropagation();
        $("span.tooltipmain p.tooltipclass span").each(function() {
            $(this).parent("p").hide();
            $(this).parent("p").removeClass('show');
        });
        $(this).siblings("p").show();
        $(this).siblings("p").addClass('show');

    });
    $("span.tooltipmain p.tooltipclass span").click(function() {
        $(this).parent("p").hide();
    });
});
$(document).on('click', function(e) {
    var card_opened = $('.tooltipclass').hasClass('show');
    if (!$(e.target).closest('.tooltipclass').length && !$(e.target).is('.tooltipclass') && card_opened === true) {
        $('.tooltipclass').hide();
    }
});*/

/******Test Analytics-Marks Percentage ******/
$(document).ready(function(){
  $(".scroll-top").click(function() {
      $("html, body").animate({ 
          scrollTop: 0 
      }, "slow");
      return false;
  });
});


/************************* Amit - End ****************************/


/***************************************************/
/*****upload-user-picture-user-profile-page**********/
 $(document).ready(function() {
    var fileTypes = ['jpg', 'jpeg', 'png'];

    function readFile(input) {
        if (input.files && input.files[0]) {
         if (input.files[0].size > 2097152) {
                return false;
            }
            var extension = input.files[0].name.split('.').pop().toLowerCase(),
                isSuccess = fileTypes.indexOf(extension) > -1;
            if (isSuccess) {
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
            }else
            {
              alert("invalid file type");
            }

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


/************************Toast Message***************************/
var toast = document.querySelector(".toastdata");
var btn = document.querySelector(".toast-btn");
var close = document.querySelector(".toast-close");
var progress = document.querySelector(".progress");

function toastFunction() {
  toast.classList.add("active");
  progress.classList.add("active");

  setTimeout(() =>{
    toast.classList.remove("active");
  }, 5000)

  setTimeout(() =>{
    progress.classList.remove("active");
  }, 5300)
}

function toastClose() {
  toast.classList.remove("active");

  setTimeout(() =>{
    progress.classList.remove("active");
  }, 300)
}
   
/************************Toast Message end***************************/ 

