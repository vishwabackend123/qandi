<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\StudentPreference;
use App\Models\StudentUsers;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Config;

use App\Http\Traits\CommonTrait;
use Carbon\Carbon;
use App\Models\UserPurchase;
use Illuminate\Support\Facades\Log;
use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;
use Mixpanel;

/**
 * SubscriptionController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 * */
class SubscriptionController extends Controller
{
    use CommonTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Index
     *
     * @return void
     */
    public function index()
    {
        try {
            $userData = Session::get('user_data');

            $user_id = isset($userData->id) ? $userData->id : 0;
            $grade_id = isset($userDatagrade_id) ? $userData->grade_id : 0;

            $curl = curl_init();
            $curl1 = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/subscription-packages/' . $user_id;
            $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ". $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);
            $response_status = isset($aResponse->success) ? $aResponse->success : false;
            if ($response_status == true) {
                $subscriptions = isset($aResponse->all_packages) ? $aResponse->all_packages : [];
                $purchased_packages = isset($aResponse->purchased_packages) ? $aResponse->purchased_packages : [];
            } else {
                $subscriptions = [];
                $purchased_packages = [];
            }

            $purchased_ids = [];

            if (is_array($purchased_packages) && !empty($purchased_packages)) {
                foreach ($purchased_packages as $pur) {
                    array_push($purchased_ids, $pur->subscription_id);
                }
            }

            $aPurchased = collect($purchased_packages);


            /*trial link*/

            $curl_url1 = $api_URL . 'api/subscriptions/' . $user_id;
            $curl_option = array(

                CURLOPT_URL => $curl_url1,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ". $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl1, $curl_option);

            $response_json1 = curl_exec($curl1);
            $err1 = curl_error($curl1);
            $httpcode1 = curl_getinfo($curl1, CURLINFO_HTTP_CODE);
            curl_close($curl1);

            $aResponse1 = json_decode($response_json1);

            $response_status1 = isset($aResponse1->success) ? $aResponse1->success : false;
            if ($response_status1 == true) {
                $purchased_packages1 = isset($aResponse1->order_details) ? $aResponse1->order_details : [];
            } else {
                $purchased_packages1 = [];
            }

            $purchasedid = [];

            if (is_array($purchased_packages1) && !empty($purchased_packages1)) {
                foreach ($purchased_packages1 as $purch) {
                    array_push($purchasedid, $purch->subscription_id);
                }
            }

            $aPurchasedpack = collect($purchased_packages1);
            /*trial link*/


            /* Subscription Status Check */
            $preferences = $this->redis_Preference();

            $subscription_yn = (isset($preferences->subscription_yn) && !empty($preferences->subscription_yn)) ? $preferences->subscription_yn : '';
            $today_date = Carbon::now();

            $expiry_date = (isset($preferences->subscription_expiry_date) && !empty($preferences->subscription_expiry_date)) ? $preferences->subscription_expiry_date : '';

            $data_difference = $today_date->diffInDays($expiry_date, false);




            $suscription_status = 3;

            if ($data_difference > 0) {
                //not expired
                $suscription_status = 2;
            } elseif ($data_difference < 0) {
                //expired
                $suscription_status = 0;
            } else {
                //expire today
                $suscription_status = 1;
            }

            $subscription_packages = $this->subscription_packages();
            $subscriptionData = $this->subscribedPackage();
            $latest_pack = isset($subscription_packages->purchased_packages[0]) ? $subscription_packages->purchased_packages[0] : [];
            $subscription_type = (isset($latest_pack) && !empty($latest_pack)) ? $latest_pack->subscription_t : '';
            return view('subscriptions', compact('subscription_type', 'subscriptions', 'purchased_ids', 'aPurchased', 'aPurchasedpack', 'purchasedid', 'suscription_status','subscriptionData'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Trial subscription
     *
     * @param mixed   $sub_id    subject id
     * @param mixed   $exam_year exam year
     * @param mixed   $exam_id   exam id
     * @param Request $request   recieve the body request data
     *
     * @return void
     */
    public function trialSubscription($sub_id, $exam_year, $exam_id, Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $exam_id;
            $subscription_id = $sub_id;

            // Mixpanel Started

            if (Session::has('redis_data')) {
                $redis_data = Session::get('redis_data');
            }else
            {
                $redis_data = $_SESSION['SECRET_REDIS'];
            }
            $Mixpanel_key_id = $redis_data['MIXPANEL_KEY'];
           
            $mp = Mixpanel::getInstance($Mixpanel_key_id);
			
            // track an event

            $mp->track("Free Trial", array(
            'distinct_id' => $userData->id,
            '$user_id' => $userData->id,
            '$phone' => $userData->mobile,
            '$email' => $userData->email,
            'Email Verified' => $userData->email_verified,
            '$city' => $userData->city,
            'Exam Id' => $exam_id));

            // create/update a profile for user id

            $mp->people->set($userData->id, array(
            'distinct_id' => $userData->id,
            '$user_id' => $userData->id,
            '$phone' => $userData->mobile,
            '$email' => $userData->email,
            'Email Verified' => $userData->email_verified,
            '$city' => $userData->city,
            'Exam Id' => $exam_id


            ));

            // Mixpanel Event Ended


            $trail_purchase_data = [
                'student_id' => $user_id,
                'subscription_id' => $subscription_id,
                'exam_year' =>  $exam_year,
            ];
            $order_request_json = json_encode($trail_purchase_data);

            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/save-trial-subscription';

            $curl_option =  array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $order_request_json,
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "content-type: application/json",
                    "Authorization: Bearer ". $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);
            $order_response_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            $aResponse = json_decode($order_response_json);

            $response_status = isset($aResponse->success) ? $aResponse->success : false;

            if ($response_status == true) {
                $sessionData = Session::get('user_data');
                $sessionData->grade_id = $exam_id;
                Session::put('user_data', $sessionData);
                if (env('CRM_URL_STATUS')) {
                    $curl = curl_init();
                    $api_URL = env('CRM_URL');
                    $curl_url = $api_URL . 'crm/update_lead_info/' . $user_id.'/trial';
                    $apiKey = '998da5ee-90de-4cfa-832d-aea9dfee1ccf';
                    $headers = array(
                            'x-api-key: ' . $apiKey,
                            "Authorization: Bearer ". $this->getAccessToken()
                        );
                    $curl_option = array(
                            CURLOPT_URL => $curl_url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_HTTPHEADER => $headers,
                        );
                    curl_setopt_array($curl, $curl_option);

                    $response_json = curl_exec($curl);
                    $err = curl_error($curl);
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    curl_close($curl);
                }
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors(['Something wrong! Plase try after some time.']);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Check out
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function checkout(Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $cacheKey = 'checkout_details:' . $user_id;

            // Mixpanel Started
            if (Session::has('redis_data')) {
                $redis_data = Session::get('redis_data');
            }else
            {
                $redis_data = $_SESSION['SECRET_REDIS'];
            }
            
            $Mixpanel_key_id = $redis_data['MIXPANEL_KEY'];
           
            $mp = Mixpanel::getInstance($Mixpanel_key_id);
			
            
            // track an event

                $mp->track("Get Subcription/Payment start", array(
                    'distinct_id' => $userData->id,
                    '$user_id' => $userData->id,
                    '$phone' => $userData->mobile,
                    '$email' => $userData->email,
                    
                    '$city' => $userData->city));
                // create/update a profile for user id

                $mp->people->set($userData->id, array(
                    'distinct_id' => $userData->id,
                    '$user_id' => $userData->id,
                    '$phone' => $userData->mobile,
                    '$email' => $userData->email,
                    
                    '$city' => $userData->city

                ));
            // Mixpanel Event Ended
            

            if ($request->isMethod('post')) {
                $postdata = $request->all();
                $price = isset($request->exam_price) ? $request->exam_price : 0;
                $subscript_id = isset($request->subscript_id) ? $request->subscript_id : 0;
                $exam_id = isset($request->exam_id) ? $request->exam_id : 0;
                $exam_period = isset($request->exam_period) ? $request->exam_period : 0;
                $period_unit = isset($request->period_unit) ? $request->period_unit : 0;
                $discount_code = isset($request->discount_code) ? $request->discount_code : "";
                $coupon_discount = 0;
                $discounted_price = 0;
                if (isset($postdata['discount_code'])) {
                    $discount_data = $this->ajaxValidateCouponCode($postdata['discount_code']);
                    if ($discount_data) {
                        $coupon_discount = $discount_data->coupon_discount;
                        $discounted_price = ($price * $coupon_discount) / 100;
                        $price = $price - $discounted_price;
                    }
                }
                $curl = curl_init();
                $api_URL = env('API_URL');
                $curl_url = $api_URL . 'api/subscription-package-detail/' . $subscript_id;

                $curl = curl_init();
                $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ". $this->getAccessToken()
                ),

            );
                curl_setopt_array($curl, $curl_option);

                $package_response_json = curl_exec($curl);
                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                if ($httpcode != 200 || $httpcode != 201) {
                    $pResponse = json_decode($package_response_json);
                    $package_data = isset($pResponse->package_details) ? $pResponse->package_details : '';
                    $subscriptions_data = !empty($package_data) ? $package_data[0] : [];
                    $subscript_data = json_decode($subscriptions_data->subs_price,true);
                    $price = $subscript_data['price'];
                } else {
                    $subscriptions_data = [];
                }

                $amount = $price * 100;

                $notes = [
                "month" => $exam_period,
                "exam_id" => $exam_id,
            ];

                $request = [
                "amount" => $price,
                "currency" => "INR",
                "notes" => $notes
            ];
                $order_request_json = json_encode($request);

                $curl = curl_init();
                $api_URL = env('API_URL');
                $curl_url = $api_URL . 'api/payment/order-id';
                $curl_option = array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $order_request_json,
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "content-type: application/json",
                    "Authorization: Bearer ". $this->getAccessToken()
                ),
            );
                curl_setopt_array($curl, $curl_option);
                $order_response_json = curl_exec($curl);
                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


                if ($httpcode != 200 || $httpcode != 201) {
                    $aResponse = json_decode($order_response_json);
                    $razorpayOrderId = isset($aResponse->order_details->id) ? $aResponse->order_details->id : '';
                } else {
                    $razorpayOrderId = '';
                }


                
                $checkout_data = array();
                $checkout_data['subscriptions_data'] = $subscriptions_data;
                $checkout_data['razorpayOrderId'] = $razorpayOrderId;
                $checkout_data['price'] = $price;
                $checkout_data['subscript_id'] = $subscript_id;
                $checkout_data['exam_id'] = $exam_id;
                $checkout_data['coupon_discount'] = $coupon_discount;
                $checkout_data['discount_code'] = $discount_code;
                $checkout_data['discounted_price'] = $discounted_price;
                Redis::set($cacheKey, json_encode($checkout_data));
                $razorData = $this->getSecretName();
                return view('subscription_checkout', compact('subscriptions_data', 'razorpayOrderId', 'price', 'subscript_id', 'exam_id', 'subscript_id', 'coupon_discount', 'discount_code', 'discounted_price','razorData'));
            } else {
                $checkout_data = json_decode(Redis::get($cacheKey), true);
                $subscriptions_data = (object)$checkout_data['subscriptions_data'];
                $razorpayOrderId = $checkout_data['razorpayOrderId'];
                $price=$checkout_data['price'];
                $subscript_id=$checkout_data['subscript_id'];
                $exam_id = $checkout_data['exam_id'];
                $coupon_discount = $checkout_data['coupon_discount'];
                $discount_code = $checkout_data['discount_code'];
                $discounted_price = $checkout_data['discounted_price'];
                $razorData = $this->getSecretName();
                return view('subscription_checkout', compact('subscriptions_data', 'razorpayOrderId', 'price', 'subscript_id', 'exam_id', 'subscript_id', 'coupon_discount', 'discount_code', 'discounted_price','razorData'));
            }
        } catch (\Exception $e) {

            // Mixpanel Started

            if (Session::has('redis_data')) {
                $redis_data = Session::get('redis_data');
            }else
            {
                $redis_data = $_SESSION['SECRET_REDIS'];
            }
            $Mixpanel_key_id = $redis_data['MIXPANEL_KEY'];
           
            $mp = Mixpanel::getInstance($Mixpanel_key_id);
			

            $mp->track("Payment Failed", array(
                'distinct_id' => $userData->id,
                '$user_id' => $userData->id,
                '$phone' => $userData->mobile,
                '$email' => $userData->email,
                
                '$city' => $userData->city));
               // create/update a profile for user id
               $mp->people->set($userData->id, array(
                'distinct_id' => $userData->id,
                '$user_id' => $userData->id,
                '$phone' => $userData->mobile,
                '$email' => $userData->email,
                
                '$city' => $userData->city

                
            ));
            // Mixpanel Event Ended

            
            Log::info($e->getMessage());
        }
    }
    /**
     * Refund Form
     *
     * @return void
     */
    public function refundForm()
    {
        return view('afterlogin.refund_form');
    }
    /**
     * Refund Form Submit
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function refundFormSubmit(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;

            $rquestData = $request->all();

            $request = [
                "student_id" => $user_id,
                "user_name" => $request->firstname,
                "bank_name" => $request->bank_name,
                "account_no" => $request->acc_no,
                "code_ifsc" => $request->ifsc_code,
                "subject" => $request->subject,
            ];

            $request_json = json_encode($request);

            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/student-refund';
            $curl_option = array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json,
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "content-type: application/json",
                    "Authorization: Bearer ". $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);


            if (isset($aResponse->success) && $aResponse->success == true) {
                echo $response_json;
            } else {
                echo $err;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Validat Discount Code
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function validatDiscountCode(Request $request)
    {
        $rquestData = $request->all();
        $couponCode = $rquestData['couponCode'];
        $response_status = $this->ajaxValidateCouponCode($couponCode);
        if ($response_status) {
            return response()->json([
                'status' => true,
                'message' => 'Coupon code applied successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No coupon found.',
            ]);
        }
    }
    /**
     * Ajax Validate Coupon Code
     *
     * @param mixed $couponCode coupon code
     *
     * @return void
     */
    public function ajaxValidateCouponCode($couponCode)
    {
        try {
            $curl = curl_init();
            $curl1 = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/coupon/' . $couponCode;
            $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ". $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);
            $response_status = isset($aResponse->success) && !empty($aResponse->success) ? $aResponse->success : false;
            if ($response_status) {
                return $aResponse->response;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function sendVerficationEmail(Request $request)
    {
        try {
            $postData = $request->all();
            $curl = curl_init();
            $curl1 = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/get-email-verification-link?user_id=' . $postData['userId'];
            $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ". $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);
            $response_status = isset($aResponse->status) && !empty($aResponse->status) ? $aResponse->status : false;
            if ($response_status) {
                return response()->json([
                    'status' => true,
                    'message' => $aResponse->message,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $aResponse->message,
                ]);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    public function getSecretName()
    {
        $client = new SecretsManagerClient([
                'version' => '2017-10-17',
                'region' => 'ap-south-1'
            ]);

        $studentCecretName = env('SECRET_REDIS');
        $resultStudent = $client->getSecretValue([
            'SecretId' => $studentCecretName,
        ]);
        if (isset($resultStudent['SecretString']) && !empty($resultStudent['SecretString'])) {
            $redis_data=json_decode($resultStudent['SecretString'], true);
        }; 
        return $redis_data;
    }
}
