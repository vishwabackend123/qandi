
@extends('layouts.app')
@section('content')



<style>


    

 
.getDiscount{
    background: #f5faf6;   padding: 86px 131px;
}
.planPayment .testType {
    display: block;
    width: 50%;
    border-right: 1px solid #e4e2e2;
}
.applyCo{
    display: block;
    padding-top: 40px;
    width: 50%;
}
.applyCoform{
    max-width: 295px;
    margin: 0 auto;
}

.planPayment{
    background: #ffffff;
    display: flex;
    border-radius: 20px;
    box-shadow: 0 8px 30px 0 rgb(172 185 176 / 14%);
}
.planPayment .testType{display: block;padding-left: 28px}
.planPayment .testType h2{
    font-size: 24px;

}


.subscribe_form{
    padding-top: 43px;
}
 

.subscribe_form .custom-input .form-control {
    border: none !important;
}
.subscribe_form .input-group{
    color: #363c4f;
    border: 1px solid #d0d5dd !important;
    background: #fff;
  
    border-radius: 8px;
    box-shadow: 0 1px 2px 0 rgb(16 24 40 / 5%);
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    width: 100%;
    
}
.subscribe_form .custom-input {
    border-bottom: 1px solid rgb(86 182 99 / 30%);
    padding-bottom: 20px;
}

.payDetail p{
    display: flex;
    justify-content: space-between;
    
}
.PlanR{
    font-size: 14px;
  font-weight: 800;
  font-stretch: normal;
  font-style: normal;
  line-height: 1.29;
  letter-spacing: normal;
  text-align: left;
  color: #363c4f;
}
.planL{
    font-size: 14px;
  font-weight: 600;
  font-stretch: normal;
  font-style: normal;
  line-height: 1.3;
  letter-spacing: normal;
  text-align: left;
  color: rgba(54, 60, 79, 0.8);
}
.payDetail {
    padding-top: 17px;
}
.inst {
    text-align: center;
}
.inst p {
    padding: 0px;
    margin: 0px;
}
 

 
 



        </style>

<section class="getDiscount">
    <div class="planPayment">
    
            
        <div class="testType">
            <h2 class="SelectPlanName">NEET Annual Plan</h2>
            <ul>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                    </svg>
                    Chapter and Topic-wise Unlimited Tests
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                    </svg>
                    Adaptive Learning Experience
                </li>
                <li>
                
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                    </svg>
                    AI-based Analytics and Valuable Insightss
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                    </svg>
                    Identify Your Strengths and Weaknesses
                </li>
            
            
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                    </svg>
                    Personalised and Smart Recommendations
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                    </svg>
                    Plan Your Weekly and Monthly Preparation
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                    </svg>
                    Unlimited Mock tests</li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0 10C0 4.477 4.477 0 10 0s10 4.477 10 10-4.477 10-10 10S0 15.523 0 10z" fill="#56B663" fill-opacity=".1"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.247 6.158 8.28 11.917l-1.583-1.692c-.292-.275-.75-.292-1.083-.058a.764.764 0 0 0-.217 1.008l1.875 3.05c.183.283.5.458.858.458.342 0 .667-.175.85-.458.3-.392 6.025-7.217 6.025-7.217.75-.766-.158-1.441-.758-.858v.008z" fill="#56B663"></path>
                    </svg>Live Exam - All India Test Series
                </li>
            </ul>
        </div>
        <div class="applyCo">
            <div class="applyCoform">
                <h3>15,000 <sub>Inc tax</sub></h3>

                
                <form class="subscribe_form">
                    <div class="custom-input">
                        <label>Discoun:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="text" placeholder="Code">
                            <span class="input-group-btn">
                                <button class="btn btn-default applyDiscount" type="button">Apply</button>
                            </span>
                        </div>
                    </div>
                    <div class="payDetail">
                        <p><span class="planL">Plan duration</span><span class="PlanR">1 year</span></p>
                        <p><span class="planL">Discount</span><span class="PlanR">₹0</span></p>
                        <p><span class="planL">Total</span><span class="PlanR">₹15,000</span></p>
                        

                    </div>


                  </form>


                  <div class="inst">
                    <p>By clicking "Make Payment" you authorise your payment method to be charged in accordance with your subscription plan. For more details</p> 
<a href="">Terms of Service</a> 
                 </div>



                  
            </div>
        </div>

  
    </div>
</section>
@endsection