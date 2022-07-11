@extends('afterlogin.layouts.app_new')
 

 

<div class="exam-wrapper">
    
    <div class="content-wrapper">
        <div class="examSereenwrapper">
            <div class="examMaincontainer">
                <div class="examLeftpanel">
                <div class="">
                        <div class="tabMainblock">
                            <div class="commontab aeck_commontab">
                                <div class="tablist">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4 active" data-bs-toggle="tab" href="#evaluation">Math .65</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#application">Physics .50</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link qq1_2_3_4" data-bs-toggle="tab" href="#complrehension">Chemistry .60</a>
                                        </li>
                                      
                                    </ul>
                                </div>
                                <div class="submitBtn"><button>Submit Test<span></span></button></div>
                                <!-- Tab panes -->
                                <div class="tab-content aect_tabb_contantt">
                                    <div id="evaluation" class=" tab-pane active">
                                         
                                    </div>
                                    <div id="application" class=" tab-pane">
                                 adasdas
                                    </div>
                                    <div id="complrehension" class=" tab-pane">
                                    complrehension
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="examRightpanel">
                    dfdfd
                    
                </div>
            </div>

        </div>
    </div>
 
</div>

 
<style>
.examMaincontainer{
    display: flex;
}
.exam-wrapper {
    background: #f5faf6;
}

.examLeftpanel{
    width:calc(100% - 379px);
    height: 100vh;

}
.examRightpanel{
    min-width: 379px;
    max-width: 379px;
    height: 100vh;
    margin: 0 0 0 40px;
    padding: 40px 28px 10px;
    border-radius: 20px;
    box-shadow: 0 8px 30px 0 rgba(172, 185, 176, 0.14);
    background-color: #ffffff;
}
.submitBtn{
    position: absolute;
    top: 0px;
    right: 0px;
}
</style>
 


 