<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{URL::asset('public/after_login/new_ui/js/jquery.slimscroll.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
/*************Mobiletab-scroll **************/
$.fn.tabbing = function (options) {
    var opts = {delayTime : 300};
    options = options || {};
    opts = $.extend(opts,options);    
    return this.each(function () {
        $(this).on('click', function (event) {
            event.preventDefault();
            var sum = 0;
            $(this).prevAll().each(function(){  sum += $(this).width();});
          var get = document.querySelector('.mobilescrolltabNew').scrollWidth
            var dist = sum - ( $(this).parent().width() - $(this).width()) / 2;
          if(dist < 0){
            dist = 0;
          }
          /* else if(dist+sum > get){
            dist = get-sum+dist+dist;
          } */
            $(this).parent().animate({
                scrollLeft: dist
            },opts['delayTime']);
        });
    });
};
$('.mobilescrolltabNew li').tabbing();

/**************Mobiletab-scroll-end*****************/
</script>
<script>
$('.submitBtnlink').click(function() {
    $('body').addClass("make_me_blue");
});

const checkConnection = async () => {
    try {
        /* const response = await fetch(
            'http://localhost/uniqtoday/'
        ); */
        const response = navigator.onLine;

        //return response.status >= 200 && response.status < 300;
        return response;
    } catch (error) {
        return false;
    }
};
setInterval(async () => {
    const isOnline = await checkConnection();
    if(isOnline == false){
      
      $endExamCheck = $('#endExam').hasClass('show');
        if ($endExamCheck == false) {
            $('#FullTest_Exam_Panel_Interface_A').modal('hide');
            $('#attemptlimit').modal('hide');
            
            $('#resume-test .exammodal_content').addClass("connectionlost");
            $("#resume_lebel").text("Connection Lost");
            $("#connectivity_div").show();            
            $("#resume-duration-div").hide();
            $("#resume-button-div").hide();
            $("#resume_subMsg").hide();

           
            stop();
        }
    }

    if(isOnline == true){
      $("#resume_lebel").text("Exam Paused");
      $('#resume-test .exammodal_content').removeClass("connectionlost");
            $("#resume-duration-div").show();

            $("#resume-button-div").show();
            $("#connectivity_div").hide();
            $("#resume_subMsg").show();

            $('#myTabContent .quesBtn').attr("disabled", false);
            $('#myTabContent .quesBtn').removeClass("disabled");
    }
    
    
}, 10000);

</script>

<style>


.make_me_blue  .modal-backdrop {
    background: #f5faf6;
    opacity: 1 !important;
}
</style>

<script>
    $(document).ready(function(){
      $(window).resize(function(){
        var newWindowWidth2 = $(window).width();
        if (newWindowWidth2 > 1200) {
            $('.main-textexam-sec').show();
            } else {
              $('.main-textexam-sec').hide();
            }
      });
    });
</script>