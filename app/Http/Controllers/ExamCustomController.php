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
                $topTen = array_slice($aSubject_topics, 0, 10);

                $subject_topic_list[$subject_id] = !empty($topTen) ? $topTen : [];
            }
        }

        return view('afterlogin.ExamCustom.exam_custom', compact('subject_list', 'subject_topic_list'));
    }

    public function get_subject_topics($active_subject_id)
    {
        $cacheKey = 'exam_subjects_topics:' . $active_subject_id;
        if ($data = Redis::get($cacheKey)) {
            $topic_list = json_decode($data);
            return $topic_list;
        }

        $api_url = Config::get('constants.API_php_URL') . 'api/getTopics/' . $active_subject_id;

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

        if (Redis::exists('custom_answer_time')) {
            Redis::del(Redis::keys('custom_answer_time'));
        }

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
        $api_URL = Config::get('constants.API_8080_URL');
        //$api_URL = Config::get('constants.API_php_URL');

        /* $curl_url = $api_URL . 'AdvanceQuestionSelection'; */
        $curl_url = $api_URL . 'api/AdvanceQuestionSelectiontest';

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
        curl_close($curl);

        if ($httpcode == 200) {
            $responsedata = json_decode(json_decode($response_json));
            $aQuestions_list = $responsedata->questions;
            $exam_fulltime = $responsedata->time_allowed;
            $questions_count = count($aQuestions_list);
        } else {
            $aQuestions_list = [];
            $questions_count = 0;
            $exam_fulltime = 0;
            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }

        $redis_set = 'True';


        $collection = collect($aQuestions_list);
        $grouped = $collection->groupBy('subject_id');
        //dd("hi", $grouped);
        $allQuestions = $collection->keyBy('question_id');
        $allQuestionDetails = $this->allCustomQlist($user_id, $allQuestions->all(), $redis_set);
        $keys = $allQuestions->keys('question_id')->all();

        $question_data = current($aQuestions_list);
        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
        $nextquestion_data = next($aQuestions_list);
        $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
        $prev_qid = '';

        if (isset($question_data) && !empty($question_data)) {
            $publicPath = url('/') . '/public/images/questions/';
            $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
            $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
            $qs_id = $question_data->question_id;
            $option_ques = str_replace("'", '"', $question_data->question_options);

            $tempdata = json_decode($option_ques, true);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {
                    $option = str_replace('/public/images/questions/', $publicPath, $option);
                    $opArr[$key] = $option;
                }
            }
            $optionArray = $this->shuffle_assoc($opArr);
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }


        //dd($question_data, $option_data);

        /* set redis for save exam question response */
        $retrive_array = $retrive_time_array = $answer_swap_cnt = [];
        $redis_data = [
            'given_ans' => $retrive_array,
            'taken_time' => $retrive_time_array,
            'answer_swap_cnt' => $answer_swap_cnt,
            'questions_count' => $questions_count,
            'all_questions_id' => $keys,
            'full_time' => $exam_fulltime,
        ];

        // Push Value in Redis
        Redis::set('custom_answer_time', json_encode($redis_data));


        return view('afterlogin.ExamCustom.exam', compact('question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime'));
    }

    function shuffle_assoc($list)
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


    public function ajax_next_question($quest_id, Request $request)
    {

        $user_id = Auth::user()->id;
        $cacheKey = 'CustomQuestion:all:' . $user_id;
        $redis_result = Redis::get($cacheKey);

        if (isset($redis_result) && !empty($redis_result)) :
            $response = json_decode($redis_result);
        endif;

        $allQuestions = isset($response) ? $response : []; // redis response as object
        $allQuestionsArr = (array)$allQuestions; //object convert to array

        $allkeys = array_keys((array)$allQuestions); //Array of all keys

        $question_data = isset($allQuestions->$quest_id) ? $allQuestions->$quest_id : []; // required question all data

        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : ''; //ccurrent question id

        $key = array_search($quest_id, array_column($allQuestionsArr, 'question_id'));

        $qNo = $key + 1;
        $nextKey = $key + 1;
        $nextKey = $nextKey % count($allQuestionsArr);
        if ($key > 0) { // Key would become 0
            $prevKey = $key - 1;
        } else {
            $prevKey = $key;
        }
        $next_qid = '';
        $prev_qid = '';


        $next_qid = $allkeys[$nextKey];

        $prev_qid = $allkeys[$prevKey];
        $last_qid = end($allkeys);



        if (isset($question_data) && !empty($question_data)) {
            $publicPath = url('/') . '/public/images/questions/';
            $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
            $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
            $qs_id = $question_data->question_id;
            $option_ques = str_replace("'", '"', $question_data->question_options);

            $tempdata = json_decode($option_ques, true);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {
                    $option = str_replace('/public/images/questions/', $publicPath, $option);
                    $opArr[$key] = $option;
                }
            }
            $optionArray = $this->shuffle_assoc($opArr);
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }


        return view('afterlogin.ExamCustom.next_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid'));
    }


    public function saveAnswer(Request $request)
    {
        /* # code... */
        $data = $request->all();
        $question_id = isset($data['question_id']) ? $data['question_id'] : '';
        $option_id = isset($data['option_id']) ? $data['option_id'] : '';

        $redis_result = Redis::get('custom_answer_time');


        if (!empty($redis_result)) {
            $redisArray = json_decode($redis_result, true);
            $retrive_array = $redisArray['given_ans'];
            $retrive_time_array = $redisArray['taken_time'];
            $answer_swap_cnt = $redisArray['answer_swap_cnt'] ?? array();

            $time_taken = $redisArray['time_taken'] ?? array();
            if (isset($option_id) && $option_id != '') {
                $retrive_array[$question_id] = $option_id;
                $retrive_time_array[$question_id] = '00:00:00';
            }
        } else {
            $retrive_array = $retrive_time_array = $answer_swap_cnt = [];
            if (isset($option_id) && $option_id != '') {
                $retrive_array[$question_id] = $option_id;
                $retrive_time_array[$question_id] = '00:00:00';
            }
        }
        if (isset($answer_swap_cnt[$question_id])) {
            $answer_swap_cnt[$question_id] = $answer_swap_cnt[$question_id] + 1;
        } else {
            $answer_swap_cnt[$question_id] = 0;
        }

        $redisArray['given_ans'] = $retrive_array;
        $redisArray['taken_time'] = $retrive_time_array;
        $redisArray['answer_swap_cnt'] = $answer_swap_cnt;

        // Push Value in Redis
        Redis::set('custom_answer_time', json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }
}
