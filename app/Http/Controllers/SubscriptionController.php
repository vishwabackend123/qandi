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

        $cacheKey = 'subscription_packages';

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
        if ($httpcode == 200 || $httpcode == 201) {
            $aResponse = json_decode($response_json);

            $subscriptions = isset($aResponse->all_packages) ? json_decode($aResponse->all_packages) : [];
            $purchased_packages = isset($aResponse->purchased_packages) ? json_decode($aResponse->purchased_packages) : [];
            Redis::set($cacheKey, json_encode($subscriptions));
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



        return view('subscriptions', compact('subscriptions', 'purchased_ids'));
    }


    /**
     * Show the subscription packages.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function trial_subscription($sub_id, Request $request)
    {
        $user_id = Auth::user()->id;
        $grade_id = $sub_id;
        $subscription_date = date('Y-m-d');
        $subscription_expiry = date('Y-m-d');

        $date = Carbon::now();
        $date->addDays(15);

        $subscription_expiry = $date->format('Y-m-d');

        $update_user = [
            'grade_id' => $grade_id,
        ];
        $upt_user = StudentUsers::where('id', $user_id)->update($update_user);

        $update_preference = [
            'subscription_yn' => 'Y',
            'subscription_expiry_date' => $subscription_expiry,
        ];
        $upt_pre = StudentPreference::where('student_id', $user_id)->update($update_preference);

        if ($upt_pre) {
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
        $amount = $price * 100;

        $receipt_Id = 'order_rcptid_' . mt_rand(100000, 999999);

        $api = new Api(env('RAZORPAY_KEY'),  env('RAZORPAY_SECRET'));


        $order = $api->order->create(
            array(
                'receipt' => $receipt_Id,
                'amount' => $amount,
                'currency' => 'INR'
            )
        );
        $razorpayOrderId = $order['id'];



        /*  $subscriptions_data = DB::table('class_exams as ce')
            ->select('ce.id as exam_id', 'ce.class_exam_cd as exam_name', 'ce.class_exam_desc as exam_description')
            ->leftJoin('exam_subscription_price as esp', 'esp.exam_id', '=', 'ce.id')
            ->addSelect('esp.day_unit', 'esp.day_month_count', 'esp.exam_price')
            ->where('ce.status', '1')
            ->where('ce.id', $request->exam_id)
            ->first(); */
        $subscriptions = $this->subscription_packages();
        if (isset($subscriptions) && !empty($subscriptions)) {
            $subscriptions_collect = collect($subscriptions);
            $subscriptions_data = $subscriptions_collect->where('subscript_id', $request->subscript_id)->values()->all();
            $subscriptions_data = $subscriptions_data[0];
        } else {
            $subscriptions_data = [];
        }

        //dd($subscriptions_data);


        return view('subscription_checkout', compact('subscriptions_data', 'razorpayOrderId', 'price'));
    }
}
