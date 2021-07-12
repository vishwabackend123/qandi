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
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;


        $cacheKey = 'user_exam:' . $user_id;
        if ($data = Redis::get($cacheKey)) {
            $exam_data = json_decode($data);
            return $exam_data;
        }
        $api_URL = Config::get('constants.API_NEW_URL');
        $curl_url = $api_URL . 'api/get-all-exams/';


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

            $exam_data = $exam_list->where('id', $exam_id)->all();
            $exam_details = $exam_data[0];
            Redis::set($cacheKey, json_encode($exam_details));
        } else {
            $exam_details = [];
        }
        return $exam_details;
    }

    public function redis_subjects()
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $cacheKey = 'exam_subjects:' . $exam_id;
        if ($data = Redis::get($cacheKey)) {
            $subject_list = json_decode($data);
            return $subject_list;
        }
        $api_url = Config::get('constants.API_8080_URL') . 'api/getSubject/' . $exam_id;

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
        if ($httpcode == 200) {
            $responsedata = json_decode($response_json);

            $subject_list = $responsedata->response;
            Redis::set($cacheKey, json_encode($subject_list));
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

                    Redis::del($cacheKey);
                }
            }
            if ($data = Redis::get($cacheKey)) {
                return json_decode($data);
            }
            $data = collect($question_data);
            Redis::set($cacheKey, $data);
            return $data->all();
        }
        return [];
    }
}
