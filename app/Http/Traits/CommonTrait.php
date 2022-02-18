<?php

namespace App\Http\Traits;

use App\Models\StudentUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

trait CommonTrait
{
    public function user_exam()
    {
        $userData = Session::get('user_data');

        $user_id = isset($userData->id) ? $userData->id : 0;
        $exam_id = $userData->grade_id;

        if (!empty($exam_id)) {

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/get-all-exams';

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

            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if ($httpcode == 200 || $httpcode == 201) {
                $responsedata = json_decode($response_json);

                $exam_list = collect($responsedata->response);
                /* gettin user exam data */

                $exam_details = $exam_list->where('id', $exam_id)->first();
            } else {
                $exam_details = [];
            }
            return $exam_details;
        } else {
            return '';
        }
    }

    public function redis_subjects()
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;

        $exam_id = $userData->grade_id;

        /* 
        $cacheKey = 'exam_subjects:' . $exam_id;
        if ($data = Redis::get($cacheKey)) {
            $subject_list = json_decode($data);
            return $subject_list;
        } */
        $api_url = env('API_URL') . 'api/subjects/' . $exam_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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
            $responsedata = json_decode($response_json);

            $subject_list = $responsedata->response;
            /* if (!empty($subject_list)) {
                Redis::set($cacheKey, json_encode($subject_list));
            } */
        } else {
            $subject_list = [];
        }
        return $subject_list;
    }



    public function shuffle_assoc($list)
    {
        if (!is_array($list)) {
            return $list;
        }

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key) {
            $random[$key] = $list[$key];
        }
        return $random;
    }

    public function allCustomQlist($user_id, $question_data, $redis_set)
    {


        if (!empty($user_id) &&  !empty($question_data)) {

            $cacheKey = 'CustomQuestion:all:' . $user_id;
            if (Redis::exists($cacheKey)) {
                if ($redis_set == 'True') {
                    Redis::del(Redis::keys($cacheKey));
                    //Redis::del($cacheKey);
                } else {
                    $data = Redis::get($cacheKey);

                    return json_decode($data);
                }
            }
            $data = collect($question_data);
            Redis::set($cacheKey, $data);
            return $data->all();
        }
        return [];
    }

    public function adaptiveCustomQlist($user_id, $question_data, $redis_set)
    {
        if (!empty($user_id) &&  !empty($question_data)) {
            $cacheKey = 'CustomQuestionAdaptive:all:' . $user_id;
            if (Redis::exists($cacheKey)) {
                if ($redis_set == 'True') {
                    Redis::del(Redis::keys($cacheKey));
                    //Redis::del($cacheKey);
                } else {
                    $data = Redis::get($cacheKey);
                    return json_decode($data);
                }
            }

            $data = collect($question_data);
            Redis::set($cacheKey, $data);
            return $data->all();
        }
        return [];
    }

    public function addAdaptiveQuestion($user_id, $question_data, $redis_set)
    {
        if (!empty($user_id) &&  !empty($question_data)) {
            $cacheKey = 'CustomQuestion:all:' . $user_id;
            if (Redis::exists($cacheKey)) {
                if ($redis_set == 'True') {
                    Redis::del(Redis::keys($cacheKey));
                    //Redis::del($cacheKey);
                } else {
                    $data = Redis::get($cacheKey);
                    return json_decode($data);
                }
            }
            $data = collect($question_data);
            Redis::set($cacheKey, $data);
            return $data->all();
        }
        return [];
    }


    public function subscription_packages()
    {
        $userData = Session::get('user_data');

        $user_id = isset($userData->id) ? $userData->id : 0;
        $grade_id = isset($userData->grade_id) ? $userData->grade_id : 0;

        /* $cacheKey = 'subscription_packages';
        if ($data = Redis::get($cacheKey)) {
            $package_list = json_decode($data);
            return $package_list;
        } */

        $curl = curl_init();
        $api_URL = env('API_URL');
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
        $aResponse = json_decode($response_json);
        $rStatus = isset($aResponse->success) ? $aResponse->success : false;
        curl_close($curl);
        if ($rStatus != false) {

            /* $package_list = isset($aResponse->all_packages) ? $aResponse->all_packages : [];
            $current_pack = isset($aResponse->purchased_packages) ? $aResponse->purchased_packages : [];
            */ /*   Redis::set($cacheKey, json_encode($package_list)); */
            $package_list = $aResponse;
        } else {
            $package_list = [];
        }
        return $package_list;
    }


    public function redis_Preference()
    {
        $userData = Session::get('user_data');

        $user_id = isset($userData->id) ? $userData->id : 0;
        $exam_id =  isset($userData->grade_id) ? $userData->grade_id : 0;

        /*  $cacheKey = 'preferences_data:' . $user_id;
        if ($data = Redis::get($cacheKey)) {
            $preferences = json_decode($data);
            return $preferences;
        } */



        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/preference/' . $user_id;


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

        $response_json = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode == 200 || $httpcode == 201) {
            $aResponse = json_decode($response_json);
            $prefData = isset($aResponse->response) ? json_decode($aResponse->response) : '';
            $preferences = (isset($prefData[0]) && !empty($prefData[0])) ? $prefData[0] : [];

            /*  Redis::set($cacheKey, json_encode($preferences)); */
        } else {
            $preferences = [];
        }
        return $preferences;
    }

    public function subscribedPackage()
    {

        $userData = Session::get('user_data');

        $user_id = isset($userData->id) ? $userData->id : 0;

        $curl = curl_init();

        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/user-subscription/' . $user_id;

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

        $sub_response_json = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);


        if ($httpcode == 200 || $httpcode == 201) {
            $subResponse = json_decode($sub_response_json);
            $subscriptionData = isset($subResponse->response) ? $subResponse->response : '';
            $subscriptionData1 = isset($subscriptionData[1]) ? $subscriptionData[1] : $subscriptionData[0];
            $subscriptionData = isset($subscriptionData[2]) ? $subscriptionData[2] : $subscriptionData1;
        } else {
            $subscriptionData = [];
        }

        return $subscriptionData;
    }

    public function leaderBoard()
    {
        $userData = Session::get('user_data');

        $user_id = isset($userData->id) ? $userData->id : 0;
        $grade_id =  isset($userData->grade_id) ? $userData->grade_id : 0;

        $curl = curl_init();
        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/get-leadershipBoard/' . $user_id . '/' . $grade_id;



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
        $aResponse = json_decode($response_json);
        $status = isset($aResponse->success) ? $aResponse->success : false;
        curl_close($curl);

        if ($status != false) {
            $resp_list = isset($aResponse->response) ? $aResponse->response : [];
            $collection = collect($resp_list);
            $board_list = $collection->sortBy('user_rank')->all();
        } else {
            $resp_list = [];
            $board_list = [];
        }


        return $board_list;
    }


    public function redis_chapter_list($subject_id)
    {
        $userData = Session::get('user_data');
        $user_id = isset($userData->id) ? $userData->id : 0;
        $grade_id =  isset($userData->grade_id) ? $userData->grade_id : 0;


        /*  $cacheKey = 'exam_subjects_chapters:' . $subject_id;
        if ($data = Redis::get($cacheKey)) {
            $chapter_list = json_decode($data);
            return $chapter_list;
        } */

        $api_url = env('API_URL') . 'api/chapters/' . $user_id . '/' . $subject_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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
            $responsedata = json_decode($response_json);

            $chapter_list = $responsedata->response;
            /*  if (!empty($chapter_list)) {
                Redis::set($cacheKey, json_encode($chapter_list));
            } */
        } else {
            $chapter_list = [];
        }


        return $chapter_list;
    }


    public function current_week_plan()
    {
        $userData = Session::get('user_data');
        $user_id = isset($userData->id) ? $userData->id : 0;
        $exam_id = isset($userData->grade_id) ? $userData->grade_id : 0;



        $curl = curl_init();
        $api_URL = env('API_URL');

        $curl_url = $api_URL . 'api/student-planner-current-week/' . $user_id;


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
        $response = json_decode($response_json);
        $response_status = isset($response->success) ? $response->success : false;

        if ($response_status != false) {
            $planner_list = isset($response->result) ? $response->result : [];
            $cPlanner = collect($planner_list);
            $sorted_list = $cPlanner->sortBy('test_completed_yn', SORT_NATURAL);
            $planner = $sorted_list->values()->all();
        } else {
            $planner = [];
        }
        return $planner;
    }
}
