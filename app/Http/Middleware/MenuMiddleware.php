<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

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
        $user_data = Auth::user();
        $user_id = Auth::user()->id;
        $api_URL = Config::get('constants.API_NEW_URL');
        /*Preference  data
        */

        $preferences = $this->redis_Preference();

        $subjects_rating = (isset($preferences->subjects_rating) && !empty($preferences->subjects_rating)) ? $preferences->subjects_rating : '';
        $student_stage_at_sgnup = (isset($preferences->student_stage_at_sgnup) && !empty($preferences->student_stage_at_sgnup)) ? $preferences->student_stage_at_sgnup : '';

        if ($student_stage_at_sgnup == 1) {
            $user_stage = 'Begginer (10th)';
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


        \Illuminate\Support\Facades\View::share('aSubjects', $user_subjects);
        \Illuminate\Support\Facades\View::share('subjects_rating', $subjects_rating);
        \Illuminate\Support\Facades\View::share('user_stage', $user_stage);
        \Illuminate\Support\Facades\View::share('preferences_data', $preferences);
        \Illuminate\Support\Facades\View::share('exam_data', $exam_data);
        \Illuminate\Support\Facades\View::share('subscription_details', $subscriptionData);

        return $next($request);
    }
}
