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
use Illuminate\Support\Facades\Route;

use App\Http\Traits\CommonTrait;
use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;



class MenuMiddleware
{
    private static $checkRouteName = [
        'profile',
        'planner',

    ];
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
        if (Auth::check()) {
            $user_Data = Auth::user();

            if (!Session::has('user_data')) {
                //Session::put('user_data', $user_Data);
            }
            Session::put('user_data', $user_Data);
            $userData = Session::get('user_data');



            $user_id = $userData->id;
            $api_URL = env('API_URL');

            $preferences = $this->redis_Preference();

            $prof_asst_test = (isset($preferences->prof_asst_test) && !empty($preferences->prof_asst_test)) ? $preferences->prof_asst_test : '';
            if ($prof_asst_test == "Y") {
                Session::put('full_body_attempt', $prof_asst_test);
            }


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
            $subscription_packages = $this->subscription_packages();
            $latest_pack = isset($subscription_packages->purchased_packages[0]) ? $subscription_packages->purchased_packages[0] : [];
            $subscription_type = (isset($latest_pack) && !empty($latest_pack)) ? $latest_pack->subscription_t : '';

            $user_subjects = $this->redis_subjects();

            $leaderboard_list = $this->leaderBoard();
            $current_subscription = [];
            if (isset($subscription_packages->all_packages) && !empty($subscription_packages->all_packages)) {
                foreach ($subscription_packages->all_packages as $key => $value) {
                    if ((isset($latest_pack->subscription_id) && !empty($latest_pack->subscription_id)) && $latest_pack->subscription_id == $value->subscript_id) {
                        $current_subscription = $value;
                    }
                }
            }

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
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
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

            $subscription_yn = (isset($preferences->subscription_yn) && !empty($preferences->subscription_yn)) ? $preferences->subscription_yn : '';
            //if (in_array(Route::getCurrentRoute()->getName(),self::$checkRouteName)) {
            if (Route::getCurrentRoute()->getName() != 'subscriptions') {
                if (($suscription_status == 0 && $subscription_yn == 'N') || empty($expiry_date)) {
                    if (!Session::has('subscription_status')) {
                        return redirect()->route('subscriptions');
                    }
                }
            }

            $client = new SecretsManagerClient([
                'version' => '2017-10-17',
                'region' => 'ap-south-1'
            ]);

            $secretName = env('SECRET_DB');

            $result = $client->getSecretValue([
                'SecretId' => $secretName,
            ]);
            if (isset($result['SecretString']) && !empty($result['SecretString'])) {
                $db_data = json_decode($result['SecretString'], true);
            };

            $studentCecretName = env('SECRET_REDIS');
            $resultStudent = $client->getSecretValue([
                'SecretId' => $studentCecretName,
            ]);
            if (isset($resultStudent['SecretString']) && !empty($resultStudent['SecretString'])) {
                $redis_data = json_decode($resultStudent['SecretString'], true);
            };


            /* check user status new or old */

            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url_check = $api_URL . 'api/check-if-fresh-user/' . $user_id;
            $curl_option = array(
                CURLOPT_URL => $curl_url_check,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $statusCheck_json = curl_exec($curl);
            $statusCheck = json_decode($statusCheck_json);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);


            $userStatus = isset($statusCheck->fresh_user) ? $statusCheck->fresh_user : false;
            /* check user status new or old */



            \Illuminate\Support\Facades\View::share('aSubjects', $user_subjects);
            \Illuminate\Support\Facades\View::share('subjects_rating', $subjects_rating);
            \Illuminate\Support\Facades\View::share('user_stage', $user_stage);
            \Illuminate\Support\Facades\View::share('preferences_data', $preferences);
            \Illuminate\Support\Facades\View::share('exam_data', $exam_data);
            \Illuminate\Support\Facades\View::share('subscription_details', $subscriptionData);
            \Illuminate\Support\Facades\View::share('suscription_status', $suscription_status);
            \Illuminate\Support\Facades\View::share('subscription_type', $subscription_type);
            \Illuminate\Support\Facades\View::share('leaderboard_list', $leaderboard_list);
            \Illuminate\Support\Facades\View::share('imgPath', $imgPath);
            \Illuminate\Support\Facades\View::share('current_week_plan', $current_week_plan);
            \Illuminate\Support\Facades\View::share('notifications', $notifications);
            \Illuminate\Support\Facades\View::share('current_subscription', $current_subscription);
            \Illuminate\Support\Facades\View::share('student_stage_at_sgnup', $student_stage_at_sgnup);
            \Illuminate\Support\Facades\View::share('secretKeysRedis', $redis_data);
            \Illuminate\Support\Facades\View::share('secretKeysDB', $db_data);
            \Illuminate\Support\Facades\View::share('userStatus', $userStatus);


            return $next($request);
        } else {
            return $next($request);
        }
    }
}
