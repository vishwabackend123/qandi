<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

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

        $api_url = Config::get('constants.API_php_URL') . 'api/get_topics/' . $active_subject_id;

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
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;


        $question_count = isset($request->question_count) ? $request->question_count : 30;
        $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
        $subject_ids = [];
        array_push($subject_ids, $subject_id);
        $aQuestionFrom = [];
        $aQCategory = [];
        $select_modules = [];
        $difficulty = 0;

        $inputjson['test_type'] = 'sample';
        $inputjson['student_id'] = $user_id; //30776; //(string);
        $inputjson['exam_id'] = (string)$exam_id;
        $inputjson['question_cnt'] = $question_count;
        $inputjson['difficulty_level'] = $difficulty;
        $inputjson['question_from'] = json_encode($aQuestionFrom);
        $inputjson['question_category'] = json_encode($aQCategory);
        $inputjson['subject_list'] = json_encode($subject_ids);
        $inputjson['topic_list'] = json_encode($select_modules);

        $request = json_encode($inputjson);

        $curl_url = "";
        $curl = curl_init();
        //$api_URL = Config::get('constants.API_8080_URL');
        $api_URL = Config::get('constants.API_php_URL');

        /* $curl_url = $api_URL . 'AdvanceQuestionSelection'; */
        $curl_url = $api_URL . 'AdvanceQuestionSelectiontest';

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "8080",
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",

            ),
        ));
        $response_json = curl_exec($curl);
        $response_json = str_replace('NaN', '""', $response_json);


        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpcode == 200) {
            $responsedata = json_decode($response_json);
            $aQuestions_list = $responsedata->questions;
        } else {
            $aQuestions_list = [];
            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }

        $redis_set = 'True';
        $allQuestionDetails = $this->allCustomQlist($user_id, $aQuestions_list, $redis_set);

        $collection = collect($aQuestions_list);
        $allQuestions = $collection->keyBy('question_id');
        $keys = $allQuestions->keys('question_id')->all();

        $question_data = current($aQuestions_list);
        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
        $nextquestion_data = next($aQuestions_list);
        $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
        $prev_qid = '';



        return view('afterlogin.ExamCustom.exam', compact('question_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid'));
    }


    public function allCustomQlist($user_id, $question_data, $redis_set)
    {
        if (!empty($user_id) &&  !empty($question_data)) {
            $cacheKey = 'CustomQuestion:all:' . $user_id;
            if (Redis::exists($cacheKey)) {
                if ($redis_set == 'True') {
                    Redis::del(Redis::keys($cacheKey));
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
