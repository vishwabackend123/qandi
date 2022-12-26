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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Mixpanel;

/**
 * MockExamController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class MockExamController extends Controller
{
    use CommonTrait;
    /**
     * MockExam
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function mockExam(Request $request, $inst = '')
    {
        try {
            $header_title = "Mock Exam";
            $filtered_subject = [];
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $ranSession =  isset($request->ranSession) ? $request->ranSession : mt_rand(10, 1000000);

            if (Redis::exists('custom_answer_time_mock' . $user_id . '_' . $ranSession)) {
                Redis::del(Redis::keys('custom_answer_time_mock' . $user_id . '_' . $ranSession));
            }

            $exam_name = 'Mock Exam';

            $inputjson['student_id'] = $user_id;
            $inputjson['exam_id'] = $exam_id;

            $request = json_encode($inputjson);
            $url_name = Route::current()->getName();

            $mockCacheKey = 'MockExamTest:all:' . $user_id . '_' . $ranSession;
            if ($inst == 'instruction' || $url_name == 'mockExamTest') {
                if (Redis::exists('MockExamTest:all:' . $user_id . '_' . $ranSession)) {
                    Redis::del('MockExamTest:all:' . $user_id . '_' . $ranSession);
                }
            }

            if (Redis::exists('MockExamTest:all:' . $user_id . '_' . $ranSession)) {
                $response_json = Redis::get($mockCacheKey);
            } else {

                $curl_url = "";
                $curl = curl_init();
                $api_URL = env('API_URL');


                $curl_url = $api_URL . 'api/mock-exam/' . $exam_id;
                $curl_option = array(
                    CURLOPT_URL => $curl_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FAILONERROR => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 360,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json",
                        "Authorization: Bearer " . $this->getAccessToken()

                    ),
                );
                curl_setopt_array($curl, $curl_option);
                $response_json = curl_exec($curl);

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);


                Redis::set($mockCacheKey, $response_json);
            }

            $responsedata = json_decode($response_json);



            $response_status = isset($responsedata->success) ? $responsedata->success : false;

            if ($response_status == true) {
                $aQuestions_list = isset($responsedata->questions) ? $responsedata->questions : [];

                $aSections = isset($responsedata->sections) ? $responsedata->sections : [];
                $exam_fulltime = $responsedata->time_allowed ?? '';
                //$exam_ques_count = $questions_count = count($aQuestions_list);
                $exam_ques_count = $questions_count = isset($responsedata->total_ques) ? $responsedata->total_ques : 0;
                $total_marks  = isset($responsedata->total_marks) ? $responsedata->total_marks : 0;
            } else {
                $aQuestions_list = $aSections = [];
                $questions_count = 0;
                $exam_fulltime = 0;
                $total_marks = 0;
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
            $exam_ques_count = $questions_count;

            $redis_set = 'True';

            // $exam_fulltime = (isset($exam_fulltime) && !empty($exam_fulltime)) ? $exam_fulltime : $questions_count  * 60;
            $sort = array();


            foreach ($aQuestions_list as $k => $v) {
                $sort['subject_id'][$k] = $v->subject_id;
                $sort['section_id'][$k] = $v->section_id;
            }

            // sort by subject_id desc and then title asc
            array_multisort($sort['subject_id'], SORT_ASC, $sort['section_id'], SORT_ASC, $aQuestions_list);

            $collection = collect($aQuestions_list);

            /*  $aQuestionslist = $collection->sortBy('subject_id'); */
            $aQuestionslist = $collection;

            $subject_ids = $collection->pluck('subject_id');




            $subject_list = $subject_ids->unique()->values()->all();

            $redis_subjects = $this->redis_subjects();
            $cSubjects = collect($redis_subjects);
            $aTargets = $aSectionSub = $aSubSecCount = $aSubIds = [];
            $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
            foreach ($filtered_subject as $sub) {
                $count_arr = $collection->where('subject_id', $sub->id)->all();
                $aSubIds[] = $sub->id;
                $sub->count = count($count_arr);
                $aTargets[] = $sub->subject_name;
                $aSectionIds = $collection->where('subject_id', $sub->id)->pluck('section_id');
                $aSectionSub[$sub->id] = $aSectionIds->unique()->values()->all();
                foreach ($aSections as $secK => $secV) {
                    $countSecQ = $collection->where('subject_id', $sub->id)->where('section_id', $secV->id)->count();
                    $aSubSecCount[$sub->id][$secV->id] = $countSecQ;
                }
            }


            $allQuestions = $aQuestionslist->keyBy('question_id');


            $aQuestions_list = $aQuestionslist->values()->all();

            $allQuestionDetails = $this->allMockQlist($user_id, $allQuestions->all(), $redis_set, $ranSession);

            $keys = $allQuestions->keys('question_id')->all();

            $question_data = current($aQuestions_list);
            $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
            $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
            $nextquestion_data = next($aQuestions_list);
            $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
            $prev_qid = '';

            if (isset($question_data) && !empty($question_data)) {
                //$publicPath = url('/') . '/public/images/questions/';
                /*  $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
                $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
                $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
                */
                $qs_id = $question_data->question_id;
                //$option_ques = str_replace("'", '"', $question_data->question_options);
                $option_ques = $question_data->question_options;

                $tempdata = json_decode($option_ques, true);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {
                        /* $option = str_replace('/public/images/questions/', $publicPath, $option); */
                        $opArr[$key] = $option;
                    }
                }
                //$optionArray = $this->shuffle_assoc($opArr);
                $optionArray = $opArr;
                $option_data = $optionArray;
            } else {
                $option_data[] = '';
            }

            $tagrets = implode(', ', $aTargets);
            $test_type = 'Mocktest';
            $exam_type = 'PE';
            $exam_mode = 'Practice';

            if (isset($inst) && $inst === 'instruction') {

                $exam_url = route('mockExam');

                $exam_title = "Mock Exam";
                $examType = 'mock';
                $instructions = $this->getInstructions($examType);


                return view('afterlogin.MockExam.mock_exam_instruction', compact('instructions', 'ranSession', 'aSections', 'exam_url', 'exam_name', 'questions_count', 'tagrets', 'exam_fulltime', 'total_marks', 'filtered_subject', 'exam_title', 'header_title'));
            } else {
                /* set redis for save exam question response */
                $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = $attempt_sub_section_cnt =  [];
                $redis_data = [
                    'given_ans' => $retrive_array,
                    'taken_time' => $retrive_time_array,
                    'taken_time_sec' => $retrive_time_sec,
                    'answer_swap_cnt' => $answer_swap_cnt,
                    'questions_count' => $questions_count,
                    'all_questions_id' => $keys,
                    'full_time' => $exam_fulltime,
                    'section_data' => $aSections,
                    'attempt_count' => $attempt_sub_section_cnt,
                    'aSectionSub' => $aSectionSub,
                    'aSubSecCount' => $aSubSecCount,
                    'aSubjectIds' => $aSubIds,
                ];


                // Push Value in Redis
                Redis::set('custom_answer_time_mock' . $user_id . '_' . $ranSession, json_encode($redis_data));
            }

            //Session::put('exam_name', $exam_name);
            Redis::set('exam_name' . $user_id, $exam_name);
            Redis::set('test_type' . $user_id, $test_type);
            $url_name = Route::current()->getName();
            if ($url_name == 'mockExamTest') {
                return view('afterlogin.AdaptiveExam.adaptiveExam_mock_test', compact('filtered_subject', 'tagrets', 'question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'exam_ques_count', 'exam_name', 'activesub_id', 'test_type', 'exam_type', 'aSections', 'aSectionSub', 'aSubSecCount', 'total_marks', 'header_title'));
            } else {

                // Mixpanel Started

                if ($userData->grade_id == '1') {
                    $grade = 'JEE';
                } elseif ($userData->grade_id == '2') {
                    $grade = 'NEET';
                } else {
                    $grade = 'NA';
                }

                /*mixpanel*/

                $redis_data = Session::get('redis_data');
                $Mixpanel_key_id = $redis_data['MIXPANEL_KEY'];

                $mp = Mixpanel::getInstance($Mixpanel_key_id);

                // track an event
                $mp->track("Mock Exam-clicked to take test button", array(
                    'distinct_id' => $userData->id,
                    //'$city' => $userData->city,
                    '$phone' => $userData->mobile,
                    '$email' => $userData->email,
                    'Email Verified' => $userData->email_verified,
                    'Course' => $grade,
                    '$city' => $userData->city,
                    '$name'=>$userData->user_name,
                    'State'=>$userData->state
                ));

                // create/update a profile for user id
                $mp->people->set($userData->id, array(
                    'distinct_id'       => $userData->id,
                    //'$city' => $userData->city,
                    '$phone' => $userData->mobile,
                    '$email' => $userData->email,
                    'Email Verified' => $userData->email_verified,
                    'Course' => $grade,
                    '$city' => $userData->city,
                    '$name'=>$userData->user_name,
                    'State'=>$userData->state
                ));

                // Mixpanel Event Ended


                //return view('afterlogin.MockExam.adaptiveExam_mock', compact('filtered_subject', 'tagrets', 'question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'exam_ques_count', 'exam_name', 'activesub_id', 'test_type', 'exam_type', 'aSections', 'aSectionSub', 'aSubSecCount', 'total_marks', 'exam_mode', 'header_title'));
                return view('afterlogin.MockExam.mock_exam', compact('ranSession', 'filtered_subject', 'tagrets', 'question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'exam_ques_count', 'exam_name', 'activesub_id', 'test_type', 'exam_type', 'aSections', 'aSectionSub', 'aSubSecCount', 'total_marks', 'exam_mode', 'header_title'));
            }
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
    /**
     * Mock Next Question
     *
     * @param mixed   $quest_id Question id
     * @param Request $request  recieve the body request data
     *
     * @return void
     */
    public function mockNextQuestion($quest_id, Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $ranSession = isset($request->ranSession) ? $request->ranSession : '';

            $cacheKey = 'CustomQuestion:mock:' . $user_id . '_' . $ranSession;

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
                /*  $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
                $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
                $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
                */
                $qs_id = $question_data->question_id;
                //$option_ques = str_replace("'", '"', $question_data->question_options);
                $option_ques = $question_data->question_options;

                $tempdata = json_decode($option_ques, true);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {
                        /* $option = str_replace('/public/images/questions/', $publicPath, $option); */
                        $opArr[$key] = $option;
                    }
                }
                //$optionArray = $this->shuffle_assoc($opArr);
                $optionArray = $opArr;
                $option_data = $optionArray;
            } else {
                $option_data[] = '';
            }
            $session_result = Redis::get('custom_answer_time_mock' . $user_id . '_' . $ranSession);
            $sessionResult = json_decode($session_result);


            $keyactSub = array_search($que_sub_id, $sessionResult->aSubjectIds);
            $nextSubId = isset($sessionResult->aSubjectIds[$keyactSub + 1]) ? $sessionResult->aSubjectIds[$keyactSub + 1] : '';


            $aGivenAns = (isset($sessionResult->given_ans->$quest_id) && !empty($sessionResult->given_ans->$quest_id)) ? $sessionResult->given_ans->$quest_id : [];
            $aquestionTakenTime = isset($sessionResult->taken_time_sec->$quest_id) ? $sessionResult->taken_time_sec->$quest_id : 0;
            $aSections = isset($sessionResult->section_data) ? $sessionResult->section_data : [];
            $aSectionSub = isset($sessionResult->aSectionSub) ? $sessionResult->aSectionSub : [];
            $aSubSecCount = isset($sessionResult->aSubSecCount) ? $sessionResult->aSubSecCount : [];


            // return view('afterlogin.AdaptiveExam.next_adaptive_question_mock', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime', 'aSections', 'aSectionSub', 'aSubSecCount'));
            return view('afterlogin.MockExam.next_mock_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime', 'aSections', 'aSectionSub', 'aSubSecCount', 'nextSubId'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Mock Next Subject Question
     *
     * @param mixed   $subject_id subject id
     * @param mixed   $section_id section id
     * @param Request $request    recieve the body request data
     *
     * @return void
     */
    public function mockNextSubjectQuestion($subject_id, $section_id = null, Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $ranSession = isset($request->ranSession) ? $request->ranSession : '';

            $cacheKey = 'CustomQuestion:mock:' . $user_id . '_' . $ranSession;
            $redis_result = Redis::get($cacheKey);

            if (isset($redis_result) && !empty($redis_result)) :
                $response = json_decode($redis_result);
            endif;

            $allQuestions = isset($response) ? $response : []; // redis response as object
            $collection = collect($allQuestions);

            if (!empty($section_id)) {
                $filtered = $collection->where('section_id', $section_id)->where('subject_id', $subject_id);
            } else {
                $filtered = $collection->where('subject_id', $subject_id);
            }


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
                // $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
                // $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
                // $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
                $qs_id = $question_data->question_id;
                //$option_ques = str_replace("'", '"', $question_data->question_options);
                $option_ques = $question_data->question_options;

                $tempdata = json_decode($option_ques, true);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {
                        // $option = str_replace('/public/images/questions/', $publicPath, $option);
                        $opArr[$key] = $option;
                    }
                }
                //$optionArray = $this->shuffle_assoc($opArr);
                $optionArray = $opArr;
                $option_data = $optionArray;
            } else {
                $option_data[] = '';
            }

            $session_result = Redis::get('custom_answer_time_mock' . $user_id . '_' . $ranSession);
            $sessionResult = json_decode($session_result);

            $keyactSub = array_search($que_sub_id, $sessionResult->aSubjectIds);
            $nextSubId = isset($sessionResult->aSubjectIds[$keyactSub + 1]) ? $sessionResult->aSubjectIds[$keyactSub + 1] : '';

            $aGivenAns = (isset($sessionResult->given_ans->$activeq_id) && !empty($sessionResult->given_ans->$activeq_id)) ? $sessionResult->given_ans->$activeq_id : [];
            $aquestionTakenTime = isset($sessionResult->taken_time_sec->$activeq_id) ? $sessionResult->taken_time_sec->$activeq_id : 0;

            $aSections = isset($sessionResult->section_data) ? $sessionResult->section_data : [];
            $aSectionSub = isset($sessionResult->aSectionSub) ? $sessionResult->aSectionSub : [];
            $aSubSecCount = isset($sessionResult->aSubSecCount) ? $sessionResult->aSubSecCount : [];


            return view('afterlogin.MockExam.next_mock_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime', 'aSections', 'aSectionSub', 'aSubSecCount', 'nextSubId'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * saveAnswerMock
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function saveAnswerMock(Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;

            /* # code... */
            $data = $request->all();
            $question_id = isset($data['question_id']) ? $data['question_id'] : '';
            $option_id = isset($data['option_id']) ? $data['option_id'] : '';
            $q_submit_time = isset($data['q_submit_time']) ? $data['q_submit_time'] : '';
            $subject_id = isset($data['current_subject_id']) ? $data['current_subject_id'] : '';
            $section_id = isset($data['current_section_id']) ? $data['current_section_id'] : '';
            $ranSession = isset($data['ranSession']) ? $data['ranSession'] : '';




            $redis_result = Redis::get('custom_answer_time_mock' . $user_id . '_' . $ranSession);

            if (!empty($redis_result)) {
                $redisArray = json_decode($redis_result, true);

                $retrive_array = $redisArray['given_ans'];
                $retrive_time_array = $redisArray['taken_time'];
                $answer_swap_cnt = $redisArray['answer_swap_cnt'];
                $retrive_time_sec = $redisArray['taken_time_sec'];

                $sectionData = isset($redisArray['section_data']) ? $redisArray['section_data'] : [];

                $sectionData = collect($sectionData);
                $limit_data = $sectionData->where("id", $section_id)->first();
                $max_attempt_limit = isset($limit_data['num_of_ques_tobeattempted']) ? $limit_data['num_of_ques_tobeattempted'] : 0;

                $attempt_sub_section_cnt = isset($redisArray['attempt_count']) ? $redisArray['attempt_count'] : [];

                if (isset($attempt_sub_section_cnt[$question_id])) {
                    unset($attempt_sub_section_cnt[$question_id]);
                }

                $attempts = collect($attempt_sub_section_cnt);
                $attempts_cnt = $attempts->where('sub_id', $subject_id)->where("section_id", $section_id);
                $sec_q_attmpt_count = $attempts_cnt->count();


                if (($sec_q_attmpt_count >= $max_attempt_limit) && $max_attempt_limit > 0) {
                    $response['status'] = 400;
                    /*   $response['sec_q_attmpt_count'] = $sec_q_attmpt_count; */

                    $response['message'] = "This section allows a maximum of " . $max_attempt_limit . " question attempts.";
                    return json_encode($response);
                }

                $retrive_time_sec[$question_id] = (int)$q_submit_time;
                //$time_taken = $redisArray['time_taken'] ?? array();
                if (isset($option_id) && $option_id != '') {
                    $retrive_array[$question_id] = $option_id;
                    $retrive_time_array[$question_id] = gmdate('H:i:s', (int)$q_submit_time);


                    $attempt_sub_section_cnt[$question_id] = array("sub_id" => $subject_id, "section_id" => $section_id);
                }
            } else {
                $retrive_array = $retrive_time_array = $answer_swap_cnt = $retrive_time_sec = $attempt_sub_section_cnt =  [];
                if (isset($option_id) && $option_id != '') {
                    $retrive_array[$question_id] = $option_id;
                    $retrive_time_array[$question_id] = gmdate('H:i:s', (int)$q_submit_time);
                    $attempt_sub_section_cnt[$question_id] = array("sub_id" => $subject_id, "section_id" => $section_id);
                }
                $retrive_time_sec[$question_id] = (int)$q_submit_time;
            }

            if (isset($answer_swap_cnt[$question_id])) {
                $answer_swap_cnt[$question_id] = $answer_swap_cnt[$question_id] + 1;
            } else {
                $answer_swap_cnt[$question_id] = 0;
            }

            $redisArray['given_ans'] = $retrive_array;
            $redisArray['taken_time'] = $retrive_time_array;
            $redisArray['answer_swap_cnt'] = $answer_swap_cnt;
            $redisArray['taken_time_sec'] = $retrive_time_sec;
            $redisArray['attempt_count'] = $attempt_sub_section_cnt;


            // Push Value in Redis
            Redis::set('custom_answer_time_mock' . $user_id . '_' . $ranSession, json_encode($redisArray));

            $response['status'] = 200;
            $response['sec_q_attmpt_count'] = $sec_q_attmpt_count;
            $response['max_attempt_limit'] = $max_attempt_limit;
            $response['message'] = "save response successfully";


            return json_encode($response);
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
    /**
     * Clear Response
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function clearResponseMock(Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            /* # code... */
            $data = $request->all();
            $question_id = isset($data['question_id']) ? $data['question_id'] : '';
            $option_id = isset($data['option_id']) ? $data['option_id'] : '';
            $ranSession = isset($data['ranSession']) ? $data['ranSession'] : '';

            $redis_result = Redis::get('custom_answer_time_mock' . $user_id . '_' . $ranSession);


            if (!empty($redis_result)) {
                $redisArray = json_decode($redis_result, true);
                $retrive_array = $redisArray['given_ans'];
                $retrive_time_array = $redisArray['taken_time'];
                $answer_swap_cnt = $redisArray['answer_swap_cnt'] ?? array();
                $answer_attempt_cnt = $redisArray['attempt_count'] ?? array();

                //clearing response of question
                unset($retrive_array[$question_id]);
                unset($answer_attempt_cnt[$question_id]);
            }
            if (isset($answer_swap_cnt[$question_id])) {
                $answer_swap_cnt[$question_id] = $answer_swap_cnt[$question_id] + 1;
            } else {
                $answer_swap_cnt[$question_id] = 0;
            }

            $redisArray['given_ans'] = $retrive_array;
            $redisArray['taken_time'] = $retrive_time_array;
            $redisArray['answer_swap_cnt'] = $answer_swap_cnt;
            $redisArray['attempt_count'] = $answer_attempt_cnt;

            // Push Value in Redis
            Redis::set('custom_answer_time_mock' . $user_id . '_' . $ranSession, json_encode($redisArray));

            $response['status'] = 200;
            $response['message'] = "save response successfully";


            return json_encode($response);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * SaveQuestionTimeSession
     *
     * @param Request $request     recieve the body request data
     * @param mixed   $question_id question id
     *
     * @return void
     */
    public function saveQuestionTimeSession(Request $request, $question_id)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;

            $question_time = $request->q_time;
            $ranSession = isset($request->ranSession) ? $request->ranSession : '';
            $redis_result = Redis::get('custom_answer_time_mock' . $user_id . '_' . $ranSession);

            if (!empty($redis_result)) {
                $redisArray = json_decode($redis_result, true);

                $retrive_array = $redisArray['given_ans'];
                $retrive_time_array = $redisArray['taken_time'];
                $answer_swap_cnt = $redisArray['answer_swap_cnt'];
                $retrive_time_sec = $redisArray['taken_time_sec'];

                $retrive_time_sec[$question_id] = (int)$question_time;
                $retrive_time_array[$question_id] = gmdate('H:i:s', $question_time);
            } else {
                $retrive_time_sec = [];
                $retrive_time_array = [];

                $retrive_time_sec[$question_id] = (int)$question_time;
                $retrive_time_array[$question_id] = gmdate('H:i:s', $question_time);
            }


            $redisArray['given_ans'] = $retrive_array;
            $redisArray['taken_time'] = $retrive_time_array;
            $redisArray['answer_swap_cnt'] = $answer_swap_cnt;
            $redisArray['taken_time_sec'] = $retrive_time_sec;

            // Push Value in Redis
            Redis::set('custom_answer_time_mock' . $user_id . '_' . $ranSession, json_encode($redisArray));

            $response['status'] = 200;
            $response['message'] = "save response successfully";


            return json_encode($response);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
