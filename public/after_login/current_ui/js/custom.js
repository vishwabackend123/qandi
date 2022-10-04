
/************ Amit - Start **************/
/********** Sidebar *****/
$("ul.submenu-lists li.practice-menu>a").click(function(){
    $(this).parent().toggleClass("practice-menu-active");
    $(".practice-submenu").slideToggle();
});
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
    if (e.target.classList.contains('ref_class')) {
        $('.mb-4').removeClass('active');
        $('.current_refer').addClass('active');
    }else
    {
        var exam_flow = ['exam_custom', 'series_list', 'mockExamTest','previous_year_exam','live_exam_list','custom_exam','exam_result_analytics','get_exam_result_analytics','custom_exam_chapter','custom_exam_topic','test_series','mock_exam','live_exam','previousYearExam'];
        var url = window.location.pathname.split("/");
        var action_method = url[1];
        if (action_method == 'overall_analytics') {
            $('.current_dashboard').removeClass('active');
            $('.current_analytics').addClass('active');
        } else if (action_method == 'planner') {
            $('.current_dashboard').removeClass('active');
            $('.current_planner').addClass('active');
        }  else if (exam_flow.includes(action_method)) {
            $('.current_dashboard').removeClass('active');
            $('.current_practice').addClass('active');
        }  
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
var percent_data =$('#accurate_percent').val();
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
     $('.mq_circle_percent').addClass('noshadow');

}else if(headingpercent > 75){
    $('.dashSubHeading').text('You are doing great!');
    $('.mq_circle_percent').addClass('mq_circle_green');
    $('.mq_circle_percent').addClass('noshadow');
}
$(".mq_percent_text").text(Math.ceil(percent_data))

/******Test Analytics-Marks Percentage ******/
$(document).ready(function(){
  $(".scroll-top").click(function() {
      $("html, body").animate({ 
          scrollTop: 0 
      }, "slow");
      return false;
  });
});

function resize() {
    if ($(window).width() < 767) {
        $("ul.mob_sidebar_lists li:last-child a").click(function(){
            $("body").addClass("referpopupBackdrop");
        });
    }
    else{
        $("body").removeClass("referpopupBackdrop");
    }
}
$(window).on('resize', function() {
    resize()
});
$("#referfrnd .btn-close").click(function(){
    $("body").removeClass("referpopupBackdrop");
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



