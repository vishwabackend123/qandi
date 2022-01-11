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

class PlannerController extends Controller
{
    //
    use CommonTrait;

    public function addPlanner(Request $request)
    {

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
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/student-planner';

        curl_setopt_array($curl, array(
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

            ),
        ));
        $response_json = curl_exec($curl);


        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode == 200 || $httpcode == 201) {

            return $response_json;
        } else {
            return $err;
        }
    }


    public function weeklyExams(Request $request)
    {
        # code...
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/student-planner-current-week/' . $user_id;


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
    }

    public function getWeeklyPlanSchedule(Request $request)
    {
        # code...
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $range = 0;

        $start_date = $request->start_date;

        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/student-planner/' . $user_id;


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

            return json_encode(array('range' => $range, 'planner' => $planner, 'status' => 'success'));
        } else {

            return json_encode(array('range' => $range, 'status' => 'failed'));
        }
    }



    public function plannerExam($planner_id = null, $chapter_id = null, Request $request)
    {
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
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/planner-question-selection';

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
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
            $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
            $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
            $qs_id = $question_data->question_id;
            $question_data->subject_id = isset($subject_id) ? $subject_id : '';
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
    }


    public function shuffle_chapter($active_subject_id, Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $selected_chapter = isset($request->selected_chapters) ? $request->selected_chapters : [];

        $chapter_list = $this->redis_chapter_list($active_subject_id);
        $chapter_collect = collect($chapter_list);

        $filtered = $chapter_collect->whereNotIn('chapter_id', $selected_chapter);
        $shuffle = $filtered->random();

        return json_encode($shuffle);
    }
}
