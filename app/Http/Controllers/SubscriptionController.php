<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\StudentPreference;
use App\Models\StudentUsers;

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
        return view('subscriptions');
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
}
