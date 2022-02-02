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

class SubscriptionController extends Controller
{
    //
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
     * Show the subscription packages.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $userData = Session::get('user_data');

        $user_id = isset($userData->id) ? $userData->id : 0;
        $grade_id = isset($userDatagrade_id) ? $userData->grade_id : 0;

        $curl = curl_init();
        $curl1 = curl_init();
        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/subscription-packages/' . $user_id;

        curl_setopt_array($curl, array(

            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

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

        curl_setopt_array($curl1, array(

            CURLOPT_URL => $curl_url1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

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
        $latest_pack = isset($subscription_packages->purchased_packages[0]) ? $subscription_packages->purchased_packages[0] : [];
        $subscription_type = (isset($latest_pack) && !empty($latest_pack)) ? $latest_pack->subscription_t : '';




        return view('subscriptions', compact('subscription_type', 'subscriptions', 'purchased_ids', 'aPurchased', 'aPurchasedpack', 'purchasedid', 'suscription_status'));
    }


    /**
     * Show the subscription packages.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trial_subscription($sub_id, $exam_year, Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $subscription_id = $sub_id;

        $trail_purchase_data = [
            'student_id' => $user_id,
            'subscription_id' => $subscription_id,
            'exam_year' =>  $exam_year,
        ];
        $order_request_json = json_encode($trail_purchase_data);

        $curl = curl_init();
        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/save-trial-subscription';


        curl_setopt_array($curl, array(
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
                "content-type: application/json"
            ),
        ));
        $order_response_json = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $aResponse = json_decode($order_response_json);

        $response_status = isset($aResponse->success) ? $aResponse->success : false;

        if ($response_status == true) {
            Session::forget('user_data');
            $user_Data = Auth::user();
            Session::put('user_data', $user_Data);
            $userData = Session::get('user_data');

            return redirect()->route('dashboard');
        } else {

            return redirect()->back()->withErrors(['Something wrong! Plase try after some time.']);
        }
    }


    /**
     * Show the subscription packages details for checkout.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkout(Request $request)
    {

        $postdata = $request->all();

        $price = isset($request->exam_price) ? $request->exam_price : 0;
        $subscript_id = isset($request->subscript_id) ? $request->subscript_id : 0;
        $exam_id = isset($request->exam_id) ? $request->exam_id : 0;
        $exam_period = isset($request->exam_period) ? $request->exam_period : 0;
        $period_unit = isset($request->period_unit) ? $request->period_unit : 0;

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


        curl_setopt_array($curl, array(
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
                "content-type: application/json"
            ),
        ));
        $order_response_json = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        if ($httpcode != 200 || $httpcode != 201) {
            $aResponse = json_decode($order_response_json);
            $razorpayOrderId = isset($aResponse->order_details->id) ? $aResponse->order_details->id : '';
        } else {
            $razorpayOrderId = '';
        }


        $curl = curl_init();
        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/subscription-package-detail/' . $subscript_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(

            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $package_response_json = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode != 200 || $httpcode != 201) {
            $pResponse = json_decode($package_response_json);
            $package_data = isset($pResponse->package_details) ? $pResponse->package_details : '';
            $subscriptions_data = !empty($package_data) ? $package_data[0] : [];
        } else {
            $subscriptions_data = [];
        }



        return view('subscription_checkout', compact('subscriptions_data', 'razorpayOrderId', 'price'));
    }

    public function refundForm()
    {
        return view('afterlogin.refund_form');
    }
    public function refundFormSubmit(Request $request)
    {

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

        curl_setopt_array($curl, array(
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
                "content-type: application/json"
            ),
        ));
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
    }
}
