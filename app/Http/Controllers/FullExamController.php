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

class FullExamController extends Controller
{
    //

    public function exam(Request $request, $exam_name)
    {

        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;
        if ($exam_name == 'full_exam') {
            $exam_name = 'Full Exam';
        } else {
            $exam_name = 'Mock Test';
        }

        $exam_fulltime = 5400;
        $exam_ques_count = 90;

        $inputjson['exam_id'] = $exam_id;
        $inputjson['count'] = 90;

        $request = json_encode($inputjson);

        $curl_url = "";
        $curl = curl_init();
        $api_URL = Config::get('constants.API_8080_URL');

        $curl_url = $api_URL . 'api/profiling_input';



        curl_setopt_array($curl, array(
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
            $responsedata = json_decode($response_json);
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
        $exam_fulltime = $questions_count  * 60;



        $collection = collect($aQuestions_list);
        $grouped = $collection->groupBy('subject_id');
        $plucked = $collection->pluck('subject_id');
        /* dd("hi", $plucked, $grouped); */
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


        return view('afterlogin.ExamViews.exam', compact('question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'exam_ques_count', 'exam_name'));



        //return view('afterlogin.ExamViews.exam', compact('exam_name', 'exam_fulltime', 'exam_ques_count'));
    }

    function exam_result()
    {

        return view('afterlogin.ExamViews.resultview');
    }

    function exam_review()
    {
        return view('afterlogin.ExamViews.review');
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
}
