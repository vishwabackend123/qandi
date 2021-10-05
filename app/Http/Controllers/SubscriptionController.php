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
        $user_data = Auth::user();
        $user_id = isset(Auth::user()->id) ? Auth::user()->id : 0;
        $grade_id = isset(Auth::user()->grade_id) ? Auth::user()->grade_id : 0;

        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');
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

        //dd($aPurchased, $filtered_data);

        return view('subscriptions', compact('subscriptions', 'purchased_ids', 'aPurchased'));
    }


    /**
     * Show the subscription packages.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trial_subscription($sub_id, Request $request)
    {
        $user_id = Auth::user()->id;
        $subscription_id = $sub_id;

        $trail_purchase_data = [
            'student_id' => $user_id,
            'subscription_id' => $subscription_id,
            'exam_year' => 2022,
        ];
        $order_request_json = json_encode($trail_purchase_data);


        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');
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
        $api_URL = Config::get('constants.API_NEW_URL');
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
        $api_URL = Config::get('constants.API_NEW_URL');
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
            $subscriptions_data = $package_data[0];
        } else {
            $subscriptions_data = [];
        }



        return view('subscription_checkout', compact('subscriptions_data', 'razorpayOrderId', 'price'));
    }
}
