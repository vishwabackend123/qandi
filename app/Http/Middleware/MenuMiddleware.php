<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Http\Traits\CommonTrait;


class MenuMiddleware
{
    //
    use CommonTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_Data = Auth::user();

        Session::put('user_data', $user_Data);
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $api_URL = env('API_URL');

        $preferences = $this->redis_Preference();

        $subjects_rating = (isset($preferences->subjects_rating) && !empty($preferences->subjects_rating)) ? $preferences->subjects_rating : '';
        $student_stage_at_sgnup = (isset($preferences->student_stage_at_sgnup) && !empty($preferences->student_stage_at_sgnup)) ? $preferences->student_stage_at_sgnup : '';


        if ($student_stage_at_sgnup == 1) {
            $user_stage = 'Beginner (10th)';
        } elseif ($student_stage_at_sgnup == 2) {
            $user_stage = '11th';
        } elseif ($student_stage_at_sgnup == 3) {
            $user_stage = '12th';
        } else {
            $user_stage = '';
        }
        $exam_data = $this->user_exam();


        $subscriptionData = $this->subscribedPackage();


        $user_subjects = $this->redis_subjects();

        $leaderboard_list = $this->leaderBoard();

        if ($userData->user_profile_img) {
            $imgPath = $userData->user_profile_img;
        } else {
            $imgPath =  url('/') . '/public/after_login/images/profile.png';
        }

        $current_week_plan = $this->current_week_plan();

        $curl = curl_init();
        $curl_url = $api_URL . 'api/notification-history/' . $user_id;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $aResponse = json_decode($response);
        if (isset($aResponse->success) && $aResponse->success == true) {
            $notifications = $aResponse->response;
        } else {
            $notifications = [];
        }

        $today_date = Carbon::now();

        $expiry_date = (isset($preferences->subscription_expiry_date) && !empty($preferences->subscription_expiry_date)) ? $preferences->subscription_expiry_date : '';

        $data_difference = $today_date->diffInDays($expiry_date, false);

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



        \Illuminate\Support\Facades\View::share('aSubjects', $user_subjects);
        \Illuminate\Support\Facades\View::share('subjects_rating', $subjects_rating);
        \Illuminate\Support\Facades\View::share('user_stage', $user_stage);
        \Illuminate\Support\Facades\View::share('preferences_data', $preferences);
        \Illuminate\Support\Facades\View::share('exam_data', $exam_data);
        \Illuminate\Support\Facades\View::share('subscription_details', $subscriptionData);
        \Illuminate\Support\Facades\View::share('suscription_status', $suscription_status);
        \Illuminate\Support\Facades\View::share('leaderboard_list', $leaderboard_list);
        \Illuminate\Support\Facades\View::share('imgPath', $imgPath);
        \Illuminate\Support\Facades\View::share('current_week_plan', $current_week_plan);
        \Illuminate\Support\Facades\View::share('notifications', $notifications);

        return $next($request);
    }
}
