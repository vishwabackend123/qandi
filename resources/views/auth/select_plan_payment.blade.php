
@extends('layouts.app')
@section('content')



<style>
.getDiscount{
    background: #f5faf6;
    min-height: 100%; 
    padding: 86px 131px;
}
.planPayment .testType {
    display: block;
    width: 50%;
    border-right: 1px solid #e4e2e2;
    display: block;
    padding-left: 28px;
    position: relative;
    border-bottom: none;
    padding-top:0px; 
}
.applyCo{
    display: block;
    padding-top: 130px;
    width: 50%;
}
.applyCoform{
    max-width: 310px;
    margin: 0 auto;
}
.applyCoform h3{
    font-size: 32px;
    font-weight: 600;
    line-height: 1.3;
    text-align: left;
    color:#1f1f1f;
}
.applyCoform sub{
    font-size: 14px;
    font-weight: normal;
    line-height: 1.3;
    color: #363c4f;
}

.planPayment{
    background: #ffffff;
    display: flex;
    border-radius: 20px;
    box-shadow: 0 8px 30px 0 rgb(172 185 176 / 14%);
}

.planPayment .testType h2{
    font-size: 24px;
    font-weight: 600;
    line-height: 1.3;
    color: #1f1f1f;
    padding-bottom: 32px;
    padding-top: 72px;
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
    border-bottom: 1px solid rgb(86 182 99 / 8%);
    padding-bottom: 20px;
    border-top: 1px solid rgb(86 182 99 / 8%);
    padding-top: 20px;
}
.payDetail p{
    display: flex;
    justify-content: space-between;   
}
.PlanR{
    font-size: 14px;
    font-weight: 800;
    line-height: 1.29;
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
    padding: 47px 0px;
    font-size: 12px;
    font-weight: 500;
    line-height: 1.6;
    text-align: center;
    color: rgba(54, 60, 79, 0.8);
}
.inst p {
    padding: 0px;
    margin: 0px;
}
.inst a{
    color:#56b663;
}
.getDiscount .testType ul li {
    font-size: 14px;
    line-height: 3;
    display: flex;
    align-items: center;
    font-size: 14px;
    font-weight: 500;
    color: #363c4f;
}
.secured{
    position: absolute;
    bottom: 20px;
}
.secured p{
    font-size: 12px;
    font-weight: normal;
    line-height: 1;
    color: #424242;
    display: flex;
    align-items: center;
    margin: 0px;
    padding: 0px;
}
.secured span{
    margin-left:10px; 
} 
.applyDiscount{
    color: 56b663;
    background: transparent;
}
.Paymentbtn{
    text-align:center;
}
.backBtn {
    padding-top: 40px;
}
.backBtn a{
    font-size: 14px;
    font-weight: 500;
    line-height: 1.43;
    letter-spacing: normal;
    text-align: left;
    color: rgba(54, 60, 79, 0.8);
    display: flex;
    align-items: center;
    text-decoration: none;
}
 </style>

<section class="getDiscount">
    <div class="planPayment">
        <div class="testType">
            <div class="backBtn">
                <a href="javascript:void(0)">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M10 4 6 8l4 4" stroke="#363C4F" stroke-opacity=".8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    Back
                </a>
            </div>
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
            <div class="secured">
                <p>
                    Secured by
                    <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="87" height="18" viewBox="0 0 87 18" fill="none">
                        <path d="m5.627 4.755-.723 2.596 4.137-2.61-2.706 9.85 2.748.002L13.08.042" fill="#3395FF"/>
                        <path d="m1.175 10.452-1.138 4.14h5.631L7.973 6.17l-6.798 4.283zm19.562-3.646c-.138.5-.403.866-.798 1.1-.395.234-.949.351-1.664.351h-2.271l.797-2.901h2.272c.714 0 1.204.116 1.47.353.266.238.33.6.194 1.102v-.005zm2.352-.058c.289-1.048.17-1.854-.36-2.418-.527-.56-1.453-.841-2.774-.841h-5.07l-3.05 11.108h2.462l1.23-4.477h1.615c.362 0 .648.058.856.17.209.116.331.318.369.609l.44 3.699h2.638l-.428-3.448c-.087-.77-.448-1.223-1.083-1.357.81-.228 1.487-.609 2.033-1.137a4.124 4.124 0 0 0 1.122-1.903v-.005zm5.986 3.873c-.207.753-.523 1.321-.951 1.72-.429.398-.941.595-1.538.595-.609 0-1.021-.192-1.24-.582-.218-.39-.225-.954-.022-1.692.202-.74.526-1.317.971-1.733a2.213 2.213 0 0 1 1.563-.625c.596 0 1.005.202 1.211.602.211.401.216.976.01 1.723l-.004-.008zm1.08-3.931-.31 1.124a1.788 1.788 0 0 0-.772-.967c-.383-.238-.857-.358-1.422-.358a4.1 4.1 0 0 0-1.996.523 5.235 5.235 0 0 0-1.674 1.478 6.429 6.429 0 0 0-1.051 2.167c-.22.815-.266 1.527-.133 2.145.137.622.426 1.097.872 1.428.45.336 1.023.502 1.725.502a3.86 3.86 0 0 0 1.615-.345c.5-.22.945-.544 1.303-.95l-.321 1.172h2.381l2.175-7.915h-2.386l-.007-.004zm10.95 0h-6.926l-.484 1.764h4.03l-5.328 4.491-.455 1.657h7.15l.483-1.764h-4.318l5.41-4.558.438-1.59zm6.096 3.918c-.215.779-.532 1.365-.952 1.746-.42.385-.929.578-1.526.578-1.248 0-1.658-.775-1.232-2.324.21-.77.53-1.35.957-1.74.427-.39.944-.586 1.552-.586.596 0 1 .194 1.207.585.207.39.205.97-.006 1.74zm1.394-3.62c-.549-.333-1.248-.5-2.102-.5-.864 0-1.664.166-2.4.497-.733.33-1.377.82-1.881 1.436a5.747 5.747 0 0 0-1.12 2.185c-.225.83-.253 1.558-.078 2.182a2.363 2.363 0 0 0 1.092 1.432c.555.335 1.261.5 2.129.5.853 0 1.647-.167 2.377-.5a5.223 5.223 0 0 0 1.872-1.437 5.766 5.766 0 0 0 1.12-2.185c.229-.833.256-1.56.082-2.185a2.377 2.377 0 0 0-1.083-1.436l-.008.01zm8.502 1.816.61-2.153c-.207-.103-.477-.157-.817-.157-.546 0-1.07.132-1.574.398a3.412 3.412 0 0 0-1.115.947l.317-1.16-.692.003H52.13l-2.19 7.912h2.416l1.135-4.136c.166-.601.463-1.075.892-1.41.427-.338.959-.506 1.601-.506.395 0 .762.088 1.11.264l.003-.002zm6.72 1.842c-.207.739-.52 1.303-.946 1.692-.427.392-.94.587-1.537.587s-1.005-.197-1.22-.591c-.221-.396-.226-.967-.02-1.718.207-.75.524-1.325.96-1.723.436-.402.95-.603 1.546-.603.587 0 .982.206 1.193.623.211.416.216.994.013 1.732l.01.001zm1.678-3.645c-.448-.35-1.02-.524-1.712-.524-.607 0-1.186.134-1.734.406-.549.27-.994.64-1.336 1.107l.008-.053.406-1.259h-2.359l-.6 2.19-.02.076-2.477 9.02h2.418l1.248-4.54c.124.403.376.72.762.95.385.228.861.341 1.427.341.702 0 1.372-.165 2.007-.497a4.932 4.932 0 0 0 1.657-1.428 6.245 6.245 0 0 0 1.037-2.145c.225-.812.27-1.536.142-2.17-.13-.634-.42-1.125-.867-1.472L65.495 7zm8.021 3.613c-.207.747-.523 1.32-.95 1.715a2.18 2.18 0 0 1-1.537.594c-.61 0-1.023-.193-1.239-.582-.22-.39-.225-.954-.023-1.693.202-.739.524-1.316.97-1.733a2.214 2.214 0 0 1 1.563-.624c.596 0 1 .202 1.21.6.212.4.213.975.008 1.724l-.002-.001zm1.078-3.934-.308 1.124a1.772 1.772 0 0 0-.771-.967c-.386-.24-.859-.358-1.423-.358a4.12 4.12 0 0 0-2 .524c-.638.349-1.198.839-1.675 1.473a6.416 6.416 0 0 0-1.051 2.167c-.223.813-.266 1.527-.133 2.147.134.618.424 1.096.872 1.429.447.331 1.023.498 1.725.498.564 0 1.103-.114 1.615-.344a3.771 3.771 0 0 0 1.3-.95l-.321 1.171h2.381l2.174-7.912h-2.381l-.004-.002zm12.384.003V6.68h-1.463c-.047 0-.088.002-.13.003h-.76l-.39.528-.096.125-.042.063-3.086 4.195-.637-4.912h-2.528l1.28 7.464-2.826 3.82h2.519l.684-.947a1.82 1.82 0 0 1 .06-.08l.798-1.106.023-.032 3.576-4.947 3.014-4.165.005-.002h-.001v-.005z" fill="#072654"/>
                    </svg>
                </span>
                </p>
            </div>
        </div>
        <div class="applyCo">
            <div class="applyCoform">
                <h3>₹15,000 <sub>Inc tax</sub></h3>
                <form class="subscribe_form">
                    <div class="custom-input">
                        <label>Discount code</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="text" placeholder="Code">
                            <button class="btn btn-default applyDiscount" type="button">Apply</button>
                        </div>
                    </div>
                    <div class="payDetail">
                        <p><span class="planL">Plan duration</span><span class="PlanR">1 year</span></p>
                        <p><span class="planL">Discount</span><span class="PlanR">₹0</span></p>
                        <p><span class="planL">Total</span><span class="PlanR">₹15,000</span></p>
                    </div>
                    <div class="Paymentbtn">
                        <a href="javascript:void(0)" class="btn btn-common-green">Make Payment</a>
                    </div>
                  </form>
                  <div class="inst">
                    <p>By clicking "Make Payment" you authorise your payment method to be charged in accordance with your subscription plan. For more details</p> 
                    <a href="javascript:void(0)">Terms of Service</a> 
                 </div>
            </div>
        </div>

  
    </div>
</section>
@endsection