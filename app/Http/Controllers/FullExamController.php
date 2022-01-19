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

use App\Http\Traits\CommonTrait;


class FullExamController extends Controller
{
    //
    use CommonTrait;

    public function exam(Request $request, $exam_name)
    {

        $filtered_subject = [];
        $userData = Session::get('user_data');
        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        if (Redis::exists('custom_answer_time_' . $user_id)) {
            Redis::del(Redis::keys('custom_answer_time_' . $user_id));
        }

        if ($exam_name == 'full_exam') {
            $exam_name = 'Full Exam';
        } else {
            $exam_name = 'Mock Test';
        }
        $exam_mode = 'Practice';

        // $exam_fulltime = 5400;
        $exam_ques_count = 90;

        $inputjson['exam_id'] = $exam_id;
        $inputjson['count'] = 90;

        $request = json_encode($inputjson);

        $curl_url = "";
        $curl = curl_init();
        $api_URL = env('API_URL');

        $curl_url = $api_URL . 'api/profiling-test-web/' . $exam_id;

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
        $response_json = str_replace('NaN', '""', $response_json);

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode == 200) {
            $responsedata = json_decode($response_json);

            $aQuestions_list = $responsedata->questions_list;

            //$exam_fulltime = $responsedata->time_allowed;
            $exam_fulltime = 180;
            $questions_count = count($aQuestions_list);
            //$exam_fulltime = $questions_count;
        } else {
            $aQuestions_list = [];
            $questions_count = 0;
            $exam_fulltime = 0;
            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }

        $redis_set = 'True';

        //$exam_fulltime = (isset($exam_fulltime) && !empty($exam_fulltime)) ? $exam_fulltime : $questions_count  * 60;

        $collection = collect($aQuestions_list);

        $aQuestionslist = $collection->sortBy('subject_id');

        $subject_ids = $collection->pluck('subject_id');
        $subject_list = $subject_ids->unique()->values()->all();

        $redis_subjects = $this->redis_subjects();
        $cSubjects = collect($redis_subjects);
        $aTargets = [];
        $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
        foreach ($filtered_subject as $sub) {
            $count_arr = $collection->where('subject_id', $sub->id)->all();
            $sub->count = count($count_arr);
            $aTargets[] = $sub->subject_name;
        }

        $allQuestions = $aQuestionslist->countBy('question_id');
        $allQuestions = $aQuestionslist->keyBy('question_id');
        $aQuestions_list = $aQuestionslist->values()->all();

        $allQuestionDetails = $this->allCustomQlist($user_id, $allQuestions->all(), $redis_set);
        $keys = $allQuestions->keys('question_id')->all();


        $question_data = current($aQuestions_list);
        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
        $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
        $nextquestion_data = next($aQuestions_list);
        $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
        $prev_qid = '';

        if (isset($question_data) && !empty($question_data)) {
            //$publicPath = url('/') . '/public/images/questions/';
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
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
            //$optionArray = $this->shuffle_assoc($opArr);
            $optionArray = $opArr;
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }



        /* set redis for save exam question response */
        $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = [];
        $redis_data = [
            'given_ans' => $retrive_array,
            'taken_time' => $retrive_time_array,
            'taken_time_sec' => $retrive_time_sec,
            'answer_swap_cnt' => $answer_swap_cnt,
            'questions_count' => $questions_count,
            'all_questions_id' => $keys,
            'full_time' => $exam_fulltime,
        ];

        // Push Value in Redis
        Redis::set('custom_answer_time_' . $user_id, json_encode($redis_data));

        $tagrets = implode(', ', $aTargets);

        $test_type = 'Profiling';
        $exam_type = 'P';
        $series_id = "";
        return view('afterlogin.ExamViews.exam', compact('filtered_subject', 'tagrets', 'question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'exam_ques_count', 'exam_name', 'activesub_id', 'test_type', 'exam_type', 'exam_mode', 'series_id'));



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


    public function next_question($quest_id, Request $request)
    {

        $userData = Session::get('user_data');
        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

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
        $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
        $key = array_search($quest_id, array_column($allQuestionsArr, 'question_id'));

        $qNo = $key + 1;
        $nextKey = $key + 1;

        $nextKey = (count($allQuestionsArr) > 0) ? $nextKey % count($allQuestionsArr) : $nextKey;

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
            /*  $publicPath = url('/') . '/public/images/questions/'; */
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
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
            //$optionArray = $this->shuffle_assoc($opArr);
            $optionArray = $opArr;
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }
        $session_result = Redis::get('custom_answer_time_' . $user_id);
        $sessionResult = json_decode($session_result);

        $aGivenAns = (isset($sessionResult->given_ans->$quest_id) && !empty($sessionResult->given_ans->$quest_id)) ? $sessionResult->given_ans->$quest_id : [];
        $aquestionTakenTime = isset($sessionResult->taken_time_sec->$quest_id) ? $sessionResult->taken_time_sec->$quest_id : 0;

        return view('afterlogin.ExamViews.next_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
    }

    public function next_subject_question($subject_id, Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $cacheKey = 'CustomQuestion:all:' . $user_id;
        $redis_result = Redis::get($cacheKey);

        if (isset($redis_result) && !empty($redis_result)) :
            $response = json_decode($redis_result);
        endif;

        $allQuestions = isset($response) ? $response : []; // redis response as object
        $collection = collect($allQuestions);
        $filtered = $collection->where('subject_id', $subject_id);
        $filtered_questions = $filtered->values()->all();

        $allQuestionsArr = (array)$allQuestions; //object convert to array

        $allkeys = array_keys((array)$allQuestions); //Array of all keys

        //$question_data = isset($allQuestions->$quest_id) ? $allQuestions->$quest_id : []; // required question all data
        $question_data = current($filtered_questions);
        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : ''; //ccurrent question id

        $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';


        $key = array_search($activeq_id, array_column($allQuestionsArr, 'question_id'));

        $qNo = $key + 1;
        $nextKey = $key + 1;
        $nextKey = (count($allQuestionsArr) > 0) ? $nextKey % count($allQuestionsArr) : $nextKey;
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
            //$publicPath = url('/') . '/public/images/questions/';
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
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
            //$optionArray = $this->shuffle_assoc($opArr);
            $optionArray = $opArr;
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }

        $session_result = Redis::get('custom_answer_time_' . $user_id);
        $sessionResult = json_decode($session_result);

        $aGivenAns = (isset($sessionResult->given_ans->$activeq_id) && !empty($sessionResult->given_ans->$activeq_id)) ? $sessionResult->given_ans->$activeq_id : [];
        $aquestionTakenTime = isset($sessionResult->taken_time_sec->$activeq_id) ? $sessionResult->taken_time_sec->$activeq_id : 0;

        return view('afterlogin.ExamViews.next_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
    }
}
