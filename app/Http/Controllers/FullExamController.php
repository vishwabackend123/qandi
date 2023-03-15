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
 * FullExamController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class FullExamController extends Controller
{
    use CommonTrait;
    /**
     * Exam
     *
     * @param Request $request   recieve the body request data
     * @param mixed   $exam_name exam name
     *
     * @return void
     */
    public function exam(Request $request, $exam_name, $inst = '',$is_empty_user = '', $event_type ='')
    {
        try {
            $filtered_subject = [];
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $exam_name_new = $exam_name;

            // Mixpanel Started
                
            $mp = Mixpanel::getInstance("cde29a1613d3ceca7b54336c8ae944b3");
            // track an event
            //$mp->track("Attempt full body scan from MyQ Today", array('distinct_id' => $userData->id,'$email' => $userData->email,'$city' => $userData->city,'$country' => $userData->country)); 

            if($is_empty_user==='empty_user' && $event_type==='my_task_center')
            {
                $mp->track("Attempt full body scan from My Task Center  ", array('distinct_id' => $userData->id,'$email' => $userData->email,'$city' => $userData->city,'$country' => $userData->country)); 
            }
            else if($is_empty_user==='empty_user' && $event_type==='myq_today')
            {
                $mp->track("Attempt full body scan from MyQ Today", array('distinct_id' => $userData->id,'$email' => $userData->email,'$city' => $userData->city,'$country' => $userData->country)); 
            }
            else if($is_empty_user==='empty_user' && $event_type==='myq_matrix')
            {
                $mp->track("Attempt full body scan from MyQ Matrix", array(
                    'distinct_id' => $userData->id,
                    '$email' => $userData->email,
                    'Email Verified' => $userData->email_verified,
                    '$city' => $userData->city,
                    '$name'=>$userData->user_name,
                    'State'=>$userData->state
                )); 
            }
            
            // create/update a profile for user id
            $mp->people->set($userData->id, array(
                'distinct_id' => $userData->id,
                '$email' => $userData->email,
                'Email Verified' => $userData->email_verified,
                '$city' => $userData->city,
                '$name'=>$userData->user_name,
                'State'=>$userData->state
            ));
            

            // Mixpanel Event Ended

            $ranSession =  isset($request->ranSession) ? $request->ranSession : mt_rand(10, 1000000);

            if (Redis::exists('custom_answer_time_full' . $user_id . '_' . $ranSession)) {
                Redis::del(Redis::keys('custom_answer_time_full' . $user_id . '_' . $ranSession));
            }

            if ($exam_name == 'full_exam_basic' || $exam_name == 'full_exam_advance') {
                $exam_name = 'Personalized Assessment';
            } else {
                $exam_name = 'Mock Test';
            }
            if (isset($inst) && $inst === 'instruction') {
                $curl_url = "";
                $curl = curl_init();
                $api_URL = env('API_URL');
                $curl_url = $api_URL . 'api/profiling-test-web-class-based/' . $exam_id . '/' . $user_id;

                $curl_option = array(

                    CURLOPT_URL => $curl_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer " . $this->getAccessToken()
                    ),
                );
                curl_setopt_array($curl, $curl_option);

                $response_json = curl_exec($curl);


                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                if ($httpcode == 200) {

                    $responsedata = json_decode($response_json);

                    $aQuestions_list = $responsedata->questions_list;

                    $exam_fulltime = $responsedata->time_allowed;
                    $total_marks = $responsedata->total_marks;

                    $questions_count = count($aQuestions_list);
                } else {
                    $aQuestions_list = [];
                    $questions_count = 0;
                    $exam_fulltime = 0;
                    $total_marks = 0;
                    return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
                }

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
                $subCounts = count($aTargets);
                $tagrets = implode(', ', $aTargets);

                $allQuestions = $aQuestionslist->countBy('question_id');
                $allQuestions = $aQuestionslist->keyBy('question_id');
                $aQuestions_list = $aQuestionslist->values()->all();

                $allQuestionDetails = $this->allProfilingQlist($user_id, $allQuestions->all(), $redis_set, $ranSession);

                $keys = $allQuestions->keys('question_id')->all();

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
                $Redis = Redis::set('custom_answer_time_full' . $user_id . '_' . $ranSession, json_encode($redis_data));
                
                $exam_url = route('exam', ['full_exam']);

                $exam_title = "Personalized Assessment";
                $test_type = 'Profiling';

                // Mixpanel started 

                if($userData->grade_id == '1'){
                    $grade = 'JEE';
                   }elseif($userData->grade_id == '2'){
                    $grade = 'NEET';
                   }else{
                    $grade = 'NA';
                   }
   
                   
                   $mp = Mixpanel::getInstance("cde29a1613d3ceca7b54336c8ae944b3");
                   // track an event
                   $mp->track("Full Body Scan Attempt Now", array(
                    'distinct_id' => $userData->id,
                   '$user_id' => $userData->id,
                   '$phone' => $userData->mobile,
                   '$email' => $userData->email,
                   'Email Verified' => $userData->email_verified,
                   'Course' => $grade,
                   '$city' => $userData->city,
                   '$name'=>$userData->user_name,
                   "State"=>$userData->state
                   )); 
   
                   // create/update a profile for user id
                   $mp->people->set($userData->id, array(
                    'distinct_id' => $userData->id,
                   '$user_id' => $userData->id,
                   '$phone' => $userData->mobile,
                   '$email' => $userData->email,
                   'Email Verified' => $userData->email_verified,
                   'Course' => $grade,
                   '$city' => $userData->city,
                   '$name'=>$userData->user_name,
                   "State"=>$userData->state
                   ));
                

                // Mixpanel Event Ended

                $examType = 'full_body_scan';
                $instructions = $this->getInstructions($examType);
                if ($exam_name_new == 'full_exam_basic' || $exam_name_new == 'full_exam_advance') {
                    return view('afterlogin.ExamViews.full_exam_instrucions', compact('instructions', 'ranSession', 'filtered_subject', 'exam_url', 'exam_name', 'questions_count', 'tagrets', 'exam_fulltime', 'total_marks', 'exam_title', 'subCounts', 'test_type','exam_name_new'));

                } else
                {
                    return view('afterlogin.ExamViews.examsInstrucions', compact('instructions', 'ranSession', 'filtered_subject', 'exam_url', 'exam_name', 'questions_count', 'tagrets', 'exam_fulltime', 'total_marks', 'exam_title', 'subCounts', 'test_type'));
    
                }

                

                // return view('afterlogin.ExamViews.exam_instructions', compact('ranSession', 'filtered_subject', 'exam_url', 'exam_name', 'questions_count', 'tagrets', 'exam_fulltime', 'total_marks', 'exam_title', 'subCounts', 'test_type'));
            } else {
                $cacheKey = 'CustomQuestion:full:' . $user_id . '_' . $ranSession;
                $redis_result = Redis::get($cacheKey);

                if (isset($redis_result) && !empty($redis_result)) :
                    $response = json_decode($redis_result);
                endif;


                $aQuestionslist = isset($response) ? collect($response) : [];

                if (!empty($aQuestionslist)) {
                    $subject_ids = $aQuestionslist->pluck('subject_id');
                    $subject_list = $subject_ids->unique()->values()->all();



                    $allQuestions = $aQuestionslist->countBy('question_id');
                    $allQuestions = $aQuestionslist->keyBy('question_id');
                    $aQuestions_list = $aQuestionslist->values()->all();
                    $questions_count = count($aQuestions_list);

                    $keys = $allQuestions->keys('question_id')->all();


                    $question_data = current($aQuestions_list);
                    $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
                    $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
                    $nextquestion_data = next($aQuestions_list);
                    $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
                    $prev_qid = '';

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
                        $optionArray = $opArr;
                        $option_data = $optionArray;
                    } else {
                        $option_data[] = '';
                    }

                    $test_type = 'Profiling';
                    $exam_type = 'P';
                    $exam_mode = 'Practice';

                    $redis_subjects = $this->redis_subjects();
                    $cSubjects = collect($redis_subjects);
                    $aTargets = [];
                    $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
                    foreach ($filtered_subject as $sub) {
                        $count_arr = $aQuestionslist->where('subject_id', $sub->id)->all();
                        $sub->count = count($count_arr);
                        $aTargets[] = $sub->subject_name;
                    }
                    $tagrets = implode(', ', $aTargets);

                    $session_result = Redis::get('custom_answer_time_full' . $user_id . '_' . $ranSession);
                    $sessionResult = json_decode($session_result);

                    $exam_fulltime = (isset($sessionResult->full_time) && !empty($sessionResult->full_time)) ? $sessionResult->full_time : 0;

                    $series_id = "";
                    Redis::set('exam_name' . $user_id, $exam_name);
                    Redis::set('test_type' . $user_id, $test_type);
                    return view('afterlogin.ExamViews.exam_new', compact('ranSession', 'filtered_subject', 'tagrets', 'question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime',  'exam_name', 'activesub_id', 'test_type', 'exam_type', 'exam_mode', 'series_id'));
                } else {
                    return Redirect::back();
                }
            }
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
    /**
     * Exam_result
     *
     * @return void
     */
    public function examResult()
    {
        return view('afterlogin.ExamViews.resultview');
    }
    /**
     * Exam_review
     *
     * @return void
     */
    public function examReview()
    {
        return view('afterlogin.ExamViews.review');
    }
    /**
     * Next Question
     *
     * @param mixed   $quest_id question id
     * @param Request $request  recieve the body request data
     *
     * @return void
     */
    public function nextQuestion($quest_id, Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $ranSession = isset($request->ranSession) ? $request->ranSession : '';

            $cacheKey = 'CustomQuestion:full:' . $user_id . '_' . $ranSession;
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

            /* this extra code for test series */
            if (empty($que_sub_id)) {
                $que_sub_id = (isset($question_data->subt_id)) ? $question_data->subt_id : '';
            }
            /* this extra code for test series */


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
            $session_result = Redis::get('custom_answer_time_full' . $user_id . '_' . $ranSession);
            $sessionResult = json_decode($session_result);

            $aGivenAns = (isset($sessionResult->given_ans->$quest_id) && !empty($sessionResult->given_ans->$quest_id)) ? $sessionResult->given_ans->$quest_id : [];
            $aquestionTakenTime = isset($sessionResult->taken_time_sec->$quest_id) ? $sessionResult->taken_time_sec->$quest_id : 0;


            return view('afterlogin.ExamViews.next_question_new', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Next subject question
     *
     * @param mixed   $subject_id subject id
     * @param Request $request    recieve the body request data
     *
     * @return void
     */
    public function nextSubjectQuestion($subject_id, Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $ranSession = isset($request->ranSession) ? $request->ranSession : '';
            $cacheKey = 'CustomQuestion:full:' . $user_id . '_' . $ranSession;
            $redis_result = Redis::get($cacheKey);

            if (isset($redis_result) && !empty($redis_result)) :
                $response = json_decode($redis_result);
            endif;

            $allQuestions = isset($response) ? $response : []; // redis response as object

            $collection = collect($allQuestions);
            $filtered = $collection->where('subject_id', $subject_id);
            $filtered_questions = $filtered->values()->all();
            /* this extra code for test series */
            if (empty($filtered_questions)) {
                $filtered = $collection->where('subt_id', $subject_id);
                $filtered_questions = $filtered->values()->all();
            }

            /* this extra code for test series */

            $allQuestionsArr = (array)$allQuestions; //object convert to array

            $allkeys = array_keys((array)$allQuestions); //Array of all keys

            //$question_data = isset($allQuestions->$quest_id) ? $allQuestions->$quest_id : []; // required question all data
            $question_data = current($filtered_questions);
            $activeq_id = isset($question_data->question_id) ? $question_data->question_id : ''; //ccurrent question id

            $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
            /* this extra code for test series */
            if (empty($que_sub_id)) {
                $que_sub_id = (isset($question_data->subt_id)) ? $question_data->subt_id : '';
            }
            /* this extra code for test series */
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

            $session_result = Redis::get('custom_answer_time_full' . $user_id . '_' . $ranSession);
            $sessionResult = json_decode($session_result);

            $aGivenAns = (isset($sessionResult->given_ans->$activeq_id) && !empty($sessionResult->given_ans->$activeq_id)) ? $sessionResult->given_ans->$activeq_id : [];
            $aquestionTakenTime = isset($sessionResult->taken_time_sec->$activeq_id) ? $sessionResult->taken_time_sec->$activeq_id : 0;


            return view('afterlogin.ExamViews.next_question_new', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * SaveAnswer
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function saveAnswerProfiling(Request $request)
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
            $ranSession = isset($request->ranSession) ? $request->ranSession : '';


            $redis_result = Redis::get('custom_answer_time_full' . $user_id . '_' . $ranSession);

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
            Redis::set('custom_answer_time_full' . $user_id . '_' . $ranSession, json_encode($redisArray));

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
     * ClearResponse
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function clearResponseProfiling(Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            /* # code... */
            $data = $request->all();
            $question_id = isset($data['question_id']) ? $data['question_id'] : '';
            $option_id = isset($data['option_id']) ? $data['option_id'] : '';
            $ranSession = isset($request->ranSession) ? $request->ranSession : '';

            $redis_result = Redis::get('custom_answer_time_full' . $user_id . '_' . $ranSession);


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
            Redis::set('custom_answer_time_full' . $user_id . '_' . $ranSession, json_encode($redisArray));

            $response['status'] = 200;
            $response['message'] = "save response successfully";



            return json_encode($response);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function allProfilingQlist($user_id, $question_data, $redis_set, $ranSession)
    {


        if (!empty($user_id) &&  !empty($question_data)) {
            $cacheKey = 'CustomQuestion:full:' . $user_id . '_' . $ranSession;


            if (Redis::exists($cacheKey)) {
                if ($redis_set == 'True') {
                    Redis::del(Redis::keys($cacheKey));
                    //Redis::del($cacheKey);
                } else {
                    $data = Redis::get($cacheKey);

                    return json_decode($data);
                }
            }
            $data = collect($question_data);
            Redis::set($cacheKey, $data);
            return $data->all();
        }
        return [];
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
            $redis_result = Redis::get('custom_answer_time_full' . $user_id . '_' . $ranSession);

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
            Redis::set('custom_answer_time_full' . $user_id . '_' . $ranSession, json_encode($redisArray));

            $response['status'] = 200;
            $response['message'] = "save response successfully";


            return json_encode($response);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
