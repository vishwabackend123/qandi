<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\StudentUsers;
use App\Models\UserPurchase;
use App\Models\StudentPreference;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Config;

use App\Http\Traits\CommonTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Mixpanel;

/**
 * RazorpayController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class RazorpayController extends Controller
{
    use CommonTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $cacheKey = 'payment_details:' . $user_id;
            $paymentKey = 'payment_response:' . $user_id;
            $payment_id = isset($request->razorpay_payment_id) ? $request->razorpay_payment_id : '';
            if (isset($payment_id) && !empty($payment_id)) {
                $order_id = isset($request->razorpay_order_id) ? $request->razorpay_order_id : '';
                $razorpay_signature = isset($request->razorpay_signature) ? $request->razorpay_signature : '';
                $exam_id = isset($request->exam_id) ? $request->exam_id : '';
                $verify_request = [
                        "payment_id" => $payment_id,
                        "order_id" => $order_id,
                        "signature" => $razorpay_signature,
                        "user_id" => $user_id
                    ];

                $order_request_json = json_encode($verify_request);
                $curl = curl_init();
                $api_URL = env('API_URL');
                $curl_url = $api_URL . 'api/payment/verify-payment';
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
                $response_json = curl_exec($curl);

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                Redis::set($cacheKey, $order_request_json);
                Redis::set($paymentKey, $response_json);
            } else {
                $order_request_json = Redis::get($cacheKey);
                $response_json = Redis::get($paymentKey);
            }
            $aResponse = json_decode($response_json);
            $success_status = isset($aResponse->success) ? $aResponse->success : false;
            $transaction_data = isset($aResponse->orderDetails) ? $aResponse->orderDetails : [];
            if ($success_status == true) {
                $sessionData = Session::get('user_data');
                $sessionData->grade_id = isset($exam_id) && !empty($exam_id) ? $exam_id : $sessionData->grade_id;

                // Mixpanel Started
                $details = $aResponse->orderDetails;

                $amount = isset($details->amount) ? $details->amount: 0;


                // Mixpanel Started Event
                
                $redis_data = Session::get('redis_data');
                $Mixpanel_key_id = $redis_data['MIXPANEL_KEY'];
           
                $mp = Mixpanel::getInstance($Mixpanel_key_id);
                
                    // track an event
                    $mixpane_amount= $amount/100;
                    $mp->track("Payment Completed", array(
                        'distinct_id' => $userData->id,
                    '$user_id' => $userData->id,
                    '$phone' => $userData->mobile,
                    '$email' => $userData->email,
                    'Email Verified' => $userData->email_verified,
                    //'Course' => $grade,
                    '$city' => $userData->city,
                    '$name'=>$userData->user_name,
                    'State'=>$userData->state,
                    'amount paid' => $mixpane_amount));

                    // create/update a profile for user id

                    $mp->people->set($userData->id, array(
                        'distinct_id' => $userData->id,
                    '$user_id' => $userData->id,
                    '$phone' => $userData->mobile,
                    '$email' => $userData->email,
                    'Email Verified' => $userData->email_verified,
                    //'Course' => $grade,
                    '$city' => $userData->city,
                    '$name'=>$userData->user_name,
                    'State'=>$userData->state,
                    'amount paid' => $mixpane_amount
                    ));


                // Mixpanel Event Ended



                Session::put('user_data', $sessionData);
                if (env('CRM_URL_STATUS')) {
                    $curl = curl_init();
                    $api_URL = env('CRM_URL');
                    $curl_url = $api_URL . 'crm/update_lead_info/' . $user_id.'/purchased';
                    $apiKey = '998da5ee-90de-4cfa-832d-aea9dfee1ccf';
                    $headers = array(
                            'x-api-key: ' . $apiKey,
                            "Authorization: Bearer " . $this->getAccessToken()
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
                return view('plan_purchased_success', compact('transaction_data'));
            } else {

                // Mixpanel Started
                $redis_data = Session::get('redis_data');
                $Mixpanel_key_id = $redis_data['MIXPANEL_KEY'];
           
                $mp = Mixpanel::getInstance($Mixpanel_key_id);
			
                // track an event

                $mp->track("Payment Failed", array(
                    'distinct_id' => $userData->id,
                '$user_id' => $userData->id,
                '$phone' => $userData->mobile,
                '$email' => $userData->email,
                'Email Verified' => $userData->email_verified,
                //'Course' => $grade,
                '$city' => $userData->city,
                '$name'=>$userData->user_name,
                'State'=>$userData->state,
                'amount paid' => "", 'course cost' => "", 'discount' => "" ));

                // create/update a profile for user id

                $mp->people->set($userData->id, array(
                    'distinct_id' => $userData->id,

                '$user_id' => $userData->id,
                '$phone' => $userData->mobile,
                '$email' => $userData->email,
                'Email Verified' => $userData->email_verified,
                //'Course' => $grade,
                '$city' => $userData->city,
                '$name'=>$userData->user_name,
                'State'=>$userData->state
                ));

                // Mixpanel Event Ended

                
                return view('plan_purchased_faild', compact('transaction_data', 'exam_id'));
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Store old
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function store_old(Request $request)
    {
        try {
            $input = $request->all();
            $exam_id = $input['exam_id'];

            $userData = Session::get('user_data');

            $user_id = $userData->id;


            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            //$api = new Api('rzp_test_foHLtdKSJjEDzv', 'RFrAe68CEzVrQpuuHnlKJHcy');

            $payment = $api->payment->fetch($input['razorpay_payment_id']);



            if (count($input)  && !empty($input['razorpay_payment_id'])) {
                try {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                    $select_month = $response->notes->month;
                    $payment_date = gmdate("Y-m-d H:i:s", $response->created_at);

                    $subscription_start_date = gmdate("Y-m-d", $response->created_at);
                    $expiry_date = date("Y-m-d", strtotime("+" . $select_month . " months"));
                    $user_purchase_data = [
                        'user_id' => $user_id,
                        'purchase_date' => $payment_date,
                        'amount' => $response->amount / 100,
                        'transaction_id' => $response->id,
                        'order_id' => $response->order_id,
                        'order_status' => $response->status,
                        'transaction_status' => "Pass",
                        'subscription_type' => 'P',
                        'payment_by' => $response->method,
                        'created_on' => $payment_date,
                        'subscription_end_date' => $expiry_date,
                        'subscription_start_date' => $subscription_start_date,
                        'subscription_id' => $response->notes->exam_id,
                        'exam_year' => '2021',  // new attribute
                    ];


                    UserPurchase::create($user_purchase_data);

                    $update_user = [
                        'grade_id' => $response->notes->exam_id,
                    ];
                    $upt_user = StudentUsers::where('id', $user_id)->update($update_user);

                    $update_preference = [
                        'subscription_yn' => 'Y',
                        'subscription_expiry_date' => $expiry_date,
                    ];
                    $upt_pre = StudentPreference::where('student_id', $user_id)->update($update_preference);
                } catch (Exception $e) {
                    return  $e->getMessage();
                    Session::put('error', $e->getMessage());
                    return redirect()->route('subscriptions');
                }
            }

            Session::forget('user_data');
            $user_Data = Auth::user();
            Session::put('user_data', $user_Data);
            $userData = Session::get('user_data');

            Session::put('success', 'Payment successful');
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
