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

class RazorpayController extends Controller
{
    //
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
