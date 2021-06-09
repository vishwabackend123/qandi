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


use Carbon\Carbon;

class SubscriptionController extends Controller
{
    //
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
        $subscriptions = DB::table('class_exams as ce')
            ->select('ce.id as exam_id', 'ce.class_exam_cd as exam_name', 'ce.class_exam_desc as exam_description')
            ->leftJoin('exam_subscription_price as esp', 'esp.exam_id', '=', 'ce.id')
            ->addSelect('esp.day_unit', 'esp.day_month_count', 'esp.exam_price')
            ->where('ce.status', '1')
            ->get();


        return view('subscriptions', compact('subscriptions'));
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

        $subscriptions_data = DB::table('class_exams as ce')
            ->select('ce.id as exam_id', 'ce.class_exam_cd as exam_name', 'ce.class_exam_desc as exam_description')
            ->leftJoin('exam_subscription_price as esp', 'esp.exam_id', '=', 'ce.id')
            ->addSelect('esp.day_unit', 'esp.day_month_count', 'esp.exam_price')
            ->where('ce.status', '1')
            ->where('ce.id', $request->exam_id)
            ->first();




        return view('subscription_checkout', compact('subscriptions_data', 'razorpayOrderId'));
    }
}
