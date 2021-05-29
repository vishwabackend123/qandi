<?php

namespace App\Http\Controllers;

use App\Models\StudentUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserAnalytics;
use App\Models\StudentPreference;


use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user_data = Auth::user();
        $user_id = Auth::user()->id;

        $preferences = DB::table('student_preferences')->select('student_stage_at_sgnup', 'subjects_rating', 'subscription_yn', 'subscription_expiry_date')->where('student_id', $user_id)->first();

        $student_stage_at_sgnup = (isset($preferences->student_stage_at_sgnup) && !empty($preferences->student_stage_at_sgnup)) ? $preferences->student_stage_at_sgnup : 0;

        if ($student_stage_at_sgnup == 0) {
            return redirect()->route('studentstandfor');
        }

        $subscription_yn = (isset($preferences->subscription_yn) && !empty($preferences->subscription_yn)) ? $preferences->subscription_yn : '';

        $subscription_expiry_date = (isset($preferences->subscription_expiry_date) && !empty($preferences->subscription_expiry_date)) ? $preferences->subscription_expiry_date : '';

        if (!empty($subscription_expiry_date) && ($subscription_expiry_date > date('Y-m-d')) && $subscription_yn == 'Y') {
            $suscription_status = 1;
        } else {
            $suscription_status = 0;
        }


        if ($suscription_status == 0) {
            return redirect()->route('subscriptions');
        }
        return view('afterlogin.dashboard');
    }

    public function student_stand(Request $request)
    {
        return view('signup_poststatus');
    }

    public function store_stand_value(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;

        $stand_value = $request->input('user_stand_value');

        if ($stand_value) {

            $user_stand = DB::table('student_preferences')->where('student_id', $user_id)->update(['student_stage_at_sgnup' => $stand_value]);

            if ($user_stand) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function dailyWelcomeUpdates(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;

        $storeddata = $request->input('storeddata');

        if (isset($storeddata['today_feeling']) && !empty($storeddata['today_feeling'])) {
            $mood = $storeddata['today_feeling'];
            $insert = [
                'user_id' => $user_id,
                'user_mood_ind' => (int)$mood,
                'login_date' => date('Y-m-d'),
                'time_start' => date('h:i:s'),
                'time_end' => '',
                'traffic_source' => 'web',
                'pages_visted' => ''
            ];
            $crt = UserAnalytics::create($insert);
        }
        if (isset($storeddata['subjects_rating']) && !empty($storeddata['subjects_rating'])) {
            $rating = json_encode($storeddata['subjects_rating']);
            $update = [
                'subjects_rating' => $rating,
            ];
            $upt = StudentPreference::where('student_id', $user_id)->update($update);
        }

        return true;
    }
}
