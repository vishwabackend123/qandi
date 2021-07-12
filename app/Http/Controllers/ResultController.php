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


class ResultController extends Controller
{
    //
    public function exam_result(Request $request)
    {

        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $exam_full_time = isset($request->fulltime) ? $request->fulltime : '';
        $submit_time = isset($request->submit_time) ? $request->submit_time : '';

        $redis_json = Redis::get('custom_answer_time');

        $redisArray = (isset($redis_json) && !empty($redis_json)) ? json_decode($redis_json) : [];



        $given_ans = $answerList = $answersArr = [];
        $given_ans = isset($redisArray->given_ans) ? $redisArray->given_ans : [];
        $taken_time = isset($redisArray->taken_time) ? $redisArray->taken_time : [];
        $answer_swap_cnt = isset($redisArray->answer_swap_cnt) ? $redisArray->answer_swap_cnt : [];
        $questions_count = isset($redisArray->questions_count) ? $redisArray->questions_count : 0;
        $questions_list = isset($redisArray->all_questions_id) ? $redisArray->all_questions_id : [];



        if (isset($given_ans) && !empty($given_ans)) {
            foreach ($given_ans as $key => $ans) {
                $answerList['answer'] = (int)$ans[0];
                $answerList['timetaken'] = isset($taken_time->$key) ? (string)$taken_time->$key : '';
                $answerList['attemptCount'] = isset($answer_swap_cnt->$key) ? (int)$answer_swap_cnt->$key : '';
                $answerList['question_id'] = (int)$key;

                $answersArr[] = $answerList;
            }
        }

        $inputjson = [];
        $inputjson['answerList'] = $answersArr;
        $inputjson['test_time'] = (string)$exam_full_time;
        $inputjson['total_marks'] = 30;
        $inputjson['user_id'] = $user_id;
        $inputjson['no_of_question'] = $questions_count;
        $inputjson['questions_list'] = $questions_list;
        $inputjson['time_taken'] = (string)$submit_time;
        $inputjson['class_id'] = $exam_id;

        $request = json_encode($inputjson);


        $curl_url = "";
        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/save-result';

        curl_setopt_array($curl, array(

            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 120,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response_json = curl_exec($curl);


        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode == 200 || $httpcode == 201) {
            $response = json_decode($response_json);

            /* $response = isset($responsedata->response) ? $responsedata->response : []; */

            return view('afterlogin.ExamCustom.exam_result', compact('response'));
        } else {
            $aQuestions_list = [];
            $questions_count = 0;
            $exam_fulltime = 0;
            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }
    }
}
