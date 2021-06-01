<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class ExamCustomController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $cacheKey = 'exam_subjects:' . $exam_id;
        if ($data = Redis::get($cacheKey)) {
            $subject_list = json_decode($data);
        }

        $api_url = Config::get('constants.API_8080_URL') . 'api/get_subjects/' . $exam_id;

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
            $subject_list = $responsedata->subject;
        } else {
            $subject_list = [];
        }

        Redis::set($cacheKey, json_encode($subject_list));

        /* $active_subject = !empty($subject_list) ? head($subject_list) : [];
        $active_subject_id = isset($active_subject->sub_id) ? $active_subject->sub_id : '';
 */
        $subject_topic_list = [];
        if (!empty($subject_list)) {
            foreach ($subject_list as $row) {
                $subject_id = $row->id;
                $aSubject_topics = $this->get_subject_topics($subject_id);

                $subject_topic_list[$subject_id] = !empty($aSubject_topics) ? $aSubject_topics : [];
            }
        }

        //dd($subject_topic_list);
        return view('afterlogin.ExamCustom.exam_custom', compact('subject_list', 'subject_topic_list'));
    }

    public function get_subject_topics($active_subject_id)
    {
        $cacheKey = 'exam_subjects_topics:' . $active_subject_id;
        if ($data = Redis::get($cacheKey)) {
            $topic_list = json_decode($data);
            return $topic_list;
        }

        $api_url = Config::get('constants.API_8080_URL') . 'api/get_topics/' . $active_subject_id;

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

            $topic_list = $responsedata->response;
        } else {
            $topic_list = [];
        }

        Redis::set($cacheKey, json_encode($topic_list));
        return $topic_list;
    }


    public function subject_exam(Request $request)
    {
        return view('afterlogin.ExamCustom.exam');
    }
}
