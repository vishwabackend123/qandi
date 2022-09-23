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

/**
 * ResultController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 * */
class ResultController extends Controller
{
    use CommonTrait;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Exam Result
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function examResult(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $exam_full_time = isset($request->fulltime) ? $request->fulltime : '';
            $total_marks = isset($request->total_marks) ? $request->total_marks : '';
            $submit_time = isset($request->submit_time) ? (string)gmdate('H:i:s', $request->submit_time) : '00:00:00';
            $exam_type = isset($request->exam_type) ? $request->exam_type : '';
            $test_type = isset($request->test_type) ? $request->test_type : '';
            $exam_mode = isset($request->exam_mode) ? $request->exam_mode : 'Practice';
            $planner_id = isset($request->planner_id) ? $request->planner_id : 0;
            $live_exam_id = isset($request->live_exam_id) ? $request->live_exam_id : 0;
            $test_series_id = isset($request->series_id) ? $request->series_id : 0;
            $py_paper_id = isset($request->py_paperid) ? $request->py_paperid : 0;

            $ranSession = isset($request->ranSession) ? $request->ranSession : 0;

            $autosubmit = isset($request->autosubmit) ? $request->autosubmit : false;



            /* below parameter for dailyTaskExam result */
            $tasktype = isset($request->tasktype) ? $request->tasktype : "";
            $category = isset($request->category) ? $request->category : "";
            /* end parameter for dailyTaskExam result */

            if ($test_type == 'Live') {
                $redis_json = Redis::get('custom_answer_time_live_' . $user_id);
            } elseif ($test_type == 'Mocktest') {
                $redis_json = Redis::get('custom_answer_time_mock' . $user_id . '_' . $ranSession);
            } elseif ($test_type == 'Profiling') {

                $redis_json = Redis::get('custom_answer_time_full' . $user_id . '_' . $ranSession);
            } elseif ($test_type == 'PreviousYear') {
                $redis_json = Redis::get('custom_answer_time_py' . $user_id . '_' . $ranSession);
            } elseif ($test_type == 'Test-Series') {
                if ($exam_mode == 'Open') {
                    $redis_json = Redis::get('custom_answer_time_ts' . $user_id . '_' . $ranSession);
                } else {
                    $redis_json = Redis::get('custom_answer_time_tsl' . $user_id . '_' . $ranSession);
                }
            } elseif ($tasktype == 'daily' || $tasktype == 'weekly') {

                $redis_json = Redis::get('custom_answer_time_task' . $user_id . '_' . $ranSession);
            } else {
                //custom subject exam
                $redis_json = Redis::get('custom_answer_time_' . $user_id);
            }



            $redisArray = (isset($redis_json) && !empty($redis_json)) ? json_decode($redis_json) : [];


            $given_ans = $answerList = $answersArr = [];
            $given_ans = isset($redisArray->given_ans) ? $redisArray->given_ans : [];

            $attempt_count = isset($redisArray->attempt_count) ? $redisArray->attempt_count : [];
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
                    $answerList['section_id'] = isset($attempt_count->$key->section_id) ? (int)$attempt_count->$key->section_id : 0;

                    $answersArr[] = $answerList;
                    $answersArrQID[] = (int)$key;
                }
            }


            $inputjson = [];
            $inputjson['answerList'] = $answersArr;
            $inputjson['test_time'] = (string)$exam_full_time;
            $inputjson['total_marks'] = !empty($total_marks) ? $total_marks : ($questions_count * 4);
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
            $inputjson['py_paper_id'] = $py_paper_id;

            $request = json_encode($inputjson);


            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/save-result';
            $curl_option = array(

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
                    "content-type: application/json",
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);


            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($test_type == 'Live') {
                return view('afterlogin.LiveExam.live_result', compact('autosubmit'));
            }

            $response_data = (json_decode($response_json));
            $check_response = isset($response_data->success) ? $response_data->success : false;


            if ($check_response == true) {
                if (!empty($category) && !empty($tasktype)) {
                    $saveDailyTaskRecord = $this->saveRecordToTaskCenterHistory($user_id, $tasktype, $category);
                }
                $result_id = $response_data->result_id;



                return Redirect::route('exam_result_analytics', [$result_id]);
            } else {
                return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }

    /**
     * Exam post analysis score
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function examPostAnalysisScore(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/mini-post-exam-analytics1/' . $user_id . '/' . $exam_id;
            $curl_option = array(
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
    /**
     * Exam post analysis attempt
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function examPostAnalysisAttempt(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/mini-post-exam-analytics2/' . $user_id . '/' . $exam_id;
            $curl_option = array(
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
                $response_data = (json_decode($response_json));
                $response = isset($response_data->response) ? $response_data->response : [];
                if (Redis::exists('test_type' . $user_id)) {
                    $cacheKey = 'test_type' . $user_id;
                    $test_type = Redis::get($cacheKey);
                } else {
                    $test_type = '';
                }

                return view('afterlogin.ExamCustom.exam_result2', compact('response', 'test_type'));
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Exam post analysis rank
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function examPostAnalysisRank(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');


            $curl_url = $api_URL . 'api/mini-post-exam-analytics3/' . $user_id . '/' . $exam_id;
            $curl_option = array(
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
                    "content-type: application/json",
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $response_data = json_decode($response_json);
            $response = isset($response_data->response) ? $response_data->response : [];
            $check_response = isset($response->success) ? $response->success : false;

            if ($check_response == true) {
                return view('afterlogin.ExamCustom.exam_result3', compact('response'));
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Get All Result
     *
     * @param mixed $exam_type exam type
     *
     * @return void
     */
    public function getAllResult($exam_type)
    {
        $limit = 100;
        $offset = 0;
        $userData = Session::get('user_data');
        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $curl_url = "";
        $curl = curl_init();
        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/student-result-list/' . $user_id . '/?pagination_start=' . $offset . '&limit=' . $limit . '&test_type=' . $exam_type;
        $curl_option = array(
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
            $response_data = (json_decode($response_json));
            $result_data = isset($response_data->response) ? $response_data->response : [];

            return $result_data;
        } else {
            return false;
        }
    }
    /**
     * Get Exam Result Analytics
     *
     * @param mixed $result_id result id
     *
     * @return void
     */
    public function getExamResultAnalytics($result_id, $type_exam = null, $type_name = null)
    {
        try {
            if ($type_exam) {
                $type_exam = base64_decode($type_exam);
            }
            if ($type_name) {
                $type_name = base64_decode($type_name);
            }
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/result-analytics/' . $user_id . '/' . $exam_id . '/' . $result_id;

            $curl_option = array(
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
                $response_data = (json_decode($response_json));
                $response = isset($response_data) ? $response_data : [];
                $header_title = "Test Analysis";

                return view('afterlogin.LiveExam.live_result_analysis', compact('response', 'header_title', 'result_id', 'type_exam', 'type_name'));
            } else {

                //return redirect()->back();
                return Redirect::back()->withErrors(['There is some error  for this result id.']);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Exam Result Analytics
     *
     * @param mixed $result_id result id
     *
     * @return void
     */
    public function examResultAnalytics($result_id)
    {
        $userData = Session::get('user_data');


        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        if (Redis::exists('exam_name' . $user_id)) {
            //$exam_name = Session::get('exam_name');
            $cacheKey = 'exam_name' . $user_id;
            $exam_name = Redis::get($cacheKey);
        } else {
            $exam_name = '';
        }


        $curl_url = "";
        $curl = curl_init();
        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/mini-post-exam-analytics1/' . $user_id . '/' . $exam_id;
        $curl_option = array(
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
            $response_data = (json_decode($response_json));
            $scoreResponse = isset($response_data->response) ? $response_data->response : [];
        } else {
            $scoreResponse = [];
        }



        $curl_url2 = "";
        $curl2 = curl_init();
        $curl_url2 = $api_URL . 'api/mini-post-exam-analytics3/' . $user_id . '/' . $exam_id;
        $curl_option2 = array(
            CURLOPT_URL => $curl_url2,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 120,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "Authorization: Bearer " . $this->getAccessToken()
            ),
        );
        curl_setopt_array($curl2, $curl_option2);

        $response_json = curl_exec($curl2);

        $err = curl_error($curl2);
        $httpcode = curl_getinfo($curl2, CURLINFO_HTTP_CODE);
        curl_close($curl2);

        $response_data = json_decode($response_json);
        $response = isset($response_data->response) ? $response_data->response : [];
        $check_response = isset($response->success) ? $response->success : false;

        if ($check_response == true) {
            $rankResponse = isset($response_data->response) ? $response_data->response : [];
        } else {
            $rankResponse =  [];
        }
        if (Redis::exists('test_type' . $user_id)) {
            $cacheKey = 'test_type' . $user_id;
            $test_type = Redis::get($cacheKey);
        } else {
            $test_type = '';
        }
        $header_title = "Test Analysis";

        return view('afterlogin.ResultAnalysis.exam_result', compact('exam_name', 'scoreResponse', 'rankResponse', 'test_type', 'header_title'));
    }
    /**
     * Ajax Exam Result List
     *
     * @param mixed $exam_type exam type
     *
     * @return void
     */
    public function ajaxExamResultList($exam_type)
    {
        $result_data = [];
        $redis_subjects = $this->redis_subjects();
        $cSubjects = collect($redis_subjects);
        $result_data = $this->getAllResult($exam_type);
        $years_list = [];
        $filtered_subject = [];
        foreach ($result_data as $key => $value) {
            $id = explode(',', $value->subject_id_list);
            if ($id) {
                $filtered_subject = $cSubjects->whereIn('id', $id)->all();
                $result_data[$key]->subject_name = implode(', ', array_column($filtered_subject, 'subject_name'));
            } else {
                $result_data[$key]->subject_name = "";
            }
            if ($exam_type == 'Live') {
                $date = strtotime(date('Y-m-d', strtotime($value->resultDate)));
                $now = strtotime(date('Y-m-d'));
                if ($date > $now) {
                    unset($result_data[$key]);
                }
            }
            if ($exam_type == 'PreviousYear') {
                $year = isset($value->paper_year) ? $value->paper_year : '';
            } else {
                $year = date('Y', strtotime($value->created_at));
            }

            $years_list[] = $year;
        }
        $subject_count = count($filtered_subject);

        if ($exam_type == 'PreviousYear') {
            $years_list = array_unique($years_list);

            $html = view('afterlogin.PreviousYearExam.previous_attempted_list', compact('result_data', 'cSubjects', 'years_list', 'subject_count'))->render();
        } else {

            $html = view('afterlogin.TestSeries.attempted_result_list', compact('result_data', 'cSubjects', 'subject_count'))->render();
        }


        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'result list  successfully.',
        ]);
    }
    /**
     * Save Record To Task Center History
     *
     * @param mixed $user_id  user id
     * @param mixed $tasktype task type
     * @param mixed $category category
     *
     * @return void
     */
    public function saveRecordToTaskCenterHistory($user_id, $tasktype, $category)
    {
        try {
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/save-record-to-task-center-history/' . $user_id . '/' . $tasktype . '/' . $category;
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


            if ($httpcode == 200 || $httpcode == 201) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
