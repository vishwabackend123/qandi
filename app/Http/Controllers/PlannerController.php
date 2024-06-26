<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use App\Models\UserAnalytics;
use App\Models\StudentPreference;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Log;
use Mixpanel;

/**
 * PlannerController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class PlannerController extends Controller
{
    use CommonTrait;

    /**
     * Add Planner
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function addPlanner(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $range = isset($request->weekrange) ? $request->weekrange : '';
            $start_date = isset($request->start_date) ? $request->start_date : '';
            $end_date = isset($request->end_date) ? $request->end_date : '';
            $chapters = isset($request->chapters) ? json_encode($request->chapters, true) : '';


            $request = [
                "student_id" => $user_id,
                "exam_id" => $exam_id,
                "subject_id" => 1,
                "chapter_id" => $chapters,
                "date_from" => $start_date,
                "date_to" => $end_date
            ];

            $request_json = json_encode($request);


            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/student-planner';
            $curl_option = array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json,
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

            if ($httpcode == 200 || $httpcode == 201) {
                return $response_json;
            } else {
                return $err;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Weekly Exams
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function weeklyExams(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/student-planner-current-week/' . $user_id;

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
            $response = json_decode($response_json);
            $response_status = isset($response->success) ? $response->success : false;

            if ($response_status != false) {
                $planner = isset($response->result) ? $response->result : [];

                return view('afterlogin.weekly_planner', compact('planner'));
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Get Weekly Plan Schedule
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function getWeeklyPlanSchedule(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $range = 0;

            $start_date = $request->start_date;

            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/student-planner/' . $user_id;

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
            $response = json_decode($response_json);
            $response_status = isset($response->success) ? $response->success : false;


            if ($response_status != false) {
                $planner_result = isset($response->result) ? $response->result : [];
                $plan_collection = collect($planner_result);

                $filtered = $plan_collection->where('date_from', $start_date);
                $planner = $filtered->all();

                $range = count($planner);

                $planner = collect($planner);
                $filter_attempted = $planner->where('test_completed_yn', 'Y')->all();
                $attempted = count($filter_attempted);



                return json_encode(array('range' => $range, 'planner' => $planner, 'attempted' => $attempted, 'status' => 'success'));
            } else {
                return json_encode(array('range' => $range, 'status' => 'failed'));
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Planner Exam
     *
     * @param mixed   $planner_id planner id
     * @param mixed   $chapter_id chapter id
     * @param Request $request    recieve the body request data
     *
     * @return void
     */
    public function plannerExam($planner_id = null, $chapter_id = null, Request $request)
    {
        try {
            $filtered_subject = [];
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            if (Redis::exists('custom_answer_time_' . $user_id)) {
                Redis::del(Redis::keys('custom_answer_time_' . $user_id));
            }

            $question_count = isset($request->question_count) ? $request->question_count : 30;
            $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
            $chapter_id = isset($request->chapter_id) ? $request->chapter_id : 0;
            $chapter_name = isset($request->chapter_name) ? $request->chapter_name : '';
            $select_topic = isset($request->topics) ? (explode(",", $request->topics)) : [];


            $inputjson['student_id'] = $user_id; //30776; //(string);
            $inputjson['exam_id'] = (string)$exam_id;
            $inputjson['chapter_id'] = (string)$chapter_id;
            $request = json_encode($inputjson);

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/planner-question-selection';
            $curl_option = array(
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
            );

            curl_setopt_array($curl, $curl_option);
            $response_json = curl_exec($curl);

            //$response_json = str_replace('NaN', '""', $response_json);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $responsedata = json_decode($response_json);
            $res_status = isset($responsedata->success) ? $responsedata->success : false;


            if ($res_status == true) {
                $aQuestionslist = isset($responsedata->questions_list[0]) ? $responsedata->questions_list[0] : $responsedata->questions_list;

                if (!empty($aQuestionslist)) {
                    $aQuestions_lists = !empty($aQuestionslist) ? $aQuestionslist->Questions : [];

                    $subject_id = !empty($aQuestionslist) ? $aQuestionslist->subject_id : '';

                    $filtered_subject = $responsedata->Subjects;
                    $exam_fulltime = $responsedata->time_allowed;
                    $questions_count = count($aQuestions_lists);
                } else {
                    return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
                }
            } else {
                $aQuestions_lists = [];
                $questions_count = 0;
                $exam_fulltime = 0;
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }

            $redis_set = 'True';

            $collection = collect($aQuestions_lists);

            $allQuestions = $collection->keyBy('question_id')->sortBy('question_id');

            $allQuestionDetails = $this->allCustomQlist($user_id, $allQuestions->all(), $redis_set);
            $aQuestions_list = $allQuestionDetails;
            $keys = $allQuestions->keys('question_id')->all();



            $question_data = (object)current($aQuestions_list);
            $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
            $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
            $nextquestion_data = (object)next($aQuestions_list);

            $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
            $prev_qid = '';


            if (isset($question_data) && !empty($question_data)) {
                //$publicPath = url('/') . '/public/images/questions/';
                // $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
                // $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
                // $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
                $qs_id = $question_data->question_id;
                $question_data->subject_id = isset($subject_id) ? $subject_id : '';
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
            $aTargets = [];

            foreach ($filtered_subject as $sub) {
                $aTargets[] = $sub->subject_name;
            }
            $tagrets = implode(', ', $aTargets);
            $exam_name = "Planner Exam";

            $test_type = 'Planner';
            $exam_type = 'P';


            return view('afterlogin.planner.exam', compact('planner_id', 'chapter_name', 'question_data', 'tagrets', 'exam_name', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'filtered_subject', 'activesub_id', 'test_type', 'exam_type'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Shuffle chapter
     *
     * @param mixed   $active_subject_id active subject id
     * @param Request $request           recieve the body request data
     *
     * @return void
     */
    public function shuffleChapter($active_subject_id, Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $selected_chapter = isset($request->selected_chapters) ? $request->selected_chapters : [];

            $chapter_list = $this->redis_chapter_list($active_subject_id);
            $chapter_collect = collect($chapter_list);

            $filtered = $chapter_collect->whereNotIn('chapter_id', $selected_chapter);
            $shuffle = $filtered->random();

            return json_encode($shuffle);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Planner Adaptive Exam
     *
     * @param mixed   $planner_id planner id
     * @param Request $request    recieve the body request data
     *
     * @return void
     */
    public function plannerAdaptiveExam($planner_id = null, $inst = "", Request $request)
    {
        try {
            $header_title = 'Planner Exam';
            $filtered_subject = [];

            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $ranSession =  isset($request->ranSession) ? $request->ranSession : mt_rand(10, 1000000);
            if (Redis::exists('adaptive_session:' . $user_id . '_' . $ranSession)) {
                Redis::del(Redis::keys('adaptive_session:' . $user_id . '_' . $ranSession));
            }

            $plannerCacheKey = 'PlannerExam:' . $user_id . '_' . $ranSession;
            if ($inst == 'instruction') {
                if (Redis::exists($plannerCacheKey)) {
                    Redis::del($plannerCacheKey);
                }
            }

            if (Redis::exists($plannerCacheKey)) {
                $response_json = Redis::get($plannerCacheKey);
            } else {

                $question_count = isset($request->question_count) ? $request->question_count : 30;
                $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
                $chapter_id = isset($request->chapter_id) ? $request->chapter_id : 0;

                $select_topic = isset($request->topics) ? explode(",", (int)$request->topics, true) : [];


                $inputjson['student_id'] = $user_id;
                $inputjson['exam_id'] = (string)$exam_id;
                $inputjson['chapter_id'] = $chapter_id;
                $inputjson['session_id'] = 0;
                $inputjson['end_test'] = "";
                $inputjson['exam_over'] = "";
                $inputjson['questions_list'] = [];
                $inputjson['answerList'] = [];
                $inputjson['planner_id'] = $planner_id;

                $request = json_encode($inputjson);


                $curl_url = "";
                $curl = curl_init();
                $api_URL = env('API_URL');

                $curl_url = $api_URL . 'api/adaptive-assessment-chapter-practice';
                $curl_option = array(
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
                );
                curl_setopt_array($curl, $curl_option);
                $response_json = curl_exec($curl);


                // $response_json = str_replace('NaN', '""', $response_json);

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                Redis::set($plannerCacheKey, $response_json);
            }

            $responsedata = json_decode($response_json);

            $httpcode_response = isset($responsedata->success) ? $responsedata->success : false;
            $aQuestionslist = isset($responsedata->questions) ? $responsedata->questions : [];
            $session_id = isset($responsedata->session_id) ? $responsedata->session_id : [];
            $test_name = isset($responsedata->test_name) ? $responsedata->test_name : 'Chapter Level Exam';

            if ($httpcode_response == true) {
                if (!empty($aQuestionslist)) {
                    $exam_fulltime = $responsedata->time_allowed;
                    $questions_count = count($aQuestionslist);
                } else {
                    return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
                }
            } else {
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
            $exam_fulltime = 60; //60min set for cahpter adaptive exam
            $redis_set = 'True';

            $collection = collect($aQuestionslist)->sortBy('subject_id');
            $grouped = $collection->groupBy('subject_id');
            $subject_ids = $collection->pluck('subject_id');
            $question_ids = $collection->pluck('question_id')->values()->all();

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
            $tagrets = implode(', ', $aTargets);

            $test_type = 'Planner';
            $exam_type = 'P';
            $exam_name = $test_name;
            //Session::put('exam_name', $test_name);
            Redis::set('exam_name' . $user_id, $test_name);
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
                ];

                // Push Value in Redis
                Redis::set('adaptive_session:' . $user_id . '_' . $ranSession, json_encode($redis_data));

                Redis::set('custom_answer_time_' . $user_id, json_encode($redis_data));

                $exam_url = route('plannerExam', ['planner_id' => $planner_id]);

                $exam_title = "Planner Exam";
                $eType = "Adaptive";
                $total_marks = 0;

                $examType = 'planner';
                $instructions = $this->getInstructions($examType);
                return view('afterlogin.AdaptiveExam.adaptive_exam_instruction', compact('instructions', 'ranSession', 'filtered_subject', 'exam_url', 'exam_name', 'questions_count', 'tagrets', 'exam_fulltime', 'total_marks', 'exam_title', 'header_title'));
            }


            return view('afterlogin.planner.planner_exam', compact('ranSession', 'planner_id', 'session_id', 'test_type', 'exam_type', 'question_data', 'tagrets', 'option_data', 'keys', 'activeq_id', 'next_qKey', 'prev_qKey', 'questions_count', 'exam_fulltime', 'filtered_subject', 'activesub_id', 'test_name', 'header_title', 'exam_name'));
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }




    /**
     * 
     * 
     * 
     *  */
    public function plannerSchedule()
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;


            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/student-planner-current-week/' . $user_id;

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
            $response = json_decode($response_json);
            $response_status = isset($response->success) ? $response->success : false;


            if ($response_status != false) {
                $aPlanner = isset($response->result) ? $response->result : [];
            } else {
                $aPlanner = [];
            }
            $planner = collect($aPlanner);
            $filter = $planner->where('test_completed_yn', 'Y')->all();

            $planner_cnt = count($aPlanner);
            $attempted = count($filter);
            $mondayDate = date('Y-m-d', strtotime('monday this week'));
            $sundayDate = date('Y-m-d', strtotime('sunday this week'));

            $user_subjects = $this->redis_subjects();
            $header_title = "Planner";



            return view('afterlogin.planner.planner_schedule', compact('header_title', 'planner', 'attempted', 'mondayDate', 'sundayDate', 'planner_cnt', 'user_subjects'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
