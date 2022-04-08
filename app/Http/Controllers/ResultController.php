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
use Illuminate\Support\Facades\Log;
use App\Http\Traits\CommonTrait;


class ResultController extends Controller
{
     use CommonTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function exam_result(Request $request)
    {

        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $exam_full_time = isset($request->fulltime) ? $request->fulltime : '';
            $submit_time = isset($request->submit_time) ? (string)gmdate('H:i:s', $request->submit_time) : '00:00:00';
            //$submit_time = isset($request->submit_time) ? $request->submit_time : '00:00:00';
            $exam_type = isset($request->exam_type) ? $request->exam_type : '';
            $test_type = isset($request->test_type) ? $request->test_type : '';
            $exam_mode = isset($request->exam_mode) ? $request->exam_mode : 'Practice';
            $planner_id = isset($request->planner_id) ? $request->planner_id : 0;
            $live_exam_id = isset($request->live_exam_id) ? $request->live_exam_id : 0;
            $test_series_id = isset($request->series_id) ? $request->series_id : 0;

            $redis_json = Redis::get('custom_answer_time_' . $user_id);

            $redisArray = (isset($redis_json) && !empty($redis_json)) ? json_decode($redis_json) : [];


            $given_ans = $answerList = $answersArr = [];
            $given_ans = isset($redisArray->given_ans) ? $redisArray->given_ans : [];
            $taken_time = isset($redisArray->taken_time) ? $redisArray->taken_time : [];
            $answer_swap_cnt = isset($redisArray->answer_swap_cnt) ? $redisArray->answer_swap_cnt : [];
            $questions_count = isset($redisArray->questions_count) ? $redisArray->questions_count : 0;
            $questions_list = isset($redisArray->all_questions_id) ? $redisArray->all_questions_id : [];



            if (isset($given_ans) && !empty($given_ans)) {
                foreach ($given_ans as $key => $ans) {

                    // $answerList['answer'] = (int)$ans[0];
                    $answerList['answer'] = $ans;
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
            $inputjson['user_id'] = (string)$user_id;
            $inputjson['no_of_question'] = $questions_count;
            $inputjson['questions_list'] = $questions_list;
            $inputjson['time_taken'] = (string)$submit_time;
            $inputjson['class_id'] = $exam_id;
            $inputjson['test_type'] = ucfirst($test_type);
            $inputjson['exam_mode'] = ucfirst($exam_mode);
            $inputjson['exam_type'] = $exam_type;
            $inputjson['planner_id'] = $planner_id;
            $inputjson['live_exam_id'] = $live_exam_id;
            $inputjson['test_series_id'] = $test_series_id;

            $request = json_encode($inputjson);


            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

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

            if ($test_type == 'Live') {
                return view('afterlogin.LiveExam.live_result');
            }

            $response_data = (json_decode($response_json));
            $check_response = isset($response_data->success) ? $response_data->success : false;

            if ($check_response == true) {


                return view('afterlogin.ExamCustom.exam_result_analytics');
            } else {
                return redirect()->route('dashboard');
                /* return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']); */
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }


    public function exam_post_analysis_score(Request $request)
    {

        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

            /* $curl_url = $api_URL . 'api/post-exam-analytics/' . $user_id . '/' . $exam_id;
     */
            $curl_url = $api_URL . 'api/mini-post-exam-analytics1/' . $user_id . '/' . $exam_id;

            curl_setopt_array($curl, array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 120,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
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
                $response_data = (json_decode($response_json));
                $response = isset($response_data->response) ? $response_data->response : [];


                return view('afterlogin.ExamCustom.exam_result1', compact('response'));
            } else {

                return false;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }


    public function exam_post_analysis_attempt(Request $request)
    {

        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');


            $curl_url = $api_URL . 'api/mini-post-exam-analytics2/' . $user_id . '/' . $exam_id;

            curl_setopt_array($curl, array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 120,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
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
                $response_data = (json_decode($response_json));
                $response = isset($response_data->response) ? $response_data->response : [];


                return view('afterlogin.ExamCustom.exam_result2', compact('response'));
            } else {

                return false;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }


    public function exam_post_analysis_rank(Request $request)
    {

        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');


            $curl_url = $api_URL . 'api/mini-post-exam-analytics3/' . $user_id . '/' . $exam_id;

            curl_setopt_array($curl, array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 120,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
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
                $response_data = (json_decode($response_json));
                $response = isset($response_data->response) ? $response_data->response : [];


                return view('afterlogin.ExamCustom.exam_result3', compact('response'));
            } else {

                return false;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    public function examResultList($exam_type)
    {
        try {

            $result_data = [];

            $redis_subjects = $this->redis_subjects();
            $cSubjects = collect($redis_subjects);
            $result_data = $this->getAllResult($exam_type);
            foreach($result_data as $key => $value)
            {
                $id=explode(',', $value->subject_id_list);
                $filtered_subject = $cSubjects->whereIn('id', $id)->all();
                $result_data[$key]->subject_name = implode(',', array_column($filtered_subject, 'subject_name'));
            }
            return view('afterlogin.ExamViews.mock_result_list', compact('result_data'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    public function getAllResult($exam_type)
    {
        $limit = 10;
        $offset = 0;
        $userData = Session::get('user_data');
        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $curl_url = "";
        $curl = curl_init();
        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/student-result-list/' . $user_id . '/?pagination_start=' . $offset . '&limit=' . $limit . '&test_type=' . $exam_type;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 120,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
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
            $response_data = (json_decode($response_json));
            $result_data = isset($response_data->response) ? $response_data->response : [];  
            return $result_data;         
        } else {

            return false;
        }
    }
    
}
