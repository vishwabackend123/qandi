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

class RazorpayController extends Controller
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
        $this->middleware('auth');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;

        $payment_id = isset($request->razorpay_payment_id) ? $request->razorpay_payment_id : '';
        $order_id = isset($request->razorpay_order_id) ? $request->razorpay_order_id : '';
        $razorpay_signature = isset($request->razorpay_signature) ? $request->razorpay_signature : '';

        $verify_request =
            [
                "payment_id" => $payment_id,
                "order_id" => $order_id,
                "signature" => $razorpay_signature,
                "user_id" => $user_id
            ];
        $order_request_json = json_encode($verify_request);

        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');
        $curl_url = $api_URL . 'api/payment/verify-payment';


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
        $response_json = curl_exec($curl);

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode == 200 || $httpcode == 201) {
            $aResponse = json_decode($response_json);
            $success_status = isset($aResponse->success) ? $aResponse->success : '';
        } else {
            $aResponse = json_decode($response_json);
            $success_status = isset($aResponse->success) ? $aResponse->success : '';
        }

        if ($success_status == true) {
            Session::put('success', 'Payment successful.');
            return redirect()->route('dashboard');
        } else {
            Session::put('error', 'Payment failed.');
            return redirect()->route('subscriptions');
        }
    }



    public function store_old(Request $request)
    {
        $input = $request->all();
        $exam_id = $input['exam_id'];


        $user_id = Auth::user()->id;

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



        Session::put('success', 'Payment successful');
        return redirect()->route('dashboard');
    }
}
