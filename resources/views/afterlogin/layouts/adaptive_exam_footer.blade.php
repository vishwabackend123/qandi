<script>

const checkConnection = async () => {
    try {
        
        const response = navigator.onLine;       
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
            $("#resume-duration-div").show();
            $("#resume-button-div").show();
            $("#connectivity_div").hide();
            $("#resume_subMsg").show();

            $('#myTabContent .quesBtns').attr("disabled", false);
            $('#myTabContent .quesBtns').removeClass("disabled");
    }
    
    
}, 10000);

    </script>