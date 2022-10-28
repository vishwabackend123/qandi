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
use Mixpanel;

/**
 * AdpativeExamController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class AdpativeExamController extends Controller
{
    use CommonTrait;

    /**
     * Adaptive_mock_exam
     *
     * @param Request $request Illuminate\Http\Request
     *
     * @return void
     */
    public function adaptiveMockExam(Request $request)
    {
        try {
            $filtered_subject = [];
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            if (Redis::exists('custom_answer_time_' . $user_id)) {
                Redis::del(Redis::keys('custom_answer_time_' . $user_id));
            }

            $exam_name = 'Mock Test';

            $inputjson['student_id'] = $user_id;
            $inputjson['exam_id'] = $exam_id;

            $request = json_encode($inputjson);

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

            //$curl_url = $api_URL . 'api/assessment-question-selection';
            $curl_url = $api_URL . 'api/adaptive-assessment-mock-exam';

            curl_setopt_array($curl, array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 360,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request,
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json",
                    "Authorization: Bearer " . $this->getAccessToken()

                ),
            ));
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $responsedata = json_decode($response_json);


            $response_status = isset($responsedata->success) ? $responsedata->success : false;

            if ($response_status == true) {
                $aQuestions_list = isset($responsedata->questions) ? $responsedata->questions : [];
                $exam_fulltime = $responsedata->time_allowed ?? '';

                $exam_ques_count = $questions_count = count($aQuestions_list);
            } else {
                $aQuestions_list = [];
                $questions_count = 0;
                $exam_fulltime = 0;
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
            $exam_ques_count = $questions_count;

            $redis_set = 'True';

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
            $test_type = 'Mocktest';
            $exam_type = 'PE';

            //Session::put('exam_name', $exam_name);
            Redis::set('exam_name' . $user_id, $exam_name);
            Redis::set('test_type' . $user_id, $test_type);

            return view('afterlogin.AdaptiveExam.adaptiveExam', compact('filtered_subject', 'tagrets', 'question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'exam_ques_count', 'exam_name', 'activesub_id', 'test_type', 'exam_type'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Adaptive_next_question
     *
     * @param mixed   $quest_id quest id
     * @param Request $request  Illuminate\Http\Request
     *
     * @return void
     */
    public function adaptiveNextQuestion($quest_id, Request $request)
    {
        try {
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
            $session_result = Redis::get('custom_answer_time_' . $user_id);
            $sessionResult = json_decode($session_result);

            $aGivenAns = (isset($sessionResult->given_ans->$quest_id) && !empty($sessionResult->given_ans->$quest_id)) ? $sessionResult->given_ans->$quest_id : [];
            $aquestionTakenTime = isset($sessionResult->taken_time_sec->$quest_id) ? $sessionResult->taken_time_sec->$quest_id : 0;

            return view('afterlogin.AdaptiveExam.next_adaptive_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Adaptive_next_subject_question
     *
     * @param mixed   $subject_id subject id
     * @param Request $request    Illuminate\Http\Request
     *
     * @return void
     */
    public function adaptiveNextSubjectQuestion($subject_id, Request $request)
    {
        try {
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

            $session_result = Redis::get('custom_answer_time_' . $user_id);
            $sessionResult = json_decode($session_result);

            $aGivenAns = (isset($sessionResult->given_ans->$activeq_id) && !empty($sessionResult->given_ans->$activeq_id)) ? $sessionResult->given_ans->$activeq_id : [];
            $aquestionTakenTime = isset($sessionResult->taken_time_sec->$activeq_id) ? $sessionResult->taken_time_sec->$activeq_id : 0;

            return view('afterlogin.AdaptiveExam.next_adaptive_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /* ENd Adaptive Exam Methods */

    /**
     * TopicAdaptiveExam
     *
     * @param Request $request Illuminate\Http\Request
     *
     * @return void
     */
    public function topicAdaptiveExam(Request $request, $inst = '')
    {
        try {
            $header_title = "Practice";
            $filtered_subject = [];

            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $ranSession =  isset($request->ranSession) ? $request->ranSession : mt_rand(10, 1000000);

            if (Redis::exists('adaptive_session:' . $user_id . '_' . $ranSession)) {
                Redis::del(Redis::keys('adaptive_session:' . $user_id . '_' . $ranSession));
            }
            $topicAdaptiveCacheKey = 'TopicAdaptiveExam:' . $user_id . '_' . $ranSession;
            if ($inst == 'instruction') {
                if (Redis::exists($topicAdaptiveCacheKey)) {
                    Redis::del($topicAdaptiveCacheKey);
                }
            }

            if (Redis::exists($topicAdaptiveCacheKey)) {
                $response_json = Redis::get($topicAdaptiveCacheKey);
                $adaptive_session = Redis::get('adaptive_session:' . $user_id . '_' . $ranSession);
                $sesion_data = json_decode($adaptive_session);
                $select_topic = isset($sesion_data->selected_topics) ? $sesion_data->selected_topics : [];
            } else {



                $question_count = isset($request->question_count) ? $request->question_count : 30;
                $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
                $chapter_id = isset($request->chapter_id) ? $request->chapter_id : 0;
                $topic_id = isset($request->topics) ? $request->topics : 0;
                $select_topic = isset($request->topics) ? array_map('intval', explode(",", $request->topics)) : [];


                $inputjson['student_id'] = $user_id;
                $inputjson['exam_id'] = (string)$exam_id;
                if (count($select_topic) > 1) {
                    $inputjson['topic_id'] = $select_topic;
                } else {
                    $inputjson['topic_id'] = !empty($select_topic) ? $select_topic[0] : [];
                }

                $inputjson['session_id'] = 0;
                $inputjson['end_test'] = "";
                $inputjson['exam_over'] = "";
                $inputjson['questions_list'] = [];
                $inputjson['answerList'] = [];

                $request = json_encode($inputjson);

                $curl_url = "";
                $curl = curl_init();
                $api_URL = env('API_URL');

                if (count($select_topic) > 1) {
                    $curl_url = $api_URL . 'api/adaptive-assessment-multi-topics-practice';
                } else {
                    $curl_url = $api_URL . 'api/adaptive-assessment-topic-practice';
                }

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
                        "Authorization: Bearer " . $this->getAccessToken()

                    ),
                ));
                $response_json = curl_exec($curl);


                //$response_json = str_replace('NaN', '""', $response_json);

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                Redis::set($topicAdaptiveCacheKey, $response_json);
            }

            $responsedata = json_decode($response_json);



            $httpcode_response = isset($responsedata->success) ? $responsedata->success : false;
            $aQuestionslist = isset($responsedata->questions) ? $responsedata->questions : [];
            $session_id = isset($responsedata->session_id) ? $responsedata->session_id : [];
            $test_name = isset($responsedata->test_name) ? $responsedata->test_name : [];



            if ($httpcode_response == true) {
                if (!empty($aQuestionslist)) {
                    $exam_fulltime = $responsedata->time_allowed;
                    $questions_count = count($aQuestionslist);
                } else {
                    return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
                }
            } else {
                $aQuestionslist = [];
                $questions_count = 0;
                $exam_fulltime = 0;
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
            $exam_fulltime = 30; //30 min exam
            $redis_set = 'True';

            $collection = collect($aQuestionslist)->sortBy('subject_id');
            $grouped = $collection->groupBy('subject_id');
            // $subject_ids = $collection->pluck('subject_id');
            $question_ids = $collection->pluck('question_id')->values()->all();

            // $subject_list = $subject_ids->unique()->values()->all();
            if (count($select_topic) > 1) {
                $subjects_list = isset($responsedata->subjects_list) ? $responsedata->subjects_list : [];
            } else {
                $subject_ids = $collection->pluck('subject_id');
                $subjects_list = $subject_ids->unique()->values()->all();
            }

            $redis_subjects = $this->redis_subjects();
            $cSubjects = collect($redis_subjects);
            $aTargets = [];
            $filtered_subject = $cSubjects->whereIn('id', $subjects_list)->all();
            foreach ($filtered_subject as $sub) {
                $count_arr = $collection->where('subject_id', $sub->id)->all();
                $sub->count = count($count_arr);
                $aTargets[] = $sub->subject_name;
            }


            $allQuestionDetails = $this->adaptiveCustomQlist($user_id, $aQuestionslist, $redis_set, $ranSession);
            $keys = array_keys($allQuestionDetails);

            $question_data = (object)current($allQuestionDetails);

            $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
            $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
            $nextquestion_data = (object)next($allQuestionDetails);

            $next_qKey = 1;
            $prev_qKey = 0;

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
                        // /$option = str_replace('/public/images/questions/', $publicPath, $option);
                        $opArr[$key] = $option;
                    }
                }
                //$optionArray = $this->shuffle_assoc($opArr);
                $optionArray = $opArr;
                $option_data = $optionArray;
            } else {
                $option_data[] = '';
            }
            $subCounts = count($aTargets);
            $tagrets = implode(', ', $aTargets);

            $test_type = 'Assessment';
            $exam_type = 'PT';
            $exam_name = $test_name;
            //$exam_name = 'Custom Exam';
            if (count($select_topic) > 1) {
                $exam_name = "Multi Topic Adaptive Exam";
                Redis::set('exam_name' . $user_id, $exam_name);
            } else {
                $exam_name = "Single Topic Adaptive Exam";
                Redis::set('exam_name' . $user_id, $exam_name);
            }

            //Session::put('exam_name', $test_name);
            // Redis::set('exam_name' . $user_id, $test_name);
            Redis::set('test_type' . $user_id, $test_type);

            if (isset($inst) && $inst == 'instruction') {
                /* set redis for save exam question response */
                $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = $aQ_list = [];
                $redis_data = [
                    'given_ans' => $retrive_array,
                    'taken_time' => $retrive_time_array,
                    'taken_time_sec' => $retrive_time_sec,
                    'answer_swap_cnt' => $answer_swap_cnt,
                    'questions_count' => $questions_count,
                    'all_questions_id' => $question_ids,
                    'full_time' => $exam_fulltime,
                    'adaptive_api_url' => $curl_url,
                    'selected_topics' => $select_topic,
                ];

                // Push Value in Redis
                Redis::set('adaptive_session:' . $user_id . '_' . $ranSession, json_encode($redis_data));

                $exam_url = route('custom_exam_topic');

                $exam_title = "Adaptive Topic Exam";
                $eType = "Adaptive";
                $total_marks = 0;

                // Mixpanel Started
                if($userData->grade_id == '1'){
                    $grade = 'JEE';
                   }elseif($userData->grade_id == '2'){
                    $grade = 'NEET';
                   }else{
                    $grade = 'NA';
                   }


                   //Mixpanel Event Started
   
                   $Mixpanel_key_id = env('MIXPANEL_KEY');
                   $mp = Mixpanel::getInstance($Mixpanel_key_id);
                   
                   // track an event
                   $mp->track("Custom Exam Practice For Selected Topics Button Clicked", array(
                    'distinct_id' => $userData->id,
                   '$user_id' => $userData->id,
                   '$phone' => $userData->mobile,
                   '$email' => $userData->email,
                   'Email Verified' => $userData->email_verified,
                   'Course' => $grade,
                   '$city' => $userData->city
                   )); 
   
                   // create/update a profile for user id
                   $mp->people->set($userData->id, array(
                    'distinct_id' => $userData->id,
                       '$user_id'       => $userData->id,
                       '$phone' => $userData->mobile,
                       '$email' => $userData->email,
                       'Email Verified' => $userData->email_verified,
                       'course' => $grade,
                       '$city' => $userData->city
   
                   ));
                   

                   //Mixpanel Event Ended



                $examType = 'custom';
                $instructions = $this->getInstructions($examType);

                return view('afterlogin.AdaptiveExam.adaptive_exam_instruction', compact('instructions', 'ranSession', 'filtered_subject', 'exam_url', 'exam_name', 'questions_count', 'tagrets', 'exam_fulltime', 'total_marks', 'exam_title', 'header_title', 'subCounts'));

                /*  return view('afterlogin.ExamViews.exam_instructions', compact('exam_url', 'exam_name', 'questions_count', 'tagrets', 'exam_fulltime')); */
            }



            return view('afterlogin.AdaptiveExamTopic.adaptiveExam', compact('ranSession', 'exam_name', 'session_id', 'test_type', 'exam_type', 'question_data', 'tagrets', 'option_data', 'keys', 'activeq_id', 'next_qKey', 'prev_qKey', 'questions_count', 'exam_fulltime', 'filtered_subject', 'activesub_id', 'header_title'));
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
    /**
     * Ajax_adaptive_question_topic
     *
     * @param mixed   $key     key type request
     * @param Request $request Illuminate\Http\Request
     *
     * @return void
     */
    public function ajaxAdaptiveQuestionTopic($key, Request $request)
    {
        try {
            $qNo = $key + 1;
            $next_qid = $key + 1;
            $prev_qid = $key - 1;

            $session_id = isset($request->session_id) ? $request->session_id : [];
            $topic_id = isset($request->topic_id) ? $request->topic_id : [];
            $ranSession = isset($request->ranSession) ? $request->ranSession : [];

            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'CustomQuestionAdaptive:all:' . $user_id . '_' . $ranSession;
            $redis_result = Redis::get($cacheKey);;
            $redis_result = Redis::get($cacheKey);

            if (isset($redis_result) && !empty($redis_result)) :
                $response = json_decode($redis_result);
            endif;

            $allQuestions = isset($response) ? $response : []; // redis response as object

            $allQuestionsArr = (array)$allQuestions; //object convert to array

            $allkeys = array_keys((array)$allQuestions); //Array of all keys

            $next_question_data = isset($allQuestions[$key]) ? $allQuestions[$key] : []; // required question all data

            if (empty($next_question_data)) {
                $question_data = $this->getNextAdpativeQues($session_id, $key, $topic_id, $ranSession);
            } else {
                $question_data = $next_question_data;
            }

            $activeq_id = isset($question_data->question_id) ? $question_data->question_id : ''; //current question id
            $quest_id = $activeq_id;
            $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
            $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
            // $key = array_search($activeq_id, array_column($allQuestionsArr, 'question_id'));


            $last_qid = end($allkeys);

            if (isset($question_data) && !empty($question_data)) {

                $qs_id = $question_data->question_id;

                $option_ques = $question_data->question_options;

                $tempdata = json_decode($option_ques, true);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {

                        $opArr[$key] = $option;
                    }
                }
                //$optionArray = $this->shuffle_assoc($opArr);
                $optionArray = $opArr;
                $option_data = $optionArray;

                $session_result = Redis::get('adaptive_session:' . $user_id . '_' . $ranSession);
                $sessionResult = json_decode($session_result);

                $aGivenAns = (isset($sessionResult->given_ans->$quest_id->answer) && !empty($sessionResult->given_ans->$quest_id->answer)) ? $sessionResult->given_ans->$quest_id->answer : [];



                $aquestionTakenTime = isset($sessionResult->taken_time_sec->$quest_id) ? $sessionResult->taken_time_sec->$quest_id : 0;

                $view = view('afterlogin.AdaptiveExamTopic.next_adaptive_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'))->render();

                return response(array('status' => 'success', 'html' => $view));
            } else {
                return response(array('status' => 'failed'));
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * GetNextAdpativeQues
     *
     * @param mixed $session_id session id
     * @param mixed $nextkey    nextkey
     * @param mixed $topic_id   topic id
     *
     * @return void
     */
    public function getNextAdpativeQues($session_id, $nextkey, $topic_id, $ranSession)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'CustomQuestionAdaptive:all:' . $user_id . '_' . $ranSession;
            $redis_result = Redis::get($cacheKey);;
            $redis_result = Redis::get($cacheKey);
            $redisQuestionArray = json_decode($redis_result);

            $session_result = Redis::get('adaptive_session:' . $user_id . '_' . $ranSession);
            $sessionResult = json_decode($session_result);
            $questionList = isset($sessionResult->all_questions_id) ? $sessionResult->all_questions_id : [];
            $answerList = isset($sessionResult->given_ans) ? (array)$sessionResult->given_ans : [];
            $adaptive_api_url = isset($sessionResult->adaptive_api_url) ? $sessionResult->adaptive_api_url : '';
            $selected_topics = isset($sessionResult->selected_topics) ? $sessionResult->selected_topics : [];




            $inputjson['student_id'] = (int)$user_id;
            $inputjson['exam_id'] = (int)$exam_id;
            if (count($selected_topics) > 1) {
                $inputjson['topic_id'] = $selected_topics;
            } else {
                $inputjson['topic_id'] = (int)$topic_id;
            }


            $inputjson['session_id'] = (int)$session_id;
            $inputjson['end_test'] = "no";
            $inputjson['questions_list'] = array_values($questionList);
            $inputjson['answerList'] = array_values($answerList);

            $request = json_encode($inputjson);


            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = !empty($adaptive_api_url) ? $adaptive_api_url : $api_URL . 'api/adaptive-assessment-topic-practice';


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
                    "Authorization: Bearer " . $this->getAccessToken()

                ),
            ));
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $responsedata = json_decode($response_json);
            $res_status = isset($responsedata->success) ? $responsedata->success : false;
            $res_questions = isset($responsedata->questions) ? $responsedata->questions : [];

            if ($res_status == true && !empty($res_questions)) {
                if (Redis::exists('adaptive_session:' . $user_id . '_' . $ranSession)) {
                    Redis::del(Redis::keys('adaptive_session:' . $user_id . '_' . $ranSession));

                    $questions_count = count($res_questions);
                    $newQuestions = collect($res_questions);

                    $question_ids = $newQuestions->pluck('question_id')->values()->all();

                    $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = [];
                    $redis_data = [
                        'given_ans' => $retrive_array,
                        'taken_time' => $retrive_time_array,
                        'taken_time_sec' => $retrive_time_sec,
                        'answer_swap_cnt' => $answer_swap_cnt,
                        'questions_count' => $questions_count,
                        'all_questions_id' => $question_ids,
                        'adaptive_api_url' => $curl_url,
                        'selected_topics' => $selected_topics,
                    ];

                    // Push Value in Redis
                    Redis::set('adaptive_session:' . $user_id . '_' . $ranSession, json_encode($redis_data));
                }

                $nArray = array_merge($redisQuestionArray, $res_questions);

                $allQuestionDetails = $this->adaptiveCustomQlist($user_id, $nArray, 'True', $ranSession);
                $next_question_data = isset($allQuestionDetails[$nextkey]) ? $allQuestionDetails[$nextkey] : []; // required question all data

                return $next_question_data;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Adaptive_topic_exam_result
     *
     * @param Request $request Illuminate\Http\Request
     *
     * @return void
     */
    public function adaptiveTopicExamResult(Request $request)
    {
        try {
            $session_id = isset($request->session_id) ? $request->session_id : 0;
            $topic_id = isset($request->topic_id) ? $request->topic_id : 0;
            $ranSession = isset($request->ranSession) ? $request->ranSession : 0;
            $exam_name = isset($request->exam_name) ? $request->exam_name : 0;
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'CustomQuestionAdaptive:all:' . $user_id . '_' . $ranSession;
            $redis_result = Redis::get($cacheKey);;
            $redis_result = Redis::get($cacheKey);
            $redisQuestionArray = json_decode($redis_result);

            $session_result = Redis::get('adaptive_session:' . $user_id . '_' . $ranSession);
            $sessionResult = json_decode($session_result);



            //$questionList = isset($sessionResult->all_questions_id) ? $sessionResult->all_questions_id : [];
            $questionList = isset($sessionResult->given_ans) ? array_keys((array)$sessionResult->given_ans) : [];
            $answerList = isset($sessionResult->given_ans) ? (array)$sessionResult->given_ans : [];
            $adaptive_api_url = isset($sessionResult->adaptive_api_url) ? $sessionResult->adaptive_api_url : '';
            $selected_topics = isset($sessionResult->selected_topics) ? $sessionResult->selected_topics : [];



            $inputjson['student_id'] = (int)$user_id;
            $inputjson['exam_id'] = (int)$exam_id;
            if (count($selected_topics) > 1) {
                $inputjson['topic_id'] = $selected_topics;
            } else {
                $inputjson['topic_id'] = (int)$topic_id;
            }
            $inputjson['session_id'] = (int)$session_id;
            $inputjson['end_test'] = "yes";
            $inputjson['questions_list'] = array_values($questionList);
            $inputjson['answerList'] = array_values($answerList);
            $inputjson['test_name'] = $exam_name;

            $request = json_encode($inputjson);

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = !empty($adaptive_api_url) ? $adaptive_api_url : $api_URL . 'api/adaptive-assessment-topic-practice';
            //$curl_url = $api_URL . 'api/adaptive-assessment-topic-practice';

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
                    "Authorization: Bearer " . $this->getAccessToken()

                ),
            ));
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $response_data = (json_decode($response_json));
            $check_response = isset($response_data->success) ? $response_data->success : false;

            if ($check_response == true) {

                $result_id = $response_data->result_id;

                /*mixpanel start*/
                if($userData->grade_id == '1'){
                    $grade = 'JEE';
                   }elseif($userData->grade_id == '2'){
                    $grade = 'NEET';
                   }else{
                    $grade = 'NA';
                   }
   
                   $mp = Mixpanel::getInstance("1786724e2a19c89a045f66f90b792a98");
                   
                   // track an event
                   $mp->track("Custom Exam Practice For Topic Submit", array(
                   'distinct_id' => $userData->id,
                   '$phone' => $userData->mobile,
                   '$email' => $userData->email,
                   'Email Verified' => $userData->email_verified,
                   'Course' => $grade,
                   '$city' => $userData->city,
                   )); 
   
                   // create/update a profile for user id
                   $mp->people->set($userData->id, array(
                       'distinct_id' => $userData->id,
                       '$phone' => $userData->mobile,
                       '$email' => $userData->email,
                       'Email Verified' => $userData->email_verified,
                       'Course' => $grade,
                       '$city' => $userData->city,
   
                   ));
                   /*mixpanel event end*/
                
                return Redirect::route('exam_result_analytics', [$result_id]);
                // return view('afterlogin.ExamCustom.exam_result_analytics');
            } else {


                return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
    /**
     * Adaptive_chapter_exam_result
     *
     * @param Request $request Illuminate\Http\Request
     *
     * @return void
     */
    public function adaptiveChapterExamResult(Request $request)
    {
        try {
            $session_id = isset($request->session_id) ? $request->session_id : 0;
            $chapter_id = isset($request->chapter_id) ? $request->chapter_id : 0;
            $planner_id = isset($request->planner_id) ? $request->planner_id : 0;
            $ranSession = isset($request->ranSession) ? $request->ranSession : 0;
            $exam_name = isset($request->exam_name) ? $request->exam_name : '';

            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'CustomQuestionAdaptive:all:' . $user_id . '_' . $ranSession;
            $redis_result = Redis::get($cacheKey);;
            $redis_result = Redis::get($cacheKey);
            $redisQuestionArray = json_decode($redis_result);

            $session_result = Redis::get('adaptive_session:' . $user_id . '_' . $ranSession);
            $sessionResult = json_decode($session_result);
            $questionList = isset($sessionResult->all_questions_id) ? $sessionResult->all_questions_id : [];
            $answerList = isset($sessionResult->given_ans) ? (array)$sessionResult->given_ans : [];

            $inputjson['student_id'] = (int)$user_id;
            $inputjson['exam_id'] = (int)$exam_id;
            $inputjson['chapter_id'] = (int)$chapter_id;
            $inputjson['session_id'] = (int)$session_id;
            $inputjson['end_test'] = "yes";
            $inputjson['questions_list'] = array_values($questionList);
            $inputjson['answerList'] = array_values($answerList);
            $inputjson['planner_id'] = $planner_id;
            $inputjson['test_name'] = $exam_name;
            /* $inputjson['questions_list'] = [];
            $inputjson['answerList'] = []; */


            $request = json_encode($inputjson);


            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/adaptive-assessment-chapter-practice';

            curl_setopt_array($curl, array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 360,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request,
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json",
                    "Authorization: Bearer " . $this->getAccessToken()

                ),
            ));
            $response_json = curl_exec($curl);


            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $response_data = json_decode($response_json);
            $check_response = isset($response_data->success) ? $response_data->success : false;



            if ($check_response == true) {
                $result_id = $response_data->result_id;

                // Mixpanel Started
                if($userData->grade_id == '1'){
                    $grade = 'JEE';
                   }elseif($userData->grade_id == '2'){
                    $grade = 'NEET';
                   }else{
                    $grade = 'NA';
                   }
                
                   $Mixpanel_key_id = env('MIXPANEL_KEY');
                   $mp = Mixpanel::getInstance($Mixpanel_key_id);
			
                   // track an event
                   $mp->track("Custom Exam Practice For Chapter Submit", array(
                    'distinct_id' => $userData->id,
                    '$user_id' => $userData->id,
                    '$phone' => $userData->mobile,
                    '$email' => $userData->email,
                    'Email Verified' => $userData->email_verified,
                    'Course' => $grade,
                    '$city' => $userData->city
                   )); 
   
                   // create/update a profile for user id
                   $mp->people->set($userData->id, array(
                    'distinct_id' => $userData->id,
                    '$user_id' => $userData->id,
                    '$phone' => $userData->mobile,
                    '$email' => $userData->email,
                    'Email Verified' => $userData->email_verified,
                    'Course' => $grade,
                    '$city' => $userData->city
   
                   ));
                   
                   // Mixpanel Event End



                return Redirect::route('exam_result_analytics', [$result_id]);
                //return view('afterlogin.ExamCustom.exam_result_analytics');
            } else {

                return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
